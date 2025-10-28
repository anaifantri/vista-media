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

        $itemDescriptions = ['Pemasangan Gambar', 'Lampu Penerangan', 'Halangan', 'Lainnya'];
        $images = json_decode($complaint_response->images);
        $descriptions = json_decode($complaint->descriptions);

        $product = json_decode($sale->product);
        $client = json_decode($sale->quotation->clients);
    @endphp
    <!-- Form Create start -->
    <form id="formCreate" action="/workshop/complaint-responses/{{ $complaint_response->id }}" method="post"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="text" name="old_images" id="updated_by" value="{{ $complaint_response->images }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="p-4 w-[1000px] border rounded-lg bg-stone-700">
                <div class="flex items-center justify-center border-b p-1">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[950px]">EDIT DATA RESPONSE KOMPLAIN
                        DARI
                        KLIEN</h4>
                    <div class="flex justify-end w-full">
                        <a href="/workshop/complaint-responses/{{ $complaint_response->id }}"
                            class="flex items-center justify-center btn-danger mx-1">
                            <svg class="fill-current w-5 rotate-180" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1"> Back </span>
                        </a>
                        <button class="flex items-center justify-center btn-primary mx-1" type="submit">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                            </svg>
                            <span class="mx-2"> Save </span>
                        </button>
                    </div>
                </div>
                <!-- View Create start -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="border rounded-lg p-2 bg-stone-200 w-full">
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Kode Lokasi</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ $product->code }}-{{ $product->city_code }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Lokasi</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ $product->address }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Ukuran</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ $product->size }}-{{ $product->orientation }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Nama Klien</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ $client->company }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Periode Kontrak</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ date('d', strtotime($sale->start_at)) }}-{{ $bulan[(int) date('m', strtotime($sale->start_at))] }}-{{ date('Y', strtotime($sale->start_at)) }}
                                s.d.
                                {{ date('d', strtotime($sale->end_at)) }}-{{ $bulan[(int) date('m', strtotime($sale->end_at))] }}-{{ date('Y', strtotime($sale->end_at)) }}
                            </label>
                        </div>
                    </div>
                    <div class="border rounded-lg p-2 bg-stone-300">
                        <div>
                            <div>
                                <span class="text-sm text-stone-900">No. Komplain</span>
                                <label
                                    class="flex w-[150px] text-sm font-semibold bg-neutral-50 text-stone-900 border rounded-lg p-1">
                                    {{ $complaint->number }}
                                </label>
                            </div>
                            <div>
                                <span class="text-sm text-stone-900">Tgl. Komplain</span>
                                <label
                                    class="flex w-[150px] text-sm font-semibold bg-neutral-50 text-stone-900 border rounded-lg p-1">
                                    {{ date('d', strtotime($complaint->complaint_date)) }}-{{ $bulan_full[(int) date('m', strtotime($complaint->complaint_date))] }}-{{ date('Y', strtotime($complaint->complaint_date)) }}
                                </label>
                            </div>
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Deskripsi</span>
                                <div class="grid grid-cols-2 gap-2 p-1">
                                    @foreach ($descriptions as $description)
                                        <div class="flex">
                                            @if ($description->checked == true)
                                                <div
                                                    class="flex justify-center items-center bg-neutral-50 w-10 h-6 border border-black font-bold text-black">
                                                    ✓
                                                </div>
                                            @else
                                                <div
                                                    class="flex justify-center items-center bg-neutral-50 w-10 h-6 border border-black font-bold text-black">

                                                </div>
                                            @endif
                                            <span class="ml-2 text-sm font-semibold">{{ $description->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Catatan</span>
                                <textarea class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none"
                                    rows="3" readonly>{{ $complaint->notes }}</textarea>
                            </div>
                            <div>
                                <span class="text-sm text-stone-900">Status</span>
                                <label
                                    class="flex w-[150px] text-sm font-semibold bg-neutral-50 text-stone-900 border rounded-lg p-1">
                                    @if ($complaint->complaint_responses)
                                        Open
                                    @else
                                        Sudah tertangani
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-b p-1 text-lg font-semibold mt-2 text-stone-100">
                    Penanganan / Perbaikan atas komplain dari klien
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="border rounded-lg p-2 bg-stone-200 w-full">
                        <div>
                            <span class="text-sm text-stone-900">Tgl. Penanganan / Perbaikan</span>
                            <input name="response_date"
                                class="flex w-[150px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('response_date') is-invalid @enderror"
                                value="{{ $complaint_response->response_date }}" type="date" required>
                        </div>
                        @error('response_date')
                            <div class="text-red-600 flex mx-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-2">
                            <span class="text-sm text-stone-900">Permasalahan</span>
                            <textarea
                                class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('problem') is-invalid @enderror"
                                name="problem" rows="3" placeholder="Input Permasalahan" required autofocus>{{ $complaint_response->problem }}</textarea>
                        </div>
                        @error('problem')
                            <div class="text-red-600 flex mx-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="border rounded-lg p-2 bg-stone-200 w-full">
                        <div class="mt-2">
                            <span class="text-sm text-stone-900">Penyelesaian</span>
                            <textarea
                                class="flex w-[450px] mt-2 text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('problem_solving') is-invalid @enderror"
                                name="problem_solving" rows="5" placeholder="Input Penyelesaian / Perbaikan" required>{{ $complaint_response->problem_solving }}</textarea>
                        </div>
                        @error('problem_solving')
                            <div class="text-red-600 flex mx-2">
                                {{ $message }}
                            </div>
                        @enderror
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
    <!-- Form Create end -->
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
