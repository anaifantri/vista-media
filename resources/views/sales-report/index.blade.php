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
                            <a href="/marketing/sales-report/c-report/{{ $company->id }}"
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
                            </div>
                            <div
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
                            </div>
                            <div
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center w-[650px] mx-4 m-1 border rounded-lg bg-stone-300">
                    <div class="w-[600px] h-[460px] bg-stone-300 border rounded-lg m-4">
                        <div id="line-chart"></div>
                        <div id="bar-chart"></div>
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
                name: "Total Penjualan",
                data: @json($thisYearTotal)
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
                text: 'Penjualan Bulanan Tahun ' + @json(date('Y')),
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
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toLocaleString("id-ID", {
                            style: "currency",
                            currency: "IDR"
                        });
                    }
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#line-chart"), options);
        chart.render();

        var options = {
            series: [{
                name: @json(date('Y') - 1),
                data: @json($prevYearTotal)
            }, {
                name: @json(date('Y')),
                data: @json($thisYearTotal)
            }],
            chart: {
                type: 'bar',
                height: 220
            },
            title: {
                text: 'Penjualan Tahun Ini dan Tahun Lalu',
                align: 'left'
            },
            plotOptions: {
                bar: {
                    vertical: true,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: false,
                offsetX: -6,
                style: {
                    fontSize: '12px',
                    rotate: 90,
                    colors: ['#fff']
                },
                formatter: function(val, opts) {
                    if (val < 1000000000) {
                        return (val / 1000000).toFixed(2) + 'Jt'
                    } else if (val >= 1000000000) {

                        return (val / 1000000000).toFixed(2) + 'M'
                    }
                }
            },
            stroke: {
                show: true,
                width: 1,
                colors: ['#fff']
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            xaxis: {
                categories: @json($monthData),
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toLocaleString("id-ID", {
                            style: "currency",
                            currency: "IDR"
                        });
                    }
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#bar-chart"), options);
        chart.render();
    </script>
    <!-- Script end -->
@endsection
