<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
                height: 30vh;
                margin: auto;
                margin-bottom: 3vh;
                margin-top: 0vh;
                padding: 0;
            }
            a {
                text-decoration: none;
            }
            a:hover {
                color: red;
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
                    height: 23vh;
                    margin-bottom: 3vh;
                    margin-top: 0vh;
                }
            }
        </style>
    </head>
    <body>
        <div class="container py-2">
            <div class="d-flex justify-content-between items-center ">
                <div>
                    <img src="{{ asset('img/logoNPR.png') }}" alt="Лого национальные проекты России" style="width:20vh;">
                 </div>
                <div>
                    <a href="https://apps.rustore.ru/app/com.bashkiriaguide.BashkiriaGuide" target="_blank">Скачать приложение</a>
                </div>
            </div>
        </div>
        
       <!-- Основная навигация -->
        <div class="container pt-2 pb-4" style="position: relative">
            <div class="d-flex justify-content-between items-center ">
                <div class=" rounded-full"> 
                    <a href="{{ route('app.search') }}">                   
                        <img src="{{ asset('img/lupa.svg') }}" style="
                        width: 2.5vh;
                        " alt="search"
                        loading="lazy">
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
                " alt="menu"
                loading="lazy">
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
                                    <img class="me-2" src="{{ asset('storage/' . $category->img) }}" alt="" style="width: 3vh; height: 3vh;" loading="lazy">
                                    <p class="fs-5">{{ $category->name }}</p>
                                </a>
                                @if($category->children->isNotEmpty())
                                    <ul class="list-unstyled ps-4">
                                        @foreach($category->children as $child)
                                            <li class="p-2 rounded">
                                                <a href="#category-{{ $child->id }}" class="d-flex align-items-center" >
                                                    <img class="me-2" src="{{ asset('storage/' . $child->img) }}" alt="" style="width: 2vh; height: 2vh;" loading="lazy">
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

        {{-- Слайдер --}}
        <div class="container py-4">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <? 
                        use App\Models\Articles;
                        $articles = Articles::all();
                    ?>
                    @if(isset($articles))
                        @foreach($articles as $index => $article)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $article->img) }}" class="d-block w-75 m-auto" alt="{{ $article->heading }}">
                                <div class="carousel-caption">
                                    <p class="text-start fs-3" style=" font-weight: bold; ">{{ $article->heading }}</p>
                                    <p class="text-start fs-5" >{{ $article->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button class="carousel-control-prev" style="width: 3vh;" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev" >
                    <img class="w-100" src="{{ asset('img/left.svg') }}" alt="arrow" >
                </button>
                <button class="carousel-control-next" style="width: 3vh;" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
                    <img class="w-100" src="{{ asset('img/right.svg') }}" alt="arrow" >
                </button>
            </div>
        </div>
        
        {{-- Карты --}}
        <div class="container px-3">
            <?php
              $categories = Categories::with('places')->get();
            ?>
            @foreach($categories as $category)
                {{-- Make sure the id attribute is unique for each category --}}
                <div id="category-{{ $category->id }}" class="row row-cols-2">                   
                    @if($category->places->isNotEmpty())
                        <p class="col-12 fs-4 mb-2 fw-bolder">{{ $category->name }}</p>    
                        @foreach($category->places as $place)
                            @if ($place->orientationImg == '1')
                                <div class="place-vertical col row row-cols-1 row-cols-md-2" > 
                                    <div class="col" >
                                        <img src="{{ asset('storage/' . $place->img) }}" alt="" class="w-100 image-cover" loading="lazy">
                                    </div> 
                                    <div class="col d-flex flex-column justify-content-between">
                                        <div class="d-flex flex-column justify-content-between">
                                            <p class="fs-4 fw-bold">{{ $place->name }}</p>  
                                            <p class="fs-5">{{ mb_substr($place->address, 0, 100) }}{{ strlen($place->address) > 100 ? '...' : '' }}</p>
                                            <div class="col mb-5 mb-md-2">
                                                @foreach($place->attributes as $attribute)
                                                    <img loading="lazy" src="{{ asset('storage/' . $attribute->img) }}" alt="{{ $attribute->name }}" class="attribute-img" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="{{ $attribute->name }}" style="width: 3vh; height: 3vh;">
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                        <div>
                                            <a href="{{ route('app.places.show', $place->id) }}" class="btn btn-primary w-100">
                                                Подробнее
                                            </a>
                                        </div> 
                                    </div> 
                                </div>
                            @else 
                                <div class="place-horizontal col-12 row row-cols-2 row-cols-md-1 flex-column justify-content-around">
                                    <div class="col col-6" >
                                        <img loading="lazy" src="{{ asset('storage/' . $place->img) }}" alt="" class="w-100 image-cover">
                                    </div>
                                    <div class="col col-6 d-flex flex-column justify-content-between">
                                        <p class="fs-4 fw-bold fw-md-normal mb-1">{{ $place->name }}</p>
                                        <p class="fs-5">{{ mb_substr($place->address, 0, 100) }}{{ strlen($place->address) > 100 ? '...' : '' }}</p>
                                        <div class="col mb-5  mb-md-2">
                                            @foreach($place->attributes as $attribute)
                                                <img loading="lazy" src="{{ asset('storage/' . $attribute->img) }}" alt="{{ $attribute->name }}" class="attribute-img" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="{{ $attribute->name }}" style="width: 3vh; height: 3vh;">
                                            @endforeach
                                        </div>
                                        <a href="{{ route('app.places.show', $place->id) }}" class="btn btn-primary">
                                            Подробнее
                                        </a>
                                    </div>            
                                </div>
                            @endif 
                        @endforeach
                    @else
                        <p class="col-12 fs-3 fw-bold">{{ $category->name }}</p>          
                    @endif
                </div>
            @endforeach
        </div>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>

    </body>
</html>
