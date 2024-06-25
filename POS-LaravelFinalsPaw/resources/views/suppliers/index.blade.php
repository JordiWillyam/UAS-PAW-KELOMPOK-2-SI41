@extends('layouts.admin')

@section('title', 'Suppliers')
@section('content-header', 'Suppliers')

@section('content')

<div class="card">
    <div class="card-body">
        <a href="{{ route('suppliers.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add Supplier</a>

        <form action="{{ route('suppliers.index') }}" method="GET" class="form-inline mb-3">
            <input type="text" name="search" placeholder="Search Supplier" class="form-control mr-2" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $suppliers->appends(['search' => request('search')])->links() }}
    </div>
</div>

@endsection
