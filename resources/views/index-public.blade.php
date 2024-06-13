@extends('layouts.template')

@section('styles')
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        #map {
            height: calc(100vh - 56px);
            width: 100%;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>
@endsection

@section('script')
    <script>
        //Map
        var map = L.map('map').setView([-6.985012968232377, 107.5724290048572], 10);

        // Basemap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Load GeoJSON */
        fetch('storage/bandung_all.geojson')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            opacity: 1,
                            color: "black",
                            weight: 0.5,
                            fillOpacity: 0.7,
                            fillColor: "#fcdca4",
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        var content = feature.properties.KAB_KOTA;
                        layer.on({
                            click: function(e) {
                                // Fungsi ketika objek diklik
                                layer.bindPopup(content).openPopup();
                            },
                        });
                    }
                }).addTo(map);
            })
            .catch(error => {
                console.error('Error loading the GeoJSON file:', error);
            });

        /* GeoJSON Point */

        // Definisikan ikon kustom
        var customIcon = L.icon({
            iconUrl: '{{ asset('storage/icon2.png') }}', // Ganti dengan path ke ikon kustom Anda
            iconSize: [32, 32], // Ukuran ikon
        });

        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "<img src='{{ asset('storage/images/') }}/" + feature.properties
                    .image +
                    "'class='img-thumbnail' alt=''>" + "<br>" +
                    feature.properties.name + "<br>" +
                    feature.properties.description + "<br>"
                ;

                layer.on({
                    click: function(e) {
                        point.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        point.bindTooltip(feature.properties.name);
                    },
                });
            },
            pointToLayer: function(feature, latlng) {
                return L.marker(latlng, {
                    icon: customIcon
                });
            }
        });
        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        // /* GeoJSON Line */
        // var polyline = L.geoJson(null, {
        //     /* Style polyline */
        //     style: function(feature) {
        //         return {
        //             color: "#3388ff",
        //             weight: 3,
        //             opacity: 1,
        //         };
        //     },
        //     onEachFeature: function(feature, layer) {
        //         var popupContent = "Nama " + feature.properties.name + "<br>" +
        //             "Deskripsi: " + feature.properties.description + "<br>" +
        //             "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
        //             "'class='img-thumbnail' alt=''>";
        //         layer.on({
        //             click: function(e) {
        //                 polyline.bindPopup(popupContent);
        //             },
        //             mouseover: function(e) {
        //                 polyline.bindTooltip(feature.properties.name, {
        //                     sticky: true,
        //                 });
        //             },
        //         });
        //     },
        // });
        // $.getJSON("{{ route('api.polylines') }}", function(data) {
        //     polyline.addData(data);
        //     map.addLayer(polyline);
        // });

        // /* GeoJSON Polygon */
        // var polygon = L.geoJson(null, {
        //     /* Style polygon */
        //     style: function(feature) {
        //         return {
        //             color: "#3388ff",
        //             fillColor: "#3388ff",
        //             weight: 2,
        //             opacity: 1,
        //             fillOpacity: 0.2,
        //         };
        //     },
        //     onEachFeature: function(feature, layer) {
        //         var popupContent = "Nama: " + feature.properties.name + "<br>" +
        //             "Descripsi: " + feature.properties.description + "<br>" +
        //             "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
        //             "'class='img-thumbnail' alt=''>";
        //         layer.on({
        //             click: function(e) {
        //                 polygon.bindPopup(popupContent);
        //             },
        //             mouseover: function(e) {
        //                 polygon.bindTooltip(feature.properties.name, {
        //                     sticky: true,
        //                 });
        //             },
        //         });
        //     },
        // });
        // $.getJSON("{{ route('api.polygons') }}", function(data) {
        //     polygon.addData(data);
        //     map.addLayer(polygon);
        // });

        // // Layer Control
        // var overlayMaps = {
        //     "Point": point,
        //     "Polyline": polyline,
        //     "Polygon": polygon
        // };

        var layerControl = L.control.layers(null, overlayMaps, {
            collapsed: false
        }).addTo(map);
    </script>
@endsection
