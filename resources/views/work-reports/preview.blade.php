@extends('dashboard.layouts.main');

@section('container')
    @php

        function hari_ini($getNow)
        {
            $getDay = date('D', strtotime($getNow));
            $getMonth = [
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember',
            ];

            switch ($getDay) {
                case 'Sun':
                    $getToday = 'Minggu';
                    break;
                case 'Mon':
                    $getToday = 'Senin';
                    break;
                case 'Tue':
                    $getToday = 'Selasa';
                    break;
                case 'Wed':
                    $getToday = 'Rabu';
                    break;
                case 'Thu':
                    $getToday = 'Kamis';
                    break;
                case 'Fri':
                    $getToday = 'Jumat';
                    break;
                case 'Sat':
                    $getToday = 'Sabtu';
                    break;
            }

            return $getToday .
                ', tanggal ' .
                date('d', strtotime($getNow)) .
                ' bulan ' .
                $getMonth[(int) date('m', strtotime($getNow))] .
                ' tahun ' .
                date('Y', strtotime($getNow));
        }
        if ($content->format == 'gg') {
            $ggCategories = ['Billboard', 'Baliho', 'Neon Box', 'LED', 'JPO', 'Lainnya ...............'];
        }
        $fullMonth = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    @endphp
    <div class="flex justify-center bg-black p-10">
        <div>
            <!-- Title start -->
            <div class="flex border-b">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
                    type="button">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1 text-white">Save PDF</span>
                </button>
                @if (auth()->check())
                    <a href="/accounting/work-reports/{{ $work_report->id }}/edit"
                        class="flex items-center justify-center btn-warning mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Edit </span>
                    </a>
                    <a class="flex justify-center items-center mx-1 btn-danger"
                        href="/work-reports/index/{{ $company->id }}">
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
            <!-- Title end -->
            <div id="pdfPreview">
                <div class="flex justify-center w-full">
                    <div>
                        @include('work-reports.preview-' . $content->format)
                        {{-- @include('work-reports.preview-standar') --}}
                    </div>
                </div>
                <!-- Documentation start -->
                <div class="flex justify-center w-full mt-2">
                    <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->

                        <!-- Body start -->
                        <div class="h-[1100px] w-full flex justify-center mt-2">
                            <div class="flex justify-center w-full">
                                <div class="w-[780px]">
                                    <div
                                        class="flex justify-center w-full font-serif mt-4 text-md tracking-wider font-bold">
                                        <label class="border-b-2 border-black">
                                            DOKUMENTASI PEKERJAAN
                                        </label>
                                    </div>
                                    <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24 mt-8">
                                        <span class="w-28">Pekerjaan</span>
                                        <span>:</span>
                                        <span class="ml-2">{{ $content->type }}</span>
                                    </div>
                                    <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24">
                                        <span class="w-28">Lokasi</span>
                                        <span>:</span>
                                        <span class="ml-2">{{ $content->location_address }}</span>
                                    </div>
                                    @if ($work_report->sale->media_category->name == 'Service')
                                        <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24">
                                            <span class="w-28">Tema</span>
                                            <span>:</span>
                                            <span class="ml-2">{{ $content->theme }}</span>
                                        </div>
                                    @else
                                        <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24">
                                            <span class="w-28">Periode</span>
                                            <span>:</span>
                                            <span class="ml-2">{{ $content->periode }}</span>
                                        </div>
                                    @endif
                                    <div class="flex w-full justify-center font-serif mt-6 text-sm font-semibold">
                                        @if ($first_photo_title != 'null' && $first_photo_title != '')
                                            <u>{{ $first_photo_title }}</u>
                                        @endif
                                    </div>
                                    <div class="flex justify-center w-full mt-2">
                                        <img id="previewFirstPhoto"
                                            class="border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
                                            src="{{ asset('storage/' . $first_photo) }}">
                                    </div>
                                    <div class="flex w-full justify-center font-serif mt-6 text-sm font-semibold">
                                        @if ($second_photo_title != 'null' && $second_photo_title != '')
                                            <u>{{ $second_photo_title }}</u>
                                        @endif
                                    </div>
                                    <div class="flex justify-center w-full mt-2">
                                        <img id="previewSecondPhoto"
                                            class="border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
                                            src="{{ asset('storage/' . $second_photo) }}">
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
                <!-- Documentation end -->
            </div>
        </div>
        @if ($content->category == 'Service')
            @if (isset($content->client->company))
                <input id="saveName" type="text"
                    value="{{ substr($work_report->number, 0, 4) }}-BAPP-Revisual-{{ $content->client->company }}-{{ $content->location_address }}"
                    hidden>
            @else
                <input id="saveName" type="text"
                    value="{{ substr($work_report->number, 0, 4) }}-BAPP-Revisual-{{ $content->client->name }}-{{ $content->location_address }}"
                    hidden>
            @endif
        @else
            @if (isset($content->client->company))
                <input id="saveName" type="text"
                    value="{{ substr($work_report->number, 0, 4) }}-BAPP-Media-{{ $content->client->company }}-{{ $content->location_address }}"
                    hidden>
            @else
                <input id="saveName" type="text"
                    value="{{ substr($work_report->number, 0, 4) }}-BAPP-Media-{{ $content->client->name }}-{{ $content->location_address }}"
                    hidden>
            @endif
        @endif
    </div>

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
                filename: saveName.value + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 300,
                    scale: 1,
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
@endsection
