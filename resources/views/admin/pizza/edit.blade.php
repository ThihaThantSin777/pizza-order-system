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
                  <legend class="text-center">Edit Pizza</legend>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src=" {{asset('uploads/'.$p_data->image)}}" alt="" style="width: 300px; height: 200px;">
                    </div>
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action="{{route('admin#pizza#update',$p_data->pizza_id)}}" enctype="multipart/form-data">
                          @csrf
                        <div class="form-group row">
                          <label for="name" class="col-sm-3 col-form-label">Pizza Name</label>
                          <div class="col-sm-7">
                            <input type="text" name="name" id="name" value="{{old('name',$p_data->pizza_name)}}" class="form-control mb-3" placeholder="enter pizza name">
                            @if ($errors->has('name'))
                            <p class="text-danger">
                           {{$errors->first('name')}}
                           </p>
                         @endif
                          </div>

                          <label for="img" class="col-sm-3 col-form-label">Pizza Image</label>
                          <div class="col-sm-7">
                             <input type="file" name="img" id="img" value="{{old('img',asset('uploads/'.$p_data->image))}}" class="form-control mb-3" accept="image/*" >
                            
                             <p class="text-danger">
                            Note:: if you don't choose new image,it will upload an original image.
                            </p>
                          
                          </div>

                          <label for="price" class="col-sm-3 col-form-label">Pizza Price</label>
                          <div class="col-sm-7">
                             <input type="number" name="price" id="price" value="{{old('price',$p_data->price)}}" class="form-control mb-3" placeholder="enter pizza price" min="0">
                             @if ($errors->has('price'))
                             <p class="text-danger">
                            {{$errors->first('price')}}
                            </p>
                          @endif
                          </div>
                          <label for="publish" class="col-sm-3 col-form-label">Publish status</label>
                          <div class="col-sm-7">
                           <select name="publish" id="publish" class="form-select mb-3">
                               @if ($p_data->publish_status==1)
                               <option value="1" selected >Publish</option>
                               <option value="0">Un Publish</option>
                               @else
                               <option value="0" selected>Un Publish</option>
                               <option value="1">Publish</option>
                               @endif
                           </select>
                         </div>

                         <label for="category" class="col-sm-3 col-form-label">Category</label>
                          <div class="col-sm-7">

                            <select name="category" id="category" class="form-select mb-3">
                                @foreach ($category as $item)
                                @if ($item->category_id ==$p_data->category_id)
                                <option value="{{$item->category_id}}" selected>{{$item->category_name}}</option>
                                @else
                                <option value="{{$item->category_id}}">{{$item->category_name}}</option>

                                @endif

                              @endforeach

                        </select>
                         </div>

                         <label for="discount" class="col-sm-3 col-form-label">Discount Price</label>
                         <div class="col-sm-7">
                            <input type="number" name="discount" value="{{old('discount',$p_data->discort_price)}}" id="discount" class="form-control mb-3" placeholder="enter discount price" min="0">
                            @if ($errors->has('discount'))
                            <p class="text-danger">
                           {{$errors->first('discount')}}
                           </p>
                         @endif
                        </div>

                        <label for="buy_one" class="col-sm-3 col-form-label">Buy one get one</label>

                            <div class="col-sm-7 form-check mx-2">
                                @if ($p_data->buy_one_get_one_status==1)
                                <input class="form-check-input" type="radio" name="buy_one" id="b_yes" value="1" checked>
                                <label class="form-check-label" for="b_yes">
                                  Yes
                                </label>


                                <input class="form-check-input mx-4" type="radio" name="buy_one" id="b_no" value="0">
                                <label class="form-check-label mx-5" for="b_no">
                                 No
                                </label>
                                @else
                                <input class="form-check-input" type="radio" name="buy_one" id="b_yes" value="1">
                                <label class="form-check-label" for="b_yes">
                                  Yes
                                </label>


                                <input class="form-check-input mx-4" type="radio" name="buy_one" id="b_no" value="0" checked>
                                <label class="form-check-label mx-5" for="b_no">
                                 No
                                </label>
                                @endif

                              </div>

                              <label for="time" class="col-sm-3 col-form-label">Waiting Time</label>
                              <div class="col-sm-7">
                                 <input type="number" name="time" id="time" value="{{old('time',$p_data->waiting_time)}}" class="form-control mb-3" placeholder="enter minutes" min="0">
                                 @if ($errors->has('time'))
                                 <p class="text-danger">
                                {{$errors->first('time')}}
                                </p>
                              @endif
                             </div>

                             <label for="desc" class="col-sm-3 col-form-label">Description</label>
                             <div class="col-sm-7">
                              <textarea name="desc" id="desc" cols="30" rows="10" placeholder="enter description" class="form-control mb-3">{{old('desc',$p_data->description)}}</textarea>
                                @if ($errors->has('desc'))
                                <p class="text-danger">
                               {{$errors->first('desc')}}
                               </p>
                             @endif
                            </div>

                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-10">
                                <button type="submit" class="btn bg-success">Edit</button>
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
