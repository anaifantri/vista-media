    <table id="exportExcelTable" class="table-auto w-full" hidden>
        <thead>
            <tr class="bg-stone-400 h-6">
                <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center">No</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center">Data Lokasi</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">Izin Prinsip</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">PBG/SLF</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">Izin Reklame</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">SKPD</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">SSPD</th>
            </tr>
        </thead>
        <tbody class="bg-stone-300">
            @foreach ($export_locations as $location)
                @php
                    $dataPrinsip = $location->licenses->where('licensing_category_id', $prinsip)->last();
                    $dataPbg = $location->licenses->where('licensing_category_id', $pbg)->last();
                    $dataSlf = $location->licenses->where('licensing_category_id', $slf)->last();
                    $dataIpr = $location->licenses->where('licensing_category_id', $ipr)->last();
                    $dataSkpd = $location->licenses->where('licensing_category_id', $skpd)->last();
                    $dataSspd = $location->licenses->where('licensing_category_id', $sspd)->last();
                @endphp
                @if ($number % 2 == 0)
                    <tr class="bg-stone-100">
                        <td class="text-stone-900 border border-stone-900 text-xs text-center align-top">
                            {{ $loop->iteration }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs px-1 align-top">
                            <div class="flex">
                                <label class="flex w-10">Kode</label>
                                <label class="flex">:</label>
                                <label class="flex ml-1">{{ $location->code }} -
                                    {{ $location->city->code }}</label>
                            </div>
                            <div class="flex">
                                <label class="flex w-10">Lokasi</label>
                                <label class="flex">:</label>
                                <label class="flex ml-1">{{ $location->address }}</label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex font-semibold">:
                                    @if ($dataPrinsip)
                                        @if ($dataPrinsip->number)
                                            @if (strlen($dataPrinsip->number) > 10)
                                                {{ substr($dataPrinsip->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataPrinsip->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataPrinsip)
                                        @if ($dataPrinsip->start_at)
                                            {{ date('d', strtotime($dataPrinsip->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataPrinsip->start_at))] }}
                                            {{ date('Y', strtotime($dataPrinsip->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataPrinsip)
                                        @if ($dataPrinsip->end_at)
                                            {{ date('d', strtotime($dataPrinsip->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataPrinsip->end_at))] }}
                                            {{ date('Y', strtotime($dataPrinsip->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex">:
                                    @if ($dataPbg)
                                        @if ($dataPbg->number)
                                            @if (strlen($dataPbg->number) > 10)
                                                {{ substr($dataPbg->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataPbg->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @elseif ($dataSlf)
                                        @if ($dataSlf->number)
                                            @if (strlen($dataSlf->number) > 10)
                                                {{ substr($dataSlf->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataSlf->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataPbg)
                                        @if ($dataPbg->start_at)
                                            {{ date('d', strtotime($dataPbg->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataPbg->start_at))] }}
                                            {{ date('Y', strtotime($dataPbg->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @elseif ($dataSlf)
                                        @if ($dataSlf->start_at)
                                            {{ date('d', strtotime($dataSlf->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSlf->start_at))] }}
                                            {{ date('Y', strtotime($dataSlf->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataPbg)
                                        @if ($dataPbg->end_at)
                                            {{ date('d', strtotime($dataPbg->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataPbg->end_at))] }}
                                            {{ date('Y', strtotime($dataPbg->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @elseif ($dataSlf)
                                        @if ($dataSlf->end_at)
                                            {{ date('d', strtotime($dataSlf->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSlf->end_at))] }}
                                            {{ date('Y', strtotime($dataSlf->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex">:
                                    @if ($dataIpr)
                                        @if ($dataIpr->number)
                                            @if (strlen($dataIpr->number) > 10)
                                                {{ substr($dataIpr->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataIpr->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataIpr)
                                        @if ($dataIpr->start_at)
                                            {{ date('d', strtotime($dataIpr->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataIpr->start_at))] }}
                                            {{ date('Y', strtotime($dataIpr->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataIpr)
                                        @if ($dataIpr->end_at)
                                            {{ date('d', strtotime($dataIpr->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataIpr->end_at))] }}
                                            {{ date('Y', strtotime($dataIpr->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex">:
                                    @if ($dataSkpd)
                                        @if ($dataSkpd->number)
                                            @if (strlen($dataSkpd->number) > 10)
                                                {{ substr($dataSkpd->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataSkpd->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataSkpd)
                                        @if ($dataSkpd->start_at)
                                            {{ date('d', strtotime($dataSkpd->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSkpd->start_at))] }}
                                            {{ date('Y', strtotime($dataSkpd->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataSkpd)
                                        @if ($dataSkpd->end_at)
                                            {{ date('d', strtotime($dataSkpd->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSkpd->end_at))] }}
                                            {{ date('Y', strtotime($dataSkpd->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex">:
                                    @if ($dataSspd)
                                        @if ($dataSspd->number)
                                            @if (strlen($dataSspd->number) > 10)
                                                {{ substr($dataSspd->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataSspd->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataSspd)
                                        @if ($dataSspd->start_at)
                                            {{ date('d', strtotime($dataSspd->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSspd->start_at))] }}
                                            {{ date('Y', strtotime($dataSspd->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataSspd)
                                        @if ($dataSspd->end_at)
                                            {{ date('d', strtotime($dataSspd->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSspd->end_at))] }}
                                            {{ date('Y', strtotime($dataSspd->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center align-top">
                            {{ $loop->iteration }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs px-1 align-top">
                            <div class="flex">
                                <label class="flex w-10">Kode</label>
                                <label class="flex">:</label>
                                <label class="flex ml-1">{{ $location->code }} -
                                    {{ $location->city->code }}</label>
                            </div>
                            <div class="flex">
                                <label class="flex w-10">Lokasi</label>
                                <label class="flex">:</label>
                                <label class="flex ml-1">{{ $location->address }}</label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex font-semibold">:
                                    @if ($dataPrinsip)
                                        @if ($dataPrinsip->number)
                                            @if (strlen($dataPrinsip->number) > 10)
                                                {{ substr($dataPrinsip->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataPrinsip->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataPrinsip)
                                        @if ($dataPrinsip->start_at)
                                            {{ date('d', strtotime($dataPrinsip->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataPrinsip->start_at))] }}
                                            {{ date('Y', strtotime($dataPrinsip->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataPrinsip)
                                        @if ($dataPrinsip->end_at)
                                            {{ date('d', strtotime($dataPrinsip->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataPrinsip->end_at))] }}
                                            {{ date('Y', strtotime($dataPrinsip->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex">:
                                    @if ($dataPbg)
                                        @if ($dataPbg->number)
                                            @if (strlen($dataPbg->number) > 10)
                                                {{ substr($dataPbg->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataPbg->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @elseif ($dataSlf)
                                        @if ($dataSlf->number)
                                            @if (strlen($dataSlf->number) > 10)
                                                {{ substr($dataSlf->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataSlf->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataPbg)
                                        @if ($dataPbg->start_at)
                                            {{ date('d', strtotime($dataPbg->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataPbg->start_at))] }}
                                            {{ date('Y', strtotime($dataPbg->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @elseif ($dataSlf)
                                        @if ($dataSlf->start_at)
                                            {{ date('d', strtotime($dataSlf->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSlf->start_at))] }}
                                            {{ date('Y', strtotime($dataSlf->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataPbg)
                                        @if ($dataPbg->end_at)
                                            {{ date('d', strtotime($dataPbg->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataPbg->end_at))] }}
                                            {{ date('Y', strtotime($dataPbg->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @elseif ($dataSlf)
                                        @if ($dataSlf->end_at)
                                            {{ date('d', strtotime($dataSlf->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSlf->end_at))] }}
                                            {{ date('Y', strtotime($dataSlf->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex">:
                                    @if ($dataIpr)
                                        @if ($dataIpr->number)
                                            @if (strlen($dataIpr->number) > 10)
                                                {{ substr($dataIpr->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataIpr->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataIpr)
                                        @if ($dataIpr->start_at)
                                            {{ date('d', strtotime($dataIpr->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataIpr->start_at))] }}
                                            {{ date('Y', strtotime($dataIpr->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataIpr)
                                        @if ($dataIpr->end_at)
                                            {{ date('d', strtotime($dataIpr->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataIpr->end_at))] }}
                                            {{ date('Y', strtotime($dataIpr->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex">:
                                    @if ($dataSkpd)
                                        @if ($dataSkpd->number)
                                            @if (strlen($dataSkpd->number) > 10)
                                                {{ substr($dataSkpd->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataSkpd->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataSkpd)
                                        @if ($dataSkpd->start_at)
                                            {{ date('d', strtotime($dataSkpd->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSkpd->start_at))] }}
                                            {{ date('Y', strtotime($dataSkpd->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataSkpd)
                                        @if ($dataSkpd->end_at)
                                            {{ date('d', strtotime($dataSkpd->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSkpd->end_at))] }}
                                            {{ date('Y', strtotime($dataSkpd->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs">
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Nomor</label>
                                <label class="flex">:
                                    @if ($dataSspd)
                                        @if ($dataSspd->number)
                                            @if (strlen($dataSspd->number) > 10)
                                                {{ substr($dataSspd->number, 0, 10) }}...
                                            @else
                                                {{ substr($dataSspd->number, 0, 10) }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Awal</label>
                                <label class="flex">:
                                    @if ($dataSspd)
                                        @if ($dataSspd->start_at)
                                            {{ date('d', strtotime($dataSspd->start_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSspd->start_at))] }}
                                            {{ date('Y', strtotime($dataSspd->start_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                            <div class="flex w-36 px-1">
                                <label class="flex w-12">Akhir</label>
                                <label class="flex">:
                                    @if ($dataSspd)
                                        @if ($dataSspd->end_at)
                                            {{ date('d', strtotime($dataSspd->end_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($dataSspd->end_at))] }}
                                            {{ date('Y', strtotime($dataSspd->end_at)) }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </label>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
