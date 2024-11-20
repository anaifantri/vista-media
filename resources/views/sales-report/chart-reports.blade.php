@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center m-2">
                <h1 class="text-xl text-stone-100 font-bold tracking-wider w-[1580px] border-b">GAFIK PERIODE KONTRAK</h1>
            </div>
            @include('sales-report.chart-header')
            <div id="chartReport" class="flex justify-center z-0">
                <?php
                if (fmod(count($locations), 35) == 0) {
                    $pageQtyChart = count($locations) / 35;
                } else {
                    $pageQtyChart = (count($locations) - fmod(count($locations), 35)) / 35 + 1;
                }
                if (request('yearReport')) {
                    $thisYear = request('yearReport');
                } else {
                    $thisYear = date('Y');
                }
                $prevYear = $thisYear - 1;
                $nextYear = $thisYear + 1;
                ?>
                <div id="pdfPreview">
                    @for ($j = 0; $j < $pageQtyChart; $j++)
                        @if ($j == 0)
                            @include('sales-report.chart-first-page')
                        @else
                            @include('sales-report.chart-next-page')
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
