@if($chat->user_id != auth()->id())

<!-- Message. Default to the left -->
<div class="direct-chat-msg">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-left">{{$chat->user->name}} [{{$chat->user->user_type->label}}]</span>
        <span class="direct-chat-timestamp pull-right">{{$chat->created_at->format('h:i a')}}</span>
    </div>
    <!-- /.direct-chat-info -->
    <img class="direct-chat-img" src="{{asset('assets/images/user_1.jpg')}}" alt="Message User Image"><!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        {!!$chat->message!!}

    </div>

    <!-- /.direct-chat-text -->
</div>
<!-- /.direct-chat-msg -->
@else
<!-- Message to the right -->
<div class="direct-chat-msg right">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-right">You</span>
        <span class="direct-chat-timestamp pull-left">{{$chat->created_at->format('h:i a')}}</span>
    </div>
    <!-- /.direct-chat-info -->
    <img class="direct-chat-img" src="{{asset('assets/images/user_2.jpg')}}" alt="Message User Image"><!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        {!!$chat->message!!}
    </div>
    <!-- /.direct-chat-text -->
</div>
<!-- /.direct-chat-msg -->
@endif
