$(document).ready(function() {
var budget_id = $("#budget_id").val();
var xin_table_expense = $('#speding_datatable').DataTable({
	"bDestroy": true,
	"bProcessing"   :   true,
	dom: 'Bltip',
	buttons: [
		{
			text: '<i class="fas fa-file-pdf"></i>Export',
			extend: 'pdf',
			split: [ 'excel', 'csv','copy','print'],
		}
	],
	search: {
		return: false,
	},
	lengthChange: true,
	search: {
		return: false,
	},
	"ajax": {
		url : site_url+"/budgeting/budget_list/"+budget_id,
		type : 'GET'
	},
	"fnDrawCallback": function(settings){
	$('[data-toggle="tooltip"]').tooltip();          
	}
});
	$('speding_datatable_filter').hide();
	$('#filter_expense').keyup(function(){

		xin_table_expense.search($(this).val()).draw() ;
	});

	var xin_table_requests = $('#request_datatable').DataTable({
		"bDestroy": true,
		dom: 'Bltip',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf"></i>Export',
				extend: 'pdf',
				split: [ 'excel', 'csv','copy','print'],
			}
		],
		columnDefs: [
			{
				target: 10,
				visible: false,
			},
		],
		
		"bDestroy": true,
		"ajax": {
			url : site_url+"/request/request_list/"+budget_id,
			type : 'GET'
		},
		"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();
		}
	});
	$('#request_datatable_filter').hide();
	$('#filter_request').keyup(function(){

		xin_table_requests.search($(this).val()).draw() ;
	});
	$('#filter_requests'  ).on('change', function () {
		if (this.value == 'all') {
			xin_table_requests.column(10).search('').draw();

		}if (this.value == "approved") {
			xin_table_requests.column(10).search(1).draw();

		}if (this.value == "declined") {
			xin_table_requests.column(10).search(2).draw();

		} if (this.value == "pending") {
			xin_table_requests.column(10).search(0).draw();

		}    } );

	//xin_table_requests.buttons().container().appendTo("#export_req_div");

	$( document ).on( "click", "#req_view_button", function() {

		var request_id  = $(this).data('request_id');
		$.ajax({
			type: "POST",
			url: site_url+"request/read_request/",
			data: "jd=1&is_ajax=1&mode=modal&request_id="+request_id+"&budget_id="+budget_id,
			cache: false,
			success: function (response) {
				if(response) {
					$("#ajax_modal_view").html(response);
					$('#view-modal-data').modal('toggle');
				}
			}
		});

	});

});
