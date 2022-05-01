"use strict";
(function($) {
	"use strict";
	$('#product-list-table').dataTable({
		pageLength: 5,
		info: false,
		responsive: true,
		"ordering": false,
		lengthMenu: [
			[5, 10, 20, -1],
			[5, 10, 20, "All"]
		],
		language: {
			"lengthMenu": "Display _MENU_ Products",
			searchPlaceholder: "Search by products name",
			search: ' '
		}
	});
	
	 $('#productReportChart').DataTable({
		responsive: true,
		"ordering": false,
		"columnDefs": [
			{width: '20%', targets: 0, type: 'html'},
			{targets: 1, type: 'html'},
			{targets: 2, type: 'html'},
		],
		initComplete: function () {
			this.api().columns().every( function (d) {
				var column = this;
				var theadname = $("#productReportChart th").eq([d]).text();
				var select = $('<select class="js-example-basic-single"><option value="">' + theadname + ': All</option></select>')
				.appendTo( $(column.header()).empty() )
				.on( 'change', function () {
					var val = $.fn.dataTable.util.escapeRegex(
						$(this).val()
						);
						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					});
					
					column.data().unique().sort().each( function ( d, j ) {
							d = $(d).text();
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
				});
			}
		});
		
})(jQuery);