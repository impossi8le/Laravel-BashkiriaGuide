@extends('layouts.admin_layout')

@section('title', 'Все слайды')


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
              <h1 class="m-0">Все локации</h1>
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
                  <h3 class="card-title">Маршруты</h3>
        
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
                              <th style="width: 22%">
                                  Название
                              </th>
                              <th style="width: 22%">
                                  Точка нахождения
                              </th>
                              <th style="width: 22%">
                                Адрес
                              </th> 
                              <th style="width: 22%">
                                Картинка
                              </th>     
                              <th style="width: 21%">
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <td>
                                    {{$location['id']}}
                                </td>
                                <td>
                                    <a>
                                        {{$location['name']}}
                                    </a>                                  
                                </td>
                                <td>
                                    <a>
                                      {{$location['point']}}
                                    </a>
                                </td>
                                <td>
                                      <a>
                                        {{$location['address']}}
                                      </a>
                                </td>

                                <td class="project_progress">
                                  {{-- <img src="/storage/{{$category['img']}}" alt="" style="width: 10%">                                  --}}
                                  @if(!empty($location['img']))
                                    <img src="/storage/{{$location['img']}}" alt="" style="width: 10%">
                                  @else
                                      <!-- В этом месте может быть текст или значок, указывающий на отсутствие изображения -->
                                  @endif
                                </td>

                       
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('locations.edit', $location['id']) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>

                                    <form action="{{ route('locations.destroy', $location['id']) }}" method="POST">
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