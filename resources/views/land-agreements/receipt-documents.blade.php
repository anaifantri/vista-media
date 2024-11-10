<div class="w-[950px] p-4">
    <div class="border-t border-b border-stone-900 p-1">
        <label class="flex justify-center text-sm font-semibold text-stone-900">DOKUMEN PEMBAYARAN</label>
        <label class="flex justify-center text-sm font-semibold text-stone-900">Jumlah Dokumen :
            {{ count($receipts) }} dokumen</label>
    </div>
    <figure class="flex w-[950px] justify-center overflow-x-auto bg-stone-800 rounded-lg mt-2" id="figureReceipt">
        @foreach ($receipts as $document)
            @if (count($receipts) > 2)
                @if ($loop->iteration - 1 == intdiv(count($receipts), 2))
                    <img id="{{ $loop->iteration - 1 }}" class="photo-active"
                        src="{{ asset('storage/' . $document->image) }}" alt=""
                        onclick="figureAction(this,'receipt')">
                @else
                    <img id="{{ $loop->iteration - 1 }}" class="photo" src="{{ asset('storage/' . $document->image) }}"
                        alt="" onclick="figureAction(this,'receipt')">
                @endif
            @else
                @if ($loop->iteration == 1)
                    <img id="{{ $loop->iteration - 1 }}" class="photo-active"
                        src="{{ asset('storage/' . $document->image) }}" alt=""
                        onclick="figureAction(this,'receipt')">
                @else
                    <img id="{{ $loop->iteration - 1 }}" class="photo" src="{{ asset('storage/' . $document->image) }}"
                        alt="" onclick="figureAction(this,'receipt')">
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
                    type="button" onclick="buttonPrev('receipt')">
                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                        clip-rule="evenodd" viewBox="0 0 24 24">
                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                    </svg>
                </button>
            </div>
            <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                <button type="button"
                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                    onclick="buttonNext('receipt')">
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
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ date('d', strtotime($document->created_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                            {{ date('Y', strtotime($document->created_at)) }}
                                        </label>
                                    </div>
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                            Oleh</label>
                                        <label class="text-sm text-yellow-400">: </label>
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ $land_agreement->user->name }}
                                        </label>
                                    </div>
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
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ date('d', strtotime($document->created_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                            {{ date('Y', strtotime($document->created_at)) }}
                                        </label>
                                    </div>
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                            Oleh</label>
                                        <label class="text-sm text-yellow-400">: </label>
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ $land_agreement->user->name }}
                                        </label>
                                    </div>
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
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ date('d', strtotime($document->created_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                            {{ date('Y', strtotime($document->created_at)) }}
                                        </label>
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
                                        <label class="text-sm text-yellow-400 ml-2 w-40">
                                            {{ date('d', strtotime($document->created_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                            {{ date('Y', strtotime($document->created_at)) }}
                                        </label>
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
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $document->image) }}" alt="">
                    </div>
                @endif
            @endif
        @endforeach
    </div>
</div>
