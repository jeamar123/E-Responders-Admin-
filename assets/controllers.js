app
		
	.service( "io" , [
		function service ( ) {
			var socket = io.connect( "http://cdoresponder.herokuapp.com/" );
			// var socket = io.connect( "http://localhost:8080" );

			return {
				"socket": socket
			}
		}
	] )

	.controller('loginController', [
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ){
			$scope.user = {};
			$scope.authenticate_login = function (){
				$http.post( getServerData.url + 'user/authenticate' , $scope.user).
					success(function onSuccess(response){
						// console.log(response);
						if (response == 1) {
							window.location = getServerData.url + "admin/#/dashboard";					
						}else{
							alert('Account does not exist');
						}
					})
					.error(function(m) {
						console.log(m)
					})

			}
		}
	])

	.controller('dashboardController', [
		"$scope",
		"$http",
		"$timeout",
		"getServerData",
		function controller( $scope , $http , $timeout , getServerData ){
			$scope.dept = {};
			$scope.mapdata = {};
			$scope.count_requests = "test";

			get_user_info();
			get_dept_data();			

			console.log($scope.dept.dept_name);

			$scope.save_initial_info = function(){
				$http.post( getServerData.url + "dept/create" , $scope.dept )
					.success(function(response){
						// console.log(response)
					})
				$http.post( getServerData.url + 'map/update', $scope.mapdata )
					.success(function(data){
						console.log(data)
					});
				location.reload();
			}

			function get_user_info(){
				$http.get(getServerData.url + 'user/getUserInfo')
					.success(function onSuccess(response){
						console.log(response);
						$scope.user_info = response;
						for(x in response){
							console.log(response[x].dept_id);
							$http.get(getServerData.url + 'maps/show_focused_map_details/' + response[x].dept_id)
								.success(function(request_map_info){
									console.log(request_map_info.location_id);

									if (response[x].dept_id == 0 || request_map_info.location_id == null){
										$scope.disable_step = true;
									}else{
										$scope.disable_step = false;
									}
								})


						}						
					}).error(function onError( m ){
						console.log(m);
					});	
			}

			function get_dept_data() {
				$http.get( getServerData.url + 'department/get_dept_info' )
					.success( function ( data ) {
						console.log(data)
						if (data != null) {
							for ( val of data){
								$scope.dept.dept_id = val.dept_id;
								$scope.dept.dept_name = val.dept_name;
								$scope.dept.dept_desc = val.dept_desc;
								$scope.dept.category  = val.category;
								$scope.dept.hotline_no = val.hotline_no;
								$scope.dept.mobile_no = val.mobile_no;
								$scope.dept.address = val.address;
								$scope.dept.email = val.email;
								$scope.dept.website = val.website;
								$scope.dept.dept_image = val.dept_image;
								$scope.dept.features = val.features;
								$scope.dept_img = true;
								if (val.website == 'none') {
									$scope.dept.webstat == false;
								}else{
									$scope.dept.webstat == true;
								}
							}
						}else{
							$scope.dept_img = false;
						}
					});
			}	

		}
	])

	.controller('userInfoController', [		
		"$scope",
		"$http",
		"$timeout",
		"getServerData",
		function controller( $scope , $http , $timeout , getServerData ){
			// var socket = io.connect( "http://cdoresponder.herokuapp.com/" );
			$scope.url = getServerData.url;
			$scope.user_info = {};
			$scope.user_info.bday = '';
			$scope.disable_tab = false;
			var user_type = false;
			get_user_info();

			$scope.update_user_info = function () {
				var html_prompt = "<div id='update_prompt' style='width:100%;'>" +
								  "<h4>Successfully updated</h4><hr>"+
								  "Personal information successfully updated.<hr>" +
								  "</div>";				
				$http.post(getServerData.url + 'user/edit_info',$scope.user_info)
					.success(function(response){
						if (response.status == 'success') {
							$.fancybox.open(html_prompt);
							get_user_info();
							$timeout(function() {
								$.fancybox({
									'onComplete': function() { 
										$("#fancybox-wrap, #fancybox-overlay").delay(2500).fadeOut(); 
									} 
								});
							}, 2000);
						};
					})
			}
			function get_user_info(){
				$http.get(getServerData.url + 'user/getUserInfo')
					.success(function onSuccess(response){
						console.log(response);
						$scope.user_info = response;
						for(x in response){
							$scope.user_info.bday = new Date(response[x].bday);
							$scope.user_info.prof_pic = response[x].profile_pic;
							$scope.$broadcast("get-user-type",{user_type:response[x].user_type});
							// For Superadmin
							if (response[x].user_type == 'Superadmin')
								$scope.user_type = true;
							else
								$scope.user_type = false;

							// For Administrator
							$http.get(getServerData.url + 'maps/show_focused_map_details/' + response[x].dept_id)
								.success(function(request_map_info){
									console.log(request_map_info.location_id);

									if (response[x].dept_id == 0 || request_map_info.location_id == null){
										$scope.disable_tab = false;
									}else{
										$scope.disable_tab = true;
									}
									
								})
							
						}						
					}).error(function onError( m ){
						console.log(m);
					});	
			}
		}
	])
	//  kuhaon niya ang dept ID sa current user
	.controller('userDeptInfo', [
		"$scope",
		"$http",
		"$element",
		"getServerData",
		"$timeout",
		"io",
		function controller( $scope , $http , $element , getServerData , $timeout , io ) {

			var cur_dept_category = '';

			$scope.user_dept_id = {};
			$http.get(getServerData.url + 'user/getUserInfo')
				.success(function onSuccess(response){
					for( val of response ){
						$scope.$broadcast( 'dept_id', val.dept_id );
						// console.log(val.dept_id)
					}
				})
			io.socket.on( "load-all-data" , 
				function ( data ) {
					console.log(data);
					// Get department category
					$http.get( getServerData.url + 'department/get_dept_info' )
						.success(function(data_arr){
							console.log(data_arr);
							for(x in data_arr){
								console.log(data_arr[x].category +'==='+data.category);
								cur_dept_category = data_arr[x].category;
								$http.get(getServerData.url + 'maps/get_current_request')
									.success(function(req_data){
										var alert_dept_id
										for(val of req_data){
											alert_dept_id = val.dept_id;
										}	
										console.log( alert_dept_id +'=='+ data.dept_id)
										// Alarms all department according to category
										if (cur_dept_category == data.category && alert_dept_id == data.dept_id) {
											console.log('Alert sound : Active');
											alert_tone();
											io.socket.emit( "load-finish" , { 'category' : 'load_alert_map' } ); 
											window.location = getServerData.url + "admin/#/mobile-alerts";							
										}else if(data.category == 'newsfeeds'){
											$scope.$broadcast('load_newsfeeds', { 'status' : 'load' });
										}
									})
								
							}
						})
				} );
				
				$scope.$on('alarm_off',
					function on(evt,data){
						console.log(data.alarm);
						$('.alert_tone').hide().remove();
					})
				function alert_tone(){
					var alert_html = '<embed class="alert_tone" src="'+getServerData.url+'assets/sound/emergency_siren.mp3" autoplay="true" loop="true" width="2" height="0">'+
						             '</embed>'+
						             '<noembed>'+
						             	'<bgsound class="alert_tone" src="'+getServerData.url+'assets/sound/emergency_siren.mp3">'+
						             '</noembed>';					
					$('#alert_tone_container').append(alert_html);
				}
		}
	])		
	//  kuhaon niya ang dept ID sa current user
	.controller('deptWidURL', [
		"$scope",
		"$http",
		"$element",
		"getServerData",
		function controller( $scope , $http , $element , getServerData ) {
			$scope.user_dept_id = {};
			$http.get(getServerData.url + 'user/getUserInfo')
				.success(function onSuccess(response){
					for( val of response ){
						$scope.$broadcast( 'dept_id', val.dept_id );
						$element.trigger('deptID_URL', { dept_id: val.dept_id, url : getServerData.url });
					}
				})
		}
	])
	// For Routes
	.controller('page-controller', [
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ){
			// $scope.active = function ( id ) {
			// 	if (!$('li[ng-click="active('+id+')"]').attr('class','active')) {
			// 		$('li[ng-click="active('+id+')"]').removeClass('active');
			// 	};
			// }
		} 	
	])
	// Manage Location
	.controller('currentMapLocation',[ 
		"$scope",
		"$http",
		function controller( $scope , $http ){
			$scope.$emit('LOAD');
			
			$http.jsonp('http://filltext.com/?rows=10&delay=3&fname={firstName}&callback=JSON_CALLBACK')
				.success(function(data){
					$scope.listofpeople = "ok";	
					console.log("ok")	
					$scope.$emit('UNLOAD');
				})

		}
	])
	.controller('updateLocation' , [
		"$scope",
		function controller ( $scope ) {
			$scope.$emit('LOAD'); 
			$scope.$on( "long-lang" ,
				function on ( evt , data ) {
					$scope.$emit('UNLOAD');
					// console.log( data.lng() + " " + data.lat() );
				} );
		}
	] )
	.controller('saveLocation', [
		"$scope",
		"$http",
		"getServerData",
		"$element",
		function controller( $scope , $http , getServerData , $element){
			$scope.mapdata = {};
			$scope.department_id = "";
			$scope.department_info = {};
			get_display_map_id();
			$scope.$on( "dept_id" ,
				function on ( evt , data ) {
					$http.get( getServerData.url + 'maps/show_focused_map_details/' + data )
						.success( function ( response ) {
							$scope.mapdata.dept_id = data;	
							console.log(response);
							if ( response != 'null' ) {	
								$scope.mapdata = response;	
								$scope.mapdata.dept_id = data;
							};
						})

				});

			$scope.range = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21];
			$scope.zoom = function () {
				console.log($scope.mapdata.zoom);
				if ($scope.mapdata.zoom) {
					$scope.zoom.zoomValue = $scope.mapdata.zoom;
					$scope.zoom.status = true;
				}else{
					$scope.zoom.status = false;
				}
			}
			$scope.$on( "long-lang" ,
				function on ( evt , data ) {
					$scope.$apply(function () {
						$scope.mapdata.lat = data.lat();
						$scope.mapdata.lng = data.lng();
					});
				} );

			$scope.saveMap = function(){
				$http.post( getServerData.url + 'map/update', $scope.mapdata )
					.success(function(data){
						alert(data.message);
						console.log(data)
						location.reload();
					})
			}

			function get_lat_lng( coordinate ) {
				return coordinate;
			}
			function get_display_map_id() {
				$http.get( getServerData.url + 'maps/show_focused_map_id' )
					.success( function ( response ) {
						console.log(response);
						$scope.department_info = response;
					})					
			}
		}
	])
	.controller('markerList', [
		"$scope",
		"$http",
		"$element",
		"getServerData",
		function controller( $scope , $http , $element , getServerData ){
			$scope.marker_info = {};
			$scope.dept_branch_list = {};
			$scope.marker_data = {};
			$scope.zoom = {};
			$scope.range = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21];

			no_marker_branch(); // show list of branches with no marker set

			$scope.$on( "dept_id" ,
				function on ( evt , data ) {
					$scope.markerList = {};
					show_marker_list(data);
			});		 
			$scope.$on( "branch-long-lang" ,
				function on ( evt , data ) {
					$scope.$apply(function () {
						$scope.marker_info.lat = data.lat();
						$scope.marker_info.lng = data.lng();
					});
				} );		 
			$scope.$on( "edit-branch-long-lang" ,
				function on ( evt , data ) {
					$scope.$apply(function () {
						$scope.marker_data.lat = data.lat();
						$scope.marker_data.lng = data.lng();
					});
				} );

			$scope.zoom = function () {
				if ($scope.marker_info.zoom) {
					$scope.zoom.zoomValue = $scope.marker_info.zoom;
					$scope.zoom.status = true;
				}else{
					$scope.zoom.status = false;
				}
			}

			$scope.display_map_name = function (dept_id) {
				$http.get( getServerData.url + 'maps/get_marker_data/' + dept_id )
					.success(function(data2){						
						$scope.marker_data = data2;
						$scope.$broadcast('display_marker_data', data2);
						$element.trigger('view_lat_lng', { 
								lat : $scope.marker_data.lat , 
								lng : $scope.marker_data.lng ,
								map_type : $scope.marker_data.map_type
						});
					});
			}

			$scope.add_branch_marker = function () {
				$http.get(getServerData.url + 'user/getUserInfo')
					.success(function onSuccess(response){
						for( val of response ){
							// Gets the main department id of the user
							$scope.marker_info.main_dept_id = val.dept_id; 
							if ( ($scope.marker_info.lat && $scope.marker_info.lng) ) {
								$http.post( getServerData.url + 'maps/set_branch_marker' , $scope.marker_info )
									.success(function( response ){
										console.log(response)
										no_marker_branch();
										$scope.marker_info = "";
										alert(response.msg);
										show_marker_list(val.dept_id);
										location.reload();
									})
							}else{
								alert('Set your marker first')
							}
						}
					})
			}
			$scope.get_edit_info = function ( marker_dept_id ) {
				$http.get( getServerData.url + 'maps/get_marker_data/' + marker_dept_id )
					.success(function(data2){						
						$scope.marker_data = data2;
						$scope.$broadcast('getMarkerData', data2);
						$element.trigger('edit_lat_lng', { 
								lat : $scope.marker_data.lat , 
								lng : $scope.marker_data.lng ,
								map_type : $scope.marker_data.map_type
						});
					});
			}
			$scope.set_as_main_map = function ( marker_dept_id ) {
				if (confirm('Do you want to set as main map?')) {
					$http.get( getServerData.url + 'maps/set_main_map_view/' + marker_dept_id )
						.success(function(data){
							console.log(data);
							location.reload();
						})					
				};
			}
			$scope.delete_map_info = function ( location_id , marker_dept_id ) {
				// alert(location_id + "-" +marker_dept_id)
				$scope.marker_data.location_id = location_id;
				$scope.marker_data.dept_id = marker_dept_id;
				if (confirm('Are you sure you want to delete this map?')) {
					$http.post( getServerData.url + 'maps/delete_map_info' , $scope.marker_data )
						.success( function (response) {
							console.log(response)
							location.reload();
							alert(response.msg)
						})					
				};
			}
			function show_marker_list(data) {
				$http.get( getServerData.url + 'maps/markerList/' + data )
					.success( function ( response ) {
						$scope.markerList = response;
						console.log(response)
					});
			}
			function no_marker_branch() {
				$http.get( getServerData.url + 'department/no_marker_added_branches' )
					.success( function( data ) {
						// console.log(data)
						$scope.dept_branch_list = data;
					})				
			}

		}
	])
	.controller('viewMapModalController', [
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ) {
			$scope.display_map_name = "";
			$scope.$on('display_marker_data',function(evt,data){
				$scope.display_map_name = data.map_name;
				
			});
		}
	])
	.controller('modalController', [
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ) {
			$scope.marker_data = {};
			$scope.$on('getMarkerData',function(evt,data){
				console.log(data);
				$scope.marker_data = data;
			});
			$scope.edit_unfocused_marker = function () {
				$http.post( getServerData.url + 'maps/edit_map_info' , $scope.marker_data )
					.success( function (response) {
						console.log(response)
						alert(response.msg);
						location.reload();
					});
			}
		}
	])
	.controller('locationSettingtabs', [
		"$scope",
		function controller( $scope ){
	        this.tab = 1;

	        this.setTab = function (tabId) {
	            this.tab = tabId;
	        };

	        this.isSet = function (tabId) {
	            return this.tab === tabId;
	        };
		}
	])
	// For Members page
	.controller('addUser', [
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ){
			$scope.user_data = {};

			$scope.save_data = function (){
				if ($scope.user_data.password != $scope.user_data.rtpassword) {
					alert('Password did not match');
				}else{
					$http.post( getServerData.url + 'user/addNewUser' , $scope.user_data )
						.success( function( response ) {
							console.log(response)
							if (response.status == 'error' ) {
								alert(response.msg);
							}else{
								alert(response.msg);
							}
						})					}
			}
		}
	])
	// For Mailbox Page
	.controller('mailBox', [
		"$scope",
		function controller( $scope ){
			$scope.$emit('LOAD');
			
		}
	])
	// For Department
	.controller('getDepartmentInfo',[
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ){

		}
	])
	.controller('departmentBranch',[
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ){
			get_branches();
			$scope.branch = {};
			$scope.branches = {};
			$scope.$on( "dept_id" ,
				function on ( evt , data ) {
					$scope.branch.dept_id = data
				} );

			$scope.view_branch = function (branch_id) {
				$scope.$broadcast('get_branch_info', {
					branch_id : branch_id
				});
			}
			$scope.addBranchInfo = function() {
				console.log($scope.branch)
				var add_branch_prompt = "<div style='width:100%;'>" +
								  "<h4>Successully created</h4><hr>"+
								  "New branch successfully created.<hr>" +
								  "</div>";					
				$http.post( getServerData.url + 'department/create_branch' , $scope.branch )
					.success(function ( response ) {
						console.log(response)
						$scope.branch = "";
						get_branches();
						$.fancybox.open(add_branch_prompt);
					})
					.error(function ( response ) {
						console.log(response)
					})
			};
			$scope.updateBranchInfo = function (branch_id){
				$scope.$broadcast('get_branch_id_for_edit', {
					branch_id : branch_id
				});				
			}
			$scope.deleteBranchInfo = function (branch_id){
				if (confirm('Are you sure you want to delete this branch?')) {
					$http.get(getServerData.url +'department/delete_branch/'+branch_id)
						.success(function(response){
							$('#branch_row_'+branch_id).fadeOut();
							console.log(response)
						})					
				}
			}
			$scope.$on('load_branch_info',function(evt,data){
				get_branches();
			})
			function get_branches()
			{
				$http.get( getServerData.url + 'department/branch_list' )
					.success( function ( data ) {
						$scope.branches = data;
					})
					.error( function ( data ) {
						console.log('Error')
					})
			}

		}
	])
	.controller('updateDepartment',[
		"$scope",
		"$http",
		"$timeout",
		"getServerData",
		function controller( $scope , $http , $timeout , getServerData ){
			var fd = new FormData();
			var img_status = false;
			$scope.dept = {};
			$scope.dept_name = "";
			$scope.url = getServerData.url;
			get_dept_data ();

			$scope.updateDept = function(){
				$http.post( getServerData.url + "dept/create" , $scope.dept )
					.success(function(response){
						if (response.status == "create") {
							alert('Successully created');
							location.reload();
						}else if (response.status == "update") {
							alert('Successully updated');
						}else{
							alert("Error");
						}
						console.log(response);
					})
			}
			$scope.save_dept_img = function (){
				var upload_url = getServerData.url + 'department/do_upload/';
				$scope.loading_screen = true;
				$scope.loading_msg = false;
				$.ajax({
					type: "POST",
					url: upload_url,
					data:fd,
    				dataType: 'json',
					contentType: false,
					cache: false,
					processData:false
				}).success(function(resp){
					alert(resp.msg);
					$scope.loading_screen = false;
					$scope.loading_msg = true;
					$timeout(function(){
						$('#loading_msg').fadeOut();
					},2500);					
				})
				// console.log(fd)
			}
			$scope.file_upload = function (img) {
				console.log(img[0]);
				fd.append('userfile',img[0]);				
				img_status = true;
				$('#btn_upload').show();
			}
			$scope.clear = function ()
			{
				fd = new FormData();
				status = "no_file";
				fd.append('userfile', 'none');
				$timeout(function() {
					$('#btn_upload').hide();
				},200);
			}
			$('#btn_upload').hide();
			function get_dept_data () {
				$http.get( getServerData.url + 'department/get_dept_info' )
					.success( function ( data ) {
						console.log(data)
						if (data != null) {
							for ( val of data){
								$scope.dept.dept_id = val.dept_id;
								$scope.dept.dept_name = val.dept_name;
								$scope.dept.dept_desc = val.dept_desc;
								$scope.dept.category  = val.category;
								$scope.dept.hotline_no = val.hotline_no;
								$scope.dept.mobile_no = val.mobile_no;
								$scope.dept.address = val.address;
								$scope.dept.email = val.email;
								$scope.dept.website = val.website;
								$scope.dept.dept_image = val.dept_image;
								$scope.dept_img = true;
								if (val.website == 'none') {
									$scope.dept.webstat == false;
								}else{
									$scope.dept.webstat == true;
								}
							}
						}else{
							$scope.dept_img = false;
						}
					});			
			}
		}
	])
	.controller('mobileAlertController',[
		"$scope",
		"$http",
		"$timeout",
		"getServerData",
		"io",
		function controller( $scope , $http , $timeout , getServerData , io ){
		
			$scope.url = getServerData.url + 'admin/#/mobile-alerts';
			$scope.alert_lists = {};
			$scope.alert_reports = {};
			$scope.show_content_superadmin = false;
			$scope.show_content_admin = false;
			
			get_request_alert();
			count_requests();


			io.socket.on( "load-all-data" , 
				function ( ) {
					get_request_alert();
				} );

			 $scope.categorize_mobile_alerts = function(category){
				category = typeof category !== 'undefined' ? category : null;
				$http.get(getServerData.url+'maps/display_request_alert_by_category/'+category)
					.success(function(data){
						console.log(data)
						$scope.alert_reports = data;
					})
			}
			$scope.$on( "get-user-type" ,
				function on ( evt , data ) {
					console.log(data. user_type);
					if (data.user_type == 'Superadmin') {
						$scope.show_content_superadmin = true;
						$scope.show_content_admin = false;
					}else{
						$scope.show_content_superadmin = false;
						$scope.show_content_admin = true;
					}
				} )
			$scope.$on( "alert-action" ,
				function on ( evt , data ) {
					$http.post( getServerData.url + 'maps/update_alert_action', data )
						.success(function(response){
							console.log(response.msg);
							$scope.$emit('alarm_off', {'alarm' : 'off'});
							// io.socket.emit( "alert-response" , { 'msg' : response.msg } );
						})
				} );

			$scope.$on( "dashboard-alert-action",
				function on( evt , data ) {
					console.log(data);
					$http.post( getServerData.url + 'maps/update_alert_action', data )
						.success(function(response){
							console.log(response);
							if(response.action == 'delete'){
								$(".alert_row_"+response.alert_id).fadeOut();
								count_requests();
							}else{
								get_request_alert();
								count_requests();
							}
							$scope.$emit('alarm_off', {'alarm' : 'off'});
						})					
			})
			// function get_user_type(type){
			// 	alert(type)
			// }
			function get_request_alert(){
				$http.get(getServerData.url + 'maps/get_current_request')
					.success(function(data){
						console.log(data)
						if (data != null) {
							if (data[0].dept_id == 0) {
								$scope.dashboard_content = false;
							}else{
								$scope.dashboard_content = true;
							}							
						};
						$scope.alert_lists = data;
						$scope.alert_reports = parseDate(data);
						count_requests();
					})
			}
			function parseDate (get_data) {
				
				for( val of get_data){
					if (val.date_responded == '0000-00-00 00:00:00') {
						val.date_responded = '*Not yet responded';
					}else{
						val.date_responded = (Date.parse(val.date_responded));
					}
					val.date = (Date.parse(val.date));		
				}
				return get_data;
			}

			function count_requests(){
				$http.get( getServerData.url + 'maps/count_requests/' )
					.success( function ( data ){
						console.log(data)
						$scope.count_responded = data.responded;
						$scope.count_denied = data.denied;
						$scope.count_request_for_respond = data.request_for_respond;						 
					})
			}					
		}
	])
	.controller('postController', [
		"$scope",
		"$http",
		"$timeout",
		"getServerData",
		"io",
		function controller( $scope , $http , $timeout , getServerData , io ) {		
			var fd = new FormData();
			var status = "no_file";
			var html_prompt = "<div style='width:100%;'>" +
							  "<h4>Status Is Empty</h4><hr>"+
							  "Status Is Empty.This status update appears to be blank. Please write something or attach a link or photo to update your status.<hr>" +
							  "</div>";	
							  
			// var socket = io.connect( "http://cdoresponder.herokuapp.com/" );
			$scope.file_url = getServerData.url+'assets/uploads/';
			$scope.current_dept_id = "";
			$scope.post_content = "";
			$scope.posts = {};
			$scope.post_date = "";
			$scope.base_url = getServerData.url;

			$scope.add_post = function () {
				if ($('.textarea').val() || status == "has_file" ) {
					fd.append('post_content',$('#post_content').val());		
					var upload_url = getServerData.url + 'newsfeeds/do_upload/';
					var upload = httpReq(upload_url, fd);
					if (status == 'has_file') {
						$scope.loading_screen = true;
						$scope.loading_msg = false;						
					};
					upload.success(function(response){
						if (status == 'has_file') {
							$scope.loading_screen = false;
							$scope.loading_msg = true;
							$timeout(function(){
								$('#loading_msg').fadeOut();
								$scope.loading_msg = false;
							},2500);
						};
						console.log(response);
						if (response.status == "empty") {
							$.fancybox.open(html_prompt);
						};
						$('.textarea').data("wysihtml5").editor.setValue();

						io.socket.emit( "load-finish", { category : 'newsfeeds'} );
					});
					upload.error(function(response){
						console.log(response);
						$.fancybox.open(html_prompt);
					});								
				}else{
					$.fancybox.open(html_prompt);
				}
			}
			$scope.file_upload = function (files) {
				fd.append('userfile',files[0]);				
				status = "has_file";
			}
			$scope.clear = function ()
			{
				fd = new FormData();
				status = "no_file";
				fd.append('userfile', 'none');	
			}
			$scope.get_posts_by_department = function (category) 
			{	
				get_posts(category);
			}
			$scope.delete_post = function (post_id) 
			{	
				if (confirm('Do you want to delete this post?')) {
					$http.post( getServerData.url + 'newsfeeds/delete_post', post_id )
						.success(function(response){
							$('#post_'+post_id).fadeOut();
							io.socket.emit( "load-finish", { category : 'newsfeeds'});
						})				
				};
			}
			$scope.get_edit_post = function (post_id,post_content) 
			{	
				var posts = get_posts();
				$scope.$broadcast('edit_post_data',{
					post_id : post_id ,
					post_content : post_content
				});
			}
			$scope.$on('load_newsfeeds',
				function on(evt,data){
					get_posts( );
			})
			$scope.$on( "load_posts" , 
				function ( evt , message ) {
					io.socket.emit( "load-finish", { category : 'newsfeeds'} );
				} );
			$scope.showFancyBoxImg = function ( post_file )
			{
				$.fancybox.open($scope.file_url+post_file);
			}
			function httpReq ( url , data ) {
				return $.ajax({
					type: "POST",
					url: url,
					data:data,
    				dataType: 'json',
					contentType: false,
					cache: false,
					processData:false
				});
			}
			get_posts();
			function get_posts(category) {
				category = typeof category !== 'undefined' ? category : null;
				$http.get( getServerData.url + 'newsfeeds/show_posts/' + category )
					.success (function (data) {
						$scope.img_url = getServerData.url + 'assets/img/';
						console.log( data );
						$scope.posts = parseData(data);
						console.log($scope.posts);
					});
			}
			$scope.$on( "message-brod" , 
				function ( evt , message ) {
					$scope.$apply( function ( ) {
						$scope.posts.unshift( {
							"post_content": message
						} );
					} );
				} );
			function parseData (get_data) {
				for(x in get_data) {
					get_data[x].post_date = (Date.parse(get_data[x].post_date));
					get_data[x].extension = (get_data[x].post_file).split('.')[1];
				}
				return get_data;
			}
			getDeptID ();
			function getDeptID () {
				$http.get(getServerData.url + 'user/getUserInfo')
					.success(function onSuccess(response){
						for( val of response ){
							$scope.current_dept_id = val.dept_id
						}
					});
			}
		}
	])
	.controller('modalBranch',[
		"$scope",
		"$http",
		"$timeout",
		"getServerData",
		function controller( $scope , $http , $timeout , getServerData ) {
			$scope.branch = {};
			$scope.$on('get_branch_info',function(evt,data){
				$http.get(getServerData.url+'department/get_branch_info/'+data.branch_id)
					.success(function(response){
						for(x in response){
							$scope.branch.branch_name = response[x].branch_name;
							$scope.branch.branch_desc = response[x].description;
							$scope.branch.address = response[x].address;
							$scope.branch.mobile_no = response[x].mobile_no;
							$scope.branch.hotline_no = response[x].hotline_no;
							$scope.branch.website = response[x].website;
							$scope.branch.email = response[x].email;
							if (response[x].website != 'none') {
								$scope.branch.webstat = 'has_site';
							}else{
								$scope.branch.webstat = 'no_site';
							}
							console.log(response[x].website)
						}
					})
			});
		}
	])
	.controller('editBranchModal',[
		"$scope",
		"$http",
		"$timeout",
		"getServerData",
		function controller( $scope , $http , $timeout , getServerData ) {
			var html_prompt = "<div style='width:100%;'>" +
							  "<h4>Successfully saved</h4><hr>"+
							  "Branch details successfully saved.<hr>" +
							  "</div>";				
			$scope.branch = {};
			$scope.$on('get_branch_id_for_edit',function(evt,data){
				$http.get(getServerData.url+'department/get_branch_info/'+data.branch_id)
					.success(function(response){
						for(x in response){
							$scope.branch.branch_id = response[x].branch_id;
							$scope.branch.branch_name = response[x].branch_name;
							$scope.branch.description = response[x].description;
							$scope.branch.address = response[x].address;
							$scope.branch.category = response[x].category;
							$scope.branch.mobile_no = parseInt(response[x].mobile_no);
							$scope.branch.hotline_no = parseInt(response[x].hotline_no);
							$scope.branch.website = response[x].website;
							$scope.branch.email = response[x].email;
							console.log(response[x])
						}
					})
			});
			$scope.save_edit_branch = function(){
				$http.post( getServerData.url + 'department/edit_branch', $scope.branch )
					.success(function(response){
						$.fancybox.open(html_prompt);
						$scope.$emit('load_branch_info');
					})
			}
		}
	])
	.controller('editPostModalController',[
		"$scope",
		"$http",
		"$timeout",
		"getServerData",
		function controller( $scope , $http , $timeout , getServerData ) {
			$('.edit_textarea').wysihtml5(); 
			$scope.post = {};
			$scope.$on('edit_post_data', function( evt, data ){
				$('.edit_textarea').data("wysihtml5").editor.setValue(data.post_content);
				$scope.post.post_id = data.post_id;
				console.log(data)
			});
			$scope.submit_new_post = function () {
				$scope.post.post_content = $('.edit_textarea').val();
				$http.post( getServerData.url + 'newsfeeds/edit_post', $scope.post )
					.success(function(response){
						alert(response.msg)
						$scope.$emit('load_posts', {load_status:'posts_loaded'});
					})
			}
		}
	])
	.controller('loadingController',[
		"$scope",
		function controller( $scope ){
			$scope.$on('LOAD',function(){
				$scope.loading = "true";
			});
			$scope.$on('UNLOAD',function(){
				$scope.loading = "false";
			});
			// console.log('load')
		}
	]);













