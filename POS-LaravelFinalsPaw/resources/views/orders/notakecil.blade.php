@extends('layouts.admin')

@section('title', 'Orders List')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Nota Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: left;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 200px;height=1000px;">
            <h3 align="center" style="font-family: Verdana, Geneva, Tahoma, sans-serif"><b><u>{{ config('settings.app_name') }}</u></b></h3>
            <h6 align="center">{{config('settings.app_description')}}</h6>
            <h4>Nota Penjualan</h4>
            <p>Order ID: {{ $order->id }}</p>
            <p>Tanggal: {{ $order->created_at->format('d/m/Y') }}</p>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>Total Harga : {{ number_format($order->items->sum(function ($item) { return $item->quantity * $item->price; }), 2) }}</p>
            <p>Total Bayar : {{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</p>
            <p>Kembalian : {{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</p>
        </div>
    </div>
</body>
</html>
@endsection
