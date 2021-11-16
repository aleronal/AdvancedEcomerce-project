@extends('admin.admin_master')

@section('admin')


    <div class="container-full">
      <!-- Content Header (Page header) -->
     
      <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Order Details</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            
                            <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
            <div class="col-md-6 col-12">
				<div class="box box-bordered border-primary">
				  <div class="box-header with-border">
					<h4 class="box-title"><strong>Shipping Details</strong> box</h4>
                  </div>
                  
                  <table class="table">
                    <tr>
                        <th> Shipping Name:</th>
                        <th> {{$order->name}}</th>
                    </tr>
                    <tr>
                        <th> Shipping Phone:</th>
                        <th> {{$order->phone}}</th>
                    </tr>
                    <tr>
                        <th> Shipping mail:</th>
                        <th> {{$order->email}}</th>
                    </tr>
                    <tr>
                        <th> Division</th>
                    <th> {{$order->division->division_name}}</th>
                    </tr>
                    <tr>
                        <th> District</th>
                        <th>{{$order->district->district_name}}</th>
                    </tr>
                    <tr>
                        <th> State</th>
                    <th> {{$order->state->state_name}}</th>
                    </tr>
                    <tr>
                        <th> Post Code</th>
                        <th> {{$order->post_code}}</th>
                    </tr>
                    <tr>
                        <th> Order Date</th>
                    <th> {{$order->order_date}}</th>
                    </tr>

                </table>
				</div>
			  </div>
         
              <div class="col-md-6 col-12">
				<div class="box box-bordered border-primary">
				  <div class="box-header with-border">
					<h4 class="box-title"><strong>Order Details</strong> box</h4>
				  </div>
				  <table class="table">
                    <tr>
                        <th> Name:</th>
                        <th> {{$order->user->name}}</th>
                    </tr>
                    <tr>
                        <th> Phone:</th>
                        <th> {{$order->user->phone}}</th>
                    </tr>
                    <tr>
                        <th> Payment Type</th>
                        <th> {{$order->payment_method}}</th>
                    </tr>
                    <tr>
                        <th> Tranx Id</th>
                    <th> {{$order->transaction_id}}</th>
                    </tr>
                    <tr>
                        <th> Invoice</th>
                        <th>{{$order->invoice_number}}</th>
                    </tr>
                    <tr>
                        <th> Order Total</th>
                    <th> ${{$order->amount}}</th>
                    </tr>
                    <tr>
                        <th> Order Status</th>
                        <th> <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{$order->status}}</span></th>
                    </tr>
                    <tr>
                        <th> </th>
                        <th> 
                    @if ($order->status == 'Pending')
                        <a href="{{route('pending-confirmed', $order->id)}}" class="btn btn-block btn-success" id="confirmed">Confirm Order</a>

                    @elseif($order->status == 'Confirmed') 
                        <a href="{{route('confirmed-processed', $order->id)}}" class="btn btn-block btn-success" id="processing">Process Order</a>
                  

                    @elseif($order->status == 'Processed') 
                        <a href="{{route('processed-picked', $order->id)}}" class="btn btn-block btn-success" id="confirmed">Pick Order</a>

                    @elseif($order->status == 'Picked') 
                        <a href="{{route('picked-shipped', $order->id)}}" class="btn btn-block btn-success" id="confirmed">Ship Order</a>

                    @elseif($order->status == 'Shipped') 
                        <a href="{{route('shipped-delivered', $order->id)}}" class="btn btn-block btn-success" id="confirmed">Deliver Order</a>

                    @elseif($order->status == 'Delivered') 
                        <a href="{{route('delivered-canceled', $order->id)}}" class="btn btn-block btn-success" id="confirmed">Cancel Order</a>

                    @endif
                        </th>
                    </tr>
                    
                </table>
				</div>
              </div>
              
              <div class="col-md-12 col-12">
				<div class="box box-bordered border-primary">
				  <div class="box-header with-border">
					<h4 class="box-title"><strong>Products Details</strong> box</h4>
				  </div>
                  <table class="table">
                    <tbody>
                        <tr style="background-color: #272E48;">
                            <td class="col-md-1">
                                <label for="">Image</label>
                            </td>
                            <td class="col-md-3">
                                <label for="">Product Name</label>
                            </td>
                            <td class="col-md-3">
                                <label for="">Product Code</label>
                            </td>
                            <td class="col-md-2">
                                <label for="">Color</label>
                            </td>
                            <td class="col-md-1">
                                <label for="">Size</label>
                            </td>
                            <td class="col-md-1">
                                <label for="">Qty</label>
                            </td>
                            <td class="col-md-1">
                                <label for="">Price</label>
                            </td>
                        </tr>

                        @foreach ($order_item as $item)
                    
                        <tr>
                            <td class="col-md-1">
                            <label for=""><img src="{{asset($item->product->product_thumbnail)}}" alt="" height="50px;" width="50px;"></label>
                            </td>
                            <td class="col-md-3">
                                <label for="">{{$item->product->product_name_en}}</label>
                            </td>
                            <td class="col-md-3">
                                <label for="">{{$item->product->product_code}}</label>
                            </td>
                            <td class="col-md-2">
                                <label for="">{{$item->color}}</label>
                            </td>
                            <td class="col-md-1">
                                <label for="">{{$item->size}}</label>
                            </td>
                            <td class="col-md-1">
                                <label for="">{{$item->qty}}</label>
                            </td>
                            <td class="col-md-1">
                                <label for="">${{$item->price}}
                                (${{$item->price * $item->qty}})
                                </label>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
				</div>
			  </div>


    
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>

 


@endsection