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
              <h1 class="m-0">Создать Организацию</h1>
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
                <form action="{{ route('organisations.store') }}" method="POST" >
                @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputName1">Название</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Введите название организации" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPhone1">Список номеров</label>
                      <input type="text" name="phones" class="form-control" id="exampleInputPhone1" placeholder="Введите номера телефонов через запятую" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Ссылка</label>
                    <input type="text" name="link" class="form-control" id="exampleInputName1" placeholder="Введите ссылку" required>
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