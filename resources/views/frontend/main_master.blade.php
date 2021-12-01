<!DOCTYPE html>
<html lang="en">

@php
    $seo = App\Models\Seo::find(1);
@endphp

<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="{{$seo->meta_description}}">
<meta name="csrf-token" content="{{csrf_token()}}">
<meta name="author" content="{{$seo->meta_author}}">
<meta name="keywords" content="{{$seo->meta_keyword}}">
<meta name="robots" content="all">
<title>@yield('title')</title>



<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/blue.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.transitions.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/rateit.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap-select.min.css') }} ">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome.css')}}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
{{-- TOASTR CDN CSS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
{{-- fontawesome CDN --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<script src="https://js.stripe.com/v3/"></script>

</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->

@include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->

@yield('content')

<!-- /#top-banner-and-menu --> 

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-hover-dropdown.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/echo.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.easing-1.3.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-slider.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.rateit.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/lightbox.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-select.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/scripts.js')}}"></script>

{{-- Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- Sweet Alert --}}

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>

      @if(Session::has('message'))
      var type = "{{ Session::get('alert-type','info') }}"
      switch(type){
        case 'info':
        toastr.info(" {{ Session::get('message') }} ");
        break;
        case 'success':
        toastr.success(" {{ Session::get('message') }} ");
        break;
        case 'warning':
        toastr.warning(" {{ Session::get('message') }} ");
        break;
        case 'error':
        toastr.error(" {{ Session::get('message') }} ");
        break;
      }

      @endif

  </script>


{{-- Add To Cart Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id=closeModel>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-md-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" id="pimage" src="" style="height:200px;" width="200px;" alt="Card image cap">

            </div>
          </div>

          <div class="col-md-4">
            <ul class="list-group">
              <li class="list-group-item">Product Price:<span class="text-danger" id="pprice">$</span>
                <del id="oldprice">$</del></li>
              

              <li class="list-group-item">Product Code: <span id="pcode" class="text-primary"></span></li></li>
              <li class="list-group-item">Category: <strong><span id="pcategory"></span></strong></li></li>
              <li class="list-group-item">Product Brand: <strong><span id="pbrand"></span></strong></li></li>
              <li class="list-group-item">Stock: 
{{-- available --}}
              <span class="badge bage-pill badge-success" id="available" style="background:green; color:white;"></span>
{{-- unavailable --}}
              <span class="badge bage-pill badge-danger" id="stockout" style="background:red; color:white;"></span>
            
            </li>
            </ul>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="color">Choose Color</label>
              <select class="form-control" id="color" name="color">
                
              </select>
            </div>
            <div class="form-group" id="sizeArea">
              <label for="size">Choose Size</label>
              <select class="form-control" id="size" name="size">
                <option>1</option>
                
              </select>
            </div>
            <div class="form-group">
              <label for="qty">Quantity</label>
              <input type="number" class="form-control" id="qty" value="1" min="1">
            </div>

            <input type="hidden" id="product_id">
            <button type="submit" onclick="addToCart()" id="" class="btn btn-primary mb-2">Add To Cart</button>
          </div>
        </div>



      </div>
     
    </div>
  </div>
</div>

{{-- Add To Cart Modal --}}
  <script type="text/javascript">
    $.ajaxSetup({
      headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
        }
    }) 
    // Start Product view with Model

    function productView(id)
    {
     
      $.ajax({
        type:'GET',
        url:'/produc/view/modal/'+id,
        dataType:'json',
        success:function(data){
          $('#pname').text(data.product.product_name_en);
          $('#price').text(data.product.selling_price);
          $('#pcode').text(data.product.product_code);
          $('#pcategory').text(data.product.category.category_name_en);
          $('#pbrand').text(data.product.brand.brand_name_en);
          $('#pimage').attr('src','/' + data.product.product_thumbnail);

          $('#product_id').val(id);
          $('#qty').val(1);
          
          


          // Price
          if(data.product.discount_price == null){

            $('#pprice').text('');
            $('#oldprice').text('');
            $('#pprice').text(data.product.selling_price);
          }else{
            $('#pprice').text(data.product.discount_price);
            $('#oldprice').text(data.product.selling_price);
          }
          // END Price

          // Stock 
            if(data.product.product_qty > 0 ){
              $('#available').text('');
              $('#stockout').text('');
              $('#available').text('available');
            }else{
              $('#available').text('');
              $('#stockout').text('');
              $('#stockout').text('stockout');
            }

          // End Stock


          // Color 
          $('select[name="color"]').empty();
          $.each(data.color, function(key, value){
                
            $('select[name="color"]').append('<option value=" '+value+' " >'+value+'</option>')
          })
          // END COLOR 

          // Size
          $('select[name="size"]').empty();
          $.each(data.size, function(key, value){
                
            $('select[name="size"]').append('<option value=" '+value+' " >'+value+'</option>')
            if(data.size == " "){
              $('#sizeArea').hide();
            }else{
              $('#sizeArea').show();

            }
          })
          // END SIZE

        } 
      })
    }
    // END Product View

    // Add To Cart Product



    // Add To Cart Product

    function addToCart()
    {
      var product_name = $('#pname').text();
      var id = $('#product_id').val();
      var color = $('#color option:selected').text();
      var size = $('#size option:selected').text();
      var quantity = $('#qty').val();

      $.ajax({
        type:'POST',
        dataType: 'json',
        data: {
          color: color,
          size: size,
          quantity: quantity,
          product_name : product_name
        },
        url: "/cart/data/store/" + id,
        success: function(data){
          miniCart()
          $('#closeModel').click();
          // Message Toastr

        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                  })
                if($.isEmptyObject(data.error)) {
                  Toast.fire({
                    type:'success',
                    title: data.success
                  }) 
                  }else{
                    toast.fire({
                      type:'error',
                      title: data.error
                    })
                  }
                    // end message
                }
      })
}

  </script>
  <script type="text/javascript">

    function miniCart()
    {
      $.ajax({
        type: 'GET',
        url: '/product/mini/cart',
        dataType: 'json',
        success: function(response){
         
          $('span[id="cartSubTotal"]').text(response.cartTotal);
          $('#cartQty').text(response.cartQty);
          var miniCart = ""
          
          $.each(response.cart, function(key, value){
            miniCart += `<div class="cart-item product-summary">
                        <div class="row">
                          <div class="col-xs-4">
                          <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                          </div>
                          <div class="col-xs-7">
                            <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                            <div class="price">${value.price} * ${value.qty}</div>
                          </div>
                          <div class="col-xs-1 action"> <button type="submit" id="${value.rowId}" onclick="minicartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
                        </div>
                      </div>
                      <!-- /.cart-item -->
                      <div class="clearfix"></div>
                      <hr> `
          });
          $('#miniCart').html(miniCart)
        }
      }) 
    }
miniCart();


// Mini Cart Remove Start

  function minicartRemove(rowId)
  {
    $.ajax({
      type: "GET",
      url:'/minicart/product-remove/' +rowId,
      dataType:'json',
      success: function(data){
        miniCart();
        // Star Message

        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                  })
                if($.isEmptyObject(data.error)) {
                  Toast.fire({
                    type:'success',
                    icon: 'success',
                    title: data.success
                  }) 
                  }else{
                    Toast.fire({
                      type:'error',
                      icon:'error',
                      title: data.error
                    })
                  }
      }
    })
  }

// Mini Cart Remove ENd
  </script>

{{-- Add To WishList --}}

  <script text="text/javascript">

    function addToWishlist(product_id)
    {
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "add/to/wishlist/"+ product_id,
        success:function(data){
          const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                       
                        showConfirmButton: false,
                        timer: 3000
                  })
                if($.isEmptyObject(data.error)) {
                  Toast.fire({
                    type:'success',
                    icon: 'success',
                    title: data.success
                  }) 
                  }else{
                    Toast.fire({
                      type:'error',
                      icon: 'error',
                      title: data.error
                    })
                  }
        }
      })
    }

  </script>

