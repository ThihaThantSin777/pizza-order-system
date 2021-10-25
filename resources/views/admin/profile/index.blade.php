@extends('admin.layout.template')

@section('content')


<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <div class="card">
                @if (Session::has('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('status')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <div class="card-header p-2">
                  <legend class="text-center">Admin Profile</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane offset-3" id="activity">

                        <div class="d-flex">
                          <label for="inputName" class="form-label mx-4">Name</label>
                          <div class="">
                              <label>{{$login_data->name}}</label>
                          </div>
                        </div>
                        <div class="d-flex">
                          <label for="inputEmail" class="form-label mx-4">Email</label>
                          <div class="">
                            <label>{{$login_data->email}}</label>
                          </div>
                        </div>
                        <div class="d-flex">
                            <label for="inputPhone" class="form-label mx-4">Phone</label>
                            <div class="">
                                <label>{{$login_data->phone}}</label>
                            </div>
                          </div>

                          <div class="d-flex">
                            <label for="inputAddress" class="form-label mx-3">Address</label>
                            <div class="">
                                <label>{{$login_data->address}}</label>
                            </div>
                          </div>
                          <div>
                            <a href="{{route('admin#edit#profile',$login_data->id)}}" class="text-black">
                              Edit Profile
                            </a>

                                                         <!-- Button trigger modal -->
<span style="cursor: pointer; text-decoration: underline" class="mx-3">
     <a href="{{route('admin#profile#change#password',$login_data->id)}}" class="text-black">
                             Change Password
                            </a>

</span>


                          </div>
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
