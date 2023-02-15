<div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Budget List &nbsp;&nbsp;<a href="<?php echo site_url('budgeting/allocated_budget_list');?>"><i class="bi bi-list fs-3"></i></a></h1>
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
		<!--begin::Stats-->
		<div class="row g-4 g-xl-6">
			<div class="card p-5">
				<!--begin::Header-->
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bolder fs-3 mb-1">All Budgets in Department</span>
						<span class="text-muted mt-1 fw-bold fs-7"><?php echo $all_budgeting->num_rows(); ?> budgets in 2022</span>
					</h3>
					<div class="card-toolbar">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">2022</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">2021</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">2020</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="card-body py-6">
					<!--end::Header-->
					<div class="row">
					    
					    <?php
					    foreach($all_budgeting->result() as $all_budgeting_data)
					    {
					    ?>
					    
						<!--begin::Col-->
						<div class="col-xl-4">
							<!--begin::Mixed Widget 1-->
							<div class="card card-xl-stretch mb-xl-8">
								<!--begin::Body-->
								<div class="card-body p-0">
									<!--begin::Header-->
									<div class="px-9 pt-7 card-rounded h-275px w-100 bg-gray">
										<!--begin::Heading-->
										<div class="d-flex flex-stack">
											<h3 class="m-0 text-white fs-3"><?php echo $all_budgeting_data->budget_name; ?></h3>
											<div class="ms-1">
												<!--begin::Menu-->
												<button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color-primary border-0 me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
													<!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
													<span class="svg-icon svg-icon-2">
														<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
																<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
															</g>
														</svg>
													</span>
													<!--end::Svg Icon-->
												</button>
												<!--begin::Menu 3-->
												<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
													<!--begin::Heading-->
													<div class="menu-item px-3">
														<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Actions</div>
													</div>
													<!--end::Heading-->
													<!--begin::Menu item-->
													<div class="menu-item px-3">
													    <?php
													    if($all_budgeting_data->status==1)
													    {
													    ?>
														    <a href="<?php echo site_url('budgeting/budget_details/'.$all_budgeting_data->id); ?>" class="menu-link px-3">View details</a>
														<?php
													    }
													    else{
													        ?>
													        <a href="<?php echo site_url('budgeting/pending_budget_details/'.$all_budgeting_data->id); ?>" class="menu-link px-3">View details</a>
													        <?php
													    }
														?>
													</div>
													<!--end::Menu item-->
													<!--begin::Menu item-->
													<div class="menu-item px-3">
														<a href="#" class="menu-link px-3">Export</a>
													</div>
												</div>
												<!--end::Menu 3-->
												<!--end::Menu-->
											</div>
										</div>
										<!--end::Heading-->
										<!--begin::Balance-->
										<?php
										$aed_amount = $all_budgeting_data->amount;
                                        if($all_budgeting_data->currency!='AED'){
                                            $aed_amount = $this->Xin_model->convert_to_current_currency($all_budgeting_data->amount,$all_budgeting_data->currency,'AED',0);
                                        }
										?>
										<div class="d-flex text-center flex-column text-white pt-1">
											<span class="fw-bold fs-7">Total Allocated</span>
											<span class="fs-2 pt-1"><?php echo $all_budgeting_data->currency.' '.number_format($all_budgeting_data->amount); ?></span>
											<span class="fs-2 pt-1"><?php echo 'AED '.number_format($aed_amount); ?></span>
										</div>
										<!--end::Balance-->
									</div>
									<?php
                                    $grand_tot = 0;
                                    $query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$all_budgeting_data->id."'");
                                    foreach($query->result() as $expense_data){
                                        $grand_tot=$grand_tot+$expense_data->amount;
                                    }
                                    ?>
									<!--end::Header-->
									<!--begin::Items-->
									<div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
									    <?php
									    if($all_budgeting_data->status==1)
									    {
									    ?>
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-3">
											<!--begin::Description-->
											<div class="d-flex align-items-center flex-wrap w-100">
												<!--begin::Title-->
												<div class="mb-1 pe-3 flex-grow-1">
													<a href="#" class="fs-5 text-gray-800 text-hover-primary">Total Expenses</a>
												</div>
												<!--end::Title-->
												<!--begin::Label-->
												<div class="d-flex align-items-center">
												    
													<div class="fs-5  text-warning pe-1 fw-bolder"><?php echo $all_budgeting_data->currency.' '.number_format($grand_tot); ?></div>
												</div>
												<!--end::Label-->
											</div>
											<!--end::Description-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-0">
											<!--begin::Description-->
											<div class="d-flex align-items-center flex-wrap w-100">
												<!--begin::Title-->
												
												<div class="mb-1 pe-3 flex-grow-1">
													<a href="#" class="fs-5 text-gray-800 text-hover-primary">Available Budget</a>
												</div>
												<!--end::Title-->
												<!--begin::Label-->
												<div class="d-flex align-items-center">
													<div class="fw-bolder fs-5 text-success pe-1"><?php echo $all_budgeting_data->currency.' '.number_format($all_budgeting_data->amount-$grand_tot); ?></div>
												</div>
												<!--end::Label-->
											</div>
											<!--end::Description-->
										</div>
										<!--end::Item-->
										<?php
									    }
									    else{
									    ?>
									    <div class="d-flex align-items-center mb-0">
											<!--begin::Description-->
											<div class="d-flex align-items-center flex-wrap w-100">
												<span class="fw-bolder fs-5 text-warning pe-1">
    											    Pending for Approval
    											</span>
											</div>
											<!--end::Description-->
										</div>
									    <?php
									    }
										?>
										<div class="align-items-center text-center mt-6">
											<hr>
											<?php
										    if($all_budgeting_data->status==1)
										    {
										    ?>
											    <a href="<?php echo site_url('budgeting/budget_details/'.$all_budgeting_data->id); ?>" class="btn btn-primary w-70 py-3">View Detail</a>
											<?php
										    }
										    else{
										        ?>
										        <a href="<?php echo site_url('budgeting/pending_budget_details/'.$all_budgeting_data->id); ?>" class="btn btn-primary w-70 py-3">View Detail</a>
										        <?php
										    }
											?>
										</div>
									</div>
									<!--end::Items-->
								</div>
								<!--end::Body-->
							</div>
							<!--end::Mixed Widget 1-->
						</div>
						
						<?php
					    }
						?>
						
					</div>
				</div>
			</div>
		</div>
		<!--end::Stats-->
	</div>
	<!--end::Container-->
</div>