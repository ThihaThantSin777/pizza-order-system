@extends('user.layout.style')


@section('content')

<!-- Page Content-->
    <div class="container px-4 px-lg-5" id="home">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza" src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
            <div class="col-lg-5">
                <h1 class="font-weight-light" id='about'>Yummy Pizza</h1>
                <p>

                    Pizza is an Italian dish consisting of a usually round, flattened base of leavened wheat-based dough topped with tomatoes, cheese, and often various other ingredients (such as anchovies, mushrooms, onions, olives, pineapple, meat, etc.), which is then baked at a high temperature, traditionally in a wood-fired oven. A small pizza is sometimes called a pizzetta. A person who makes pizza is known as a pizzaiolo.

In Italy, pizza served in formal settings, such as at a restaurant, is presented unsliced, and is eaten with the use of a knife and fork. In casual settings, however, it is cut into wedges to be eaten while held in the hand.
                </p>
                <a class="btn btn-primary" href="#list">Enjoy!</a>
            </div>
        </div>

        <!-- Content Row-->
        <div class="d-flex" id='list'>
            <div class="col-3 me-5">
                <div class="">
                    <div class="py-5 text-center">
                        <form class="d-flex m-5" method="get" action="{{route('user#pizza#search')}}">
                            <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search" value="{{old('search')}}">
                            <button class="btn btn-outline-dark" type="submit">Search</button>
                        </form>

                        <div class="">
                             <a class="text-decoration-none text-black" href="{{route('user#index')}}">
                                 <div class="m-2 p-2">All</div>
                           </a>

                           @foreach ($category as $item)
                           <a class="text-decoration-none text-black" href="{{route('user#category#search',$item->category_id)}}">
                               <div class="m-2 p-2">{{$item->category_name}}</div>
                           </a>

                           @endforeach
                        </div>
                        <hr>
                 <form action="{{route('user#pizza#search#items')}}" method="GET">
                     @csrf
                            <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Start Date - End Date</h3>


                                <input type="date" name="startDate" id="" class="form-control"> -
                                <input type="date" name="endDate" id="" class="form-control">

                        </div>
                        <hr>
                        <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Min - Max Amount</h3>


                                <input type="number" name="minPrice" id="" class="form-control" placeholder="minimum price"> -
                                <input type="number" name="maxPrice" id="" class="form-control" placeholder="maximun price">

                        </div>
                         <div class="">
                             <button type="submit" class="btn bg-dark text-white">Search <i class="fas fa-search"></i></button>
                            {{-- <input type="submit" value="search" class='btn bg-dark text-white'> --}}
                        </div>
                 </form>

                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="row" id="pizza">
                     @if ($status==0)

<div class="alert alert-danger mt-4" style="width:700px;" role="alert">
  There is no data
</div>
                          @else
                          @foreach ($pizza as $item)
          <div class="col-4 mb-4">
                     <div class="card h-100" style="width: 280px;">
                            <!-- Sale badge-->
                            @if ($item->buy_one_get_one_status==1)
                                  <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Buy one get one</div>
                            @endif
                            <!-- Product image-->
                            <img class="card-img-top" src="{{asset('uploads/'.$item->image)}}" alt="..."  style="height: 200px" id='pizzaImg'/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder" >{{$item->pizza_name}}</h5>
                                    <!-- Product price-->
                                    {{-- <span class="text-muted text-decoration-line-through">$20.00</span> $18.00 --}}
                                    {{$item->price}} Kyats
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('user#pizza#details',$item->pizza_id)}}">More Details</a></div>
                            </div>
                        </div>

                    </div>

                    @endforeach
                    @endif
                </div>
               <div class="mt-3">
 {{$pizza->links()}}
               </div>
            </div>
        </div>
    </div>

    <div class="text-center d-flex justify-content-center align-items-center mt-3" id="contact">
        <div class="col-4 border shadow-sm ps-5 pt-5 pe-5 pb-2 mb-5">
             @if (Session::has('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('status')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
            <h3>Contact Us</h3>

            <form action="{{route('user#contact')}}" class="my-4" method="post">
                @csrf
                <input type="text" name="name" id="" value="{{old('name')}}" class="form-control my-3" placeholder="Name">
                  @if ($errors->has('name'))
                                <small class="text-danger">
                               {{$errors->first('name')}}
                               </small>
                             @endif
                <input type="text" name="email" id="" value="{{old('email')}}" class="form-control my-3" placeholder="Email">
                  @if ($errors->has('email'))
                                <small class="text-danger">
                               {{$errors->first('email')}}
                               </small>
                             @endif
                <textarea class="form-control my-3" id="exampleFormControlTextarea1" rows="3" placeholder="Message" name="message">{{old('message')}}</textarea>
                  @if ($errors->has('message'))
                                <small class="text-danger">
                               {{$errors->first('message')}}
                               </small>
                             @endif
                <button type="submit" class="btn bg-dark text-white">Send <i class="fas fa-arrow-right"></i></button>
            </form>
        </div>
    </div>

@endsection






