@extends('dashboard.layouts.main');

@section('container')
    <!-- Container Index Size start -->
    <div class="mt-10 z-0">
        <div class="flex justify-center w-full">
            <div class="w-full md:w-[575px] p-2">
                <div class="flex">
                    <!-- Title Size start -->
                    <h1 class="index-h1"> DAFTAR UKURAN</h1>
                    <!-- Title Size end -->
                    <!-- Button Create New Size start -->
                    @canany(['isAdmin', 'isMedia'])
                        <div class="flex border-b">
                            <a href="/media-sizes/create" class="index-link btn-primary"><span></span>
                                <svg class="fill-current w-6 mx-1" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                    stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1 hidden sm:flex"> Tambah Ukuran</span>
                            </a>
                        </div>
                    @endcanany
                </div>
                <!-- Button Create New Size end -->
                <!-- Alert Success Create New Size start -->
                <form class="mt-2" action="/media-sizes/">
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
        <!-- Alert Success Create New Size end -->
        <!-- View Size start -->
        <div class="flex justify-center w-full">
            <div class="w-[580px]">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-teal-100 h-10">
                            <th class="text-teal-700 border text-sm w-8 text-center">No.</th>
                            <th class="text-teal-700 border text-sm text-center w-16">
                                <button class="flex justify-center items-center w-16">@sortablelink('code', 'Kode')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-teal-700 border text-sm text-center w-36">
                                <button class="flex justify-center items-center w-36">@sortablelink('size', 'Ukuran')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-teal-700 border text-sm text-center">Katagori</th>
                            <th class="text-teal-700 border text-sm text-center w-24">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1 + ($media_sizes->currentPage() - 1) * $media_sizes->perPage();
                        @endphp
                        @foreach ($media_sizes as $size)
                            <tr>
                                <td class="text-teal-700 border text-sm text-center">{{ $number++ }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $size->code }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $size->size }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $size->media_category->name }}</td>
                                <td class="text-teal-700 border text-sm text-center">
                                    <div class="flex justify-center items-center">
                                        <a href="/media-sizes/{{ $size->id }}"
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
                                        <a href="/media-sizes/{{ $size->id }}/edit"
                                            class="index-link text-white w-8 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mr-1">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                        </a>
                                        @can('isAdmin')
                                            <form action="/media-sizes/{{ $size->id }}" method="post" class="d-inline m-1">
                                                @method('delete')
                                                @csrf
                                                <button
                                                    class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus area {{ $size->size }} ?')">
                                                    <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24">
                                                        <title>DELETE</title>
                                                        <path
                                                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center text-teal-900">
            {{ $media_sizes->links() }}
        </div>
    </div>
    <!-- View Size end -->
    <!-- Container Index Size end -->
@endsection