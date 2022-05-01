<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Card::select('cards.*');
        if ($request->search) {
            $query = $query->where('card_name', 'like', '%' . $request->search . '%');
            $query = $query->orWhere('bank_name', 'like', '%' . $request->search . '%');
            $query = $query->orWhere('card_types.label', 'like', '%' . $request->search . '%');
        }
        $query =  $query->leftJoin('banks', 'banks.id', '=', 'cards.bank_id');
        $query =  $query->leftJoin('card_types', 'card_types.id', '=', 'cards.card_type_id');
        $cards = $query->paginate(5);
        return view('search', compact('cards'));
    }
}
