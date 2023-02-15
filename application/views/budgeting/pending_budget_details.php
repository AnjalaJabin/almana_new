<!--begin::Toolbar-->
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
<!--end::Toolbar-->
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
	<!--begin::Container-->
	<div id="kt_content_container" class="container-xxl">
		<div class="row g-2 g-xl-3">
			<div class="col-lg-12">
				<!--begin::Navbar-->
				<div class="card mb-6 mb-xl-6">
					<div class="card-body pt-6 pb-0">
						<div class="row">
							<!--begin::Details-->
							<div class="col-md-4 align-middle">
								<!--begin::Wrapper-->
								<div class="flex-grow-1">
									<!--begin::Head-->
									<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
										<!--begin::Details-->
										<div class="d-flex flex-column">
											<!--begin::Status-->
											<div class="d-flex align-items-center mb-1">
												<a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3"><?php echo $budget_details_info[0]->budget_name."(".$budget_details_info[0]->currency.")"; ?> </a>
												<span class="badge badge-light-success me-auto">In Progress</span>
											</div>
											<!--end::Status-->
											<!--begin::Description-->
											<div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400"><?php echo date('d-m-Y',strtotime($budget_details_info[0]->date_from)).' - '.date('d-m-Y',strtotime($budget_details_info[0]->date_to)); ?></div>
											<!--end::Description-->
										</div>
										<!--end::Details-->
									</div>
									<!--end::Head-->
									<!--begin::Info-->
									<div class="d-flex flex-wrap align-middle">
										<!--begin::Stats-->
										<div class="d-flex flex-wrap">
											<!--begin::Stat-->
											<div class="border border-primary border-solid rounded min-w-125px py-3 px-4 me-6 mb-3">
												<!--begin::Number-->
												<div class="d-flex align-items-center">
													<div class="text-end fs-4 fw-bolder text-primary"><?php echo $budget_details_info[0]->currency.' '.number_format($budget_details_info[0]->amount,2); ?></div>
												</div>
												<!--end::Number-->
												<!--begin::Label-->
												<div class="fw-bold fs-6 text-gray-400">Pending Budget</div>
												<!--end::Label-->
											</div>
											<!--end::Stat-->
										</div>
										<!--end::Stats-->
									</div>
									<!--end::Info-->
								</div>
								<!--end::Wrapper-->
								<div class="separator mb-4 mt-4"></div>
							</div>
							<div class="col-md-3 align-middle">
								<!--begin::Wrapper-->
								<div class="flex-grow-1">
									<!--begin::Chart-->
									<div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
										<div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
											<span class="fs-2qx fw-bolder">100</span>
											<span class="fs-6 fw-bold text-gray-400">Requests</span>
										</div>
										<canvas id="project_overview_chart"></canvas>
									</div>
									<!--end::Chart-->
									<div class="separator mb-4 mt-4"></div>
									<!--begin::Labels-->
									<div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
										<!--begin::Label-->
										<div class="d-flex fs-6 fw-bold align-items-center mb-3">
											<div class="bullet bg-success me-3"></div>
											<div class="text-gray-400">Pending</div>
											<div class="text-end ms-auto fw-bolder text-gray-700"><?php echo number_format($budget_details_info[0]->amount,2); ?></div>
										</div>
										<!--end::Label-->
									</div>
									<!--end::Labels-->
								</div>
								<!--end::Wrapper-->
								
							</div>
							<div class="col-md-5">
								<table class="table table-row-dashed table-row-gray-300 align-middle">
									<!--begin::Table head-->
									<thead>
										<tr class="fw-bolder text-muted ">
											<th class="">Category</th>
											<th class="text-end">Budget</th>
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
												<a href="#" class="text-end text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?php echo number_format($assigned_budget_category_data->amount,2); ?></a>
											</td>
										</tr>
										<?php
            							}
										?>
									</tbody>
									<tfoot class="bg-light">
									<tr class="px-3">
										<th class="text-dark fw-bolder fs-4 px-3">Total :</th>
										<td class="text-end fw-bolder text-primary fs-4"><?php echo number_format($total_budget,2); ?></td>
									</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!--end::Navbar-->
			</div>
		</div>
		<!--begin::Table-->
		<div class="card card-flush">
			<!--begin::Card header-->
			<div class="card-header mt-5">
				<!--begin::Card title-->
				<div class="card-title flex-column">
					<h1 class="fw-bolder mb-1">Category</h1>
				</div>
				<!--begin::Card title-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
			    
			    
			    <?php
			    $collapse_slno = 1;
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
			    
				<div class="py-0">
					<div class="rounded border p-0 bg-light bg-opacity-50">
						<div class="row">
						    
						    <!--begin::Section-->
							<div class="m-0">
								<!--begin::Heading-->
								<div class="card-header mt-0 py-0 px-3 collapsible  py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_6_<?php echo $collapse_slno; ?>">
								    <div class="card-title">
    									<div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
    										<span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
    											<img src="https://almana.g4demo.com/assets/media/icons/duotune/general/gen036.svg">
    										</span>
    										<span class="svg-icon toggle-off svg-icon-1">
    											<img src="https://almana.g4demo.com/assets/media/icons/duotune/general/gen035.svg">
    										</span>
    									</div>
    									<h4 class="text-gray-700 fw-bolder cursor-pointer mb-0"><?php echo $category_name; ?></h4>
								    </div>
								    <div class="card-toolbar"><a href="#" class="btn btn-success fs-6 btn-sm pull-right">Total: <?php echo number_format($assigned_budget_category_data->amount,2); ?></a></div>
								</div>
								<div id="kt_job_6_<?php echo $collapse_slno; ?>" class="collapse fs-6 ms-1">
									<div class="col-lg-12">
        								<div class="table-responsive">
        									<table class="table table-row-bordered">
        										<thead>
        											<tr class="border-bottom fs-6 fw-bolder text-muted text-uppercase">
        												<th class="min-w-275px">Sub Catogeries</th>
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
        												<td class="text-end fs-5 pt-3 text-dark fw-boldest"><?php echo number_format($sub_cat_assign_data->amount,2); ?></td>
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
							<!--end::Section-->

						</div>
					</div>
				</div>
				
				<?php
				$collapse_slno++;
				}
				?>
				
			</div>
			<!--end::Card body-->
			<!-- begin::Footer-->
			<div class="d-flex flex-stack flex-wrap px-10 py-10 border-top">
				<!-- begin::Actions-->
				<div class="my-1 me-5">
					<!-- begin::Pint-->
					<!--<button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print</button>-->
					<a target="blank" href="<?php echo site_url('budgeting/print_budget_pdf/'.$budget_id); ?>" class="btn btn-success my-1 me-12">Print PDF</a>
					<!-- end::Pint-->
					<!-- begin::Download-->
					<a href="<?php echo site_url('budgeting/edit_budget/'.$budget_id); ?>" class="btn btn-warning my-1"><i class="fa fa-pencil"></i>Edit</a>
					<!-- end::Download-->
				</div>
				<!-- end::Actions-->
				<!-- begin::Action-->
				<a href="<?php echo site_url('budgeting/approve_budget/'.$budget_id); ?>" class="btn btn-primary my-1">Approve</a>
				<!-- end::Action-->
			</div>
			<!-- end::Footer-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Container-->
