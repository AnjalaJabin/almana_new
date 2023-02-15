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
		url : site_url+"/employees/empolyee_list/",
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
/* Delete data */

/*Form Submit*/
$( document ).on( "click", ".delete", function() {
	$('input[name=_token]').val($(this).data('record-id'));

	var employee_id  = $('input[name=_token]').val();

	$.ajax({
		type: "POST",
		url: site_url+"/employees/delete/",
		data: "is_ajax=2&employee_id="+employee_id,
		cache: false,
		success: function (JSON) {


			if (JSON.error != '') {
				toastr.error(JSON.error);
			} else {

				$('.delete-modal').modal('toggle');

				xin_table_employee.ajax.reload(function(){
					toastr.success(JSON.result);
				}, true);


			}
		}
	});
});

// edit
$('.edit-modal-data').on('show.bs.modal', function (event) {

	var button = $(event.relatedTarget);
	var employee_id = button.data('employee_id');
	var modal = $(this);
$.ajax({
	url : site_url+"/employees/read_employee/",
	type: "GET",
	data: 'jd=1&is_ajax=1&mode=modal&data=employee&employee_id='+employee_id,
	success: function (response) {
		if(response) {
			$("#ajax_modal").html(response);
		}
	}
	});
});





/* Add data */ /*Form Submit*/
/*$("#add_user_form").submit(function(e){
e.preventDefault();
	var obj = $(this), action = obj.attr('name');
	$('.save').prop('disabled', true);
	$.ajax({
		type: "POST",
		url: e.target.action,
		data: obj.serialize()+"&is_ajax=1&add_type=add_employee&form="+action,
		cache: false,
		success: function (JSON) {
			if (JSON.error != '') {
				toastr.error(JSON.error);
				$('.save').prop('disabled', false);
			} else {
				xin_table_employee.api().ajax.reload(function(){ 
					toastr.success(JSON.result);
				}, true);
				$('.add-form').fadeOut('slow');
				$('#add_user_form')[0].reset(); // To reset form fields
				$('.save').prop('disabled', false);
			}
		}
	});
});*/


$("#add_user_form").submit(function(e){

	var fd = new FormData(this);
	var obj = $(this), action = obj.attr('name');
	fd.append("is_ajax", 1);
	fd.append("add_type", 'add_employee');
	fd.append("form", action);
	e.preventDefault();
	$('.save').prop('disabled', true);
	
	$.ajax({
	    url: site_url+'/employees/add_employee/',//e.target.action,
		type: "POST",
		data:  fd,
		contentType: false,
		cache: false,
		processData:false,
		success: function(JSON)
		{  
			if (JSON.error != '') {
				toastr.error(JSON.error);
				$('.save').prop('disabled', false);
			} else {
			    $('#kt_modal_add_user').modal('toggle');
				xin_table_employee.ajax.reload(function(){
					toastr.success(JSON.result);
				}, true);
				$('#add_user_form')[0].reset(); // To reset form fields
				$('.save').prop('disabled', false);
			}
		},
		error: function() 
		{
			toastr.error(JSON.error);
			$('.save').prop('disabled', false);
		} 	        
   });
});
	xin_table_employee.buttons().container().appendTo("#export_div");
	$( document ).on( "click", "#sync_employees", function() {


		$.ajax({
			type: "POST",
			url: site_url+"/employees/get_employees_from_azure/",
			data: "is_ajax=2",
			cache: false,
			success: function (JSON) {


				// if (JSON.error != '') {
				// 	toastr.error("Some error Occured!");
				// } else {

					xin_table_employee.ajax.reload(function(){
						toastr.success("synchronization Completed!");
					}, true);


			//	}
			}
		});
	});
});


