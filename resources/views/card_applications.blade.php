@extends('layouts.app')
@section('title', 'User Applications')
@section('css')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .quill-editor {
        margin-bottom: 41px;
    }

    .mb-3 .btn {
        margin-top: 10px !important;
    }
</style>
@endsection

@section('content')
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <a href="{{route('support.agent.card.applications')}}" class="page-back-btn rounded-circle d-block"></a>
                    <div>
                    </div>
                    <div>
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>
                    </div>
                </div>
            </nav>
            <!-- Topbar -->
            <div class="wrapper">

                <div class="container">
                    @if(session()->has('success'))
                    <div class="alert alert-dismissible fade show alert-success" role="alert">
                        {{ session()->get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-dismissible fade show alert-danger" role="alert">
                        {{ session()->get('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <h2 class="mb-3">My Credit Card Applications</h2>
                    @forelse($applications as $application)
                    @php
                    $card = $application->card;

                    $message = \App\Models\Chat::where(['application_id'=>$application->id,'is_new'=>1])->where('user_id','!=',auth()->id())->count();
                    @endphp
                    <div class="card-details">
                        <div class="credit-card">
                            <img src="{{$card['card_image']}}" class="img-fluid w-100 credit-card-img" alt="Card" />
                        </div>
                        <p>
                        <h6>{{$card->card_name}}</h6>
                        <h7>Applied : {{$application->created_at->diffForHumans()}}</h7>
                        </p>
                        <p>
                        <div class="row">
                            <div class="col-8">
                                @if($message)
                                You have {{$message}} new message
                                @endif
                            </div>
                            <div class="col-4 text-end">
                                <a class="text-end" href="{{route('application_chat',$application->id)}}">Contact Support</a>

                            </div>
                        </div>

                        </p>
                    </div>
                    <hr />
                    @empty
                    <div class="credit-card">
                        <img src="{{asset('assets/images/no-data.webp')}}" class="img-fluid w-100 credit-card-img" />
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
