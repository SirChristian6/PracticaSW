var map;
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 16,
      center: {lat:latitude, lng: longitude}
    });
    var geocoder = new google.maps.Geocoder;
    var infowindow = new google.maps.InfoWindow;
    geocodeLatLng(geocoder, map, infowindow);
}
function geocodeLatLng(geocoder, map, infowindow) {
    var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
    geocoder.geocode({'location': latlng}, function(results, status) {
        if (results[0]) {
            var marker = new google.maps.Marker({
                position: latlng,
                map: map
            });
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
        } 
            
    });
}