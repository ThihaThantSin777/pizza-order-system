@extends('admin.layout.template')

@section('content')



<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                @if (Session::has('category_status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('category_status')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if (Session::has('deleteSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('deleteSuccess')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if (Session::has('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('updateSuccess')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <div class="mb-3">Total-{{$pizza_data->total()}}</div>
                <h3 class="card-title">
                    <a href="{{route('admin#add-category')}}">
                        <button class="btn btn-sm btn-outline-dark">Add Category</button>
                    </a>

                </h3>

                <div class="card-tools d-flex">
                    <a href="{{route('admin#category#download')}}">
  <button class="btn-sm btn-success mr-3">Download CSV</button>
                    </a>

                    <form action="{{route('admin#search')}}" method="get">
                        @csrf
                        <div class="input-group input-group-sm mt-1" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">

                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                      </button>


                            </div>
                          </div>
                    </form>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th>Product Count</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($status==0)
                    <tr>
                        <td colspan="6">
                            <small class="text-muted">There is no data</small>
                        </td>
                    </tr>
                    @else
                        @foreach ($pizza_data as $item)
                        <tr>
                          <td>{{$item->category_id}}</td>
                          <td>{{$item->category_name}}</td>
                          <td>

                            @if ($item->count==0)
                                <a href="#" class="text-decoration-none text-black">
                                    {{$item->count}}
                                </a>
                                @else
                                <a href="{{route('admin#category#items',$item->category_id)}}" class="text-decoration-none text-black">
                                    {{$item->count}}
                                </a>
                            @endif
                          </td>
                          <td>
                            <a href="{{route('admin#edit',$item->category_id)}}" class="text-decoration-none">
                              <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                            </a>
                            <a href="{{route('admin#confirm-delete',$item->category_id)}}" class="text-decoration-none">
                              <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                            </a>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                  </tbody>
                </table>
              </div>
             <div class="mt-3">
                 {{$pizza_data->links()}}
             </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection
