<div>
    <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-4">
        <u>INVOICE</u>
    </label>
    <div class="flex mt-4">
        <div class="w-[380px] h-[200px] border rounded-lg p-1">
            <div class="flex items-center ml-2">
                <label class="text-lg w-24">Nomor</label>
                <label class="text-lg">:</label>
                <label class="text-lg font-mono font-semibold ml-2">001/INV/VM/II-2025</label>
            </div>
            <div class="flex items-center ml-2">
                <label class="text-lg w-24">Tanggal</label>
                <label class="text-lg">:</label>
                <label class="text-lg font-mono font-semibold ml-2">01 Februari 2025</label>
            </div>
            <div class="mt-2">
                <label class="text-lg ml-2 font-semibold">
                    <u>Dokumen :</u>
                </label>
            </div>
            <div class="flex text-md ml-2 mt-1">
                <label class="w-40">No. PO/Approval</label>
                <label class="">:</label>
                <label class="ml-2">-</label>
            </div>
            <div class="flex text-md ml-2">
                <label class="w-40">Tgl. PO/Approval</label>
                <label class="">:</label>
                <label class="ml-2">-</label>
            </div>
            <div class="flex text-md ml-2">
                <label class="w-40">No. Perjanjian</label>
                <label class="">:</label>
                <label class="ml-2">-</label>
            </div>
            <div class="flex text-md ml-2">
                <label class="w-40">Tgl. Perjanjian</label>
                <label class="">:</label>
                <label class="ml-2">-</label>
            </div>
        </div>
        <div class="w-[380px] h-[190px] border rounded-lg p-1 ml-2">
            <label class="text-lg font-mono font-semibold ml-2">Kepada Yth.</label>
            <div class="flex ml-2">
                <label class="text-md w-24">Nama</label>
                <label class="text-md">:</label>
                <label class="text-md ml-2 font-semibold">-</label>
            </div>
            <div class="flex ml-2">
                <label class="text-md w-24">Perusahaan</label>
                <label class="text-md">:</label>
                <label class="text-md ml-2 font-semibold">-</label>
            </div>
            <div class="flex ml-2">
                <label class="text-md w-24">Alamat</label>
                <label class="text-md">:</label>
                <label class="text-md ml-2 w-[250px] h-12">jjjjjjjjjjjjjkkk
                    kkkkkkk
                    kkkkk
                    kkkkk
                    kkkkkk kkkkkk kkk -</label>
            </div>
            <div class="flex ml-2">
                <label class="text-md w-24">No. Telp.</label>
                <label class="text-md">:</label>
                <label class="text-md ml-2">-</label>
            </div>
            <div class="flex ml-2">
                <label class="text-md w-24">Email</label>
                <label class="text-md">:</label>
                <label class="text-md ml-2">-</label>
            </div>
        </div>
    </div>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="text-sm">
                <th class="border h-8 w-8">No.</th>
                <th class="border h-8 ">Deskripsi</th>
                <th class="border h-8 w-16">Jumlah</th>
                <th class="border h-8 w-28">Harga</th>
                <th class="border h-8 w-32">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-sm">
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
            </tr>
            <tr class="text-sm">
                <td class="border px-4" colspan="3" rowspan="4">
                    <u>Pembayaran :</u>
                    <div class="flex">
                        <label class="w-20">No. Rek.</label>
                        <label>:</label>
                        <label class="ml-2 font-semibold">040 232 111</label>
                    </div>
                    <div class="flex">
                        <label class="w-20">Nama</label>
                        <label>:</label>
                        <label class="ml-2 font-semibold">VISTA MEDIA PT</label>
                    </div>
                    <div class="flex">
                        <label class="w-20">Bank</label>
                        <label>:</label>
                        <label class="ml-2 font-semibold">BCA Cabang Hasanudin, Denpasar - Bali</label>
                    </div>
                </td>
                <td class="border text-right px-1 font-semibold">SUB TOTAL</td>
                <td class="border text-right"></td>
            </tr>
            <tr class="text-sm">
                <td class="border text-right px-1 font-semibold">DISKON</td>
                <td class="border text-right"></td>
            </tr>
            <tr class="text-sm">
                <td class="border text-right px-1 font-semibold">PPN</td>
                <td class="border text-right"></td>
            </tr>
            <tr class="text-sm">
                <td class="border text-right px-1 font-semibold">GRAND TOTAL</td>
                <td class="border text-right"></td>
            </tr>
        </tbody>
    </table>
    <label class="mt-4 text-sm flex justify-center w-72">Hormat kami,</label>
    <label class="text-sm flex justify-center w-72 font-semibold">{{ $company->name }}</label>
    <label class="mt-16 text-sm flex justify-center w-72 font-semibold">
        <u>Texun Sandy Kamboy</u>
    </label>
    <label class="text-sm flex justify-center w-72">Direktur</label>
</div>
