function init_map(){
    var myOptions = {
        zoom:10,
        center:new google.maps.LatLng(55.73804802080089,37.64476582031249),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
    marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(55.73804802080089,37.64476582031249),
            icon: ' http://www.clker.com/cliparts/H/Z/0/R/f/S/warning-icon-th.png'
        }
    );
    infowindow = new google.maps.InfoWindow({content:'<strong>Название</strong><br>Moscow, Russia<br>'});
    google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);
}


google.maps.event.addDomListener(window, 'load', init_map);


function moveBus( map, marker ) {
    marker.setPosition( new google.maps.LatLng(59.73804802080089,31.64476582031249) );
    map.panTo( new google.maps.LatLng(59.73804802080089,31.64476582031249) );

};

setTimeout(function() {
    moveBus(map, marker)
}, 2000)
