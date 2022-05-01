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
                        <div class="" style="padding: 20px;">
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
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="card_id" value="{{$card->id}}" />
                            <label for="title" class="form-label">Company Name *</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" value="{{old('salary',auth()->user()->profile->company_name ??'')}}" aria-describedby="titleHelp">
                            @if($errors->has('company_name'))
                            <span class="text-danger">{{$errors->first('company_name')}}</span>
                            @endif
                        </div>
                        <div class="mb-3 ">
                            <label for=" offer_letter" class="form-label">Offer Letter *</label>
                            <input class="form-control @error('offer_letter') is-invalid @enderror" type="file" id="offer_letter" name="offer_letter" accept="application/pdf,image/*">
                            @if($errors->has('offer_letter'))
                            <span class="text-danger">{{$errors->first('offer_letter')}}</span>
                            @endif
                        </div>
                        <div class="mb-3 ">
                            <label for="salary_slip" class="form-label">3 Months Salary Slip *</label>
                            <input class="form-control @error('salary_slip') is-invalid @enderror" type="file" id="salary_slip" name="salary_slip" accept="application/pdf,image/*">
                            @if($errors->has('salary_slip'))
                            <span class="text-danger">{{$errors->first('salary_slip')}}</span>
                            @endif
                        </div>
                        <div class="mb-3 ">
                            <label for="epf" class="form-label">3 Months EPF *</label>
                            <input class="form-control @error('epf') is-invalid @enderror" type="file" id="epf" name="epf" accept="application/pdf,image/*">
                            @if($errors->has('epf'))
                            <span class="text-danger">{{$errors->first('epf')}}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary"><span>Submit</span></button>
                        </div>
                    </form>
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
