<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    protected $bank;
    protected $bankAdmin;

    public function __construct(
        Bank $bank,
        BankAdmin $bankAdmin
    ) {
        $this->bank = $bank;
        $this->bankAdmin = $bankAdmin;
    }

    public function details()
    {
        $user = Auth::user();
        $bankAdmin = $this->bankAdmin->where('user_id', $user->id)->first();
        $bank = $this->bank->find($bankAdmin->bank_id);
        
        return view('bank_details', compact('bank'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $bankAdmin = $this->bankAdmin->where('user_id', $user->id)->first();

        $this->validate($request, [
            'bank_name' => 'required',
            'bank_hotline' => 'required',
            'shortcut_speak' => 'required',
            'redeem_web' => 'required',
            'min_age' => 'required|numeric|between:1,150',
            'min_age_sub' => 'required|numeric|between:1,150',
            'point_value_rm' => 'required',
            'late_charge_fee' => 'required',
            'interest_rate' => 'required',
            'hotline_serviceable' => 'required',
            'point_value_rm' => 'required',
            'point_rebate_percentage' => 'required',
            'late_charge_fee' => 'required',
            'interest_rate' => 'required',
            'cash_out_interest' => 'required',
            'cash_out_first_charge' => 'required'
        ]);
        
        $weekDayArray = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        $data = $request->except('_token');
        $hotline_serviceable = $data['hotline_serviceable'];
        $hotline_time = (!isset($data['hotline_time'])) ? [] : $data['hotline_time'];
        foreach($hotline_serviceable as $key => $service_day){
            if(in_array($key,$weekDayArray)){
                if($service_day == 'no'){
                    $hotline_time[$key] = [
                        'start_time' => '',
                        'end_time' => ''
                    ];
                }
            }
        }
        $data['hotline_time'] = $hotline_time;
        unset($data['hotline_serviceable']);
        unset($data['bank_update']);
        
        $this->bank->where('id', $bankAdmin->bank_id)->update($data);
        
        return redirect(route('bank_details'))->with('success','Bank Details Updated Successfully');
    }
}
