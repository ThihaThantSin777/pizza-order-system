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
                  <h2>Contact List</h2>
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
                <div class="mb-3">Total-{{$data->total()}}</div>

                <div class="card-tools">
                    <form action="{{route('admin#contact#search')}}" method="get">
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
                      <th>User ID</th>
                      <th>User Name</th>
                      <th>User Email</th>
                      <th>User Message</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($status==0)
                    <tr>
                        <td colspan="5">
                            <small class="text-muted">There is no data</small>
                        </td>
                    </tr>
                    @else
                        @foreach ($data as $item)
                        <tr>
                          <td>{{$item->contact_id}}</td>
                          <td>{{$item->user_id}}</td>
                           <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                             <td>{{$item->message}}</td>
                        </tr>
                        @endforeach
                        @endif
                  </tbody>
                </table>
              </div>
             <div class="mt-3">
                 {{$data->links()}}
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
