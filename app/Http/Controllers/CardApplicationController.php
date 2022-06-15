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
        $exists = CardApplication::where(['user_id' => auth()->id(), 'card_id' => $card->id])->first();
        if (!$exists) {
            $newApplication = new CardApplication();
            $newApplication->card_id = $card->id;
            $newApplication->bank_id = $card->bank_id;
            $newApplication->user_id = auth()->id();
            $newApplication->save();
        }

        return redirect()->to($card->card_info_url);
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

    public function supportApplications()
    {
        $applications = CardApplication::orderByDesc('id')->get();
        return view('card_applications', compact('applications'));
    }

    public function messages($id)
    {
        $application = CardApplication::findOrFail($id);
        $chats = $application->conversations;
        Chat::where('application_id', $application->id)->where('user_id', '!=', auth()->id())->update(['is_new' => 0]);
        return view('support_chat', compact('application', 'chats'));
    }
}
