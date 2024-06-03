<div id="chartReport" class="hidden justify-center z-0 p-10">
    <?php
    if (fmod(count($billboards), 30) == 0) {
        $pageQtyChart = count($sales) / 30;
    } else {
        $pageQtyChart = (count($billboards) - fmod(count($billboards), 30)) / 30 + 1;
    }
    ?>
    <div id="pdfChartPreview">
        @for ($j = 0; $j < $pageQtyChart; $j++)
            <div class="w-[1280px] h-[890px] p-6 mt-2">
                <div class="flex h-[100px] items-center border rounded-lg p-2 mt-4">
                    <div class="w-28">
                        <img class="ml-2" src="/img/logo-vm.png" alt="">
                    </div>
                    <div class="w-[450px] ml-6">
                        <div>
                            <span class="text-xs font-semibold">PT. Vista Media</span>
                        </div>
                        <div>
                            <span class="text-[0.7rem]">Jl. Pulau Kawe No. 40 - Dauh Puri Kauh</span>
                        </div>
                        <div>
                            <span class="text-[0.7rem]">Kota Denpasar, Bali 80114</span>
                        </div>
                        <div>
                            <span class="text-[0.7rem]">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                        </div>
                        <div>
                            <span class="text-[0.7rem]">e-mail : info@vistamedia.co.id |
                                www.vistamedia.co.id</span>
                        </div>
                    </div>
                    <div class="flex w-full justify-end">
                        <div>
                            <div class="flex justify-center w-60">
                                <label class="text-3xl text-center border rounded-md p-1">1. BALI</label>
                            </div>
                            <div class="flex justify-center w-60">
                                <label class="text-sm text-center">GRAFIK PERIODE KONTRAK</label>
                            </div>
                            <div class="flex justify-center w-60">
                                <label class="text-sm text-center"></label>
                            </div>
                            <div class="flex justify-center w-60 border rounded-md">
                                <?php
                                $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                ?>
                                <label id="labelPeriode" class="month-report">
                                    <span class="text-md font-semibold text-red-600">Tgl. Cetak : </span>
                                    {{ date('d') }} {{ $bulan[(int) date('m')] }} {{ date('Y') }}</label>
                            </div>
                        </div>
                        <div class=" ml-4 mt-1">
                            <div class="flex justify-center items-center w-24 border rounded-md p-1">
                                <label class="text-4xl font-semibold text-center">H</label>
                            </div>
                            <div class="flex justify-center items-center w-24 border rounded-md mt-1">
                                @if (request('yearReport'))
                                    <label class="text-xl font-semibold text-center">{{ request('yearReport') }}</label>
                                @else
                                    <label class="text-xl font-semibold text-center">2024</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-[622px] mt-2">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-teal-100 h-6">
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-8" rowspan="2">
                                    No.
                                </th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16 text-center"
                                    rowspan="2">
                                    <button class="flex justify-center items-center w-16">@sortablelink('code', 'Kode')
                                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                        </svg>
                                    </button>
                                </th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem]" rowspan="2">Lokasi
                                </th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-8" rowspan="2">
                                    Kota</th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-32" colspan="3">
                                    Jenis Reklame</th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-48" colspan="3">
                                    Detail Kontrak</th>

                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-36" colspan="2">
                                    Periode Kontrak</th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-[365px]" colspan="12">
                                    Grafik Periode Kontrak</th>
                            </tr>
                            <tr class="bg-teal-100 h-6">
                                <th class="text-teal-700 border text-[0.65rem] w-8">Jenis</th>
                                <th class="text-teal-700 border text-[0.65rem] w-8">BL/FL</th>
                                <th class="text-teal-700 border text-[0.65rem] w-20">Size - V/H</th>
                                <th class="text-teal-700 border text-[0.65rem] w-24">Klien</th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-20">Nilai (Rp.)</th>
                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-12">Durasi</th>
                                <th class="text-teal-700 border text-[0.65rem] w-16">Awal</th>
                                <th class="text-teal-700 border text-[0.65rem] w-16">Akhir</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[31px]">Jan</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[28px]">Feb</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[31px]">Mar</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[30px]">Apr</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[31px]">Mei</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[30px]">Jun</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[31px]">Jul</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[31px]">Agu</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[30px]">Sep</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[31px]">Okt</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[30px]">Nov</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[31px]">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($billboards as $billboard)
                                @if ($j == 0)
                                    @if ($loop->iteration < 31)
                                        <?php
                                        $billboardSales = [];
                                        $activeClient = [];
                                        $billboardSaleNumber = 0;
                                        $saleObjects = [];
                                        $numberSales = 0;
                                        $hasClient = false;
                                        if (request('yearReport')) {
                                            $thisYear = request('yearReport');
                                        } else {
                                            $thisYear = date('Y');
                                        }
                                        $prevYear = $thisYear - 1;
                                        $nextYear = $thisYear + 1;
                                        ?>
                                        <tr class="h-[22px]">
                                            <td class="text-teal-700 border text-[0.65rem] text-center">
                                                {{ $loop->iteration }}</td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center">
                                                {{ $billboard->code }} - {{ $billboard->city->code }}</td>
                                            <td class="text-teal-700 border text-[0.65rem] px-1">
                                                {{ $billboard->address }}</td>
                                            <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                {{ $billboard->city->code }}</td>
                                            @if ($billboard->billboard_category->name == 'Billboard')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BB
                                                </td>
                                            @elseif ($billboard->billboard_category->name == 'Bando')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BD
                                                </td>
                                            @elseif ($billboard->billboard_category->name == 'Baliho')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    BLH</td>
                                            @elseif ($billboard->billboard_category->name == 'Midiboard')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">MB
                                                </td>
                                            @endif
                                            @if ($billboard->lighting == 'Frontlight')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">FL
                                                </td>
                                            @elseif ($billboard->lighting == 'Backlight')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BL
                                                </td>
                                            @elseif ($billboard->lighting == 'Nonlight')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">NL
                                                </td>
                                            @endif
                                            @if ($billboard->orientation == 'Vertikal')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    {{ $billboard->size->size }} - V</td>
                                            @elseif ($billboard->orientation == 'Horizontal')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    {{ $billboard->size->size }} - V</td>
                                            @endif
                                            @foreach ($sales as $sale)
                                                @if ($sale->billboard_id == $billboard->id)
                                                    <?php
                                                    $billboardSales[$billboardSaleNumber] = $sale;
                                                    $billboardSaleNumber = $billboardSaleNumber + 1;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($billboardSales)
                                                @foreach ($billboardSales as $billboardSale)
                                                    @if ($thisYear == date('Y'))
                                                        @if (strtotime($billboardSale->end_at) > strtotime(date('Y/m/d')))
                                                            <?php
                                                            $activeClient[0] = $billboardSale;
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => true,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @else
                                                            <?php
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => false,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @endif
                                                    @elseif ($thisYear > date('Y'))
                                                        @if (strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01')))
                                                            <?php
                                                            $activeClient[0] = $billboardSale;
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => true,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @else
                                                            <?php
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => false,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @endif
                                                    @elseif ($thisYear < date('Y'))
                                                        @if (strtotime($billboardSale->start_at) <= strtotime(date($thisYear . '-12-31')) &&
                                                                strtotime($billboardSale->end_at) > strtotime(date('Y/m/d')))
                                                            <?php
                                                            $activeClient[0] = $billboardSale;
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => true,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @else
                                                            <?php
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => false,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                {{-- {{ var_dump($saleObjects) }} --}}
                                                @if ($activeClient)
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ $activeClient[0]->client->name }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ number_format($activeClient[0]->price) }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ $activeClient[0]->duration }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ date('d-M-Y', strtotime($activeClient[0]->start_at)) }}
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ date('d-M-Y', strtotime($activeClient[0]->end_at)) }}
                                                    </td>
                                                    <td class="relative border text-[0.65rem]">
                                                        <div class="flex absolute w-[365px] h-4 z-50">
                                                            @foreach ($saleObjects as $saleObject)
                                                                @if ($saleObject->active == true)
                                                                    @if ($loop->iteration - 1 == 0)
                                                                        @if ($saleObject->start == 0)
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i == 0)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px] w-max">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px] w-max">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @else
                                                                        @if ($startContract == $saleObject->start)
                                                                            @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                @if ($i == $saleObject->start)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px] w-max">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px] w-max">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if ($loop->iteration - 1 == 0)
                                                                        @if ($saleObject->start == 0)
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i == 0)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px] w-max">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px] w-max">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @else
                                                                        @if ($startContract == $saleObject->start)
                                                                            @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                @if ($i == $saleObject->start)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px] w-max">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px] w-max">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                @else
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="relative border text-[0.65rem]">
                                                        <div class="flex absolute w-[365px]">
                                                            @foreach ($saleObjects as $saleObject)
                                                                @if ($saleObject->active == true)
                                                                    @if ($loop->iteration - 1 == 0)
                                                                        @if ($saleObject->start == 0)
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i == 0)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px]">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px]">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @else
                                                                        @if ($startContract == $saleObject->start)
                                                                            @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                @if ($i == $saleObject->start)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px]">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px]">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if ($loop->iteration - 1 == 0)
                                                                        @if ($saleObject->start == 0)
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i == 0)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px]">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px]">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @else
                                                                        @if ($startContract == $saleObject->start)
                                                                            @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                @if ($i == $saleObject->start)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px]">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px]">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                @endif
                                            @else
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                            @endif
                                        </tr>
                                    @endif
                                @else
                                    @if ($loop->iteration > $j * 30 && $loop->iteration < ($j + 1) * 30 + 1)
                                        <?php
                                        $billboardSales = [];
                                        $activeClient = [];
                                        $billboardSaleNumber = 0;
                                        $saleObjects = [];
                                        $numberSales = 0;
                                        $hasClient = false;
                                        if (request('yearReport')) {
                                            $thisYear = request('yearReport');
                                        } else {
                                            $thisYear = date('Y');
                                        }
                                        $prevYear = $thisYear - 1;
                                        $nextYear = $thisYear + 1;
                                        ?>
                                        <tr class="h-[22px]">
                                            <td class="text-teal-700 border text-[0.65rem] text-center">
                                                {{ $loop->iteration }}</td>
                                            <td class="text-teal-700 border text-[0.65rem] text-center">
                                                {{ $billboard->code }} - {{ $billboard->city->code }}</td>
                                            <td class="text-teal-700 border text-[0.65rem] px-1">
                                                {{ $billboard->address }}</td>
                                            <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                {{ $billboard->city->code }}</td>
                                            @if ($billboard->billboard_category->name == 'Billboard')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BB
                                                </td>
                                            @elseif ($billboard->billboard_category->name == 'Bando')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BD
                                                </td>
                                            @elseif ($billboard->billboard_category->name == 'Baliho')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    BLH</td>
                                            @elseif ($billboard->billboard_category->name == 'Midiboard')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">MB
                                                </td>
                                            @endif
                                            @if ($billboard->lighting == 'Frontlight')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">FL
                                                </td>
                                            @elseif ($billboard->lighting == 'Backlight')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BL
                                                </td>
                                            @elseif ($billboard->lighting == 'Nonlight')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">NL
                                                </td>
                                            @endif
                                            @if ($billboard->orientation == 'Vertikal')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    {{ $billboard->size->size }} - V</td>
                                            @elseif ($billboard->orientation == 'Horizontal')
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    {{ $billboard->size->size }} - V</td>
                                            @endif
                                            @foreach ($sales as $sale)
                                                @if ($sale->billboard_id == $billboard->id)
                                                    <?php
                                                    $billboardSales[$billboardSaleNumber] = $sale;
                                                    $billboardSaleNumber = $billboardSaleNumber + 1;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($billboardSales)
                                                @foreach ($billboardSales as $billboardSale)
                                                    @if ($thisYear == date('Y'))
                                                        @if (strtotime($billboardSale->end_at) > strtotime(date('Y/m/d')))
                                                            <?php
                                                            $activeClient[0] = $billboardSale;
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => true,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @else
                                                            <?php
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => false,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @endif
                                                    @elseif ($thisYear > date('Y'))
                                                        @if (strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01')))
                                                            <?php
                                                            $activeClient[0] = $billboardSale;
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => true,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @else
                                                            <?php
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => false,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @endif
                                                    @elseif ($thisYear < date('Y'))
                                                        @if (strtotime($billboardSale->start_at) <= strtotime(date($thisYear . '-12-31')) &&
                                                                strtotime($billboardSale->end_at) > strtotime(date('Y/m/d')))
                                                            <?php
                                                            $activeClient[0] = $billboardSale;
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => true,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @else
                                                            <?php
                                                            $startThisYear = 0;
                                                            $diffPrevYear = 0;
                                                            $diffThisYear = 0;
                                                            $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                            if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $startThisYear = 0;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                            }
                                                            $saleObjects[$numberSales] = (object) [
                                                                'active' => false,
                                                                'start' => $startThisYear,
                                                                'end' => $startThisYear + $diffThisYear,
                                                                'client' => $billboardSale->client->name,
                                                            ];
                                                            $numberSales = $numberSales + 1;
                                                            ?>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                {{-- {{ var_dump($saleObjects) }} --}}
                                                @if ($activeClient)
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ $activeClient[0]->client->name }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ number_format($activeClient[0]->price) }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ $activeClient[0]->duration }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ date('d-M-Y', strtotime($activeClient[0]->start_at)) }}
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ date('d-M-Y', strtotime($activeClient[0]->end_at)) }}
                                                    </td>
                                                    <td class="relative border text-[0.65rem]">
                                                        <div class="flex absolute w-[365px] h-4 z-50">
                                                            @foreach ($saleObjects as $saleObject)
                                                                @if ($saleObject->active == true)
                                                                    @if ($loop->iteration - 1 == 0)
                                                                        @if ($saleObject->start == 0)
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i == 0)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px] w-max">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px] w-max">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @else
                                                                        @if ($startContract == $saleObject->start)
                                                                            @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                @if ($i == $saleObject->start)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px] w-max">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px] w-max">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if ($loop->iteration - 1 == 0)
                                                                        @if ($saleObject->start == 0)
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i == 0)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px] w-max">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px] w-max">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @else
                                                                        @if ($startContract == $saleObject->start)
                                                                            @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                @if ($i == $saleObject->start)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px] w-max">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px] w-max">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                @else
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                    </td>
                                                    <td class="relative border text-[0.65rem]">
                                                        <div class="flex absolute w-[365px]">
                                                            @foreach ($saleObjects as $saleObject)
                                                                @if ($saleObject->active == true)
                                                                    @if ($loop->iteration - 1 == 0)
                                                                        @if ($saleObject->start == 0)
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i == 0)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px]">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px]">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @else
                                                                        @if ($startContract == $saleObject->start)
                                                                            @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                @if ($i == $saleObject->start)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px]">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-red-700">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px]">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-red-700">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if ($loop->iteration - 1 == 0)
                                                                        @if ($saleObject->start == 0)
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i == 0)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px]">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px]">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @else
                                                                        @if ($startContract == $saleObject->start)
                                                                            @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                @if ($i == $saleObject->start)
                                                                                    <div class="relative">
                                                                                        <div
                                                                                            class="flex absolute mt-[-12px]">
                                                                                            <label
                                                                                                for="">{{ $saleObject->client }}</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="relative">
                                                                                        <div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="w-[1px] h-[3px] bg-slate-500">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @else
                                                                            @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                @if ($i < $saleObject->start)
                                                                                    <div class="w-[1px] h-[3px]">
                                                                                    </div>
                                                                                @else
                                                                                    @if ($i == $saleObject->start)
                                                                                        <div class="relative">
                                                                                            <div
                                                                                                class="flex absolute mt-[-12px]">
                                                                                                <label
                                                                                                    for="">{{ $saleObject->client }}</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="relative">
                                                                                            <div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="w-[1px] h-[3px] bg-slate-500">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endfor
                                                                            <?php
                                                                            $startContract = $saleObject->end;
                                                                            ?>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                    <td class="relative border text-[0.65rem]"></td>
                                                @endif
                                            @else
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                </td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                                <td class="relative border text-[0.65rem]"></td>
                                            @endif
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endfor
    </div>
</div>
