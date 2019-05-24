@extends('layout.layout1')
@section('title','Detail Produk')
@section('page','Detail Produk')
@section('content')

<!-- product category -->
<section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                        @foreach($images as $images)
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('images/'.$images['image_name']) }}" class="simpleLens-lens-image"><img src="{{asset('images/'.$images['image_name']) }}" class="simpleLens-big-image"></a></div>
                      </div>
                      @endforeach
                      {{-- <div class="simpleLens-thumbnails-container">
                          <a data-big-image="img/view-slider/medium/polo-shirt-1.png" data-lens-image="img/view-slider/large/polo-shirt-1.png" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                          </a>                                    
                          <a data-big-image="img/view-slider/medium/polo-shirt-3.png" data-lens-image="img/view-slider/large/polo-shirt-3.png" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                          </a>
                          <a data-big-image="img/view-slider/medium/polo-shirt-4.png" data-lens-image="img/view-slider/large/polo-shirt-4.png" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                          </a>
                      </div> --}}
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                  <h3>{{$detail_product->product_name}}</h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price">IDR. {{number_format($detail_product->price,2)}}</span>
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                    </div>
                  <p>{{$detail_product->description}}</p>
                    {{-- <h4>Size</h4>
                    <div class="aa-prod-view-size">
                      <a href="#">S</a>
                      <a href="#">M</a>
                      <a href="#">L</a>
                      <a href="#">XL</a>
                    </div> --}}
                    <div class="aa-prod-quantity">
                        @if($detail_product->stock >0)
                      <form action="{{route('addToCart')}}" method="POST" role="form">
                          @csrf
                          <input type="hidden" name="product_id" value="{{$detail_product->id}}">
                          <input type="hidden" name="product_name" value="{{$detail_product->product_name}}">
                          <input type="hidden" name="price" value="{{$detail_product->price}}" id="dynamicPriceInput">
                          <input type="hidden" name="stock" value="{{$detail_product->stock}}">
                  
                        <input class="form-control" type="number" name="quantity" >
                      <p class="aa-prod-category">
                          @foreach($kat as $kat)
                      Category: <a href="#">{{$kat->category_name}}</a>
                          @endforeach
                      </p>
                    </div>
      
                    <div class="aa-prod-view-bottom">
                      
                        <button class="aa-add-to-cart-btn" > Add to cart</button>
                      </form>
                      @endif
                      <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                      <a class="aa-add-to-cart-btn" href="#">Compare</a>
                          
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
    <div class="category-tab shop-details-tab"><!--category-tab-->
      <div class="col-sm-12">
          <ul class="nav nav-tabs">
              <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
              {{-- <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
              <li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li> --}}
          </ul>
      </div>
      <div class="tab-content" id="reviews">
          <div class="tab-pane fade active in"  >
              <div class="container">
                  <div class="row">
                      <div class="col-sm-9">
                  @foreach($review as $review)
                      <p><b>{{$review->name}}</b></p>
                      @php
                          $a = 5;
                      @endphp
                      @for($i=0 ; $i< $review->rate; $i++)
                          @php
                              $a = $a-1;
                          @endphp
                          <span style="color: gold;" class="fa fa-star checked"></span>
                      @endfor
                      @for($i=0 ; $i< $a; $i++)
                          <span style="color: grey;" class="fa fa-star"></span>
                      @endfor
                      <input style="background-color: white;" type="text" readonly="" class="form-control" value="{{$review->content}}">
                      <hr>

                  @endforeach
                  </div>
                  </div>
              </div>
          </div> 
          <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                                <span>
                                    <input type="text" placeholder="Your Name"/>
                                    <input type="email" placeholder="Email Address"/>
                                </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="{{asset('frontEnd/images/product-details/rating.png')}}" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div> 
    
@endsection