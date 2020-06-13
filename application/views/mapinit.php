<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


    <style>
    body { margin:0; padding:0; }
    #map { 
        width: 100px;
        height:500px;
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
                    var start = [<?= $start ?>];
                <?php } else { ?>
                    var start = [0,0];
                <?php } ?>


                var map = L.map('map').setView(start, 2);
                var results = L.layerGroup().addTo(map);

                <?php if(isset($start)) { ?>
                var marker_start = new L.marker(start).addTo(map);
                marker_start.addTo(results);
                <?php } ?>                
  
                // init starting point
                // var icon = L.icon({
                //     iconUrl: 'https://cdn0.iconfinder.com/data/icons/engineers-1/421/Untitled-18-512.png',
		        //     iconSize: [30, 50],
                // })

                // add search address
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var searchControl = L.esri.Geocoding.geosearch().addTo(map);
                searchControl.on('results', function (data) {
                    results.clearLayers();
                    for (var i = data.results.length - 1; i >= 0; i--) {
                        getClicked([data.results[i].latlng.lat, data.results[i].latlng.lng]);
                        results.addLayer(L.marker(data.results[i].latlng));
                    }
                });
                map.on('click', function(e){
                    results.clearLayers();
                    getClicked([e.latlng.lat, e.latlng.lng])
                    var marker = new L.marker(e.latlng).addTo(map);
                    marker.addTo(results);
                });

                function getClicked(latlng) {
                    console.log(latlng)
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
                function toRadian(degree) {
                    return degree*Math.PI/180;
                }
                function toKm(res) {
                    var km = res / 1000;
                    return km.toFixed(1)
                }
                </script>

            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->


