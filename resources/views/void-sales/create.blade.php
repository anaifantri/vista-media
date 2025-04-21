@extends('dashboard.layouts.main');

@section('container')
    @php
        $description = json_decode($product->description);

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;

        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    @endphp
    <!-- Create Void Sales start -->
    <form action="/marketing/void-sales" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="created_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
        <input type="number" name="price" value="{{ $sale->price }}" hidden>
        <input type="number" name="dpp" value="{{ $sale->dpp }}" hidden>
        <input type="number" name="ppn" value="{{ ($sale->ppn / 100) * $sale->dpp }}" hidden>
        <input type="text" name="sale_number" value="{{ $sale->number }}" hidden>
        <input type="text" name="category" value="{{ $category }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex w-[1200px] p-2 border-b-2 border-white">
                    <div class="flex w-[1150px] items-center">
                        <h1 class="text-xl text-stone-100 font-bold tracking-wider">PEMBATALAN PENJUALAN NOMOR
                            {{ $sale->number }}</h1>
                    </div>
                    <div class="flex justify-end w-[150px]">
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Save">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="mx-1">Save</span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/marketing/sales/home/{{ $category }}/{{ $company->id }}">
                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 p-2">
                    <div class="text-sm border rounded-lg  bg-stone-200 border-stone-900 mt-2 p-2">
                        <div class="flex">
                            <label class="w-32">No. Penjualan</label>
                            <label>:</label>
                            <label class="ml-2">{{ $sale->number }}</label>
                        </div>
                        <div class="flex">
                            <label class="w-32">Tgl. Penjualan</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ date('d', strtotime($sale->created_at)) }}
                                {{ $bulan[(int) date('m', strtotime($sale->created_at))] }}
                                {{ date('Y', strtotime($sale->created_at)) }}
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-32">Jenis</label>
                            <label>:</label>
                            <label class="ml-2">
                                @if ($category == 'Service')
                                    Cetak / Pasang Visual
                                @else
                                    {{ $category }}
                                @endif
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-32">Lokasi</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ $product->address }}
                            </label>
                        </div>
                    </div>
                    <div class="text-sm border rounded-lg  bg-stone-200 border-stone-900 mt-2 p-2">
                        <div class="flex">
                            <label class="w-32">No. Penawaran</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ $quotation->number }}
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-32">Tgl. Penawaran</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ date('d', strtotime($quotation->created_at)) }}
                                {{ $bulan[(int) date('m', strtotime($quotation->created_at))] }}
                                {{ date('Y', strtotime($quotation->created_at)) }}
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-32">Nama Klien</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ $client->name }}
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-32">Nama Perusahaan</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ $client->company }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center w-[1200px] p-2 m-2 bg-stone-200">
                    @include('void-sales.show-table')
                </div>
                <div class="w-[1200px] p-2 m-2">
                    <span class="flex text-md font-semibold text-stone-100">Keterangan Pembatalan</span>
                    @if (old('note'))
                        <textarea name="note" class="border rounded-lg outline-none w-full p-2" rows="4" autofocus required>{{ old('note') }}</textarea>
                    @else
                        <textarea name="note" class="border rounded-lg outline-none w-full p-2" rows="4" autofocus required></textarea>
                    @endif
                </div>
                <div class="w-[1200px] p-2 m-2">
                    <span class="flex text-md font-semibold text-stone-100">Dokumen Pembatalan</span>
                    <div class="flex justify-center border rounded-lg w-full p-2 mt-2">
                        <div class="w-[950px]">
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
                                    <span class="ml-2">Pilih Dokumen</span>
                                </button>
                            </div>
                            <div class="flex items-center mt-2 w-full justify-center border rounded-lg">
                                <label class="text-xs text-stone-100 w-20">Jumlah File</label>
                                <label class="text-xs text-stone-100 ml-2">:</label>
                                <label id="numberImagesFile" class="text-xs text-stone-100 ml-2"> 0 file yang
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
                            <figure class="flex w-[950px] justify-center overflow-x-auto bg-stone-800 rounded-lg mt-2"
                                id="figureImages">

                            </figure>
                            <div class="relative m-auto w-[950px] h-max mt-2">
                                <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button" onclick="prevButtonAction()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
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
            </div>
        </div>
        <!-- Create Void Sales end -->
    </form>


    <script src="/js/voidsaledocuments.js"></script>
@endsection
