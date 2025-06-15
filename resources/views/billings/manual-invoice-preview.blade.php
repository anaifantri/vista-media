<div class="h-[1100px] w-full flex justify-center mt-2">
    <div>
        <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-4">
            <u>INVOICE</u>
        </label>
        <div class="flex mt-4">
            <div class="w-[380px] h-[185px] border rounded-lg p-1">
                <div class="flex items-center ml-2">
                    <label class="text-lg w-24">Nomor</label>
                    <label class="text-lg">:</label>
                    <label class="text-md font-mono font-semibold ml-2">{{ $billing->invoice_number }}</label>
                </div>
                <div class="flex items-center ml-2">
                    <label class="text-lg w-24">Tanggal</label>
                    <label class="text-lg">:</label>
                    <label class="text-lg font-mono font-semibold ml-2">
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
                @if (!empty($approvals))
                    @foreach ($approvals as $approval)
                        @if ($loop->iteration < 5)
                            <div class="flex items-center text-sm ml-2 mt-1 border-b">
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
                            <label class="w-14">No. PO</label>
                            <label class="">:</label>
                            <label class="ml-2 w-44 font-semibold">
                                @if (strlen($itemOrder->number) > 24)
                                    {{ substr($itemOrder->number, 0, 24) }}..
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
                            <label class="w-6">Tgl.</label>
                            <label class="">:</label>
                            <label class="ml-2 font-semibold">
                                {{ date('d', strtotime($itemAgreement->date)) }}-{{ $month[(int) date('m', strtotime($itemAgreement->date))] }}-{{ date('Y', strtotime($itemAgreement->date)) }}
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="w-[380px] h-[185px] border rounded-lg p-1 ml-2">
                <label class="text-lg font-mono font-semibold ml-2">Kepada Yth.</label>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Nama</label>
                    <label class="text-sm">:</label>
                    <label class="w-[250px] ml-1 text-sm font-semibold">
                        @if ($client->type == 'Perusahaan')
                            @if ($client->contact_name != '')
                                {{ $client->contact_name }}
                            @else
                                -
                            @endif
                        @else
                            {{ $client->name }}
                        @endif
                    </label>
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Perusahaan</label>
                    <label class="text-sm">:</label>
                    <label class="text-sm ml-2 font-semibold">
                        @if ($client->type == 'Perusahaan')
                            {{ $client->company }}
                        @else
                            -
                        @endif
                    </label>
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Alamat</label>
                    <label class="text-sm">:</label>
                    <label class="text-sm ml-1 w-[250px] font-semibold"
                        name="client_address">{{ $client->address }}</label>
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">No. Telp.</label>
                    <label class="text-sm">:</label>
                    <label class="w-[250px] ml-1 text-sm font-semibold">
                        @if ($client->type == 'Perusahaan')
                            @if ($client->contact_phone != '')
                                {{ $client->contact_phone }}
                            @else
                                -
                            @endif
                        @else
                            @if ($client->phone != '')
                                {{ $client->phone }}
                            @else
                                -
                            @endif
                        @endif
                    </label>
                </div>
                <div class="flex ml-2">
                    <label class="text-sm w-24">Email</label>
                    <label class="text-sm">:</label>
                    <label class="w-[250px] ml-1 text-sm font-semibold">
                        @if ($client->type == 'Perusahaan')
                            @if ($client->email != '')
                                {{ $client->email }}
                            @else
                                -
                            @endif
                        @else
                            @if ($client->email != '')
                                {{ $client->email }}
                            @else
                                -
                            @endif
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
                @foreach ($manual_details as $itemManual)
                    @php
                        if ($itemManual->ppn == false) {
                            $dpp = $dpp + $itemManual->dpp;
                        } else {
                            $ppnCheck = true;
                            $subPpn = $subPpn + $itemManual->nominal;
                        }
                    @endphp
                    @if ($loop->iteration > $i * 4 && $loop->iteration < ($i + 1) * 4 + 1)
                        <tr class="text-sm">
                            <td class="border px-2">{{ $loop->iteration }}</td>
                            <td class="border px-2">{{ $itemManual->title }}</td>
                            <td class="border px-2 text-right">
                                <div class="flex justify-end">
                                    <label class="w-6">Rp. </label>
                                    <label
                                        class="w-full flex justify-end">{{ number_format($itemManual->nominal) }}</label>
                                    <label class="w-4">,-</label>
                                </div>
                            </td>
                            <td class="border px-2 text-right">
                                <div class="flex justify-end">
                                    <label class="w-6">Rp. </label>
                                    <label
                                        class="w-full flex justify-end">{{ number_format($itemManual->nominal) }}</label>
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
                                    <span class="ml-2">{{ $invoice_descriptions[0]->type }}</span>
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
                                    <span id="invoiceSize" class="ml-2">{{ $invoice_descriptions[0]->size }}</span>
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
                                    <span id="invoiceQty" class="ml-2">{{ $invoice_descriptions[0]->qty }}</span>
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
                                    <span class="ml-2">{{ $invoice_descriptions[0]->periode }}</span>
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
                                    <span class="ml-2 w-[300px]">{{ $invoice_descriptions[0]->location }}</span>
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
                                <label class="w-full flex justify-end">{{ number_format($billing->nominal) }}</label>
                                <label class="w-4">,-</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-sm">
                        <td class="border text-right px-2 font-semibold">DPP</td>
                        <td class="border text-right font-semibold">
                            <div class="flex w-full justify-end px-1">
                                <label class="w-6">Rp. </label>
                                <label class="w-full flex justify-end">{{ number_format($billing->dpp) }}</label>
                                <label class="w-4">,-</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-sm">
                        <td class="border text-right px-2 font-semibold">PPN</td>
                        <td class="border text-right font-semibold">
                            <div class="flex w-full justify-end px-1">
                                <label class="w-6">Rp. </label>
                                <label class="w-full flex justify-end">{{ number_format($billing->ppn) }}</label>
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
            <label class="mt-2 text-sm flex justify-center w-72">Hormat kami,</label>
            <label class="text-sm flex justify-center w-72 font-semibold">{{ $company->name }}</label>
            <label class="mt-10 text-sm flex justify-center w-72 font-semibold">
                <u>Texun Sandy Kamboy</u>
            </label>
            <label class="text-sm flex justify-center w-72">Direktur</label>
        @endif
    </div>
</div>
