$(document).ready(function() {
	$('#store-select').select2();

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
	$('#store-select').select2();
	function generateRow() {
		var html = '<div class="row form-group mb-3">';
		html += '<div class="card-header" id="select_period_div" style="display:block;">';
		html += '<div class="card-title fs-3 fw-bolder">';
		html += '<div class="w-200 w-md-600px" style="background: rgb(221, 221, 221); padding: 7px;">';
		html += '<div class="input-group">';
		html += '<select  name="period[]" class="form-select form-select-solid select_period" data-placeholder="Allowance Period" data-allow-clear="true">';
		html += '<option value="">Select Allowance Period..</option>';
		$.each(periods, function(i, period) {
			html += '<option value="' + period.id + '">' + formatDate(period.from_date) + ' - ' + formatDate(period.to_date) + '</option>';
		});
		html += '</select>';
		html += '<input type="text" class="form-control form-control-solid" placeholder="Amount" name="amount[]" />';
		// html += '<span class="input-group-btn">';
		// html += '<button class="btn btn-success group_add_main_cat_sub_btn add_period" type="button"><i class="fa fa-plus"></i></button>';
		// html += '</span>';
		html += '<span class="input-group-btn">';
		html += '<button class="btn btn-danger group_remove_main_cat_sub_btn" type="button"><i class="fa fa-times"></i></button>';
		html += '</span>';
		html += '</div></div></div></div></div>';

		$("#allowance-div").append(html);

		// Initialize select2 for the new row
		$('.select_period').select2();


	}
	function formatDate(dateString) {
		var date = new Date(dateString);
		var day = date.getDate();
		var month = date.toLocaleString('default', { month: 'short' });
		var year = date.getFullYear();
		return day + ' ' + month.toUpperCase() + ' ' + year;
	}
	// Add new row
	$(document).on('click', '.add_period', function() {
		// $(this).hide();
		// $(this).closest('.input-group').find('.remove_period').attr("style", "display:block");
		generateRow();
	});

	// Remove current row
	$(document).on('click', '.group_remove_main_cat_sub_btn', function() {
		$(this).closest('.row.form-group.mb-3').remove();
	});

});


