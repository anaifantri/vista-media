<form action="/marketing/sales-report/c-report/{{ $company->id }}">
    <div class="flex justify-center">
        <div class="flex justify-center items-center border rounded-lg mt-2 p-2 w-[1580px]">
            <div>
                <div class="flex h-14">
                    <div class="w-24">
                        <span class="text-base text-stone-100">Bulan</span>
                        <select name="month"
                            class="p-1 outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                            onchange="submit()">
                            <option value="All">All</option>
                            @if (request('month'))
                                @for ($i = 1; $i < 13; $i++)
                                    @if ($i == request('month'))
                                        <option value="{{ $i }}" selected>{{ $bulan[$i] }}</option>
                                    @else
                                        <option value="{{ $i }}">{{ $bulan[$i] }}</option>
                                    @endif
                                @endfor
                            @else
                                @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ $bulan[$i] }}</option>
                                @endfor
                            @endif
                        </select>
                    </div>
                    <div class="ml-2 w-20">
                        <span class="text-base text-stone-100">Tahun</span>
                        <select name="year"
                            class="p-1 text-center outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                            onchange="submit()">
                            @if (request('year'))
                                @for ($i = date('Y'); $i > date('Y') - 5; $i--)
                                    @if ($i == request('year'))
                                        <option value="{{ $i }}" selected>{{ $i }}</option>
                                    @else
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                @endfor
                            @else
                                @for ($i = date('Y'); $i > date('Y') - 5; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            @endif
                        </select>
                    </div>
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
