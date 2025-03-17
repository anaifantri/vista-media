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
            <div id="letterTop" class="text-md mt-12 w-full">
                @php
                    echo $content->letter_top;
                @endphp
            </div>
            <div class="flex text-md mt-4 ml-10">
                <label class="w-40">Pekerjaan</label>
                <label>:</label>
                <label class="ml-2">{{ $content->type }}</label>
            </div>
            <div class="flex text-md mt-2 ml-10">
                <label class="w-40">Jumlah</label>
                <label>:</label>
                <label id="workQty" class="ml-2">{{ $content->qty }} unit</label>
            </div>
            <div class="flex text-md mt-2 ml-10">
                <label class="w-40">Lokasi</label>
                <label>:</label>
                <label class="ml-2">{{ $product->address }}</label>
            </div>
            <div class="flex text-md mt-2 ml-10">
                <label class="w-40">Ukuran</label>
                <label>:</label>
                <label class="ml-2">{{ $content->location_size }}</label>
            </div>
            @if ($sale->media_category->name == 'Service')
                <div class="flex text-md mt-2 ml-10">
                    <label class="w-40">Tema</label>
                    <label>:</label>
                    <label id="theme" class="ml-2">{{ $content->theme }}</label>
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
            <div class="text-md mt-10 w-full">{{ $content->letter_bottom }}</div>
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
                    <label class="text-md flex justify-center w-72 font-semibold">{{ $client->company }}</label>
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
