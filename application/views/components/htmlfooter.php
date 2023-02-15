        <div class="modal fade delete-modal animated pluse"  role="dialog" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                  <div class="swal2-icon-content">!</div>
              </div>
              <div class="swal2-html-container" id="swal2-html-container" style="display: block;">Record deleted can't be restored!!!</div>
              <div class="modal-footer">
                <form id="delete_record" name="delete_record" role="form" action="" method="post">
                  <input name="_method" type="hidden" value="DELETE">
                  <input name="_token" type="hidden" value="">
                  <input name="token_type" id="token_type" type="hidden" value="">
                  <button type="submit" class="swal2-confirm btn fw-bold btn-danger" aria-label="" style="display: inline-block;">Yes, delete!</button>
                  <button type="button" class="swal2-cancel btn fw-bold btn-active-light-primary" aria-label="" style="display: inline-block;" data-bs-dismiss="modal">No, cancel</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade approve-modal animated pluse"  role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                        <div class="swal2-icon-content">!</div>
                    </div>
                    <div class="swal2-html-container" id="swal2-html-container_1" style="display: block;">Do you really want to perform this action?</div>
                    <div class="modal-footer">
                        <form id="request_action" name="request_action" role="form" action="" method="post">
                            <input name="_method" type="hidden" value="">
                            <input name="request_id" type="hidden" value="">
                            <input name="token_type" id="token_type" type="hidden" value="">
                            <button type="submit" class="swal2-confirm btn fw-bold btn-danger" aria-label="" style="display: inline-block;">Yes</button>
                            <button type="button" class="swal2-cancel btn fw-bold btn-active-light-primary" aria-label="" style="display: inline-block;" data-bs-dismiss="modal">No, cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade edit_setting_datail animated pluse" id="edit_setting_datail"  role="dialog" aria-labelledby="edit_setting_datail" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered mw-600px">
            <div class="modal-content" id="ajax_setting_info"></div>
          </div>
        </div>
        
        <div class="modal fade edit-modal-data animated pluse" id="edit-modal-data"  role="dialog" aria-labelledby="edit-modal-data" aria-hidden="true">
          <div class="modal-dialog modal-lg mw-650px">
            <div class="modal-content" id="ajax_modal"></div>
          </div>
        </div>
        <div class="modal fade view-modal-data animated pluse" id="view-modal-data"  role="dialog" aria-labelledby="view-modal-data" aria-hidden="true">
            <div class="modal-dialog modal-lg mw-650px">
                <div class="modal-content" id="ajax_modal_view"></div>
            </div>
        </div>
        
        
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->
		<!--end::Main-->
		<script>
		var hostUrl = "assets/";
		var base_url = '<?php echo site_url(); ?>';
		var site_url = '<?php echo site_url(); ?>';
		</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?php echo site_url('assets/plugins/global/plugins.bundle.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/scripts.bundle.js'); ?>"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="<?php echo site_url('assets/plugins/custom/datatables/datatables.bundle.js'); ?>"></script>

		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?php echo site_url('assets/js/custom/widgets.js'); ?>"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
		<?php
		if($path_url=='add_budget' || $path_url=='budget_details' || $path_url=='edit_budget')
		{
		?>
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?php echo site_url('assets/js/custom/pages/projects/project/project.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/custom/modals/users-search.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/custom/modals/new-target.js'); ?>"></script>
		<!--begin::Page Custom Javascript(used by this page)-->
		<?php
		if($path_url=='add_budget' || $path_url=='budget_details')
		{
		?>
		<script src="<?php echo site_url('assets/js/custom/modals/create-account.js').'?v='.time(); ?>"></script>
		<?php
		}
		else if($path_url=='edit_budget'){
		?>
		<script src="<?php echo site_url('assets/js/custom/modals/edit-budget-account.js').'?v='.time(); ?>"></script>
		<?php  
		}
		?>
		<script src="<?php echo site_url('assets/js/custom/widgets.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/custom/apps/chat/chat.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/custom/modals/create-app.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/custom/modals/upgrade-plan.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/custom/pages/projects/project/project.js').'?v='.time(); ?>"></script>
		<?php
		} 
		 if($path_url=='roles'){?>
        <!-- Vendor JS -->
        <script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/kendo/jquery-3.2.1.min.js"></script> 
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/kendo/kendo-all-min.js"></script>
		<?php }
        if(!empty($path_url)){

        ?><script type="text/javascript" src="<?php echo base_url().'assets/custom_glx_js/'.$path_url.'.js?ver='.time(); ?>"></script>
            <script  type="text/javascript" src="<?php echo base_url().'assets/custom_glx_js/dashboard.js?ver='.time(); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url().'assets/js/custom/DataTables/datatables.min.js';?>"></script>

            <script src="<?php echo base_url().'assets/plugins/custom/filter/dist/excel-bootstrap-table-filter-bundle.js';?>"></script>
            <script type="text/javascript" src="<?php echo base_url()?>assets/js/highchart.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>assets/js/exporting.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>assets/js/export-data.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>assets/js/accessibilty.js"></script>

            <script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/Chart.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/Chart.js"></script>
            <script type="text/javascript" src="<?php echo base_url();?>skin/js_reports/moment.min.js"></script>
          <script type="text/javascript" src="<?php echo base_url().'assets/js/custom/bootstrap/bootstrap.min.js';?>"></script>
            <?php
        }
        
        if($path_url=='employees')
        {
        ?>
        <script src="<?php echo site_url('assets/js/custom/apps/user-management/users/list/table.js'); ?>"></script>
        <script src="<?php echo site_url('assets/js/custom/apps/user-management/users/list/export-users.js'); ?>"></script>
        <script src="<?php echo site_url('assets/js/custom/apps/user-management/users/list/add.js'); ?>"></script>
        <?php
        }
        ?>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        
        
        <script>
        $(".datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#supplier_dropdown").select2();
        </script>
		
	</body>
	<!--end::Body-->
</html>