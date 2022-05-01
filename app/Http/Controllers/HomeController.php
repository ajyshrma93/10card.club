<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\Card;
use App\Models\Categories;
use App\Models\Merchant;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    protected $category;
    protected $merchant;
    protected $card;
    protected $benefit;
    protected $news;

    public function __construct(
        Categories $category,
        Merchant $merchant,
        Benefit $benefit,
        Card $card,
        News $news
    ) {
        $this->category = $category;
        $this->merchant = $merchant;
        $this->benefit = $benefit;
        $this->card = $card;
        $this->news = $news;
    }

    public function index()
    {
        $categories = $this->category->all();
        $merchants = $this->merchant->where('is_approved', 1)->get();
        $news = $this->news->with(['bank', 'card_type'])->get();

        return view('home', compact('categories', 'merchants', 'news'));
    }

    public function category($category, Request $request)
    {
        $request->session()->flash('previous-route', route('category', ['category' => $category]));
        $category = $this->category->where('slug', $category)->first();
        if (!isset($category)) {
            $message = 'Category not found';
            return view('errors.404', compact('message'));
        }

        $merchants = $this->merchant->where('category_id', $category->id)->get();
        $merchantIds = [];
        foreach ($merchants as $merchant) {
            $merchantIds[] = $merchant['id'];
        }

        $day = Str::of(Carbon::now()->getTranslatedShortDayName())->lower();
        $column = 'benefit_day_' . $day;
        $cards = $this->card->with(['benefits' => function ($query) use ($merchantIds, $column) {
            $query->whereIn('merchant_id', $merchantIds)->where($column, '1')->get();
        }])->get();

        $benefits = $this->benefit->with(['merchant'])->whereIn('merchant_id', $merchantIds)->where($column, '1')->get();

        $benfits_categories = $this->card->with(['benefits' => function ($query) use ($merchantIds) {
            $query->whereIn('merchant_id', $merchantIds)->get();
        }])->get();


        $today_suggestions = [];
        foreach ($cards as $card) {
            if ($card->benefits->count() != 0) {
                $today_suggestions[] = $card;
            }
        }

        $this_category = [];
        foreach ($benfits_categories as $benfits_category) {
            if ($benfits_category->benefits->count() != 0) {
                $this_category[] = $benfits_category->toArray();
            }
        }

        $todays_merchants = [];
        foreach ($benefits as $benefit) {
            $todays_merchants[$benefit->merchant->id] = $benefit->merchant;
        }
        $todays_merchants = array_values($todays_merchants);

        return view('category', compact('category', 'today_suggestions', 'merchants', 'this_category', 'todays_merchants'));
    }
}
