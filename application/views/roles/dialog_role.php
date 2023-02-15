<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['role_id']) && $_GET['data']=='role'){
$role_resources_ids = explode(',',$role_resources);
?>

<div class="modal-header" id="kt_modal_add_user_header">
	<h2 class="fw-bolder">Edit User Role</h2>
	<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
		<span class="svg-icon svg-icon-1">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
				<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
			</svg>
		</span>
	</div>
</div>
<!--begin::Modal body-->
<div class="modal-body">
	<form class="m-b-1" action="<?php echo site_url("roles/update").'/'.$role_id; ?>" method="post" name="edit_role" id="edit_role">
  <input type="hidden" name="_method" value="EDIT">
  <input type="hidden" name="_token" value="<?php echo $role_id;?>">
  <input type="hidden" name="ext_name" value="<?php echo $role_name;?>">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12 mb-5">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="role_name">Role Name</label>
              <input class="form-control form-control-solid" placeholder="Role Name" name="role_name" type="text" value="<?php echo $role_name;?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="resources">Resources</label>
              <div id="all_resources">
                <div class="demo-section k-content">
                  <div>
                    <div id="treeview_m1"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--<div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <div id="all_resources">
                <div class="demo-section k-content">
                  <div>
                    <div id="treeview_m2"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>-->
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
</form>
</div>
<!--end::Modal body-->

<script type="text/javascript">
 $(document).ready(function(){
					
		// On page load: datatable
		var xin_table = $('#xin_table').dataTable({
			"bDestroy": true,
            "bFilter": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bInfo": false,
			"ajax": {
				url : "<?php echo site_url("roles/role_list") ?>",
				type : 'GET'
			},
			"fnDrawCallback": function(settings){
			//$('[data-toggle="tooltip"]').tooltip();          
			}
    	});	 

		/* Edit data */
		$("#edit_role").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&edit_type=role&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('.save').prop('disabled', false);
					} else {
						xin_table.api().ajax.reload(function(){ 
							toastr.success(JSON.result);
						}, true);
						$('.edit-modal-data').modal('toggle');
						$('.save').prop('disabled', false);
					}
				}
			});
		});
	});	
  </script>
  <script>

