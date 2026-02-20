@extends('dashboard.layouts.main');

@section('container')
    <?php
    $reviewed = false;
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $bulan_full = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    $client = json_decode($payment->billings[0]->client);
    if (!empty($payment->income_tax_document)) {
        $images = json_decode($payment->income_tax_document->images);
    } else {
        $images = [];
    }
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- table start -->
            <div class="flex justify-center border rounded-lg w-[1200px] p-4 mt-4">
                <div class="w-[950px]">
                    <label class="text-lg font-bold text-white">DETAIL PEMBAYARAN</label>
                    <div class="p-2 mt-1 border rounded-lg">
                        <div class="flex">
                            <label class="text-lg text-stone-100 w-24">Perusahaan</label>
                            <label class="text-lg text-stone-100 ml-2">:</label>
                            <label class="text-lg text-stone-100 ml-2">
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
                            <label class="text-lg text-stone-100 w-24">Alamat</label>
                            <label class="text-lg text-stone-100 ml-2">:</label>
                            <label class="text-lg text-stone-100 w-[800px] ml-2">{{ $client->address }}</label>
                        </div>
                    </div>
                    <label class="flex text-lg font-bold text-white mt-2">DATA INVOICE</label>
                    <div class="p-2 mt-1 border rounded-lg text-lg text-stone-100">
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
                                                Sewa Media
                                            @endif
                                        </label>
                                    </div>
                                    <table class="table-auto w-full text-md">
                                        <thead>
                                            <tr class="text-black bg-stone-400">
                                                <th class="border border-black w-12">No.</th>
                                                <th class="border border-black">Deskripsi</th>
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
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="flex mt-1 w-80">
                                        <label class="w-40">Nominal Invoice</label>
                                        <label class="ml-2">:</label>
                                        <label class="ml-2">Rp. </label>
                                        <label class="text-right w-28">{{ number_format($billing->nominal) }},-</label>
                                    </div>
                                    <div class="flex mt-1 w-80 border-b">
                                        <label class="w-40">PPN</label>
                                        <label class="ml-2">:</label>
                                        <label class="ml-2">Rp. </label>
                                        <label class="text-right w-28">{{ number_format($billing->ppn) }},-</label>
                                    </div>
                                    <div class="flex mt-1 w-80">
                                        <label class="w-40">Total</label>
                                        <label class="ml-2">:</label>
                                        <label class="ml-2">Rp. </label>
                                        <label
                                            class="text-right w-28">{{ number_format($billing->nominal + $billing->ppn) }},-</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <label class="flex text-lg font-bold text-white mt-2">DATA PEMBAYARAN</label>
                    <div class="flex">
                        <div class="p-2 mt-1 border rounded-lg">
                            <div class="flex mt-1 w-[360px]">
                                <label class="text-lg text-stone-100 w-48">Total Tagihan</label>
                                <label class="text-lg text-stone-100 ml-2">:</label>
                                <label class="text-lg text-stone-100 ml-2">Rp. </label>
                                <label
                                    class="text-lg text-stone-100 text-right w-28">{{ number_format($payment->billings->sum('nominal') + $payment->billings->sum('ppn')) }},-</label>
                            </div>
                            <div class="flex mt-1 w-[360px] border-b">
                                <label class="text-lg text-stone-100 w-48">Pemotongan PPh</label>
                                <label class="text-lg text-stone-100 ml-2">:</label>
                                <label class="text-lg text-stone-100 ml-2">Rp. </label>
                                <label
                                    class="text-lg text-stone-100 text-right w-28">{{ number_format($payment->income_taxes->sum('nominal')) }},-</label>
                            </div>
                            <div class="flex mt-1 w-[360px]">
                                <label class="text-lg text-stone-100 w-48">Nominal Pembayaran</label>
                                <label class="text-lg text-stone-100 ml-2">:</label>
                                <label class="text-lg text-stone-100 ml-2">Rp. </label>
                                <label
                                    class="text-lg text-stone-100 text-right w-28">{{ number_format($payment->nominal) }},-</label>
                            </div>
                            <div class="flex mt-1 w-[360px]">
                                <label class="text-lg text-stone-100 w-48">Tgl. Pembayaran</label>
                                <label class="text-lg text-stone-100 ml-2">:</label>
                                <label class="text-lg text-stone-100 ml-2">
                                    {{ date('d', strtotime($payment->payment_date)) }}
                                    {{ $bulan_full[(int) date('m', strtotime($payment->payment_date))] }}
                                    {{ date('Y', strtotime($payment->payment_date)) }}
                                </label>
                            </div>
                        </div>
                        <div class="mt-1 rounded-lg w-full p-2 ml-5 bg-white">
                            <div class="flex w-full">
                                <label class="flex text-md font-semibold text-stone-900">Telah Diperiksa Oleh :</label>
                            </div>
                            @foreach ($payment->payment_reviews as $review)
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
                </div>
            </div>
            <!-- table end -->

            <form method="post" action="/payment-review" enctype="multipart/form-data">
                @csrf
                <input type="text" name="payment_id" value="{{ $payment->id }}" hidden>
                <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                <input type="text" name="note" value="Telah diperiksa oleh : {{ auth()->user()->name }}" hidden>
                <input type="text" name="company_id" value="{{ $company->id }}" hidden>
                <input type="text" name="payment_month"
                    value="{{ (int) date('m', strtotime($payment->payment_date)) }}" hidden>
                <input type="text" name="payment_year" value="{{ date('Y', strtotime($payment->payment_date)) }}"
                    hidden>
                <div class="flex justify-center items-center mt-2 border rounded-lg p-2">
                    <a class="flex justify-center items-center btn-danger"
                        href="/payment-review/{{ $company->id }}?month={{ (int) date('m', strtotime($payment->payment_date)) }}&year={{ date('Y', strtotime($payment->payment_date)) }}">
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
