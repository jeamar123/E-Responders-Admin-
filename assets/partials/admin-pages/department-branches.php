<section class="content-header">
    <h1>
        Branches
        <small>Related departments</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Departments</li>
        <li class="active">Department Branches</li>
    </ol>
</section>

<!-- Main content -->
<section class="content" dept-id  ng-controller="updateDepartment">
	<div ng-controller="departmentBranch">
		<section class="nav-tabs-custom" style="overflow: hidden" ng-controller="locationSettingtabs as tab">
		    <ul class="nav nav-tabs">
		    	<li class="header">
		    		<i class="fa fa-archive"></i>
		    		Department Branch
		    	</li>
		        <li ng-class="{active:tab.isSet(1)}">
		        	<a href ng-click="tab.setTab(1)">Branches</a>
		        </li>
		        <li class="pull-right">
		        	<a href data-toggle="modal" data-target="#create-branch-modal">
		        		<i class="fa fa-plus-square"></i> &nbsp;
		        		Add new branch info
		        	</a>

				    <!-- ADD BRANCH MODAL -->
				    <div class="modal fade" id="create-branch-modal" tabindex="-1" role="dialog" aria-hidden="true"	>
				        <div class="modal-dialog" >
				            <div class="modal-content">
				                <div class="modal-header">
				                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                    <h4 class="modal-title"><i class="fa fa-archive"></i> Add New Branch</h4>
				                </div>
				                <form ng-submit="addBranchInfo()">
				                    <div class="modal-body">
										<div class="col-md-6">
		                        			<div class="form-group" hidden>
					                            <input ng-model="branch.dept_id" type="hidden" class="form-control" placeholder="Department ID">
					                        </div>
					                        <div class="form-group">
					                        	<label>Branch Name</label>
					                            <input ng-model="branch.branch_name" type="text" class="form-control" placeholder="Branch name" required>
					                        </div>
					                        <div class="form-group">
					                        	<label>Address</label>
					                            <input ng-model="branch.address" type="text" class="form-control" placeholder="Address" required>
					                        </div>
											<div class="form-group">
												<label>Category</label>
												<select class="form-control" ng-model="branch.category" required>
													<option value="" disabled>Choose category</option>
													<option>Police</option>
													<option>Hospital</option>
													<option>Fire Station</option>
												</select>
											</div>	
					                        <div class="form-group">
					                        	<label>Set your description</label>
					                            <textarea class="form-control" style="width: 100%" ng-model="branch.description" placeholder="Department description" required></textarea>
					                        </div>									
										</div>		
										<div class="col-md-6">
					                        <div class="form-group">
					                        	<label>Hotline No.</label>
					                            <input ng-model="branch.hotline_no" type="number" class="form-control" placeholder="Telephone no." required>
					                        </div>
					                        <div class="form-group">
					                        	<label>Mobile No.</label>
					                            <input ng-model="branch.mobile_no" type="number" class="form-control" placeholder="Mobile No." required>
					                        </div>
					                        <div class="form-group">
					                        	<label>Email</label>
					                            <input ng-model="branch.email" type="email" class="form-control" placeholder="Email" required>
					                        </div>
					                        <div class="form-group">
					                        	<label>Website</label>
					                            <input ng-model="branch.website" type="text" class="form-control" placeholder="Website">
					                        </div>											
										</div>
				                    </div>
				                    <div class="modal-footer clearfix">
				                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Create Branch</button>
				                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
				                    </div>
				                </form>
				            </div><!-- /.modal-content -->
				        </div><!-- /.modal-dialog -->
				    </div><!-- /.modal -->

		        </li>
		    </ul>

		    <div ng-show="tab.isSet(1)" class="col-md-12">
		    	<br>
				<div class="box">
				    <div class="box-header">
				        <h3 class="box-title">List of branches</h3>
				    </div><!-- /.box-header -->
				    <div class="box-body table-responsive">
				        <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
				        	<div class="row">
				        		<div class="col-xs-6"></div>
				        		<div class="col-xs-6"></div>
				        	</div>
				        	<table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
					            <thead>
					                <tr role="row">
					                	<th class="sorting_asc" role="columnheader" tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Branch name</th>
					                	<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Address</th>
					                	<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Hotline #</th>
					                	<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Mobile #</th>
					                	<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" style="width: 80px;">Action</th>
					                </tr>
					            </thead>
					            
						        <tbody role="alert" aria-live="polite" aria-relevant="all">
						        	<tr ng-repeat="branch in branches" id="branch_row_{{branch.branch_id}}">
						        		<td>
											<a href ng-click="view_branch(branch.branch_id)" data-toggle="modal" data-target="#view-branch-modal">
												{{branch.branch_name}}
											</a>											
						        		</td>
						        		<td ng-bind="branch.address"></td>
						        		<td ng-bind="branch.hotline_no"></td>
						        		<td ng-bind="branch.mobile_no"></td>
						        		<td style="font-size: 18px;word-spacing: 10px;">
						        			<a href ng-click="updateBranchInfo(branch.branch_id)" data-toggle="modal" data-target="#edit-branch-modal">
						        				<i class="fa fa-edit"></i>
						        			</a>
						        			<a href ng-click="deleteBranchInfo(branch.branch_id)">
						        				<i class="fa fa-trash-o"></i>
						        			</a>
						        		</td>
						        	</tr>
						        </tbody>
				            </table>
				<!--             <div class="row">
				            	<div class="col-xs-6">
				            		<div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div>
				            	</div>
				            	<div class="col-xs-6">
				            		<div class="dataTables_paginate paging_bootstrap">
				            			<ul class="pagination">
				            				<li class="prev disabled"><a href="#">← Previous</a></li>
				            				<li class="active"><a href="#">1</a></li>
				            				<li><a href="#">2</a></li><li><a href="#">3</a></li>
				            				<li><a href="#">4</a></li><li><a href="#">5</a></li>
				            				<li class="next"><a href="#">Next → </a></li>
				            			</ul>
				            		</div>
				            	</div>
				            </div> -->

				        </div>
				    </div><!-- /.box-body -->
				</div>     
		        <br>
		    </div>
		</section>		
		<div viewbranch-modal></div>
		<div editbranch-modal></div>
	</div>
</section><!-- /.content -->