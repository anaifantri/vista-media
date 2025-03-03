<div id="modalPreview" hidden>
    <div class="flex w-full">
        <span class="text-center w-full text-lg font-semibold text-white">Preview Invoice & Kwitansi</span>
    </div>

    <!-- Surat Invoice start -->
    <div class="flex justify-center w-full mt-2">
        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
            <!-- Header start -->
            @include('dashboard.layouts.letter-header')
            <!-- Header end -->
            <!-- Body start -->
            <div class="h-[1100px] w-full flex justify-center mt-2">
                <div>
                    <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-4">
                        <u>INVOICE</u>
                    </label>
                    <div class="flex mt-4">
                        <div class="w-[380px] h-[200px] border rounded-lg p-1">
                            <div class="flex items-center ml-2">
                                <label class="text-lg w-24">Nomor</label>
                                <label class="text-lg">:</label>
                                <label class="text-lg font-mono font-semibold ml-2 text-slate-300">Penomoran
                                    otomatis</label>
                            </div>
                            <div class="flex items-center ml-2">
                                <label class="text-lg w-24">Tanggal</label>
                                <label class="text-lg">:</label>
                                <label class="text-lg font-mono font-semibold ml-2">
                                    {{ date('d') }}
                                    {{ $bulan[(int) date('m')] }}
                                    {{ date('Y') }}
                                </label>
                            </div>
                            <div class="mt-2">
                                <label class="flex text-md ml-2 font-semibold">
                                    Dokumen :
                                </label>
                            </div>
                            <div class="flex items-center text-sm ml-2 mt-1 border-b">
                                <input type="checkbox" class="outline-none mr-2" checked>
                                <label class="w-24">No. Penawaran</label>
                                <label class="">:</label>
                                <label
                                    class="ml-2 w-24 font-semibold">{{ substr($quotation_deal->number, 0, 9) }}..</label>
                                <label class="w-8">Tgl.</label>
                                <label class="">:</label>
                                <label class="ml-2 font-semibold">
                                    {{ date('d', strtotime($quotation_deal->created_at)) }}-{{ $month[(int) date('m', strtotime($quotation_deal->created_at))] }}-{{ date('Y', strtotime($quotation_deal->created_at)) }}
                                </label>
                            </div>
                            @foreach ($quotation_orders as $itemOrder)
                                <div class="flex items-center text-sm ml-2 mt-1 border-b">
                                    <input type="checkbox" class="outline-none mr-2" checked>
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
                            @foreach ($quotation_agreements as $itemAgreement)
                                <div class="flex items-center text-sm ml-2 mt-1 border-b">
                                    <input type="checkbox" class="outline-none mr-2" checked>
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
                        <div class="w-[380px] h-[200px] border rounded-lg p-1 ml-2">
                            <label class="text-lg font-mono font-semibold ml-2">Kepada Yth.</label>
                            <div class="flex ml-2">
                                <label class="text-sm w-24">Nama</label>
                                <label class="text-sm">:</label>
                                <label class="text-sm ml-2 font-semibold">
                                    @if ($client->contact_name)
                                        @if ($client->contact_gender == 'Male')
                                            Bapak {{ $client->contact_name }}
                                        @else
                                            Ibu {{ $client->contact_name }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex ml-2">
                                <label class="text-sm w-24">Perusahaan</label>
                                <label class="text-sm">:</label>
                                <label class="text-sm ml-2 font-semibold">{{ $client->company }}</label>
                            </div>
                            <div class="flex ml-2">
                                <label class="text-sm w-24">Alamat</label>
                                <label class="text-sm">:</label>
                                <label class="text-sm ml-2 w-[250px] h-[72px]">
                                    @if (strlen($client->address) > 100)
                                        {{ substr($client->address, 0, 100) }}..
                                    @else
                                        {{ $client->address }}
                                    @endif
                                </label>
                            </div>
                            <div class="flex ml-2">
                                <label class="text-sm w-24">No. Telp.</label>
                                <label class="text-sm">:</label>
                                <label class="text-sm ml-2">
                                    @if ($client->contact_phone)
                                        {{ $client->contact_phone }}
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex ml-2">
                                <label class="text-sm w-24">Email</label>
                                <label class="text-sm">:</label>
                                <label class="text-sm ml-2">
                                    @if ($client->contact_email)
                                        {{ $client->contact_email }}
                                    @else
                                        -
                                    @endif
                                </label>
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
                            @foreach ($bill_terms as $termItem)
                                @if ($termItem->set_collect == true)
                                    @php
                                        $totalNominal = $totalNominal + $termItem->nominal;
                                        $totalPpn = $totalPpn + $termItem->ppn;
                                        $totalDpp = $totalDpp + $termItem->ppn;
                                        $grandTotal = $totalNominal + $totalPpn;
                                    @endphp
                                    <tr class="text-sm">
                                        <td class="border px-2">{{ $loop->iteration }}</td>
                                        <td class="border px-2">{{ $termItem->title }} Media Luar Ruang Tahap
                                            Ke-{{ $termItem->number }} ({{ $termItem->term }}%)</td>
                                        <td class="border px-2 text-right">
                                            <div class="flex justify-end">
                                                <label class="w-6">Rp. </label>
                                                <label
                                                    class="w-full flex justify-end">{{ number_format($termItem->nominal) }}</label>
                                                <label class="w-4">,-</label>
                                            </div>
                                        </td>
                                        <td class="border px-2 text-right">
                                            <div class="flex justify-end">
                                                <label class="w-6">Rp. </label>
                                                <label
                                                    class="w-full flex justify-end">{{ number_format($termItem->nominal) }}</label>
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
                                                <span class="ml-2">{{ $product->category }}</span>
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
                                                <span class="ml-2">{{ $product->size }} x {{ $product->side }} -
                                                    {{ $product->orientation }}</span>
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
                                                <span class="ml-2">1 (Satu) Unit</span>
                                            </div>
                                        </td>
                                        <td class="border px-2"></td>
                                        <td class="border px-2"></td>
                                    </tr>
                                    <tr class="text-sm">
                                        <td class="border px-2"></td>
                                        <td class="border px-2">
                                            <div class="flex w-full">
                                                <span class="w-16">Periode</span>
                                                <span>:</span>
                                                <span class="ml-2">
                                                    {{ $priceTitle }} (
                                                    {{ date('d', strtotime($sale->start_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($sale->start_at))] }}
                                                    {{ date('Y', strtotime($sale->start_at)) }} s.d
                                                    {{ date('d', strtotime($sale->end_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($sale->end_at))] }}
                                                    {{ date('Y', strtotime($sale->end_at)) }} )
                                                </span>
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
                                                <span class="ml-2 w-[300px]">{{ $product->address }}</span>
                                            </div>
                                        </td>
                                        <td class="border px-2"></td>
                                        <td class="border px-2"></td>
                                    </tr>
                                    <tr class="h-6">
                                        <td class="border px-2"></td>
                                        <td class="border px-2"></td>
                                        <td class="border px-2"></td>
                                        <td class="border px-2"></td>
                                    </tr>
                                @endif
                            @endforeach
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
                                        <label class="ml-2 font-semibold">BCA Cabang Hasanudin, Denpasar - Bali</label>
                                    </div>
                                </td>
                                <td class="border text-right px-2 font-semibold">SUB TOTAL</td>
                                <td class="border text-right font-semibold">
                                    <div class="flex w-full justify-end px-1">
                                        <label class="w-6">Rp. </label>
                                        <label
                                            class="w-full flex justify-end">{{ number_format($totalNominal) }}</label>
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
                                            class="w-full flex justify-end">{{ number_format(($totalNominal / 12) * 11) }}</label>
                                        <label class="w-4">,-</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-sm">
                                <td class="border text-right px-2 font-semibold">PPN</td>
                                <td class="border text-right font-semibold">
                                    <div class="flex w-full justify-end px-1">
                                        <label class="w-6">Rp. </label>
                                        <label class="w-full flex justify-end">{{ number_format($totalPpn) }}</label>
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
                                            class="w-full flex justify-end">{{ number_format($grandTotal) }}</label>
                                        <label class="w-4">,-</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <label class="mt-4 text-sm flex justify-center w-72">Hormat kami,</label>
                    <label class="text-sm flex justify-center w-72 font-semibold">{{ $company->name }}</label>
                    <label class="mt-16 text-sm flex justify-center w-72 font-semibold">
                        <u>Texun Sandy Kamboy</u>
                    </label>
                    <label class="text-sm flex justify-center w-72">Direktur</label>
                </div>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            @include('dashboard.layouts.letter-footer')
            <!-- Footer end -->
        </div>
    </div>
    <!-- Surat Invoice end -->

    <!-- Kwitansi start -->
    <div class="flex justify-center w-full mt-2">
        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
            <!-- Header start -->
            @include('billings.receipt-header')
            <!-- Header end -->
            <!-- Body start -->
            @include('billings.receipt-body')
            <!-- Body end -->
            <!-- Sign start -->
            @include('billings.receipt-sign')
            <!-- Sign end -->
            <div class="flex w-full justify-center items-center pt-2">
                <div class="border-t h-2 border-slate-500 border-dashed w-full">
                </div>
            </div>
            <!-- Header start -->
            @include('billings.receipt-header')
            <!-- Header end -->
            <!-- Body start -->
            @include('billings.receipt-body')
            <!-- Body end -->
            <!-- Sign start -->
            @include('billings.receipt-sign')
            <!-- Sign end -->
        </div>
    </div>
    <!-- Kwitansi end -->
</div>
