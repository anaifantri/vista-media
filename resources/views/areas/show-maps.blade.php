@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Area start -->
    <input type="text" id="area" hidden value="{{ $area->id }}">
    <label id="lat" hidden>{{ $area->lat }}</label>
    <label id="lng" hidden>{{ $area->lng }}</label>
    <label id="zoom" hidden>{{ $area->zoom + 1 }}</label>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full ">
                <div class="flex w-[1200px] border-b">
                    <!-- Title Area start -->
                    <h1 class="index-h1 w-[500px]">PETA AREA {{ strtoupper($area->area) }}</h1>
                    <!-- Title Area end -->
                    <div class="flex w-full justify-end items-center">
                        <a class="flex justify-center items-center mx-1 btn-danger" href="/media/area">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Close</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <!-- Maps Area start -->
                <div class="flex justify-center border rounded-lg w-[1200px] h-[600px]">
                    <div class="border rounded-lg w-full" id="map">
                    </div>
                    <!-- Maps Area end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Script Area start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/showarea.js"></script>
    <!-- Script Area end -->
@endsection
