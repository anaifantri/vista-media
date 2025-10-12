@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">Daftar Lokasi</h1>
                <div class="flex justify-end w-full">
                    <button class="flex items-center justify-center btn-success mx-1" onclick="submitAction(this)"
                        title="submit" type="button">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Submit </span>
                    </button>
                    <a id="submitLink" href="" hidden></a>
                </div>
                <!-- Title end -->
                <!-- Button Create end -->
            </div>
            <div>
                <!-- Form search start -->
                <form action="/electrical-power/show-location/{{ $area_id }}/{{ $city_id }}/{{ $electrical_id }}">
                    <div class="flex mt-2">
                        <div class="flex">
                            <input id="search" name="search"
                                class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-stone-900"
                                type="text" placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                            <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                type="submit">
                                <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Form search end -->
            </div>
            <!-- View start -->
            <div class="w-[1200px] mt-2">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center" rowspan="2">
                                <button class="flex justify-center items-center w-16">@sortablelink('code', 'Kode')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2"
                                colspan="2">
                                Lokasi
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20" rowspan="2">
                                Area</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20" rowspan="2">
                                Kota</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="5">
                                Deskripsi Reklame
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24" rowspan="2">
                                Action</th>
                        </tr>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-10">Jenis</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-10">BL/FL</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-8">Side</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-8">Qty</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">Size - V/H
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-200">
                        @php
                            $number = 1 + ($locations->currentPage() - 1) * $locations->perPage();
                        @endphp
                        @foreach ($locations as $location)
                            @php
                                $description = json_decode($location->description);
                                $getPhoto = $location->location_photos
                                    ->where('company_id', $company->id)
                                    ->where('set_default', true)
                                    ->last();
                            @endphp
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $number++ }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->code }} -
                                    {{ $location->city->code }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-2" colspan="2">
                                    {{ $location->address }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->area->area }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->city->city }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->media_category->code }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @if ($location->media_category->name == 'Videotron')
                                        -
                                    @elseif ($location->media_category->name == 'Signage')
                                        @if ($description->type == 'Videotron')
                                            -
                                        @else
                                            @if ($description->lighting == 'Backlight')
                                                BL
                                            @elseif ($description->lighting == 'Frontlight')
                                                FL
                                            @elseif ($description->lighting == 'Nonlight')
                                                NL
                                            @endif
                                        @endif
                                    @else
                                        @if ($description->lighting == 'Backlight')
                                            BL
                                        @elseif ($description->lighting == 'Frontlight')
                                            FL
                                        @elseif ($description->lighting == 'Nonlight')
                                            NL
                                        @endif
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ (int) filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}</td>
                                @if ($location->media_category->name == 'Signage')
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $description->qty }}</td>
                                @else
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">1
                                    </td>
                                @endif
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->media_size->size }}
                                    -
                                    @if ($location->orientation == 'Vertikal')
                                        V
                                    @elseif ($location->orientation == 'Horizontal')
                                        H
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-center text-sm">
                                    <input id="{{ $location->id }}" name="rbLocation" type="radio" title="pilih"
                                        onclick="addLocation(this)">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- View end -->
            <!-- Pagination start -->
            <div class="flex justify-center text-stone-100 mt-2">
                {!! $locations->appends(Request::query())->render('dashboard.layouts.pagination') !!}
            </div>
            <!-- Pagination end -->
        </div>
    </div>
    <!-- Container end -->
    <script>
        var electricalId = @json($electrical_id);
        var locationId = "";
        submitAction = (sel) => {
            const submitLink = document.getElementById("submitLink");
            if (locationId == "") {
                alert("Silahkan pilih lokasi terlebih dahulu");
            } else {
                submitLink.setAttribute("href", "/electrical-power/add-location/" + locationId + "/" + electricalId);
            }
            submitLink.click();
        }

        addLocation = (sel) => {
            locationId = sel.id;
        }
    </script>
@endsection
