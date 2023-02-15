<?php
$cookie_name = "mycbusername";

if(isset($_COOKIE[$cookie_name])) {
    
    $session_data = unserialize($_COOKIE[$cookie_name]);
    
    $session_data = array(
	'user_id' => $session_data['user_id'],
	'username' => $session_data['username'],
	'email' => $session_data['email'],
	);
	
	$this->session->set_userdata('username', $session_data);
    
    $_SESSION['user_id'] = $session_data['user_id'];

    if(isset($_REQUEST['next']))
    {
        if(!empty($_REQUEST['next']))
        {
            session_start();
            $_SESSION['next'] = $_REQUEST['next'];
            header('location:'.$_REQUEST['next']);
        }
    }
    else
    {
        header('location:./dashboard');
    }
    
}

$user_email = '';
if(isset($_REQUEST['re_key']) && !empty($_REQUEST['re_key'])){
    $user_email = base64_decode($_REQUEST['re_key']);
}
//exit();
?>

<!DOCTYPE html>
<!--
Author: Gligx
Product Name: Metronic - Bootstrap 5 HTML
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>Login | Al Mana</title>
		<meta charset="utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="" />
		<link rel="shortcut icon" href="<?php echo site_url('assets/media/logos/favicon.ico');?>" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="<?php echo site_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css');?>" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="<?php echo site_url('assets/plugins/custom/datatables/datatables.bundle.css');?>" rel="stylesheet" type="text/css" />
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?php echo site_url('assets/plugins/global/plugins.bundle.css');?>" rel="stylesheet" type="text/css" />

		<link href="<?php echo site_url('assets/css/style.bundle.css');?>" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		
		<!-- Custom Stylesheet -->
		<link href="<?php echo site_url('assets/css/style-gligx.css').'?v='.time(); ?>" rel="stylesheet" type="text/css" />

	</head>
<!--end::Head-->

	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root customlogin">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid position-x-center bgi-no-repeat bgi-size-cover bgi-attachment-fixed" style="background-image: url(assets/media/patterns/login-background.jpg">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="../../demo13/dist/index.html" class="mb-12">
						<img alt="Logo" src="<?php echo site_url('assets/media/logos/logo.svg');?>" class="h-50px lgn-logo" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-10 mx-auto">
						<!--begin::Form-->
						<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="<?php echo site_url('index/login'); ?>" data-redirect="dashboard" data-form-table="login" data-is-redirect="1">
							<!--begin::Heading-->
					
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label fs-6 fw-bolder text-dark">Email</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack mb-2">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
									<!--end::Label-->
									<!--begin::Link-->
									<a href="<?php echo site_url('dashboard/forgot_password/');?>" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Input-->
								<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
								<!--begin::Submit button-->
								<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Continue</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<!--end::Submit button-->
								<!--begin::Separator-->
								<div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
								<!--end::Separator-->
								<!--begin::Google link-->
								<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
								<img alt="Logo" src="<?php echo site_url('assets/media/svg/brand-logos/outlook.svg');?>" class="h-20px me-3" />Continue with Outlook</a>
								<!--end::Google link-->
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Main-->
		<script>
		    var hostUrl = "assets/";
		    var base_url = '<?php echo site_url(); ?>';
		</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?php echo site_url('assets/plugins/global/plugins.bundle.js');?>"></script>
		<script src="<?php echo site_url('assets/js/scripts.bundle.js');?>"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?php echo site_url('assets/js/custom/authentication/sign-in/general.js?v=').time();?>"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>