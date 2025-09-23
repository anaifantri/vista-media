@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    @php
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
        $client = json_decode($income_tax_document->payment->billings[0]->client);
        $images = json_decode($income_tax_document->images);
    @endphp
    <form method="post" action="/accounting/income-tax-documents/{{ $income_tax_document->id }}"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <label class="flex text-xl text-stone-100 font-bold w-[850px]">
                        DETAIL BUKTI POTONG PPH
                    </label>
                    <div class="flex items-center w-full justify-end">
                        <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                            name="btnSubmit">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                            </svg>
                            <span class="mx-2"> Save </span>
                        </button>
                        <a href="/income-taxes/index/{{ $company->id }}"
                            class="flex justify-center items-center mx-1 btn-danger" title="Back">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1 text-white">Cancel</span>
                        </a>
                    </div>
                </div>
                <!-- Title end -->

                <!-- New License Document start -->
                <div class="flex justify-center border rounded-lg w-[1200px] p-4">
                    <div class="w-[950px]">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-2 mt-2 border rounded-lg bg-stone-300 text-stone-900">
                                <div class="flex border-b border-stone-900 font-semibold">Detail Pemotongan</div>
                                <div class="flex mt-1">
                                    <label class="text-md w-40">Total Tagihan</label>
                                    <label class="text-md ml-2">:</label>
                                    <label class="text-md ml-2">Rp.
                                        {{ number_format($income_tax_document->payment->billings->sum('nominal') + $income_tax_document->payment->billings->sum('ppn')) }},-</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-md w-40">Nominal PPh</label>
                                    <label class="text-md ml-2">:</label>
                                    <input name="nominal" type="number" placeholder="Input Nomor Bukti Potong"
                                        value="{{ $income_tax_document->nominal }}"
                                        class="text-md outline-none rounded-md px-1 ml-2 w-[250px] in-out-spin-none"
                                        required>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-md w-40">No. Bukti Potong</label>
                                    <label class="text-md ml-2">:</label>
                                    <input name="number" type="text" placeholder="Input Nomor Bukti Potong"
                                        value="{{ $income_tax_document->number }}"
                                        class="text-md outline-none rounded-md px-1 ml-2 w-[250px]" required>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-md w-40">Tgl. Bukti Potong</label>
                                    <label class="text-md ml-2">:</label>
                                    <input name="tax_date" type="date"
                                        class="text-md outline-none rounded-md px-1 ml-2 w-36"
                                        value="{{ $income_tax_document->tax_date }}" required>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-md w-40">Masa Pajak</label>
                                    <label class="text-md ml-2">:</label>
                                    <input type="month" name="period"
                                        class="text-md outline-none rounded-md px-1 ml-2 w-36"
                                        value="{{ $income_tax_document->period }}" required>
                                </div>
                            </div>
                            <div class="p-2 mt-2 border rounded-lg bg-stone-300 text-stone-900">
                                <div class="flex border-b border-stone-900 font-semibold">Data Pemotong</div>
                                <div class="flex mt-1">
                                    <label class="text-md w-28">Perusahaan</label>
                                    <label class="text-md ml-2">:</label>
                                    <label class="text-md ml-2">{{ $income_tax_document->company }}</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-md w-28">Alamat</label>
                                    <label class="text-md ml-2">:</label>
                                    <label class="text-md ml-2 w-[320px]">{{ $client->address }}</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-md w-28">NPWP</label>
                                    <label class="text-md ml-2">:</label>
                                    <label class="text-md ml-2">{{ $client->npwp }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full justify-center mt-4">
                            <input id="documentTax" name="documents[]" type="file"
                                accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)" multiple hidden>
                            <button id="btnChooseImages" class="flex justify-center items-center w-44 btn-primary-small"
                                title="Chose Files" type="button" onclick="document.getElementById('documentTax').click()">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                </svg>
                                <span class="ml-2">Ganti Dokumen</span>
                            </button>
                        </div>
                        <div class="flex items-center mt-2 w-full justify-center border rounded-lg">
                            <label class="text-md text-stone-100 w-20">Jumlah File</label>
                            <label class="text-md text-stone-100 ml-2">:</label>
                            <label id="numberImagesFile" class="text-md text-stone-100 ml-2">{{ count($images) }}
                                dokumen</label>
                        </div>
                        @error('documents.*')
                            <div class="invalid-feedback">
                                Ukuran file max 1024 kb, tipe file jpeg/jpg/png
                            </div>
                        @enderror
                        <div class="relative m-auto w-[950px] h-max mt-2">
                            @if (count($images) > 1)
                                <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button" onclick="buttonPrevShow()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        onclick="buttonNextShow()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                            @else
                                <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button" onclick="buttonPrevShow()">
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
                                        onclick="buttonNextShow()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            <div id="slidesPreview">
                                @foreach ($images as $image)
                                    @if (count($images) > 2)
                                        @if ($loop->iteration - 1 == intdiv(count($agreements), 2))
                                            <img src="{{ asset('storage/' . $image) }}" alt="" class="images">
                                        @else
                                            <img src="{{ asset('storage/' . $image) }}" alt=""class="images"
                                                hidden>
                                        @endif
                                    @else
                                        @if ($loop->iteration == 1)
                                            <img src="{{ asset('storage/' . $image) }}" alt="" class="images">
                                        @else
                                            <img src="{{ asset('storage/' . $image) }}" alt="" class="images"
                                                hidden>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New License Document end -->
            </div>
        </div>
    </form>
    <!-- Container end -->

    <script>
        // Funtion Button Next-Prev-figure start -->
        const imageViews = document.querySelectorAll(".images");
        const slidesPreview = document.getElementById("slidesPreview");
        const numberImagesFile = document.getElementById("numberImagesFile");
        const nextButton = document.getElementById("nextButton");
        const prevButton = document.getElementById("prevButton");

        var indexShow = 0;
        let previewImage = [];
        let slidePreviewImage = [];
        let fileLength = 0;

        //preview images --> start
        imagePreview = (sel) => {
            fileLength = 0;
            indexShow = 0;
            numberImagesFile.innerHTML = "Tidak Ada File Yang Dipilih";

            while (slidesPreview.hasChildNodes()) {
                slidesPreview.removeChild(slidesPreview.firstChild);
            }

            if (sel.files.length != 0) {
                numberImagesFile.innerHTML = sel.files.length + " file di pilih";
                fileLength = sel.files.length;

                for (n = 0; n < sel.files.length; n++) {
                    const file = sel.files[n];
                    const objectUrl = URL.createObjectURL(file);

                    slidePreviewImage[n] = document.createElement("img");
                    slidePreviewImage[n].classList.add("images");
                    if (n != 0) {
                        slidePreviewImage[n].setAttribute('hidden', 'hidden');
                    }
                    slidePreviewImage[n].classList.add("w-full");
                    slidePreviewImage[n].classList.add("mt-2");
                    slidePreviewImage[n].src = objectUrl;
                    slidesPreview.appendChild(slidePreviewImage[n]);
                }

                prevButton.removeAttribute('hidden');
                nextButton.removeAttribute('hidden');
            }
        }
        //preview images --> end

        for (let i = 0; i < imageViews.length; i++) {
            if (i == 0) {
                indexShow = i;
                imageViews[i].removeAttribute('hidden');
            } else {
                imageViews[i].setAttribute('hidden', 'hidden');
            }
        }

        buttonNextShow = () => {
            const imageViews = document.querySelectorAll(".images");
            console.log(indexShow);
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
            const imageViews = document.querySelectorAll(".images");
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
    </script>
@endsection
