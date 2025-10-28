    <table id="exportExcelTable" class="table-auto w-full" hidden>
        <thead>
            <tr class="bg-stone-400">
                <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">No
                </th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="2">Data
                    Lokasi</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="4">Data
                    Perjanjian</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="3">Periode
                </th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="2">Harga
                </th>
            </tr>
            <tr class="bg-stone-400">
                <th class="text-stone-900 border border-stone-900 text-xs w-[72px] text-center">Kode</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center">Lokasi</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-48">Nomor</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Tanggal</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-48">Pemilik</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">No. HP</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-12">Durasi</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Awal</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Akhir</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Per Tahun</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Total</th>
            </tr>
        </thead>
        <tbody class="bg-stone-300">
            @foreach ($export_locations as $excelLocation)
                @php
                    $agreements = $excelLocation->land_agreements;
                @endphp
                @if (count($agreements) > 0)
                    @if (count($agreements) > 1)
                        @php
                            $rowSpan = count($agreements) + 1;
                        @endphp
                        <tr>
                            <td class="text-stone-900 border border-stone-900 text-xs text-center"
                                rowspan="{{ $rowSpan }}">{{ $loop->iteration }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-xs text-center"
                                rowspan="{{ $rowSpan }}">
                                {{ $excelLocation->code }} -
                                {{ $excelLocation->city->code }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-xs px-2"
                                rowspan="{{ $rowSpan }}">
                                {{ $excelLocation->address }}
                            </td>
                        </tr>
                        @foreach ($agreements as $agreement)
                            @php
                                $secondParty = json_decode($agreement->second_party);
                            @endphp
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $agreement->number }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ date('d', strtotime($agreement->published)) }}-{{ $bulan[(int) date('m', strtotime($agreement->published))] }}-{{ date('Y', strtotime($agreement->published)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $secondParty->name }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $secondParty->phone }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $agreement->duration }} th
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ date('d', strtotime($agreement->start_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->start_at))] }}-{{ date('Y', strtotime($agreement->start_at)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ date('d', strtotime($agreement->end_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->end_at))] }}-{{ date('Y', strtotime($agreement->end_at)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $agreement->price }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $agreement->price * $agreement->duration }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                {{ $number++ }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                {{ $excelLocation->code }} -
                                {{ $excelLocation->city->code }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-xs px-2">
                                @if (strlen($excelLocation->address) > 65)
                                    {{ substr($excelLocation->address, 0, 65) }}..
                                @else
                                    {{ $excelLocation->address }}
                                @endif
                            </td>
                            @foreach ($agreements as $agreement)
                                @php
                                    $secondParty = json_decode($agreement->second_party);
                                @endphp
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $agreement->number }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ date('d', strtotime($agreement->published)) }}-{{ $bulan[(int) date('m', strtotime($agreement->published))] }}-{{ date('Y', strtotime($agreement->published)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $secondParty->name }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $secondParty->phone }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $agreement->duration }} th
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ date('d', strtotime($agreement->start_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->start_at))] }}-{{ date('Y', strtotime($agreement->start_at)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ date('d', strtotime($agreement->end_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->end_at))] }}-{{ date('Y', strtotime($agreement->end_at)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $agreement->price }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $agreement->price * $agreement->duration }}
                                </td>
                            @endforeach
                        </tr>
                    @endif
                @else
                    <tr>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                            {{ $number++ }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                            {{ $excelLocation->code }} -
                            {{ $excelLocation->city->code }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs px-2">
                            @if (strlen($excelLocation->address) > 65)
                                {{ substr($excelLocation->address, 0, 65) }}..
                            @else
                                {{ $excelLocation->address }}
                            @endif
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
