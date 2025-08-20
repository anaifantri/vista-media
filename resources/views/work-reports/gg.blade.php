<div class="flex text-md font-bold mt-4 text-white">
    <input id="lepStatus" type="checkbox" class="outline-none" onclick="changeLepStatus(this)" checked>
    <span class="ml-2">LEP</span>
    <input id="bappStatus" type="checkbox" class="outline-none ml-6" onclick="changeBappStatus(this)" checked>
    <span class="ml-2">BAPP</span>
</div>
<div id="divBapp" class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
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
                <label class="ml-2">Penomoran otomatis</label>
                <label class="font-semibold w-24 ml-60">Tanggal</label>
                <label>:</label>
                @if (request('bast_date'))
                    <input class="ml-4 outline-none border rounded-md px-1" type="date"
                        value="{{ request('bast_date') }}" name="bast_date" onchange="submit()">
                @else
                    <input class="ml-4 outline-none border rounded-md px-1" type="date" value="{{ date('Y-m-d') }}"
                        name="bast_date" onchange="submit()">
                @endif
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
                @if ($sale->media_category->name == 'Service')
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
                    <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                        @if ($content->bast_sale_status == 'new')
                            <input class="outline-none" type="radio" name="bast_sale_status" value="new"
                                onclick="changeBastSaleStatus(this)" checked>
                        @else
                            <input class="outline-none" type="radio" name="bast_sale_status" value="new"
                                onclick="changeBastSaleStatus(this)">
                        @endif
                    </div>
                    <label class="w-40 ml-2">Kontrak Baru</label>
                    <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                        @if ($content->bast_sale_status == 'extend')
                            <input class="outline-none" type="radio" name="bast_sale_status" value="extend"
                                onclick="changeBastSaleStatus(this)" checked>
                        @else
                            <input class="outline-none" type="radio" name="bast_sale_status" value="extend"
                                onclick="changeBastSaleStatus(this)">
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
                        @if ($ggCategory == $product->category)
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'LED' && $product->category == 'Videotron')
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'JPO' && $product->category == 'Bando')
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'Neon Box' && $product->category == 'Signage')
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
                        @if ($ggCategory == $product->category)
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'LED' && $product->category == 'Videotron')
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'JPO' && $product->category == 'Bando')
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'Neon Box' && $product->category == 'Signage')
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
                <label class="ml-4">{{ $product->size }}</label>
            </div>
            <div class="flex text-md items-center ml-2 mt-2">
                @if ($product->category != 'Videotron' || ($product->category == 'Signage' && $description->type != 'Videotron'))
                    @if ($description->lighting == 'Backlight')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                        </div>
                    @endif
                @else
                    <div
                        class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    </div>
                @endif
                <label class="w-40 ml-2">Back Light</label>
                @if ($product->category != 'Videotron' || ($product->category == 'Signage' && $description->type != 'Videotron'))
                    @if ($description->lighting == 'Frontlight')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                        </div>
                    @endif
                @else
                    <div
                        class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    </div>
                @endif
                <label class="w-40 ml-2">Front Light</label>
                @if ($product->category != 'Videotron' || ($product->category == 'Signage' && $description->type != 'Videotron'))
                    @if ($description->lighting == 'Nonlight')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                        </div>
                    @endif
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
                <input type="text" class="ml-4 px-1 outline-none border rounded-md w-[550px]"
                    placeholder="input lokasi" value="{{ $content->location_address }}"
                    onchange="changeLocation(this)">
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-40 ml-5">Desain Visual</label>
                <label class="">:</label>
                <input id="inputTheme" type="text" class="ml-4 px-1 outline-none border rounded-md w-[550px]"
                    placeholder="input desain" value="{{ $content->theme }}" onchange="changeTheme(this)">
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-40 ml-5">Brand</label>
                <label class="">:</label>
                <input id="lepBrand" type="text" class="ml-4 px-1 outline-none border rounded-md w-[550px]"
                    placeholder="input brand" onchange="changeBrand(this)">
            </div>
            <div class="flex text-md items-center ml-2 mt-2">
                <label class="font-semibold">6.</label>
                <label class="font-semibold ml-2">Pemeriksaan oleh Area Office yang bertindak untuk dan atas nama PT
                    Gudang
                    Garam Tbk</label>
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
<div id="divLep" class="standard w-[950px] h-[1345px] mt-4 bg-white p-4">
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
                <label class="ml-2">Penomoran otomatis</label>
                <label class="font-semibold w-24 ml-60">Tanggal</label>
                <label>:</label>
                @if (request('lep_date'))
                    <input class="ml-4 outline-none border rounded-md px-1" type="date"
                        value="{{ request('lep_date') }}" name="lep_date" onchange="submit()">
                @else
                    <input class="ml-4 outline-none border rounded-md px-1" type="date"
                        value="{{ date('Y-m-d') }}" name="lep_date" onchange="submit()">
                @endif
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
                @if ($sale->media_category->name == 'Service')
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
                    <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                        @if ($content->lep_sale_status == 'new')
                            <input class="outline-none" type="radio" name="lep_sale_status" value="new"
                                onclick="changeLepSaleStatus(this)" checked>
                        @else
                            <input class="outline-none" type="radio" name="lep_sale_status" value="new"
                                onclick="changeLepSaleStatus(this)">
                        @endif
                    </div>
                    <label class="w-40 ml-2">Kontrak Baru</label>
                    <div class="flex justify-center items-center w-10 h-6 border border-black ml-5">
                        @if ($content->lep_sale_status == 'extend')
                            <input class="outline-none" type="radio" name="lep_sale_status" value="extend"
                                onclick="changeLepSaleStatus(this)" checked>
                        @else
                            <input class="outline-none" type="radio" name="lep_sale_status" value="extend"
                                onclick="changeLepSaleStatus(this)">
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
                        @if ($ggCategory == $product->category)
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'LED' && $product->category == 'Videotron')
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'JPO' && $product->category == 'Bando')
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'Neon Box' && $product->category == 'Signage')
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
                        @if ($ggCategory == $product->category)
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'LED' && $product->category == 'Videotron')
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'JPO' && $product->category == 'Bando')
                            <div
                                class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                                ✓
                            </div>
                        @elseif ($ggCategory == 'Neon Box' && $product->category == 'Signage')
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
                <label class="ml-4">{{ $product->size }}</label>
            </div>
            <div class="flex text-md items-center ml-2 mt-2">
                @if ($product->category != 'Videotron' || ($product->category == 'Signage' && $description->type != 'Videotron'))
                    @if ($description->lighting == 'Backlight')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                        </div>
                    @endif
                @else
                    <div
                        class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    </div>
                @endif
                <label class="w-40 ml-2">Back Light</label>
                @if ($product->category != 'Videotron' || ($product->category == 'Signage' && $description->type != 'Videotron'))
                    @if ($description->lighting == 'Frontlight')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                        </div>
                    @endif
                @else
                    <div
                        class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                    </div>
                @endif
                <label class="w-40 ml-2">Front Light</label>
                @if ($product->category != 'Videotron' || ($product->category == 'Signage' && $description->type != 'Videotron'))
                    @if ($description->lighting == 'Nonlight')
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                            ✓
                        </div>
                    @else
                        <div
                            class="flex justify-center items-center w-10 h-6 border border-black ml-5 text-lg font-bold text-black">
                        </div>
                    @endif
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
                <input type="text" class="ml-4 px-1 outline-none border rounded-md w-[550px]"
                    placeholder="input lokasi" value="{{ $content->location_address }}"
                    onchange="changeLocation(this)">
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-40 ml-5">Desain Visual</label>
                <label class="">:</label>
                <input id="lepTheme" type="text" class="ml-4 px-1 outline-none border rounded-md w-[550px]"
                    placeholder="input desain" value="{{ $content->theme }}" onchange="changeTheme(this)">
            </div>
            <div class="flex text-md items-center ml-2 mt-1">
                <label class="w-40 ml-5">Brand</label>
                <label class="">:</label>
                <input id="inputBrand" type="text" class="ml-4 px-1 outline-none border rounded-md w-[550px]"
                    placeholder="input brand" onchange="changeBrand(this)">
            </div>
            <div class="flex text-md items-center ml-2 mt-2">
                <label class="font-semibold">6.</label>
                <label class="font-semibold ml-2">Pemeriksaan oleh Area Office yang bertindak untuk dan atas nama PT
                    Gudang
                    Garam Tbk</label>
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
