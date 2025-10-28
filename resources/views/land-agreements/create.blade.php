@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    <?php
    $description = json_decode($location->description);
    ?>
    <form action="/media/land-agreements" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="location_id" value="{{ $location_id }}" hidden>
        <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
        <div class="flex justify-center  py-10 px-14 bg-stone-800">
            <div class="bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[850px]"> MENAMBAHKAN DATA SEWA LAHAN
                    </h1>
                    <div class="flex items-center w-full justify-end">
                        <button id="btnSave" name="btnSave" class="flex justify-center items-center ml-1 btn-primary"
                            type="submit">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Save</span>
                        </button>
                        <a class="flex justify-center items-center ml-1 btn-danger" href="/media/land-agreements">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Cancel</span>
                        </a>
                    </div>
                </div>
                <!-- Title end -->

                <!-- New Land Agreement Input start -->
                <div class="flex justify-center w-full mt-2">
                    <div class="w-[1200px]">
                        <!-- Location start -->
                        <div class="grid grid-cols-2 gap-2 w-full justify-center mt-2 p-2">
                            <div class="border rounded-lg p-2 bg-stone-200">
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Kode Lokasi</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->code }}-{{ $location->city->code }}</label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Lokasi</label>
                                    <label>:</label>
                                    <label class="ml-1">
                                        @if (strlen($location->address) > 65)
                                            {{ substr($location->address, 0, 65) }}..
                                        @else
                                            {{ $location->address }}
                                        @endif
                                    </label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Ukuran</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->media_size->size }}-{{ $location->side }}</label>
                                </div>
                            </div>
                            <div class="border rounded-lg p-2 bg-stone-200 ml-4">
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Jenis</label>
                                    <label>:</label>
                                    <label class="ml-1">
                                        {{ $location->media_category->name }}
                                        @if (
                                            $location->media_category->name != 'Videotron' ||
                                                ($location->media_category->name == 'Signage' && $description->type != 'Videotron'))
                                            - {{ $description->lighting }}
                                        @endif
                                    </label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Area</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->area->area }}</label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Kota</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->city->city }}</label>
                                </div>
                            </div>
                        </div>
                        <!-- Location end -->
                        <div>
                            <div class="flex justify-center border rounded-lg w-[1200px] p-2 mt-4">
                                <div class="w-[580px] p-2 border rounded-lg bg-stone-300">
                                    <div class="flex">
                                        <label class="text-xs text-stone-900 w-36">Nomor Perjanjian</label>
                                        <input
                                            class="flex text-semibold w-96 border rounded-lg px-1 outline-none @error('number') is-invalid @enderror"
                                            type="text" id="number" name="number" value="{{ old('number') }}"
                                            autofocus placeholder="Input Nomor Perjanjian" required>
                                        @error('number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Tanggal Perjanjian</label>
                                        <input
                                            class="flex text-semibold border rounded-lg px-1 outline-none @error('published') is-invalid @enderror"
                                            type="date" id="published" name="published" value="{{ old('published') }}"
                                            required>
                                        @error('published')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Keterangan</label>
                                        <textarea class="flex text-semibold w-96  border rounded-lg p-1 outline-none @error('notes') is-invalid @enderror"
                                            name="notes" rows="3" id="notes" placeholder="Input Keterangan">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-[580px] p-2 ml-4 border rounded-lg bg-stone-300">
                                    <div class="flex">
                                        <label class="text-xs text-stone-900 w-36">Durasi Sewa</label>
                                        <input id="duration" name="duration" onkeyup="countTotal()"
                                            class="flex text-semibold w-20 in-out-spin-none border rounded-lg px-1 outline-none @error('duration') is-invalid @enderror"
                                            type="number" min="0" placeholder="0" value="{{ old('duration') }}"
                                            required>
                                        <label class="text-xs text-stone-900 ml-2">Tahun</label>
                                        @error('duration')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Harga Sewa</label>
                                        <input id="price" name="price" onkeyup="countTotal()"
                                            class="flex text-semibold in-out-spin-none w-32 border rounded-lg px-1 outline-none @error('price') is-invalid @enderror"
                                            type="number" min="0" placeholder="0" value="{{ old('price') }}"
                                            required>
                                        <label class="text-xs text-stone-900 ml-2">/ Tahun</label>
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Total Harga</label>
                                        <input id="totalPrice" name="totalPrice"
                                            class="flex text-semibold in-out-spin-none w-32 border rounded-lg px-1 outline-none"
                                            type="number" min="0" placeholder="0"
                                            value="{{ old('totalPrice') }}" readonly>
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Tgl. Awal Perjanjian</label>
                                        <input id="start_at" name="start_at"
                                            class="flex text-semibold border rounded-lg px-1 outline-none @error('start_at') is-invalid @enderror"
                                            type="date" value="{{ old('start_at') }}" required>
                                        @error('start_at')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Tgl. Akhir Perjanjian</label>
                                        <input min="0" id="end_at" name="end_at"
                                            class="flex text-semibold border rounded-lg px-1 outline-none @error('end_at') is-invalid @enderror"
                                            type="date" value="{{ old('end_at') }}">
                                        @error('end_at')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center border rounded-lg w-[1200px] p-2 mt-2">
                                <div class="flex border rounded-lg w-[580px] p-2 bg-stone-300">
                                    <div class="w-[275px] pl-2 py-2">
                                        <label
                                            class="text-xs font-semibold text-stone-900 flex justify-center w-full border-b">PIHAK
                                            PENYEWA</label>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">Nama</label>
                                            <input type="text" id="nameFirst" name="nameFirst"
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('nameFirst') is-invalid @enderror"
                                                value="{{ old('nameFirst') }}" placeholder="Input Nama" required>
                                            @error('nameFirst')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">Alamat</label>
                                            <textarea id="addressFirst" name="addressFirst" rows="5"
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('addressFirst') is-invalid @enderror"
                                                placeholder="Input Alamat" required>{{ old('addressFirst') }}</textarea>
                                            @error('addressFirst')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">No. KTP</label>
                                            <input type="text" id="idNumberFirst" name="idNumberFirst"
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('idNumberFirst') is-invalid @enderror"
                                                value="{{ old('idNumberFirst') }}" placeholder="Input No. KTP" required>
                                            @error('idNumberFirst')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">No. Hp</label>
                                            <input type="text" id="phoneFirst" name="phoneFirst"
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('phoneFirst') is-invalid @enderror"
                                                value="{{ old('phoneFirst') }}" placeholder="Input No. Hp" required>
                                            @error('phoneFirst')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="w-[275px] ml-2 p-2 border-l">
                                        <div class="flex justify-center items-center">
                                            <input type="file" id="ktpFirst" name="ktpFirst"
                                                onchange="previewImageFirst(this)" hidden>
                                            <button class="flex justify-center text-xs items-center w-36 btn-primary-small"
                                                title="Chose Files" type="button"
                                                onclick="document.getElementById('ktpFirst').click()">
                                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                    <path
                                                        d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                                </svg>
                                                <span class="ml-2">Upload KTP</span>
                                            </button>
                                        </div>
                                        @error('ktpFirst')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @error('ktpFirst.*')
                                            <div class="invalid-feedback">
                                                Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                            </div>
                                        @enderror
                                        <div class="flex m-auto w-[275px] h-max mt-2">
                                            <img class="m-auto img-preview-first flex items-center bg-white rounded-lg"
                                                src="/img/product-image.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex border rounded-lg w-[580px] bg-stone-300 ml-4">
                                    <div class="w-[275px] pl-2 py-2">
                                        <label
                                            class="text-xs font-semibold text-stone-900 flex justify-center w-full border-b">PIHAK
                                            YANG MENYEWAKAN</label>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">Nama</label>
                                            <input
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('nameSecond') is-invalid @enderror"
                                                type="text" id="nameSecond" name="nameSecond"
                                                value="{{ old('nameSecond') }}" placeholder="Input Nama" required>
                                            @error('nameSecond')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">Alamat</label>
                                            <textarea
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('addressSecond') is-invalid @enderror"
                                                id="addressSecond" name="addressSecond" rows="5" placeholder="Input Alamat" required>{{ old('addressSecond') }}</textarea>
                                            @error('addressSecond')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">No. KTP</label>
                                            <input
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('idNumberSecond') is-invalid @enderror"
                                                type="text" id="idNumberSecond" name="idNumberSecond"
                                                value="{{ old('idNumberSecond') }}" placeholder="Input No. KTP" required>
                                            @error('idNumberSecond')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">No. Hp</label>
                                            <input
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('phoneSecond') is-invalid @enderror"
                                                type="text" id="phoneSecond" name="phoneSecond"
                                                value="{{ old('phoneSecond') }}" placeholder="Input No. Hp" required>
                                            @error('phoneSecond')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="w-[275px] ml-2 p-2 border-l">
                                        <div class="flex justify-center items-center">
                                            <input type="file" id="ktpSecond" name="ktpSecond"
                                                onchange="previewImageSecond(this)" hidden>
                                            <button id="btnChooseImages"
                                                class="flex justify-center text-xs items-center w-36 btn-primary-small"
                                                title="Chose Files" type="button"
                                                onclick="document.getElementById('ktpSecond').click()">
                                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                    <path
                                                        d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                                </svg>
                                                <span class="ml-2">Upload KTP</span>
                                            </button>
                                        </div>
                                        @error('ktpSecond')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @error('ktpSecond.*')
                                            <div class="invalid-feedback">
                                                Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                            </div>
                                        @enderror
                                        <div class="flex m-auto w-[275px] h-max mt-2">
                                            <img class="m-auto img-preview-second flex items-center bg-white rounded-lg"
                                                src="/img/product-image.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center border rounded-lg w-[1200px] p-2 mt-4">
                            <div class="w-[950px]">
                                <div class="flex w-full justify-center">
                                    <input id="legalDocuments" name="legal_documents[]" type="file"
                                        accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)" multiple
                                        hidden>
                                    <button id="btnChooseImages"
                                        class="flex justify-center items-center w-44 btn-primary-small"
                                        title="Chose Files" type="button"
                                        onclick="document.getElementById('legalDocuments').click()">
                                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                        </svg>
                                        <span class="ml-2">Pilih Dokumen</span>
                                    </button>
                                </div>
                                <div class="flex items-center mt-2 w-full justify-center border rounded-lg">
                                    <label class="text-xs text-stone-100 w-20">Jumlah File</label>
                                    <label class="text-xs text-stone-100 ml-2">:</label>
                                    <label id="numberImagesFile" class="text-xs text-stone-100 ml-2"> 0 file yang
                                        dipilih</label>
                                </div>
                                @error('legal_documents')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('legal_documents.*')
                                    <div class="invalid-feedback">
                                        Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                    </div>
                                @enderror
                                <figure class="flex w-[950px] justify-center overflow-x-auto bg-stone-800 rounded-lg mt-2"
                                    id="figureImages">

                                </figure>
                                <div class="relative m-auto w-[950px] h-max mt-2">
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
                </div>
                <!-- New Land Agreement Input end -->
            </div>
        </div>
    </form>
    <!-- Container end -->
    <!-- Script start -->
    <script src="/js/addlegaldocuments.js"></script>

    <script>
        function previewImageFirst(sel) {
            const imgPreview = document.querySelector('.img-preview-first');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(sel.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImageSecond(sel) {
            const imgPreview = document.querySelector('.img-preview-second');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(sel.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        countTotal = () => {
            const duration = document.getElementById("duration");
            const price = document.getElementById("price");
            const totalPrice = document.getElementById("totalPrice");

            totalPrice.value = Number(price.value) * Number(duration.value);
        }
    </script>
    <!-- Script end -->
@endsection
