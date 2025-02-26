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
        function hari_ini()
        {
            $getDay = date('D');
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
                date('d') .
                ' bulan ' .
                $getMonth[(int) date('m')] .
                ' tahun ' .
                date('Y');
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

        $dayDisable = false;
        $nightDisable = false;

        if (count($installation_photos) > 0) {
            if (count($first_photos) == 0) {
                $dayDisable = true;
                $first_photos = $second_photos;
            }

            if (count($second_photos) == 0) {
                $nightDisable = true;
                $second_photos = $first_photos;
            }
        } else {
            $nightDisable = true;
            $dayDisable = true;
        }

        $firstPhoto = new stdClass();
        $firstPhoto->id = '';
        $firstPhoto->title = '';
        $secondPhoto = new stdClass();
        $secondPhoto->id = '';
        $secondPhoto->title = '';

        $content = new stdClass();
        if (count($install_order) > 0) {
            $content->install_order_id = $install_order[0]->id;
        } else {
            $content->install_order_id = '';
        }
        $content->letter_top =
            'Pada hari ini <b>' .
            hari_ini() .
            '</b>
            telah dilaksanakan serah terima pekerjaan antara <b>' .
            $company->name .
            '</b> dan <b>' .
            $client->company .
            '</b> dengan rincian pekerjaan sebagai
            berikut :';
        $content->letter_bottom =
            'Demikian Berita Acara Serah Terima ini dibuat dan ditandatangani bersama untuk dapat dipergunakan sebagaimana mestinya';
        if ($sale->media_category->name == 'Service') {
            $content->type = 'Jasa ' . $getService . ' ' . 'Visual Media Luar Ruang';
        } else {
            if (
                $sale->media_category->name != 'Videotron' ||
                ($sale->media_category->name == 'Signage' && $description->type != 'Videotron')
            ) {
                $content->type = 'Penempatan Media ' . $sale->media_category->name . ' ' . $description->lighting;
            } else {
                'Penempatan Media ' . $sale->media_category->name;
            }
        }
        if ($sale->media_category->name == 'Service') {
            if ($product->category == 'Signage') {
                $content->qty = (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) * $description->qty;
            } else {
                $content->qty = (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT);
            }
        } else {
            $content->qty = 1;
        }
        if (count($install_order) > 0) {
            $content->theme = $install_order[0]->theme;
        } else {
            $content->theme = '';
        }
        if ($sale->media_category->name != 'Service') {
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
        } else {
            $content->periode = '';
        }
        $content->location_size = $product->size . ' x ' . $product->side . ' - ' . $product->orientation;
        $content->location_address = $product->address;
        $content->location_code = $product->code . '-' . $product->city_code;
        $content->client = $client;
        $content->note = '';
        if ($sale->media_category->name == 'Service') {
            $content->category = $getService;
        } else {
            $content->category = $sale->media_category->name;
        }

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
                    <div id="divButton" class="hidden w-[150px] justify-end">
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
                            onclick="previewBack()">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1 text-white">Back</span>
                        </button>
                        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
                        <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
                        <input type="text" name="first_photo" id="firstPhotoId" hidden>
                        <input type="text" name="second_photo" id="secondPhotoId" hidden>
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
            @include('work-reports.select-documentation')
            @include('work-reports.modal-preview')
        </div>
    </div>

    <script>
        let firstPhoto = @json($firstPhoto);
        let secondPhoto = @json($secondPhoto);
        let firstImages = @json($first_photos);
        let secondImages = @json($second_photos);
        let getContent = @json($content);
        const previewFirstPhoto = document.getElementById("previewFirstPhoto");
        const previewSecondPhoto = document.getElementById("previewSecondPhoto");
        const imageSecondViews = document.querySelectorAll(".divSecondPhoto");
        const imageFirstViews = document.querySelectorAll(".divFirstPhoto");
        const firstPhotoId = document.getElementById("firstPhotoId");
        const secondPhotoId = document.getElementById("secondPhotoId");
        const inputContent = document.getElementById("inputContent");

        if (document.querySelectorAll(".divSecondPhoto").length > 2) {
            var indexSecond = Math.floor(document.querySelectorAll(".divSecondPhoto").length / 2);
            secondPhoto.id = secondImages[indexSecond].id;
            if (secondImages[indexSecond].type == "day") {
                secondPhoto.title = "Foto Siang";
            } else {
                secondPhoto.title = "Foto Malam";
            }
            secondPhotoId.value = JSON.stringify(secondPhoto);
        } else {
            var indexSecond = 0;
            if (Object.keys(secondImages).length != 0) {
                secondPhoto.id = secondImages[indexSecond].id;
                if (secondImages[indexSecond].type == "day") {
                    secondPhoto.title = "Foto Siang";
                } else {
                    secondPhoto.title = "Foto Malam";
                }
                secondPhotoId.value = JSON.stringify(secondPhoto);
            }
        }

        if (document.querySelectorAll(".divFirstPhoto").length > 2) {
            var indexFirst = Math.floor(document.querySelectorAll(".divFirstPhoto").length / 2);
            firstPhoto.id = firstImages[indexSecond].id;
            if (firstImages[indexFirst].type == "day") {
                firstPhoto.title = "Foto Siang";
            } else {
                firstPhoto.title = "Foto Malam";
            }
            firstPhotoId.value = JSON.stringify(firstPhoto);
        } else {
            var indexFirst = 0;
            if (Object.keys(firstImages).length != 0) {
                firstPhoto.id = firstImages[indexSecond].id;
                if (firstImages[indexFirst].type == "day") {
                    firstPhoto.title = "Foto Siang";
                } else {
                    firstPhoto.title = "Foto Malam";
                }
                firstPhotoId.value = JSON.stringify(firstPhoto);
            }
        }

        // Function Modal Documentation start
        documentationNext = () => {
            if (firstPhotoId.value == "" && secondPhotoId.value == "") {
                alert("Belum ada foto/dokumentasi pekerjaan..!!")
            } else {
                document.getElementById("selectDocumentation").setAttribute('hidden', 'hidden');
                document.getElementById("modalPreview").removeAttribute('hidden');
                document.getElementById("divButton").classList.remove('hidden');
                document.getElementById("divButton").classList.add('flex');
                firstPhotoId.value = JSON.stringify(firstPhoto);
                secondPhotoId.value = JSON.stringify(secondPhoto);
            }
        }
        documentationBack = () => {
            document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
            document.getElementById("modalSelectSale").removeAttribute('hidden');
            saleHeader.classList.remove('flex');
            saleHeader.classList.add('hidden');
        }

        previewBack = () => {
            document.getElementById("selectDocumentation").removeAttribute('hidden');
            document.getElementById("modalPreview").setAttribute('hidden', 'hidden');
            document.getElementById("divButton").classList.add('hidden');
            document.getElementById("divButton").classList.remove('flex');
        }

        // Function Modal Documentation end
        buttonSecondNext = () => {
            if (indexSecond == imageSecondViews.length - 1) {
                imageSecondViews[indexSecond].setAttribute('hidden', 'hidden');
                imageSecondViews[0].removeAttribute('hidden');
                indexSecond = 0;
                secondPhoto.id = secondImages[indexSecond].id;
                previewSecondPhoto.src = "/storage/" + secondImages[indexSecond].image;
            } else {
                imageSecondViews[indexSecond].setAttribute('hidden', 'hidden');
                imageSecondViews[indexSecond + 1].removeAttribute('hidden');
                indexSecond = indexSecond + 1;
                secondPhoto.id = secondImages[indexSecond].id;
                previewSecondPhoto.src = "/storage/" + secondImages[indexSecond].image;
            }
        }
        buttonFirstNext = () => {
            if (indexFirst == imageFirstViews.length - 1) {
                imageFirstViews[indexFirst].setAttribute('hidden', 'hidden');
                imageFirstViews[0].removeAttribute('hidden');
                indexFirst = 0;
                firstPhoto.id = firstImages[indexFirst].id;
                previewFirstPhoto.src = "/storage/" + firstImages[indexFirst].image;
            } else {
                imageFirstViews[indexFirst].setAttribute('hidden', 'hidden');
                imageFirstViews[indexFirst + 1].removeAttribute('hidden');
                indexFirst = indexFirst + 1;
                firstPhoto.id = firstImages[indexFirst].image;
                previewFirstPhoto.src = "/storage/" + firstImages[indexFirst].image;
            }
        }
        buttonSecondPrev = () => {
            if (indexSecond == 0) {
                imageSecondViews[indexSecond].setAttribute('hidden', 'hidden');
                imageSecondViews[imageSecondViews.length - 1].removeAttribute('hidden');
                indexSecond = imageSecondViews.length - 1;
                secondPhoto.id = secondImages[indexSecond].id;
                previewSecondPhoto.src = "/storage/" + secondImages[indexSecond].image;
            } else {
                imageSecondViews[indexSecond].setAttribute('hidden', 'hidden');
                imageSecondViews[indexSecond - 1].removeAttribute('hidden');
                indexSecond = indexSecond - 1;
                secondPhoto.id = secondImages[indexSecond].id;
                previewSecondPhoto.src = "/storage/" + secondImages[indexSecond].image;
            }
        }
        buttonFirstPrev = () => {
            if (indexFirst == 0) {
                imageFirstViews[indexFirst].setAttribute('hidden', 'hidden');
                imageFirstViews[imageFirstViews.length - 1].removeAttribute('hidden');
                indexFirst = imageFirstViews.length - 1;
                firstPhoto.id = firstImages[indexFirst].id;
                previewFirstPhoto.src = "/storage/" + firstImages[indexFirst].image;
            } else {
                imageFirstViews[indexFirst].setAttribute('hidden', 'hidden');
                imageFirstViews[indexFirst - 1].removeAttribute('hidden');
                indexFirst = indexFirst - 1;
                firstPhoto.id = firstImages[indexFirst].id;
                previewFirstPhoto.src = "/storage/" + firstImages[indexFirst].image;
            }
        }
        rbFirstTitle = (sel) => {
            document.getElementById("firstPhotoTitle").innerHTML = sel.id;
            firstPhoto.title = sel.id;
            document.getElementById("inputFirstTitle").setAttribute('disabled', 'disabled');
        }
        rbSecondTitle = (sel) => {
            document.getElementById("secondPhotoTitle").innerHTML = sel.id;
            secondPhoto.title = sel.id;
            document.getElementById("inputSecondTitle").setAttribute('disabled', 'disabled');
        }
        inputFirstTitleAction = (sel) => {
            document.getElementById("firstPhotoTitle").innerHTML = sel.value;
            firstPhoto.title = sel.value;
        }
        inputSecondTitleAction = (sel) => {
            document.getElementById("secondPhotoTitle").innerHTML = sel.value;
            secondPhoto.title = sel.value;
        }
        rbManualTitle = (sel) => {
            if (sel.id == "rbManualDay") {
                document.getElementById("inputFirstTitle").removeAttribute('disabled');
                document.getElementById("inputFirstTitle").focus();
            } else if (sel.id == "rbManualNight") {
                document.getElementById("inputSecondTitle").removeAttribute('disabled');
                document.getElementById("inputSecondTitle").focus();
            }
        }
        getNote = (sel) => {
            getContent.note = sel.value;
            inputContent.value = JSON.stringify(getContent);
        }
    </script>
@endsection
