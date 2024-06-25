@extends('layouts.admin')

@section('title', 'Purchase')
@section('content-header', 'Add Purchase')
@section('content-actions')
    <a href="{{route('suppliers.create')}}" class="btn btn-success mr-3"><i class="fas fa-plus"></i>Add Supplier</a>
    <a href="{{route('products.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Add Product</a>
@endsection

@section('content')
<div id="purchase">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="row mb-2">
                <div class="col">
                    <form id="barcodeForm">
                        <input type="text" class="form-control" placeholder="Scan Barcode..." id="barcode" />
                    </form>
                </div>
                <div class="col">
                    <select class="form-control" id="supplier_id">


                        <option value="" selected disabled >CASH</option>
                        @foreach($getData as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <form id="purchaseForm" method="POST" action="{{ route('purchase.store') }}">
                @csrf
                <input type="hidden" name="supplier_id" id="hiddenSupplierId">
                <input type="hidden" name="products" id="hiddenProducts">

                <div class="user-purchase">
                    <div class="card">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody id="purchase-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col">Total:</div>
                    <div class="col text-right" id="total-price">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-block" id="cancel-purchase">Cancel</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block" id="submit-purchase">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-lg-6 order-product" id="product-list">
            <div class="mb-2">
                @livewire('product-search')
            </div>
        </div>
    </div>
</div>

<script>
    const getDataProduk = @json($getDataProduk);

    document.getElementById('barcode').addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            const barcode = event.target.value;
            const product = getDataProduk.find(product => product.barcode === barcode);

            if (product) {
                klikShowData(product.name, product.price, product.id, product.quantity);
                event.target.value = '';
            } else {
                alert('Produk tidak ditemukan');
            }
        }
    });
    function klikShowData(productName, productPrice, productId) {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td data-product-id="${productId}">${productName}</td>
            <td>
                <input type="number" value="1" min="1" class="form-control d-inline-block" style="width: 60px;" onchange="updateTotalPrice()">
                <button class="btn btn-danger btn-sm d-inline-block" style="margin-left: 10px;" onclick="removeRow(this)">Hapus</button>
            </td>
            <td class="text-right">
                <input type="number" value="${productPrice.toFixed(2)}" min="1" class="form-control text-right" onchange="updateTotalPrice()">
            </td>
        `;
        document.getElementById('purchase-table-body').appendChild(newRow);
        updateTotalPrice();
    }

    function removeRow(button) {
        button.parentElement.parentElement.remove();
        updateTotalPrice();
    }

    function updateTotalPrice() {
        let totalPrice = 0;

        document.querySelectorAll('#purchase-table-body tr').forEach(row => {
            const quantity = row.querySelector('input[type="number"]').value;
            const price = parseFloat(row.querySelector('td:nth-child(3) input').value);
            totalPrice += quantity * price;
        });

        document.getElementById('total-price').textContent = totalPrice.toFixed(2);
    }
    document.getElementById('cancel-purchase').addEventListener('click', cancelPurchase);
    function cancelPurchase() {
        document.getElementById('purchase-table-body').innerHTML = '';
        document.getElementById('total-price').textContent = '0.00';
        document.getElementById('supplier_id').value = '';
        console.log("Purchase has been canceled and form has been reset.");
    }
    document.getElementById('purchaseForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const supplierId = document.getElementById('supplier_id').value;
        document.getElementById('hiddenSupplierId').value = supplierId;

        const products = [];
        const rows = document.querySelectorAll('#purchase-table-body tr');
        rows.forEach(row => {
            const product = {
                product_id: row.querySelector('td[data-product-id]').getAttribute('data-product-id'),
                quantity: row.querySelector('input[type="number"]').value,
                price: row.querySelector('td:nth-child(3) input').value,
            };
            products.push(product);

        });

        document.getElementById('hiddenProducts').value = JSON.stringify(products);
        console.log('Form Data:', {
            supplier_id: supplierId,
            products: products
        });

        this.submit();
    });
</script>

@endsection
