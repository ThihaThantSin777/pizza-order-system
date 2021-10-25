@extends('admin.layout.template')

@section('content')



<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
                      @if (Session::has('ds'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('ds')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                      <div class="mb-3">Total Admin-{{$admin_data->total()}}</div>
                    <a href="{{route('admin#user#list')}}" class="text-decoration-none">
                        <button class="btn btn-sm btn-outline-dark">User List</button>

                    </a>
                       <a href="{{route('admin#admin#list')}}" class="text-decoration-none">
                        <button class="btn btn-sm btn-outline-dark">Admin List</button>

                    </a>


                </h3>

                <div class="card-tools">
                    <form action="{{route('admin#admin#search')}}" method="get">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
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
                        @foreach ($admin_data as $item)
                        <tr>
                          <td>{{$item->id}}</td>
                          <td>{{$item->name}}</td>
                         <td>{{$item->email}}</td>
                          <td>{{$item->phone}}</td>
                           <td>{{$item->address}}</td>
                           <td>
                               <a href="{{route('admin#admin#confirm#delete',$item->id)}}" class="text-decoration-none">
                              <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                            </a>
                           </td>
                        </tr>
                        @endforeach
                        @endif
                  </tbody>
                </table>
              </div>
             <div>
                 {{$admin_data->links()}}
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
