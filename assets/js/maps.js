// Mao ning  para ma focus ang map sa CDO
var myCenter=new google.maps.LatLng(8.4542363,124.631897699999970000);

function initialize()
{
	var mapProp = {
	  center: myCenter,
	  zoom:10,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	  };

	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker = new google.maps.Marker({
	  position: myCenter,
	  title:'Click to zoom'
	  });

	marker.setMap(map);
	// Mao ning para makuha ang longitude ug latitude
	google.maps.event.addListener(map, 'click', function( event ){
	  alert( "Latitude: "+event.latLng.lat()+" "+", longitude: "+event.latLng.lng() ); 
	});

	// Zoom to 9 when clicking on marker
	google.maps.event.addListener(marker,'click',function() {
	  map.setZoom(14);
	  map.setCenter(marker.getPosition());
	  });
}

google.maps.event.addDomListener(window, 'load', initialize);
