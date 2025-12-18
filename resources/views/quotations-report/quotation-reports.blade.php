@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    @php
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center m-2 w-[1280px]">
                <h1 class="text-xl text-stone-100 font-bold tracking-wider w-[1580px] border-b">LAPORAN PENAWARAN
                    {{ strtoupper($quotation_category->name) }}</h1>
            </div>
            @include('quotations-report.quotation-header')
            <div id="chartReport" class="flex justify-center z-0">
                <?php
                if (fmod(count($quotations), 30) == 0) {
                    $pageQty = count($quotations) / 5;
                } else {
                    $pageQty = (count($quotations) - fmod(count($quotations), 30)) / 30 + 1;
                }
                ?>
                <div id="pdfPreview">
                    @if (count($quotations) == 0)
                        <div class="w-[1280px] h-[900px] px-10 mt-2 p-4 bg-white z-0">
                            <div class="flex items-center border rounded-lg p-4 mt-8">
                                <div class="w-44">
                                    <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}"
                                        alt="">
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
                                            <label class="text-5xl text-center">Q1</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center">LAPORAN PENAWARAN
                                                {{ strtoupper($quotation_category->name) }}</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md">
                                            @if (request('search'))
                                                <?php
                                                $searchDate = strtotime(request('search'));
                                                ?>
                                                <label id="labelPeriode"
                                                    class="month-report text-xl font-semibold text-center">
                                                    {{ $bulan[(int) date('m', $searchDate)] }}
                                                    {{ date('Y', $searchDate) }}
                                                </label>
                                            @else
                                                <label id="labelPeriode"
                                                    class="month-report text-xl font-semibold text-center">SEMUA
                                                    DATA</label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md mt-2">
                                            <label class="text-sm">
                                                <span class="text-sm font-semibold text-red-600">Tgl. Cetak : </span>
                                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                {{ date('Y') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center h-[625px] mt-2">
                                @if (request('search'))
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                                        penawaran {{ $quotation_category->name }} pada
                                        bulan
                                        {{ $bulan[(int) date('m', strtotime(request('search')))] }}
                                        {{ date('Y', strtotime(request('search'))) }} ~~
                                    </label>
                                @else
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                                        penawaran {{ $quotation_category->name }} pada tahun
                                        {{ date('Y', strtotime(date('Y-m-d'))) }} ~~
                                    </label>
                                @endif
                            </div>
                        </div>
                    @else
                        @for ($i = 0; $i < $pageQty; $i++)
                            <div class="w-[1280px] h-[900px] px-10 mt-2 p-4 bg-white z-0">
                                <div class="flex items-center border rounded-lg p-4 mt-8">
                                    <div class="w-44">
                                        <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}"
                                            alt="">
                                    </div>
                                    <div class="w-[750px] ml-6">
                                        <div>
                                            <span class="text-sm font-semibold">{{ $company->name }}</span>
                                        </div>
                                        <div>
                                            <span class="text-xs">{{ $company->address }}, Desa/Kel.
                                                {{ $company->village }},
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
                                                <label class="text-5xl text-center">Q1</label>
                                            </div>
                                            <div class="flex justify-center w-56">
                                                <label class="text-sm text-center">LAPORAN PENAWARAN
                                                    {{ strtoupper($quotation_category->name) }}</label>
                                            </div>
                                            <div class="flex justify-center w-56">
                                                <label class="text-sm text-center"></label>
                                            </div>
                                            <div class="flex justify-center w-56 border rounded-md">
                                                @if (request('search'))
                                                    <?php
                                                    $searchDate = strtotime(request('search'));
                                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                    ?>
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">{{ $bulan[(int) date('m', $searchDate)] }}
                                                        {{ date('Y', $searchDate) }}</label>
                                                @else
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">SEMUA
                                                        DATA</label>
                                                @endif
                                            </div>
                                            <div class="flex justify-center w-56 border rounded-md mt-2">
                                                <label class="text-sm">
                                                    <span class="text-sm font-semibold text-red-600">Tgl. Cetak : </span>
                                                    {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                    {{ date('Y') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-[622px] mt-2">
                                    <table class="table-auto w-full">
                                        <thead>
                                            <tr>
                                                <th class="text-black sticky top-0 border text-[0.65rem] w-6"
                                                    rowspan="2">
                                                    No.
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem] w-20"
                                                    rowspan="2">
                                                    Jenis
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem] text-center w-32"
                                                    rowspan="2">
                                                    <button class="flex justify-center items-center w-32">@sortablelink('number', 'Nomor Penawaran')
                                                        <svg class="fill-current w-3 ml-1"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                        </svg>
                                                    </button>
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem] w-20"
                                                    rowspan="2">
                                                    Tanggal
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem]" colspan="2">
                                                    Data Klien
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem] w-44"
                                                    rowspan="2">
                                                    Lokasi
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem]" colspan="2">
                                                    Progress Penawaran
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-black border text-[0.65rem] w-24">Nama</th>
                                                <th class="text-black border text-[0.65rem] w-32">Kontak Person</th>
                                                <th class="text-black border text-[0.65rem] w-24">Status Akhir</th>
                                                <th class="text-black border text-[0.65rem]">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quotations as $quotation)
                                                @php
                                                    $client = json_decode($quotation->clients);
                                                    $products = json_decode($quotation->products);
                                                @endphp
                                                @if ($i == 0)
                                                    @if ($loop->iteration <= 30)
                                                        <tr>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                @if ($quotation->media_category->name == 'Service')
                                                                    Cetak/Pasang
                                                                @else
                                                                    {{ $quotation->media_category->name }}
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $quotation->number }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ date('d-M-Y', strtotime($quotation->created_at)) }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $client->name }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                @if ($client->type == 'Perusahaan')
                                                                    {{ $client->contact_name }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top px-1">
                                                                @foreach ($products as $product)
                                                                    @if ($loop->iteration != count($products))
                                                                        {{ $product->code }},
                                                                    @else
                                                                        {{ $product->code }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                @if (count($quotation->quotation_revisions) != 0)
                                                                    Revisi ke {{ count($quotation->quotation_revisions) }}
                                                                    :
                                                                    {{ $quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->status }}
                                                                @else
                                                                    Utama :
                                                                    {{ $quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->status }}
                                                                @endif
                                                            </td>
                                                            <td class="text-black border text-[0.65rem] align-top px-1">
                                                                @if (count($quotation->quotation_revisions) != 0)
                                                                    @if (strlen($quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->description) > 50)
                                                                        ..{{ substr($quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->description, 32) }}
                                                                    @else
                                                                        {{ $quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->description }}
                                                                    @endif
                                                                @else
                                                                    @if (strlen($quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->description) > 50)
                                                                        ..{{ substr($quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->description, 32) }}
                                                                    @else
                                                                        {{ $quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->description }}
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @else
                                                    @if ($loop->iteration > $i * 30 && $loop->iteration < ($i + 1) * 30 + 1)
                                                        <tr>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                @if ($quotation->media_category->name == 'Service')
                                                                    Cetak/Pasang
                                                                @else
                                                                    {{ $quotation->media_category->name }}
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $quotation->number }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ date('d-M-Y', strtotime($quotation->created_at)) }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $client->name }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                @if ($client->type == 'Perusahaan')
                                                                    {{ $client->contact_name }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                @foreach ($products as $product)
                                                                    @if ($loop->iteration != count($products))
                                                                        {{ $product->code }},
                                                                    @else
                                                                        {{ $product->code }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                @if (count($quotation->quotation_revisions) != 0)
                                                                    Revisi ke {{ count($quotation->quotation_revisions) }}
                                                                    :
                                                                    {{ $quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->status }}
                                                                @else
                                                                    Utama :
                                                                    {{ $quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->status }}
                                                                @endif
                                                            </td>
                                                            <td class="text-black border text-[0.65rem] align-top px-1">
                                                                @if (count($quotation->quotation_revisions) != 0)
                                                                    @if (strlen($quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->description) > 50)
                                                                        ..{{ substr($quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->description, 32) }}
                                                                    @else
                                                                        {{ $quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->description }}
                                                                    @endif
                                                                @else
                                                                    @if (strlen($quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->description) > 50)
                                                                        ..{{ substr($quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->description, 32) }}
                                                                    @else
                                                                        {{ $quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->description }}
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="flex justify-end mt-1 text-teal-900">
                                    <label for="">Halaman {{ $i + 1 }} dari {{ $pageQty }}</label>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
        <input id="saveName" type="text" value="Laporan Penawaran - {{ date('d-m-Y') }}" hidden>
    </div>


    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const saveName = document.querySelectorAll("[id=saveName]");
        const pdfPreview = document.querySelectorAll("[id=pdfPreview]");
        document.getElementById("btnCreatePdf").onclick = function() {
            for (let i = 0; i < pdfPreview.length; i++) {
                var element = document.getElementById('pdfPreview');
                var opt = {
                    margin: 0,
                    filename: saveName[i].value,
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    pagebreak: {
                        mode: ['avoid-all', 'css', 'legacy']
                    },
                    html2canvas: {
                        dpi: 192,
                        scale: 2,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [1300, 920],
                        orientation: 'landscape',
                        putTotalPages: true
                    }
                };
                html2pdf().set(opt).from(element).save();
            }
        };
    </script>
    <!-- Script end -->
@endsection
