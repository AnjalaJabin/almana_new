<?php
$role_resources_ids = $this->Xin_model->user_role_resource();
$session = $this->session->userdata('username');?>
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Settings</h1>
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
        <!--begin::Card-->
        <div class="card card-flush">
            <!--begin::Card body-->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <?php if(in_array('11',$role_resources_ids)) {?>
                                <button class="nav-link active" id="v-pills-departments-tab" data-bs-toggle="pill" data-bs-target="#departments" type="button" role="tab" aria-controls="departments" aria-selected="true">
								<span class="d-flex flex-column align-items-start">
									<span class="fs-4 fw-bolder">Departments</span>
								</span>
                                </button>
                            <?php }
                            if (in_array('12', $role_resources_ids)) { ?>

                                <button class="nav-link" id="v-pills-catogeris-tab" data-bs-toggle="pill" data-bs-target="#catogeris" type="button" role="tab" aria-controls="catogeris" aria-selected="false">
								<span class="d-flex flex-column align-items-start">
					                <span class="fs-4 fw-bolder">Categories</span>
					            </span>
                                </button>
                            <?php }
                            if (in_array('13', $role_resources_ids)) { ?>

                                <button class="nav-link" id="v-pills-sub-catogeris-tab" data-bs-toggle="pill" data-bs-target="#sub-catogeris" type="button" role="tab" aria-controls="sub-catogeris" aria-selected="false">
								<span class="d-flex flex-column align-items-start">
					                <span class="fs-4 fw-bolder">Sub-Categories</span>
					            </span>
                                </button> <?php }
                            if (in_array('14', $role_resources_ids)) { ?>

                                <button class="nav-link" class="nav-link" id="v-pills-cost-center-tab" data-bs-toggle="pill" data-bs-target="#cost-center" type="button" role="tab" aria-controls="cost-center" aria-selected="false">
								<span class="d-flex flex-column align-items-start">
					                <span class="fs-4 fw-bolder">Cost Center</span>
					            </span>
                                </button>
                            <?php }
                            if (in_array('34', $role_resources_ids)) { ?>

                                <button class="nav-link" class="nav-link" id="v-pills-cost-center-tab" data-bs-toggle="pill" data-bs-target="#company" type="button" role="tab" aria-controls="cost-center" aria-selected="false">
								<span class="d-flex flex-column align-items-start">
					                <span class="fs-4 fw-bolder">Company</span>
					            </span>
                                </button>
                            <?php }
                            if (in_array('24', $role_resources_ids)) { ?>

                                <button class="nav-link" class="nav-link" id="v-pills-currency-tab" data-bs-toggle="pill" data-bs-target="#currency" type="button" role="tab" aria-controls="currency" aria-selected="false">
								<span class="d-flex flex-column align-items-start">
					                <span class="fs-4 fw-bolder">Currency</span>
					            </span>
                                </button> <?php }
                            if (in_array('15', $role_resources_ids)) { ?>


                                <button class="nav-link" id="v-pills-vendor-tab" data-bs-toggle="pill" data-bs-target="#vendor" type="button" role="tab" aria-controls="vendor" aria-selected="false">
								<span class="d-flex flex-column align-items-start">
					                <span class="fs-4 fw-bolder">Vendor/Supplier</span>
					            </span>
                                </button>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-9 p-5 bg-light">
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php
                            if (in_array('11', $role_resources_ids)) { ?>

                                <div class="tab-pane fade show active" id="departments" role="tabpanel" aria-labelledby="v-pills-departments-tab">
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="box box-block bg-white p-3">
                                                <h4><strong>Add New</strong> Department</h4>
                                                <div class="separator mb-4 mt-4"></div>
                                                <form class="m-b-1 add" id="add_departments" action="<?php echo site_url("settings/add_departments") ?>" name="add_departments" method="post">
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Department Name</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Department Name" name="name" />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary save">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="box box-block bg-white p-5">
                                                <div id ="export_dep" class="d-flex justify-content-end"></div>

                                                <h2><strong>List All</strong> Departments</h2>
                                                <div class="table-responsive">
                                                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-3 gy-3" id="xin_table_departments" style="width: 100%;" role="grid">
                                                        <thead>
                                                        <tr class="fw-bolder text-muted bg-light">
                                                            <th class="ps-4 rounded-start w-125px">Action</th>
                                                            <th class="ps-4 rounded-start">Depart. Name</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (in_array('12', $role_resources_ids)) { ?>

                                <div class="tab-pane fade" id="catogeris" role="tabpanel" aria-labelledby="v-pills-catogeris-tab">
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="box box-block bg-white p-3">
                                                <h4><strong>Add New</strong> Categories</h4>
                                                <div class="separator mb-4 mt-4"></div>
                                                <form class="m-b-1 add" id="add_category" action="<?php echo site_url("settings/add_budget_main_category") ?>" name="add_category" method="post">
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Category Name</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Category Name" name="name" />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary save">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="box box-block bg-white p-5">
                                                <div id ="export_cat" class="d-flex justify-content-end"></div>

                                                <h2><strong>List All</strong> Categories</h2>
                                                <div class="table-responsive">
                                                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-3 gy-3" id="xin_table_category" style="width: 100%;" role="grid">
                                                        <thead>
                                                        <tr class="fw-bolder text-muted bg-light">
                                                            <th class="ps-4 rounded-start w-125px">Action</th>
                                                            <th class="ps-4 rounded-start">Categories Name</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (in_array('13', $role_resources_ids)) { ?>

                                <div class="tab-pane fade" id="sub-catogeris" role="tabpanel" aria-labelledby="v-pills-catogeris-tab">
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="box box-block bg-white p-3">
                                                <h4><strong>Add New</strong> Sub Categories</h4>
                                                <div class="separator mb-4 mt-4"></div>
                                                <form class="m-b-1 add" id="add_budget_sub_category" action="<?php echo site_url("settings/add_budget_sub_category") ?>" name="add_budget_sub_category" method="post">
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Main Category</label>
                                                        <select class="form-control form-select form-control-solid mb-3 mb-lg-0" name="main_category">
                                                            <?php $categories = $this->Xin_model->get_all_categories();
                                                            foreach($categories->result() as $row){?>
                                                                <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Sub Category Name</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Sub Category Name" name="name" />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary save">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="box box-block bg-white p-5">
                                                <div id ="export_subcat" class="d-flex justify-content-end"></div>

                                                <h2><strong>List All</strong> Sub Categories</h2>
                                                <div class="table-responsive">
                                                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-3 gy-3" id="xin_table_sub_category" style="width: 100%;" role="grid">
                                                        <thead>
                                                        <tr class="fw-bolder text-muted bg-light">
                                                            <th class="ps-4 rounded-start w-125px">Action</th>
                                                            <th class="ps-4 rounded-start">Category</th>
                                                            <th class="ps-4 rounded-start">Sub Category</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (in_array('14', $role_resources_ids)) { ?>

                                <div class="tab-pane fade" id="cost-center" role="tabpanel" aria-labelledby="v-pills-cost-center-tab">
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="box box-block bg-white p-3">
                                                <h4><strong>Add New</strong> Cost Center</h4>
                                                <div class="separator mb-4 mt-4"></div>
                                                <form class="m-b-1 add" id="add_cost_center" action="<?php echo site_url("settings/add_cost_center") ?>" name="add_cost_center" method="post">
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Cost Center</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Cost Center" name="name" />
                                                        <label class="required fs-6 fw-bold mb-2">Cost Center Code</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Cost Center Code" name="export" />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary save">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="box box-block bg-white p-5">
                                                <div id ="export_cost" class="d-flex justify-content-end"><button id="sync_costcenter" class="btn btn-primary save">Sync Data</button></div>

                                                <h2><strong>List All</strong> Cost Center</h2>
                                                <div class="table-responsive">
                                                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-3 gy-3" id="xin_table_cost_center" style="width: 100%;" role="grid">
                                                        <thead>
                                                        <tr class="fw-bolder text-muted bg-light">
                                                            <th class="ps-4 rounded-start w-125px">Action</th>
                                                            <th class="ps-4 rounded-start">Cost Center Name</th>
                                                            <th class="ps-4 rounded-start">Cost Center Code</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (in_array('34', $role_resources_ids)) { ?>

                                <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="v-pills-cost-center-tab">
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="box box-block bg-white p-3">
                                                <h4><strong>Add New</strong>  Company</h4>
                                                <div class="separator mb-4 mt-4"></div>
                                                <form class="m-b-1 add" id="add_company" action="<?php echo site_url("settings/add_company") ?>" name="add_company" method="post">
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Company</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Company Name" name="name" />
                                                        <label class="required fs-6 fw-bold mb-2">Company Code</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Company Code" name="code" />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary save">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="box box-block bg-white p-5">
                                                <div id ="export_company" class="d-flex justify-content-end"><button id="sync_company" class="btn btn-primary save">Sync Data</button></div>

                                                <h2><strong>List All</strong> Cost Company</h2>
                                                <div class="table-responsive">
                                                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-3 gy-3" id="xin_table_companies" style="width: 100%;" role="grid">
                                                        <thead>
                                                        <tr class="fw-bolder text-muted bg-light">
                                                            <th class="ps-4 rounded-start w-125px">Action</th>
                                                            <th class="ps-4 rounded-start">Company Name</th>
                                                            <th class="ps-4 rounded-start">Company Code</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (in_array('24', $role_resources_ids)) { ?>

                                <div class="tab-pane fade" id="currency" role="tabpanel" aria-labelledby="v-pills-currency-tab">
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="box box-block bg-white p-3">
                                                <h4><strong>Add New</strong> Currency</h4>
                                                <div class="separator mb-4 mt-4"></div>
                                                <form class="m-b-1 add" id="add_currency" action="<?php echo site_url("settings/add_currency") ?>" name="add_currency" method="post">
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Currency Name</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Enter Currency name" name="name" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Currency Code</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Enter currency code" name="code" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Symbol</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Symbol" name="symbol" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Decimal Point</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Enter Decimal point" name="decimalpoint" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">After Decimal Length</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="After Decimal length" name="decimallength" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">1 USD</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="1 USD to your currency" name="usd" />
                                                    </div>

                                                    <button type="submit" class="btn btn-primary save">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="box box-block bg-white p-5">
                                                <div id ="export_currency" class="d-flex justify-content-end"></div>

                                                <h2><strong>List All</strong> Currency</h2>

                                                <div class="table-responsive">
                                                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-3 gy-3" id="xin_table_currency" style="width: 100%;" role="grid">
                                                        <thead>
                                                        <tr class="fw-bolder text-muted bg-light">
                                                            <th class="ps-4 rounded-start w-125px">Action</th>
                                                            <th class="ps-4 rounded-start"> Currency name</th>
                                                            <th class="ps-4 rounded-start"> Code</th>
                                                            <th class="ps-4 rounded-start"> Symbol</th>
                                                            <th class="ps-4 rounded-start"> Decimal Point</th>
                                                            <th class="ps-4 rounded-start"> After decimal length</th>
                                                            <th class="ps-4 rounded-start"> 1 USD</th>

                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (in_array('15', $role_resources_ids)) { ?>

                                <div class="tab-pane fade" id="vendor" role="tabpanel" aria-labelledby="v-pills-vendor-tab">
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="box box-block bg-white p-3">
                                                <h4><strong>Add New</strong> Supplier</h4>
                                                <div class="separator mb-4 mt-4"></div>
                                                <form class="m-b-1 add" id="add_supplier" action="<?php echo site_url("settings/add_supplier") ?>" name="add_supplier" method="post">
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Supplier</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Supplier" name="name" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="required fs-6 fw-bold mb-2">Supplier Ref.No</label>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Supplier Ref.No" name="ref_no" />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary save">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-8">

                                            <div class="box box-block bg-white p-5">
                                                <div id ="export_supplier" class="d-flex justify-content-end"> <button id="sync_vendor" class="btn btn-primary save">Sync Data</button></div>


                                                <h2><strong>List All</strong> Supplier</h2>
                                                <div class="table-responsive">
                                                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-3 gy-3" id="xin_table_supplier" style="width: 100%;" role="grid">
                                                        <thead>
                                                        <tr class="fw-bolder text-muted bg-light">
                                                            <th class="ps-4 rounded-start w-125px">Action</th>
                                                            <th class="ps-4 rounded-start">Supplier</th>
                                                            <th class="ps-4 rounded-start">Ref.No</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
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