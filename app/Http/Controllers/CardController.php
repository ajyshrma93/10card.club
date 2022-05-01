<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAdmin;
use App\Models\Benefit;
use App\Models\Card;
use App\Models\CardType;
use App\Models\Merchant;
use App\Models\UserMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use Illuminate\Support\Arr;

class CardController extends Controller
{
    protected $card;
    protected $benefit;
    protected $userMessage;
    protected $bank;
    protected $cardType;
    protected $bankAdmin;

    public function __construct(
        Card $card,
        Benefit $benefit,
        UserMessage $userMessage,
        Bank $bank,
        CardType $cardType,
        BankAdmin $bankAdmin,
        Merchant $merchant
    ) {
        $this->card = $card;
        $this->benefit = $benefit;
        $this->userMessage = $userMessage;
        $this->bank = $bank;
        $this->cardType = $cardType;
        $this->bankAdmin = $bankAdmin;
        $this->merchant = $merchant;
    }

    public function addCardForm()
    {
        $user = Auth::user();
        $merchants = $this->merchant->all();

        $bankAdmin = $this->bankAdmin->with('bank')->where('user_id', $user->id)->first();
        $bank = $bankAdmin->bank;
        $card_types = $this->cardType->all();
        $form_type = 'add';
        $form_action = route('card_add');
        $card_form = [];

        return view('card_add', compact('bank', 'card_types', 'merchants', 'card_form', 'form_type', 'form_action'));
    }

    public function editCardForm($id)
    {
        $user = Auth::user();
        $card = $this->card->find($id);
        $bankAdmin = $this->bankAdmin->with('bank')->where('user_id', $user->id)->first();
        $bank = $bankAdmin->bank;
        if (!isset($card)) {
            $message = 'Card not found';
            return view('errors.404', compact('message'));
        }
        if ($card->bank_id != $bank->id) {
            $message = 'Access denied!';
            return view('errors.404', compact('message'));
        }

        $merchants = $this->merchant->all();

        $bankAdmin = $this->bankAdmin->with('bank')->where('user_id', $user->id)->first();
        $bank = $bankAdmin->bank;
        $card_types = $this->cardType->all();
        $form_type = 'edit';
        $form_action = route('card_edit', ['id' => $card->id]);

        $card_form = $this->prepareEditCardResponse($card);

        return view('card_add', compact('bank', 'card_types', 'merchants', 'card_form', 'form_type', 'form_action'));
    }

    public function prepareEditCardResponse($card)
    {

        $annual_fee_free_for = 'no';
        if ($card->annual_fee == '' && $card->annual_fee_free_1_year == '') {
            $annual_fee_free_for = 'lifetime';
        } else if ($card->annual_fee_free_1_year == 'yes') {
            $annual_fee_free_for = 'one_year';
        }

        $benefits = [];
        $benefitLists = $this->benefit->with('merchant')->where('card_id', $card->id)->get();

        foreach ($benefitLists as $benefitList) {
            $benefit_string = '';
            if ($benefitList->benefit_day_mon) {
                $benefit_string .= 'Mon,';
            }
            if ($benefitList->benefit_day_tue) {
                $benefit_string .= 'Tue,';
            }
            if ($benefitList->benefit_day_wed) {
                $benefit_string .= 'Wed,';
            }
            if ($benefitList->benefit_day_thu) {
                $benefit_string .= 'Thu,';
            }
            if ($benefitList->benefit_day_fri) {
                $benefit_string .= 'Fri,';
            }
            if ($benefitList->benefit_day_sat) {
                $benefit_string .= 'Sat,';
            }
            if ($benefitList->benefit_day_sun) {
                $benefit_string .= 'Sun,';
            }
            $benefits[] = [
                'id' => $benefitList->id,
                'merchant_id' => $benefitList->merchant_id,
                'merchant_benefit_description' => $benefitList->merchant_benefit_description,
                'merchant_image' => $benefitList->merchant->merchant_image,
                'merchant_name' => $benefitList->merchant->merchant_name,
                'benefit_description_text' => strip_tags($benefitList->merchant_benefit_description),
                'index' => null,
                'benefit_day' => false,
                'benefit_day_mon' => $benefitList->benefit_day_mon,
                'benefit_day_tue' => $benefitList->benefit_day_tue,
                'benefit_day_wed' => $benefitList->benefit_day_wed,
                'benefit_day_thu' => $benefitList->benefit_day_thu,
                'benefit_day_fri' => $benefitList->benefit_day_fri,
                'benefit_day_sat' => $benefitList->benefit_day_sat,
                'benefit_day_sun' => $benefitList->benefit_day_sun,
                'benefit_string' => $benefit_string
            ];
        }

        $card_form = [
            'card_type_id' => $card->card_type_id,
            'card_name' => $card->card_name,
            'card_image' => asset($card->card_image),
            'card_des' => $card->card_des,
            'card_info_url' => $card->card_info_url,
            'rebate_type' => ($card->point_or_cashrebate == 'both') ? ['point', 'cash'] : [$card->point_or_cashrebate],
            'point_value_rm' => $card->point_value_rm,
            'point_rebate_percentage' => $card->point_rebate_percentage,
            'point_or_cashrebate_description' => $card->point_or_cashrebate_description,
            'point_name' => $card->point_name,
            'annual_fee_free_for' => $annual_fee_free_for,
            'annual_fee' => $card->annual_fee,
            'annual_fee_sub' => $card->annual_fee_sub,
            'annual_fee_waived' => $card->annual_fee_waived,
            'late_charge_fee' => $card->late_charge_fee,
            'interest_rate' => $card->interest_rate,
            'cashout_can' => $card->cashout_can,
            'cash_out_interest' => $card->cash_out_interest,
            'cash_out_first_charge' => $card->cash_out_first_charge,
            'min_income' => $card->min_income,
            'benefits' => $benefits
        ];

        return $card_form;
    }

