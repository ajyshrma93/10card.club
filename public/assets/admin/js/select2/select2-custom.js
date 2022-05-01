"use strict";
(function($) {
    "use strict";
    // Single Search Select
    $(".js-example-basic-single").select2();
    $(".js-example-disabled-results").select2();

    // Multi Select
    $(".js-example-basic-multiple").select2();

    // With Placeholder
    $(".js-example-placeholder-multiple").select2({
        placeholder: "Select Your Name"
    });
    $("#modalSelect-1, #modalSelect-4").select2({ 
        dropdownParent: $('#product-modal-1 .modal-content')
    });
    $("#modalSelect-6, #modalSelect-7").select2({ 
        dropdownParent: $('#product-modal-3 .modal-content')
    });

    $("#modalSelect-2, #modalSelect-3").select2({ 
        dropdownParent: $('#product-modal-2 .modal-content')
    });

    // custom
    function iformat(icon) {
        var originalOption = icon.element;
        return $('<span><i class="fi ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
    }
    $('.country-list').select2({
        width: "100%",
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true
    });
    $('#modalSelect-5').select2({
        width: "100%",
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true,
        dropdownParent: $('#product-modal-1 .modal-content')
    });
    $('#modalSelect-8').select2({
        width: "100%",
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true,
        dropdownParent: $('#product-modal-3 .modal-content')
    });
    

    // With Placeholder
    $("#bm-group").select2({ 
        dropdownParent: $('#addNewItem .modal-content')
    });

    //Limited Numbers
    $(".js-example-basic-multiple-limit").select2({
        maximumSelectionLength: 2
    });

    //RTL Suppoort
    $(".js-example-rtl").select2({
        dir: "rtl"
    });
    // Responsive width Search Select
    $(".js-example-basic-hide-search").select2({
        minimumResultsForSearch: Infinity
    });
    $(".js-example-disabled").select2({
        disabled: true
    });
    $(".js-programmatic-enable").on("click", function() {
        $(".js-example-disabled").prop("disabled", false);
    });
    $(".js-programmatic-disable").on("click", function() {
        $(".js-example-disabled").prop("disabled", true);
    });
})(jQuery);