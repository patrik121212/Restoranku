@extends('customer.layouts.master')
@section('content')
    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-3">
                        <div class="col-lg">
                            <div class="row g-4 justify-content-center">
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="https://images.unsplash.com/photo-1591325418441-ff678baf78ef"
                                                class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                            style="top: 10px; left: 10px;">Makanan</div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>Ichiraku Ramen</h4>
                                            <p class="text-limited">bowl of authentic Japanese noodles with rich broth,
                                                tender toppings, and fresh ingredients, perfect for warming your day!
                                            </p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">Rp25.000,00</p>
                                                <a href="#"
                                                    class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                        class="fa fa-shopping-bag me-2 text-primary"></i> Tambah
                                                    Keranjang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                <!-- <div class="col-12">
                                                    <div class="pagination d-flex justify-content-center mt-5">
                                                        <a href="#" class="rounded">&laquo;</a>
                                                        <a href="#" class="active rounded">1</a>
                                                        <a href="#" class="rounded">2</a>
                                                        <a href="#" class="rounded">3</a>
                                                        <a href="#" class="rounded">4</a>
                                                        <a href="#" class="rounded">5</a>
                                                        <a href="#" class="rounded">6</a>
                                                        <a href="#" class="rounded">&raquo;</a>
                                                    </div>
                                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection
