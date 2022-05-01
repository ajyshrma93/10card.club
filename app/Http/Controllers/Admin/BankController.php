<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    //

    public function __construct()
    {
        view()->share('menu', 'bank');
    }

    public function index()
    {
        $banks = Bank::get();
        return view('admin.banks', compact('banks'));
    }

    public function view(Request $request)
    {
        $id = $request->id;
        try {
            $bank = Bank::find($id);

            $html = view('admin.partials.bank-details', compact('bank'))->render();
            $response['status'] = 200;
            $response['html'] = $html;
        } catch (\Exception $e) {
            $response['status'] = 204;
            $response['message'] = $e->getMessage();
        }
        return response()->json($response);
    }
}
