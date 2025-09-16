@extends('dashboard.layouts.main');

@section('container')
    <form method="post" action="/accounting/work-reports/{{ $work_report->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
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

            if (request('bast_date')) {
                $content->date = request('bast_date');
            }

            $updated_by = new stdClass();
            $updated_by->id = auth()->user()->id;
            $updated_by->name = auth()->user()->name;
            $updated_by->position = auth()->user()->position;
        @endphp
        <div class="flex justify-center bg-black p-10">
            <input id="inputContent" type="text" name="content" value="{{ json_encode($content) }}" hidden>
            <input type="text" name="first_photo" value="{{ json_encode($first_photo) }}" hidden>
            <input type="text" name="second_photo" value="{{ json_encode($second_photo) }}" hidden>
            <input type="text" name="updated_by" value="{{ json_encode($updated_by) }}" hidden>
            <div>
                <!-- Title start -->
                <div class="flex border-b p-1">
                    <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                        name="btnSubmit">
                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                        </svg>
                        <span class="mx-2"> Save </span>
                    </button>
                    <a href="#" class="flex items-center justify-center btn-danger mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Cancel </span>
                    </a>
                </div>
                <!-- Title end -->
                <div id="pdfPreview">
                    <div class="flex justify-center w-full">
                        <div>
                            @include('work-reports.edit-' . $content->format)
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
                                        <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24 mt-6">
                                            <span class="w-28">Pekerjaan</span>
                                            <span>:</span>
                                            <span class="ml-2">
                                                {{ $content->type }}
                                            </span>
                                        </div>
                                        <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24">
                                            <span class="w-28">Lokasi</span>
                                            <span>:</span>
                                            <span class="ml-2">
                                                {{ $content->location_address }}
                                            </span>
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
                                        <div class="flex w-full justify-center font-serif mt-2 text-sm font-semibold">
                                            @if ($first_photo->title != 'null' && $first_photo->title != '')
                                                <u>{{ $first_photo->title }}</u>
                                            @endif
                                        </div>
                                        <div class="flex w-full justify-center mt-2">
                                            <input type="file" id="firstPhoto" name="image_1"
                                                onchange="previewImage(this)" hidden>
                                            <button id="btnChooseImages"
                                                class="flex justify-center items-center w-44 btn-primary-small"
                                                title="Chose Files" type="button"
                                                onclick="document.getElementById('firstPhoto').click()">
                                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                    <path
                                                        d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                                </svg>
                                                <span class="ml-2">Ganti Foto</span>
                                            </button>
                                        </div>
                                        @error('image_1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="flex justify-center w-full mt-2">
                                            <img class="img-first-preview border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
                                                src="{{ asset('storage/' . $first_photo->image) }}">
                                        </div>
                                        <div class="flex w-full justify-center font-serif mt-6 text-sm font-semibold">
                                            @if ($second_photo->title != 'null' && $second_photo->title != '')
                                                <u>{{ $second_photo->title }}</u>
                                            @endif
                                        </div>
                                        <div class="flex w-full justify-center mt-2">
                                            <input type="file" id="secondPhoto" name="image_2"
                                                onchange="previewImage(this)" hidden>
                                            <button id="btnChooseImages"
                                                class="flex justify-center items-center w-44 btn-primary-small"
                                                title="Chose Files" type="button"
                                                onclick="document.getElementById('secondPhoto').click()">
                                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                    <path
                                                        d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                                </svg>
                                                <span class="ml-2">Ganti Foto</span>
                                            </button>
                                        </div>
                                        @error('image_2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="flex justify-center w-full mt-2">
                                            <img class="img-second-preview border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
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
        </div>
    </form>

    <form id="formChangeDate" action="/accounting/work-reports/{{ $work_report->id }}/edit">
        <input id="bastDate" type="date" value="{{ $content->date }}" name="bast_date" hidden>
    </form>
    <!-- Script start -->

    <script>
        let getContent = @json($content);
        const inputContent = document.getElementById("inputContent");
        const formChangeDate = document.getElementById("formChangeDate");
        const bastDate = document.getElementById("bastDate");
        const inputBastDate = document.getElementById("inputBastDate");

        changeDate = (sel) => {
            bastDate.value = sel.value;
            getContent.date = bastDate.value;

            formChangeDate.submit();
        }

        changeType = (sel) => {
            getContent.type = sel.value;

            inputContent.value = JSON.stringify(getContent);
        }

        changeLocationType = (sel) => {
            getContent.location_type = sel.value;

            inputContent.value = JSON.stringify(getContent);
        }

        changeLocationLighting = (sel) => {
            getContent.location_lighting = sel.value;

            inputContent.value = JSON.stringify(getContent);
        }

        changeLocationAddress = (sel) => {
            getContent.location_address = sel.value;

            inputContent.value = JSON.stringify(getContent);
        }

        changeLocationSize = (sel) => {
            getContent.location_size = sel.value;

            inputContent.value = JSON.stringify(getContent);
        }

        changeQty = (sel) => {
            getContent.qty = sel.value;

            inputContent.value = JSON.stringify(getContent);
        }

        changeTheme = (sel) => {
            getContent.theme = sel.value;

            inputContent.value = JSON.stringify(getContent);
        }

        changePeriode = (sel) => {
            getContent.periode = sel.value;

            inputContent.value = JSON.stringify(getContent);
        }

        changeNote = (sel) => {
            getContent.note = sel.value;

            inputContent.value = JSON.stringify(getContent);
        }

        function previewImage(sel) {
            if (sel.name == "image_1") {
                const imgPreview = document.querySelector('.img-first-preview');

                const oFReader = new FileReader();

                oFReader.readAsDataURL(sel.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            } else {
                const imgPreview = document.querySelector('.img-second-preview');

                const oFReader = new FileReader();

                oFReader.readAsDataURL(sel.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        }
    </script>

    <!-- Script end -->
@endsection
