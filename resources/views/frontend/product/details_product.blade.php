@extends('frontend.main_master')
@section('content')
@section('title')
{{$product->product_name_en}}
@endsection

<div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Clothing</a></li>
                    <li class='active'>Floral Print Buttoned</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                   
      
        
        
    <!-- ============================================== HOT DEALS ============================================== -->
    @include('frontend.common.hot_deals')
    <!-- ============================================== HOT DEALS: END ============================================== -->					
    
    <!-- ============================================== NEWSLETTER ============================================== -->
    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
        <h3 class="section-title">Newsletters</h3>
        <div class="sidebar-widget-body outer-top-xs">
            <p>Sign Up for Our Newsletter!</p>
            <form>
                 <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
                  </div>
                <button class="btn btn-primary">Subscribe</button>
            </form>
        </div><!-- /.sidebar-widget-body -->
    </div><!-- /.sidebar-widget -->
    <!-- ============================================== NEWSLETTER: END ============================================== -->
    
    <!-- ============================================== Testimonials============================================== -->
    <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
        <div id="advertisement" class="advertisement">
            <div class="item">
                <div class="avatar"><img src="assets/images/testimonials/member1.png" alt="Image"></div>
            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
            <div class="clients_author">John Doe	<span>Abc Company</span>	</div><!-- /.container-fluid -->
            </div><!-- /.item -->
    
             <div class="item">
                 <div class="avatar"><img src="assets/images/testimonials/member3.png" alt="Image"></div>
            <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
            <div class="clients_author">Stephen Doe	<span>Xperia Designs</span>	</div>    
            </div><!-- /.item -->
    
            <div class="item">
                <div class="avatar"><img src="assets/images/testimonials/member2.png" alt="Image"></div>
            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
            <div class="clients_author">Saraha Smith	<span>Datsun &amp; Co</span>	</div><!-- /.container-fluid -->
            </div><!-- /.item -->
    
        </div><!-- /.owl-carousel -->
    </div>
        
    <!-- ============================================== Testimonials: END ============================================== -->
    
     

            </div>
        </div><!-- /.sidebar -->

    <div class='col-md-9'>
    <div class="detail-block">
        <div class="row  wow fadeInUp">
                    
        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
        <div class="product-item-holder size-big single-product-gallery small-gallery">
    
        <div id="owl-single-product">

        @foreach ($multimage as $image)
            
        
        <div class="single-product-gallery-item" id="slide{{$image->id}}">
            <a data-lightbox="image-1" data-title="Gallery" href="{{asset($image->photo_name)}}">
                    <img class="img-responsive" alt="" src="{{ asset($image->photo_name) }}" data-echo="{{asset($image->photo_name) }}" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            @endforeach

            
    
            </div><!-- /.single-product-slider -->
    
    
            <div class="single-product-gallery-thumbs gallery-thumbs">
                
                <div id="owl-single-product-thumbnails">
                    @foreach ($multimage as $image)
                        
                   
                    <div class="item">
                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{$image->id}}">
                        <img class="img-responsive" width="85" alt="" src="{{asset($image->photo_name)}}" data-echo="{{asset($image->photo_name)}}" />
                        </a>
                    </div>
                    @endforeach
    
                    
                </div><!-- /#owl-single-product-thumbnails -->
    
                
    
            </div><!-- /.gallery-thumbs -->
    
        </div><!-- /.single-product-gallery -->
    </div><!-- /.gallery-holder -->    

        <div class='col-sm-6 col-md-7 product-info-block'>
            <div class="product-info">
                <h1  id="pname" class="name">{{$product->product_name_en}}</h1>
                
                <div class="rating-reviews m-t-20">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="rating rateit-small"></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="reviews">
                                <a href="#" class="lnk">(13 Reviews)</a>
                            </div>
                        </div>
                    </div><!-- /.row -->		
                </div><!-- /.rating-reviews -->
    
            <div class="stock-container info-container m-t-10">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="stock-box">
                            <span class="label">Availability :</span>
                        </div>	
                    </div>
                    <div class="col-sm-9">
                        <div class="stock-box">
                            <span class="value">In Stock</span>
                        </div>	
                    </div>
                </div><!-- /.row -->	
            </div><!-- /.stock-container -->
    
            <div class="description-container m-t-20">
                {{$product->short_description_en}}
            </div><!-- /.description-container -->

            <div class="price-container info-container m-t-20">
                <div class="row">
                    

            <div class="col-sm-6">
                    <div class="price-box">

                @if ($product->discount_price == null)
                    <span class="price">${{$product->selling_price}}</span>
                @else
                    <span class="price">${{$product->discount_price}}</span>
                    <span class="price-strike">${{$product->selling_price}}<span>   
                @endif
                        
                    </div>
            </div>
    
            <div class="col-sm-6">
                <div class="favorite-button m-t-10">
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                        <i class="fa fa-heart"></i>
                    </a>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                        <i class="fa fa-signal"></i>
                    </a>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                        <i class="fa fa-envelope"></i>
                    </a>
                </div>
            </div>
    
            </div><!-- /.row -->
        </div><!-- /.price-container -->
    
