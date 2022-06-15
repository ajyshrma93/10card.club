@extends('layouts.app')
@section('title', 'Card Details')
@section('content')
<style>
    .dropdown-menu[data-bs-popper] {
        right: 0x !important;
    }
</style>
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <!-- Topbar -->
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <div>
                        @if (session()->has('previous-route'))
                        <a href="{{session()->get('previous-route')}}" class="page-back-btn rounded-circle d-block"></a>
                        @else
                        <a href="{{route('home')}}" class="page-back-btn rounded-circle d-block"></a>
                        @endif
                    </div>
                    <div>
                        <h1 class="small fw-medium text-center m-0">Card Details</h1>
                    </div>
                    <div>
                        @auth
                        <div class="dropdown">
                            <a class="btn btn-secondary " type="button" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" style="left :unset;right:0">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-card-id="{{$card->id}}" data-card-title="{{$card->card_name}}" data-bs-target="#addCardToOwn">Mark as Owned</a>

                            </div>
                        </div>
                        @else
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>

                        @endauth
                    </div>
                </div>
            </nav>
            <div class="wrapper">
                <div class="container">
                    <div class="mb-4">
                        <img src="{{ asset($card['card_image'])}}" class="img-fluid w-100" alt="Card" height="500px" />
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-10">
                                @include('includes.own-card')
                            </div>
                            <div class="col-2">

                                <a href="#" data-bs-toggle="modal" data-bs-target="#callModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.888" height="21.926" viewBox="0 0 21.888 21.926">
                                        <path id="Icon_feather-phone-call" data-name="Icon feather-phone-call" d="M15.551,5.328a4.786,4.786,0,0,1,3.781,3.781M15.551,1.5A8.614,8.614,0,0,1,23.16,9.1M22.2,16.737v2.871a1.914,1.914,0,0,1-2.086,1.914,18.941,18.941,0,0,1-8.26-2.938,18.664,18.664,0,0,1-5.743-5.743,18.941,18.941,0,0,1-2.938-8.3,1.914,1.914,0,0,1,1.9-2.087H7.952A1.914,1.914,0,0,1,9.866,4.1a12.289,12.289,0,0,0,.67,2.689,1.914,1.914,0,0,1-.431,2.019L8.89,10.028a15.314,15.314,0,0,0,5.743,5.743l1.216-1.216a1.914,1.914,0,0,1,2.019-.431,12.289,12.289,0,0,0,2.689.67A1.914,1.914,0,0,1,22.2,16.737Z" transform="translate(-2.267 -0.506)" fill="none" stroke="#000944" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                    <ul class="nav nav-tabs justify-content-between" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#infoTab" type="button" role="tab" aria-controls="infoTab" aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20.896" height="20.896" viewBox="0 0 20.896 20.896">
                                    <path id="Icon_awesome-info-circle" data-name="Icon awesome-info-circle" d="M11.01.562A10.448,10.448,0,1,0,21.458,11.01,10.45,10.45,0,0,0,11.01.562Zm0,4.634A1.769,1.769,0,1,1,9.241,6.966,1.769,1.769,0,0,1,11.01,5.2ZM13.37,15.9a.506.506,0,0,1-.506.506H9.157a.506.506,0,0,1-.506-.506V14.886a.506.506,0,0,1,.506-.506h.506v-2.7H9.157a.506.506,0,0,1-.506-.506V10.168a.506.506,0,0,1,.506-.506h2.7a.506.506,0,0,1,.506.506v4.213h.506a.506.506,0,0,1,.506.506Z" transform="translate(-0.563 -0.562)" />
                                </svg>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="flight-tab" data-bs-toggle="tab" data-bs-target="#flightTab" type="button" role="tab" aria-controls="flightTab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.375" height="23.552" viewBox="0 0 22.375 23.552">
                                    <path id="Path_6909" data-name="Path 6909" d="M25.375,19.487V17.131l-9.421-5.888V4.766a1.766,1.766,0,1,0-3.533,0v6.477L3,17.131v2.355l9.421-2.944V23.02l-2.355,1.766v1.766l4.122-1.178,4.122,1.178V24.786L15.954,23.02V16.543Z" transform="translate(-3 -3)" />
                                </svg>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="chat-tab" data-bs-toggle="tab" data-bs-target="#chatTab" type="button" role="tab" aria-controls="chatTab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19.589" height="19.589" viewBox="0 0 19.589 19.589">
                                    <g id="Icon_ionic-md-chatbubbles" data-name="Icon ionic-md-chatbubbles" transform="translate(-3 -2)">
                                        <path id="Path_12" data-name="Path 12" d="M25.716,3.375H10.045A1.964,1.964,0,0,0,8.086,5.334V18.025a1.969,1.969,0,0,0,1.959,1.965h13.37l4.26,2.975V5.334A1.964,1.964,0,0,0,25.716,3.375Z" transform="translate(-5.086 -1.375)" />
                                    </g>
                                </svg>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#listTab" type="button" role="tab" aria-controls="listTab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25.022" height="19.944" viewBox="0 0 25.022 19.944">
                                    <path id="Icon_awesome-list-ul" data-name="Icon awesome-list-ul" d="M2.346,3.375a2.3,2.3,0,1,0,0,4.6,2.3,2.3,0,1,0,0-4.6Zm0,7.671a2.3,2.3,0,1,0,0,4.6,2.3,2.3,0,1,0,0-4.6Zm0,7.671a2.3,2.3,0,1,0,0,4.6,2.3,2.3,0,1,0,0-4.6Zm21.894.767H8.6a.775.775,0,0,0-.782.767v1.534a.775.775,0,0,0,.782.767H24.24a.775.775,0,0,0,.782-.767V20.25A.775.775,0,0,0,24.24,19.483Zm0-15.341H8.6a.775.775,0,0,0-.782.767V6.443A.775.775,0,0,0,8.6,7.21H24.24a.775.775,0,0,0,.782-.767V4.909A.775.775,0,0,0,24.24,4.142Zm0,7.671H8.6a.775.775,0,0,0-.782.767v1.534a.775.775,0,0,0,.782.767H24.24a.775.775,0,0,0,.782-.767V12.58A.775.775,0,0,0,24.24,11.813Z" transform="translate(0 -3.375)" />
                                </svg>
                            </button>
                        </li>
                        @if(auth()->check() && auth()->user()->hasCard($card->id))
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="user-tab" data-bs-toggle="tab" data-bs-target="#userTab" type="button" role="tab" aria-controls="userTab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.242" height="22.242" viewBox="0 0 22.242 22.242">
                                    <path id="Icon_awesome-user-circle" data-name="Icon awesome-user-circle" d="M11.121.562A11.121,11.121,0,1,0,22.242,11.683,11.119,11.119,0,0,0,11.121.562Zm0,4.3A3.946,3.946,0,1,1,7.175,8.814,3.946,3.946,0,0,1,11.121,4.867Zm0,15.426a8.593,8.593,0,0,1-6.569-3.058,5,5,0,0,1,4.417-2.682,1.1,1.1,0,0,1,.318.049,5.937,5.937,0,0,0,1.834.309,5.915,5.915,0,0,0,1.834-.309,1.1,1.1,0,0,1,.318-.049,5,5,0,0,1,4.417,2.682A8.593,8.593,0,0,1,11.121,20.293Z" transform="translate(0 -0.563)" />
                                </svg>
                            </button>
                        </li>
                        @endif

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @include('includes.card_details.info_tab',['card' => $card])
                        @include('includes.card_details.flight_tab',['merchants' => $merchants])
                        @include('includes.card_details.chat_tab',['card' => $card])
                        <div class="tab-pane fade" id="chatTab" role="tabpanel" aria-labelledby="chat-tab">Chat</div>
                        <div class="tab-pane fade" id="listTab" role="tabpanel" aria-labelledby="list-tab">List</div>
                        @if(auth()->check() && auth()->user()->hasCard($card->id))
                        @include('includes.card_details.mycard_details')

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My Card Details Modal -->
<?php
$years = [];
for ($i = date('Y'); $i <= date('Y', strtotime('+30 year')); $i++) {
    $years[] = $i;
}
$months = [];
for ($i = 1; $i <= 12; $i++) {
    $month = '2000-' . $i . '-01';
    $months[$i] = date('F', strtotime($month));
}
$days = [];
for ($i = 1; $i <= 31; $i++) {
    $date = '2000-01-' . $i;
    $days[$i] = date('jS', strtotime($date));;
}
$userCard  = \App\Models\UserCard::where(['user_id' => auth()->id(), 'card_id' => $card->id])->first();
?>
@if($userCard)
<div class="modal fade" id="ownedCardDetails" tabindex="-1" aria-labelledby="ownedCardDetailsLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body pt-2">

                <form method="post" action="{{route('update_user_card')}}" onsubmit="submitCardData(event)" id="userCardData">
                    @csrf
                    <input type="hidden" value="{{$userCard->id}}" name="card_id" />
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="#" data-bs-dismiss="modal" aria-label="Close" class="btn text-danger text-decoration-none">Cancel</a>
                        <button type="submit" class="btn text-primary text-decoration-none" ref="submitOwnedCard">Save</button>
                    </div>
                    <div class="alert_message">

                    </div>
                    <div class="px-2">
                        <div class="mb-3">
                            <label>Card Number :</label>
                            <input type="text" class="form-control" placeholder="Card Number" name="card_number" value="{{{$userCard->card_number}}}">
                        </div>
                        <div class="mb-3">
                            <label>Card Expiry</label>
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control" name="expiry_month">
                                        <option value="">Select Month</option>
                                        @foreach ($months as $key=> $month)
                                        <option value="{{$key}}" {{$userCard->expiry_month == $key ?'selected':''}}>{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-control" name="expiry_year">
                                        <option value="">Select Year</option>
                                        @foreach ($years as $year)
                                        <option value="{{$year}}" {{$userCard->expiry_year == $year ?'selected':''}}>{{$year}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Card Statement Date</label>
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control" name="statement_date">
                                        <option value="">Select Date</option>
                                        @foreach ($days as $key=> $day)
                                        <option value="{{$key}}" {{$userCard->statement_date == $key ?'selected':''}}>{{$day}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-control" name="statement_month">
                                        <option value="">Select month</option>
                                        @foreach ($months as $key=> $month)
                                        <option value="{{$key}}" {{$userCard->statement_month == $key ?'selected':''}}>{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Card Due Date</label>
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control" name="due_date">
                                        <option value="">Select Date</option>
                                        @foreach ($days as $key =>$day)
                                        <option value="{{$key}}" {{$userCard->due_date == $key ?'selected':''}}>{{$day}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-control" name="due_month">
                                        <option value="">Select month</option>
                                        @foreach ($months as $key => $month)
                                        <option value="{{$key}}" {{$userCard->due_month == $key ?'selected':''}}>{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Card Annual Fee Date</label>
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control" name="annual_fee_date">
                                        <option value="">Select Date</option>
                                        @foreach ($days as $key => $day)
                                        <option value="{{$key}}" {{$userCard->annual_fee_date == $key ?'selected':''}}>{{$day}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-control" name="annual_fee_month">
                                        <option value="">Select month</option>
                                        @foreach ($months as $key=> $month)
                                        <option value="{{$key}}" {{$userCard->annual_fee_month == $key ?'selected':''}}>{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Card Service Tax Date</label>
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control" name="tax_date">
                                        <option value="">Select Date</option>
                                        @foreach ($days as $key => $day)
                                        <option value="{{$key}}" {{$userCard->tax_date == $key ?'selected':''}}>{{$day}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-control" name="tax_month">
                                        <option value="">Select month</option>
                                        @foreach ($months as $key=> $month)
                                        <option value="{{$key}}" {{$userCard->tax_month == $key ?'selected':''}}>{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="subCardModal" tabindex="-1" aria-labelledby="subCardModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body pt-2">

                <form method="post" id="subCardInfo" action="" onsubmit="saveSubCardInfo(event)">
                    @csrf
                    <input type="hidden" value="{{$userCard->id}}" name="card_id" />
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="#" data-bs-dismiss="modal" aria-label="Close" class="btn text-danger text-decoration-none">Cancel</a>
                        <button type="submit" class="btn text-primary text-decoration-none">Save</button>
                    </div>
                    <div class="sub_card_alert">

                    </div>
                    <div class="px-2">
                        <div class="mb-3">
                            <label>Who is the one use this subcard? </label>
                            <input type="text" class="form-control" placeholder="My Brother, Jason Smith, Joe Doe" name="cardholder_name" value="{{$userCard->cardholder_name}}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@auth

@php
$userCards =auth()->user()->cards;
@endphp
@if($userCards->count() > 1)
<div id="view_all_card_date_details">
    @include('includes.modals.statement-modal',['userCards'=>$userCards])
    @include('includes.modals.expirydate-modal',['userCards'=>$userCards])
    @include('includes.modals.duedate-modal',['userCards'=>$userCards])
    @include('includes.modals.annualFee-modal',['userCards'=>$userCards])
    @include('includes.modals.serviceTax-modal',['userCards'=>$userCards])
</div>
@endif
@endauth


<!-- My Card Detials Modal Ends -->
<!-- Card Add Note Modal -->
<div class="modal fade" id="notesAddModal" tabindex="-1" aria-labelledby="notesAddModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body pt-2">

                <form method="post" action="{{route('add_user_note',['id' => $card->id])}}" novalidate @submit.prevent="addUserNote" enctype="multipart/form-data" @change="form.onChange($event)" @keydown="form.onKeydown($event)">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="#" data-bs-dismiss="modal" aria-label="Close" class="btn text-danger text-decoration-none">Cancel</a>
                        <a href="javascript:void(0);" @click="submitUserNoteForm" class="btn text-primary text-decoration-none">Save</a>
                    </div>
                    <div class="alert alert-dismissible fade show" :class="{'alert-danger': message.type == 'error','alert-success': message.type == 'success'}" v-for="message in messageBox" :index="message.index" role="alert">
                        @{{ message.message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="px-2">
                        <div class="mb-3" :class="{'has-error': noteForm.errors.has('title')}">
                            <input type="text" class="form-control" placeholder="Title" name="title" v-model="noteForm.title">
                            <span class="text-danger" v-if="noteForm.errors.has('title')" v-html="noteForm.errors.get('title')"></span>
                        </div>
                        <div :class="{'has-error': noteForm.errors.has('description')}">
                            <textarea class="form-control text-area" name="description" v-model="noteForm.description" placeholder="Your note here"></textarea>
                            <span class="text-danger" v-if="noteForm.errors.has('description')" v-html="noteForm.errors.get('description')"></span>
                        </div>
                    </div>
                    <button type="submit" style="display: none;" ref="submitNoteForm"></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Call Modal -->
<div class="modal fade" id="callModal" tabindex="-1" aria-labelledby="callModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="cstm-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                <ul class="list-unstyled cash-rebate-list banking-info mb-2">
                    <li class="d-flex flex-wrap">
                        <div class="cash-type rounded-circle d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27.01" height="27.008" viewBox="0 0 27.01 27.008">
                                <path id="Icon_ionic-ios-call" data-name="Icon ionic-ios-call" d="M30.72,25.65a22.686,22.686,0,0,0-4.739-3.171c-1.42-.682-1.941-.668-2.946.056-.837.6-1.378,1.167-2.341.956s-2.862-1.645-4.7-3.48-3.277-3.741-3.48-4.7.359-1.5.956-2.341c.724-1.005.745-1.526.056-2.946A22.238,22.238,0,0,0,10.35,5.28c-1.034-1.034-1.266-.809-1.835-.6a10.443,10.443,0,0,0-1.68.893A5.069,5.069,0,0,0,4.816,7.7c-.4.865-.865,2.475,1.5,6.68a37.272,37.272,0,0,0,6.553,8.74h0l.007.007.007.007h0a37.418,37.418,0,0,0,8.74,6.553c4.2,2.362,5.815,1.9,6.68,1.5a4.983,4.983,0,0,0,2.13-2.018,10.443,10.443,0,0,0,.893-1.68C31.528,26.916,31.76,26.684,30.72,25.65Z" transform="translate(-4.49 -4.502)" fill="#fff"></path>
                            </svg>
                        </div>
                        <div class="cash-debate-info">
                            <h4 class="fw-medium">Bank hotline</h4>
                            <div class="call-numbers">
                                <p><a href="tel:{{$card['bank']['bank_hotline']}}">{{$card['bank']['bank_hotline']}}</a></p>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex flex-wrap">
                        <div class="cash-type rounded-circle free-type fw-semibold text-white d-flex align-items-center justify-content-center text-uppercase" style="background-color: #1BB4ED;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33">
                                <g id="Icon_feather-clock" data-name="Icon feather-clock" transform="translate(-1.5 -1.5)">
                                    <path id="Path_16075" data-name="Path 16075" d="M33,18A15,15,0,1,1,18,3,15,15,0,0,1,33,18Z" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                                    <path id="Path_16076" data-name="Path 16076" d="M18,9v9l6,3" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="cash-debate-info">
                            <h4 class="fw-medium">Business Hour</h4>
                            <p>24/7</p>
                        </div>
                    </li>
                    @if ($card['bank']['hotline_time'] != null)
                    <li class="d-flex flex-wrap">
                        <div class="cash-type rounded-circle free-type fw-semibold text-white d-flex align-items-center justify-content-center text-uppercase" style="background-color: #EDAC1B;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33">
                                <g id="Icon_feather-clock" data-name="Icon feather-clock" transform="translate(-1.5 -1.5)">
                                    <path id="Path_16075" data-name="Path 16075" d="M33,18A15,15,0,1,1,18,3,15,15,0,0,1,33,18Z" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                                    <path id="Path_16076" data-name="Path 16076" d="M18,9v9l6,3" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="cash-debate-info">
                            <h4 class="fw-medium">Service Hour Call</h4>
                            <div class="days-hours">
                                @foreach ($card['bank']['hotline_time'] as $key => $value)
                                <p class="d-flex">
                                    <span class="d-inline-block day-name me-2">{{ substr(ucfirst($key),0,3) }}</span>
                                    @if ($value['start_time'] != '' || $value['end_time'] != '')
                                    {{date("h:i A", strtotime($value['start_time']))}} - {{date("h:i A", strtotime($value['end_time']))}}
                                    @else
                                    Not serviceable
                                    @endif

                                </p>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
                @if ($card['bank']['hotline_time'] != null)
                <div class="card-charges text-center">
                    Shortcut CS Number: {{$card['bank']['shortcut_speak']}}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@section('modals')
@include('includes.modals.owned-card-modal')
@include('includes.modals.merchant-modal')
@endsection


@section('js_script')
<script src="{{asset('/js/axios.js')}}"></script>
<script src="{{asset('/js/vue.js')}}"></script>
<script src="{{asset('/js/vform.js')}}"></script>
<script type="text/javascript" type="module">
    var addMessageUrl = "{!! route('addMessage',['id' => $card->id]) !!}";
    var listMessageUrl = "{!! route('list_card_message',['id' => $card->id]) !!}";
    var addUserNoteUrl = "{!! route('add_user_note',['id' => $card->id]) !!}";
    var deleteUserNoteUrl = "{!! route('delete_user_note',['id' => $card->id]) !!}";
    var listUserNoteUrl = "{!! route('list_user_note',['id' => $card->id]) !!}";
    var app = new Vue({
        el: '#app',
        watch: {
            searchQuery(value) {
                if (value.length == 0) {
                    this.fetchMessages();
                }
            }
        },
        data() {
            return {
                form: new Form.Form({
                    message: ''
                }),
                noteForm: new Form.Form({
                    title: '',
                    description: ''
                }),
                messageBox: [],
                searchQuery: '',
                userMessages: [],
                userNoteList: [],
            }
        },
        mounted() {
            this.fetchMessages();
            this.fetchUserNotes();
        },
        methods: {
            addMessage($event) {
                var url = $event.target.action;
                this.form.post(url).then((response) => {
                    if (response.data.success) {
                        this.userMessages.push(response.data.data);
                        this.form.reset();
                    }
                });
            },
            searchMessage($event) {
                var url = $event.target.action + '?query=' + this.searchQuery;
                if (this.searchQuery.length != 0) {
                    axios.get(url).then((response) => {
                        if (response.data.success) {
                            this.userMessages = response.data.data;
                        }
                    });
                }

            },
            fetchMessages() {
                axios.get(listMessageUrl).then((response) => {
                    if (response.data.success) {
                        this.userMessages = response.data.data;
                    }
                });
            },
            fetchUserNotes() {
                axios.get(listUserNoteUrl).then((response) => {
                    if (response.data.success) {
                        this.userNoteList = response.data.data;
                    }
                });
            },
            addUserNote($event) {
                var url = $event.target.action;
                this.noteForm.post(url).then((response) => {
                    if (response.data.success) {
                        this.userNoteList.push(response.data.data);
                        this.noteForm.reset();
                        $('#notesAddModal').modal('toggle');
                        $('html,body').animate({
                            scrollTop: document.body.scrollHeight
                        }, "fast");
                    } else {
                        this.messageBox.push({
                            type: 'error',
                            message: 'Something went wrong!'
                        });
                        const element = document.getElementsByClassName('mainContainer')[0];
                        element.scrollIntoView({
                            behavior: "smooth",
                            block: "start",
                        });
                    }
                });
            },
            deleteNote(note) {
                axios.delete(deleteUserNoteUrl).then((response) => {
                    if (response.data.success) {
                        var check = this.userNoteList.indexOf(note);
                        if (check >= 0) {
                            this.userNoteList.splice(check, 1);
                        }
                    }
                });
            },
            submitUserNoteForm() {
                this.$refs['submitNoteForm'].click();
            },
            submitOwnedCardDetails() {
                alert();
            }
        }
    });
    Vue.component('user-message', {
        props: {
            message: Object
        },
        data: function() {
            return {
                form: new Form.Form({
                    message: '',
                    parent_message_id: this.message.id
                }),
                chatReply: false,
            }
        },
        methods: {
            addMessage($event) {
                var url = $event.target.action;
                this.form.post(url).then((response) => {
                    if (response.data.success) {
                        if (typeof this.message.child != 'undefined') {
                            this.message.child.push(response.data.data);
                        } else {
                            this.message.child = [response.data.data];
                        }
                        this.form.reset();
                        this.chatReply = false;
                    } else {
                        this.chatReply = false;
                    }
                });
            }
        }
    })

    function submitCardData(e) {
        e.preventDefault();
        FormData = $('#userCardData').serialize();
        $.ajax({
            url: '{{route("update_user_card")}}',
            method: 'POST',
            data: FormData,
            success: function(response) {
                if (response.status == 200) {
                    reloadAllCardDates();
                    html = '<div role="alert" class="alert alert-dismissible show fade alert_class alert-success"><span class="alert_message">' + response.message + '</span> <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button></div>';
                    $('.user-credit-card-info').html(response.html);
                } else {
                    html = '<div role="alert" class="alert alert-dismissible show fade alert_class alert-danger"><span class="alert_message">' + response.message + '</span> <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button></div>';
                }

                $('.alert_message').html(html);
                if (response.status == 200) {
                    setTimeout(function() {
                        $('.alert_message').html('');
                        $('#ownedCardDetails').modal('hide');
                    }, 2000);
                }
            }
        })
    }

    $('#ownedCardDetails').on('shown.bs.modal', function(e) {
        var link = e.relatedTarget,
            modal = $(this);
        $(".alert_message").html('');
    });

    function saveSubCardInfo(e) {
        e.preventDefault();
        FormData = $('#subCardInfo').serialize();
        $.ajax({
            url: '{{route("update_user_card_subcard_detail")}}',
            method: 'POST',
            data: FormData,
            success: function(response) {
                if (response.status == 200) {
                    html = '<div role="alert" class="alert alert-dismissible show fade alert_class alert-success"><span class="alert_message">' + response.message + '</span> <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button></div>';
                    $('.user-credit-card-info').html(response.html);
                } else {
                    html = '<div role="alert" class="alert alert-dismissible show fade alert_class alert-danger"><span class="alert_message">' + response.message + '</span> <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button></div>';
                }

                $('.sub_card_alert').html(html);
                if (response.status == 200) {
                    setTimeout(function() {
                        $('.sub_card_alert').html('');
                        $('#subCardModal').modal('hide');
                    }, 2000);
                }
            }
        });
    }

    $('body').on('change', '#is_sub_card', function() {
        if ($(this).is(':checked') == true) {
            $('#subCardModal').modal('show');
        } else {
            $('input[name="cardholder_name"]').val('');
            $('#subCardInfo').submit();
        }
    })


    function reloadAllCardDates() {
        $.ajax({
            url: '{{route("reload_user_card_details")}}',
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                if ($('#view_all_card_date_details').length > 0) {
                    $('#view_all_card_date_details').html(response.html)
                }
            }
        });
    }
</script>
@endsection
