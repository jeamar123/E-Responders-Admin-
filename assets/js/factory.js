app
	.factory('getServerData' , [
		function factory ( ) {
			return {
				url: 'http://localhost/Admin-CDO/',
				header: {
					headers : {
						'Content-Type': 'application/json'
					}
				}
			}
		}
	] );