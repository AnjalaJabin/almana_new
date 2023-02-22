<?php
$session = $this->session->userdata('username');
$user_info = $this->Xin_model->read_user_info($session['user_id']);
$role_user = $this->Xin_model->read_user_role_info($user_info[0]->user_role_id);
$designation_info = $this->Xin_model->read_designation_info($user_info[0]->designation_id);
$role_resources_ids = explode(',',$role_user[0]->role_resources);
$periods =$this->Xin_model->get_all_periods();

?>
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Allowances List</h1>
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
            <!--begin::Card header-->
            <div class="card-header border-0 pt-4">
                <div class="col-md-2 fv-row">
                    <label class="fs-7 fw-bold mb-2">Allowance type</label>
                    <select id="allowance_filter" name="employee" data-control="select2" data-hide-search="true" class="form-select select2down form-select-solid">
                        <?php $categories = $this->Xin_model->get_all_allowance_category();
                        foreach($categories->result() as $row){?>
                            <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                        <?php }?>

                    </select>
                </div>

                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1" >
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span>
                        <!--end::Svg Icon-->
                        <input type="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" id='filter_employee' placeholder="Search Allowance" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->  <?php if(in_array('6',$role_resources_ids)) {?>
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                            <!--begin::Add user-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
								<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
							</svg>
						</span>
                                <!--end::Svg Icon-->Add User Allowance</button>
                            <!--end::Add user-->
                            <div id ="export_div"></div>

                        </div><?php }?>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                        <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                    </div>
                    <!--end::Group actions-->
                    <!--begin::Modal - Add task-->
                    <div class="modal fade " id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-lg modal-dialog-centered mw-650px">
                            <div class="modal-content">
                                <div class="modal-header" id="kt_modal_add_user_header">
                                    <h2 class="fw-bolder">Add Allowance</h2>
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
                                    <form id="add_allowance_form" class="form" enctype="multipart/form-data" method="post">
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                            <div class="row form-group mb-7">

                                                <div class="col-md-12">
                                                    <label class="required fw-bold fs-6 mb-2">Employee</label>
                                                    <select class="form-control form-select form-control-solid mb-3 mb-lg-0" id="employee_select"  data-control="select2" name="employee" data-dropdown-parent="#kt_modal_add_user" >
                                                       <option value="">Select Employee..</option>
                                                        <?php $employees = $this->Xin_model->get_all_employees();

                                                        foreach($employees as $r){?>
                                                            <option value="<?php echo $r->user_id?>"><?php echo $r->first_name." ".$r->last_name?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="allowance-div">

                                            <div class="row form-group mb-3">
                                                <div class="card-header" id="select_period_div" style="display:block;">
                                                    <div class="card-title fs-3 fw-bolder">

                                                        <div class="w-200 w-md-600px" style="background: rgb(221, 221, 221); padding: 7px;">
                                                            <div class="input-group">

                                                                <select  name="period[]" class="form-select form-select-solid select_period" data-placeholder="Allowance Period" data-control="select2" data-dropdown-parent="#kt_modal_add_user">

                                                                    <!--                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Vendor/Supplier" name="supplier_id">-->
                                                                    <option value="">Select Allowance Period..</option>

                                                                    <?php
                                                                    foreach($periods->result() as $period){
                                                                        echo '<option value="'.$period->id.'">'.date('j M Y', strtotime($period->from_date)).' - '.date('j M Y', strtotime($period->to_date)).'('.$period->category.')'.'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <input type="text" class="form-control form-control-solid" placeholder="Amount" name="amount[]" />

                                                                <span class="input-group-btn">
                                                                                <button class="btn btn-success group_add_main_cat_sub_btn add_period" type="button"><i class="fa fa-plus"></i></button>
                                                                </span>  <span class="input-group-btn">
                                                                                <button style="display:none;" class="btn btn-danger group_add_main_cat_sub_btn remove_period"  type="button"><i class="fa fa-times"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                        <div class="row form-group mb-7">
                                            <div class="text-center pt-15">
                                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                                                <button type="submit" class="btn btn-primary save" data-kt-users-modal-action="submit">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>

                    <!--end::Modal - Add task-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="xin_table_employee">
                    <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-120px">User</th>
                        <th class="min-w-75px">Emp Code</th>
                        <th class="min-w-120px">Email</th>
                        <th class="min-w-75px">Stores</th>
                        <th class="min-w-75px">Period</th>
                        <th class="min-w-75px">Allow.Amt</th>
                        <th class="min-w-75px">Balance</th>
                        <th class="min-w-75px">Category</th>
                        <th class="min-w-75px">CategoryId</th>
                        <th class=" min-w-60px">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<script>
    var periods = JSON.parse('<?php echo json_encode($periods->result()); ?>');

</script>