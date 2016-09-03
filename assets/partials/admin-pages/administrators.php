<section class="content-header">
    <h1>
        Administrators
        <small>List of Administrators</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Members</li>
        <li class="active">Administrators</li>
    </ol>
</section>

<!-- Main content -->
<section class="contents margin-top-sm">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
              <!-- For Superadmin Reports -->
              <table class="table table-hover table-bordered">
                <div class="btn-group pull-left">
                    <button type="button" class="btn btn-success margin-bottom-xs">Category</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href ng-click="category = 'Hospital' ">Hospital</a></li>
                        <li><a href ng-click="category = 'Police' ">Police Department</a></li>
                        <li><a href ng-click="category = 'Fire Station' ">Fire Station</a></li>
                        <li class="divider"></li>
                        <li><a href ng-click="category = '' ">Show All</a></li>
                    </ul>
                </div>
                <div class="col-xs-4 pull-right">
                    <div class="col-md-6">
                        Show names per:
                    </div>
                    <div class="col-md-6">
                        <input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
                    </div>
                </div>                
                <thead>
                  <th>User ID</th>
                  <th>Fullname</th>
                  <th>Department</th>
                  <th>Category</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  <tr dir-paginate="list in user_lists | filter:category | itemsPerPage: pageSize" current-page="currentPage">
                    <td>{{list.user_id}}</td>
                    <td>{{list.fname}} {{list.mname}} {{list.lname}}</td>
                    <td>{{list.dept_name}}</td>
                    <td>{{list.category}}</td>
                    <td>
                        <a href ng-click="delete_user(list.user_id)"><i class="fa fa-trash-o"></i></a>&nbsp;
                    </td>
                  </tr>
                </tbody>
               </table> 
              <div class="text-center">
                 <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="http://localhost/Admin-CDO/assets/js/pagination/dirPagination.tpl.html"></dir-pagination-controls>
              </div>           
            </div>
        </div>
    </div>

</section><!-- /.content -->


