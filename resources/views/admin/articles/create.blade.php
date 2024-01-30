@extends('layouts.admin_layout')

@section('title', 'Создать слайд')


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
              <h1 class="m-0">Создать слайд</h1>
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
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputhead1">Загаловок</label>
                      <input type="text" name="heading" class="form-control" id="exampleInputhead1" placeholder="Введите заголовок" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputdescription1">Описание</label>
                      <input type="text" name="description" class="form-control" id="exampleInputdescription1" placeholder="Введите описание" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLink1">Ссылка на статью</label>
                        <input type="text" name="link" class="form-control" id="exampleInputLink1" placeholder="Введите ссылку" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUpload1">Загрузите файл</label>
                        <input type="file" name="image" class="form-control" id="exampleInputUpload1" placeholder="Загрузите файл" required>
                    </div>

                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Создать</button>
                  </div>
                </form>
              </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection