<div id="bast" class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    <div class="p-4 m-4 h-[1280px]">
        <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider mt-4">
            BERITA ACARA PENYERAHAN PEKERJAAN
        </label>
        <label class="flex justify-center w-full text-xl font-serif font-bold tracking-widermt-2">
            Nomor : {{ $work_report->number }}
        </label>
        <div class="p-4">
            <div class="flex text-md items-center ml-2 mt-6">
                <label>Pada hari ini {{ hari_ini($content->date) }} telah dilaksankan serah terima pekerjaan :</label>
            </div>
            <div class="flex text-md items-center ml-2 mt-6">
                <label class="w-28 ml-5">Nomor PO</label>
                <label class="">:</label>
                <input id="poNumber" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                    value="{{ $content->po_number }}" onchange="changePoNumber(this)" required>
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-28 ml-5">Tanggal PO</label>
                <label class="">:</label>
                <input id="poDate" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                    value="{{ $content->po_date }}" onchange="changePoDate(this)" required>
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-28 ml-5">Pekerjaan</label>
                <label class="">:</label>
                <input id="bastType" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                    value="{{ $content->type }}" onchange="changeType(this)">
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-28 ml-5">Lokasi</label>
                <label class="">:</label>
                <input id="locationAddress" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                    value="{{ $content->location_address }}" onchange="changeLocationAddress(this)" required>
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-28 ml-5">Quantity</label>
                <label class="">:</label>
            </div>
            <div class="flex justify-center items-center ml-2 mt-4">
                <table class="table-auto w-[780px]">
                    <thead>
                        <tr class="text-md text-sans">
                            <th class="w-10 border border-black">No.</th>
                            <th class="border border-black">Keterangan</th>
                            <th class="w-28 border border-black">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($content->pmlr == true && $content->tax == true)
                            <tr class="text-md text-sans">
                                <td class="border border-black text-center">1.</td>
                                <td class="border border-black px-1 text-justify">
                                    <textarea rows="2" class="border rounded-lg outline-none text-justify px-1 w-full"
                                        onchange="changePmlrDetail(this)">{{ $content->detail[0] }}</textarea>
                                </td>
                                <td class="border border-black text-center">
                                    <input type="number" class="w-10 border rounded-md outline-none px-1 text-center"
                                        value="{{ $content->pmlr_qty }}" onchange="changePmlrQty(this)">
                                </td>
                            </tr>
                            <tr class="text-md text-sans">
                                <td class="border border-black text-center">2.</td>
                                <td class="border border-black px-1 text-justify">
                                    <textarea rows="2" class="border rounded-lg outline-none text-justify px-1 w-full"
                                        onchange="changeTaxDetail(this)">{{ $content->detail[1] }}</textarea>
                                </td>
                                <td class="border border-black text-center">
                                    <input type="number" class="w-10 border rounded-md outline-none px-1 text-center"
                                        value="{{ $content->tax_qty }}" onchange="changeTaxQty(this)">
                                </td>
                            </tr>
                        @elseif ($content->pmlr == true && $content->tax == false)
                            <tr class="text-md text-sans">
                                <td class="border border-black text-center">1.</td>
                                <td class="border border-black px-1 text-justify">
                                    <textarea rows="2" class="border rounded-lg outline-none text-justify px-1 w-full"
                                        onchange="changePmlrDetail(this)">{{ $content->detail[0] }}</textarea>
                                </td>
                                <td class="border border-black text-center">
                                    <input type="number" class="w-10 border rounded-md outline-none px-1 text-center"
                                        value="{{ $content->pmlr_qty }}" onchange="changePmlrQty(this)">
                                </td>
                            </tr>
                        @elseif ($content->pmlr == false && $content->tax == true)
                            <tr class="text-md text-sans">
                                <td class="border border-black text-center">1.</td>
                                <td class="border border-black px-1 text-justify">
                                    <textarea rows="2" class="border rounded-lg outline-none text-justify px-1 w-full"
                                        onchange="changeTaxDetail(this)">{{ $content->detail[1] }}</textarea>
                                </td>
                                <td class="border border-black text-center">
                                    <input type="number" class="w-10 border rounded-md outline-none px-1 text-center"
                                        value="{{ $content->tax_qty }}" onchange="changeTaxQty(this)">
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center text-md items-center ml-2 mt-6">
                <label class="w-[800px] text-justify">Dengan ini Pihak Kedua menyatakan bahwa telah melaksanakan seluruh
                    kewajiban pekerjaan dengan baik sesuai kesepakatan dengan Pihak Pertama.</label>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-10">
            <div class="flex text-md justify-center ml-2 mt-1">
                <div>
                    <label class="flex w-max">Pihak Pertama,</label>
                    <input type="text" class="flex mt-20 px-1 border rounded-lg outline-none"
                        onchange="changeFirstContact(this)" value="{{ $content->first_contact }}">
                    <div class="flex">
                        <label for="flex">Jabatan :</label>
                        <input type="text" class="flex px-1 border rounded-lg outline-none ml-2"
                            onchange="changeFirstContactTitle(this)" value="{{ $content->first_contact_title }}">
                    </div>
                </div>
            </div>
            <div class="flex text-md justify-center items-center ml-2 mt-1">
                <div>
                    <label class="flex w-max">Pihak Kedua,</label>
                    <label class="flex w-max mt-20 border-b-2 border-black">{{ $content->second_contact }}</label>
                    <label class="flex w-max">Jabatan : {{ $content->second_contact_title }}</label>
                </div>
            </div>
        </div>
        <div class="mx-20 mt-10">
            <label class="flex w-max">Mengetahui,</label>
            <input type="text" class="flex mt-20 px-1 border rounded-lg outline-none"
                onchange="changeKnownContact(this)" value="{{ $content->known_contact }}">
            <input type="text" class="flex px-1 border rounded-lg outline-none w-[420px]"
                onchange="changeKnownContactTitle(this)" value="{{ $content->known_contact_title }}">
        </div>
    </div>
</div>
