@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div>
            <div class="flex justify-center w-full p-4">
                <label class="text-2xl text-stone-50 font-bold">LAPORAN PENJUALAN</label>
            </div>
            <div class="flex justify-center bg-stone-700 p-2 border rounded-md">
                <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
                    <div>
                        <div class="flex justify-center w-full p-1">
                            <label class="text-lg text-stone-800 font-bold">Grafik Kontrak Klien</label>
                        </div>
                        <div class="grid grid-cols-4 gap-2 w-[500px] p-2">
                            @foreach ($areas as $area)
                                <a href="/marketing/sales-report/chart-report/{{ $area->id }}"
                                    class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                    <div>
                                        <label class="flex justify-center font-serif text-md cursor-pointer">Area</label>
                                        <label
                                            class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">{{ $area->area }}</label>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="flex justify-center w-full mt-4 border-t">
                            <label class="text-lg text-stone-800 font-bold">Laporan Penjualan</label>
                        </div>
                        <div class="grid grid-cols-1 gap-2 w-[500px] p-2">
                            <a href="/marketing/sales-report/c-report"
                                class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label class="flex justify-center font-serif text-4xl cursor-pointer">C1</label>
                                </div>
                            </a>
                        </div>
                        <div class="grid grid-cols-3 gap-2 w-[500px] p-4 mt-4 border-t">
                            <div
                                class="flex justify-center text-teal-400 h-[200px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                                <div>
                                    <label
                                        class="flex justify-center font-serif text-lg cursor-pointer w-full">Penjualan</label>
                                    <label
                                        class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full">MINGGU
                                        INI</label>
                                    <label
                                        class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                        {{ number_format($weekSales / 1000000000, 2, '.', '') }}
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                        Miliar
                                    </label>
                                </div>
                            </div>
                            <div
                                class="flex justify-center text-teal-400 h-[200px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                                <div>
                                    <label
                                        class="flex justify-center font-serif text-lg cursor-pointer w-full">Penjualan</label>
                                    <label
                                        class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full">BULAN
                                        INI</label>
                                    <label
                                        class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                        {{ number_format($monthSales / 1000000000, 2, '.', '') }}
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                        Miliar
                                    </label>
                                </div>
                            </div>
                            <div
                                class="flex justify-center text-teal-400 h-[200px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                                <div>
                                    <label
                                        class="flex justify-center font-serif text-lg cursor-pointer w-full">Penjualan</label>
                                    <label
                                        class="flex justify-center font-serif text-md font-semibold cursor-pointer w-full">TAHUN
                                        INI</label>
                                    <label
                                        class="flex justify-center items-center font-serif text-4xl cursor-pointer w-full p-2 text-yellow-400 mt-2 font-semibold">
                                        {{ number_format($yearSales / 1000000000, 2, '.', '') }}
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-2xl cursor-pointer w-full p-2 text-yellow-400">
                                        Miliar
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center w-[650px] mx-4 m-1 border rounded-lg bg-stone-300">
                    <div class="w-[600px] h-[460px] bg-stone-300 border rounded-lg m-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container end -->

    <!-- Script start -->
    <!-- Script end -->
@endsection
