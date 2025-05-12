<div class="w-[1580px] h-[1120px] px-10 py-4 mt-2 bg-white z-0">
    <div class="flex items-center border rounded-lg p-4 mt-8">
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
                <div class="flex justify-center w-56">
                    <label class="text-5xl text-center">C1</label>
                </div>
                <div class="flex justify-center w-56">
                    <label class="text-sm text-center">LAPORAN PENJUALAN</label>
                </div>
                <div class="flex justify-center w-56">
                    <label class="text-sm text-center"></label>
                </div>
                <div class="flex justify-center w-56 border rounded-md">
                    @if (request('month'))
                        @if (request('month') != 'All')
                            <label id="labelPeriode" class="month-report text-xl font-semibold text-center">
                                {{ $bulan[request('month')] }}
                                {{ request('year') }}
                            </label>
                        @else
                            <label id="labelPeriode" class="month-report text-xl font-semibold text-center">JAN
                                - DES
                                {{ date('Y') }}</label>
                        @endif
                    @else
                        @if (request('year'))
                            <label id="labelPeriode" class="month-report text-xl font-semibold text-center">JAN
                                - DES
                                {{ request('year') }}</label>
                        @else
                            <label id="labelPeriode" class="month-report text-xl font-semibold text-center">JAN
                                - DES
                                {{ date('Y') }}</label>
                        @endif
                    @endif
                </div>
                <div class="flex justify-center w-56 border rounded-md mt-2">
                    <label class="text-sm">
                        <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
                        </span>
                        {{ date('d') }} {{ $bulan[(int) date('m')] }}
                        {{ date('Y') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="h-[840px] mt-2">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-teal-100">
                    <th class="text-black sticky top-0 border text-[0.65rem] w-6" rowspan="2">
                        No.
                    </th>
                    <th class="text-black sticky top-0 border text-[0.65rem] text-center" rowspan="2">
                        <button class="flex justify-center w-full items-center">@sortablelink('number', 'Data Penjualan')
                            <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                            </svg>
                        </button>
                    </th>
                    <th class="text-black sticky top-0 border text-[0.65rem] w-40" rowspan="2">
                        Klien
                    </th>
                    <th class="text-black sticky top-0 border text-[0.65rem] w-36" rowspan="2">
                        Penawaran
                    </th>
                    <th class="text-black sticky top-0 border text-[0.65rem] w-[120px]" rowspan="2">
                        Harga
                    </th>
                    <th class="text-black sticky top-0 border text-[0.65rem]" colspan="5">
                        Termin Pembayaran
                    </th>
                    <th class="text-black sticky top-0 border text-[0.65rem]" colspan="3">
                        Penagihan
                    </th>
                    <th class="text-black sticky top-0 border text-[0.65rem]" colspan="2">
                        Pembayaran
                    </th>
                </tr>
                <tr class="bg-teal-100">
                    <th class="text-black border text-[0.65rem] w-10">Termin</th>
                    <th class="text-black border text-[0.65rem] w-[72px]">Nominal</th>
                    <th class="text-black border text-[0.65rem] w-16">PPN</th>
                    <th class="text-black border text-[0.65rem] w-14">PPh</th>
                    <th class="text-black border text-[0.65rem] w-20">Total</th>
                    <th class="text-black border text-[0.65rem] w-20">No. Invoice</th>
                    <th class="text-black border text-[0.65rem] w-20">Tgl. Invoice</th>
                    <th class="text-black border text-[0.65rem] w-[72px]">Nominal</th>
                    <th class="text-black border text-[0.65rem] w-12">Status</th>
                    <th class="text-black border text-[0.65rem] w-20">Tgl. Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    @php
                        $quotId = null;
                        $quotRevisionId = null;
                        $created_by = json_decode($sale->created_by);
                        $revisions = $sale->quotation->quotation_revisions;

                        if ($sale->void_sale) {
                            $voidSale = $sales->where('id', $sale->id);
                            if (count($voidSale) == 2) {
                                $pphTotal = $pphTotal + ($sale->dpp * ($sale->pph / 100)) / 2;
                                $ppnTotal = $ppnTotal + ($sale->dpp * ($sale->ppn / 100)) / 2;
                                $priceTotal = $priceTotal + $sale->price / 2;
                            }
                        } elseif ($sale->change_sale) {
                            $changeSale = $sales->where('id', $sale->id);
                            if (count($changeSale) == 2) {
                                $pphTotal = $pphTotal + ($sale->dpp * ($sale->pph / 100)) / 2;
                                $ppnTotal = $ppnTotal + ($sale->dpp * ($sale->ppn / 100)) / 2;
                                $priceTotal = $priceTotal + $sale->price / 2;
                            }
                        } else {
                            $pphTotal = $pphTotal + $sale->dpp * ($sale->pph / 100);
                            $ppnTotal = $ppnTotal + $sale->dpp * ($sale->ppn / 100);
                            $priceTotal = $priceTotal + $sale->price;
                        }

                        if (count($revisions) != 0) {
                            $revision =
                                $sale->quotation->quotation_revisions[count($sale->quotation->quotation_revisions) - 1];
                            $number = $revision->number;
                            $quotRevisionId = $revision->id;
                            $notes = json_decode($revision->notes);
                            $created_at = $revision->created_at;
                            // $products = json_decode($revision->products);
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
                            // $products = json_decode($sale->quotation->products);
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
                    @endphp
                    @if ($i == 0)
                        @include('sales-report.cpage-first')
                    @else
                        @include('sales-report.cpage-middle')
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex justify-end mt-1 text-black">
        <label for="">Halaman {{ $i + 1 }} dari
            {{ $pageQty }}</label>
    </div>
</div>
