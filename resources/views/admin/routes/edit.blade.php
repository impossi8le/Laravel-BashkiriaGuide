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
              <h1 class="m-0">Редактировать слайд: id - {{ $route['id'] }}</h1>
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
                <form action="{{ route('routes.update', $route['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputhead1">Загаловок</label>
                      <input type="text" value="{{ $route['name'] }}" name="name" class="form-control" id="exampleInputhead1" placeholder="Введите заголовок" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPointStart1">Точка начала</label>
                      <input type="text" value="{{ $route['pointStart'] }}" name="pointStart" class="form-control" id="exampleInputPointStart1" placeholder="Введите описание" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPointEnd1">Точка конца</label>
                      <input type="text" value="{{ $route['pointEnd'] }}" name="pointEnd" class="form-control" id="exampleInputPointEnd1" placeholder="Введите описание" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputAgencyId1">Агенство</label>
                      <select name="agencyId" class="form-control" id="exampleInputAgencyId1" required>
                        <option value="" disabled>Выберите агенство</option>
                        @foreach($agencies as $agency)
                            <option value="{{ $agency->id }}" {{ $route->agencyId == $agency->id ? 'selected' : '' }}>
                                {{ $agency->name }}
                            </option>
                        @endforeach
                    </select>
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