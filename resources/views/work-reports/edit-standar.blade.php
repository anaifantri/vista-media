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
                <div class="flex mt-6">
                    <label class="w-40">Tanggal BAST</label>
                    <label>:</label>
                    <input type="date" class="ml-2 outline-none px-2 border rounded-md" value="{{ $content->date }}"
                        onchange="changeDate(this)" id="inputBastDate" required>
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
                        if ($client->type == 'Perusahaan') {
                            echo '<b>' . $client->company . '</b>';
                        } else {
                            echo '<b>' . $client->name . '</b>';
                        }
                    @endphp
                    dengan rincian pekerjaan sebagai
                    berikut :
                </div>
                <div class="flex text-md mt-4 ml-10">
                    <label class="w-40">Pekerjaan</label>
                    <label>:</label>
                    <input id="bastType" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                        value="{{ $content->type }}" onchange="changeType(this)">
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Jenis</label>
                    <label>:</label>
                    <input id="locationType" type="text"
                        class="ml-2 mr-2 outline-none px-1 border rounded-md w-[200px]"
                        value="{{ $content->location_type }}" onchange="changeLocationType(this)" required> -
                    <input id="locationLighting" type="text"
                        class="ml-2 outline-none px-1 border rounded-md w-[200px]"
                        value="{{ $content->location_lighting }}" onchange="changeLocationLighting(this)" required>
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Jumlah</label>
                    <label>:</label>
                    <input id="qty" type="text" class="ml-2 outline-none px-1 border rounded-md w-16"
                        value="{{ $content->qty }}" onchange="changeQty(this)" required>
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Lokasi</label>
                    <label>:</label>
                    <input id="locationAddress" type="text"
                        class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                        value="{{ $content->location_address }}" onchange="changeLocationAddress(this)" required>
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Ukuran</label>
                    <label>:</label>
                    <input id="locationSize" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                        value="{{ $content->location_size }}" onchange="changeLocationSize(this)" required>
                </div>
                @if ($work_report->sale->media_category->name == 'Service')
                    <div class="flex text-md mt-2 ml-10">
                        <label class="w-40">Tema</label>
                        <label>:</label>
                        <input id="theme" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                            value="{{ $content->theme }}" onchange="changeTheme(this)" required>
                    </div>
                @else
                    <div class="flex text-md mt-2 ml-10">
                        <label class="w-40">Periode Kontrak</label>
                        <label>:</label>
                        <input id="periode" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                            value="{{ $content->periode }}" onchange="changePeriode(this)" required>
                    </div>
                @endif
                <div class="flex text-md mt-2 ml-10">
                    <label class="flex w-40">Keterangan</label>
                    <label class="flex">:</label>
                    <textarea id="note" class="flex ml-2 text-md w-[575px] outline-none border rounded-md px-2" rows="4"
                        onchange="changeNote(this)"></textarea>
                </div>
                <div class="text-md mt-10 w-full text-justify">Demikian Berita Acara Serah Terima ini dibuat dan
                    ditandatangani
                    bersama untuk dapat dipergunakan sebagaimana mestinya</div>
                <div class="flex justify-center w-full mt-4">
                    <div class="w-[360px]">
                        <label class="mt-4 text-md flex justify-center w-72">Yang menyerahkan,</label>
                        <label class="text-md flex justify-center w-72 font-semibold">{{ $company->name }}</label>
                        <label class="mt-24 text-md flex justify-center w-72 font-semibold">
                            <u>{{ $bank_account->director }}</u>
                        </label>
                        <label class="text-md flex justify-center w-72">Direktur</label>
                    </div>
                    <div class="w-[360px] ml-2">
                        <label class="mt-4 text-md flex justify-center w-72">Yang menerima,</label>
                        <label class="text-md flex justify-center w-72 font-semibold">
                            @if (isset($content->client->company))
                                {{ $content->client->company }}
                            @else
                                {{ $content->client->name }}
                            @endif
                        </label>
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
