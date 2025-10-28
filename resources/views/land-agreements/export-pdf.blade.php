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
                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data sewa
                            lahan
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
                                    <tr class="h-8">
                                        <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center"
                                            rowspan="2">No
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                            colspan="2">Data
                                            Lokasi</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                            colspan="4">Data
                                            Perjanjian</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                            colspan="3">Periode
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                            colspan="2">Harga
                                        </th>
                                    </tr>
                                    <tr class="h-8">
                                        <th class="text-stone-900 border border-stone-900 text-sm w-20 text-center">
                                            Kode
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center">
                                            Lokasi
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-48">
                                            Nomor</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                            Tanggal</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-48">
                                            Pemilik</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                            No.
                                            HP</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-12">
                                            Durasi</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                            Awal</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                            Akhir</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">
                                            Per
                                            Tahun</th>
                                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($export_locations as $excelLocation)
                                        @if ($loop->iteration > $i * 30 && $loop->iteration < ($i + 1) * 30 + 1)
                                            @php
                                                $agreement = $excelLocation->land_agreements->last();
                                            @endphp
                                            @if ($agreement)
                                                @php
                                                    $secondParty = json_decode($agreement->second_party);
                                                @endphp
                                                <tr>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $excelLocation->code }} -
                                                        {{ $excelLocation->city->code }}
                                                    </td>
                                                    <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                                        @if (strlen($excelLocation->address) > 65)
                                                            {{ substr($excelLocation->address, 0, 65) }}..
                                                        @else
                                                            {{ $excelLocation->address }}
                                                        @endif
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $agreement->number }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ date('d', strtotime($agreement->published)) }}-{{ $bulan[(int) date('m', strtotime($agreement->published))] }}-{{ date('Y', strtotime($agreement->published)) }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $secondParty->name }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $secondParty->phone }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $agreement->duration }} th
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ date('d', strtotime($agreement->start_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->start_at))] }}-{{ date('Y', strtotime($agreement->start_at)) }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ date('d', strtotime($agreement->end_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->end_at))] }}-{{ date('Y', strtotime($agreement->end_at)) }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ number_format($agreement->price) }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ number_format($agreement->price * $agreement->duration) }}
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $excelLocation->code }} -
                                                        {{ $excelLocation->city->code }}
                                                    </td>
                                                    <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                                        @if (strlen($excelLocation->address) > 65)
                                                            {{ substr($excelLocation->address, 0, 65) }}..
                                                        @else
                                                            {{ $excelLocation->address }}
                                                        @endif
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        -
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        -
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        -
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        -
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        -
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        -
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        -
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        -
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        -
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
