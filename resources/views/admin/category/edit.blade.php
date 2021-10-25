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
                  <legend>Are you sure want to edit?</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action="{{route('admin#update',$data->category_id)}}">
                          @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-5 col-form-label">Before Category Name</label>
                          <div class="col-sm-7">
                              <label>{{$data->category_name}}</label>
                          </div>
                          <label for="inputName" class="col-sm-5 col-form-label">After Category Name</label>
                          <div class="col-sm-7">
                             <input type="text" name="after_name" id="inputName" class="form-control" placeholder="enter new category name">
                             @if ($errors->has('after_name'))
                             <small class="text-danger">
                            {{$errors->first('after_name')}}
                            </small>
                          @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-5 col-sm-10">
                                <button type="submit" class="btn bg-success">Edit</button>
                            <a href="{{route('admin#category')}}" class="text-decoration-none">
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
