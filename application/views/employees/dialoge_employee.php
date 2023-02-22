<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['employee_id']) && $_GET['data']=='employee'){

    if(isset($profile_picture) && !empty($profile_picture))
    {
        $profile_picture = 'uploads/profile/'.$profile_picture;
    }
    else
    {
        $profile_picture='assets/media/avatars/blank.png';
    }
    $periods =$this->Xin_model->get_all_periods();

    ?>
    <!--- <script src="assets/js/scripts.bundle.js"></script>--->

    <div class="modal-header" id="kt_modal_add_user_header">
        <h2 class="fw-bolder">Edit User</h2>
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
        <form id="edit_employee" class="form" enctype="multipart/form-data" method="post" action="<?php echo site_url("employees/update")?>">
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                <div class="fv-row mb-7">
                    <input type="hidden" name="user_id" value="<?php echo $user_id?>">

                    <label class="d-block fw-bold fs-6 mb-5">Avatar</label>
                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/avatars/blank.png)">
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(<?php echo $profile_picture?>)"></div>
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
                        <input type="text" name="user_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="<?php echo $first_name?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="required fw-bold fs-6 mb-2">Email</label>
                        <input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" value="<?php echo $email?>"/>
                    </div>
                </div>
                <div class="row form-group mb-7">
                    <div class="col-md-6">
                        <label class="required fw-bold fs-6 mb-2">Phone Number</label>
                        <input type="text" name="user_mobile" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Phone Number" value="<?php echo $contact_no?>"/>
                    </div>
                    <div class="col-md-6">
                        <label class="required fw-bold fs-6 mb-2">Department</label>
                        <select class="form-select form-select-lg form-select-solid" data-placeholder="Select Department" data-allow-clear="true" data-hide-search="true" name="department">
                            <?php $departments = $this->Xin_model->get_all_departments();
                            foreach($departments->result() as $r){?>
                                <option value="<?php echo $r->id?>" <?php if($r->id==$department_id) echo 'selected';?>><?php echo $r->name?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="row form-group mb-7">
                    <div class="col-md-6">
                        <label class="required fw-bold fs-6 mb-2">Permission Role</label>
                        <select class="form-select form-select-lg form-select-solid" data-placeholder="Select Permission" data-allow-clear="true" data-hide-search="true" name="permission">
                            <?php $roles = $this->Xin_model->get_all_roles();
                            foreach($roles->result() as $r){?>
                                <option value="<?php echo $r->role_id?>" <?php if($r->role_id==$user_role_id) echo 'selected';?>><?php echo $r->role_name?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="required fw-bold fs-6 mb-2">Status</label>
                        <select class="form-select form-select-lg form-select-solid" name="status">
                            <option value="1" <?php if($status==1) echo 'selected'?>>Active</option>
                            <option value="2" <?php if($status==2) echo 'selected'?>>In-Active</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group mb-7">
                    <div class="col-md-12">

                        <label class="fw-bold fs-6 mb-2">Stores Allocated</label>
                        <select class="form-control form-select form-control-solid mb-3 mb-lg-0 " id="store-select" name="stores[]" multiple>
                            <?php $stores = $this->Xin_model->get_all_stores();
                            $selected_stores = explode(",", $stores_user); // convert the string to an array

                            foreach($stores->result() as $r){
                                $is_selected = in_array($r->id, $selected_stores);
                                ?>
                                <option value="<?php echo $r->id?>" <?php if ($is_selected) echo "selected"?>><?php echo $r->name?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <div class="row form-group mb-7">
                    <div class="col-md-6">
                        <label class="required fw-bold fs-6 mb-2">Employee Code</label>
                        <input type="text" name="emp_code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="emp_code" value="<?php echo $emp_code?>"/>
                    </div>
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
    <!--end::Modal body-->

    <script type="text/javascript">
        $(document).ready(function(){
            var periods = JSON.parse('<?php echo json_encode($periods->result()); ?>');

            $(".form-select").select2();

            // On page load: datatable
            var xin_table = $('#xin_table_employee').DataTable({
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
            $("#edit_employee").submit(function(e){
                e.preventDefault();
                var fd = new FormData(this);
                var obj = $(this), action = obj.attr('name');
                fd.append("is_ajax", 2);
                fd.append("edit_type", 'edit_employee');
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
                            if(JSON.session != ''){
                                $('#profile_name').html(JSON.session.name);
                                $('#prof_department').html(JSON.session.department);
                                $('#prof_designation').html(JSON.session.designation);
                                if(JSON.session.profile_picture != ''){
                                    var prof_pic  = window.location.origin + '/uploads/profile/'+ JSON.session.profile_picture;
                                    $('#profile_pic').attr('src',prof_pic);
                                    $('#prof_pic_small').attr('src',prof_pic);
                                }



                            }
                            $('.edit-modal-data').modal('toggle');
                            $('.save').prop('disabled', false);
                            xin_table.ajax.reload(function(){
                                toastr.success(JSON.result);
                            }, true);

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