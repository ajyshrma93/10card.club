var SweetAlert_custom = {
    init: function () {
        document.querySelectorAll(".delete-item").forEach(function (e) {
            e.onclick = function () {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        location.replace($(this).attr("data-href"));
                    }
                });
            };
        });
    },
};
(function ($) {
    SweetAlert_custom.init();
})(jQuery);
