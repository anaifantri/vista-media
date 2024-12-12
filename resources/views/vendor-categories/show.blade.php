@extends('dashboard.layouts.main');

@section('container')
    <?php
    $createdDate = strtotime($vendor_category->created_at);
    $updatedDate = strtotime($vendor_category->updated_at);
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="p-4 w-[350px] h-[500px] border rounded-lg bg-stone-300">
            <div class="flex justify-center items-center mb-3 w-full border-b">
                <h4 class="text-2xl font-semibold tracking-wider text-stone-900">Detail Katagori Vendor</h4>
            </div>
            <div>
                <div class="border-b mt-2"><label class="text-sm text-stone-900">Katagori</label>
                    <h6 class="text-base font-semibold text-stone-900">{{ $vendor_category->name }}</h6>
                </div>
                <div class="flex justify-center mt-2 w-full">
                    <div class="mt-1">
                        <label class="text-sm text-stone-900">Deskripsi</label>
                        <textarea class="flex text-base font-semibold text-stone-900 w-[320px]  border rounded-lg p-1 outline-teal-300"
                            readonly>{{ $vendor_category->description }}</textarea>
                    </div>
                </div>
                <div class="flex justify-center mt-2 w-full">
                    <div class="border-b mt-2 w-[320px]">
                        <label class="text-sm text-stone-900">Tanggal Dibuat</label>
                        <h6 class="text-base font-semibold text-stone-900">
                            {{ date('d', $createdDate) }}
                            {{ $bulan[(int) date('m', $createdDate)] }}
                            {{ date('Y', $createdDate) }}
                        </h6>
                    </div>
                </div>
                <div class="flex justify-center mt-2 w-full">
                    <div class="border-b mt-2 w-[320px]">
                        <label class="text-sm text-stone-900">Tanggal Perubahan
                            Terakhir</label>
                        <h6 class="text-base font-semibold text-stone-900">
                            {{ date('d', $updatedDate) }}
                            {{ $bulan[(int) date('m', $updatedDate)] }}
                            {{ date('Y', $updatedDate) }}
                        </h6>
                    </div>
                </div>
                @if ($vendor_category->created_at != $vendor_category->updated_at)
                    <div class="flex justify-center mt-2 w-full">
                        <div class="border-b mt-2 w-[320px]">
                            <label class="text-sm text-stone-900">Diupdate Oleh</label>
                            <h6 class="text-base font-semibold text-stone-900">
                                {{ $vendor_category->user->name }}
                            </h6>
                        </div>
                    </div>
                @else
                    <div class="flex justify-center mt-2 w-full">
                        <div class="border-b mt-2 w-[320px]">
                            <label class="text-sm text-stone-900">Dibuat Oleh</label>
                            <h6 class="text-base font-semibold text-stone-900">
                                {{ $vendor_category->user->name }}
                            </h6>
                        </div>
                    </div>
                @endif
                <div class="flex justify-center mt-4 w-full">
                    <div class="flex mt-2">
                        <a href="/marketing/vendor-categories" class="flex items-center justify-center btn-primary mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Back </span>
                        </a>
                        @canany(['isAdmin', 'isMarketing'])
                            @can('isVendor')
                                @can('isMarketingEdit')
                                    <a href="/marketing/vendor-categories/{{ $vendor_category->id }}/edit"
                                        class="flex items-center justify-center btn-warning mx-1">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1"> Edit </span>
                                    </a>
                                @endcan
                            @endcan
                        @endcanany
                        @canany(['isAdmin', 'isMarketing'])
                            @can('isVendor')
                                @can('isMarketingDelete')
                                    <form action="/marketing/vendor-categories/{{ $vendor_category->id }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="flex items-center justify-center btn-danger mx-1"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus katagori vendor dengan nama {{ $vendor_category->name }} ?')">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="mx-1"> Delete </span>
                                        </button>
                                    </form>
                                @endcan
                            @endcan
                        @endcanany
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection