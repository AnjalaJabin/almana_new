<?php
$session = $this->session->userdata('username');
$user_info = $this->Xin_model->read_user_info($session['user_id']);
$role_user = $this->Xin_model->read_user_role_info($user_info[0]->user_role_id);
$designation_info = $this->Xin_model->read_designation_info($user_info[0]->designation_id);
$role_resources_ids = explode(',',$role_user[0]->role_resources);
?>

<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="<?php echo site_url(); ?>">
            <img alt="Logo" src="<?php echo site_url('assets/media/logos/logo.svg'); ?>" class="h-11px logo" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-2 py-5 py-lg-8" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link <?=($this->uri->segment(1)==='dashboard')?'active':''?>" href="<?php echo site_url('dashboard'); ?>">
                        <span class="menu-icon">
                            <i class="bi bi-grid fs-3"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Management</span>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?=($this->uri->segment(1)==='budgeting')?'show':''?>">
                    <span class="menu-link <?=($this->uri->segment(1)==='budgeting')?'menu-active-bg':''?>">
                        <span class="menu-icon">
                            <i class="bi bi-person fs-2"></i>
                        </span>
                        <span class="menu-title">Budgeting</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <?php if(in_array('2',$role_resources_ids)) {?>
                        <div class="menu-item">
                            <a class="menu-link <?=($this->uri->segment(2)==='allocated_budget_list')?'active':''?>" href="<?php echo site_url('budgeting/allocated_budget_list'); ?>">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">All Budgets</span>
                            </a>
                        </div>
                        <?php } if(in_array('3',$role_resources_ids)) {?>
                        <div class="menu-item">
                            <a class="menu-link <?=($this->uri->segment(2)==='add_budget')?'active':''?>" href="<?php echo site_url('budgeting/add_budget'); ?>">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Add New Budget</span>
                            </a>
                        </div>
                        <?php }?>
                    </div>
                    <!--
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link" href="departments.php">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Departments</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="department-details.php">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Department Details</span>
                            </a>
                        </div>
                    </div>
                    -->
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?=($this->uri->segment(2)==='direct_expense')?'show':''?>">
                    <div class="menu-item">
                        <a class="menu-link <?=($this->uri->segment(2)==='direct_expense')?'active':''?>" href="<?php echo site_url('budgeting/direct_expense'); ?>">
                                <span class="menu-icon">
                                    <span class="bi bi-coin "></span>
                                </span>
                            <span class="menu-title">All Expenses</span>
                        </a>
                    </div>
                </div>
          <!---      <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?=($this->uri->segment(1)==='employees')?'show':''?>">
                    <span class="menu-link <?=($this->uri->segment(1)==='employees')?'menu-active-bg':''?>">
                        <span class="menu-icon">
                            <i class="bi bi-person fs-2"></i>
                        </span>
                        <span class="menu-title">Employee</span>
                        <span class="menu-arrow"></span>
                    </span>
                   // <?php if(in_array('7',$role_resources_ids)) {?>
                  <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link <?=($this->uri->segment(1)==='employees')?'active':''?>" href="<?php echo site_url('employees'); ?>">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                 <span class="menu-title">List All</span>
                            </a>
                        </div>
                    </div>
                 <!--   <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link <?=($this->uri->segment(1)==='myexpense')?'active':''?>" href="<?php echo site_url('employees/my_expence'); ?>">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">My Expenses</span>
                            </a>
                        </div>
                    </div>-->

                  //  <?php }?>
              <!--  </div>-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-sticky fs-3"></i>
                        </span>
                        <span class="menu-title">Asset Management</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">View All</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Add New</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cart fs-3"></i>
                        </span>
                        <span class="menu-title">Purchases & Allowance</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List All</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Add New</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-shield-check fs-3"></i>
                        </span>
                        <span class="menu-title">Travel Management</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Overview</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">+ New Record</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Others</span>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1 <?=($this->uri->segment(1)==='settings')?'show':''?>">
                    <?php if(in_array('21',$role_resources_ids)) {?>
                    <div class="menu-item">
                        <a class="menu-link <?=($this->uri->segment(1)==='settings')?'active':''?>" href="<?php echo site_url('settings'); ?>">
                            <span class="menu-icon">
                                <i class="bi bi-app-indicator fs-3"></i>
                            </span>
                            <span class="menu-title">Settings</span>
                        </a>
                    </div>
                    <?php }?>
                    <span class="menu-link">
                        <span class="menu-icon <?php if ($this->uri->segment(1) === 'roles') {?>
                            menu-active-bg <?php } elseif( $this->uri->segment(1) === 'employees') {?>
                            menu-active-bg <?php } else{
                           ?> '' <?php } ?>">
                            <i class="bi bi-people fs-3"></i>
                        </span>
                        <span class="menu-title">User Management</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion  <?php if ($this->uri->segment(1) === 'roles') {?>
                            show <?php } elseif( $this->uri->segment(1) === 'employees') {?>
                            show <?php } else{
                        ?> '' <?php } ?>">
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?=($this->uri->segment(1)==='employees')?'show':''?>">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bi bi-person fs-2"></span>
                                </span>
                                <span class="menu-title">Users</span>
                                <span class="menu-arrow"></span>
                            </span>

                            <div class="menu-sub menu-sub-accordion">
                                <?php if(in_array('7',$role_resources_ids)) {?>

                                <div class="menu-item">
                                    <a class="menu-link <?=($this->uri->segment(1)==='employees')?'active':''?>" href="<?php echo site_url('employees'); ?>">
                                        <span class="menu-icon">
                                          <i class="bullet bullet-dot"></i>
                                      </span>
                                        <span class="menu-title">All Employees</span>
                                    </a>
                                </div>
                                <?php } ?>
<!--                                <div class="menu-item">-->
<!--                                    <a class="menu-link" href="user-view.php">-->
<!--                                        <span class="menu-bullet">-->
<!--                                            <span class="bullet bullet-dot"></span>-->
<!--                                        </span>-->
<!--                                        <span class="menu-title">View User</span>-->
<!--                                    </a>-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?=($this->uri->segment(1)==='roles')?'show':''?>">
                            <span class="menu-link <?=($this->uri->segment(1)==='roles')?'show':''?>">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Roles</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                <?php if(in_array('17',$role_resources_ids)) {?>
                                <div class="menu-item">
                                    <a class="menu-link <?=($this->uri->segment(1)==='roles')?'active':''?>" href="<?php echo site_url('roles'); ?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Roles List</span>
                                    </a>
                                </div>
                                <?php }?>
<!--                                <div class="menu-item">-->
<!--                                    <a class="menu-link" href="roles-view.php">-->
<!--                                        <span class="menu-bullet">-->
<!--                                            <span class="bullet bullet-dot"></span>-->
<!--                                        </span>-->
<!--                                        <span class="menu-title">View Role</span>-->
<!--                                    </a>-->
<!--                                </div>-->
                            </div>
                        </div>
<!--                        <div class="menu-item">-->
<!--                            <a class="menu-link" href="permissions.php">-->
<!--                                <span class="menu-bullet">-->
<!--                                    <span class="bullet bullet-dot"></span>-->
<!--                                </span>-->
<!--                                <span class="menu-title">Permissions</span>-->
<!--                            </a>-->
<!--                        </div>-->
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-content">
                        <div class="separator mx-1 my-4"></div>
                    </div>
                </div>
            </div>
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
        <a href="<?php echo site_url('logout'); ?>" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" >
            <span class="btn-label">Logout</span>
        </a>
    </div>
    <!--end::Footer-->
</div>