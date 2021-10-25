@extends('admin.layout.template')

@section('content')


<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">

              <div class="card">
                <div class="card-header p-2">
                  <legend>Are you sure want to delete?</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                              <label>{{$comfirm_delte_data->name}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                              <label>{{$comfirm_delte_data->email}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                          <div class="col-sm-10">
                              <label>{{$comfirm_delte_data->phone}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Address</label>
                          <div class="col-sm-10">
                              <label>{{$comfirm_delte_data->address}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <a href="{{route('admin#admin#delete',$comfirm_delte_data->id)}}">
                                <button type="button" class="btn bg-success">Yes</button>
                            </a>
                            <a href="{{route('admin#admin#list')}}">
                                <button type="button" class="btn bg-danger">No</button>
                            </a>
                          </div>
                        </div>
                      </form>

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