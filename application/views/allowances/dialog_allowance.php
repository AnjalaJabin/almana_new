<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['allowance_id']) && $_GET['data']=='allowance'){


    $periods =$this->Xin_model->get_all_periods();

    ?>
    <!--- <script src="assets/js/scripts.bundle.js"></script>--->

    <div class="modal-header" id="kt_modal_add_user_header">
        <h2 class="fw-bolder">Edit User Allowance</h2>
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
        <form id="edit_allowance" class="form" enctype="multipart/form-data" method="post" action="<?php echo site_url("allowances/update")?>">
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">



                <div class="row form-group mb-7">
                    <div class="col-md-12">
                        <input type="hidden" name="allowance_id" value="<?php echo $allowance->id;?>">

                        <label class="required fw-bold fs-6 mb-2">Employee</label>
                        <select class="form-control form-select form-select form-control-solid mb-3 mb-lg-0" data-controls="select2" data-placeholder="Select Employee" data-allow-clear="true"  id="employeeselect" name="employee">
                            <?php $employees = $this->Xin_model->get_all_employees();
                            foreach($employees as $r){?>
                                <option value="<?php echo $r->user_id?>"<?php if($r->user_id==$allowance->employee_id) echo 'selected';?>><?php echo $r->first_name." ".$r->last_name?></option>
                            <?php }?>
                        </select>
                    </div>

                </div>


                <div id="allowance-div1">


                            <div class="row form-group mb-3">
                                <div class="card-header" id="select_period_div" style="display:block;">
                                    <div class="card-title fs-3 fw-bolder">

                                        <div class="w-200 w-md-600px" style="background: rgb(221, 221, 221); padding: 7px;">
                                            <div class="input-group">

                                                <select  id="periodselect" name="period" class="form-select form-select-solid select_period" data-placeholder="Allowance Period" >

                                                    <!--                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Vendor/Supplier" name="supplier_id">-->
                                                    <option value="">Select Allowance Period..</option>

                                                    <?php
                                                    foreach($periods->result() as $period){
                                                        $is_selected="";
                                                        if($period->id==$allowance->period_id)
                                                            $is_selected="selected";
                                                        echo '<option value="'.$period->id.'" '.$is_selected.'>'.date('j M Y', strtotime($period->from_date)).' - '.date('j M Y', strtotime($period->to_date)).'('.$period->category.')'.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <input type="text" class="form-control form-control-solid" value="<?php echo $allowance->amount;?>" placeholder="Amount" name="amount" />
<!--                                                --><?php //if($key==0){?>
<!--                                                    <span class="input-group-btn">-->
<!--                                                                                <button id="add_row" onclick="generateRow();" class="btn btn-success group_add_main_cat_sub_btn add_period1" type="button"><i class="fa fa-plus"></i></button>-->
<!--                                                                </span>-->
<!--                                                --><?php //}?>
<!--                                                <span class="input-group-btn">-->
<!--                                                                                <button style="display:none;" class="btn btn-danger group_add_main_cat_sub_btn remove_period"  type="button"><i class="fa fa-times"></i></button>-->
<!--                                                                </span>-->
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>


                </div>

                <div class="row form-group mb-7">

                    <div class="text-right pt-5">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
    				<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </div>
        </form>
    </div>
    </div>
    </div>
    <!--end::Modal body-->

    <script type="text/javascript">
        $(document).ready(function(){
            $('#periodselect').select2();
            var periods = JSON.parse('<?php echo json_encode($periods->result()); ?>');


            // On page load: datatable
            var xin_table = $('#xin_table_employee').DataTable({
                "bDestroy": true,
                "ajax": {
                    url : site_url+"/allowances/employee_list/",
                    type : 'GET'
                },
                "fnDrawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();
                },
                columnDefs: [
                    {
                        target: 8,
                        visible: false,
                    },
                ],
            });

            $('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
            $('[data-plugin="select_hrm"]').select2({ width:'100%' });

            /* Edit data */
            $("#edit_allowance").submit(function(e){
                e.preventDefault();
                var fd = new FormData(this);
                var obj = $(this), action = obj.attr('name');
                fd.append("is_ajax", 2);
                fd.append("edit_type", 'edit_allowance');
                fd.append("form", action);
                e.preventDefault();
                $('.save').prop('disabled', true);
                $.ajax({
                    url: e.target.action,
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
                            $('.edit-modal-data').modal('toggle');
                            $('.save').prop('disabled', false);
                            xin_table.ajax.reload();

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
        function formatDate(dateString) {
            var date = new Date(dateString);
            var day = date.getDate();
            var month = date.toLocaleString('default', { month: 'short' });
            var year = date.getFullYear();
            return day + ' ' + month.toUpperCase() + ' ' + year;
        }

        function generateRow() {
            var html = '<div class="row form-group mb-3">';
            html += '<div class="card-header" id="select_period_div" style="display:block;">';
            html += '<div class="card-title fs-3 fw-bolder">';
            html += '<div class="w-200 w-md-600px" style="background: rgb(221, 221, 221); padding: 7px;">';
            html += '<div class="input-group">';
            html += '<select  name="period[]" class="form-select form-select-solid select_period" data-placeholder="Allowance Period"  data-allow-clear="true">';
            html += '<option value="">Select Allowance Period..</option>';
            $.each(periods, function(i, period) {
                html += '<option value="' + period.id + '">' + formatDate(period.from_date) + ' - ' + formatDate(period.to_date) + '</option>';
            });
            html += '</select>';
            html += '<input type="text" class="form-control form-control-solid" placeholder="Amount" name="amount[]" />';
            // html += '<span class="input-group-btn">';
            // html += '<button class="btn btn-success group_add_main_cat_sub_btn add_period" type="button"><i class="fa fa-plus"></i></button>';
            // html += '</span>';
            html += '<span class="input-group-btn">';
            html += '<button class="btn btn-danger group_remove_main_cat_sub_btn" type="button"><i class="fa fa-times"></i></button>';
            html += '</span>';
            html += '</div></div></div></div></div>';
            $("#allowance-div1").append(html);

            // Initialize select2 for the new row
            $('.select_period').select2();


        }

        // Add new row
        // $(document).on('click', '#add_row', function() {
        //     // $(this).hide();
        //     // $(this).closest('.input-group').find('.remove_period').attr("style", "display:block");
        //     console.log("click");
        //
        //     generateRow();
        // });

        // Remove current row
        $(document).on('click', '.group_remove_main_cat_sub_btn', function() {
            $(this).closest('.row.form-group.mb-3').remove();
        });

        // $('#store-select').select2();

    </script>
<?php } ?>