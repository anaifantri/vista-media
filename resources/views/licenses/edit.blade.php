@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $location = $license->location;
    $description = json_decode($location->description);
    ?>
    <!-- Container start -->
    <form method="post" action="/media/licenses/{{ $license->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center p-10 bg-stone-800">
            <div class="bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[850px]">EDIT DATA IZIN
                        {{ strtoupper($license->licensing_category->name) }}</h1>
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
                        <a class="flex justify-center items-center ml-1 btn-danger"
                            href="/show-license/{{ $license->location->id }}">
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

                <!-- Edit Licenses Input start -->
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
                        <div class="flex justify-center">
                            <div class="flex justify-center border rounded-lg w-[400px] h-[550px] p- bg-stone-300">
                                <div class="w-[350px]">
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Jenis Izin</label>
                                        <input
                                            class="flex text-sm font-semibold mt-1 w-full text-slate-400 border rounded-lg px-1 outline-none"
                                            type="text" value="{{ $license->licensing_category->name }}" readonly>
                                    </div>
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Nomor Izin</label>
                                        <input
                                            class="flex text-semibold w-full border rounded-lg px-1 outline-none @error('number') is-invalid @enderror"
                                            type="text" min="0" id="number" name="number"
                                            value="{{ $license->number }}" autofocus placeholder="Input Nomor Izin"
                                            required>
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
                                            value="{{ $license->government }}" placeholder="Input Penerbit Izin" required>
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
                                            value="{{ $license->published }}" required>
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
                                            value="{{ $license->start_at }}" required>
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
                                            value="{{ $license->end_at }}">
                                        @error('end_at')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Keterangan</label>
                                        <textarea class="flex text-semibold w-full  border rounded-lg p-1 outline-none @error('notes') is-invalid @enderror"
                                            name="notes" rows="8" id="notes" placeholder="Input Keterangan">{{ $license->notes }}</textarea>
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
                                        <a class="flex justify-center items-center w-44 btn-primary-small"
                                            title="Tambah Dokumen" href="/create-license-documents/{{ $license->id }}">
                                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                            </svg>
                                            <span class="ml-2">Tambah Dokumen</span>
                                        </a>
                                    </div>
                                    <div
                                        class="flex items-center mt-2 w-full justify-center border rounded-lg border-stone-900">
                                        <label class="text-sm text-stone-900">Jumlah Dokumen</label>
                                        <label class="text-sm text-stone-900 ml-2">:</label>
                                        <label id="numberImagesFile" class="text-sm text-stone-900 ml-2">
                                            {{ count($license_documents) }} dokumen</label>
                                    </div>
                                    <!-- Alert start -->
                                    @if (session()->has('success'))
                                        <div class="ml-2 flex alert-success">
                                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                            </svg>
                                            <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                                        </div>
                                    @endif
                                    <!-- Alert end -->
                                    @error('document_license')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @error('document_license.*')
                                        <div class="invalid-feedback">
                                            Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                        </div>
                                    @enderror
                                    <figure id="figure"
                                        class="flex w-[750px] justify-center overflow-x-auto bg-stone-800 rounded-lg mt-2">
                                        @foreach ($license_documents as $document)
                                            @if (count($license_documents) > 2)
                                                @if ($loop->iteration - 1 == intdiv(count($license_documents), 2))
                                                    <img id="{{ $document->id }}" class="photo-active"
                                                        src="{{ asset('storage/' . $document->image) }}" alt=""
                                                        onclick="figureAction(this)">
                                                @else
                                                    <img id="{{ $document->id }}" class="photo"
                                                        src="{{ asset('storage/' . $document->image) }}" alt=""
                                                        onclick="figureAction(this)">
                                                @endif
                                            @else
                                                @if ($loop->iteration == 1)
                                                    <img id="{{ $document->id }}" class="photo-active"
                                                        src="{{ asset('storage/' . $document->image) }}" alt=""
                                                        onclick="figureAction(this)">
                                                @else
                                                    <img id="{{ $document->id }}" class="photo"
                                                        src="{{ asset('storage/' . $document->image) }}" alt=""
                                                        onclick="figureAction(this)">
                                                @endif
                                            @endif
                                        @endforeach
                                    </figure>
                                    <div class="relative m-auto w-[750px] h-max mt-2">
                                        <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                                            <button
                                                class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                                type="button" onclick="buttonPrev()">
                                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                    <path
                                                        d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                                            <button type="button"
                                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                                onclick="buttonNext()">
                                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                    <path
                                                        d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                                </svg>
                                            </button>
                                        </div>
                                        @foreach ($license_documents as $document)
                                            @if (count($license_documents) > 2)
                                                @if ($loop->iteration - 1 == intdiv(count($license_documents), 2))
                                                    <div class="divImage">
                                                        <div
                                                            class="absolute top-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                                            <div class="flex items-center">
                                                                <div class="w-64">
                                                                    <div class="flex">
                                                                        <label
                                                                            class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                                                            Upload</label>
                                                                        <label class="text-sm text-yellow-400">:</label>
                                                                        <label
                                                                            class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($document->created_at)) }}
                                                                            {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                                                            {{ date('Y', strtotime($document->created_at)) }}</label>
                                                                    </div>
                                                                    <div class="flex">
                                                                        <label
                                                                            class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                                                            Oleh</label>
                                                                        <label class="text-sm text-yellow-400">: </label>
                                                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                            {{ $document->user->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="flex w-full px-1 justify-end items-center">
                                                                    <button id="{{ $document->id }}" type="button"
                                                                        class="index-link btn-danger"
                                                                        onclick="deleteDocument(this)">
                                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                                fill-rule="nonzero" />
                                                                        </svg>
                                                                        <span class="mx-1">Hapus Dokumen</span>
                                                                    </button>
                                                                    <a class="flex justify-center items-center w-44 btn-primary mx-1"
                                                                        title="Tambah Dokumen"
                                                                        href="/media/license-documents/{{ $document->id }}/edit">
                                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                                                        </svg>
                                                                        <span class="mx-1">Ganti Dokumen</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{ asset('storage/' . $document->image) }}"
                                                            alt="">
                                                    </div>
                                                @else
                                                    <div class="divImage" hidden>
                                                        <div
                                                            class="absolute top-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                                            <div class="flex items-center">
                                                                <div class="w-64">
                                                                    <div class="flex">
                                                                        <label
                                                                            class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                                                            Upload</label>
                                                                        <label class="text-sm text-yellow-400">:</label>
                                                                        <label
                                                                            class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($document->created_at)) }}
                                                                            {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                                                            {{ date('Y', strtotime($document->created_at)) }}</label>
                                                                    </div>
                                                                    <div class="flex">
                                                                        <label
                                                                            class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                                                            Oleh</label>
                                                                        <label class="text-sm text-yellow-400">: </label>
                                                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                            {{ $document->user->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="flex w-full px-1 justify-end items-center">
                                                                    <button id="{{ $document->id }}" type="button"
                                                                        class="index-link btn-danger"
                                                                        onclick="deleteDocument(this)">
                                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                                fill-rule="nonzero" />
                                                                        </svg>
                                                                        <span class="mx-1">Hapus Dokumen</span>
                                                                    </button>
                                                                    <a class="flex justify-center items-center w-44 btn-primary mx-1"
                                                                        title="Tambah Dokumen"
                                                                        href="/media/license-documents/{{ $document->id }}/edit">
                                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                                                        </svg>
                                                                        <span class="mx-1">Ganti Dokumen</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{ asset('storage/' . $document->image) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                            @else
                                                @if ($loop->iteration == 1)
                                                    <div class="divImage">
                                                        <div
                                                            class="absolute top-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                                            <div class="flex items-center">
                                                                <div class="w-64">
                                                                    <div class="flex">
                                                                        <label
                                                                            class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                                                            Upload</label>
                                                                        <label class="text-sm text-yellow-400">:</label>
                                                                        <label
                                                                            class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($document->created_at)) }}
                                                                            {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                                                            {{ date('Y', strtotime($document->created_at)) }}</label>
                                                                    </div>
                                                                    <div class="flex">
                                                                        <label
                                                                            class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                                                            Oleh</label>
                                                                        <label class="text-sm text-yellow-400">: </label>
                                                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                            {{ $document->user->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="flex w-full px-1 justify-end items-center">
                                                                    <button id="{{ $document->id }}" type="button"
                                                                        class="index-link btn-danger"
                                                                        onclick="deleteDocument(this)">
                                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                                fill-rule="nonzero" />
                                                                        </svg>
                                                                        <span class="mx-1">Hapus Dokumen</span>
                                                                    </button>
                                                                    <a class="flex justify-center items-center w-44 btn-primary mx-1"
                                                                        title="Tambah Dokumen"
                                                                        href="/media/license-documents/{{ $document->id }}/edit">
                                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                                                        </svg>
                                                                        <span class="mx-1">Ganti Dokumen</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{ asset('storage/' . $document->image) }}"
                                                            alt="">
                                                    </div>
                                                @else
                                                    <div class="divImage" hidden>
                                                        <div
                                                            class="absolute top-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                                            <div class="flex items-center">
                                                                <div class="w-64">
                                                                    <div class="flex">
                                                                        <label
                                                                            class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                                                            Upload</label>
                                                                        <label class="text-sm text-yellow-400">:</label>
                                                                        <label
                                                                            class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($document->created_at)) }}
                                                                            {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                                                            {{ date('Y', strtotime($document->created_at)) }}</label>
                                                                    </div>
                                                                    <div class="flex">
                                                                        <label
                                                                            class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                                                            Oleh</label>
                                                                        <label class="text-sm text-yellow-400">: </label>
                                                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                            {{ $document->user->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="flex w-full px-1 justify-end items-center">
                                                                    <button id="{{ $document->id }}" type="button"
                                                                        class="index-link btn-danger"
                                                                        onclick="deleteDocument(this)">
                                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                                fill-rule="nonzero" />
                                                                        </svg>
                                                                        <span class="mx-1">Hapus Dokumen</span>
                                                                    </button>
                                                                    <a class="flex justify-center items-center w-44 btn-primary mx-1"
                                                                        title="Tambah Dokumen"
                                                                        href="/media/license-documents/{{ $document->id }}/edit">
                                                                        <svg class="fill-current w-5" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                                                        </svg>
                                                                        <span class="mx-1">Ganti Dokumen</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{ asset('storage/' . $document->image) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Licenses Input end -->
            </div>
        </div>
    </form>
    <form id="formDelete" method="post" hidden>
        @method('delete')
        @csrf
    </form>
    <!-- Container end -->
    <!-- Script start -->
    <script src="/js/editlicense.js"></script>
    <!-- Script end -->
@endsection
