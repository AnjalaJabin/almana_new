<?php
$role_resources_ids = $this->Xin_model->user_role_resource();
?>
<style>
    .cb-dropdown-wrap {
        max-height: 200px; /* At most, around 3/4 visible items. */
        position: relative;
        height: 20px;
    }

    .cb-dropdown,
    .cb-dropdown li {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .cb-dropdown {
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid #888;
    }

    /* For selected filter. */
    .active .cb-dropdown {
        background: pink;
    }

    .cb-dropdown-wrap:hover .cb-dropdown {
        height: 200px;
        overflow: auto;
        transition: 0.2s height ease-in-out;
    }

    /* For selected items. */
    .cb-dropdown li.active {
        background: #ff0;
    }

    .cb-dropdown li label {
        color: #0a2b1d;
        display: block;
        position: relative;
        cursor: pointer;
        line-height: 19px; /* Match height of .cb-dropdown-wrap */
    }

    .cb-dropdown li label > input {
        position: absolute;
        right: 0;
        top: 0;
        width: 16px;
    }

    .cb-dropdown li label > span {
        display: block;
        margin-left: 3px;
        margin-right: 20px; /* At least, width of the checkbox. */
        font-family: sans-serif;
        font-size: 13px;
        font-weight: normal;
        text-align: left;
    }

    /* This fixes the vertical aligning of the sorting icon. */
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc,
    table.dataTable thead .sorting_asc_disabled,
    table.dataTable thead .sorting_desc_disabled {
        background-position: 100% 10px;
    }
</style>
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Direct Expense List &nbsp;</h1>
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
        <!--begin::Stats-->
        <div class="row ">

            <div class="card card-flush">
                <!--begin::Header-->
                <div class="card-header border-0" id ="top_div">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">All Expenses</span>
                        <span class="text-muted mt-1 fw-bold fs-7"><?php echo count($expenses); ?> direct expenses </span>
                    </h3>

                    <div class="card-toolbar">



                        <ul class="nav">

                            <li class="nav-item">
<!--                                <button type="button" id="clear_filter" class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1" >-->
<!--<span class="svg-icon svg-icon-2">-->
<!---->
<!--						</span>-->
<!--                                Clear Filters</button>-->
<!---->                                <div id="export_div"></div>

                            </li>

                        </ul>
                    </div>

                </div>

                <div class="modal fade " id="kt_modal_add_user" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-lg modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_add_user_header">
                                <h2 class="fw-bolder">Add Direct Expense</h2>
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
                                <form id="add_direct_expense_form" class="form" enctype="multipart/form-data" method="post">
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                        <div class="row form-group mb-3">
                                            <div class="col-md-12">
                                                <label class="required fw-bold fs-6 mb-2">Description</label>
                                                <input type="text" name="exp_title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" />
                                            </div>
                                        </div>
                                        <div class="row form-group mb-3">
                                            <div class="col-md-6">
                                                <label class="required fs-7 fw-bold mb-2">Entity</label>
                                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_user" data-allow-clear="true" data-placeholder="Select Company" id="company" name="company">
                                                    <option value="">Select Entity...</option>
                                                    <?php

                                                    $comp_data = $this->Xin_model->get_companies();
                                                    foreach($comp_data->result() as $company) {?>
                                                        <option value="<?php echo $company->id?>"><?php echo $company->name?></option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="required fs-7 fw-bold mb-2">Date</label>
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
                                                </div> </div>
                                        </div>
                                        <div class="row form-group mb-3">
                                            <div class="col-md-6">
                                                <label class="fs-7 fw-bold mb-2">Cost Center</label>
                                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_user" data-allow-clear="true" data-placeholder="Select Cost Center" name="cost_center">
                                                    <option value="">Select Cost Center...</option>
                                                    <?php
                                                    $all_cost_centers =$this->Xin_model->get_all_cost_centers();
                                                    foreach($all_cost_centers->result() as $cost_centers){
                                                        echo '<option value="'.$cost_centers->id.'">'.$cost_centers->name.'</option>';
                                                    }
                                                    ?>
                                                </select></div>
                                            <div class="col-md-6">
                                                <label class="required fw-bold fs-6 mb-2">Department</label>
                                                <select class="form-control form-select form-control-solid mb-3 mb-lg-0" name="department" data-control="select2" data-dropdown-parent="#kt_modal_add_user" data-allow-clear="true">
                                                    <?php $departments = $this->Xin_model->get_all_departments();
                                                    foreach($departments->result() as $r){?>
                                                        <option value="<?php echo $r->id?>"><?php echo $r->name?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>


                        </div>
                                        <div class="row form-group mb-3">
                                        <div class="col-md-6">
                                        <label class="required fs-7 fw-bold mb-2">Employee Code</label>
                                                <input type="text" class="form-control form-control-solid" placeholder="Employee Code" name="emp_code" />
                                                </div>
                                                <div class="col-md-3">
                                                <label class="required fs-7 fw-bold mb-2"> Amount </label>
                                                <input type="text" class="form-control form-control-solid" placeholder="Amount" id="current_expense_amount" name="amount" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="required fs-7 fw-bold mb-2">Currency</label>
                                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_user" data-allow-clear="true" data-placeholder="Select Currency" name="currency">
                                                    <option value="">Select Currency...</option>
                                                        <?php
                                                        $default_currency  = $this->Xin_model->get_default_currency();

                                                        $currency_data = $this->Xin_model->get_currencies(1);
                                                        foreach($currency_data->result() as $currencies) {?>
                                                  <option value="<?php echo $currencies->code?>"<?php if($default_currency[0]->default_currency_symbol==$currencies->code) echo 'selected';?>><?php echo $currencies->code?></option>
                                                     <?php   }
                                                        ?>
                                                </select>
                                            </div>
                                                </div>
                                    <div class="row form-group mb-3">
                                        <div class="card-header" id="select_supp_div" style="display:block;">
                                            <div class="card-title fs-3 fw-bolder">

                                                <div class="w-200 w-md-600px" style="background: rgb(221, 221, 221); padding: 7px;">
                                                    <div class="input-group">

                                                        <select id="supplier_dropdown" name="supplier_id" class="form-select form-select-solid select_supplier_list" data-placeholder="Vendor/Supplier" data-control="select2" data-dropdown-parent="#kt_modal_add_user" data-allow-clear="true">

                                                            <!--                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Vendor/Supplier" name="supplier_id">-->
                                                            <option value="">Select Supplier...</option>
                                                            <?php
                                                            $all_suppliers =$this->Xin_model->get_all_suppliers();
                                                            foreach($all_suppliers->result() as $suppliers){
                                                                echo '<option value="'.$suppliers->id.'">'.$suppliers->name.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="text" class="form-control form-control-solid" placeholder="Supplier Ref No" name="supplier_ref" />
                                                        <?php if(in_array('15',$role_resources_ids)) {?>

                                                        <span class="input-group-btn">
                                                                                <button class="btn btn-success group_add_main_cat_sub_btn" id="add_supplier" type="button"><i class="fa fa-plus"></i></button>
                                                                           </span>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card-header" id="add_supplier_div" style="display:none;">
                                            <div class="card-title fs-3 fw-bolder">

                                                <div class="w-200 w-md-600px" style="background: rgb(221, 221, 221); padding: 7px;">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control group_add_main_cat_val" placeholder="Supplier Name"  id="sup_name" name="name">
                                                        <input type="text" class="form-control form-control-solid" placeholder="Supplier Ref.No" id="sup_ref_no" name="ref_no" />

                                                        <span class="input-group-btn">
                                                                                <button class="btn btn-success group_add_main_cat_sub_btn" id="save_supplier" type="button"><i class="fa fa-save"></i></button>
                                                                           </span>
                                                        <span class="input-group-btn">
                                                                                <button class="btn supplier_close_btn" type="button">X</button>
                                                                           </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                        <div class="row form-group mb-3">

                                            <div class="col-md-6">
                                                <label class="fs-7 fw-bold mb-2">  File  </label>
                                                <input type="file" class="form-control form-control-solid" placeholder="Status" name="file"  accept=".pdf"  />
                                                <div class="form-text">Allowed file types: pdf</div>

                                            </div>
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-7 fw-bold mb-2">Tax</label>
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
                                        </div>
                                        <div class="d-flex flex-column mb-8">
                                            <label class="fs-7 fw-bold mb-2">Detailed Description</label>
                                            <textarea class="form-control form-control-solid" rows="3" name="expense_description" placeholder="Free field to describe the description of the expense"></textarea>
                                        </div>

                                    </div>
                                    <div class="text-center pb-5">
                                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
<!--                </div>-->


                <div class="card-body py-2">
                    <!--end::Header-->
                    <div class="row">
                        <div class="col-md-4 fv-row">
                            <label class="fs-7 fw-bold mb-2">Date Range</label>

                            <div id="reportrange" class='form-control form-select-solid'>
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div>
                                    <!--end::Datepicker-->
                        </div>
                                <!--end::Input-->
                        <div class="col-md-2 fv-row">
                            <input id="user_name" value="<?php echo $user_data[0]->user_id?>" type="hidden">
                            <label class="fs-7 fw-bold mb-2">Expense Type</label>
                            <select id="employee_filter" name="employee" data-control="select2" data-hide-search="true" class="form-select select2down form-select-solid">
                                <option value="all" selected="selected">All Expenses</option>
                                <option value="direct" selected="selected">Direct Expenses</option>
                                <option value="budget" selected="selected">Budget Expenses</option>
                                <option value="<?php echo $user_data[0]->user_id?>">My Expenses</option>
                            </select>
                        </div>
<!--                        <div class="col-md-2 fv-row">-->
<!--                            <label class="fs-7 fw-bold mb-2">Employee</label>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-2 fv-row">-->
<!--                            <label class="fs-7 fw-bold mb-2">Expense Title</label>-->
<!--                            <div id ="filter_area_2">-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!---->
<!---->
<!--                    </div>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-2 fv-row">-->
<!--                            <label class="fs-7 fw-bold mb-2">Expense ID</label>-->
<!--                        <div id ="filter_area_0">-->
<!--                        </div>-->
<!--                        </div>-->
<!---->
<!--                    <div class="col-md-2 fv-row">-->
<!--                        <label class="fs-7 fw-bold mb-2">Currency</label>-->
<!--                        <div id ="filter_area_4">-->
<!--                        </div>-->
<!--                    </div><div class="col-md-2 fv-row">-->
<!--                        <label class="fs-7 fw-bold mb-2">Cost Center</label>-->
<!--                        <div id ="filter_area_5">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-2 fv-row">-->
<!--                        <label class="fs-7 fw-bold mb-2">Supplier</label>-->
<!--                        <div id ="filter_area_6">-->
<!--                        </div>-->
<!--                    </div>-->
                        <div class ="col-md-4 fv-row">
                            <label class="fs-7 fw-bold mb-2">Search</label>
                            <div class="d-flex align-items-center position-relative my-1" >
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span>
                                <!--end::Svg Icon-->
                                <input type="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-330px ps-14" id='filter_exp' placeholder="Search" />
                            </div>

                        </div>
                        <div class ="col-md-2 fv-row">

                            <?php if(in_array('26',$role_resources_ids)) {?>
                                <label class="fs-7 fw-bold mb-2">Add new</label>
                                <button type="button" class="nav-link btn btn-color-muted btn-active btn-active-dark active fw-bolder px-4 py-3 me-1" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
								<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
							</svg>
						</span>
                                    <!--end::Svg Icon-->Add Direct Expense</button>
                                <?php } ?>

                        </div>
                    </div>

                            <table>    <tbody>
                                </tbody></table>
                            <table id="direct_exp_table" class="table table-row-bordered gy-2">
                                <thead>
                                <tr class="fw-bold fs-6 text-muted">
                                    <th class="ps-4 rounded-start">Expense ID</th>
                                    <th class="min-w-75px ps-4 rounded-start">Date</th>
                                    <th class="ps-4 rounded-start">Description</th>
                                 <!--   <th class="ps-4 rounded-start">Emp Code</th>-->
                                    <th class="ps-4 rounded-start">Amount</th>
                                    <th class="ps-4 rounded-start">Currency</th>
                                  <!--  <th class="ps-4 rounded-start">Description</th>-->
                                    <th class="ps-4 rounded-start">Cost center</th>
                                    <th class="ps-4 rounded-start">Supplier</th>
                                    <th class="ps-4 rounded-start">Added By</th>
                                    <th class="ps-4 rounded-start">Added ByID</th>

                                    <th>Exp Type</th>

                                    <th class="ps-4 rounded-start">Actions</th>

                                </tr>
<!--                                <tr>-->
<!--                                    <th><div id ="filter_area_0"></th>-->
<!--                                    <th></th>-->
<!--                                    <th  class="ps-4 rounded-start"><div id ="filter_area_2"></th>-->
<!--                                    <th></th>-->
<!--                                    <th><div id ="filter_area_4"></th>-->
<!--                                    <th><div id ="filter_area_5"></th>-->
<!--                                    <th><div id ="filter_area_6"></th>-->
<!--                                    <th> <div id ="filter_area_7"></th>-->
<!--                                    <th></th>-->
<!--                                    <th></th>-->
<!--                                    <th></th>-->
<!---->
<!---->
<!--                                </tr>-->
                                </thead>
                                <tbody>
                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end::Stats-->
    </div>
    <!--end::Container-->
</div>