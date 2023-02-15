<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    #container {
        height: 400px;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

</style>
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
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
		<!--begin::Row-->
		<div class="row gy-5 g-xl-8 mb-7">
			<!--begin::Col-->
			<div class="col-xl-4">
				<!--begin::Card-->
				<div class="card h-100 bg-gradiant-yellow text-white" style="background: linear-gradient(89.11deg, #FE8F25 -1.25%, #FFC83F 99.35%);">
					<!--begin::Card body-->
					<div class="card-body p-9">
						<!--begin::Heading-->
						<div class="fs-2hx fw-bolder"><?php echo $expense_counts; ?></div>
						<div class="fs-4 fw-bold text-white-200 mb-7">Current Expeses</div>
						<!--end::Heading-->
						<!--begin::Wrapper-->
						<div class="d-flex flex-wrap">
							<!--begin::Labels-->
							<div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
								<!--begin::Label-->
								<div class="d-flex fs-6 fw-bold align-items-center mb-3">
									<div class="bullet bg-primary me-3"></div>
									<div class="text-white-400">Budget Expenses</div>
									<div class="ms-auto fw-bolder text-white-700"><?php echo $budget_expense_counts; ?></div>
								</div>
								<!--end::Label-->
								<!--begin::Label-->
								<div class="d-flex fs-6 fw-bold align-items-center mb-3">
									<div class="bullet bg-success me-3"></div>
									<div class="text-white-400">Direct Expenses</div>
									<div class="ms-auto fw-bolder text-white-700"><?php echo $direct_expense_counts; ?></div>
								</div>
								<!--end::Label-->
								<!--begin::Label-->
								<div class="d-flex fs-6 fw-bold align-items-center">
									<div class="bullet bg-gray-300 me-3"></div>
									<div class="text-white-400">My Expenses</div>
									<div class="ms-auto fw-bolder text-white-700"><?php echo $my_expense_counts; ?></div>
								</div>
								<!--end::Label-->
							</div>
							<!--end::Labels-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-xl-4">
				<!--begin::Budget-->
				<div class="card h-100 text-white" style="background: linear-gradient(90.13deg, #39B359 0.1%, #ACD449 102.55%);">
					<div class="card-body p-9">
						<div class="fs-2hx fw-bolder">AED <?php echo number_format($total_budget_amount,2); ?></div>
						<div class="fs-4 fw-bold text-white-400 mb-7">Project Budget <?php echo date('Y'); ?></div>
						<div class="fs-6 d-flex justify-content-between mb-4">
							<div class="fw-bold">Total Expenses</div>
							<div class="d-flex fw-bolder">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr007.svg-->
							<span class="svg-icon svg-icon-3 me-1 svg-icon-dark">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z" fill="black" />
									<path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->AED <?php echo number_format($total_expense,2); ?></div>
						</div>
						<div class="separator separator-dashed"></div>
						<div class="fs-6 d-flex justify-content-between my-4">
							<div class="fw-bold">Budgets Expenses</div>
							<div class="d-flex fw-bolder">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr006.svg-->
							<span class="svg-icon svg-icon-3 me-1 svg-icon-danger">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M13.4 14.8L5.3 6.69999C4.9 6.29999 4.9 5.7 5.3 5.3C5.7 4.9 6.29999 4.9 6.69999 5.3L14.8 13.4L13.4 14.8Z" fill="black" />
									<path opacity="0.3" d="M19.8 8.5L8.5 19.8H18.8C19.4 19.8 19.8 19.4 19.8 18.8V8.5Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->AED <?php echo number_format($total_bud_exp,2); ?></div>
						</div>
						<div class="separator separator-dashed"></div>
						<div class="fs-6 d-flex justify-content-between mt-4">
							<div class="fw-bold">Direct Expenses</div>
							<div class="d-flex fw-bolder">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr007.svg-->
							<span class="svg-icon svg-icon-3 me-1 svg-icon-dark">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z" fill="black" />
									<path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->AED <?php echo number_format($total_dir_exp,2); ?></div>
						</div>
					</div>
				</div>
				<!--end::Budget-->
			</div>
			<!--end::Col-->
			<div class="col-xl-4">
				<!--begin::Clients-->
				<div class="card h-100 text-white" style="background: linear-gradient(90.13deg, #1FA2FF 0.1%, #21DEFF 102.55%);">
					<div class="card-body p-9">
						<!--begin::Heading-->
						<div class="fs-2hx fw-bolder"><?php echo $employee_count; ?></div>
						<div class="fs-4 fw-bold text-white-400 mb-7">Employees</div>
						<!--end::Heading-->
						<!--begin::Users group-->
						<div class="symbol-group symbol-hover mb-9">
                            <?php
                            $key =0;
                            foreach ($all_employees as $employee)
                            {
                                $key++;
                                ?>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?php echo $employee->first_name.$employee->last_name?>">
                                    <img alt="Pic" src="<?php
                                    if($employee->profile_picture){echo base_url()."uploads/profile/" . $employee->profile_picture;}else{
                                        echo base_url()."assets/media/avatars/blank.png";
                                    }?>" />
							</div>

                                <?php
                                if($key==10){
                                    break;
                                }
                            }
                            if($employee_count>10){?>

							<a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bolder">+<?php echo $employee_count-10?></span>
							</a>
                            <?php }
