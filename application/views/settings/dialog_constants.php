<?php
if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='category' && $_GET['type']=='category'){
$row = $this->Xin_model->read_category_data_by_id($_GET['field_id']);
?>
	<!--begin::Modal content-->
	<div class="modal-content">
		<!--begin::Modal header-->
		<div class="modal-header">
			<!--begin::Modal title-->
			<h2>Edit Category</h2>
			<!--end::Modal title-->
			<!--begin::Close-->
			<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
				<span class="svg-icon svg-icon-1">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
						<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>0-
			<!--end::Close-->
		</div>
		<!--end::Modal header-->
		<!--begin::Modal body-->
		<div class="modal-body py-lg-10 px-lg-10">
			<!--begin::Stepper-->
			<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid">
				<!--begin::Content-->
				<div class="flex-row-fluid py-lg-12 px-lg-15">
					<!--begin::Form-->
					<form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="<?php echo site_url("settings/update_category") ?>/<?php echo $row[0]->id;?>" method="post" id="update_category">
						<!--begin::Step 1-->
						<div class="current" data-kt-stepper-element="content">
							<div class="w-100">
								<!--begin::Input group-->
								<div class="fv-row mb-10 fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-5 fw-semibold mb-2">
										<span class="required">Category Name</span>
										<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder="Category" value="<?php echo $row[0]->name;?>">
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
						</div>
						<!--end::Step 1-->
						<!--begin::Actions-->
						<div class="d-flex flex-stack pt-10">
							<!--begin::Wrapper-->
							<div class="me-2">
								<button type="button" class="btn btn-lg btn-light-primary me-3" data-bs-dismiss="modal">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
								<span class="svg-icon svg-icon-3 me-1">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"></rect>
										<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"></path>
									</svg>
								</span>
								<!--end::Svg Icon-->Close</button>
							</div>
							<!--end::Wrapper-->
							<!--begin::Wrapper-->
							<div>
								<button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Update 
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
								<span class="svg-icon svg-icon-3 ms-1 me-0">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
										<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
									</svg>
								</span>
								<!--end::Svg Icon--></button>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Actions-->
					<div></div><div></div><div></div><div></div></form>
					<!--end::Form-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Stepper-->
		</div>
		<!--end::Modal body-->
	</div>
	<!--end::Modal content-->
		
<script type="text/javascript">
$(document).ready(function(){
	// On page load: datatable
	var xin_table_product_cat = $('#xin_table_category').dataTable({
		"bDestroy": true,
		"ajax": {
            url : "<?php echo site_url("settings/category_list") ?>",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	});	 

	/* Edit data */
	$("#update_category").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=21&type=edit_category&data=edit_category&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('.save').prop('disabled', false);
				} else {
					$('.edit_setting_datail').modal('toggle');
					xin_table_product_cat.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('.save').prop('disabled', false);				
				}
			}
		});
	});
});	
</script>
<?php }else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='sub_category' && $_GET['type']=='sub_category'){
$row = $this->Xin_model->read_sub_category_data_by_id($_GET['field_id']);
?>
	<!--begin::Modal content-->
	<div class="modal-content">
		<!--begin::Modal header-->
		<div class="modal-header">
			<!--begin::Modal title-->
			<h2>Edit Sub Category</h2>
			<!--end::Modal title-->
			<!--begin::Close-->
			<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
				<span class="svg-icon svg-icon-1">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
						<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>
			<!--end::Close-->
		</div>
		<!--end::Modal header-->
		<!--begin::Modal body-->
		<div class="modal-body py-lg-10 px-lg-10">
			<!--begin::Stepper-->
			<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid">
				<!--begin::Content-->
				<div class="flex-row-fluid py-lg-12 px-lg-15">
					<!--begin::Form-->
					<form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="<?php echo site_url("settings/update_sub_category") ?>/<?php echo $row[0]->id;?>" method="post" id="update_sub_category">
						<!--begin::Step 1-->
						<div class="current" data-kt-stepper-element="content">
							<div class="w-100">
								<!--begin::Input group-->
								<div class="fv-row mb-10 fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-5 fw-semibold mb-2">
										<span class="required">Sub Category</span>
										<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-lg form-control-solid mb-2" name="name" placeholder="Sub Category" value="<?php echo $row[0]->name;?>">
									<label class="required fs-6 fw-bold mb-2">Main Category</label>
									<select class="form-control form-select form-control-solid mb-3 mb-lg-0" name="main_category">
									    <?php $categories = $this->Xin_model->get_all_categories();
									    foreach($categories->result() as $r){?>
                    				    <option value="<?php echo $r->id?>" <?php if($r->id==$row[0]->main_cat_id) echo "selected";?>><?php echo $r->name?></option>
                    				    <?php }?>
                    				</select>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
						</div>
						<!--end::Step 1-->
						<!--begin::Actions-->
						<div class="d-flex flex-stack pt-10">
							<!--begin::Wrapper-->
							<div class="me-2">
								<button type="button" class="btn btn-lg btn-light-primary me-3" data-bs-dismiss="modal">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
								<span class="svg-icon svg-icon-3 me-1">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"></rect>
										<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"></path>
									</svg>
								</span>
								<!--end::Svg Icon-->Close</button>
							</div>
							<!--end::Wrapper-->
							<!--begin::Wrapper-->
							<div>
								<button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Update 
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
								<span class="svg-icon svg-icon-3 ms-1 me-0">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
										<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
									</svg>
								</span>
								<!--end::Svg Icon--></button>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Actions-->
					<div></div><div></div><div></div><div></div></form>
					<!--end::Form-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Stepper-->
		</div>
		<!--end::Modal body-->
	</div>
	<!--end::Modal content-->
		
<script type="text/javascript">
$(document).ready(function(){
	// On page load: datatable
	var xin_table_sub_category = $('#xin_table_sub_category').dataTable({
		"bDestroy": true,
		"ajax": {
            url : "<?php echo site_url("settings/sub_category_list") ?>",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	});	 

	/* Edit data */
	$("#update_sub_category").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=21&type=edit_sub_category&data=edit_sub_category&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('.save').prop('disabled', false);
				} else {
					$('.edit_setting_datail').modal('toggle');
					xin_table_sub_category.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('.save').prop('disabled', false);				
				}
			}
		});
	});
});	
</script>
<?php }else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='departments' && $_GET['type']=='departments'){
$row = $this->Xin_model->read_department_data_by_id($_GET['field_id']);
?>
<!--begin::Modal content-->
	<div class="modal-content">
		<!--begin::Modal header-->
		<div class="modal-header">
			<!--begin::Modal title-->
			<h2>Edit Category</h2>
			<!--end::Modal title-->
			<!--begin::Close-->
			<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
				<span class="svg-icon svg-icon-1">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
						<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>
			<!--end::Close-->
		</div>
		<!--end::Modal header-->
		<!--begin::Modal body-->
		<div class="modal-body py-lg-10 px-lg-10">
			<!--begin::Stepper-->
			<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid">
				<!--begin::Content-->
				<div class="flex-row-fluid py-lg-12 px-lg-15">
					<!--begin::Form-->
					<form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="<?php echo site_url("settings/update_department") ?>/<?php echo $row[0]->id;?>" method="post" id="update_department">
						<!--begin::Step 1-->
						<div class="current" data-kt-stepper-element="content">
							<div class="w-100">
								<!--begin::Input group-->
								<div class="fv-row mb-10 fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-5 fw-semibold mb-2">
										<span class="required">Department Name</span>
										<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder="Department" value="<?php echo $row[0]->name;?>">
									<!--end::Input-->
								<div class="fv-plugins-message-container invalid-feedback"><div data-field="name" data-validator="notEmpty">Department name is required</div></div></div>
								<!--end::Input group-->
							</div>
						</div>
						<!--end::Step 1-->
						<!--begin::Actions-->
						<div class="d-flex flex-stack pt-10">
							<!--begin::Wrapper-->
							<div class="me-2">
								<button type="button" class="btn btn-lg btn-light-primary me-3" data-bs-dismiss="modal">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
								<span class="svg-icon svg-icon-3 me-1">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"></rect>
										<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"></path>
									</svg>
								</span>
								<!--end::Svg Icon-->Close</button>
							</div>
							<!--end::Wrapper-->
							<!--begin::Wrapper-->
							<div>
								<button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Update 
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
								<span class="svg-icon svg-icon-3 ms-1 me-0">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
										<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
									</svg>
								</span>
								<!--end::Svg Icon--></button>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Actions-->
					<div></div><div></div><div></div><div></div></form>
					<!--end::Form-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Stepper-->
		</div>
		<!--end::Modal body-->
	</div>
	<!--end::Modal content-->
<script type="text/javascript">
$(document).ready(function(){
	// On page load: datatable
	var xin_table_departments = $('#xin_table_departments').dataTable({
		"bDestroy": true,
		"ajax": {
            url : site_url+"settings/department_list/",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	}); 

	/* Edit data */
	$("#update_department").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=21&type=edit_department&data=edit_department&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('.save').prop('disabled', false);
				} else {
					$('.edit_setting_datail').modal('toggle');
					xin_table_departments.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('.save').prop('disabled', false);				
				}
			}
		});
	});
});	
</script>

