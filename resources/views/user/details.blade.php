@extends('user.layout.style')

@section('content')

 <div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{asset('uploads/'.$data->image)}}" class="img-thumbnail" width="100%">            <br>
           <a href="{{route('user#order')}}">
                <button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Order</button>
           </a>
            <a href="{{route('user#index')}}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
           <div>
               <label><h5>Pizza Name</h5></label><br>
                  <label>{{$data->pizza_name}}</label>
           </div>
           <hr>
             <div>
               <label><h5>Pizza Price</h5></label><br>
                  <label>{{$data->price}} kyats</label>
           </div>
             <hr>
              <div>
               <label><h5>Discount Price</h5></label><br>
                  <label>{{$data->discort_price}} kyats</label>
           </div>
<hr>
           <div>
               <label><h5>Buy one get one</h5></label><br>
                  <label>
                      @if($data->buy_one_get_one_status	==0)
                      Allow
                      @else
                      Not allow
                      @endif

                  </label>
           </div>
           <hr>
                 <div>
               <label><h5>Waiting Time</h5></label><br>
                  <label>{{$data->waiting_time}} minutes</label>
           </div>
           <hr>
           <div>
               <label><h5>Description</h5></label><br>
                  <label>{{$data->description}} </label>
           </div>
<hr>
             <div>
               <label><h3>Total price</h3></label><br>
                  <h4  class="text-success">{{$data->price-$data->discort_price}} kyats</h4>
           </div>


        </div>



@endsection
