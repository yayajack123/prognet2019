@extends('layout.layout1')
@section('title','Welcome')
@section('page','Welcome')
@section('content')
<!-- Products section -->
<section id="aa-product">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="aa-product-area">
            <div class="aa-product-inner">
              <!-- start prduct navigation -->
               <ul class="nav nav-tabs aa-products-tab">
                  <li class="active"><a href="#men" data-toggle="tab">Men</a></li>
                  <li><a href="#women" data-toggle="tab">Women</a></li>
                  <li><a href="#sports" data-toggle="tab">Sports</a></li>
                  <li><a href="#electronics" data-toggle="tab">Electronics</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
   <!-- Start men product category -->
   <div class="tab-pane fade in active" id="men">
    <ul class="aa-product-catg">
      <!-- start single product item -->
      @if(isset($index) && $index->count())
      @foreach ($index as $item)
      <li>
          <figure>
            <a class="aa-product-img" href="#"><img src="{{asset('images/'.$item['image_name']) }}" width="100%" height="auto" alt="polo shirt img"></a>
            <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
              <figcaption>
              <h4 class="aa-product-title"><a href="#">{{$item->product_name}}</a></h4>
              <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
            </figcaption>
          </figure>                        
          <div class="aa-product-hvr-content">
            <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
            <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                          
          </div>
          <!-- product badge -->
          <span class="aa-badge aa-sale" href="#">SALE!</span>
        </li>    
      @endforeach
      @endif
      
                              
    </ul>
    <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
  </div>
  <!-- / men product category --> 
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
    