<?php }else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='cost_center' && $_GET['type']=='cost_center'){
$row = $this->Xin_model->read_cost_center_data_by_id($_GET['field_id']);
?>
<!--begin::Modal content-->
	<div class="modal-content">
		<!--begin::Modal header-->
		<div class="modal-header">
			<!--begin::Modal title-->
			<h2>Edit Cost Center</h2>
			<!--end::Modal title-->
			<!--begin::Close-->
			<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
				<span class="svg-icon svg-icon-1">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
						<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>
			<!--end::Close-->
		</div>
		<!--end::Modal header-->
		<div class="modal-body py-lg-10 px-lg-10">
			<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid">
				<div class="flex-row-fluid py-lg-12 px-lg-15">
					<form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="<?php echo site_url("settings/update_cost_center") ?>/<?php echo $row[0]->id;?>" method="post" id="update_cost_center">
						<div class="current" data-kt-stepper-element="content">
							<div class="w-100">
								<div class="fv-row mb-10 fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
									<label class="d-flex align-items-center fs-5 fw-semibold mb-2">
										<span class="required">Cost Center Name</span>
										<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
									</label>
									<input type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder="Cost Center" value="<?php echo $row[0]->name;?>">
									<br>
									<label class="d-flex align-items-center fs-5 fw-semibold mb-2">
										<span class="required">Cost Center Code</span>
										<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
									</label>
									<input type="text" class="form-control form-control-lg form-control-solid" name="export" placeholder="Cost Center" value="<?php echo $row[0]->cost_center_code;?>">
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
	// On page load: datatable
	var xin_table_cost_center = $('#xin_table_cost_center').dataTable({
		"bDestroy": true,
		//"bFilter": false,
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 30, 50, 100, -1], [5, 10, 30, 50, 100, "All"]],
		"ajax": {
            url : "<?php echo site_url("settings/cost_center_list") ?>",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	});	 

	/* Edit data */
	$("#update_cost_center").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=21&type=cost_center&data=cost_center&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('.save').prop('disabled', false);
				} else {
					$('.edit_setting_datail').modal('toggle');
					xin_table_cost_center.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('.save').prop('disabled', false);				
				}
			}
		});
	});
});	
</script>

