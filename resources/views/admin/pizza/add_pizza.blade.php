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
                  <legend>Add Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action="{{route('admin#create#pizza')}}" enctype="multipart/form-data">
                          @csrf
                        <div class="form-group row">
                          <label for="name" class="col-sm-4 col-form-label">Pizza Name</label>
                          <div class="col-sm-7">
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control mb-3" placeholder="enter pizza name">
                            @if ($errors->has('name'))
                            <p class="text-danger">
                           {{$errors->first('name')}}
                           </p>
                         @endif
                          </div>

                          <label for="img" class="col-sm-4 col-form-label">Pizza Image</label>
                          <div class="col-sm-7">
                             <input type="file" name="img" id="img" value="{{old('img')}}" class="form-control mb-3" accept="image/*" >
                             @if ($errors->has('img'))
                             <p class="text-danger">
                            {{$errors->first('img')}}
                            </p>
                          @endif
                          </div>

                          <label for="price" class="col-sm-4 col-form-label">Pizza Price</label>
                          <div class="col-sm-7">
                             <input type="number" name="price" id="price" value="{{old('price')}}" class="form-control mb-3" placeholder="enter pizza price" min="0">
                             @if ($errors->has('price'))
                             <p class="text-danger">
                            {{$errors->first('price')}}
                            </p>
                          @endif
                          </div>
                          <label for="publish" class="col-sm-4 col-form-label">Publish status</label>
                          <div class="col-sm-7">
                           <select name="publish" id="publish" class="form-select mb-3">
                            <option value="1">Publish</option>
                            <option value="0">Un Publish</option>
                           </select>
                         </div>

                         <label for="category" class="col-sm-4 col-form-label">Category</label>
                          <div class="col-sm-7">
                            <select name="category" id="category" class="form-select mb-3">
                          @foreach ($category as $item)

                            <option value="{{$item->category_id}}">{{$item->category_name}}</option>

                          @endforeach
                        </select>
                         </div>

                         <label for="discount" class="col-sm-4 col-form-label">Discount Price</label>
                         <div class="col-sm-7">
                            <input type="number" name="discount" value="{{old('discount',0)}}" id="discount" class="form-control mb-3" placeholder="enter discount price" min="0">
                            @if ($errors->has('discount'))
                            <p class="text-danger">
                           {{$errors->first('discount')}}
                           </p>
                         @endif
                        </div>

                        <label for="buy_one" class="col-sm-4 col-form-label">Buy one get one</label>

                            <div class="col-sm-7 form-check mx-2">

                                    <input class="form-check-input" type="radio" name="buy_one" id="b_yes" value="1" checked>
                                    <label class="form-check-label" for="b_yes">
                                      Yes
                                    </label>


                                    <input class="form-check-input mx-4" type="radio" name="buy_one" id="b_no" value="0">
                                    <label class="form-check-label mx-5" for="b_no">
                                     No
                                    </label>

                              </div>

                              <label for="time" class="col-sm-4 col-form-label">Waiting Time</label>
                              <div class="col-sm-7">
                                 <input type="number" name="time" id="time" value="{{old('time')}}" class="form-control mb-3" placeholder="enter minutes" min="0">
                                 @if ($errors->has('time'))
                                 <p class="text-danger">
                                {{$errors->first('time')}}
                                </p>
                              @endif
                             </div>

                             <label for="desc" class="col-sm-4 col-form-label">Description</label>
                             <div class="col-sm-7">
                              <textarea name="desc" id="desc" cols="30" rows="10" placeholder="enter description" class="form-control mb-3">{{old('desc')}}</textarea>
                                @if ($errors->has('desc'))
                                <p class="text-danger">
                               {{$errors->first('desc')}}
                               </p>
                             @endif
                            </div>

                        <div class="form-group row">
                          <div class="offset-sm-4 col-sm-10">
                                <button type="submit" class="btn bg-success">Add</button>
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
