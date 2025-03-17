@extends('dashboard.layouts.main');

@section('container')
    <?php
    $clients = json_decode($sale->quotation->clients);
    $product = json_decode($sale->product);
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $month = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    ?>
    <form method="post" action="/marketing/quotation-agreements/{{ $quotation_agreement->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <!-- Document Orders start -->
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Document Orders Title start -->
                <div class="flex w-[950px] items-center border-b p-1">
                    <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[550px]">DOKUMEN PERJANJIAN</h1>
                    <div class="flex w-full justify-end">
                        <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                            name="btnSubmit">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                            </svg>
                            <span class="mx-2"> Update </span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/marketing/quotation-agreements/show-agreements/{{ $category }}/{{ $sale->id }}">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <!-- Document Orders Title end -->
                <div class="grid grid-cols-2 gap-2 mt-2">
                    <div class="border p-1 rounded-lg bg-stone-400">
                        <div class="div-sale">
                            <label class="text-sm text-stone-900 w-24">No. Penjualan</label>
                            <label class="label-sale-02">:</label>
                            <label class="label-sale-02">{{ $sale->number }}</label>
                        </div>
                        <div class="div-sale">
                            <label class="text-sm text-stone-900 w-24">Tgl. Penjualan</label>
                            <label class="label-sale-02">:</label>
                            <label class="label-sale-02">
                                {{ date('d', strtotime($sale->created_at)) }}
                                {{ $bulan[(int) date('m', strtotime($sale->created_at))] }}
                                {{ date('Y', strtotime($sale->created_at)) }}
                            </label>
                        </div>
                        <div class="div-sale">
                            <label class="text-sm text-stone-900 w-24">Nama Klien</label>
                            <label class="label-sale-02">:</label>
                            <label class="label-sale-02">{{ $clients->name }}</label>
                        </div>
                        @if ($clients->type == 'Perusahaan')
                            <div class="div-sale">
                                <label class="text-sm text-stone-900 w-24">Perusahaan</label>
                                <label class="label-sale-02">:</label>
                                <label class="label-sale-02">{{ $clients->company }}</label>
                            </div>
                        @endif
                        <div class="div-sale">
                            <label class="text-sm text-stone-900 w-24">Kode Lokasi</label>
                            <label class="label-sale-02">:</label>
                            <label class="label-sale-02">
                                {{ $product->code }} - {{ $product->city_code }} | {{ $product->address }}
                            </label>
                        </div>
                    </div>
                    <div class="border p-1 rounded-lg bg-stone-400">
                        <div class="flex w-full items-center text-sm border-b border-stone-900 m-1 font-semibold">
                            <label class="w-60">EDIT DATA PERJANJIAN</label>
                        </div>
                        <div class="flex w-full items-center text-sm m-1 mt-2">
                            <label class="w-36">No. Perjanjian</label>
                            <label>:</label>
                            <input class="outline-none ml-2 rounded-md border px-1" type="text" name="number"
                                placeholder="Input Nomor PO" value="{{ $quotation_agreement->number }}">
                        </div>
                        <div class="flex w-full items-center text-sm m-1">
                            <label class="w-36">Tgl. Perjanjian</label>
                            <label>:</label>
                            <input class="outline-none ml-2 rounded-md border px-1" type="date" name="date"
                                value="{{ $quotation_agreement->date }}">
                        </div>
                        <div class="flex w-full items-center text-sm m-1">
                            <label class="w-36">Ganti Dokumen</label>
                            <label>:</label>
                            <input type="text" name="oldImages" value="{{ $quotation_agreement->images }}" hidden>
                            <input id="documentAgreements"
                                class="outline-none ml-2 rounded-md border px-1"name="document_agreement[]" type="file"
                                accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)" multiple>
                        </div>
                        @error('document_agreement')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('document_agreement.*')
                            <div class="invalid-feedback">
                                Ukuran file max 1024 kb, tipe file jpeg/jpg/png
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-center w-[950px]">
                    <div>
                        <div id="previewOldImages" class="relative mt-4 w-[950px] border rounded-lg p-2">
                            @if (count($images) == 0)
                                <div id="prevButtonShow" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button" onclick="buttonPrevShow()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                            clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextButtonShow" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        onclick="buttonNextShow()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                            clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                            @else
                                <div id="prevButtonShow" class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button" onclick="buttonPrevShow()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextButtonShow" class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        onclick="buttonNextShow()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            @foreach ($images as $agreement)
                                @if ($loop->iteration == 1)
                                    <div class="divImage">
                                        <div class="flex w-full justify-center mt-2">
                                            <img class="w-[880px]" src="{{ asset('storage/' . $agreement) }}"
                                                alt="">
                                        </div>
                                    </div>
                                @else
                                    <div class="divImage" hidden>
                                        <div class="flex w-full justify-center">
                                            <img class="w-[880px]" src="{{ asset('storage/' . $agreement) }}"
                                                alt="">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div id="previewNewImages" class="flex relative justify-center m-auto w-[950px] h-max" hidden>
                            <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                <button
                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    type="button" onclick="prevButtonAction()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                <button type="button"
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    onclick="nextButtonAction()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="slidesPreview" class="mt-2 w-[880px]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Document Orders end -->
        </div>
    </form>

    <script>
        // Funtion Button Next-Prev-figure start -->
        const imageViews = document.querySelectorAll(".divImage");
        var indexShow = 0;

        for (let i = 0; i < imageViews.length; i++) {
            if (i == 0) {
                indexShow = i;
                imageViews[i].removeAttribute('hidden');
            } else {
                imageViews[i].setAttribute('hidden', 'hidden');
            }
        }
        buttonNextShow = () => {
            if (indexShow == imageViews.length - 1) {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                indexShow = 0;
                imageViews[indexShow].removeAttribute('hidden');
            } else {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                imageViews[indexShow + 1].removeAttribute('hidden');
                indexShow = indexShow + 1;
            }
        }
        buttonPrevShow = () => {
            if (indexShow == 0) {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                indexShow = imageViews.length - 1;
                imageViews[indexShow].removeAttribute('hidden');
            } else {
                imageViews[indexShow].setAttribute('hidden', 'hidden');
                imageViews[indexShow - 1].removeAttribute('hidden');
                indexShow = indexShow - 1;
            }
        }
        // Funtion Button Next-Prev-figure end -->
        const slidesPreview = document.getElementById("slidesPreview");
        const nextButton = document.getElementById("nextButton");
        const prevButton = document.getElementById("prevButton");

        let slidePreview = [];
        let slidePreviewImage = [];
        let index = 0;

        //preview images --> start
        imagePreview = (sel) => {
            document.getElementById("previewOldImages").setAttribute('hidden', 'hidden');
            document.getElementById("previewNewImages").removeAttribute('hidden');
            index = 0;

            while (slidesPreview.hasChildNodes()) {
                slidesPreview.removeChild(slidesPreview.firstChild);
            }

            if (sel.files.length != 0) {
                for (n = 0; n < sel.files.length; n++) {
                    const file = sel.files[n];
                    const objectUrl = URL.createObjectURL(file);

                    slidePreview[n] = document.createElement("figure");
                    slidePreview[n].classList.add("mySlides");
                    slidePreview[n].classList.add("fade");
                    slidePreviewImage[n] = document.createElement("img");
                    if (n != 0) {
                        slidePreviewImage[n].classList.add("hidden");
                    }
                    slidePreviewImage[n].classList.add("w-full");
                    slidePreviewImage[n].classList.add("mt-2");
                    slidePreviewImage[n].src = objectUrl;
                    slidePreview[n].appendChild(slidePreviewImage[n]);
                    slidesPreview.appendChild(slidePreview[n]);
                }

                prevButton.removeAttribute('hidden');
                nextButton.removeAttribute('hidden');
            }
        }
        //preview images --> end

        //prev button action --> start
        prevButtonAction = () => {
            if (index != 0) {
                slidePreviewImage[index].classList.add("hidden");
                index = index - 1;
                slidePreviewImage[index].classList.remove("hidden");
            } else {
                slidePreviewImage[index].classList.add("hidden");
                index = document.getElementById('documentOrders').files.length - 1;
                slidePreviewImage[index].classList.remove("hidden");
            }
        }
        //prev button action --> end

        //next button action --> start
        nextButtonAction = () => {
            if (index != document.getElementById('documentOrders').files.length - 1) {
                slidePreviewImage[index].classList.add("hidden");
                index = index + 1;
                slidePreviewImage[index].classList.remove("hidden");
            } else {
                slidePreviewImage[index].classList.add("hidden");
                index = 0;
                slidePreviewImage[index].classList.remove("hidden");
            }
        }
        //next button action --> end
    </script>
@endsection
