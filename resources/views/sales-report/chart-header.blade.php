<form id="formFilter" action="/marketing/sales-report/chart-report/{{ $area->id }}">
    <div class="flex justify-center">
        <div class="flex items-center border rounded-lg mt-2 p-2 w-[1580px]">
            <input id="search" name="search" type="text" value="{{ request('search') }}" hidden>
            <div>
                <div class="flex h-[22px]">
                    <span class="text-sm  text-stone-100 font-semibold w-24">Periode</span>
                    <span class="text-sm  text-stone-100 font-semibold ml-2">:</span>
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
                        <select
                            class="relative text-center outline-none border w-24 text-sm text-stone-900 rounded-md ml-2 bg-stone-100"
                            name="yearReport" id="yearReport" onmousedown="if(this.options.length>5){this.size=5;}"
                            onchange="this.blur(), submit()" onblur="this.size=0;">
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
                    <div class="flex ml-8 items-center">
                        <span class="text-base text-stone-200 w-20">Katagori : </span>
                        @if (request('get_categories'))
                            @php
                                $getCategories = [];
                                $getCategories = json_decode(request('get_categories'));
                            @endphp
                            @foreach ($categories as $category)
                                @if ($category->name != 'Service')
                                    @if (in_array($category->id, $getCategories))
                                        <input class="outline-none ml-4" type="checkbox" id="category_id"
                                            value="{{ $category->id }}" onclick="setCategories(this)" checked>
                                        <span class="text-base text-stone-200 ml-1">{{ $category->name }}</span>
                                    @else
                                        <input class="outline-none ml-4" type="checkbox" id="category_id"
                                            value="{{ $category->id }}" onclick="setCategories(this)">
                                        <span class="text-base text-stone-200 ml-1">{{ $category->name }}</span>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            @php
                                $getCategories = [];
                            @endphp
                            @foreach ($categories as $category)
                                @if ($category->name != 'Service')
                                    <input class="outline-none ml-4" type="checkbox" id="category_id"
                                        value="{{ $category->id }}" onclick="setCategories(this)" checked>
                                    <span class="text-base text-stone-200 ml-1">{{ $category->name }}</span>
                                    @php
                                        array_push($getCategories, $category->id);
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        <input type="text" id="getCategories" name="get_categories"
                            value="{{ json_encode($getCategories) }}" hidden>
                    </div>
                    <!-- Form search end -->
                </div>
            </div>
            <div id="divButton" class="flex justify-end w-full">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary"
                    title="Simpan dalam bentuk pdf" type="button">
                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1">Save PDF</span>
                </button>
                <a class="flex justify-center items-center mx-1 btn-danger"
                    href="/marketing/sales-report/{{ $company->id }}">
                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="mx-1">Close</span>
                </a>
            </div>
        </div>
    </div>
</form>
