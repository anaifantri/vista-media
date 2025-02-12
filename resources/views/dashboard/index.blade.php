@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            @can('isMedia')
                @include('dashboard.media')
            @endcan
            @can('isMarketing')
                @include('dashboard.marketing')
            @endcan
            @canany(['isAdmin', 'isOwner'])
                @include('dashboard.media')
                @include('dashboard.marketing')
            @endcanany
        </div>
    </div>

    <!-- Script start -->
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            series: [{
                name: "Total Penawaran",
                data: @json($thisYearQty)
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
                text: 'Penawaran Bulanan',
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

        var chart = new ApexCharts(document.querySelector("#line-quotation-chart"), options);
        chart.render();

        var options = {
            series: @json($quotationData),
            chart: {
                width: 380,
                type: 'pie',
            },
            title: {
                text: 'Penawaran Tahun Ini',
                align: 'center'
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
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
        chart.render();

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
                text: 'Penjualan Bulanan',
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

        var chart = new ApexCharts(document.querySelector("#line-sales-chart"), options);
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
            labels: @json($labelDataOrder),
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
            labels: @json($labelDataOrder),
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
