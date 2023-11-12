@extends('clients.buyer.master')
@section('title', 'Detail Penjual')

@section('childs')
    <main class="main">
        <div class="section-box">
            <div class="breadcrumbs-div">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a class="font-xs color-gray-1000" href="{{ route('buyer.home') }}">Beranda</a></li>
                        <li><a class="font-xs color-gray-500" href="{{ route('buyer.allSeller') }}">Semua Penjual</a></li>
                        <li><a class="font-xs color-gray-500"
                                href="{{ route('buyer.detailSeller', ['slug' => $seller->seller_slug]) }}">Detail
                                Penjual</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section-box shop-template mt-30">
            <div class="container">
                <div class="d-flex box-banner-vendor col-12">
                    <div class="vendor-left">
                        <div class="banner-vendor"><img src="{{ asset('ecom/imgs/page/vendor/featured.png') }}"
                                alt="Ecom">
                            <div class="d-flex box-info-vendor">
                                <div class="avarta"><img class="mb-5"
                                        src="{{ asset('ecom/imgs/page/vendor/fasfox.png') }}" alt="Ecom"><a
                                        class="btn btn-buy font-xs"
                                        href="{{ route('buyer.allGridProduct') }}">{{ $seller->products_count ? moneyFormat($seller->products_count) ?? 0 : 0 }}
                                        Produk</a></div>
                                <div class="info-vendor">
                                    <h4 class="mb-5">Fasfox Coporation</h4><span
                                        class="font-xs color-gray-500 mr-20">sejak 2012</span>
                                    <div class="rating d-inline-block"><img
                                            src="{{ asset('ecom/imgs/template/icons/star.svg') }}" alt="Ecom"><span
                                            class="font-xs color-gray-500"> (65)</span></div>
                                </div>
                                <div class="vendor-contact">
                                    <div class="row">
                                        <div class="col-xl-7 col-lg-12">
                                            <div class="d-inline-block font-md color-gray-500 location mb-10">5171 W
                                                Campbell Ave undefined Kent, Utah 53127 United States</div>
                                        </div>
                                        <div class="col-xl-5 col-lg-12">
                                            <div class="d-inline-block font-md color-gray-500 phone">(+91) -
                                                540-025-124553<br>(+91) - 540-025-235688</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vendor-right">
                        <div class="box-featured-product">
                            <div class="item-featured">
                                <div class="featured-icon"><img src="{{ asset('ecom/imgs/page/product/delivery.svg') }}"
                                        alt="Ecom"></div>
                                <div class="featured-info"><span class="font-sm-bold color-gray-1000">Pengiriman
                                        gratis</span>
                                    <p class="font-sm color-gray-500 font-medium">Semua pesanan di atas 5 Juta</p>
                                </div>
                            </div>
                            <div class="item-featured">
                                <div class="featured-icon"><img src="{{ asset('ecom/imgs/page/product/support.svg') }}"
                                        alt="Ecom"></div>
                                <div class="featured-info"><span class="font-sm-bold color-gray-1000">Bantuan 24/7</span>
                                    <p class="font-sm color-gray-500 font-medium">Berbelanja dengan ahlinya</p>
                                </div>
                            </div>
                            <div class="item-featured">
                                <div class="featured-icon"><img src="{{ asset('ecom/imgs/template/voucher.svg') }}"
                                        alt="Ecom"></div>
                                <div class="featured-info"><span class="font-sm-bold color-gray-1000">Kupon hadiah</span>
                                    <p class="font-sm color-gray-500 font-medium">Ajak teman</p>
                                </div>
                            </div>
                            <div class="item-featured">
                                <div class="featured-icon"><img src="{{ asset('ecom/imgs/template/secure.svg') }}"
                                        alt="Ecom"></div>
                                <div class="featured-info"><span class="font-sm-bold color-gray-1000">Dana Kembali</span>
                                    <p class="font-sm color-gray-500 font-medium">100% Terlindungi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 order-first order-lg-last">
                        <div class="box-filters mt-0 pb-5 border-bottom">
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 mb-10 text-lg-start text-center"><a
                                        class="btn btn-filter font-sm color-brand-3 font-medium" href="#ModalFiltersForm"
                                        data-bs-toggle="modal">Filter</a></div>
                                <div class="col-xl-10 col-lg-9 mb-10 text-lg-end text-center"><span
                                        class="font-sm color-gray-900 font-medium border-1-right span">Menampilkan
                                        {{ count($products) > 0 ? count($products) : 0 }} hasil</span>
                                    <div class="d-inline-block"><span
                                            class="font-sm color-gray-500 font-medium">Berdasarkan:</span>
                                        <div class="dropdown dropdown-sort">
                                            <button class="btn dropdown-toggle font-sm color-gray-900 font-medium"
                                                id="dropdownSort" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">Produk Terbaru</button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort"
                                                style="margin: 0px;">
                                                <li><a class="dropdown-item active" href="#">Produk Terbaru</a></li>
                                                <li><a class="dropdown-item" href="#">Produk Terlama</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- <div class="d-inline-block"><span class="font-sm color-gray-500 font-medium">Show</span>
                                        <div class="dropdown dropdown-sort border-1-right">
                                            <button class="btn dropdown-toggle font-sm color-gray-900 font-medium"
                                                id="dropdownSort2" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false" data-bs-display="static"><span>30
                                                    items</span></button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2">
                                                <li><a class="dropdown-item active" href="#">30 items</a></li>
                                                <li><a class="dropdown-item" href="#">50 items</a></li>
                                                <li><a class="dropdown-item" href="#">100 items</a></li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-20">
                            @if (count($products) > 0)
                                @foreach ($products as $prd)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                        @include('clients.buyer.components.list_product1')
                                    </div>
                                @endforeach
                            @else
                                <div class="col-lg-12 text-center mt-40">
                                    <h4>Tidak ada data Produk saat ini</h4>
                                </div>
                            @endif
                        </div>
                        @if (count($products) > 0)
                            {{ $products->onEachSide(3)->links() }}
                        @endif
                        {{-- <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link page-prev" href="#"></a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link active" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item"><a class="page-link page-next" href="#"></a></li>
                            </ul>
                        </nav> --}}
                    </div>
                    <div class="col-lg-3 order-last order-lg-first">
                        <div class="sidebar-border mb-0">
                            <div class="sidebar-head">
                                <h6 class="color-gray-900">Kategori Produk</h6>
                            </div>
                            <div class="sidebar-content">
                                @if (count($data['categories_product']) > 0)
                                    <ul class="list-nav-arrow">
                                        @foreach ($data['categories_product'] as $ct)
                                            <li class="{{ request()->input('category_id') == $ct->id ? 'active' : '' }}">
                                                <a class="{{ request()->input('category_id') == $ct->id ? 'active' : '' }}"
                                                    href="{{ route('buyer.allGridProduct', ['category_id' => $ct->id]) }}">{{ $ct->name ?? '' }}<span
                                                        class="number">{{ $ct->products_count }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="col-lg-12 text-center">
                                        <p>Tidak ada kategori</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('clients.buyer.layouts.benefit')

        <div class="modal fade" id="ModalFiltersForm" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content apply-job-form">
                    <div class="modal-header">
                        <h5 class="modal-title color-gray-1000 filters-icon">Filter Tingkat Lanjut
                        </h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-30">
                        <div class="row">
                            <div class="col-w-1">
                                <h6 class="color-gray-900 mb-0">Harga</h6>
                                <ul class="list-checkbox">
                                    <li>
                                        <label class="cb-container">
                                            <input type="radio" name="price" value="tertinggi"
                                                {{ request()->get('price') && request()->get('price') == 'tertinggi' ? 'checked' : '' }}><span
                                                class="text-small">Harga Tertinggi</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cb-container">
                                            <input type="radio" name="price" value="terendah"
                                                {{ request()->get('price') && request()->get('price') == 'terendah' ? 'checked' : '' }}><span
                                                class="text-small">Harga
                                                Terendah</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-w-1">
                                <h6 class="color-gray-900 mb-0">Rating</h6>
                                <ul class="list-checkbox">
                                    <li>
                                        <label class="cb-container">
                                            <input type="radio" name="rating" value="tertinggi"
                                                {{ request()->get('rating') && request()->get('rating') == 'tertinggi' ? 'checked' : '' }}><span
                                                class="text-small">Rating Tertinggi</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cb-container">
                                            <input type="radio" name="rating" value="terendah"
                                                {{ request()->get('rating') && request()->get('rating') == 'terendah' ? 'checked' : '' }}><span
                                                class="text-small">Rating
                                                Terendah</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-w-1">
                                <h6 class="color-gray-900 mb-0">Berdasarkan</h6>
                                <ul class="list-checkbox">
                                    <li>
                                        <label class="cb-container">
                                            <input type="radio" name="orderBy" value="desc"
                                                {{ !request()->get('orderBy') || (request()->get('orderBy') && request()->get('orderBy') == 'desc') ? 'checked' : '' }}><span
                                                class="text-small">Produk Terbaru</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cb-container">
                                            <input type="radio" name="orderBy" value="asc"
                                                {{ request()->get('orderBy') && request()->get('orderBy') == 'asc' ? 'checked' : '' }}><span
                                                class="text-small">Produk Terlama</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-start pl-30"><a class="btn btn-buy w-auto"
                            href="#">Terapkan Filter</a><a class="btn font-sm-bold color-gray-500"
                            href="{{ route('buyer.detailSeller', ['slug' => $seller->seller_slug]) }}">Setel Ulang Filter</a></div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('importjs')
@endpush
