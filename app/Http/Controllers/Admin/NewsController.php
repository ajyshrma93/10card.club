<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function __construct()
    {
        view()->share('menu', 'news');
    }


    public function index()
    {
        $news = News::get();

        return view('admin.news-list', compact('news'));
    }


    public function updateStatus($id)
    {
        $news = News::where('id', $id)->first();
        $news->is_approved = $news->is_approved ? 0 : 1;
        if ($news->save()) {
            Session::flash('success', 'News has been approved successfully');
        } else {
            Session::flash('error', 'Something went wrong.Please try again later !!!');
        }

        return back();
    }

    public function destroy($id)
    {

        $news = News::findOrFail($id);
        if ($news->delete()) {
            Session::flash('success', 'News has been deleted successfully');
        } else {
            Session::flash('error', 'Something went wrong.Please try again later');
        }

        return back();
    }

    public function view(Request $request)
    {
        $id = $request->id;
        try {
            $news = News::find($id);
            $html = view('admin.partials.news-details', compact('news'))->render();
            $response['status'] = 200;
            $response['html'] = $html;
        } catch (\Exception $e) {
            $response['status'] = 204;
            $response['message'] = $e->getMessage();
        }
        return response()->json($response);
    }
}
