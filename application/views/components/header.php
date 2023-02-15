<?php
$session = $this->session->userdata('username');
$system = $this->Xin_model->read_setting_info(1);
$user_info = $this->Xin_model->read_user_info($session['user_id']);
$role_user = $this->Xin_model->read_user_role_info($user_info[0]->user_role_id);
$role_resources_ids = explode(',',$role_user[0]->role_resources);

if($system[0]->system_skin=='skin-default'){
	$cl_skin = 'light';
} else if($system[0]->system_skin=='skin-1'){
	$cl_skin = 'dark';
} else if($system[0]->system_skin=='skin-2'){
	$cl_skin = 'light';
} else if($system[0]->system_skin=='skin-3'){
	$cl_skin = 'light';
} else if($system[0]->system_skin=='skin-4'){
	$cl_skin = 'dark';
} else if($system[0]->system_skin=='skin-5'){
	$cl_skin = 'dark';
} else if($system[0]->system_skin=='skin-6'){
	$cl_skin = 'dark';
}

$session = $this->session->userdata('username');
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(!isset($_COOKIE['mycbusername'])) {
    header('');
}

if(empty($session)){ 
	header('');
}
if($this->session->userdata('username')['profile_picture'])
{
    $profile_picture = 'uploads/profile/'.$this->session->userdata('username')['profile_picture'];
}
else{
    $profile_picture = 'assets/media/avatars/blank.png';
}

?>

<div class="preloader"></div>



