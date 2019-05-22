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
                  
                        <input class="aa-cart-quantity" type="number" name="quantity" >
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
@endsection