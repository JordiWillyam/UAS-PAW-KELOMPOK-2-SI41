<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index() {
        $penjualan = Order::with('customer', 'items')->get();
        $getData = Customer::all();
        $getDataProduk = Product::all();
        return view("penjualan.index", compact('getData', 'getDataProduk', 'penjualan'));
    }

public function store(Request $request)
{

    $products = $request->products;
    $dataArray = json_decode($products, true);
       $combinedProducts = [];
       foreach ($dataArray as $productData) {
           if (isset($combinedProducts[$productData['product_id']])) {
               $combinedProducts[$productData['product_id']]['quantity'] += $productData['quantity'];
           } else {
               $combinedProducts[$productData['product_id']] = $productData;
           }
       }

       foreach ($combinedProducts as $productData) {
           $product = Product::find($productData['product_id']);

           if ($productData['quantity'] > $product->quantity) {
               return back()->with(['error' => "Insufficient stock for product: {$product->name}. Available stock: {$product->quantity}"]);
           }
       }

    DB::beginTransaction();
    try {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $totalAmount = 0;
        foreach ($dataArray as $item) {
            $orderItem = new OrderItem();
            $orderItem->price = $item['price'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];

            $product = Product::find($item['product_id']);
            $product->quantity -= $item['quantity'];
            $product->save();

            $orderItem->save();
            $totalAmount += $item['quantity'] * $item['price'];
        }

        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->user_id = Auth::id();
        $payment->amount = $request->amount;
        $payment->save();

        DB::commit();
        return redirect()->route('penjualan.index')->with('success',"Sale Invoice created successfully.");
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with(['error' => 'An error occurred while saving the order.']);
    }
}
 }
