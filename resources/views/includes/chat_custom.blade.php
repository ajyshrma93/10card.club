@foreach ($user_messages as $user_message)
<div class="chat-row d-flex">
    <div class="user-profile-photo">
        @php
        $userImage = '/'.$user_message['user']['image'];
        @endphp
        <div class="user-avatar" style="background-image: url({{$userImage}});"></div>
        <!-- <div class="user-short-name pt-1 text-center">(me)</div> -->
    </div>
    <div class="chat-container">
        <div class="d-flex flex-wrap justify-content-between mb-1">
            <h4>{{$user_message['user']['name']}}</h4>
            <div class="chat-date">{{ \Carbon\Carbon::parse($user_message['created_at'])->format('jS, F Y')}}</div>
        </div>
        <div class="chat-details position-relative pe-3">
            <p>{{$user_message['message']}}</p>
            <div class="dropdown">
                <button class="btn dropdown-toggle p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="4" height="16" viewBox="0 0 4 16">
                        <g id="Group_346" data-name="Group 346" transform="translate(0.215 -0.197)" opacity="0.76">
                            <circle id="Ellipse_45" data-name="Ellipse 45" cx="2" cy="2" r="2" transform="translate(-0.215 0.197)" fill="#707070" />
                            <circle id="Ellipse_46" data-name="Ellipse 46" cx="2" cy="2" r="2" transform="translate(-0.215 6.197)" fill="#707070" />
                            <circle id="Ellipse_47" data-name="Ellipse 47" cx="2" cy="2" r="2" transform="translate(-0.215 12.197)" fill="#707070" />
                        </g>
                    </svg>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Favourite it</a></li>
                </ul>
            </div>
        </div>
        @foreach ($user_message['child'] as $child_message)
        <div class="chat-reply {{($child_message['user']['user_type']['name'] == 'customer') ? 'customer' : ''}}">
            @if ($child_message['user']['user_type']['name'] == 'customer')
            <h4>{{$child_message['user']['name']}}</h4>
            @else
            <h4>{{$child_message['user']['name']}} ({{$child_message['user']['user_type']['label']}})</h4>
            @endif
            <p>{{$child_message['message']}}</p>
        </div>
        @endforeach
    </div>
</div>
@endforeach