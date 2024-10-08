<div id="c1Report" class="flex justify-center z-0">
    <?php
    if (fmod(count($sales), 5) == 0) {
        $pageQty = count($sales) / 5;
    } else {
        $pageQty = (count($sales) - fmod(count($sales), 5)) / 5 + 1;
    }
    ?>
    <div id="pdfPreview">
        @for ($i = 0; $i < $pageQty; $i++)
            <div class="w-[1180px] h-[832px] p-4">
                <div class="flex h-[136px] items-center border rounded-lg p-2 mt-4">
                    <div class="w-44">
                        <img class="ml-2" src="/img/logo-vm.png" alt="">
                    </div>
                    <div class="w-[450px] ml-6">
                        <div>
                            <span class="text-sm font-semibold">PT. Vista Media</span>
                        </div>
                        <div>
                            <span class="text-xs">Jl. Pulau Kawe No. 40 - Dauh Puri Kauh</span>
                        </div>
                        <div>
                            <span class="text-xs">Kota Denpasar, Bali 80114</span>
                        </div>
                        <div>
                            <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                        </div>
                        <div>
                            <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                        </div>
                    </div>
                    <div class="flex w-full justify-end">
                        <div>
                            <div class="flex justify-center w-48">
                                <label class="text-5xl text-center">C1</label>
                            </div>
                            <div class="flex justify-center w-48">
                                <label class="text-sm text-center">LAPORAN PENJUALAN</label>
                            </div>
                            <div class="flex justify-center w-48">
                                <label class="text-sm text-center"></label>
                            </div>
                            <div class="flex justify-center w-48 border rounded-md">
                                @if (request('search'))
                                    <?php
                                    $searchDate = strtotime(request('search'));
                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    ?>
                                    <label id="labelPeriode"
                                        class="month-report text-xl font-semibold text-center">{{ $bulan[(int) date('m', $searchDate)] }}
                                        {{ date('Y', $searchDate) }}</label>
                                @else
                                    <label id="labelPeriode" class="month-report text-xl font-semibold text-center">JAN
                                        - DES {{ date('Y') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-[622px] mt-2">
                    <table class="table-auto">
                        <thead>
                            <tr class="bg-teal-100">
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-6" rowspan="2">
                                    No.
                                </th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-44 text-center"
                                    rowspan="2">
                                    <button class="flex justify-center items-center w-44">@sortablelink('number', 'Data Penjualan')
                                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                        </svg>
                                    </button>
                                </th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-40" rowspan="2">
                                    Klien
                                </th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-32" rowspan="2">
                                    Penawaran
                                </th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-[340px]" colspan="5">
                                    Termin
                                    Pembayaran</th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-40" colspan="2">
                                    Penagihan
                                </th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-36" colspan="2">
                                    Pembayaran
                                </th>
                            </tr>
                            <tr class="bg-teal-100">
                                <th class="text-teal-700 border text-[0.65rem] w-10">Termin</th>
                                <th class="text-teal-700 border text-[0.65rem] w-20">Nominal (Rp.)</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[72px]">PPN (Rp.)</th>
                                <th class="text-teal-700 border text-[0.65rem] w-16">PPh (Rp.)</th>
                                <th class="text-teal-700 border text-[0.65rem] w-20">Total (Rp.)</th>
                                <th class="text-teal-700 border text-[0.65rem] w-20">No. Invoice</th>
                                <th class="text-teal-700 border text-[0.65rem] w-20">Tgl. Invoice</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[72px]">Jadwal Bayar</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[72px]">Tgl. Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                @php
                                    $created_by = json_decode($sale->created_by);
                                    $revisions = $sale->quotation->quotation_revisions;

                                    if (count($revisions) != 0) {
                                        $revision =
                                            $sale->quotation->quotation_revisions[
                                                count($sale->quotation->quotation_revisions) - 1
                                            ];
                                        $number = $revision->number;
                                        $notes = json_decode($revision->notes);
                                        $created_at = $revision->created_at;
                                        $products = json_decode($revision->products);
                                        $payment_terms = json_decode($revision->payment_terms);
                                        $price = json_decode($revision->price);
                                        $dataApprovals = $sale->quotation->quotation_approvals;
                                        $dataAgreements = $sale->quotation->quotation_agreements;
                                        $dataOrders = $sale->quotation->quotation_orders;
                                    } else {
                                        $number = $sale->quotation->number;
                                        $notes = json_decode($sale->quotation->notes);
                                        $created_at = $sale->quotation->created_at;
                                        $products = json_decode($sale->quotation->products);
                                        $payment_terms = json_decode($sale->quotation->payment_terms);
                                        $price = json_decode($sale->quotation->price);
                                        $dataApprovals = $sale->quotation->quotation_approvals;
                                        $dataAgreements = $sale->quotation->quotation_agreements;
                                        $dataOrders = $sale->quotation->quotation_orders;
                                    }
                                    $clients = json_decode($sale->quotation->clients);
                                    foreach ($products as $product) {
                                        if ($product->code == $sale->product_code) {
                                            $description = json_decode($product->description);
                                        }
                                    }
                                @endphp
                                @if ($i == 0)
                                    @if ($loop->iteration < 6)
                                        <tr>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                {{ $loop->iteration }}</td>
                                            <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                <div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">No.</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2 w-32">{{ Str::substr($sale->number, 0, 4) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Tgl.</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2 w-32">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Oleh</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-32">{{ $created_by->name }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Kode</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-32">{{ $sale->product_code }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Lokasi</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-32">
                                                            @foreach ($products as $product)
                                                                @if ($product->code == $sale->product_code)
                                                                    {{ $product->address }}
                                                                @endif
                                                            @endforeach

                                                        </label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Size</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-32">
                                                            @foreach ($products as $product)
                                                                @if ($product->code == $sale->product_code)
                                                                    {{ $product->size }}x{{ $product->side }}-
                                                                    @if ($product->orientation == 'Horizontal')
                                                                        H
                                                                    @elseif ($product->orientation == 'Vertikal')
                                                                        V
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                <div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Klien</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-28">{{ $clients->name }}</label>
                                                    </div>
                                                    @if ($clients->type == 'Perusahaan')
                                                        <div class="flex ml-1">
                                                            <label class="w-8">Kontak</label>
                                                            <label class="ml-1">:</label>
                                                            <label
                                                                class="ml-2 w-28">{{ $clients->contact_name }}</label>
                                                        </div>
                                                    @endif
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Jenis</label>
                                                        <label class="ml-1">:</label>
                                                        @if ($sale->media_category->name == 'Service')
                                                            <label class="ml-2 w-28">Cetak / Pasang</label>
                                                        @else
                                                            <label
                                                                class="ml-2 w-28">{{ $sale->media_category->name }}</label>
                                                        @endif
                                                    </div>
                                                    @if ($sale->media_category->name != 'Service')
                                                        <div class="flex ml-1">
                                                            <label class="w-8">Periode</label>
                                                            <label class="ml-1">:</label>
                                                            <label class="ml-2 w-28">{{ $sale->duration }}</label>
                                                        </div>
                                                        <div class="flex ml-1">
                                                            <label class="w-8">Awal</label>
                                                            <label class="ml-1">:</label>
                                                            @if ($sale->start_at)
                                                                <label
                                                                    class="ml-2  w-28">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                                            @else
                                                                <label class="ml-2 w-28">-</label>
                                                            @endif
                                                        </div>
                                                        <div class="flex ml-1">
                                                            <label class="w-8">Akhir</label>
                                                            <label class="ml-1">:</label>
                                                            @if ($sale->end_at)
                                                                <label
                                                                    class="ml-2 w-28">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                                            @else
                                                                <label class="ml-2 w-28">-</label>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                <div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">No.</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ Str::substr($number, 0, 4) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Tgl.</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ date('d-M-Y', strtotime($created_at)) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Harga</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ number_format($sale->price) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">DPP</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ number_format($sale->dpp) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">PPN</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ number_format($sale->dpp * ($sale->ppn / 100)) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">PPh</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ number_format($sale->dpp * ($sale->pph / 100)) }}</label>
                                                    </div>
                                                    @if ($sale->media_category->name == 'Billboard')
                                                        <div class="flex ml-1">
                                                            <label class="w-14">Free Cetak</label>
                                                            <label class="ml-1">:</label>
                                                            <label class="ml-2">
                                                                @if ($notes->freePrint)
                                                                    {{ $notes->freePrint }} x
                                                                @else
                                                                    -
                                                                @endif
                                                            </label>
                                                        </div>
                                                        <div class="flex ml-1">
                                                            <label class="w-14">Free Pasang</label>
                                                            <label class="ml-1">:</label>
                                                            <label class="ml-2">
                                                                @if ($notes->freeInstall)
                                                                    {{ $notes->freeInstall }} x
                                                                @else
                                                                    -
                                                                @endif
                                                            </label>
                                                        </div>
                                                    @elseif ($sale->media_category->name == 'Signage')
                                                        @if ($description->type != 'Videotron')
                                                            <div class="flex ml-1">
                                                                <label class="w-14">Free Cetak</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2">
                                                                    @if ($notes->freePrint)
                                                                        {{ $notes->freePrint }} x
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-14">Free Pasang</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2">
                                                                    @if ($notes->freeInstall)
                                                                        {{ $notes->freeInstall }} x
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex ml-1 justify-center">
                                                            <label>{{ $terms->term }} %</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex mr-1 justify-end">
                                                            <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex mr-1 justify-end">
                                                            <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->ppn / 100)) }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex mr-1 justify-end">
                                                            <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->pph / 100)) }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex mr-1 justify-end">
                                                            @if ($sale->dpp)
                                                                @php
                                                                    $subTotal = $sale->price * ($terms->term / 100);
                                                                    $ppnTerm =
                                                                        $sale->dpp *
                                                                        ($terms->term / 100) *
                                                                        ($sale->ppn / 100);
                                                                    $pphTerm =
                                                                        $sale->dpp *
                                                                        ($terms->term / 100) *
                                                                        ($sale->pph / 100);
                                                                @endphp
                                                                <label>{{ number_format($subTotal + $ppnTerm - $pphTerm) }}</label>
                                                            @else
                                                                <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                            </td>
                                        </tr>
                                    @endif
                                @else
                                    @if ($loop->iteration > $i * 5 && $loop->iteration < ($i + 1) * 5 + 1)
                                        <tr>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                {{ $loop->iteration }}</td>
                                            <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                <div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">No.</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2 w-32">{{ Str::substr($sale->number, 0, 4) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Tgl.</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2 w-32">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Oleh</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-32">{{ $created_by->name }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Kode</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-32">{{ $sale->product_code }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Lokasi</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-32">
                                                            @foreach ($products as $product)
                                                                @if ($product->code == $sale->product_code)
                                                                    {{ $product->address }}
                                                                @endif
                                                            @endforeach
                                                        </label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Size</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-32">
                                                            @foreach ($products as $product)
                                                                @if ($product->code == $sale->product_code)
                                                                    {{ $product->size }}x{{ $product->side }}-
                                                                    @if ($product->orientation == 'Horizontal')
                                                                        H
                                                                    @elseif ($product->orientation == 'Vertikal')
                                                                        V
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                <div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Klien</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-28">{{ $clients->name }}</label>
                                                    </div>
                                                    @if ($clients->type == 'Perusahaan')
                                                        <div class="flex ml-1">
                                                            <label class="w-8">Kontak</label>
                                                            <label class="ml-1">:</label>
                                                            <label
                                                                class="ml-2 w-28">{{ $clients->contact_name }}</label>
                                                        </div>
                                                    @endif
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Jenis</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2 w-28">{{ $sale->media_category->name }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Periode</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-28">{{ $sale->duration }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Awal</label>
                                                        <label class="ml-1">:</label>
                                                        @if ($sale->start_at)
                                                            <label
                                                                class="ml-2  w-28">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                                        @else
                                                            <label class="ml-2 w-28">-</label>
                                                        @endif
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Akhir</label>
                                                        <label class="ml-1">:</label>
                                                        @if ($sale->end_at)
                                                            <label
                                                                class="ml-2 w-28">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                                        @else
                                                            <label class="ml-2 w-28">-</label>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                <div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">No.</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ Str::substr($number, 0, 4) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Tgl.</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ date('d-M-Y', strtotime($created_at)) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">Harga</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ number_format($sale->price) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">DPP</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ number_format($sale->dpp) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">PPN</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ number_format($sale->dpp * ($sale->ppn / 100)) }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-8">PPh</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ number_format($sale->dpp * ($sale->pph / 100)) }}</label>
                                                    </div>
                                                    @if ($sale->media_category->name == 'Billboard')
                                                        <div class="flex ml-1">
                                                            <label class="w-14">Free Cetak</label>
                                                            <label class="ml-1">:</label>
                                                            <label class="ml-2">
                                                                @if ($notes->freePrint)
                                                                    {{ $notes->freePrint }} x
                                                                @else
                                                                    -
                                                                @endif
                                                            </label>
                                                        </div>
                                                        <div class="flex ml-1">
                                                            <label class="w-14">Free Pasang</label>
                                                            <label class="ml-1">:</label>
                                                            <label class="ml-2">
                                                                @if ($notes->freeInstall)
                                                                    {{ $notes->freeInstall }} x
                                                                @else
                                                                    -
                                                                @endif
                                                            </label>
                                                        </div>
                                                    @elseif ($sale->media_category->name == 'Signage')
                                                        @if ($description->type != 'Videotron')
                                                            <div class="flex ml-1">
                                                                <label class="w-14">Free Cetak</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2">
                                                                    @if ($notes->freePrint)
                                                                        {{ $notes->freePrint }} x
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-14">Free Pasang</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2">
                                                                    @if ($notes->freeInstall)
                                                                        {{ $notes->freeInstall }} x
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex ml-1 justify-center">
                                                            <label>{{ $terms->term }} %</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex mr-1 justify-end">
                                                            <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex mr-1 justify-end">
                                                            <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->ppn / 100)) }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex mr-1 justify-end">
                                                            <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->pph / 100)) }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                <div>
                                                    @foreach ($payment_terms->dataPayments as $terms)
                                                        <div class="flex mr-1 justify-end">
                                                            @if ($sale->dpp)
                                                                @php
                                                                    $subTotal = $sale->price * ($terms->term / 100);
                                                                    $ppnTerm =
                                                                        $sale->dpp *
                                                                        ($terms->term / 100) *
                                                                        ($sale->ppn / 100);
                                                                    $pphTerm =
                                                                        $sale->dpp *
                                                                        ($terms->term / 100) *
                                                                        ($sale->pph / 100);
                                                                @endphp
                                                                <label>{{ number_format($subTotal + $ppnTerm - $pphTerm) }}</label>
                                                            @else
                                                                <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                            </td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- </div> --}}
                {{-- <div class="flex justify-end mt-1 text-teal-900">
                    <label for="">Halaman {{ $i + 1 }} dari {{ $pageQty }}</label>
                </div> --}}
            </div>
        @endfor
    </div>
</div>
