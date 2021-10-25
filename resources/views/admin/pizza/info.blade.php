@extends('admin.layout.template')

@section('content')


<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
                <a href="{{route('admin#pizza')}}" class="text-decoration-none text-dark">
                    <i class="fas fa-arrow-left"></i>Back
                   </a>
              <div class="card mt-2">
                <div class="card-header p-2">
                  <legend class="text-center">Pizza Information</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane d-flex justify-center" id="activity">
                        <div class="img-fluid">
                            <img src=" {{asset('uploads/'.$pizza->image)}}" alt="" style="width: 300px; height: 280px;">
                        </div>
                <div class="mx-4">
                    <div class="mb-3">
                        <b>Name: </b><span>{{$pizza->pizza_name}}</span>
                    </div>
                    <div class="mb-3">
                        <b>Price: </b><span>{{$pizza->price}}</span> Kyats
                    </div>
                    <div class="mb-3">
                        <b>Publish Status: </b>
                        @if ($pizza->publish_status==1)
                        <span>Yes</span>
                        @else
                            <span>No</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <b>Category: </b><span>{{$c_data['category_name']}}</span>
                    </div>
                    <div class="mb-3">
                        <b>Discount: </b><span>{{$pizza->discort_price}}</span>
                    </div>
                    <div class="mb-3">
                        <b>Buy one get one </b>
                        @if ($pizza->buy_one_get_one_status==1)
                        <span>Yes</span>
                        @else
                            <span>No</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <b>Waiting Time: </b><span>{{$pizza->waiting_time}}</span> mins
                    </div>
                </div>
              
                    </div>
                    <div class="mt-3">
                        <b>Description</b>
                    </div>
                    <div class="mt-1">
                        {{$pizza->description}}
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
