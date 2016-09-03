<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mobile Alerts
        <small>Alerts from mobile users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mobile Alerts</li>
    </ol>
</section>

<!-- Main content -->
<section class="content" id="mobile_map_alert" ng-controller="mobileAlertController">
    <div class="contentHEre">   
		<div loading-screen>
			<center class="loading-view-container">
				<img src="http://localhost/Admin-CDO/assets/img/ajax-loader1.gif" ng-show="loading">
			</center>
		</div>
        <div id="directions-panel"></div>
        <div class="col-md-9 remove-side-padding-left">
            <div class="margin-bottom-sm" id="new-map-canvas" style="width:100%x;height:480px;"></div>            
        </div>
        <div class="col-md-3 remove-side-padding">           
            <ul class="list-group" id="mobile-requests" style="max-height: 395px;overflow: overlay;">
                 <li class="list-group-item text-muted">Mobile Alert Requests</li>  
                <li  class="list-group-item" ng-repeat="list in alert_lists" ng-if="list.status=='request_for_respond'">
                    <a href onclick="return false;" class="btn-mobile-alert text-primary" lat="{{list.lat}}" lng="{{list.lng}}">
                        Subscriber {{list.alert_id}}
                    </a> 
                </li>             
            </ul>
        </div>
        <section id="new-map-canvas-script" ng-controller="deptWidURL">
        <script type="text/javascript">
            // Mao ning  para ma focus ang map sa CDO 
            // var socket = io.connect( "http://localhost:8080" );
            var socket = io.connect( "http://cdoresponder.herokuapp.com/" );
            
            $("#new-map-canvas").ready(function(){
                var contentString = "";
                var marker_start,lat,lng,zoom;

                $('#new-map-canvas-script').on('deptID_URL', function(event, data) {
                    $.get( data.url + 'maps/show_focused_map_details/' + data.dept_id , function( response ) {
                        lat = response.lat;
                        lng = response.lng;     
                        zoom = response.zoom;
                        
                        var myCenter = new google.maps.LatLng(lat,lng);
                        var mapProp = {
                            center: myCenter,
                            zoom: 12,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById("new-map-canvas"),mapProp); 

                        var marker = new google.maps.Marker({
                              position: myCenter,
                              title:'Click to show information',
                              icon: data.url + '/assets/img/marker-icon/temple-2.png'
                              });
                        marker.setMap(map);
                        var infowindow = new google.maps.InfoWindow();  
                        var bounds = new google.maps.LatLngBounds();

                        var ctr = 1;
                        var prompt = false;
            
                        socket.on( "load-all-data" , 
                            function ( data ) {
                                console.log(data)
                                if (data.category == 'load_alert_map' ) {
                                    get_all_request_markers();
                                    prompt = true;
                                }
                            } );
                        

                        get_all_request_markers();

                        function get_all_request_markers(){
                            $.get( data.url + 'maps/get_current_request' , function( locations ){
                                console.log(locations)
                                for (var i = 0; i < locations.length; i++) {                                                    
                                    console.log(locations[i]['alert_id'])
                                    if (locations[i]['status'] == 'request_for_respond') {
                                        marker = new google.maps.Marker({
                                            position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']),
                                            icon: data.url + '/assets/img/marker-icon/icon4.png',
                                            map: map
                                        });                                        
                                        var bound_position = new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']);
                                        bounds.extend(bound_position); 
                                        bounds.extend(myCenter); 
                                        console.log('Alert Count: '+locations.length);
                                        if (locations.length == 1 && prompt == true) {
                                            var html_content = '<h4 style="margin:0">Requesting for respond</h4>'+
                                                               '<hr style="margin: 8px 0 8px 0">'+
                                                               '<p>'+locations[i]['msg']+'</p>'+
                                                               '<p>'+
                                                               '<hr style="margin: 8px 0 8px 0">'+
                                                               '<button class="btn btn-success btn-action btn-action-respond-'+locations[i]['alert_id']+'" for="respond" id="'+locations[i]['alert_id']+'">Respond</button> &nbsp;'+
                                                               '<button class="btn btn-danger btn-action btn-action-deny-'+locations[i]['alert_id']+'" for="deny" id="'+locations[i]['alert_id']+'">Deny</button>'+
                                                               '</p>';
                                            $.fancybox.open(html_content);
                                        };

                                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                            return function() {
                                                contentString = '<div id="infowindow" class="infowindow_'+locations[i]['alert_id']+'" style="max-width: 400px;">'+
                                                                        '<h4 style="margin:0">Requesting for respond</h4>'+
                                                                        '<hr style="margin: 8px 0 8px 0">'+
                                                                        '<p>'+locations[i]['msg']+'</p>'+
                                                                        '<p>'+
                                                                        '<hr style="margin: 8px 0 8px 0">'+
                                                                        '<button class="btn btn-success btn-action btn-action-respond-'+locations[i]['alert_id']+'" for="respond" id="'+locations[i]['alert_id']+'">Respond</button> &nbsp;'+
                                                                        '<button class="btn btn-danger btn-action btn-action-deny-'+locations[i]['alert_id']+'" for="deny" id="'+locations[i]['alert_id']+'">Deny</button>'+
                                                                        '</p>'+
                                                                '</div>';                       
                                                infowindow.setContent(contentString);
                                                infowindow.open(map, marker);
                                            }
                                          })(marker, i));                            
                                    };
                                }
                                
                            },'json');                            
                        }

                        var text_value = "";
                        // pass alert_id to angular controller
                        $("body").delegate('.btn-action','click',function(){
                            var action_btn = $(this).attr('for');
                            var id = $(this).attr('id');
                            get_all_request_markers();
                            $('body').scope().$broadcast( "alert-action" , {
                                    'alert_id' : $(this).attr('id'),
                                    'action' : $(this).attr('for')
                            });

                            if (action_btn == "respond") {
                                $(".btn-action-deny-"+id).hide();
                                $(this).text('Responded');
                                $(this).css('width','100%').attr('disabled','disabled');
                            }else{
                                $(".btn-action-respond-"+id).hide();
                                $(this).text('Denied');  
                                $(this).css('width','100%').attr('disabled','disabled');                              
                            }
                        });

                        var directionsDisplay = new google.maps.DirectionsRenderer();
                        var directionsService = new google.maps.DirectionsService(); 

                        $('#mobile-requests').delegate('.btn-mobile-alert','click',function(){
                            var end_lat = $(this).attr('lat'),
                                end_lng = $(this).attr('lng'); 
                                
                            directionRequest = {
                                origin:myCenter,
                                destination:new google.maps.LatLng(end_lat,end_lng),
                                avoidHighways:true,
                                optimizeWaypoints: true,
                                travelMode: google.maps.TravelMode.DRIVING
                            };
                            directionsService.route(directionRequest, function(response, status) {
                              if (status == google.maps.DirectionsStatus.OK) {
                                    directionsDisplay.setDirections(response);
                                    directionsDisplay.setMap(map);
                                    directionsDisplay.setOptions({
                                        preserveViewport: true,
                                        suppressMarkers: true,
                                        polylineOptions:{
                                            strokeColor:"#456ccc"
                                        }
                                    });
                                }
                            }); 
                            map.fitBounds(bounds); 
                        });                              

                    }, "json" );        
                });
            });            
        </script>
        </section>
    </div>
</section><!-- /.content