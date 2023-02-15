<?php
$grand_tot = 0;
$query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."'");
foreach($query->result() as $expense_data){
    $grand_tot=$grand_tot+$expense_data->amount;
}
?>
<div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add New Expense</h1>
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
		<div class="row g-2 g-xl-3">
			<div class="col-lg-12">
				<!--begin::Navbar-->
				<div class="card mb-6 mb-xl-6">
					<div class="card-body pt-6 pb-0">
						<div class="row">
							<!--begin::Details-->
							<div class="col-md-6 align-middle">
								<!--begin::Wrapper-->
								<div class="flex-grow-1">
									<!--begin::Head-->
									<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
										<!--begin::Details-->
										<div class="d-flex flex-column">
											<!--begin::Status-->
											<div class="d-flex align-items-center mb-1">
												<a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3"><?php echo $budget_details_info[0]->budget_name."(".$budget_details_info[0]->currency.")"; ?> </a>
												<span class="badge badge-light-success me-auto">In Progress</span>
											</div>
											<!--end::Status-->
											<!--begin::Description-->
											<div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">Budget Description Add Here</div>
											<!--end::Description-->
										</div>
										<!--end::Details-->
									</div>
									<!--end::Head-->
									<!--begin::Info-->
									<div class="d-flex flex-wrap align-middle">
										<!--begin::Stats-->
										<div class="d-flex flex-wrap">
											<!--begin::Stat-->
											<div class="border border-primary border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
												<!--begin::Number-->
												<div class="d-flex align-items-center">
													<div class="fs-4 fw-bolder text-primary"><?php echo number_format($budget_details_info[0]->amount,2); ?></div>
												</div>
												<!--end::Number-->
												<!--begin::Label-->
												<div class="fw-bold fs-6 text-gray-400">Approved Budget</div>
												<!--end::Label-->
											</div>
											<!--end::Stat-->
											<!--begin::Stat-->
											<div class="border border-warning border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
												<!--begin::Number-->
												<div class="d-flex align-items-center">
													<div class="fs-4 fw-bolder text-warning"><?php echo number_format($grand_tot,2); ?></div>
												</div>
												<!--end::Number-->
												<!--begin::Label-->
												<div class="fw-bold fs-6 text-gray-400">Total Expenses</div>
												<!--end::Label-->
											</div>
											<!--end::Stat-->
											<!--begin::Stat-->
											
											<div class="border border-success border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
												<!--begin::Number-->
												<div class="d-flex align-items-center">
													<div class="fs-4 fw-bolder text-success"><?php echo number_format($budget_details_info[0]->amount-$grand_tot,2); ?></div>
												</div>
												<!--end::Number-->
												<!--begin::Label-->
												<div class="fw-bold fs-6 text-gray-400">Available Budget</div>
												<!--end::Label-->
											</div>
											<!--end::Stat-->
										</div>
										<!--end::Stats-->
									</div>
									<!--end::Info-->
								</div>
								<!--end::Wrapper-->
								<div class="separator mb-4 mt-4"></div>

							</div>
							<div class="col-md-6">
								<table class="table table-row-dashed table-row-gray-300 align-middle">
									<!--begin::Table head-->
									<thead>
										<tr class="fw-bolder text-muted ">
											<th class="">Category Spend</th>
											<th class="text-end">Approved Budget</th>
											<th class="text-end"> Expenses</th>
											<th class="text-end">Balance</th>
										</tr>
									</thead>
									<!--end::Table head-->
									<!--begin::Table body-->
									<tbody>
									    <?php
									    $total_budget = 0;
									    $total_expense = 0;
            							foreach($assigned_budget_category->result() as $assigned_budget_category_data)
            							{
            							    $category_name = $this->Xin_model->read_category_data_by_id($assigned_budget_category_data->category_id);
            							    if(isset($category_name[0]->name)){
            							        $category_name = $category_name[0]->name;
            							    }else{
            							        $category_name = '--';
            							    }
            							    $total_budget = $total_budget+$assigned_budget_category_data->amount;
            							    
            							    $cat_total = 0;
                                    	    $query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `main_category_id`='".$assigned_budget_category_data->category_id."'");
                                    	    foreach($query->result() as $expense_data){
                                    	        $cat_total=$cat_total+$expense_data->amount;
                                    	    }
                                    	    
                                    	    $total_expense=$total_expense+$cat_total;
            							?>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<div class="d-flex justify-content-start flex-column">
														<a href="#" class="text-dark text-hover-primary mb-1 fs-6"><?php echo $category_name; ?></a>
													</div>
												</div>
											</td>
											<td>
												<a href="#" class="text-end text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo number_format($assigned_budget_category_data->amount,2); ?></a>
											</td>
											<td>
												<a href="#" class="text-end text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo number_format($cat_total,2); ?></a>
											</td>
											<td>
												<a href="#" class="text-end text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo number_format($assigned_budget_category_data->amount-$cat_total,2); ?></a>
											</td>
										</tr>
										<?php
            							}
										?>
									</tbody>
									<tfoot class="bg-light">
									<tr class="px-3">
										<th class="text-dark fw-bolder fs-4 px-3">Total :</th>
										<td class="text-end fw-bolder text-primary fs-4"><?php echo number_format($total_budget,2); ?></td>
										<td class="text-end fw-bolder text-warning fs-4"><?php echo number_format($total_expense,2); ?></td>
										<td class="text-end fw-bolder text-success fs-4"><?php echo number_format(($total_budget-$total_expense),2); ?></td>
									</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!--end::Navbar-->
			</div>
		</div>
		<!--begin::Row-->
		<div class="row g-6 g-xl-9">
			<!--begin::Col-->
			<div class="col-lg-12">
				<div class="card card-flush p-8">
					<!--begin:Form-->
					<form id="add_expense_form" class="form" action="#">
						<!--begin::Heading-->
						<div class="mb-5 text-left">
						    <input type="hidden" name="budget_id" id="budget_id" value="<?php echo $budget_id; ?>"/>
                            <input type="hidden" name="budget_currency" id="budget_currency" value="<?php echo $budget_details_info[0]->currency; ?>"/>

                            <input type="hidden" name="exp_amount" id="exp_amount" value=""/>

                            <!--begin::Title-->
							<h3 class="mb-3">Add New Expense Record</h3>
							<!--end::Title-->
						</div>
						<!--end::Heading-->
						<!--begin::Input group-->
						<div class="d-flex flex-column mb-8 fv-row" style="display:none !important;">
							<!--begin::Label-->
							<label class="d-flex align-items-center fs-7 mb-2 text-gray-600">
								<span class="required">Expense Title</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-solid" placeholder="Expense Title" name="expense_title" />
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row g-3 mb-3">
                            <div class="col-md-2 fv-row">
                                <label class="required fs-7 mb-2 text-gray-600">Entity</label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Company" id="company" name="company">
                                    <option value="">Select Entity...</option>
                                    <?php

                                    $comp_data = $this->Xin_model->get_companies();
                                    foreach($comp_data->result() as $company) {?>
                                        <option value="<?php echo $company->id?>"><?php echo $company->name?></option>
                                    <?php  }
                                    ?>
                                </select>
                            </div>
							<!--begin::Col-->
							<div class="col-md-2 fv-row">
								<label class="required fs-7 mb-2 text-gray-600">Date</label>
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
									<input class="form-control form-control-solid ps-12 datepicker" placeholder="Select a date" name="date" value="<?php echo date('d-m-Y');?>"/>
									<!--end::Datepicker-->
								</div>
								<!--end::Input-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->

							<div class="col-md-4 fv-row">

                                    <label class="fs-7 mb-2 text-gray-600">  Description  </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Description" name="remarks" />

                                <!--end::Col-->

							</div>
							<!--end::Col-->
							<!--begin::Col-->
							
							<div class="col-md-4 fv-row">
                                <label class="required fs-7 mb-2 text-gray-600">Budget Line</label>
                                <select class="form-select form-select-solid" data-control="select2" id="sub_category_change" data-hide-search="true" data-placeholder="Select Categories" name="sub_category_id">
                                    <option value="">Select Categories...</option>
                                    <?php
                                    foreach($all_sub_categories->result() as $sub_categories){
                                        echo '<option data-main_cat_id="'.$sub_categories->main_cat_id.'" value="'.$sub_categories->id.'">'.$sub_categories->name.'</option>';
                                    }
                                    ?>
                                </select>

							</div>
							<!--end::Col-->
						</div>
						<div class="row g-3 mb-3">
							<!--begin::Col-->
							<input type="hidden" id="selected_main_cat_id" name="selected_main_cat_id"/>
							<div class="col-md-4 fv-row">
								<label class="fs-7 mb-2 text-gray-600">Category</label>
								<input type="text" readonly class="form-control form-control-solid" placeholder="Budget Line" id="budget_line_text" />
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-md-4 fv-row">
                                <label class="fs-7 mb-2 text-gray-600">Cost Center</label>
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select Cost Center" name="cost_center">
                                    <option value="">Select Cost Center...</option>
                                    <?php
                                    foreach($all_cost_centers->result() as $cost_centers){
                                        echo '<option value="'.$cost_centers->id.'">'.$cost_centers->name.'</option>';
                                    }
                                    ?>
                                </select>

							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-md-4 fv-row">
                                <label class="required fs-7 mb-2 text-gray-600">Vendor/Supplier</label>
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="Vendor/Supplier" name="supplier_id">
                                    <option value="">Select Supplier...</option>
                                    <?php
                                    foreach($all_suppliers->result() as $suppliers){
                                        echo '<option value="'.$suppliers->id.'">'.$suppliers->name.'</option>';
                                    }
                                    ?>
                                </select>

							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<div class="row g-3 mb-3">
							<!--begin::Col-->
							<div class="col-md-4 fv-row">
                                <label class="required fs-7 mb-2 text-gray-600">Supplier Ref No</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Supplier Ref No" name="supplier_ref" />

							</div>
                            <div class="col-md-2 fv-row">
                                <label class="required fs-7 mb-2 text-gray-600"> Amount </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Amount" id="current_expense_amount" name="amount" />

                            </div>

                            <!--end::Col-->
                            <div class="col-md-2 fv-row">
                                <label class="required fs-7 mb-2 text-gray-600">Currency</label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Currency" id="currency" name="currency">
                                    <option value="">Select Currency...</option>
                                    <?php
                                    $default_currency  = $this->Xin_model->get_default_currency();

                                    $currency_data = $this->Xin_model->get_currencies(1);
                                    foreach($currency_data->result() as $currencies) {?>
                                        <option value="<?php echo $currencies->code?>"<?php if($default_currency[0]->default_currency_symbol==$currencies->code) echo 'selected';?>><?php echo $currencies->code?></option>
                                    <?php  }
                                    ?>
                                </select>

                            </div>

                            <!--begin::Col-->
							<div class="col-md-4 fv-row">
                                <label class="required fs-7 mb-2 text-gray-600">Tax</label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Tax" id="tax" name="tax">
                                    <option value="">Select Tax...</option>
                                    <?php

                                    $tax_data = $this->Xin_model->get_taxes();
                                    foreach($tax_data->result() as $tax) {?>
                                        <option value="<?php echo $tax->tax_code?>"><?php echo $tax->tax_code."   -  ".$tax->name?></option>
                                    <?php  }
                                    ?>
                                </select>
								</div>
							<!--end::Col-->

						</div>
						<!--end::Input group-->
						<!--Start::Input group-->
						<div class="row g-3 mb-3">
							<!--begin::Col-->
							<div class="col-md-2 fv-row">
								<label class="fs-7 mb-2 text-gray-600">  Available Budget  </label>
								<input type="text" class="form-control form-control-solid" placeholder=" Available Budget " id="total_available_budget" style="color: green; font-size: 16px; font-weight: bold;"/>
							</div>
                            <!--begin::Col-->
                            <div class="col-md-2 fv-row">
                                <label class="fs-7 mb-2 text-gray-600">  Budget Run.Tot  </label>
                                <input type="text" readonly class="form-control form-control-solid" id="total_amount_used_in_this_main_cat" placeholder=" Budget Run.Tot " style="color:green;"/>

                            </div>
                            <!--end::Col-->
                            <div class="col-md-4 fv-row">
                            <label class="fs-7 mb-2 text-gray-600">  Running Total  </label>
                            <input type="text" readonly class="form-control form-control-solid" id="total_amount_used_in_this_budget" placeholder=" Running Total "  style="color:orange;"/>
                        </div>
							<!--end::Col-->

							<!--begin::Col-->
							<div class="col-md-4 fv-row">
								<label class="fs-7 mb-2 text-gray-600">  File  </label>
								<input type="file" class="form-control form-control-solid" placeholder="Status" name="file" accept=".pdf"  />
                                <div class="form-text">Allowed file types: pdf</div>

                            </div>
							<!--end::Col-->
						</div>
						<div>
						<!-----<div class="col-md-4 fv-row">
								<label class="fs-7 mb-2 text-gray-600">Employees</label>
								<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select employee" name="emp_id">
									<option value="">Select employee...</option>
									<?php/*
									foreach($all_employees->result() as $employees){
									    echo '<option value="'.$employees->user_id.'">'.$employees->first_name.'</option>';
									}
								*/?>
                                </select>
							</div>---->
								</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="d-flex flex-column mb-5">
							<label class="fs-7 mb-2 text-gray-600">Detailed Description</label>
							<textarea class="form-control form-control-solid" rows="3" name="expense_description" placeholder="Free field to describe the description of the expense"></textarea>
						</div>
						<!--end::Input group-->
						<!--begin::Actions-->
						<div class="text-center">
							<button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
							<button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
								<span class="indicator-label">Submit</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
						</div>
						<!--end::Actions-->
					</form>
					<!--end:Form-->
				</div>
			</div>
			<!--end::Col-->
		</div>
		<!--end::Row-->
	</div>
	<!--end::Container-->
</div>