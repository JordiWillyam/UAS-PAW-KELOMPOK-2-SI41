<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderSupplierStoreRequest;
use App\Models\OrderSupplier;
use App\Models\OrderSupplierItem;
use App\Models\PaymentSupplier;
use App\Models\Supplier;
use Illuminate\Http\Request;

class OrderSupplierController extends Controller
{
    public function index(Request $request) {
        $getDataSupplier = Supplier::all();
        $getordersupplieritems=OrderSupplierItem::all();
        $getpaymentsupplier=PaymentSupplier::all();
        $orderSupplier = new OrderSupplier();
        if($request->start_date) {
            $orderSupplier = $orderSupplier->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orderSupplier = $orderSupplier->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $orderSupplier = $orderSupplier->with(['items', 'payments', 'supplier'])->latest()->paginate(10);

        $total = $orderSupplier->map(function($i) {
            return $i->total();
        })->sum();
        $totalQuantity = $orderSupplier->map(function($i) {
            return $i->totalQuantity();
        })->sum();
        $receivedAmount = $orderSupplier->map(function($i) {
            return $i->receivedAmount();
        })->sum();


        return view('ordersuppliers.index', compact('orderSupplier', 'total','totalQuantity', 'receivedAmount'));
    }

    public function store(OrderSupplierStoreRequest $request)
    {
        dd($request);

        $orderSuppliers = OrderSupplier::create([
            'supplier_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $purchase = $request->user()->purchase()->get();
        foreach ($purchase as $item) {
            $orderSuppliers->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->purchase()->detach();
        $orderSuppliers->paymentSupplier()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return 'success';
    }

    public function cetak(Request $request){
        $orderSupplier = new OrderSupplier();
        if($request->start_date) {
            $orderSupplier = $orderSupplier->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orderSupplier = $orderSupplier->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $orderSupplier = $orderSupplier->with(['items', 'payments', 'supplier'])->latest()->paginate(10000);
        $total = $orderSupplier->map(function($i) {
            return $i->total();
        })->sum();
        $totalQuantity = $orderSupplier->map(function($i) {
            return $i->totalQuantity();
        })->sum();
        $receivedAmount = $orderSupplier->map(function($i) {
            return $i->receivedAmount();
        })->sum();


        return view('ordersuppliers.cetak', compact('orderSupplier', 'total','totalQuantity', 'receivedAmount'));
    }
    public function show($id)
    {
        // Logika untuk menampilkan resource tertentu berdasarkan $id
    }
}
