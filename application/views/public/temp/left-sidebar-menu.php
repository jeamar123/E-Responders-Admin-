
            <aside class="left-side sidebar-offcanvas" ng-controller="userInfoController">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url('assets/img/profile_pics');?>/{{user_info.prof_pic}}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info user-fname-wrapper margin-top-xs">
                            <p>Hello, <a href="#profile"><span class="user-fname text-primary" first-name></span></a> </p> 
                        </div>
                    </div>
                    <!-- search form -->
<!--                     <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form> -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="#dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview" ng-show="disable_tab">
                            <a href="">
                                <i class="glyphicon glyphicon-map-marker"></i> <span>Manage Location</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#location"><i class="fa fa-angle-double-right"></i> Static View</a></li>
                                <li><a href="#update-location"><i class="fa fa-angle-double-right"></i> Change Location Details </a></li>
                                <li><a href="#other-departments"><i class="fa fa-angle-double-right"></i> View Other Departments </a></li>
                            </ul>
                        </li>
                        <li ng-show="hide_tab">
                            <a href="#mobile-alerts">
                                <i class="fa fa-mobile"></i> <span>Mobile Alerts</span>
                            </a>
                        </li>
<!--                         <li>
                            <a href="#mailbox">
                                <i class="fa fa-envelope"></i> 
                                <span>mailbox</span>
                            </a>
                        </li> -->
                        <li ng-show="disable_tab">
                            <a href="#posts">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Posts</span>
                            </a>
                        </li>
                        <li class="treeview" ng-show="user_type">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Members</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#add-user"><i class="fa fa-angle-double-right"></i> Add New Users</a></li>
                                <li><a href="#administrators"><i class="fa fa-angle-double-right"></i> Administrators</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-archive"></i> <span>Department</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#department-details"><i class="fa fa-angle-double-right"></i> Department Details</a></li>
                               <!--  <li ng-show="user_type "><a href="#department-lists"><i class="fa fa-angle-double-right"></i> List of Departments</a></li> -->
                                <li><a href="#update-department"><i class="fa fa-angle-double-right"></i> Update Department Details</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>  
                <!-- /.sidebar -->
            </aside>