?>
						</div>
						<!--end::Users group-->
						<!--begin::Actions-->
						<div class="d-flex">
							<a href="<?php echo site_url('employees'); ?>" class="btn btn-secondary btn-sm me-3">All Employees</a>
						</div>
						<!--end::Actions-->
					</div>
				</div>
				<!--end::Clients-->
			</div>
		</div>
		<!--end::Row-->
		
		<!--begin::Row-->
		<div class="row g-5 g-xl-8">
			<!--begin::Col-->
			<div class="col-xl-4">
				<!--begin::Mixed Widget 5-->
				<div class="card card-xxl-stretch mb-xl-8">
					<!--begin::Beader-->
					<div class="card-header border-0 py-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder fs-3 mb-1">Expense Graph</span>

						</h3>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body d-flex flex-column">
						<!--begin::Chart-->

						<!--end::Chart-->
						<!--begin::Items-->
						<div class="mt-5">
							<!--begin::Item-->
                            <div class="card-block text-center">
                                <div id="container_chart" style="width: 100%; height: 300px"></div>
                            </div>
						</div>
						<!--end::Items-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Mixed Widget 5-->
			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-xl-8">
				<!--begin::Tables Widget 5-->
				<div class="card card-xxl-stretch mb-5 mb-xl-8">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder fs-3 mb-1">Latest Expense Records</span>
							<span class="text-muted mt-1 fw-bold fs-7">All expense records in department</span>
						</h3>
						<div class="card-toolbar">
<!--							<ul class="nav">-->
<!--								<li class="nav-item">-->
<!--									<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">Month</a>-->
<!--								</li>-->
<!--								<li class="nav-item">-->
<!--									<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">Week</a>-->
<!--								</li>-->
<!--								<li class="nav-item">-->
<!--									<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">Day</a>-->
<!--								</li>-->
<!--							</ul>-->
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body py-3">
						<div class="tab-content">
							<!--begin::Tap pane-->
							<div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
								<!--begin::Table container-->
								<div class="table-responsive">
									<!--begin::Table-->
									<table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
										<!--begin::Table head-->
										<thead>
											<tr class="border-0">
												<th class="p-0 min-w-150px"></th>
												<th class="p-0 min-w-140px"></th>
												<th class="p-0 min-w-110px"></th>
												<th class="p-0 min-w-110px"></th>
												<th class="p-0 min-w-50px"></th>
											</tr>
										</thead>
										<!--end::Table head-->
										<!--begin::Table body-->
										<tbody>
										    <?php
                                            $k=0;
										    foreach($all_expenses->result() as $expense_data)
										    {
										        if($expense_data->budget_id>0){
										            $exp_view_url = site_url('budgeting/budget_details/'.$expense_data->budget_id);
										        }else{
										            $exp_view_url = site_url('budgeting/direct_expense');
										        }
                                                $k++;
										        $sub_category_name = $this->Xin_model->read_sub_category_data_by_id($expense_data->sub_category);
                            				    if(isset($sub_category_name[0]->name)){
                            				        $sub_category_name = $sub_category_name[0]->name;
                            				    }else{
                            				        $sub_category_name = '--';
                            				    }
										    ?>
											<tr>
												<td>
													<a href="<?php echo $exp_view_url; ?>" class="text-dark fw-bolder text-hover-primary mb-1 fs-6"><?php echo $sub_category_name; ?></a>
												</td>
												<td class="text-end text-muted fw-bold"><?php echo $dept_name;?></td>
												<td class="text-end text-muted fw-bold">AED <?php echo number_format($expense_data->initial_amount); ?></td>
												<td class="text-end">
													<span class="badge badge-light-success">Approved</span>
												</td>
												<td class="text-end">
													<a href="<?php echo $exp_view_url; ?>" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
														<span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
																<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
												</td>
											</tr>
											<?php
                                                if($k==9){
                                                    break;
                                                }
										    }
											?>
										</tbody>
										<!--end::Table body-->
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
						</div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Tables Widget 5-->
			</div>
			<!--end::Col-->
		</div>
		<!--end::Row-->

	</div>
	<!--end::Container-->
</div>
<!--end::Post-->
