@extends('main.master')

@section('title', 'Create Order')

@section('content')
    <div class="content-body">
        <div class="container">

            <!-- Page Title & Breadcrumb -->
            <div class="row page-titles">
                <div class="col p-0">
                    <h4>Create Order</h4>
                </div>
                <div class="col p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active">Create Order</li>
                    </ol>
                </div>
            </div>

            <!-- Create Product Form Section -->
            <div class="row">
                <div class="col-lg-12">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Add New Order</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <select name="product" id="product" class="form-control">
                                        <option disabled selected>--select--</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                                {{ old('product') == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="billing">Billing</label>
                                    <select name="billing" class="form-control">
                                        <option disabled selected>--select--</option>
                                        @foreach ($billing as $bill)
                                            <option value="{{ $bill->id }}"
                                                {{ old('billing') == $bill->id ? 'selected' : '' }}>{{ $bill->cycle_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('billing')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control"
                                        value="1">
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total_price">Total Price</label>
                                    <input type="number" name="total_price" id="total_price" disabled value="0"
                                        class="form-control">
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Save Order</button>
                                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('customScript')
    <script>
        let product = document.getElementById('product');
        let quantity = document.getElementById('quantity');
        let totalPrice = document.getElementById('total_price');

        product.addEventListener('change', function() {
            console.log(calculateTotalPrice());
        });
        quantity.addEventListener('change', function() {
            console.log(calculateTotalPrice());
        });

        function calculateTotalPrice() {
            let selectedOption = product.options[product.selectedIndex];
            let price = selectedOption.getAttribute('data-price');

            totalPrice.value = price * quantity.value;
        }
    </script>
@endsection
