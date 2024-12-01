@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div>
            <div class="flex justify-center w-full p-4">
                <label class="text-2xl text-stone-50 font-bold">LAPORAN PENAWARAN</label>
            </div>
            <div class="flex justify-center bg-stone-700 p-2 border rounded-md">
                <div class="flex justify-center m-1 border rounded-lg bg-stone-300">
                    <div>
                        <div class="flex justify-center w-full p-1">
                            <label class="text-lg text-stone-800 font-bold">Data Penawaran</label>
                        </div>
                        <div class="grid grid-cols-4 gap-2 w-[500px] p-2">
                            @foreach ($media_categories as $category)
                                @if ($category->name == 'Service')
                                    <a href="/marketing/quotations-report/reports/{{ $category->id }}"
                                        class="flex col-span-2 justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                        <div>
                                            <label
                                                class="flex justify-center font-serif text-md cursor-pointer">Katagori</label>
                                            <label
                                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">Cetak/Pasang</label>
                                        </div>
                                    </a>
                                @else
                                    <a href="/marketing/quotations-report/reports/{{ $category->id }}"
                                        class="flex justify-center text-teal-400 items-center h-[60px] bg-stone-900 hover:bg-stone-700 border rounded-lg shadow-lg cursor-pointer">
                                        <div>
                                            <label
                                                class="flex justify-center font-serif text-md cursor-pointer">Katagori</label>
                                            <label
                                                class="flex justify-center text-yellow-400 font-serif text-md font-semibold cursor-pointer">{{ $category->name }}</label>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
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
                                        Total Penawaran :
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                        {{ count($todays) }}
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                        Penawaran Disetujui :
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($todays as $quotation)
                                            @php
                                                if (count($quotation->quotation_revisions) != 0) {
                                                    $revision = $quotation->quotation_revisions->last();
                                                    $revisionStatus =
                                                        $revision->quot_revision_statuses[
                                                            count($revision->quot_revision_statuses) - 1
                                                        ]->status;
                                                    if ($revisionStatus == 'Deal') {
                                                        $counter++;
                                                    }
                                                } else {
                                                    if (
                                                        $quotation->quotation_statuses[
                                                            count($quotation->quotation_statuses) - 1
                                                        ]->status == 'Deal'
                                                    ) {
                                                        $counter++;
                                                    }
                                                }
                                            @endphp
                                        @endforeach
                                        {{ $counter }}
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
                                        Total Penawaran :
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                        {{ count($weekday) }}
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                        Penawaran Disetujui :
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($weekday as $quotation)
                                            @php
                                                if (count($quotation->quotation_revisions) != 0) {
                                                    $revision = $quotation->quotation_revisions->last();
                                                    $revisionStatus =
                                                        $revision->quot_revision_statuses[
                                                            count($revision->quot_revision_statuses) - 1
                                                        ]->status;
                                                    if ($revisionStatus == 'Deal') {
                                                        $counter++;
                                                    }
                                                } else {
                                                    if (
                                                        $quotation->quotation_statuses[
                                                            count($quotation->quotation_statuses) - 1
                                                        ]->status == 'Deal'
                                                    ) {
                                                        $counter++;
                                                    }
                                                }
                                            @endphp
                                        @endforeach
                                        {{ $counter }}
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
                                        Total Penawaran :
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                        {{ count($monthQuots) }}
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                        Penawaran Disetujui :
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($monthQuots as $quotation)
                                            @php
                                                if (count($quotation->quotation_revisions) != 0) {
                                                    $revision = $quotation->quotation_revisions->last();
                                                    $revisionStatus =
                                                        $revision->quot_revision_statuses[
                                                            count($revision->quot_revision_statuses) - 1
                                                        ]->status;
                                                    if ($revisionStatus == 'Deal') {
                                                        $counter++;
                                                    }
                                                } else {
                                                    if (
                                                        $quotation->quotation_statuses[
                                                            count($quotation->quotation_statuses) - 1
                                                        ]->status == 'Deal'
                                                    ) {
                                                        $counter++;
                                                    }
                                                }
                                            @endphp
                                        @endforeach
                                        {{ $counter }}
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
                                        Total Penawaran :
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                        {{ count($yearQuots) }}
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-sm cursor-pointer w-full text-white mt-4">
                                        Penawaran Disetujui :
                                    </label>
                                    <label
                                        class="flex justify-center items-center font-serif text-XL cursor-pointer w-full text-yellow-400">
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($yearQuots as $quotation)
                                            @php
                                                if (count($quotation->quotation_revisions) != 0) {
                                                    $revision = $quotation->quotation_revisions->last();
                                                    $revisionStatus =
                                                        $revision->quot_revision_statuses[
                                                            count($revision->quot_revision_statuses) - 1
                                                        ]->status;
                                                    if ($revisionStatus == 'Deal') {
                                                        $counter++;
                                                    }
                                                } else {
                                                    if (
                                                        $quotation->quotation_statuses[
                                                            count($quotation->quotation_statuses) - 1
                                                        ]->status == 'Deal'
                                                    ) {
                                                        $counter++;
                                                    }
                                                }
                                            @endphp
                                        @endforeach
                                        {{ $counter }}
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
