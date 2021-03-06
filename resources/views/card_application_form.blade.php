@extends('layouts.app')
@section('title', 'Credit Card Apply')
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
                    <a href="javascript:void(0)" onclick="history.back()" class="page-back-btn rounded-circle d-block"></a>
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
                    <div class="mb-3">
                        <div class="">
                            <div class="credit-card">
                                <img src="{{asset($card->card_image)}}" class="img-fluid w-100 credit-card-img" alt="Card" />
                                <h4 class="mt-2">{{$card->card_name}}</h4>
                                <h7 class="mt-2">Bank : {{$card->bank->bank_name}}</h7>
                            </div>
                        </div>
                    </div>
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
                    <div class="row">
                        <div class="col-12">
                            <p>{{$card->card_des}}</p>
                            <a href="{{$card->card_info_url}}" target="_blank">View More</a>
                        </div>
                        <div class="col-12 text-end">
                            <a href="{{route('redirect.to.apply.card',$card->id)}}" class="btn btn-success">Apply</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_script')
<script>
    var loadFile = function(event, input) {
        var reader = new FileReader();
        reader.onload = function() {
            item = $(input).attr('name');
            var output = document.getElementById(item);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
@endsection
