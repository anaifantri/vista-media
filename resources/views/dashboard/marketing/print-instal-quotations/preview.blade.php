@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <div class="flex justify-center bg-black">
        <div class="mt-10">
            <!-- Title Show Quotatin start -->
            <div class="flex border-b">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
                    type="button">
                    <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="ml-2 text-white">Save PDF</span>
                </button>
                <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                    href="/dashboard/marketing/print-instal-quotations">
                    <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Close</span>
                </a>
                @if (session()->has('success'))
                    <div class="ml-2 flex alert-success">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
            </div>
            <!-- Title Show Quotatin end -->
            <div>
                <div id="pdfPreview" class="w-[950px] h-[1345px] mt-2 bg-white">
                    <!-- Header start -->
                    <div class="h-28">
                        <div class="flex w-full justify-center items-center">
                            <img class="mt-3" src="/img/logo-vm.png" alt="">
                        </div>
                        <div class="flex w-full justify-center items-center mt-2">
                            <img src="/img/line-top.png" alt="">
                        </div>
                    </div>
                    <!-- Header end -->
                    <!-- Body start -->
                    <div class="h-[1125px]">
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-2">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                    <label class="ml-1 text-sm text-black flex">: </label>
                                    <label
                                        class="ml-1 text-sm text-black flex">{{ $print_instal_quotation->number }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label class="ml-1 text-sm text-black flex">-</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label class="ml-1 text-sm text-black font-semibold flex">Penawaran
                                        Biaya Cetak dan Pasang Materi Iklan Billboard</label>
                                </div>
                                <div class="flex mt-4">
                                    <div>
                                        <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                        <label
                                            class="ml-1 text-sm text-black flex font-semibold">{{ $print_instal_quotation->client->company }}</label>
                                        <div class="flex">
                                            <label id="clientPreviewContact"
                                                class="ml-1 text-sm text-black flex font-semibold">{{ $print_instal_quotation->contact->name }}</label>
                                        </div>
                                        <label class="ml-1 text-sm text-black flex">Di -</label>
                                        <label class="ml-6 text-sm text-black flex">Tempat</label>
                                    </div>
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label id="contactPreviewEmail"
                                        class="ml-1 text-sm text-black flex">{{ $print_instal_quotation->contact->email }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label id="contactPreviewPhone"
                                        class="ml-1 text-sm text-black flex">{{ $print_instal_quotation->contact->phone }}</label>
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                </div>
                                <div class="flex mt-2">
                                    <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>Bersama ini kami menyampaikan surat penawaran biaya cetak dan pasang materi billboard dengan spesifikasi sebagai berikut :</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- quotation table start -->
                        <div class="ml-2">
                            <div class="flex justify-center">
                                <div class="w-[725px]">
                                    <table id="billboardTable" class="table-fix mt-2 w-full">
                                        <thead>
                                            <tr>
                                                <th class="text-xs text-teal-700 border w-6" rowspan="2">No</th>
                                                <th class="text-xs text-teal-700 border w-16" rowspan="2">Jenis</th>
                                                <th class="text-xs text-teal-700 border" colspan="2">Lokasi</th>
                                                <th class="text-xs text-teal-700 border w-[300px]" colspan="4">
                                                    Deskripsi
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-xs text-teal-700 border w-20">Kode</th>
                                                <th class="text-xs text-teal-700 border">Alamat</th>
                                                <th class="text-xs text-teal-700 border w-28">Bahan</th>
                                                <th class="text-xs text-teal-700 border w-8">Luas</th>
                                                <th class="text-xs text-teal-700 border w-14">Harga</th>
                                                <th class="text-xs text-teal-700 border w-[100px]">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="billboardsPreviewTBody">
                                            <?php
                                            $products = json_decode($print_instal_quotation->products);
                                            $subTotal = 0;
                                            // $number = 0;
                                            ?>
                                            @foreach ($products->quotationProducts as $product)
                                                <tr>
                                                    {{-- @if ($number == 0)
                                                        <td class="text-xs text-teal-700 border text-center p-1">
                                                            {{ $number + 1 }}</td>
                                                    @else
                                                        <td class="text-xs text-teal-700 border text-center p-1">
                                                            {{ $number * 2 + 1 }}</td>
                                                    @endif --}}
                                                    <td class="text-xs text-teal-700 border text-center p-1" rowspan="2">
                                                        {{ $loop->iteration }}</td>
                                                    <td class="text-xs text-teal-700 border text-center p-1">Cetak</td>
                                                    <td class="text-xs text-teal-700 border text-center p-1" rowspan="2">
                                                        {{ $products->quotationProducts[$loop->iteration - 1]->billboard_code }}
                                                    </td>
                                                    <td class="text-xs text-teal-700 border p-1" rowspan="2">
                                                        {{ $products->quotationProducts[$loop->iteration - 1]->billboard_address }}
                                                    </td>
                                                    @if ($products->quotationProducts[$loop->iteration - 1]->print == true)
                                                        <td class="text-xs text-teal-700 border text-center">
                                                            {{ $products->quotationProducts[$loop->iteration - 1]->printProduct }}
                                                        </td>
                                                    @else
                                                        <td class="text-xs text-teal-700 border text-center">Free</td>
                                                    @endif

                                                    <td class="text-xs text-teal-700 border text-center p-1"
                                                        rowspan="2">
                                                        {{ $products->quotationProducts[$loop->iteration - 1]->wide }}</td>
                                                    @if ($products->quotationProducts[$loop->iteration - 1]->print == true)
                                                        <td class="text-xs text-teal-700 border text-center">
                                                            {{ number_format($products->quotationProducts[$loop->iteration - 1]->print_price) }}
                                                        </td>
                                                        <td class="text-xs text-teal-700 border text-right p-1">
                                                            {{ number_format($products->quotationProducts[$loop->iteration - 1]->print_price * $products->quotationProducts[$loop->iteration - 1]->wide) }}
                                                        </td>
                                                    @else
                                                        <td class="text-xs text-teal-700 border text-center">Free</td>
                                                        <td class="text-xs text-teal-700 border text-right p-1">
                                                            Free ke
                                                            {{ $products->quotationProducts[$loop->iteration - 1]->used_print + 1 }}
                                                            dari
                                                            {{ $products->quotationProducts[$loop->iteration - 1]->free_print }}
                                                        </td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    {{-- @if ($number == 0)
                                                        <td class="text-xs text-teal-700 border text-center p-1">
                                                            {{ $number + 2 }}</td>
                                                    @else
                                                        <td class="text-xs text-teal-700 border text-center p-1">
                                                            {{ $number * 2 + 2 }}</td>
                                                    @endif --}}
                                                    <td class="text-xs text-teal-700 border text-center p-1">Pasang</td>
                                                    <td class="text-xs text-teal-700 border text-center">
                                                        {{ $products->quotationProducts[$loop->iteration - 1]->installProduct }}
                                                    </td>
                                                    @if ($products->quotationProducts[$loop->iteration - 1]->install == true)
                                                        <td class="text-xs text-teal-700 border text-center">
                                                            {{ number_format($products->quotationProducts[$loop->iteration - 1]->install_price) }}
                                                        </td>
                                                        <td class="text-xs text-teal-700 border text-right p-1">
                                                            {{ number_format($products->quotationProducts[$loop->iteration - 1]->install_price * $products->quotationProducts[$loop->iteration - 1]->wide) }}
                                                        </td>
                                                    @else
                                                        <td class="text-xs text-teal-700 border text-center">Free</td>
                                                        <td class="text-xs text-teal-700 border text-right p-1">Free ke
                                                            {{ $products->quotationProducts[$loop->iteration - 1]->used_install + 1 }}
                                                            dari
                                                            {{ $products->quotationProducts[$loop->iteration - 1]->free_install }}
                                                        </td>
                                                    @endif
                                                </tr>
                                                <?php
                                                $subTotal = $subTotal + ($products->quotationProducts[$loop->iteration - 1]->print_price * $products->quotationProducts[$loop->iteration - 1]->wide + $products->quotationProducts[$loop->iteration - 1]->install_price * $products->quotationProducts[$loop->iteration - 1]->wide);
                                                $ppn = ($subTotal * 11) / 100;
                                                // $number++;
                                                ?>
                                            @endforeach
                                            <tr>
                                                <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                    colspan="7">Sub Total</td>
                                                <td id="subTotalPreview"
                                                    class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                                    {{ number_format($subTotal) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                    colspan="7">PPN 11%</td>
                                                <td id="ppnValuePreview"
                                                    class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                                    {{ number_format($ppn) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                    colspan="7">Grand Total</td>
                                                <td id="grandTotalPreview"
                                                    class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                                    {{ number_format($subTotal + $ppn) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- quotation table end -->

                        <!-- quotation note start -->
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-2">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                </div>
                                <div id="notesPreview">
                                    @foreach ($products->quotationProducts[0]->notes as $note)
                                        <div class="flex">
                                            <label class="ml-1 text-sm">-</label>
                                            <textarea class="text-area-notes" rows="1" readonly>{{ $note }}</textarea>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex mt-2">Sistem pembayaran :</label>
                                </div>
                                <div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm">-</label>
                                        <textarea class="text-area-notes" rows="1" placeholder="input catatan" readonly>100 % setelah cetak dan pemasangan</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- quotation note end -->

                        <div class="flex justify-center">
                            <div class="flex mt-2">
                                <textarea class="ml-1 w-[721px] outline-none text-sm" rows="1" readonly>Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-4">
                                <?php
                                $searchDate = strtotime(request('search'));
                                $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                ?>
                                <label class="ml-1 text-sm text-black flex">Denpasar, {{ date('j') }}
                                    {{ $bulan[(int) date('m')] }} {{ date('Y') }}</label>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="w-[250px]">
                                <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                                <label class="ml-1 my-2 text-xs text-slate-300 flex">Ditandatangani secara
                                    elektronik
                                    oleh
                                    :</label>
                                <label id="salesUser"
                                    class="ml-1 text-sm text-black flex font-semibold">{{ $print_instal_quotation->user->name }}</label>
                                <label id="salesPotition"
                                    class="ml-1 text-sm text-black flex">{{ $print_instal_quotation->user->level }}</label>
                            </div>
                            <div class="w-[475px]">
                                <div>
                                    {{ QrCode::size(100)->generate('https://www.vistamedia.co.id/dashboard/marketing/print-instal-quotations/preview/' . $print_instal_quotation->id) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Body end -->
                    <!-- Footer start -->
                    <div class="flex items-end justify-center">
                        <div>
                            <div class="flex w-full h-max justify-center mt-2">
                                <img src="/img/line-bottom.png" alt="">
                            </div>
                            <div class="flex items-center w-full justify-center">
                                <span class="text-sm font-semibold">PT. Vista Media</span>
                            </div>
                            <div class="flex items-center w-full justify-center">
                                <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
                            </div>
                            <div class="flex items-center w-full justify-center">
                                <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                            </div>
                            <div class="flex items-center w-full justify-center">
                                <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                            </div>
                        </div>
                    </div>
                    <!-- Footer end -->
                </div>
            </div>
        </div>
        <input type="text" id="saveName"
            value="{{ $print_instal_quotation->number }}- Cetak & Pasang - {{ $print_instal_quotation->client->name }}"
            hidden>
    </div>
    <!-- Show Quotatin end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const saveName = document.getElementById("saveName");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: saveName.value,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 192,
                    scale: 4,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [950, 1365],
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            // html2pdf(element, opt);
            html2pdf().set(opt).from(element).save();
        };
    </script>
    <!-- Script end -->
@endsection
