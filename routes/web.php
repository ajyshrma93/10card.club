<?php

use App\Http\Controllers\Admin\BankController as AdminBankController;
use App\Http\Controllers\Admin\CardController as AdminCardController;
use App\Http\Controllers\Admin\CardTypeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MerchantController as AdminMerchantController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CardApplicationController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserCardNoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');
Route::get('/card/{id}', [CardController::class, 'card'])->name('card_details');
Route::get('/card/message/{id}', [UserMessageController::class, 'listMessage'])->name('list_card_message');
Route::get('/card/search/message/{id}', [UserMessageController::class, 'searchMessage'])->name('card_chat_search');
Route::get('/news/detail/{id}', [NewsController::class, 'detail'])->name('news_detail');

///// logged user routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user_profile');
    Route::post('/user/profile', [UserController::class, 'updateProfile'])->name('update_profile');
    Route::post('/card/add/message/{id}', [UserMessageController::class, 'addMessage'])->name('addMessage');
    Route::get('/card/user/note/{id}', [UserCardNoteController::class, 'userCardNotesList'])->name('list_user_note');
    Route::post('/card/user/note/{id}/add', [UserCardNoteController::class, 'addUserCardNote'])->name('add_user_note');
    Route::delete('/card/user/note/{id}/delete', [UserCardNoteController::class, 'deleteUserCardNote'])->name('delete_user_note');


    //// user self card routes
    Route::post('/mark-card-as-owned', [UserController::class, 'markCardAsOwned'])->name('mark_card_as_owned');
    Route::post('/update-card-details', [UserController::class, 'updateCardDetails'])->name('update_user_card');
    Route::post('/update-subcard-details', [UserController::class, 'updateSubCardDetails'])->name('update_user_card_subcard_detail');
    Route::post('/reload-card-dates', [UserController::class, 'reloadCardDates'])->name('reload_user_card_details');
    Route::get('apply/{id}/card', [CardApplicationController::class, 'apply'])->name('apply_for_card');
    Route::get('redirect/{id}/card', [CardApplicationController::class, 'saveApplication'])->name('redirect.to.apply.card');
    Route::get('my-applications', [CardApplicationController::class, 'myApplications'])->name('my_applications');
    Route::get('card-applications', [CardApplicationController::class, 'supportApplications'])->name('support.agent.card.applications');

    Route::get('/my-cards', [UserController::class, 'myCards'])->name('my_cards');
    Route::get('/card-support/{id}/messages', [CardApplicationController::class, 'messages'])->name('application_chat');
    Route::post('send-message', [ChatController::class, 'sendMessage'])->name('send_message');
    Route::post('load-new-message', [ChatController::class, 'loadMessage'])->name('load_application_chat');
});

//// bank admin routes
Route::group(['middleware' => ['auth', 'bank_admin']], function () {

    Route::get('dashboard', [BankController::class, 'dashboard'])->name('bank.dashboard');
    Route::get('/news/list', [NewsController::class, 'newsList'])->name('news_list');
    Route::get('/news/create', [NewsController::class, 'createForm'])->name('news_create');
    Route::post('/news/create', [NewsController::class, 'create']);
    Route::get('/news/edit/{id}', [NewsController::class, 'editForm'])->name('news_edit');
    Route::post('/news/edit/{id}', [NewsController::class, 'update']);
    Route::delete('/news/delete/{id}', [NewsController::class, 'delete']);
    Route::get('/bank/details', [BankController::class, 'details'])->name('bank_details');
    Route::post('/bank/details/update', [BankController::class, 'update'])->name('bank_details_update');
    Route::get('/cards/add', [CardController::class, 'addCardForm'])->name('card_add');
    Route::post('/cards/add', [CardController::class, 'addCard']);
    Route::get('/cards/edit/{id}', [CardController::class, 'editCardForm'])->name('card_edit');
    Route::post('/cards/edit/{id}', [CardController::class, 'updateCard']);
    Route::delete('/cards/delete/{id}', [CardController::class, 'deleteCard']);
    Route::get('/cards/list', [CardController::class, 'cardList'])->name('card_list');
    Route::get('/merchants/list', [MerchantController::class, 'merchantsList'])->name('merchant_list');
    Route::get('/merchants/add', [MerchantController::class, 'addMerchantForm'])->name('merchant_add');
    Route::post('/merchants/add', [MerchantController::class, 'addMerchant']);
});

//// admin routes
Route::group(['middleware' => ['auth', 'is_admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    /// admin categories routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'save'])->name('categories');
    //// admin merchants routes
    Route::get('/merchants', [AdminMerchantController::class, 'index'])->name('merchants');
    Route::post('/merchants', [AdminMerchantController::class, 'save'])->name('merchants');
    Route::post('/merchant/view', [AdminMerchantController::class, 'view'])->name('merchant.view');
    Route::get('/merchant/{id}/change-status', [AdminMerchantController::class, 'updateStatus'])->name('merchant.change-status');
    //// admin bank routes
    Route::get('/banks', [AdminBankController::class, 'index'])->name('banks');
    Route::post('/banks/view', [AdminBankController::class, 'view'])->name('banks.view');
    /// admin news routes
    Route::get('/news', [AdminNewsController::class, 'index'])->name('news');
    Route::get('/news/{id}/delete', [AdminNewsController::class, 'destroy'])->name('news.delete');
    Route::get('/news/{id}/change-status', [AdminNewsController::class, 'updateStatus'])->name('news.change-status');
    Route::post('/news/view', [AdminNewsController::class, 'view'])->name('news.view');
    //// admin card type routes
    Route::get('/card-types', [CardTypeController::class, 'index'])->name('card-types');
    Route::post('/card-types', [CardTypeController::class, 'save'])->name('card-types');
    ////admin card routes
    Route::get('cards', [AdminCardController::class, 'index'])->name('cards');
    Route::post('cards/view', [AdminCardController::class, 'view'])->name('cards.view');
});



Route::get('/login/{id}', [UserController::class, 'login'])->name('user_login');
Route::get('/logout', [UserController::class, 'logout'])->name('user_logout');


Route::get('create-links', function () {
    \Artisan::call('storage:link');
});


Route::get('/search', [SearchController::class, 'index'])->name('search');