<!--begin::Header-->
<div id="kt_header" style="" class="header align-items-stretch">
	<!--begin::Container-->
	<div class="container-fluid d-flex align-items-stretch justify-content-between">
		<!--begin::Aside mobile toggle-->
		<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
			<div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
				<i class="bi bi-list fs-1"></i>
			</div>
		</div>
		<!--end::Aside mobile toggle-->
		<!--begin::Mobile logo-->
		<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
			<a href="index.php" class="d-lg-none">
				<img alt="Logo" src="<?php echo site_url('assets/media/logos/logo.svg');?>" class="h-25px" />
			</a>
		</div>
		<!--end::Mobile logo-->
		<!--begin::Wrapper-->
		<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
			<!--begin::Navbar-->
			<div class="d-flex align-items-stretch" id="kt_header_nav">
			</div>
			<!--end::Navbar-->
			<!--begin::Topbar-->
			<div class="d-flex align-items-stretch flex-shrink-0">
				<!--begin::Toolbar wrapper-->
				<div class="topbar d-flex align-items-stretch flex-shrink-0">
					<!--begin::Search-->
					<div class="d-flex align-items-stretch">
						<!--begin::Search-->
						<div id="kt_header_search" class="d-flex align-items-stretch" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-overflow="false" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
							<!--begin::Search toggle-->
							<div class="d-flex align-items-stretch" data-kt-search-element="toggle" id="kt_header_search_toggle">
								<div class="topbar-item px-3 px-lg-5">
									<i class="bi bi-search fs-3"></i>
								</div>
							</div>
							<!--end::Search toggle-->
							<!--begin::Menu-->
							<div data-kt-search-element="content" class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px">
								<!--begin::Wrapper-->
								<div data-kt-search-element="wrapper">
									<!--begin::Form-->
									<form data-kt-search-element="form" class="w-100 position-relative mb-3" autocomplete="off">
										<!--begin::Icon-->
										<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
										<span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 translate-middle-y ms-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
												<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
										<!--end::Icon-->
										<!--begin::Input-->
										<input type="text" class="form-control form-control-flush ps-10" name="search" value="" placeholder="Search..." data-kt-search-element="input" />
										<!--end::Input-->
										<!--begin::Spinner-->
										<span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-1" data-kt-search-element="spinner">
											<span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
										</span>
										<!--end::Spinner-->
										<!--begin::Reset-->
										<span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none" data-kt-search-element="clear">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
											<span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
													<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<!--end::Reset-->
									</form>
									<!--end::Form-->
									<!--begin::Separator-->
									<div class="separator border-gray-200 mb-6"></div>
									<!--end::Separator-->
									
									<!--begin::Recently viewed-->
									<div class="mb-4" data-kt-search-element="main">
										<!--begin::Heading-->
										<div class="d-flex flex-stack fw-bold mb-4">
											<!--begin::Label-->
											<span class="text-muted fs-6 me-2">Recently Searched:</span>
											<!--end::Label-->
										</div>
										<!--end::Heading-->
										<!--begin::Items-->
										<div class="scroll-y mh-200px mh-lg-325px">
											<!--begin::Item-->
											<div class="d-flex align-items-center mb-5">
												<!--begin::Symbol-->
												<div class="symbol symbol-40px me-4">
													<span class="symbol-label bg-light">
														<!--begin::Svg Icon | path: icons/duotune/electronics/elc004.svg-->
														<span class="svg-icon svg-icon-2 svg-icon-primary">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M2 16C2 16.6 2.4 17 3 17H21C21.6 17 22 16.6 22 16V15H2V16Z" fill="black" />
																<path opacity="0.3" d="M21 3H3C2.4 3 2 3.4 2 4V15H22V4C22 3.4 21.6 3 21 3Z" fill="black" />
																<path opacity="0.3" d="M15 17H9V20H15V17Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
												</div>
												<!--end::Symbol-->
												<!--begin::Title-->
												<div class="d-flex flex-column">
													<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Calvin Klean at Dubai Mall</a>
													<span class="fs-7 text-muted fw-bold">#45789</span>
												</div>
												<!--end::Title-->
											</div>
											<!--end::Item-->																
										</div>
										<!--end::Items-->
									</div>
									<!--end::Recently viewed-->
									<!--begin::Empty-->
									<div data-kt-search-element="empty" class="text-center d-none">
										<!--begin::Icon-->
										<div class="pt-10 pb-10">
											<!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
											<span class="svg-icon svg-icon-4x opacity-50">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="black" />
													<path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="black" />
													<rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="black" />
													<path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</div>
										<!--end::Icon-->
										<!--begin::Message-->
										<div class="pb-15 fw-bold">
											<h3 class="text-gray-600 fs-5 mb-2">No result found</h3>
											<div class="text-muted fs-7">Please try again with a different query</div>
										</div>
										<!--end::Message-->
									</div>
									<!--end::Empty-->
								</div>
								<!--end::Wrapper-->
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Search-->
					</div>
					<!--end::Search-->
					<!--begin::Notifications-->
					<div class="d-flex align-items-stretch">
						<!--begin::Menu wrapper-->
						<div class="topbar-item position-relative px-3 px-lg-5" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
							<i class="bi bi-app-indicator fs-3"></i>
						</div>
						<!--begin::Menu-->
						<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
							<!--begin::Heading-->
							<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('<?php echo site_url('assets/media/misc/pattern-1.jpg');?>')">
								<!--begin::Title-->
								<h3 class="text-white fw-bold px-9 mt-6 mb-6">Notifications
								<span class="fs-8 opacity-75 ps-3">24 reports</span></h3>
								<!--end::Title-->
							</div>
							<!--end::Heading-->
							<!--begin::Tab content-->
							<div class="tab-content">
								<!--begin::Tab panel-->
								<div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
									<!--begin::Items-->
									<div class="scroll-y mh-325px my-5 px-8">
										<!--begin::Item-->
										<div class="d-flex flex-stack py-4">
											<!--begin::Section-->
											<div class="d-flex align-items-center">
												<!--begin::Title-->
												<div class="mb-0 me-2">
													<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Notification Recived</a>
													<div class="text-gray-400 fs-7">Phase 1 development</div>
												</div>
												<!--end::Title-->
											</div>
											<!--end::Section-->
											<!--begin::Label-->
											<span class="badge badge-light fs-8">1 hr</span>
											<!--end::Label-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex flex-stack py-4">
											<!--begin::Section-->
											<div class="d-flex align-items-center">
												<!--begin::Title-->
												<div class="mb-0 me-2">
													<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Notification from HR</a>
													<div class="text-gray-400 fs-7">Confidential staff documents</div>
												</div>
												<!--end::Title-->
											</div>
											<!--end::Section-->
											<!--begin::Label-->
											<span class="badge badge-light fs-8">2 hrs</span>
											<!--end::Label-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex flex-stack py-4">
											<!--begin::Section-->
											<div class="d-flex align-items-center">
												<!--begin::Title-->
												<div class="mb-0 me-2">
													<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Company Notification</a>
													<div class="text-gray-400 fs-7">Corporeate staff profiles</div>
												</div>
												<!--end::Title-->
											</div>
											<!--end::Section-->
											<!--begin::Label-->
											<span class="badge badge-light fs-8">5 hrs</span>
											<!--end::Label-->
										</div>
										<!--end::Item-->
									</div>
									<!--end::Items-->
									<!--begin::View more-->
									<div class="py-3 text-center border-top">
										<a href="profile-activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
										<span class="svg-icon svg-icon-5">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
												<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon--></a>
									</div>
									<!--end::View more-->
								</div>
								<!--end::Tab panel-->
								
							</div>
							<!--end::Tab content-->
						</div>
						<!--end::Menu-->
						<!--end::Menu wrapper-->
					</div>
					<!--end::Notifications-->
					<!--begin::User-->
					<div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
						<!--begin::Menu wrapper-->
						<div class="topbar-item cursor-pointer symbol px-3 px-lg-5 me-n3 me-lg-n5 symbol-30px symbol-md-35px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
							<img id= 'prof_pic_small'src="<?php echo site_url($profile_picture);?>" alt="metronic" />
						</div>
						<!--begin::Menu-->
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<div class="menu-content d-flex align-items-center px-3">
									<!--begin::Avatar-->
									<div class="symbol symbol-50px me-5">
										<img alt="Logo" id='profile_pic' src="<?php echo site_url($profile_picture);?>" />
									</div>
									<!--end::Avatar-->
									<!--begin::Username-->
									<div class="d-flex flex-column">
										<div class="fw-bolder d-flex align-items-center fs-5" id="profile_name"><?php  echo $this->session->userdata('username')['name'];?>

										<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2" id ='prof_designation'><?php  echo $this->session->userdata('username')['designation'];?></span></div>
										<a href="#" class="fw-bold text-muted text-hover-primary fs-7" id="prof_department"><?php  echo $this->session->userdata('username')['department'];?></a>
									</div>
									<!--end::Username-->
								</div>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator my-2"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
                                <a href="#"   data-bs-toggle="modal" data-bs-target=".edit-modal-data"  id="prof_change" data-employee_id=<?php  echo $this->session->userdata('username')['user_id'];?> class="menu-link px-5">My Profile</>
							</div>
							<!--end::Menu item-->
							 <!--begin::Menu item
							<div class="menu-item px-5">
								<a href="project-list" class="menu-link px-5">
									<span class="menu-text">My Projects</span>
									<span class="menu-badge">
										<span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
									</span>
								</a>
							</div>
						end::Menu item-->
							
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator my-2"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
								<a href="<?php echo site_url('logout'); ?>" class="menu-link px-5">Sign Out</a>
							</div>
							<!--end::Menu item-->
						</div>
						<!--end::Menu-->
						<!--end::Menu wrapper-->
					</div>
					<!--end::User -->
					<!--begin::Heaeder menu toggle-->
					<div class="d-flex align-items-stretch d-lg-none px-3 me-n3" title="Show header menu">
						<div class="topbar-item" id="kt_header_menu_mobile_toggle">
							<i class="bi bi-text-left fs-1"></i>
						</div>
					</div>
					<!--end::Heaeder menu toggle-->
				</div>
				<!--end::Toolbar wrapper-->
			</div>
			<!--end::Topbar-->
		</div>
		<!--end::Wrapper-->
	</div>

	<!--end::Container-->
</div>
<!--end::Header-->