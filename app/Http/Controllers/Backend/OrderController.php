<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    // Pending Orders

    public function OrdersDetails($order_id)
    {
        $order = Order::with('division','district','state','user')->where('id', $order_id)->first();
        $order_item = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();


        return view('backend.orders.order_details',compact('order', 'order_item'));
    }

    public function PendingOrders()
    {
        $orders = Order::where('status', 'Pending')->orderBy('id', 'DESC')->get();

        return view('backend.orders.pending_orders',compact('orders'));
    }

    public function ProcessingOrders()
    {
        $orders = Order::where('status', 'Processed')->orderBy('id', 'DESC')->get();

        return view('backend.orders.processing_orders',compact('orders'));
    }
   
    public function ConfirmedOrders()
    {
        $orders = Order::where('status', 'Confirmed')->orderBy('id', 'DESC')->get();

        return view('backend.orders.confirmed_orders',compact('orders'));
    }

    public function ConfirmedOrdersDetails($order_id)
    {
        $order = Order::with('division','district','state','user')->where('id', $order_id)->first();
        $order_item = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();


        return view('backend.orders.confirmed_order_details',compact('order', 'order_item'));
    }

    public function PickedOrders()
    {
        $orders = Order::where('status', 'Picked')->orderBy('id', 'DESC')->get();

        return view('backend.orders.picked_orders',compact('orders'));
    }

    public function ShippedOrders()
    {
        $orders = Order::where('status', 'Shipped')->orderBy('id', 'DESC')->get();

        return view('backend.orders.shipped_orders',compact('orders'));
    }

    public function DeliveredOrders()
    {
        $orders = Order::where('status', 'Delivered')->orderBy('id', 'DESC')->get();

        return view('backend.orders.delivered_orders',compact('orders'));
    }

    public function CanceledOrders()
    {
        $orders = Order::where('status', 'Canceled')->orderBy('id', 'DESC')->get();

        return view('backend.orders.canceled_orders',compact('orders'));
    }

    // update function to change status 

    public function PendingToConfirm($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update([
            'status' => 'Confirmed',
        ]);

        $notification = array(
            'message' => "Order Updated Succesfully",
            'alert-type' => 'success'
        ); 
        return redirect()->route('pending.orders')->with($notification);
    }   

    public function ConfirmedToProcessing($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update([
            'status' => 'Processed',
        ]);

        $notification = array(
            'message' => "Order Updated Succesfully",
            'alert-type' => 'success'
        ); 
        return redirect()->route('confirmed.orders')->with($notification);
    }

    public function ProcessingToPicked($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update([
            'status' => 'Picked',
        ]);

        $notification = array(
            'message' => "Order Updated Succesfully",
            'alert-type' => 'success'
        ); 
        return redirect()->route('processing.orders')->with($notification);
    }

    public function PickedToShipped($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update([
            'status' => 'Shipped',
        ]);

        $notification = array(
            'message' => "Order Updated Succesfully",
            'alert-type' => 'success'
        ); 
        return redirect()->route('picked.orders')->with($notification);
    }

    public function ShippedToDelivered($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update([
            'status' => 'Delivered',
        ]);

        $notification = array(
            'message' => "Order Updated Succesfully",
            'alert-type' => 'success'
        ); 
        return redirect()->route('shipped.orders')->with($notification);
    }

    public function DeliveredToCanceled($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update([
            'status' => 'Canceled',
        ]);

        $notification = array(
            'message' => "Order Updated Succesfully",
            'alert-type' => 'success'
        ); 
        return redirect()->route('delivered.orders')->with($notification);
    }

    public function AdminInvoiceDownload($order_id)
    {
        $order = Order::with('division','district','state','user')->where('id', $order_id)->first();
        $order_item = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = PDF::loadView('backend.orders.invoice_order', compact('order', 'order_item'));
        return $pdf->download('invoice.pdf');
    }
}
