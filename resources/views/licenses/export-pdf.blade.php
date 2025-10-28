<div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md" hidden>
    <div class="flex justify-center w-full">
        <div id="pdfPreview">
            @if (count($export_locations) == 0)
                <div class="w-[1550px] h-[980px] bg-white p-8">
                    <div class="flex items-center border rounded-lg p-2 mt-6">
                        <div class="w-44">
                            <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}" alt="">
                        </div>
                        <div class="w-[750px] ml-6">
                            <div>
                                <span class="text-sm font-semibold">{{ $company->name }}</span>
                            </div>
                            <div>
                                <span class="text-sm">{{ $company->address }}, Desa/Kel. {{ $company->village }},
                                    Kec.
                                    {{ $company->district }}</span>
                            </div>
                            <div>
                                <span class="text-sm">{{ $company->city }} - {{ $company->province }}
                                    {{ $company->post_code }}</span>
                            </div>
                            <div>
                                <span class="text-sm">Ph. {{ $company->phone }} | Mobile.
                                    {{ $company->m_phone }}</span>
                            </div>
                            <div>
                                <span class="text-sm">e-mail : {{ $company->email }} | website :
                                    {{ $company->website }}</span>
                            </div>
                        </div>
                        <div class="flex w-full justify-end">
                            <div>
                                <div class="flex items-end justify-center w-56">
                                    <label class="text-5xl text-center font-bold">-</label>
                                </div>
                                <div class="flex justify-center w-56">
                                    <label class="text-lg text-center font-bold">LIST SEWA LAHAN</label>
                                </div>
                                <div class="flex justify-center w-56">
                                    <label class="text-sm text-center"></label>
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
                    <div class="flex justify-center h-[875px] mt-2">
                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data perizinan
                            ~~</label>
                    </div>
                </div>
            @else
                @for ($i = 0; $i < $totalPages; $i++)
                    <div class="w-[1550px] h-[1100px] bg-white p-8 mt-2">
                        <div class="flex items-center border rounded-lg p-2 mt-6">
                            <div class="w-44">
                                <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}"
                                    alt="">
                            </div>
                            <div class="w-[750px] ml-6">
                                <div>
                                    <span class="text-sm font-semibold">{{ $company->name }}</span>
                                </div>
                                <div>
                                    <span class="text-sm">{{ $company->address }}, Desa/Kel.
                                        {{ $company->village }},
                                        Kec.
                                        {{ $company->district }}</span>
                                </div>
                                <div>
                                    <span class="text-sm">{{ $company->city }} - {{ $company->province }}
                                        {{ $company->post_code }}</span>
                                </div>
                                <div>
                                    <span class="text-sm">Ph. {{ $company->phone }} | Mobile.
                                        {{ $company->m_phone }}</span>
                                </div>
                                <div>
                                    <span class="text-sm">e-mail : {{ $company->email }} | website :
                                        {{ $company->website }}</span>
                                </div>
                            </div>
                            <div class="flex w-full justify-end">
                                <div>
                                    <div class="flex items-end justify-center w-96">
                                        <label class="text-5xl text-center font-bold">-</label>
                                    </div>
                                    <div class="flex justify-center w-96">
                                        <label class="text-lg text-center font-bold">{{ strtoupper($title) }}</label>
                                    </div>
                                    <div class="flex justify-center w-96 border rounded-md mt-2">
                                        <label class="text-sm">
                                            <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
                                            </span>
                                            {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                            {{ date('Y') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-[800px] mt-6">
                            <table class="table-auto w-full mt-4">
                                <thead>
                                    <tr class="bg-stone-400 h-10">
                                        <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center">No
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-xs text-center">Data
                                            Lokasi</th>
                                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">Izin
                                            Prinsip</th>
                                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">
                                            PBG/SLF</th>
                                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">Izin
                                            Reklame</th>
                                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">SKPD
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">SSPD
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($export_locations as $excelLocation)
                                        @if ($loop->iteration > $i * 15 && $loop->iteration < ($i + 1) * 15 + 1)
                                            @php
                                                $dataPrinsip = $location->licenses
                                                    ->where('licensing_category_id', $prinsip)
                                                    ->last();
                                                $dataPbg = $location->licenses
                                                    ->where('licensing_category_id', $pbg)
                                                    ->last();
                                                $dataSlf = $location->licenses
                                                    ->where('licensing_category_id', $slf)
                                                    ->last();
                                                $dataIpr = $location->licenses
                                                    ->where('licensing_category_id', $ipr)
                                                    ->last();
                                                $dataSkpd = $location->licenses
                                                    ->where('licensing_category_id', $skpd)
                                                    ->last();
                                                $dataSspd = $location->licenses
                                                    ->where('licensing_category_id', $sspd)
                                                    ->last();
                                            @endphp
                                            @if ($number % 2 == 0)
                                                <tr class="bg-stone-100">
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-xs text-center align-top">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-xs px-1 align-top">
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
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-xs text-center align-top">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-xs px-1 align-top">
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
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex items-end justify-end mt-8 text-black">
                            <label for="">Halaman {{ $i + 1 }} dari
                                {{ $totalPages }}</label>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>
</div>
