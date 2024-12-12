<div class="flex justify-center w-full p-2 mt-2">
    <label class="text-2xl text-stone-50 font-bold">DATA LOKASI</label>
</div>
<div class="grid grid-cols-4 gap-2 w-[1200px] p-2">
    @foreach ($areas as $area)
        <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
            <div class="border-b w-full">
                <label class="flex justify-center font-serif text-md">Area</label>
                <a href="/media/area/{{ $area->id }}"
                    class="flex justify-center text-stone-200 hover:text-stone-400 font-serif text-md font-semibold">{{ $area->area }}</a>
            </div>
            <div class="w-full p-2">
                <label
                    class="flex justify-center text-stone-200 font-serif text-4xl font-semibold">{{ count($area->locations) }}</label>
                <label class="flex justify-center font-serif text-md">Titik Lokasi</label>
            </div>
            <div class="flex justify-center items-center mb-2">
                <a href="/media/locations/home/All?area={{ $area->id }}"
                    class="p-2 w-max h-8 bg-stone-400 rounded-lg text-stone-900 hover:bg-stone-200 drop-shadow-md flex items-center justify-center mx-1">
                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                            fill-rule="nonzero" />
                    </svg>
                    <span>Daftar Lokasi</span>
                </a>
                <a href="/media/show-maps/{{ $area->id }}"
                    class="p-2 w-max h-8 bg-stone-400 rounded-lg text-stone-900 hover:bg-stone-200 drop-shadow-md flex items-center justify-center mx-1">
                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                            fill-rule="nonzero" />
                    </svg>
                    <span>Peta Area</span>
                </a>
            </div>
            @foreach ($area->cities as $city)
                <a href="/media/cities/{{ $city->id }}" class="flex justify-center w-full hover:text-teal-600">
                    <label class="font-serif text-md w-40 cursor-pointer">{{ $city->city }}</label>
                    <label class="font-serif text-md  cursor-pointer">=</label>
                    <label
                        class="text-right font-serif text-md font-semibold w-10  cursor-pointer">{{ count($city->locations) }}</label>
                </a>
            @endforeach
        </div>
    @endforeach
</div>
<div class="flex justify-center w-full p-2 mt-2">
    <label class="text-2xl text-stone-50 font-bold">DATA LEGALITAS</label>
</div>
<div class="grid grid-cols-2 gap-2 w-[1200px] p-2">
    <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
        <div class="w-full">
            <label class="flex justify-center font-serif text-md">Data Perizinan</label>
            <div class="grid grid-cols-3 gap-2 p-2">
                <a href="/media/expired-licenses"
                    class="text-stone-900 w-full bg-stone-400 hover:bg-stone-500 border rounded-lg shadow-lg p-2">
                    <div class="flex justify-center items-center w-full border-b">
                        <label class="font-serif font-semibold text-md cursor-pointer">Tidak Berlaku</label>
                    </div>
                    <label
                        class="flex justify-center text-stone-900 font-serif text-4xl font-semibold cursor-pointer">{{ $expired_licenses }}</label>
                    <label class="flex justify-center font-serif text-md cursor-pointer">Titik Lokasi</label>
                </a>
                <a href="/media/expired-soon-licenses"
                    class="text-stone-900 w-full bg-stone-400 hover:bg-stone-500 border rounded-lg shadow-lg p-2">
                    <div class="flex justify-center items-center w-full border-b">
                        <label class="font-serif font-semibold text-md cursor-pointer">Segera Berakhir</label>
                    </div>
                    <label
                        class="flex justify-center text-stone-900 font-serif text-4xl font-semibold cursor-pointer">{{ $expired_soon_licenses }}</label>
                    <label class="flex justify-center font-serif text-md cursor-pointer">Titik Lokasi</label>
                </a>
                <a href="/media/active-licenses"
                    class="text-stone-900 w-full hover:bg-stone-500 bg-stone-400 border rounded-lg shadow-lg p-2">
                    <div class="flex justify-center items-center w-full border-b">
                        <label class="font-serif font-semibold text-md cursor-pointer">Masih Berlaku</label>
                    </div>
                    <label
                        class="flex justify-center text-stone-900 font-serif text-4xl font-semibold cursor-pointer">{{ $active_licenses }}</label>
                    <label class="flex justify-center font-serif text-md cursor-pointer">Titik Lokasi</label>
                    </href=>
                    <a href="/media/licenses"
                        class="col-span-3 p-2 w-full bg-stone-400 rounded-lg text-stone-900 hover:bg-stone-200 drop-shadow-md flex items-center justify-center">
                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                                fill-rule="nonzero" />
                        </svg>
                        <span>Semua Data Izin</span>
                    </a>
            </div>
        </div>
    </div>
    <div class="text-teal-400 w-full bg-stone-900 border rounded-lg shadow-lg p-2">
        <div class="w-full">
            <label class="flex justify-center font-serif text-md">Data Sewa Lahan</label>
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
                        <label class="font-serif font-semibold text-md cursor-pointer">Segera Berakhir</label>
                    </div>
                    <label
                        class="flex justify-center text-stone-900 font-serif text-4xl font-semibold cursor-pointer">{{ $expired_soon_agreements }}</label>
                    <label class="flex justify-center font-serif text-md cursor-pointer">Titik Lokasi</label>
                </a>
                <a href="/media/active-agreements"
                    class="text-stone-900 hover:bg-stone-500 w-full bg-stone-400 border rounded-lg shadow-lg p-2">
                    <div class="flex justify-center items-center w-full border-b">
                        <label class="font-serif font-semibold text-md cursor-pointer">Masih Berlaku</label>
                    </div>
                    <label
                        class="flex justify-center text-stone-900 font-serif text-4xl font-semibold cursor-pointer">{{ $active_agreements }}</label>
                    <label class="flex justify-center font-serif text-md cursor-pointer">Titik Lokasi</label>
                </a>
                <a href="/media/land-agreements"
                    class="col-span-3 p-2 w-full bg-stone-400 rounded-lg text-stone-900 hover:bg-stone-200 drop-shadow-md flex items-center justify-center">
                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
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
