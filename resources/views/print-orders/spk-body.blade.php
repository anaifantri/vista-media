@php
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $spkDate = date('d') . ' ' . $bulan[(int) date('m')] . ' ' . date('Y');
@endphp
<div class="h-[330px] mt-5">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full mt-2"><u>SPK CETAK GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">Nomor : penomoroan otomatis </label>
            <div class="flex justify-center w-full mt-4">
                <div class="w-[500px] border p-3">
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Tgl. SPK</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <input type="text"
                            class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                            value="{{ $spkDate }}" readonly>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Design/Tema</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <input type="text"
                            class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1">
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Ukuran</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <input type="text"
                            class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1">
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Bahan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <select
                            class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 w-[170px]"></select>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Jumlah</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <input type="text"
                            class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1">
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Finishing</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <input type="text"
                            class="flex w-[350px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1">
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Catatan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <textarea class="flex w-[350px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1" rows="3"></textarea>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <input class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-full"
                        type="file" onchange="previewImage(this)">
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[200px]"
                            src="/img/photo_profile.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
