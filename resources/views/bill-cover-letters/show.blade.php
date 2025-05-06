@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    $content = json_decode($bill_cover_letter->content);
    $client = $content->client;
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-4 border rounded-md">
            <div class="flex border-b">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
                    type="button">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1">Save PDF</span>
                </button>
                <a class="flex justify-center items-center mx-1 btn-danger"
                    href="/bill-cover-letters/index/{{ $company->id }}">
                    <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                    <span class="mx-1">Close</span>
                </a>
            </div>
            @if (session()->has('success'))
                <div class="mt-2 flex alert-success">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            <div class="flex justify-center w-full">
                <div id="pdfPreview" class="w-[950px] h-[1345px] bg-white p-2 mt-2">
                    <!-- Header start -->
                    @include('dashboard.layouts.letter-header')
                    <!-- Header end -->
                    <!-- Body start -->
                    <div class="h-[1100px]">
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-2">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                    <label class="ml-1 text-sm text-black">:</label>
                                    <label class="ml-1 text-sm text-black">{{ $bill_cover_letter->number }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label id="createAttachment" class="ml-1 text-sm text-black flex">1 (Satu)
                                        Set</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label id="createSubject" class="ml-1 text-sm text-black flex">
                                        Pengantar Tagihan
                                    </label>
                                </div>
                                <div class="flex mt-4">
                                    <div>
                                        <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                        <label
                                            class="ml-1 text-sm text-black font-semibold flex">{{ $client->company }}</label>
                                        <label class="ml-1 text-sm text-black flex">Di -</label>
                                        <label class="ml-6 text-sm text-black flex">Tempat</label>
                                    </div>
                                </div>
                                <div class="flex mt-6">
                                    <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                </div>
                                <div class="flex mt-2 text-justify w-[721px] text-sm">
                                    {{ $content->letter_top }}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center mt-2">
                            <div id="attachment" class="w-[650px]">
                                @foreach ($content->attachments as $item)
                                    <div class="flex text-sm">
                                        <label>{{ $loop->iteration }}. </label>
                                        <label class="ml-2">{{ $item }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-center">
                                <div class="w-[721px] mt-4 text-sm text-justify">Demikian surat ini kami sampaikan dan
                                    mohon kiranya dapat diterima dengan baik, atas perhatian dan kerjasamanya kami
                                    ucapkan terima kasih.
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-10">
                                    <label class="ml-1 text-sm text-black flex">Denpasar,
                                        {{ date('d', strtotime($bill_cover_letter->created_at)) }}
                                        {{ $bulan[(int) date('m', strtotime($bill_cover_letter->created_at))] }}
                                        {{ date('Y', strtotime($bill_cover_letter->created_at)) }}</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[725px]">
                                    <label class="ml-1 text-sm text-black flex font-semibold">{{ $company->name }}</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-16">
                                    <label id="salesUser" class="ml-1 text-sm text-black flex font-semibold"><u>Texun
                                            Sandy Kamboy</u></label>
                                    <label id="salesPhone" class="ml-1 text-xs text-black flex">Direktur</label>
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
        </div>
    </div>
    @if ($content->category == 'Service')
        <input id="saveName" type="text"
            value="{{ substr($bill_cover_letter->number, 0, 4) }}-SP-Revisual-{{ $client->company }}" hidden>
    @else
        <input id="saveName" type="text"
            value="{{ substr($bill_cover_letter->number, 0, 4) }}-SP-Media-{{ $client->company }}" hidden>
    @endif

    <!-- Script start-->
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
    <!-- Script end-->
@endsection
