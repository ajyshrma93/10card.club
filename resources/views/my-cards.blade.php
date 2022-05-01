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
                    @if(session()->has('success'))
                    <div class="alert alert-dismissible fade show alert-success" role="alert">
                        {{ session()->get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <h2 class="mb-3">My Cards</h2>
                    @forelse($userCards as $userCard)
                    @php
                    $card = $userCard->card;
                    @endphp
                    <div class="card-details">
                        <div class="credit-card">
                            <a href="{{route('card_details',$card->id)}}">
                                <img src="{{$card['card_image']}}" class="img-fluid w-100 credit-card-img" alt="Card" />
                            </a>
                        </div>
                        <p>
                        <h6>{{$card->card_name}}</h6>
                        </p>
                    </div>
                    <hr />
                    @empty
                    <div class="credit-card">
                        <img src="{{asset('assets/images/no-data.webp')}}" class="img-fluid w-100 credit-card-img" />
                    </div>
                    @endforelse

                    <div id="pagination">
                        {{ $userCards->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

