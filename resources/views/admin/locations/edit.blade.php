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
              <h1 class="m-0">Редактировать локацию: Название - {{ $location['id'] }}</h1>
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
                <form action="{{ route('locations.update', $location['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputhead1">Название</label>
                      <input type="text" value="{{ $location['name'] }}" name="name" class="form-control" id="exampleInputhead1" placeholder="Введите заголовок" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPointStart1">Точка</label>
                      <input type="text" value="{{ $location['point'] }}" name="point" class="form-control" id="exampleInputPointStart1" placeholder="Введите описание" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPointEnd1">Адрес</label>
                      <input type="text" value="{{ $location['address'] }}" name="address" class="form-control" id="exampleInputPointEnd1" placeholder="Введите описание" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUpload1">Загрузите файл</label>
                      <input type="file" name="image" class="form-control" id="exampleInputUpload1" placeholder="Загрузите файл">
                      @if($location['img'])
                          <div class="form-group">                            
                              <img src="/storage/{{$location['img']}}" alt="Image" class="img-thumbnail">
                          </div>
                      @endif
                    </div>

                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                  </div>
                </form>
              </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection