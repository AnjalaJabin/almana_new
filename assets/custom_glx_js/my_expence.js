$(document).ready(function() {
var xin_table_employee = $('#xin_table_employee').DataTable({
	"bDestroy": true,
	"bProcessing"   :   true,
	dom: 'lBfrtip',
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
	"ajax": {
		url : site_url+"/employees/my_expense_list/",
		type : 'GET'
	},
	"fnDrawCallback": function(settings){
	$('[data-toggle="tooltip"]').tooltip();          
	}
});
	$(".dataTables_filter").css("display", "none");

	$('#filter_employee').keyup(function(){

		xin_table_employee.search($(this).val()).draw() ;
	});
$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
$('[data-plugin="select_hrm"]').select2({ width:'100%' });
	xin_table_employee.buttons().container().appendTo("#export_div");
});