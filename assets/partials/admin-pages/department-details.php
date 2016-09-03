<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Department Info
        <small>Details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Departments</li>
        <li class="active">Department Details</li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="updateDepartment">
	<div id="department_profile" >
		<div class="profile_content">
			<img src="{{url}}assets/uploads/{{dept.dept_image}}" class="img-thumbnail" alt="" ng-if="dept.dept_image" />
			<img src="{{url}}assets/uploads/default_dept_img.jpg" class="img-thumbnail" alt="" ng-if="!dept.dept_image" />
		</div>
		<div class="department_info_container">
			<h3>{{dept.dept_name}}</h3>
			<p>{{dept.dept_desc}}</p>
			<p><label>Address: &nbsp;&nbsp;</label>{{dept.address}}</p>
			<p><label>Mobile No.: &nbsp;&nbsp;</label>{{dept.mobile_no}}</p>
			<p><label>Hotline No.: &nbsp;&nbsp;</label>{{dept.hotline_no}}</p>
			<p ng-if="dept.website == 'none' "><label>Website: &nbsp;&nbsp;</label>{{dept.website}}</p>
			<p ng-if="dept.website != 'none' "><label>Website: &nbsp;&nbsp;</label><a href="http://{{dept.website}}" target="__blank">{{dept.website}}</a></p>
			<p><label>Email: &nbsp;&nbsp;</label>{{dept.email}}</p>
		</div>
	</div>
</section><!-- /.content -->