<?php }else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='supplier' && $_GET['type']=='supplier'){
$row = $this->Xin_model->read_suppliers_data_by_id($_GET['field_id']);
?>
	<div class="modal-content">
		<div class="modal-header">
			<h2>Edit Supplier</h2>
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
				<div class="flex-row-fluid py-lg-12 px-lg-15">
					<form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="<?php echo site_url("settings/update_supplier") ?>/<?php echo $row[0]->id;?>" method="post" id="update_supplier">
						<div class="current" data-kt-stepper-element="content">
							<div class="w-100">
								<div class="fv-row mb-10 fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
									<label class="d-flex align-items-center fs-5 fw-semibold mb-2">
										<span class="required">Supplier Name</span>
										<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
									</label>
									<input type="text" class="form-control form-control-lg form-control-solid mb-2" name="name" placeholder="Supplier" value="<?php echo $row[0]->name;?>">
									
								    <input type="text" class="form-control form-control-lg form-control-solid" name="ref_no" placeholder="Ref.No" value="<?php echo $row[0]->ref_no;?>">
								</div>
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
	$("#update_supplier").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=21&type=edit_supplier&data=edit_supplier&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('.save').prop('disabled', false);
				} else {
					$('.edit_setting_datail').modal('toggle');
					xin_table_supplier.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('.save').prop('disabled', false);				
				}
			}
		});
	});
});	
</script>
<?php }else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='currency' && $_GET['type']=='currency'){
    $row = $this->Xin_model->read_currency_by_id($_GET['field_id']);
    ?>
    <!--begin::Modal content-->
    <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header">
            <!--begin::Modal title-->
            <h2>Edit Sub Category</h2>
            <!--end::Modal title-->
            <!--begin::Close-->
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                <span class="svg-icon svg-icon-1">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
						<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
					</svg>
				</span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Close-->
        </div>
        <!--end::Modal header-->
        <!--begin::Modal body-->
        <div class="modal-body py-lg-10 px-lg-10">
            <!--begin::Stepper-->
            <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid">
                <!--begin::Content-->
                <div class="flex-row-fluid py-lg-12 px-lg-15">
                    <!--begin::Form-->
                    <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="<?php echo site_url("settings/update_currency") ?>/<?php echo $row[0]->currency_id;?>" method="post" id="update_currency">
                        <!--begin::Step 1-->
                        <div class="current" data-kt-stepper-element="content">
                            <div class="w-100">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10 fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">Currency Name</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-lg form-control-solid mb-2" name="name" placeholder="Currency Name" value="<?php echo $row[0]->name;?>">

                                    <!--end::Input-->
                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">Currency Code</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-lg form-control-solid mb-2" name="code" placeholder="Currency Code" value="<?php echo $row[0]->code;?>">

                                    <!--end::Input-->
                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">Currency Symbol</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-lg form-control-solid mb-2" name="symbol" placeholder="Currency Symbol" value="<?php echo $row[0]->symbol;?>">

                                    <!--end::Input-->
                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">Decimal Point</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-lg form-control-solid mb-2" name="decimalpoint" placeholder="Decimal Point" value="<?php echo $row[0]->decimal_point;?>">

                                    <!--end::Input-->
                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">Decimal Length</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-lg form-control-solid mb-2" name="decimallength" placeholder="Decimal length" value="<?php echo $row[0]->after_decimal_length;?>">

                                    <!--end::Input-->
                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">One USD</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify your unique app name" data-kt-initialized="1"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-lg form-control-solid mb-2" name="usd" placeholder="1 USD" value="<?php echo $row[0]->one_usd;?>">

                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-10">
                            <!--begin::Wrapper-->
                            <div class="me-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3" data-bs-dismiss="modal">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                    <span class="svg-icon svg-icon-3 me-1">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"></rect>
										<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"></path>
									</svg>
								</span>
                                    <!--end::Svg Icon-->Close</button>
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Wrapper-->
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Update
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    <span class="svg-icon svg-icon-3 ms-1 me-0">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
										<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
									</svg>
								</span>
                                    <!--end::Svg Icon--></button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                        <div></div><div></div><div></div><div></div></form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->

    <script type="text/javascript">
        $(document).ready(function(){
            // On page load: datatable
            var xin_table_currency = $('#xin_table_currency').dataTable({
                "bDestroy": true,
                "ajax": {
                    url : "<?php echo site_url("settings/currency_list") ?>",
                    type : 'GET'
                },
                "fnDrawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });

            /* Edit data */
            $("#update_currency").submit(function(e){
                /*Form Submit*/
                e.preventDefault();
                var obj = $(this), action = obj.attr('name');
                $('.save').prop('disabled', true);
                $.ajax({
                    type: "POST",
                    url: e.target.action,
                    data: obj.serialize()+"&is_ajax=21&type=edit_currency&data=edit_sub_currency&form="+action,
                    cache: false,
                    success: function (JSON) {
                        if (JSON.error != '') {
                            toastr.error(JSON.error);
                            $('.save').prop('disabled', false);
                        } else {
                            $('.edit_setting_datail').modal('toggle');
                            xin_table_currency.api().ajax.reload(function(){
                                toastr.success(JSON.result);
                            }, true);
                            $('.save').prop('disabled', false);
                        }
                    }
                });
            });
        });
    </script>

<?php }?>