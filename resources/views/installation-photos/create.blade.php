@extends('dashboard.layouts.main');

@section('container')
    <?php
    // $description = json_decode($location->description);
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    $client = '-';
    $product = json_decode($install_order->product);
    if ($install_order->sale) {
        $client = json_decode($install_order->sale->quotation->clients);
    }
    ?>
    <!-- Container start -->
    <form action="/workshop/installation-photos" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="install_order_id" value="{{ $install_order->id }}" hidden>
        <input type="text" name="type" value="{{ $type }}" hidden>
        <div class="flex justify-center  py-10 px-14 bg-stone-800">
            <div class="bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[780px] items-center border-b p-1">
                    <label class="flex text-xl text-stone-100 font-bold w-[900px]">TAMBAH FOTO
                        @if ($type == 'day')
                            SIANG
                        @else
                            MALAM
                        @endif
                    </label>
                    <div class="flex items-center w-full justify-end">
                        <button id="btnSave" name="btnSave" class="flex justify-center items-center ml-1 btn-primary"
                            type="submit">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Save</span>
                        </button>
                        <a class="flex justify-center items-center ml-1 btn-danger"
                            href="/installation-photos/show/{{ $install_order->id }}">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Cancel</span>
                        </a>
                    </div>
                </div>
                <!-- Title end -->

                <div class="flex w-full justify-center mt-2">
                    <div class="w-[780px] border rounded-lg p-2 bg-stone-200">
                        <div class="flex text-stone-900 text-sm font-semibold">
                            <label class="w-28">No. Penjualan</label>
                            <label>:</label>
                            <label class="ml-1">
                                {{ $install_order->sale->number }}
                            </label>
                        </div>
                        <div class="flex text-stone-900 text-sm font-semibold">
                            <label class="w-28">Klien</label>
                            <label>:</label>
                            <label class="ml-1">
                                {{ $client->name }}
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

                <!-- New Documentation start -->
                <div class="flex justify-center w-full mt-2">
                    <div class="flex justify-start border rounded-lg w-[780px] p-4">
                        <div class="w-[750px]">
                            <div class="flex w-full justify-center">
                                <input id="images" name="images[]" type="file"
                                    accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)" multiple hidden>
                                <button id="btnChooseImages" class="flex justify-center items-center w-44 btn-primary-small"
                                    title="Chose Files" type="button" onclick="document.getElementById('images').click()">
                                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                    </svg>
                                    <span class="ml-2">Pilih Foto
                                        @if ($type == 'day')
                                            Siang
                                        @else
                                            Malam
                                        @endif
                                    </span>
                                </button>
                            </div>
                            <div class="flex items-center mt-2 w-full justify-center border rounded-lg">
                                <label class="text-sm text-stone-100 w-20">Jumlah File</label>
                                <label class="text-sm text-stone-100 ml-2">:</label>
                                <label id="numberImagesFile" class="text-sm text-stone-100 ml-2"> 0 file yang
                                    dipilih</label>
                            </div>
                            @error('images')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('images.*')
                                <div class="invalid-feedback">
                                    Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                </div>
                            @enderror
                            <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-stone-100 mt-2"
                                id="figureImages">

                            </figure>
                            <div class="relative m-auto w-[750px] h-max mt-2">
                                <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button" onclick="prevButtonAction()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                            clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        onclick="nextButtonAction()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="slidesPreview" class="mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Documentation end -->
            </div>
        </div>
    </form>
    <!-- Container end -->
    <!-- Script start -->
    <script src="/js/addinstallationphotos.js"></script>
    <!-- Script end -->
@endsection
