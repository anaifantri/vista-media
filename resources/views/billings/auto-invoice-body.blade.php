<div class="h-[1100px] w-full flex justify-center mt-2">
    <div>
        <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-2">
            <u>INVOICE</u>
        </label>
        <div class="flex mt-4">
            <div class="w-[380px] h-[185px] border rounded-lg p-1">
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
                @if (!empty($approvals))
                    @foreach ($approvals as $approval)
                        @if ($loop->iteration < 5)
                            <div class="flex items-center text-xs ml-2 mt-1 border-b">
                                <label class="w-14">No. SPH</label>
                                <label class="">:</label>
                                <label class="ml-2 w-44 font-semibold">
                                    @if (strlen($approval->number) > 24)
                                        {{ substr($approval->number, 0, 10) }}..{{ substr($approval->number, -9) }}
                                    @else
                                        {{ $approval->number }}
                                    @endif
                                </label>
                                <label class="w-6">Tgl.</label>
                                <label class="">:</label>
                                <label class="ml-2 font-semibold">
                                    {{ date('d', strtotime($approval->created_at)) }}-{{ $month[(int) date('m', strtotime($approval->created_at))] }}-{{ date('Y', strtotime($approval->created_at)) }}
                                </label>
                            </div>
                        @endif
                    @endforeach
                @endif
                @if (!empty($orders))
                    @foreach ($orders as $itemOrder)
                        <div class="flex items-center text-sm ml-2 mt-1 border-b">
                            <input type="checkbox" class="outline-none mr-2" checked>
                            <label class="w-14">No. PO</label>
                            <label class="">:</label>
                            <label class="ml-2 w-36 font-semibold">
                                @if (strlen($itemOrder->number) > 20)
                                    {{ substr($itemOrder->number, 0, 20) }}..
                                @else
                                    {{ $itemOrder->number }}
                                @endif
                            </label>
                            <label class="w-6">Tgl.</label>
                            <label class="">:</label>
                            <label class="ml-2 font-semibold">
                                {{ date('d', strtotime($itemOrder->date)) }}-{{ $month[(int) date('m', strtotime($itemOrder->date))] }}-{{ date('Y', strtotime($itemOrder->date)) }}
                            </label>
                        </div>
                    @endforeach
                @endif
                @if (!empty($agreements))
                    @foreach ($agreements as $itemAgreement)
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
                @endif
            </div>
            <div class="w-[380px] h-[185px] border rounded-lg px-1 ml-2">
                <label class="text-lg font-mono font-semibold ml-2">Kepada Yth.</label>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Nama</label>
                    <label class="text-sm">:</label>
                    @php
                        if ($client->type == 'Perusahaan') {
                            if ($client->contact_gender == 'Male') {
                                $client->contact_name = 'Bapak ' . $client->contact_name;
                            } else {
                                $client->contact_name = 'Ibu ' . $client->contact_name;
                            }
                        }
                    @endphp
                    <input type="text" id="client" name="client" value="{{ json_encode($client) }}" hidden>
                    @if ($client->type == 'Perusahaan')
                        <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                            name="client_contact" type="text" value="{{ $client->contact_name }}"
                            onchange="changeClient(this)">
                    @else
                        <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                            name="client_contact" type="text" value="{{ $client->name }}"
                            onchange="changeClient(this)">
                    @endif
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Perusahaan</label>
                    <label class="text-sm">:</label>
                    @if ($client->type == 'Perusahaan')
                        <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                            name="client_company" type="text" value="{{ $client->company }}"
                            onchange="changeClient(this)">
                    @else
                        <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                            name="client_company" type="text" value="-" onchange="changeClient(this)">
                    @endif
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Alamat</label>
                    <label class="text-sm">:</label>
                    <textarea class="text-sm ml-1 px-1 w-[250px] outline-none border rounded-md font-semibold" name="client_address"
                        rows="2" onchange="changeClient(this)">{{ $client->address }}</textarea>
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">No. Telp.</label>
                    <label class="text-sm">:</label>
                    @if ($client->type == 'Perusahaan')
                        <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                            name="contact_phone" type="text" value="{{ $client->contact_phone }}"
                            onchange="changeClient(this)">
                    @else
                        <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                            name="contact_phone" type="text" value="{{ $client->phone }}"
                            onchange="changeClient(this)">
                    @endif
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Email</label>
                    <label class="text-sm">:</label>
                    @if ($client->type == 'Perusahaan')
                        <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                            name="contact_email" type="text" value="{{ $client->contact_email }}"
                            onchange="changeClient(this)">
                    @else
                        <input class="w-[250px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                            name="contact_email" type="text" value="{{ $client->email }}"
                            onchange="changeClient(this)">
                    @endif
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">NPWP</label>
                    <label class="text-sm">:</label>
                    <input id="inputNpwp"
                        class="w-[175px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                        name="npwp" type="text" value="{{ $npwp }}">
                    <input name="old_npwp" type="text" value="{{ $npwp }}" hidden>
                </div>
            </div>
        </div>
        @if (count($invoice_content->description) == 2)
            <div class="flex text-sm mt-2">
                <span>Penggabungan : </span>
                @if ($merge == 'normal')
                    <input class="ml-2 outline-none" type="radio" name="merge" value="normal"
                        onclick="mergeLocation(this)" checked>
                @else
                    <input class="ml-2 outline-none" type="radio" name="merge" value="normal"
                        onclick="mergeLocation(this)">
                @endif
                <span class="ml-1">Normal</span>
                @if ($merge == 'size')
                    <input class="ml-4 outline-none" type="radio" name="merge" value="size"
                        onclick="mergeLocation(this)" checked>
                @else
                    <input class="ml-4 outline-none" type="radio" name="merge" value="size"
                        onclick="mergeLocation(this)">
                @endif
                <span class="ml-1">Ukuran</span>
                @if ($merge == 'side')
                    <input class="ml-4 outline-none" type="radio" name="merge" value="side"
                        onclick="mergeLocation(this)" checked>
                @else
                    <input class="ml-4 outline-none" type="radio" name="merge" value="side"
                        onclick="mergeLocation(this)">
                @endif
                <span class="ml-1">Media</span>
            </div>
        @else
            <div class="hidden text-sm mt-2">
                <span>Penggabungan : </span>
                @if ($merge == 'normal')
                    <input class="ml-2 outline-none" type="radio" name="merge" value="normal"
                        onclick="mergeLocation(this)" checked>
                @else
                    <input class="ml-2 outline-none" type="radio" name="merge" value="normal"
                        onclick="mergeLocation(this)">
                @endif
                <span class="ml-1">Normal</span>
                @if ($merge == 'size')
                    <input class="ml-4 outline-none" type="radio" name="merge" value="size"
                        onclick="mergeLocation(this)" checked>
                @else
                    <input class="ml-4 outline-none" type="radio" name="merge" value="size"
                        onclick="mergeLocation(this)">
                @endif
                <span class="ml-1">Ukuran</span>
                @if ($merge == 'side')
                    <input class="ml-4 outline-none" type="radio" name="merge" value="side"
                        onclick="mergeLocation(this)" checked>
                @else
                    <input class="ml-4 outline-none" type="radio" name="merge" value="side"
                        onclick="mergeLocation(this)">
                @endif
                <span class="ml-1">Media</span>
            </div>
        @endif
        @if ($merge == 'normal')
            <table class="table-auto w-full mt-4">
                <thead>
                    <tr class="text-sm">
                        <th class="border h-8 w-8">No.</th>
                        <th class="border h-8 ">Deskripsi</th>
                        <th class="border h-8 w-32">Harga</th>
                        <th class="border h-8 w-36">Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @if (count($invoice_descriptions) >= 4) --}}
                    @foreach ($invoice_content->description as $invoiceItem)
                        @php
                            $subTotal = $subTotal + $invoiceItem->nominal;
                        @endphp
                        @if ($loop->iteration > $i * 4 && $loop->iteration < ($i + 1) * 4 + 1)
                            <tr class="text-sm">
                                <td class="border px-2">{{ $loop->iteration }}</td>
                                <td class="border px-2">
                                    <div class="w-full">
                                        <input class="w-full px-1 text-sm outline-none border rounded-md font-semibold"
                                            id="invoiceTitle{{ $loop->iteration - 1 }}" name="invoice_title"
                                            type="text" value="{{ $invoiceItem->title }}"
                                            onchange="changeInvoiceTitle(this)">
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
                    @php
                        $dpp = round(($subTotal / 12) * 11);
                        $ppn = round(($dpp * 12) / 100);
                        $grandTotal = $subTotal + $ppn;
                        $receipt_content->nominal = $grandTotal;
                        $receipt_content->terbilang = '# ' . terbilang($receipt_content->nominal) . ' Rupiah #';
                    @endphp
                    <input type="text" name="dpp" value="{{ $dpp }}" hidden>
                    <input type="text" name="ppn" value="{{ $ppn }}" hidden>
                    <input type="text" name="nominal" value="{{ $subTotal }}" hidden>
                    <input type="text" id="receipt" name="receipt_content"
                        value="{{ json_encode($receipt_content) }}" hidden>
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
                                    <label class="w-full flex justify-end">{{ number_format($subTotal) }}</label>
                                    <label class="w-4">,-</label>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-sm">
                            <td class="border text-right px-2 font-semibold">DPP</td>
                            <td class="border text-right font-semibold">
                                <div class="flex w-full justify-end px-1">
                                    <label class="w-6">Rp. </label>
                                    <label class="w-full flex justify-end">{{ number_format($dpp) }}</label>
                                    <label class="w-4">,-</label>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-sm">
                            <td class="border text-right px-2 font-semibold">PPN</td>
                            <td class="border text-right font-semibold">
                                <div class="flex w-full justify-end px-1">
                                    <label class="w-6">Rp. </label>
                                    <label class="w-full flex justify-end">{{ number_format($ppn) }}</label>
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
                <label class="mt-2 text-sm flex justify-center w-72">Hormat kami,</label>
                <label class="text-sm flex justify-center w-72 font-semibold">{{ $company->name }}</label>
                <label class="mt-10 text-sm flex justify-center w-72 font-semibold">
                    <u>{{ $bank_account->director }}</u>
                </label>
                <label class="text-sm flex justify-center w-72">Direktur</label>
            @endif
        @else
            @php
                $subTotal = array_sum(array_column($invoice_descriptions, 'nominal'));
            @endphp
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
                    <tr class="text-sm">
                        <td class="border px-2">1</td>
                        <td class="border px-2">
                            <div class="w-full">
                                <input class="w-full px-1 text-sm outline-none border rounded-md font-semibold"
                                    id="invoiceTitle0" name="invoice_title" type="text"
                                    value="{{ $invoice_content->description[0]->title }}"
                                    onchange="changeInvoiceTitle(this)">
                            </div>
                        </td>
                        <td class="border px-2 text-right">
                            <div class="flex justify-end">
                                <label class="w-6">Rp. </label>
                                <label class="w-full flex justify-end">{{ number_format($subTotal) }}</label>
                                <label class="w-4">,-</label>
                            </div>
                        </td>
                        <td class="border px-2 text-right">
                            <div class="flex justify-end">
                                <label class="w-6">Rp. </label>
                                <label class="w-full flex justify-end">{{ number_format($subTotal) }}</label>
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
                                <span class="ml-2">{{ $invoice_content->description[0]->type }}</span>
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
                                <span id="invoiceSize" class="ml-2">{{ $size }}</span>
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
                                <span id="invoiceQty"
                                    class="ml-2">{{ $invoice_content->description[0]->qty }}</span>
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
                                <span class="ml-2">{{ $invoice_content->description[0]->periode }}</span>
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
                                <span>: 1.</span>
                                <span class="ml-2 w-[300px]">{{ $invoice_content->description[0]->location }}</span>
                            </div>
                            <div class="flex w-full">
                                <span class="w-16"></span>
                                <span class="ml-2">2.</span>
                                <span class="ml-2 w-[300px]">{{ $invoice_content->description[1]->location }}</span>
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
                    @php
                        $dpp = round(($subTotal / 12) * 11);
                        $ppn = round(($dpp * 12) / 100);
                        $grandTotal = $subTotal + $ppn;
                        $receipt_content->nominal = $grandTotal;
                        $receipt_content->terbilang = '# ' . terbilang($receipt_content->nominal) . ' Rupiah #';
                    @endphp
                    <input type="text" name="dpp" value="{{ $dpp }}" hidden>
                    <input type="text" name="ppn" value="{{ $ppn }}" hidden>
                    <input type="text" name="nominal" value="{{ $subTotal }}" hidden>
                    <input type="text" id="receipt" name="receipt_content"
                        value="{{ json_encode($receipt_content) }}" hidden>
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
                                <label class="w-full flex justify-end">{{ number_format($subTotal) }}</label>
                                <label class="w-4">,-</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-sm">
                        <td class="border text-right px-2 font-semibold">DPP</td>
                        <td class="border text-right font-semibold">
                            <div class="flex w-full justify-end px-1">
                                <label class="w-6">Rp. </label>
                                <label class="w-full flex justify-end">{{ number_format($dpp) }}</label>
                                <label class="w-4">,-</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-sm">
                        <td class="border text-right px-2 font-semibold">PPN</td>
                        <td class="border text-right font-semibold">
                            <div class="flex w-full justify-end px-1">
                                <label class="w-6">Rp. </label>
                                <label class="w-full flex justify-end">{{ number_format($ppn) }}</label>
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
                <u>{{ $bank_account->director }}</u>
            </label>
            <label class="text-sm flex justify-center w-72">Direktur</label>
        @endif
    </div>
</div>
