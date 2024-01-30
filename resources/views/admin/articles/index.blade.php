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
              <h1 class="m-0">Все слайды</h1>
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
                  <h3 class="card-title">Слайды</h3>
        
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
                                  Название заголовка
                              </th>
                              <th style="width: 22%">
                                  Текст описания
                              </th>
                              <th style="width: 22%">
                                  Ссылка на статью
                              </th>
                              <th style="width: 21%">
                                  Картинка
                              </th>
                              <th style="width: 22%">
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td>
                                    {{$article['id']}}
                                </td>
                                <td>
                                    <a>
                                        {{$article['heading']}}
                                    </a>                                  
                                </td>
                                <td>
                                      <a>
                                        {{$article['description']}}
                                      </a>
                                </td>
                                <td class="project_progress">
                                      <a>
                                        {{$article['link']}}
                                      </a>
                                </td>
                                <td class="project_progress">
                                    <img src="/storage/{{$article['img']}}" alt="">                                 
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('articles.edit', $article['id']) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>

                                    <form action="{{ route('articles.destroy', $article['id']) }}" method="POST">
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