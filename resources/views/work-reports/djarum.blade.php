<div class="flex text-md font-bold mt-4 text-white">
    <input id="bastDjarumStatus" type="checkbox" class="outline-none" onclick="changeBastDjarumStatus(this)" checked>
    <span class="ml-2">BAST</span>
    <input id="lpjDjarumStatus" type="checkbox" class="outline-none ml-6" onclick="changeLpjDjarumStatus(this)" checked>
    <span class="ml-2">LPJ</span>
</div>
<div id="divBastDjarum" class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    <div class="p-2 m-4 border-4 rounded-md border-black h-[1280px]">
        <div class="p-4 border-2 rounded-md border-black h-full">
            <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-4">
                <u>BERITA ACARA SERAH TERIMA</u>
            </label>
            <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider">
                Nomor : Penomoran otomatis
            </label>
            <div class="flex mt-6 ml-6">
                <label class="w-40">Tanggal BAST</label>
                <label>:</label>
                <form
                    action="/work-reports/select-format/{{ $sale->id }}/{{ $main_sale_id }}/{{ $content->install_order_id }}/{{ $first_photos->id }}/{{ $first_photos->title }}/{{ $second_photos->id }}/{{ $second_photos->title }}/{{ $bast_category }}">
                    <input id="djarumDate" type="date" class="ml-2 outline-none px-2 border rounded-md"
                        value="{{ $content->date }}" onchange="submit()" name="bast_date">
                </form>
            </div>
            <div class="p-4">
                <div class="flex text-md items-center ml-2 mt-4">
                    <label>Yang bertandatangan di bawah ini :</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-6">1.</label>
                    <textarea rows="3" class="px-1 ml-4 text-justify w-[725px] border rounded-md outline-none" readonly>{{ $content->first }}</textarea>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-6">2.</label>
                    <textarea rows="3" class="px-1 ml-4 text-justify w-[725px] border rounded-md outline-none"
                        onchange="changeSecond(this)">{{ $content->second }}</textarea>
                </div>
                <div class="flex text-md items-center ml-2 mt-4">
                    <label class="text-justify w-[780px]">Bersama ini Pihak Pertama dan Pihak Kedua telah Bersama-sama
                        melaksanakan Pemeriksaan pekerjaan Pemasangan atas Surat Perjanjian Kerja Sama Penempatan Media
                        dengan rincian sebagai berikut :</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Nomor perjanjian</label>
                    <label>:</label>
                    @if ($content->agreement_number != '')
                        <input id="bastAgreement" type="text" value="{{ $content->agreement_number }}"
                            class="outline-none border rounded-md w-[550px] ml-2 px-1"
                            onchange="changeDjarumAgreement(this, 'bast')">
                    @else
                        <input id="bastAgreement" type="text"
                            class="outline-none border rounded-md w-[550px] ml-2 px-1"
                            onchange="changeDjarumAgreement(this, 'bast')">
                    @endif
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Jenis Reklame</label>
                    <label>:</label>
                    <input type="text" class="ml-2 outline-none px-1 border rounded-md w-[150px]"
                        value="{{ $product->category }}">
                    <label class="ml-20 w-36">Total Titik</label>
                    <label>:</label>
                    <input type="text" class="ml-2 outline-none px-1 border rounded-md w-40"
                        value="{{ $content->djarum_qty }}" onchange="changeDjarumQty(this)">
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Lokasi</label>
                    <label>:</label>
                    <input id="bastLocation" type="text" class="ml-2 outline-none px-1 border rounded-md w-[550px]"
                        value="{{ $product->address }}" onchange="changeDjarumLocation(this, 'bast')">
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Ukuran</label>
                    <label>:</label>
                    <label class="ml-4">{{ $content->location_size }}</label>
                </div>
                <div class="flex text-md ml-2 mt-2">
                    <label class="ml-14 w-36">Jenis Penerangan</label>
                    <label>:</label>
                    <label class="ml-4">{{ $content->location_lighting }}</label>
                </div>
                <div class="flex text-md items-center ml-2 mt-4">
                    <label class="text-justify w-[780px]">Dari hasil pemeriksaan tersebut diatas dinyatakan pekerjaan
                        pemasangan materi diatas telah selesai dikerjakan dengan baik dan berfungsi sesuai dengan
                        kontrak
                        pada Hari
                        @php
                            echo '<b>' . hari_ini($content->date) . '</b>';
                        @endphp
                        dibuktikan dengan Foto Dokumentasi pada saat siang dan
                        malam hari.</label>
                </div>
                <div class="flex text-md items-center ml-2 mt-4">
                    <label class="text-justify w-[780px]">Demikianlah Berita Acara Serah Terima Pekerjaan ini dibuat
                        dengan
                        sebenarnya untuk dapat digunakan sebagaimana mestinya.</label>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="flex text-md justify-center ml-2 mt-1">
                    <div>
                        <label class="flex w-full justify-center font-semibold">PIHAK PERTAMA,</label>
                        <label class="flex w-full justify-center font-semibold">{{ $company->name }}</label>
                        <label
                            class="flex w-full justify-center font-semibold mt-20 border-b-2 border-black">{{ $content->first_contact }}</label>
                        <label class="flex w-full justify-center">Direktur</label>
                    </div>
                </div>
                <div class="flex text-md justify-center items-center ml-2 mt-1">
                    <div>
                        <label class="flex w-full justify-center font-semibold">PIHAK KEDUA,</label>
                        <label class="flex w-full justify-center font-semibold">
                            @if ($client->type == 'Perusahaan')
                                {{ $client->company }}
                            @else
                                {{ $client->name }}
                            @endif
                        </label>
                        <input type="text"
                            class="flex text-center outline-none px-1 border rounded-md mt-20 border-b-2 border-black"
                            value="{{ $content->second_contact }}" onchange="changeSecondContact(this)">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="divLpjDjarum" class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    <div class="p-4 h-full">
        <label
            class="flex justify-center w-full text-2xl font-bold tracking-wider mt-4 p-1 border bg-blue-600 text-white">LAPORAN
            PEMBELIAN JASA</label>
        <div class="mt-4 border border-black w-full px-6 py-2 text-sm">
            <div class="flex">
                <label class="w-52">Nama Vendor</label>
                <label>:</label>
                <label class="ml-2">{{ $company->name }}</label>
            </div>
            <div class="flex mt-2">
                <label class="w-52">Tanggal Laporan</label>
                <label>:</label>
                <input type="date" class="ml-2 outline-none px-2 border rounded-md" value="{{ $content->date }}"
                    onchange="changeLpjDate(this)">
            </div>
            <div class="flex mt-2">
                <label class="w-52">Nomor SPK/SPKS</label>
                <label>:</label>
                @if ($content->agreement_number != '')
                    <input id="lpjAgreement" type="text" value="{{ $content->agreement_number }}"
                        class="outline-none border rounded-md w-[350px] ml-2 px-1"
                        onchange="changeDjarumAgreement(this, 'lpj')">
                @else
                    <input id="lpjAgreement" type="text"
                        class="outline-none border rounded-md w-[350px] ml-2 px-1"
                        onchange="changeDjarumAgreement(this, 'lpj')">
                @endif

            </div>
        </div>
        <label
            class="flex justify-center w-full text-md font-bold tracking-wider mt-4 p-1 border bg-blue-600 text-white">URAIAN
            PEKERJAAN</label>
        <div class="mt-4 border border-black w-full px-6 py-2 text-sm">
            <div class="flex">
                <label class="w-52">Nama Jasa</label>
                <label>:</label>
                <input type="text" class="ml-2 outline-none w-[450px] border rounded-md px-1"
                    value="{{ $content->type }}" placeholder="Input Brand" onchange="changeType(this)">
            </div>
            <div class="flex mt-2">
                <label class="w-52">Brand</label>
                <label>:</label>
                <input id="lpjBrand" type="text" class="ml-2 outline-none w-[450px] border rounded-md px-1"
                    value="{{ $content->brand }}" placeholder="Input Brand" onchange="changeBrand(this)">
            </div>
            <div class="flex mt-2">
                <label class="w-52">Lokasi</label>
                <label>:</label>
                <input id="lpjLocation" type="text" class="ml-2 outline-none w-[450px] border rounded-md px-1"
                    value="{{ $content->location_address }}" placeholder="Input Lokasi"
                    onchange="changeDjarumLocation(this, 'lpj')">
                <label class="ml-2"></label>

            </div>
            <div class="flex mt-2">
                <label class="w-52">Tanggal mulai</label>
                <label>:</label>
                @if ($bast_category == 'Media')
                    <input type="date" class="ml-2 border rounded-md" value="{{ $content->lpj_start }}"
                        onchange="changeLpjStart(this)">
                @else
                    <input type="date" class="ml-2 border rounded-md" onchange="changeLpjStart(this)">
                @endif
                <label class="ml-56">Tanggal selesai</label>
                <label class="ml-2">:</label>
                @if ($bast_category == 'Media')
                    <input type="date" class="ml-2 border rounded-md" value="{{ $content->lpj_end }}"
                        onchange="changeLpjEnd(this)">
                @else
                    <input type="date" class="ml-2 border rounded-md" onchange="changeLpjEnd(this)">
                @endif
            </div>
        </div>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="text-sm">
                    <th class="border w-8">No.</th>
                    <th class="border w-44">Jenis Pekerjaan</th>
                    <th class="border w-24">Jenis Materi</th>
                    <th class="border w-40">Brand</th>
                    <th class="border w-40">Versi</th>
                    <th class="border w-20">Ukuran</th>
                    <th class="border w-16">Jumlah</th>
                    <th class="border w-16">Satuan</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-sm">
                    <td class="border px-1 text-center align-top">1</td>
                    <td class="border px-1 align-top">{{ $content->type }}</td>
                    <td class="border px-1 text-center align-top">{{ $content->location_lighting }}</td>
                    <td id="tdBrand" class="border px-1 align-top">{{ $content->theme }}</td>
                    <td class="border px-1 align-top">
                        <textarea type="text" class="outline-none w-full" rows="4" onchange="changeTheme(this)">{{ $content->theme }}</textarea>
                    </td>
                    <td class="border px-1 text-center align-top">{{ $product->size }}</td>
                    <td class="border px-1 text-center align-top">
                        <input type="number" class="outline-none in-out-spin-none w-full text-center"
                            value="1">
                    </td>
                    <td class="border px-1 text-center align-top">Unit</td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">2</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">3</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">4</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">5</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">6</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">7</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">8</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">9</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">10</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">11</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
                <tr class="text-sm">
                    <td class="border text-center">12</td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                    <td class="border text-center"></td>
                </tr>
            </tbody>
        </table>
        <label
            class="flex justify-center w-full text-md font-bold tracking-wider mt-4 p-1 border bg-blue-600 text-white">CATATAN
            PEKERJAAN</label>
        <div class="mt-4 border border-black w-full p-2 text-sm">
            <div class="flex w-full justify-center px-4">
                <input type="text" class="w-full outline-none border-b">
            </div>
            <div class="flex w-full justify-center px-4">
                <input type="text" class="w-full outline-none border-b">
            </div>
            <div class="flex w-full justify-center px-4">
                <input type="text" class="w-full outline-none border-b">
            </div>
            <div class="flex w-full justify-center px-4">
                <input type="text" class="w-full outline-none border-b">
            </div>
            <div class="flex w-full justify-center px-4">
                <input type="text" class="w-full outline-none border-b">
            </div>
            <div class="flex w-full justify-center px-4">
                <input type="text" class="w-full outline-none border-b">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-6">
            <div class="flex text-md justify-center ml-2 mt-1">
                <div>
                    <label class="flex w-full justify-center font-semibold">Pembuat Laporan,</label>
                    <label class="flex w-full justify-center font-semibold">{{ $company->name }}</label>
                    <label
                        class="flex w-full justify-center font-semibold mt-20 border-b-2 border-black">{{ $content->first_contact }}</label>
                    <label class="flex w-full justify-center">Direktur</label>
                </div>
            </div>
            <div class="flex text-md justify-center items-center ml-2 mt-1 ">
                <div>
                    <label class="flex w-full justify-center font-semibold">Mengetahui,</label>
                    <label class="flex w-full justify-center font-semibold">
                        @if ($client->type == 'Perusahaan')
                            {{ $client->company }}
                        @else
                            {{ $client->name }}
                        @endif
                    </label>
                    <input type="text" class="flex text-center outline-none px-1 mt-20 border-b-2 border-black"
                        placeholder="........................................................."
                        onchange="changeSecondContact(this)">
                </div>
            </div>
        </div>
    </div>
</div>
