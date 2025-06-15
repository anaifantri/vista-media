@if ($content->bast == true)
    <div id="bast" class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
        <div class="p-2 m-4 border-4 rounded-md border-black h-[1280px]">
            <div class="p-4 border-2 rounded-md border-black h-full">
                <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-4">
                    <u>BERITA ACARA SERAH TERIMA</u>
                </label>
                <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider">
                    Nomor : {{ $work_report->number }}
                </label>
                <div class="p-4">
                    <div class="flex text-md items-center ml-2 mt-4">
                        <label>Yang bertandatangan di bawah ini :</label>
                    </div>
                    <div class="flex text-md ml-2 mt-2">
                        <label class="ml-6">1.</label>
                        <label class="px-1 ml-4 text-justify w-[725px]">{{ $content->first }}</label>
                    </div>
                    <div class="flex text-md ml-2 mt-2">
                        <label class="ml-6">2.</label>
                        <label class="px-1 ml-4 text-justify w-[725px]">{{ $content->second }}</label>
                    </div>
                    <div class="flex text-md items-center ml-2 mt-4">
                        <label class="text-justify w-[780px]">Bersama ini Pihak Pertama dan Pihak Kedua telah
                            Bersama-sama
                            melaksanakan Pemeriksaan pekerjaan Pemasangan atas Surat Perjanjian Kerja Sama Penempatan
                            Media
                            dengan rincian sebagai berikut :</label>
                    </div>
                    <div class="flex text-md ml-2 mt-2">
                        <label class="ml-14 w-36">Nomor perjanjian</label>
                        <label>:</label>
                        <label class="ml-4">{{ $content->agreement_number }}</label>
                    </div>
                    <div class="flex text-md ml-2 mt-2">
                        <label class="ml-14 w-36">Jenis Reklame</label>
                        <label>:</label>
                        <label class="ml-2">{{ $content->type }}</label>
                    </div>
                    <div class="flex text-md ml-2 mt-2">
                        <label class="ml-14 w-36">Lokasi</label>
                        <label>:</label>
                        <label class="ml-2">{{ $content->location_address }}</label>
                    </div>
                    <div class="flex text-md ml-2 mt-2">
                        <label class="ml-14 w-36">Ukuran</label>
                        <label>:</label>
                        <label class="ml-2">{{ $content->location_size }}</label>
                    </div>
                    <div class="flex text-md ml-2 mt-2">
                        <label class="ml-14 w-36">Jenis Penerangan</label>
                        <label>:</label>
                        <label class="ml-4">{{ $content->location_lighting }}</label>
                    </div>
                    <div class="flex text-md items-center ml-2 mt-4">
                        <label class="text-justify w-[780px]">Dari hasil pemeriksaan tersebut diatas dinyatakan
                            pekerjaan
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
                    <div class="flex text-md justify-center ml-2 mt-1">
                        <div>
                            <label class="flex w-full justify-center font-semibold">PIHAK KEDUA,</label>
                            <label class="flex w-full justify-center font-semibold">
                                @if ($client->type == 'Perusahaan')
                                    {{ $client->company }}
                                @else
                                    {{ $client->name }}
                                @endif
                            </label>
                            <label
                                class="flex w-full justify-center font-semibold mt-20 border-b-2 border-black">{{ $content->second_contact }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($content->lpj == true)
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
                    <label class="ml-2">{{ $content->date }}</label>
                </div>
                <div class="flex mt-2">
                    <label class="w-52">Nomor SPK/SPKS</label>
                    <label>:</label>
                    @if ($content->agreement_number != '')
                        <label class="ml-2">{{ $content->agreement_number }}</label>
                    @else
                        <label class="ml-2">-</label>
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
                    <label class="ml-2">{{ $content->type }}</label>
                </div>
                <div class="flex mt-2">
                    <label class="w-52">Brand</label>
                    <label>:</label>
                    <label class="ml-2">{{ $content->brand }}</label>
                </div>
                <div class="flex mt-2">
                    <label class="w-52">Lokasi</label>
                    <label>:</label>
                    <label class="ml-2">{{ $content->location_address }}</label>
                </div>
                <div class="flex mt-2">
                    <label class="w-52">Tanggal mulai</label>
                    <label>:</label>
                    <label class="ml-2">{{ $content->lpj_start }}</label>
                    <label class="ml-56">Tanggal selesai</label>
                    <label class="ml-2">:</label>
                    <label class="ml-2">{{ $content->lpj_end }}</label>
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
                        <td class="border px-1 text-center align-top">{{ $content->location_size }}</td>
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
                        <label
                            class="flex w-full justify-center font-semibold mt-20 border-b-2 border-black">.........................................................</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
