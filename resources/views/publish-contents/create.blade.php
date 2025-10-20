@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">PILIH JENIS PENAYANGAN</h1>
                <a href="/workshop/publish-contents" class="flex items-center justify-center btn-danger mx-1">
                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                            fill-rule="nonzero" />
                    </svg>
                    <span class="mx-1"> Cancel </span>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4 w-[950px] p-6">
                <a href="/publish-contents/free"
                    class="flex justify-center text-yellow-400 hover:text-stone-900 items-center h-[60px] bg-stone-900 hover:bg-stone-400 border rounded-lg shadow-lg cursor-pointer">
                    <div>
                        <label class="flex justify-center font-serif text-md font-semibold cursor-pointer">PENAYANGAN MATERI
                            GRATIS</label>
                    </div>
                </a>
                <a href="/publish-contents/sale"
                    class="flex justify-center text-yellow-400 hover:text-stone-900 items-center h-[60px] bg-stone-900 hover:bg-stone-400 border rounded-lg shadow-lg cursor-pointer">
                    <div>
                        <label class="flex justify-center font-serif text-md font-semibold cursor-pointer">PENAYANGAN MATERI
                            KLIEN</label>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
