<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Поиск мест</title>
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
        <div class="container py-4 ">
            <form id="searchForm" action="{{ route('app.search') }}" method="GET" class="row row-cols-2 justify-content-between p-2">
                <input class="col-8" type="text" id="searchQuery" name="query" placeholder="Введите название" />
                <input class="col-3" type="button" id="searchButton" value="Поиск" />
            </form>
            <div id="placesList">
              
            </div>            
        </div>

        <!-- Include jQuery for AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                function ajaxSearch() {
                    var query = $('#searchQuery').val();
                    $.ajax({
                        url: "{{ route('app.search') }}",
                        type: 'GET',
                        data: { query: query },
                        success: function(response) {
                            console.log(response); // Debug response
                            $('#placesList').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX error:", status, error);
                        }
                    });
                }
        
                // Trigger AJAX search on page load and button click
                ajaxSearch();
                $('#searchButton').click(ajaxSearch);
            });
        </script>



    </body>
</html>
