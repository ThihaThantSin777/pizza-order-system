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
                @if (Session::has('pizza_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('pizza_success')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if (Session::has('update_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('update_success')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if (Session::has('pizza_status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('pizza_status')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                  <div class="mb-3">Total-{{$pizza_data->total()}}</div>
                <h3 class="card-title">
                    <a href="{{route('admin#add#pizza')}}">
                        <button class="btn btn-sm btn-outline-dark"><i class="fas fa-plus-square"></i></button>
                    </a>
                </h3>

                <div class="card-tools d-flex">
                     <a href="{{route('admin#pizza#download')}}">
  <button class="btn-sm btn-success mr-3">Download CSV</button>
                    </a>
                    <form action="{{route('admin#pizza#search')}}" method="GET">
                        @csrf
                  <div class="input-group input-group-sm mt-1" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">


                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>

                   </form>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
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
                          @foreach ($pizza_data as $item )
                          <tr>
                           <td>{{$item->pizza_id}}</td>
                           <td>{{$item->pizza_name}}</td>
                           <td>
                             <img src="{{asset('uploads/'.$item->image)}}" class="img-thumbnail" width="100px">
                           </td>
                           <td>{{$item->price}} kyats</td>
                           <td>
                               @if ($item->publish_status =="0")
                                   No
                                   @else
                                   Yes
                               @endif
                           </td>
                           <td>
                               @if ($item->buy_one_get_one_status =="0")
                               No
                               @else
                               Yes
                           @endif
                           </td>

                           <td>
                               <a href="{{route('admin#pizza#edit',$item->pizza_id)}}">
                                <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                               </a>

                            <a href="{{route('admin#p-confirm-delete',$item->pizza_id)}}" class="text-decoration-none">
                               <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                            </a>
                            <a href="{{route('admin#pizza#info',$item->pizza_id)}}" class="text-decoration-none">
                                <button class="btn btn-sm bg-success text-white"><i class="far fa-eye"></i></button>
                            </a>
                           </td>
                         </tr>
                          @endforeach
                      @endif

                  </tbody>
                </table>
              </div>
              <div>
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


