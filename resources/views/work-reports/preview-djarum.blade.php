<div id="bast" class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    <div class="p-2 m-4 border-4 rounded-md border-black h-[1280px]">
        <div class="p-4 border-2 rounded-md border-black h-full">
            <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-4">
                <u>BERITA ACARA SERAH TERIMA</u>
            </label>
            <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider">
                Nomor : {{ $work_report->number }}
            </label>
            <div class="p-4">
                <div class="flex text-md items-center ml-2 mt-4">
                    <label>Yang bertandatangan di bawah ini :</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-6">1.</label>
                    <label class="px-1 ml-4 text-justify w-[725px]">{{ $content->first }}</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-6">2.</label>
                    <label class="px-1 ml-4 text-justify w-[725px]">{{ $content->second }}</label>
                </div>
                <div class="flex text-md items-center ml-2 mt-4">
                    <label class="text-justify w-[780px]">Bersama ini Pihak Pertama dan Pihak Kedua telah Bersama-sama
                        melaksanakan Pemeriksaan pekerjaan Pemasangan atas Surat Perjanjian Kerja Sama Penempatan Media
                        dengan rincian sebagai berikut :</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Nomor perjanjian</label>
                    <label>:</label>
                    <label class="ml-4">{{ $content->agreement_number }}</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Jenis Reklame</label>
                    <label>:</label>
                    <label class="ml-2">{{ $content->type }}</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Lokasi</label>
                    <label>:</label>
                    <label class="ml-2">{{ $content->location_address }}</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Ukuran</label>
                    <label>:</label>
                    <label class="ml-2">{{ $content->location_size }}</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Jenis Penerangan</label>
                    <label>:</label>
                    <label class="ml-4">{{ $content->location_lighting }}</label>
                </div>
                <div class="flex text-md items-center ml-2 mt-4">
                    <label class="text-justify w-[780px]">Dari hasil pemeriksaan tersebut diatas dinyatakan pekerjaan
                        pemasangan materi diatas telah selesai dikerjakan dengan baik dan berfungsi sesuai dengan
                        kontrak
                        pada Hari
                        @php
                            echo '<b>' . hari_ini($content->date) . '</b>';
                        @endphp
                        dibuktikan dengan Foto Dokumentasi pada saat siang dan
                        malam hari.</label>
                </div>
                <div class="flex text-md items-center ml-2 mt-4">
                    <label class="text-justify w-[780px]">Demikianlah Berita Acara Serah Terima Pekerjaan ini dibuat
                        dengan
                        sebenarnya untuk dapat digunakan sebagaimana mestinya.</label>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="flex text-md justify-center ml-2 mt-1">
                    <div>
                        <label class="flex w-full justify-center font-semibold">PIHAK PERTAMA,</label>
                        <label class="flex w-full justify-center font-semibold">{{ $company->name }}</label>
                        <label
                            class="flex w-full justify-center font-semibold mt-20 border-b-2 border-black">{{ $content->first_contact }}</label>
                        <label class="flex w-full justify-center">Direktur</label>
                    </div>
                </div>
                <div class="flex text-md justify-center ml-2 mt-1">
                    <div>
                        <label class="flex w-full justify-center font-semibold">PIHAK KEDUA,</label>
                        <label class="flex w-full justify-center font-semibold">{{ $client->company }}</label>
                        <label
                            class="flex w-full justify-center font-semibold mt-20 border-b-2 border-black">{{ $content->second_contact }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
