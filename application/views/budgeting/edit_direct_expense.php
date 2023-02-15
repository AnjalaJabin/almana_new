<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if(isset($_GET['jd']) && isset($_GET['exp_id']) && $_GET['data']=='direct_exp'){


        ?>
   <!--- <script src="assets/js/scripts.bundle.js"></script>--->

<div class="modal-header" id="kt_modal_add_user_header">
	<h2 class="fw-bolder">Edit Direct Expense</h2>
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
<form id="edit_direct_expense" class="form" enctype="multipart/form-data" method="post">
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                        <div class="row form-group mb-3">
                                            <div class="col-md-12">
                                                <label class="required fs-7 mb-2">Description</label>
                                                <input type="hidden" name="exp_id" id="exp_id" value="<?php echo $exp_id; ?>"/>

                                                <input type="text" name="expense_title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" value="<?php echo $exp_title; ?>" />
                                            </div>
                                        </div><div class="row form-group mb-3">
                                            <div class="col-md-6"><label class="required fs-7 mb-2">Entity</label>
                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Company" id="company" name="company">
                                                    <option value="">Select Entity...</option>
                                                    <?php

                                                    $comp_data = $this->Xin_model->get_companies();
                                                    foreach($comp_data->result() as $company) {?>
                                                        <option <?php if($company_id==$company->id){ echo 'selected'; } ?> value="<?php echo $company->id; ?>"><?php echo $company->name; ?></option>
                                                    <?php  }
                                                    ?>
                                                </select></div>
                                            <div class="col-md-6">
                                                <label class="required fs-7 mb-2">Date</label>
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
                                                    <input class="form-control form-control-solid ps-12 datepicker" placeholder="Select a date" name="date" value="<?php echo date('d-m-Y',strtotime($date)); ?>"/>
                                                    <!--end::Datepicker-->
                                                </div> </div>
                                        </div>
                                        <div class="row form-group mb-3">
                                            <div class="col-md-6">
                                                <label class="fs-6 fw-bold mb-2">Cost Center</label>
                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Cost Center" name="cost_center">
                                                    <option value="">Select Cost Center...</option>
                                                    <?php
                                                    $all_cost_centers =$this->Xin_model->get_all_cost_centers();
                                                    foreach($all_cost_centers->result() as $cost_centers){
                                                        
                                                        ?>
                                                        
                                                        <option <?php if($cost_center==$cost_centers->id){ echo 'selected'; } ?> value="<?php echo $cost_centers->id; ?>"><?php echo $cost_centers->name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select></div>

                                            <div class="col-md-6">
                                                <label class="required fs-7 mb-2">Department</label>
                                                <select class="form-control form-select form-control-solid mb-3 mb-lg-0" name="department">
                                                <option value="">Select department...</option>
                                                    <?php $departments = $this->Xin_model->get_all_departments();
                                                    foreach($departments->result() as $r){
                                                        ?>
                                                  
                                                        <option <?php if($department==$r->id){ echo 'selected'; } ?> value="<?php echo $r->id; ?>"><?php echo $r->name; ?></option>


                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group mb-3">
                                            <div class="col-md-6">
                                                <label class="required fs-7 mb-2">Vendor/Supplier</label>
                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Vendor/Supplier" name="supplier_id">
                                                    <option value="">Select Supplier...</option>
                                                    <?php
                                                    $all_suppliers =$this->Xin_model->get_all_suppliers();
                                                    foreach($all_suppliers->result() as $suppliers){
                                                        ?>

                                                        <option <?php if($vendor==$suppliers->id){ echo 'selected'; } ?> value="<?php echo $suppliers->id; ?>"><?php echo $suppliers->name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="required fs-7 mb-2">Supplier Ref No</label>
                                                <input type="text" class="form-control form-control-solid" placeholder="Supplier Ref No" name="supplier_ref" value="<?php echo $supp_refno; ?>" />
                                            </div>
                                        </div>
                                        <div class="row form-group mb-3">
                                        <div class="col-md-6">
                                        <label class="required fs-7 mb-2">Employee Code</label>
                                                <input type="text" class="form-control form-control-solid" placeholder="Employee Code" name="emp_code" value="<?php echo $employee_code;?>" />
                                                </div>
                                                <div class="col-md-3">
                                                <label class="required fs-7 mb-2"> Amount </label>
                                                <input type="text" class="form-control form-control-solid" placeholder="Amount" id="current_expense_amount" name="amount" value="<?php echo $amt;?>" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="required fs-7 mb-2">Currency</label>
                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Currency" name="currency" >
                                                    <option value="">Select Currency...</option>
                                                        <?php
                                                        $currency_data = $this->Xin_model->get_currencies(1);
                                                        foreach($currency_data->result() as $currencies) {
                                                            ?>
                                                            <option <?php if($currency==$currencies->code){ echo 'selected'; } ?> value="<?php echo $currencies->code; ?>"><?php echo $currencies->code; ?></option>

                                                            <?php
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                                </div>
                                        <div class="row form-group mb-3">
                                            
                                            <div class="col-md-6">
                                                <label class="fs-6 fw-bold mb-2">  File  </label>
                                                <input type="file" class="form-control form-control-solid" placeholder="Status" name="file"   accept=".pdf"  />
                                                <div class="form-text">Allowed file types: pdf</div>

                                                <?php
                                                    if(!empty($file)){
                                                        ?>
                                                        <input type="hidden" name="expense_file_name" value="<?php echo $file; ?>"/>
                                                        <a class="symbol symbol-20px mb-5" target="blank" href="<?php echo site_url('uploads/expense_files/'.$file); ?>"><i class="fa fa-file"></i> View Uploaded Document</a>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-7 mb-2">Tax</label>
                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Tax" id="tax" name="tax">
                                                    <option value="">Select Tax...</option>
                                                    <?php

                                                    $tax_data = $this->Xin_model->get_taxes();

                                                    foreach($tax_data->result() as $tax) {?>

                                                        <option <?php if($tax_code==$tax->tax_code){ echo 'selected'; } ?> value="<?php echo $tax->tax_code?>"><?php echo $tax->tax_code."   -  ".$tax->name?></option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-3">
                                            <label class="fs-6 fw-bold mb-2">Detailed Description</label>
                                            <textarea class="form-control form-control-solid" rows="3" name="expense_description" placeholder="Free field to describe the description of the expense"> <?php echo $detail_des;?></textarea>
                                        </div>

                                    </div>
                                    <div class="text-center pt-3 pb-3">
                                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Update</span>
                                            <span class="indicator-progress">Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </form>
</div>

<!--end::Modal body-->

<script type="text/javascript">
 $(document).ready(function(){
     //$(".form-select").select2();
		// On page load: datatable
		var xin_table = $('#xin_table_employee').dataTable({
        	"bDestroy": true,
        	"ajax": {
        		url : site_url+"/employees/empolyee_list/",
        		type : 'GET'
        	},
        	"fnDrawCallback": function(settings){
        	$('[data-toggle="tooltip"]').tooltip();
        	}
        });

		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });

		/* Edit data */
		$("#edit_direct_expense").submit(function(e){
            e.preventDefault();
			var fd = new FormData(this);
			var obj = $(this), action = obj.attr('name');
			fd.append("is_ajax", 2);
			fd.append("edit_type", 'update_direct_expense');
			fd.append("form", action);
			e.preventDefault();
			$('.save').prop('disabled', true);
			$.ajax({
				url: site_url + '/budgeting/update_direct_expense/',
				type: "POST",
				data:  fd,
				contentType: false,
				cache: false,
				processData:false,
				success: function(JSON)
				{
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('.save').prop('disabled', false);
					} else {
                        toastr.success(JSON.result);
                         $('.view-modal-data').modal('toggle');
                        tbl_direct_exp.ajax.reload();

					}
				},
				error: function()
				{
					toastr.error(JSON.error);
					$('.save').prop('disabled', false);
				}
		   });
		});

     });
  </script>
<?php } ?>