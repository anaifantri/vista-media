@extends('dashboard.layouts.main');

@section('container')
    @php
        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    <!-- Create New Location start -->
    <form method="post" action="/media/locations" enctype="multipart/form-data">
        @csrf
        <input id="description" type="text" value="{{ old('description') }}" hidden>
        <input name="created_by" type="text" value="{{ json_encode($created_by) }}" hidden>
        <input name="modified_by" type="text" value="{{ json_encode($created_by) }}" hidden>
        <input name="media_category_id" type="text" value="{{ $data_category->id }}" hidden>
        <input name="category" type="text" value="{{ $data_category->name }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Create New Location Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[850px]"> MENAMBAHKAN DATA LOKASI
                        {{ strtoupper($category) }}</h1>
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
                <!-- Create New Location Title end -->

                <!-- New Location Input start -->
                <div class="flex justify-center w-full mt-2">
                    @if ($category == 'Billboard' || $category == 'Bando' || $category == 'Baliho' || $category == 'Midiboard')
                        @include('dashboard.layouts.bb-create')
                    @elseif ($category == 'Videotron')
                        @include('dashboard.layouts.vt-create')
                    @elseif ($category == 'Signage')
                        @include('dashboard.layouts.sn-create')
                    @endif
                </div>
                <!-- New Location Input end -->
            </div>
        </div>
    </form>
    <!-- Create New Location end -->
    <!-- Script Create Location start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/createlocation.js"></script>
    <!-- Script Create Location end -->
@endsection