    public function addCard(Request $request)
    {
        $user = Auth::user();
        $bankAdmin = $this->bankAdmin->with('bank')->where('user_id', $user->id)->first();
        $bank = $bankAdmin->bank;

        $data = $this->cardFormValidation($request, 'add');
        $benefits = json_decode($data['benefits']);

        DB::beginTransaction();
        try {
            $file = $request->file('card_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/cards', $fileName, 'public');
            $data['card_image'] = 'storage/' . $filePath;
            $data['bank_id'] = $bank->id;
            $data['point_or_cashrebate'] = 'cash';
            if (in_array('point', $data['rebate_type']) && in_array('cash', $data['rebate_type'])) {
                $data['point_or_cashrebate'] = 'both';
            } else if (in_array('point', $data['rebate_type']) && !in_array('cash', $data['rebate_type'])) {
                $data['point_or_cashrebate'] = 'point';
            }
            unset($data['rebate_type']);
            $card = $this->card->create($data);
            $benefits = json_decode($data['benefits']);
            if ($benefits) {
                $merchantBenefits = [];
                foreach ($benefits as $key => $benefit) {
                    $merchantBenefits[] = [
                        'card_id' => $card->id,
                        'merchant_id' => $benefit->merchant_id,
                        'merchant_benefit_description' => $benefit->merchant_benefit_description,
                        'benefit_day_mon' => $benefit->benefit_day_mon,
                        'benefit_day_tue' => $benefit->benefit_day_tue,
                        'benefit_day_wed' => $benefit->benefit_day_wed,
                        'benefit_day_thu' => $benefit->benefit_day_thu,
                        'benefit_day_fri' => $benefit->benefit_day_fri,
                        'benefit_day_sat' => $benefit->benefit_day_sat,
                        'benefit_day_sun' => $benefit->benefit_day_sun,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                $this->benefit->insert($merchantBenefits);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Card added successfully.', 'data' => []]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Something went wrong!.', 'data' => []]);
        }
    }

    public function updateCard(Request $request, $id)
    {
        $user = Auth::user();
        $card = $this->card->find($id);
        $bankAdmin = $this->bankAdmin->with('bank')->where('user_id', $user->id)->first();
        $bank = $bankAdmin->bank;
        if (!isset($card)) {
            $message = 'Card not found';
            return view('errors.404', compact('message'));
        }
        if ($card->bank_id != $bank->id) {
            $message = 'Access denied!';
            return view('errors.404', compact('message'));
        }
        $data = $this->cardFormValidation($request, 'edit');
        $benefits = json_decode($data['benefits']);

        DB::beginTransaction();
        try {
            if ($request->file('card_image')) {
                $file = $request->file('card_image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/cards', $fileName, 'public');
                $data['card_image'] = 'storage/' . $filePath;
            } else {
                unset($data['card_image']);
            }

            $data['point_or_cashrebate'] = 'cash';
            if (in_array('point', $data['rebate_type']) && in_array('cash', $data['rebate_type'])) {
                $data['point_or_cashrebate'] = 'both';
            } else if (in_array('point', $data['rebate_type']) && !in_array('cash', $data['rebate_type'])) {
                $data['point_or_cashrebate'] = 'point';
            }
            unset($data['rebate_type']);
            if (isset($data['deletedBenefits']) && count($data['deletedBenefits']) != 0) {
                $deletedBenefits = $data['deletedBenefits'];
                $this->benefit->whereIn('id', $deletedBenefits)->delete();
            }
            $data = Arr::only($data, $this->card->getFillable());
            $this->card->where('id', $id)->update($data);

            if ($benefits) {
                $merchantBenefits = [];
                foreach ($benefits as $key => $benefit) {
                    $tempBenefits = [
                        'card_id' => $card->id,
                        'merchant_id' => $benefit->merchant_id,
                        'merchant_benefit_description' => $benefit->merchant_benefit_description,
                        'benefit_day_mon' => $benefit->benefit_day_mon,
                        'benefit_day_tue' => $benefit->benefit_day_tue,
                        'benefit_day_wed' => $benefit->benefit_day_wed,
                        'benefit_day_thu' => $benefit->benefit_day_thu,
                        'benefit_day_fri' => $benefit->benefit_day_fri,
                        'benefit_day_sat' => $benefit->benefit_day_sat,
                        'benefit_day_sun' => $benefit->benefit_day_sun,
                    ];
                    if (isset($benefit->id) && $benefit->id != '' && $benefit->id != 0) {
                        $this->benefit->where('id', $benefit->id)->update($tempBenefits);
                    } else {
                        $tempBenefits['created_at'] = Carbon::now();
                        $tempBenefits['updated_at'] = Carbon::now();
                        $merchantBenefits[] = $tempBenefits;
                    }
                }
                $this->benefit->insert($merchantBenefits);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Something went wrong!.', 'data' => []]);
        }
        $card = $this->card->find($id);
        $data = $this->prepareEditCardResponse($card);

        return response()->json(['success' => true, 'message' => 'Card updated successfully.', 'data' => $data]);
    }

    public function deleteCard($id)
    {
        $user = Auth::user();
        $card = $this->card->find($id);
        $bankAdmin = $this->bankAdmin->with('bank')->where('user_id', $user->id)->first();
        $bank = $bankAdmin->bank;
        if (!isset($card)) {
            $message = 'Card not found';
            return view('errors.404', compact('message'));
        }
        if ($card->bank_id != $bank->id) {
            $message = 'Access denied!';
            return view('errors.404', compact('message'));
        }

        $card->delete();

        return response()->json(['success' => true, 'message' => 'Card deleted successfully.', 'data' => []]);
    }

    public function cardFormValidation($request, $type)
    {
        $data = $request->except('_token');
        $validation = [
            'card_type_id' => 'required',
            'card_name' => 'required',
            'card_info_url' => 'required',
            'rebate_type' => 'required',
            'annual_fee_free_for' => 'required|in:one_year,lifetime,no',
            'late_charge_fee' => 'required',
            'interest_rate' => 'required',
            'cashout_can' => 'required',
            'min_income' => 'required'
        ];

        if ($type == 'edit' && $request->file('card_image') != '') {
            $validation['card_image'] = 'sometimes|image|mimes:png,jpg,jpeg,gif,svg|max:5120';
        }
        if ($type == 'add') {
            $validation['card_image'] = 'required|image|mimes:png,jpg,jpeg,gif,svg|max:5120';
        }

        if (isset($data['cashout_can']) && $data['cashout_can'] == 'yes') {
            $validation['cash_out_interest'] = 'required';
            $validation['cash_out_first_charge'] = 'required';
        } else {
            unset($validation['cash_out_interest']);
            unset($validation['cash_out_first_charge']);
        }

        if (isset($data['rebate_type']) && in_array('point', $data['rebate_type'])) {
            $validation['point_value_rm'] = 'required';
            $validation['point_rebate_percentage'] = 'required';
        } else {
            $data['point_value_rm'] = NULL;
            $data['point_rebate_percentage'] = NULL;
            $data['point_name'] = NULL;
        }

        if (isset($data['annual_fee_free_for'])) {
            if ($data['annual_fee_free_for'] == 'one_year') {
                $validation['annual_fee'] = 'required';
                $validation['annual_fee_sub'] = 'required';
                $data['annual_fee_free_1_year'] = 'yes';
            } else if ($data['annual_fee_free_for'] == 'lifetime') {
                $data['annual_fee'] = NULL;
                $data['annual_fee_sub'] = NULL;
                $data['annual_fee_free_1_year'] = NULL;
                $data['annual_fee_waived'] = NULL;
            } else {
                $data['annual_fee_free_1_year'] = 'no';
                $validation['annual_fee'] = 'required';
                $validation['annual_fee_sub'] = 'required';
                $data['annual_fee_waived'] = NULL;
            }
        }
        $this->validate($request, $validation, [
            'card_type_id.required' => 'Card type field is required',
            'rebate_type.required' => 'Please select atleast one rebate type.'
        ]);

        return $data;
    }

    public function card($id, Request $request)
    {
        $card = $this->card->with('bank')->find($id);
        if (!isset($card)) {
            $message = 'Card not found';
            return view('errors.404', compact('message'));
        }
        $benefits = $this->benefit->with(['merchant'])->where('card_id', $id)->get();


        $merchants = [];
        foreach ($benefits as $benefit) {
            $merchants[] = [
                'name' => $benefit->merchant->merchant_name,
                'description' => $benefit->merchant_benefit_description,
                'logo' => $benefit->merchant->merchant_image
            ];
        }

        return view('card_details', compact('card', 'merchants'));
    }

    public function cardList()
    {
        $user = Auth::user();
        $bankAdmin = $this->bankAdmin->with('bank')->where('user_id', $user->id)->first();
        $bank = $bankAdmin->bank;
        $cards = $this->card->where('bank_id', $bank->id)->get();

        return view('card_list', compact('cards'));
    }
}
