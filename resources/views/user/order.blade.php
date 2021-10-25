@extends('user.layout.style')

@section('content')

 <div class="row mt-5 d-flex justify-content-center">
        <div class="col-4 ">
            <img src="{{asset('uploads/'.$pizza->image)}}" class="img-thumbnail" width="100%">            <br>
            <a href="{{route('user#index')}}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
            @if (Session::has('totalTime'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   Order Success Please wait {{Session::get('totalTime')}} minutes
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
           <div>
               <label><h5>Pizza Name</h5></label><br>
                  <label>{{$pizza->pizza_name}}</label>
           </div>
           <hr>
             <div>
               <label><h5>Pizza Price</h5></label><br>
                  <label>{{$pizza->price-$pizza->discort_price}} kyats</label>
           </div>
             <hr>
                 <div>
               <label><h5>Waiting Time</h5></label><br>
                  <label>{{$pizza->waiting_time}} minutes</label>
           </div>
           <hr>
<form action="{{route('user#place#order')}}" method="POST">
    @csrf
                <div>
               <label><h5>Pizza Count</h5></label><br>
                 <input type="number" name="number"  class="form-control" placeholder="Number of pizza you want">
           </div>
            @if ($errors->has('number'))
                    <p class="text-danger">
                   {{$errors->first('number')}}
                   </p>
                 @endif
<hr>
<div>
               <label><h5>Payment type</h5></label><br>
<div class="form-check-inline">
  <input class="form-check-input" type="radio" name="payment" id="payment1" value="1" checked>
  <label class="form-check-label" for="payment1">
   Visa
  </label>
</div>
<div class="form-check-inline">
  <input class="form-check-input" type="radio" name="payment" id="payment2" value="2">
  <label class="form-check-label" for="payment2">
   Cash Down
  </label>
</div>
<hr>
     <button type='submit' class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Place Order</button>
</form>
           </div>

<hr>

        </div>



@endsection
