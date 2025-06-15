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
        if (!empty($payment->income_tax_document)) {
            $images = json_decode($payment->income_tax_document->images);
        } else {
            $images = [];
        }
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Title start -->
            <div class="flex w-[1200px] items-center border-b p-1">
                <label class="flex text-xl text-stone-100 font-bold w-[850px]">
                    DETAIL PEMBAYARAN
                </label>
                <div class="flex items-center w-full justify-end">
                    <a href="/payments/index/{{ $company->id }}" class="flex justify-center items-center mx-1 btn-primary"
                        title="Back">
                        <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                        </svg>
                        <span class="mx-1 text-white">Back</span>
                    </a>
                </div>
            </div>
            <!-- Title end -->

            <!-- New License Document start -->
            <div class="flex justify-center border rounded-lg w-[1200px] p-4 mt-4">
                <div class="w-[950px]">
                    <label class="text-md font-bold text-white">DATA PERUSAHAAN</label>
                    <div class="p-2 mt-1 border rounded-lg">
                        <div class="flex">
                            <label class="text-md text-stone-100 w-24">Perusahaan</label>
                            <label class="text-md text-stone-100 ml-2">:</label>
                            <label class="text-md text-stone-100 ml-2">
                                @if (isset($client->company))
                                    {{ $client->company }}
                                @elseif (isset($client->name))
                                    {{ $client->name }}
                                @else
                                    {{ $client->contact_name }}
                                @endif
                            </label>
                        </div>
                        <div class="flex mt-1">
                            <label class="text-md text-stone-100 w-24">Alamat</label>
                            <label class="text-md text-stone-100 ml-2">:</label>
                            <label class="text-md text-stone-100 w-[340px] ml-2">{{ $client->address }}</label>
                        </div>
                    </div>
                    <label class="flex text-md font-bold text-white mt-2">DATA INVOICE</label>
                    <div class="p-2 mt-1 border rounded-lg text-md text-stone-100">
                        @foreach ($payment->billings as $billing)
                            @php
                                $descriptions = json_decode($billing->invoice_content)->description;
                                if (isset(json_decode($billing->invoice_content)->manual_detail)) {
                                    $manualDetail = json_decode($billing->invoice_content)->manual_detail;
                                }
                                $i = 0;
                            @endphp
                            <div class="flex w-full">
                                <div>{{ $loop->iteration }}.</div>
                                <div class="ml-2 w-full">
                                    <div class="flex">
                                        <label class="w-40">Nomor Invoice</label>
                                        <label class="ml-2">:</label>
                                        <label class="ml-2">{{ $billing->invoice_number }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40">Jenis</label>
                                        <label class="ml-2">:</label>
                                        <label class="ml-2">
                                            @if ($billing->category == 'Service')
                                                Revisual
                                            @else
                                                Media
                                            @endif
                                        </label>
                                    </div>
                                    <table class="table-auto w-full text-sm">
                                        <thead>
                                            <tr class="text-black bg-stone-400">
                                                <th class="border border-black w-8">No.</th>
                                                <th class="border border-black">Deskripti</th>
                                                <th class="border border-black w-28">Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($descriptions as $description)
                                                @php
                                                    if (isset($manualDetail)) {
                                                        $invoiceTitle = $manualDetail[$i]->title;
                                                    } else {
                                                        $invoiceTitle = $description->title;
                                                    }
                                                    $i++;
                                                @endphp
                                                <tr class="text-black bg-stone-200">
                                                    <td class="border border-black text-center">{{ $i }}</td>
                                                    <td class="border border-black px-2">
                                                        <div>
                                                            <div class="flex">
                                                                <span class="flex w-16">Tagihan</span>
                                                                <span class="flex ml-2">:</span>
                                                                <span class="flex ml-2">
                                                                    {{ $invoiceTitle }}
                                                                </span>
                                                            </div>
                                                            <div class="flex">
                                                                <span class="flex w-16">Lokasi</span>
                                                                <span class="flex ml-2">:</span>
                                                                <span class="flex ml-2">{{ $description->location }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="border border-black text-right px-2">
                                                        {{ number_format($description->nominal) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="flex mt-1">
                                        <label class="w-40">Nominal Invoice</label>
                                        <label class="ml-2">:</label>
                                        <label class="ml-2">Rp. </label>
                                        <label class="text-right w-28">{{ number_format($billing->nominal) }},-</label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="w-40">Total Ppn</label>
                                        <label class="ml-2">:</label>
                                        <label class="ml-2">Rp. </label>
                                        <label class="text-right w-28">{{ number_format($billing->ppn) }},-</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <label class="flex text-md font-bold text-white mt-2">DATA PEMBAYARAN</label>
                    <div class="p-2 mt-1 border rounded-lg">
                        <div class="flex mt-1">
                            <label class="text-md text-stone-100 w-40">Total Tagihan</label>
                            <label class="text-md text-stone-100 ml-2">:</label>
                            <label class="text-md text-stone-100 ml-2">Rp. </label>
                            <label
                                class="text-md text-stone-100 text-right w-28">{{ number_format($payment->billings->sum('nominal') + $payment->billings->sum('ppn')) }},-</label>
                        </div>
                        <div class="flex mt-1">
                            <label class="text-md text-stone-100 w-40">Pemotongan PPh</label>
                            <label class="text-md text-stone-100 ml-2">:</label>
                            <label class="text-md text-stone-100 ml-2">Rp. </label>
                            <label
                                class="text-md text-stone-100 text-right w-28">{{ number_format($payment->income_taxes->sum('nominal')) }},-</label>
                        </div>
                        <div class="flex mt-1">
                            <label class="text-md text-stone-100 w-40">Nominal Pembayaran</label>
                            <label class="text-md text-stone-100 ml-2">:</label>
                            <label class="text-md text-stone-100 ml-2">Rp. </label>
                            <label
                                class="text-md text-stone-100 text-right w-28">{{ number_format($payment->nominal) }},-</label>
                        </div>
                        <div class="flex mt-1">
                            <label class="text-md text-stone-100 w-40">Tgl. Pembayaran</label>
                            <label class="text-md text-stone-100 ml-2">:</label>
                            <label class="text-md text-stone-100 ml-2">
                                {{ date('d', strtotime($payment->created_at)) }}
                                {{ $fullMonth[(int) date('m', strtotime($payment->created_at))] }}
                                {{ date('Y', strtotime($payment->created_at)) }}
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 border rounded-lg">
                        <div class="flex items-center w-full justify-center">
                            <label class="flex text-md text-stone-100 border-b font-bold">BUKTI POTONG PPH</label>
                        </div>
                        <div class="flex items-center mt-1 w-full justify-center">
                            <label class="flex text-md text-stone-100">Jumlah File</label>
                            <label class="flex text-md text-stone-100 ml-2">:</label>
                            <label id="numberImagesFile" class="flex text-md text-stone-100 ml-2">{{ count($images) }}
                                dokumen</label>
                        </div>
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
