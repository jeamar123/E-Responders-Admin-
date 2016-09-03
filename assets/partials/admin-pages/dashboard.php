
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section ng-controller="userInfoController">
      <!-- multistep form -->
      <div id="msform" style="overflow: inherit;height: 600px;" ng-controller="dashboardController" ng-show="disable_step">
        <!-- progressbar -->
        <ul id="progressbar">
          <li class="active">Department Info</li>
          <li>Location Info</li>
          <li>Done</li>
        </ul>
        <!-- fieldsets -->
        <fieldset>
          <h2 class="fs-title">Set Department Info</h2>
             <form>     
                  <div class="col-md-12">
                      <div class="form-group col-md-12">
                          <input type="text" class="dept_input" name="dept_name" ng-model="dept.dept_name" placeholder="Write your department name" >
                      </div>
                      <div class="form-group col-md-12">
                          <textarea class="dept_input" name="dept_desc" ng-model="dept.dept_desc" placeholder="Add department description" ></textarea>
                      </div>
                      <div class="form-group col-md-12">
                          <input type="email" class="dept_input" name="email" ng-model="dept.email" name="email" placeholder="Add email">
                      </div>
                      <div class="form-group col-md-12 remove-left-side-padding">
                          <div class="alert alert-success" style="margin-left: 0">
                              Note: You can add more description in Department tab after you finished the steps
                          </div>
                      </div>
                  </div>
              </form>
              <input type="button" name="next" class="next action-button btn btn-primary btn-add-user" value="Next" />
        </fieldset>
        <fieldset style="width: 77%;">
          <h2 class="fs-title">Set Your Location Info</h2>               
          <input type="text" ng-model="mapdata.map_name" class="map_info" id="mapname" placeholder="Map name">   
          <input type="text" ng-model="mapdata.map_description" class="map_info" id="map_description" placeholder="Map description">
          <select ng-model="mapdata.map_type">
              <option value="" disabled>Choose map type</option>
              <option value="ROADMAP">Roadmap</option>
              <option value="SATELLITE">Satellite</option>
              <option value="HYBRID">Hybrid</option>
              <option value="TERRAIN">Terrain</option>
          </select>
          <div class="form-group col-md-12 remove-left-side-padding">
              <div class="alert alert-success" style="margin-left: 0">
                  Note: You can add more description in Department tab after you finished the steps
              </div>
          </div>        
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button step-2 map_next" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Done setting up your department info</h2>
          <h3 class="fs-subtitle">Press the Proceed button to save your info</h3>
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="submit" name="submit" ng-click="save_initial_info()" class="submit action-button" value="Proceed" />
        </fieldset>
      </div>
      <!-- Dashboard Main Content -->
      <div class="margin-top-sm" id="main-content-dashboard" ng-controller="mobileAlertController">
        <div class="col-md-12 remove-side-padding">
            <div class="col-md-4">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{count_responded}}</h3>
                 <p>Accepted requests</p>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark"></i>
                </div>
                <a href="{{url}}" class="small-box-footer" ng-show="show_content_admin">
                  View lists of alert requests <i class="fa fa-arrow-circle-right"></i>
                </a>
                <a href class="small-box-footer" ng-show="show_content_superadmin">
                  Responder alert details
                </a>
              </div>              
            </div>  
            <div class="col-md-4">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{count_denied}}</h3>
                  <p>Denied requests</p>
                </div>
                <div class="icon">
                  <i class="ion ion-close"></i>
                </div>
                <a href="{{url}}" class="small-box-footer" ng-show="show_content_admin">
                  View lists of alert requests <i class="fa fa-arrow-circle-right"></i>
                </a>
                <a href class="small-box-footer" ng-show="show_content_superadmin">
                  Responder alert details
                </a>
              </div>              
            </div>  
            <div class="col-md-4">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{count_request_for_respond}}</h3>
                  <p>Not yet responded</p>
                </div>
                <div class="icon">
                  <i class="ion ion-alert-circled"></i>
                </div>
                <a href="{{url}}" class="small-box-footer" ng-show="show_content_admin">
                  View lists of alert requests <i class="fa fa-arrow-circle-right"></i>
                </a>
                <a href class="small-box-footer" ng-show="show_content_superadmin">
                  Responder alert details
                </a>
              </div>              
            </div>  

        </div>
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-body">
              <!-- For Superadmin Reports -->
              <table class="table table-hover table-bordered" ng-show="show_content_superadmin">
                <div class="btn-group pull-left" ng-show="show_content_superadmin">
                    <button type="button" class="btn btn-success margin-bottom-xs">Category</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href ng-click="categorize_mobile_alerts(1)">Hospital</a></li>
                        <li><a href ng-click="categorize_mobile_alerts(2)">Police Department</a></li>
                        <li><a href ng-click="categorize_mobile_alerts(3)">Fire Station</a></li>
                        <li class="divider"></li>
                        <li><a href ng-click="categorize_mobile_alerts('')">Show All</a></li>
                    </ul>
                </div>
                <thead>
                  <th>Alert ID</th>
                  <th>Responder</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Date Recieved</th>
                  <th>Date Responded/Denied</th>
                </thead>
                <tbody>
                  <!-- <tr ng-repeat="list in alert_reports track by $index | itemsPerPage: pageSize" class="alert_row_{{list.alert_id}}"> -->
                  <tr dir-paginate="list in alert_reports | itemsPerPage: pageSize" current-page="currentPage" class="alert_row_{{list.alert_id}}">
                    <td>{{list.alert_id}}</td>
                    <td>{{list.dept_name}}</td>
                    <td>{{list.category}}</td>
                    <!-- IF status == request_for_respond -->
                    <td ng-if="list.status == 'request_for_respond' "><span class="text-warning">Waiting for respond</span></td>
                    <!-- IF status == request_for_respond -->
                    <td ng-if="list.status == 'responded' "><span class="text-success">Emergency alert responded</span></td>
                    <!-- IF status == denied -->
                    <td ng-if="list.status == 'denied' "><span class="text-danger">Emergency alert Denied</span></td>
                    <td>{{list.date | date:'medium'}}</td>
                    <td>{{list.date_responded | date:'medium'}}</td>
                  </tr>
                </tbody> 
            </table>     
            <div class="text-center" ng-show="show_content_superadmin">
               <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="http://localhost/Admin-CDO/assets/js/pagination/dirPagination.tpl.html"></dir-pagination-controls>
            </div>         
              <!-- For Administrator Reports -->
              <table class="table table-hover table-bordered" ng-show="show_content_admin">
                <thead>
                  <th>Alert ID</th>
                  <th>Status</th>
                  <th>Date Recieved</th>
                  <th>Date Responded/Denied</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <tr dir-paginate="list in alert_reports | itemsPerPage: pageSize" current-page="currentPage" class="alert_row_{{list.alert_id}}">
                    <td>{{list.alert_id}}</td>
                    <!-- IF status == request_for_respond -->
                    <td ng-if="list.status == 'request_for_respond' "><span class="text-warning">Waiting for respond</span></td>
                    <!-- IF status == request_for_respond -->
                    <td ng-if="list.status == 'responded' "><span class="text-success">Emergency alert responded</span></td>
                    <!-- IF status == redirected -->
                    <td ng-if="list.status == 'redirected' "><span class="text-info">Request was redirected</span></td>
                    <!-- IF status == denied -->
                    <td ng-if="list.status == 'denied' "><span class="text-danger">Emergency alert Denied</span></td>
                    <td>{{list.date | date:'medium'}}</td>
                    <td>{{list.date_responded | date:'medium'}}</td>
                    <td id="action-list">
                    <!-- IF not yet responded -->
                      <div ng-if="list.status == 'request_for_respond' ">
                        <a class="action-icon-1 btn-action" id="{{list.alert_id}}" action="respond"><i class="glyphicon glyphicon-ok"></i>
                          <p class="desc1">Respond</p>
                        </a>&nbsp;
                        <a class="action-icon-2 btn-action" id="{{list.alert_id}}" action="deny"><i class="glyphicon glyphicon-remove"></i>
                          <p class="desc2">Deny</p>
                        </a>&nbsp;
                        <a class="action-icon-3 btn-redirect" id="{{list.alert_id}}" action="redirect" data-toggle="modal" data-target="#modalRedirect">
                          <i class="glyphicon glyphicon-share-alt"></i>
                          <p class="desc3">Redirect</p>            
                        </a> &nbsp;
                        <a class="action-icon-4 btn-action" id="{{list.alert_id}}" action="delete"><i class="glyphicon glyphicon-trash"></i>
                          <p class="desc4">Delete</p>            
                        </a>                     
                      </div>
                    <!-- IF responded -->
                      <div ng-if="list.status == 'responded' ">
                        <i class="glyphicon glyphicon-ok action-icon-1 text-muted">
                          
                        </i>&nbsp;&nbsp;
                        <i class="glyphicon glyphicon-remove action-icon-2 text-muted">
                          
                        </i>&nbsp;&nbsp;
                        <i class="glyphicon glyphicon-share-alt action-icon-2 text-muted">
                          
                        </i>&nbsp;&nbsp;
                        <a class="action-icon-4 btn-action" id="{{list.alert_id}}" action="delete"><i class="glyphicon glyphicon-trash"></i>
                          <p class="desc4">Delete</p>            
                        </a>                     
                      </div>
                            
                    <!-- IF redirected -->
                      <div ng-if="list.status == 'redirected' ">
                        <i class="glyphicon glyphicon-ok action-icon-1 text-muted">
                          
                        </i>&nbsp;&nbsp;
                        <i class="glyphicon glyphicon-remove action-icon-2 text-muted">
                          
                        </i>&nbsp;&nbsp;
                        <i class="glyphicon glyphicon-share-alt action-icon-3 text-muted">
                          
                        </i>&nbsp;&nbsp;
                        <a class="action-icon-4 btn-action" id="{{list.alert_id}}" action="delete"><i class="glyphicon glyphicon-trash"></i>
                          <p class="desc4">Delete</p>            
                        </a>                     
                      </div>
                            
                    <!-- IF denied -->
                      <div ng-if="list.status == 'denied' ">
                        <i class="glyphicon glyphicon-ok action-icon-1 text-muted">
                          
                        </i>&nbsp;&nbsp;
                        <i class="glyphicon glyphicon-remove action-icon-2 text-muted">
                          
                        </i>&nbsp;&nbsp;
                        <i class="glyphicon glyphicon-share-alt action-icon-3 text-muted">
                          
                        </i>&nbsp;&nbsp;
                        <a class="action-icon-4 btn-action" id="{{list.alert_id}}" action="delete"><i class="glyphicon glyphicon-trash"></i>
                          <p class="desc4">Delete</p>            
                        </a>                     
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>               
              <div class="text-center" ng-show="show_content_admin">
                 <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="http://localhost/Admin-CDO/assets/js/pagination/dirPagination.tpl.html"></dir-pagination-controls>
              </div>               
            </div>
          </div>        
        </div>
      </div>    
    </section>


  <!-- Modal Redirect -->
  <div class="modal fade" ng-controller="requestRedirectionController" id="modalRedirect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Alert ID: <span id="alert_id"></span></h4>
        </div>
        <form>
          <div class="modal-body" style="overflow: overlay;height: 350px;">
            <h4>Sorted by distance</h4>
            <div class="container-fluid" style="margin-left: 10px;">
              <div class="checkbox" ng-repeat="list in department_list">
                <span>{{$index+1}} : </span>
                <label>
                  <input type="checkbox" class="dept_id" 
                        value="{{list.dept_id}}"
                        mobileID="{{list.mobile_id}}"> 
                        {{list.dept_name}} <!-- ({{list.kilometers}} Kilometers)  -->
                </label>
              </div>                        
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="btn-redirect-request">Redirect</button>
          </div>
        </form>
      </div>
    </div>
  </div> 

