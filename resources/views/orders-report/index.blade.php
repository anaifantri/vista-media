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
                            <a href="/marketing/orders-report/print-orders"
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
                                </div>
                            </a>
                            <a href="/print-orders/free-sales/{{ $company->id }}"
                                class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                                <div>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Penjualan</label>
                                </div>
                            </a>
                            <a href="/print-orders/free-other/{{ $company->id }}"
                                class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
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
                            <a href="/marketing/orders-report/install-orders"
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
                                </div>
                            </a>
                            <a href="/install-orders/free-sales/{{ $company->id }}"
                                class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
                                <div>
                                    <label
                                        class="flex justify-center items-center font-serif text-md cursor-pointer">Gratis</label>
                                    <label class="flex justify-center items-center font-serif text-md cursor-pointer">Dari
                                        Penjualan</label>
                                </div>
                            </a>
                            <a href="/install-orders/free-other/{{ $company->id }}"
                                class="flex justify-center text-teal-400 items-center bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer p-2">
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
                <div class="flex justify-center items-center w-[650px] mx-4 m-1 border rounded-lg bg-stone-300 p-4">
                    <div class="w-full h-full bg-stone-300 border rounded-lg">
                        <div id="install-pie-chart" class="flex justify-center items-center w-full h-[250px]"></div>
                        <div id="install-line-chart" class="flex justify-center items-center w-full h-[250px] mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container end -->

    <!-- Script start -->
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            series: [{
                name: "Jumlah SPK Cetak",
                data: @json($printOrderQty)
            }],
            chart: {
                height: 220,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight',
                width: 2
            },
            title: {
                text: 'SPK Cetak Bulanan',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($monthData),
            },
        };

        var chart = new ApexCharts(document.querySelector("#print-line-chart"), options);
        chart.render();

        var options = {
            series: @json($printOrderData),
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: @json($labelData),
            legend: {
                show: true,
                showForSingleSeries: false,
                showForNullSeries: true,
                showForZeroSeries: true,
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                fontFamily: 'Helvetica, Arial',
                fontWeight: 400,
                itemMargin: {
                    horizontal: 6,
                    vertical: 0
                },
            },
            title: {
                text: 'SPK Cetak Tahun Ini',
                align: 'center'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#print-pie-chart"), options);
        chart.render();


        var options = {
            series: [{
                name: "Jumlah SPK Pasang",
                data: @json($installOrderQty)
            }],
            chart: {
                height: 220,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight',
                width: 2
            },
            title: {
                text: 'SPK Pasang Bulanan',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($monthData),
            },
        };

        var chart = new ApexCharts(document.querySelector("#install-line-chart"), options);
        chart.render();

        var options = {
            series: @json($installOrderData),
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: @json($labelData),
            legend: {
                show: true,
                showForSingleSeries: false,
                showForNullSeries: true,
                showForZeroSeries: true,
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                fontFamily: 'Helvetica, Arial',
                fontWeight: 400,
                itemMargin: {
                    horizontal: 6,
                    vertical: 0
                },
            },
            title: {
                text: 'SPK Pasang Tahun Ini',
                align: 'center'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#install-pie-chart"), options);
        chart.render();
    </script>
    <!-- Script end -->
@endsection