jQuery("#treeview_m1").kendoTreeView({
checkboxes: {
checkChildren: true,
template: "<label class='custom-control custom-checkbox'><input type='checkbox' #= item.check# class='#= item.class #' name='role_resources[]' value='#= item.value #'  /><span class='custom-control-indicator'></span><span class='custom-control-description'>#= item.text #</span><span class='custom-control-info'>#= item.add_info #</span></label>"
},
check: onCheck,
dataSource: [
    
{ id: "", class: "role-checkbox custom-control-input", text: "Budgeting", add_info: "", value: "1", check: "<?php if(isset($_GET['role_id'])) { 
    if(in_array('1',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "All Budgets",  add_info: "", value: "2", check: "<?php if(isset($_GET['role_id'])) { if(in_array('2',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Add New Budget",  add_info: "", value: "3", check: "<?php if(isset($_GET['role_id'])) { if(in_array('3',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
        { id: "", class: "role-checkbox custom-control-input", text: "View Budget Details",  add_info: "", value: "4", check: "<?php if(isset($_GET['role_id'])) { if(in_array('4',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
        { id: "", class: "role-checkbox custom-control-input", text: "Edit User Allocation",  add_info: "", value: "31", check: "<?php if(isset($_GET['role_id'])) { if(in_array('31',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
        { id: "", class: "role-checkbox custom-control-input", text: "Edit Budget",  add_info: "", value: "32", check: "<?php if(isset($_GET['role_id'])) { if(in_array('32',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
        { id: "", class: "role-checkbox custom-control-input", text: "Add Expense",  add_info: "", value: "33", check: "<?php if(isset($_GET['role_id'])) { if(in_array('33',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
        { id: "", class: "role-checkbox custom-control-input", text: "View All Expense Data",  add_info: "", value: "35", check: "<?php if(isset($_GET['role_id'])) { if(in_array('35',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

]},

{ id: "", class: "role-checkbox custom-control-input", text: "Employee", add_info: "", value: "5", check: "<?php if(isset($_GET['role_id'])) { 
    if(in_array('5',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "Add",  add_info: "Employee Add", value: "6", check: "<?php if(isset($_GET['role_id'])) { if(in_array('6',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "View",  add_info: "Employee List", value: "7", check: "<?php if(isset($_GET['role_id'])) { if(in_array('7',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Edit",  add_info: "Employee Edit", value: "8", check: "<?php if(isset($_GET['role_id'])) { if(in_array('8',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Delete",  add_info: "Employee Delete", value: "9", check: "<?php if(isset($_GET['role_id'])) { if(in_array('9',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},


]}, // sub 1 end
    { id: "", class: "role-checkbox custom-control-input", text: "All Expenses", add_info: "", value: "25", check: "<?php if(isset($_GET['role_id'])) {
            if(in_array('25',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1
            { id: "", class: "role-checkbox custom-control-input", text: "Add",  add_info: "Expense Add", value: "26", check: "<?php if(isset($_GET['role_id'])) { if(in_array('26',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

            { id: "", class: "role-checkbox custom-control-input", text: "View",  add_info: "Expense  List", value: "27", check: "<?php if(isset($_GET['role_id'])) { if(in_array('27',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

            { id: "", class: "role-checkbox custom-control-input", text: "Edit",  add_info: "Expense Edit", value: "28", check: "<?php if(isset($_GET['role_id'])) { if(in_array('28',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

            { id: "", class: "role-checkbox custom-control-input", text: "Delete",  add_info: "Expense Delete", value: "29", check: "<?php if(isset($_GET['role_id'])) { if(in_array('29',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},


        ]}, // sub 1 end


{ id: "", class: "role-checkbox custom-control-input", text: "Role", add_info: "", value: "16", check: "<?php if(isset($_GET['role_id'])) { 
    if(in_array('16',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "Role Lists",  add_info: "", value: "17", check: "<?php if(isset($_GET['role_id'])) { if(in_array('17',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Add Role",  add_info: "", value: "18", check: "<?php if(isset($_GET['role_id'])) { if(in_array('18',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Edit Role",  add_info: "", value: "19", check: "<?php if(isset($_GET['role_id'])) { if(in_array('19',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Delete Role",  add_info: "", value: "20", check: "<?php if(isset($_GET['role_id'])) { if(in_array('20',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

]}, // sub 1 end


{ id: "", class: "role-checkbox custom-control-input", text: "Settings", add_info: "", value: "10", check: "<?php if(isset($_GET['role_id'])) { 
if(in_array('10',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1

{ id: "", class: "role-checkbox custom-control-input", text: "Settings View",  add_info: "", value: "21", check: "<?php if(isset($_GET['role_id'])) { if(in_array('21',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Departments",  add_info: "", value: "11", check: "<?php if(isset($_GET['role_id'])) { if(in_array('11',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Categories",  add_info: "", value: "12", check: "<?php if(isset($_GET['role_id'])) { if(in_array('12',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Sub-Categories",  add_info: "", value: "13", check: "<?php if(isset($_GET['role_id'])) { if(in_array('13',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Cost Center",  add_info: "", value: "14", check: "<?php if(isset($_GET['role_id'])) { if(in_array('14',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Vendor/Supplier",  add_info: "", value: "15", check: "<?php if(isset($_GET['role_id'])) { if(in_array('15',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
        { id: "", class: "role-checkbox custom-control-input", text: "Currency",  add_info: "", value: "24", check: "<?php if(isset($_GET['role_id'])) { if(in_array('24',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

        { id: "", class: "role-checkbox custom-control-input", text: "Company",  add_info: "", value: "34", check: "<?php if(isset($_GET['role_id'])) { if(in_array('34',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

    ]}, // sub 1 end


]
});

jQuery("#treeview_m2").kendoTreeView({
checkboxes: {
checkChildren: true,
template: "<label class='custom-control custom-checkbox'><input type='checkbox' #= item.check# class='#= item.class #' name='role_resources[]' value='#= item.value #'  /><span class='custom-control-indicator'></span><span class='custom-control-description'>#= item.text #</span><span class='custom-control-info'>#= item.add_info #</span></label>"
},
check: onCheck,
dataSource: [
//

{ id: "", class: "role-checkbox custom-control-input", text: "Receipts", add_info: "", value: "58", check: "<?php if(isset($_GET['role_id'])) { 
if(in_array('58',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "Show All",  add_info: "show all", value: "59", check: "<?php if(isset($_GET['role_id'])) { if(in_array('59',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Add",  add_info: "Add", value: "60", check: "<?php if(isset($_GET['role_id'])) { if(in_array('60',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Edit",  add_info: "Edit", value: "61", check: "<?php if(isset($_GET['role_id'])) { if(in_array('61',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "View",  add_info: "View", value: "62", check: "<?php if(isset($_GET['role_id'])) { if(in_array('62',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Download",  add_info: "View", value: "63", check: "<?php if(isset($_GET['role_id'])) { if(in_array('63',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Delete",  add_info: "Delete", value: "64", check: "<?php if(isset($_GET['role_id'])) { if(in_array('64',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

]}, // sub 1 end



{ id: "", class: "role-checkbox custom-control-input", text: "Account Receivable", add_info: "", value: "65", check: "<?php if(isset($_GET['role_id'])) { 
if(in_array('65',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "Show All",  add_info: "show all", value: "66", check: "<?php if(isset($_GET['role_id'])) { if(in_array('66',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Add",  add_info: "Add", value: "67", check: "<?php if(isset($_GET['role_id'])) { if(in_array('67',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Edit",  add_info: "Edit", value: "68", check: "<?php if(isset($_GET['role_id'])) { if(in_array('68',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "View",  add_info: "View", value: "69", check: "<?php if(isset($_GET['role_id'])) { if(in_array('69',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Download",  add_info: "View", value: "70", check: "<?php if(isset($_GET['role_id'])) { if(in_array('70',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Delete",  add_info: "Delete", value: "71", check: "<?php if(isset($_GET['role_id'])) { if(in_array('71',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

]}, // sub 1 end



{ id: "", class: "role-checkbox custom-control-input", text: "Daily Expenses", add_info: "", value: "72", check: "<?php if(isset($_GET['role_id'])) { 
if(in_array('72',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "Show All",  add_info: "show all", value: "73", check: "<?php if(isset($_GET['role_id'])) { if(in_array('73',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Add",  add_info: "Add", value: "74", check: "<?php if(isset($_GET['role_id'])) { if(in_array('74',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Edit",  add_info: "Edit", value: "75", check: "<?php if(isset($_GET['role_id'])) { if(in_array('75',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "View",  add_info: "View", value: "76", check: "<?php if(isset($_GET['role_id'])) { if(in_array('76',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Download",  add_info: "View", value: "77", check: "<?php if(isset($_GET['role_id'])) { if(in_array('77',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Delete",  add_info: "Delete", value: "78", check: "<?php if(isset($_GET['role_id'])) { if(in_array('78',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

]}, // sub 1 end


{ id: "", class: "role-checkbox custom-control-input", text: "Rate Request", add_info: "", value: "16", check: "<?php if(isset($_GET['role_id'])) { 
if(in_array('16',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "Add",  add_info: "Add", value: "17", check: "<?php if(isset($_GET['role_id'])) { if(in_array('17',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Edit",  add_info: "Edit", value: "18", check: "<?php if(isset($_GET['role_id'])) { if(in_array('18',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "View",  add_info: "View", value: "19", check: "<?php if(isset($_GET['role_id'])) { if(in_array('19',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Delete",  add_info: "Delete", value: "20", check: "<?php if(isset($_GET['role_id'])) { if(in_array('20',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

]}, // sub 1 end


{ id: "", class: "role-checkbox custom-control-input", text: "Users", add_info: "", value: "21", check: "<?php if(isset($_GET['role_id'])) { 
if(in_array('21',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
// sub 1
{ id: "", class: "role-checkbox custom-control-input", text: "Add",  add_info: "Add", value: "22", check: "<?php if(isset($_GET['role_id'])) { if(in_array('22',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Edit",  add_info: "Edit", value: "23", check: "<?php if(isset($_GET['role_id'])) { if(in_array('23',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "View",  add_info: "View", value: "24", check: "<?php if(isset($_GET['role_id'])) { if(in_array('24',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Delete",  add_info: "Delete", value: "25", check: "<?php if(isset($_GET['role_id'])) { if(in_array('25',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

]}, // sub 1 end


{ id: "", class: "role-checkbox custom-control-input", text: "Roles",  add_info: "View", value: "26", check: "<?php if(isset($_GET['role_id'])) { if(in_array('26',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Company",  add_info: "View", value: "27", check: "<?php if(isset($_GET['role_id'])) { if(in_array('27',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},

{ id: "", class: "role-checkbox custom-control-input", text: "Settings",  add_info: "", value: "28", check: "<?php if(isset($_GET['role_id'])) { 
if(in_array('28',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
{ id: "", class: "role-checkbox custom-control-input", text: "Currency",  add_info: "Add", value: "29", check: "<?php if(isset($_GET['role_id'])) { if(in_array('29',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
]},

]
});
		
// show checked node IDs on datasource change
function onCheck() {
var checkedNodes = [],
treeView = jQuery("#treeview").data("kendoTreeView"),
message;
//checkedNodeIds(treeView.dataSource.view(), checkedNodes);
jQuery("#result").html(message);
}
$(document).ready(function(){
	$("#role_access_modal").change(function(){
		var sel_val = $(this).val();
		if(sel_val=='1') {
			$('.role-checkbox-modal').prop('checked', true);
		} else {
			$('.role-checkbox-modal').attr("checked", false);
		}
	});
});
</script>
<?php }
?>
