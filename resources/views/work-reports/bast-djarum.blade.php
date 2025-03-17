<div class="p-2 m-4 border-4 rounded-md border-black h-[1280px]">
    <div class="p-4 border-2 rounded-md border-black h-full">
        <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-4">
            <u>BERITA ACARA SERAH TERIMA</u>
        </label>
        <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider">
            Nomor :
        </label>
        <div class="p-4">
            <div class="flex text-md items-center ml-2 mt-4">
                <label>Yang bertandatangan di bawah ini :</label>
            </div>
            <div class="flex text-md ml-2 mt-2">
                <label class="ml-6">1.</label>
                <label class="ml-4 text-justify w-[725px]">Nama : Texun Sandy Kamboy dalam hal ini bertindak atas nama
                    PT. Vista Media berkedudukan di Jl Pulau Kawe No 40 Dauh Puri Kauh Denpaasar Barat-Denpasar Bali,
                    untuk selanjutnya disebut sebagai Pihak Pertama.</label>
            </div>
            <div class="flex text-md ml-2 mt-2">
                <label class="ml-6">2.</label>
                <label class="ml-4 text-justify w-[725px]">Nama : Jonny Andriyanto dalam hal ini bertindak atas nama
                    PT. Perada Swara Produtions berkedudukan di The Vida Office Building Lt.7 Jl Raya Perjuangan No 8
                    Rt.001/Rw 007 Kebon Jeruk Jakarta Barat DKI Jakarta, untuk selanjutnya disebut sebagai Pihak Kedua
                </label>
            </div>
            <div class="flex text-md items-center ml-2 mt-4">
                <label class="text-justify w-[780px]">Bersama ini Pihak Pertama dan Pihak Kedua telah Bersama-sama
                    melaksanakan Pemeriksaan pekerjaan Pemasangan atas Surat Perjanjian Kerja Sama Penempatan Media
                    dengan rincian sebagai berikut :</label>
            </div>
            <div class="flex text-md ml-2 mt-2">
                <label class="ml-14 w-36">Nomor perjanjian</label>
                <label>:</label>
                <label class="ml-4">
                    @if (count($quotation_agreements) > 0)
                        {{ $quotation_agreements[0]->number }}
                    @else
                        -
                    @endif
                </label>
            </div>
            <div class="flex text-md ml-2 mt-2">
                <label class="ml-14 w-36">Jenis Reklame</label>
                <label>:</label>
                <label class="ml-4">{{ $content->type }}</label>
            </div>
            <div class="flex text-md ml-2 mt-2">
                <label class="ml-14 w-36">Lokasi</label>
                <label>:</label>
                <label class="ml-4">{{ $content->location_address }}</label>
            </div>
            <div class="flex text-md ml-2 mt-2">
                <label class="ml-14 w-36">Ukuran</label>
                <label>:</label>
                <label class="ml-4">{{ $content->location_size }}</label>
            </div>
            <div class="flex text-md ml-2 mt-2">
                <label class="ml-14 w-36">Jenis Penerangan</label>
                <label>:</label>
                <label class="ml-4">{{ $content->location_lighting }}</label>
            </div>
            <div class="flex text-md items-center ml-2 mt-4">
                <label class="text-justify w-[780px]">Dari hasil pemeriksaan tersebut diatas dinyatakan pekerjaan
                    pemasangan materi diatas telah selesai dikerjakan dengan baik dan berfungsi sesuai dengan kontrak
                    pada Hari {{ hari_ini() }} dibuktikan dengan Foto Dokumentasi pada saat siang dan
                    malam hari.</label>
            </div>
            <div class="flex text-md items-center ml-2 mt-4">
                <label class="text-justify w-[780px]">Demikianlah Berita Acara Serah Terima Pekerjaan ini dibuat dengan
                    sebenarnya untuk dapat digunakan sebagaimana mestinya.</label>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-6">
            <div class="flex text-md justify-center ml-2 mt-1">
                <div>
                    <label class="flex w-full justify-center font-semibold">PIHAK PERTAMA,</label>
                    <label class="flex w-full justify-center font-semibold">{{ $company->name }}</label>
                    <label class="flex w-full justify-center font-semibold mt-20 border-b-2 border-black">Texun Sandy
                        Kamboy</label>
                    <label class="flex w-full justify-center">Direktur</label>
                </div>
            </div>
            <div class="flex text-md justify-center items-center ml-2 mt-1">
                <div>
                    <label class="flex w-full justify-center font-semibold">PIHAK KEDUA,</label>
                    <label class="flex w-full justify-center font-semibold">{{ $client->company }}</label>
                    <input type="text"
                        class="flex text-center outline-none px-1 border rounded-md mt-20 border-b-2 border-black"
                        value="Jonny Andrianto">
                    <input type="text" class="flex text-center outline-none px-1 border rounded-md"
                        value=".......................">
                </div>
            </div>
        </div>
    </div>
</div>
