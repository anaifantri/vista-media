@extends('dashboard.layouts.main');

@section('container')
    @php
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
        $month = [
            1 => 'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des',
        ];

        $invoice_content = json_decode($billing->invoice_content);
        $receipt_content = json_decode($billing->receipt_content);
        $client = json_decode($billing->client);
        $invoice_descriptions = $invoice_content->description;
        if (fmod(count($invoice_descriptions), 4) == 0) {
            $pageQty = count($invoice_descriptions) / 4;
        } else {
            $pageQty = (count($invoice_descriptions) - fmod(count($invoice_descriptions), 4)) / 4 + 1;
        }
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex border-b">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
                    type="button">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1">Save PDF</span>
                </button>
                <a class="flex justify-center items-center mx-1 btn-danger" href="/billings/index/{{ $company->id }}">
                    <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                    <span class="mx-1">Close</span>
                </a>
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
            <div class="flex justify-center w-full mt-2">
                <div id="pdfPreview" class="w-[950px]mt-2">
                    <!-- Surat Invoice start -->
                    @for ($i = 0; $i < $pageQty; $i++)
                        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="w-full flex justify-center mt-2">
                                <div class="h-[1100px]">
                                    <label
                                        class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-2">
                                        <u>INVOICE</u>
                                    </label>
                                    <div class="flex mt-4">
                                        <div class="w-[380px] h-[180px] border rounded-lg p-1">
                                            <div class="flex items-center ml-2">
                                                <label class="text-md w-[72px]">Nomor</label>
                                                <label class="text-md">:</label>
                                                <label
                                                    class="text-md font-mono font-semibold ml-2">{{ $billing->invoice_number }}</label>
                                            </div>
                                            <div class="flex items-center ml-2">
                                                <label class="text-md w-[72px]">Tanggal</label>
                                                <label class="text-md">:</label>
                                                <label class="text-md font-mono font-semibold ml-2">
                                                    {{ date('d', strtotime($billing->created_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($billing->created_at))] }}
                                                    {{ date('Y', strtotime($billing->created_at)) }}
                                                </label>
                                            </div>
                                            <div class="mt-2">
                                                <label class="flex text-md ml-2 font-semibold">
                                                    Dokumen :
                                                </label>
                                            </div>
                                            <div class="flex items-center text-sm ml-2 mt-1 border-b">
                                                <label class="w-24">No. Penawaran</label>
                                                <label class="">:</label>
                                                <label
                                                    class="ml-2 w-24 font-semibold">{{ substr($invoice_content->approval->number, 0, 9) }}..</label>
                                                <label class="w-8">Tgl.</label>
                                                <label class="">:</label>
                                                <label class="ml-2 font-semibold">
                                                    {{ date('d', strtotime($invoice_content->approval->created_at)) }}-{{ $month[(int) date('m', strtotime($invoice_content->approval->created_at))] }}-{{ date('Y', strtotime($invoice_content->approval->created_at)) }}
                                                </label>
                                            </div>
                                            @foreach ($invoice_content->orders as $itemOrder)
                                                <div class="flex items-center text-sm ml-2 mt-1 border-b">
                                                    <label class="w-24">No. PO</label>
                                                    <label class="">:</label>
                                                    <label class="ml-2 w-24 font-semibold">
                                                        @if (strlen($itemOrder->number) > 9)
                                                            {{ substr($itemOrder->number, 0, 9) }}..
                                                        @else
                                                            {{ $itemOrder->number }}
                                                        @endif
                                                    </label>
                                                    <label class="w-8">Tgl.</label>
                                                    <label class="">:</label>
                                                    <label class="ml-2 font-semibold">
                                                        {{ date('d', strtotime($itemOrder->date)) }}-{{ $month[(int) date('m', strtotime($itemOrder->date))] }}-{{ date('Y', strtotime($itemOrder->date)) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                            @foreach ($invoice_content->agreements as $itemAgreement)
                                                <div class="flex items-center text-sm ml-2 mt-1 border-b">
                                                    <label class="w-24">No. Perjanjian</label>
                                                    <label class="">:</label>
                                                    <label class="ml-2 w-24 font-semibold">
                                                        @if (strlen($itemAgreement->number) > 9)
                                                            {{ substr($itemAgreement->number, 0, 9) }}..
                                                        @else
                                                            {{ $itemAgreement->number }}
                                                        @endif
                                                    </label>
                                                    <label class="w-8">Tgl.</label>
                                                    <label class="">:</label>
                                                    <label class="ml-2 font-semibold">
                                                        {{ date('d', strtotime($itemAgreement->date)) }}-{{ $month[(int) date('m', strtotime($itemAgreement->date))] }}-{{ date('Y', strtotime($itemAgreement->date)) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="w-[380px] h-[180px] border rounded-lg p-1 ml-2">
                                            <label class="text-lg font-mono font-semibold ml-2">Kepada Yth.</label>
                                            <div class="flex ml-2">
                                                <label class="text-sm w-24">Nama</label>
                                                <label class="text-sm">:</label>
                                                <label class=" ml-2 text-sm font-semibold">{{ $client->contact }}</label>
                                            </div>
                                            <div class="flex ml-2">
                                                <label class="text-sm w-24">Perusahaan</label>
                                                <label class="text-sm">:</label>
                                                <label class="text-sm ml-2 font-semibold">{{ $client->company }}</label>
                                            </div>
                                            <div class="flex ml-2">
                                                <label class="text-sm w-24">Alamat</label>
                                                <label class="text-sm">:</label>
                                                <textarea class="text-sm ml-1 px-1 w-[250px] outline-none border rounded-md font-semibold" rows="3" readonly>{{ $client->address }}</textarea>
                                            </div>
                                            <div class="flex ml-2">
                                                <label class="text-sm w-24">No. Telp.</label>
                                                <label class="text-sm">:</label>
                                                <label
                                                    class=" ml-2 text-sm font-semibold">{{ $client->contact_phone }}</label>
                                            </div>
                                            <div class="flex ml-2">
                                                <label class="text-sm w-24">Email</label>
                                                <label class="text-sm">:</label>
                                                <label
                                                    class=" ml-2 text-sm font-semibold">{{ $client->contact_email }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table-auto w-full mt-4">
                                        <thead>
                                            <tr class="text-sm">
                                                <th class="border h-8 w-8">No.</th>
                                                <th class="border h-8 ">Deskripsi</th>
                                                <th class="border h-8 w-36">Harga</th>
                                                <th class="border h-8 w-36">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice_descriptions as $invoiceItem)
                                                @if ($loop->iteration > $i * 4 && $loop->iteration < ($i + 1) * 4 + 1)
                                                    <tr class="text-sm">
                                                        <td class="border px-2">{{ $loop->iteration }}</td>
                                                        <td class="border px-2">{{ $invoiceItem->title }}</td>
                                                        <td class="border px-2 text-right">
                                                            <div class="flex justify-end">
                                                                <label class="w-6">Rp. </label>
                                                                <label
                                                                    class="w-full flex justify-end">{{ number_format($invoiceItem->nominal) }}</label>
                                                                <label class="w-4">,-</label>
                                                            </div>
                                                        </td>
                                                        <td class="border px-2 text-right">
                                                            <div class="flex justify-end">
                                                                <label class="w-6">Rp. </label>
                                                                <label
                                                                    class="w-full flex justify-end">{{ number_format($invoiceItem->nominal) }}</label>
                                                                <label class="w-4">,-</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="text-sm">
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2">
                                                            <div class="flex w-full">
                                                                <span class="w-16">Jenis</span>
                                                                <span>:</span>
                                                                <span class="ml-2">{{ $invoiceItem->type }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2"></td>
                                                    </tr>
                                                    <tr class="text-sm">
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2">
                                                            <div class="flex w-full">
                                                                <span class="w-16">Ukuran</span>
                                                                <span>:</span>
                                                                <span class="ml-2">{{ $invoiceItem->size }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2"></td>
                                                    </tr>
                                                    <tr class="text-sm">
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2">
                                                            <div class="flex w-full">
                                                                <span class="w-16">Jumlah</span>
                                                                <span>:</span>
                                                                <span class="ml-2">{{ $invoiceItem->qty }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2"></td>
                                                    </tr>
                                                    <tr class="text-sm">
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2">
                                                            <div class="flex w-full">
                                                                @if ($billing->category == 'Service')
                                                                    <span class="w-16">Tema</span>
                                                                    <span>:</span>
                                                                    <span class="ml-2">{{ $invoiceItem->theme }}</span>
                                                                @elseif ($billing->category == 'Media')
                                                                    <span class="w-16">Periode</span>
                                                                    <span>:</span>
                                                                    <span
                                                                        class="ml-2">{{ $invoiceItem->periode }}</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2"></td>
                                                    </tr>
                                                    <tr class="text-sm">
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2">
                                                            <div class="flex w-full">
                                                                <span class="w-16">Lokasi</span>
                                                                <span>:</span>
                                                                <span
                                                                    class="ml-2 w-[300px]">{{ $invoiceItem->location }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="border px-2"></td>
                                                        <td class="border px-2"></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            @if ($i == $pageQty - 1)
                                                <tr class="text-sm">
                                                    <td class="border px-4" colspan="2" rowspan="4">
                                                        <u>Pembayaran :</u>
                                                        <div class="flex">
                                                            <label class="w-20">No. Rek.</label>
                                                            <label>:</label>
                                                            <label class="ml-2 font-semibold">040 232 111</label>
                                                        </div>
                                                        <div class="flex">
                                                            <label class="w-20">Nama</label>
                                                            <label>:</label>
                                                            <label class="ml-2 font-semibold">VISTA MEDIA PT</label>
                                                        </div>
                                                        <div class="flex">
                                                            <label class="w-20">Bank</label>
                                                            <label>:</label>
                                                            <label class="ml-2 font-semibold">BCA Cabang Hasanudin,
                                                                Denpasar - Bali</label>
                                                        </div>
                                                    </td>
                                                    <td class="border text-right px-2 font-semibold">SUB TOTAL</td>
                                                    <td class="border text-right font-semibold">
                                                        <div class="flex w-full justify-end px-1">
                                                            <label class="w-6">Rp. </label>
                                                            <label
                                                                class="w-full flex justify-end">{{ number_format($billing->nominal) }}</label>
                                                            <label class="w-4">,-</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border text-right px-2 font-semibold">DPP</td>
                                                    <td class="border text-right font-semibold">
                                                        <div class="flex w-full justify-end px-1">
                                                            <label class="w-6">Rp. </label>
                                                            <label
                                                                class="w-full flex justify-end">{{ number_format(($billing->dpp / 12) * 11) }}</label>
                                                            <label class="w-4">,-</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border text-right px-2 font-semibold">PPN</td>
                                                    <td class="border text-right font-semibold">
                                                        <div class="flex w-full justify-end px-1">
                                                            <label class="w-6">Rp. </label>
                                                            <label
                                                                class="w-full flex justify-end">{{ number_format($billing->ppn) }}</label>
                                                            <label class="w-4">,-</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border text-right px-2 font-semibold">GRAND TOTAL</td>
                                                    <td class="border text-right font-semibold">
                                                        <div class="flex w-full justify-end px-1">
                                                            <label class="w-6">Rp. </label>
                                                            <label
                                                                class="w-full flex justify-end">{{ number_format($billing->nominal + $billing->ppn) }}</label>
                                                            <label class="w-4">,-</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if ($i == $pageQty - 1)
                                        <label class="mt-4 text-sm flex justify-center w-72">Hormat kami,</label>
                                        <label
                                            class="text-sm flex justify-center w-72 font-semibold">{{ $company->name }}</label>
                                        <label class="mt-12 text-sm flex justify-center w-72 font-semibold">
                                            <u>Texun Sandy Kamboy</u>
                                        </label>
                                        <label class="text-sm flex justify-center w-72">Direktur</label>
                                    @endif
                                </div>
                            </div>
                            <!-- Body end -->
                            @if ($pageQty > 1)
                                <div class="flex w-[850px] justify-end text-sm">
                                    Halaman {{ $i + 1 }} dari {{ $pageQty }}
                                </div>
                            @endif
                            <!-- Footer start -->
                            @include('dashboard.layouts.letter-footer')
                            <!-- Footer end -->
                        </div>
                    @endfor
                    <!-- Surat Invoice end -->

                    <!-- Kwitansi start -->
                    <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                        <!-- Header start -->
                        @include('billings.receipt-header-preview')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="mt-4">
                            <div class="flex w-full items-center px-10">
                                <div class="w-[950px] h-[275px] p-4 border-2 border-black text-sm">
                                    <div class="flex">
                                        <label class="w-40">Telah terima dari</label>
                                        <label>:</label>
                                        <label
                                            class="ml-2 border-b border-dotted w-[650px]"><b>{{ $client->company }}</b></label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40">Banyaknya Uang</label>
                                        <label>:</label>
                                        <label
                                            class="ml-2 border-b border-dotted font-semibold italic w-[650px]">{{ $receipt_content->terbilang }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40">Untuk Pembayaran</label>
                                        <label>:</label>
                                        <label
                                            class="ml-2 border-b border-dotted font-semibold w-[650px]">{{ $receipt_content->title }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40"></label>
                                        <label></label>
                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                            <div class="flex w-full">
                                                <span class="w-16">Jenis</span>
                                                <span>:</span>
                                                <span class="ml-2">{{ $receipt_content->type }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40"></label>
                                        <label></label>
                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                            <div class="flex w-full">
                                                <span class="w-16">Ukuran</span>
                                                <span>:</span>
                                                <span class="ml-2">{{ $receipt_content->size }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40"></label>
                                        <label></label>
                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                            <div class="flex w-full">
                                                <span class="w-16">Jumlah</span>
                                                <span>:</span>
                                                <span class="ml-2">{{ $receipt_content->qty }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40"></label>
                                        <label></label>
                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                            <div class="flex w-full">
                                                @if ($billing->category == 'Service')
                                                    <span class="w-16">Tema</span>
                                                    <span>:</span>
                                                    <label
                                                        class="ml-2 border-b border-dotted font-semibold">{{ $receipt_content->theme }}</label>
                                                @elseif ($billing->category == 'Media')
                                                    <span class="w-16">Periode</span>
                                                    <span>:</span>
                                                    <label
                                                        class="ml-2 border-b border-dotted font-semibold">{{ $receipt_content->periode }}</label>
                                                @endif
                                            </div>
                                        </label>
                                    </div>
                                    @if ($billing->category == 'Media')
                                        <div class="flex">
                                            <label class="w-40"></label>
                                            <label></label>
                                            <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                                <div class="flex w-full">
                                                    <span class="w-16">Lokasi</span>
                                                    <span>:</span>
                                                    <span class="ml-2">{{ $receipt_content->location }}</span>
                                                </div>
                                            </label>
                                        </div>
                                    @elseif($billing->category == 'Service')
                                        @if (count($invoice_descriptions) < 5)
                                            @foreach ($invoice_descriptions as $item)
                                                <div class="flex">
                                                    <label class="w-40"></label>
                                                    <label></label>
                                                    @if ($loop->iteration == 1)
                                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                                            <div class="flex w-full">
                                                                <span class="w-16">Lokasi</span>
                                                                <span>:</span>
                                                                <span class="ml-2">{{ $loop->iteration }}.
                                                                    {{ $item->location }}
                                                                </span>
                                                            </div>
                                                        </label>
                                                    @else
                                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                                            <div class="flex w-full">
                                                                <span class="w-16"></span>
                                                                <span></span>
                                                                <span class="ml-3">
                                                                    {{ $loop->iteration }}. {{ $item->location }}
                                                                </span>
                                                            </div>
                                                        </label>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex">
                                                <label class="w-40"></label>
                                                <label></label>
                                                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                                    <div class="flex w-full">
                                                        <span class="w-16">Lokasi</span>
                                                        <span>:</span>
                                                        <span class="ml-2">Tertera pada invoice nomor :
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Body end -->
                        <!-- Sign start -->
                        @include('billings.receipt-service-sign-preview')
                        <!-- Sign end -->
                        <div class="flex w-full justify-center items-center pt-2">
                            <div class="border-t h-2 border-slate-500 border-dashed w-full">
                            </div>
                        </div>
                        <!-- Header start -->
                        @include('billings.receipt-header-preview')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="mt-4">
                            <div class="flex w-full items-center px-10">
                                <div class="w-[950px] h-[275px] p-4 border-2 border-black text-sm">
                                    <div class="flex">
                                        <label class="w-40">Telah terima dari</label>
                                        <label>:</label>
                                        <label
                                            class="ml-2 border-b border-dotted w-[650px]"><b>{{ $client->company }}</b></label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40">Banyaknya Uang</label>
                                        <label>:</label>
                                        <label
                                            class="ml-2 border-b border-dotted font-semibold italic w-[650px]">{{ $receipt_content->terbilang }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40">Untuk Pembayaran</label>
                                        <label>:</label>
                                        <label
                                            class="ml-2 border-b border-dotted font-semibold w-[650px]">{{ $receipt_content->title }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40"></label>
                                        <label></label>
                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                            <div class="flex w-full">
                                                <span class="w-16">Jenis</span>
                                                <span>:</span>
                                                <span class="ml-2">{{ $receipt_content->type }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40"></label>
                                        <label></label>
                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                            <div class="flex w-full">
                                                <span class="w-16">Ukuran</span>
                                                <span>:</span>
                                                <span class="ml-2">{{ $receipt_content->size }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40"></label>
                                        <label></label>
                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                            <div class="flex w-full">
                                                <span class="w-16">Jumlah</span>
                                                <span>:</span>
                                                <span class="ml-2">{{ $receipt_content->qty }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="flex">
                                        <label class="w-40"></label>
                                        <label></label>
                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                            <div class="flex w-full">
                                                @if ($billing->category == 'Service')
                                                    <span class="w-16">Tema</span>
                                                    <span>:</span>
                                                    <label
                                                        class="ml-2 border-b border-dotted font-semibold">{{ $receipt_content->theme }}</label>
                                                @elseif ($billing->category == 'Media')
                                                    <span class="w-16">Periode</span>
                                                    <span>:</span>
                                                    <label
                                                        class="ml-2 border-b border-dotted font-semibold">{{ $receipt_content->periode }}</label>
                                                @endif
                                            </div>
                                        </label>
                                    </div>
                                    @if ($billing->category == 'Media')
                                        <div class="flex">
                                            <label class="w-40"></label>
                                            <label></label>
                                            <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                                <div class="flex w-full">
                                                    <span class="w-16">Lokasi</span>
                                                    <span>:</span>
                                                    <span class="ml-2">{{ $receipt_content->location }}</span>
                                                </div>
                                            </label>
                                        </div>
                                    @elseif($billing->category == 'Service')
                                        @if (count($invoice_descriptions) < 5)
                                            @foreach ($invoice_descriptions as $item)
                                                <div class="flex">
                                                    <label class="w-40"></label>
                                                    <label></label>
                                                    @if ($loop->iteration == 1)
                                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                                            <div class="flex w-full">
                                                                <span class="w-16">Lokasi</span>
                                                                <span>:</span>
                                                                <span class="ml-2">{{ $loop->iteration }}.
                                                                    {{ $item->location }}
                                                                </span>
                                                            </div>
                                                        </label>
                                                    @else
                                                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                                            <div class="flex w-full">
                                                                <span class="w-16"></span>
                                                                <span></span>
                                                                <span class="ml-3">
                                                                    {{ $loop->iteration }}. {{ $item->location }}
                                                                </span>
                                                            </div>
                                                        </label>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex">
                                                <label class="w-40"></label>
                                                <label></label>
                                                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                                    <div class="flex w-full">
                                                        <span class="w-16">Lokasi</span>
                                                        <span>:</span>
                                                        <span class="ml-2">Tertera pada invoice nomor :
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Body end -->
                        <!-- Sign start -->
                        @include('billings.receipt-service-sign-preview')
                        <!-- Sign end -->
                    </div>
                    <!-- Kwitansi end -->
                </div>
            </div>
        </div>
        @if ($billing->category == 'Media')
            <input id="saveName" type="text"
                value="{{ substr($billing->invoice_number, 0, 3) }}-Media-{{ $client->company }}-{{ $receipt_content->location }}"
                hidden>
        @elseif($billing->category == 'Service')
            <input id="saveName" type="text"
                value="{{ substr($billing->invoice_number, 0, 3) }}-Revisual-{{ $client->company }}-{{ $receipt_content->location }}"
                hidden>
        @endif
    </div>

    <!-- Script start-->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const saveName = document.getElementById("saveName");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: saveName.value + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 192,
                    scale: 2,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [950, 1365],
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            // html2pdf(element, opt);
            html2pdf().set(opt).from(element).save();
        };
    </script>
    <!-- Script end-->
@endsection
