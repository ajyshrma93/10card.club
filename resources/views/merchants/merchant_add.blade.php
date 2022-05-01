@extends('layouts.app')
@section('title', 'Add merchant')
@section('content')
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <!-- Topbar -->
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <div class="d-flex align-items-center">
                        <a href="{{route('merchant_list')}}" class="page-back-btn rounded-circle d-block"></a>
                    </div>
                    <div>
                        <h1 class="small fw-medium text-center m-0">Add Merchant</h1>
                    </div>
                    <div>
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>
                    </div>
                </div>
            </nav>
            <div class="wrapper">
                <div class="container">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif (session('success'))
                    <div class="alert alert-success alert-dismissible alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(count($errors))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <br />
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form method="post" enctype="multipart/form-data" action="{{route('merchant_add')}}" id="merchant_add_form">
                        @csrf
                        <div class="mb-3 {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <label for="category_id" class="form-label">Category *</label>
                            <select class="form-select" name="category_id">
                                <option value="">--Select--</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{ (old("category_id") == $category->id ? "selected":"") }}>{{$category->category}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('merchant_image') ? 'has-error' : '' }}"">
                            <label for=" merchant_image" class="form-label">Merchant Image *</label>
                                <input class="form-control" type="file" id="merchant_image" name="merchant_image" />
                                <span class="text-danger">{{ $errors->first('merchant_image') }}</span>
                            </div>
                        <div class="mb-3 {{ $errors->has('merchant_name') ? 'has-error' : '' }}">
                            <label for="merchant_name" class="form-label">Merchant Name *</label>
                            <input type="text" class="form-control" name="merchant_name" id="merchant_name" value="{{old('merchant_name')}}" />
                            <span class="text-danger">{{ $errors->first('merchant_name') }}</span>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>