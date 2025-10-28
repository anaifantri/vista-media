@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sept', 'Okt', 'Nov', 'Des'];
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="p-4 w-[1000px] border rounded-lg bg-stone-300">
            <div class="flex items-center border-b">
                <h4 class="text-xl font-semibold tracking-wider text-stone-900 w-[600px]">DETAIL DATA DAYA LISTRIK</h4>
                <div class="flex items-center w-full justify-end">
                    <a href="/workshop/electrical-powers" class="flex items-center justify-center btn-primary mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Back </span>
                    </a>
                    @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isAccounting', 'isMarketing'])
                        @can('isElectricity')
                            @can('isWorkshopEdit')
                                <a href="/workshop/electrical-powers/{{ $electrical_power->id }}/edit"
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
                    @canany(['isAdmin'])
                        @can('isElectricity')
                            @can('isWorkshopDelete')
                                <form action="/workshop/electrical-powers/{{ $electrical_power->id }}" method="post"
                                    class="d-inline m-1">
                                    @method('delete')
                                    @csrf
                                    <button class="flex items-center justify-center btn-danger"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus data daya listrik untuk lokasi dengan kode ?')">
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
            @if (session()->has('success'))
                <div class="ml-2 flex alert-success">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            <!-- View start -->
            <div class="flex w-full justify-center mt-4">
                <div class="w-[485px] border rounded-lg p-2 bg-stone-200">
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
                </div>
                <div class="w-[485px] border rounded-lg p-2 bg-stone-200 ml-4">
                    <div>
                        <label class="text-sm text-stone-900">Jenis</label>
                        <label
                            class="flex w-[310px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $electrical_power->type }}</label>
                    </div>
                    <div>
                        <label class="text-sm text-stone-900">Daya</label>
                        <label
                            class="flex w-[310px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $electrical_power->power }}</label>
                    </div>
                </div>
            </div>
            @if ($electrical_power->type == 'Prabayar')
                <div class="text-md text-stone-900 mt-4 font-semibold border-b">
                    Daftar Pengisian Pulsa Listrik
                </div>
                <div class="flex w-full justify-center mt-4">
                    <div class="w-full border rounded-lg p-2 bg-stone-200">
                        <table class="table-auto w-[450px]">
                            <thead>
                                <tr class="bg-stone-400 h-8">
                                    <th class="text-stone-900 border border-stone-900 text-xs w-10 text-center">No.</th>
                                    <th class="text-stone-900 border border-stone-900 w-28 text-xs text-center">Tgl.
                                        Pembelian
                                    </th>
                                    <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Jumlah Kwh
                                    </th>
                                    <th class="text-stone-900 border border-stone-900 text-xs text-center w-28">Nominal</th>
                                    <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-stone-200">
                                @foreach ($electrical_power->electricity_top_ups as $topUp)
                                    <tr>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            {{ $loop->iteration }}</td>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            @if ($topUp->topup_date != '')
                                                {{ date('d', strtotime($topUp->topup_date)) }}-{{ $bulan[(int) date('m', strtotime($topUp->topup_date))] }}-{{ date('Y', strtotime($topUp->topup_date)) }}
                                            @endif
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            @if ($topUp->kwh_qty != 0)
                                                {{ number_format($topUp->kwh_qty) }}
                                            @endif
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            @if ($topUp->top_up_nominal != 0)
                                                {{ number_format($topUp->top_up_nominal) }}
                                            @endif
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            <div class="flex justify-center items-center">
                                                <a href="/workshop/electricity-top-ups/{{ $topUp->id }}"
                                                    class="index-link text-white w-7 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mx-1">
                                                    <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                </a>
                                                @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isMarketing', 'isAccounting'])
                                                    @can('isElectricity')
                                                        @can('isWorkshopEdit')
                                                            <a href="/workshop/electricity_top_up/{{ $topUp->id }}/edit"
                                                                class="index-link text-white w-7 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mx-1">
                                                                <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                    fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                                        fill-rule="nonzero" />
                                                                </svg>
                                                            </a>
                                                        @endcan
                                                    @endcan
                                                @endcanany
                                                @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isAccounting', 'isMarketing'])
                                                    @can('isElectricity')
                                                        @can('isWorkshopDelete')
                                                            <form action="/workshop/electricity-top-ups/{{ $topUp->id }}"
                                                                method="post" class="d-inline m-1">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="index-link text-white w-7 h-5 rounded bg-red-700 hover:bg-red-500 drop-shadow-md"
                                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data pengisian pulsa listrik..?')">
                                                                    <svg class="fill-current w-5" clip-rule="evenodd"
                                                                        fill-rule="evenodd" stroke-linejoin="round"
                                                                        stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                            fill-rule="nonzero" />
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
                </div>
            @else
                <div class="text-md text-stone-900 mt-4 font-semibold border-b">
                    Daftar Pembayaran Tagihan Listrik
                </div>
                <div class="flex w-full justify-center mt-4">
                    <div class="w-full border rounded-lg p-2 bg-stone-200">
                        <table class="table-auto w-[450px]">
                            <thead>
                                <tr class="bg-stone-400 h-8">
                                    <th class="text-stone-900 border border-stone-900 text-xs w-10 text-center">No.</th>
                                    <th class="text-stone-900 border border-stone-900 w-28 text-xs text-center">Tgl.
                                        Pembayaran
                                    </th>
                                    <th class="text-stone-900 border border-stone-900 text-xs text-center w-28">Nominal
                                    </th>
                                    <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-stone-200">
                                @foreach ($electrical_power->electricity_payments as $payment)
                                    <tr>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            {{ $loop->iteration }}</td>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            {{ date('d', strtotime($payment->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($payment->payment_date))] }}-{{ date('Y', strtotime($payment->payment_date)) }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            {{ number_format($payment->payment) }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            <div class="flex justify-center items-center">
                                                <a href="/workshop/electricity-payments/{{ $payment->id }}"
                                                    class="index-link text-white w-7 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mx-1">
                                                    <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                </a>
                                                @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isMarketing', 'isAccounting'])
                                                    @can('isElectricity')
                                                        @can('isWorkshopEdit')
                                                            <a href="/workshop/electricity_payments/{{ $payment->id }}/edit"
                                                                class="index-link text-white w-7 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mx-1">
                                                                <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                    fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                                        fill-rule="nonzero" />
                                                                </svg>
                                                            </a>
                                                        @endcan
                                                    @endcan
                                                @endcanany
                                                @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isAccounting', 'isMarketing'])
                                                    @can('isElectricity')
                                                        @can('isWorkshopDelete')
                                                            <form action="/workshop/electricity-payments/{{ $payment->id }}"
                                                                method="post" class="d-inline m-1">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="index-link text-white w-7 h-5 rounded bg-red-700 hover:bg-red-500 drop-shadow-md"
                                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data pembayaran listrik..?')">
                                                                    <svg class="fill-current w-5" clip-rule="evenodd"
                                                                        fill-rule="evenodd" stroke-linejoin="round"
                                                                        stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                            fill-rule="nonzero" />
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
                </div>
            @endif
            <!-- View end -->
            <div class="text-md text-stone-900 mt-4 font-semibold border-b">
                Daftar Lokasi Yang Menggunakan
            </div>
            <!-- Location start -->
            @foreach ($electrical_power->locations as $location)
                @php
                    $description = json_decode($location->description);
                    $location_photos = $location->location_photos
                        ->where('company_id', $company->id)
                        ->where('set_default', true)
                        ->last();
                @endphp
                <div class="flex w-full justify-center mt-1">
                    <div class="flex w-full justify-center mt-1">
                        <div class="w-[485px] border rounded-lg p-2 bg-stone-200">
                            <div>
                                <label class="text-sm text-stone-900">Kode Lokasi</label>
                                <label
                                    class="flex w-[150px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->code }}-{{ $location->city->code }}</label>
                            </div>
                            <div>
                                <label class="text-sm text-stone-900">Alamat</label>
                                <textarea class="flex w-[460px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none"
                                    rows="2" readonly>{{ $location->address }}</textarea>
                            </div>
                            <div class="flex">
                                <div>
                                    <div>
                                        <label class="text-sm text-stone-900">Jenis</label>
                                        <label
                                            class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">
                                            {{ $location->media_category->name }}
                                            @if (
                                                $location->media_category->name != 'Videotron' ||
                                                    ($location->media_category->name == 'Signage' && $description->type != 'Videotron'))
                                                - {{ $description->lighting }}
                                            @endif
                                        </label>
                                    </div>
                                    <div>
                                        <label class="text-sm text-stone-900">Ukuran</label>
                                        <label
                                            class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->media_size->size }}
                                            - {{ $location->orientation }}</label>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div>
                                        <label class="text-sm text-stone-900">Area</label>
                                        <label
                                            class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">
                                            {{ $location->area->area }}
                                        </label>
                                    </div>
                                    <div>
                                        <label class="text-sm text-stone-900">Kota</label>
                                        <label
                                            class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">
                                            {{ $location->city->city }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center items-center w-[485px] border rounded-lg py-4 bg-stone-200 ml-4">
                            <img class="w-[420px] border rounded-lg"
                                src="{{ asset('storage/' . $location_photos->photo) }}" alt="">
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Location end -->
        </div>
    </div>
    <!-- Container end -->
@endsection
