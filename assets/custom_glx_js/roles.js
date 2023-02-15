$(document).ready(function() {
   var xin_table = $('#xin_table').dataTable({
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bLengthChange": false,
        "bInfo": false,
		"ajax": {
            url : site_url+"/roles/role_list/",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
    });
    
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
		

	/* Delete data */
	$("#delete_record").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=2&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
				} else {
					$('.delete-modal').modal('toggle');
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);							
				}
			}
		});
	});
	
	// edit
	$('.edit-modal-data').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var role_id = button.data('role_id');
		var modal = $(this);
	$.ajax({
		url : site_url+"/roles/read/",
		type: "GET",
		data: 'jd=1&is_ajax=1&mode=modal&data=role&role_id='+role_id,
		success: function (response) {
			if(response) {
				$("#ajax_modal").html(response);
			}
		}
		});
	});
	
	/* Add data */ /*Form Submit*/
	$("#xin-form").submit(function(e){
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&add_type=role&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('.save').prop('disabled', false);
				} else {
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('#kt_modal_add_user').modal('toggle');
					$('.add-form').fadeOut('slow');
					$('#xin-form')[0].reset(); // To reset form fields
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});
$( document ).on( "click", ".delete", function() {
	$('input[name=_token]').val($(this).data('record-id'));
	$('#delete_record').attr('action',base_url+'/delete/'+$(this).data('record-id'));
});

$( document ).on( "change", "#role_access_modal", function() {
    var role_access = $('#role_access_modal').val();
    if(role_access==1)
    {
        $('input[type=checkbox]').attr('checked',true);
    }
});

jQuery("#treeview_r1").kendoTreeView({
checkboxes: {
checkChildren: true,
template: "<label class='custom-control custom-checkbox single-item'><input type='checkbox' #= item.check# class='#= item.class #' name='role_resources[]' value='#= item.value #'  /><span class='custom-control-indicator'></span><span class='custom-control-description'>#= item.text #</span><span class='custom-control-info'>#= item.add_info #</span></label>"
},
//<label class='custom-control custom-checkbox'><input type='checkbox' class='#= item.class #' name='role_resources[]' value='#= item.value #'  /><span class='custom-control-indicator'></span><span class='custom-control-description'>#= item.text #</span><span class='custom-control-info'>#= item.add_info #</span></label>

//template: "<div class='checkbox'><label><input type='checkbox' #= item.check# class='#= item.class #' name='role_resources[]' value='#= item.value #'>#= item.text #</label></div>"
check: onCheck,
dataSource: [

{ id: "", class: "role-checkbox custom-control-input", text: "Budgeting", add_info: "", value: "1", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "All Budgets",  add_info: "View", value: "2",},

{ id: "", class: "role-checkbox custom-control-input", text: "Add New Budget",  add_info: "View", value: "3",},

]}, // sub 1 end


{ id: "", class: "role-checkbox custom-control-input", text: "Employee", add_info: "", value: "5", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "Add",  add_info: "Employee Add", value: "6",},

{ id: "", class: "role-checkbox custom-control-input", text: "View",  add_info: "Employee List", value: "7",},

{ id: "", class: "role-checkbox custom-control-input", text: "Edit",  add_info: "Employee Edit", value: "8",},

{ id: "", class: "role-checkbox custom-control-input", text: "Delete",  add_info: "Employee Delete", value: "9",},

]}, // sub 1 end

/*{ id: "", class: "role-checkbox custom-control-input", text: "Customers",  add_info: "View", value: "9",},*/

{ id: "", class: "role-checkbox custom-control-input", text: "Roles",  add_info: "", value: "16",  items: [
{ id: "", class: "role-checkbox custom-control-input", text: "Roles List",  add_info: "", value: "17",},
{ id: "", class: "role-checkbox custom-control-input", text: "Add Role",  add_info: "", value: "18",},
{ id: "", class: "role-checkbox custom-control-input", text: "Edit Role",  add_info: "", value: "19",},
{ id: "", class: "role-checkbox custom-control-input", text: "Delete Role",  add_info: "", value: "20",},
]},


{ id: "", class: "role-checkbox custom-control-input", text: "Settings",  add_info: "", value: "10",  items: [
{ id: "", class: "role-checkbox custom-control-input", text: "Settings View",  add_info: "", value: "21",},
{ id: "", class: "role-checkbox custom-control-input", text: "Departments",  add_info: "", value: "11",},
{ id: "", class: "role-checkbox custom-control-input", text: "Categories",  add_info: "", value: "12",},
{ id: "", class: "role-checkbox custom-control-input", text: "Sub-Categories",  add_info: "", value: "13",},
{ id: "", class: "role-checkbox custom-control-input", text: "Cost Center",  add_info: "", value: "14",},
{ id: "", class: "role-checkbox custom-control-input", text: "Vendor/Supplier",  add_info: "", value: "15",},
]},


]
});

/*jQuery("#treeview_r2").kendoTreeView({
checkboxes: {
checkChildren: true,
template: "<label class='custom-control custom-checkbox'><input type='checkbox' #= item.check# class='#= item.class #' name='role_resources[]' value='#= item.value #'  /><span class='custom-control-indicator'></span><span class='custom-control-description'>#= item.text #</span><span class='custom-control-info'>#= item.add_info #</span></label>"
},
check: onCheck,
dataSource: [

{ id: "", class: "role-checkbox custom-control-input", text: "Tools",  add_info: "", value: "11",  items: [
{ id: "", class: "role-checkbox custom-control-input", text: "Add Users",  add_info: "Add", value: "12"},
{ id: "", class: "role-checkbox custom-control-input", text: "Edit Users",  add_info: "Edit", value: "13",},
{ id: "", class: "role-checkbox custom-control-input", text: "Delete Users",  add_info: "Delete", value: "14",},
]},

{ id: "", class: "role-checkbox custom-control-input", text: "Roles",  add_info: "", value: "15",  items: [
{ id: "", class: "role-checkbox custom-control-input", text: "Add Roles",  add_info: "Add", value: "16"},
{ id: "", class: "role-checkbox custom-control-input", text: "Edit Roles",  add_info: "Edit", value: "17",},
{ id: "", class: "role-checkbox custom-control-input", text: "Delete Roles",  add_info: "Delete", value: "18",},
]},


{ id: "", class: "role-checkbox custom-control-input", text: "Reports",  add_info: "", value: "19",  items: [
{ id: "", class: "role-checkbox custom-control-input", text: "Order Report",  add_info: "Add", value: "20"},
]},

{ id: "", class: "role-checkbox custom-control-input", text: "Settings",  add_info: "", value: "21",  items: [
{ id: "", class: "role-checkbox custom-control-input", text: "Add Settings",  add_info: "Add", value: "23"},
{ id: "", class: "role-checkbox custom-control-input", text: "View Settings",  add_info: "View", value: "24"},
{ id: "", class: "role-checkbox custom-control-input", text: "Edit Settings",  add_info: "Edit", value: "25",},
{ id: "", class: "role-checkbox custom-control-input", text: "Delete Settings",  add_info: "Delete", value: "26",},
]},

]
});*/
		
// show checked node IDs on datasource change
function onCheck() {
var checkedNodes = [],
		treeView = jQuery("#treeview2").data("kendoTreeView"),
		message;
		jQuery("#result").html(message);
}
$(document).ready(function(){
	$("#role_access").change(function(){
		var sel_val = $(this).val();
		if(sel_val=='1') {
			$('.role-checkbox').prop('checked', true);
		} else {
			$('.role-checkbox').attr("checked", false);
		}
	});
});