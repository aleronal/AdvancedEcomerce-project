@extends('frontend.main_master')



@section('content')
@section('title')
  Order Tracking Page

@endsection

<link rel="stylesheet" href="{{asset('frontend/assets/css/track_order.css')}}">


<div class="container">
    <article class="card">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">
            

            <div class="row" style="margin-left:30px; margin-top:20px;">
                <div class="col-md-2 ">
                    <b>Invoice Number: </b>
                    {{$track->invoice_number}}
                </div>
                <div class="col-md-2">
                     <b>Order Date</b> 
                     {{$track->order_number}} 
                </div>
                <div class="col-md-2">
                    <b>Shipping By - {{$track->name}}</b> 
                    {{$track->division->division_name}}
                    {{$track->district->district_name}}  
                </div>
                <div class="col-md-2">
                    <b>User Mobile Number </b> <br>
                    {{$track->phone}} 
                </div>
                <div class="col-md-2">
                    <b>Payment Method </b><br> 
                    {{$track->payment_method}} 
                </div>
                <div class="col-md-2">
                    <b>Total Amount </b><br> 
                    ${{$track->amount}} 
                </div>


            </div>

            <div class="track">

        @if($track->status == "Pending")
            <div class="step active"> <span class="icon"> <i class="fa fa-search"></i> </span> <span class="text">Order Pending</span> </div>

        @elseif($track->status == "Confirmed")
            <div class="step active"> <span class="icon"> <i class="fa fa-search"></i> </span> <span class="text">Order Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order Confirmed</span> </div>

        @elseif($track->status == "Processing")
            <div class="step active"> <span class="icon"> <i class="fa fa-search"></i> </span> <span class="text">Order Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order Confirmed</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-walking"></i> </span> <span class="text"> Order Processing </span> </div>

        @elseif($track->status == "Picked")
            <div class="step active"> <span class="icon"> <i class="fa fa-search"></i> </span> <span class="text">Order Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order Confirmed</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-walking"></i> </span> <span class="text"> Order Processing </span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-ambulance"></i> </span> <span class="text">Order Picked</span> </div>
        @elseif($track->status == "Shipped" )
            <div class="step active"> <span class="icon"> <i class="fa fa-search"></i> </span> <span class="text">Order Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order Confirmed</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-walking"></i> </span> <span class="text"> Order Processing </span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-ambulance"></i> </span> <span class="text">Order Picked</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order Shipped</span> </div>
        @elseif($track->status == "Delivered")
            <div class="step active"> <span class="icon"> <i class="fa fa-search"></i> </span> <span class="text">Order Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order Confirmed</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-walking"></i> </span> <span class="text"> Order Processing </span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-ambulance"></i> </span> <span class="text">Order Picked</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order Shipped</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck-loading"></i> </span> <span class="text">Order Delivered</span> </div>
                
            @endif

     
            </div>


    
            <hr><br><br>
            
        </div>
    </article>
</div>





@endsection