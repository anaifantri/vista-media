@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
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
        if (count($sale->quotation->quotation_revisions) != 0) {
            $quotationDeal = $sale->quotation->quotation_revisions->last();
            $price = json_decode($quotationDeal->price);
        } else {
            $quotationDeal = $sale->quotation;
            $price = json_decode($quotationDeal->price);
        }
        $getService = '';

        if ($sale->media_category->name == 'Service') {
            if ($price->objServiceType->print == true && $price->objServiceType->install == true) {
                $getService = 'Cetak dan Pasang';
            } elseif ($price->objServiceType->print == true && $price->objServiceType->install == false) {
                $getService = 'Cetak';
            } elseif ($price->objServiceType->print == false && $price->objServiceType->install == true) {
                $getService = 'Pasang';
            }
        }

        $product = json_decode($sale->product);
        $description = json_decode($product->description);
        $client = json_decode($sale->quotation->clients);

        $content = new stdClass();
        $content->install_order_id = $install_order->id;
        $content->category = $sale->media_category->name;
        if (request('bast_date')) {
            $content->date = request('bast_date');
        } else {
            $content->date = date('Y-m-d');
        }
        if ($sale->media_category->name == 'Service') {
            $content->periode = '';
            $content->type = 'Jasa ' . $getService . ' ' . 'Visual Media Luar Ruang';
            if ($product->category == 'Signage') {
                $content->qty = (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) * $description->qty;
            } else {
                $content->qty = (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT);
            }
        } else {
            $content->qty = 1;
            $content->periode =
                date('d', strtotime($sale->start_at)) .
                ' ' .
                $fullMonth[(int) date('m', strtotime($sale->start_at))] .
                ' ' .
                date('Y', strtotime($sale->start_at)) .
                ' s.d. ' .
                date('d', strtotime($sale->end_at)) .
                ' ' .
                $fullMonth[(int) date('m', strtotime($sale->end_at))] .
                ' ' .
                date('Y', strtotime($sale->end_at));
            $content->type = 'Jasa Penempatan Media Luar Ruang';
            // if (
            //     $sale->media_category->name != 'Videotron' ||
            //     ($sale->media_category->name == 'Signage' && $description->type != 'Videotron')
            // ) {
            //     $content->type = 'Jasa Penempatan Media Luar Ruang' . $sale->media_category->name . ' ' . $description->lighting;
            // } else {
            //     'Penempatan Media ' . $sale->media_category->name;
            // }
        }
        $content->theme = $install_order->theme;
        $content->location_size = $product->size . ' x ' . $product->side . ' - ' . $product->orientation;
        $content->location_address = $product->address;
        $content->location_type = $product->category;
        $content->location_orientation = $product->orientation;
        if (
            $product->category != 'Videotron' ||
            ($product->category == 'Signage' && $description->type != 'Videotron')
        ) {
            $content->location_lighting = $description->lighting;
        } else {
            $content->location_lighting = '';
        }
        $content->location_code = $product->code . '-' . $product->city_code;
        $content->client = $client;
        if (count($quotation_orders) > 0) {
            if (count($quotation_orders) == 2) {
                $content->po_number = $quotation_orders[0]->number . ' & ' . $quotation_orders[1]->number;
                $content->po_date =
                    date('d', strtotime($quotation_orders[0]->date)) .
                    ' ' .
                    $fullMonth[(int) date('m', strtotime($quotation_orders[0]->date))] .
                    ' ' .
                    date('Y', strtotime($quotation_orders[0]->date)) .
                    ' & ' .
                    date('d', strtotime($quotation_orders[1]->date)) .
                    ' ' .
                    $fullMonth[(int) date('m', strtotime($quotation_orders[1]->date))] .
                    ' ' .
                    date('Y', strtotime($quotation_orders[1]->date));
            } else {
                $content->po_number = $quotation_orders[0]->number;
                $content->po_date =
                    date('d', strtotime($quotation_orders[0]->date)) .
                    ' ' .
                    $fullMonth[(int) date('m', strtotime($quotation_orders[0]->date))] .
                    ' ' .
                    date('Y', strtotime($quotation_orders[0]->date));
            }
        } else {
            $content->po_number = '';
            $content->po_date = '';
        }
        if (count($quotation_agreements) > 0) {
            $content->agreement_number = $quotation_agreements[0]->number;
            $content->agreement_date =
                date('d', strtotime($quotation_agreements[0]->date)) .
                ' ' .
                $fullMonth[(int) date('m', strtotime($quotation_agreements[0]->date))] .
                ' ' .
                date('Y', strtotime($quotation_agreements[0]->date));
        } else {
            $content->agreement_number = '';
            $content->agreement_date = '';
        }
        $content->note = '';
        if (request('bast_format')) {
            $content->format = request('bast_format');
            if (request('bast_format') == 'gg') {
                $content->brand = '';
                $content->lep = true;
                $content->bapp = true;
                if (request('bast_sale_status')) {
                    $content->bast_sale_status = request('bast_sale_status');
                } else {
                    $content->bast_sale_status = 'new';
                }
                if (request('lep_sale_status')) {
                    $content->lep_sale_status = request('lep_sale_status');
                } else {
                    $content->lep_sale_status = 'new';
                }
                $ggCategories = ['Billboard', 'Baliho', 'Neon Box', 'LED', 'JPO', 'Lainnya ...............'];
            } elseif (request('bast_format') == 'sampoerna') {
                $content->detail = [];
                $content->tax = true;
                $content->pmlr = true;
                $content->first_contact = 'Yoni Eka Sari';
                $content->first_contact_title = 'SCE Teritory';
                $content->second_contact = 'Texun Sandy Kamboy';
                $content->second_contact_title = 'Direktur';
                $content->known_contact = 'Raka Joe Soekarta';
                $content->known_contact_title = 'Manager Area Consumer Engagement (MICE)';
                array_push(
                    $content->detail,
                    'PMLR ' .
                        $product->category .
                        ' ' .
                        $description->lighting .
                        ', Lokasi : ' .
                        $content->location_address .
                        ', Ukuran : ' .
                        $content->location_size .
                        ', Periode : ' .
                        $content->periode,
                );
                array_push(
                    $content->detail,
                    'Tax ' .
                        $product->category .
                        ' ' .
                        $description->lighting .
                        ', Lokasi : ' .
                        $content->location_address .
                        ', Ukuran : ' .
                        $content->location_size .
                        ', Periode : ' .
                        $content->periode,
                );
            } elseif (request('bast_format') == 'djarum') {
                $content->brand = '';
                $content->lpj_start = '';
                $content->lpj_end = '';
                $content->lpj = true;
                $content->bast = true;
                $content->first =
                    'Nama : Texun Sandy Kamboy dalam hal ini bertindak atas nama PT. Vista Media berkedudukan di Jl. Pulau Kawe No 40 Dauh Puri Kauh Denpaasar Barat-Denpasar Bali, untuk selanjutnya disebut sebagai Pihak Pertama.';
                $content->second =
                    'Nama : Jonny Andriyanto dalam hal ini bertindak atas nama PT. Perada Swara Produtions berkedudukan di The Vida Office Building Lt.7 Jl Raya Perjuangan No. 8 Rt.001/Rw 007 Kebon Jeruk Jakarta Barat DKI Jakarta, untuk selanjutnya disebut sebagai Pihak Kedua.';
                $content->first_contact = 'Texun Sandy Kamboy';
                $content->second_contact = 'Jonny Andriyanto';
            } elseif (request('bast_format') == 'xl') {
                $content->detail = [];
                array_push(
                    $content->detail,
                    'Vista Media, telah menyelesaikan pekerjaan Media Luar Ruang di Site ' .
                        $content->location_address .
                        ' sesuan dengan SP3 tanggal ...........................................',
                );
                array_push(
                    $content->detail,
                    'XL telah menerima Media Luar Ruang tersebut dalam keadaan baik dan dapat dipergunakan sebagaimana dimaksud yaitu dengan cara membayar Media Luar Ruang kepada Vista Media.',
                );
                array_push(
                    $content->detail,
                    'Sesuai dengan Berita Acara Serah Terima ini diterbitkan, maka masa Media Luar Ruang dimulai dari tanggal ' .
                        $content->periode,
                );
            }
        } else {
            $content->format = 'standar';
        }

        $bastFormats = ['Standar', 'GG', 'Sampoerna', 'Djarum', 'XL'];

        $first_photos = new stdClass();
        $first_photos->title = $first_title;
        $first_photos->id = $first_photo->id;
        $first_photos->image = $first_photo->image;

        $second_photos = new stdClass();
        $second_photos->title = $second_title;
        $second_photos->id = $second_photo->id;
        $second_photos->image = $second_photo->image;

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <form method="post" action="/accounting/work-reports" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center w-[1200px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[1200px]">Membuat BAST</h1>
                    <!-- Title end -->
                    <div id="divButton" class="flex w-[150px] justify-end">
                        <a href="/work-reports/select-documentation/{{ $sale->id }}/{{ $bast_category }}"
                            class="flex justify-center items-center mx-1 btn-primary" title="Back">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1 text-white">Back</span>
                        </a>
                        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
                        <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
                        <input type="text" name="first_photo" value="{{ json_encode($first_photos) }}" hidden>
                        <input type="text" name="second_photo" value="{{ json_encode($second_photos) }}" hidden>
                        <input type="text" name="content" id="inputContent" value="{{ json_encode($content) }}" hidden>
                        <input type="text" name="created_by" value="{{ json_encode($created_by) }}" hidden>
                        <input type="text" name="updated_by" value="{{ json_encode($created_by) }}" hidden>
                        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="submit">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="mx-1 text-white">Save</span>
                        </button>
                    </div>
                    <div>
                        <a href="/work-reports/index/{{ $company->id }}"
                            class="flex justify-center items-center mx-1 btn-danger" title="Cancel">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1 text-white">Cancel</span>
                        </a>
                    </div>
                </div>
            </form>
            <div id="modalPreview">
                <div class="flex w-full">
                    <span class="text-center w-full text-lg font-bold text-white">Preview BAST</span>
                </div>

                <!-- BAST start -->
                <div class="flex justify-center w-full mt-4">
                    <div>
                        <form
                            action="/work-reports/select-format/{{ $sale->id }}/{{ $install_order->id }}/{{ $first_photo->id }}/{{ $first_title }}/{{ $second_photo->id }}/{{ $second_title }}/{{ $bast_category }}">
                            <div class="flex items-center w-[950px] border rounded-md px-2">
                                <span class="text-sm font-semibold text-white">Pilih format BAST :</span>
                                @foreach ($bastFormats as $format)
                                    @if (request('bast_format'))
                                        @if (request('bast_format') == strtolower($format))
                                            <input type="radio" name="bast_format" value="{{ strtolower($format) }}"
                                                class="ml-4 outline-none" onclick="submit()" checked>
                                            <span class="ml-2 text-sm font-semibold text-white">{{ $format }}</span>
                                        @else
                                            <input type="radio" name="bast_format" value="{{ strtolower($format) }}"
                                                class="ml-4 outline-none" onclick="submit()">
                                            <span class="ml-2 text-sm font-semibold text-white">{{ $format }}</span>
                                        @endif
                                    @else
                                        @if ($loop->iteration == 1)
                                            <input type="radio" name="bast_format" value="{{ strtolower($format) }}"
                                                class="ml-4 outline-none" onclick="submit()" checked>
                                            <span class="ml-2 text-sm font-semibold text-white">{{ $format }}</span>
                                        @else
                                            <input type="radio" name="bast_format" value="{{ strtolower($format) }}"
                                                class="ml-4 outline-none" onclick="submit()">
                                            <span class="ml-2 text-sm font-semibold text-white">{{ $format }}</span>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            @if (request('bast_format'))
                                @include('work-reports.' . request('bast_format'))
                            @else
                                @include('work-reports.standar')
                            @endif
                        </form>

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
                                                <span class="ml-2">{{ $product->address }}</span>
                                            </div>
                                            @if ($sale->media_category->name == 'Service')
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
                                                <label id="firstPhotoTitle"><u>{{ $first_title }}</u></label>
                                            </div>
                                            <div class="flex justify-center w-full mt-2">
                                                <img id="previewFirstPhoto"
                                                    class="border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
                                                    src="{{ asset('storage/' . $first_photo->image) }}">
                                            </div>
                                            <div class="flex w-full justify-center font-serif mt-6 text-sm font-semibold">
                                                <label id="secondPhotoTitle"><u>{{ $second_title }}</u></label>
                                            </div>
                                            <div class="flex justify-center w-full mt-2">
                                                <img id="previewSecondPhoto"
                                                    class="border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
                                                    src="{{ asset('storage/' . $second_photo->image) }}">
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
                <!-- BAST end -->

            </div>
        </div>
    </div>

    <script>
        let getContent = @json($content);

        getNote = (sel) => {
            getContent.note = sel.value;
            inputContent.value = JSON.stringify(getContent);
        }
        changeType = (sel) => {
            if (sel.value == "") {
                alert("Input pekerjaan tidak boleh kosong..");
                sel.value = sel.defaultValue;
            } else {
                getContent.type = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeLocation = (sel) => {
            if (sel.value == "") {
                alert("Input lokasi tidak boleh kosong..");
                sel.value = sel.defaultValue;
            } else {
                getContent.location_address = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeTheme = (sel) => {
            if (sel.value == "") {
                alert("Input tema tidak boleh kosong..");
                sel.value = sel.defaultValue;
            } else {
                getContent.theme = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeBrand = (sel) => {
            if (sel.value == "") {
                alert("Input brand tidak boleh kosong..");
                sel.value = sel.defaultValue;
            } else {
                getContent.brand = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeBastSaleStatus = (sel) => {
            getContent.bast_sale_status = sel.value;
            inputContent.value = JSON.stringify(getContent);
        }
        changeLepSaleStatus = (sel) => {
            getContent.lep_sale_status = sel.value;
            inputContent.value = JSON.stringify(getContent);
        }
        changeLepStatus = (sel) => {
            if (sel.checked == true) {
                getContent.lep = true;
                inputContent.value = JSON.stringify(getContent);
                document.getElementById("divLep").removeAttribute('hidden');
            } else {
                if (document.getElementById("bappStatus").checked == false) {
                    sel.checked = true;
                    alert("Minimal pilih salah satu..!!");
                } else {
                    getContent.lep = false;
                    inputContent.value = JSON.stringify(getContent);
                    document.getElementById("divLep").setAttribute('hidden', 'hidden');
                }
            }
        }
        changeBappStatus = (sel) => {
            if (sel.checked == true) {
                getContent.bapp = true;
                inputContent.value = JSON.stringify(getContent);
                document.getElementById("divBapp").removeAttribute('hidden');
            } else {
                if (document.getElementById("lepStatus").checked == false) {
                    sel.checked = true;
                    alert("Minimal pilih salah satu..!!");
                } else {
                    getContent.bapp = false;
                    inputContent.value = JSON.stringify(getContent);
                    document.getElementById("divBapp").setAttribute('hidden', 'hidden');
                }
            }
        }
        changeBastDjarumStatus = (sel) => {
            if (sel.checked == true) {
                getContent.bast = true;
                inputContent.value = JSON.stringify(getContent);
                document.getElementById("divBastDjarum").removeAttribute('hidden');
            } else {
                if (document.getElementById("lpjDjarumStatus").checked == false) {
                    sel.checked = true;
                    alert("Minimal pilih salah satu..!!");
                } else {
                    getContent.bast = false;
                    inputContent.value = JSON.stringify(getContent);
                    document.getElementById("divBastDjarum").setAttribute('hidden', 'hidden');
                }
            }
        }
        changeLpjDjarumStatus = (sel) => {
            if (sel.checked == true) {
                getContent.lpj = true;
                inputContent.value = JSON.stringify(getContent);
                document.getElementById("divLpjDjarum").removeAttribute('hidden');
            } else {
                if (document.getElementById("bastDjarumStatus").checked == false) {
                    sel.checked = true;
                    alert("Minimal pilih salah satu..!!");
                } else {
                    getContent.lpj = false;
                    inputContent.value = JSON.stringify(getContent);
                    document.getElementById("divLpjDjarum").setAttribute('hidden', 'hidden');
                }
            }
        }
        changeXlDetail = (sel) => {
            if (sel.value == "") {
                alert("Input poin " + (Number(sel.id) + 1) + " tidak boleh kosong..");
                sel.value = getContent.detail[Number(sel.id)];
            } else {
                getContent.detail[Number(sel.id)] = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changePmlrDetail = (sel) => {
            if (sel.value == "") {
                alert("Input PMLR tidak boleh kosong..");
                sel.value = getContent.detail[0];
            } else {
                getContent.detail[0] = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeTaxDetail = (sel) => {
            if (sel.value == "") {
                alert("Input Tax tidak boleh kosong..");
                sel.value = getContent.detail[1];
            } else {
                getContent.detail[1] = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeTax = (sel) => {
            if (sel.checked == true) {
                getContent.tax = true;
                inputContent.value = JSON.stringify(getContent);
            } else {
                if (document.getElementById("cbPmlr").checked == false) {
                    sel.checked = true;
                    alert("Minimal pilih salah satu..!!");
                } else {
                    getContent.tax = false;
                    inputContent.value = JSON.stringify(getContent);
                }
            }
        }
        changePmlr = (sel) => {
            if (sel.checked == true) {
                getContent.pmlr = true;
                inputContent.value = JSON.stringify(getContent);
            } else {
                if (document.getElementById("cbTax").checked == false) {
                    sel.checked = true;
                    alert("Minimal pilih salah satu..!!");
                } else {
                    getContent.pmlr = false;
                    inputContent.value = JSON.stringify(getContent);
                }
            }
        }
        changeSecond = (sel) => {
            if (sel.value == "") {
                alert("Input detail pihak kedua tidak boleh kosong..");
                sel.value = getContent.second;
            } else {
                getContent.second = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeSecondContact = (sel) => {
            if (sel.value == "") {
                alert("Input pihak kedua tidak boleh kosong..");
                sel.value = sel.defaultValue;
            } else {
                getContent.second_contact = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeFirstContact = (sel) => {
            if (sel.value == "") {
                alert("Input pihak pertama tidak boleh kosong..");
                sel.value = sel.defaultValue;
            } else {
                getContent.first_contact = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeFirstContactTitle = (sel) => {
            if (sel.value == "") {
                alert("Input jabatan pihak pertama tidak boleh kosong..");
                sel.value = sel.defaultValue;
            } else {
                getContent.first_contact_title = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeKnownContact = (sel) => {
            if (sel.value == "") {
                alert("Input mengetahui tidak boleh kosong..");
                sel.value = sel.defaultValue;
            } else {
                getContent.known_contact = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
        changeKnownContactTitle = (sel) => {
            if (sel.value == "") {
                alert("Input jabatan tidak boleh kosong..");
                sel.value = sel.defaultValue;
            } else {
                getContent.known_contact_title = sel.value;
                inputContent.value = JSON.stringify(getContent);
            }
        }
    </script>
@endsection
