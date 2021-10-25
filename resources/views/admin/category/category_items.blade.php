@extends('admin.layout.template')

@section('content')



<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
              <a href="{{route('admin#category')}}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>Back
               </a>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                 <h4>  {{$data[0]->categoryName}} Pizza</h4>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Pizza Name</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($data as $item)
                        <tr>
                          <td>{{$item->pizza_id}}</td>
                       <td>
                             <img src="{{asset('uploads/'.$item->image)}}" class="img-thumbnail" width="100px">
                           </td>
                          <td>{{$item->pizza_name}}</td>
                         <td>{{$item->price}}</td>
                        </tr>
                        @endforeach
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
