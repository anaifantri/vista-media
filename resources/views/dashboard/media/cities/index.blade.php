@extends('dashboard.layouts.main');

@section('container')
    <!-- Container Index City start -->
    <div class="mt-10 z-0">
        <div class="flex justify-center w-full">
            <div class="w-[800px] p-2">
                <div class="flex">
                    <!-- Title City start -->
                    <h1 class="index-h1">DAFTAR KOTA</h1>
                    <!-- Title city end -->
                    <!-- Button Create New City start -->
                    @canany(['isAdmin', 'isMedia'])
                        <div class="flex border-b">
                            <a href="/dashboard/media/cities/create" class="index-link btn-primary"><span></span>
                                <svg class="fill-current w-6 mx-1" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                    stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1"> Tambah Kota </span>
                            </a>
                        </div>
                    @endcanany
                </div>
                <!-- Button Create New City end -->
                <!-- Alert Success Create New City start -->
                <form class="flex mt-2" action="/dashboard/media/cities/">
                    <div class="flex">
                        <input id="search" name="search"
                            class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900" type="text"
                            placeholder="Search" value="{{ request('search') }}">
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
                </form>
            </div>
        </div>
        <!-- Alert Success Create New City end -->
        <!-- View City start -->
        <div class="flex justify-center w-full">
            <div class="w-[800px]">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-teal-100 h-10">
                            <th class="text-teal-700 border text-sm text-center w-8">No.</th>
                            <th class="text-teal-700 border text-sm text-center w-28">Area</th>
                            <th class="text-teal-700 border text-sm text-center w-24">
                                <button class="flex justify-center items-center w-24">@sortablelink('city', 'Kota')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-teal-700 border text-sm text-center w-16">Kode</th>
                            <th class="text-teal-700 border text-sm text-center w-24">Latitude</th>
                            <th class="text-teal-700 border text-sm text-center w-24">Longitude</th>
                            <th class="text-teal-700 border text-sm text-center w-16">Zoom</th>
                            <th class="text-teal-700 border text-sm text-center w-24">Dibuat Oleh</th>
                            <th class="text-teal-700 border text-sm text-center w-24">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1 + ($cities->currentPage() - 1) * $cities->perPage();
                        @endphp
                        @foreach ($cities as $city)
                            <tr>
                                <td class="text-teal-700 border text-sm text-center">{{ $number++ }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $city->area->area }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $city->city }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $city->code }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $city->lat }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $city->lng }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $city->zoom }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $city->user->name }}</td>
                                <td class="text-teal-700 border text-sm text-center">
                                    <div class="flex justify-center items-center">
                                        <a href="/dashboard/media/cities/{{ $city->id }}"
                                            class="index-link text-white m-1 w-7 h-5 bg-cyan-400 rounded-md hover:bg-cyan-500">
                                            <svg class="w-5 fill-current" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <title>VIEW</title>
                                                <path
                                                    d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                        </a>
                                        @canany(['isAdmin', 'isMedia'])
                                            <form action="/dashboard/media/cities/{{ $city->id }}" method="post"
                                                class="d-inline m-1">
                                                @method('delete')
                                                @csrf
                                                <button
                                                    class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus area {{ $city->city }} ?')">
                                                    <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24">
                                                        <title>DELETE</title>
                                                        <path
                                                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcanany
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center text-teal-900">
            {{ $cities->links() }}
        </div>
        {{-- {!! $cities->appends(Request::except('page'))->render() !!} --}}
        <!-- View City end -->
    </div>
    <!-- Container Index City end -->
@endsection
