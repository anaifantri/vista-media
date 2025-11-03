<div class="w-[1580px] h-[1000px] px-10 py-4 mt-2 bg-white z-0">
    <div class="flex items-center p-2 mt-4">
        <div class="w-44">
            <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}" alt="">
        </div>
        <div class="w-[750px] ml-6">
            <div>
                <span class="text-sm font-semibold">{{ $company->name }}</span>
            </div>
            <div>
                <span class="text-xs">{{ $company->address }}, Desa/Kel. {{ $company->village }},
                    Kec.
                    {{ $company->district }}</span>
            </div>
            <div>
                <span class="text-xs">{{ $company->city }} - {{ $company->province }}
                    {{ $company->post_code }}</span>
            </div>
            <div>
                <span class="text-xs">Ph. {{ $company->phone }} | Mobile.
                    {{ $company->m_phone }}</span>
            </div>
            <div>
                <span class="text-xs">e-mail : {{ $company->email }} | website :
                    {{ $company->website }}</span>
            </div>
        </div>
        <div class="flex w-full justify-end">
            <div>
                <div class="flex justify-center w-96">
                    <label class="text-4xl font-bold text-center">G1</label>
                </div>
                <div class="flex justify-center w-96">
                    <label class="text-lg text-center">LAPORAN PIUTANG</label>
                </div>
                <div class="flex justify-center w-96 border border-black rounded-md">
                    @if (request('client') && request('client') != 'All')
                        <label class="text-2xl text-center">
                            @if (strlen(request('client')) > 30)
                                {{ substr(request('client'), 0, 30) }}..
                            @else
                                {{ request('client') }}
                            @endif
                        </label>
                    @else
                        <label class="text-3xl text-center">SELURUH KLIEN</label>
                    @endif
                </div>
                <div class="flex justify-center w-96 border border-black rounded-md mt-2">
                    <label class="text-sm">
                        <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
                        </span>
                        {{ date('d') }} {{ $bulan[(int) date('m')] }}
                        {{ date('Y') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="h-[780px] mt-2">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-teal-100 h-10">
                    <th class="sticky top-0 border border-black text-sm w-8" rowspan="2">
                        No.
                    </th>
                    <th class="sticky top-0 border border-black text-sm text-center w-24">
                        No. Penjualan
                    </th>
                    <th class="sticky top-0 border border-black text-sm">
                        Lokasi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-72">
                        Klien
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-20">
                        Deskripsi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Harga
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Penagihan
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Pembayaran
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Pot. PPh
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Piutang
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    @php
                        $pphTotal = $pphTotal + $sale->dpp * (2 / 100);
                        $ppnTotal = $ppnTotal + $sale->dpp * ($sale->ppn / 100);
                        $priceTotal = $priceTotal + $sale->price;

                        $quotId = null;
                        $quotRevisionId = null;
                        $created_by = json_decode($sale->created_by);
                        $revisions = $sale->quotation->quotation_revisions;

                        if (count($revisions) != 0) {
                            $revision =
                                $sale->quotation->quotation_revisions[count($sale->quotation->quotation_revisions) - 1];
                            $number = $revision->number;
                            $quotRevisionId = $revision->id;
                            $notes = json_decode($revision->notes);
                            $created_at = $revision->created_at;
                            $payment_terms = json_decode($revision->payment_terms);
                            $price = json_decode($revision->price);
                            $dataApprovals = $sale->quotation->quotation_approvals;
                            $dataAgreements = $sale->quotation->quotation_agreements;
                            $dataOrders = $sale->quotation->quotation_orders;
                        } else {
                            $number = $sale->quotation->number;
                            $quotId = $sale->quotation->id;
                            $notes = json_decode($sale->quotation->notes);
                            $created_at = $sale->quotation->created_at;
                            $payment_terms = json_decode($sale->quotation->payment_terms);
                            $price = json_decode($sale->quotation->price);
                            $dataApprovals = $sale->quotation->quotation_approvals;
                            $dataAgreements = $sale->quotation->quotation_agreements;
                            $dataOrders = $sale->quotation->quotation_orders;
                        }
                        $clients = json_decode($sale->quotation->clients);
                        $product = json_decode($sale->product);
                        $description = json_decode($product->description);
                        $saleBillings = $sale->billings;
                        $billingNominal = 0;
                        $paymentNominal = 0;
                        if ($sale->media_category->name == 'Service') {
                            foreach ($saleBillings as $itemBilling) {
                                if (count($itemBilling->bill_payments) > 0) {
                                    $paymentNominal = $paymentNominal + $itemBilling->bill_payments->sum('nominal');
                                }
                                foreach (json_decode($itemBilling->invoice_content)->description as $itemDescription) {
                                    if ($itemDescription->sale_id == $sale->id) {
                                        $billingNominal =
                                            $billingNominal +
                                            ($itemDescription->nominal +
                                                ($sale->ppn / 100) * $itemDescription->nominal);
                                    }
                                }
                            }
                        } else {
                            foreach ($saleBillings as $itemBilling) {
                                if (count($itemBilling->bill_payments) > 0) {
                                    $paymentNominal = $paymentNominal + $itemBilling->bill_payments->sum('nominal');
                                }
                                if (isset(json_decode($itemBilling->invoice_content)->manual_detail)) {
                                    $billingNominal = $billingNominal + ($itemBilling->nominal + $itemBilling->ppn);
                                } elseif (isset(json_decode($itemBilling->invoice_content)->data_sales)) {
                                    foreach (json_decode($itemBilling->invoice_content)->data_sales as $itemSales) {
                                        if ($itemSales->id == $sale->id) {
                                            $billingNominal =
                                                $billingNominal +
                                                ($itemSales->nominal + ($sale->ppn / 100) * $itemSales->nominal);
                                        }
                                    }
                                } else {
                                    foreach (json_decode($itemBilling->invoice_content)->description as $itemDesc) {
                                        if ($itemDesc->sale_id == $sale->id) {
                                            $billingNominal =
                                                $billingNominal +
                                                ($itemDesc->nominal + ($sale->ppn / 100) * $itemDesc->nominal);
                                        }
                                    }
                                }
                            }
                        }
                    @endphp
                    @if ($loop->iteration > $i * 30 && $loop->iteration < ($i + 1) * 30 + 1)
                        <tr>
                            <td class="border border-black text-sm text-center">
                                {{ $loop->iteration }}</td>
                            <td class="border border-black text-sm text-center">
                                <a href="/marketing/sales/{{ $sale->id }}">
                                    {{ substr($sale->number, 0, 5) }}..{{ substr($sale->number, -5) }}
                                </a>
                            </td>
                            <td class="border border-black text-sm text-start px-1">
                                <a href="/media/locations/preview/{{ $product->category }}/{{ $product->id }}"
                                    class="ml-1">{{ $product->code }} -
                                    {{ $product->city_code }} | {{ $product->address }}</a>
                            </td>
                            <td class="border border-black text-sm text-start px-1">
                                <div>
                                    @if ($clients->type == 'Perusahaan')
                                        {{ $clients->company }}
                                    @else
                                        {{ $clients->name }}
                                    @endif
                                </div>
                            </td>
                            <td class="border border-black text-sm text-center px-1">
                                @if ($sale->media_category->name == 'Service')
                                    Revisual
                                @else
                                    {{ $sale->media_category->name }}
                                @endif
                            </td>
                            <td class="border border-black text-sm text-right px-1">
                                {{ number_format($sale->price + ($sale->dpp * $sale->ppn) / 100) }}
                            </td>
                            <td class="border border-black text-sm text-right px-1">
                                {{ number_format($billingNominal) }}
                            </td>
                            <td class="border border-black text-sm text-right px-1">
                                {{ number_format($paymentNominal) }}
                            </td>
                            <td class="border border-black text-sm text-right px-1">
                            </td>
                            <td class="border border-black text-sm text-right px-1">
                                {{ number_format($billingNominal - $paymentNominal) }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td class="border border-black text-sm text-right font-semibold px-2" colspan="5">
                        Total</td>
                    <td class="border border-black text-sm text-right font-semibold px-2">
                        {{ number_format($priceTotal) }}
                    </td>
                    <td class="text-black border border-black text-sm text-right font-semibold"></td>
                    <td class="text-black border border-black text-sm text-right font-semibold"></td>
                    <td class="text-black border border-black text-sm text-right font-semibold"></td>
                    <td class="text-black border border-black text-sm text-right font-semibold"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="flex justify-end mt-1 text-black">
        <label for="">Halaman {{ $i + 1 }} dari
            {{ $pageQty }}</label>
    </div>
</div>
