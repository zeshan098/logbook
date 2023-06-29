<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="/" class="logo logo-dark">
                    <!-- <span class="logo-sm">
                        <img src="../../admin_file/assets/images/logo.png" alt="" height="22">
                    </span> -->
                    <!-- <span class="logo-lg">
                        <img src="../../admin_file/assets/images/logo.png" alt="" height="">
                    </span> -->
                </a>
                <!-- Light Logo-->
                <a href="/" class="logo logo-light">
                    <!-- <span class="logo-sm">
                        <img src="../../admin_file/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="../../admin_file/assets/images/logo-light.png" alt="" height="17">
                    </span> -->
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/backoffice/add-host">
                                <i class="ri-profile-line"></i> <span data-key="t-widgets">Add Host</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarUser" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                                <i class="bx bx-user-pin"></i> <span data-key="t-channels">User Info</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarUser">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/backoffice/add_backoffice" class="nav-link" data-key="t-chanel">Add Backoffice</a>
                                    </li><li class="nav-item">
                                        <a href="/backoffice/add_supervisor" class="nav-link" data-key="t-chanel">Add Supervisor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/backoffice/add_user" class="nav-link" data-key="t-chanel">Add Student</a>
                                    </li>
                                    
                                     
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebartask" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                                <i class="bx bx-task"></i> <span data-key="t-channels">Assign User &  Task</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebartask">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/backoffice/assign-user" class="nav-link" data-key="t-chanel">Assign User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/backoffice/assign-task" class="nav-link" data-key="t-chanel">Assign Task</a>
                                    </li> 
                                    
                                    <li class="nav-item">
                                        <a href="/backoffice/approved-disapproved-task" class="nav-link" data-key="t-chanel">Approved Disapproved Task</a>
                                    </li> 
                                     
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarreport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                                <i class="ri-file-pdf-line"></i> <span data-key="t-channels">Report</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarreport">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="report/activity-report" class="nav-link" data-key="t-chanel">Activity Report</a>
                                    </li> 
                                     
                                </ul>
                            </div>
                        </li>

                         

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>