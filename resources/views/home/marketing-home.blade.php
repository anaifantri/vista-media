@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Vendor start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">DATA VENDOR</label>
            </div>
            <div class="grid grid-cols-2 gap-2 w-[1200px] p-2">
                <a href="/marketing/vendor-categories"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center text-stone-200 font-serif text-md font-semibold">Katagori Vendor</span>
                </a>
                <a href="/marketing/vendors"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center text-stone-200 font-serif text-md font-semibold">Daftar Vendor</span>
                </a>
            </div>
            <!-- Vendor end -->

            <!-- Client start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">DATA KLIEN</label>
            </div>
            <div class="grid grid-cols-3 gap-2 w-[1200px] p-2">
                <a href="/marketing/client-categories"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center text-stone-200 font-serif text-md font-semibold">Katagori Klien</span>
                </a>
                <a href="/marketing/clients"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center text-stone-200 font-serif text-md font-semibold">Daftar Klien</span>
                </a>
                <a href="/marketing/client-groups"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center text-stone-200 font-serif text-md font-semibold">Group Klien</span>
                </a>
            </div>
            <!-- Client end -->
            <!-- Quotations start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">PENAWARAN</label>
            </div>
            <div class="grid grid-cols-4 gap-2 w-[1200px] p-2">
                @foreach ($categories as $category)
                    @if ($category->name == 'Service')
                        <a href="/marketing/quotations/home/{{ $category->name }}/{{ $company->id }}"
                            class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                            <span class="flex justify-center font-serif text-md">Katagori</span>
                            <span
                                class="flex justify-center text-stone-200 font-serif text-md font-semibold">Cetak/Pasang</span>
                        </a>
                    @else
                        <a href="/marketing/quotations/home/{{ $category->name }}/{{ $company->id }}"
                            class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                            <span class="flex justify-center font-serif text-md">Katagori</span>
                            <span
                                class="flex justify-center text-stone-200 font-serif text-md font-semibold">{{ $category->name }}</span>
                        </a>
                    @endif
                @endforeach
                <a href="/marketing/quotations/home/All/{{ $company->id }}"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Katagori</span>
                    <span class="flex justify-center text-stone-200 font-serif text-md font-semibold">Semua
                        Katagori</span>
                </a>
            </div>
            <!-- Quotations end -->

            <!-- Sales start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">PENJUALAN</label>
            </div>
            <div class="grid grid-cols-4 gap-2 w-[1200px] p-2">
                @foreach ($categories as $category)
                    @if ($category->name == 'Service')
                        <a href="/marketing/sales/home/{{ $category->name }}/{{ $company->id }}"
                            class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                            <span class="flex justify-center font-serif text-md">Katagori</span>
                            <span
                                class="flex justify-center text-stone-200 font-serif text-md font-semibold">Cetak/Pasang</span>
                        </a>
                    @else
                        <a href="/marketing/sales/home/{{ $category->name }}/{{ $company->id }}"
                            class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                            <span class="flex justify-center font-serif text-md">Katagori</span>
                            <span
                                class="flex justify-center text-stone-200 font-serif text-md font-semibold">{{ $category->name }}</span>
                        </a>
                    @endif
                @endforeach
                <a href="/marketing/sales/home/All/{{ $company->id }}"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Katagori</span>
                    <span class="flex justify-center text-stone-200 font-serif text-md font-semibold">Semua
                        Katagori</span>
                </a>
            </div>
            <!-- Sales end -->

            <!-- Order start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">DATA SPK</label>
            </div>
            <div class="grid grid-cols-2 gap-2 w-[1200px] p-2">
                <a href="/print-orders/index/{{ $company->id }}"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">SPK Cetak</span>
                </a>
                <a href="/install-orders/index/{{ $company->id }}"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">SPK Pasang</span>
                </a>
            </div>
            <!-- Order end -->

            <!-- Reports start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">LAPORAN</label>
            </div>
            <div class="grid grid-cols-3 gap-2 w-[1200px] p-2">
                <a href="/marketing/quotations-report/{{ $company->id }}"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Laporan Penawaran</span>
                </a>
                <a href="/marketing/sales-report/{{ $company->id }}"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Laporan Penjualan</span>
                </a>
                <a href="/marketing/orders-report/{{ $company->id }}"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Laporan SPK</span>
                </a>
            </div>
            <!-- Reports end -->

            <!-- Setting start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">PENGATURAN</label>
            </div>
            <div class="grid grid-cols-3 gap-2 w-[1200px] p-2">
                <a href="/marketing/printing-products"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Bahan Cetak</span>
                </a>
                <a href="/marketing/printing-prices"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Harga Cetak</span>
                </a>
                <a href="/marketing/installation-prices"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Harga Pasang</span>
                </a>
            </div>
            <!-- Setting end -->
        </div>
    </div>
@endsection
