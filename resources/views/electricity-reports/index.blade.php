@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10">
        <div class="w-[600px] border rounded-lg bg-stone-600 p-2">
            <div class="flex justify-center w-[600px] p-2">
                <label class="text-2xl text-stone-50 font-bold">PENGISIAN PULSA LISTRIK BULAN INI</label>
            </div>
            <div class="grid grid-cols-3 gap-2">
                @foreach ($areas as $area)
                    @php
                        $locationQty = count($locations->where('area_id', $area->id));
                    @endphp
                    <div class="border rounded-md bg-stone-800 m-2 p-2">
                        <div class="flex justify-center w-full border-b">
                            <label class="text-lg text-yellow-300 font-bold">Area {{ $area->area }}</label>
                        </div>
                        <div class="mt-2 border-b w-full">
                            <div class="flex justify-center w-full">
                                <label class="text-sm text-stone-50">Jumlah Lokasi</label>
                            </div>
                            <div class="flex justify-center w-full">
                                <label class="text-sm text-orange-400 font-semibold">{{ $locationQty }}</label>
                            </div>
                        </div>
                        <div class="mt-2 border-b w-full">
                            <div class="flex justify-center w-full">
                                <label class="text-sm text-stone-50">Jumlah Pengisian Pulsa</label>
                            </div>
                            <div class="flex justify-center w-full">
                                <label class="text-sm text-orange-400 font-semibold">20</label>
                            </div>
                        </div>
                        <div class="mt-2 border-b w-full">
                            <div class="flex justify-center w-full">
                                <label class="text-sm text-stone-50">Total Nominal</label>
                            </div>
                            <div class="flex justify-center w-full">
                                <label class="text-sm text-lime-300 font-semibold">2.000.000</label>
                            </div>
                        </div>
                        <div class="mt-4 w-full">
                            <div class="flex justify-center w-full">
                                <a href="#"
                                    class="flex items-center justify-center w-max px-1 bg-amber-700 rounded-lg text-white hover:bg-amber-800 drop-shadow-md mx-1">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1"> View </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="w-[600px] border rounded-lg bg-stone-600 ml-4 p-2">
            <div class="flex justify-center w-[600px]">
                <label class="text-xl text-stone-50 font-bold">Grafik Pengisian Pulsa Listrik</label>
            </div>
        </div>
    </div>
    <!-- Container end -->
@endsection
