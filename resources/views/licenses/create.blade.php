@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    <?php
    $description = json_decode($location->description);
    ?>
    <form action="/media/licenses" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center p-10 bg-stone-800">
            <div class="bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[850px]"> MENAMBAHKAN DATA IZIN</h1>
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
                        <a class="flex justify-center items-center ml-1 btn-danger" href="/media/licenses">
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

                <!-- New Licenses Input start -->
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
                        <div class="flex justify-center mt-2">
                            <div class="flex justify-center border rounded-lg w-[400px] h-[550px] p-2 bg-stone-300">
                                <div class="w-[350px]">
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Jenis Izin</label>
                                        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
                                        <input type="text" name="location_id" value="{{ $location_id }}" hidden>
                                        <select id="licensing_category_id" name="licensing_category_id"
                                            class="flex text-semibold w-full border rounded-lg px-1 outline-none @error('licensing_category_id') is-invalid @enderror"
                                            value="{{ old('licensing_category_id') }}">
                                            <option value="pilih">- pilih -</option>
                                            @foreach ($licensing_categories as $licensing_category)
                                                @if (old('licensing_category_id') == $licensing_category->id)
                                                    <option value="{{ $licensing_category->id }}" selected>
                                                        {{ $licensing_category->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $licensing_category->id }}">
                                                        {{ $licensing_category->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('licensing_category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Nomor Izin</label>
                                        <input
                                            class="flex text-semibold w-full border rounded-lg px-1 outline-none @error('number') is-invalid @enderror"
                                            type="text" min="0" id="number" name="number"
                                            value="{{ old('number') }}" autofocus placeholder="Input Nomor Izin" required>
                                        @error('number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Penerbit Izin</label>
                                        <input
                                            class="flex text-semibold w-full border rounded-lg px-1 outline-none @error('government') is-invalid @enderror"
                                            type="text" min="0" id="government" name="government"
                                            value="{{ old('government') }}" placeholder="Input Penerbit Izin" required>
                                        @error('government')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Tanggal Izin Terbit</label>
                                        <input
                                            class="flex text-semibold border rounded-lg px-1 outline-none @error('published') is-invalid @enderror"
                                            type="date" min="0" id="published" name="published"
                                            value="{{ old('published') }}" required>
                                        @error('published')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Tanggal Awal Izin</label>
                                        <input
                                            class="flex text-semibold border rounded-lg px-1 outline-none @error('start_at') is-invalid @enderror"
                                            type="date" min="0" id="start_at" name="start_at"
                                            value="{{ old('start_at') }}" required>
                                        @error('start_at')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Tanggal Akhir Izin</label>
                                        <input
                                            class="flex text-semibold border rounded-lg px-1 outline-none @error('end_at') is-invalid @enderror"
                                            type="date" min="0" id="end_at" name="end_at"
                                            value="{{ old('end_at') }}">
                                        @error('end_at')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Keterangan</label>
                                        <textarea class="flex text-semibold w-full  border rounded-lg p-1 outline-none @error('notes') is-invalid @enderror"
                                            name="notes" rows="8" id="notes" placeholder="Input Keterangan">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-start border rounded-lg w-[780px] p-4 ml-4 bg-stone-300">
                                <div class="w-[750px]">
                                    <div class="flex w-full justify-center">
                                        <input id="legalDocuments" name="legal_documents[]" type="file"
                                            accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)"
                                            multiple hidden>
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
                                    <div
                                        class="flex items-center mt-2 w-full justify-center border rounded-lg border-stone-900">
                                        <label class="text-sm text-stone-900 w-20">Jumlah File</label>
                                        <label class="text-sm text-stone-900 ml-2">:</label>
                                        <label id="numberImagesFile" class="text-sm text-stone-900 ml-2"> 0 file yang
                                            dipilih</label>
                                    </div>
                                    @error('legal_documents')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @error('legal_docments.*')
                                        <div class="invalid-feedback">
                                            Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                        </div>
                                    @enderror
                                    <figure
                                        class="flex w-[750px] justify-center overflow-x-auto bg-stone-800 rounded-lg mt-2"
                                        id="figureImages">

                                    </figure>
                                    <div class="relative m-auto w-[750px] h-max mt-2">
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
                </div>
                <!-- New Licenses Input end -->
            </div>
        </div>
    </form>
    <!-- Container end -->
    <!-- Script start -->
    <script src="/js/addlegaldocuments.js"></script>
    <!-- Script end -->
@endsection
