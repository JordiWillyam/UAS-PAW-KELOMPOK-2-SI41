<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\OrderSupplierItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);

        $total = $orders->map(function($i) {
            return $i->total();
        })->sum();
        $totalQuantity = $orders->map(function($i) {
            return $i->totalQuantity();
        })->sum();
        $receivedAmount = $orders->map(function($i) {
            return $i->receivedAmount();
        })->sum();


        return view('orders.index', compact('orders', 'total','totalQuantity', 'receivedAmount'));
    }

    public function store(OrderStoreRequest $request)
    {

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $order->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $order->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return 'success';
    }

    public function cetak(Request $request){
        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10000);

        $total = $orders->map(function($i) {
            return $i->total();
        })->sum();
        $totalQuantity = $orders->map(function($i) {
            return $i->totalQuantity();
        })->sum();
        $receivedAmount = $orders->map(function($i) {
            return $i->receivedAmount();
        })->sum();


        return view('orders.cetak', compact('orders', 'total','totalQuantity', 'receivedAmount'));

    }
    public function cetakNota($id)
    {
        $order = Order::with('items')->find($id);
        $orders = new Order();
        $orders = $orders->with(['items', 'payments', 'customer'])->latest();
        $getData = Order::all();
        return view('orders.notakecil', compact('order'));

    }
    public function destroy($id)
    {
        try {
            // Find the order by ID
            $order = Order::findOrFail($id);

            // Delete the order
            $order->delete();

            // Redirect with success message
            return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->route('orders.index')->with('error', 'Order not found or could not be deleted.');
        }
    }
}
