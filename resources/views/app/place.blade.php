<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $place->name }}</title>
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
    </head>
    <body>
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


        <div class="container py-4">
            <div class="row row-cols-1 mb-3">
                <img src="{{ asset('storage/' . $place->img) }}" alt="" class="w-100 image-cover">
            </div>
            <p class="fs-3 fw-bold mb-3">{{ $place->name }}</p>
            <p class="fs-5 mb-3">{{ $place->description }}</p>
            <div class="row row-cols-2 mt-2">
                <p class="col fs-5">{{ $place->address }}</p>
                <?php
                    $mapQuery = urlencode($place->address);
        
                    if ($place->location) {
                        $mapQuery = $place->location->name ?: $place->location->point;
                        $mapQuery = urlencode($mapQuery);
                    }
                ?>
                <a class="col btn btn-primary" href="https://yandex.ru/maps/?text={{ $mapQuery }}&z=12&l=map" target="_blank">Показать на карте</a>
            </div>
        </div>



    </body>
</html>
