<form action="/sales/report/{{ $category }}">
    <div class="flex justify-center">
        <div class="flex items-center border rounded-lg mt-2 p-2 w-[1200px]">

            <input id="search" name="search" type="text" value="{{ request('search') }}" hidden>
            <div>
                <div class="flex items-center">
                    <span class="text-sm  text-teal-700 font-semibold w-24">Jenis Laporan</span>
                    <span class="text-sm  text-teal-700 font-semibold ml-2">:</span>
                    @if (request('type'))
                        @if (request('type') == 'c1Report')
                            <input class="ml-2" type="radio" name="type" id="c1Type" value="c1Report" checked>
                            <span class="ml-2 text-sm  text-teal-700 font-semibold w-8">C1</span>
                            <input type="radio" name="type" id="chartType" value="chartReport">
                            <span class="ml-2 text-sm  text-teal-700 font-semibold w-12">Grafik</span>
                        @elseif (request('type') == 'chartReport')
                            <input class="ml-2" type="radio" name="type" id="c1Type" value="c1Report">
                            <span class="ml-2 text-sm  text-teal-700 font-semibold w-8">C1</span>
                            <input type="radio" name="type" id="chartType" value="chartReport" checked>
                            <span class="ml-2 text-sm  text-teal-700 font-semibold w-12">Grafik</span>
                        @endif
                    @else
                        <input class="ml-2" type="radio" name="type" id="c1Type" value="c1Report" checked>
                        <span class="ml-2 text-sm  text-teal-700 font-semibold w-8">C1</span>
                        <input type="radio" name="type" id="chartType" value="chartReport">
                        <span class="ml-2 text-sm  text-teal-700 font-semibold w-12">Grafik</span>
                    @endif
                </div>
                <div class="flex h-[22px]">
                    <span class="text-sm  text-teal-700 font-semibold w-24">Periode</span>
                    <span class="text-sm  text-teal-700 font-semibold ml-2">:</span>
                    @if (request('search'))
                        <input class="ml-2 outline-none text-sm text-teal-700 border rounded-lg w-36 p-1" type="month"
                            name="monthReport" id="monthReport" value="{{ request('search') }}">
                    @else
                        <input class="ml-2 outline-none text-sm text-teal-700 border rounded-lg w-36 p-1" type="month"
                            name="monthReport" id="monthReport">
                    @endif
                    <?php
                    $getYear = date('Y') + 1;
                    $year = [];
                    $totalYear = 0;
                    for ($i = 2014; $i <= $getYear; $i++) {
                        $totalYear = $totalYear + 1;
                    }
                    for ($i = 0; $i < $totalYear; $i++) {
                        if ($i == 0) {
                            $year[$i] = $getYear;
                        } else {
                            $year[$i] = $getYear - $i;
                        }
                    }
                    ?>
                    <div>
                        <select class="outline-none border w-20 text-sm text-teal-700 rounded-md ml-2" name="yearReport"
                            id="yearReport" onmousedown="if(this.options.length>5){this.size=5;}" onchange="this.size=0"
                            onblur="this.size=0" hidden>
                            @for ($i = 0; $i < $totalYear; $i++)
                                @if (request('yearReport'))
                                    @if (request('yearReport') == $year[$i])
                                        <option value="{{ $year[$i] }}" selected>{{ $year[$i] }}</option>
                                    @else
                                        <option value="{{ $year[$i] }}">{{ $year[$i] }}</option>
                                    @endif
                                @else
                                    @if ($year[$i] == date('Y'))
                                        <option value="{{ $year[$i] }}" selected>{{ $year[$i] }}</option>
                                    @else
                                        <option value="{{ $year[$i] }}">{{ $year[$i] }}</option>
                                    @endif
                                @endif
                            @endfor
                        </select>
                    </div>
                    <button id="btnSubmit"
                        class="flex items-center border p-1 rounded-lg justify-center w-16 bg-slate-50 ml-2 text-sm text-teal-700 font-semibold hover:bg-slate-200"
                        type="submit">Submit</button>
                </div>
                <div id="divArea" class="hidden mt-2 items-center">
                    <span class="text-sm  text-teal-700 font-semibold w-24">Area</span>
                    <span class="text-sm  text-teal-700 font-semibold ml-2">:</span>
                    <select class="w-28 border rounded-lg text-sm text-teal-900 outline-none ml-2" name="area"
                        id="area" onchange="submit()" value="{{ request('area') }}">
                        <option value="All">All</option>
                        @foreach ($areas as $area)
                            @if (request('area') == $area->id)
                                <option value="{{ $area->id }}" selected>{{ $area->area }}</option>
                            @else
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="divButton" class="flex justify-end w-full">
                <button id="btnC1Pdf" class="hidden justify-center items-center mx-1 btn-primary" title="C1 Preview"
                    type="button">
                    <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                    </svg>
                    <span class="ml-2 text-white">Preview</span>
                </button>
                <button id="btnChartPdf" class="hidden justify-center items-center mx-1 btn-primary"
                    title="Chart Preview" type="button">
                    <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                    </svg>
                    <span class="ml-2 text-white">Preview</span>
                </button>
                <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                    href="/sales/home/{{ $category }}">
                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                </a>
            </div>
        </div>
    </div>
</form>
