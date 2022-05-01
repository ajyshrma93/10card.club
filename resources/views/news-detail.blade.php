@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="main-wrapper">
   <div class="mainContainer">
      @include('includes.sidemenu')
      <div id="site-wrapper">
         <nav class="navbar header-topbar navbar-light mb-3">
            <div class="container d-flex justify-content-between align-items-center flex-fill">
               <div>
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
               <div class="news-promotion-list">
                  <div class="news-promotion-block news-lazy-block">
                     @php
                     $converImage = asset('/assets/images/default-news-image.png');
                     if($news->cover_image != ''){
                     $converImage = asset($news->cover_image);
                     }
                     @endphp
                     <a href="javascript:void(0);" class="d-block news-image position-relative" style="background-image: url({{$converImage}});">
                     </a>
                     <div class="news-title-section pt-3 pb-4">
                        <h2><a href="javascript:void(0)">{{$news->title}}</a></h2>
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="news-author-info d-flex align-items-center">
                              @php
                              $bankLogo = asset($news->bank->bank_logo);
                              @endphp
                              <div class="news-author-img rounded-circle overflow-hidden bg-img-full me-2" style="background-image: url({{$bankLogo}});"></div>
                              <div class="news-author-name">{{$news->bank->bank_name}}</div>
                           </div>
                           <div class="news-date">{{\Carbon\Carbon::createFromTimeStamp(strtotime($news->created_at))->diffForHumans()}}</div>
                           <div class="d-flex align-items-center">
                              <a href="#" class="like-btn"></a>
                              <a href="#" class="share-btn ms-4 d-inline-block"></a>
                              <div class="dropdown d-arrow-none ms-4">
                                 <button class="btn dropdown-toggle p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="4" height="16" viewBox="0 0 4 16">
                                       <g id="Group_346" data-name="Group 346" transform="translate(0.215 -0.197)" opacity="0.76">
                                          <circle id="Ellipse_45" data-name="Ellipse 45" cx="2" cy="2" r="2" transform="translate(-0.215 0.197)" fill="#707070"></circle>
                                          <circle id="Ellipse_46" data-name="Ellipse 46" cx="2" cy="2" r="2" transform="translate(-0.215 6.197)" fill="#707070"></circle>
                                          <circle id="Ellipse_47" data-name="Ellipse 47" cx="2" cy="2" r="2" transform="translate(-0.215 12.197)" fill="#707070"></circle>
                                       </g>
                                    </svg>
                                 </button>
                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Favourite it</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     {!! $news->description !!}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
