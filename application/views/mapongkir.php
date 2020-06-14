<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Load Leaflet from CDN -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>


  <!-- Load Esri Leaflet from CDN -->
  <script src="https://unpkg.com/esri-leaflet@2.4.1/dist/esri-leaflet.js"
  integrity="sha512-xY2smLIHKirD03vHKDJ2u4pqeHA7OQZZ27EjtqmuhDguxiUvdsOuXMwkg16PQrm9cgTmXtoxA6kwr8KBy3cdcw=="
  crossorigin=""></script>


  <!-- Load Esri Leaflet Geocoder from CDN -->
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
  <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
    integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
    crossorigin=""></script>

    <!-- material icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">

    <style>
    body { margin:0; padding:0; }
    #map { 
        width: 100px;
        height:300px;
        min-height: 100%;
        min-width: 100%;
        display: block;
    }
        .marker-pin {
            width: 30px;
            height: 30px;
            border-radius: 50% 50% 50% 0;
            background: #c30b82;
            position: absolute;
            transform: rotate(-45deg);
            left: 50%;
            top: 50%;
            margin: -15px 0 0 -15px;
            z-index: -1;
        }
        .marker-pin::after {
            content: '';
            width: 24px;
            height: 24px;
            margin: 3px 0 0 3px;
            background: #fff;
            position: absolute;
            border-radius: 50%;
        }
        .custom-div-icon i {
            position: absolute;
            width: 22px;
            font-size: 22px;
            left: 0;
            right: 0;
            margin: 10px auto;
            text-align: center;
        }
  </style>

<!-- Wrapper -->
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div id="map"></div>

                <script>
                <?php if(isset($start)) { ?>
                    var start_point = [<?= $start ?>];
                <?php } else { ?>
                    var start_point = [0,0];
                <?php } ?>

                var markerFrom = L.circleMarker(start_point, { color: "#F00", radius: 10 });
                var map = L.map('map').setView(start_point, 5);
  
                // init starting point
                // var icon = L.icon({
                //     iconUrl: 'https://cdn0.iconfinder.com/data/icons/engineers-1/421/Untitled-18-512.png',
		        //     iconSize: [30, 50],
                // })
                var icon = L.divIcon({
                    className: 'custom-div-icon',
                    html: "<div style='background-color:#c30b82;' class='marker-pin'></div><i class='material-icons'>home</i>",
                    iconSize: [30, 42],
                    iconAnchor: [15, 42]
                });
                L.marker(start_point, {icon: icon}).addTo(map);


                // add search address
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var searchControl = L.esri.Geocoding.geosearch().addTo(map);
                var results = L.layerGroup().addTo(map);
                searchControl.on('results', function (data) {
                    results.clearLayers();
                    for (var i = data.results.length - 1; i >= 0; i--) {
                        var end_point = [data.results[i].latlng.lat, data.results[i].latlng.lng]
                        var distance = getDistance(start_point, end_point)
                        getClicked(toKm(distance))

                        results.addLayer(L.marker(data.results[i].latlng));
                    }
                });
                map.on('click', function(e){
                    results.clearLayers();
                    
                    var end_point = [e.latlng.lat, e.latlng.lng]
                    var distance = getDistance(start_point, end_point)
                    
                    getClicked(toKm(distance))
                    var marker = new L.marker(e.latlng).addTo(map);
                    marker.addTo(results);
                });

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
                    console.log(distance)
                }
                function toRadian(degree) {
                    return degree*Math.PI/180;
                }
                function toKm(res) {
                    var km = res / 1000;
                    return Math.round(km.toFixed(1))
                }
                </script>

            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->


