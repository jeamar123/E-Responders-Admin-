
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url('assets/img/avatar3.png') ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info user-fname-wrapper">
                            <p>Hello, <span class="user-fname" first-name></span> </p> 
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.html">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="">
                                <i class="fa fa-th"></i> <span>Manage Location</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#location"><i class="fa fa-angle-double-right"></i> Static View</a></li>
                                <li><a href="#update-location"><i class="fa fa-angle-double-right"></i> Change Location Details </a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#mailbox">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Posts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                                <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                                <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Members</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#add-user"><i class="fa fa-angle-double-right"></i> Add New Users</a></li>
                                <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Administrators</a></li>
                                <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> Mobile Subscribers</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-archive"></i> <span>Department</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#department-details"><i class="fa fa-angle-double-right"></i> Department Details</a></li>
                                <li><a href="#update-department"><i class="fa fa-angle-double-right"></i> Update Department Details</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>