<div class="p-4 m-4 h-[1280px]">
    <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider mt-4">
        BERITA ACARA PENYERAHAN PEKERJAAN
    </label>
    <label class="flex justify-center w-full text-xl font-serif font-bold tracking-widermt-2">
        Nomor : Penomoran otomatis
    </label>
    <div class="p-4">
        <div class="flex text-md items-center ml-2 mt-4">
            <label>Pada hari ini {{ hari_ini() }} telah dilaksankan serah terima pekerjaan :</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-28 ml-5">Nomor PO</label>
            <label class="">:</label>
            <label class="ml-2">
                @if (count($quotation_orders) > 0)
                    @if (count($quotation_orders) == 2)
                        {{ $quotation_orders[0]->number }} & {{ $quotation_orders[1]->number }}
                    @else
                        {{ $quotation_orders[0]->number }}
                    @endif
                @else
                    -
                @endif
            </label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-28 ml-5">Tanggal PO</label>
            <label class="">:</label>
            <label class="ml-2">
                @if (count($quotation_orders) > 0)
                    @if (count($quotation_orders) == 2)
                        {{ date('d', strtotime($quotation_orders[0]->date)) . ' ' . $fullMonth[(int) date('m', strtotime($quotation_orders[0]->date))] . ' ' . date('Y', strtotime($quotation_orders[0]->date)) }}
                        &
                        {{ date('d', strtotime($quotation_orders[1]->date)) . ' ' . $fullMonth[(int) date('m', strtotime($quotation_orders[1]->date))] . ' ' . date('Y', strtotime($quotation_orders[1]->date)) }}
                    @else
                        {{ date('d', strtotime($quotation_orders[0]->date)) . ' ' . $fullMonth[(int) date('m', strtotime($quotation_orders[0]->date))] . ' ' . date('Y', strtotime($quotation_orders[0]->date)) }}
                    @endif
                @else
                    -
                @endif
            </label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-28 ml-5">Pekerjaan</label>
            <label class="">:</label>
            <label class="ml-2">{{ $content->type }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-28 ml-5">Lokasi</label>
            <label class="">:</label>
            <label class="ml-2">{{ $content->location_address }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-28 ml-5">Quantity</label>
            <label class="">:</label>
        </div>
        <div class="flex justify-center items-center ml-2 mt-1">
            <table class="table-auto w-[700px]">
                <thead>
                    <tr class="text-md text-sans">
                        <th class="w-10 border border-black">No.</th>
                        <th class="border border-black">Keterangan</th>
                        <th class="w-16 border border-black">Jumlah</th>
                        <th class="w-16 border border-black">Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-md text-sans">
                        <td class="border border-black text-center">1.</td>
                        <td class="border border-black">
                            <textarea rows="3" class="outline-none border rounded-md w-full px-1 text-justify">PMLR {{ $product->category . ' ' . $description->lighting }}, Lokasi : {{ $content->location_address }}, Ukuran : {{ $content->location_size }}, Periode : {{ $content->periode }}</textarea>
                        </td>
                        <td class="border border-black text-center">1</td>
                        <td class="border border-black">
                            <div class="flex w-full justify-center">
                                <input type="checkbox" class="outline-none text-center">
                                <label class="ml-1">pilih</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-md text-sans">
                        <td class="border border-black text-center">2.</td>
                        <td class="border border-black">
                            <textarea rows="3" class="outline-none border rounded-md w-full px-1 text-justify">Tax {{ $product->category . ' ' . $description->lighting }}, Lokasi : {{ $content->location_address }}, Ukuran : {{ $content->location_size }}, Periode : {{ $content->periode }}</textarea>
                        </td>
                        <td class="border border-black text-center">1</td>
                        <td class="border border-black">
                            <div class="flex w-full justify-center">
                                <input type="checkbox" class="outline-none text-center">
                                <label class="ml-1">pilih</label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="flex justify-center text-md items-center ml-2 mt-4">
        <label class="w-[800px] text-justify">Dengan ini Pihak Kedua menyatakan bahwa telah melaksanakan seluruh
            kewajiban pekerjaan dengan baik sesuai kesepakatan dengan Pihak Pertama.</label>
    </div>
    <div class="grid grid-cols-2 gap-4 mt-10">
        <div class="flex text-md justify-center ml-2 mt-1">
            <div>
                <label class="flex w-full">Pihak Pertama,</label>
                <input type="text" class="flex outline-none px-1 border rounded-md mt-20 border-b-2 border-black"
                    value="Yoni Eka Sari">
                <input type="text" class="flex outline-none px-1 border rounded-md" value="Jabatan : SCE Teritory">
            </div>
        </div>
        <div class="flex text-md justify-center items-center ml-2 mt-1">
            <div>
                <label class="flex w-full">Pihak Kedua,</label>
                <label class="flex w-full mt-20 border-b-2 border-black">Texun Sandy Kamboy</label>
                <label class="flex w-full">Jabatan : Direktur</label>
            </div>
        </div>
    </div>
    <div class="mx-32 mt-10">
        <label class="flex w-full">Mengetahui,</label>
        <input type="text" class="flex outline-none w-[420px] px-1 border rounded-md mt-20 border-b-2 border-black"
            value="Raka Joe Soekarta">
        <input type="text" class="flex outline-none w-[420px] px-1 border rounded-md"
            value="Jabatan : Manager Area Consumer Engagement (MICE)">
    </div>
</div>
