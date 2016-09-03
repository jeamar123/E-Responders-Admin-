<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Set Department Details
        <small>Department Description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Department</li>
        <li class="active">Set Department Details</li>
    </ol>
</section>

<section id="cover_photo" class="content" dept-id  ng-controller="updateDepartment">
	<section class="container">
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<div class="fileinput-new thumbnail" style="max-width: 1040px; max-height: 399px;">
				<img ng-show="dept_img" src="{{url}}assets/uploads/{{dept.dept_image}}" alt="...">
			</div>
			<div class="fileinput-preview fileinput-exists thumbnail"  style="max-width: 1040px; max-height: 399px;"></div>
			<div>
				<span class="btn btn-default btn-file">
					<span class="fileinput-new">Update Image</span>
					<span class="fileinput-exists" ng-click="save_dept_img()">Change</span>
					<input type="file" id="post_file" name="userfile" onchange="angular.element(this).scope().file_upload(this.files)">
				</span>
				<button id="btn_upload" ng-click="save_dept_img()" class="btn btn-success fileinput-upload fileinput-upload-button"><i class="glyphicon glyphicon-upload"></i> Upload</button>
				<a href="#" class="btn btn-danger fileinput-exists" ng-click="clear()" data-dismiss="fileinput">Remove</a>
			</div>
            <span>
                <img src="{{base_url}}../assets/img/ajax-loader2.gif" ng-if="loading_screen == true ">
                <span class="text-primary" ng-if="loading_screen == true ">Your file is uploading...</span>
                <span id="loading_msg" class="text-success" ng-if="loading_msg == true ">File successfully uploaded</span>
            </span>			
		</div>
	</section>
	<div class="contentHere">
		<section >
			<form ng-submit="updateDept()">		
				<div class="col-md-6">
					<div class="form-group col-md-12 hide" >
						<label>Department ID</label>
						<input type="hidden" class="form-control" ng-model="dept.dept_id" placeholder="Enter Department name" >
					</div>
					<div class="form-group col-md-12">
						<label>Department name</label>
						<input type="text" class="form-control" ng-model="dept.dept_name" placeholder="Enter Department name" required>
					</div>
					<div class="form-group col-md-12">
						<label>Description</label>
						<textarea class="form-control" ng-model="dept.dept_desc" placeholder="Add department description" required></textarea>
						
					</div>
<!-- 					<div class="form-group col-md-12">
						<label>Category</label>
						<select class="form-control" ng-model="dept.category" required>
							<option value="" disabled>Choose category</option>
							<option>Police</option>
							<option>Hospital</option>
							<option>Fire Station</option>
						</select>
					</div> -->
					<div class="form-group col-md-12">
						<label>Hotline Number</label>
						<input type="text" class="form-control" ng-model="dept.hotline_no" name="hotline" placeholder="Hotline number" >
					</div>
					<div class="form-group col-md-12">
						<label>Mobile Number</label>
						<input type="text" class="form-control" ng-model="dept.mobile_no" name="mobile" placeholder="Mobile number" >
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group col-md-12">
						<label>Address</label>
						<input type="text" class="form-control" ng-model="dept.address" name="address" placeholder="Enter Address" required>
					</div>
					<div class="form-group col-md-12">
						<label>Features / Services</label>
						<textarea class="form-control" ng-model="dept.features" placeholder="Add services or features which your department provides" required></textarea>
					</div>
					<div class="form-group col-md-12">
						<label>Email</label>
						<input type="email" class="form-control" ng-model="dept.email" name="email" placeholder="Add email">
					</div>
					<div class="form-group col-md-12">
						<label>Website</label>
						<input type="text" class="form-control" ng-model="dept.website" name="website" placeholder="Add site">
					</div>
					<div class="form-group col-md-6">
						<input type="submit" value="Save Information " class="form-control btn btn-info btn-add-user" name="btn-add">
					</div>
				</div>
			</form>
		</section>
	</div>
</section>

