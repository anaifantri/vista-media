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
                    <div class="flex">
                        <div class="w-[240px] border rounded-md p-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Tgl. SPK</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    value="{{ $spkDate }}" readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Design</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Ukuran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900">Bahan</label>
                                <label class="flex text-sm text-teal-900 ml-4">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Jumlah</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">No. Penjualan</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 w-28"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Tgl. Penjualan</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 w-28"
                                    value="{{ $spkDate }}" readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">No. Penawaran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 w-28"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Tgl. Penawaran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 w-28"
                                    value="{{ $spkDate }}" readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-12">Status</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 w-40"
                                    value="Free ke 12 dari 12" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-24">Finishing</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <input type="text"
                            class="flex w-[370px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                            readonly>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-24">Catatan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <textarea class="flex w-[370px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1" rows="3" readonly></textarea>
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
