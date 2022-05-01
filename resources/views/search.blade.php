@extends('layouts.app')
@section('title','Search Result -'.request()->search)
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
                    <div class="global-search position-relative mb-3">
                        <form action="{{url('search')}}">
                            <input type="text" class="form-control" placeholder="Search By Card Name or Bank Name " value="{{request()->search}}" name="search" required />
                            <a href="#" onclick="$(this).parent('form').submit()" class="speech-to-search-btn position-absolute"></a>
                        </form>
                    </div>
                    <h2 class="mb-3">Showing result's for : {{request()->search}}</h2>
                    @forelse($cards as $card)
                    <div class="card-details">
                        <div class="credit-card">
                            <a href="{{route('card_details',$card->id)}}">
                                <img src="{{$card['card_image']}}" class="img-fluid w-100 credit-card-img" alt="Card" />
                            </a>
                        </div>
                        @include('includes.own-card')
                        <p>
                        <h6>{{$card->card_name}}</h6>
                        <h6>Card Type : {{$card->type ? $card->type->label :'N/A'}}</h6>
                        <h6>Bank Name : {{$card->bank ? $card->bank->bank_name :''}}</h6>
                        </p>
                    </div>
                    <hr />
                    @empty
                    <div class="credit-card">
                        <img src="{{asset('assets/images/no-data.webp')}}" class="img-fluid w-100 credit-card-img" />
                    </div>
                    @endforelse

                    <div id="pagination">
                        {{ $cards->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('modals')
@include('includes.modals.owned-card-modal')
@endsection
