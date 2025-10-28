@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="text-teal-400 w-[950px] bg-stone-900 border rounded-lg shadow-lg p-2">
                <label class="flex justify-center font-serif text-2xl">DATA SEWA LAHAN</label>
                <div class="grid grid-cols-3 gap-2 p-2">
                    <a href="/media/expired-agreements"
                        class="text-stone-900 w-full bg-stone-400 hover:bg-stone-500 border rounded-lg shadow-lg p-2">
                        <div class="flex justify-center items-center w-full border-b">
                            <label class="font-serif font-semibold text-md cursor-pointer">Habis Masa Sewa</label>
                        </div>
                        <label
                            class="flex justify-center text-stone-900 font-serif text-4xl font-semibold cursor-pointer">{{ $expired_agreements }}</label>
                        <label class="flex justify-center font-serif text-md cursor-pointer">Titik Lokasi</label>
                    </a>
                    <a href="/media/expired-soon-agreements"
                        class="text-stone-900 w-full bg-stone-400 hover:bg-stone-500 border rounded-lg shadow-lg p-2">
                        <div class="flex justify-center items-center w-full border-b">
                            <label class="font-serif font-semibold text-md cursor-pointer">Masa Sewa Segera Berakhir</label>
                        </div>
                        <label
                            class="flex justify-center text-stone-900 font-serif text-4xl font-semibold cursor-pointer">{{ $expired_soon_agreements }}</label>
                        <label class="flex justify-center font-serif text-md cursor-pointer">Titik Lokasi</label>
                    </a>
                    <a href="/media/active-agreements"
                        class="text-stone-900 hover:bg-stone-500 w-full bg-stone-400 border rounded-lg shadow-lg p-2">
                        <div class="flex justify-center items-center w-full border-b">
                            <label class="font-serif font-semibold text-md cursor-pointer">Masa Sewa Masih Berlaku</label>
                        </div>
                        <label
                            class="flex justify-center text-stone-900 font-serif text-4xl font-semibold cursor-pointer">{{ $active_agreements }}</label>
                        <label class="flex justify-center font-serif text-md cursor-pointer">Titik Lokasi</label>
                    </a>
                    <a href="/media/all-agreements"
                        class="col-span-3 p-2 w-full h-16 bg-stone-400 rounded-lg text-stone-900 hover:bg-stone-200 drop-shadow-md flex items-center justify-center">
                        <svg class="fill-current w-10 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                                fill-rule="nonzero" />
                        </svg>
                        <span>Semua Data Sewa Lahan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Container end -->
@endsection
