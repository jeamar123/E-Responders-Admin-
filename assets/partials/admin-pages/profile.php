<section class="content-header">
    <h1>
        Profile
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
    </ol>
</section>
<!-- Main content -->
<section class="content" ng-repeat="info in user_info">
    <div class="col-md-3">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="max-width: 1040px; max-height: 399px;">
                <img src="{{url}}assets/img/profile_pics/{{info.profile_pic}}" alt="{{info.profile_pic}}">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail"  style="max-width: 1040px; max-height: 399px;"></div>
            <div>
                <span class="btn btn-default btn-file">
                    <span class="fileinput-new">Update Image</span>
                    <span class="fileinput-exists" ng-click="save_dept_img()">Change</span>
                    <input type="file" id="post_file" name="userfile" onchange="angular.element(this).scope().profile_file_upload(this.files)">
                </span>
                <button id="btn_profile_upload" ng-click="save_prof_img()" class="btn btn-success fileinput-upload fileinput-upload-button"><i class="glyphicon glyphicon-upload"></i> Upload</button>
            </div>
            <div>
                <img src="{{url}}assets/img/ajax-loader2.gif" ng-show="loading_screen">
                <span class="text-info" ng-show="loading_msg">Uploading image</span>
                <span class="text-success" ng-show="loading_success">Image successfully saved</span>
            </div>
        </div> 

        <ul class="list-group margin-top-sm">
            <li class="list-group-item text-muted">Profile</li>    
            <li class="list-group-item  text-right">
                <span class="pull-left">
                    <strong>User Type: </strong>
                </span>
                {{info.user_type}}
            </li>  
            <li class="list-group-item  text-right">
                <span class="pull-left">
                    <strong>Username: </strong>
                </span>
                {{info.username}}
            </li>  
            <li class="list-group-item">
                <a href data-toggle="modal" data-target="#modalAccountSettings">
                    <i class="glyphicon glyphicon-cog"></i>&nbsp;
                    Change Password
                </a>
            </li>     
        </ul>    
    </div>
    <div class="col-md-9">
        <div class="alert alert-info alert-dismissable">
            <a class="panel-close close" data-dismiss="alert">×</a> 
            <i class="fa fa-coffee"></i>
             Update your personal information.
        </div>   
        <h3>Personal Information</h3> 
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-lg-3 control-label">First name:</label>
                <div class="col-lg-8">
                  <input class="form-control" type="text" ng-model="info.fname">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Middle name:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" ng-model="info.mname">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Last name:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" ng-model="info.lname">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Position:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" ng-model="info.position">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Birth Date: </label>
                <div class="col-lg-8">
                    <input class="form-control" type="date" ng-model="info.bday">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Gender:</label>
                <div class="col-lg-8">
                    <select ng-model="info.gender" class="form-control">
                        <option value="" required>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Barangay:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" ng-model="info.barangay">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">City:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" ng-model="info.city">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Province:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" ng-model="info.province">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Postal Code:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" ng-model="info.postal_code">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-8">
                    <input type="button" ng-click="update_user_info()" class="btn btn-primary" value="Save Changes">     
                </div>
            </div>
        </form>
    </div>
</section><!-- /.content -->
<!-- Modal -->
<div class="modal fade" id="modalAccountSettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <i class="glyphicon glyphicon-cog"></i>&nbsp;
                    Account Settings
                </h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success alert-dismissable" id="success_msg" ng-show="respond_msg">
                    <a class="panel-close close" data-dismiss="alert">×</a> 
                    <i class="fa fa-coffee"></i>
                     Password successfully changed.
                </div>              
                <form>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" ng-model="account.new_pass" class="form-control" placeholder="Change your Password">
                    </div>
                    <div class="form-group">
                        <label>Re-type Password</label>
                        <input type="password" ng-model="account.retype_new_pass" class="form-control" placeholder="Re-type password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" ng-click="save_account_setting()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#btn_profile_upload').hide();
</script>