<div id="bast" class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    <!-- Header start -->
    @include('dashboard.layouts.letter-header')
    <!-- Header end -->

    <!-- Body start -->
    <div class="h-[1100px] w-full flex justify-center mt-2">
        <div class="flex justify-center w-full">
            <div class="w-[780px]">
                <div class="flex justify-center w-full font-serif mt-6 text-lg tracking-wider font-bold">
                    <label>
                        <u>BERITA ACARA SERAH TERIMA PEKERJAAN</u>
                    </label>
                </div>
                <div class="flex justify-center w-full font-serif text-md font-semibold">
                    <label class="text-slate-400">
                        Nomor : Penomoran otomatis
                    </label>
                </div>
                <div class="flex mt-6">
                    <label class="w-40">Tanggal BAST</label>
                    <label>:</label>
                    <form
                        action="/work-reports/select-format/{{ $sale->id }}/{{ $install_order->id }}/{{ $first_photo->id }}/{{ $first_title }}/{{ $second_photo->id }}/{{ $second_title }}/{{ $bast_category }}">
                        <input type="date" class="ml-2 outline-none px-2 border rounded-md"
                            value="{{ $content->date }}" onchange="submit()" name="bast_date" required>
                    </form>
                </div>
                <div id="letterTop" class="text-md mt-12 w-full">Pada hari ini
                    @php
                        echo '<b>' . hari_ini($content->date) . '</b>';
                    @endphp
                    telah dilaksanakan serah terima pekerjaan antara @php
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
                    <input type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                        value="{{ $content->type }}" onchange="changeType(this)">
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Jenis</label>
                    <label>:</label>
                    <label class="ml-2">{{ $content->location_type }} {{ $content->location_lighting }}</label>
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Ukuran</label>
                    <label>:</label>
                    <label class="ml-2">{{ $content->location_size }}</label>
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Jumlah</label>
                    <label>:</label>
                    <label id="workQty" class="ml-2">{{ $content->qty }} unit</label>
                </div>
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Lokasi</label>
                    <label>:</label>
                    <input type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                        value="{{ $content->location_address }}" onchange="changeLocation(this)" required>
                </div>
                @if ($sale->media_category->name == 'Service')
                    <div class="flex text-md mt-2 ml-10">
                        <label class="w-40">Tema</label>
                        <label>:</label>
                        <input type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                            value="{{ $content->theme }}" onchange="changeTheme(this)" required>
                    </div>
                @else
                    <div class="flex text-md mt-2 ml-10">
                        <label class="w-40">Periode Kontrak</label>
                        <label>:</label>
                        <label class="ml-2">{{ $content->periode }}</label>
                    </div>
                @endif
                <div class="flex text-md mt-2 ml-10">
                    <label class="flex w-40">Keterangan</label>
                    <label class="flex">:</label>
                    <textarea class="flex ml-2 text-md w-[575px] outline-none border rounded-md px-2" rows="4"
                        onchange="getNote(this)"></textarea>
                </div>
                <div class="text-md mt-10 w-full">Demikian Berita Acara Serah Terima ini dibuat dan ditandatangani
                    bersama
                    untuk dapat dipergunakan sebagaimana mestinya</div>
                <div class="grid grid-cols-2 gap-4 w-full mt-4">
                    <div>
                        <label class="mt-4 text-md flex justify-center w-full">Yang menyerahkan,</label>
                        <label class="text-md flex justify-center w-full font-semibold">{{ $company->name }}</label>
                        <label class="mt-24 text-md flex justify-center w-full font-semibold">
                            <span class="border-b-2 border-black">Texun Sandy Kamboy</span>
                        </label>
                        <label class="text-md flex justify-center w-full">Direktur</label>
                    </div>
                    <div>
                        <label class="mt-4 text-md flex justify-center w-full">Yang menerima,</label>
                        <label class="text-md flex justify-center w-full font-semibold">{{ $client->company }}</label>
                        <label class="mt-24 text-md flex justify-center w-full font-semibold">
                            <span
                                class="border-b-2 border-black">.......................................................</span>
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
