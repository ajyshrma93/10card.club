<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\CardType;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    protected $bank;
    protected $cardType;
    protected $news;

    public function __construct(
        Bank $bank,
        CardType $cardType,
        News $news
    ) {
        $this->bank = $bank;
        $this->cardType = $cardType;
        $this->news = $news;
    }

    public function newsList()
    {
        $user = Auth::user();
        $news_list = $this->news->where('user_id', $user->id)->get();

        return view('news_list', compact('news_list'));
    }

    public function createForm()
    {
        $banks = $this->bank->all();
        $card_types = $this->cardType->all();
        $form_type = 'create';
        $form_action = route('news_create');
        $news_form = [];

        return view('news-create', compact('banks', 'card_types', 'form_type', 'form_action', 'news_form'));
    }

    public function editForm($id)
    {
        $user = Auth::user();
        $news = $this->news->where('user_id', $user->id)->where('id', $id)->first();
        if (!isset($news)) {
            $message = 'News not found';
            return view('errors.404', compact('message'));
        }

        $banks = $this->bank->all();
        $card_types = $this->cardType->all();
        $form_type = 'edit';
        $form_action = route('news_edit', ['id' => $id]);

        $news_form = [
            'title' => $news->title,
            'cover_image' => ($news->cover_image != '') ? asset($news->cover_image) : null,
            'bank_id' => $news->bank_id,
            'card_type_id' => $news->card_type_id,
            'description' => $news->description
        ];

        return view('news-create', compact('banks', 'card_types', 'form_type', 'form_action', 'news_form'));
    }

    public function create(Request $request)
    {
        $validations = [
            'title' => 'required',
            'bank_id' => 'required',
            'card_type_id' => 'required',
            'description' => 'required'
        ];
        if ($request->hasFile('cover_image')) {
            $validations['cover_image'] = 'image|mimes:png,jpg,jpeg,gif,svg|max:5120';
        }
        $this->validate($request, $validations);

        DB::beginTransaction();
        try {
            $data = $request->except('_token');

            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/news', $fileName, 'public');
                $data['cover_image'] = 'storage/' . $filePath;
            } else {
                unset($data['cover_image']);
            }

            $data['user_id'] = Auth::user()->id;
            $data['description'] = Str::replace('&nbsp;', ' ', $data['description']);
            $news = $this->news->create($data);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'News added successfully.', 'data' => []]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Something went wrong!.', 'data' => []]);
        }
    }

    public function update($id, Request $request)
    {
        $validations = [
            'title' => 'required',
            'bank_id' => 'required',
            'card_type_id' => 'required',
            'description' => 'required'
        ];
        if ($request->hasFile('cover_image')) {
            $validations['cover_image'] = 'image|mimes:png,jpg,jpeg,gif,svg|max:5120';
        }
        $this->validate($request, $validations);

        DB::beginTransaction();
        try {
            $data = $request->except('_token');

            $user = Auth::user();
            $news = $this->news->where('user_id', $user->id)->where('id', $id)->first();
            if (!isset($news)) {
                $message = 'News not found';
                return view('errors.404', compact('message'));
            }

            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/news', $fileName, 'public');
                $data['cover_image'] = 'storage/' . $filePath;
            } else {
                unset($data['cover_image']);
            }

            $data['description'] = Str::replace('&nbsp;', ' ', $data['description']);
            $news->update($data);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'News updated successfully.', 'data' => []]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Something went wrong!.', 'data' => []]);
        }
    }

    public function delete($id)
    {
        $user = Auth::user();
        $news = $this->news->where('user_id', $user->id)->where('id', $id)->first();
        if (!isset($news)) {
            $message = 'Card not found';
            return view('errors.404', compact('message'));
        }
        if ($news->user_id != $user->id) {
            $message = 'Access denied!';
            return view('errors.404', compact('message'));
        }
        $cover_image = $news->cover_image;
        if ($news->delete() && $cover_image != '') {
            File::delete($cover_image);
        }

        return response()->json(['success' => true, 'message' => 'News deleted successfully.', 'data' => []]);
    }

    public function detail($id)
    {
        $news = $this->news->with(['bank', 'card_type'])->find($id);
        if (!isset($news)) {
            $message = 'News not found';
            return view('errors.404', compact('message'));
        }
        return view('news-detail', compact('news'));
    }
}
