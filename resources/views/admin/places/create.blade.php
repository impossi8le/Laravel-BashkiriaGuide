@extends('layouts.admin_layout') 

@section('title', 'Создать карточку места(объекта)')


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
              <h1 class="m-0">Создать карточка места(объекта)</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputName1">Название</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Введите название" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputDescription1">Описание</label>
                        <input type="text"   name="description" class="form-control" id="exampleInputDescription1" placeholder="Введите описание объекта" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputAddres1">Адрес</label>
                          <input type="text" name="address" class="form-control" id="exampleInputAddres1" placeholder="Введите адрес" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputOrientation1">Ориентация картинки</label>
                        <select name="orientation" class="form-control" id="exampleInputOrientation1" required>
                          <option value="" disabled selected>Выберите ориентацию</option>
                          <option value="1" {{ old('orientation') == '1' ? 'selected' : '' }}>Вертикально</option>
                          <option value="2" {{ old('orientation') == '2' ? 'selected' : '' }}>Горизонтально</option>
                        </select>                    
                      </div>
                      <div class="form-group">
                        <label for="exampleInputOrientation1">Имеет ОВЗ</label>
                        <select name="disabilities" class="form-control" id="exampleInputOrientation1" required>
                          <option value="" disabled selected>Выберите да или нет</option>
                          <option value="1" {{ old('disabilities') == '1' ? 'selected' : '' }}>Да</option>
                          <option value="2" {{ old('disabilities') == '2' ? 'selected' : '' }}>Нет</option>
                        </select>                    
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCategory1">Подкатегория</label>
                        <select name="subcategoryId" class="form-control" id="exampleInputCategory1" required>
                            <option value="" disabled selected>Выберите подкатегорию</option>
                            @foreach($categories as $category)
                                @if($category->parent_id) {{-- Если у категории есть родительская категория --}}
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputRoute1">Маршрут</label>
                        <select name="routeId[]" class="form-control" id="exampleInputRoute1" multiple required>
                            <option value="" disabled selected>Выберите маршруты</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputorganisation1">Организация</label>
                        <select name="organisationId" class="form-control" id="exampleInputorganisation1" multiple required>
                            <option value="" disabled selected>Выберите Организацию</option>
                            @foreach($organisations as $organisation)
                                <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                            @endforeach
                        </select>
                      </div>
  
                      <div class="form-group">
                        <label for="exampleInputorganisation1">Атрибуты</label>
                        <select name="attributeId[]" class="form-control" id="exampleInputorganisation1" multiple required>
                            <option value="" disabled selected>Выберите атрибуты</option>
                            @foreach($attributes as $attribute)
                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputLocation1">Местонахождение</label>
                        <select name="locationId" class="form-control" id="exampleInputLocation1" required>
                            <option value="" disabled selected>Выберите местонахождение</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputUpload1">Загрузите файл</label>
                        <input type="file" name="image" class="form-control" id="exampleInputUpload1" placeholder="Загрузите файл">
                      </div>
                    
                    
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