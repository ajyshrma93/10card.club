@extends('layouts.app')
@section('title', 'Category - '.ucfirst($category->category))
@section('content')
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <!-- Topbar -->
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <div class="d-flex align-items-center">
                        <a href="{{route('home')}}" class="page-back-btn rounded-circle d-block"></a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger ms-2">{{$category->category}}</a>
                    </div>
                    <div>
                    </div>
                    <div>
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>
                    </div>
                </div>
            </nav>
            <div class="wrapper">
                <div class="container">
                    <h2 class="mb-3">Today’s Card Offer ({{count($today_suggestions)}})</h2>
                    <div class="mb-4 pb-3">
                        <div class="mr-minus-20">
                            <div class="credit-card-list d-flex scrollbar-outer">
                                @foreach ($today_suggestions as $card)
                                <div class="credit-card-details" title="{{$card->card_name}}">
                                    <div class="credit-card">
                                        <a href="{{route('card_details', ['id' => $card->id])}}">
                                            <img src="{{ asset($card->card_image)}}" class="img-fluid w-100 credit-card-img" alt="{{$card->card_name}}" />
                                        </a>
                                    </div>
                                    @include('includes.own-card')
                                </div>

                                @endforeach
                                @if (count($today_suggestions) == 0)
                                <h6 class="text-danger">Sorry, You don't have any special benefit cards to use in this category.</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (count($today_suggestions) != 0)
                    <h2 class="mb-3">Today’s Merchants ({{count($todays_merchants)}})</h2>
                    <div class="mb-4 pb-3">
                        <div class="discover-lists d-flex scrollbar-outer">
                            @foreach ($todays_merchants as $todays_merchant)
                            @php
                            $merchantLogo = asset($todays_merchant->merchant_image);
                            @endphp
                            <div title="{{$todays_merchant->merchant_name}}" class="discover-product overflow-hidden rounded-circle d-flex align-items-center justify-content-center flex-wrap bg-img-full" style="background-image: url({{$merchantLogo}});">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="light-section bg-light py-4">
                        <h2 class="mb-3 text-danger d-flex align-items-center flex-wrap justify-content-between">
                            ALL TIME’S CARD
                            <div><img src="../assets/images/info-circle.svg" class="img-fluid" /></div>
                        </h2>
                        <div class="mb-4 pb-3">
                            <div class="mr-minus-20">
                                <div class="credit-card-list d-flex scrollbar-outer">
                                    @foreach ($this_category as $category_card)
                                    <div class="credit-card-details" title="{{$category_card['card_name']}}">
                                        <div class="credit-card">
                                            <a href="{{route('card_details', ['id' => $category_card['id']])}}">
                                                <img src="{{ asset($category_card['card_image'])}}" class="img-fluid w-100 credit-card-img" alt="{{$category_card['card_name']}}" />
                                            </a>
                                        </div>
                                        @include('includes.own-card')
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <h2 class="mb-3 text-danger d-flex align-items-center flex-wrap justify-content-between">
                            ALL TIME’S Merchants
                            <div><img src="../assets/images/info-circle.svg" class="img-fluid" /></div>
                        </h2>
                        <div class="pb-3">
                            <div class="discover-lists d-flex scrollbar-outer">
                                @foreach ($merchants as $merchant)
                                @php
                                $merchantLogo = asset($merchant->merchant_image);
                                @endphp
                                <div title="{{$merchant->merchant_name}}" class="discover-product overflow-hidden rounded-circle d-flex align-items-center justify-content-center flex-wrap bg-img-full" style="background-image: url({{$merchantLogo}});">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.modals.owned-card-modal')
@endsection
