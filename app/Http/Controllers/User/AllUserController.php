<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AllUserController extends Controller
{
    public function MyOrders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        $user = User::find(Auth::user()->id);
        return view('frontend.user.orders.view_order', compact('orders','user'));
    }

    public function DetailsOrder($order_id)
    {
        $order = Order::with('division','district','state','user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $order_item = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('frontend.user.orders.details_order',compact('order', 'order_item'));

    }

    public function InvoiceDownload($order_id)
    {
        $order = Order::with('division','district','state','user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $order_item = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        // return view('frontend.user.orders.invoice_order',compact('order', 'order_item'));
        $pdf = PDF::loadView('frontend.user.orders.invoice_order', compact('order', 'order_item'));
        return $pdf->download('invoice.pdf');
    }

    public function ReturnOrder(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
        ]);

        $notification = array(
            'message' => 'Return Request Send Sucessfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.orders')->with($notification);

    }

    public function ReturnedOrderList()
    {
        $orders = Order::where('user_id', Auth::id())->where('return_reason','!=', NULL)->orderBy('id', 'DESC')->get();
        return view('frontend.user.orders.returned_orders_list',compact('orders'));
    }

    public function CancelledOrderList()
    {
        $orders = Order::where('user_id', Auth::id())->where('status', 'Cance   led')->orderBy('id', 'DESC')->get();
        return view('frontend.user.orders.cancelled_orders_list',compact('orders'));
    }
}
