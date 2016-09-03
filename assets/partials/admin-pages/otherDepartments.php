<section class="content-header">
    <h1>
        View All Departments
        <small>Departmen locations</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Manage Location</li>
        <li class="active">View Other Departments</li>
    </ol>
</section>
    
<!-- Main content -->
<section class="content" ng-controller="departmentLocationsController">
    <!-- Button for Superadmin-->
    <div class="btn-group margin-bottom-xs" ng-show="showBtn">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        View by :  <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href ng-click="get_category('1')">Hospitals</a></li>
            <li><a href ng-click="get_category('2')">Police Stations</a></li>
            <li><a href ng-click="get_category('3')">Fire Stations</a></li>
        </ul>
    </div>
    <div id="mapForAllDeparmtments" style="width:100%x;height:400px;"></div>

</section><!-- /.content