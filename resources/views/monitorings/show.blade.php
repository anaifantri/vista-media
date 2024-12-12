@extends('dashboard.layouts.main');

@section('container')
    <?php
    $description = json_decode($location->description);
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="w-[1000px] z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex items-center border-b">
                <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[800px]">DETAIL FOTO PEMANTAUAN
                    {{ strtoupper($bulan[(int) date('m', strtotime($monitoring->month))]) }}
                    {{ date('Y', strtotime($monitoring->month)) }}</h4>
                <div class="flex items-center w-full justify-end">
                    <a href="/show-monitoring/{{ $location->id }}" class="flex items-center justify-center btn-primary mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Back </span>
                    </a>
                    @canany(['isAdmin', 'isWorkshop'])
                        @can('isElectricity')
                            @can('isWorkshopEdit')
                                <a href="/workshop/monitorings/{{ $monitoring->id }}/edit"
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
                    @canany(['isAdmin', 'isWorkshop'])
                        @can('isElectricity')
                            @can('isWorkshopDelete')
                                <form action="/workshop/monitorings/{{ $monitoring->id }}" method="post" class="d-inline m-1">
                                    @method('delete')
                                    @csrf
                                    <button class="flex items-center justify-center btn-danger"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus data foto pemantaun bulan {{ $bulan[(int) date('m', strtotime($monitoring->month))] }}..?')">
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

            <!-- View start -->
            <div class="flex w-full justify-center mt-4">
                <div class="flex w-[485px] border rounded-lg p-2 bg-stone-200">
                    <div>
                        <div>
                            <label class="text-sm text-stone-900">Bulan</label>
                            <label
                                class="flex w-[200px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">
                                {{ $bulan[(int) date('m', strtotime($monitoring->month))] }}
                                {{ date('Y', strtotime($monitoring->month)) }}
                            </label>
                        </div>
                        <div>
                            <label class="text-sm text-stone-900">Tanggal Foto</label>
                            <label
                                class="flex w-[200px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">
                                {{ date('d', strtotime($monitoring->monitoring_date)) }}
                                {{ $bulan[(int) date('m', strtotime($monitoring->monitoring_date))] }}
                                {{ date('Y', strtotime($monitoring->monitoring_date)) }}
                            </label>
                        </div>
                        <div>
                            <label class="text-sm text-stone-900">Keterangan</label>
                            <textarea rows="6"
                                class=" flex w-[450px] text-sm in-out-spin-none font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('notes') is-invalid @enderror"
                                readonly>{{ $monitoring->notes }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center w-[485px] border rounded-lg p-2 bg-stone-200 ml-4">
                    <div>
                        <div class="w-[460px] h-max">
                            <div class="flex justify-center">
                                <div class="w-[460px]">
                                    <div class="mt-1  border-b-2 border-teal-700 py-2">
                                        <div class="flex justify-center w-full">
                                            <label class="text-sm text-stone-900">FOTO PEMANTAUAN</label>
                                        </div>
                                        <div class="flex items-center w-full justify-center">
                                            <label id="numberImagesFile" class="text-sm text-stone-900 ml-2">Jumlah :
                                                {{ count($photos) }} foto</label>
                                        </div>
                                    </div>
                                    <div class="relative m-auto w-[450px] h-[300px] p-2">
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
                                        <div id="slidesPreview" class="mt-2 w-full">
                                            @foreach ($photos as $photo)
                                                @if ($loop->iteration == 1)
                                                    <img class="m-auto flex border rounded-lg items-center w-[450px]"
                                                        src="{{ asset('storage/' . $photo->photo) }}">
                                                @else
                                                    <img class="m-auto hidden border rounded-lg items-center w-[450px]"
                                                        src="{{ asset('storage/' . $photo->photo) }}">
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View end -->
            <!-- Location start -->
            <div class="flex w-full justify-center mt-1">
                <div class="flex w-full justify-center mt-1">
                    <div class="w-[485px] border rounded-lg p-2 bg-stone-200">
                        <div>
                            <label class="text-sm text-stone-900">Kode Lokasi</label>
                            <label
                                class="flex w-[150px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->code }}-{{ $location->city->code }}</label>
                        </div>
                        <div>
                            <label class="text-sm text-stone-900">Alamat</label>
                            <textarea class="flex w-[460px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none"
                                rows="2" readonly>{{ $location->address }}</textarea>
                        </div>
                        <div class="flex">
                            <div>
                                <div>
                                    <label class="text-sm text-stone-900">Jenis</label>
                                    <label
                                        class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->media_category->name }}
                                        - {{ $description->lighting }}</label>
                                </div>
                                <div>
                                    <label class="text-sm text-stone-900">Ukuran</label>
                                    <label
                                        class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->media_size->size }}
                                        - {{ $location->orientation }}</label>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div>
                                    <label class="text-sm text-stone-900">Area</label>
                                    <label
                                        class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->area->area }}</label>
                                </div>
                                <div>
                                    <label class="text-sm text-stone-900">Kota</label>
                                    <label
                                        class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->city->city }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center items-center w-[485px] border rounded-lg py-4 bg-stone-200 ml-4">
                        <img class="w-[420px] border rounded-lg" src="{{ asset('storage/' . $location_photo->photo) }}"
                            alt="">
                    </div>
                </div>
            </div>
            <!-- Location end -->
        </div>
    </div>
    <!-- Container end -->
    <script>
        const slidesPreview = document.getElementById("slidesPreview");
        const images = slidesPreview.getElementsByTagName("img");
        var fileLength = images.length;
        var index = 0;
        const nextButton = document.getElementById("nextButton");
        const prevButton = document.getElementById("prevButton");

        if (fileLength > 1) {
            prevButton.removeAttribute('hidden');
            nextButton.removeAttribute('hidden');
        }

        //prev button action --> start
        prevButtonAction = () => {
            if (index != 0) {
                images[index].classList.add("hidden");
                images[index].classList.remove("flex");
                index = index - 1;
                images[index].classList.remove("hidden");
                images[index].classList.add("flex");
            } else {
                images[index].classList.add("hidden");
                images[index].classList.remove("flex");
                index = fileLength - 1;
                images[index].classList.remove("hidden");
                images[index].classList.add("flex");
            }
        }
        //prev button action --> end

        //next button action --> start
        nextButtonAction = () => {
            if (index != fileLength - 1) {
                images[index].classList.add("hidden");
                images[index].classList.remove("flex");
                index = index + 1;
                images[index].classList.remove("hidden");
                images[index].classList.add("flex");
            } else {
                images[index].classList.add("hidden");
                images[index].classList.remove("flex");
                index = 0;
                images[index].classList.remove("hidden");
                images[index].classList.add("flex");
            }
        }
        //next button action --> end
    </script>
@endsection