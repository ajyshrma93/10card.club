@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <!-- Topbar -->
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <div>
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
                    <div class="d-flex justify-content-between mb-5">
                        <h2 class="lg fw-semibold m-0">Todays Suggestion</h2>
                        <a href="#" class="notification-btn d-inline-block position-relative"><span class="d-inline-block rounded-circle position-absolute notification-indicator"></span></a>
                    </div>
                    <div class="global-search position-relative mb-3">
                        <form action="{{url('search')}}">
                            <input type="text" class="form-control" placeholder="Search By Card Name or Bank Name" name="search" required />
                            <a href="#" onclick="$(this).parent('form').submit()" class="speech-to-search-btn position-absolute"></a>
                        </form>
                    </div>
                    <div class="mb-4 mr-minus-20">
                        <div class="d-flex services-list scrollbar-outer">
                            @php
                            $randomClass = ['bg-warning','bg-danger','bg-info'];
                            $randomIcon = ['s-check-icon','s-heart-icon','s-video-icon'];
                            $count = 0;
                            @endphp
                            @foreach ($categories as $category)
                            @if(!isset($randomClass[$count]))
                            @php
                            $count = 0;
                            @endphp
                            @endif
                            <div class="cbp-item">
                                <a href="{{route('category',$category->slug)}}" class="services-box d-flex flex-wrap text-white text-decoration-none {{$randomClass[$count]}}">
                                    <div class="searvice-title flex-fill w-100">{{$category->category}}</div>
                                    <div class="{{$randomIcon[$count]}} mx-auto"></div>
                                </a>
                            </div>
                            @php
                            $count = $count + 1;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                    @auth
                    <h2 class="mb-3">My Cards ({{auth()->user()->cards->count()}})</h2>
                    @php
                    $userCards =auth()->user()->cards;
                    @endphp
                    <div class="mb-4 mr-minus-20">
                        <div class="credit-card-list d-flex scrollbar-outer">
                            @foreach ($userCards as $userCard)
                            @php
                            $card = $userCard->card;
                            @endphp
                            <div class="credit-card-details">
                                <div class="credit-card">
                                    <a href="{{route('card_details', ['id' => $card['id']])}}">
                                        <img src="{{$card['card_image']}}" class="img-fluid w-100 credit-card-img" alt="Card" />
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @endauth
                    <h2 class="mb-3">Discover</h2>
                    <div class="mb-4 pb-3">
                        <div class="discover-lists d-flex scrollbar-outer">
                            @foreach ($merchants as $merchant)
                            @php
                            $merchantLogo = asset($merchant->merchant_image);
                            @endphp
                            <div class="discover-product overflow-hidden rounded-circle d-flex align-items-center justify-content-center flex-wrap bg-img-full" style="background-image: url({{$merchantLogo}});">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <h2 class="mb-3">News &amp; Promotions</h2>
                    <div class="news-promotion-list mb-5">
                        @foreach ($news as $key => $value)
                        <div class="news-promotion-block shadow-sm overflow-hidden news-lazy-block">
                            @php
                            $converImage = asset('/assets/images/default-news-image.png');
                            if($value->cover_image != ''){
                            $converImage = asset($value->cover_image);
                            }
                            @endphp
                            <a href="{{route('news_detail', ['id' => $value->id])}}" title="{{$value->title}}" class="d-block news-image position-relative" style="background-image: url({{$converImage}});">
                            </a>
                            <div class="p-3 news-title-section">
                                <h2><a href="{{route('news_detail', ['id' => $value->id])}}">{{$value->title}}</a></h2>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="news-author-info d-flex align-items-center">
                                        @php
                                        $bankLogo = '/'.$value->bank->bank_logo;
                                        @endphp
                                        <div class="news-author-img rounded-circle overflow-hidden bg-img-full me-2" style="background-image: url({{$bankLogo}});"></div>
                                        <div class="news-author-name">{{$value->bank->bank_name}}</div>
                                    </div>
                                    <div class="news-date">{{\Carbon\Carbon::createFromTimeStamp(strtotime($value->created_at))->diffForHumans()}}</div>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="like-btn"></a>
                                        <a href="#" class="share-btn ms-4 d-inline-block"></a>
                                        <div class="dropdown d-arrow-none ms-4">
                                            <button class="btn dropdown-toggle p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="4" height="16" viewBox="0 0 4 16">
                                                    <g id="Group_346" data-name="Group 346" transform="translate(0.215 -0.197)" opacity="0.76">
                                                        <circle id="Ellipse_45" data-name="Ellipse 45" cx="2" cy="2" r="2" transform="translate(-0.215 0.197)" fill="#707070"></circle>
                                                        <circle id="Ellipse_46" data-name="Ellipse 46" cx="2" cy="2" r="2" transform="translate(-0.215 6.197)" fill="#707070"></circle>
                                                        <circle id="Ellipse_47" data-name="Ellipse 47" cx="2" cy="2" r="2" transform="translate(-0.215 12.197)" fill="#707070"></circle>
                                                    </g>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">Favourite it</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
