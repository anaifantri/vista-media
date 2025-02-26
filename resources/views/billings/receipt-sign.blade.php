<!-- sign area start -->
<div class="flex justify-center">
    <div class="flex w-full items-center px-10 pt-2 pb-2">
        <div class="ml-4 w-[900px]">
            <div class="flex w-[500px] justify-center py-1 border-b-2 border-t-2 border-black">
                <label id="receiptTotal" class="text-4xl font-bold tracking-wider"></label>
            </div>
            <div class="w-[500px] h-[160px] border border-black mt-2 p-2">
                <label class="flex text-sm"><u>Catatan :</u></label>
                <label class="flex text-sm ml-2">1. Mohon pembayaran ditransfer ke rekening bank berikut :</label>
                <label class="flex text-sm ml-6 font-semibold">Bank BCA Cabang Hasanudin</label>
                <label class="flex text-sm ml-6 font-semibold">No. Rekening : 040 232 1111</label>
                <label class="flex text-sm ml-6 font-semibold">Atas Nama : Vista Media PT</label>
                <label class="flex text-sm ml-2">2. Pembayaran melalui cel/giro dengan mencantumkan nama
                    penerima</label>
                <label class="flex text-sm ml-6">dan baru dianggap sah setelah cek/giro dapat
                    dicairkan</label>
            </div>
        </div>
        <div class="flex w-full justify-center p-2">
            <div>
                <label class="mt-4 text-sm flex justify-center w-72">Denpasar,
                    {{ date('d') }}
                    {{ $bulan[(int) date('m')] }}
                    {{ date('Y') }}
                </label>
                <label class="text-sm flex justify-center w-72 font-semibold">{{ $company->name }}</label>
                <label class="mt-28 text-sm flex justify-center w-72 font-semibold">
                    <u>Texun Sandy Kamboy</u>
                </label>
                <label class="text-sm flex justify-center w-72">Direktur</label>

            </div>
        </div>
    </div>
</div>
<!-- sign area end -->
