<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function __construct()
    {
        view()->share('menu', 'category');
    }

    public function index()
    {
        $categories = Categories::get();

        return view('admin.categories', compact('categories'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'category' => 'required|unique:categories,category'
        ]);

        $category = new Categories();
        $category->category = $request->category;
        $category->slug =  Str::slug($request->category, '-');

        if ($category->save()) {
            Session::flash('success', 'New Category Create Successfully');
        } else {
            Session::flash('error', 'Something went wrong');
        }

        return back();
    }
}
