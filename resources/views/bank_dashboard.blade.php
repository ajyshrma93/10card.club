@extends('layouts.app')
@section('title', 'Bank Details - '.$bank['bank_name'])
@section('content')
<style>
    .custom_style {
        color: black
    }
</style>
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
                        <h1 class="small fw-medium text-center m-0">Bank Dashboard</h1>
                    </div>
                    <div>
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>
                    </div>
                </div>
            </nav>
            <div class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6  col-sm-6 col-6">
                            <a class="nav-link" href="{{route('merchant_list')}}">
                                <div class="card">
                                    <div class="card-body text-center custom_style">
                                        <p> <i class="fa fa-industry" style="font-size: 20px"></i></p>
                                        Merchants
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6  col-sm-6 col-6">
                            <a class="nav-link" href="{{route('card_list')}}">
                                <div class="card">
                                    <div class="card-body text-center custom_style">
                                        <p> <i class="fa fa-credit-card" style="font-size: 20px"></i></p>
                                        Cards List
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <a class="nav-link" href="{{route('bank_details')}}">
                                <div class="card">
                                    <div class="card-body text-center custom_style">
                                        <p> <i class="fa fa-user" style="font-size: 20px"></i></p>
                                        Update Details
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6  col-sm-6 col-6">
                            <a class="nav-link" href="{{route('news_list')}}">
                                <div class="card">
                                    <div class="card-body text-center custom_style">
                                        <p> <i class="fa fa-users" style="font-size: 20px"></i></p>
                                        News list
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
