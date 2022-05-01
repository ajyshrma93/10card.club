$(function () {
    $(document).on("click", ".toggle-nav", function (e) {
        e.preventDefault();
        if ($(".toggle-nav").hasClass("clicked")) {
            $(".toggle-nav").removeClass("clicked");
            $("#site-menu").removeClass("flip");
            $("#site-wrapper").removeClass("flip");
        } else {
            $(".toggle-nav").addClass("clicked");
            $("#site-menu").addClass("flip");
            $("#site-wrapper").addClass("flip");

            $("#site-menu ul li").each(function (e) {
                var parentLink = $(this);
                var dataAnimationDelay = $(parentLink).data("animation-delay");
                var dataLinkBgColor = $(parentLink).data("link-bg-color");

                $(parentLink)
                    .css({
                        "animation-delay": dataAnimationDelay,
                        "-webkit-animation-delay": dataAnimationDelay,
                    })
                    .find(".nav-link")
                    .css("background-color", dataLinkBgColor);
            });
        }
    });

    // Footer scroll up-down
    var lastScrollTop = 0;
    $(window).scroll(function (event) {
        var currentScoll = $(this).scrollTop();
        if (currentScoll > lastScrollTop) {
            $(".navbar.bottom-bar").addClass("scrolling_down");
        } else {
            $(".navbar.bottom-bar").removeClass("scrolling_down");
        }
        lastScrollTop = currentScoll;
    });

    if ($(".scrollbar-outer").length > 0) {
        $(".scrollbar-outer").scrollbar();
    }

    $(document).ready(function () {
        setTimeout(function () {
            $("#site-menu").css({ opacity: "1", visibility: "visible" });
        }, 400);
    });
});

function markCardAsOwn(card_id) {
    $.ajax({
        url: $base_url + "mark-card-as-owned",
        data: {
            card_id: card_id,
        },
        success: function (response) {
            if (response.status == 200) {
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        },
    });
}
