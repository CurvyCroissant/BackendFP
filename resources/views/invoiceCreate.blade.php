@extends('layouts.main')

@section('container')
    <h1>Create Invoice</h1>
    <br>
    <h3>Invoice ID: {{ $cart->id }}</h3>
    <br>

    <form action="{{ route('invoice.store', ['cart' => $cart->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @foreach ($cart->item as $item)
            @if ($item->quantity > 0)
                <ul>
                    <li>
                        <h5>{{ $item->name }}</h5>
                    </li>
                </ul>

                <div class="mb-2">
                    <label for="category" class="form-label">Category:</label>
                    <input type="text" class="form-control" id="category" name="category"
                        value="{{ $item->category->name }}" disabled>
                </div>
                <div class="mb-2">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <select class="form-select" id="quantity" name="quantity" required onchange="updateSubtotal()">
                        @for ($i = 0; $i <= $item->quantity; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <label for="subtotal" class="form-label">Sub-Total:</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" class="form-control" id="subtotal" name="subtotal"
                            value="{{ $item->price * old('quantity') }}" disabled>
                    </div>
                </div>
                <br>
            @else
                <ul>
                    <li>
                        <h5>{{ $item->name }}</h5>
                    </li>
                </ul>
                <h5>Item is out of stock! Please wait for admin to restock.</h5>
            @endif
        @endforeach
        <br>
        <div class="mb-2">
            <label for="sender_address" class="form-label">Sender Address:</label>
            <input type="text" class="form-control" id="sender_address" name="sender_address" required>
        </div>
        <div class="mb-2">
            <label for="post_code" class="form-label">Post Code:</label>
            <input type="text" class="form-control" id="post_code" name="post_code" required>
        </div>
        <div class="mb-2">
            <label for="total" class="form-label"><strong>Total:</strong></label>
            <div class="input-group">
                <span class="input-group-text">Rp.</span>
                <input type="text" class="form-control" id="total" name="total" value="{{ $invoice->total }}"
                    disabled>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Create</button>
    </form>

    <script>
        function updateSubtotal() {
            var quantity = document.getElementById('quantity').value;
            var price = {{ $item->price }};
            var subtotal = quantity * price;
            document.getElementById('subtotal').value = subtotal;
        }
    </script>
    <br>
    <br>
@endsection
