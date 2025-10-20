@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $bulan_full = [
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
        if ($sale) {
            $product = json_decode($sale->product);
            $client = json_decode($sale->quotation->clients);
        }
        $images = json_decode($publish_content->images);
        $updated_by = new stdClass();
        $updated_by->id = auth()->user()->id;
        $updated_by->name = auth()->user()->name;
        $updated_by->position = auth()->user()->position;
    @endphp
    <!-- Form Editstart -->
    <form action="/workshop/publish-contents/{{ $publish_content->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="text" name="updated_by" id="updated_by" value="{{ json_encode($updated_by) }}" hidden>
        <input type="text" name="old_images" id="updated_by" value="{{ $publish_content->images }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="p-4 w-[1000px] border rounded-lg bg-stone-700">
                <div class="flex items-center justify-center border-b p-1">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[950px]">EDIT DATA PENAYANGAN MATERI
                        VIDEOTRON
                    </h4>
                    <div class="flex justify-end w-full">
                        <button id="btnSave" name="btnSave" class="flex justify-center items-center ml-1 btn-primary"
                            type="submit">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-1">Save</span>
                        </button>
                        <a href="/workshop/publish-contents" class="flex items-center justify-center btn-danger mx-1">
                            <svg class="fill-current w-5 rotate-180" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Close </span>
                        </a>
                    </div>
                </div>
                <!-- View Create start -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="border rounded-lg p-2 bg-stone-200 w-full">
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Kode Lokasi</label>
                            <label class="flex w-[450px] text-sm font-semibold text-stone-900 p-1">
                                {{ $publish_content->location->code }}-{{ $publish_content->location->city->code }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Lokasi</label>
                            <label class="flex w-[450px] text-sm font-semibold text-stone-900 p-1">
                                {{ $location->address }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Ukuran</label>
                            <label class="flex w-[450px] text-sm font-semibold text-stone-900 p-1">
                                {{ $location->media_size->size }}-{{ $location->orientation }}
                            </label>
                        </div>

                        @if ($publish_content->status == 'Berbayar')
                            <div class="mt-2">
                                <label class="text-sm text-stone-900 w-24">Klien</label>
                                <label class="flex w-[450px] text-sm font-semibold text-stone-900 py-1">
                                    {{ $client->company }}
                                </label>
                            </div>
                            <div class="mt-2">
                                <label class="text-sm text-stone-900 w-24">Periode Kontrak</label>
                                <label class="flex w-[450px] text-sm font-semibold text-stone-900 py-1">
                                    {{ date('d', strtotime($sale->start_at)) }}-{{ $bulan[(int) date('m', strtotime($sale->start_at))] }}-{{ date('Y', strtotime($sale->start_at)) }}
                                    s.d.
                                    {{ date('d', strtotime($sale->end_at)) }}-{{ $bulan[(int) date('m', strtotime($sale->end_at))] }}-{{ date('Y', strtotime($sale->end_at)) }}
                                </label>
                            </div>
                        @endif
                    </div>
                    <div class="border rounded-lg p-2 bg-stone-300">
                        <div>
                            <div>
                                <span class="text-sm text-stone-900">Tgl. Tayang</span>
                                <input name="publish_date"
                                    class="flex w-[150px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('publish_date') is-invalid @enderror"
                                    value="{{ $publish_content->publish_date }}" type="date" required>
                            </div>
                            @error('publish_date')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Tema</span>
                                <input name="theme"
                                    class=" flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('theme') is-invalid @enderror"
                                    value="{{ $publish_content->theme }}" type="text" placeholder="Input Tema" required>
                            </div>
                            @error('theme')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Catatan</span>
                                <textarea
                                    class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('notes') is-invalid @enderror"
                                    name="notes" rows="3" placeholder="Input Catatan" required>{{ $publish_content->notes }}</textarea>
                            </div>
                            @error('notes')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- View Create end -->
                <!-- View Photos start -->
                <div class="w-[965px] border rounded-lg mt-8" id="divOldImages">
                    <div class="flex items-center justify-center border-b p-1">
                        <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[950px]">FOTO DOKUMENTASI</h4>
                        <div class="flex justify-end w-full">
                            <button id="btnSave" name="btnSave" class="flex justify-center items-center ml-1 btn-primary"
                                type="button" onclick="changePhoto()">Ganti Photo</button>
                        </div>
                    </div>
                    <div class="w-[940px] p-2">
                        <figure id="figureOldImages"
                            class="flex w-[940px] justify-center overflow-x-auto bg-stone-800 rounded-lg mt-2">
                            @foreach ($images as $image)
                                @if (count($images) > 2)
                                    @if ($loop->iteration - 1 == intdiv(count($images), 2))
                                        <img id="day{{ $loop->iteration - 1 }}" class="documentation-photo-active"
                                            src="{{ asset('storage/' . $image) }}" alt=""
                                            onclick="figureOldAction(this)">
                                    @else
                                        <img id="day{{ $loop->iteration - 1 }}" class="documentation-photo"
                                            src="{{ asset('storage/' . $image) }}" alt=""
                                            onclick="figureOldAction(this)">
                                    @endif
                                @else
                                    @if ($loop->iteration == 1)
                                        <img id="day{{ $loop->iteration - 1 }}" class="documentation-photo-active"
                                            src="{{ asset('storage/' . $image) }}" alt=""
                                            onclick="figureOldAction(this)">
                                    @else
                                        <img id="day{{ $loop->iteration - 1 }}" class="documentation-photo"
                                            src="{{ asset('storage/' . $image) }}" alt=""
                                            onclick="figureOldAction(this)">
                                    @endif
                                @endif
                            @endforeach
                        </figure>
                        <div class="relative m-auto w-[940px] h-max mt-2">
                            <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                                <button
                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    type="button" onclick="buttonOldPrev()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                                <button type="button"
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    onclick="buttonOldNext()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                    </svg>
                                </button>
                            </div>
                            @foreach ($images as $image)
                                @if (count($images) > 2)
                                    @if ($loop->iteration - 1 == intdiv(count($images), 2))
                                        <div class="divOldImages">
                                            <img src="{{ asset('storage/' . $image) }}" alt=""
                                                class="w-[940px] rounded-lg">
                                        </div>
                                    @else
                                        <div class="divOldImages" hidden>
                                            <img src="{{ asset('storage/' . $image) }}" alt=""
                                                class="w-[940px] rounded-lg">
                                        </div>
                                    @endif
                                @else
                                    @if ($loop->iteration == 1)
                                        <div class="divOldImages">
                                            <img src="{{ asset('storage/' . $image) }}" alt=""
                                                class="w-[940px] rounded-lg">
                                        </div>
                                    @else
                                        <div class="divOldImages" hidden>
                                            <img src="{{ asset('storage/' . $image) }}" alt=""
                                                class="w-[940px] rounded-lg">
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- View Photos end -->
                <!-- New Foto start -->
                <div class="hidden justify-center w-full mt-2" id="divNewImages">
                    <div class="flex justify-start border rounded-lg w-[960px] p-4">
                        <div class="w-[925px]">
                            <div class="flex w-full justify-center">
                                <input id="images" name="images[]" type="file"
                                    accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)" multiple
                                    hidden>
                                <button id="btnChooseImages" class="flex justify-center items-center btn-primary-small"
                                    title="Chose Files" type="button"
                                    onclick="document.getElementById('images').click()">Pilih Foto
                                </button>
                                <button id="btnChooseImages"
                                    class="flex ml-2 justify-center items-center p-2 w-max h-6 bg-red-500 rounded-lg text-white hover:bg-red-700 drop-shadow-md"
                                    title="Chose Files" type="button" onclick="clearNewImages()">Cancel
                                </button>
                            </div>
                            <div class="flex items-center mt-2 w-full justify-center border rounded-lg">
                                <label class="text-sm text-stone-100 w-20">Jumlah File</label>
                                <label class="text-sm text-stone-100 ml-2">:</label>
                                <label id="numberImagesFile" class="text-sm text-stone-100 ml-2"> 0 file yang
                                    dipilih</label>
                            </div>
                            @error('images')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('images.*')
                                <div class="invalid-feedback">
                                    Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                </div>
                            @enderror
                            <figure class="flex w-[925px] justify-center overflow-x-auto border-b-2 border-stone-100 mt-2"
                                id="figureImages">

                            </figure>
                            <div class="relative m-auto w-[925px] h-max mt-2">
                                <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button" onclick="prevButtonAction()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        onclick="nextButtonAction()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="slidesPreview" class="mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Foto end -->
            </div>
        </div>
    </form>
    <!-- Form Editend -->
    <!-- Show end -->
    <!-- Script start -->
    <script src="/js/addinstallationphotos.js"></script>
    <script>
        const images = document.getElementById("images");
        const divNewImages = document.getElementById("divNewImages");
        const divOldImages = document.getElementById("divOldImages");
        const imageOldViews = document.querySelectorAll(".divOldImages");
        const figureOld = document.getElementById("figureOldImages");
        const figureOldImages = figureOld.getElementsByTagName("img");


        if (document.querySelectorAll(".divOldImages").length > 2) {
            var indexOld = Math.floor(document.querySelectorAll(".divOldImages").length / 2);
        } else {
            var indexOld = 0;
        }

        buttonOldNext = () => {
            if (indexOld == imageOldViews.length - 1) {
                figureOldImages[indexOld].classList.remove('documentation-photo-active');
                figureOldImages[indexOld].classList.add('documentation-photo');
                figureOldImages[0].classList.remove('documentation-photo');
                figureOldImages[0].classList.add('documentation-photo-active');
                imageOldViews[indexOld].setAttribute('hidden', 'hidden');
                imageOldViews[0].removeAttribute('hidden');
                indexOld = 0;
            } else {
                figureOldImages[indexOld].classList.remove('documentation-photo-active');
                figureOldImages[indexOld].classList.add('documentation-photo');
                figureOldImages[indexOld + 1].classList.add('documentation-photo-active');
                figureOldImages[indexOld + 1].classList.remove('documentation-photo');
                imageOldViews[indexOld].setAttribute('hidden', 'hidden');
                imageOldViews[indexOld + 1].removeAttribute('hidden');
                indexOld = indexOld + 1;
            }
        }

        buttonOldPrev = () => {
            if (indexOld == 0) {
                figureOldImages[indexOld].classList.remove('documentation-photo-active');
                figureOldImages[indexOld].classList.add('documentation-photo');
                figureOldImages[imageOldViews.length - 1].classList.remove('documentation-photo');
                figureOldImages[imageOldViews.length - 1].classList.add('documentation-photo-active');
                imageOldViews[indexOld].setAttribute('hidden', 'hidden');
                imageOldViews[imageOldViews.length - 1].removeAttribute('hidden');
                indexOld = imageOldViews.length - 1;
            } else {
                figureOldImages[indexOld].classList.remove('documentation-photo-active');
                figureOldImages[indexOld].classList.add('documentation-photo');
                figureOldImages[indexOld - 1].classList.add('documentation-photo-active');
                figureOldImages[indexOld - 1].classList.remove('documentation-photo');
                imageOldViews[indexOld].setAttribute('hidden', 'hidden');
                imageOldViews[indexOld - 1].removeAttribute('hidden');
                indexOld = indexOld - 1;
            }
        }

        figureOldAction = (sel) => {
            for (let i = 0; i < figureOldImages.length; i++) {
                if (figureOldImages[i].id == sel.id) {
                    figureOldImages[i].classList.remove('documentation-photo');
                    figureOldImages[i].classList.add('documentation-photo-active');
                    imageOldViews[i].removeAttribute('hidden');
                } else {
                    figureOldImages[i].classList.add('documentation-photo');
                    figureOldImages[i].classList.remove('documentation-photo-active');
                    imageOldViews[i].setAttribute('hidden', 'hidden');
                }
            }
            indexOld = parseInt(sel.id.replace(/[^\d.]/g, ''));
        }

        changePhoto = () => {
            divNewImages.classList.remove('hidden');
            divNewImages.classList.add('flex');
            divOldImages.classList.add('hidden');
        }

        clearNewImages = () => {
            const getFigureImages = document.getElementById("figureImages");
            const getSlidePreview = document.getElementById("slidesPreview");
            const getQtyFile = document.getElementById("numberImagesFile");
            divNewImages.classList.remove('flex');
            divNewImages.classList.add('hidden');
            divOldImages.classList.remove('hidden');
            images.value = null;

            while (figureImages.hasChildNodes()) {
                figureImages.removeChild(figureImages.firstChild);
            }
            while (slidesPreview.hasChildNodes()) {
                slidesPreview.removeChild(slidesPreview.firstChild);
            }

            getQtyFile.innerText = " 0 file yang dipilih";

            prevButton.setAttribute('hidden', 'hidden');
            nextButton.setAttribute('hidden', 'hidden');

        }
    </script>
    <!-- Script end -->
@endsection
