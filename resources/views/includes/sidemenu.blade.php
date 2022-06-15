<section id="site-menu">
    <div>
        @if (auth()->check())
        @php
        $auth_user = auth()->user();
        $user = $auth_user->toArray();
        $user_type = $auth_user->user_type->toArray();
        @endphp

        @if ($user_type['name'] == 'card_admin')
        {{ $auth_user->bank_admin->bank->bank_name . ' ('.$user['name'].')'}}
        @else
        {{$user['name']}}
        @endif
        @endif

    </div>
    <div class="d-flex justify-content-end p-3">
        <a href="#" class="toggle-nav menu-close-btn"></a>
    </div>
    <ul class="navbar-nav">

        <li class="nav-item active" data-animation-delay="100ms" data-link-bg-color="#16a085">
            <a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a>
        </li>

        @if (!auth()->check())
        @foreach ($users as $user)
        <li class="nav-item " data-animation-delay="300ms" data-link-bg-color="#b92990">
            @if ($user['user_type']['name'] == 'card_admin')
            <a class="nav-link" href="{{route('user_login', ['id' => $user['id']])}}">Login as: {{$user['bank_admin']['bank']['bank_name']}} ({{$user['name']}})</a>
            @else
            <a class="nav-link" href="{{route('user_login', ['id' => $user['id']])}}">Login as: {{$user['name']}} ({{$user['user_type']['label']}})</a>
            @endif
        </li>
        @endforeach
        @else
        @php
        $auth_user = auth()->user();
        $user = $auth_user->toArray();
        $user_type = $auth_user->user_type->toArray();
        @endphp
        @if ($user_type['name'] == 'card_admin')
        <li class="nav-item" data-animation-delay="200ms" data-link-bg-color="#29b865">
            <a class="nav-link" href="{{route('bank.dashboard')}}">Dashboard</a>
        </li>
        <li class="nav-item" data-animation-delay="200ms" data-link-bg-color="#29b865">
            <a class="nav-link" href="{{route('merchant_list')}}">Merchants</a>
        </li>
        <li class="nav-item" data-animation-delay="200ms" data-link-bg-color="#29b865">
            <a class="nav-link" href="{{route('card_list')}}">Cards List</a>
        </li>
        <li class="nav-item " data-animation-delay="300ms" data-link-bg-color="#29b9b9">
            <a class="nav-link" href="{{route('bank_details')}}">Update Bank Details</a>
        </li>
        <li class="nav-item " data-animation-delay="300ms" data-link-bg-color="#2980b9">
            <a class="nav-link" href="{{route('news_list')}}">News list</a>
        </li>
        @endif
        @if($user_type['name'] =='customer')
        <li class="nav-item " data-animation-delay="300ms" data-link-bg-color="#29b9b9">
            <a class="nav-link" href="{{route('user_profile')}}">Profile</a>
        </li>
        <li class="nav-item " data-animation-delay="300ms" data-link-bg-color="#29b865">
            <a class="nav-link" href="{{route('my_cards')}}">My Cards</a>
        </li>
        <li class="nav-item " data-animation-delay="300ms" data-link-bg-color="#b92990">
            <a class="nav-link" href="{{route('my_applications')}}">My Applications</a>
        </li>
        @endif
        @if ($user_type['name'] == 'service_agent')
        <li class="nav-item " data-animation-delay="300ms" data-link-bg-color="#b92990">
            <a class="nav-link" href="{{route('support.agent.card.applications')}}">Card Applications</a>
        </li>
        @endif
        <li class="nav-item " data-animation-delay="300ms" data-link-bg-color="#b92990">
            <a class="nav-link" href="{{route('user_logout')}}">Logout</a>
        </li>
        @endif
    </ul>
</section>
