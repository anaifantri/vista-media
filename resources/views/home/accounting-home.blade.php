@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="grid grid-cols-2 gap-4 z-0 mb-8 bg-stone-700 p-2 border rounded-md">
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
                    </div>
                </div>
            </div>
            <div class="flex justify-center bg-stone-700 p-2 border rounded-md">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
