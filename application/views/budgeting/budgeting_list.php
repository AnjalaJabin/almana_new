<?php
$role_resources_ids = $this->Xin_model->user_role_resource();
$session = $this->session->userdata('username');?>
<div class="toolbar" id="kt_toolbar">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Title-->
				<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Budget List &nbsp;&nbsp;<a href="<?php echo site_url('budgeting/allocated_budget');?>"><i class="bi bi-grid fs-3"></i></a></h1>
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
				<div class="card p-1">
					<!--begin::Header-->
					<div class="card-header border-0" id ="top_div">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder fs-3 mb-1"> All Budgets </span>
							<span class="text-muted mt-1 fw-bold fs-7"><?php echo $all_budgeting->num_rows(); ?> budgets in 2022</span>
						</h3>
						<div class="card-toolbar">
							<ul class="nav">
								<li class="nav-item">
									<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">2023</a>
								</li>
								<li class="nav-item">
									<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">2022</a>
								</li>
								<li class="nav-item">
									<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">2021</a>
								</li>
								<li class="nav-item">
									<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">2020</a>
								</li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4"  data-bs-toggle="tab" id ="print_pdf" href="#">Print Approval Note</a>
                                </li>
							</ul>
						</div>
					</div>
					<div class="card-body py-1">
						<!--end::Header-->
						<div class="row">
						    <div class="col-md-6 d-flex align-items-center position-relative my-1">
						<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
						<span class="svg-icon svg-icon-3 position-absolute ms-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span>

						<!--end::Svg Icon-->
						<input type="text" id="filter_bud" class="form-control form-control-solid form-select-sm w-250px ps-9" placeholder="Search Budgets" />
						

					</div>
					<div class="col-md-6 card-toolbar">
						<div id ="export_budget" class="d-flex justify-content-end"></div>

					</div>
					</div
					<!--end::Search-->
						    <div clas="col-md-12">
						        
                                <table id="budget_table" class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th style="display: none" class="print min-w-75px">Select Items</th>

                                            <th class="min-w-75px">Budget ID</th>
                                            <th class="min-w-125px">Budget Name</th>
                                            <th class="min-w-50px">Status</th>
                                            <th class="text-end min-w-125px">Total Allocated</th>
                                            <th class="text-end min-w-125px">Total Expenses</th>
                                            <th class="text-end min-w-125px">Available Budget</th>
                                            <th class="text-end min-w-125px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                					    foreach($all_budgeting->result() as $all_budgeting_data)
                					    {
                					    ?>

                					    <?php
                                        $grand_tot = 0;
                                        $query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$all_budgeting_data->id."'");
                                        foreach($query->result() as $expense_data){
                                            $grand_tot=$grand_tot+$expense_data->amount;
                                        }
                                        ?>

                                        <?php
                                        $status_label = '';
									    if($all_budgeting_data->status==1)
									    {
									        $view_budget_details_url = site_url('budgeting/budget_details/'.$all_budgeting_data->id);
									        $status_label = '<div class="badge badge-light-success">Active</div>';
										}
									    else{
									        $view_budget_details_url = site_url('budgeting/pending_budget_details/'.$all_budgeting_data->id);
									        $status_label = '<div class="badge badge-light-warning">Pending</div>';
									    }
										?><div>
                                        <tr>
                                            <td class="print" style="display: none"> <input type="checkbox"  class="print_check"  <?php
                                                if($all_budgeting_data->status==1)
                                                { ?>disabled="true" <?php }?> id="check_<?php echo ($all_budgeting_data->id); ?>" value="<?php echo ($all_budgeting_data->id); ?>"></td>
                                            <td><?php echo $all_budgeting_data->budget_code; ?></td>

                                            <td><?php if(in_array('4',$role_resources_ids)) {?>
                                                <a href="<?php echo $view_budget_details_url; ?>"><strong><?php }echo $all_budgeting_data->budget_name; ?></strong></a></td>
    										<td><?php echo $status_label; ?></td>
                                            <?php
                                            $aed_amount = $all_budgeting_data->amount;
                                            if($all_budgeting_data->currency!='AED'){
                                                $aed_amount = $this->Xin_model->convert_to_current_currency($all_budgeting_data->amount,$all_budgeting_data->currency,'AED',0);
                                            }
                                            ?>
                                            <td class="text-end"><?php echo $all_budgeting_data->currency; ?> <?php echo number_format($all_budgeting_data->amount,2); ?><br/>AED <?php echo number_format($aed_amount,2); ?></td>
                                            <td class="text-end"><?php echo $all_budgeting_data->currency; ?> <?php echo number_format($grand_tot,2); ?></td>
    										<td class="text-end"><?php echo $all_budgeting_data->currency; ?> <?php echo number_format($all_budgeting_data->amount-$grand_tot,2); ?></td>
    										<td class="text-end">
                                                <?php
                                                if($all_budgeting_data->status!=1)
                                                {
                                                if (in_array('32', $role_resources_ids)) { ?>
                                                    <a href="<?php echo site_url('budgeting/edit_budget/'.$all_budgeting_data->id); ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Edit"><i class="fas fa-edit"></i></button></a>
                                                <?php }if(in_array('4',$role_resources_ids)) {?>
                                                    <a href="<?php echo site_url('budgeting/pending_budget_details/'.$all_budgeting_data->id); ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="View" ><i class="fas fa-eye"></i></button></a>

                                                    <?php
                                                }
                                                }else{
                                                if (in_array('4', $role_resources_ids)) { ?>
                                                    <a href="<?php echo site_url('budgeting/budget_details/'.$all_budgeting_data->id);
                                                ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="View" ><i class="fas fa-eye"></i></button></a>


                                                <?php }
                                                }
                                                if (in_array('31', $role_resources_ids)) { ?>
                                                <a href="<?php echo site_url('budgeting/budget_allocation/'.$all_budgeting_data->id); ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Edit User Allocation" ><i class="fas fa-users"></i></button></a>

<?php } ?>

    										</td>
    									</tr>
                                            </div>
    									<?php
                					    }
    									?>
                                    </tbody>
<tfoot><td style="display: none"  class="print" id="checkall_col" > <input type= "checkbox" id ="check_all"> Check All<br/></td></tfoot>
                                </table>
                            <div class="row">
                            <div class="col-md-4" class="rep_title">

                                <label style="display: none" class="rep_title required fw-bold fs-6 mb-2">Report Title</label>
                                <input style="display: none" type="text" name="report_title" id="report_title" class="rep_title form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" />
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                <a target="blank" id="print_budget_pdf" style="display: none" class="submit_print btn btn-success my-1 me-12">Print Consolidated Budget</a>
                                    <a target="blank" id="print_one_budget" style="display: none" class="submit_print btn btn-success my-1 me-12">Print PDF</a>

                                </div>

                            </div>

                        </div>
						    
						</div>
					</div>
				</div>
			</div>
			<!--end::Stats-->
		</div>
		<!--end::Container-->
	</div>