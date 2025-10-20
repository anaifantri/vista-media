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
        $images = json_decode($publish_content->images);
        if ($sale) {
            $product = json_decode($sale->product);
            $client = json_decode($sale->quotation->clients);
        }
    @endphp
    <!-- Show start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="p-4 w-[1000px] border rounded-lg bg-stone-700">
            <div class="flex items-center justify-center border-b p-1">
                <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[950px]">DETAIL PENAYANGAN MATERI VIDEOTRON
                </h4>
                <div class="flex justify-end w-full">
                    <a href="/workshop/publish-contents" class="flex items-center justify-center btn-primary mx-1">
                        <svg class="fill-current w-5 rotate-180" clip-rule="evenodd" fill-rule="evenodd"
                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                        </svg>
                        <span class="mx-1"> Back </span>
                    </a>
                    @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isAccounting', 'isMarketing'])
                        @can('isContent')
                            @can('isWorkshopEdit')
                                <a href="/workshop/publish-contents/{{ $publish_content->id }}/edit"
                                    class="flex items-center justify-center btn-warning">
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
                    @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isAccounting', 'isMarketing'])
                        @can('isContent')
                            @can('isWorkshopDelete')
                                <form action="/workshop/publish-contents/{{ $publish_content->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="flex items-center justify-center btn-danger mx-1"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus data upload materi videotron ini..?')">
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
            <!-- Alert start -->
            @if (session()->has('success'))
                <div class="ml-2 flex alert-success mt-2">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            <!-- Alert end -->
            <!-- View Create start -->
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="border rounded-lg p-2 bg-stone-200 w-full">
                    <div class="mt-2">
                        <label class="text-sm text-stone-900 w-24">Kode Lokasi</label>
                        <label
                            class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg border-stone-900 px-2 py-1">
                            {{ $publish_content->location->code }}-{{ $publish_content->location->city->code }}
                        </label>
                    </div>
                    <div class="mt-2">
                        <label class="text-sm text-stone-900 w-24">Lokasi</label>
                        <label
                            class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg border-stone-900 px-2 py-1">
                            {{ $location->address }}
                        </label>
                    </div>
                    <div class="mt-2">
                        <label class="text-sm text-stone-900 w-24">Ukuran</label>
                        <label
                            class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg border-stone-900 px-2 py-1">
                            {{ $location->media_size->size }}-{{ $location->orientation }}
                        </label>
                    </div>

                    @if ($publish_content->status == 'Berbayar')
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Klien</label>
                            <label
                                class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg border-stone-900 px-2 py-1">
                                {{ $client->company }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Periode Kontrak</label>
                            <label
                                class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg border-stone-900 px-2 py-1">
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
                            <label
                                class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg border-stone-900 px-2 py-1">
                                {{ date('d', strtotime($publish_content->publish_date)) }}-{{ $bulan_full[(int) date('m', strtotime($publish_content->publish_date))] }}-{{ date('Y', strtotime($publish_content->publish_date)) }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <span class="text-sm text-stone-900">Status</span>
                            <label
                                class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg border-stone-900 px-2 py-1">
                                @if ($publish_content->status == 'Free')
                                    Gratis
                                @else
                                    Berbayar
                                @endif
                            </label>
                        </div>
                        <div class="mt-2">
                            <span class="text-sm text-stone-900">Tema</span>
                            <label
                                class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg border-stone-900 px-2 py-1">
                                {{ $publish_content->theme }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <span class="text-sm text-stone-900">Catatan</span>
                            <label
                                class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg border-stone-900 px-2 py-1">
                                {{ $publish_content->notes }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View Create end -->
            <!-- View Photos start -->
            <div class="w-[965px] border rounded-lg mt-2">
                <label class="flex w-full justify-center text-stone-100 test-sm font-semibold">Foto Dokumentasi</label>
                <div class="w-[940px] p-2">
                    <figure id="figureImages"
                        class="flex w-[940px] justify-center overflow-x-auto bg-stone-800 rounded-lg mt-2">
                        @foreach ($images as $image)
                            @if (count($images) > 2)
                                @if ($loop->iteration - 1 == intdiv(count($images), 2))
                                    <img id="day{{ $loop->iteration - 1 }}" class="documentation-photo-active"
                                        src="{{ asset('storage/' . $image) }}" alt="" onclick="figureAction(this)">
                                @else
                                    <img id="day{{ $loop->iteration - 1 }}" class="documentation-photo"
                                        src="{{ asset('storage/' . $image) }}" alt="" onclick="figureAction(this)">
                                @endif
                            @else
                                @if ($loop->iteration == 1)
                                    <img id="day{{ $loop->iteration - 1 }}" class="documentation-photo-active"
                                        src="{{ asset('storage/' . $image) }}" alt="" onclick="figureAction(this)">
                                @else
                                    <img id="day{{ $loop->iteration - 1 }}" class="documentation-photo"
                                        src="{{ asset('storage/' . $image) }}" alt="" onclick="figureAction(this)">
                                @endif
                            @endif
                        @endforeach
                    </figure>
                    <div class="relative m-auto w-[940px] h-max mt-2">
                        <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                            <button
                                class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                type="button" onclick="buttonPrev()">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>
                            </button>
                        </div>
                        <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                            <button type="button"
                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                onclick="buttonNext()">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                </svg>
                            </button>
                        </div>
                        @foreach ($images as $image)
                            @if (count($images) > 2)
                                @if ($loop->iteration - 1 == intdiv(count($images), 2))
                                    <div class="divImages">
                                        <img src="{{ asset('storage/' . $image) }}" alt=""
                                            class="w-[940px] rounded-lg">
                                    </div>
                                @else
                                    <div class="divImages" hidden>
                                        <img src="{{ asset('storage/' . $image) }}" alt=""
                                            class="w-[940px] rounded-lg">
                                    </div>
                                @endif
                            @else
                                @if ($loop->iteration == 1)
                                    <div class="divImages">
                                        <img src="{{ asset('storage/' . $image) }}" alt=""
                                            class="w-[940px] rounded-lg">
                                    </div>
                                @else
                                    <div class="divImages" hidden>
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
        </div>
    </div>
    <!-- Show end -->
    <!-- Script start -->
    <script>
        const imageViews = document.querySelectorAll(".divImages");
        const figure = document.getElementById("figureImages");
        const figureImages = figure.getElementsByTagName("img");


        if (document.querySelectorAll(".divImages").length > 2) {
            var index = Math.floor(document.querySelectorAll(".divImages").length / 2);
        } else {
            var index = 0;
        }

        buttonNext = () => {
            if (index == imageViews.length - 1) {
                figureImages[index].classList.remove('documentation-photo-active');
                figureImages[index].classList.add('documentation-photo');
                figureImages[0].classList.remove('documentation-photo');
                figureImages[0].classList.add('documentation-photo-active');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[0].removeAttribute('hidden');
                index = 0;
            } else {
                figureImages[index].classList.remove('documentation-photo-active');
                figureImages[index].classList.add('documentation-photo');
                figureImages[index + 1].classList.add('documentation-photo-active');
                figureImages[index + 1].classList.remove('documentation-photo');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[index + 1].removeAttribute('hidden');
                index = index + 1;
            }
        }

        buttonPrev = () => {
            if (index == 0) {
                figureImages[index].classList.remove('documentation-photo-active');
                figureImages[index].classList.add('documentation-photo');
                figureImages[imageViews.length - 1].classList.remove('documentation-photo');
                figureImages[imageViews.length - 1].classList.add('documentation-photo-active');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[imageViews.length - 1].removeAttribute('hidden');
                index = imageViews.length - 1;
            } else {
                figureImages[index].classList.remove('documentation-photo-active');
                figureImages[index].classList.add('documentation-photo');
                figureImages[index - 1].classList.add('documentation-photo-active');
                figureImages[index - 1].classList.remove('documentation-photo');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[index - 1].removeAttribute('hidden');
                index = index - 1;
            }
        }
        figureAction = (sel) => {
            for (let i = 0; i < figureImages.length; i++) {
                if (figureImages[i].id == sel.id) {
                    figureImages[i].classList.remove('documentation-photo');
                    figureImages[i].classList.add('documentation-photo-active');
                    imageViews[i].removeAttribute('hidden');
                } else {
                    figureImages[i].classList.add('documentation-photo');
                    figureImages[i].classList.remove('documentation-photo-active');
                    imageViews[i].setAttribute('hidden', 'hidden');
                }
            }
            index = parseInt(sel.id.replace(/[^\d.]/g, ''));
        }
    </script>
    <!-- Script end -->
@endsection
