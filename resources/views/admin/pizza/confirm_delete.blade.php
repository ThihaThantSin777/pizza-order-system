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
                      <form class="form-horizontal" method="POST" action="{{route('admin#p#delete',$confirm_data->pizza_id)}}">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Pizza Name</label>
                          <div class="col-sm-7">
                              <label>{{$confirm_data->pizza_name}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-4 col-sm-10">
                                <button type="submit" class="btn bg-success">Yes</button>
                            <a href="{{route('admin#pizza')}}">
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
