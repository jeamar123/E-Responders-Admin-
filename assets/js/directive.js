app.
	directive('mainContainer' , [
		function directive ( ) {
			return {
				"restrict": "A",
				"scope": true,
				"controller" : "userDeptInfo",
				"link": function onLink ( scope , element , attributeSet ) {					
				}
			}
		}
	] )
	.directive('deptId' , [
		function directive ( ) {
			return {
				"restrict": "A",
				"scope": true,
				"controller" : "userDeptInfo",
				"link": function onLink ( scope , element , attributeSet ) {					
				}
			}
		}
	] )
	.directive('loginAuth', [
		function directive(){
			return {
				"restrict" 	: "A",
				"scope"	   	: true,
				"controller": "loginController",
				"link"		: function onLink ( scope , element , attributeSet ){

				}
			}
		}
	]).
	directive('firstName', [
		function directive(){
			return{
				"restrict" 	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/firstname.html",
				"controller" : "userInfoController",
				"link"		 : function onLink ( scope ,element , attributeSet ){
					
				}
			}
		}
	]).
	directive('fullName', [
		function directive(){
			return{
				"restrict" 	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/fullname.html",
				"controller" : "userInfoController",
				"link"		 : function onLink ( scope ,element , attributeSet ){
					
				}
			}
		}
	]).
	directive('staticView',[
		function directive(){
			return{
				"restrict" 	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/map.html",
				"controller" : "currentMapLocation",
				"link"		 : function onLink ( scope ,element , attributeSet ){
					
				}				
			}
		}
	]).
	directive('locationUpdate',[
		function directive(){
			return{
				"restrict" 	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/update_map_location.html",
				"controller" : "updateLocation",
				"link"		 : function onLink ( scope ,element , attributeSet ){
					
				}				
			}
		}
	]).
	directive('mailBox',[
		function directive(){
			return{
				"restrict" 	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/mail.html",
				"controller" : "mailBox",
				"link"		 : function onLink ( scope ,element , attributeSet ){
					
				}				
			}
		}
	]).
	directive('newUser', [
		function directive(){
			return{
				"restrict"	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/add-users.html",
				"controller" : "",
				"link"		 : function onLink ( scope , element , attributeSet ){
					
				}
			}
		}
	]).
	directive('addMarker', [
		function directive(){
			return{
				"restrict"	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/add_new_marker.html",
				"controller" : "",
				"link"		 : function onLink ( scope , element , attributeSet ){
					
				}
			}
		}
	]).
	directive('mapinfoModal',[
		function directive(){
			return {
				"restrict"	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/view_marker_info.html",
				"controller" : "",
				"link"		 : function onLink ( scope , element , attributeSet ){

				}
			}
		}
	]).
	directive('editmarkerModal', [
		function directive(){
			return{
				"restrict"	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/edit_marker_info.html",
				"controller" : "modalController",
				"link"		 : function onLink ( scope , element , attributeSet ){
						
				}
			}
		}
	]).
	directive('viewbranchModal', [
		function directive(){
			return{
				"restrict"	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/view_branch_info.html",
				"controller" : "modalController",
				"link"		 : function onLink ( scope , element , attributeSet ){
						
				}
			}
		}
	]).
	directive('editpostModal', [
		function directive(){
			return{
				"restrict"	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/edit_post_modal.html",
				"controller" : "modalController",
				"link"		 : function onLink ( scope , element , attributeSet ){
						
				}
			}
		}
	]).
	directive('editbranchModal', [
		function directive(){
			return{
				"restrict"	 : "A",
				"scope"		 : true,
				"templateUrl": "/Admin-CDO/assets/js/template/edit_branch_info.html",
				"controller" : "modalController",
				"link"		 : function onLink ( scope , element , attributeSet ){
						
				}
			}
		}
	]).
	directive('loadingScreen',[
		function directive(){
			return{
				"restrict" 	 : "A",
				"scope"		 : true,
				"controller" : "loadingController",
				"link"		 : function onLink ( scope ,element , attributeSet ){
					
				}				
			}
		}
	]);	