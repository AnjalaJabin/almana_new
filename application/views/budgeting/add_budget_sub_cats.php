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


<div class="post d-flex flex-column-fluid" id="kt_post">
	<!--begin::Container-->
	<div id="kt_content_container" class="container-xxl">
		<!--begin::Card-->
		<div class="card">
			<!--begin::Card body-->
			<div class="card-body">
				<!--begin::Form-->
				<form class="mx-auto mw-1000px w-100 pt-15 pb-10" novalidate="novalidate" id="kt_create_account_form">
				    <input type="hidden" name="budget_id" value="<?php echo $budget_id; ?>"/>
					<!--begin::Step 3-->
					<div class="current">
						<!--begin::Wrapper-->
						<div class="w-100">
							<!--begin::Heading-->
							<div class="pb-6 pb-lg-8">
								<!--begin::Title-->
								<h2 class="fw-bolder text-dark">Add Sub Categories</h2>
								<!--end::Title-->
							</div>
							<!--end::Heading-->
							
							<?php
							foreach($assigned_budget_category->result() as $assigned_budget_category_data)
							{
							    $category_name = $this->Xin_model->read_category_data_by_id($assigned_budget_category_data->category_id);
							    if(isset($category_name[0]->name)){
							        $category_name = $category_name[0]->name;
							    }else{
							        $category_name = '--';
							    }
							?>
							
							<!--begin::Input group-->
							<div class="mb-10 fv-row">
								<div class="card-body p-0" data-select2-id="select2-data-136-vp2d">
									<!--begin::Card-->
									<div class="card badge-light border">
										<!--begin::Card header-->
										<div class="card-header">
											<!--begin::Card header-->
											<div class="card-title fs-3 fw-bolder"> <?php echo $category_name; ?> </div>
											<!--end::Card header-->
											<div class="card-toolbar">
												<div class="border border-success border-solid rounded min-w-125px py-3 px-4 ms-6">
													<div class="fw-bold fs-6 text-gray-400"></div>
													<!--begin::Number-->
													<input type="hidden" class="main_assigned_budget" value="<?php echo $assigned_budget_category_data->amount; ?>">
													<div class="d-flex align-items-center">
														<div class="fs-4 fw-bolder text-success">Total Budget: <?php echo number_format($assigned_budget_category_data->amount); ?></div>
													</div>
													<!--end::Number-->
												</div>
											</div>
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body bg-white">
											<!--begin::Repeater-->
											<div id="kt_ecommerce_add_product_options" data-select2-id="select2-data-kt_ecommerce_add_product_options">
												<!--begin::Form group-->
												<div class="form-group sub_category_list_div" data-select2-id="select2-data-134-mrjd">
													<div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3" data-select2-id="select2-data-133-fmy1">
														<div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5 pt-2 pb-2" data-select2-id="select2-data-132-a5tz">
															<!--begin::Select2-->
															<div class="w-100 w-md-200px">
																<select name="sub_category[]" class="form-select form-select-lg form-select-solid" data-placeholder="Select Sub Categories" data-allow-clear="true" data-hide-search="true">
																<option></option>
																<?php
																$sub_cat_data = $this->Xin_model->get_sub_categories_by_main_cat($assigned_budget_category_data->category_id);
																foreach($sub_cat_data->result() as $sub_categories){
																    echo '<option value="'.$sub_categories->id.'">'.$sub_categories->name.'</option>';
																}
																?>
																</select>
																<!--end::Input-->
															</div>
															<!--end::Select2-->
															<input type="hidden" name="main_category_id[]" value="<?php echo $assigned_budget_category_data->category_id; ?>"/>
															<!--begin::Input-->
															<input type="number" class="form-control mw-100 w-200px main_category_budget_keyup" name="sub_cat_amount[]" placeholder="Budget">
															<!--end::Input-->
															<div class="w-100 w-md-200px">
																<!--begin::Input-->
																<select class="form-select form-select-solid" data-hide-search="true" data-placeholder="Select..." name="employee_id[]">
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
															<span class="h-20px mx-4"></span>
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
													<button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary add_sub_category_btn">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
															<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
														</svg>
													</span>
													<!--end::Svg Icon-->Add another sub category</button>
												</div>
												<!--end::Form group-->
												<input type="hidden" class="sub_category_list_div_html"/>
												
											</div>
											<!--end::Repeater-->
										</div>
									</div>
								</div>
							</div>
							<!--end::Input group-->
							
							<?php
							}
							?>
							
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Step 3-->
					
					<!--begin::Actions-->
					<div class="d-flex flex-stack pt-5">
						<!--begin::Wrapper-->
						<div style="width:100%;" align="right">
							<button type="submit" class="btn btn-lg btn-primary me-3">
								<span class="indicator-label">Submit
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
								<span class="svg-icon svg-icon-3 ms-2 me-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
										<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon--></span>
							</button>
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Actions-->
				</form>
				<!--end::Form-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Container-->
</div>