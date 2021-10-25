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
                  <div class="mb-3">Total-{{$order->total()}}</div>
                <h3 class="card-title">Order List</h3>

                <div class="card-tools d-flex">
                    <a href="{{route('admin#order#download')}}">
                         <button class="btn-sm btn-success mr-3">Download CSV</button>
                    </a>

                    <form action="{{route('admin#order#search')}}" method="get">
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
                      <th>Order ID</th>
                      <th>Customer Name</th>
                      <th>Pizza Name</th>
                      <th>Pizza Count</th>
                      <th>Order Time</th>
                      <th></th>
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
                        @foreach ($order as $item)
                        <tr>
                          <td>{{$item->order_id}}</td>
                          <td>{{$item->customer_name}}</td>
                            <td>{{$item->pizza_name}}</td>
                          <td>{{$item->count}}</td>
                            <td>{{$item->order_time}}</td>
                          <td>
                            <a href="#" class="text-decoration-none">
                              <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                            </a>
                            <a href="#" class="text-decoration-none">
                              <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                            </a>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                  </tbody>
                </table>
                  <div class="mt-3">
                 {{$order->links()}}
             </div>
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


