@extends('dashboard.layouts.main');

@section('container')
    <?php
    $created_by = json_decode($quotation[0]->created_by);
    $clients = json_decode($quotation[0]->clients);
    $products = json_decode($quotation[0]->products);
    $quotation_number = $quotation[0]->number;
    $quotation_created_at = $quotation[0]->created_at;
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <!-- Document Approvals start -->
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Document Approvals Title start -->
            <div class="flex w-[600px] items-center border-b p-1">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[550px]">DOKUMEN PO/SPK</h1>
                <div class="flex justify-end">
                    <a class="flex justify-center items-center mx-1 btn-danger"
                        href="/marketing/sales/home/{{ $category }}/{{ $company->id }}">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                        </svg>
                        <span class="mx-1">CLose</span>
                    </a>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="mt-2 flex alert-success">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            <!-- Document Approvals Title end -->
            <div class="flex w-[600px] items-center border rounded-lg mt-2 px-2 bg-stone-400">
                <div class="w-[280px] py-1">
                    <div class="div-sale">
                        <label class="text-sm text-stone-900 w-24">No. Penawaran</label>
                        <label class="label-sale-02">:</label>
                        <label class="label-sale-02">{{ $quotation_number }}</label>
                    </div>
                    <div class="div-sale">
                        <label class="text-sm text-stone-900 w-24">Tgl. Penawaran</label>
                        <label class="label-sale-02">:</label>
                        <label class="label-sale-02">{{ date('d', strtotime($quotation_created_at)) }}
                            {{ $bulan[(int) date('m', strtotime($quotation_created_at))] }}
                            {{ date('Y', strtotime($quotation_created_at)) }}</label>
                    </div>
                    <div class="div-sale">
                        <label class="text-sm text-stone-900 w-24">Jml. Dokumen</label>
                        <label class="label-sale-02">:</label>
                        <label class="label-sale-02">{{ count($quotation_orders) }} dokumen</label>
                        <button id="order"
                            class="flex justify-center items-center ml-2 px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md"
                            onclick="btnImages(this, document.getElementById('orderImages'))">
                            <svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                            </svg>
                            <span class="text-sm ml-1">Tambah</span>
                        </button>
                    </div>
                </div>
                <div class="w-[310px] border-l p-1">
                    <div class="div-sale">
                        <label class="text-sm text-stone-900 w-20">Nama Klien</label>
                        <label class="label-sale-02">:</label>
                        <label class="label-sale-02">{{ $clients->name }}</label>
                    </div>
                    @if ($clients->type == 'Perusahaan')
                        <div class="div-sale">
                            <label class="text-sm text-stone-900 w-20">Perusahaan</label>
                            <label class="label-sale-02">:</label>
                            <label class="label-sale-02">{{ $clients->company }}</label>
                        </div>
                    @endif
                    <div class="div-sale">
                        <label class="text-sm text-stone-900 w-20">Kode Lokasi</label>
                        <label class="label-sale-02">:</label>
                        <label class="label-sale-02">
                            @foreach ($products as $product)
                                @if ($loop->iteration == count($products))
                                    {{ $product->code }} -
                                @else
                                    {{ $product->code }}
                                @endif
                            @endforeach
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex justify-center w-[600px]">
                <div>
                    <div class="relative mt-4 w-[600px] border ">
                        @if (count($quotation_orders) == 0)
                            <div id="prevButtonShow" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                <button
                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    type="button" onclick="buttonPrevShow()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="nextButtonShow" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                <button type="button"
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    onclick="buttonNextShow()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            <div id="prevButtonShow" class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                                <button
                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    type="button" onclick="buttonPrevShow()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="nextButtonShow" class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                                <button type="button"
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    onclick="buttonNextShow()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                        @foreach ($quotation_orders as $order)
                            @if ($loop->iteration == 1)
                                <div class="divImage">
                                    <div class="absolute border rounded-md bg-black opacity-70 top-2 left-2">
                                        <span class="mx-1 text-sm text-white">{{ $loop->iteration }}</span>
                                    </div>
                                    <div class="absolute bottom-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                        <div class="flex items-center">
                                            <div class="w-64">
                                                <div class="flex">
                                                    <label class="text-sm text-yellow-400 w-28 mx-1">Tanggal Upload</label>
                                                    <label class="text-sm text-yellow-400">:</label>
                                                    <label
                                                        class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($order->created_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($order->created_at))] }}
                                                        {{ date('Y', strtotime($order->created_at)) }}</label>
                                                </div>
                                                <div class="flex">

                                                    <label class="text-sm text-yellow-400 w-28 mx-1">Diupload Oleh</label>
                                                    <label class="text-sm text-yellow-400">: </label>
                                                    <label
                                                        class="text-sm text-yellow-400 ml-2 w-40">{{ $created_by->name }}</label>
                                                </div>
                                            </div>
                                            <div class="flex w-full px-1 justify-end items-center">
                                                <form action="/marketing/quotation-orders/{{ $order->id }}"
                                                    method="post" class="d-inline my-1">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                        class="index-link text-white p-2 h-6 rounded bg-red-600 hover:bg-red-700 drop-shadow-md mr-1"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus dokumen ini ?')">
                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                fill-rule="nonzero" />
                                                        </svg>
                                                        <span class="ml-1 text-sm">Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <img class="w-[600px]" src="{{ asset('storage/' . $order->image) }}" alt="">
                                </div>
                            @else
                                <div class="divImage" hidden>
                                    <div class="absolute border rounded-md bg-black opacity-70 top-2 left-2">
                                        <span class="mx-1 text-sm text-white">{{ $loop->iteration }}</span>
                                    </div>
                                    <div class="absolute bottom-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                        <div class="flex items-center">
                                            <div class="w-64">
                                                <div class="flex">
                                                    <label class="text-sm text-yellow-400 w-28 mx-1">Tanggal Upload</label>
                                                    <label class="text-sm text-yellow-400">:</label>
                                                    <label
                                                        class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($order->created_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($order->created_at))] }}
                                                        {{ date('Y', strtotime($order->created_at)) }}</label>
                                                </div>
                                                <div class="flex">
                                                    <label class="text-sm text-yellow-400 w-28 mx-1">Diupload Oleh</label>
                                                    <label class="text-sm text-yellow-400">: </label>
                                                    <label
                                                        class="text-sm text-yellow-400 ml-2 w-40">{{ $created_by->name }}</label>
                                                </div>
                                            </div>
                                            <div class="flex w-full px-1 justify-end items-center">
                                                <form action="/marketing/quotation-orders/{{ $order->id }}"
                                                    method="post" class="d-inline my-1">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                        class="index-link text-white p-2 h-6 rounded bg-red-600 hover:bg-red-700 drop-shadow-md mr-1"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus dokumen ini ?')">
                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                fill-rule="nonzero" />
                                                        </svg>
                                                        <span class="ml-1 text-sm">Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <img class="w-[600px]" src="{{ asset('storage/' . $order->image) }}" alt="">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Document Approvals end -->
    </div>

    <!-- Modal Add / View Document start -->
    @include('dashboard.layouts.add-documents')
    <!-- Modal Add / View Document end -->

    <form id="formDelete" method="post" hidden>
        @method('delete')
        @csrf
    </form>
    <form id="formAdd" method="post" enctype="multipart/form-data">
        @csrf
        <input id="orderImages" class="hidden" name="document_order[]" type="file"
            accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)" multiple>
        <input type="text" name="quotation_id" value="{{ $quotation[0]->id }}" hidden>
        <input type="text" id="number" name="number" hidden>
        <input type="date" id="date" name="date" hidden>
        <input type="text" name="category" value="{{ $category }}" hidden>
    </form>

    <script src="/js/adddocuments.js"></script>
    <script>
        // Funtion Button Next-Prev-figure start -->
        const imageViews = document.querySelectorAll(".divImage");
        var indexShow = 0;

        for (let i = 0; i < imageViews.length; i++) {
            if (i == 0) {
                indexShow = i;
                imageViews[i].removeAttribute('hidden');
            } else {
                imageViews[i].setAttribute('hidden', 'hidden');
            }
        }
        buttonNextShow = () => {
            if (indexShow == imageViews.length - 1) {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                imageViews[0].removeAttribute('hidden');
                indexShow = 0;
            } else {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                imageViews[indexShow + 1].removeAttribute('hidden');
                indexShow = indexShow + 1;
            }
        }
        buttonPrevShow = () => {
            if (indexShow == 0) {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                imageViews[imageViews.length - 1].removeAttribute('hidden');
                indexShow = imageViews.length - 1;
            } else {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                imageViews[indexShow - 1].removeAttribute('hidden');
                indexShow = indexShow - 1;
            }
        }
        // Funtion Button Next-Prev-figure end -->
    </script>
@endsection
