<div class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    <!-- Header start -->
    <div>
        <div class="flex w-[full] items-center px-16 border-b border-black py-4">
            <img class="w-[125px]" class="mt-3" src="/img/logo-xl.png" alt="">
            <div class="grid grid-cols-2 gap-4 w-[700px]">
                <div class="flex justify-center text-md font-serif font-semibold">
                    <div>
                        <label class="flex justify-center w-full">Perjanjian Media Luar Ruang</label>
                        <label class="flex justify-center w-full">Oleh dan antara</label>
                        <label class="flex justify-center w-full">PT. XL Axiata Tbk</label>
                        <label class="flex justify-center w-full">dan</label>
                        <label class="flex justify-center w-full">{{ $company->name }}</label>
                    </div>
                </div>
                <div class="flex justify-center text-md font-serif font-semibold">
                    <div>
                        <label class="flex justify-center w-full">No. :
                            ..............................................</label>
                        <label class="flex justify-center w-full mt-2">General Terms</label>
                        <label class="flex justify-center w-full">and</label>
                        <label class="flex justify-center w-full">Conditions</label>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Header end -->

    <!-- Body start -->
    <div class="h-[1100px] w-full flex justify-center">
        <div class="flex justify-center w-full">
            <div class="w-[780px]">
                <div class="flex justify-center w-full font-sans mt-6 text-lg font-bold">
                    <label>
                        Surat Pemberitahuan Penyelesaian Pekerjaan ("SP3")
                    </label>
                </div>
                <div class="font-sans mt-10 text-lg">
                    <label class="flex">
                        Kepada Yth.
                    </label>
                    <label class="flex font-semibold">
                        PT. XL Axiata Tbk.
                    </label>
                    <label class="flex">
                        Gedung XL Axiata Tower
                    </label>
                    <label class="flex">
                        Jl. HR. Rasuna Said Ka. 11-12, Blok X-5 RT. 007 RW. 002
                    </label>
                    <label class="flex">
                        Kuningan Timur, Setiabudi, Jakarta Selatan DKI Jakarta 12950
                    </label>
                    <label class="flex mt-6">
                        Dengan hormat,
                    </label>
                    @if ($content->agreement_number != '' && $content->agreement_number != '')
                        <textarea class="flex outline-none mt-1 text-justify w-[800px]" rows="5">Dengan ini diberitahukan bahwa order XL untuk Media Luar Ruang di site {{ $content->location_address }} ("Site") sebagaimana dituangkan dalam PO# {{ $content->po_number }}, secara fisik telah kami selesaikan berikut dokumen-dokumen yang diperlukan, sebagaimana telah dipersyaratkan dalam perjanjian induk nomor {{ $content->agreement_number }} yaitu dokumen : </textarea>
                    @elseif($content->agreement_number != '' && $content->agreement_number == '')
                        <textarea class="flex outline-none mt-1 text-justify w-[800px]" rows="5">Dengan ini diberitahukan bahwa order XL untuk Media Luar Ruang di site {{ $content->location_address }} ("Site") sebagaimana dituangkan dalam PO# {{ $content->po_number }}, secara fisik telah kami selesaikan berikut dokumen-dokumen yang diperlukan, sebagaimana telah dipersyaratkan dalam perjanjian induk nomor ............................ yaitu dokumen : </textarea>
                    @elseif($content->agreement_number == '' && $content->agreement_number != '')
                        <textarea class="flex outline-none mt-1 text-justify w-[800px]" rows="5">Dengan ini diberitahukan bahwa order XL untuk Media Luar Ruang di site {{ $content->location_address }} ("Site") sebagaimana dituangkan dalam PO# ............................, secara fisik telah kami selesaikan berikut dokumen-dokumen yang diperlukan, sebagaimana telah dipersyaratkan dalam perjanjian induk nomor {{ $content->agreement_number }} yaitu dokumen : </textarea>
                    @else
                        <textarea class="flex outline-none mt-1 text-justify w-[800px]" rows="5">Dengan ini diberitahukan bahwa order XL untuk Media Luar Ruang di site {{ $content->location_address }} ("Site") sebagaimana dituangkan dalam PO# ...................................., secara fisik telah kami selesaikan berikut dokumen-dokumen yang diperlukan, sebagaimana telah dipersyaratkan dalam perjanjian induk nomor ...................... yaitu dokumen : </textarea>
                    @endif
                    <div class="flex ml-10">
                        <label>1. </label>
                        <label class="ml-2">BAK asli</label>
                    </div>
                    <div class="flex ml-10">
                        <label>2. </label>
                        <label class="ml-2">Spesifikasi teknis yang disetujui oleh XL</label>
                    </div>
                    <div class="flex ml-10">
                        <label>3. </label>
                        <label class="ml-2">Izin-izin</label>
                    </div>
                    <div class="flex ml-10">
                        <label>4. </label>
                        <label class="ml-2">Foto site (dalam waktu siang dan waktu malam)</label>
                    </div>
                    <div class="flex ml-10">
                        <label>4. </label>
                        <label class="ml-2">Surat pernyataan</label>
                    </div>
                    <label class="flex ml-10">(Copy atau asli dokumen tersebut di atas terlampir)</label>
                </div>
                <div class="text-lg font-sans text-justify mt-4 w-full">
                    Selanjutnya dengan terselesaikannya Site tersebut, kami mengundang pihak XL untuk melakukan uji
                    terima
                    penyelesaian atas Site tersebut (penandatanganan BAST) sesuai dengan mekanisme yang diatur dalam
                    pasal 3
                    ayat 3 perjanjian induk.
                </div>
                <div class="text-lg font-sans mt-2 w-full">
                    Demikian atas perhatiannya kami ucapkan terima kasih.
                </div>
                <div class="mt-8  text-lg font-sans">
                    <label class="mt-4 flex justify-center w-72">Hormat kami,</label>
                    <label class="flex justify-center w-72 font-semibold">{{ $company->name }}</label>
                    <label class="mt-24 flex justify-center w-72 font-semibold">
                        <u>Texun Sandy Kamboy</u>
                    </label>
                    <label class="flex justify-center w-72">Direktur</label>
                </div>
            </div>
        </div>
    </div>
    <!-- Body end -->
