<div id="bast" class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    <div class="p-4 m-4 h-[1280px]">
        <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider mt-4">
            BERITA ACARA PENYERAHAN PEKERJAAN
        </label>
        <label class="flex justify-center w-full text-xl font-serif font-bold tracking-widermt-2">
            Nomor : Penomoran otomatis
        </label>
        <div class="flex mt-6 ml-6">
            <label class="w-40">Tanggal BAST</label>
            <label>:</label>
            <form
                action="/work-reports/select-format/{{ $sale->id }}/{{ $install_order->id }}/{{ $first_photo->id }}/{{ $first_title }}/{{ $second_photo->id }}/{{ $second_title }}/{{ $bast_category }}">
                <input type="date" class="ml-2 outline-none px-2 border rounded-md" value="{{ $content->date }}"
                    onchange="submit()" name="bast_date">
            </form>
        </div>
        <div class="p-4">
            <div class="flex text-md items-center ml-2 mt-4">
                <label>Pada hari ini {{ hari_ini($content->date) }} telah dilaksankan serah terima pekerjaan :</label>
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-28 ml-5">Nomor PO</label>
                <label class="">:</label>
                <label class="ml-2">{{ $content->po_number }}</label>
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-28 ml-5">Tanggal PO</label>
                <label class="">:</label>
                <label class="ml-2">{{ $content->po_date }}</label>
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-28 ml-5">Pekerjaan</label>
                <label class="">:</label>
                <input type="text" class="ml-2 outline-none px-1 border rounded-md w-[610px]"
                    value="{{ $content->type }}">
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-28 ml-5">Lokasi</label>
                <label class="">:</label>
                <input type="text" class="ml-2 outline-none px-1 border rounded-md w-[610px]"
                    value="{{ $product->address }}">
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
                                <textarea rows="3" class="outline-none border rounded-md w-full px-1 text-justify"
                                    onchange="changePmlrDetail(this)">{{ $content->detail[0] }}</textarea>
                            </td>
                            <td class="border border-black text-center">1</td>
                            <td class="border border-black">
                                <div class="flex w-full justify-center">
                                    <input id="cbPmlr" type="checkbox" class="outline-none text-center" checked
                                        onclick="changePmlr(this)">
                                    <label class="ml-1">pilih</label>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-md text-sans">
                            <td class="border border-black text-center">2.</td>
                            <td class="border border-black">
                                <textarea rows="3" class="outline-none border rounded-md w-full px-1 text-justify"
                                    onchange="changeTaxDetail(this)">{{ $content->detail[1] }}</textarea>
                            </td>
                            <td class="border border-black text-center">1</td>
                            <td class="border border-black">
                                <div class="flex w-full justify-center">
                                    <input id="cbTax" type="checkbox" class="outline-none text-center" checked
                                        onclick="changeTax(this)">
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
                        value="{{ $content->first_contact }}" onchange="changeFirstContact(this)">
                    <input type="text" class="flex outline-none px-1 border rounded-md"
                        value="Jabatan : {{ $content->first_contact_title }}" onchange="changeFirstContactTitle(this)">
                </div>
            </div>
            <div class="flex text-md justify-center items-center ml-2 mt-1">
                <div>
                    <label class="flex w-full">Pihak Kedua,</label>
                    <label class="flex w-full mt-20 border-b-2 border-black">{{ $content->second_contact }}</label>
                    <label class="flex w-full">Jabatan : {{ $content->first_contact_title }}</label>
                </div>
            </div>
        </div>
        <div class="mx-32 mt-10">
            <label class="flex w-full">Mengetahui,</label>
            <input type="text"
                class="flex outline-none w-[420px] px-1 border rounded-md mt-20 border-b-2 border-black"
                value="{{ $content->known_contact }}" onchange="changeKnownContact(this)">
            <input type="text" class="flex outline-none w-[420px] px-1 border rounded-md"
                value="Jabatan : {{ $content->known_contact_title }}" onchange="changeKnownContactTitle(this)">
        </div>
    </div>
</div>
