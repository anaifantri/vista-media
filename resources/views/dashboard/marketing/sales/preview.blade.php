@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Sales start -->
    <?php
    $salesData = [];
    $salesData = session()->get('sales_store');
    ?>

    <div class="flex justify-center bg-black">
        <div class="mt-10">
            <!-- Title Show Sales start -->
            <div class="flex border-b mb-2">
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
                    href="/dashboard/marketing/sales">
                    <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Close</span>
                </a>
                @if (session()->has('success'))
                    <div
                        class="ml-2 flex text-white text-sm items-center rounded-lg border border-white bg-green-700 drop-shadow-xl shadow-inner w-max h-8 p-2">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
            </div>
            <!-- Title Show Sales end -->
            <div>
                <?php
                $saveNumber = [];
                ?>
                <div id="pdfPreview" class="w-[950px]">
                    @if ($salesData)
                        @foreach ($salesData as $sale)
                            <!-- Header start -->
                            <div class="w-[950px] h-[1345px] bg-white">
                                <?php
                                $saveNumber[$loop->iteration - 1] = Str::substr($sale['number'], 0, 4);
                                ?>
                                <div class="h-24 mt-4">
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
                                    <div class="flex justify-center mt-2">
                                        <label class="sale-label-title">DATA PENJUALAN</label>
                                    </div>
                                    <div class="body-detail">
                                        <div class="sale-detail">
                                            <div class="div-sale">
                                                <label class="label-sale-01">No. Penjualan</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['number'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Tgl. Penjualan</label>
                                                <label class="label-sale-02">:</label>
                                                <label
                                                    class="label-sale-02">{{ date('d-M-Y', strtotime($sale['date'])) }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Dok. Approval</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['client_approvals'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Dok. PO/SPK</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['client_orders'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Dok. Agreement</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['client_agreements'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="title-periode">PERIODE KONTRAK</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Awal</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['start_at'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Akhir</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['end_at'] }}</label>
                                            </div>
                                        </div>
                                        <div class="sale-detail ml-4">
                                            <div class="div-sale">
                                                <label class="label-sale-01">No. Penawaran</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['quot_number'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Tgl. Penawaran</label>
                                                <label class="label-sale-02">:</label>
                                                <label
                                                    class="label-sale-02">{{ date('d-M-Y', strtotime($sale['quot_date'])) }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Nama Klien</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['client_name'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Perusahaan</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['client_company'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Alamat</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['client_address'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Kontak Person</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['contact_name'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">No. Telp./Hp.</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['contact_phone'] }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Email</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $sale['contact_email'] }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center mt-4">
                                        <table class="table-auto mt-2 w-[780px]">
                                            <thead>
                                                <tr>
                                                    <th class="th-table w-8" rowspan="2">No.</th>
                                                    <th class="th-table w-20" rowspan="2">Kode</th>
                                                    <th class="th-table" rowspan="2">Lokasi</th>
                                                    <th class="th-table w-48" colspan="3">Deskripsi</th>
                                                    <th class="th-table w-28">Harga</th>
                                                </tr>
                                                <tr>
                                                    <th class="th-table w-10">Jenis</th>
                                                    <th class="th-table w-10">BL/FL</th>
                                                    <th class="th-table w-28">Size - V/H</th>
                                                    <th class="th-table w-28">{{ $sale['duration'] }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="td-table">1</td>
                                                    <td class="td-table">{{ $sale['billboard_code'] }}</td>
                                                    <td class="text-xs text-teal-700 border">
                                                        {{ $sale['billboard_address'] }}</td>
                                                    @if ($sale['billboard_category'] == 'Billboard')
                                                        <td class="td-table w-10">BB</td>
                                                    @elseif ($sale['billboard_category'] == 'Bando')
                                                        <td class="td-table w-10">BD</td>
                                                    @elseif ($sale['billboard_category'] == 'Baliho')
                                                        <td class="td-table w-10">BLH</td>
                                                    @elseif ($sale['billboard_category'] == 'Midiboard')
                                                        <td class="td-table w-10">MB</td>
                                                    @endif
                                                    @if ($sale['billboard_lighting'] == 'Frontlight')
                                                        <td class="td-table w-10">FL</td>
                                                    @elseif ($sale['billboard_lighting'] == 'Backlight')
                                                        <td class="td-table w-10">BL</td>
                                                    @else
                                                        <td class="td-table w-10">NL</td>
                                                    @endif
                                                    @if ($sale['billboard_orientation'] == 'Vertikal')
                                                        <td class="td-table w-28">{{ $sale['billboard_size'] }} - V</td>
                                                    @elseif ($sale['billboard_orientation'] == 'Horizontal')
                                                        <td class="td-table w-28">{{ $sale['billboard_size'] }} - H</td>
                                                    @endif
                                                    <td class="td-table-sale">{{ number_format($sale['price']) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-table-sale" colspan="6">DPP</td>
                                                    <td class="td-table-sale">{{ number_format($sale['dpp']) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-table-sale" colspan="6">PPN 11% (A)</td>
                                                    <td class="td-table-sale">
                                                        {{ number_format($sale['dpp'] * (11 / 100)) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-table-sale" colspan="6">PPh 23 2% (B)</td>
                                                    <td class="td-table-sale">
                                                        {{ number_format($sale['dpp'] * (2 / 100)) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-table-sale" colspan="6">Grand Total ((Harga + A) - B)
                                                    </td>
                                                    <td class="td-table-sale">
                                                        {{ number_format($sale['price'] + $sale['dpp'] * (11 / 100) - $sale['dpp'] * (2 / 100)) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="sale-note w-[780px]">
                                        <div class="div-sale-notes w-[325px]">
                                            <div>
                                                <div class="flex">
                                                    <label class="sale-note-title">Termin Pembayaran</label>
                                                </div>
                                                <?php
                                                $objPayments = json_decode($sale['terms_of_payment']);
                                                $payments = $objPayments->payments;
                                                ?>
                                                @foreach ($payments as $terms)
                                                    <div class="flex">
                                                        <label class="label-number-notes">{{ $loop->iteration }}.</label>
                                                        <label class="label-sale-notes">{{ $terms->termValue }} %
                                                            {{ $terms->termNote }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="mt-4">
                                                <div>
                                                    <label class="sale-note-title">Services</label>
                                                </div>
                                                <div>
                                                    @if ($sale['free_instalation'])
                                                        <label class="label-sale-notes">• Free pemasangan
                                                            {{ $sale['free_instalation'] }} x</label>
                                                    @else
                                                        <label class="label-sale-notes">• Tidak ada free pemasangan</label>
                                                    @endif
                                                    @if ($sale['free_print'])
                                                        <label class="label-sale-notes">• Free cetak
                                                            {{ $sale['free_print'] }} x</label>
                                                    @else
                                                        <label class="label-sale-notes">• Tidak ada free cetak</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="div-sale-notes w-[435px] ml-5">
                                            <div>
                                                <div>
                                                    <label class="sale-note-title">Keterangan Tambahan :</label>
                                                    <label class="line-label"></label>
                                                    <label class="line-label"></label>
                                                    <label class="line-label"></label>
                                                    <label class="line-label"></label>
                                                    <label class="line-label"></label>
                                                    <label class="line-label"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sale-note w-[780px]">
                                        <table class="mt-2 w-[780px]">
                                            <thead>
                                                <tr>
                                                    <th class="th-title-sign" colspan="4">Mengetahui :</th>
                                                </tr>
                                                <tr>
                                                    <th class="th-sign">Penjualan dan Pemasaran</th>
                                                    <th class="th-sign">Penagihan</th>
                                                    <th class="th-sign">Keuangan</th>
                                                    <th class="th-sign">Direktur</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="h-28">
                                                    <td class="td-sign">Nur Cahyono</td>
                                                    <td class="td-sign">Yudhi Pratama</td>
                                                    <td class="td-sign">Ayu Putri Lestari</td>
                                                    <td class="td-sign">Sandy Kamboy</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="body-bottom-sale mt-4">
                                        <div class="sale-detail">
                                            <img class="img-location-sale" src="/storage/{{ $sale['billboard_photo'] }}"
                                                alt="">
                                        </div>
                                        <div class="qr-code-sale">
                                            {{ QrCode::size(100)->generate('http://vistamedia.co.id/') }}
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
                                            <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali -
                                                Indonesia</span>
                                        </div>
                                        <div class="flex items-center w-full justify-center">
                                            <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                        </div>
                                        <div class="flex items-center w-full justify-center">
                                            <span class="text-xs">e-mail : info@vistamedia.co.id |
                                                www.vistamedia.co.id</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Footer end -->
                            <!-- Footer end -->
                        @endforeach
                        <input type="text" id="saveNumber" value="{{ implode(' & ', $saveNumber) }}" hidden>
                    @endif
                </div>
                <div class="h-10"></div>
            </div>
        </div>
    </div>
    <!-- Show Sales end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const saveName = document.getElementById("saveNumber");
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
                    dpi: 300,
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
