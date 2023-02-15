<?php 
$role_resources_ids = $this->Xin_model->user_role_resource();
$session = $this->session->userdata('username');?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/custom/kendo/kendo.common.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/custom/kendo/kendo.default.min.css" />


<div class="toolbar" id="kt_toolbar">
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Roles List</h1>
		</div>
	</div>
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
	<div id="kt_content_container" class="container-xxl">
		<div class="card">
			<div class="card-header border-0 pt-6">
				<div class="card-title">
					<div class="d-flex align-items-center position-relative my-1">
						<span class="svg-icon svg-icon-1 position-absolute ms-6">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span>
						<input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
					</div>
				</div>
				<div class="card-toolbar">
                    <?php if(in_array('18',$role_resources_ids)) {?>
					<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
								<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
							</svg>
						</span>Add New Role</button>
					</div><?php }?>
					<div class="modal fade " id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-lg modal-dialog-centered mw-650px">
							<div class="modal-content">
								<div class="modal-header" id="kt_modal_add_user_header">
                                	<h2 class="fw-bolder">Add a Role</h2>
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
                                	<form class="m-b-1" action="<?php echo site_url("roles/add_role") ?>" method="post" name="add_role" id="xin-form">
                                      <input type="hidden" name="_method" value="EDIT">
                                      <input type="hidden" name="_token">
                                      <input type="hidden" name="ext_name">
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label for="role_name">Role Name</label>
                                                  <input class="form-control form-control-solid" placeholder="Role Name" name="role_name" type="text">
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 mt-5">
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="resources">Resources</label>
                                                  <div id="all_resources">
                                                    <div class="demo-section k-content">
                                                      <div>
                                                        <div id="treeview_r1"></div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <!--<div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="resources">Resources</label>
                                                  <div id="all_resources">
                                                    <div class="demo-section k-content">
                                                      <div>
                                                        <div id="treeview_r2"></div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>-->
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary save">Save</button>
                                      </div>
                                    </form>
                                </div>
                                <!--end::Modal body-->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body pt-0">
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="xin_table">
					<thead>
						<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
							<th class="min-w-125px">Action</th>
							<th class="min-w-125px">Role ID</th>
							<th class="min-w-125px">Role Name</th>
							<!--<th class="min-w-125px">Menu Permission</th>-->
							<th class="min-w-125px">Added Date</th>
						</tr>
					</thead>
					<tbody class="text-gray-600 fw-bold">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>