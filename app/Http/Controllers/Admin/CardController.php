<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    //
    public function __construct()
    {
        view()->share('menu', 'cards');
    }

    public function index()
    {
        $cards = Card::get();

        return view('admin.cards', compact('cards'));
    }

    public function view(Request $request)
    {
        $id = $request->id;
        try {
            $card = Card::find($id);

            $html = view('admin.partials.card-details', compact('card'))->render();
            $response['status'] = 200;
            $response['html'] = $html;
        } catch (\Exception $e) {
            $response['status'] = 204;
            $response['message'] = $e->getMessage();
        }
        return response()->json($response);
    }
}
