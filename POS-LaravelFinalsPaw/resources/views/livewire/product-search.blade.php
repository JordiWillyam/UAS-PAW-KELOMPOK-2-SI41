<div>
    <input type="text" wire:model="search" placeholder="Cari Produk..." class="form-control mb-3">

    <div class="order-product" id="product-list">
        <div class="row">
            @foreach ($products as  $data)
                <div class="col-md-2 mb-2">
                    <div class="position-relative">
                        <span class="d-flex align-items-center mb-2" data-product-id="{{ $data->id }}" data-sb="">
                            <button onclick="klikShowData('{{ $data->name }}', {{ $data->price }}, {{ $data->id }},'{{ $data->imageUrl ?? '' }}')" class="btn btn-primary btn-sm w-100 position-relative" style="height: 120px; background-color: #fff; color: #000;">
                                <span class="sr-only">{{ $data->name }}</span>
                                <span class="sr-only">{{ $data->unit }}</span>
                                <div class="d-flex flex-column justify-content-center h-60">
                                    {{-- @if ($data->imageUrl)
                                        <img src="{{ $data->imageUrl }}" alt="{{ $data->name }}" style="max-height: 60px; max-width: 60px;">
                                    @else
                                        <span class="text-left">Product Image</span>
                                    @endif --}}
                                    <div class="text-center mt-auto" style="font-size: 15px; color: {{ $data->quantity < 1 ? 'red' : 'black' }}">{{ $data->name }}
                                        ({{$data->quantity}})</div>
                                </div>
                        </button>
                        </span>
                    </div>
                </div>
                {{-- @if (($key + 1) % 7 == 0)
                    </div><div class="row">
                @endif --}}
            @endforeach
        </div>
    </div>
</div>

