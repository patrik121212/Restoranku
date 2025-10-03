@extends('customer.layouts.master')

@section('content')
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (empty($cart))
                <h4 class="text-center">Keranjang anda kosong</h4>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Gambar</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subTotal = 0;
                            @endphp

                            @foreach ($cart as $item)
                                @php
                                    $itemTotal = $item['price'] * $item['qty'];
                                    $subTotal += $itemTotal;
                                @endphp

                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('img_item_upload/' . $item['image']) }}"
                                                    class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                    alt=""
                                                    onerror="this.onerror=null;this.src='{{ $item['image'] }}';">
                                            </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $item['name'] }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">{{ 'Rp' . number_format($item['price'], 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border"
                                                    onclick="updateQuantity('{{ $item['id'] }}', -1)">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>

                                            <input id="qty-{{ $item['id'] }}" type="text"
                                                class="form-control form-control-sm text-center border-0 bg-transparent"
                                                value="{{ $item['qty'] }}" readonly>

                                            <div class="input-group-btn">
                                                <button
                                                    class="btn btn-sm btn-plus rounded-circle bg-light border"onclick="updateQuantity('{{ $item['id'] }}', 1)">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">
                                            {{ 'Rp' . number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <button class="btn btn-md rounded-circle bg-light border mt-4"
                                            onclick="if(confirm('Apakah anda yakin ingin menghapus item ini?')) { removeItemFromCart('{{ $item['id'] }}') }">>
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.unsplash.com/photo-1543392765-620e968d2162?q=80&w=1987&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                alt="" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">Beef Burger</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">Rp40.000,00</p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border"
                                                    onclick="updateQuantity('{{ $item['id'] }}', -1)">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input id="qty-{{ $item['id'] }}" type="text"
                                                class="form-control form-control-sm text-center border-0 bg-transparent"
                                                value="{{ $item['qty'] }}" readonly>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">Rp40.000,00</p>
                                    </td>
                                    <td>
                                        <button class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                </tr> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @php
                    $tax = $subTotal * 0.1; // 10% tax
                    $total = $subTotal + $tax;
                @endphp
                <div class="d-flex justify-content-end">
                    <a href="{{ route('cart.clear') }}" class="btn btn-danger"
                        onclick=" return confirm('Apakah Anda yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</a>
                </div>
                <div class="row g-4 justify-content-end mt-1">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h2 class="display-6 mb-4">Total <span class="fw-normal">Pesanan</span></h2>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal</h5>
                                    <p class="mb-0">Rp{{ number_format($subTotal, 0, ',', '.') }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-0 me-4">Pajak (10%)</p>
                                    <div class="">
                                        <p class="mb-0">Rp {{ number_format($tax, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4 mb-4 border-top d-flex justify-content-between">
                                <h4 class="mb-0 ps-4 me-4">Total</h4>
                                <h5 class="mb-0 pe-4">Rp{{ number_format($total, 0, ',', '.') }}</h5>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="mb-3">
                                <a href="{{ route('checkout') }}"
                                    class="btn border-secondary py-3 text-primary text-uppercase mb-4" type="button">Lanjut
                                    ke
                                    Pembayaran</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
