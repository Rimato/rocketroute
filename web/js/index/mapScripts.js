
$( document ).ready(function() {
    function init_map(){
        var myOptions = {
            zoom:10,
            center:new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
        marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(0, 0),
                icon: ' http://www.clker.com/cliparts/H/Z/0/R/f/S/warning-icon-th.png'
            }
        );

    }
    google.maps.event.addDomListener(window, 'load', init_map);

    $('#submit').on('click', function(){
        $.ajax({
            method: "POST",
            dataType: 'json',
            url: "index.php?r=site/get-icao-info",
            data: { icao: $('#indexinputmodel-icao').val() }
        })
        .done(function( data ) {
            google.maps.event.clearListeners(marker, 'click');
            marker.setPosition( new google.maps.LatLng(data['location'][0], data['location'][1]) );
            map.panTo( new google.maps.LatLng(data['location'][0], data['location'][1]) );
            infowindow = new google.maps.InfoWindow({content:data['iteme']});
            google.maps.event.addListener(marker, 'click', function(){
                infowindow.open(map,marker);
            });
            infowindow.open(map,marker);
        });
    })
});
