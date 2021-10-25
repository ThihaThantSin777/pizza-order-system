@extends('admin.layout.template')

@section('content')


<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
                 @if (Session::has('status'))
                <div class="alert alert-{{Session::get('color')}} alert-dismissible fade show" role="alert">
                   {{Session::get('status')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <a href="{{route('admin#profile')}}" class="text-decoration-none text-dark">
                    <i class="fas fa-arrow-left"></i>Back
                   </a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Change Passowrd</legend>
                </div>
                <div class="card-body">
                    <form action="{{route('admin#profile#update#password',$data->id)}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="o_p">Old Password</label>
                        <input value ="{{old('o_p')}}" type="password" name="o_p" id="o_p" class="form-control" placeholder="enter old password">
                    </div>
                     @if ($errors->has('o_p'))
                    <p class="text-danger">
                   {{$errors->first('o_p')}}
                   </p>
                 @endif

                      <div class="mb-3">
                        <label for="new_p">New Password</label>
                        <input value ="{{old('new_p')}}" type="password" name="new_p" id="new_p" class="form-control" placeholder="enter new password">
                    </div>
 @if ($errors->has('new_p'))
                    <p class="text-danger">
                   {{$errors->first('new_p')}}
                   </p>
                 @endif
                     <div class="mb-3">
                        <label for="c_p">Confirm Password</label>
                        <input value ="{{old('c_p')}}" type="password" name="c_p" id="c_p" class="form-control" placeholder="enter confirm password">
                    </div>
 @if ($errors->has('c_p'))
                    <p class="text-danger">
                   {{$errors->first('c_p')}}
                   </p>
                 @endif
                 <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit">Update</button>
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