</div>

<?php
$total_amount = 0;
foreach($category_total_array as $category_total_array_data){
    $total_amount=$total_amount+$category_total_array_data['amount'];
}


$hex_colors_array = array(
  '#F44336',
  '#FFEBEE',
  '#FFCDD2',
  '#EF9A9A',
  '#E57373',
  '#EF5350',
  '#F44336',
  '#E53935',
  '#D32F2F',
  '#C62828',
  '#B71C1C',
  '#FF8A80',
  '#FF5252',
  '#FF1744',
  '#D50000',
  '#E91E63',
  '#FCE4EC',
  '#F8BBD0',
  '#F48FB1',
  '#F06292',
  '#EC407A',
  '#E91E63',
  '#D81B60',
  '#C2185B',
  '#AD1457',
  '#880E4F',
  '#FF80AB',
  '#FF4081',
  '#F50057',
  '#C51162',
  '#9C27B0',
  '#F3E5F5',
  '#E1BEE7',
  '#CE93D8',
  '#BA68C8',
  '#AB47BC',
  '#9C27B0',
  '#8E24AA',
  '#7B1FA2',
  '#6A1B9A',
  '#4A148C',
  '#EA80FC',
  '#E040FB',
  '#D500F9',
  '#AA00FF',
  '#673AB7',
  '#EDE7F6',
  '#D1C4E9',
  '#B39DDB',
  '#9575CD',
  '#7E57C2',
  '#673AB7',
  '#5E35B1',
  '#512DA8',
  '#4527A0',
  '#311B92',
  '#B388FF',
  '#7C4DFF',
  '#651FFF',
  '#6200EA',
  '#3F51B5',
  '#E8EAF6',
  '#C5CAE9',
  '#9FA8DA',
  '#7986CB',
  '#5C6BC0',
  '#3F51B5',
  '#3949AB',
  '#303F9F',
  '#283593',
  '#1A237E',
  '#8C9EFF',
  '#536DFE',
  '#3D5AFE',
  '#304FFE',
  '#2196F3',
  '#E3F2FD',
  '#BBDEFB',
  '#90CAF9',
  '#64B5F6',
  '#42A5F5',
  '#2196F3',
  '#1E88E5',
  '#1976D2',
  '#1565C0',
  '#0D47A1',
  '#82B1FF',
  '#448AFF',
  '#2979FF',
  '#2962FF',
  '#03A9F4',
  '#E1F5FE',
  '#B3E5FC',
  '#81D4FA',
  '#4FC3F7',
  '#29B6F6',
  '#03A9F4',
  '#039BE5',
  '#0288D1',
  '#0277BD',
  '#01579B',
  '#80D8FF',
  '#40C4FF',
  '#00B0FF',
  '#0091EA',
  '#00BCD4',
  '#E0F7FA',
  '#B2EBF2',
  '#80DEEA',
  '#4DD0E1',
  '#26C6DA',
  '#00BCD4',
  '#00ACC1',
  '#0097A7',
  '#00838F',
  '#006064',
  '#84FFFF',
  '#18FFFF',
  '#00E5FF',
  '#00B8D4',
  '#009688',
  '#E0F2F1',
  '#B2DFDB',
  '#80CBC4',
  '#4DB6AC',
  '#26A69A',
  '#009688',
  '#00897B',
  '#00796B',
  '#00695C',
  '#004D40',
  '#A7FFEB',
  '#64FFDA',
  '#1DE9B6',
  '#00BFA5',
  '#4CAF50',
  '#E8F5E9',
  '#C8E6C9',
  '#A5D6A7',
  '#81C784',
  '#66BB6A',
  '#4CAF50',
  '#43A047',
  '#388E3C',
  '#2E7D32',
  '#1B5E20',
  '#B9F6CA',
  '#69F0AE',
  '#00E676',
  '#00C853',
  '#8BC34A',
  '#F1F8E9',
  '#DCEDC8',
  '#C5E1A5',
  '#AED581',
  '#9CCC65',
  '#8BC34A',
  '#7CB342',
  '#689F38',
  '#558B2F',
  '#33691E',
  '#CCFF90',
  '#B2FF59',
  '#76FF03',
  '#64DD17',
  '#CDDC39',
  '#F9FBE7',
  '#F0F4C3',
  '#E6EE9C',
  '#DCE775',
  '#D4E157',
  '#CDDC39',
  '#C0CA33',
  '#AFB42B',
  '#9E9D24',
  '#827717',
  '#F4FF81',
  '#EEFF41',
  '#C6FF00',
  '#AEEA00',
  '#FFEB3B',
  '#FFFDE7',
  '#FFF9C4',
  '#FFF59D',
  '#FFF176',
  '#FFEE58',
  '#FFEB3B',
  '#FDD835',
  '#FBC02D',
  '#F9A825',
  '#F57F17',
  '#FFFF8D',
  '#FFFF00',
  '#FFEA00',
  '#FFD600',
  '#FFC107',
  '#FFF8E1',
  '#FFECB3',
  '#FFE082',
  '#FFD54F',
  '#FFCA28',
  '#FFC107',
  '#FFB300',
  '#FFA000',
  '#FF8F00',
  '#FF6F00',
  '#FFE57F',
  '#FFD740',
  '#FFC400',
  '#FFAB00',
  '#FF9800',
  '#FFF3E0',
  '#FFE0B2',
  '#FFCC80',
  '#FFB74D',
  '#FFA726',
  '#FF9800',
  '#FB8C00',
  '#F57C00',
  '#EF6C00',
  '#E65100',
  '#FFD180',
  '#FFAB40',
  '#FF9100',
  '#FF6D00',
  '#FF5722',
  '#FBE9E7',
  '#FFCCBC',
  '#FFAB91',
  '#FF8A65',
  '#FF7043',
  '#FF5722',
  '#F4511E',
  '#E64A19',
  '#D84315',
  '#BF360C',
  '#FF9E80',
  '#FF6E40',
  '#FF3D00',
  '#DD2C00',
  '#795548',
  '#EFEBE9',
  '#D7CCC8',
  '#BCAAA4',
  '#A1887F',
  '#8D6E63',
  '#795548',
  '#6D4C41',
  '#5D4037',
  '#4E342E',
  '#3E2723',
  '#9E9E9E',
  '#FAFAFA',
  '#F5F5F5',
  '#EEEEEE',
  '#E0E0E0',
  '#BDBDBD',
  '#9E9E9E',
  '#757575',
  '#616161',
  '#424242',
  '#212121',
  '#607D8B',
  '#ECEFF1',
  '#CFD8DC',
  '#B0BEC5',
  '#90A4AE',
  '#78909C',
  '#607D8B',
  '#546E7A',
  '#455A64',
  '#37474F',
  '#263238',
);
$percentage_array = array();
$percentage_val_array = array();
$cat_names_array = array();
$cat_color_array = array();
foreach($category_total_array as $category_total_array_data){
    $percentage = round(100-((($total_amount-$category_total_array_data['amount'])/$total_amount)*100));
    $percentage_array[] = array('cat_name' => $category_total_array_data['cat_name'], 'percentage' => $percentage);
    $cat_names_array[] = $category_total_array_data['cat_name'];
    $percentage_val_array[] = $percentage;
    $hex_colors_array_key = array_rand($hex_colors_array, 1);
    $cat_color_array[] = $hex_colors_array[$hex_colors_array_key];
}
?>

<script>
var category_percentage_array_json = '<?php echo json_encode($percentage_array,true); ?>';
var category_cat_name_array_json_data = <?php echo json_encode($cat_names_array,true); ?>;
var category_percentage_array_json_data = <?php echo json_encode($percentage_val_array,true); ?>;
var category_cat_color_json_data = <?php echo json_encode($cat_color_array,true); ?>;
</script>