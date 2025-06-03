<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title> <?php echo $__env->yieldContent('title'); ?> </title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="<?php echo e(asset('theme')); ?>/dist-assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('theme')); ?>/dist-assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?php echo e(asset('theme')); ?>/frontend//img/favicon.png">   


    <?php echo $__env->yieldContent('style'); ?>

    <style>
        .navbar .collapse {
            visibility: hidden;
            display: block;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('dashboard')); ?>">
                <div class="sidebar-brand-icon">
                    
                    <img width="100%" height="50px" src="<?php echo e(asset('theme/frontend/img/logo-white.svg')); ?>">
                </div>
                <!-- <div class="sidebar-brand-text mx-3"><?php echo e(Session::get('username')); ?></div> -->
            </a>

            <?php
            $role_id = session()->get('role_id');
            if ($role_id == 4) {
            ?>
                <li class="nav-item <?php echo e(Request::segment(1) == 'admin' && Request::segment(2) == 'dashboard' ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                        <i class="fas fa-tachometer-alt custom-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            <?php 
            } elseif ($role_id == 2) { 
            ?>
                <li class="nav-item <?php echo e(Request::segment(1) == 'agent' && Request::segment(2) == 'dashboard' ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('agentDashboard')); ?>">
                        <i class="fas fa-tachometer-alt custom-icon"></i>
                        <span>Agent Dashboard</span>
                    </a>
                </li>
            <?php 
            
            } elseif ($role_id == env('partnerRole_id')) { 
            ?>
                <li class="nav-item <?php echo e(Request::segment(1) == 'agent' && Request::segment(2) == 'dashboard' ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('partnerDashboard')); ?>">
                        <i class="fas fa-tachometer-alt custom-icon"></i>
                        <span>CP Dashboard</span>
                    </a>
                </li>
            <?php 
            }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <?php
                 $role_id = session()->get('role_id');
                 if($role_id == env('brokerRole_id')) {
            ?>
             <li class="nav-item <?php echo e(Request::segment(1) == 'admin' && Request::segment(2) == 'dashboard' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('allLoansApplications')); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Loan Applications</span></a>
            </li>
          
            <?php } ?> 


            <?php
                 $role_id = session()->get('role_id');
                 if($role_id == 4) {
            ?>
             <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users custom-icon"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users Components:</h6>
                        <a class="collapse-item <?php echo e(Request::segment(1) == 'admin' && Request::segment(2) == 'allUsers' ? 'active' : ''); ?>" href="<?php echo e(route('allUsers')); ?>">All Users</a>
                        <a class="collapse-item <?php echo e(Request::segment(1) == 'agent' && Request::segment(2) == 'allAgents' ? 'active' : ''); ?>" href="<?php echo e(route('allAgents')); ?>">Employee/Officer</a>
                        <a class="collapse-item <?php echo e(Request::segment(1) == 'partner' && Request::segment(2) == 'allPartners' ? 'active' : ''); ?>" href="<?php echo e(route('allPartners')); ?>">Channel Partner</a>
                    </div>
                </div>
            </li>
          

             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLoans" aria-expanded="true" aria-controls="collapseLoans">
                    <i class="fas fa-fw fa-folder custom-icon"></i>
                    <span>Loans</span>
                </a>
                <div id="collapseLoans" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Loans Components:</h6>
                        <a class="collapse-item" href="<?php echo e(route('loans.index')); ?>">All</a>
                        <a class="collapse-item" href="<?php echo e(route('pendingLoans')); ?>">Pending Assign</a>                        
                        <a class="collapse-item" href="<?php echo e(route('inprocess.loans')); ?>">In Process Loans</a>
                        
                    </div>
                </div>
            </li>
            <?php } ?> 

            <!--Agent navigation -->
            <?php    if($role_id == 2) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLoans"
                        aria-expanded="true" aria-controls="collapseLoans">
                        <i class="fas fa-fw fa-folder custom-icon"></i>
                        <span>Loans</span>
                    </a>
                    <div id="collapseLoans" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Loans Components:</h6>
                            <a class="collapse-item" href="<?php echo e(route('agent.allAgentLoans')); ?>">All </a>
                            <a class="collapse-item" href="<?php echo e(route('agent.assignedLoans')); ?>">Assign </a>
                            
                        </div>
                    </div>
                </li>
            <?php } ?> 

            <?php    if($role_id == 4) { ?>
           <!-- Nav Item - Pages Collapse Menu -->
           <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProperty"
                    aria-expanded="true" aria-controls="collapseLeads">
                    <i class="fas fa-fw fa-home custom-icon"></i>
                    <span>Property</span>
                </a>
                <div id="collapseProperty" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Property:</h6>
                        <a class="collapse-item" href="<?php echo e(route('pendingProperties')); ?>">Pending Property</a>
                        <a class="collapse-item" href="<?php echo e(route('allProperties')); ?>">List Property</a>
                        <a class="collapse-item" href="<?php echo e(route('addProperty')); ?>">Add Property</a>
                        <a class="collapse-item" href="<?php echo e(route('property_takers.index')); ?>">Property Taker</a>
                    </div>
                </div>
            </li>
            <?php } ?>   
            <?php    if($role_id == env('partnerRole_id')) { ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProperty"
                        aria-expanded="true" aria-controls="collapseLeads">
                        <i class="fas fa-fw fa-home custom-icon"></i>
                        <span>Property</span>
                    </a>
                    <div id="collapseProperty" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Property:</h6>
                            <a class="collapse-item" href="<?php echo e(route('allProperties')); ?>">List Property</a>
                            <a class="collapse-item" href="<?php echo e(route('addProperty')); ?>">Add Property</a>
                        </div>
                    </div>
                </li>
            <?php } ?>   
                    
            <?php    if($role_id == 4) { ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLeads"
                        aria-expanded="true" aria-controls="collapseLeads">
                        <i class="fas fa-fw fa-tasks custom-icon"></i>
                        <span>Web Form & Leads</span>
                    </a>
                    <div id="collapseLeads" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Web Form & Leads:</h6>
                            <a class="collapse-item" href="<?php echo e(route('enquiries.enquiryLead')); ?>">Enquiry Leads</a>
                            <a class="collapse-item" href="#">Property Leads</a>
                            <a class="collapse-item" href="/admin/leads">Leads</a>
                        </div>
                    </div>
                </li>

            <?php } ?>  
            

            <!-- Nav Item - Pages Collapse Menu -->
            <?php    if($role_id == 4) { ?>   
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReferral"
                    aria-expanded="true" aria-controls="collapseReferral">
                    <i class="fas fa-rupee-sign custom-icon"></i>
                    <span>Referral</span>
                </a>
                <div id="collapseReferral" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Referral Management:</h6>
                        <a class="collapse-item" href="<?php echo e(route('admin.withdrawal.requests')); ?>">Reddem Requests</a>
                        <a class="collapse-item" href="<?php echo e(route('referral_earnings')); ?>">Referral Earnings</a>
                        <a class="collapse-item" href="<?php echo e(route('admin.transactions')); ?>">Transaction History</a>
                    </div>
                </div>
            </li>
            <?php } ?>
            
            <!-- <?php    if($role_id == 2) { ?>   
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReferral"
                    aria-expanded="true" aria-controls="collapseReferral">
                    <i class="fas fa-fw fa-dollar-sign fa-2x custom-icon"></i>
                    <span>Referral</span>
                </a>
                <div id="collapseReferral" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Referral Management:</h6>
                        <a class="collapse-item" href="<?php echo e(route('walletbalance')); ?>">Wallet</a>
                        <a class="collapse-item" href="<?php echo e(route('referral_earnings')); ?>">Referral Earnings</a>
                    </div>
                </div>
            </li>
            <?php } ?> -->

            <?php    if($role_id == 2) { ?>   
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReferral"
                    aria-expanded="true" aria-controls="collapseReferral">
                    <i class="fas fa-fw fa-tasks custom-icon"></i>
                    <span>Leads</span>
                </a>
                <div id="collapseReferral" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lead Management:</h6>
                        <a class="collapse-item" href="#">Add Lead</a>
                        <a class="collapse-item" href="#">All Leads</a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php    if($role_id == 4) { ?>   
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTools"
                    aria-expanded="true" aria-controls="collapseTools">
                    <i class="fas fa-fw fa-wrench custom-icon"></i>
                    <span>Tools</span>
                </a>
                <div id="collapseTools" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tools:</h6>
                        <a class="collapse-item" href="<?php echo e(route('allbanks')); ?>">Tied Up Banks</a>
                        <a class="collapse-item" href="<?php echo e(route('loanbanks')); ?>">Loan Banks</a>
                        <!-- <a class="collapse-item" href="<?php echo e(route('sanctioncalculator')); ?>">Eligiblity Calculation</a> -->
                        <a class="collapse-item" href="<?php echo e(route('mis.index')); ?>">MIS</a>
                        <!-- <a class="collapse-item" href="buttons.html">Invoice</a> -->
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">    

            <!-- Nav Item - Activity logs -->
            <li class="nav-item <?php echo e(Request::segment(1) == 'admin' && Request::segment(2) == 'activities' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('activities')); ?>">
                    <i class="fas fa-history custom-icon"></i>
                    <span>Activity Logs</span></a>
            </li>

         
            <!-- Divider -->
            <hr class="sidebar-divider">    

            <!-- Nav Item - Activity logs -->
            <li class="nav-item <?php echo e(Request::segment(1) == 'admin' && Request::segment(2) == 'tree' ? 'active' : ''); ?>">
                <!-- <a class="nav-link" href="<?php echo e(route('mlmView')); ?>"> -->
                <a class="nav-link" href="<?php echo e(route('admin.tree.show')); ?>">
                    <i class="fas fa-project-diagram custom-icon"></i>
                    <span>MLM</span></a>
            </li>   
            
             <!-- Nav Item - Commission -->
             <li class="nav-item <?php echo e(Request::segment(1) == 'admin' && Request::segment(2) == 'allCommission' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('allCommission')); ?>">
                    <i class="fas fa-percentage custom-icon"></i>
                    <span>Commission</span></a>
            </li>   

              <!-- Nav Item - Elgiblity criteria -->
              
              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEligibility"
                    aria-expanded="true" aria-controls="collapseEligibility">
                    <i class="fas fa-clipboard-list custom-icon"></i>
                    <span>Eligibility Calculation</span>
                </a>
                <div id="collapseEligibility" class="collapse" aria-labelledby="headingEligibility" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Eligibility:</h6>
                        <a class="collapse-item" href="<?php echo e(route('eligibilityCriteria')); ?>">Eligibility Criteria</a>
                        <a class="collapse-item" href="<?php echo e(route('standalone.self')); ?>">Self(for admin)</a>
                        <a class="collapse-item" href="#">Salaried(for admin)</a>
                    </div>
                </div>
              </li>

            <?php } ?> 
            <?php    if($role_id == 2) { ?>
            <hr class="sidebar-divider">    

            <!-- Nav Item - Agent MIS -->
            <li class="nav-item <?php echo e(Request::segment(1) == 'admin' && Request::segment(2) == 'activity' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('agent.mis')); ?>">
            
                    <i class="fa fa-address-book"></i>
                    <span>MIS</span></a>
            </li> 
            <?php } ?>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
    <nav class="navbar navbar-expand topbar mb-4 static-top">
                    <!-- <h2><b>Dashboard</b></h2> -->

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

    <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <!-- Mail Icon (Clickable link) -->
                <a class="nav-link" href="<?php echo e(route('messages.index')); ?>" id="mailDropdown" role="button">
                    <i class="fas fa-envelope fa-fw mr-2 text-gray-600"></i>
                    <span class="indicator" id="mail-notification-count"></span>
                </a>
            </li>
    <!-- Notification Icon -->
            <li class="nav-item dropdown no-arrow">
                
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw mr-2 text-gray-600"></i>
                    <span class="indicator" id="notification-count">0</span>
                </a>
                <!-- Dropdown - Notifications -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        <span id="notification-header">No New Notifications</span>
                    </div>
                    <div class="list-group" id="notification-list">
                        <!-- Notifications will be dynamically inserted here -->
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="/notifications" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>
    
            <?php    if($role_id == 4) { ?>
        <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e(Session::get('username')); ?></span>
                    <img class="img-profile rounded-circle" src="<?php echo e(asset('theme')); ?>/dist-assets/img/undraw_profile_2.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                        Logout
                    </a>
                </div>
            </li>
            <?php } ?> 
            <?php    if($role_id == env('partnerRole_id')) { ?>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e(Session::get('username')); ?></span>
                    <img class="img-profile rounded-circle" src="<?php echo e(asset('theme')); ?>/dist-assets/img/undraw_profile_2.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo e(route('partner.profile')); ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                        Logout
                    </a>
                </div>
            </li>
            <?php } ?>
            <?php    if($role_id == 2) { ?>
        <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e(Session::get('username')); ?></span>
                    <img class="img-profile rounded-circle" src="<?php echo e(asset('theme')); ?>/dist-assets/img/undraw_profile_2.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                        Logout
                    </a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </nav>
                <!-- End of Topbar -->

                
                <div class="main-content">
                    <?php echo $__env->yieldContent('content'); ?>

                </div>
                

            </div>
            <!-- End of Content Wrapper -->
            <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo e(asset('theme')); ?>/dist-assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo e(asset('theme')); ?>/dist-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo e(asset('theme')); ?>/dist-assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="<?php echo e(asset('theme')); ?>/dist-assets/js/sb-admin-2.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>
        <script>
        $("document").ready(function(){

            var zone = Intl.DateTimeFormat().resolvedOptions().timeZone;
            console.log(zone);
            // $("#currentTimezone").val(zone);
        });
        </script>
      
        <?php echo $__env->yieldContent('script'); ?>
</body>
<?php /**PATH C:\xampp\htdocs\jfin-may\resources\views/layouts/header.blade.php ENDPATH**/ ?>