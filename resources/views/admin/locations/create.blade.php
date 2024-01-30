@extends('layouts.admin_layout') 

@section('title', 'Создать маршрут')


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
              <h1 class="m-0">Создать локацию</h1>
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
                {{-- <form action="{{ route('locations.store') }}" method="POST"  enctype="multipart/form-data" >
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputName1">Название</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Введите название" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPointStrat1">Точка</label>
                      <input type="text" name="point" class="form-control" id="exampleInputPointStrat1" placeholder="Введите точку" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPointEnd1">Адрес</label>
                        <input type="text" name="address" class="form-control" id="exampleInputPointEnd1" placeholder="Введите адрес" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUpload1">Загрузите файл</label>
                    <input type="file" name="image" class="form-control" id="exampleInputUpload1" placeholder="Загрузите файл" required>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Создать</button>
                  </div>
                </form> --}}

                <form action="{{ route('locations.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputName1">Название</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Введите название" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputDescription1">Точка</label>
                        <input type="text"   name="point" class="form-control" id="exampleInputDescription1" placeholder="Введите описание объекта" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputAddres1">Адрес</label>
                          <input type="text" name="address" class="form-control" id="exampleInputAddres1" placeholder="Введите адрес" required>
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