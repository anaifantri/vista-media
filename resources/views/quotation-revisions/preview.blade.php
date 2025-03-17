@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <?php
    $products = json_decode($quotation_revision->products);
    $client = json_decode($quotation_revision->quotation->clients);
    $modified_by = json_decode($quotation_revision->modified_by);
    $price = json_decode($quotation_revision->price);
    $payment_terms = json_decode($quotation_revision->payment_terms);
    $notes = json_decode($quotation_revision->notes);
    $number = Str::substr($quotation_revision->number, 0, 9);
    if ($category == 'Signage') {
        $dataDescription = json_decode($products[0]->description);
    }
    
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <div class="flex justify-center bg-black p-10">
        <div>
            <!-- Title Show Quotatin start -->
            <div class="flex border-b">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
                    type="button">
                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1">Save PDF</span>
                </button>
                @if (auth()->check())
                    <a class="flex justify-center items-center mx-1 btn-danger"
                        href="/marketing/quotations/{{ $quotation_revision->quotation->id }}">
                        <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                        <span class="mx-1">Close</span>
                    </a>
                @endif
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
                    <div class="w-[950px] h-[1345px] p-4 mt-1 bg-white">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1100px]">
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Nomor</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-black">{{ $quotation_revision->number }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label
                                            class="ml-1 text-sm text-black">{{ $quotation_revision->quotation->attachment }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label
                                            class="ml-1 text-sm text-black">{{ $quotation_revision->quotation->subject }}</label>
                                    </div>
                                    <div class="mt-4">
                                        <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                        @if ($client->type == 'Perorangan')
                                            <label
                                                class="flex ml-1 text-sm text-black font-semibold">{{ $client->name }}</label>
                                        @else
                                            <label
                                                class="flex ml-1 text-sm text-black font-semibold">{{ $client->company }}</label>
                                            @if ($client->contact_gender == 'Male')
                                                <label class="flex ml-1 text-sm text-black font-semibold">Bapak
                                                    {{ $client->contact_name }}</label>
                                            @else
                                                <label class="flex ml-1 text-sm text-black font-semibold">Ibu
                                                    {{ $client->contact_name }}</label>
                                            @endif
                                        @endif
                                        <label class="flex ml-1 text-sm text-black">Di -</label>
                                        <label class="flex ml-6 text-sm text-black">Tempat</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black w-20">Email</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        @if ($client->type == 'Perorangan')
                                            <label class="ml-1 text-sm text-black ">{{ $client->email }}</label>
                                        @else
                                            <label class="ml-1 text-sm text-black ">{{ $client->contact_email }}</label>
                                        @endif
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        @if ($client->type == 'Perorangan')
                                            <label class="ml-1 text-sm text-black ">{{ $client->phone }}</label>
                                        @else
                                            <label class="ml-1 text-sm text-black ">{{ $client->contact_phone }}</label>
                                        @endif
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $quotation_revision->quotation->body_top }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- table start -->
                            <div class="ml-2">
                                <div class="flex justify-center">
                                    @if ($category == 'Service')
                                        @include('quotations.service-show-table')
                                    @else
                                        @if ($category == 'Videotron' || ($category == 'Signage' && $dataDescription->type == 'Videotron'))
                                            @include('quotations.vt-show-table')
                                        @else
                                            @include('quotations.bb-show-table')
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <!-- table end -->

                            <!-- quotation note start -->
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                    </div>
                                    <div>
                                        @foreach ($notes->dataNotes as $note)
                                            @if ($category == 'Service')
                                                <label class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                            @else
                                                @if ($category == 'Videotron' || ($category == 'Signage' && $dataDescription->type == 'Videotron'))
                                                    @if ($loop->iteration == 3 || $loop->iteration == 4)
                                                        <label
                                                            class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                    @else
                                                        <label
                                                            class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                    @endif
                                                @else
                                                    @if ($notes->freePrint != 0 && $notes->freeInstall != 0)
                                                        @if ($loop->iteration == 3 || $loop->iteration == 4 || $loop->iteration == 5)
                                                            <label
                                                                class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                        @else
                                                            <label
                                                                class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                        @endif
                                                    @elseif (($notes->freePrint == 0 && $notes->freeInstall != 0) || ($notes->freePrint != 0 && $notes->freeInstall == 0))
                                                        @if ($loop->iteration == 3 || $loop->iteration == 4)
                                                            <label
                                                                class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                        @else
                                                            <label
                                                                class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                        @endif
                                                    @elseif ($notes->freePrint == 0 && $notes->freeInstall == 0)
                                                        @if ($loop->iteration == 3)
                                                            <label
                                                                class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                        @else
                                                            <label
                                                                class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                        @endif
                                                    @else
                                                        <label
                                                            class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                    @endif
                                                @endif
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
                                        <label
                                            class="ml-1 w-[721px] text-sm">{{ $quotation_revision->quotation->body_end }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-4">
                                        <label class="ml-1 text-sm text-black flex">Denpasar,
                                            {{ date('d', strtotime($quotation_revision->created_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($quotation_revision->created_at))] }}
                                            {{ date('Y', strtotime($quotation_revision->created_at)) }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="flex w-[725px]">
                                        <div class="mt-2">
                                            <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista
                                                Media</label>
                                            <label
                                                class="ml-1 mt-10 text-sm text-black flex font-semibold"><u>{{ $modified_by->name }}</u></label>
                                            <label
                                                class="flex ml-1 text-sm text-black">{{ $modified_by->position }}</label>
                                            <label class="flex ml-1 text-sm text-black">Hp.
                                                {{ $modified_by->phone }}</label>
                                        </div>
                                        <div class="flex ml-4 mt-2">
                                            {{ QrCode::size(100)->generate('http://vistamedia.co.id/quotation-revisions/preview/' . $category . '/' . Crypt::encrypt($quotation_revision->id)) }}
                                        </div>
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
                @if ($category != 'Service')
                    @foreach ($products as $product)
                        @php
                            $description = json_decode($product->description);
                            $sectors = json_decode($product->sector);

                            if ($product->category == 'Signage') {
                                $mapsLink =
                                    'https://maps.googleapis.com/maps/api/staticmap?center=' .
                                    $description->lat[0] .
                                    ',' .
                                    $description->lng[0] .
                                    '&zoom=17&size=480x355&maptype=terrain';
                                $mapsMarkers = '';
                                $googleKey = '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                                for ($i = 0; $i < count($description->lat); $i++) {
                                    $mapsMarkers =
                                        $mapsMarkers .
                                        '&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' .
                                        $description->lat[$i] .
                                        ',' .
                                        $description->lng[$i];
                                }
                                $src = $mapsLink . $mapsMarkers . $googleKey;
                            } else {
                                $src =
                                    'https://maps.googleapis.com/maps/api/staticmap?center=' .
                                    $description->lat .
                                    ',' .
                                    $description->lng .
                                    '&zoom=16&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' .
                                    $description->lat .
                                    ',' .
                                    $description->lng .
                                    '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                            }
                        @endphp
                        <div class="flex justify-center w-full">
                            <div class="w-[950px] h-[1345px] p-4 mt-1 bg-white">
                                <!-- Header start -->
                                @include('dashboard.layouts.letter-header')
                                <!-- Header end -->
                                <!-- Body start -->
                                <div class="h-[1110px]">
                                    <div class="flex w-full h-[50px] justify-center items-center mt-1">
                                        <div
                                            class="flex w-[800px] h-[50px] justify-start items-center bg-slate-50 border rounded-t-xl">
                                            <span
                                                class="flex justify-end items-center w-20 h-[42px] text-lg text-red-700 font-bold">{{ $product->code }}</span>
                                            <span
                                                class="flex justify-start items-center w-20 h-[42px] text-lg font-bold ml-1">
                                                -
                                                {{ $product->city_code }}
                                            </span>
                                            <img class="h-10" src="/img/code-line.png" alt="">
                                            <span
                                                class="flex items-center w-[575px] h-[42px] text-base font-semibold">{{ $product->address }}
                                                | {{ strtoupper($product->area) }}</span>
                                        </div>
                                    </div>
                                    <div class="flex w-full h-[570px] justify-center mt-2">
                                        <div
                                            class="flex w-[800px] h-[570px] justify-center items-center bg-slate-50 border rounded-b-xl">
                                            <img class="m-auto w-[770px] h-[540px]"
                                                src="{{ asset('storage/' . $product->photo) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex w-full justify-center mt-2 h-[470px] bg-white">
                                        <div class="w-[544px] h-[470px] bg-white justify-center">
                                            <div
                                                class="flex w-[544px] h-10 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                Google Maps Koordinat :
                                                @if ($category == 'Signage')
                                                    {{ number_format($description->lat[0], 7) . ', ' . number_format($description->lng[0], 7) }}
                                                @else
                                                    {{ number_format($description->lat, 7) . ', ' . number_format($description->lng, 7) }}
                                                @endif
                                            </div>
                                            <div class="flex relative w-[544px] h-[430px] mt-1 rounded-b-lg">
                                                <div class="flex absolute w-[100px] mt-[325px] ml-1">
                                                    @if ($category == 'Signage')
                                                        {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $description->lat[0] . ',' . $description->lng[0] . '/@' . $description->lat[0] . ',' . $description->lng[0] . ',16z') }}
                                                    @else
                                                        {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $description->lat . ',' . $description->lng . '/@' . $description->lat . ',' . $description->lng . ',16z') }}
                                                    @endif
                                                </div>
                                                <img class="w-[544px] h-[430px] border rounded-b-xl" id="myImage"
                                                    name="myImage" src="{{ $src }}" alt="">
                                            </div>
                                        </div>
                                        <div class="w-[256px] h-[470px] bg-white justify-center ml-1">
                                            <div
                                                class="flex p-1 items-center justify-center w-[256px] h-10 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                Deskripsi Lokasi
                                            </div>
                                            @if ($category == 'Billboard' || $category == 'Bando' || $category == 'Baliho' || $category == 'Midiboard')
                                                @include('quotations.bb-description-show')
                                            @elseif ($category == 'Videotron')
                                                @include('quotations.vt-description-show')
                                            @elseif ($category == 'Signage')
                                                @include('quotations.sn-description-show')
                                            @endif
                                            <div
                                                class="flex w-[256px] h-10 p-1 bg-slate-50 mt-1 border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                Informasi Area
                                            </div>
                                            <div class="w-[256px] h-[212px] border bg-slate-50 mt-1 rounded-b-lg">
                                                <div class="flex">
                                                    <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type
                                                        Jalan</span>
                                                    <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                        {{ $product->road_segment }}
                                                    </span>
                                                </div>
                                                <div class="flex">
                                                    <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                                        Pandang</span>
                                                    <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                        {{ $product->max_distance }}
                                                    </span>
                                                </div>
                                                <div class="flex">
                                                    <span
                                                        class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                                        Kend.</span>
                                                    <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                                        {{ $product->speed_average }}
                                                    </span>
                                                </div>
                                                <div class="flex">
                                                    <div>
                                                        <span
                                                            class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                                        </span>
                                                        <span class="w-[100px] flex mt-[40px] ml-2">
                                                            {{ QrCode::size(100)->generate('https://vistamedia.co.id/locations/guest-preview/' . $category . '/' . Crypt::encrypt($product->id)) }}
                                                        </span>
                                                    </div>
                                                    <span class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                                        <div>:</div>
                                                        <div>
                                                            @foreach ($sectors->dataSector as $sector)
                                                                <div>
                                                                    - {{ $sector }}
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Body start -->
                                <!-- Footer start -->
                                @include('dashboard.layouts.letter-footer')
                                <!-- Footer end -->
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- View Location end -->
            </div>
        </div>
        @if ($category == 'Service')
            <input id="saveName" type="text" value="{{ $number }}-Cetak-Pasang-{{ $client->name }}" hidden>
        @else
            <input id="saveName" type="text" value="{{ $number }}-{{ $category }}-{{ $client->name }}"
                hidden>
        @endif
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
                    scale: 2,
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
