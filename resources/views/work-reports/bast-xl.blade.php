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
                    <label class="flex justify-center w-full mt-2">General Term ands</label>
                    <label class="flex justify-center w-full">dan</label>
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
                Pada hari ini {{ hari_ini() }} bertempat di Jakarta antara pihak-pihak :
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
                Berdasarkan perjanjian
                .................................................................................., maka :
            </div>
            <div class="flex ml-10">
                <label>1. </label>
                <textarea class="ml-2 outline-none border rounded-md text-justify w-[750px]" rows="2">Vista Media, telah menyelesaikan pekerjaan Media Luar Ruang di Site {{ $content->location_address }} sesuan dengan SP3 tanggal ..............</textarea>
            </div>
            <div class="flex ml-10">
                <label>2. </label>
                <textarea class="ml-2 outline-none border rounded-md text-justify w-[750px]" rows="2">XL telah menerima Media Luar Ruang tersebut dalam keadaan baik dan dapat dipergunakan sebagaimana dimaksud yaitu dengan cara membayar Media Luar Ruang kepada Vista Media</textarea>
            </div>
            <div class="flex ml-10">
                <label>3. </label>
                <textarea class="ml-2 outline-none border rounded-md text-justify w-[750px]" rows="2">Sesuai dengan Berita Acara Serah Terima ini diterbitkan, maka masa Media Luar Ruang dimulai dari tanggal {{ $content->periode }}.</textarea>
            </div>
            <div class="font-sans mt-2 w-full">
                Berita Acara Serah Terima ini dibuat dalam rangkap 2 (dua) asli, masing-masing sama memiliki bunyi yang
                sama diatas kertas bermaterai cukup serta mempunyai kekuatan hukum yang sama setelah ditandatangani
                semua pihak dan dibubuhi cap.
            </div>
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="flex text-md justify-center items-center ml-2 mt-1">
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

<!-- Footer start -->
<!-- Footer end -->