</div>

<div class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    <!-- Header start -->
    <div>
        <div class="flex w-[full] items-center px-16 border-b border-black py-4">
            <img class="w-[125px]" class="mt-3" src="/img/logo-xl.png" alt="">
            <div class="grid grid-cols-2 gap-4 w-[700px]">
                <div class="flex justify-center text-md font-serif font-semibold">
                    <div>
                        <label class="flex justify-center w-full">Perjanjian Media Luar Ruang</label>
                        <label class="flex justify-center w-full">Oleh dan antara</label>
                        <label class="flex justify-center w-full">PT. XL Axiata Tbk</label>
                        <label class="flex justify-center w-full">dan</label>
                        <label class="flex justify-center w-full">{{ $company->name }}</label>
                    </div>
                </div>
                <div class="flex justify-center text-md font-serif font-semibold">
                    <div>
                        <label class="flex justify-center w-full">No. :
                            ..............................................</label>
                        <label class="flex justify-center w-full mt-2">General Terms</label>
                        <label class="flex justify-center w-full">and</label>
                        <label class="flex justify-center w-full">Conditions</label>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Header end -->

    <!-- Body start -->
    <div class="h-[1100px] w-full flex justify-center">
        <div class="flex justify-center w-full text-lg font-sans">
            <div class="w-[780px]">
                <div class="flex justify-center w-full font-sans mt-6 text-2xl font-bold tracking-widest">
                    <label>
                        BERITA ACARA SERAH TERIMA (BAST)
                    </label>
                </div>
                <div class="flex justify-center w-full font-sans mt-2 font-semibold">
                    <label>
                        Nama Site :
                    </label>
                </div>
                <div class="flex justify-center w-full font-sans mt-4 font-semibold">
                    <label>
                        Antara
                    </label>
                </div>
                <div class="flex justify-center w-full font-sans font-semibold">
                    <label>
                        PT. XL Axiata Tbk
                    </label>
                </div>
                <div class="flex justify-center w-full font-sans font-semibold">
                    <label>
                        Dengan
                    </label>
                </div>
                <div class="flex justify-center w-full font-sans font-semibold">
                    <label>
                        {{ $company->name }}
                    </label>
                </div>
                <div class="font-sans mt-10">
                    Pada hari ini {{ hari_ini($content->date) }} bertempat di Jakarta antara pihak-pihak :
                </div>
                <div class="flex ml-10">
                    <label>1. </label>
                    <label class="ml-2 text-justify w-[750px]">PT. XL Axiata Tbk, dalam penandatanganan Berita Acara ini
                        diwakili secara sah oleh ......................................, jabatan
                        ............................................, selanjutnya disebut sebagai XL.</label>
                </div>
                <div class="flex ml-10">
                    <label>2. </label>
                    <label class="ml-2 text-justify w-[750px]">PT. Vista Media, dalam penandatanganan Berita Acara ini
                        diwakili secara sah oleh Texun Sandy Kamboy, jabatan Direktur, selanjutnya disebut sebagai Vista
                        Media</label>
                </div>
                <div class="font-sans mt-4 w-full">
                    @if ($content->agreement_number != '')
                        Berdasarkan perjanjian {{ $content->agreement_number }}, maka :
                    @else
                        Berdasarkan perjanjian ........................................................................,
                        maka :
                    @endif
                </div>
                <div class="flex ml-10">
                    <label>1. </label>
                    <textarea id="0" class="ml-2 outline-none border rounded-md text-justify w-[750px]" rows="2"
                        onchange="changeXlDetail(this)">{{ $content->detail[0] }}</textarea>
                </div>
                <div class="flex ml-10">
                    <label>2. </label>
                    <textarea id="1" class="ml-2 outline-none border rounded-md text-justify w-[750px]" rows="3"
                        onchange="changeXlDetail(this)">{{ $content->detail[1] }}</textarea>
                </div>
                <div class="flex ml-10">
                    <label>3. </label>
                    <textarea id="2" class="ml-2 outline-none border rounded-md text-justify w-[750px]" rows="2"
                        onchange="changeXlDetail(this)">{{ $content->detail[2] }}</textarea>
                </div>
                <div class="font-sans mt-2 w-full">
                    Berita Acara Serah Terima ini dibuat dalam rangkap 2 (dua) asli, masing-masing sama memiliki bunyi
                    yang sama diatas kertas bermaterai cukup serta mempunyai kekuatan hukum yang sama setelah
                    ditandatangani semua pihak dan dibubuhi cap.
                </div>
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="flex text-md justify-center ml-2 mt-1">
                        <div>
                            <label class="flex w-full justify-center font-semibold">PIHAK PERTAMA,</label>
                            <label class="flex w-full justify-center font-semibold">PT. XL Axiata Tbk.</label>
                            <label
                                class="flex w-full justify-center font-semibold mt-20 border-b-2 border-black">............................................................</label>
                        </div>
                    </div>
                    <div class="flex text-md justify-center ml-2 mt-1">
                        <div>
                            <label class="flex w-full justify-center font-semibold">PIHAK KEDUA,</label>
                            <label class="flex w-full justify-center font-semibold">{{ $company->name }}</label>
                            <label class="flex w-full justify-center font-semibold mt-20 border-b-2 border-black">
                                Texun Sandy Kamboy
                            </label>
                            <label class="flex w-full justify-center">Direktur</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Body end -->
</div>
