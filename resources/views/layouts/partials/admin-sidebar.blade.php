<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="{{url('/')}}">
                <img class="img-fluid for-light" src="{{asset('assets/admin/images/logo/logo.png')}}" alt="">
                <img class="img-fluid for-dark" src="{{asset('assets/admin/images/logo/logo_dark.png')}}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{url('/')}}"><img class="img-fluid" src="{{asset('assets/admin/images/logo/logo-icon.png')}}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="{{url('/')}}"><img class="img-fluid" src="{{asset('assets/admin/images/logo/logo-icon.png')}}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav  {{ $menu === 'dashboard'? 'active':''}}" href="{{route('admin.dashboard')}}">
                            <i data-feather="activity"></i>
                            <span>Dashboard </span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav  {{ $menu === 'category'? 'active':''}}" href="{{route('admin.categories')}}">
                            <i data-feather="user"></i>
                            <span>All Category </span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav  {{ $menu === 'merchant'? 'active':''}}" href="{{route('admin.merchants')}}">
                            <i data-feather="shopping-cart"></i>
                            <span>All Merchants </span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav  {{ $menu === 'bank'? 'active':''}}" href="{{route('admin.banks')}}">
                            <i data-feather="dollar-sign"></i>
                            <span>All Banks </span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav  {{ $menu === 'news'? 'active':''}}" href="{{route('admin.news')}}">
                            <i data-feather="file-plus"></i>
                            <span>All News </span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav  {{ $menu === 'card-types'? 'active':''}}" href="{{route('admin.card-types')}}">
                            <i data-feather="file-text"></i>
                            <span>All Card Types </span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav  {{ $menu === 'cards'? 'active':''}}" href="{{route('admin.cards')}}">
                            <i data-feather="credit-card"></i>
                            <span>All Cards </span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="http://admin.pixelstrap.com/cuba/theme/{{url('/')}}" target="_blank">
                            <i data-feather="airplay"></i>
                            <span>Cuba</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
