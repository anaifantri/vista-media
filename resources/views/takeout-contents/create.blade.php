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
        if ($sale) {
            $client = json_decode($sale->quotation->clients);
        }
        $images = json_decode($publish_content->images);
    @endphp
    <!-- Form Editstart -->
    <form action="/workshop/takeout-contents" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
        @if ($sale)
            <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
        @else
            <input type="text" name="sale_id" hidden>
        @endif
        <input type="text" name="location_id" value="{{ $location->id }}" hidden>
        <input type="text" name="publish_content_id" value="{{ $publish_content->id }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="p-4 w-[1000px] border rounded-lg bg-stone-700">
                <div class="flex items-center justify-center border-b p-1">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[950px]">TAMBAH DATA TAKE OUT MATERI
                        VIDEOTRON
                    </h4>
                    <div class="flex justify-end w-full">
                        <a href="/workshop/takeout-contents/create"
                            class="flex items-center justify-center btn-danger mx-1">
                            <svg class="fill-current w-5 rotate-180" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1"> Back </span>
                        </a>
                        <button id="btnSave" name="btnSave" class="flex justify-center items-center ml-1 btn-primary"
                            type="submit">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-1">Save</span>
                        </button>
                    </div>
                </div>
                <!-- View Create start -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="border rounded-lg p-2 bg-stone-200 w-full">
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Kode Lokasi</label>
                            <label
                                class="flex w-[450px] text-sm font-semibold border rounded-lg border-stone-900 px-2 text-stone-900 p-1">
                                {{ $publish_content->location->code }}-{{ $publish_content->location->city->code }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Lokasi</label>
                            <label
                                class="flex w-[450px] text-sm font-semibold border rounded-lg border-stone-900 px-2 text-stone-900 p-1">
                                {{ $location->address }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Ukuran</label>
                            <label
                                class="flex w-[450px] text-sm font-semibold border rounded-lg border-stone-900 px-2 text-stone-900 p-1">
                                {{ $location->media_size->size }}-{{ $location->orientation }}
                            </label>
                        </div>

                        @if ($publish_content->status == 'Berbayar')
                            <div class="mt-2">
                                <label class="text-sm text-stone-900 w-24">Klien</label>
                                <label
                                    class="flex w-[450px] text-sm font-semibold border rounded-lg border-stone-900 px-2 text-stone-900 py-1">
                                    {{ $client->company }}
                                </label>
                            </div>
                            <div class="mt-2">
                                <label class="text-sm text-stone-900 w-24">Periode Kontrak</label>
                                <label
                                    class="flex w-[450px] text-sm font-semibold border rounded-lg border-stone-900 px-2 text-stone-900 py-1">
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
                                    class="flex w-[450px] text-sm font-semibold border rounded-lg border-stone-900 px-2 text-stone-900 py-1">
                                    {{ date('d', strtotime($publish_content->publish_date)) }}-{{ $bulan[(int) date('m', strtotime($publish_content->publish_date))] }}-{{ date('Y', strtotime($publish_content->publish_date)) }}
                                </label>
                            </div>
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Tema</span>
                                <label
                                    class="flex w-[450px] text-sm font-semibold border rounded-lg border-stone-900 px-2 text-stone-900 py-1">
                                    {{ $publish_content->theme }}
                                </label>
                            </div>
                            <div class="mt-4 font-semibold border-b border-stone-900">
                                INPUT DATA TAKE OUT
                            </div>
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Tgl. Takeout</span>
                                <input name="take_out_date"
                                    class="flex w-[150px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('take_out_date') is-invalid @enderror"
                                    value="{{ old('take_out_date') }}" type="date" required>
                            </div>
                            @error('take_out_date')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Catatan</span>
                                <textarea
                                    class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('notes') is-invalid @enderror"
                                    name="notes" rows="3" placeholder="Input Catatan" required>{{ old('notes') }}</textarea>
                            </div>
                            @error('notes')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- View Create end -->
                <!-- View Photos start -->
                <div class="w-[965px] border rounded-lg mt-8" id="divOldImages">
                    <div class="flex items-center justify-center border-b p-1">
                        <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[950px]">FOTO DOKUMENTASI</h4>
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
            </div>
        </div>
    </form>
    <!-- Form Editend -->
    <!-- Show end -->
    <!-- Script start -->
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
    </script>
    <!-- Script end -->
@endsection
