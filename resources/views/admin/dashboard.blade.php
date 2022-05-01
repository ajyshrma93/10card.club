@extends('layouts.admin')
<?php

use App\Models\Merchant;
use App\Models\Bank;
use App\Models\Categories;
use App\Models\News;
use App\Models\Card;
use App\Models\CardType;
?>

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Dashboard</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" data-bs-original-title="" title=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg></a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden static-top-widget-card">
                <div class="card-body">
                    <div class="media static-top-widget">
                        <div class="media-body">
                            <h6 class="font-roboto"> Merchants</h6>
                            <h4 class="mb-0 counter">{{Merchant::count()}}</h4>
                        </div>

                    </div>
                    <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-secondary" role="progressbar" style="width: {{Merchant::count()}}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden static-top-widget-card">
                <div class="card-body">
                    <div class="media static-top-widget">
                        <div class="media-body">
                            <h6 class="font-roboto"> Banks</h6>
                            <h4 class="mb-0 counter">{{Bank::count()}}</h4>
                        </div>
                    </div>
                    <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-success" role="progressbar" style="width: {{Bank::count()}}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="card-body">
                    <div class="media static-top-widget">
                        <div class="media-body">
                            <h6 class="font-roboto"> Categories</h6>
                            <h4 class="mb-0 counter">{{Categories::count()}}</h4>
                        </div>
                    </div>
                    <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-primary" role="progressbar" style="width: {{Categories::count()}}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden static-top-widget-card">
                <div class="card-body">
                    <div class="media static-top-widget">
                        <div class="media-body">
                            <h6 class="font-roboto"> Cards</h6>
                            <h4 class="mb-0 counter">{{Card::count()}}</h4>
                        </div>
                    </div>
                    <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-warning" role="progressbar" style="width: {{Merchant::count()}}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="card-body">
                    <div class="media static-top-widget">
                        <div class="media-body">
                            <h6 class="font-roboto"> News</h6>
                            <h4 class="mb-0 counter">{{News::count()}}</h4>
                        </div>

                    </div>
                    <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-danger" role="progressbar" style="width: {{News::count()}}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden static-top-widget-card">
                <div class="card-body">
                    <div class="media static-top-widget">
                        <div class="media-body">
                            <h6 class="font-roboto"> Card Types</h6>
                            <h4 class="mb-0 counter">{{CardType::count()}}</h4>
                        </div>
                    </div>
                    <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-warning" role="progressbar" style="width: {{Merchant::count()}}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection


@section('scripts')
<script src="{{asset('assets/admin/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/admin/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/admin/js/counter/counter-custom.js')}}"></script>
@endsection
