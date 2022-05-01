@extends('layouts.app')
@section('title', 'User Profile')
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
                    <a href="{{url('home')}}" class="page-back-btn rounded-circle d-block"></a>
                    <div>
                        <h1 class="small fw-medium text-center m-0">Update User Profile</h1>
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
                    <div class="alert alert-dismissible fade show alert-warning" role="alert">
                        We do not want to know who you are, we are not collecting your info. the input of this form is only to increase user experience in this app only
                    </div>
                    <form method="post" enctype="multipart/form-data" action="{{$form_action}}">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Name *</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{auth()->user()->name}}" aria-describedby="titleHelp">
                            @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Telegram ID *</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{old('salary',auth()->user()->phone ??'')}}" aria-describedby="titleHelp">
                            @if($errors->has('phone'))
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Current Company Name *</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" value="{{old('salary',auth()->user()->profile->company_name ??'')}}" aria-describedby="titleHelp">
                            @if($errors->has('company_name'))
                            <span class="text-danger">{{$errors->first('company_name')}}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Basic Montly Salary *</label>
                            <input type="number" step='0.01' class="form-control" name="salary" id="salary" value="{{old('salary',auth()->user()->profile->salary ??'')}}" aria-describedby="titleHelp">
                            @if($errors->has('salary'))
                            <span class="text-danger">{{$errors->first('salary')}}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Work Duration *</label>
                            @php
                            $selectedOption = auth()->user()->profile->work_duration ??'';
                            @endphp
                            <select name="work_duration" class="form-control">
                                <option value="">Select An Option</option>
                                <option value="Less Than 3 Month" {{$selectedOption =='Less Than 3 Month' ? 'selected':''}}>Less Than 3 Month</option>
                                <option value="More Than 3 Month" {{$selectedOption =='More Than 3 Month' ? 'selected':''}}>More Than 3 Month</option>
                                <option value="More Than 6 Month" {{$selectedOption =='More Than 6 Month' ? 'selected':''}}>Less Than 6 Month</option>
                                <option value="More Than 1 Year" {{$selectedOption =='More Than 1 Year' ? 'selected':''}}>More Than 1 Year</option>
                            </select>
                            @if($errors->has('work_duration'))
                            <span class="text-danger">{{$errors->first('work_duration')}}</span>
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
