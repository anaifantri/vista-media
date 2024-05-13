@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Billboard start -->
    <div class="flex justify-center bg-black">
        <input id="code" type="text" value="{{ $billboard->code }}" hidden>
        <input id="city" type="text" value="{{ $billboard->city->city }}" hidden>
        <input id="address" type="text" value="{{ $billboard->address }}" hidden>
        <div class="mt-10">
            <!-- Title Show Billboard start -->
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
                    href="/dashboard/media/billboards">
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
            <!-- Title Show Billboard end -->
            <div>
                <div id="pdfPreview" name="pdfPreview" class="ml-2 w-[780px] h-[1100px] bg-white mt-2">
                    <div class="flex w-full justify-center items-center">
                        <img class="mt-3" src="/img/logo-vm.png" alt="">
                    </div>
                    <div class="flex w-full justify-center items-center mt-2">
                        <img src="/img/line-top.png" alt="">
                    </div>
                    <div class="flex w-full h-[44px] justify-center items-center mt-1">
                        <div class="flex w-[700px] h-[44px] justify-start items-center bg-slate-50 border rounded-t-xl">
                            <span
                                class="flex justify-end items-center w-20 h-[36px] text-lg text-red-700 font-bold">{{ $billboard->code }}</span>
                            <span class="flex justify-start items-center w-24 h-[36px] text-lg font-bold ml-1"> -
                                {{ $billboard->city->code }}
                            </span>
                            <img class="h-10" src="/img/code-line.png" alt="">
                            <span
                                class="flex items-center w-[575px] h-[36px] text-base font-semibold">{{ $billboard->address }}
                                | {{ strtoupper($billboard->area->area) }}</span>
                        </div>
                    </div>
                    <div class="flex w-full h-[465px] justify-center mt-[1px]">
                        <div class="flex w-[700px] h-[465px] justify-center items-center bg-slate-50 border rounded-b-xl">
                            @foreach ($billboard_photos as $photo)
                                @if ($photo->billboard_code == $billboard->code && $photo->company_id == '1')
                                    <img class="m-auto w-[670px] h-[435px]" src="{{ asset('storage/' . $photo->photo) }}"
                                        alt="">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="flex w-full h-[385px] justify-center mt-1">
                        <div class="flex w-[700px] h-[385px] bg-white">
                            <div class="flex w-[476px] h-[385px] bg-white justify-center">
                                <div class="">
                                    <div
                                        class="flex w-[476px] h-7 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                        Google Maps
                                        Koordinat :
                                        {{ number_format($billboard->lat, 7) . ', ' . number_format($billboard->lng, 7) }}
                                    </div>
                                    <div class="flex relative w-[476px] h-[355px] mt-[1px] rounded-b-lg">
                                        <div class="flex absolute w-[100px] mt-[250px] ml-1">
                                            {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $billboard->lat . ',' . $billboard->lng . '/@' . $billboard->lat . ',' . $billboard->lng . ',16z') }}
                                        </div>
                                        <?php
                                        $src = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $billboard->lat . ',' . $billboard->lng . '&zoom=16&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' . $billboard->lat . ',' . $billboard->lng . '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                                        ?>
                                        <img class="w-[476px] h-[355px] border rounded-b-xl" id="myImage" name="myImage"
                                            src="{{ $src }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="flex w-[220px] h-[385px] bg-white justify-center ml-1">
                                <div class="">
                                    <div
                                        class="flex p-1 items-center justify-center w-[220px] h-7 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                        Deskripsi Billboard
                                    </div>
                                    <div class="w-[220px] h-[92px] bg-slate-50 mt-[1px] rounded-b-lg border">
                                        <div class="flex mt-1">
                                            <span
                                                class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Jenis</span>
                                            <span
                                                class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                {{ $billboard->billboard_category->name }}
                                            </span>
                                        </div>
                                        <div class="flex mt-1">
                                            <span
                                                class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Ukuran</span>
                                            <span
                                                class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                {{ $billboard->size->size }}</span>
                                        </div>
                                        <div class="flex mt-1">
                                            <span
                                                class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Orientasi</span>
                                            <span
                                                class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                {{ $billboard->orientation }}
                                            </span>
                                        </div>
                                        <div class="flex mt-1">
                                            <span
                                                class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Penerangan</span>
                                            <span
                                                class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                {{ $billboard->lighting }}
                                            </span>
                                        </div>
                                    </div>
                                    <div
                                        class="flex w-[220px] h-7 p-1 bg-slate-50 mt-[1px] border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                        Informasi Area
                                    </div>
                                    <div class="flex w-[220px] h-[234px] border bg-slate-50 mt-[1px] rounded-b-lg">
                                        <div>
                                            <div class="flex">
                                                <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type
                                                    Jalan</span>
                                                <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                    {{ $billboard->road_segment }}
                                                </span>
                                            </div>
                                            <div class="flex">
                                                <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                                    Pandang</span>
                                                <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                    {{ $billboard->max_distance }}
                                                </span>
                                            </div>
                                            <div class="flex">
                                                <span
                                                    class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                                    Kend.</span>
                                                <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                                    {{ $billboard->speed_average }}
                                                </span>
                                            </div>
                                            <div class="flex">
                                                <span
                                                    class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                                    <br><br><br><br><br>
                                                    {{ QrCode::size(100)->generate('https://vistamedia.co.id/dashboard/media/billboards/preview/' . $billboard->id) }}
                                                </span>
                                                <span class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                                    <div>:</div>

                                                    <?php
                                                    $data = $billboard->sector;
                                                    $sectors = explode('-', $data);
                                                    ?>
                                                    <div>
                                                        @foreach ($sectors as $key => $sector)
                                                            @if ($sector != end($sectors))
                                                                <div>
                                                                    - {{ $sector }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex
                                w-full h-max justify-center mt-1">
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
            <div class="h-10"></div>
        </div>
    </div>
    <!-- Show Billboard end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const code = document.getElementById("code");
        const city = document.getElementById("city");
        const address = document.getElementById("address");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: code.value + ' - ' + city.value + ' - ' + address.value + '.pdf',
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
                    unit: 'in',
                    format: 'a4',
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
