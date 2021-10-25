@extends('admin.layout.template')

@section('content')


<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
                <a href="{{route('admin#profile')}}" class="text-decoration-none text-dark">
                    <i class="fas fa-arrow-left"></i>Back
                   </a>
              <div class="card">
                  
                <div class="card-header p-2">
                  <legend>Edit Profile</legend>
                </div>
                <div class="card-body">
                 <form action="{{route('admin#update#profile',$data->id)}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="enter name" value="{{old('name',$data->name)}}">
                    </div>
                    @if ($errors->has('name'))
                    <p class="text-danger">
                   {{$errors->first('name')}}
                   </p>
                 @endif
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="enter email" value="{{old('email',$data->email)}}">
                    </div>
                    @if ($errors->has('email'))
                    <p class="text-danger">
                   {{$errors->first('email')}}
                   </p>
                 @endif
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="number" name="phone" id="phone" class="form-control" placeholder="enter phone" value="{{old('phone',$data->phone)}}">
                    </div>
                    @if ($errors->has('phone'))
                    <p class="text-danger">
                   {{$errors->first('phone')}}
                   </p>
                 @endif
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="enter address" value="{{old('address',$data->address)}}">
                    </div>
                    @if ($errors->has('address'))
                    <p class="text-danger">
                   {{$errors->first('address')}}
                   </p>
                 @endif
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit">Edit</button>
                      </div>
                 </form>
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
