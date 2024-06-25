@extends('layouts.admin')

@section('title', 'Sales Page')
@section('content-header', 'Sales Page')

@section('content')

<div id="purchase">
    <div class="row">
        <div class="col-md-8 col-lg-6">
            <div class="row mb-2">
                <div class="col">
                    <form id="barcodeForm">
                        <input type="text" class="form-control" placeholder="Scan Barcode..." id="barcode" />
                    </form>
                </div>
                <div class="col">
                    <select class="form-control" id="customer_id">
                        <option value="" selected disabled >CASH</option>
                        @foreach($getData as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <form id="purchaseForm" method="POST" action="{{ route('penjualan.store') }}">
                @csrf
                <input type="hidden" name="customer_id" id="hiddenSupplierId">
                <input type="hidden" name="products" id="hiddenProducts">
                <input type="hidden" name="amount" id="hiddenPaymentAmount">

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
                    <div class="col" style="font-size: 22px">Total:</div>
                    <div class="col text-right" id="total-price" style="font-size: 22px">
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
        <div class="col-md-4 col-lg-6 order-product" id="product-list">
            <div class="mb-2">
                @livewire('product-search')
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    <div class="form-group">
                        <label for="totalModalPrice">Total :</label>
                        <input type="text" class="form-control" id="totalModalPrice" readonly style="font-size: 25px">
                    </div>
                    <div class="form-group">
                        <label for="paymentAmount">Payment Amount :</label>
                        <input type="number" class="form-control" id="paymentAmount" min="1" required style="font-size: 25px">
                    </div>
                    <div class="form-group">
                        <label for="changeAmount">Change :</label>
                        <input type="number" class="form-control" id="changeAmount" readonly style="font-size: 50px">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Payment</button>
                    </div>
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
                <input type="number" value="${productPrice.toFixed(2)}" min="1" class="form-control text-right" onchange="updateTotalPrice()" disabled style="font-size: 18px" >
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
            const quantity = parseFloat(row.querySelector('input[type="number"]').value);
            const price = parseFloat(row.querySelector('td:nth-child(3) input').value);
            totalPrice += quantity * price;
        });

        document.getElementById('total-price').textContent = `Rp ${totalPrice.toFixed(2)}`;
    }

    document.getElementById('cancel-purchase').addEventListener('click', cancelPurchase);
    function cancelPurchase() {
        document.getElementById('purchase-table-body').innerHTML = '';
        document.getElementById('total-price').textContent = '0.00';
        document.getElementById('customer_id').value = '';
    }

    function formatRupiah(angka) {
        const numberString = angka.toString();
        const sisa = numberString.length % 3;
        let rupiah = numberString.substr(0, sisa);
        const ribuan = numberString.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            const separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return 'Rp ' + rupiah;
    }

    document.getElementById('submit-purchase').addEventListener('click', function(event) {
        event.preventDefault();
        const totalPrice = parseFloat(document.getElementById('total-price').textContent.replace(/[^0-9.-]+/g, ""));

        document.getElementById('totalModalPrice').value = `Rp ${totalPrice.toFixed(2)}`;
        $('#paymentModal').modal('show');
    });

    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const totalPrice = parseFloat(document.getElementById('total-price').textContent.replace(/[^0-9.-]+/g, ""));
        const paymentAmount = parseFloat(document.getElementById('paymentAmount').value);

        if (paymentAmount < totalPrice) {
            alert('Uang Anda tidak Cukup !!! Mohon di isi Jumlah Uang yang Benar');
        } else {
            const changeAmount = paymentAmount - totalPrice;

            $('#paymentModal').modal('hide');
            document.getElementById('hiddenPaymentAmount').value = paymentAmount;

            const supplierId = document.getElementById('customer_id').value;
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

            document.getElementById('purchaseForm').submit();
        }
    });

    document.getElementById('paymentAmount').addEventListener('input', function() {
        const totalPrice = parseFloat(document.getElementById('total-price').textContent.replace(/[^0-9.-]+/g, ""));
        const paymentAmount = parseFloat(this.value);

        if (paymentAmount >= totalPrice) {
            const changeAmount = paymentAmount - totalPrice;
            document.getElementById('changeAmount').value = changeAmount.toFixed(2);
        } else {
            document.getElementById('changeAmount').value = '';
        }
    });

</script>

@endsection
