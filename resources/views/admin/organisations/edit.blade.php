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
              <h1 class="m-0">Редактировать организацию: Название - {{ $organisation['name'] }}</h1>
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
                <form action="{{ route('organisations.update', $organisation['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName1">Название</label>
                    <input type="text" name="name" value="{{ $organisation['name'] }}" class="form-control" id="exampleInputName1" placeholder="Введите название" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPhone1">Список номеров</label>
                    <input type="text" name="phones" value="{{ implode(', ', json_decode($organisation->phones, true)) }}" class="form-control" id="exampleInputPhone1" placeholder="Введите номера телефонов через запятую" required>

                    {{-- <input type="text" name="phones" value="{{ $agency['phones'] }}" class="form-control" id="exampleInputPhone1" placeholder="Введите номера телефонов через запятую" required> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Ссылка</label>
                    <input type="text" name="link" value="{{ $organisation['link'] }}" class="form-control" id="exampleInputName1" placeholder="Введите ссылку" required>
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