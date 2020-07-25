<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        width: 100%;
        height:300px;
        display: block;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        text-overflow: ellipsis;
        width: 40%;
        top: 12px !important;
        border: none;
        padding: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
      }
    </style>

    <input id="pac-input" class="controls" type="text" placeholder="Cari lokasi Anda disini..">
    <div id="map"></div>
    
    
    <script>
      var map, infoWindow;
      var marker, marker_awal;

      <?php if(isset($start)) { ?>
        var start = [<?= $start ?>];
        var zoom = 18;
    <?php } else { ?>
        var start = [0,0];
        var zoom = 3;
    <?php } ?>

      function initMap() {
        var asal = new google.maps.LatLng(start[0], start[1]);
        var service = new google.maps.DistanceMatrixService();        

        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: start[0], lng: start[1]},
          zoom: zoom,
          mapTypeId: 'roadmap'
        });

        var icon = {
            url: "<?= base_url('assets/img/map-marker.png') ?>", // url
            scaledSize: new google.maps.Size(50, 50) // scaled size
        };

        marker_awal = new google.maps.Marker({
            map: map,
            icon: icon,
            position: {lat: start[0], lng: start[1]}
        });
        marker_awal.addListener('click', function() {
            geocoder.geocode({'location': {lat: start[0], lng: start[1]}}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    } else {
                    window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        });


        // search box
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // zoom ke search box
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        //popup window
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();

        // get user position
        var position = document.querySelector("#getCurrentPosition");
        if (position) {
          position.addEventListener('click', e => {
            console.log("fetching location...")
            navigator.geolocation.getCurrentPosition(pos => {
              let lat = pos.coords.latitude
              let lng = pos.coords.longitude
              let lok = {
                lat: lat,
                lng: lng
              }
              marker = new google.maps.Marker({
                map: map,
                position: lok,
                icon: icon,
              });
              marker.setMap(map)
              map.setCenter(lok)
              getLongLat(lok)
  
              var tujuan = new google.maps.LatLng({lat: lat, lng: lng});
              countDistance(service, asal, tujuan);
            })
          })
        }

        // map diklik
        map.addListener('click', function(e) {
            if(marker != undefined) marker.setMap(null);                        
            marker = new google.maps.Marker({
              map: map,
              position: e.latLng
            });
            marker.addListener('click', function() {
                geocoder.geocode({'location': e.latLng}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        } else {
                        window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            });
            
            var lokasi = {
                lat: e.latLng.lat(),
                lng: e.latLng.lng()
            };
            var tujuan = new google.maps.LatLng(lokasi);
            getLongLat(lokasi);          
            countDistance(service, asal, tujuan);
        });
        
        // alamat di search
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

            // Create a marker
            if(marker != undefined) marker.setMap(null);            
            marker = new google.maps.Marker({
              map: map,
              title: place.name,
              position: place.geometry.location
            });
            marker.addListener('click', function() {
                geocoder.geocode({'location': place.geometry.location}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        } else {
                        window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            });

            var lokasi = {
                lat: place.geometry.location.lat(),
                lng: place.geometry.location.lng()
            };
            var tujuan = new google.maps.LatLng(lokasi);
            getLongLat(lokasi);                      
            countDistance(service, asal, tujuan);

            if (place.geometry.viewport) {
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });

          map.fitBounds(bounds);
        });
      }

    function countDistance(service, asal, tujuan) {
        service.getDistanceMatrix(
        {
            origins: [asal],
            destinations: [tujuan],
            travelMode: 'WALKING'
        }, callback);
    }

    function toKm (m) {
	let res = m / 1000;
	return Math.ceil(res);
	// return (Math.round(res * 2) / 2).toFixed(1);
    }
    function callback(response, status) {
        var distance = 0;
        var asal = 0;
        var tujuan = 0;
        console.log(response)
        if(response.rows[0].elements[0].distance == undefined) {
            tujuan = response.destinationAddresses[0].split(',')
            asal = response.originAddresses[0].split(',')
            distance = getDistance(asal, tujuan)
        } else {
            distance = toKm(response.rows[0].elements[0].distance.value);
        }
        getClicked(distance);
    }

    function getLongLat(tujuan) {
        //
    }

    function toRadian(degree) {
        return degree*Math.PI/180;
    }

    function getDistance(origin, destination) {
        // return distance in meters
        var lon1 = toRadian(origin[1]),
            lat1 = toRadian(origin[0]),
            lon2 = toRadian(destination[1]),
            lat2 = toRadian(destination[0]);

        var deltaLat = lat2 - lat1;
        var deltaLon = lon2 - lon1;

        var a = Math.pow(Math.sin(deltaLat/2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon/2), 2);
        var c = 2 * Math.asin(Math.sqrt(a));
        var EARTH_RADIUS = 6371;
        return c * EARTH_RADIUS * 1000;
    }

    function getClicked(distance) {
        //--
    }
    </script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgq7vxt9KoseblPztho1tMFFylhIWcgg8&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>
