<div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
    <!-- Header start -->
    @include('dashboard.layouts.letter-header')
    <!-- Header end -->
    <!-- Body start -->
    <div class="h-[1110px]">
        <div class="flex justify-center w-full">
            <div class="w-[780px]">
                <div class="flex justify-center w-full font-serif mt-6 text-lg tracking-wider font-bold">
                    <label>
                        <u>BERITA ACARA SERAH TERIMA PEKERJAAN</u>
                    </label>
                </div>
                <div class="flex justify-center w-full font-serif text-md font-semibold">
                    <label>
                        Nomor : {{ $work_report->number }}
                    </label>
                </div>
                <div class="text-md mt-12 w-full">Pada hari ini
                    @php
                        echo '<b>' . hari_ini($content->date) . '</b>';
                    @endphp
                    telah dilaksanakan serah terima pekerjaan antara
                    @php
                        echo '<b>' . $company->name . '</b>';
                    @endphp
                    dan
                    @php
                        echo '<b>' . $client->company . '</b>';
                    @endphp
                    dengan rincian pekerjaan sebagai
                    berikut :
                </div>
                <div class="flex text-md mt-4 ml-10">
                    <label class="w-40">Pekerjaan</label>
                    <label>:</label>
                    <label class="ml-2"><b>{{ $content->type }}</b></label>
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Jumlah</label>
                    <label>:</label>
                    <label id="workQty" class="ml-2"><b>{{ $content->qty }} unit</b></label>
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Lokasi</label>
                    <label>:</label>
                    <label class="ml-2"><b>{{ $content->location_address }}</b></label>
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Ukuran</label>
                    <label>:</label>
                    <label class="ml-2"><b>{{ $content->location_size }}</b></label>
                </div>
                @if ($work_report->sale->media_category->name == 'Service')
                    <div class="flex text-md mt-2 ml-10">
                        <label class="w-40">Tema</label>
                        <label>:</label>
                        <label id="theme" class="ml-2"><b>{{ $content->theme }}</b></label>
                    </div>
                @else
                    <div class="flex text-md mt-2 ml-10">
                        <label class="w-40">Periode Kontrak</label>
                        <label>:</label>
                        <label class="ml-2"><b>{{ $content->periode }}</b></label>
                    </div>
                @endif
                <div class="flex text-md mt-2 ml-10">
                    <label class="flex w-40">Keterangan</label>
                    <label class="flex">:</label>
                    <label class="flex ml-2 text-md w-[575px] h-20"><b>{{ $content->note }}</b></label>
                </div>
                <div class="text-md mt-10 w-full text-justify">Demikian Berita Acara Serah Terima ini dibuat dan
                    ditandatangani
                    bersama untuk dapat dipergunakan sebagaimana mestinya</div>
                <div class="flex justify-center w-full mt-4">
                    <div class="w-[360px]">
                        <label class="mt-4 text-md flex justify-center w-72">Yang menyerahkan,</label>
                        <label class="text-md flex justify-center w-72 font-semibold">{{ $company->name }}</label>
                        <label class="mt-24 text-md flex justify-center w-72 font-semibold">
                            <u>Texun Sandy Kamboy</u>
                        </label>
                        <label class="text-md flex justify-center w-72">Direktur</label>
                    </div>
                    <div class="w-[360px] ml-2">
                        <label class="mt-4 text-md flex justify-center w-72">Yang menerima,</label>
                        <label
                            class="text-md flex justify-center w-72 font-semibold">{{ $content->client->company }}</label>
                        <label class="mt-24 text-md flex justify-center w-72 font-semibold">
                            ___________________________________
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Body end -->
    <!-- Footer start -->
    @include('dashboard.layouts.letter-footer')
    <!-- Footer end -->
</div>
