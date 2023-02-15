<?php
$session = $this->session->userdata('username');
$system = $this->Xin_model->read_setting_info(1);
?>
<?php $this->load->view('components/htmlheader');?>
<!--end::Head-->
	
<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
					<?php $this->load->view('components/left_menu');?>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!-- Top Bar Start -->
					<?php $this->load->view('components/header');?>
					<!-- Top Bar End -->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<?php // get the required layout..?>
					    <?php echo $subview;?>
					</div>
					<!--end::Content-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
<!-- Footer -->
	<?php $this->load->view('components/htmlfooter');?>
<!-- Footer End -->