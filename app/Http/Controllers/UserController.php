<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Models\UserCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    public function login($id)
    {
        $user = $this->user->find($id);
        Auth::login($user);
        if ($user->user_type_id == 2) {
            return redirect()->route('bank.dashboard');
        }

        if ($user->user_type_id != 5) {
            return redirect()->route('home');
        }

        return redirect()->to('admin');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }


    public function profile()
    {
        $form_type = 'update';
        $form_action = route('update_profile');
        return view('profile', compact('form_type', 'form_action'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'company_name' => 'required',
            'salary' => 'required',
            'work_duration' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->phone = $request->phone;
            if ($user->save()) {
                $profile = Profile::where('user_id', auth()->id())->first();
                if (!$profile) {
                    $profile = new Profile();
                    $profile->user_id = auth()->id();
                }
                $profile->work_duration = $request->work_duration;
                $profile->company_name = $request->company_name;
                $profile->salary = $request->salary;

                $profile->save();
            }
            DB::commit();
            return back()->with('success', 'Profile Update Successfully');
        } catch (\Throwable $th) {
            DB::rollback();

            return back()->with('error', $th->getMessage());
        }
    }


    public function markCardAsOwned(Request $request)
    {

        $userCard = new UserCard();
        $userCard->card_id = $request->card_id;
        $userCard->user_id = auth()->id();
        $userCard->card_number = $request->card_number;
        $userCard->expiry_month = $request->month;
        $userCard->expiry_year = $request->year;


        $userCard->save();

        Session::flash('success', 'New Credit Card added successfully');

        return redirect(route('my_cards'));
    }


    public function myCards()
    {
        $userCards = auth()->user()->cards()->paginate(5);
        return view('my-cards', compact('userCards'));
    }

    public function updateCardDetails(Request $request)
    {
        $userCard = UserCard::where('id', $request->card_id)->where('user_id', auth()->id())->first();
        try {
            $userCard->card_number = $request->card_number;
            $userCard->expiry_month = $request->expiry_month;
            $userCard->expiry_year = $request->expiry_year;
            $userCard->statement_date = $request->statement_date;
            $userCard->statement_month = $request->statement_month;
            $userCard->due_date = $request->due_date;
            $userCard->due_month = $request->due_month;
            $userCard->annual_fee_date = $request->annual_fee_date;
            $userCard->annual_fee_month = $request->annual_fee_month;
            $userCard->tax_date = $request->tax_date;
            $userCard->tax_month = $request->tax_month;
            $userCard->save();
            $html = view('includes.card_details.owned_card_detail', ['ownedCard' => $userCard])->render();
            $response['status'] = 200;
            $response['message'] = 'Card Details updated successfully';
            $response['html'] = $html;
        } catch (\Exception $e) {
            $response['status'] = 403;
            $response['message'] = 'You are not authorized to update card';
        }


        return response()->json($response);
    }
    public function updateSubCardDetails(Request $request)
    {
        $userCard = UserCard::where('id', $request->card_id)->where('user_id', auth()->id())->first();
        try {
            $userCard->cardholder_name = $request->cardholder_name;
            $userCard->save();
            $html = view('includes.card_details.owned_card_detail', ['ownedCard' => $userCard])->render();
            $response['status'] = 200;
            $response['message'] = 'Card Details updated successfully';
            $response['html'] = $html;
        } catch (\Exception $e) {
            $response['status'] = 403;
            $response['message'] = 'You are not authorized to update card';
        }


        return response()->json($response);
    }

    public function reloadCardDates(Request $request)
    {
        $html = '';
        $userCards = auth()->user()->cards;
        $html .= view('includes.modals.annualFee-modal', compact('userCards'));
        $html .= view('includes.modals.duedate-modal', compact('userCards'));
        $html .= view('includes.modals.expirydate-modal', compact('userCards'));
        $html .= view('includes.modals.statement-modal', compact('userCards'));
        $html .= view('includes.modals.serviceTax-modal', compact('userCards'));


        return response()->json(['html' => $html], 200);
    }
}
