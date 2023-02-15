<?php
$cookie_name = "mycbusername";




if(isset($_COOKIE[$cookie_name])) {

    $session_data = unserialize($_COOKIE[$cookie_name]);

    $session_data = array(
        'user_id' => $session_data['user_id'],
        'username' => $session_data['username'],
        'email' => $session_data['email'],
        'root_id' => $session_data['root_id'],
    );

    $this->session->set_userdata('username', $session_data);

    $_SESSION['user_id'] = $session_data['user_id'];
    $_SESSION['root_id'] = $session_data['root_id'];

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

//exit();
?>
<!doctype html>
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
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,600,700&display=swap" rel="stylesheet">
        <link rel="icon" href="<?php echo site_url('assets/media/logos/favicon.ico'); ?>" />

        <!--end::Page Vendor Stylesheets-->
        <!--begin::Page Vendor Stylesheets(used by this page)-->
        <link href="<?php echo site_url('assets/plugins/custom/datatables/datatables.bundle.css');?>" rel="stylesheet" type="text/css" />
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="<?php echo site_url('assets/plugins/global/plugins.bundle.css');?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo site_url('assets/css/style.bundle.css');?>" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/toastr/toastr.min.css">

        <!-- Custom Stylesheet -->
        <link href="<?php echo site_url('assets/css/style-gligx.css').'?v='.time(); ?>" rel="stylesheet" type="text/css" />

    </head>

<body id="kt_body" class="bg-body">
  <div class="d-flex flex-column flex-root customlogin">

    <div class="d-flex flex-column flex-column-fluid position-x-center bgi-no-repeat bgi-size-cover bgi-attachment-fixed" style="background-image: url(../../assets/media/patterns/login-background.jpg">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
			<a href="<?php echo site_url(); ?>" class="mb-12">
				<img alt="Logo" src="<?php echo site_url('assets/media/logos/logo.svg');?>" class="h-50px lgn-logo" />
			</a>
			<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-10 mx-auto">
                    <div>
                        <h4>Forgot Password</h4>
                        <p class="mb-5">Type your email to reset your password.</p>
                    </div>

                    <?php
                    if(isset($_REQUEST['next']))
                    {
                        $re_url = $_REQUEST['next'];
                    }
                    else
                    {
                        $re_url = 'dashboard';
                    }

                    ?>

                    <form class="form-material" action="<?php echo site_url('forgot_password/send_mail/');?>" method="post" name="xin-form" id="xin-form">

                        <div class="form-group">

                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 16">
                                    <g transform="translate(0)">
                                        <path d="M23.983,101.792a1.3,1.3,0,0,0-1.229-1.347h0l-21.525.032a1.169,1.169,0,0,0-.869.4,1.41,1.41,0,0,0-.359.954L.017,115.1a1.408,1.408,0,0,0,.361.953,1.169,1.169,0,0,0,.868.394h0l21.525-.032A1.3,1.3,0,0,0,24,115.062Zm-2.58,0L12,108.967,2.58,101.824Zm-5.427,8.525,5.577,4.745-19.124.029,5.611-4.774a.719.719,0,0,0,.109-.946.579.579,0,0,0-.862-.12L1.245,114.4,1.23,102.44l10.422,7.9a.57.57,0,0,0,.7,0l10.4-7.934.016,11.986-6.04-5.139a.579.579,0,0,0-.862.12A.719.719,0,0,0,15.977,110.321Z" transform="translate(0 -100.445)"/>
                                    </g>
                                </svg>
                            </span>
                                </div>
                                <input required  class="form-control" name="iemail" id="iemail" placeholder="Email Address" autofocus>
                            </div>
                        </div>

                        <div class="g-recaptcha" data-sitekey="6LdYsK0UAAAAALsllphsWWXbX02oEwlAmnpsW1kc" data-badge="xinline" data-size="invisible" data-callback="setResponse"></div>

                        <div>
                            <button type="submit" class="btn btn-primary btn-block save">Reset</button>
                        </div>

                        <div class="mt-10">
                            <a href="<?php echo site_url(); ?>">Back to Login</a>
                        </div>
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

<!-- Vendor JS -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/kendo/jquery-3.2.1.min.js"></script>
<script src="<?php echo site_url('assets/plugins/global/plugins.bundle.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom/tether/tether.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom/toastr/toastr.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback" async defer></script>
<script type="text/javascript">
    $(document).ready(function(){
        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.options.timeOut = 15000;
        toastr.options.positionClass = "toast-top-center";
        toastr.options.preventDuplicates = true;
    });

    var onloadCallback = function() {
        grecaptcha.execute();
    };

    $("#xin-form").submit(function(e){
        e.preventDefault();
        var obj = $(this), action = obj.attr('name');
        $('.save').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize()+"&is_ajax=1&add_type=forgot_password&form="+action,
            cache: false,
            success: function (JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('.save').prop('disabled', false);
                } else {
                    toastr.success(JSON.result);
                    $('#iemail').val(''); // To reset form fields
                    $('.save').prop('disabled', false);
                }
            }
        });
    });
</script>
</body>

</html>