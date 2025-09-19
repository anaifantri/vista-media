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
            <label class="font-semibold w-24 ml-60">Tanggal</label>
            <label>:</label>
            <label class="ml-4">
                {{ date('d', strtotime($content->date)) }}
                {{ $fullMonth[(int) date('m', strtotime($content->date))] }}
                {{ date('Y', strtotime($content->date)) }}
            </label>
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
            <label class="ml-4">{{ $content->po_date }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Nomor PO</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->po_number }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">4.</label>
            <label class="font-semibold ml-2">Jenis Pekerjaan</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            @if ($content->category == 'Service')
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                </div>
                <label class="w-40 ml-2">Kontrak Baru</label>
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                </div>
                <label class="w-40 ml-2">Perpanjangan</label>
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
                <label class="w-40 ml-2">Revisual</label>
            @else
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5 font-bold text-black">
                    @if ($content->bast_sale_status == 'new')
                        ✓
                    @endif
                </div>
                <label class="w-40 ml-2">Kontrak Baru</label>
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5 font-bold text-black">
                    @if ($content->bast_sale_status == 'extend')
                        ✓
                    @endif
                </div>
                <label class="w-40 ml-2">Perpanjangan</label>
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
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
                            ✓
                        </div>
                    @elseif ($ggCategory == 'LED' && $content->location_type == 'Videotron')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @elseif ($ggCategory == 'JPO' && $content->location_type == 'Bando')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @elseif ($ggCategory == 'Neon Box' && $content->location_type == 'Signage')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
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
                            ✓
                        </div>
                    @elseif ($ggCategory == 'LED' && $content->location_type == 'Videotron')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @elseif ($ggCategory == 'JPO' && $content->location_type == 'Bando')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @elseif ($ggCategory == 'Neon Box' && $content->location_type == 'Signage')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                        </div>
                    @endif
                    <label class="w-40 ml-2">{{ $ggCategory }}</label>
                @endif
            @endforeach
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Ukuran</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->location_size }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @if ($content->location_lighting == 'Backlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">Back Light</label>
            @if ($content->location_lighting == 'Frontlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">Front Light</label>
            @if ($content->location_lighting == 'Nonlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">No Light</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @if ($content->location_orientation == 'Vertikal')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">Vertical</label>
            @if ($content->location_orientation == 'Horizontal')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">Horizontal</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="w-40 ml-5">Lokasi</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->location_address }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Desain Visual</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->theme }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Brand</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->brand }}</label>
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
            <label class="font-semibold w-24 ml-60">Tanggal</label>
            <label>:</label>
            <label class="ml-4">
                {{ date('d', strtotime($content->date)) }}
                {{ $fullMonth[(int) date('m', strtotime($content->date))] }}
                {{ date('Y', strtotime($content->date)) }}
            </label>
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
            <label class="ml-4">{{ $content->po_date }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Nomor PO</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->po_number }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="font-semibold">4.</label>
            <label class="font-semibold ml-2">Jenis Pekerjaan</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            @if ($content->category == 'Service')
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                </div>
                <label class="w-40 ml-2">Kontrak Baru</label>
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                </div>
                <label class="w-40 ml-2">Perpanjangan</label>
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
                <label class="w-40 ml-2">Revisual</label>
            @else
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5 font-bold text-black">
                    @if ($content->lep_sale_status == 'new')
                        ✓
                    @endif
                </div>
                <label class="w-40 ml-2">Kontrak Baru</label>
                <div class="flex justify-center items-center w-10 h-6 border border-black ml-5 font-bold text-black">
                    @if ($content->lep_sale_status == 'extend')
                        ✓
                    @endif
                </div>
                <label class="w-40 ml-2">Perpanjangan</label>
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
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
                            ✓
                        </div>
                    @elseif ($ggCategory == 'LED' && $content->location_type == 'Videotron')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @elseif ($ggCategory == 'JPO' && $content->location_type == 'Bando')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @elseif ($ggCategory == 'Neon Box' && $content->location_type == 'Signage')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
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
                            ✓
                        </div>
                    @elseif ($ggCategory == 'LED' && $content->location_type == 'Videotron')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @elseif ($ggCategory == 'JPO' && $content->location_type == 'Bando')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @elseif ($ggCategory == 'Neon Box' && $content->location_type == 'Signage')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                        </div>
                    @endif
                    <label class="w-40 ml-2">{{ $ggCategory }}</label>
                @endif
            @endforeach
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Ukuran</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->location_size }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @if ($content->location_lighting == 'Backlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">Back Light</label>
            @if ($content->location_lighting == 'Frontlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">Front Light</label>
            @if ($content->location_lighting == 'Nonlight')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">No Light</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            @if ($content->location_orientation == 'Vertikal')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">Vertical</label>
            @if ($content->location_orientation == 'Horizontal')
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    ✓
                </div>
            @else
                <div
                    class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                </div>
            @endif
            <label class="w-40 ml-2">Horizontal</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-2">
            <label class="w-40 ml-5">Lokasi</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->location_address }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Desain Visual</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->theme }}</label>
        </div>
        <div class="flex text-md items-center ml-2 mt-1">
            <label class="w-40 ml-5">Brand</label>
            <label class="">:</label>
            <label class="ml-4">{{ $content->brand }}</label>
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
