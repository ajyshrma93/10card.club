"use strict";
(function($) {
    "use strict";
    $('#basic-1').DataTable({
        pageLength: 5,
        info: false,
        responsive: true,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, "Todos"]
        ]
    });
})(jQuery);