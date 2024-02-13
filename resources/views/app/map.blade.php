<?php
// PHP array of coordinates for Bashkortostan's border
$bashkortostanBorderCoordinates = [
    ['lat' => 54.864988, 'lng' => 59.999362600000005],
    ['lat' => 54.8658392, 'lng' => 59.978289499999995],
    // ... Add all your coordinates here
    ['lat' => 54.8441798, 'lng' => 59.886760699999996],
    // Ensure that the last coordinate is the same as the first to close the polygon
];

// Encode the coordinates to JSON
$bashkortostanCoordsJson = json_encode($bashkortostanBorderCoordinates);
?>

<!DOCTYPE html>
<html>
    <head>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>Путеводитель по Башкирии</title>
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <style>
            p {
                margin: 0 !important;
            }
            .image-cover {
                height: 30vh; /* Adjust the height as needed */
                object-fit: cover; /* This will make sure the image covers the area and gets cropped if needed */
                width: 100%; /* Ensure the image is full width */
            }
            .place-vertical{
                height:30vh;margin: auto;margin-bottom: 3vh;margin-top: 0vh;padding: 0;
            }
            .place-horizontal{
                height: 30vh;margin: auto;margin-bottom: 3vh;margin-top: 0vh;padding: 0;
            }
            #map {
                height: calc(100vh - 80vh); 
                width: 100%;
            }
            @media (min-width: 280px) and (max-width: 508px){
                .image-cover {
                    height: 18vh!important;
                }
                .place-vertical{
                    height: auto !important;
                }
                .fs-2{
                    font-size: 18px !important;
                }
                .fs-3{
                    font-size: 16px !important;
                }
                .fs-4{
                    font-size: 14px !important;
                }
                .fs-5{
                    font-size: 12px !important;
                }
                .place-horizontal{
                    height: 20vh;
                }
            }
        </style>        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLHI32BsY3TORmjRSZ7UzFHE4BEx1PW-o"></script>
        <?php 
            use App\Models\Places;
            $places = Places::whereHas('attributes', function ($query) {
                $query->where('attributes.id', '=', 1);
            })->with('location')->get();
        ?>
        <script>
            var places = <?php echo json_encode($places);?>;
            
            const mapStyleWinter = [ { "featureType": "administrative", "elementType": "geometry", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.country", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.locality", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.locality", "elementType": "geometry.fill", "stylers": [ { "color": "#fffafa" }, { "visibility": "on" } ] }, { "featureType": "administrative.locality", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" }, { "visibility": "on" } ] }, { "featureType": "administrative.locality", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.locality", "elementType": "labels.text", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [ { "color": "#000000" }, { "visibility": "on" } ] }, { "featureType": "administrative.locality", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.neighborhood", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.province", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.province", "elementType": "geometry.fill", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.province", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" }, { "visibility": "off" }, { "weight": 4 } ] }, { "featureType": "landscape", "stylers": [ { "color": "#43b2d9" } ] }, { "featureType": "landscape.natural.landcover", "elementType": "geometry", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural.terrain", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "labels.text", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "color": "#fac180" }, { "weight": 3 } ] }, { "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.arterial", "stylers": [ { "weight": 1.5 } ] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [ { "color": "#fac180" }, { "weight": 2 } ] }, { "featureType": "road.arterial", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.highway", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.highway.controlled_access", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [ { "color": "#fac180" } ] }, { "featureType": "road.local", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.local", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit.line", "stylers": [ { "visibility": "on" } ] }, { "featureType": "transit.line", "elementType": "geometry.fill", "stylers": [ { "color": "#887777" }, { "visibility": "on" }, { "weight": 4.5 } ] }, { "featureType": "transit.line", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" }, { "visibility": "on" }, { "weight": 4.5 } ] }, { "featureType": "transit.station", "stylers": [ { "visibility": "on" } ] }, { "featureType": "water", "stylers": [ { "visibility": "on" }, { "weight": 8 } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#bce4fa" }, { "visibility": "on" }, { "weight": 8 } ] }, { "featureType": "water", "elementType": "geometry.stroke", "stylers": [ { "color": "#0080c9" }, { "visibility": "on" }, { "weight": 8 } ] } ];
            
            mapStyle = mapStyleWinter;


            function initMap() {
                var options = {
                    zoom: 7,
                    center: {lat: 54.7355, lng: 55.991982}, // Центрирование карты на Башкортостане
                    styles: mapStyleWinter // Стили карты
                };

                var map = new google.maps.Map(document.getElementById('map'), options);

                // Перебор массива мест и добавление маркеров на карту
                if (Array.isArray(places)) {
                    places.forEach(function(place) {
                        if (!place.location || !place.location.point) {
                            return;
                        }

                        var point = place.location.point.split(', ');
                        var latitude = parseFloat(point[0]);
                        var longitude = parseFloat(point[1]);

                        if (isNaN(latitude) || isNaN(longitude)) {
                            return;
                        }

                        var markerImageUrl = 'https://bashkiriaguide.com/storage/' + place.img;
                        var marker = new google.maps.Marker({
                            position: {lat: latitude, lng: longitude},
                            map: map,
                            title: place.name,
                            icon: {
                                url: 'https://bashkiriaguide.com/storage/' + place.location.img, // URL кастомного изображения
                                // Можно настроить размеры изображения маркера, если необходимо
                                scaledSize: new google.maps.Size(50, 50) // Размеры изображения
                            }
                        });

                        var placeShowUrlTemplate = "{{ route('app.places.show', 'PLACE_ID') }}";

                        // Создание всплывающего окна с информацией о месте
                        var infoWindowContent = '<div class="info-window-content">' +
                                                '<img src="' + markerImageUrl + '" alt="' + place.name + '" style="width:100px;"><br>' +
                                                '<h3>' + place.name + '</h3>' +
                                                '<a href="' + placeShowUrlTemplate.replace('PLACE_ID', place.id) + '" class="btn btn-primary w-100">Подробнее</a>' +
                                                '</div>';

                        var infoWindow = new google.maps.InfoWindow({
                            content: infoWindowContent
                        });

                        // Добавление события клика на маркер, чтобы открыть модальное окно
                        marker.addListener('click', function() {
                            infoWindow.open(map, marker);
                        });
                    });
                }
            }
        </script>
    </head>
    <body onload="initMap()">
        <!-- Основная навигация -->
        <div class="container py-4" style="position: relative">
            <div class="d-flex justify-content-between items-center ">
                <div class=" rounded-full"> 
                    <a href="{{ route('app.search') }}">                   
                        <img src="{{ asset('img/lupa.svg') }}" style="
                        width: 2.5vh;
                        " alt="search">
                    </a>
                </div>            
                <div class="rounded-full"> 
                    <a href="/">
                        <img src="{{ asset('img/home.svg') }}" style="
                        width: 2.5vh;
                    " alt="home">
                    </a> 
                </div>
                <!-- Иконка меню -->
                <button class=" rounded-full" data-bs-toggle="collapse" data-bs-target="#collapsibleMenu" aria-expanded="false" aria-controls="collapsibleMenu" style="border-width: 0px; background: none;">
                    <img src="{{ asset('img/menu.svg') }}" style="
                    width: 2.5vh;
                " alt="menu">
                </button>
        
                <!-- Collapsible menu -->
                <div class="collapse position-absolute mt-5 end-0" id="collapsibleMenu" style="z-index: 1030;">
                    <? 
                        use App\Models\Categories;
                        $categories = Categories::whereNull('parent_id')->with('children')->get();
                    ?>
                    <!-- Menu items -->
                    <ul class="list-unstyled bg-white shadow p-2 rounded">
                        @foreach($categories as $category)
                            <li class="p-2 rounded">
                                <a href="#category-{{ $category->id }}" class="d-flex align-items-center" >
                                    <img class="me-2" src="{{ asset('storage/' . $category->img) }}" alt="" style="width: 3vh; height: 3vh;">
                                    <p class="fs-5">{{ $category->name }}</p>
                                </a>
                                @if($category->children->isNotEmpty())
                                    <ul class="list-unstyled ps-4">
                                        @foreach($category->children as $child)
                                            <li class="p-2 rounded">
                                                <a href="#category-{{ $child->id }}" class="d-flex align-items-center" >
                                                    <img class="me-2" src="{{ asset('storage/' . $child->img) }}" alt="" style="width: 2vh; height: 2vh;">
                                                    <p class="fs-6">{{ $child->name }}</p>
                                                </a>
                                            </li> 
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <li class="p-2 rounded">
                            <a href="{{ route('app.map') }}"> 
                                <div class="d-flex align-items-center">
                                    <p class="fs-5">Карта зимняя</p>
                                </div>
                            </a>
                        </li>
                        <li class="p-2 rounded">
                            <a href="{{ route('app.maps') }}"> 
                                <div class="d-flex align-items-center">
                                    <p class="fs-5">Карта летняя</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container py-4" id="map"></div>
    </body>
    <script>
         function setMapHeight() {
                var headerHeight = document.querySelector('.container.py-4').offsetHeight; // Adjust the selector as needed
                var mapHeight = window.innerHeight - headerHeight;
                document.getElementById('map').style.height = mapHeight + 'px';
            }

            // Set map height on load and resize
            window.onload = function() {
                setMapHeight();
                initMap();
            };

            window.onresize = setMapHeight;
    </script>
</html>
