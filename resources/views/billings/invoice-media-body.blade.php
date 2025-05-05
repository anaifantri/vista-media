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
                        class="ml-2 w-24 font-semibold">{{ substr($bill_documents->approval->number, 0, 9) }}..</label>
                    <label class="w-8">Tgl.</label>
                    <label class="">:</label>
                    <label class="ml-2 font-semibold">
                        {{ date('d', strtotime($bill_documents->approval->created_at)) }}-{{ $month[(int) date('m', strtotime($bill_documents->approval->created_at))] }}-{{ date('Y', strtotime($bill_documents->approval->created_at)) }}
                    </label>
                </div>
                @foreach ($bill_documents->orders as $itemOrder)
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
                @foreach ($bill_documents->agreements as $itemAgreement)
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
                    <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                        name="client_contact" type="text" value="{{ $bill_client->contact }}"
                        onchange="changeClient(this)">
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Perusahaan</label>
                    <label class="text-sm">:</label>
                    <label class="text-sm ml-2 font-semibold">{{ $bill_client->company }}</label>
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Alamat</label>
                    <label class="text-sm">:</label>
                    <textarea class="text-sm ml-1 px-1 w-[250px] outline-none border rounded-md font-semibold" name="client_address"
                        rows="3" onchange="changeClient(this)">{{ $bill_client->address }}</textarea>
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">No. Telp.</label>
                    <label class="text-sm">:</label>
                    <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                        name="contact_phone" type="text" value="{{ $bill_client->contact_phone }}"
                        onchange="changeClient(this)">
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Email</label>
                    <label class="text-sm">:</label>
                    <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                        name="contact_email" type="text" value="{{ $bill_client->contact_email }}"
                        onchange="changeClient(this)">
                </div>
            </div>
        </div>
        @if (count($sales) == 2)
            <div class="flex text-sm mt-2">
                <span>Penggabungan : </span>
                <input class="ml-2 outline-none" type="radio" name="merge" value="normal"
                    onclick="mergeAction(this)" checked>
                <span class="ml-1">Normal</span>
                <input class="ml-4 outline-none" type="radio" name="merge" value="size"
                    onclick="mergeAction(this)">
                <span class="ml-1">Ukuran</span>
                <input class="ml-4 outline-none" type="radio" name="merge" value="side"
                    onclick="mergeAction(this)">
                <span class="ml-1">Media</span>
            </div>
        @endif
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
                @php
                    $number = 0;
                @endphp
                @foreach ($invoice_descriptions as $invoiceItem)
                    @php
                        $number++;
                    @endphp
                    <tr class="text-sm">
                        <td class="border px-2">{{ $number }}</td>
                        <td class="border px-2">
                            <div class="w-full">
                                <input class="w-full px-1 text-sm outline-none border rounded-md font-semibold"
                                    id="invoiceTitle{{ $loop->iteration - 1 }}" name="invoice_title" type="text"
                                    value="{{ $invoiceItem->title }}" onchange="changeInvoiceTitle(this)">
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
                                <span id="invoiceSize" class="ml-2">{{ $invoiceItem->size }}</span>
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
                                <span id="invoiceQty" class="ml-2">{{ $invoiceItem->qty }}</span>
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
                                <span class="ml-2">{{ $invoiceItem->periode }}</span>
                            </div>
                        </td>
                        <td class="border px-2"></td>
                        <td class="border px-2"></td>
                    </tr>
                    @if (count($sales) == 2)
                        @php
                            $locations = explode('*', $invoiceItem->location);
                        @endphp
                        <tr class="text-sm">
                            <td class="border px-2"></td>
                            <td class="border px-2">
                                <div class="flex w-full">
                                    <span class="w-16">Lokasi</span>
                                    <span>: 1. </span>
                                    <span class="ml-2 w-[300px]">{{ $locations[0] }}</span>
                                </div>
                            </td>
                            <td class="border px-2"></td>
                            <td class="border px-2"></td>
                        </tr>
                        <tr class="text-sm">
                            <td class="border px-2"></td>
                            <td class="border px-2">
                                <div class="flex w-full">
                                    <span class="w-16"></span>
                                    <span class="ml-2"> 2. </span>
                                    <span class="ml-2 w-[300px]">{{ $locations[1] }}</span>
                                </div>
                            </td>
                            <td class="border px-2"></td>
                            <td class="border px-2"></td>
                        </tr>
                    @else
                        <tr class="text-sm">
                            <td class="border px-2"></td>
                            <td class="border px-2">
                                <div class="flex w-full">
                                    <span class="w-16">Lokasi</span>
                                    <span>:</span>
                                    <span class="ml-2 w-[300px]">{{ $invoiceItem->location }}</span>
                                </div>
                            </td>
                            <td class="border px-2"></td>
                            <td class="border px-2"></td>
                        </tr>
                    @endif
                    <tr class="h-6">
                        <td class="border px-2"></td>
                        <td class="border px-2"></td>
                        <td class="border px-2"></td>
                        <td class="border px-2"></td>
                    </tr>
                @endforeach
                <tr class="text-sm">
                    <td class="border px-4" colspan="2" rowspan="4">
                        <u>Pembayaran :</u>
                        <div class="flex">
                            <label class="w-20">No. Rek.</label>
                            <label>:</label>
                            <label class="ml-2 font-semibold">040 232 1111</label>
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
                            <label class="w-full flex justify-end">{{ number_format($totalNominal) }}</label>
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
                            <label class="w-full flex justify-end">{{ number_format($grandTotal) }}</label>
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
