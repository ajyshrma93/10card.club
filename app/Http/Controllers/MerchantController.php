<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAdmin;
use App\Models\Categories;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MerchantController extends Controller
{
    protected $categories;
    protected $bankAdmin;

    public function __construct(
        Categories $categories,
        Merchant $merchant
    ) {
        $this->categories = $categories;
        $this->merchant = $merchant;
    }

    public function merchantsList()
    {
        $merchants = $this->merchant->with(['category'])->get();

        return view('merchants.merchant_list', compact('merchants'));
    }

    public function addMerchantForm()
    {
        $categories = $this->categories->all();

        return view('merchants.merchant_add', compact('categories'));
    }

    public function addMerchant(Request $request)
    {

        $data = $request->except('_token');

        $this->validate($request, [
            'category_id' => 'required',
            'merchant_name' => 'required',
            'merchant_image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:5120',
        ], [
            'category_id.required' => 'Category field is required'
        ]);

        try {
            $slug = Str::slug($data['merchant_name'], '-');
            if (!$this->merchant->where('slug', $slug)->first()) {
                $file = $request->file('merchant_image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/merchants', $fileName, 'public');
                $data['merchant_image'] = 'storage/' . $filePath;
                $data['slug'] = $slug;
                $this->merchant->create($data);

                return back()->with('success', 'Merchant added successfully.');
            } else {
                return back()->with('error', 'Merchant is already registered')->withInput();
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong!')->withInput();
        }
    }
}
