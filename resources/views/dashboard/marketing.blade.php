<div>
    <div class="flex justify-center bg-stone-700 p-2 border rounded-md">
        <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
            <div>
                <div class="flex justify-center w-full p-1">
                    <label class="text-lg text-stone-800 font-bold">Data Penawaran</label>
                </div>
                <div class="grid grid-cols-4 gap-2 w-[500px] p-2">
                    @foreach ($categories as $category)
                        @if ($category->name == 'Service')
                            <a href="/marketing/quotations/home/{{ $category->name }}/{{ $company->id }}"
                                class="flex col-span-2 justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label class="flex justify-center font-serif text-md cursor-pointer">Katagori</label>
                                    <label
                                        class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">Cetak/Pasang</label>
                                </div>
                            </a>
                        @else
                            <a href="/marketing/quotations/home/{{ $category->name }}/{{ $company->id }}"
                                class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label
                                        class="flex justify-center font-serif text-md cursor-pointer">Katagori</label>
                                    <label
                                        class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">{{ $category->name }}</label>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="grid grid-cols-2 gap-2 w-[500px] p-4 mt-4 border-t">
                    <a href="/marketing/quotations/home/All/{{ $company->id }}?todays={{ date('Y-m-d') }}"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">HARI
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total Penawaran :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($todays) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Penawaran Disetujui :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($todays as $quotation)
                                    @php
                                        if (count($quotation->quotation_revisions) != 0) {
                                            $revision = $quotation->quotation_revisions->last();
                                            $revisionStatus =
                                                $revision->quot_revision_statuses[
                                                    count($revision->quot_revision_statuses) - 1
                                                ]->status;
                                            if ($revisionStatus == 'Deal') {
                                                $counter++;
                                            }
                                        } else {
                                            if (
                                                $quotation->quotation_statuses[
                                                    count($quotation->quotation_statuses) - 1
                                                ]->status == 'Deal'
                                            ) {
                                                $counter++;
                                            }
                                        }
                                    @endphp
                                @endforeach
                                {{ $counter }}
                            </label>
                        </div>
                    </a>
                    <a href="/marketing/quotations/home/All/{{ $company->id }}?weekday=true"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">MINGGU
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total Penawaran :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($weekday) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Penawaran Disetujui :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($weekday as $quotation)
                                    @php
                                        if (count($quotation->quotation_revisions) != 0) {
                                            $revision = $quotation->quotation_revisions->last();
                                            $revisionStatus =
                                                $revision->quot_revision_statuses[
                                                    count($revision->quot_revision_statuses) - 1
                                                ]->status;
                                            if ($revisionStatus == 'Deal') {
                                                $counter++;
                                            }
                                        } else {
                                            if (
                                                $quotation->quotation_statuses[
                                                    count($quotation->quotation_statuses) - 1
                                                ]->status == 'Deal'
                                            ) {
                                                $counter++;
                                            }
                                        }
                                    @endphp
                                @endforeach
                                {{ $counter }}
                            </label>
                        </div>
                    </a>
                    <a href="/marketing/quotations/home/All/{{ $company->id }}?monthly=true"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">BULAN
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total Penawaran :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($monthQuots) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Penawaran Disetujui :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($monthQuots as $quotation)
                                    @php
                                        if (count($quotation->quotation_revisions) != 0) {
                                            $revision = $quotation->quotation_revisions->last();
                                            $revisionStatus =
                                                $revision->quot_revision_statuses[
                                                    count($revision->quot_revision_statuses) - 1
                                                ]->status;
                                            if ($revisionStatus == 'Deal') {
                                                $counter++;
                                            }
                                        } else {
                                            if (
                                                $quotation->quotation_statuses[
                                                    count($quotation->quotation_statuses) - 1
                                                ]->status == 'Deal'
                                            ) {
                                                $counter++;
                                            }
                                        }
                                    @endphp
                                @endforeach
                                {{ $counter }}
                            </label>
                        </div>
                    </a>
                    <a href="/marketing/quotations/home/All/{{ $company->id }}?annual=true"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">TAHUN
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total Penawaran :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($yearQuots) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Penawaran Disetujui :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($yearQuots as $quotation)
                                    @php
                                        if (count($quotation->quotation_revisions) != 0) {
                                            $revision = $quotation->quotation_revisions->last();
                                            $revisionStatus =
                                                $revision->quot_revision_statuses[
                                                    count($revision->quot_revision_statuses) - 1
                                                ]->status;
                                            if ($revisionStatus == 'Deal') {
                                                $counter++;
                                            }
                                        } else {
                                            if (
                                                $quotation->quotation_statuses[
                                                    count($quotation->quotation_statuses) - 1
                                                ]->status == 'Deal'
                                            ) {
                                                $counter++;
                                            }
                                        }
                                    @endphp
                                @endforeach
                                {{ $counter }}
                            </label>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center w-[650px] mx-4 m-1 border rounded-lg bg-stone-300 p-4">
            <div class="w-full h-full bg-stone-300 border rounded-lg">
                <div id="pie-chart" class="flex justify-center items-center w-full h-[250px]"></div>
                <div id="line-quotation-chart" class="flex justify-center items-center w-full h-[250px] mt-4"></div>
            </div>
        </div>
    </div>
    <div class="flex justify-center bg-stone-700 p-2 border rounded-md mt-4">
        <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
            <div>
                <div class="flex justify-center w-full p-1">
                    <label class="text-lg text-stone-800 font-bold">Data Penjualan Berdasarkan Katagori</label>
                </div>
                <div class="grid grid-cols-4 gap-2 w-[500px] p-2">
                    @foreach ($categories as $category)
                        @if ($category->name == 'Service')
                            <a href="/marketing/sales/home/{{ $category->name }}/{{ $company->id }}"
                                class="flex justify-center  col-span-2 text-teal-400 items-center py-4 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label
                                        class="flex justify-center font-serif text-md cursor-pointer">Katagori</label>
                                    <label
                                        class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">Cetak/Pasang</label>
                                    @if ($sales->where('media_category_id', $category->id)->sum('price') < 1000000000)
                                        <label
                                            class="flex justify-center text-stone-100 font-serif text-2xl font-semibold cursor-pointer mt-2">
                                            {{ number_format($sales->where('media_category_id', $category->id)->sum('price') / 1000000, 2, ',', '') }}
                                        </label>
                                        <label
                                            class="flex justify-center font-serif text-md cursor-pointer">Juta</label>
                                    @else
                                        <label
                                            class="flex justify-center text-stone-100 font-serif text-2xl font-semibold cursor-pointer mt-2">
                                            {{ number_format($sales->where('media_category_id', $category->id)->sum('price') / 1000000000, 2, ',', '') }}
                                        </label>
                                        <label
                                            class="flex justify-center font-serif text-md cursor-pointer">Miliyar</label>
                                    @endif
                                </div>
                            </a>
                        @else
                            <a href="/marketing/sales/home/{{ $category->name }}/{{ $company->id }}"
                                class="flex justify-center text-teal-400 items-center py-4 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label
                                        class="flex justify-center font-serif text-md cursor-pointer">Katagori</label>
                                    <label
                                        class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">{{ $category->name }}</label>
                                    @if ($sales->where('media_category_id', $category->id)->sum('price') < 1000000000)
                                        <label
                                            class="flex justify-center text-stone-100 font-serif text-2xl font-semibold cursor-pointer mt-2">
                                            {{ number_format($sales->where('media_category_id', $category->id)->sum('price') / 1000000, 2, ',', '') }}
                                        </label>
                                        <label
                                            class="flex justify-center font-serif text-md cursor-pointer">Juta</label>
                                    @else
                                        <label
                                            class="flex justify-center text-stone-100 font-serif text-2xl font-semibold cursor-pointer mt-2">
                                            {{ number_format($sales->where('media_category_id', $category->id)->sum('price') / 1000000000, 2, ',', '') }}
                                        </label>
                                        <label
                                            class="flex justify-center font-serif text-md cursor-pointer">Miliyar</label>
                                    @endif
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="flex justify-center w-full p-1 border-t mt-2">
                    <label class="text-lg text-stone-800 font-bold">Data Penjualan Berdasarkan Periode</label>
                </div>
                <div class="grid grid-cols-3 gap-2 w-[500px] p-4">
                    <a href="/marketing/sales/home/All/{{ $company->id }}?weekday=true"
                        class="flex justify-center text-teal-400 h-[200px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-lg cursor-pointer w-full">Penjualan</label>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full">MINGGU
                                INI</label>
                            @if ($weekSales < 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($weekSales / 1000000, 2, '.', '') }}
                                </label>
                                <label
                                    class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                    Juta
                                </label>
                            @elseif ($weekSales >= 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($weekSales / 1000000000, 2, '.', '') }}
                                </label>
                                <label
                                    class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                    Miliar
                                </label>
                            @endif
                        </div>
                    </a>
                    <a href="/marketing/sales/home/All/{{ $company->id }}?monthly=true"
                        class="flex justify-center text-teal-400 h-[200px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-lg cursor-pointer w-full">Penjualan</label>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full">BULAN
                                INI</label>
                            @if ($monthSales < 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($monthSales / 1000000, 2, '.', '') }}
                                </label>
                                <label
                                    class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                    Juta
                                </label>
                            @elseif ($monthSales >= 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($monthSales / 1000000000, 2, '.', '') }}
                                </label>
                                <label
                                    class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                    Miliar
                                </label>
                            @endif
                        </div>
                    </a>
                    <a href="/marketing/sales/home/All/{{ $company->id }}?annual=true"
                        class="flex justify-center text-teal-400 h-[200px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-lg cursor-pointer w-full">Penjualan</label>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full">TAHUN
                                INI</label>
                            @if ($yearSales < 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($yearSales / 1000000, 2, '.', '') }}
                                </label>
                                <label
                                    class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                    Juta
                                </label>
                            @elseif ($yearSales >= 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($yearSales / 1000000000, 2, '.', '') }}
                                </label>
                                <label
                                    class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                    Miliar
                                </label>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center w-[650px] mx-4 m-1 border rounded-lg bg-stone-300">
            <div class="w-[600px] h-[460px] bg-stone-300 border rounded-lg m-4">
                <div id="line-sales-chart"></div>
                <div id="bar-chart"></div>
            </div>
        </div>
    </div>
    <div class="flex justify-center bg-stone-700 p-2 border rounded-md mt-4">
        <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
            <div>
                <div class="flex justify-center w-full p-1">
                    <label class="text-lg text-stone-800 font-bold">Data SPK Cetak</label>
                </div>
                <div class="grid grid-cols-3 gap-2 w-[500px] p-2">
                    <a href="/print-orders/index/{{ $company->id }}"
                        class="flex col-span-3 justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label class="flex justify-center font-serif text-md cursor-pointer">SPK Cetak</label>
                        </div>
                    </a>
                    <a href="/print-orders/print-sales/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Cetak</label>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Berbayar</label>
                            {{-- <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ number_format($printSales->sum('price')) }}
                            </label> --}}
                        </div>
                    </a>
                    <a href="/print-orders/free-sales/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Penjualan</label>
                            {{-- <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ number_format($freePrintSales->sum('price')) }}
                            </label> --}}
                        </div>
                    </a>
                    <a href="/print-orders/free-other/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Lain-Lain</label>
                            {{-- <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ number_format($freePrintOther->sum('price')) }}
                            </label> --}}
                        </div>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-2 w-[500px] p-4 mt-4 border-t">
                    <a href="/print-orders/index/{{ $company->id }}?todays={{ date('Y-m-d') }}"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">HARI
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total SPK Cetak :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($todaysPrint) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total Nominal :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ number_format($todaysPrint->sum('price')) }}
                            </label>
                        </div>
                    </a>
                    <a href="/print-orders/index/{{ $company->id }}?weekday=true"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">MINGGU
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total SPK Cetak :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($weekdayPrints) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total Nominal :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ number_format($weekdayPrints->sum('price')) }}
                            </label>
                        </div>
                    </a>
                    <a href="/print-orders/index/{{ $company->id }}?monthly=true"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">BULAN
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total SPK Cetak :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($monthPrints) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total Nominal :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ number_format($monthPrints->sum('price')) }}
                            </label>
                        </div>
                    </a>
                    <a href="/print-orders/index/{{ $company->id }}?annual=true"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">TAHUN
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total SPK Cetak :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($yearPrints) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total Nominal :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ number_format($yearPrints->sum('price')) }}
                            </label>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center w-[650px] mx-4 m-1 border rounded-lg bg-stone-300 p-4">
            <div class="w-full h-full bg-stone-300 border rounded-lg">
                <div id="print-pie-chart" class="flex justify-center items-center w-full h-[250px]"></div>
                <div id="print-line-chart" class="flex justify-center items-center w-full h-[250px] mt-4"></div>
            </div>
        </div>
    </div>
    <div class="flex justify-center bg-stone-700 p-2 border rounded-md mt-4">
        <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
            <div>
                <div class="flex justify-center w-full p-1">
                    <label class="text-lg text-stone-800 font-bold">Data SPK Pasang</label>
                </div>
                <div class="grid grid-cols-3 gap-2 w-[500px] p-2">
                    <a href="/install-orders/index/{{ $company->id }}"
                        class="flex col-span-3 justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label class="flex justify-center font-serif text-md cursor-pointer">SPK Pasang</label>
                        </div>
                    </a>
                    <a href="/install-orders/install-sales/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Pasang</label>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Berbayar</label>
                            {{-- <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($installSales) }}
                            </label> --}}
                        </div>
                    </a>
                    <a href="/install-orders/free-sales/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                            <label class="flex justify-center items-center font-serif text-md cursor-pointer">Dari
                                Penjualan</label>
                            {{-- <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($freeInstallSales) }}
                            </label> --}}
                        </div>
                    </a>
                    <a href="/install-orders/free-other/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                            <label
                                class="flex justify-center items-center font-serif text-md cursor-pointer">Lain-Lain</label>
                            {{-- <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($freeInstallOther) }}
                            </label> --}}
                        </div>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-2 w-[500px] p-4 mt-4 border-t">
                    <a href="/install-orders/index/{{ $company->id }}?todays={{ date('Y-m-d') }}"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">HARI
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total SPK Pasang :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($todaysInstall) }}
                            </label>
                        </div>
                    </a>
                    <a href="/install-orders/index/{{ $company->id }}?weekday=true"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">MINGGU
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total SPK Pasang :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($weekdayInstalls) }}
                            </label>
                        </div>
                    </a>
                    <a href="/install-orders/index/{{ $company->id }}?monthly=true"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">BULAN
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total SPK Pasang :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($monthInstalls) }}
                            </label>
                        </div>
                    </a>
                    <a href="/install-orders/index/{{ $company->id }}?annual=true"
                        class="flex justify-center text-teal-400 h-[180px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">TAHUN
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                Total SPK Pasang :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                {{ count($yearInstalls) }}
                            </label>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center w-[650px] mx-4 m-1 border rounded-lg bg-stone-300 p-4">
            <div class="w-full h-full bg-stone-300 border rounded-lg">
                <div id="install-pie-chart" class="flex justify-center items-center w-full h-[250px]"></div>
                <div id="install-line-chart" class="flex justify-center items-center w-full h-[250px] mt-4"></div>
            </div>
        </div>
    </div>
</div>
