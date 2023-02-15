<?php if(isset($_GET['jd']) && isset($_GET['sub_cat_id']) && isset($_GET['budget_id']) && $_GET['type']=='budget_assign'){
$sub_cat_assign_row = $this->Budgeting_model->get_budget_assigned_employees($_GET['budget_id'],$_GET['sub_cat_id']);
?>
	<div class="modal-content">
		<div class="modal-header">
		    
			<h2>Assign Employees</h2>
			<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
				<span class="svg-icon svg-icon-1">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
						<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
					</svg>
				</span>
			</div>
		</div>
		<div class="modal-body py-lg-10 px-lg-10">
			<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid">
				<div class="flex-row-fluid">
					<form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="<?php echo site_url("budgeting/update_budget_assign") ?>" method="post" id="update_budget_assign">
					    <input type="hidden" name="budget_id" value="<?php echo $_GET['budget_id']; ?>"/>
					    <input type="hidden" name="sub_cat_id" value="<?php echo $_GET['sub_cat_id']; ?>"/>
						<div class="current" data-kt-stepper-element="content">
							<div class="w-100">
								<table class="table table-row-bordered">
									<thead>
										<tr class="border-bottom fs-6 fw-bolder text-muted text-uppercase">
											<th class="min-w-200px">Employee</th>
<!----											<th class="text-end">Amount</th>--->
											<th></th>
										</tr>
									</thead>
									<tbody id="table_item_list_body">
									    <?php
									    foreach($sub_cat_assign_row as $sub_cat_assign_data)
									    {
									    ?>
										<tr class="fw-bolder text-gray-700 fs-5 text-end">
											<td>
											    <select class="form-select form-select-solid" data-hide-search="true" data-placeholder="Select..." name="assigned_sub_cat_employee[]">
                									<option value="0">Select Employee</option>
                									<?php
                									foreach($all_employees->result() as $employees){
                									    ?>
                									    <option <?php if($employees->user_id==$sub_cat_assign_data->employee_id){ echo 'selected'; } ?> value="<?php echo $employees->user_id;?>"><?php echo $employees->first_name.' '.$employees->last_name;?></option>
                									    <?php
                									}
                									?>
                								</select>
											</td>
<!--											<td>-->
<!--											    <input type="number" class="form-control form-control-solid" name="assigned_sub_cat_amount[]" value="--><?php //echo $sub_cat_assign_data->amount; ?><!--"/>-->
<!--											</td>-->
											<td>
											    <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger delete_item_table_row_btn">
                                					<!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                					<span class="svg-icon svg-icon-1">
                                						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                							<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"></rect>
                                							<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"></rect>
                                						</svg>
                                					</span>
                                					<!--end::Svg Icon-->
                                				</button>
											</td>
										</tr>
										<?php
									    }
										?>
										<tr class="fw-bolder text-gray-700 fs-5 text-end" id="employees_add_last_table_row">
											<td>
											    <select class="form-select form-select-solid" data-hide-search="true" data-placeholder="Select..." name="assigned_sub_cat_employee[]">
                									<option value="0">Select Employee</option>
                									<?php
                									foreach($all_employees->result() as $employees){
                									    ?>
                									    <option value="<?php echo $employees->user_id;?>"><?php echo $employees->first_name.' '.$employees->last_name;?></option>
                									    <?php
                									}
                									?>
                								</select>
											</td>
<!--											<td>-->
<!--											    <input type="number" class="form-control form-control-solid" placeholder="Amount" name="assigned_sub_cat_amount[]" value=""/>-->
<!--											</td>-->
										<td>
											    <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger delete_item_table_row_btn">
                                					<!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                					<span class="svg-icon svg-icon-1">
                                						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                							<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"></rect>
                                							<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"></rect>
                                						</svg>
                                					</span>
                                					<!--end::Svg Icon-->
                                				</button>
											</td>
										</tr>
									</tbody>
								</table>
								<button type="button" class="btn btn-success" id="add_item_table_row_btn" title="Add New Row"><i class="fa fa-plus"></i></button>
							</div>
						</div>
						<div class="d-flex flex-stack pt-10">
							<div class="me-2">
								<button type="button" class="btn btn-lg btn-light-primary me-3" data-bs-dismiss="modal">
								<span class="svg-icon svg-icon-3 me-1">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"></rect>
										<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"></path>
									</svg>
								</span>Close</button>
							</div>
							<div>
								<button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Update 
								<span class="svg-icon svg-icon-3 ms-1 me-0">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
										<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
									</svg>
								</span></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
$(document).ready(function(){
    
    var employees_add_last_table_row = $('#employees_add_last_table_row').html();
    $('#add_item_table_row_btn').on('click',function(){
        $('#table_item_list_body').append('<tr class="fw-bolder text-gray-700 fs-5 text-end">'+employees_add_last_table_row+'</tr>');
    });
    
    $(document).on('click','.delete_item_table_row_btn',function(){
        $(this).parent().parent().remove();
    });
    
	// On page load: datatable
	var xin_table_supplier = $('#xin_table_supplier').dataTable({
		"bDestroy": true,
		//"bFilter": false,
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 30, 50, 100, -1], [5, 10, 30, 50, 100, "All"]],
		"ajax": {
            url : "<?php echo site_url("settings/supplier_list") ?>",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	});	 

	/* Edit data */
	$("#update_budget_assign").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=21&add_type=update_budget_assign&data=update_budget_assign&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('.save').prop('disabled', false);
				} else {
					$('.assign_budget_employee').modal('toggle');
					toastr.success(JSON.result);
					$('.save').prop('disabled', false);			
				}
			}
		});
	});
});	
</script>

<?php }?>