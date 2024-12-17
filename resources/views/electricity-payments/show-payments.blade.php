@extends('dashboard.layouts.main');

@section('container')
    <?php
    $description = json_decode($location->description);
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1 w-[400px]">DAFTAR PEMBAYARAN LISTRIK</h1>
                <!-- Title end -->
                <!-- Button Back start -->
                <div class="flex w-full justify-end items-center">
                    <a class="flex justify-center items-center mx-1 btn-primary" href="/workshop/electricity-payments">
                        <svg class="fill-current w-6" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1">Back</span>
                    </a>
                </div>
                <!-- Button Back end -->
            </div>
            <!-- Alert start -->
            @if (session()->has('success'))
                <div class="ml-2 flex alert-success">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            @error('delete')
                <div class="ml-2 flex alert-warning">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Warning!!</span> {{ $message }}
                </div>
            @enderror
            <!-- Alert end -->
            <!-- Location start -->
            <div class="flex w-full justify-center mt-2">
                <div class="w-[485px] border rounded-lg p-2 bg-stone-300">
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-24">Kode Lokasi</label>
                        <label>:</label>
                        <label class="ml-1">{{ $location->code }}-{{ $location->city->code }}</label>
                    </div>
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-24">Lokasi</label>
                        <label>:</label>
                        <label class="ml-1">
                            @if (strlen($location->address) > 65)
                                {{ substr($location->address, 0, 65) }}..
                            @else
                                {{ $location->address }}
                            @endif
                        </label>
                    </div>
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-24">Ukuran</label>
                        <label>:</label>
                        <label class="ml-1">{{ $location->media_size->size }}-{{ $location->side }}</label>
                    </div>
                </div>
                <div class="w-[485px] border rounded-lg p-2 bg-stone-300 ml-4">
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-24">Jenis</label>
                        <label>:</label>
                        <label class="ml-1">
                            {{ $location->media_category->name }}
                            @if (
                                $location->media_category->name != 'Videotron' ||
                                    ($location->media_category->name == 'Signage' && $description->type != 'Videotron'))
                                - {{ $description->lighting }}
                            @endif
                        </label>
                    </div>
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-24">Area</label>
                        <label>:</label>
                        <label class="ml-1">{{ $location->area->area }}</label>
                    </div>
                    <div class="flex text-stone-900 text-sm font-semibold">
                        <label class="w-24">Kota</label>
                        <label>:</label>
                        <label class="ml-1">{{ $location->city->city }}</label>
                    </div>
                </div>
            </div>
            <!-- Location end -->
            <!-- View start -->
            <div class="w-[1000px] mt-2 p-2">
                <label class="lex text-stone-100 test-sm font-semibold mt-2">DATA PEMBAYARAN LISTRIK</label>
                <table class="table-auto w-full mt-2">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">No
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="3">Data
                                Pengisian</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-24" rowspan="2">
                                Action</th>
                        </tr>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Bulan</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Tgl. Pembayaran</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-16">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-300">
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">
                                    {{ $loop->iteration }}</td>
                                <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">
                                    {{ $bulan[(int) date('m', strtotime($payment->bill_date))] }}
                                    {{ date('Y', strtotime($payment->bill_date)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">
                                    {{ date('d', strtotime($payment->payment_date)) }}
                                    {{ $bulan[(int) date('m', strtotime($payment->payment_date))] }}
                                    {{ date('Y', strtotime($payment->payment_date)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">
                                    {{ number_format($payment->payment) }}</td>
                                <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                    <div class="flex justify-center items-center">
                                        <a href="/workshop/electricity-payments/{{ $payment->id }}"
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
                                        @canany(['isAdmin', 'isWorkshop'])
                                            @can('isElectricity')
                                                @can('isWorkshopEdit')
                                                    <a href="/workshop/electricity-payments/{{ $payment->id }}/edit"
                                                        class="index-link text-white w-8 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md">
                                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                                fill-rule="nonzero" />
                                                        </svg>
                                                    </a>
                                                @endcan
                                            @endcan
                                        @endcanany
                                        @canany(['isAdmin', 'isWorkshop'])
                                            @can('isElectricity')
                                                @can('isWorkshopDelete')
                                                    <form action="/workshop/electricity-payments/{{ $payment->id }}" method="post"
                                                        class="d-inline m-1">
                                                        @method('delete')
                                                        @csrf
                                                        <button
                                                            class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus data pengisian pulsa listrik..?')">
                                                            <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24">
                                                                <title>DELETE</title>
                                                                <path
                                                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endcan
                                            @endcan
                                        @endcanany
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- View end -->
        </div>
    </div>
    <!-- Container end -->
@endsection
