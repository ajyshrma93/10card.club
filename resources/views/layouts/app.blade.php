<!DOCTYPE html>
<html lang="en">
@php
$version = 3.0;
@endphp

<head>
    <!-- Required meta tags -->
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.scrollbar.css').'?v='.$version }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css').'?v='.$version }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <title>@yield('title')</title>
    @yield('css')
    <style type="text/css">
        .chat-reply.customer h4 {
            color: #000944;
        }

        .chat-reply.search-results h4 {
            color: rgb(0 0 0 / 60%);
            font-size: 13px;
            line-height: 22px;
            margin-bottom: 11px;
        }
    </style>
</head>

<body>
    <div id="app">
        @yield('content')
    </div>

    @yield('modals')

    <!-- Scrips -->
    <script>
        let $base_url = '{{url("/")}}';
    </script>
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.scrollbar.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/custom.js').'?v='.$version  }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" type="text/javascript"></script>
    @yield('js_script')
    <script type="text/javascript">
        $('#merchantModal').on('shown.bs.modal', function(e) {
            var link = e.relatedTarget,
                modal = $(this),
                merchantName = link.getAttribute("data-merchantName"),
                merchantDescription = link.getAttribute("data-merchantDescription");
            merchantLogo = link.getAttribute('data-merchantLogo');

            modal.find("#merchantName").html(merchantName);
            modal.find("#merchantDescription").html(merchantDescription);
            modal.find("#merchantLogo").css("background-image", 'url(' + merchantLogo + ')');
        });
        $('#addCardToOwn').on('shown.bs.modal', function(e) {
            var link = e.relatedTarget,
                modal = $(this),
                cardName = link.getAttribute("data-card-title");
            cardId = link.getAttribute("data-card-id");
            modal.find("#card_name_owned").html(cardName);
            modal.find("#card-id-owned").val(cardId);

        });

        $(".chat-search-btn").on("click", function() {
            if ($(this).hasClass('close')) {
                $("#userChatMessagesOld").show();
                $("#userChatMessagesSearch").html('');
                $("#chat_search").val('');
            }
        });
    </script>

</body>

</html>
