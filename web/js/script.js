function initMap() {
	var lat = parseFloat(document.getElementById('places-lat').value),
		lng = parseFloat(document.getElementById('places-lng').value);
	if (!lat || !lng) {
		lat = 44.6166;
		lng = 33.5254;
	}
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 8,
	  center: {lat: lat, lng: lng}
	});
	var geocoder = new google.maps.Geocoder();

    var marker = new google.maps.Marker({
        map: map,
        position: {lat: lat, lng: lng}
    });

	document.getElementById('submit').addEventListener('click', function() {
	  geocodeAddress(geocoder, map);
	});
}

function geocodeAddress(geocoder, resultsMap) {
	var address = document.getElementById('address').value;
	geocoder.geocode({'address': address}, function(results, status) {
	  if (status === 'OK') {
	    resultsMap.setCenter(results[0].geometry.location);
	    var marker = new google.maps.Marker({
	      map: resultsMap,
	      position: results[0].geometry.location
	    });
	    lat = results[0].geometry.location.lat(0);
	    lng = results[0].geometry.location.lng(0);

	    document.getElementById('places-address').value = address;
	    document.getElementById('places-lat').value = lat;
	    document.getElementById('places-lng').value = lng;

	  } else {
	    alert('Geocode was not successful for the following reason: ' + status);
	  }
	});
}
