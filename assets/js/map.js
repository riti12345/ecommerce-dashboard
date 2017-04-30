$(document).ready(function() {

    var latitude, longitude, origin_lat, origin_lng, dest_lat, dest_lng, client_address, waypnt = [];
    var order_id = $('.map_div').attr('order-id');
    var client_id = $('.map_div').attr('client-id');
    var client_name = $('.map_div').attr('client-name');

    function trackVehicle(id) {
        var order_id = id;
        $.ajax({
            url: 'api/manage_delivery/track_details',
            method: 'post',
            data: {
                order_id: order_id
            },
            success: successCallBack,
            error: error
        });
        setTimeout(function(){
            trackVehicle(id);
        }, 300000);
    }

    function successCallBack(returnData) {
        returnData.data.forEach(function(index, i) {
            latitude = returnData.data[i].lat;
            longitude = returnData.data[i].long;
            var latlng = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude));
            waypnt.push({
                location: latlng,
                stopover: true
            });
        });
    }
    // client details  
    window.searchClientDetails = function(name ,type) {
        $.ajax({
            url: 'api/manage-clients/search',
            type: 'POST',
            data: {
                q: name,
                type:type
            },
            success: clientRespCallBack
        });
    }

    function clientRespCallBack(clientData) {

        clientData.data.forEach(function(index, i) {
            if (client_id == clientData.data[i].id) {
                dest_lat = clientData.data[i].lat;
                dest_lng = clientData.data[i].long;
                client_address = clientData.data[i].address;
                var latlng = new google.maps.LatLng(parseFloat(dest_lat), parseFloat(dest_lng));
                waypnt.push({
                    location: latlng,
                    stopover: true
                });
            }
        });
    }

    function error(data) {
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {
            message: 'No Map Found  !'
        };
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
    }

    searchClientDetails(client_name ,1);
    trackVehicle(order_id);
    var origin = {
        lat: 19.1612194,
        lng: 72.9393354
    };
    var destination = {
        lat: parseFloat(dest_lat),
        lng: parseFloat(dest_lng)
    };
    var currentPos = {
        lat: parseFloat(latitude),
        lng: parseFloat(longitude)
    };

    var locations = [
        ['Source', 19.1612194, 72.9393354, 'Kishna mills '],
        ['Current Position', 33.923036, 151.259052, ''],
        ['Destination', 33.950198, 151.259302, 'address 5']
    ];

    function myMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var currentPos = {
            lat: parseFloat(latitude),
            lng: parseFloat(longitude)
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {
                lat: 19.1612194,
                lng: 72.9393354
            }
        });

        /*var source_img = {
            url: 'img/source.png',
            size: new google.maps.Size(64, 64),
            origin: new google.maps.Point(0,0),
            anchor: new google.maps.Point(12, 12)
          };*/
        var marker_source = new google.maps.Marker({
            position: {
                lat: 19.1612194,
                lng: 72.9393354
            },
            map: map
        });

        var marker_dest = new google.maps.Marker({
            position: {
                lat: parseFloat(dest_lat),
                lng: parseFloat(dest_lng)
            },
            map: map
        });

        var infowindow = new google.maps.InfoWindow();
        var contentA = "<p>krishna mills </p>";
        var contentB = "<h4>" + client_name + "</h4></br>" + "<p>" + client_address + "</p>";

        marker_source.addListener('click', function() {
            infowindow.setContent(contentA);
            infowindow.open(map, marker_source);
        });

        var source_img = {
            url: 'img/source.png',
            size: new google.maps.Size(64, 64),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(12, 12)
        };
        /*var marker_source = new google.maps.Marker({
            position: {
                lat: 19.1612194,
                lng: 72.9393354
            },
            map: map
        });*/
        var marker_dest = new google.maps.Marker({
            position: {
                lat: parseFloat(dest_lat),
                lng: parseFloat(dest_lng)
            },
            map: map
        });
        var infowindow = new google.maps.InfoWindow();
        var contentA = "<p>krishna mills </p>";
        var contentB = "<h4>" + client_name + "</h4></br>" + "<p>" + client_address + "</p>";
       /* marker_source.addListener('click', function() {
            infowindow.setContent(contentA);
            infowindow.open(map, marker_source);
        });*/
        //infowindow.open(map, marker_source);
        infowindow.open(map, marker_dest);
        infowindow.setContent(contentA);
        infowindow.setContent(contentB);

        marker_dest.addListener('click', function() {
            infowindow.setContent(contentB);
            infowindow.open(map, marker_dest);
        });

        directionsDisplay.setMap(map);
        directionsDisplay.setOptions({
            polylineOptions: {
                strokeWeight: 4,
                strokeOpacity: 1,
                strokeColor: 'red'
            },
            /*suppressMarkers: true*/
        });

        /*DisplayRouteCurrentToDestination(directionsService, directionsDisplay);
    //DisplayRoute(directionsService, directionsDisplay);
    directionsDisplay.addListener('change', function() {
          DisplayRouteCurrentToDestination(directionsService, directionsDisplay);
        });*/

        var image = 'img/logistics-delivery-truck.png';
        var marker = new google.maps.Marker({
            position: currentPos,
            map: map,
            title: 'Current Position'
        });
        directionsDisplay.addListener('directions_changed', function() {
            computeTotalDistance(directionsDisplay.getDirections());
        });

        displayRouteOriginToDest(origin, destination, directionsService, directionsDisplay);
    }

    /* function DisplayRouteCurrentToDestination(directionsService, directionsDisplay) {
        var selectedMode = document.getElementById('mode').value;
          var request = {
          origin: {lat:parseFloat(latitude) ,lng:parseFloat(longitude)},
          destination: {lat:parseFloat(dest_lat), lng:parseFloat(dest_lng)},
          travelMode: google.maps.TravelMode.DRIVING
          };
          directionsService.route(request, function(response, status) {
            if (status == 'OK') {
              directionsDisplay.setDirections(response);
              directionsDisplay.setOptions( {
                polylineOptions: {
                  strokeWeight: 4,
                  strokeOpacity: 1,
                  strokeColor:  'blue' 
                }
              });
            } else {
              console.log('Directions request failed due to ' + status);
            }
          });
      }*/
    function displayRouteOriginToDest(origin, destination, service, display) {

        service.route({
            origin: {lat: 19.1612194,lng: 72.9393354},
            destination: {lat: parseFloat(dest_lat), lng: parseFloat(dest_lng)},
            waypoints: waypnt,
            optimizeWaypoints: true,
            travelMode: 'DRIVING',
            avoidTolls: true
        }, function(response, status) {
            if (status === 'OK') {
                display.setDirections(response);
            } else {
                console.log('Could not display directions due to: ' + status);
            }

        });
    }

    function computeTotalDistance(result) {
        var total = 0, elapsed_d = 0 ,covered_d=0;
        var totalTime = 0, elapsed_t = 0 ,consumed_t=0;
        var myroute = result.routes[0];
        
        for (var i = 0; i < myroute.legs.length; i++) {
            elapsed_d = myroute.legs[myroute.legs.length - 2].distance.value;
            elapsed_t = myroute.legs[myroute.legs.length - 2].duration.value;

            total += myroute.legs[i].distance.value;
            totalTime += myroute.legs[i].duration.value;
        }
        for(var i=0; i<=myroute.legs.length-3;i++){
          covered_d += myroute.legs[i].distance.value;
          consumed_t += myroute.legs[i].duration.value;
        }

        total = total / 1000;
        totalTime = totalTime / 60;
        elapsed_d = elapsed_d / 1000;
        elapsed_t = elapsed_t / 60;
        covered_d =covered_d/1000;
        consumed_t = consumed_t/60;
        document.getElementById('total').innerHTML = total + ' km';
        document.getElementById('time').innerHTML = totalTime + ' m';
        document.getElementById('elapsed_d').innerHTML = elapsed_d + ' km';
        document.getElementById('elapsed_t').innerHTML = elapsed_t + ' m';
        document.getElementById('covered_d').innerHTML = covered_d + ' km';
        document.getElementById('consumed_t').innerHTML = consumed_t + ' m';
    }
    google.maps.event.addDomListener(window, 'load', myMap);
});