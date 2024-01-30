@extends('layouts.admin_layout')

@section('title', 'Редактировать слайд')


@section('content')
    

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

          @if (session('success'))
          <div class="alert alert-success" role="alert">           
            {{ session('success') }}         
          </div>
          @endif

          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Редактировать место/объект: Имя - {{ $place['name'] }}</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <!-- form start -->
                <form action="{{ route('places.update', $place['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputName1">Название</label>
                      <input type="text" value="{{$place['name']}}" name="name" class="form-control" id="exampleInputName1" placeholder="Введите название" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDescription1">Описание</label>
                      <input type="text"  value="{{$place['description']}}" name="description" class="form-control" id="exampleInputDescription1" placeholder="Введите описание объекта" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAddres1">Адрес</label>
                        <input type="text"  value="{{$place['address']}}" name="address" class="form-control" id="exampleInputAddres1" placeholder="Введите адрес" required>
                    </div>
                    {{-- <div class="form-group">
                      <label for="exampleInputAttributes1">Аттрибуты</label>
                      <input type="text" name="address" class="form-control" id="exampleInputAttributes1" placeholder="Введите аттрибуты" required>
                    </div> --}}
                    <div class="form-group">
                      <label for="exampleInputOrientation1">Ориентация картинки</label>
                      <select name="orientationImg" class="form-control" id="exampleInputOrientation1" required>
                        <option value="" disabled>Выберите ориентацию</option>
                        <option value="1" {{ $place->orientationImg == '1' ? 'selected' : '' }}>Вертикально</option>
                        <option value="2" {{ $place->orientationImg == '2' ? 'selected' : '' }}>Горизонтально</option>
                      </select>                   
                    </div>
                    <div class="form-group">
                      <label for="exampleInputOrientation1">Имеет ОВЗ</label>
                      <select name="disabilities" class="form-control" id="exampleInputOrientation1" required>
                        <option value="" disabled>Выберите да или нет</option>
                        <option value="1" {{ $place->disabilities == '1' ? 'selected' : '' }}>Да</option>
                        <option value="2" {{ $place->disabilities == '2' ? 'selected' : '' }}>Нет</option>
                      </select>                  
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCategory1">Подкатегория</label>
                      <select name="subcategoryId" class="form-control" id="exampleInputCategory1" required>
                        <option value="" disabled>Выберите подкатегорию</option>
                        @foreach($categories as $category)
                            @if($category->parent_id) 
                                <option value="{{ $category->id }}" {{ $place->subcategoryId == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endif
                        @endforeach
                      </select>
                    
                    </div>
                    <div class="form-group">
                      <label for="exampleInputRoute1">Маршрут</label>
                      <select name="routeId[]" class="form-control" id="exampleInputRoute1" multiple>
                        @foreach($routes as $route)
                            <option value="{{ $route->id }}" {{ in_array($route->id, $place->routes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $route->name }}
                            </option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputAttribute1">Атрибуты</label>
                      <select name="attributeId[]" class="form-control" id="exampleInputAttribute1" multiple required>
                          <option value="" disabled>Выберите атрибуты</option>
                          @foreach($attributes as $attribute)
                              <option value="{{ $attribute->id }}" {{ in_array($attribute->id, $place->attributes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                  {{ $attribute->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>
                  

                    <div class="form-group">
                      <label for="exampleInputorganisation1">Организация</label>
                      <select name="organisationId[]" class="form-control" id="exampleInputorganisation1" multiple>
                        @foreach($organisations as $organisation)
                            <option value="{{ $organisation->id }}" {{ in_array($organisation->id, $place->organisations->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $organisation->name }}
                            </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputLocation1">Местонахождение</label>
                      <select name="locationId" class="form-control" id="exampleInputLocation1" required>
                          <option value="" disabled>Select location</option>
                          @foreach($locations as $location)
                              <option value="{{ $location->id }}" {{ $location->id == $place->locationId ? 'selected' : '' }}>
                                  {{ $location->name }}
                              </option>
                          @endforeach
                      </select>
                    </div>
                  
                    <div class="form-group">
                      <label for="exampleInputUpload1">Загрузите файл</label>
                      <input type="file" value="{{ $place['img'] }}" name="image" class="form-control" id="exampleInputUpload1" placeholder="Загрузите файл">
                    </div>
                    @if($place['img'])
                        <div class="form-group">                            
                            <img src="/storage/{{$place['img']}}" alt="Image" class="img-thumbnail">
                        </div>
                    @endif
                  
                  
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                  </div>
                </form>
              </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection