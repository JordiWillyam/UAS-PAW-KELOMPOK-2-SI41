@extends('layouts.admin')

@section('title', 'Orders List')
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
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 200px;height=1000px;" align="center">
        <h3 align="center" style="font-family: Verdana, Geneva, Tahoma, sans-serif"><b><u>{{ config('settings.app_name') }}</u></b></h3>
        <h6 align="center">{{config('settings.app_description')}}</h6>
        </br>
        <h4 align="center"><b>Laporan Data Stok Barang</b></h4>
    </div>
        <form action="{{route('products.cetak')}}">
            <div class="row">
                <div class="col-md-5">
                    <p>Dari Tanggal :</p>

                </div>
                <div class="col-md-5">
                    <p>Sampai Tanggal :</p>
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
                    <th>Name</th>
                    <th>Product Code</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Quantity Purchases</th>
                    <th>Quantity Orders</th>
                    {{-- <th>Status</th> --}}
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td align="center">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>

                    <td>{{ $product->barcode }}</td>
                    <td>{{ config('settings.currency_symbol') . number_format($product->price )}}</td>
                    <td align="center">{{ $product->quantity }}</td>
                    <td align="center">
                        {{$product->total()}}

                    </td>
                    <td align="center">
                        {{$product->totalcart()}}

                    </td>
                    {{-- <td><span class="right badge badge-{{ $product->status ? 'success' : 'danger' }}">{{ $product->status ? 'Active' : 'Inactive' }}</span></td> --}}
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>

                </tr>
                @endforeach

            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
</body>
</html>
@endsection
