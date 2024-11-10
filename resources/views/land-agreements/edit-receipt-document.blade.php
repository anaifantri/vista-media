<div class="w-[950px] p-4">
    <div class="flex w-full justify-center">
        <a class="flex justify-center items-center w-44 btn-primary-small" title="Tambah Dokumen"
            href="/create-land-documents/{{ $land_agreement->id }}/receipt">
            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
                viewBox="0 0 24 24">
                <path d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
            </svg>
            <span class="ml-2">Tambah Dokumen</span>
        </a>
    </div>
    <div class="flex items-center mt-2 w-full justify-center border rounded-lg">
        <div>
            <label class="flex text-sm text-stone-100 justify-center font-semibold">DOKUMEN PEMBAYARAN</label>
            <label class="flex text-sm text-stone-100 justify-center">Jumlah Dokumen : {{ count($receipts) }}
                dokumen</label>
        </div>
    </div>
    <figure id="figureReceipt" class="flex w-[950px] justify-center overflow-x-auto bg-stone-800 mt-2 rounded-lg">
        @foreach ($receipts as $document)
            @if (count($receipts) > 2)
                @if ($loop->iteration - 1 == intdiv(count($receipts), 2))
                    <img id="{{ $document->id }}" class="photo-active" src="{{ asset('storage/' . $document->image) }}"
                        alt="" onclick="figureAction(this, 'receipt')">
                @else
                    <img id="{{ $document->id }}" class="photo" src="{{ asset('storage/' . $document->image) }}"
                        alt="" onclick="figureAction(this, 'receipt')">
                @endif
            @else
                @if ($loop->iteration == 1)
                    <img id="{{ $document->id }}" class="photo-active" src="{{ asset('storage/' . $document->image) }}"
                        alt="" onclick="figureAction(this, 'receipt')">
                @else
                    <img id="{{ $document->id }}" class="photo" src="{{ asset('storage/' . $document->image) }}"
                        alt="" onclick="figureAction(this, 'receipt')">
                @endif
            @endif
        @endforeach
    </figure>
    <div class="relative m-auto w-[950px] h-max mt-2">
        @if (count($receipts) > 0)
            <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                <button
                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                    type="button" onclick="buttonPrev('receipt')">
                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                        clip-rule="evenodd" viewBox="0 0 24 24">
                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                    </svg>
                </button>
            </div>
            <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                <button type="button"
                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                    onclick="buttonNext('receipt')">
                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                        clip-rule="evenodd" viewBox="0 0 24 24">
                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                    </svg>
                </button>
            </div>
        @else
            <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                <button
                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                    type="button">
                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                        clip-rule="evenodd" viewBox="0 0 24 24">
                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                    </svg>
                </button>
            </div>
            <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                <button type="button"
                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                        clip-rule="evenodd" viewBox="0 0 24 24">
                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                    </svg>
                </button>
            </div>
        @endif
        @foreach ($receipts as $document)
            @if (count($receipts) > 2)
                @if ($loop->iteration - 1 == intdiv(count($receipts), 2))
                    <div class="divImageReceipt">
                        <div class="absolute top-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                            <div class="flex items-center">
                                <div class="w-64">
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                            Upload</label>
                                        <label class="text-sm text-yellow-400">:</label>
                                        <label
                                            class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($document->updated_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($document->updated_at))] }}
                                            {{ date('Y', strtotime($document->updated_at)) }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                            Oleh</label>
                                        <label class="text-sm text-yellow-400">: </label>
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ $document->user->name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="flex w-full px-1 justify-end items-center">
                                    <button id="{{ $document->id }}" type="button" class="index-link btn-danger"
                                        onclick="deleteDocument(this)">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1">Hapus Dokumen</span>
                                    </button>
                                    <a class="flex justify-center items-center w-44 btn-primary mx-1"
                                        title="Edit Dokumen" href="/media/land-documents/{{ $document->id }}/edit">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                        </svg>
                                        <span class="mx-1">Ganti Dokumen</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $document->image) }}" alt="">
                    </div>
                @else
                    <div class="divImageReceipt" hidden>
                        <div class="absolute top-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                            <div class="flex items-center">
                                <div class="w-64">
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                            Upload</label>
                                        <label class="text-sm text-yellow-400">:</label>
                                        <label
                                            class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($document->updated_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($document->updated_at))] }}
                                            {{ date('Y', strtotime($document->updated_at)) }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                            Oleh</label>
                                        <label class="text-sm text-yellow-400">: </label>
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ $document->user->name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="flex w-full px-1 justify-end items-center">
                                    <button id="{{ $document->id }}" type="button" class="index-link btn-danger"
                                        onclick="deleteDocument(this)">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1">Hapus Dokumen</span>
                                    </button>
                                    <a class="flex justify-center items-center w-44 btn-primary mx-1"
                                        title="Tambah Dokumen" href="/media/land-documents/{{ $document->id }}/edit">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                        </svg>
                                        <span class="mx-1">Ganti Dokumen</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $document->image) }}" alt="">
                    </div>
                @endif
            @else
                @if ($loop->iteration == 1)
                    <div class="divImageReceipt">
                        <div class="absolute top-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                            <div class="flex items-center">
                                <div class="w-64">
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                            Upload</label>
                                        <label class="text-sm text-yellow-400">:</label>
                                        <label
                                            class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($document->updated_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($document->updated_at))] }}
                                            {{ date('Y', strtotime($document->updated_at)) }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                            Oleh</label>
                                        <label class="text-sm text-yellow-400">: </label>
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ $document->user->name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="flex w-full px-1 justify-end items-center">
                                    <button id="{{ $document->id }}" type="button" class="index-link btn-danger"
                                        onclick="deleteDocument(this)">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1">Hapus Dokumen</span>
                                    </button>
                                    <a class="flex justify-center items-center w-44 btn-primary mx-1"
                                        title="Tambah Dokumen" href="/media/land-documents/{{ $document->id }}/edit">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                        </svg>
                                        <span class="mx-1">Ganti Dokumen</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $document->image) }}" alt="">
                    </div>
                @else
                    <div class="divImageReceipt" hidden>
                        <div class="absolute top-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                            <div class="flex items-center">
                                <div class="w-64">
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                            Upload</label>
                                        <label class="text-sm text-yellow-400">:</label>
                                        <label
                                            class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($document->updated_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($document->updated_at))] }}
                                            {{ date('Y', strtotime($document->updated_at)) }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                            Oleh</label>
                                        <label class="text-sm text-yellow-400">: </label>
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ $document->user->name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="flex w-full px-1 justify-end items-center">
                                    <button id="{{ $document->id }}" type="button" class="index-link btn-danger"
                                        onclick="deleteDocument(this)">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1">Hapus Dokumen</span>
                                    </button>
                                    <a class="flex justify-center items-center w-44 btn-primary mx-1"
                                        title="Tambah Dokumen" href="/media/land-documents/{{ $document->id }}/edit">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                        </svg>
                                        <span class="mx-1">Ganti Dokumen</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $document->image) }}" alt="">
                    </div>
                @endif
            @endif
        @endforeach
    </div>
</div>
