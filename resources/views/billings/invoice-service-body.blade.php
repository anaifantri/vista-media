<div class="w-full flex justify-center mt-2">
    <div class="h-[1100px]">
        <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-2">
            <u>INVOICE</u>
        </label>
        <div class="flex mt-4">
            <div class="w-[380px] h-[180px] border rounded-lg p-1">
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
                @php
                    if (count($quotation_orders) > 0) {
                        $firstOrderNumber = $bill_documents->orders[0]->number;
                    } else {
                        $firstOrderNumber = '';
                    }
                @endphp
                @foreach ($bill_documents->orders as $itemOrder)
                    @if ($loop->iteration > 1)
                        @if ($itemOrder->number != $firstOrderNumber)
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
                        @endif
                    @else
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
                    @endif
                @endforeach
            </div>
            <div class="w-[380px] h-[180px] border rounded-lg p-1 ml-2">
                <label class="text-lg font-mono font-semibold ml-2">Kepada Yth.</label>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Nama</label>
                    <label class="text-sm">:</label>
                    <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                        name="client_contact" type="text" value="{{ $bill_client->contact_name }}"
                        onchange="changeClient(this)">
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Perusahaan</label>
                    <label class="text-sm">:</label>
                    <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                        name="client_company" type="text" value="{{ $client->company }}"
                        onchange="changeClient(this)">
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
                                    <label class="w-full flex justify-end">{{ $invoiceItem->nominal }}</label>
                                    <label class="w-4">,-</label>
                                </div>
                            </td>
                            <td class="border px-2 text-right">
                                <div class="flex justify-end">
                                    <label class="w-6">Rp. </label>
                                    <label class="w-full flex justify-end">{{ $invoiceItem->nominal }}</label>
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
                                    <span class="w-16">Tema</span>
                                    <span>:</span>
                                    <input id="invoiceTheme{{ $loop->iteration - 1 }}"
                                        class="w-[400px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                                        name="invoice_theme" type="text" value="{{ $invoiceItem->theme }}"
                                        onchange="changeInvoiceTheme(this)">
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
                                    <span class="ml-2 w-[300px]">{{ $invoiceItem->location }}</span>
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
                                <label class="ml-2 font-semibold">{{ $bank_account->number }}</label>
                            </div>
                            <div class="flex">
                                <label class="w-20">Nama</label>
                                <label>:</label>
                                <label class="ml-2 font-semibold">{{ $bank_account->name }}</label>
                            </div>
                            <div class="flex">
                                <label class="w-20">Bank</label>
                                <label>:</label>
                                <label class="ml-2 font-semibold">{{ $bank_account->bank }}</label>
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
                                    class="w-full flex justify-end">{{ number_format(($totalDpp / 12) * 11) }}</label>
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
                @endif
            </tbody>
        </table>
        @if ($i == $pageQty - 1)
            <label class="mt-4 text-sm flex justify-center w-72">Hormat kami,</label>
            <label class="text-sm flex justify-center w-72 font-semibold">{{ $company->name }}</label>
            <label class="mt-12 text-sm flex justify-center w-72 font-semibold">
                <u>Texun Sandy Kamboy</u>
            </label>
            <label class="text-sm flex justify-center w-72">Direktur</label>
        @endif
    </div>
</div>
