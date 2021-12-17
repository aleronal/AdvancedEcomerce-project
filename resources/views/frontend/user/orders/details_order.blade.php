@extends('frontend.main_master')
@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
               @include('frontend.common.user_sidebar')
                {{--There is a inside user_sidebar col-md2 --}}
                <hr>
                
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Shipping Details</h4>
                        </div>
                    <hr>
                        <div class="card-body" style="background-color: #E9EBEC">
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
                </div>

                {{-- Second --}}
                <div class="col-md-5">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Order Details: Invoice:
                            <span class="text-danger">{{$order->invoice_number }}</span></h4>
                            </div>
                            <hr>
                            <div class="card-body" style="background-color: #E9EBEC">
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
                                    <th> {{$order->amount}}</th>
                                    </tr>
                                    <tr>
                                        <th> Order Status</th>
                                        <th> <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{$order->status}}</span></th>
                                    </tr>
                                    
                                </table>
    
                            </div>
                            
                        </div>
                    </div>
                    {{-- end col-md-5 --}}

                    {{-- item --}}
                   
    <div class="row">
            <div class="col-md-12 text-center ">
                    <h1>Products Details</h1>
                </div>
            <div class="col-md-12 ">
                   
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr style="background-color: #e2e2e2;">
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
                                    <td class="col-md-1">
                                        <label for="">Download</label>
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

                                    @php
                                        $file = App\Models\Product::where('id', $item->product_id)->first();
                                    @endphp

                                    <td class="col-md-1">
                                        @if ($order->status == "Pending")
                                        <strong>
                                            <span class="badge badge-pill badge-success">No File</span>
                                        </strong>
                                        @elseif($order->status == "Confirmed")

                                    <a target="_blank" href="{{ asset('upload/pdf/'. $file->digital_file) }}">
                                            <strong>
                                                <span class="badge badge-success" style="background:darkblue">Download Now</span>
                                            </strong>
                                        </a>


                                            
                                        @endif
                                        </label>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>

    </div>
                    {{-- item row --}}

                @if ($order->status !== "Delivered")

            

                @else

                @php
                    $condition = App\Models\Order::where('id', $order->id)->where('return_reason', '=', NULL)->first();
                @endphp

                @if ($condition)
                    
                <form action="{{route('return-order',$order->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="label"> Order Return Reason</label>
                        <textarea class="form-control" name="return_reason" cols="30" rows="05" placeholder="Return Reason"></textarea>
                    </div> 
                    <button type="submit" class="btn btn-danger">Submit</button>
                    <br>
                </form> 
                @else

                <span class="badge badge-pill badge-warning" style="background:red"> You have sent a return request for this Product</span>
                <br>
                @endif

                    
                @endif
                <br>
       
                    

            
            </div> 
            {{-- end row --}}
        </div>
    </div>

@endsection