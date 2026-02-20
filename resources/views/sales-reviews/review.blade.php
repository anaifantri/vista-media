@extends('dashboard.layouts.main');

@section('container')
    <?php
    $reviewed = false;
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $bulan_full = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $totalPpn = 0;
    $category = $sale->media_category->name;
    $salesNote = [];
    $quotationSale = $quotation->sales;
    $description = json_decode($products[0]->description);
    if ($category == 'Service') {
        for ($i = 0; $i < count($notes->dataNotes); $i++) {
            array_push($salesNote, $notes->dataNotes[$i]);
        }
    } else {
        if ($category == 'Videotron' || ($category == 'Signage' && $description->type == 'Videotron')) {
            for ($i = 0; $i < count($notes->dataNotes); $i++) {
                if ($i == 2) {
                    array_push($salesNote, $notes->dataNotes[$i]);
                }
            }
        } else {
            $freeInstall = $notes->freeInstall;
            $freePrint = $notes->freePrint;
            if ($freeInstall != 0 && $freePrint != 0) {
                for ($i = 0; $i < count($notes->dataNotes); $i++) {
                    if ($i == 2 || $i == 3) {
                        array_push($salesNote, $notes->dataNotes[$i]);
                    }
                }
            } elseif (($freeInstall != 0 && $freePrint == 0) || ($freeInstall == 0 && $freePrint != 0)) {
                for ($i = 0; $i < count($notes->dataNotes); $i++) {
                    if ($i == 2) {
                        array_push($salesNote, $notes->dataNotes[$i]);
                    }
                }
            }
        }
    }
    $product = json_decode($sale->product);
    $description = json_decode($product->description);
    if ($product->category == 'Signage') {
        $wide = $product->width * $product->height * (int) $product->side * $description->qty;
    } else {
        $wide = $product->width * $product->height * (int) $product->side;
    }
    if (isset($notes->includedPrint) && $notes->includedPrint->checked == true) {
        $totalPrint = $notes->includedPrint->price * $notes->includedPrint->qty * $wide;
    } else {
        $totalPrint = 0;
    }
    if (isset($notes->includedInstall) && $notes->includedInstall->checked == true) {
        $totalInstall = $notes->includedInstall->price * $notes->includedInstall->qty * $wide;
    } else {
        $totalInstall = 0;
    }
    $getPrice = $sale->price - $totalPrint - $totalInstall;
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center">
                <div class="w-[900px]">
                    <div class="flex justify-center mt-2">
                        @if ($category == 'Service')
                            <label class="text-stone-100 text-xl font-semibold">DATA PENJUALAN CETAK / PASANG</label>
                        @else
                            <label class="text-stone-100 text-xl font-semibold">DATA PENJUALAN
                                {{ strtoupper($category) }}</label>
                        @endif
                    </div>
                    <div class="flex justify-center mt-2">
                        <div class="w-[450px] border rounded-lg mt-2 p-2 bg-white">
                            <div class="flex mt-1">
                                <label class="text-sm text-stone-900 w-28">Nomor Penjualan</label>
                                <label class="text-sm text-stone-900 ml-2">:</label>
                                <label class="text-sm text-stone-900 ml-2 font-semibold">{{ $sale->number }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-sm text-stone-900 w-28">Tgl. Penjualan</label>
                                <label class="text-sm text-stone-900 ml-2">:</label>
                                <label class="text-sm text-stone-900 ml-2 font-semibold">
                                    {{ date('d', strtotime($sale->created_at)) }}
                                    {{ $bulan[(int) date('m', strtotime($sale->created_at))] }}
                                    {{ date('Y', strtotime($sale->created_at)) }}
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-sm text-stone-900 w-28">Dok. Approval</label>
                                <label class="text-sm text-stone-900 ml-2">:</label>
                                <a class="text-sm text-stone-900 ml-2 font-semibold" target="_blank"
                                    href="/marketing/quotation-approvals/show-approvals/{{ $category }}/{{ $sale->quotation->id }}">
                                    {{ count($quotation_approvals) }} dokumen
                                </a>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-sm text-stone-900 w-28">Dok. PO/SPK</label>
                                <label class="text-sm text-stone-900 ml-2">:</label>
                                <a href="/marketing/quotation-orders/show-orders/{{ $category }}/{{ $sale->id }}"
                                    target="_blank" class="text-sm text-stone-900 ml-2 font-semibold">
                                    {{ count($quotation_orders) }} dokumen
                                </a>
                            </div>
                            @if ($category != 'Service')
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-900 w-28">Dok. Agreement</label>
                                    <label class="text-sm text-stone-900 ml-2">:</label>
                                    <a href="/marketing/quotation-agreements/show-agreements/{{ $category }}/{{ $sale->id }}"
                                        target="_blank"
                                        class="text-sm text-stone-900 ml-2 font-semibold">{{ count($quotation_agreements) }}
                                        dokumen
                                    </a>
                                </div>
                                <div class="flex mt-1 justify-center">
                                    <label class="title-periode font-semibold">Periode Kontrak</label>
                                </div>
                                <div class="flex mt-1 justify-center w-[350px] border rounded-lg p-1">
                                    <div>
                                        <div class="flex justify-center w-[160px]">
                                            <label class="text-sm text-black flex">Awal Kontrak
                                                :</label>
                                        </div>
                                        <div class="flex justify-center w-[160px]">
                                            <label class="text-sm text-black flex font-semibold">
                                                @if ($sale->start_at)
                                                    {{ date('d', strtotime($sale->start_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($sale->start_at))] }}
                                                    {{ date('Y', strtotime($sale->start_at)) }}
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-center w-[160px]">
                                            <label class="text-sm text-black flex">Akhir Kontrak
                                                :</label>
                                        </div>
                                        <div class="flex justify-center w-[160px]">
                                            <label class="text-sm text-black flex font-semibold">
                                                @if ($sale->end_at)
                                                    {{ date('d', strtotime($sale->end_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($sale->end_at))] }}
                                                    {{ date('Y', strtotime($sale->end_at)) }}
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="w-[450px] border rounded-lg mt-2 p-2 ml-2 bg-white">
                            <div class="flex mt-1">
                                <label class="text-sm text-stone-900 w-28">No. Penawaran</label>
                                <label class="text-sm text-stone-900 ml-2">:</label>
                                <label class="text-sm text-stone-900 ml-2 font-semibold">
                                    @if ($revision_status == true)
                                        <a href="/marketing/quotation-revisions/{{ $quot_id }}"
                                            target="_blank">{{ $number }}</a>
                                    @else
                                        <a href="/marketing/quotations/{{ $quot_id }}"
                                            target="_blank">{{ $number }}</a>
                                    @endif
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-sm text-stone-900 w-28">Tgl. Penawaran</label>
                                <label class="text-sm text-stone-900 ml-2">:</label>
                                <label
                                    class="text-sm text-stone-900 ml-2 font-semibold">{{ date('d', strtotime($created_at)) }}
                                    {{ $bulan[(int) date('m', strtotime($created_at))] }}
                                    {{ date('Y', strtotime($created_at)) }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="text-sm text-stone-900 w-28">Nama Klien</label>
                                <label class="text-sm text-stone-900 ml-2">:</label>
                                <label class="text-sm text-stone-900 ml-2 font-semibold">{{ $clients->name }}</label>
                            </div>
                            @if ($clients->type == 'Perusahaan')
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-900 w-28">Perusahaan</label>
                                    <label class="text-sm text-stone-900 ml-2">:</label>
                                    <label
                                        class="text-sm text-stone-900 ml-2 font-semibold">{{ $clients->company }}</label>
                                </div>
                            @endif
                            <div class="flex mt-1">
                                <label class="text-sm text-stone-900 w-28">Alamat</label>
                                <label class="text-sm text-stone-900 ml-2">:</label>
                                <label
                                    class="ml-2 w-[300px] text-stone-900 text-sm font-semibold">{{ $clients->address }}</label>
                            </div>
                            @if ($clients->type == 'Perusahaan')
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-900 w-28">Kontak Person</label>
                                    <label class="text-sm text-stone-900 ml-2">:</label>
                                    <label
                                        class="text-sm text-stone-900 ml-2 font-semibold">{{ $clients->contact_name }}</label>
                                </div>
                            @endif
                            @if ($clients->type == 'Perusahaan')
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-900 w-28">No. Handphone</label>
                                    <label class="text-sm text-stone-900 ml-2">:</label>
                                    <label
                                        class="text-sm text-stone-900 ml-2 font-semibold">{{ $clients->contact_phone }}</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-900 w-28">Email</label>
                                    <label class="text-sm text-stone-900 ml-2">:</label>
                                    <label
                                        class="text-sm text-stone-900 ml-2 font-semibold">{{ $clients->contact_email }}</label>
                                </div>
                            @elseif ($clients->type == 'Perorangan')
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-900 w-28">No. Handphone</label>
                                    <label class="text-sm text-stone-900 ml-2">:</label>
                                    <label class="text-sm text-stone-900 ml-2 font-semibold">{{ $clients->phone }}</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-900 w-28">Email</label>
                                    <label class="text-sm text-stone-900 ml-2">:</label>
                                    <label class="text-sm text-stone-900 ml-2 font-semibold">{{ $clients->email }}</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- table start -->
            <div class="flex justify-center mt-2">
                <div class="w-[900px] bg-white">
                    @if ($category == 'Service')
                        @include('sales-reviews.service-show-table')
                    @else
                        @include('sales-reviews.show-table')
                    @endif
                </div>
            </div>
            <!-- table end -->

            <!-- notes start -->
            <div class="flex justify-center mt-2">
                <div class="mt-1 rounded-lg w-[440px] p-2 bg-white">
                    <div>
                        <label class="text-sm font-semibold underline text-stone-900">Termin Pembayaran</label>
                        @foreach ($payment_terms->dataPayments as $payment_term)
                            <div class="flex">
                                <label class="ml-1 flex text-sm text-stone-900 w-4">{{ $loop->iteration }}. </label>
                                <label class="flex text-sm text-stone-900 w-[340px]">{{ $payment_term->term }}
                                    {{ $payment_term->note }}</label>
                            </div>
                        @endforeach
                    </div>
                    @if ($category != 'Service')
                        <div class="mt-4">
                            <label class="text-sm font-semibold underline text-stone-900">Gratis Pelayanan :</label>
                            <div>
                                @foreach ($salesNote as $note)
                                    <label class="flex text-sm text-stone-900 w-[340px]">{{ $note }}</label>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mt-1 rounded-lg w-[440px] p-2 ml-5 bg-white">
                    <div class="flex w-full">
                        <label class="flex text-md font-semibold text-stone-900">Telah Diperiksa Oleh :</label>
                    </div>
                    @foreach ($sale->sales_reviews as $review)
                        @php
                            if (auth()->user()->id == $review->user_id) {
                                $reviewed = true;
                            }
                        @endphp
                        <div class="flex mt-2">
                            <label class="flex">{{ $loop->iteration }}.</label>
                            <label class="flex ml-2">{{ $review->user->name }}, </label>
                            <label class="flex ml-2">tanggal : {{ date('d', strtotime($review->created_at)) }}
                                {{ $bulan_full[(int) date('m', strtotime($review->created_at))] }}
                                {{ date('Y', strtotime($review->created_at)) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- notes end -->

            <form method="post" action="/sales-review" enctype="multipart/form-data">
                @csrf
                <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
                <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                <input type="text" name="note" value="Telah diperiksa oleh : {{ auth()->user()->name }}" hidden>
                <input type="text" name="company_id" value="{{ $company->id }}" hidden>
                <input type="text" name="sale_month" value="{{ (int) date('m', strtotime($sale->created_at)) }}"
                    hidden>
                <input type="text" name="sale_year" value="{{ date('Y', strtotime($sale->created_at)) }}" hidden>
                <div class="flex justify-center items-center mt-2 border rounded-lg p-2">
                    <a class="flex justify-center items-center btn-danger"
                        href="/sales-review/{{ $company->id }}?month={{ (int) date('m', strtotime($sale->created_at)) }}&year={{ date('Y', strtotime($sale->created_at)) }}">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.012 2c5.518 0 9.997 4.48 9.997 9.998 0 5.517-4.479 9.997-9.997 9.997s-9.998-4.48-9.998-9.997c0-5.518 4.48-9.998 9.998-9.998zm-1.523 6.21s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1 text-sm">Back</span>
                    </a>
                    @if ($reviewed == false)
                        <button class="flex justify-center items-center btn-success mx-2">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1 text-sm">Confirm</span>
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <!-- Container end -->
@endsection
