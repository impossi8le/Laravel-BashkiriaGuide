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
              <h1 class="m-0">Редактировать агенство: Название - {{ $category['name'] }}</h1>
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
                <form action="{{ route('categories.update', $category['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName1">Название</label>
                    <input type="text" name="name" value="{{ $category['name'] }}" class="form-control" id="exampleInputName1" placeholder="Введите название" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputParentId">id родительской категории</label>
                    <input type="text" name="parent_id" value="{{ $category->parent_id }}" class="form-control" id="exampleInputParentId" placeholder="Введите id Родительской категории">                  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUpload1">Загрузите файл</label>
                    <input type="file" name="image" class="form-control" id="exampleInputUpload1" placeholder="Загрузите файл">
                    @if($category['img'])
                        <div class="form-group">                            
                            <img src="/storage/{{$category['img']}}" alt="Image" class="img-thumbnail">
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