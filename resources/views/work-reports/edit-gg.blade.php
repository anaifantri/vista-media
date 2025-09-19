@if ($content->bapp == true)
    <div class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    @else
        <div class="standard w-[950px] h-[1345px] mt-4 bg-white p-4" hidden>
@endif
<div class="p-4 m-4 border-2 rounded-md border-black h-[1280px]">
    <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider mt-4">
        BERITA ACARA PENYERAHAN PEKERJAAN (BAPP)
    </label>
    <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider border-b-2 border-black">
        Revisual / Kontrak setahun / Kontrak kurang dari setahun
    </label>
    <div class="p-4">
        <div class="flex text-md items-center ml-2">
            <label class="font-semibold">1.</label>
            <label class="font-semibold w-24 ml-2">Nomor</label>
            <label>:</label>
            <label class="ml-2">{{ $work_report->number }}</label>
            <label class="font-semibold w-24 ml-56">Tanggal</label>
            <label>:</label>
            <input type="date" class="ml-2 outline-none px-2 border rounded-md" value="{{ $content->date }}"
                onchange="changeDate(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">2.</label>
            <label class="font-semibold ml-2">Informasi Vendor</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Nama Perusahaan</label>
            <label class="">:</label>
            <label class="ml-4">{{ $company->name }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Alamat Perusahaan</label>
            <label class="">:</label>
            <label class="ml-4">{{ $company->address }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">No. Telepon</label>
            <label class="">:</label>
            <label class="ml-4">{{ $company->phone }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">3.</label>
            <label class="font-semibold ml-2">Purchase Order (PO)</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Tanggal PO</label>
            <label class="">:</label>
            <input id="poDate" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->po_date }}" onchange="changePoDate(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Nomor PO</label>
            <label class="">:</label>
            <input id="poNumber" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->po_number }}" onchange="changePoNumber(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">4.</label>
            <label class="font-semibold ml-2">Jenis Pekerjaan</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            @if ($content->category == 'Service')
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                    <input name="bast_sale_status" value="new" type="radio" class="outline-none"
                        onclick="changeBastSaleStatus(this)">
                </div>
                <label class="w-40 ml-2">Kontrak Baru</label>
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                    <input name="bast_sale_status" value="extend" type="radio" class="outline-none"
                        onclick="changeBastSaleStatus(this)">
                </div>
                <label class="w-40 ml-2">Perpanjangan</label>
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="bast_sale_status" value="revisual" type="radio" class="outline-none" checked
                        onclick="changeBastSaleStatus(this)">
                </div>
                <label class="w-40 ml-2">Revisual</label>
            @else
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5 font-bold text-black">
                    @if ($content->bast_sale_status == 'new')
                        <input name="bast_sale_status" value="new" type="radio" class="outline-none"
                            onclick="changeBastSaleStatus(this)" checked>
                    @else
                        <input name="bast_sale_status" value="new" type="radio" class="outline-none"
                            onclick="changeBastSaleStatus(this)">
                    @endif
                </div>
                <label class="w-40 ml-2">Kontrak Baru</label>
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5 font-bold text-black">
                    @if ($content->bast_sale_status == 'extend')
                        <input name="bast_sale_status" value="extend" type="radio" class="outline-none"
                            onclick="changeBastSaleStatus(this)" checked>
                    @else
                        <input name="bast_sale_status" value="extend" type="radio" class="outline-none"
                            onclick="changeBastSaleStatus(this)">
                    @endif
                </div>
                <label class="w-40 ml-2">Perpanjangan</label>
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    @if ($content->bast_sale_status == 'revisual')
                        <input name="bast_sale_status" value="revisual" type="radio" class="outline-none"
                            onclick="changeBastSaleStatus(this)" checked>
                    @else
                        <input name="bast_sale_status" value="revisual" type="radio" class="outline-none"
                            onclick="changeBastSaleStatus(this)">
                    @endif
                </div>
                <label class="w-40 ml-2">Revisual</label>
            @endif
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">5.</label>
            <label class="font-semibold ml-2">Deskripsi Media</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            @foreach ($ggCategories as $ggCategory)
                @if ($loop->iteration < 4)
                    @if ($ggCategory == $content->location_type)
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'LED' && $content->location_type == 'Videotron')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'JPO' && $content->location_type == 'Bando')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'Neon Box' && $content->location_type == 'Signage')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @else
                        <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                            @if ($ggCategory == 'LED')
                                <input name="location_type" value="Videotron" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @elseif ($ggCategory == 'JPO')
                                <input name="location_type" value="Bando" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @elseif ($ggCategory == 'Neon Box')
                                <input name="location_type" value="Signage" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @else
                                <input name="location_type" value="{{ $ggCategory }}" type="radio"
                                    class="outline-none" onclick="changeLocationType(this)">
                            @endif
                        </div>
                    @endif
                    <label class="w-40 ml-2">{{ $ggCategory }}</label>
                @endif
            @endforeach
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @foreach ($ggCategories as $ggCategory)
                @if ($loop->iteration > 3)
                    @if ($ggCategory == $content->location_type)
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'LED' && $content->location_type == 'Videotron')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'JPO' && $content->location_type == 'Bando')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'Neon Box' && $content->location_type == 'Signage')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @else
                        <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                            @if ($ggCategory == 'LED')
                                <input name="location_type" value="Videotron" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @elseif ($ggCategory == 'JPO')
                                <input name="location_type" value="Bando" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @elseif ($ggCategory == 'Neon Box')
                                <input name="location_type" value="Signage" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @else
                                <input name="location_type" value="{{ $ggCategory }}" type="radio"
                                    class="outline-none" onclick="changeLocationType(this)">
                            @endif
                        </div>
                    @endif
                    <label class="w-40 ml-2">{{ $ggCategory }}</label>
                @endif
            @endforeach
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Ukuran</label>
            <label class="">:</label>
            <input type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->location_size }}" onchange="changeLocationSize(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @if ($content->location_lighting == 'Backlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lighting" value="Backlight" type="radio" class="outline-none" checked
                        onclick="changeLighting(this)">
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lighting" value="Backlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)">
                </div>
            @endif
            <label class="w-40 ml-2">Back Light</label>
            @if ($content->location_lighting == 'Frontlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lighting" value="Frontlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)" checked>
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lighting" value="Frontlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)">
                </div>
            @endif
            <label class="w-40 ml-2">Front Light</label>
            @if ($content->location_lighting == 'Nonlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lighting" value="Nonlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)" checked>
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lighting" value="Nonlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)">
                </div>
            @endif
            <label class="w-40 ml-2">No Light</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @if ($content->location_orientation == 'Vertikal')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="orientation" value="Vertikal" type="radio" class="outline-none"
                        onclick="changeLocationOrientation(this)" checked>
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="orientation" value="Vertikal" type="radio" class="outline-none"
                        onclick="changeLocationOrientation(this)">
                </div>
            @endif
            <label class="w-40 ml-2">Vertical</label>
            @if ($content->location_orientation == 'Horizontal')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="orientation" value="Horizontal" type="radio" class="outline-none"
                        onclick="changeLocationOrientation(this)" checked>
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="orientation" value="Horizontal" type="radio" class="outline-none"
                        onclick="changeLocationOrientation(this)">
                </div>
            @endif
            <label class="w-40 ml-2">Horizontal</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="w-40 ml-5">Lokasi</label>
            <label class="">:</label>
            <input id="locationAddress" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->location_address }}" onchange="changeLocationAddress(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Desain Visual</label>
            <label class="">:</label>
            <input id="theme" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->theme }}" onchange="changeTheme(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Brand</label>
            <label class="">:</label>
            <input id="brand" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->brand }}" onchange="changeBrand(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">6.</label>
            <label class="font-semibold ml-2">Pemeriksaan oleh Area Office yang bertindak untuk dan atas nama
                Perusahaan Rokok Tjap Gudang Garamk</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Tanggal Pemeriksaan</label>
            <label class="">:</label>
            <label class="ml-4">...........................................................</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Jam Pemeriksaan</label>
            <label class="">:</label>
            <label class="ml-4">...........................................................</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Kondisi Fisik</label>
            <label class="w-2">:</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-[60px]">
            </div>
            <label class="w-40 ml-2">Layak</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Tidak Layak</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Kondisi Penerangan</label>
            <label class="">:</label>
            <label class="ml-4"></label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Menyala Optimal</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Mati Sebagian</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Mati Total</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Kondisi Pandangan</label>
            <label class="">:</label>
            <label class="ml-4"></label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Pandangan Bebas</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Tertutup Sebagian</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Tertutup Total</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Keterangan</label>
            <label class="">:</label>
            <label class="ml-4 h-5 border-b-2 border-dotted border-black w-[500px]"></label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5"></label>
            <label class=""></label>
            <label class="ml-5 h-5 border-b-2 border-dotted border-black w-[500px]"></label>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex text-md justify-center ml-2 mt-1">
            <div>
                <label class="flex w-full justify-center">Yang menyerahkan,</label>
                <label
                    class="flex w-full justify-center mt-20 border-b-2 border-black">{{ $bank_account->director }}</label>
                <label class="flex w-full justify-center">Direktur</label>
            </div>
        </div>
        <div class="flex text-md justify-center items-center ml-2 mt-1">
            <div>
                <label class="flex w-full justify-center">Yang menerima,</label>
                <label
                    class="flex w-full justify-center mt-20 border-b-2 border-black">............................................................</label>
            </div>
        </div>
    </div>
    <div class="flex w-full justify-center text-lg items-center ml-2 mt-20">
        <label class="font-semibold">Lampiran : Foto berwarna dan bertanggal - di saat siang dan malam</label>
    </div>
</div>
</div>
@if ($content->lep == true)
    <div class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
    @else
        <div class="standard w-[950px] h-[1345px] mt-4 bg-white p-4" hidden>
@endif
<div class="p-4 m-4 border-2 rounded-md border-black h-[1280px]">
    <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider mt-4">
        LAPORAN EVALUASI PEMANTAUAN (LEP)
    </label>
    <label class="flex justify-center w-full text-xl font-serif font-bold tracking-wider border-b-2 border-black">
        Kontrak setahun / Kontrak kurang dari setahun
    </label>
    <div class="p-4">
        <div class="flex text-md items-center ml-2">
            <label class="font-semibold">1.</label>
            <label class="font-semibold w-24 ml-2">Nomor</label>
            <label>:</label>
            <label class="ml-2">{{ $work_report->number }}</label>
            <label class="font-semibold w-24 ml-56">Tanggal</label>
            <label>:</label>
            <input type="date" class="ml-2 outline-none px-2 border rounded-md" value="{{ $content->date }}"
                onchange="changeDate(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">2.</label>
            <label class="font-semibold ml-2">Informasi Vendor</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Nama Perusahaan</label>
            <label class="">:</label>
            <label class="ml-4">{{ $company->name }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Alamat Perusahaan</label>
            <label class="">:</label>
            <label class="ml-4">{{ $company->address }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">No. Telepon</label>
            <label class="">:</label>
            <label class="ml-4">{{ $company->phone }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">3.</label>
            <label class="font-semibold ml-2">Purchase Order (PO)</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Tanggal PO</label>
            <label class="">:</label>
            <input id="poDate" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->po_date }}" onchange="changePoDate(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Nomor PO</label>
            <label class="">:</label>
            <input id="poNumber" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->po_number }}" onchange="changePoNumber(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">4.</label>
            <label class="font-semibold ml-2">Jenis Pekerjaan</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            @if ($content->category == 'Service')
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                    <input name="lep_sale_status" value="new" type="radio" class="outline-none"
                        onclick="changeLepSaleStatus(this)">
                </div>
                <label class="w-40 ml-2">Kontrak Baru</label>
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                    <input name="lep_sale_status" value="extend" type="radio" class="outline-none"
                        onclick="changeLepSaleStatus(this)">
                </div>
                <label class="w-40 ml-2">Perpanjangan</label>
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_sale_status" value="revisual" type="radio" class="outline-none" checked
                        onclick="changeLepSaleStatus(this)">
                </div>
                <label class="w-40 ml-2">Revisual</label>
            @else
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5 font-bold text-black">
                    @if ($content->lep_sale_status == 'new')
                        <input name="lep_sale_status" value="new" type="radio" class="outline-none"
                            onclick="changeLepSaleStatus(this)" checked>
                    @endif
                </div>
                <label class="w-40 ml-2">Kontrak Baru</label>
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5 font-bold text-black">
                    @if ($content->lep_sale_status == 'extend')
                        <input name="lep_sale_status" value="extend" type="radio" class="outline-none"
                            onclick="changeLepSaleStatus(this)" checked>
                    @endif
                </div>
                <label class="w-40 ml-2">Perpanjangan</label>
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_sale_status" value="revisual" type="radio" class="outline-none"
                        onclick="changeLepSaleStatus(this)">
                </div>
                <label class="w-40 ml-2">Revisual</label>
            @endif
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">5.</label>
            <label class="font-semibold ml-2">Deskripsi Media</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            @foreach ($ggCategories as $ggCategory)
                @if ($loop->iteration < 4)
                    @if ($ggCategory == $content->location_type)
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="lep_location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'LED' && $content->location_type == 'Videotron')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="lep_location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'JPO' && $content->location_type == 'Bando')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="lep_location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'Neon Box' && $content->location_type == 'Signage')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="lep_location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @else
                        <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                            @if ($ggCategory == 'LED')
                                <input name="lep_location_type" value="Videotron" type="radio"
                                    class="outline-none" onclick="changeLocationType(this)">
                            @elseif ($ggCategory == 'JPO')
                                <input name="lep_location_type" value="Bando" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @elseif ($ggCategory == 'Neon Box')
                                <input name="lep_location_type" value="Signage" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @else
                                <input name="lep_location_type" value="{{ $ggCategory }}" type="radio"
                                    class="outline-none" onclick="changeLocationType(this)">
                            @endif
                        </div>
                    @endif
                    <label class="w-40 ml-2">{{ $ggCategory }}</label>
                @endif
            @endforeach
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @foreach ($ggCategories as $ggCategory)
                @if ($loop->iteration > 3)
                    @if ($ggCategory == $content->location_type)
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="lep_location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'LED' && $content->location_type == 'Videotron')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="lep_location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'JPO' && $content->location_type == 'Bando')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="lep_location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @elseif ($ggCategory == 'Neon Box' && $content->location_type == 'Signage')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            <input name="lep_location_type" value="{{ $content->location_type }}" type="radio"
                                class="outline-none" onclick="changeLocationType(this)" checked>
                        </div>
                    @else
                        <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                            @if ($ggCategory == 'LED')
                                <input name="lep_location_type" value="Videotron" type="radio"
                                    class="outline-none" onclick="changeLocationType(this)">
                            @elseif ($ggCategory == 'JPO')
                                <input name="lep_location_type" value="Bando" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @elseif ($ggCategory == 'Neon Box')
                                <input name="lep_location_type" value="Signage" type="radio" class="outline-none"
                                    onclick="changeLocationType(this)">
                            @else
                                <input name="lep_location_type" value="{{ $ggCategory }}" type="radio"
                                    class="outline-none" onclick="changeLocationType(this)">
                            @endif
                        </div>
                    @endif
                    <label class="w-40 ml-2">{{ $ggCategory }}</label>
                @endif
            @endforeach
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Ukuran</label>
            <label class="">:</label>
            <input type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->location_size }}" onchange="changeLocationSize(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @if ($content->location_lighting == 'Backlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_lighting" value="Backlight" type="radio" class="outline-none" checked
                        onclick="changeLighting(this)">
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_lighting" value="Backlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)">
                </div>
            @endif
            <label class="w-40 ml-2">Back Light</label>
            @if ($content->location_lighting == 'Frontlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_lighting" value="Frontlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)" checked>
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_lighting" value="Frontlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)">
                </div>
            @endif
            <label class="w-40 ml-2">Front Light</label>
            @if ($content->location_lighting == 'Nonlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_lighting" value="Nonlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)" checked>
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_lighting" value="Nonlight" type="radio" class="outline-none"
                        onclick="changeLighting(this)">
                </div>
            @endif
            <label class="w-40 ml-2">No Light</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @if ($content->location_orientation == 'Vertikal')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_orientation" value="Vertikal" type="radio" class="outline-none"
                        onclick="changeLocationOrientation(this)" checked>
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_orientation" value="Vertikal" type="radio" class="outline-none"
                        onclick="changeLocationOrientation(this)">
                </div>
            @endif
            <label class="w-40 ml-2">Vertical</label>
            @if ($content->location_orientation == 'Horizontal')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_orientation" value="Horizontal" type="radio" class="outline-none"
                        onclick="changeLocationOrientation(this)" checked>
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    <input name="lep_orientation" value="Horizontal" type="radio" class="outline-none"
                        onclick="changeLocationOrientation(this)">
                </div>
            @endif
            <label class="w-40 ml-2">Horizontal</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="w-40 ml-5">Lokasi</label>
            <label class="">:</label>
            <input id="locationAddress" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->location_address }}" onchange="changeLocationAddress(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Desain Visual</label>
            <label class="">:</label>
            <input id="theme" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->theme }}" onchange="changeTheme(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Brand</label>
            <label class="">:</label>
            <input id="brand" type="text" class="ml-2 outline-none px-1 border rounded-md w-[575px]"
                value="{{ $content->brand }}" onchange="changeBrand(this)" required>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">6.</label>
            <label class="font-semibold ml-2">Pemeriksaan oleh Area Office yang bertindak untuk dan atas nama
                Perusahaan Rokok Tjap Gudang Garam</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Tanggal Pemeriksaan</label>
            <label class="">:</label>
            <label class="ml-4">...........................................................</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Jam Pemeriksaan</label>
            <label class="">:</label>
            <label class="ml-4">...........................................................</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Kondisi Fisik</label>
            <label class="w-2">:</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-[60px]">
            </div>
            <label class="w-40 ml-2">Layak</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Tidak Layak</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Kondisi Penerangan</label>
            <label class="">:</label>
            <label class="ml-4"></label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Menyala Optimal</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Mati Sebagian</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Mati Total</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Kondisi Pandangan</label>
            <label class="">:</label>
            <label class="ml-4"></label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Pandangan Bebas</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Tertutup Sebagian</label>
            <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
            </div>
            <label class="w-40 ml-2">Tertutup Total</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Keterangan</label>
            <label class="">:</label>
            <label class="ml-4 h-5 border-b-2 border-dotted border-black w-[500px]"></label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5"></label>
            <label class=""></label>
            <label class="ml-5 h-5 border-b-2 border-dotted border-black w-[500px]"></label>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex text-md justify-center ml-2 mt-1">
            <div>
                <label class="flex w-full justify-center">Yang menyerahkan,</label>
                <label
                    class="flex w-full justify-center mt-20 border-b-2 border-black">{{ $bank_account->director }}</label>
                <label class="flex w-full justify-center">Direktur</label>
            </div>
        </div>
        <div class="flex text-md justify-center items-center ml-2 mt-1">
            <div>
                <label class="flex w-full justify-center">Yang menerima,</label>
                <label
                    class="flex w-full justify-center mt-20 border-b-2 border-black">............................................................</label>
            </div>
        </div>
    </div>
    <div class="flex w-full justify-center text-lg items-center ml-2 mt-20">
        <label class="font-semibold">Lampiran : Foto berwarna dan bertanggal - di saat siang dan malam</label>
    </div>
</div>
</div>
