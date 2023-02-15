<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<div class="modal-header" id="kt_modal_add_user_header">
	<h2 class="fw-bolder">Request Details</h2>
	<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
		<span class="svg-icon svg-icon-1">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
				<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
			</svg>
		</span>
	</div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">

                <!--begin::Navbar-->
                <div class="card mb-15 mb-xl-6">
                    <div class="card-body pt-6 pb-0">
                        <input type="hidden" name="budget_id" id="budget_id" value="<?php echo $budget_id; ?>"/>

                        <table class="table table-row-dashed table-row-gray-300 align-middle">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted ">
                                <th class=""></th>
                                <th class=""></th>
                                <th class=""></th>
                                <th class=""></th>

                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Description:</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $request_data[0]->expense_type; ?></a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Date:</a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $request_data[0]->requested_date; ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Requested By:</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $request_data[0]->requested_by; ?></a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Employee ID:</a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $request_data[0]->requester_id; ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Department:</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $request_data[0]->department_name; ?></a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Sub-Category:</a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $request_data[0]->sub_category_name; ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Requested Amouont:</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $request_data[0]->requested_amount; ?></a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Currency:</a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo "AED"; ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Status:</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $request_status; ?></a>
                                </td>
                                                           </tr>
                            <?php
                            if($request_data[0]->request_status!=2){
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Approved Amount:</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    if($request_data[0]->request_status==0){
                                    ?>
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter approved amount" name="amount" id="approved_amount" />
                                    <?php
                                    }else{
                                        ?>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo $request_data[0]->approved_amount; ?></a>

                                    <?php }
                                    ?>
                                </td>
                                <td>
                                    <a href="#" class="text-dark text-hover-primary mb-1 fs-6">Currency:</a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo "AED"; ?></a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>

                        <div class="d-flex flex-wrap align-middle">

                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">

                                <!--begin::Stat-->
                                <div class="border border-primary border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder text-primary"><?php echo number_format($cat_total); ?></div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">Category Total</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-warning border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder text-warning"><?php echo number_format($total_used); ?></div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">Category Expenses</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-success border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder text-success"><?php echo number_format($cat_total-$total_used); ?></div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">Category Balance</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>        <div class="separator mb-4 mt-4"></div>
                                <div class="d-flex flex-wrap align-middle">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <div class="border border-primary border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <div class="fs-4 fw-bolder text-primary"><?php echo number_format($total_assigned); ?></div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-6 text-gray-400">Assigned to User</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-warning border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <div class="fs-4 fw-bolder text-warning"><?php echo number_format($total_by_user); ?></div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-6 text-gray-400">User Expenses</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-success border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <div class="fs-4 fw-bolder text-success"><?php echo number_format($request_data[0]->requested_amount); ?></div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-6 text-gray-400">Requested Amount</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->

                                    </div>
                                    <!--end::Stats-->
                                </div>
                        <?php
                        if($request_data[0]->request_status==0){
                            ?>
                        <div class="d-flex mb-4 mt-4 align-middle">
                            <a href="#" id="approve_btn" class="btn btn-sm btn-success me-3"data-bs-toggle="modal" data-bs-target=".approve-modal"  data-record-id="<?php echo $request_data[0]->request_id;?>"  title="Approve" >Approve</a>
                            <a href="#" id="reject_btn"class="btn btn-sm btn-danger me-3"data-bs-toggle="modal" data-bs-target=".approve-modal"  data-record-id="<?php echo $request_data[0]->request_id;?>"  title="Decline">Decline</a>
                            <a href="#" id="hold_btn" class="btn btn-sm btn-primary me-3">Hold</a>

                        </div>
                    <?php
                        }

                        ?>

                            </div>





                        </div>
</div>
                      </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $( "#hold_btn" ).click(function() {
            $('#view-modal-data').modal('toggle');

        });
        $( "#approve_btn" ).click(function() {
            $('input[name=_token]').val($(this).data('record-id'));
            $('input[name=_method]').val("approve");
            $('.approve-modal').modal('toggle');
        });
        $( "#reject_btn" ).click(function() {
            $('input[name=_token]').val($(this).data('record-id'));
            $('input[name=_method]').val("decline");
            $('.approve-modal').modal('toggle');
        });

        $("#request_action").submit(function(e) {

            /*Form Submit*/
            e.preventDefault();
            $('.approve-modal').modal('toggle');
            var amount =0;
            var request_id  = $('input[name=_token]').val();
            var method      = $('input[name=_method]').val();
            var amount      = $('#approved_amount').val();
            var budget_id   = $('#budget_id').val();
            $.ajax({
                type: "POST",
                url: site_url+'request/request_action/'+request_id+'/',
                data: "is_ajax=2&request_id="+request_id+"&method="+method+"&amount="+amount+"&budget_id="+budget_id,
                cache: false,
                success: function (JSON) {

                    if (JSON.error != '') {
                        Swal.fire({
                            text: JSON.error,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            text: JSON.result,
                            icon: "success",
                        });
                        window.location = JSON.redirect_url;
                        window.location.replace(JSON.redirect_url);
                        window.location.href = JSON.redirect_url;
                    }


                }

        });
        });

    });
