<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="../../admin_file/assets/images/logo.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="../../admin_file/assets/images/logo.png" alt="" height="">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="../../admin_file/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="../../admin_file/assets/images/logo-light.png" alt="" height="17">
                    </span>
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
                            <a class="nav-link menu-link" href="#sidebarTables" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                                <i class="bx bx-table"></i> <span data-key="t-channels">Channels</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarTables">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/employee/add_chanel" class="nav-link" data-key="t-chanel">Service Hinzufügen</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/employee/add_chanel_service" class="nav-link" data-key="t-service">Channels Hinzufügen</a>
                                    </li>
                                     
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarCustomer" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                                <i class="bx bxs-user"></i> <span data-key="t-channels">Kundeninfo</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarCustomer">
                                <ul class="nav nav-sm flex-column">
                                     
                                    <li class="nav-item">
                                        <a href="/employee/add_customer" class="nav-link" data-key="t-chanel">Kunde Hinzufügen</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/employee/customer_list" class="nav-link" data-key="t-chanel">Kundenlisten</a>
                                    </li>
                                    
                                     
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#results" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                                <i class="bx bxl-squarespace"></i> <span data-key="t-channels">Results</span>
                            </a>
                            <div class="collapse menu-dropdown" id="results">
                                <ul class="nav nav-sm flex-column">
                                     
                                    <li class="nav-item">
                                        <a href="/employee/results" class="nav-link" data-key="t-chanel">Immobilienmakler</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/employee/results_new" class="nav-link" data-key="t-chanel">Immobilienfinanzierung</a>
                                    </li>
                                    
                                     
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/employee/calender">
                                <i class="ri-calendar-line"></i> <span data-key="t-widgets">Calender</span>
                            </a>
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