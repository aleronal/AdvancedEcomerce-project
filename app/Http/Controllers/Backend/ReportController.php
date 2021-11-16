<?php

namespace App\Http\Controllers\Backend;

use DateTime;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function ViewReport()
    {
        return view('backend.report.view_report');
    }

    public function ReportSearchByDate(Request $request)
    {
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        

        $orders = Order::where('order_date', $formatDate)->latest()->get();

        return view('backend.report.show_report', compact('orders'));
    }

    public function ReportSearchByMonth(Request $request)
    {
        $orders = Order::where('order_month', $request->month)->where('order_year', $request->year_name)->latest()->get();

        return view('backend.report.show_report', compact('orders'));
    }

    public function ReportSearchByYear(Request $request)
    {
        $orders = Order::where('order_year', $request->year)->latest()->get();

        return view('backend.report.show_report', compact('orders'));
    }
}

