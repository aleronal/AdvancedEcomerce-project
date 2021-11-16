@extends('frontend.main_master')
@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
               @include('frontend.common.user_sidebar')
                {{-- inside user_sidebar col-md2 --}}
                <hr>
                <div class="col-md-8 col-md-offset-1">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr style="background-color: #e2e2e2;">
                                    <td class="col-md-1">
                                        <label for="">Date</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label for="">Total</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label for="">Payment</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Invoice</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Order</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label for="">Action</label>
                                    </td>
                                </tr>

                                @forelse ($orders as $order)
                            
                                <tr>
                                    <td class="col-md-1">
                                        <label for="">{{$order->order_date}}</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label for="">${{$order->amount}}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">{{$order->payment_method}}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">{{$order->invoice_number}}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">
                                            <span class="badge badge-pill badge-warning" style="background: #418DB9">
                                            {{$order->status}}</span>
                                            <span class="badge badge-pill badge-warning" style="background:red">
                                            Return Requested</span>

                                        </label>
                                    </td>
                                    <td class="col-md-1">
                                    <a class="btn btn-sm btn-primary" href="{{url('user/details-order/'.$order->id) }}"><i class="fa fa-eye"></i>View</a>

                                    <a target="_blank" href="{{ url('user/invoice_download/'.$order->id ) }}" style="margin-top:5px;"class="btn btn-sm btn-danger" ><i class="fa fa-download"></i>Invoice</a>
                                    </td>
                                </tr>

                                @empty
                                <h2 class="text-danger">No Cancelled Orders</h2>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


              

            
            </div> 
            {{-- end row --}}
        </div>
    </div>

@endsection