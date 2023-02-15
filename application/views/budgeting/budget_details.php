<?php

$role_resources_ids = $this->Xin_model->user_role_resource();
$session = $this->session->userdata('username');
$all_expenses_count = $all_expenses->num_rows();
$grand_tot = 0;
$query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."'");
foreach($query->result() as $expense_data){
    $grand_tot=$grand_tot+$expense_data->amount;
}
$req_tot = 0;
$query_1 = $this->db->query("SELECT * FROM `requests` WHERE `budget_id`='".$budget_id."'");
foreach($query_1->result() as $req_data){
    $req_tot=$req_tot+$req_data->requested_amount;
}
?>
<div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">IT Department Budget</h1>
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
	<div id="kt_content_container" class="container-fluid">
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
												<input id="budget_id" value="<?php echo $budget_id?>" type="hidden">
												<a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3"><?php echo $budget_details_info[0]->budget_name.' ('.$budget_details_info[0]->currency.')'; ?></a>
												<span class="badge badge-light-success me-auto">In Progress</span>
											</div>
											<!--end::Status-->
											<!--begin::Description-->
											<div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400"><?php echo date('d-m-Y',strtotime($budget_details_info[0]->date_from)).' - '.date('d-m-Y',strtotime($budget_details_info[0]->date_to)); ?></div>
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
								<div class="d-flex mb-4 mt-4">
                                    <a target="blank" href="<?php echo site_url('budgeting/print_expense_sheet/'.$budget_id.'/0'); ?>" class="btn btn-sm btn-bg-light btn-active-color-primary me-3 pt-4">Export Report</a>

                                    <?php if(in_array('33',$role_resources_ids)) {?>
									<a href="<?php echo site_url('budgeting/add_expense/'.$budget_details_info[0]->id); ?>" class="btn btn-sm btn-primary me-3 pt-4">Add Expense</a>
                                   <?php }
