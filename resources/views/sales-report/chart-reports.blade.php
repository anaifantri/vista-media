@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center m-2">
                <h1 class="text-xl text-stone-100 font-bold tracking-wider w-[1580px] border-b">GAFIK PERIODE KONTRAK</h1>
            </div>
            @include('sales-report.chart-header')
            <div id="chartReport" class="flex justify-center z-0">
                <?php
                // if (fmod(count($locations), 35) == 0) {
                //     $pageQtyChart = count($locations) / 35;
                // } else {
                //     $pageQtyChart = (count($locations) - fmod(count($locations), 35)) / 35 + 1;
                // }
                if (request('yearReport')) {
                    $thisYear = request('yearReport');
                } else {
                    $thisYear = date('Y');
                }
                $prevYear = $thisYear - 1;
                $nextYear = $thisYear + 1;
                $addPages = true;
                $countPages = true;
                $pageNumber = 0;
                $totalPages = 0;
                $number = 1;
                $index = 1;
                $dataNumber = 0;
                $totalData = 0;
                ?>
                @if (count($locations) != 0)
                    @while ($countPages == true)
                        @foreach ($locations as $location)
                            @if ($index > $totalPages * 35 && $index <= $totalPages * 35 + 35 && $loop->iteration > $totalData)
                                @php
                                    $description = json_decode($location->description);
                                    $index++;
                                    $totalData = $loop->iteration - 1;
                                @endphp
                                @if (
                                    $location->media_category->name == 'Videotron' ||
                                        ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                    @php
                                        $pageSlots = $description->slots;
                                    @endphp
                                    @for ($pageSlot = 0; $pageSlot < $pageSlots; $pageSlot++)
                                        @php
                                            $index++;
                                        @endphp
                                    @endfor
                                @endif
                            @endif
                        @endforeach
                        @php
                            $totalData++;
                            $totalPages++;
                            if ($totalData == count($locations)) {
                                $countPages = false;
                            }
                        @endphp
                    @endwhile
                @endif
                <div id="pdfPreview">
                    @if (count($locations) != 0)
                        @while ($addPages == true)
                            <div class="w-[1580px] h-[1120px] px-10 mt-2 p-4 bg-white z-0">
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
                                            <div class="flex justify-center w-80">
                                                <label id="labelArea"
                                                    class="text-2xl text-center border rounded-md p-1">{{ strtoupper($area->area) }}</label>
                                                @if ($category != 'All')
                                                    <label id="labelArea"
                                                        class="mx-2 font-bold text-2xl text-center p-1">-</label>
                                                    <label id="labelArea"
                                                        class="text-2xl text-center border rounded-md p-1">{{ strtoupper($category) }}</label>
                                                @endif
                                            </div>
                                            <div class="flex justify-center w-80">
                                                <label class="text-sm text-center">GRAFIK PERIODE KONTRAK</label>
                                            </div>
                                            <div class="flex justify-center w-80">
                                                <label class="text-sm text-center"></label>
                                            </div>
                                            <div class="flex justify-center w-80 border rounded-md">
                                                <?php
                                                $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                ?>
                                                <label id="labelPeriode" class="month-report">
                                                    <span class="text-md font-semibold text-red-600">Tgl. Cetak : </span>
                                                    {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                    {{ date('Y') }}</label>
                                            </div>
                                        </div>
                                        <div class=" ml-4 mt-1">
                                            <div class="flex justify-center items-center w-24 border rounded-md p-1">
                                                <label class="text-4xl font-semibold text-center">H</label>
                                            </div>
                                            <div class="flex justify-center items-center w-24 border rounded-md mt-1">
                                                @if (request('yearReport'))
                                                    <label
                                                        class="text-xl font-semibold text-center">{{ request('yearReport') }}</label>
                                                @else
                                                    <label
                                                        class="text-xl font-semibold text-center">{{ date('Y') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-[850px] mt-8">
                                    <table class="table-auto w-full">
                                        <thead class="bg-yellow-100">
                                            <tr>
                                                <th class="text-black border text-[0.65rem] w-8 text-center" rowspan="2">
                                                    No.
                                                </th>
                                                <th class="text-black border text-[0.65rem] w-[60px] text-center"
                                                    rowspan="2">
                                                    <button
                                                        class="flex justify-center items-center w-[60px]">@sortablelink('code', 'Kode')
                                                        <svg class="fill-current w-3 ml-1"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                        </svg>
                                                    </button>
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center" rowspan="2">
                                                    Lokasi</th>
                                                <th class="text-black border text-[0.65rem] text-center " colspan="5">
                                                    Jenis Reklame</th>
                                                <th class="text-black border text-[0.65rem] text-center " colspan="4">
                                                    Detail Kontrak Aktif</th>
                                                <th class="text-black border text-[0.65rem] text-center " colspan="2">
                                                    Periode Kontrak</th>
                                                <th class="text-black border text-[0.65rem] text-center " colspan="12">
                                                    Grafik Periode Kontrak</th>
                                            </tr>
                                            <tr>
                                                <th class="text-black border text-[0.65rem] text-center w-8">Jns</th>
                                                <th class="text-black border text-[0.65rem] text-center w-8">BL/FL</th>
                                                <th class="text-black border text-[0.65rem] text-center w-8">Side</th>
                                                <th class="text-black border text-[0.65rem] text-center w-8">Qty</th>
                                                <th class="text-black border text-[0.65rem] text-center w-20">Size</th>
                                                <th class="text-black border text-[0.65rem] text-center w-24">No.
                                                    Penjualan
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-28">Klien</th>
                                                <th class="text-black border text-[0.65rem] text-center w-20">Nilai</th>
                                                <th class="text-black border text-[0.65rem] text-center w-14">Durasi</th>
                                                <th class="text-black border text-[0.65rem] text-center w-16">Awal</th>
                                                <th class="text-black border text-[0.65rem] text-center w-16">Akhir</th>
                                                <th class="text-black border text-[0.65rem] text-center w-[31px]">Jan
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[28px]">Feb
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[31px]">Mar
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[30px]">Apr
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[31px]">Mei
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[30px]">Jun
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[31px]">Jul
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[31px]">Agu
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[30px]">Sep
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[31px]">Okt
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[30px]">Nop
                                                </th>
                                                <th class="text-black border text-[0.65rem] text-center w-[31px]">Des
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($locations as $location)
                                                @if ($number > $pageNumber * 35 && $number <= $pageNumber * 35 + 35 && $loop->iteration > $dataNumber)
                                                    @php
                                                        $number++;
                                                        $dataNumber = $loop->iteration - 1;
                                                        $lastNumber = null;
                                                        $lastClient = null;
                                                        $lastPrice = null;
                                                        $duration = null;
                                                        $start_at = null;
                                                        $end_at = null;
                                                        $description = json_decode($location->description);
                                                        if (
                                                            $location->media_category->name == 'Videotron' ||
                                                            ($location->media_category->name == 'Signage' &&
                                                                $description->type == 'Videotron')
                                                        ) {
                                                            $videotronSales = $location->videotron_active_sales;
                                                            $slots = $description->slots;
                                                        } else {
                                                            if ($location->active_sale) {
                                                                $lastClient = json_decode(
                                                                    $location->active_sale->quotation->clients,
                                                                );
                                                                $lastNumber = $location->active_sale->number;
                                                                $lastPrice = $location->active_sale->price;
                                                                $start_at = $location->active_sale->start_at;
                                                                $end_at = $location->active_sale->end_at;
                                                                $duration = $location->active_sale->duration;
                                                            }
                                                        }
                                                    @endphp
                                                    @if (
                                                        $location->media_category->name == 'Videotron' ||
                                                            ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                                        @include('sales-report.tr-chart-videotron')
                                                        @if (count($videotronSales) != 0)
                                                            @php
                                                                $usedSlot = 0;
                                                            @endphp
                                                            @foreach ($videotronSales as $videotronSale)
                                                                @php
                                                                    $slotQty = 0;
                                                                    $lastClient = json_decode(
                                                                        $videotronSale->quotation->clients,
                                                                    );
                                                                    $getPrice = json_decode(
                                                                        $videotronSale->quotation->price,
                                                                    );
                                                                    $slotQty = $getPrice->slotQty;
                                                                    $lastNumber = $videotronSale->number;
                                                                    $lastPrice = $videotronSale->price;
                                                                    $duration = $videotronSale->duration;
                                                                    $start_at = $videotronSale->start_at;
                                                                    $end_at = $videotronSale->end_at;
                                                                @endphp
                                                                @for ($indexSlot = 0; $indexSlot < $slotQty; $indexSlot++)
                                                                    @php
                                                                        $number++;
                                                                        $usedSlot++;
                                                                    @endphp
                                                                    @if ($indexSlot == 0)
                                                                        @include('sales-report.tr-merged-client')
                                                                    @else
                                                                        @include('sales-report.tr-merged-blank')
                                                                    @endif
                                                                    {{-- @include('sales-report.tr-vt-client') --}}
                                                                @endfor
                                                            @endforeach
                                                            @if ($usedSlot < $slots)
                                                                @for ($indexSlot = $usedSlot; $indexSlot < $slots; $indexSlot++)
                                                                    @php
                                                                        $number++;
                                                                        $usedSlot++;
                                                                    @endphp
                                                                    @include('sales-report.tr-vt-blank')
                                                                @endfor
                                                            @endif
                                                        @else
                                                            @for ($indexSlot = 0; $indexSlot < $slots; $indexSlot++)
                                                                @php
                                                                    $number++;
                                                                @endphp
                                                                @include('sales-report.tr-vt-blank')
                                                            @endfor
                                                        @endif
                                                    @else
                                                        @include('sales-report.tr-chart-billboard')
                                                    @endif
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-2 flex items-center">
                                    <div class="flex w-[700px] items-center">
                                        <span class="text-sm font-semibold w-[120px]">Keterangan :</span>
                                        <div class="ml-4 w-8 h-1 bg-red-700"></div>
                                        <span class="ml-2 text-xs w-[200px]">Kontrak Aktif Vista Media</span>
                                        <div class="ml-4 w-8 h-1 bg-lime-700"></div>
                                        <span class="ml-2 text-xs w-[220px]">Kontrak Aktif Visual Mandiri</span>
                                        <div class="ml-4 w-8 h-1 bg-blue-700"></div>
                                        <span class="ml-2 text-xs w-[220px]">Kontrak Aktif SMP</span>
                                    </div>
                                    <div class="flex w-full justify-end mt-1 text-stone-900">
                                        <label for="">Halaman {{ $pageNumber + 1 }} dari
                                            {{ $totalPages }}</label>
                                    </div>
                                </div>
                            </div>
                            @php
                                $dataNumber++;
                                $pageNumber++;
                                if ($dataNumber == count($locations)) {
                                    $addPages = false;
                                }
                            @endphp
                        @endwhile
                    @else
                        <div class="w-[1580px] h-[1120px] px-10 mt-2 p-4 bg-white z-0">
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
                                        <div class="flex justify-center w-80">
                                            <label id="labelArea"
                                                class="text-2xl text-center border rounded-md p-1">{{ strtoupper($area->area) }}</label>
                                            @if ($category != 'All')
                                                <label id="labelArea"
                                                    class="mx-2 font-bold text-2xl text-center p-1">-</label>
                                                <label id="labelArea"
                                                    class="text-2xl text-center border rounded-md p-1">{{ strtoupper($category) }}</label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-80">
                                            <label class="text-sm text-center">GRAFIK PERIODE KONTRAK</label>
                                        </div>
                                        <div class="flex justify-center w-80">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-80 border rounded-md">
                                            <?php
                                            $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            ?>
                                            <label id="labelPeriode" class="month-report">
                                                <span class="text-md font-semibold text-red-600">Tgl. Cetak : </span>
                                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                {{ date('Y') }}</label>
                                        </div>
                                    </div>
                                    <div class=" ml-4 mt-1">
                                        <div class="flex justify-center items-center w-24 border rounded-md p-1">
                                            <label class="text-4xl font-semibold text-center">H</label>
                                        </div>
                                        <div class="flex justify-center items-center w-24 border rounded-md mt-1">
                                            @if (request('yearReport'))
                                                <label
                                                    class="text-xl font-semibold text-center">{{ request('yearReport') }}</label>
                                            @else
                                                <label
                                                    class="text-xl font-semibold text-center">{{ date('Y') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="h-[850px] mt-8">
                                @if ($category == 'All')
                                    <label
                                        class="flex justify-center w-full text-base text-red-600 font-serif tracking-wider">~~
                                        Tidak ada lokasi pada area {{ $area->area }}~~
                                    </label>
                                @else
                                    <label
                                        class="flex justify-center w-full text-base text-red-600 font-serif tracking-wider">~~
                                        Tidak ada lokasi pada area {{ $area->area }} dengan katagori
                                        {{ $category }}~~
                                    </label>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <input id="saveName" type="text" value="Grafik Kontrak Klien - {{ date('d-m-Y') }}" hidden>
    </div>


    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        // Save PDF --> start
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
                        dpi: 300,
                        scale: 2,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [1590, 1130],
                        orientation: 'landscape',
                        putTotalPages: true
                    }
                };
                html2pdf().set(opt).from(element).save();
            }
        };
        // Save PDF --> end

        const categories = JSON.parse(document.getElementById("getCategories").value);
        const formFilter = document.getElementById("formFilter");
        // getCategory --> start
        function setCategories(sel) {
            if (categories.length == 1) {
                if (sel.value == categories[0]) {
                    alert("Minimal satu katagori harus terpilih");
                    sel.checked = true;
                } else {
                    if (sel.checked == false) {
                        for (let i = 0; i < categories.length; i++) {
                            if (categories[i] == sel.value) {
                                categories.splice(i, 1);
                            }
                        }
                        document.getElementById("getCategories").value = JSON.stringify(categories);
                        formFilter.submit();
                    } else {
                        categories.push(sel.value);
                        document.getElementById("getCategories").value = JSON.stringify(categories);
                        formFilter.submit();
                    }
                }
            } else {
                if (sel.checked == false) {
                    for (let i = 0; i < categories.length; i++) {
                        if (categories[i] == sel.value) {
                            categories.splice(i, 1);
                        }
                    }
                    document.getElementById("getCategories").value = JSON.stringify(categories);
                    formFilter.submit();
                } else {
                    categories.push(sel.value);
                    document.getElementById("getCategories").value = JSON.stringify(categories);
                    formFilter.submit();
                }
            }
        }
        // getCategory --> end
    </script>
    <!-- Script end -->
@endsection