{{-- Add Color and Size --}}

<div class="row">
                    
    <div class="col-sm-6">

        @if ($product->product_size_en == NULL)
            
        @else

            <div class="form-group">
                <label class="info-title control-label">Choose Color</label>
                    <select id="color" class="form-control unicase-form-control selectpicker" style="display: none;">
                        <option selected="" disabled="">--Choose Color--</option>
                        @foreach ($product_color_en as $color)
            
                    <option value="{{$color}}">{{ucwords($color)}}</option>

                        @endforeach
                    
                    </select>
            </div>
        @endif
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label class="info-title control-label">Choose Size <span>*</span></label>
                <select id="size" class="form-control unicase-form-control selectpicker" style="display: none;">
                    <option selected="" disabled="">--Choose size--</option>
                    
                    @foreach ($product_size_en as $size)

                    <option value="{{$size}}">{{ucwords($size)}}</option>
    
                    @endforeach
                </select>
            </div>
    </div>

</div><!-- /.row -->

        {{-- end color and size --}}

                <div class="quantity-container info-container">
                    <div class="row">
                        
                        <div class="col-sm-2">
                            <span class="label">Qty :</span>
                        </div>
                        
                        <div class="col-sm-2">
                            <div class="cart-quantity">
                                <div class="quant-input">
                                    <div class="arrows">
                                        <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                        <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                    </div>
                                    <input type="number" class="form-control" id="qty" value="1" min="1">

                                </div>
                            </div>
                        </div>

                    <input type="hidden" id="product_id" value="{{ $product->id }}" min="1" >
    
                                        <div class="col-sm-7">
                                            <button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                        </div>
    
                                        
                                    </div><!-- /.row -->
                                </div><!-- /.quantity-container -->
    
                                
    
                                
    
                                
                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                    </div>
                    
<div class="product-tabs inner-bottom-xs  wow fadeInUp">
    <div class="row">
        <div class="col-sm-3">
            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                <li><a data-toggle="tab" href="#tags">TAGS</a></li>
            </ul><!-- /.nav-tabs #product-tabs -->
        </div>