{{-- Add To WishList --}}

{{-- load Wishlist Data --}}
<script type="text/javascript">

function wishlist()
    {
      $.ajax({
        type: 'GET',
        url: '/user/get-wishlist-product',
        dataType: 'json',
        success: function(response){
          
        
          var rows = ""
          
          $.each(response, function(key, value){
            rows += `<tr>
                        <td class="col-md-2"><img src="/${value.product.product_thumbnail}" alt="imga"></td>
                        <td class="col-md-7">
                            <div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
                            
                            <div class="price">
                            ${value.product.discount_price == null
                             ? `${value.product.selling_price}`
                             : `${value.product.discount_price} 
                             <span>${value.product.selling_price}</span>
                             `
          }
                            </div>
                        </td>
                        <td class="col-md-2">
                            <button class="btn btn-primary icon" type="button" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)">Add To Cart<i class="fa fa-shopping-cart"></i></button>
                        </td>
                        <td class="col-md-1">
                            <button type="submit" id="${value.id}"  onclick="wishlistRemove(this.id)" href="#" class="btn btn-danger"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>`
          });
          $('#wishlist').html(rows)
        }
      }) 
    }
wishlist();

// {{-- load Wishlist Data --}}

// Wishlist Remove Item

function wishlistRemove(id)
  {
    $.ajax({
      type: "GET",
      url:'/user/wishlist-remove/' +id,
      dataType:'json',
      
      success: function(data){
        wishlist();
        // Star Message

        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                  })
                if($.isEmptyObject(data.error)) {
                  Toast.fire({
                    type:'success',
                    icon: 'success',
                    title: data.success
                  }) 
                  }else{
                    Toast.fire({
                      type:'error',
                      icon:'error',
                      title: data.error
                    })
                  }
      }
    })
  }

  // Wishlist Remove Item

