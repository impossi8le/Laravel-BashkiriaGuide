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
              <h1 class="m-0">Все категории</h1>
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
                  <h3 class="card-title">Категории</h3>

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
                                  Родительская категория
                              </th>
                              <th style="width: 33%">
                                Картинка
                              </th>
                              <th style="width: 22%">
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><a>{{ $category->name }}</a></td>
                            <td>
                                @if($category->parent)
                                    <a>{{ $category->parent->name }}</a>
                                @else
                                    <a>Нет родительской категории</a>
                                @endif
                            </td>
                            <td class="project_progress">
                              <img src="/storage/{{$category['img']}}" alt="" style="width: 10%">                                 
                            </td>
                            <td class="project-actions text-right">
                              <a class="btn btn-info btn-sm" href="{{ route('categories.edit', $category['id']) }}">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                  Редактировать
                              </a>

                              <form action="{{ route('categories.destroy', $category['id']) }}" method="POST">
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