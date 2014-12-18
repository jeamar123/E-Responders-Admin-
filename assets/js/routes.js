app.
	config(['$routeProvider', function($routeProvider){
		$routeProvider
			// Manage Location Menu
			.when('/location',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/location.php',
				controller	: 'page-controller'
			})
			.when('/update-location', {
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/locationUpdate.php',
				controller	: 'page-controller'
			})
			// Mail
			.when('/mailbox',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/mailbox.php',
				controller	: 'page-controller'
			})
			// Members
			.when('/add-user', {
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/add-users.php',
				controller 	: 'page-controller'
			})
			// Department
			.when('/department-details',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/department-details.php',
				controller 	: 'page-controller'
			})
			.when('/department-details',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/department-details.php',
				controller 	: 'page-controller'
			})
			.when('/update-department',{
				templateUrl : '/Admin-CDO/assets/partials/admin-pages/update-department.php',
				controller 	: 'page-controller'				
			})
	}])
