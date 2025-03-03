@extends('dashboard.layouts.main');

@section('container')
    <?php
    $created_by = json_decode($sale->created_by);
    $clients = json_decode($sale->quotation->clients);
    $product = json_decode($sale->product);
    if (request('index_agreement')) {
        $indexAgreement = request('index_agreement');
    } else {
        $indexAgreement = 0;
    }
    if (count($quotation_agreements) > 0) {
        $quotation_agreement = $quotation_agreements[$indexAgreement];
        $showImages = json_decode($quotation_agreement->images);
    } else {
        $showImages = [];
    }
    $sale_number = $sale->number;
    $sale_created_at = $sale->created_at;
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $month = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <!-- Document Agreements start -->
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Document Agreements Title start -->
            <div class="flex w-[950px] items-center border-b p-1">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[550px]">DOKUMEN PERJANJIAN</h1>
                <div class="flex w-full justify-end">
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
            <!-- Document Agreements Title end -->
            <div class="grid grid-cols-2 gap-2 mt-2">
                <div class="border p-1 rounded-lg bg-stone-400">
                    <div class="div-sale">
                        <label class="text-sm text-stone-900 w-24">No. Penjualan</label>
                        <label class="label-sale-02">:</label>
                        <label class="label-sale-02">{{ $sale_number }}</label>
                    </div>
                    <div class="div-sale">
                        <label class="text-sm text-stone-900 w-24">Tgl. Penjualan</label>
                        <label class="label-sale-02">:</label>
                        <label class="label-sale-02">
                            {{ date('d', strtotime($sale_created_at)) }}
                            {{ $bulan[(int) date('m', strtotime($sale_created_at))] }}
                            {{ date('Y', strtotime($sale_created_at)) }}
                        </label>
                    </div>
                    <div class="div-sale">
                        <label class="text-sm text-stone-900 w-24">Nama Klien</label>
                        <label class="label-sale-02">:</label>
                        <label class="label-sale-02">{{ $clients->name }}</label>
                    </div>
                    @if ($clients->type == 'Perusahaan')
                        <div class="div-sale">
                            <label class="text-sm text-stone-900 w-24">Perusahaan</label>
                            <label class="label-sale-02">:</label>
                            <label class="label-sale-02">{{ $clients->company }}</label>
                        </div>
                    @endif
                    <div class="div-sale">
                        <label class="text-sm text-stone-900 w-24">Kode Lokasi</label>
                        <label class="label-sale-02">:</label>
                        <label class="label-sale-02">
                            {{ $product->code }} - {{ $product->city_code }} | {{ $product->address }}
                        </label>
                    </div>
                </div>
                <div class="border p-1 rounded-lg bg-stone-400">
                    <div class="flex w-full items-center border-b border-stone-900">
                        <label class="w-52 text-sm font-semibold m-1">Dokumen Perjanjian</label>
                        <div class="flex justify-end w-full">
                            <button id="agreement"
                                class="flex justify-center items-center ml-2 px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md"
                                onclick="btnImages(this, document.getElementById('agreementImages'))">
                                <svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                </svg>
                                <span class="text-sm ml-1">Tambah</span>
                            </button>
                        </div>
                    </div>
                    <table class="table-auto w-full mt-2">
                        <thead>
                            <tr class="text-sm bg-stone-300">
                                <th class="border border-stone-900 w-36">No. Perjanjian</th>
                                <th class="border border-stone-900 w-24">Tgl. Perjanjian</th>
                                <th class="border border-stone-900 w-8">Dok.</th>
                                <th class="border border-stone-900 w-16">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotation_agreements as $quotationAgreement)
                                @php
                                    $orderImages = json_decode($quotationAgreement->images);
                                @endphp
                                <tr class="text-sm bg-stone-100">
                                    <td class="border border-stone-900 text-center">
                                        {{ $quotationAgreement->number }}
                                    </td>
                                    <td class="border border-stone-900 text-center">
                                        {{ date('d', strtotime($quotationAgreement->date)) }}-{{ $month[(int) date('m', strtotime($quotationAgreement->date))] }}-{{ date('Y', strtotime($quotationAgreement->date)) }}
                                    </td>
                                    <td class="border border-stone-900 text-center">
                                        {{ count($orderImages) }}
                                    </td>
                                    <td class="border border-stone-900 text-center">
                                        <div class="flex w-full justify-center items-center">
                                            <form class="m-1"
                                                action="/marketing/quotation-agreements/show-agreements/{{ $category }}/{{ $sale->id }}">
                                                <input type="text" name="index_agreement"
                                                    value="{{ $loop->iteration - 1 }}" hidden>
                                                <button type="submit"
                                                    class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md">
                                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                </button>
                                            </form>
                                            @canany(['isAdmin', 'isMarketing'])
                                                @can('isSale')
                                                    @can('isMarketingCreate')
                                                        <a href="/marketing/quotation-agreements/{{ $quotationAgreement->id }}/edit"
                                                            class="index-link text-white w-8 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md">
                                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                                    fill-rule="nonzero" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                @endcan
                                            @endcanany
                                            @canany(['isAdmin', 'isMarketing'])
                                                @can('isSale')
                                                    @can('isMarketingDelete')
                                                        <form action="/marketing/quotation-agreements/{{ $quotationAgreement->id }}"
                                                            method="post" class="d-inline m-1">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                                class="index-link text-white w-8 h-5 rounded bg-red-600 hover:bg-red-700 drop-shadow-md"
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus dokumen perjanjian dengan nomor {{ $quotationAgreement->number }} ?')">
                                                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                        fill-rule="nonzero" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                @endcan
                                            @endcanany
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-center w-[950px]">
                <div>
                    <div class="relative mt-4 w-[950px] border rounded-lg p-2">
                        @if (count($showImages) == 0)
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
                        @foreach ($showImages as $order)
                            @if ($loop->iteration == 1)
                                <div class="divImage">
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="bg-stone-900 p-4 border rounded-lg">
                                            <div class="flex">
                                                <label class="text-sm text-yellow-400 w-28 mx-1">No. Perjanjian</label>
                                                <label class="text-sm text-yellow-400">:</label>
                                                <label
                                                    class="text-sm text-yellow-400 ml-2">{{ $quotation_agreement->number }}</label>
                                            </div>
                                            <div class="flex">
                                                <label class="text-sm text-yellow-400 w-28 mx-1">Tgl. Perjanjian</label>
                                                <label class="text-sm text-yellow-400">: </label>
                                                <label class="text-sm text-yellow-400 ml-2 w-40">
                                                    {{ date('d', strtotime($quotation_agreement->date)) }}
                                                    {{ $bulan[(int) date('m', strtotime($quotation_agreement->date))] }}
                                                    {{ date('Y', strtotime($quotation_agreement->date)) }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="bg-stone-900 p-4 border rounded-lg">
                                            <div class="flex">
                                                <label class="text-sm text-yellow-400 w-36 mx-1">Jumlah Dokumen</label>
                                                <label class="text-sm text-yellow-400">:</label>
                                                <label class="text-sm text-yellow-400 ml-2">{{ count($showImages) }}
                                                    lembar</label>
                                            </div>
                                            <div class="flex">
                                                <label class="text-sm text-yellow-400 w-36 mx-1">Diupload Oleh</label>
                                                <label class="text-sm text-yellow-400">: </label>
                                                <label class="text-sm text-yellow-400 ml-2 w-40">
                                                    {{ $quotation_agreement->user->name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex w-full justify-center mt-2">
                                        <img class="w-[880px]" src="{{ asset('storage/' . $order) }}" alt="">
                                    </div>
                                </div>
                            @else
                                <div class="divImage" hidden>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="bg-stone-900 p-4 border rounded-lg">
                                            <div class="flex">
                                                <label class="text-sm text-yellow-400 w-28 mx-1">No. Perjanjian</label>
                                                <label class="text-sm text-yellow-400">:</label>
                                                <label
                                                    class="text-sm text-yellow-400 ml-2">{{ $quotation_agreement->number }}</label>
                                            </div>
                                            <div class="flex">
                                                <label class="text-sm text-yellow-400 w-28 mx-1">Tgl. Perjanjian</label>
                                                <label class="text-sm text-yellow-400">: </label>
                                                <label class="text-sm text-yellow-400 ml-2 w-40">
                                                    {{ date('d', strtotime($quotation_agreement->date)) }}
                                                    {{ $bulan[(int) date('m', strtotime($quotation_agreement->date))] }}
                                                    {{ date('Y', strtotime($quotation_agreement->date)) }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="bg-stone-900 p-4 border rounded-lg">
                                            <div class="flex">
                                                <label class="text-sm text-yellow-400 w-36 mx-1">Jumlah Dokumen</label>
                                                <label class="text-sm text-yellow-400">:</label>
                                                <label class="text-sm text-yellow-400 ml-2">{{ count($showImages) }}
                                                    lembar</label>
                                            </div>
                                            <div class="flex">
                                                <label class="text-sm text-yellow-400 w-36 mx-1">Diupload Oleh</label>
                                                <label class="text-sm text-yellow-400">: </label>
                                                <label class="text-sm text-yellow-400 ml-2 w-40">
                                                    {{ $quotation_agreement->user->name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex w-full justify-center">
                                        <img class="w-[880px]" src="{{ asset('storage/' . $order) }}" alt="">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Document Agreements end -->
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
        <input id="agreementImages" class="hidden" name="document_agreement[]" type="file"
            accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)" multiple>
        <input type="text" name="quotation_id" value="{{ $sale->quotation->id }}" hidden>
        <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
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
                indexShow = 0;
                imageViews[indexShow].removeAttribute('hidden');
            } else {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                imageViews[indexShow + 1].removeAttribute('hidden');
                indexShow = indexShow + 1;
            }
        }
        buttonPrevShow = () => {
            if (indexShow == 0) {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                indexShow = imageViews.length - 1;
                imageViews[indexShow].removeAttribute('hidden');
            } else {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                imageViews[indexShow - 1].removeAttribute('hidden');
                indexShow = indexShow - 1;
            }
        }
        // Funtion Button Next-Prev-figure end -->
    </script>
@endsection
