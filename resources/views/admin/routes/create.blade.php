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
              <h1 class="m-0">Создать маршрут</h1>
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
                <form action="{{ route('routes.store') }}" method="POST" >
                @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputName1">Название</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Введите название" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPointStrat1">Точка старта</label>
                      <input type="text" name="pointStart" class="form-control" id="exampleInputPointStrat1" placeholder="Введите точку старта" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPointEnd1">Точка конца</label>
                        <input type="text" name="pointEnd" class="form-control" id="exampleInputPointEnd1" placeholder="Введите точку конца" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputAgencyId1">Агенство</label>
                      <select name="agencyId" class="form-control" id="exampleInputAgencyId1" required>
                          <option value="" disabled selected>Выберите агенство</option>
                          @foreach($agencies as $agency)
                              <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                          @endforeach
                      </select>
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