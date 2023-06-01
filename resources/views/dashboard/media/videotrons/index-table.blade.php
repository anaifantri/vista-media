@extends('dashboard.layouts.main');

@section('container')
    <div class="index-container">
        <div class="index-title">
            <h1 class="index-h1">Daftar Lokasi Videotron</h1>
        </div>
        <div class="index-btnAdd">
            <a href="/dashboard/media/products/create" class="index-link btn-primary">
                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                    stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                        fill-rule="nonzero" />
                </svg>
                <span class="mx-1">Tambah Videotron</span>
            </a>
        </div>
        @if (session()->has('success'))
            <div class="index-alert alert-success">
                <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                </svg>
                <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
            </div>
        @endif
        <div class="index-table">
            <table class="table-auto">
                <thead>
                    <tr class="index-tr bg-slate-50">
                        <th class="index-td text-sm w-5">No.</th>
                        <th class="index-td text-sm w-28">Kode</th>
                        <th class="index-td text-sm w-60">Lokasi</th>
                        <th class="index-td text-sm w-16">Kota</th>
                        <th class="index-td text-sm w-16">Jenis</th>
                        <th class="index-td text-sm w-16">Pixel</th>
                        <th class="index-td text-sm w-16">Side</th>
                        <th class="index-td text-sm w-32">Size - V/H</th>
                        <th class="index-td text-sm w-36">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="index-tr">
                            <td class="index-td text-sm w-5 text-center">{{ $loop->iteration }}</td>
                            <td class="index-td text-sm w-28">{{ $product->code }}</td>
                            <td class="flex justify-start items-center text-sm w-60">{{ $product->address }}</td>
                            <td class="index-td text-sm w-16">{{ $product->city->code }}</td>
                            <td class="index-td text-sm w-16">
                                @if ($product->product_category->name == 'Billboard')
                                    BB
                                @elseif ($product->product_category->name == 'Videotron')
                                    VT
                                @endif
                            </td>
                            <td class="index-td text-sm w-16">
                                @if ($product->product_category->lighting == 'Frontlight')
                                    FL
                                @elseif ($product->product_category->lighting == 'Backlight')
                                    BL
                                @endif
                            </td>
                            <td class="index-td text-sm w-16">{{ $product->size->side }}</td>
                            <td class="index-td text-sm w-32">{{ $product->size->size }} -
                                @if ($product->size->orientation == 'Vertikal')
                                    V
                                @elseif ($product->product_category->lighting == 'Horizontal')
                                    H
                                @endif
                            </td>
                            <td class="index-td text-sm w-36">
                                <a href="/dashboard/media/billboards/{{ $product->id }}"
                                    class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mx-1">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                            fill-rule="nonzero" />
                                    </svg>
                                </a>
                                <a href="/dashboard/media/billboards/{{ $product->id }}/edit"
                                    class="index-link text-white w-8 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mx-1">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                            fill-rule="nonzero" />
                                    </svg>
                                </a>
                                <form action="/dashboard/media/billboards/{{ $product->id }}" method="post"
                                    class="flex m-1">
                                    @method('delete')
                                    @csrf
                                    <button
                                        class="index-link text-white w-8 h-5 rounded bg-red-600 hover:bg-red-700 drop-shadow-md"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus lokasi billboard {{ $product->address }} ?')">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                fill-rule="nonzero" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
