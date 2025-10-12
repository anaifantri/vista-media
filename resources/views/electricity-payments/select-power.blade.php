@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">PILIH DAYA LISTRIK</h1>
                @canany(['isAdmin', 'isWorkshop', 'isMedia'])
                    @can('isElectricity')
                        @can('isWorkshopCreate')
                            <div class="flex">
                                <a id="linkCreate" title="Tambah Data Pengisian Pulsa Listrik" class="index-link btn-primary"
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
                <a href="/workshop/electricity-payments" class="flex items-center justify-center btn-danger mx-1">
                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                            fill-rule="nonzero" />
                    </svg>
                    <span class="mx-1"> Cancel </span>
                </a>
            </div>
            <div>
                <!-- Form search start -->
                <form action="/workshop/electricity-payments/create">
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
                    <div class="flex mt-2">
                    </div>
                </form>
                <!-- Form search end -->
            </div>
            <!-- View start -->
            <div class="w-[1250px] mt-2">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">No
                            </th>
                            <th class="text-stone-900 border border-stone-900 w-20 text-xs text-center" rowspan="2">
                                <button class="flex justify-center items-center w-20">@sortablelink('id_number', 'ID Pelanggan')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-32" rowspan="2">Nama
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-10" rowspan="2">Daya
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-[72px]" rowspan="2">
                                Area</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-[72px]" rowspan="2">
                                Kota</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center" rowspan="2">Lokasi
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-24" rowspan="2">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-200">
                        @foreach ($electrical_powers as $electrical_power)
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $electrical_power->id_number }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">
                                    {{ $electrical_power->name }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">
                                    {{ $electrical_power->power }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $electrical_power->area->area }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    {{ $electrical_power->city->city }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs px-1">
                                    <div>
                                        @if (count($electrical_power->locations) > 0)
                                            @foreach ($electrical_power->locations as $location)
                                                <span class="flex">
                                                    {{ $location->code }} | {{ $location->address }}
                                                </span>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    <input type="radio" name="rbPower" value="{{ $electrical_power->id }}"
                                        onclick="rbPowerAction(this)">
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
        var electricalId = "";
        const linkCreate = document.getElementById("linkCreate");

        rbPowerAction = (sel) => {
            electricalId = sel.value;

            linkCreate.setAttribute('href', '/create-electricity-payment/' + electricalId);
        }

        linkCreateAction = () => {
            if (electricalId == "") {
                alert("Silahkan pilih daya listrik yang akan input data pembayaran..!!");
            } else {
                linkCreate.submit();
            }
        }
    </script>
@endsection