</script>

{{-- load My Cart  --}}

<script type="text/javascript">

  function cart()
      {
        $.ajax({
          type: 'GET',
          url: '/user/get-cart-product',
          dataType: 'json',
          success: function(response){
            console.log(response)
          
            var rows = ""
            
            $.each(response.cart, function(key, value){
              rows += `<tr>
                          <td class="col-md-2"><img src="/${value.options.image}" alt="imga" style="width:60px; height:60px"></td>
                          <td class="col-md-2">
                              <div class="product-name"><a href="#">${value.name}</a></div>
                              
                              <div class="price">
                                  ${value.price}
                              </div>
                          </td>

                          <td class="col-md-2">
                              <strong>${value.options.color}</strong>
                          </td>
                          <td class="col-md-2">
                            ${value.options.size == null
                            ? `<span>...</span> `
                            : `<strong>${value.options.size}</strong>`                               
                            }
                              
                          </td>

                          <td class="col-md-2">
                            ${value.qty > 1
                            ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}"  onclick="CartDecrement(this.id)">-</button>`
                            
                            : `<button type="submit" class="btn btn-danger btn-sm" disabled>-</button>`
                            }
                           

                            <input type="text" id="" value="${value.qty}" min="1" max="100" disabled="" style="width:25px";>

                            <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}"  onclick="CartIncrement(this.id)">+</button>
                              
                          </td>

                          <td class="col-md-1">
                              <strong>$${value.subtotal}</strong>
                          </td>
                        
                          <td class="col-md-1">
                              <button type="submit" id="${value.rowId}"  onclick="CartRemove(this.id)"class="btn btn-danger"><i class="fa fa-times"></i></button>
                          </td>
                      </tr>`
            });
            $('#cartPage').html(rows)
          }
        }) 
      }
  cart();
  
  // {{-- load Cart Data --}}
  
  // Cart Remove Item
  
  function CartRemove(id)
    {
      $.ajax({
        type: "GET",
        url:'/user/cart-remove/' +id,
        dataType:'json',
        
        success: function(data){
          CouponCalculation();
          cart();
          miniCart();
          $('#couponField').show();
          $('#coupon_name').val('');
          // Start Message
  
          const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                    })
                  if($.isEmptyObject(data.error)) {
                    Toast.fire({
                      type:'success',
                      icon: 'success',
                      title: data.success
                    }) 
                    }else{
                      Toast.fire({
                        type:'error',
                        icon:'error',
                        title: data.error
                      })
                    }
        }
      })
    }
  
    // Cart Remove Item
  
  // Cart Increment

    function CartIncrement(rowId){
        $.ajax({
          type:'GET',
          url:"/cart-increment/" + rowId,
          dataType:'json',
          success:function(data){
            CouponCalculation();
            cart();
            miniCart();
          }
        });
    }

  // Cart Increment

  // Cart Decrement

  function CartDecrement(rowId){
        $.ajax({
          type:'GET',
          url:"/cart-decrement/" + rowId,
          dataType:'json',
          success:function(data){
            CouponCalculation();
            cart();
            miniCart();
          }
        });
    }
  


  </script>

  {{-- End Load my Cart --}}

  {{-- Coupon Section --}}

  <script type="text/javascript">

    function applyCoupon(){
      var coupon_name = $('#coupon_name').val();
    
      $.ajax({
        type:'POST',
        dataType:'json',
        data:{coupon_name: coupon_name},
        url:"{{ url('/coupon-apply') }}",
        success:function(data){
          CouponCalculation();
          if(data.validity == true){
            $('#couponField').hide();
          }
          const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                    })
                  if($.isEmptyObject(data.error)) {
                    Toast.fire({
                      type:'success',
                      icon: 'success',
                      title: data.success
                    }) 
                    }else{
                      Toast.fire({
                        type:'error',
                        icon:'error',
                        title: data.error
                      })
                    }
        }
      })
    }

    function CouponCalculation()
    {
      $.ajax({
        type:'GET',
        url:"{{ url('/coupon-calculation') }}",
        dataType:'json',
        success:function(data)
      
        {
          console.log(data);
          if(data.total){
            $('#couponCalField').html(
            `<tr>
                  <th>
                      <div class="cart-sub-total">
                          Subtotal<span class="inner-left-md">${data.total}</span>
                      </div>
                      <div class="cart-grand-total">
                          Grand Total<span class="inner-left-md">$${data.total}</span>
                      </div>
                  </th>
              </tr>`
            )
          }else{
            $('#couponCalField').html(
            `<tr>
                  <th>
                      <div class="cart-sub-total">
                          Subtotal<span class="inner-left-md">${data.subtotal}</span>
                      </div>
                      <div class="cart-sub-total">
                          Coupon<span class="inner-left-md">${data.coupon_name}</span>
                          <button type="submit" onclick="couponRemove()"<i class="fa fa-times"></i></button>
                      </div>
                      <div class="cart-sub-total">
                          Discount Amount<span class="inner-left-md">${data.discount_amount}</span>
                      </div>
                      <div class="cart-grand-total">
                          Grand Total<span class="inner-left-md">$${data.total_amount}</span>
                      </div>
                  </th>
              </tr>`
            )
            
          } //else end method
        }
      });
    }

    CouponCalculation();
  
// ----------------------------------------------------------------//

  function couponRemove(){
    $.ajax({
      type:'GET',
      url:"{{ url('/coupon-remove') }}",
      dataType:'json',
      success:function(data){
        CouponCalculation();
        $('#couponField').show();
        $('#coupon_name').val('');
        const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                    })
                  if($.isEmptyObject(data.error)) {
                    Toast.fire({
                      type:'success',
                      icon: 'success',
                      title: data.success
                    }) 
                    }else{
                      Toast.fire({
                        type:'error',
                        icon:'error',
                        title: data.error
                      })
                    }
      }
    });
  }
  
  </script>
  {{-- Coupon Section --}}


</body>
</html>