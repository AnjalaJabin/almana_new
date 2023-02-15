<div id="kt_ecommerce_add_product_options" data-select2-id="select2-data-kt_ecommerce_add_product_options">
	<!--begin::Form group-->
	
	<div class="w-200 w-md-500px show_sub_cat_add_btn_main_head" style="background: rgb(221, 221, 221); padding: 7px; display:none;">
        <div class="input-group">
           <input type="hidden" class="group_add_sub_cat_main_cat_id" value="<?php echo $main_cat_id; ?>"/>
           <input type="text" class="form-control group_add_sub_cat_val" placeholder="Sub Category Name">
           <span class="input-group-btn">
                <button class="btn btn-info group_add_sub_cat_sub_btn" type="button">Add</button>
           </span>
           <span class="input-group-btn">
                <button class="btn group_sub_cat_close_btn" type="button">X</button>
           </span>
        </div>
    </div>
	
	<button type="button" class="btn btn-sm btn-info group_add_sub_cat_btn">Add New Sub Category</button>
	
	<div class="form-group sub_category_list_div" data-select2-id="select2-data-134-mrjd">
		<div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3" data-select2-id="select2-data-133-fmy1">
			<div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5 pt-2 pb-2" data-select2-id="select2-data-132-a5tz">
				<!--begin::Select2-->
				<div class="w-200 w-md-400px">
					<select name="sub_category[<?php echo $main_cat_id; ?>][]" class="form-select form-select-lg form-select-solid select_sub_cat_dropdown_list" data-placeholder="Select Sub Categories" data-allow-clear="true" data-hide-search="true">
					<option value=""></option>
					<?php
					$sub_cat_data = $this->Xin_model->get_sub_categories_by_main_cat($main_cat_id);
					foreach($sub_cat_data->result() as $sub_categories){
					    echo '<option value="'.$sub_categories->id.'">'.$sub_categories->name.'</option>';
					}
					?>
					</select>
					<!--end::Input-->
				</div>
				<!--end::Select2-->
				<input type="hidden" name="main_category_id[]" value="<?php echo $main_cat_id; ?>"/>
				<!--begin::Input-->
				<input type="number" data-main_cat_id="<?php echo $main_cat_id; ?>" class="form-control mw-100 w-200px sub_category_budget_keyup" name="sub_cat_amount[<?php echo $main_cat_id; ?>][]" placeholder="Budget">
				<!--end::Input-->
				<button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger delete_sub_category_btn">
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
					<span class="svg-icon svg-icon-1">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"></rect>
							<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"></rect>
						</svg>
					</span>
					<!--end::Svg Icon-->
				</button>
			</div>
		</div>
	</div>
	<!--end::Form group-->
	<!--begin::Form group-->
	<div class="form-group mt-5">
		<button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary add_sub_category_btn">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
		<span class="svg-icon svg-icon-2">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
			</svg>
		</span>
		<!--end::Svg Icon-->Add another sub category</button>
	</div>
	<!--end::Form group-->
	<input type="hidden" class="sub_category_list_div_html"/>
</div>