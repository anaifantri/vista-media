@extends('dashboard.layouts.main');

@section('container')
    @php
        $description = json_decode($location->description);
        $sectors = json_decode($location->sector);
        $modified_by = new stdClass();
        $modified_by->id = auth()->user()->id;
        $modified_by->name = auth()->user()->name;
        $modified_by->position = auth()->user()->position;
        $bulan = [
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
    @endphp
    <!-- Edit Location start -->
    <form action="/media/locations/{{ $location->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <input id="description" type="text" value="{{ json_encode($description) }}" hidden>
            <input id="company_id" name="company_id" type="text" value="{{ $company->id }}" hidden>
            <input id="modified_by" name="modified_by" type="text" value="{{ json_encode($modified_by) }}" hidden>
            <input id="sector" name="sector" type="text" value="{{ $location->sector }}" hidden>
            <input name="modified_by" type="text" value="{{ json_encode($modified_by) }}" hidden>
            @if (old('category'))
                <input id="category" name="category" type="text" value="{{ old('category') }}" hidden>
            @else
                <input id="category" name="category" type="text" value="{{ $location->media_category->name }}" hidden>
            @endif
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Edit Location Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[850px]"> EDIT DATA
                        LOKASI
                        {{ strtoupper($location->media_category->name) }}</h1>
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
                            href="/media/locations/home/{{ $category }}">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Cancel</span>
                        </a>
                    </div>
                </div>
                <!-- Edit Location Title end -->

                <!-- Edit Location Input start -->
                <div class="flex justify-center w-full mt-2">
                    @if ($category == 'Billboard' || $category == 'Bando' || $category == 'Baliho' || $category == 'Midiboard')
                        @include('dashboard.layouts.bb-edit')
                    @elseif ($category == 'Videotron')
                        @include('dashboard.layouts.vt-edit')
                    @elseif ($category == 'Signage')
                        @include('dashboard.layouts.sn-edit')
                    @endif
                </div>
                <!-- Edit Location Input end -->
            </div>
        </div>
    </form>
    <!-- Modal Preview start -->
    <form id="formDelete" method="post" hidden>
        @method('delete')
        @csrf
    </form>
    <form id="formDefault" method="post" enctype="multipart/form-data" hidden>
        @method('put')
        @csrf
        <input type="text" name="setDefault" value="true" hidden>
        <input name="company_id" type="text" value="{{ $company->id }}" hidden>
    </form>
    <div id="modal" name="modal"
        class="absolute justify-center top-0 w-full h-[1500px] bg-black bg-opacity-90 z-50 hidden">
        <div>
            <div class="w-[600px] h-8 mt-10 ml-2">
                <div class="flex items-center">
                    <div class="flex w-full justify-end px-4">
                        <button id="btn-close" name="btn-close" class="flex justify-center items-center" title="Close"
                            onclick="btnClose()" type="button">
                            <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex justify-center w-full">
                <div>
                    <span id="divTitle"
                        class="border-b flex justify-center text-base text-white font-semibold w-full"></span>
                    <form action="/media/location-photos" method="post" enctype="multipart/form-data">
                        @csrf
                        <input name="location_id" type="text" value="{{ $location->id }}" hidden>
                        <input name="company_id" type="text" value="{{ $company->id }}" hidden>
                        <input name="media_category_id" type="text" value="{{ $location->media_category->id }}" hidden>
                        <input name="location_code" type="text" value="{{ $location->code }}" hidden>
                        <div>
                            <div id="divAdd" class="hidden w-[600px] justify-center items-center mt-2">
                                <input
                                    class="flex w-full h-8 border-t border-b border-r bg-white cursor-pointer text-gray-500"
                                    type="file" id="add_photo" name="add_photo" onchange="previewImage()">
                                <button class="index-link bg-slate-400 border rounded-r-lg h-8 hover:bg-slate-700"
                                    type="submit">
                                    <svg class="fill-white ml-2 w-4" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                    </svg>
                                    <span class="mx-1 text-white">Upload</span>
                                </button>
                            </div>
                            <div id="divAddDefault" class="hidden items-center mt-2">
                                <label class="text-sm text-white">Jadikan sebagai foto aktif :</label>
                                <input class="ml-2 outline-none" type="radio" name="add_default" checked
                                    value="Yes">
                                <label class="text-sm text-white ml-1">Ya</label>
                                <input class="ml-4 outline-none" type="radio" name="add_default" value="No">
                                <label class="text-sm text-white ml-1">Tidak</label>
                            </div>
                        </div>
                    </form>
                    <form id="formUpdate" class="flex" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div>
                            <div id="divUpdate" class="hidden w-[600px] justify-center items-center mt-2">
                                <input type="text" id="old_photo" name="old_photo" hidden>
                                <input name="company_id" type="text" value="{{ $company->id }}" hidden>
                                <input
                                    class="flex w-full h-8 border-t border-b border-r bg-white cursor-pointer text-gray-500"
                                    type="file" id="update_photo" name="update_photo"
                                    onchange="previewImageUpdate()">
                                <button id="btnUpdate"
                                    class="index-link bg-slate-400 border rounded-r-lg h-8 hover:bg-slate-700"
                                    type="button" onclick="actionSubmit(this)">
                                    <svg class="fill-white ml-2 w-4" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                    </svg>
                                    <span class="mx-1 text-white">Upload</span>
                                </button>
                            </div>
                            <div id="divUpdateDefault" class="hidden items-center mt-2">
                                <label class="text-sm text-white">Jadikan sebagai foto aktif :</label>
                                <input class="ml-2 outline-none" type="radio" name="update_default"
                                    id="update_default" value="Yes" checked>
                                <label class="text-sm text-white ml-1">Ya</label>
                                <input class="ml-4 outline-none" type="radio" name="update_default"
                                    id="update_default" value="No">
                                <label class="text-sm text-white ml-1">Tidak</label>
                            </div>
                        </div>
                    </form>
                    <div class="lg-photo-product mt-2 bg-white">
                        <img class="img-preview lg-photo-product" src="/img/product-image.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal Preview end -->
    <!-- Form Edit Location end -->
    <!-- Script Location start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/editlocation.js"></script>
    <!-- Script Location end -->
@endsection