<script type="text/javascript">
// For Modal Redirect
$("body").delegate('.btn-redirect','click',function(){
  var alert_id = $(this).attr('id');
  $("#alert_id").text(alert_id);
})
// Click button Redirect
$("body").delegate('#btn-redirect-request','click',function(){
  var checkedValue = [];
  var send_data = {};
  var inputElements = document.getElementsByClassName('dept_id');
  for(var i=0; inputElements[i]; ++i){
        if(inputElements[i].checked){
             checkedValue.push(inputElements[i].value);
        }
       
  }
  send_data = {
    "data_list" : checkedValue,
    "alert_id": $("#alert_id").text()
  };
  $('body').scope().$broadcast( "redirect-request" , send_data );   
  // console.log(send_data);
})
// For Action 
$("body").delegate('.btn-action','click',function(){
    $('body').scope().$broadcast( "dashboard-alert-action" , {
            'alert_id' : $(this).attr('id'),
            'action' : $(this).attr('action')
    });  
});
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
$('.btn-add-user').attr('disabled',true);
$('#map_next').attr('disabled','disabled');

$('.dept_input').on('keyup',function() {
    if ($('input[name=dept_name]').val().length < 1 || $('textarea[name=dept_desc]').val().length < 1 || $('input[name=email]').val().length < 1) {
        $('.btn-add-user').attr('disabled',true);
    }else{
        $('.btn-add-user').attr('disabled',false);
    }
})
$('.map_info').on('keyup',function() {
    console.log($('#map_description').val().length)
    if ($('#mapname').val().length < 1 || $('#map_description').val().length < 1 ) {
        $('#map_next').attr('disabled','disabled');

    }else{
        $('#map_next').attr('disabled','disabled');
    }
})

$(".next").click(function(){
  if(animating) return false;
  animating = true;
  
  current_fs = $(this).parent();
  next_fs = $(this).parent().next();
  
  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  
  //show the next fieldset
  next_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'transform': 'scale('+scale+')'});
      next_fs.css({'left': left, 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

$(".previous").click(function(){
  if(animating) return false;
  animating = true;
  
  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();
  
  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
  
  //show the previous fieldset
  previous_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1-now) * 50)+"%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'left': left});
      previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

$(".submit").click(function(){
  return false;
})
  
</script>