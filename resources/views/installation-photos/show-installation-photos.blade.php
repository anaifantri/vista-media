@extends('dashboard.layouts.main');

@section('container')
    <?php
    // $description = json_decode($location->description);
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    $client = '-';
    $product = json_decode($install_order->product);
    $day_photos = $installation_photos->where('type', 'day');
    $night_photos = $installation_photos->where('type', 'night');
    if ($install_order->sale) {
        $client = json_decode($install_order->sale->quotation->clients);
    }
    ?>
    <!-- Container start -->
    <div class="flex justify-center  py-10 px-14 bg-stone-800">
        <div class="bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1 w-[400px]">FOTO PEMASANGAN GAMBAR</h1>
                <!-- Title end -->
                <!-- Button Back start -->
                <div class="flex w-full justify-end items-center">
                    <a class="flex justify-center items-center mx-1 btn-primary"
                        href="/installation-photos/index/{{ $company->id }}">
                        <svg class="fill-current w-6" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1">Back</span>
                    </a>
                </div>
                <!-- Button Back end -->
            </div>
            <!-- Alert start -->
            @if (session()->has('success'))
                <div class="ml-2 flex alert-success mt-2">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            @error('delete')
                <div class="ml-2 flex alert-warning mt-2">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Warning!!</span> {{ $message }}
                </div>
            @enderror
            <!-- Alert end -->
            <!-- Install Order Detail start -->
            <div class="flex w-full justify-center mt-2">
                <div class="w-[580px] border rounded-lg p-2 bg-stone-200">
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-28">No. Penjualan</label>
                        <label>:</label>
                        <label class="ml-1">
                            @if ($install_order->sale_id == '')
                                -
                            @else
                                {{ $install_order->sale->number }}
                            @endif
                        </label>
                    </div>
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-28">Klien</label>
                        <label>:</label>
                        <label class="ml-1">
                            @if ($client == '-')
                                {{ $client }}
                            @else
                                {{ $client->name }}
                            @endif
                        </label>
                    </div>
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-28">Kode Lokasi</label>
                        <label>:</label>
                        <label class="ml-1">
                            {{ $product->location_code }}-{{ $product->city_code }}
                        </label>
                    </div>
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-28">Lokasi</label>
                        <label>:</label>
                        <label class="ml-1">
                            {{ $product->location_address }}
                        </label>
                    </div>
                </div>
                <div class="w-[580px] border rounded-lg p-2 bg-stone-200 ml-4">
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-28">No. SPK Pasang</label>
                        <label>:</label>
                        <label class="ml-1">
                            {{ $install_order->number }}
                        </label>
                    </div>
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-28">Tgl. Pasang</label>
                        <label>:</label>
                        <label class="ml-1">
                            {{ date('d', strtotime($install_order->install_at)) }}-{{ $bulan[(int) date('m', strtotime($install_order->install_at))] }}-{{ date('Y', strtotime($install_order->install_at)) }}
                        </label>
                    </div>
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-28">Tema</label>
                        <label>:</label>
                        <label class="ml-1">
                            {{ $install_order->theme }}
                        </label>
                    </div>
                </div>
            </div>
            <!-- Install Order Detail end -->
            <!-- View Foto start -->
            <div class="flex w-full justify-center mt-2">
                @include('installation-photos.day-photo')
                @include('installation-photos.night-photo')
            </div>
            <!-- View Foto end -->
        </div>
    </div>
    <form id="formDelete" method="post" hidden>
        @method('delete')
        @csrf
    </form>
    <!-- Container end -->

    <script src="/js/show-installation-photos.js"></script>
@endsection
