@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <?php
    $products = json_decode($videotron_quotation->products);
    $payment_terms = json_decode($videotron_quot_revision->payment_terms);
    $created_by = json_decode($videotron_quotation->created_by);
    $modified_by = json_decode($videotron_quot_revision->modified_by);
    $notes = json_decode($videotron_quot_revision->notes);
    $price = json_decode($videotron_quot_revision->price);
    $share_price = $price->sharePrice;
    $ex_price = $price->exPrice;
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
                    href="/dashboard/marketing/videotron-quotations/{{ $videotron_quotation->id }}">
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
                    <div class="w-[950px] h-[1345px] border mb-10 mt-1 bg-white">
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
                                        <label
                                            class="ml-1 text-sm text-black">{{ $videotron_quot_revision->number }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label
                                            class="ml-1 text-sm text-black">{{ $videotron_quotation->attachment }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-black">{{ $videotron_quotation->subject }}</label>
                                    </div>
                                    <div class="mt-4">
                                        <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $videotron_quotation->client->company }}</label>
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $videotron_quotation->client_contact }}</label>
                                        <label class="flex ml-1 text-sm text-black">Di -</label>
                                        <label class="flex ml-6 text-sm text-black">Tempat</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black w-20">Email</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label
                                            class="ml-1 text-sm text-black ">{{ $videotron_quotation->contact_email }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label
                                            class="ml-1 text-sm text-black ">{{ $videotron_quotation->contact_phone }}</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $videotron_quotation->body_top }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- videotron table start -->
                            <div class="ml-2">
                                <div class="flex justify-center">
                                    <table class="table-auto mt-2">
                                        <thead>
                                            <tr>
                                                <th class="text-sm text-black border w-60">Deskripsi
                                                </th>
                                                <th class="text-sm text-black border w-[480px]" colspan="4">
                                                    Spesifikasi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="previewTBody">
                                            <tr>
                                                <td class="px-4 text-sm text-black border">Lokasi</td>
                                                <td class="px-4 text-sm text-black border" colspan="4">
                                                    {{ $products->address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Ukuran (Screen Size) - Orientasi
                                                </td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $products->size }}
                                                    ({{ $products->screen_w }} pixel x
                                                    {{ $products->screen_h }} pixel)
                                                    -
                                                    {{ $products->orientation }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Ukuran - Konfigurasi Pixel</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $products->pixel_pitch }}
                                                    -
                                                    {{ $products->pixel_configuration }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Kerapatan Pixel</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $products->pixel_density }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Jarak Pandang Terbaik</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $products->view_distancing }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Sudut Pandang Terbaik</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $products->view_angle_h }}(W)
                                                    {{ $products->view_angle_v }}(H)</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Refresh Rate</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $products->refresh_rate }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $start = explode(':', date('H:i', strtotime($products->start_at)));
                                                $end = explode(':', date('H:i', strtotime($products->end_at)));
                                                $duration_hours = (int) $end[0] - (int) $start[0];
                                                $duration_second = $duration_hours * 60 * 60;
                                                ?>
                                                <td class="px-4 text-xs text-black border">Waktu Tayang</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ date('H:i', strtotime($products->start_at)) }} s.d
                                                    {{ date('H:i', strtotime($products->end_at)) }}
                                                    ({{ $duration_hours }} jam per hari)</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Durasi Video</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $products->duration }}
                                                    detik /
                                                    slot</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Jumlah Slot</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $products->slots }} slot
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Jumlah Spot</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $duration_second / $products->duration / $products->slots }}
                                                    spot
                                                    /
                                                    slot /
                                                    hari
                                                </td>
                                            </tr>
                                            @if ($price->priceType[0] == true)
                                                <tr>
                                                    <td class="px-4 text-xs text-black border" rowspan="2">Harga
                                                        Sharing
                                                        (per slot)</td>
                                                    @foreach ($share_price as $share)
                                                        @if ($share->checkbox == true)
                                                            <td class="border text-center text-xs text-black bg-slate-200">
                                                                {{ $share->title }}</td>
                                                        @else
                                                            <td class="border text-center text-xs text-black bg-slate-200"
                                                                hidden>
                                                                {{ $share->title }}</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach ($share_price as $share)
                                                        @if ($share->checkbox == true)
                                                            <td
                                                                class="border text-center text-xs text-black font-semibold">
                                                                Rp.
                                                                {{ number_format($share->price) }},-</td>
                                                        @else
                                                            <td class="border text-center text-xs text-black font-semibold"
                                                                hidden>Rp. {{ number_format($share->price) }},-</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endif
                                            @if ($price->priceType[1] == true)
                                                <tr>
                                                    <td class="px-4 text-xs text-black border" rowspan="2">Harga
                                                        eksklusif
                                                        (4 slot)</td>
                                                    @foreach ($ex_price as $exclusive)
                                                        @if ($exclusive->checkbox == true)
                                                            <td class="border text-center text-xs text-black bg-slate-200">
                                                                {{ $exclusive->title }}</td>
                                                        @else
                                                            <td class="border text-center text-xs text-black bg-slate-200"
                                                                hidden>
                                                                {{ $exclusive->title }}</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach ($ex_price as $exclusive)
                                                        @if ($exclusive->checkbox == true)
                                                            <td
                                                                class="border text-center text-xs text-black font-semibold">
                                                                Rp. {{ number_format($exclusive->price) }},-</td>
                                                        @else
                                                            <td class="border text-center text-xs text-black font-semibold"
                                                                hidden>
                                                                Rp. {{ number_format($exclusive->price) }},-</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
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

                            <div class="h-[1125px]">
                                <div class="flex justify-center">
                                    <div class="flex mt-4">
                                        <label class="ml-1 w-[721px] text-sm">{{ $videotron_quotation->body_end }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <?php
                                    $quotationDate = date('d F Y', strtotime($videotron_quot_revision->created_at));
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
                                            class="ml-1 text-sm text-black flex font-semibold"value="{{ $modified_by->name }}"
                                            type="text">
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <input class="ml-1 text-sm text-black flex" value="{{ $modified_by->position }}"
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
                @include('dashboard.layouts.vt-location')
                <!-- View Location end -->
            </div>
        </div>
        <input type="text" id="saveName"
            value="{{ $videotron_quot_revision->number }}- Cetak & Pasang - {{ $videotron_quotation->client->name }}"
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
