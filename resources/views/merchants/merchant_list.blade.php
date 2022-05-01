@extends('layouts.app')
@section('title', 'Merchant List')
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
                        <h1 class="small fw-medium text-center m-0">Merchant List</h1>
                    </div>
                    <div>
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>
                    </div>
                </div>
            </nav>
            <div class="wrapper">
                <div class="container">
                    <a href="{{route('merchant_add')}}" class="btn btn-primary">Add Merchant</a>
                    <table class="table table-bordeless">
                        <thead>
                            <tr>
                                <th scope="col">Index</th>
                                <th scope="col">Category</th>
                                <th scope="col">Image</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Is Approved</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $index = 1;
                            @endphp
                            @foreach ($merchants as $key => $merchant)
                            <tr>
                                <td scope="row">{{$index}}</td>
                                <td>{{$merchant->category->category}}</td>
                                <td>
                                    @php
                                    $merchantLogo = '/'.$merchant->merchant_image;
                                    $index++;
                                    @endphp
                                    <div title="{{$merchant->merchant_name}}" class="discover-product overflow-hidden rounded-circle d-flex align-items-center justify-content-center flex-wrap bg-img-full" style="background-image: url({{$merchantLogo}});">
                                    </div>
                                </td>
                                <td>{{$merchant->merchant_name}}</td>
                                <td>{{($merchant->is_approved) ? 'Yes' : 'No'}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>