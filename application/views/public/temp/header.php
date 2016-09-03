        <header class="header">
            <a href="<?php echo base_url('admin/#/dashboard'); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                CDO E-Responders
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right" style="min-width: 25%;" >
                    <ul class="nav navbar-nav" style="min-width: 75%;">
                               
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu pull-right" style="min-width: 48%;" ng-controller="userInfoController">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <ul class="list-inline">
                                    <li><i class="glyphicon glyphicon-user"></i></li>
                                    <li><span first-name></span></li>
                                    <li><i class="caret"></i></li>
                                </ul>
                            </a>
                            <ul class="dropdown-menu" ng-repeat="data in user_info">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url('assets/img/profile_pics') ?>/{{data.profile_pic}}" class="img-circle" alt="User Image" />
                                    <p>
                                        <span full-name></span> - {{data.position}}
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#profile" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('index.php/user/sign_out'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Redirected Alertnotofication -->
                        <li class="dropdown notifications-menu pull-right" ng-controller="notifController">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="label label-warning" ng-if="notifCount != 0 ">{{notifCount}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have {{notifCount}} notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li ng-repeat="notif in notifContent">
                                            <a href="#" ng-if="notif.category == 'Fire Station'">
                                                <i class="fa fa-fire-extinguisher danger"></i> {{notif.redirected_by}} <br>has redirected a request ID: <span class="text-primary">{{notif.alert_id}} </span>
                                            </a>                                        
                                            <a href="#" ng-if="notif.category == 'Police'">
                                                <i class="fa fa-shield  info"></i> {{notif.redirected_by}} <br>has redirected a request ID: <span class="text-primary">{{notif.alert_id}} </span>
                                            </a>
                                            <a href="#" ng-if="notif.category == 'Hospital'" >
                                                <i class="fa fa-medkit warning"></i> 
                                                <span class="pull-right" style="width: 79%;display: block;">{{notif.redirected_by}} <br>has redirected a request ID: <span clss="text-primary">{{notif.alert_id}} </span></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>                     
                    </ul>
                </div>
            </nav>
        </header>