<div class="col-sm-9">

    <div class="tab-content">
        
        <div id="description" class="tab-pane in active">
            <div class="product-tab">
                <p class="text">{!! $product->description_en !!}</p>
            </div>	
        </div><!-- /.tab-pane -->

        <div id="review" class="tab-pane">
            <div class="product-tab">
                                                        
                <div class="product-reviews">
                    <h4 class="title">Customer Reviews</h4>

            @php
            $reviews = App\Models\Review::where('product_id', $product->id)->where('status', '1')->latest()->limit(5)->get();
            @endphp

            
            <div class="reviews">

            @foreach ($reviews as $review)

            
            <div class="review">
                <div>
                    <div class="row">
                        <div class="col-md-3">
                        <img style="border-radius: 50%" src="{{ 
                        (!empty($review->user->profile_photo_path)) 
                        ? url('upload/user_images/'. $review->user->profile_photo_path)
                        : url('upload/no_image.jpg') }}" width="40px"; height="40px"; alt=""> {{$review->user->name}}
                        </div>
                        <div class="col-md-9">

                        </div>
                    </div>
                </div>
              
                   
                    <div class="review-title"><span class="summary">{{$review->summary}}</span><span class="date"><i class="fa fa-calendar"></i><span>{{Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span></span></div>
                    <div class="text">"{{$review->comment}}"</div>
                    </div>
            @endforeach
            </div><!-- /.reviews -->


                </div><!-- /.product-reviews -->
                

                
                <div class="product-add-review">
                    <h4 class="title">Write your own review</h4>
                    <div class="review-table">
                       
                    </div><!-- /.review-table -->
                   
            
            <div class="review-form">
                @guest

            <p><b>To Add Review. You Need to <a href="{{route('login')}}">Login</a> First </b></p>
                    
                @else


                <div class="form-container">
                <form role="form" class="cnt-form" method="POST" action="{{route('store-review')}}">
                    @csrf

                <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                    <input name="summary" type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
                                </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                    <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="" name="comment"></textarea>
                                </div><!-- /.form-group -->
                            </div>
                        </div><!-- /.row -->
                        
                        <div class="action text-right">
                            <button type="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                        </div><!-- /.action -->

                    </form><!-- /.cnt-form -->
                </div><!-- /.form-container -->
                @endguest

            </div><!-- /.review-form -->

                </div><!-- /.product-add-review -->										
                
            </div><!-- /.product-tab -->
        </div><!-- /.tab-pane -->

        <div id="tags" class="tab-pane">
            <div class="product-tag">
                
                <h4 class="title">Product Tags</h4>
                <form role="form" class="form-inline form-cnt">
                    <div class="form-container">
            
                        <div class="form-group">
                            <label for="exampleInputTag">Add Your Tags: </label>
                            <input type="email" id="exampleInputTag" class="form-control txt">
                            

                        </div>

                        <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
                    </div><!-- /.form-container -->
                </form><!-- /.form-cnt -->

                <form role="form" class="form-inline form-cnt">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                    </div>
                </form><!-- /.form-cnt -->

            </div><!-- /.product-tab -->
        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.product-tabs -->






                    <!-- ============================================== RELATED PRODUCTS ============================================== -->
    <section class="section featured-product wow fadeInUp">
        <h3 class="section-title">Related products</h3>
        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                
@foreach ($related_product as $product)
    

    <div class="item item-carousel">
        <div class="products">
            <div class="product">		
                <div class="product-image">
                    <div class="image">
                        <a href="{{url('product/details/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{asset($product->product_thumbnail)}}" alt=""></a>
                    </div><!-- /.image -->			

        <div class="tag sale"><span>sale</span></div>            		   
                </div><!-- /.product-image -->
                
            
        <div class="product-info text-left">
            <h3 class="name"><a href="{{url('product/details/'.$product->id.'/'.$product->product_slug_en) }}">{{$product->product_name_en}}</a></h3>
            <div class="rating rateit-small"></div>
                <div class="description">
                    {{$product->short_description_en}}
                </div>
                <div class="product-price"> 
                        @if ($product->discount_price == NULl)
                       <span class="price">{{ $product->selling_price }}</span>
                       @else
                       <span class="price">{{ $product->discount_price }}</span> 
                       <span class="price-before-discount">{{$product->selling_price}}</span> 
                       @endif
                </div><!-- /.product-price -->
                
        </div><!-- /.product-info -->
                <div class="cart clearfix animate-effect">
                    <div class="action">
                        <ul class="list-unstyled">
                            <li class="add-cart-button btn-group">
                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                    <i class="fa fa-shopping-cart"></i> 
                                </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>                          
                            </li>
                           
                            <li class="lnk wishlist">
                                <a class="add-to-cart" href="detail.html" title="Wishlist">
                                     <i class="icon fa fa-heart"></i>
                                </a>
                            </li>
    
                            <li class="lnk">
                                <a class="add-to-cart" href="detail.html" title="Compare">
                                    <i class="fa fa-signal"></i>
                                </a>
                            </li>
                        </ul>
                    </div><!-- /.action -->
                </div><!-- /.cart -->
                </div><!-- /.product -->
          
            </div><!-- /.products -->
        </div><!-- /.item -->
        

        @endforeach
        




       
           
        
          
                </div><!-- /.home-owl-carousel -->
    </section><!-- /.section -->
    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
                
                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->
        </div>
    </div>



@endsection