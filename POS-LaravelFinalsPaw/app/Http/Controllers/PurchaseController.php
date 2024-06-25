<?php
namespace App\Http\Controllers;

use App\Models\OrderSupplierItem;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\OrderSupplier;
use App\Models\PaymentSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $purchases = Purchase::with('supplier', 'orderSupplierItems')->get(); // Example relations
        $getData = Supplier::all();
        $getDataProduk = Product::all();
        return view("purchases.index", compact('getData', 'getDataProduk', 'purchases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     *
     */

     public function create()
     {
         return view('purchases.index');
     }
    public function store(Request $request)
    {

        // Validate the incoming request data
        // $data=$request->all();
        // $datafiks=$data =request()->except('_token');
        // dd($datafiks);
        // foreach ($data['productName'] as $index =>$nama_produk ){
        //     $quantity=$data['quantity'][$index];
        //     $price = $data['price'][$index];
        // }
        //dump($request);
        // echo $request->supplier_id;


        $products=$request->products;
        $dataArray = json_decode($products, true);

        $orderSupplier = OrderSupplier::create([
            'supplier_id' => $request->supplier_id,
            'user_id' => $request->user()->id,

        ]);
        $price=0;
        $totalAmount = 0;
        foreach ($dataArray as $item) {
            $orderSupplierItem = new OrderSupplierItem();
            $orderSupplierItem->price = $item['price'];
            $orderSupplierItem->quantity = $item['quantity'];
            $orderSupplierItem->ordersupplier_id = $orderSupplier->id;
            $orderSupplierItem->product_id = $item['product_id'];
            $product = Product::find($item['product_id']);

            $product->quantity += $item['quantity'];
            $product->save();
            $orderSupplierItem->save();

                // Calculate the total amount
            $totalAmount += $item['quantity'] * $item['price'];
        }


        $paymentSupplier = new PaymentSupplier();
        $paymentSupplier->ordersupplier_id = $orderSupplier->id;
        $paymentSupplier->user_id = Auth::id();
        $paymentSupplier->amount = $totalAmount;
        $paymentSupplier->save();
        return redirect()->route('purchases.index')->with('success', 'Purchase order created successfully.');


    }}
