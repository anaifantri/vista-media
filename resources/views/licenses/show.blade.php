@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $published = date('d', strtotime($license->published)) . ' ' . $bulan[(int) date('m', strtotime($license->published))] . ' ' . date('Y', strtotime($license->published));
    $start_at = date('d', strtotime($license->start_at)) . ' ' . $bulan[(int) date('m', strtotime($license->start_at))] . ' ' . date('Y', strtotime($license->start_at));
    $end_at = date('d', strtotime($license->end_at)) . ' ' . $bulan[(int) date('m', strtotime($license->end_at))] . ' ' . date('Y', strtotime($license->end_at));
    $location = $license->location;
    $description = json_decode($location->description);
    ?>
    <!-- Container start -->
    <div class="flex justify-center bg-stone-800 p-10">
        <div class="bg-stone-700 p-2 border rounded-md">
            <!-- Title start -->
            <div class="flex w-[1200px] items-center border-b p-1">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[850px]">DETAIL IZIN
                    {{ strtoupper($license->licensing_category->name) }}</h1>
                <div class="flex items-center w-full justify-end">
                    <a href="/show-license/{{ $license->location->id }}"
                        class="flex items-center justify-center btn-primary mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Back </span>
                    </a>
                    @canany(['isAdmin', 'isMedia'])
                        @can('isLegal')
                            @can('isMediaEdit')
                                <a href="/media/licenses/{{ $license->id }}/edit" class="flex items-center justify-center btn-warning">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1"> Edit </span>
                                </a>
                            @endcan
                        @endcan
                    @endcanany
                    @canany(['isAdmin', 'isMedia'])
                        @can('isLegal')
                            @can('isMediaDelete')
                                <form action="/media/licenses/{{ $license->id }}" method="post" class="d-inline m-1">
                                    @method('delete')
                                    @csrf
                                    <button class="flex items-center justify-center btn-danger"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus data izin dengan nomor {{ $license->number }} ?')">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1"> Delete </span>
                                    </button>
                                </form>
                            @endcan
                        @endcan
                    @endcanany
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
                                    <label class="flex text-sm text-stone-900">Jenis Izin</label>
                                    <input class="flex text-semibold mt-1 w-full border rounded-lg px-1 outline-none"
                                        type="text" value="{{ $license->licensing_category->name }}" readonly>
                                </div>
                                <div class="mt-2">
                                    <label class="flex text-sm text-stone-900">Nomor Izin</label>
                                    <input class="flex text-semibold mt-1 w-full border rounded-lg px-1 outline-none"
                                        type="text" value="{{ $license->number }}" readonly>
                                </div>
                                <div class="mt-2">
                                    <label class="flex text-sm text-stone-900">Penerbit Izin</label>
                                    <input class="flex text-semibold mt-1 w-full border rounded-lg px-1 outline-none"
                                        type="text" value="{{ $license->government }}" readonly>
                                </div>
                                <div class="mt-2">
                                    <label class="flex text-sm text-stone-900">Tanggal Terbit</label>
                                    <input class="flex text-semibold mt-1 w-full border rounded-lg px-1 outline-none"
                                        type="text" value="{{ $published }}" readonly>
                                </div>
                                <div class="mt-2">
                                    <label class="flex text-sm text-stone-900">Tanggal Awal Izin</label>
                                    <input class="flex text-semibold mt-1 w-full border rounded-lg px-1 outline-none"
                                        type="text" value="{{ $start_at }}" readonly>
                                </div>
                                <div class="mt-2">
                                    <label class="flex text-sm text-stone-900">Tanggal Akhir Izin</label>
                                    <input class="flex text-semibold mt-1 w-full border rounded-lg px-1 outline-none"
                                        type="text" value="{{ $end_at }}" readonly>
                                </div>
                                <div class="mt-2">
                                    <label class="flex text-sm text-stone-900">Keterangan</label>
                                    <textarea class="flex text-semibold mt-1 w-full  border rounded-lg p-1 outline-none" rows="8" readonly>{{ $license->notes }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-start border rounded-lg w-[780px] p-4 ml-4 bg-stone-300">
                            <div class="w-[750px]">
                                <div class="flex items-center w-full justify-center font-semibold border-b">
                                    <label class="text-sm text-stone-900">Dokumen Izin
                                        {{ $license->licensing_category->name }}</label>
                                </div>
                                <figure class="flex w-[750px] justify-center overflow-x-auto rounded-lg bg-stone-800 mt-2"
                                    id="figure">
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
                                                        class="absolute bottom-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                                        <div class="flex items-center">
                                                            <div class="w-64">
                                                                <div class="flex">
                                                                    <label
                                                                        class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                                                        Upload</label>
                                                                    <label class="text-sm text-yellow-400">:</label>
                                                                    <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                        {{ date('d', strtotime($document->created_at)) }}
                                                                        {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                                                        {{ date('Y', strtotime($document->created_at)) }}
                                                                    </label>
                                                                </div>
                                                                <div class="flex">
                                                                    <label
                                                                        class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                                                        Oleh</label>
                                                                    <label class="text-sm text-yellow-400">: </label>
                                                                    <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                        {{ $license->user->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <img src="{{ asset('storage/' . $document->image) }}" alt="">
                                                </div>
                                            @else
                                                <div class="divImage" hidden>
                                                    <div
                                                        class="absolute bottom-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                                        <div class="flex items-center">
                                                            <div class="w-64">
                                                                <div class="flex">
                                                                    <label
                                                                        class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                                                        Upload</label>
                                                                    <label class="text-sm text-yellow-400">:</label>
                                                                    <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                        {{ date('d', strtotime($document->created_at)) }}
                                                                        {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                                                        {{ date('Y', strtotime($document->created_at)) }}
                                                                    </label>
                                                                </div>
                                                                <div class="flex">
                                                                    <label
                                                                        class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                                                        Oleh</label>
                                                                    <label class="text-sm text-yellow-400">: </label>
                                                                    <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                        {{ $license->user->name }}
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
                                                <div class="divImage">
                                                    <div
                                                        class="absolute bottom-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                                        <div class="flex items-center">
                                                            <div class="w-64">
                                                                <div class="flex">
                                                                    <label
                                                                        class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                                                        Upload</label>
                                                                    <label class="text-sm text-yellow-400">:</label>
                                                                    <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                        {{ date('d', strtotime($document->created_at)) }}
                                                                        {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                                                        {{ date('Y', strtotime($document->created_at)) }}
                                                                    </label>
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
                                                        </div>
                                                    </div>
                                                    <img src="{{ asset('storage/' . $document->image) }}" alt="">
                                                </div>
                                            @else
                                                <div class="divImage" hidden>
                                                    <div
                                                        class="absolute bottom-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                                        <div class="flex items-center">
                                                            <div class="w-64">
                                                                <div class="flex">
                                                                    <label
                                                                        class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                                                        Upload</label>
                                                                    <label class="text-sm text-yellow-400">:</label>
                                                                    <label class="text-sm text-yellow-400 ml-2 w-40">
                                                                        {{ date('d', strtotime($document->created_at)) }}
                                                                        {{ $bulan[(int) date('m', strtotime($document->created_at))] }}
                                                                        {{ date('Y', strtotime($document->created_at)) }}
                                                                    </label>
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
                                                        </div>
                                                    </div>
                                                    <img src="{{ asset('storage/' . $document->image) }}" alt="">
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
            <!-- New Licenses Input end -->
        </div>
    </div>
    <!-- Container end -->
    <!-- Script start -->
    {{-- <script src="/js/addlicensedocuments.js"></script> --}}
    <script>
        // Funtion Button Next-Prev-figure start -->
        const imageViews = document.querySelectorAll(".divImage");
        const figure = document.getElementById("figure");
        const figureImages = figure.getElementsByTagName("img");
        var index = 0;

        if (imageViews.length > 2) {
            index = Math.floor(imageViews.length / 2);
        } else {
            index = 0;
        }

        buttonNext = () => {
            if (index == imageViews.length - 1) {
                figureImages[index].classList.remove('photo-active');
                figureImages[index].classList.add('photo');
                figureImages[0].classList.remove('photo');
                figureImages[0].classList.add('photo-active');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[0].removeAttribute('hidden');
                index = 0;
            } else {
                figureImages[index].classList.remove('photo-active');
                figureImages[index].classList.add('photo');
                figureImages[index + 1].classList.add('photo-active');
                figureImages[index + 1].classList.remove('photo');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[index + 1].removeAttribute('hidden');
                index = index + 1;
            }
        }
        buttonPrev = () => {
            if (index == 0) {
                figureImages[index].classList.remove('photo-active');
                figureImages[index].classList.add('photo');
                figureImages[imageViews.length - 1].classList.remove('photo');
                figureImages[imageViews.length - 1].classList.add('photo-active');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[imageViews.length - 1].removeAttribute('hidden');
                index = imageViews.length - 1;
            } else {
                figureImages[index].classList.remove('photo-active');
                figureImages[index].classList.add('photo');
                figureImages[index - 1].classList.add('photo-active');
                figureImages[index - 1].classList.remove('photo');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[index - 1].removeAttribute('hidden');
                index = index - 1;
            }
        }
        figureAction = (sel) => {
            for (let i = 0; i < figureImages.length; i++) {
                if (figureImages[i].id == sel.id) {
                    figureImages[i].classList.remove('photo');
                    figureImages[i].classList.add('photo-active');
                    imageViews[i].removeAttribute('hidden');
                } else {
                    figureImages[i].classList.add('photo');
                    figureImages[i].classList.remove('photo-active');
                    imageViews[i].setAttribute('hidden', 'hidden');
                }
            }
        }
        // Funtion Button Next-Prev-figure end -->
    </script>
    <!-- Script end -->
@endsection
