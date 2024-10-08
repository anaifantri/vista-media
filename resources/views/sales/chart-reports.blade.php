<div id="chartReport" class="hidden justify-center z-0">
    <?php
    if (fmod(count($locations), 30) == 0) {
        $pageQtyChart = count($sales) / 30;
    } else {
        $pageQtyChart = (count($locations) - fmod(count($locations), 30)) / 30 + 1;
    }
    if (request('yearReport')) {
        $thisYear = request('yearReport');
    } else {
        $thisYear = date('Y');
    }
    $prevYear = $thisYear - 1;
    $nextYear = $thisYear + 1;
    ?>
    <div id="pdfChartPreview">
        @for ($j = 0; $j < $pageQtyChart; $j++)
            <div class="w-[1280px] h-[890px] px-10 mt-2">
                <div class="flex h-[100px] items-center border rounded-lg p-2 mt-4">
                    <div class="w-28">
                        <img class="ml-2" src="/img/logo-vm.png" alt="">
                    </div>
                    <div class="w-[450px] ml-6">
                        <div>
                            <span class="text-xs font-semibold">PT. Vista Media</span>
                        </div>
                        <div>
                            <span class="text-[0.65rem]">Jl. Pulau Kawe No. 40 - Dauh Puri Kauh</span>
                        </div>
                        <div>
                            <span class="text-[0.65rem]">Kota Denpasar, Bali 80114</span>
                        </div>
                        <div>
                            <span class="text-[0.65rem]">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                        </div>
                        <div>
                            <span class="text-[0.65rem]">e-mail : info@vistamedia.co.id |
                                www.vistamedia.co.id</span>
                        </div>
                    </div>
                    <div class="flex w-full justify-end">
                        <div>
                            <div class="flex justify-center w-60">
                                @if (request('area'))
                                    @foreach ($areas as $area)
                                        @if ($area->id == request('area'))
                                            <label id="labelArea"
                                                class="text-3xl text-center border rounded-md p-1">{{ strtoupper($area->area) }}</label>
                                        @endif
                                    @endforeach
                                @else
                                    <label id="labelArea" class="text-3xl text-center border rounded-md p-1">SEMUA
                                        LOKASI</label>
                                @endif
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
                            <tr class="bg-teal-100 h-5">
                                <th class="text-teal-700 border text-[0.65rem] w-8 text-center" rowspan="2">No.</th>
                                <th class="text-teal-700 border text-[0.65rem] w-[60px] text-center" rowspan="2">
                                    <button class="flex justify-center items-center w-[60px]">@sortablelink('code', 'Kode')
                                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                        </svg>
                                    </button>
                                </th>
                                <th class="text-teal-700 border text-[0.65rem] text-center" rowspan="2">Lokasi</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center " colspan="5">Jenis
                                    Reklame
                                </th>
                                <th class="text-teal-700 border text-[0.65rem] text-center " colspan="3">Detail
                                    Kontrak</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center " colspan="2">Periode
                                    Kontrak
                                </th>
                                <th class="text-teal-700 border text-[0.65rem] text-center " colspan="12">Grafik
                                    Periode
                                    Kontrak
                                </th>
                            </tr>
                            <tr class="bg-teal-100 h-5">
                                <th class="text-teal-700 border text-[0.65rem] text-center w-6">Jns</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-8">BL/FL</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-6">Side</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-6">Qty</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[72px]">Size</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-20">Klien</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-16">Nilai</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-12">Durasi</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[60px]">Awal</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[60px]">Akhir</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[31px]">Jan</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[28px]">Feb</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[31px]">Mar</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[30px]">Apr</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[31px]">Mei</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[30px]">Jun</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[31px]">Jul</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[31px]">Agu</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[30px]">Sep</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[31px]">Okt</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[30px]">Nop</th>
                                <th class="text-teal-700 border text-[0.65rem] text-center w-[31px]">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $number = 1 + ($locations->currentPage() - 1) * $locations->perPage();
                            @endphp
                            @foreach ($locations as $location)
                                @php
                                    $client = null;
                                    $price = null;
                                    $duration = null;
                                    $start_at = null;
                                    $end_at = null;
                                    $description = json_decode($location->description);
                                    if (count($location->sales) != 0) {
                                        if ($location->sales[count($location->sales) - 1]->end_at > date('Y-m-d')) {
                                            $client = json_decode(
                                                $location->sales[count($location->sales) - 1]->quotation->clients,
                                            );
                                            $price = $location->sales[count($location->sales) - 1]->price;
                                            $start_at = $location->sales[count($location->sales) - 1]->start_at;
                                            $end_at = $location->sales[count($location->sales) - 1]->end_at;
                                            $duration = $location->sales[count($location->sales) - 1]->duration;
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">{{ $number++ }}</td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">{{ $location->code }} -
                                        {{ $location->city->code }}
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] px-2">
                                        {{ $location->address }}
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        @if ($location->media_category->name == 'Billboard')
                                            BB
                                        @elseif ($location->media_category->name == 'Bando')
                                            BD
                                        @elseif ($location->media_category->name == 'Videotron')
                                            VT
                                        @elseif ($location->media_category->name == 'Signage')
                                            SN
                                        @elseif ($location->media_category->name == 'Baliho')
                                            BLH
                                        @elseif ($location->media_category->name == 'Midiboard')
                                            MB
                                        @endif
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        @if ($location->media_category->name == 'Videotron')
                                            LED
                                        @elseif ($location->media_category->name == 'Signage')
                                            @if ($description->type == 'Videotron')
                                                LED
                                            @else
                                                @if ($description->lighting == 'Backlight')
                                                    BL
                                                @elseif ($description->lighting == 'Frontlight')
                                                    FL
                                                @elseif ($description->lighting == 'Nonlight')
                                                    NL
                                                @endif
                                            @endif
                                        @else
                                            @if ($description->lighting == 'Backlight')
                                                BL
                                            @elseif ($description->lighting == 'Frontlight')
                                                FL
                                            @elseif ($description->lighting == 'Nonlight')
                                                NL
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        {{ preg_replace('/[^0-9]/', '', $location->side) }}</td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        @if ($location->media_category->name == 'Signage')
                                            {{ $description->qty }}
                                        @else
                                            1
                                        @endif
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        {{ $location->media_size->size }}
                                        -
                                        @if ($location->orientation == 'Vertikal')
                                            V
                                        @elseif ($location->orientation == 'Horizontal')
                                            H
                                        @endif
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        @if ($client)
                                            {{ $client->name }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        @if ($price)
                                            {{ number_format($price) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        @if ($duration)
                                            {{ $duration }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        @if ($start_at)
                                            {{ date('d-m-Y', strtotime($start_at)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                        @if ($end_at)
                                            {{ date('d-m-Y', strtotime($end_at)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-teal-700 text-[0.65rem] border">
                                        <div class="flex h-5 items-center relative">
                                            @foreach ($location->sales as $locationSale)
                                                @php
                                                    $clients = json_decode($locationSale->quotation->clients);
                                                @endphp
                                                @if ($locationSale->end_at > date('Y-m-d'))
                                                    @php
                                                        if (
                                                            strtotime($locationSale->start_at) >
                                                            strtotime(date($thisYear . '-01-01'))
                                                        ) {
                                                            $start =
                                                                (strtotime($locationSale->start_at) -
                                                                    strtotime(date($thisYear . '-01-01'))) /
                                                                60 /
                                                                60 /
                                                                24;
                                                        }
                                                        if (
                                                            strtotime($locationSale->end_at) >
                                                            strtotime(date($thisYear . '-12-31'))
                                                        ) {
                                                            $lineWidth =
                                                                (strtotime(date($thisYear . '-12-31')) -
                                                                    strtotime($locationSale->start_at)) /
                                                                60 /
                                                                60 /
                                                                24;
                                                        } else {
                                                            $lineWidth =
                                                                (strtotime($locationSale->end_at) -
                                                                    strtotime($locationSale->start_at)) /
                                                                60 /
                                                                60 /
                                                                24;
                                                        }
                                                    @endphp
                                                    <div class="absolute">
                                                        <div class="flex">
                                                            @for ($i = 0; $i < 365; $i++)
                                                                @if ($i < $start)
                                                                    <div class="h-[2px] w-[1px]">
                                                                    </div>
                                                                @elseif ($i == $start)
                                                                    <label for="">{{ $clients->name }}</label>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <div class="flex">
                                                            @for ($i = 0; $i < 365; $i++)
                                                                @if ($i < $start)
                                                                    <div class="h-[2px] w-[1px]">
                                                                    </div>
                                                                @elseif ($i >= $start && $i <= $lineWidth + $start)
                                                                    <div class="h-[2px] bg-red-700 w-[1px]">
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                @elseif ($locationSale->end_at > strtotime(date($thisYear . '-01-01')) && $locationSale->end_at < date('Y-m-d'))
                                                    @php
                                                        if (
                                                            $locationSale->start_at >
                                                            strtotime(date($thisYear . '-01-01'))
                                                        ) {
                                                            $start =
                                                                (strtotime($locationSale->start_at) -
                                                                    strtotime(date($thisYear . '-01-01'))) /
                                                                60 /
                                                                60 /
                                                                24;
                                                            $lineWidth =
                                                                (strtotime(date($locationSale->end_at)) -
                                                                    strtotime($locationSale->start_at)) /
                                                                60 /
                                                                60 /
                                                                24;
                                                        } else {
                                                            $start = 0;
                                                            $lineWidth =
                                                                (strtotime(date($locationSale->end_at)) -
                                                                    strtotime($locationSale->start_at)) /
                                                                60 /
                                                                60 /
                                                                24;
                                                        }
                                                    @endphp
                                                    <div class="absolute">
                                                        <div class="flex">
                                                            @for ($i = 0; $i < 365; $i++)
                                                                @if ($i < $start)
                                                                    <div class="h-[2px] w-[1px]">
                                                                    </div>
                                                                @elseif ($i == $start)
                                                                    <label for="">{{ $clients->name }}</label>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <div class="flex">
                                                            @for ($i = 0; $i < 365; $i++)
                                                                @if ($i < $start)
                                                                    <div class="h-[2px] w-[1px]">
                                                                    </div>
                                                                @elseif ($i >= $start && $i <= $lineWidth + $start)
                                                                    <div class="h-[2px] bg-slate-600 w-[1px]">
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                    <td class="relative text-teal-700 border text-[0.65rem] text-center"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endfor
    </div>
</div>
