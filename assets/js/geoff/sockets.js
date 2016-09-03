
app
	.directive( "postArea" , [
		"io",
		"$rootScope",
		function directive ( io , $rootScope ) {
			return {
				"restrict": "A",
				"scope": true,
				"link": function onLink ( scope , element , attributeSet ) {
					
					scope.broadcast = function broadcast ( ) {
						io.socket.emit( "to-all" , "hello everyone" );
					}

					io.socket.on( "broadcast-to-me" , 
						function ( data ) {
							$rootScope.$broadcast( "message-brod" , data );
						} );
				}
			}
		}
	] );