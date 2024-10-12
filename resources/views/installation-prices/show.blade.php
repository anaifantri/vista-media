@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    @endphp
    <div class="flex justify-center w-full p-10">
        <div class="border rounded-lg h-max w-[315px] p-4">
            <div class="flex justify-center items-center mb-3 w-full border-b">
                <h4 class="text-2xl font-semibold tracking-wider text-teal-900">Detail Harga Pasang</h4>
            </div>
            <div class="flex justify-center mt-4 w-full">
                <div>
                    <div class="border-b">
                        <label class="text-sm text-teal-700">Kode</label>
                        <h6 class="text-base font-semibold text-teal-900">
                            {{ $installation_price->code }}</h6>
                    </div>
                    <div class="border-b mt-2">
                        <label class="text-sm text-teal-700">Tipe</label>
                        <h6 class="text-base font-semibold text-teal-900">
                            {{ $installation_price->type }}</h6>
                    </div>
                    <div class="border-b mt-2">
                        <label class="text-sm text-teal-700">Harga</label>
                        <h6 class="text-base font-semibold text-teal-900">
                            {{ number_format($installation_price->price) }}</h6>
                    </div>
                    <div class="border-b mt-2">
                        <label class="text-sm text-teal-700">Tanggal Dibuat</label>
                        <h6 class="text-base font-semibold text-teal-900">
                            {{ date('d', strtotime($installation_price->created_at)) }}
                            {{ $bulan[(int) date('m', strtotime($installation_price->created_at))] }}
                            {{ date('Y', strtotime($installation_price->created_at)) }}
                        </h6>
                    </div>
                    <div class="border-b mt-2">
                        <label class="text-sm text-teal-700">Tanggal Perubahan
                            Terakhir</label>
                        <h6 class="text-base font-semibold text-teal-900">
                            {{ date('d', strtotime($installation_price->updated_at)) }}
                            {{ $bulan[(int) date('m', strtotime($installation_price->updated_at))] }}
                            {{ date('Y', strtotime($installation_price->updated_at)) }}
                        </h6>
                    </div>
                    @if ($installation_price->created_at != $installation_price->updated_at)
                        <div class="border-b mt-2">
                            <label class="text-sm text-teal-700">Diupdate Oleh</label>
                            <h6 class="text-base font-semibold text-teal-900">
                                {{ $installation_price->user->name }}
                            </h6>
                        </div>
                    @else
                        <div class="border-b mt-2">
                            <label class="text-sm text-teal-700">DIbuat Oleh</label>
                            <h6 class="text-base font-semibold text-teal-900">
                                {{ $installation_price->user->name }}
                            </h6>
                        </div>
                    @endif
                    <div class="flex mt-4">
                        <a href="/marketing/installation-prices" class="flex items-center justify-center btn-primary mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Back </span>
                        </a>
                        <a href="/marketing/installation-prices/{{ $installation_price->id }}/edit"
                            class="flex items-center justify-center btn-warning mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Edit </span>
                        </a>
                        <form action="/marketing/installation-prices/{{ $installation_price->id }}" method="post"
                            class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="flex items-center justify-center btn-danger mx-1"
                                onclick="return confirm('Apakah anda yakin ingin menghapus harga pasang dengan type {{ $installation_price->type }} ?')">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
