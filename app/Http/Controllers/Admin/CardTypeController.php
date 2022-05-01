<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CardType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CardTypeController extends Controller
{
    public function __construct()
    {
        view()->share('menu', 'card-types');
    }

    public function index()
    {
        $types = CardType::get();

        return view('admin.card-types', compact('types'));
    }


    public function save(Request $request)
    {
        $request->validate([
            'label' => 'required|unique:card_types,label'
        ], [
            'label.unique' => 'Card Type already exists',
            'label.required' => 'Please enter card type name',
        ]);


        $cardType = new CardType();
        $cardType->label = $request->label;
        $cardType->card_type = Str::slug($cardType->label, '_');

        if ($cardType->save()) {
            Session::flash('success', 'New Card Type created successfully');
        } else {
            Session::flash('error', 'Something went wrong. While creating new card type');
        }

        return back();
    }
}
