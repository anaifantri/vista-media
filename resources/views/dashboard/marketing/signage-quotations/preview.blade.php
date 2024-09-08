@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <?php
    $products = json_decode($signage_quotation->products);
    $payment_terms = json_decode($signage_quotation->payment_terms);
    $created_by = json_decode($signage_quotation->created_by);
    $notes = json_decode($signage_quotation->notes);
    $price = json_decode($signage_quotation->price);
    $checkbox = 0;
    $width = 0;
    foreach ($price->dataHeader as $header) {
        if ($header->checkbox == true) {
            $checkbox = $checkbox + 1;
        }
    }
    if ($checkbox > 2) {
        $width = 850;
    } else {
        $width = 725;
    }
    ?>
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
                    href="/dashboard/marketing/signage-quotations">
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
            <div id="pdfPreview">
                <div class="flex justify-center w-full">
                    <div class="w-[950px] h-[1345px] mt-1 bg-white">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1125px]">
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Nomor</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-black">{{ $signage_quotation->number }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-black">{{ $signage_quotation->attachment }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-black">{{ $signage_quotation->subject }}</label>
                                    </div>
                                    <div class="mt-4">
                                        <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $signage_quotation->client->company }}</label>
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $signage_quotation->client_contact }}</label>
                                        <label class="flex ml-1 text-sm text-black">Di -</label>
                                        <label class="flex ml-6 text-sm text-black">Tempat</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black w-20">Email</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label
                                            class="ml-1 text-sm text-black ">{{ $signage_quotation->contact_email }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label
                                            class="ml-1 text-sm text-black ">{{ $signage_quotation->contact_phone }}</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $signage_quotation->body_top }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- videotron table start -->
                            <div class="ml-2">
                                <div class="flex justify-center">
                                    <div class="w-[{{ $width }}px]">
                                        <table class="table-auto mt-2 w-full">
                                            <thead id="previewTHead">
                                                <tr>
                                                    <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-[72px]" rowspan="2">
                                                        Kode
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border" colspan="3">
                                                        Deskripsi
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border" colspan="5">Harga
                                                        (Rp.)
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-[0.7rem] text-teal-700 border w-14">Jenis</th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-28">Size - Side - V/H
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-10">Qty</th>
                                                    @foreach ($price->dataHeader as $header)
                                                        @if ($header->checkbox == true)
                                                            <th class="text-[0.7rem] text-teal-700 border w-[90px]">
                                                                {{ $header->title }}</th>
                                                        @else
                                                            <th class="text-[0.7rem] text-teal-700 border w-[90px]" hidden>
                                                                {{ $header->title }}</th>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody id="previewTBody">
                                                @foreach ($signages as $signage)
                                                    <?php
                                                    $row = $loop->iteration - 1;
                                                    ?>
                                                    <tr>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $loop->iteration }}</td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $signage->code }}-{{ $signage->city->code }}</td>
                                                        <td class="text-[0.7rem] text-teal-700 border">
                                                            {{ $signage->address }}
                                                        </td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $signage->signage_category->name }}</td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $signage->size->size }} x {{ $signage->side }} sisi -
                                                            @if ($signage->orientation == 'Vertikal')
                                                                V
                                                            @elseif ($signage->orientation == 'Horizontal')
                                                                H
                                                            @endif
                                                        </td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $signage->qty }}</td>
                                                        @foreach ($price->dataPrice as $priceValue)
                                                            @if ($price->dataHeader[$loop->iteration - 1]->checkbox == true)
                                                                <td class="text-[0.7rem] text-teal-700 border text-center">
                                                                    Rp.
                                                                    {{ number_format($priceValue[$row]->price) }},-</td>
                                                            @else
                                                                <td class="text-[0.7rem] text-teal-700 border text-center"
                                                                    hidden>
                                                                    Rp.
                                                                    {{ number_format($priceValue[$row]->price) }},-</td>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- videotron table end -->

                            <!-- quotation note start -->
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                    </div>
                                    <div>
                                        @foreach ($notes->dataNotes as $note)
                                            @if ($loop->iteration == 3 || $loop->iteration == 4)
                                                <label class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                            @else
                                                <label class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
                                    </div>
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $payment)
                                            <div class="flex">
                                                <label class="ml-1 text-sm text-black flex">-</label>
                                                <label class="ml-1 text-sm text-black flex">{{ $payment->term }}</label>
                                                <label class="ml-2 text-sm text-black flex">{{ $payment->note }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- quotation note end -->
                            <div>
                                <div class="flex justify-center">
                                    <div class="flex mt-4">
                                        <label class="ml-1 w-[721px] text-sm">{{ $signage_quotation->body_end }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <?php
                                    $quotationDate = date('d F Y', strtotime($signage_quotation->created_at));
                                    ?>
                                    <div class="w-[725px] mt-4">
                                        <label class="ml-1 text-sm text-black flex">Denpasar, {{ $quotationDate }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-10">
                                        <input
                                            class="ml-1 text-sm text-black flex font-semibold"value="{{ $created_by->name }}"
                                            type="text">
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <input class="ml-1 text-sm text-black flex" value="{{ $created_by->position }}"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        @include('dashboard.layouts.letter-footer')
                        <!-- Footer end -->
                    </div>
                </div>
                <!-- View Location start -->
                @foreach ($signages as $signage)
                    @include('dashboard.layouts.sn-location')
                @endforeach
                <!-- View Location end -->
            </div>
        </div>
        <?php
        $number = Str::substr($signage_quotation->number, 0, 4);
        ?>
        <input id="saveName" type="text" value="{{ $number }}-SG-{{ $signage_quotation->client->name }}"
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
