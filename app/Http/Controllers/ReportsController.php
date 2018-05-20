<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;

class ReportsController extends Controller
{
    public function getProductsReports()
    {
        $SQ = [];
        $orders = Order::pluck('cart')->toArray();
        // dd(unserialize($orders[0])->items[1]['qty']);
        foreach($orders as $order) {
            $order = unserialize($order);
            foreach($order->items as $item) {
                if(array_key_exists($item['item']['title'], $SQ)) {
                    $SQ[$item['item']['title']] += $item['qty'];
                } else {
                    $SQ[$item['item']['title']] = $item['qty'];
                }
            }
        }
        arsort($SQ);

        $products = Product::all();
        
        return view('admin.reports.products-reports', compact('SQ', 'products'));
    }
}
