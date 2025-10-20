@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">PILIH LOKASI</h1>
                <a href="/workshop/publish-contents/create" class="flex items-center justify-center btn-danger mx-1">
                    <svg class="fill-current w-5 rotate-180" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                    </svg>
                    <span class="mx-1"> Back </span>
                </a>
                @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isAccounting', 'isMarketing'])
                    @can('isContent')
                        @can('isWorkshopCreate')
                            <div class="flex">
                                <a id="linkCreate" title="Tambah Data Penayangan" class="index-link btn-primary cursor-pointer"
                                    onclick="linkCreateAction()">
                                    <svg class="fill-current w-[18px]" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1">Create</span>
                                </a>
                            </div>
                        @endcan
                    @endcan
                @endcanany
            </div>
            <div>
                <!-- Form search start -->
                <form action="/publish-contents/free">
                    <div class="flex mt-1 ml-2">
                        <div class="w-36">
                            <span class="text-base text-stone-100">Area</span>
                            <select class="w-full border rounded-lg text-base text-stone-900 outline-none" name="area"
                                id="area" onchange="submit()" value="{{ request('area') }}">
                                <option value="All">All</option>
                                @foreach ($areas as $area)
                                    @if (request('area') == $area->id)
                                        <option value="{{ $area->id }}" selected>{{ $area->area }}</option>
                                    @else
                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @if (request('area') && request('area') != 'All')
                            <div class="w-36 ml-2">
                                <span class="text-base text-stone-100">Kota</span>
                                <select id="city" name="city"
                                    class="flex text-base text-stone-900 w-full border rounded-lg px-1 outline-none"
                                    type="text" value="{{ request('city') }}" onchange="submit()">
                                    <option value="All">All</option>
                                    @foreach ($cities as $city)
                                        @if (request('area') == $city->area_id)
                                            @if (request('city'))
                                                @if (request('city') == $city->id)
                                                    <option value="{{ $city->id }}" selected>
                                                        {{ $city->city }}
                                                    </option>
                                                @else
                                                    <option value="{{ $city->id }}">
                                                        {{ $city->city }}
                                                    </option>
                                                @endif
                                            @else
                                                <option value="{{ $city->id }}">
                                                    {{ $city->city }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="ml-2 w-full">
                            <span class="text-base text-stone-100">Pencarian</span>
                            <div class="flex w-full">
                                <input id="search" name="search"
                                    class="flex border rounded-l-lg px-1 outline-none text-base text-stone-900"
                                    type="text" placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                    onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                                <button class="flex border px-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                    type="submit">
                                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Form search end -->
            </div>
            <!-- View start -->
            <div class="w-[1250px] mt-2">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400 h-8">
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center">No.
                            </th>
                            <th class="text-stone-900 border border-stone-900 w-20 text-sm text-center">
                                <button class="flex justify-center items-center w-20">@sortablelink('code', 'Kode')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                Area</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                Kota</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center">
                                Lokasi</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-32">
                                Ukuran</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-200">
                        @foreach ($locations as $location)
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                    {{ $location->code }}-{{ $location->city->code }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->area->area }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->city->city }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-1">
                                    {{ $location->address }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                    {{ $location->media_size->size }}-
                                    @if ($location->orientation == 'Vertikal')
                                        V
                                    @else
                                        H
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    <input type="radio" name="rbLocation" value="{{ $location->id }}"
                                        onclick="rbLocationAction(this)">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Container end -->
    <script>
        var locationId = "";
        const linkCreate = document.getElementById("linkCreate");

        rbLocationAction = (sel) => {
            locationId = sel.value;

            linkCreate.setAttribute('href', '/publish-contents/create/free/' + locationId);
        }

        linkCreateAction = () => {
            if (locationId == "") {
                alert("Silahkan pilih lokasi terlebih dahulu..!!");
            } else {
                linkCreate.submit();
            }
        }
    </script>
@endsection
