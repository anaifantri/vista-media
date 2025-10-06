@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    @php
        $fullMonth = [
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
        $client = json_decode($payment->billings[0]->client);
        $images = json_decode($income_tax_document->images);
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Title start -->
            <div class="flex w-[1200px] items-center border-b p-1">
                <label class="flex text-xl text-stone-100 font-bold w-[850px]">
                    DETAIL BUKTI POTONG PPH
                </label>
                <div class="flex items-center w-full justify-end">
                    <a href="/income-taxes/index/{{ $company->id }}"
                        class="flex justify-center items-center mx-1 btn-primary" title="Back">
                        <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                        </svg>
                        <span class="mx-1 text-white">Back</span>
                    </a>
                    <a href="/accounting/income-tax-documents/{{ $income_tax_document->id }}/edit"
                        class="flex items-center justify-center btn-warning mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Edit </span>
                    </a>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="ml-2 flex alert-success">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            <!-- Title end -->

            <!-- New License Document start -->
            <div class="flex justify-center border rounded-lg w-[1200px] p-4">
                <div class="w-[950px]">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-2 mt-2 border rounded-lg bg-stone-300 text-stone-900">
                            <div class="flex border-b border-stone-900 font-semibold">Detail Pemotongan</div>
                            <div class="flex mt-1">
                                <label class="text-md w-40">Total Tagihan</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2">Rp.
                                    {{ number_format($payment->billings->sum('nominal') + $payment->billings->sum('ppn')) }},-</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-md w-40">Nominal PPh</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2">Rp.
                                    {{ number_format($payment->income_taxes->sum('nominal')) }},-</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-md w-40">No. Bukti Potong</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2">{{ $income_tax_document->number }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-md w-40">Tgl. Bukti Potong</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2">
                                    {{ date('d', strtotime($income_tax_document->tax_date)) }}
                                    {{ $fullMonth[(int) date('m', strtotime($income_tax_document->tax_date))] }}
                                    {{ date('Y', strtotime($income_tax_document->tax_date)) }}
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-md w-40">Masa Pajak</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2">
                                    {{ $fullMonth[(int) substr($income_tax_document->period, -2)] }}
                                    {{ substr($income_tax_document->period, 0, 4) }}
                                </label>
                            </div>
                        </div>
                        <div class="p-2 mt-2 border rounded-lg bg-stone-300 text-stone-900">
                            <div class="flex border-b border-stone-900 font-semibold">Data Pemotong</div>
                            <div class="flex mt-1">
                                <label class="text-md w-28">Perusahaan</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2">{{ $income_tax_document->company }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-md w-28">Alamat</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2 w-[320px]">{{ $client->address }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-md w-28">NPWP</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2">{{ $client->npwp }}</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="p-2 mt-2 border rounded-lg bg-stone-300 text-stone-900">
                            <div class="flex border-b border-stone-900 font-semibold">Detail Objek Pajak</div>
                            <div class="flex mt-1">
                                <label class="text-md w-40">Kode Objek</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2">
                                    @if ($income_tax_document->income_tax_category)
                                        {{ $income_tax_document->income_tax_category->code }}
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-md w-40">Nama Objek</label>
                                <label class="text-md ml-2">:</label>
                                <label class="text-md ml-2 w-[750px]">
                                    @if ($income_tax_document->income_tax_category)
                                        {{ $income_tax_document->income_tax_category->name }}
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mt-2 w-full justify-center border rounded-lg">
                        <label class="text-md text-stone-100 w-20">Jumlah File</label>
                        <label class="text-md text-stone-100 ml-2">:</label>
                        <label id="numberImagesFile" class="text-md text-stone-100 ml-2">{{ count($images) }}
                            dokumen</label>
                    </div>
                    <figure class="flex w-[950px] justify-center overflow-x-auto border-b-2 border mt-2" id="figureImages">

                    </figure>
                    <div class="relative m-auto w-[950px] h-max mt-2">
                        @if (count($images) > 1)
                            <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                                <button
                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    type="button" onclick="buttonPrevShow()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                                <button type="button"
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    onclick="buttonNextShow()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                <button
                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    type="button" onclick="buttonPrevShow()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                <button type="button"
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    onclick="buttonNextShow()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                        @foreach ($images as $image)
                            @if (count($images) > 2)
                                @if ($loop->iteration - 1 == intdiv(count($agreements), 2))
                                    <div class="divImage">
                                        <img src="{{ asset('storage/' . $image) }}" alt="">
                                    </div>
                                @else
                                    <div class="divImage" hidden>
                                        <img src="{{ asset('storage/' . $image) }}" alt="">
                                    </div>
                                @endif
                            @else
                                @if ($loop->iteration == 1)
                                    <div class="divImage">
                                        <img src="{{ asset('storage/' . $image) }}" alt="">
                                    </div>
                                @else
                                    <div class="divImage" hidden>
                                        <img src="{{ asset('storage/' . $image) }}" alt="">
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- New License Document end -->
        </div>
    </div>
    <!-- Container end -->

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
