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
                <textarea class="flex outline-none mt-1 text-justify w-[800px]" rows="5">Dengan ini diberitahukan bahwa order XL untuk Media Luar Ruang di site {{ $content->location_address }} ("Site") sebagaimana dituangkan dalam PO# {{ $quotation_orders[0]->number }}, secara fisik telah kami selesaikan berikut dokumen-dokumen yang diperlukan, sebagaimana telah dipersyaratkan dalam perjanjian induk nomor {{ $quotation_agreements[0]->number }} yaitu dokumen :
                </textarea>
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
                Selanjutnya dengan terselesaikannya Site tersebut, kami mengundang pihak XL untuk melakukan uji terima
                penyelesaian atas Site tersebut (penandatanganan BAST) sesuai dengan mekanisme yang diatur dalam pasal 3
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

<!-- Footer start -->
<!-- Footer end -->
