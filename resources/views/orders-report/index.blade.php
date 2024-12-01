@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div>
            <div class="flex justify-center w-full p-4">
                <label class="text-2xl text-stone-50 font-bold">LAPORAN SPK CETAK DAN PASANG</label>
            </div>
            <div class="flex justify-center bg-stone-700 p-2 border rounded-md">
                <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
                    <div>
                        <div class="flex justify-center w-full p-1">
                            <label class="text-lg text-stone-800 font-bold">Data SPK Cetak</label>
                        </div>
                        <div class="grid grid-cols-3 gap-2 w-[500px] p-2">
                            <a href="/marketing/orders-report/print_orders"
                                class="flex col-span-3 justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label class="flex justify-center font-serif text-md cursor-pointer">SPK Cetak</label>
                                </div>
                            </a>
                            <a href="#"
                                class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Berbayar</label>
                                </div>
                            </a>
                            <a href="#"
                                class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                                    <label class="flex justify-center items-center font-serif text-md cursor-pointer">Dari
                                        Penjualan</label>
                                </div>
                            </a>
                            <a href="#"
                                class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Lain-Lain</label>
                                </div>
                            </a>
                        </div>
                        <div class="grid grid-cols-2 gap-2 w-[500px] p-4 mt-4 border-t">
                            <div
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
                                </div>
                            </div>
                            <div
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
                                </div>
                            </div>
                            <div
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
                                </div>
                            </div>
                            <div
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
            <div class="flex justify-center bg-stone-700 p-2 border rounded-md mt-4">
                <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
                    <div>
                        <div class="flex justify-center w-full p-1">
                            <label class="text-lg text-stone-800 font-bold">Data SPK Pasang</label>
                        </div>
                        <div class="grid grid-cols-3 gap-2 w-[500px] p-2">
                            <a href="/marketing/orders-report/install_orders"
                                class="flex col-span-3 justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label class="flex justify-center font-serif text-md cursor-pointer">SPK Pasang</label>
                                </div>
                            </a>
                            <a href="#"
                                class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Berbayar</label>
                                </div>
                            </a>
                            <a href="#"
                                class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                                    <label class="flex justify-center items-center font-serif text-md cursor-pointer">Dari
                                        Penjualan</label>
                                </div>
                            </a>
                            <a href="#"
                                class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                <div>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Lain-Lain</label>
                                </div>
                            </a>
                        </div>
                        <div class="grid grid-cols-2 gap-2 w-[500px] p-4 mt-4 border-t">
                            <div
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
                            </div>
                            <div
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
                            </div>
                            <div
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
                            </div>
                            <div
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
