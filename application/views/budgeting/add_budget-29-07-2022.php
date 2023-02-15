<div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Create New Budget - IT Department</h1>
			<!--end::Title-->
		</div>
		<!--end::Page title-->
	</div>
	<!--end::Container-->
</div>
<!--end::Toolbar-->
<!--begin::Post-->

<?php
$sub_cat_array = array();
foreach($all_sub_categories->result() as $sub_categories){
    $sub_cat_array[$sub_categories->main_cat_id][$sub_categories->id] = array('id'=>$sub_categories->id, 'name'=>$sub_categories->name);
}

$main_cat_array = array();
foreach($all_categories->result() as $categories){
    $main_cat_array[$categories->id] = array('id'=>$categories->id, 'name'=>$categories->name);
}
?>
<script>
var sub_cat_json_array = '<?php echo json_encode($sub_cat_array,true); ?>';
var main_cat_json_array = '<?php echo json_encode($main_cat_array,true); ?>';
</script>
<div class="post d-flex flex-column-fluid" id="kt_post">
	<!--begin::Container-->
	<div id="kt_content_container" class="container-xxl">
		<!--begin::Card-->
		<div class="card">
			<!--begin::Card body-->
			<div class="card-body">
				<!--begin::Stepper-->
				<div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
					<!--begin::Nav-->
					<div class="stepper-nav mb-5">
						<!--begin::Step 1-->
						<div class="stepper-item current" data-kt-stepper-element="nav">
							<h3 class="stepper-title">Budget Details</h3>
						</div>
						<!--end::Step 1-->
						<!--begin::Step 2-->
						<div class="stepper-item" data-kt-stepper-element="nav">
							<h3 class="stepper-title">Select Main Categories</h3>
						</div>
						<!--end::Step 2-->
					</div>
					<!--end::Nav-->
					<!--begin::Form-->
					<form class="mx-auto mw-1000px w-100 pt-15 pb-10" id="kt_create_account_form">
						<!--begin::Step 1-->
						<div class="current" data-kt-stepper-element="content">
							<!--begin::Wrapper-->
							<div class="w-100">
								<!--begin::Heading-->
								<div class="pb-6 pb-lg-8">
									<!--begin::Title-->
									<h2 class="fw-bolder d-flex align-items-center text-dark">Budget Details (IT Department)
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Add the new budget details"></i></h2>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Input group-->
								<div class="fv-row">
									<!--begin::Row-->
									<div class="row">
										<!--begin::Input group-->
										<div class="d-flex flex-column mb-8 fv-row">
											<!--begin::Label-->
											<label class="d-flex align-items-center fs-6 fw-bold mb-2">
												<span class="required">Budget Name</span>
												<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i>
											</label>
											<!--end::Label-->
											<input type="text" class="form-control form-control-solid" placeholder="Budget Name" id="budget_name" name="budget_name" required="true"/>
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Row-->
									<div class="row g-3 mb-8">
										<!--begin::Col-->
										<div class="col-md-6 fv-row">
											<label class="required fs-6 fw-bold mb-2">From</label>
											<!--begin::Input-->
											<div class="position-relative d-flex align-items-center">
												<!--begin::Icon-->
												<!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
												<span class="svg-icon svg-icon-2 position-absolute mx-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black" />
														<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black" />
														<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--end::Icon-->
												<!--begin::Datepicker-->
												<input class="form-control form-control-solid ps-12 datepicker" placeholder="Start Date" name="start_date" />
												<!--end::Datepicker-->
											</div>
											<!--end::Input-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-md-6 fv-row">
											<label class="required fs-6 fw-bold mb-2">To</label>
											<!--begin::Input-->
											<div class="position-relative d-flex align-items-center">
												<!--begin::Icon-->
												<!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
												<span class="svg-icon svg-icon-2 position-absolute mx-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black" />
														<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black" />
														<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--end::Icon-->
												<!--begin::Datepicker-->
												<input class="form-control form-control-solid ps-12 datepicker" placeholder="End Date" name="end_date" />
												<!--end::Datepicker-->
											</div>
										</div>
										<!--end::Col-->
									</div>
									<!--begin::Input group-->
									<div class="row g-3 mb-8">
										<!--begin::Col-->
										<div class="col-md-6 fv-row">
											<label class="required fs-6 fw-bold mb-2">Allocated Amount</label>
											<input type="number" id="budget_allocated_amount" class="form-control form-control-solid" placeholder="Allocated Amount" name="amount" />
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-md-6 fv-row">
											<label class="fs-6 fw-bold mb-2">Reserved Amount</label>
											<input type="number" class="form-control form-control-solid" placeholder="Reserved Amount" name="reserved_amount" />
										</div>
										<!--end::Col-->
									</div>
									<!--end::Input group-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Step 1-->
						<!--begin::Step 2-->
						<div data-kt-stepper-element="content">
							<!--begin::Wrapper-->
							<div class="w-100">
								<!--begin::Heading-->
								<div class="pb-6 pb-lg-8">
									<!--begin::Title-->
									<h2 class="fw-bolder text-dark">Select Main Categories</h2>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Input group-->
								<div class="mb-10 fv-row">
									<div class="card-body p-0" data-select2-id="select2-data-136-vp2d">
										<!--begin::Input group-->
										<div class="" data-kt-ecommerce-catalog-add-product="auto-options" data-select2-id="select2-data-135-iq88">
											<!--begin::Label-->
											<label class="form-label">Add Main Categories</label>
											<!--end::Label-->
											<!--begin::Repeater-->
											<div id="kt_ecommerce_add_product_options" data-select2-id="select2-data-kt_ecommerce_add_product_options">
												<!--begin::Form group-->
												<div class="form-group" data-select2-id="select2-data-134-mrjd" id="main_category_list_div">
													<div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3" data-select2-id="select2-data-133-fmy1">
														<div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5" data-select2-id="select2-data-132-a5tz">
															<!--begin::Select2-->
															<div class="w-100 w-md-200px">
																<select name="main_category[]" class="form-select form-select-lg form-select-solid select_main_cat_dropdown_list" data-placeholder="Select Categories" data-allow-clear="true" data-hide-search="true">
																	<option></option>
																	<?php
																	foreach($all_categories->result() as $categories){
																	    echo '<option value="'.$categories->id.'">'.$categories->name.'</option>';
																	}
																	?>
																</select>
																<!--end::Input-->
															</div>
															<!--end::Select2-->
															<!--begin::Input-->
															<input type="number" class="form-control mw-100 w-200px main_category_budget_keyup" name="main_category_budget[]" placeholder="Budget">
															<!--end::Input-->
															<div class="w-100 w-md-200px">
																<!--begin::Input-->
																<select class="form-select form-select-solid" data-hide-search="true" data-placeholder="Select..." name="assigned_employee[]">
																	<option>Assign...</option>
																	<?php
																	foreach($all_employees->result() as $employees){
																	    echo '<option value="'.$employees->user_id.'">'.$employees->first_name.' '.$employees->last_name.'</option>';
																	}
																	?>
																</select>
															</div>
															<!--end::Input-->
															<button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger delete_main_category_btn">
																<!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
																<span class="svg-icon svg-icon-1">
																	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"></rect>
																		<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"></rect>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</button>
															<span class="h-20px border-gray-200 border-start mx-4"></span>
															<div class="rounded min-w-125px py-3 px-4 me-6 mb-3">
															<div class="fw-bold fs-6 text-gray-400">Available Balance</div>
															<!--begin::Number-->
															<div class="d-flex align-items-center">
															<div class="fs-4 fw-bolder text-primary main_cat_avail_bal">0.00</div>
															</div>
															<!--end::Number-->
															</div>
														</div>
													</div>
												</div>
												<!--end::Form group-->
												<!--begin::Form group-->
												<div class="form-group mt-5">
													<button type="button" id="add_main_category_btn" data-repeater-create="" class="btn btn-sm btn-light-primary">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
															<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
														</svg>
													</span>
													<!--end::Svg Icon-->Add another category</button>
												</div>
												<!--end::Form group-->
											</div>
											<!--end::Repeater-->
										</div>
										<!--end::Input group-->
									</div>
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Step 2-->
						
						<!--begin::Actions-->
						<div class="d-flex flex-stack pt-5">
							<!--begin::Wrapper-->
							<div class="mr-2">
								<button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
								<span class="svg-icon svg-icon-4 me-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
										<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon-->Back</button>
							</div>
							<!--end::Wrapper-->
							<!--begin::Wrapper-->
							<div>
								<button type="submit" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
									<span class="indicator-label">Submit
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
									<span class="svg-icon svg-icon-3 ms-2 me-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
											<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
										</svg>
									</span>
									<!--end::Svg Icon--></span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
								<span class="svg-icon svg-icon-4 ms-1 me-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
										<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></button>
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Actions-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Stepper-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Container-->
</div>