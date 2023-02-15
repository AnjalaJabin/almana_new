<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">IT Department Budget</h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>
<form class="mx-auto mw-1000px w-100 pt-15 pb-10" id="approve_budget_form" enctype="multipart/form-data">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">

            <div class="col-md-5">
        <table id="allocation_table" class="table table-row-dashed table-row-gray-300 align-middle">
            <!--begin::Table head-->
            <thead>
            <tr class="fw-bolder text-muted ">
                <th class="">Category</th>
                <th class="">Budget</th>
            </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody>
            <?php
            $total_budget = 0;
            $total_expense = 0;
            foreach($assigned_budget_category->result() as $assigned_budget_category_data)
            {   
                $category_name = $this->Xin_model->read_category_data_by_id($assigned_budget_category_data->category_id);
                if(isset($category_name[0]->name)){
                    $category_name = $category_name[0]->name;
                }else{
                    $category_name = '--';
                }
                $total_budget = $total_budget+$assigned_budget_category_data->amount;

                ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-start flex-column">
                                <a href="#" class="text-dark text-hover-primary mb-1 fs-6"><?php echo $category_name; ?></a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo number_format($assigned_budget_category_data->amount); ?></a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            <tfoot class="bg-light">
            <tr class="px-3">
                <th class="text-dark fw-bolder fs-4 px-3">Total :</th>
                <td class="fw-bolder text-primary fs-4"><?php echo number_format($total_budget); ?></td>
            </tr>
            </tfoot>
        </table>

    </div>
            </div>
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header mt-5">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h1 class="fw-bolder mb-1">Category</h1>
                
            </div>
            <div class="card-toolbar">
            <a href="<?php echo site_url('budgeting/budget_allocation_employees/'.$budget_id); ?>" class="btn btn-success fs-6 btn-sm" title="show employees" >Show Employees</button></a>
           
                 </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">


            <?php
            $category_total_array = array();
            foreach($assigned_budget_category->result() as $assigned_budget_category_data)
            {
                $category_name = $this->Xin_model->read_category_data_by_id($assigned_budget_category_data->category_id);
                if(isset($category_name[0]->name)){
                    $category_name = $category_name[0]->name;
                }else{
                    $category_name = '--';
                }

                $category_total_array[] = array('cat_name' => $category_name, 'amount' => $assigned_budget_category_data->amount);
                $total_budget = $total_budget+$assigned_budget_category_data->amount;

                ?>

                <div class="py-5">
                    <div class="rounded border p-5 bg-light bg-opacity-50">
                        <div class="row">
                            <div class="card-header mt-0 py-0 px-3">
                                <div class="card-title flex-column">
                                    <h2 class="fw-bolder mb-1"><?php echo $category_name; ?></h2>
                                </div>
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-success fs-6 btn-sm">Total: <?php echo number_format($assigned_budget_category_data->amount); ?></a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-row-bordered">
                                        <thead>
                                        <tr class="border-bottom fs-6 fw-bolder text-muted text-uppercase">
                                            <th class="min-w-275px">Sub Catogeries</th>
                                            <th></th>
                                            <th class="text-end">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sub_cat_assign_query = $this->Budgeting_model->get_budget_sub_categories($assigned_budget_category_data->budget_id,$assigned_budget_category_data->category_id);
                                        foreach($sub_cat_assign_query->result() as $sub_cat_assign_data)
                                        {
                                            $sub_category_name = $this->Xin_model->read_sub_category_data_by_id($sub_cat_assign_data->sub_category_id);
                                            if(isset($sub_category_name[0]->name)){
                                                $sub_category_name = $sub_category_name[0]->name;
                                            }else{
                                                $sub_category_name = '--';
                                            }
                                            ?>
                                            <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                                <td class="d-flex align-items-center pt-3"><i class="fa fa-genderless text-danger fs-1 me-2"></i><?php echo $sub_category_name; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".assign_budget_employee" data-budget_id="<?php echo $sub_cat_assign_data->budget_id; ?>" data-sub_cat_id="<?php echo $sub_cat_assign_data->sub_category_id; ?>" data-field_type="budget_assign"><i class="fas fa-users"></i></button>
                                                </td>
                                                <td class="fs-5 pt-3 text-dark fw-boldest"><?php echo number_format($sub_cat_assign_data->amount); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>

        </div>
        <!--end::Card body-->
        <!-- begin::Footer-->
        <div class="d-flex flex-stack flex-wrap px-10 py-10 border-top">
            <!-- begin::Actions-->
            <div class="my-1 me-5">
                <!-- begin::Pint-->

                <!-- begin::Download-->
               <!-- <a href="<?php echo site_url('budgeting/allocation_view/'.$budget_details_info[0]->id); ?>" class="btn btn-warning my-1">View Allocation</a>
                 end::Download-->
            </div>
            <!-- end::Actions-->

        </div>
        <!-- end::Footer-->
    </div>
        </div>
    </div>
</form>
<div class="modal fade assign_budget_employee animated pluse" id="assign_budget_employee"  role="dialog" aria-labelledby="assign_budget_employee" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content" id="ajax_budget_employee"></div>
    </div>
</div>
<?php
$total_amount = 0;
foreach($category_total_array as $category_total_array_data){
    $total_amount=$total_amount+$category_total_array_data['amount'];
}


?>
<div>
</div>

