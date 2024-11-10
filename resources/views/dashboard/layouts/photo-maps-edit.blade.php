<!-- Location Photo & Maps start -->
<div class="flex justify-center bg-stone-300 border rounded-lg w-[650px] p-4 ml-4">
    <div>
        <!-- Location Photo start -->
        <div>
            <span class="border-b flex justify-center text-base font-semibold w-full">Photo Lokasi</span>
            <div class="flex items-center border-b">
                <button class="index-link btn-primary" onclick="showModalAdd()" type="button">
                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                            fill-rule="nonzero" />
                    </svg>
                    <span class="mx-1">Tambah Photo</span>
                </button>
                @if (session()->has('success'))
                    <div class="ml-2 flex alert-success">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        @error('photo')
            <div class="invalid-feedback ml-5 ">
                {{ $message }}
            </div>
        @enderror
        @error('add_photo')
            <div class="invalid-feedback ml-5 ">
                {{ $message }}
            </div>
        @enderror
        @error('update_photo')
            <div class="invalid-feedback ml-5 ">
                {{ $message }}
            </div>
        @enderror
        <div class="mt-2">
            <figure id="figure"
                class="flex w-[600px] bg-stone-800 rounded-lg justify-center overflow-x-auto border-b-2 border-stone-900">
                @foreach ($location_photos as $photo)
                    @if ($photo->set_default == true)
                        <img id="{{ $photo->id }}" class="photo-active" src="{{ asset('storage/' . $photo->photo) }}"
                            alt="" onclick="figureAction(this)">
                    @else
                        <img id="{{ $photo->id }}" class="photo" src="{{ asset('storage/' . $photo->photo) }}"
                            alt="" onclick="figureAction(this)">
                    @endif
                @endforeach
            </figure>
            <div class=" relative mt-2 lg-photo-product border ">
                <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                    <button
                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                        type="button" onclick="buttonPrev()">
                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                            clip-rule="evenodd" viewBox="0 0 24 24">
                            <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                        </svg>
                    </button>
                </div>
                <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                    <button type="button"
                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                        onclick="buttonNext()">
                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                            clip-rule="evenodd" viewBox="0 0 24 24">
                            <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                        </svg>
                    </button>
                </div>
                @foreach ($location_photos as $photo)
                    <div id="{{ $photo->set_default }}" class="divImage" hidden>
                        <div class="absolute bottom-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                            <div class="flex items-center">
                                <div class="w-64">
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Tanggal Upload</label>
                                        <label class="text-sm text-yellow-400">:</label>
                                        <label
                                            class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($photo->created_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($photo->created_at))] }}
                                            {{ date('Y', strtotime($photo->created_at)) }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="text-sm text-yellow-400 w-28 mx-1">Diupload Oleh</label>
                                        <label class="text-sm text-yellow-400">: </label>
                                        <label
                                            class="text-sm text-yellow-400 ml-2 w-40">{{ $photo->user->name }}</label>
                                    </div>
                                </div>
                                <div class="flex w-full px-1 justify-end items-center">
                                    @if ($photo->set_default != true)
                                        <button id="{{ $photo->id }}" class="index-link items-center btn-danger"
                                            onclick="deletePhoto(this)" type="button">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="mx-1">Hapus Foto</span>
                                        </button>
                                    @else
                                        <button id="{{ $photo->id }}" type="button" class="index-link btn-disabled"
                                            disabled>
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="mx-1">Hapus Foto</span>
                                        </button>
                                    @endif
                                    <button id="{{ $photo->id }}" name="{{ $photo->photo }}"
                                        class="ml-2 index-link btn-primary" type="button"
                                        onclick="showModalUpdate(this)">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                        </svg>
                                        <span class="mx-1">Ganti Foto</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if ($photo->set_default == true)
                            <div class="absolute top-2 left-2">
                                <button class="index-link btn-disabled" disabled>
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1 17l-5-5.299 1.399-1.43 3.574 3.736 6.572-7.007 1.455 1.403-8 8.597z" />
                                    </svg>
                                    <span class="mx-1 text-sm text-white">Aktif</span>
                                </button>
                            </div>
                        @else
                            <div class="absolute top-2 left-2">
                                <button id="{{ $photo->id }}" class="index-link btn-danger" type="button"
                                    onclick="updateDefault(this)">
                                    <span class="mx-1 text-sm text-white">Aktifkan</span>
                                </button>
                            </div>
                        @endif
                        <img id="{{ $photo->set_default }}" class="lg-photo-product"
                            src="{{ asset('storage/' . $photo->photo) }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Location Photo end -->

        <!-- Location Maps start -->
        @error('lat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <span class="flex justify-center border-b mt-2 text-base font-semibold">Peta Lokasi</span>
        <div class="lg-map-product mt-2" id="map">
        </div>
        <!-- Location Maps end -->
    </div>
</div>
<!-- Location Photo & Maps end -->