//                                    if (in_array('34', $role_resources_ids)){
//                                    ?><!-- <a href="--><?php //echo site_url('request/add_request/'.$budget_details_info[0]->id); ?><!--" class="btn btn-sm btn-primary me-3">Add Request</a>-->
<!---->
<!---->
<!--									--><?php
//                                    }
                                    if(!empty($budget_details_info[0]->budget_document)){
									    ?>
									    <a class="symbol symbol-20px mt-3 mb-3" target="blank" href="<?php echo site_url('uploads/budget_files/'.$budget_details_info[0]->budget_document); ?>"><i class="fa fa-file"></i> View Uploaded Document</a>
    									<?php
									}
									?>
								</div>
							</div>
							<div class="col-md-6">
                                <?php if(in_array('35',$role_resources_ids)) {?>
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
									    <?php }
									    $total_budget = 0;
									    $total_expense = 0;
									    $category_total_array = array();
            							foreach($assigned_budget_category->result() as $assigned_budget_category_data)
            							{
            							    $category_name = $this->Xin_model->read_category_data_by_id($assigned_budget_category_data->category_id);
            							    if(isset($category_name[0]->name)){
            							        $category_name = $category_name[0]->name;
            							    }else{
            							        $category_name = '--';
            							    }
            							    $total_budget = $total_budget+$assigned_budget_category_data->amount;
            							    $category_total_array[] = array('cat_name' => $category_name, 'amount' => $assigned_budget_category_data->amount);
            							    
            							    $cat_total = 0;
                                    	    $query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `main_category_id`='".$assigned_budget_category_data->category_id."'");
                                    	    foreach($query->result() as $expense_data){
                                    	        $cat_total=$cat_total+$expense_data->amount;
                                    	    }
                                    	    
                                    	    $total_expense=$total_expense+$cat_total;
                                        if (in_array('35', $role_resources_ids)) { ?>

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
            							} }
                                        if (in_array('35', $role_resources_ids)) { ?>
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
                                <?php  } ?>
							</div>
						</div>
					</div>
				</div>
				<!--end::Navbar-->
			</div>
		</div>
		
		<?php
	    /*
	    ?>
		    
		<!--begin::Row-->
		<div class="row g-6 g-xl-6">
		    
			<!--begin::Col-->
			<div class="col-lg-6">
				<!--begin::Summary-->
				<div class="card card-flush">
					<!--begin::Card header-->
					<div class="card-header mt-6">
						<!--begin::Card title-->
						<div class="card-title flex-column">
							<h3 class="fw-bolder mb-1">Expense Summary</h3>
							<!--<div class="fs-6 fw-bold text-gray-400">25 Un-Approved Requestes</div>-->
						</div>
						<!--end::Card title-->
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body p-9 pt-5">
						<!--begin::Wrapper-->
						<div class="d-flex flex-wrap">
							<!--begin::Chart-->
							<div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
								<div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
									<span class="fs-2qx fw-bolder"><?php echo $all_expenses_count; ?></span>
									<span class="fs-6 fw-bold text-gray-400">Expenses</span>
								</div>
								<canvas id="project_overview_chart"></canvas>
							</div>
							<!--end::Chart-->
							<!--begin::Labels-->
							<div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
								<!--begin::Label-->
								<div class="d-flex fs-6 fw-bold align-items-center mb-3">
									<div class="bullet bg-primary me-3"></div>
									<div class="text-gray-400">Approved Budget</div>
									<div class="ms-auto fw-bolder text-gray-700">AED <?php echo number_format($total_budget); ?></div>
								</div>
								<!--end::Label-->
								<!--begin::Label-->
								<div class="d-flex fs-6 fw-bold align-items-center mb-3">
									<div class="bullet bg-success me-3"></div>
									<div class="text-gray-400">Budget Consumed</div>
									<div class="ms-auto fw-bolder text-gray-700">AED <?php echo number_format($total_expense); ?></div>
								</div>
								<!--end::Label-->
								<!--begin::Label-->
								<div class="d-flex fs-6 fw-bold align-items-center mb-3">
									<div class="bullet bg-success me-3"></div>
									<div class="text-gray-400">Available Budget</div>
									<div class="ms-auto fw-bolder text-gray-700">AED <?php echo number_format($total_budget-$total_expense); ?></div>
								</div>
								<!--end::Label-->
								<!--end::Label-->
							</div>
							<!--end::Labels-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Summary-->
			</div>
			<!--end::Col-->
			
			
			
			<!--begin::Col-->
			<div class="col-lg-6">
				<!--begin::Graph-->
				<div class="card card-flush h-lg-100">
					<!--begin::Card header-->
					<div class="card-header mt-6">
						<!--begin::Card title-->
						<div class="card-title flex-column">
							<h3 class="fw-bolder mb-1">Expense Overview</h3>
							<!--begin::Labels-->
							<div class="fs-6 d-flex text-gray-400 fs-6 fw-bold">
								<!--begin::Label-->
								<div class="d-flex align-items-center me-6">
								<span class="menu-bullet d-flex align-items-center me-2">
									<span class="bullet bg-success"></span>
								</span>Complete</div>
								<!--end::Label-->
								<!--begin::Label-->
								<div class="d-flex align-items-center">
								<span class="menu-bullet d-flex align-items-center me-2">
									<span class="bullet bg-primary"></span>
								</span>Incomplete</div>
								<!--end::Label-->
							</div>
							<!--end::Labels-->
						</div>
						<!--end::Card title-->
						<!--begin::Card toolbar-->
						<div class="card-toolbar">
							<!--begin::Select-->
							<select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-solid form-select-sm fw-bolder w-100px">
								<option value="1" selected="selected">2022</option>
								<option value="2">2021</option>
								<option value="3">2020</option>
							</select>
							<!--end::Select-->
						</div>
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body pt-10 pb-0 px-5">
						<!--begin::Chart-->
						<div id="kt_project_overview_graph" class="card-rounded-bottom" style="height: 190px"></div>
						<!--end::Chart-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Graph-->
			</div>
			<!--end::Col-->
			
			
			
		</div>
		<!--end::Row-->
		
		<?php
		*/
		?>
		<!--begin::Table-->
		<div class="card card-flush mt-6 mt-xl-6">
			<!--begin::Card header-->
			<div class="card-header mt-5">
				<!--begin::Card title-->
				<div class="card-title flex-column">
					<h3 class="fw-bolder mb-1">Spendings</h3>
					<div class="fs-6 text-gray-400">Total <?php echo number_format($grand_tot,2); ?> spent so far</div>
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar my-1">
					<!--begin::Select
					<div class="me-6 my-1">
						<select id="kt_filter_year" name="year" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
							<option value="All" selected="selected">All time</option>
							<option value="thisyear">This year</option>
							<option value="thismonth">This month</option>
							<option value="lastmonth">Last month</option>
							<option value="last90days">Last 90 days</option>
						</select>
					</div>
					end::Select-->
					<!--begin::Select
					<div class="me-4 my-1">
						<select id="kt_filter_orders" name="orders" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
							<option value="All" selected="selected">All Orders</option>
							<option value="Approved">Approved</option>
							<option value="Declined">Declined</option>
							<option value="In Progress">In Progress</option>
							<option value="In Transit">In Transit</option>
						</select>
					</div>
					<!--end::Select-->
					<!--begin::Search-->
					<div class="d-flex align-items-center position-relative my-1">
						<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
						<span class="svg-icon svg-icon-3 position-absolute ms-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span>

						<!--end::Svg Icon-->
						<input type="text" id="filter_expense" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search Expense" />
					</div>
					<!--end::Search-->
				</div>
				<!--begin::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table container-->
				<div class="table-responsive">
					<!--begin::Table-->
					<table id="speding_datatable" class="table table-row-bordered table-row-dashed gy-2 align-middle">
						<!--begin::Head-->
						<thead class="fs-7 text-gray-400 fw-bolder">
							<tr>
							    <th data-bs-toggle="tooltip" class="min-w-25px"  title="ID">#</th>
                                <th data-bs-toggle="tooltip" class="min-w-60px" title="Entity">Entity</th>

                                <th data-bs-toggle="tooltip" class="min-w-60px" title="Date">Date</th>
                                <th data-bs-toggle="tooltip" class="min-w-100px"title="Description">Description</th>
                                <th data-bs-toggle="tooltip" class="min-w-75px"title="Budget Line">Budget Line</th>

                                <th data-bs-toggle="tooltip" title="Category">Category</th>
								<!---<th data-bs-toggle="tooltip" title="Employee">Employee Name</th>--->
								<th data-bs-toggle="tooltip" title="Cost Centre">Cost Centre Code</th>
                                <th data-bs-toggle="tooltip" title="Vendor/supplier">Vendor</th>
                                <th data-bs-toggle="tooltip" title="Supplier Ref.no">Supplier Ref.no</th>
                                <th data-bs-toggle="tooltip" title="Currency">Currency</th>
                                <th data-bs-toggle="tooltip" title="Amount">Amount </th>
								<th data-bs-toggle="tooltip" title="Budget Run.Tot">Total Cat Spend <?php echo '('.$budget_details_info[0]->currency.')'; ?></th>
								<th data-bs-toggle="tooltip" title="Run.Total">Run.Total <?php echo '('.$budget_details_info[0]->currency.')'; ?></th>
								<th data-bs-toggle="tooltip" title="Available Budget">Avl.Budget <?php echo '('.$budget_details_info[0]->currency.')'; ?></th>
								<th data-bs-toggle="tooltip" title="Status">Status </th>
								<th data-bs-toggle="tooltip" title="File">File </th>
								<th></th>
							</tr>
						</thead>
						<!--end::Head-->
						<!--begin::Body-->
						<!-- <tbody class="fs-7">
						    <?php
						    /*
						    $exp_query = $this->db->query("SELECT e.date, e.amount, e.file, c.name as category_name, cc.name as cost_center_name, sc.name as sub_category_name FROM budget_expenses e, categories c, budget_cost_center cc, sub_categories sc WHERE e.budget_id='".$budget_id."' and c.id=e.main_category_id and cc.id=e.cost_center and sc.id=e.sub_category");
						    foreach($exp_query->result() as $expense_data)
						    {
						    ?>
							<tr>
								<td><?php echo date('d-m-Y',strtotime($expense_data->date)); ?></td>
								<td><?php echo $expense_data->sub_category_name; ?></td>
								<td><?php echo $expense_data->cost_center_name; ?></td>
								<td><?php echo $expense_data->category_name; ?></td>
								<td><?php echo number_format($expense_data->amount); ?></td>
								<td>35,700</td>
								<td>35,000</td>
								<td>65,000</td>
								<td>
									<span class=" fw-bolder px-4 py-3">
										<span class="svg-icon svg-icon-1 svg-icon-success">
											<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
												<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"></path>
												<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
											</svg>
										</span>
									</span>
								</td>
								<td>
								    <?php
								    if(!empty($expense_data->file))
								    {
								    ?>
									<a class="symbol symbol-20px mb-5" target="blank" href="<?php echo site_url('uploads/expense_files/'.$expense_data->file); ?>"><i class="fa fa-file"></i></a>
									<?php
								    }
									?>
								</td>
							</tr>
							<?php
						    }
						    */
							?>
						</tbody> -->
						<!--end::Body-->
					</table>
					<!--end::Table-->
				</div>
				<!--end::Table container-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
        <!--begin::Table-->
        <div class="card card-flush mt-6 mt-xl-6"  style="visibility: hidden;">
            <!--begin::Card header-->
            <div class="card-header mt-5">
                <!--begin::Card title-->
                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1">Requests</h3>
                    <div class="fs-6 text-gray-400"> Total <?php echo number_format($req_tot,2); ?> requested so far</div>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar my-1">
                    <!--begin::Select-->
                  <!---  <div class="me-6 my-1">
                        <select id="kt_filter_year" name="year" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                            <option value="All" selected="selected">All time</option>
                            <option value="thisyear">This year</option>
                            <option value="thismonth">This month</option>
                            <option value="lastmonth">Last month</option>
                            <option value="last90days">Last 90 days</option>
                        </select>
                    </div>--->
                    <!--end::Select-->
                    <!--begin::Select-->
                    <div class="me-4 my-1">
                        <select id="filter_requests" name="requests" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                            <option value="all" selected="selected">All Requests</option>
                            <option value="approved">Approved</option>
                            <option value="declined">Declined</option>
                            <option value="pending">In Progress</option>
                        </select>
                    </div>
                    <!--end::Select-->
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-3 position-absolute ms-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span>
                        <!--end::Svg Icon-->
                        <input type="text" id="filter_request" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search Requests" />

                    </div>
                    <!--end::Search-->
                </div>
            <!---    <div id ="export_req_div" class="d-flex justify-content-end"></div>

                begin::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table id="request_datatable" class="table table-row-bordered table-row-dashed gy-2 align-middle">
                        <!--begin::Head-->
                        <thead class="fs-7 text-gray-400 fw-bolder">
                        <tr>
                            <th data-bs-toggle="tooltip" title="ID">#</th>
                            <th data-bs-toggle="tooltip" title="Date">Date</th>
                            <th data-bs-toggle="tooltip" title="Request title">Request Title</th>
                            <th data-bs-toggle="tooltip" title="Category">Category</th>
                            <th data-bs-toggle="tooltip" title="Budget Line">Budget Line</th>
                            <th data-bs-toggle="tooltip" title="Amount">Requested Amount </th>
                            <th data-bs-toggle="tooltip" title="Requested By">Requested By </th>
                            <th data-bs-toggle="tooltip" title="Department">Department</th>
                            <th data-bs-toggle="tooltip" title="Available Budget">Avl.Budget in Category </th>
                            <th data-bs-toggle="tooltip" title="Status">Status </th>
                            <th data-bs-toggle="tooltip" title="Status">Status-id</th>
                            <th data-bs-toggle="tooltip" title="Approved Amount ">Approved Amount </th>
                            <th data-bs-toggle="tooltip" title="Approved By ">Approved By </th>
                            <th data-bs-toggle="tooltip" title="Action ">Action</th>
                        </tr>
                        </thead>
                        <!--end::Head-->
                        <!--begin::Body-->
                        <!-- <tbody class="fs-7">
						    <?php
                        /*
                        $exp_query = $this->db->query("SELECT e.date, e.amount, e.file, c.name as category_name, cc.name as cost_center_name, sc.name as sub_category_name FROM budget_expenses e, categories c, budget_cost_center cc, sub_categories sc WHERE e.budget_id='".$budget_id."' and c.id=e.main_category_id and cc.id=e.cost_center and sc.id=e.sub_category");
                        foreach($exp_query->result() as $expense_data)
                        {
                        ?>
                        <tr>
                            <td><?php echo date('d-m-Y',strtotime($expense_data->date)); ?></td>
                            <td><?php echo $expense_data->sub_category_name; ?></td>
                            <td><?php echo $expense_data->cost_center_name; ?></td>
                            <td><?php echo $expense_data->category_name; ?></td>
                            <td><?php echo number_format($expense_data->amount); ?></td>
                            <td>35,700</td>
                            <td>35,000</td>
                            <td>65,000</td>
                            <td>
                                <span class=" fw-bolder px-4 py-3">
                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"></path>
                                            <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
                                        </svg>
                                    </span>
                                </span>
                            </td>
                            <td>
                                <?php
                                if(!empty($expense_data->file))
                                {
                                ?>
                                <a class="symbol symbol-20px mb-5" target="blank" href="<?php echo site_url('uploads/expense_files/'.$expense_data->file); ?>"><i class="fa fa-file"></i></a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        */
                        ?>
						</tbody> -->
                        <!--end::Body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <div class="modal fade " id="kt_modal_view_request" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-lg modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <h2 class="fw-bolder">Add User</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
	</div>
	<!--end::Container-->
</div>



<?php
$total_amount = $total_budget;
$total_expense;
$available_budget = $total_budget-$total_expense;


$percentage_array = array();
$percentage_val_array = array();
$cat_names_array = array();
$cat_color_array = array();

$percentage = round(100-((($total_amount-$total_expense)/$total_amount)*100));
$percentage_array[] = array('cat_name' => 'Total Expense', 'percentage' => $percentage);
$cat_names_array[] = 'Total Expense';
$percentage_val_array[] = $percentage;
$cat_color_array[] = '#dddddd';

$percentage = round(100-((($total_amount-$available_budget)/$total_amount)*100));
$percentage_array[] = array('cat_name' => 'Avalable Budget', 'percentage' => $percentage);
$cat_names_array[] = 'Avalable Budget';
$percentage_val_array[] = $percentage;
$cat_color_array[] = '#47be7d';
?>

<script>
var category_percentage_array_json = '<?php echo json_encode($percentage_array,true); ?>';
var category_cat_name_array_json_data = <?php echo json_encode($cat_names_array,true); ?>;
var category_percentage_array_json_data = <?php echo json_encode($percentage_val_array,true); ?>;
var category_cat_color_json_data = <?php echo json_encode($cat_color_array,true); ?>;
</script>