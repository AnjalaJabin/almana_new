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
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Users List</h1>
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
            <div class="card-header border-0 pt-2">
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
                        <input type="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" id='filter_employee' placeholder="Search user" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->  <?php if(in_array('6',$role_resources_ids)) {?>
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <div> <button type="button" class="btn btn-active-color-gray-200" id="sync_employees"
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                        Sync
						</span></div>
                            <!--begin::Add user-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
								<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
							</svg>
						</span>
                                <!--end::Svg Icon-->Add User</button>
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
                                    <h2 class="fw-bolder">Add User</h2>
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
                                    <form id="add_user_form" class="form" enctype="multipart/form-data" method="post">
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                            <div class="fv-row mb-7">
                                                <label class="d-block fw-bold fs-6 mb-5">Avatar</label>
                                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/avatars/blank.png)">
                                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/blank.png)"></div>
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                    </label>
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
														<i class="bi bi-x fs-2"></i>
													</span>
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
														<i class="bi bi-x fs-2"></i>
													</span>
                                                </div>
                                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                            </div>
                                            <div class="row form-group mb-7">
                                                <div class="col-md-6">
                                                    <label class="required fw-bold fs-6 mb-2">Full Name</label>
                                                    <input type="text" name="user_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="required fw-bold fs-6 mb-2">Email</label>
                                                    <input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" />
                                                </div>
                                            </div>
                                            <div class="row form-group mb-7">
                                                <div class="col-md-6">
                                                    <label class="required fw-bold fs-6 mb-2">Phone Number</label>
                                                    <input type="text" name="user_mobile" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Phone Number" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="required fw-bold fs-6 mb-2">Department</label>
                                                    <select class="form-control form-select form-select form-control-solid mb-3 mb-lg-0" name="department">
                                                        <?php $departments = $this->Xin_model->get_all_departments();
                                                        foreach($departments->result() as $r){?>
                                                            <option value="<?php echo $r->id?>"><?php echo $r->name?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group mb-7">
                                                <div class="col-md-6">
                                                    <label class="required fw-bold fs-6 mb-2">Permission Roles</label>
                                                    <select class="form-control form-select form-control-solid mb-3 mb-lg-0" name="roles">
                                                        <?php $roles = $this->Xin_model->get_all_roles();
                                                        foreach($roles->result() as $r){?>
                                                            <option value="<?php echo $r->role_id?>"><?php echo $r->role_name?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="required fw-bold fs-6 mb-2">Employee Code</label>
                                                    <input type="text" name="emp_code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Employee Code" />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row form-group mb-7">
                                            <div class="col-md-12">

                                                <label class="fw-bold fs-6 mb-2">Stores Allocated</label>
                                                <select class="form-control form-select form-control-solid mb-3 mb-lg-0" id="store-select" name="stores[]" multiple>
                                                    <?php $stores = $this->Xin_model->get_all_stores();
                                                    foreach($stores->result() as $r){?>
                                                        <option value="<?php echo $r->id?>"><?php echo $r->name?></option>
                                                    <?php }?>
                                                </select>
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
                        <th class="min-w-75px">Contact</th>
                        <th class="min-w-125px">Stores</th>
                        <th class="min-w-60px">Joined Date</th>
                        <th class="min-w-60px">Last login</th>
                        <th class="min-w-60px">Status</th>
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