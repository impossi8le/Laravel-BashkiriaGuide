@extends('layouts.admin_layout')

@section('title', 'Все места/объекты')


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
              <h1 class="m-0">Все места/объекты</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
       
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Места/объекты</h3>
        
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <table class="table table-striped projects">
                      <thead>
                          <tr>
                              <th style="width: 1%">
                                  id
                              </th>
                              <th style="width: 30%">
                                  Название места/объекта
                              </th>
                              <th style="width: 28%">
                                  Описание
                              </th>
                              <th style="width: 20%">
                                Адрес
                              </th>
                              <th style="width: 22%">
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($places as $place)
                            <tr>
                                <td>
                                    {{$place['id']}}
                                </td>
                                <td>
                                    <a>
                                      {{$place['name']}}
                                    </a>                                  
                                </td>
                                <td>
                                    <a>
                                      {{$place['description']}}
                                    </a>
                                </td>
                                <td>
                                  <a>
                                    {{$place['address']}}
                                  </a>
                                </td>
                                {{-- <td class="project_progress">
                                    <img src="/storage/{{$route['img']}}" alt="">                                 
                                </td> --}}
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('places.edit', $place['id']) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>

                                    <form action="{{ route('places.destroy', $place['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Удалить
                                        </button>
                                    </form>                                    

                                </td>
                            </tr>
                        @endforeach


                      </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection