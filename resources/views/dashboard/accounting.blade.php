<div>
    <div class="flex justify-center bg-stone-700 p-2 border rounded-md">
        <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
            <div>
                <div class="flex justify-center w-full p-1">
                    <label class="text-lg text-stone-800 font-bold">Data Penagihan</label>
                </div>
                <div class="grid grid-cols-2 gap-2 w-[500px] p-2">
                    <a href="/work-reports/index/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">BAST</label>
                        </div>
                    </a>
                    <a href="/billings/index/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">INVOICE</label>
                        </div>
                    </a>
                    <a href="/bill-cover-letters/index/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">SURAT
                                PENGANTAR</label>
                        </div>
                    </a>
                    <a href="/billings/report/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">LIST
                                INVOICE</label>
                        </div>
                    </a>
                    <a href="/marketing/sales-report/c-report/{{ $company->id }}?month={{ (int) date('m') }}&year={{ date('Y') }}"
                        class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">LAPORAN
                                C1</label>
                        </div>
                    </a>
                    </a>
                    <a href="/marketing/sales-report/receivables-report/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">LIST
                                PIUTANG</label>
                        </div>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-2 w-[500px] p-4 mt-4 border-t">
                    <a href="#"
                        class="flex justify-center text-teal-400 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">BULAN
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-xl cursor-pointer w-full text-white mt-4">
                                Total Invoice :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-2XL cursor-pointer w-full text-yellow-400">
                                {{ count($monthBillings) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-xl cursor-pointer w-full text-white mt-4">
                                Nominal Invoice :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-2XL cursor-pointer w-full text-yellow-400">
                                {{ number_format($monthBillings->sum('nominal') + $monthBillings->sum('ppn')) }}
                            </label>
                        </div>
                    </a>
                    <a href="#"
                        class="flex justify-center text-teal-400 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full text-teal-400">TAHUN
                                INI</label>
                            <label
                                class="flex justify-center items-center font-serif text-xl cursor-pointer w-full text-white mt-4">
                                Total Invoice :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-2XL cursor-pointer w-full text-yellow-400">
                                {{ count($yearBillings) }}
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-xl cursor-pointer w-full text-white mt-4">
                                Nominal Invoice :
                            </label>
                            <label
                                class="flex justify-center items-center font-serif text-2XL cursor-pointer w-full text-yellow-400">
                                {{ number_format($yearBillings->sum('nominal') + $yearBillings->sum('ppn')) }}
                            </label>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center w-[650px] mx-4 m-1 border rounded-lg bg-stone-300 p-4">
            <div class="flex w-full" id="billing-bar-chart"></div>
        </div>
    </div>
    <div class="flex justify-center bg-stone-700 p-2 border rounded-md mt-4">
        <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
            <div>
                <div class="flex justify-center w-full p-1">
                    <label class="text-lg text-stone-800 font-bold">Data Pembayaran</label>
                </div>
                <div class="grid grid-cols-2 gap-2 w-[500px] p-2">
                    <a href="/payments/index/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center py-4 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">PEMBAYARAN</label>
                        </div>
                    </a>
                    <a href="/payments/report/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center py-4 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">LIST
                                PEMBAYARAN</label>
                        </div>
                    </a>
                    <a href="/vat-tax-invoices/index/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center py-4 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">PPN</label>
                        </div>
                    </a>
                    <a href="/vat-taxes/report/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center py-4 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">LIST
                                FAKTUR PPN</label>
                        </div>
                    </a>
                    <a href="/income-taxes/index/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center py-4 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">PPh</label>
                        </div>
                    </a>
                    <a href="/income-taxes/report/{{ $company->id }}"
                        class="flex justify-center text-teal-400 items-center py-4 bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                        <div>
                            <label
                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">LIST
                                POTONG PPh</label>
                        </div>
                    </a>
                </div>
                <div class="flex justify-center w-full p-1 border-t mt-2">
                    <label class="text-lg text-stone-800 font-bold">Data Pembayaran Berdasarkan Periode</label>
                </div>
                <div class="grid grid-cols-2 gap-2 w-[500px] p-4">
                    <a href="/marketing/sales/home/All/{{ $company->id }}?monthly=true"
                        class="flex justify-center text-teal-400 h-[200px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                        <div>
                            <label
                                class="flex justify-center font-serif text-lg cursor-pointer w-full">Pembayaran</label>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full">BULAN
                                INI</label>
                            @if ($monthPayments < 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($monthPayments / 1000000, 2, '.', '') }}
                                </label>
                                <label
                                    class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                    Juta
                                </label>
                            @elseif ($monthPayments >= 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($monthPayments / 1000000000, 2, '.', '') }}
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
                                class="flex justify-center font-serif text-lg cursor-pointer w-full">Pembayaran</label>
                            <label
                                class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full">TAHUN
                                INI</label>
                            @if ($yearPayments < 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($yearPayments / 1000000, 2, '.', '') }}
                                </label>
                                <label
                                    class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                    Juta
                                </label>
                            @elseif ($yearPayments >= 1000000000)
                                <label
                                    class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                    {{ number_format($yearPayments / 1000000000, 2, '.', '') }}
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
            <div class="flex w-full" id="payment-bar-chart"></div>
        </div>
    </div>
</div>
