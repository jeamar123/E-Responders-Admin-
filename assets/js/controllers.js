app
	.controller('loginController', [
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ){
			$scope.user = {};
			$scope.authenticate_login = function (){
				// console.log($scope.user);
				$http.post( getServerData.url + 'user/authenticate' , $scope.user).
					success(function onSuccess(response){
						// console.log(response);
						if (response == 1) {
							window.location = getServerData.url + "admin/";
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
	.controller('userInfoController', [		
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ){
			$scope.user_info = {};
			$http.get(getServerData.url + 'user/getUserInfo')
				.success(function onSuccess(response){
					console.log(response);
					$scope.user_info = response;
				}).error(function onError( m ){
					console.log(m);
				});			
		}
	])
	//  kuhaon niya ang dept ID sa current user
	.controller('userDeptInfo', [
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ) {
			$scope.user_dept_id = {};
			$http.get(getServerData.url + 'user/getUserInfo')
				.success(function onSuccess(response){
					for( val of response ){
						$scope.$broadcast( 'dept_id', val.dept_id );
						// console.log(val.dept_id)
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
		function controller( $scope , $http , getServerData ){
			$scope.mapdata = {};
			$scope.$on( "long-lang" ,
				function on ( evt , data ) {
					$scope.$apply(function () {
						$scope.maplat = data.lat();
						$scope.maplng = data.lng();
						$scope.mapdata.lat_lng = data.lat() + "," + data.lng();
					});
				} );

			$scope.$on( "dept_id" ,
				function on ( evt , data ) {
					$scope.mapdata.dept_id = data;
				} );
			$scope.saveMap = function(){
				$http.post( getServerData.url + 'map/update', $scope.mapdata )
					.success(function(data){
						console.log(data);
					})
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
			$scope.$on( "dept_id" ,
				function on ( evt , data ) {
					$scope.user_data.dept_id = data;
				} );
			$scope.save_data = function (){
				$http.post( getServerData.url + 'user/addNewUser' , $scope.user_data )
					.success( function( response ) {
						if (response == 1) {
							alert('New user has been created')
						}else{
							alert('Username already exists')
						}
					})
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
	.controller('updateDepartment',[
		"$scope",
		"$http",
		"getServerData",
		function controller( $scope , $http , getServerData ){
			$scope.dept = {};
			$scope.dept_name = "";
			get_dept_data ();
			$scope.url = getServerData.url;

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
							}
						}else{
							$scope.dept_img = false;
						}
					})				
			}
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










