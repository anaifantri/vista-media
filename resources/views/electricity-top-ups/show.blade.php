@extends('dashboard.layouts.main');

@section('container')
    <?php
    // $description = json_decode($location->description);
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="p-4 w-[1000px] border rounded-lg bg-stone-700">
            <div class="flex items-center border-b">
                <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[850px]">DETAIL DATA PENGISIAN PULSA LISTRIK
                </h4>
                <div class="flex items-center w-full justify-end">
                    <a href="/workshop/electricity-top-ups" class="flex items-center justify-center btn-primary mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Back </span>
                    </a>
                    @canany(['isAdmin', 'isWorkshop'])
                        @can('isElectricity')
                            @can('isWorkshopEdit')
                                <a href="/workshop/electricity-top-ups/{{ $electricity_top_up->id }}/edit"
                                    class="flex items-center justify-center btn-warning">
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
                    @canany(['isAdmin', 'isWorkshop'])
                        @can('isElectricity')
                            @can('isWorkshopDelete')
                                <form action="/workshop/electricity-top-ups/{{ $electricity_top_up->id }}" method="post"
                                    class="d-inline m-1">
                                    @method('delete')
                                    @csrf
                                    <button class="flex items-center justify-center btn-danger"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus data pengisian pulsa listrik..?')">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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

            <!-- View start -->
            <div class="grid grid-cols-2 mt-4">
                <div class="border rounded-lg p-2 bg-stone-200">
                    <div>
                        <label class="text-sm text-stone-900">ID Pelanggan</label>
                        <label
                            class="flex w-[310px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $electrical_power->id_number }}</label>
                    </div>
                    <div>
                        <label class="text-sm text-stone-900">Nama</label>
                        <label
                            class="flex w-[310px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $electrical_power->name }}</label>
                    </div>
                    <div>
                        <label class="text-sm text-stone-900">Daya</label>
                        <label
                            class="flex w-[310px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $electrical_power->power }}</label>
                    </div>
                </div>
                <div class="border rounded-lg p-2 bg-stone-200 ml-4">
                    <div>
                        <div class="flex items-center text-md text-stone-900 font-semibold border-b border-stone-900">
                            Daftar Lokasi Yang Menggunakan
                        </div>
                        @foreach ($electrical_power->locations as $location)
                            <div>
                                <label class="text-sm text-stone-900">{{ $loop->iteration }}.</label>
                                <label class="ml-2 text-sm text-stone-900">{{ $location->code }} |
                                    {{ $location->address }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mt-4">
                <div class="flex border rounded-lg p-2 bg-stone-300">
                    <div>
                        <div>
                            <label class="text-sm text-stone-900">Tanggal Pengisian</label>
                            <label
                                class="flex w-[200px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">
                                {{ date('d', strtotime($electricity_top_up->topup_date)) }}
                                {{ $bulan[(int) date('m', strtotime($electricity_top_up->topup_date))] }}
                                {{ date('Y', strtotime($electricity_top_up->topup_date)) }}
                            </label>
                        </div>
                        <div>
                            <label class="text-sm text-stone-900">Nominal</label>
                            <label
                                class="flex w-[200px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ number_format($electricity_top_up->top_up_nominal) }}</label>
                        </div>
                        <div>
                            <label class="text-sm text-stone-900">Jumlah Kwh Pembelian</label>
                            <label
                                class="flex w-[200px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ number_format($electricity_top_up->kwh_qty) }}</label>
                        </div>
                        <div>
                            <label class="text-sm text-stone-900">Jumlah Kwh Sebelum Pengisian</label>
                            <label
                                class="flex w-[200px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">
                                @if ($electricity_top_up->remaining_kwh_qty)
                                    {{ $electricity_top_up->remaining_kwh_qty }}
                                @else
                                    -
                                @endif
                            </label>
                        </div>
                        <div>
                            <label class="text-sm text-stone-900">Jumlah Kwh Setelah Pengisian</label>
                            <label
                                class="flex w-[200px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ Number_format($electricity_top_up->last_kwh_qty) }}</label>
                        </div>
                    </div>
                    <div class="ml-4 w-[250px]">
                        <div class="flex justify-center w-full">
                            <label class="text-sm text-stone-900">Foto Kwh Sebelum Pengisian</label>
                        </div>
                        <div class="flex justify-center w-full">
                            @if ($electricity_top_up->remaining_image)
                                <img class="m-auto flex border rounded-lg items-center w-[200px] h-[100px] mt-1"
                                    src="{{ asset('storage/' . $electricity_top_up->remaining_image) }}">
                            @else
                                <div class="m-auto flex border rounded-lg items-center w-[200px] h-[100px] mt-1">

                                </div>
                            @endif
                        </div>
                        <div class="flex justify-center w-full mt-2">
                            <label class="text-sm text-stone-900">Foto Kwh Setelah Pengisian</label>
                        </div>
                        <div class="flex justify-center w-full">
                            @if ($electricity_top_up->last_image != '')
                                <img class="m-auto flex border rounded-lg items-center w-[200px] h-[100px] mt-1"
                                    src="{{ asset('storage/' . $electricity_top_up->last_image) }}">
                            @else
                                <div class="m-auto flex border rounded-lg items-center w-[200px] h-[100px] mt-1">

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="border rounded-lg p-2 bg-stone-300 ml-4">
                    <div class="flex justify-center w-full">
                        <label class="text-sm text-stone-900">Foto Nota Pembelian</label>
                    </div>
                    <div class="flex justify-center w-full mt-1">
                        <img class="m-auto flex border rounded-lg items-center w-[450px]"
                            src="{{ asset('storage/' . $electricity_top_up->receipt_image) }}">
                    </div>
                </div>
            </div>
            <!-- View end -->
        </div>
    </div>
    <!-- Container end -->
@endsection
