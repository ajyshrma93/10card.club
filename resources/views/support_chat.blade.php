@extends('layouts.app')
@section('title', $application->card->card_name.' | Support')
@section('css')

<link href="{{asset('assets/css/chat.css')}}" rel="stylesheet">

@endsection

@section('content')
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <a href="{{route('my_applications')}}" class="page-back-btn rounded-circle d-block"></a>
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
                    <div class="row bootstrap snippets">
                        <div class="col-md-12">
                            <!-- DIRECT CHAT PRIMARY -->
                            <div class="box box-primary direct-chat direct-chat-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"> {{$application->card->card_name}} credit card application support</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <!-- Conversations are loaded here -->

                                    <div class="direct-chat-messages" id="chat_box">
                                        @foreach($chats as $chat)
                                        @include('includes.chat_messages')
                                        @endforeach
                                    </div>
                                    <!--/.direct-chat-messages-->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="input-group">
                                        <textarea type="text" name="message" placeholder="Type Message ..." class="form-control"></textarea>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary btn-flat sendMessage">Send</button>
                                        </span>
                                    </div>
                                </div>
                                <!-- /.box-footer-->
                            </div>
                            <!--/.direct-chat -->
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
    var $application_id = '{{$application->id}}';
    scrollMessage();

    function scrollMessage() {
        $('#chat_box').scrollTop($('#chat_box')[0].scrollHeight);
    }
    $('body').on('click', '.sendMessage', function() {
        sendMessage();
    })

    function sendMessage() {
        let message = $('textarea[name="message"]').val();
        if (message) {
            $.ajax({
                url: '{{route("send_message")}}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    application_id: $application_id,
                    message: message
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('textarea[name="message"]').val('');
                        $('.direct-chat-messages').append(response.html);
                        scrollMessage();
                    }
                }
            })
        }
    }
    setInterval(loadNewMessage, 1500);

    function loadNewMessage() {

        $.ajax({
            url: '{{route("load_application_chat")}}',
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                application_id: $application_id,
            },
            success: function(response) {
                if (response.status == 200) {
                    $('.direct-chat-messages').append(response.html);
                    scrollMessage();
                }
            }
        })
    }
</script>

@endsection
