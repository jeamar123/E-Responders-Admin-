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
				<img ng-show="dept_img" src="{{url}}assets/img/{{dept.dept_image}}" alt="...">
			</div>
			<div class="fileinput-preview fileinput-exists thumbnail"  style="max-width: 1040px; max-height: 399px;"></div>
			<div>
				<span class="btn btn-default btn-file">
					<span class="fileinput-new">Select image</span>
					<span class="fileinput-exists">Save image</span>
					<input type="file" name="...">
				</span>
				<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
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
						<input type="text" class="form-control" ng-model="dept.dept_desc" placeholder="Add department description" required>
					</div>
					<div class="form-group col-md-12">
						<label>Category</label>
						<select class="form-control" ng-model="dept.category" required>
							<option>Police</option>
							<option>Hospital</option>
							<option>Fire Station</option>
						</select>
					</div>
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