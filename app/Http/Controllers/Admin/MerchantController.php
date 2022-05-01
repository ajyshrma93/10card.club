<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class MerchantController extends Controller
{

    public function __construct()
    {
        view()->share('menu', 'merchant');
    }

    public function index()
    {
        $merchants = Merchant::get();

        return view('admin.merchants', compact('merchants'));
    }


    public function updateStatus(Request $request)
    {
        $merchant = Merchant::where('id', request()->id)->first();
        $merchant->is_approved = $merchant->is_approved ? 0 : 1;
        if ($merchant->save()) {
            Session::flash('success', 'Merchant Status has been approved successfully');
        } else {
            Session::flash('error', 'Something went wrong.Please try again later !!!');
        }

        return back();
    }


    public function view(Request $request)
    {
        $id = $request->id;
        $merchant = Merchant::findOrFail($id);
        $html = '';
        if ($merchant) {
            $href = asset($merchant->merchant_image);
            $html .= '<p><img src="' . $href . '" width=100px/></p>';
            $html .= '<p><b>Name : </b>' . $merchant->merchant_name . '</p>';
            $html .= '<p><b>Category : </b>' . ($merchant->category ? $merchant->category->category  : 'N/A') . '</p>';
            $html .= '<p><b>Status : </b>' . ($merchant->is_approved ? 'Approved' : 'Not-Approved') . '</p>';
        }

        return response()->json(['status' => $html ? 200 : 204, 'html' => $html]);
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'merchant_name' => 'required|unique:merchants,merchant_name',
            'merchant_image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:5120',
        ], [
            'category_id.required' => 'Category field is required'
        ]);
        $slug = Str::slug($data['merchant_name'], '-');
        $file = $request->file('merchant_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/merchants', $fileName, 'public');
        $data['merchant_image'] = 'storage/' . $filePath;
        $data['slug'] = $slug;

        if (Merchant::create($data)) {
            Session::flash('success', 'Merchant Added Successfully');
        } else {
            Session::flash('error', 'Something went wrong while adding merchant');
        }

        return back();
    }
}
