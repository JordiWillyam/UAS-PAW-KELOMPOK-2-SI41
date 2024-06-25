@extends('layouts.admin')

@section('title', 'Orders List')
@section('content-header', 'Order List')
@section('content-actions')
    <a href="{{route('penjualan.index')}}" class="btn btn-success"></i>Open Sale System</a>
    <a href="{{route('orders.cetak')}}" class="btn btn-warning"><i class="fas fa-print"></i>    Print Report</a>
@endsection

@section('content')
{{-- @if(session('cimory'))
    <span>{{session('cimory')}}</span>
@endif --}}
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-12">
                <form action="{{route('orders.index')}}">
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
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Received</th>
                    <th>Status</th>
                    <th>Remain.</th>
                    <th>Action</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    <td>
                        @foreach ($order->items as $item)
                        {{ $item->product->name }}</br>
                        @endforeach

                    </td>
                    <td>
                        @foreach ($order->items as $item)
                        {{$item->quantity }}</br>
                        @endforeach

                    </td>
                    <td>
                        @foreach ($order->items as $item)
                        {{ config('settings.currency_symbol') }}  {{number_format($item->price,2) }}</br>
                        @endforeach
                    </td>

                    <td>{{ config('settings.currency_symbol') }} {{number_format($item->price * $item->quantity)}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                    <td>
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">Not Paid</span>
                        @elseif($order->receivedAmount() < $order->total())
                            <span class="badge badge-warning">Partial</span>
                        @elseif($order->receivedAmount() == $order->total())
                            <span class="badge badge-success">Paid</span>
                        @elseif($order->receivedAmount() > $order->total())
                            <span class="badge badge-info">Change</span>
                        @endif
                    </td>
                    <td>{{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td>
                    <td><a href="{{ route('orders.notakecil',$order->id) }}" class="btn btn-success"><i class="fas fa-print"></i> Print Invoice</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-delete" type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
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
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                if (!confirm('Are you sure you want to delete this order?')) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
