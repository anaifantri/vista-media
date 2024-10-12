@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center p-10">
        <div class="z-0 mb-8">
            <div class="flex p-1 w-full border-b">
                @if ($category == 'All')
                    <h1 class="index-h1">Daftar Lokasi Media</h1>
                @else
                    <h1 class="index-h1">Daftar Lokasi Media {{ $category }}</h1>
                @endif
                @if ($category == 'All')
                    @if (request('media_category_id') != '' && request('media_category_id') != 'All')
                        @canany(['isAdmin', 'isMedia', 'isMarketing'])
                            <div>
                                <a href="/media/locations/create-location/{{ $data_categories->name }}"
                                    class="index-link btn-primary">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1 hidden sm:flex">Tambah Lokasi</span>
                                </a>
                            </div>
                        @endcanany
                    @endif
                @else
                    @canany(['isAdmin', 'isMedia', 'isMarketing'])
                        <div>
                            <a href="/media/locations/create-location/{{ $category }}" class="index-link btn-primary">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                    stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1 hidden sm:flex">Tambah Lokasi</span>
                            </a>
                        </div>
                    @endcanany
                @endif
            </div>
            <div>
                <form action="/media/locations/home/{{ $category }}">
                    <div class="flex mt-1 ml-2">
                        <div class="w-36">
                            <span class="text-base text-teal-900">Area</span>
                            <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="area"
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
                                <span class="text-base text-teal-900">Kota</span>
                                <select id="city" name="city"
                                    class="flex text-base text-teal-900 w-full border rounded-lg px-1 outline-none"
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
                        @if ($category == 'All')
                            <div class="w-36">
                                <span class="text-base text-teal-900">Katagori</span>
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none"
                                    name="media_category_id" id="media_category_id" onchange="submit()"
                                    value="{{ request('media_category_id') }}">
                                    <option value="All">All</option>
                                    @foreach ($categories as $category)
                                        @if (request('media_category_id') == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="w-36 ml-2">
                            <span class="text-base text-teal-900">Kondisi</span>
                            <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="condition"
                                id="condition" onchange="submit()">
                                <?php $condition = ['All', 'Terbangun', 'Rencana']; ?>
                                @for ($i = 0; $i < count($condition); $i++)
                                    @if (request('condition') == $condition[$i])
                                        <option value="{{ $condition[$i] }}" selected> {{ $condition[$i] }} </option>
                                    @else
                                        <option value="{{ $condition[$i] }}"> {{ $condition[$i] }} </option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="flex mt-2">
                        <div class="flex">
                            <input id="search" name="search"
                                class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900"
                                type="text" placeholder="Search" value="{{ request('search') }}">
                            <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                type="submit">
                                <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                </svg>
                            </button>
                        </div>
                        @if (session()->has('success'))
                            <div class="ml-2 flex alert-success">
                                <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                </svg>
                                <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            <div class="w-[1200px]">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-teal-100 h-10">
                            <th class="text-teal-700 border text-sm w-8 text-center">No</th>
                            <th class="text-teal-700 border text-sm w-24 text-center">
                                <button class="flex justify-center items-center w-24">@sortablelink('code', 'Kode')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-teal-700 border text-sm text-center">Lokasi</th>
                            <th class="text-teal-700 border text-sm text-center w-20">Area</th>
                            <th class="text-teal-700 border text-sm text-center w-28">Kota</th>
                            <th class="text-teal-700 border text-sm text-center w-12">Jenis</th>
                            <th class="text-teal-700 border text-sm text-center w-12">BL/FL</th>
                            <th class="text-teal-700 border text-sm text-center w-28">Size - V/H</th>
                            <th class="text-teal-700 border text-sm text-center w-20">Kondisi</th>
                            <th class="text-teal-700 border text-sm text-center w-28">
                                <button class="flex justify-center items-center w-28">@sortablelink('price', 'Harga (Rp.)')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-teal-700 border text-sm text-center w-24">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1 + ($locations->currentPage() - 1) * $locations->perPage();
                        @endphp
                        @foreach ($locations as $location)
                            @php
                                $description = json_decode($location->description);
                            @endphp
                            <tr>
                                <td class="text-teal-700 border text-sm text-center">{{ $number++ }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $location->code }} -
                                    {{ $location->city->code }}
                                </td>
                                <td class="text-teal-700 border text-sm px-2">
                                    {{ $location->address }}
                                </td>
                                <td class="text-teal-700 border text-sm text-center">{{ $location->area->area }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $location->city->city }}</td>
                                <td class="text-teal-700 border text-sm text-center">
                                    @if ($location->media_category->name == 'Billboard')
                                        BB
                                    @elseif ($location->media_category->name == 'Bando')
                                        BD
                                    @elseif ($location->media_category->name == 'Videotron')
                                        VT
                                    @elseif ($location->media_category->name == 'Signage')
                                        SN
                                    @elseif ($location->media_category->name == 'Baliho')
                                        BLH
                                    @elseif ($location->media_category->name == 'Midiboard')
                                        MB
                                    @endif
                                </td>
                                <td class="text-teal-700 border text-sm text-center">
                                    @if ($location->media_category->name == 'Videotron')
                                        LED
                                    @elseif ($location->media_category->name == 'Signage')
                                        @if ($description->type == 'Videotron')
                                            LED
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
                                <td class="text-teal-700 border text-sm text-center">{{ $location->media_size->size }}
                                    -
                                    @if ($location->orientation == 'Vertikal')
                                        V
                                    @elseif ($location->orientation == 'Horizontal')
                                        H
                                    @endif
                                </td>
                                <td class="text-teal-700 border text-sm text-center">{{ $location->condition }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ number_format($location->price) }}
                                </td>
                                <td class="text-teal-700 border text-sm text-center">
                                    <div class="flex justify-center items-center">
                                        <a href="/media/locations/{{ $location->id }}"
                                            class="index-link text-white w-7 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mx-1">
                                            <svg class="fill-current w-[18px]" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                        </a>
                                        @canany(['isAdmin', 'isMedia', 'isMarketing'])
                                            <a href="/media/locations/{{ $location->id }}/edit"
                                                class="index-link text-white w-7 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mx-1">
                                                <svg class="fill-current w-[18px]" clip-rule="evenodd" fill-rule="evenodd"
                                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                            </a>
                                            @can('isAdmin')
                                                <form action="/media/locations/{{ $location->id }}" method="post"
                                                    class="d-inline m-1">
                                                    @method('delete')
                                                    @csrf
                                                    @if ($location->location_photos()->exists() && $location->sales()->exists())
                                                        <button
                                                            class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                            onclick="return confirm('Berelasi dengan {{ count($location->location_photos) }} data pada tabel data foto lokasi dan {{ count($location->sales) }} data pada tabel data penjualan, apakah anda yakin ingin menghapus lokasi dengan kode {{ $location->code }} sekaligus menghapus data-data yang berelasi?')">
                                                            <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24">
                                                                <title>DELETE</title>
                                                                <path
                                                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                            </svg>
                                                        </button>
                                                    @elseif ($location->location_photos()->exists())
                                                        <button
                                                            class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                            onclick="return confirm('Berelasi dengan {{ count($location->location_photos) }} data pada tabel data foto lokasi, apakah anda yakin ingin menghapus lokasi dengan kode {{ $location->code }} sekaligus menghapus data-data yang berelasi?')">
                                                            <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24">
                                                                <title>DELETE</title>
                                                                <path
                                                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <button
                                                            class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus lokasi dengan kode {{ $location->code }} ?')">
                                                            <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24">
                                                                <title>DELETE</title>
                                                                <path
                                                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                            </svg>
                                                        </button>
                                                    @endif
                                                </form>
                                            @endcan
                                        @endcanany
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center text-teal-900 mt-2">
                {!! $locations->appends(Request::query())->render('dashboard.layouts.pagination') !!}
            </div>
        </div>
    </div>
@endsection
