@extends('layouts.admin')

@section('title', 'Print Report')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
    <style>
        table.static{
            position: relative;
            border: 1px solid #543535;
        }
        .form-group {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-group">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" align="center" style="width: 200px;height=1000px;" >
        <h3 align="center" style="font-family: Verdana, Geneva, Tahoma, sans-serif"><b><u>{{ config('settings.app_name') }}</u></b></h3>
        <h6 align="center">{{config('settings.app_description')}}</h6>
        </br>
        <h4 align="center"><b>Laporan Data Pembelian</b></h4>
    </div>
        <form action="{{route('ordersupplier.cetak')}}">
            <div class="row">
                <div class="col-md-5">
                    <p>Start Date :</p>

                </div>
                <div class="col-md-5">
                    <p>End Date :</p>
                </div>
            </div>
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
        <p type="hidden"></p>
        <table class="static" align="center" rules="all" border="1px" style="width:95%;">
            <thead class="thead-dark">
                <tr align="center">
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    {{-- <th>Status</th> --}}
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderSupplier as $order)
                <tr>
                    <td align="center">{{$order->id}}</td>
                    <td > {{$order->getSupplierName()}}</td>
                    <td>
                        @foreach ($order->items as $item)
                        {{ $item->product->name }}
                        @endforeach
                    </td>
                    <td align="center">
                        @foreach ($order->items as $item)
                        {{$item->quantity }}  {{$item->product->unit}}</br>
                        @endforeach

                    </td>
                    <td>
                        @foreach ($order->items as $item)
                        {{ config('settings.currency_symbol') }}{{number_format($item->price )}}</br>
                        @endforeach

                    </td>
                    <td>{{ config('settings.currency_symbol') }} {{number_format($item->quantity*$item->price)}}</td>
                    {{-- <td>{{ config('settings.currency_symbol') }} {{number_format($item->quantity*$item->price)}}</td> --}}
                    {{-- <td>
                        <div class="container">
                            <span class="badge badge-danger" id="payment-status">Not Paid</span>
                            <button class="btn btn-primary" id="toggle-button">Toggle Payment Status</button>
                        </div>
                    </td> --}}
                    {{-- <td>{{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td> --}}
                    <td>{{$order->created_at}}</td>
                </tr>
                @endforeach
                <!-- Tampilkan link paginasi -->

            </tbody>
            <tfoot><!-- Log on to codeastro.com for more projects -->
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    {{-- <th>{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th> --}}
                    <th></th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
@endsection
