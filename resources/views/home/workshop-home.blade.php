@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full p-1 mt-4 text-2xl text-stone-50 font-bold border-b border-t bg-teal-900">
                DATA
                LISTRIK</div>
            <div class="grid grid-cols-4 gap-2 w-[1200px] p-2 font-mono">
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Data Daya Listrik</div>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <div class="w-full p-1 border rounded-lg hover:bg-stone-700">
                            <a href="/workshop/electrical-powers/?type=Prabayar">
                                <span class="flex justify-center text-md">Prabayar</span>
                            </a>
                        </div>
                        <div class="w-full p-1 border rounded-lg hover:bg-stone-700">
                            <a href="/workshop/electrical-powers/?type=Pascabayar">
                                <span class="flex justify-center text-md">Pascabayar</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Pengisian Pulsa Listrik</div>
                    <div class="w-full p-1 border rounded-lg mt-2 hover:bg-stone-700">
                        <a href="/workshop/electricity-top-ups hover:bg-stone-700">
                            <span class="flex justify-center text-md">Bulan Ini</span>
                        </a>
                    </div>
                </div>
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Pembayaran Tagihan Listrik</div>
                    <div class="w-full p-1 border rounded-lg mt-2 hover:bg-stone-700">
                        <a href="/workshop/electricity-payments">
                            <span class="flex justify-center text-md">Bulan Ini</span>
                        </a>
                    </div>
                </div>
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Laporan</div>
                    <div class="grid grid-cols-3 gap-2 mt-2  text-md ">
                        <a href="/workshop/electricity-reports/power"
                            class="p-1 border rounded-lg flex justify-center items-center hover:bg-stone-700">Daya</a>
                        <a href="/workshop/electricity-reports/topup"
                            class="p-1 border rounded-lg flex justify-center items-center hover:bg-stone-700">Pulsa</a>
                        <a href="/workshop/electricity-reports/payment"
                            class="p-1 border rounded-lg flex justify-center items-center hover:bg-stone-700">Tagihan</a>
                    </div>
                </div>
            </div>

            <div
                class="flex justify-center font-mono w-full p-1 mt-4 text-2xl text-stone-50 font-bold border-b border-t bg-teal-900">
                KOMPLAIN
                DARI KLIEN</div>
            <div class="grid grid-cols-3 gap-2 w-[1200px] p-2">
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Data Komplain</div>
                    <div class="w-full p-1 border rounded-lg mt-2 hover:bg-stone-700">
                        <a href="/workshop/complaints">
                            <span class="flex justify-center text-md">Bulan Ini</span>
                        </a>
                    </div>
                </div>
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Data Penanganan Komplain</div>
                    <div class="w-full p-1 border rounded-lg mt-2 hover:bg-stone-700">
                        <a href="/workshop/complaint-responses">
                            <span class="flex justify-center text-md">Bulan Ini</span>
                        </a>
                    </div>
                </div>
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Laporan</div>
                    <a href="/complaints/report"
                        class="flex justify-center items-center w-full p-1 border rounded-lg mt-2 hover:bg-stone-700">Komplain</a>
                </div>
            </div>

            <div
                class="flex justify-center w-full p-1 mt-4 font-mono text-2xl text-stone-50 font-bold border-b border-t bg-teal-900">
                PEMANTAUAN BULANAN</div>
            <div class="grid grid-cols-2 gap-2 w-[1200px] p-2">
                <a href="/workshop/monitorings"
                    class="flex justify-center text-teal-400 items-center bg-stone-900 w-full p-1 border rounded-lg mt-2 hover:bg-stone-800">Data
                    Pemantauan</a>
                <a href="/workshop/monitoring-report"
                    class="flex justify-center text-teal-400 items-center bg-stone-900 w-full p-1 border rounded-lg mt-2 hover:bg-stone-800">Laporan</a>
            </div>

            <div
                class="flex justify-center w-full p-1 mt-4 font-mono text-2xl text-stone-50 font-bold border-b border-t bg-teal-900">
                DOKUMENTASI PEMASANGAN GAMBAR
            </div>
            <div class="grid grid-cols-2 gap-2 w-[1200px] p-2">
                <a href="/installation-photos/index/{{ $company->id }}"
                    class="flex justify-center text-teal-400 items-center bg-stone-900 w-full p-1 border rounded-lg mt-2 hover:bg-stone-800">Data
                    Dokumentasi</a>
                <a href="/installation-photos/report/{{ $company->id }}"
                    class="flex justify-center text-teal-400 items-center bg-stone-900 w-full p-1 border rounded-lg mt-2 hover:bg-stone-800">Laporan</a>
            </div>


            <div class="flex justify-center w-full p-1 mt-4 text-2xl text-stone-50 font-bold border-b border-t bg-teal-900">
                MATERI
                VIDEOTRON</div>
            <div class="grid grid-cols-3 gap-2 w-[1200px] p-2">
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Penayangan Materi</div>
                    <div class="w-full p-1 border rounded-lg mt-2 hover:bg-stone-700">
                        <a href="/workshop/publish-contents">
                            <span class="flex justify-center text-md">Bulan Ini</span>
                        </a>
                    </div>
                </div>
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Penurunan Materi</div>
                    <div class="w-full p-1 border rounded-lg mt-2 hover:bg-stone-700">
                        <a href="/workshop/takeout-contents">
                            <span class="flex justify-center text-md">Bulan Ini</span>
                        </a>
                    </div>
                </div>
                <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
                    <div class="border-b w-full flex justify-center text-md">Laporan</div>
                    <a href="/publish-contents/report"
                        class="p-1 border rounded-lg flex justify-center items-center hover:bg-stone-700 mt-2">Penayangan
                        Materi Videotron</a>
                </div>
            </div>
        </div>
    </div>
@endsection
