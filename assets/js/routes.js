app.
	config(['$routeProvider', function($routeProvider){
		$routeProvider
			// Manage Location Menu
			//matt my love <3
			.when('/dashboard',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/dashboard.php',
				controller	: 'page-controller'
			})
			.when('/mobile-alerts',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/mobile-alerts.php',
				controller	: 'page-controller'
			})
			.when('/location',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/location.php',
				controller	: 'page-controller'
			})
			.when('/update-location', {
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/locationUpdate.php',
				controller	: 'page-controller'
			})
			.when('/other-departments', {
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/otherDepartments.php',
				controller	: 'userInfoController'
			})
			// Mail
			.when('/mailbox',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/mailbox.php',
				controller	: 'page-controller'
			})
			// Posts
			.when('/posts',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/posts.php',
				controller	: 'page-controller'
			})
			// Members
			.when('/add-user', {
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/add-users.php',
				controller 	: 'page-controller'
			})
			.when('/administrators', {
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/administrators.php',
				controller 	: 'administratorController'
			})
			// Department
			.when('/department-details',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/department-details.php',
				controller 	: 'page-controller'
			})
			.when('/department-lists',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/department-branches.php',
				controller 	: 'page-controller'
			})
			.when('/update-department',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/update-department.php',
				controller 	: 'page-controller'				
			})
			// Profile
			.when('/profile',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/profile.php',
				controller 	: 'userInfoController'				
			})			
	}]);
