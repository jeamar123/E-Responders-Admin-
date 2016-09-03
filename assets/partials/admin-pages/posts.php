<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Posts
        <small>Department Posts</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Posts</li>
    </ol>
</section>
<br>

<!-- Start: Main Content -->    
<section class="col-md-12" ng-controller="postController">
    <div class='container box'>
        <div class='box-solid title_head'>
            <h3 class='box-title'>Broadcast a post for everyone <small>Send a post to community</small></h3>
        </div><!-- /.box-header -->
        <div class='box-body pad'>
            <form ng-submit="add_post()" novalidate>
                <textarea required="true" class="textarea" ng-model="user.post_content" id="post_content" name="post_content" placeholder="Write something here..." style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                <button class="btn-post btn btn-primary" ng-click="broadcast( )"><i class="fa fa-envelope"></i> Post</button>

                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <span class="btn btn-success btn-file btn-post file_data">
                        <i class="fa fa-picture-o"></i>
                        <span class="fileinput-new">Upload</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" id="post_file" name="userfile" onchange="angular.element(this).scope().file_upload(this.files)">
                    </span>
                    <span class="fileinput-filename"></span>
                    <a href="#" ng-click="clear()" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                </div>                
                <span>
                    <img src="{{base_url}}assets/img/ajax-loader2.gif" ng-if="loading_screen == true ">
                    <span class="text-primary" ng-if="loading_screen == true ">Your file is uploading...</span>
                    <span id="loading_msg" class="text-success"ng-if="loading_msg == true ">File successfully uploaded</span>
                </span>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <ul class="timeline">

            <!-- timeline time label -->
            <li class="time-label">                
                <div class="btn-group pull-left">
                    <button type="button" class="btn btn-primary">Newsfeeds</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href ng-click="get_posts_by_department(1)">Hospital</a></li>
                        <li><a href ng-click="get_posts_by_department(2)">Police Department</a></li>
                        <li><a href ng-click="get_posts_by_department(3)">Fire Station</a></li>
                        <li class="divider"></li>
                        <li><a href ng-click="get_posts_by_department(null)">Show All</a></li>
                    </ul>
                </div>
                <div class="pull-right col-md-4" for="search post">
                    <input type="text" ng-model="search_post" class="form-control" placeholder="Search post here ...">
                </div>          
            </li>
            <!-- /.timeline-label -->

            <!-- timeline item -->
            <li ng-repeat="post in posts | filter: search_post" id="post_{{post.post_id}}">
                <!-- timeline icon -->
                <i class="fa fa-medkit bg-yellow" ng-if="post.category == 'Hospital' "></i>
                <i class="fa fa-shield bg-blue" ng-if="post.category == 'Police' "></i>
                <i class="fa fa-fire-extinguisher bg-red" ng-if="post.category == 'Fire Station' "></i>
                <div class="timeline-item">
                    <div class="btn-group pull-right" ng-if="current_dept_id == post.dept_id">
                        <a href data-toggle="dropdown" style="padding: 7px;">
                            <span class="caret"></span>
                        </a>
                        <span class="sr-only">Toggle Dropdown</span>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href ng-click="delete_post(post.post_id)">
                                    <i class="fa fa-trash-o"></i>
                                    Delete Post
                                </a>
                            </li>
                            <li>
                                <a href ng-click="get_edit_post(post.post_id,post.post_content)" data-toggle="modal" data-target="#edit_post_modal">
                                    <i class="fa fa-edit"></i>
                                    Edit Post
                                </a>
                            </li>
                        </ul>
                    </div>                
                    <span class="time"><i class="fa fa-clock-o"></i>&nbsp;{{post.post_date | date:'medium'}}</span>

                    <h3 class="timeline-header"><a href="#">{{post.branch_name}}</a> </h3>
                    <div class="timeline-body">
                        <!-- Shows if image -->
                        <div class="image_container margin-top-bottom-xs" ng-if="post.extension == 'jpg' || post.extension == 'png' || post.extension == 'gif' || post.extension == 'jpg' ">
                            <a href="" ng-click="showFancyBoxImg(post.post_file)" id="post_img_id_{{post.post_id}}">
                                <img src="{{file_url}}{{post.post_file}}" alt="{{post.post_file}}" class="img-thumbnail post_img" >
                            </a>
                        </div>
                        <!-- Shows if compressed file -->
                        <div class="image_container margin-top-bottom-xs" ng-if="post.extension == 'zip' || post.extension == 'tar.gz' || post.extension == 'rar' ">
                            <a href="">
                                <img src="{{img_url}}icon-zip.png" alt="{{post.post_file}}" class="img-thumbnail post_img" ><br>
                                <button class="btn btn-success margin-top-bottom-xs">Download File</button>
                            </a>
                        </div>
                       <div ng-bind-html="post.post_content"></div>
                    </div>

                    <div class='timeline-footer'>
                        <a class="btn btn-primary btn-xs">Comments</a>
                    </div>
                </div>                 
            </li>
            <!-- END timeline item -->

            <!-- Edit Post Modal -->
            <div editpost-modal></div>
            <!-- End: Edit Post Modal -->
        </ul>        
    </div>
</section>

<script type="text/javascript">
    $('.textarea').wysihtml5(); 
</script>
