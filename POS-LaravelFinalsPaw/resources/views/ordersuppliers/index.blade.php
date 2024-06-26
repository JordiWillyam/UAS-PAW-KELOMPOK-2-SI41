@extends('layouts.admin')

@section('title', 'Purchase List')
@section('content-header', 'Purchase List')
@section('content-actions')
    <a href="{{route('purchases.index')}}" class="btn btn-success" ><i class="fas fa-shopping-cart"></i> Open Purchase</a>
    <a href="{{route('ordersupplier.cetak')}}" class="btn btn-warning"><i class="fas fa-print"></i> Print Report</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('ordersuppliers.index')}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr align="center">
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderSupplier as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getSupplierName()}}</td>
                    <td><ol>
                        @foreach ($order->items as $item)
                        <li>{{ $item->product->name }}</li>
                        @endforeach
                    </ol>
                    </td>
                    <td>
                        @foreach ($order->items as $item)
                        {{$item->quantity }}   {{$item->product->unit}}</br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($order->items as $item)
                        {{ config('settings.currency_symbol') }}  {{number_format($item->price,2) }}</br>
                        @endforeach
                    </td>
                    <td>{{ config('settings.currency_symbol') }} {{number_format($item->price * $item->quantity,2)}}</td>
                    <td>{{$order->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orderSupplier->render() }}
    </div>
</div>
@endsection

