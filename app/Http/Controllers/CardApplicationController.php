<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardApplication;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CardApplicationController extends Controller
{

    public function apply($id)
    {
        $card = Card::findOrFail($id);
        if ($this->checkIsApplied($id)) {
            return redirect(route('my_applications'));
        }
        return view('card_application_form', compact('card'));
    }

    public function saveApplication($id, Request $request)
    {
        $card = Card::findOrFail($id);
        $data =  $request->validate([
            'company_name' => 'required',
            'card_id' => 'required',
            'offer_letter' => 'required|mimes:jpeg,bmp,png,jpg,pdf',
            'salary_slip' => 'required|mimes:jpeg,bmp,jpg,png,pdf',
            'epf' => 'required|mimes:jpeg,bmp,png,jpg,pdf',

        ], [
            'offer_letter.required' => 'Please upload your company offer letter',
            'salary_slip.required' => 'Please upload your last 3 months salary slip',
            'epf.required' => 'Please upload your last 3 months salary slip',
        ]);

        $file = $request->file('offer_letter');
        $fileName = Str::random(32) . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/application', $fileName, 'public');
        $data['offer_letter'] = 'storage/' . $filePath;

        $file = $request->file('salary_slip');
        $fileName = Str::random(32) . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/application', $fileName, 'public');
        $data['salary_slip'] = 'storage/' . $filePath;

        $file = $request->file('epf');
        $fileName = Str::random(32) . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/application', $fileName, 'public');
        $data['epf'] = 'storage/' . $filePath;
        $data['user_id'] = auth()->id();
        $data['bank_id'] = $card->bank_id;
        try {
            $application = CardApplication::create($data);
            Session::flash('success', 'Your application for credit card ' . $card->card_name . ' has been submitted successfully');
            return redirect(route('my_applications'));
        } catch (\Exception $e) {

            Session::flash('error', 'Something went wrong. Please try again later' . $e->getMessage());
            return back();
        }
    }

    public function checkIsApplied($id)
    {

        $application = CardApplication::where('user_id', auth()->id())->where('card_id', $id)->exists();
        if ($application) {
            Session::flash('error', 'You have already applied to this credit card');
        }
        return $application;
    }


    public function myApplications()
    {

        $applications = auth()->user()->myApplications()->paginate(5);

        return view('my_card_applications', compact('applications'));
    }


    public function messages($id)
    {
        $application = CardApplication::findOrFail($id);
        $chats = $application->conversations;
        Chat::where('application_id', $application->id)->where('user_id', '!=', auth()->id())->update(['is_new' => 0]);
        return view('support_chat', compact('application', 'chats'));
    }
}
