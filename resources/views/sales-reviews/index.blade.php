@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $bulan_full = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $totalPpn = 0;
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                @if (request('month'))
                    <h1 class="index-h1">Daftar Penjualan Bulan {{ $bulan_full[(int) request('month')] }}
                        {{ request('year') }}</h1>
                @else
                    <h1 class="index-h1">Daftar Penjualan Bulan {{ $bulan_full[(int) date('m')] }} {{ date('Y') }}</h1>
                @endif
                <!-- Title end -->
            </div>
            <div>
                <form action="/sales-review/{{ $company->id }}">
                    <div class="flex items-center border rounded-lg mt-2 p-2 w-[1580px]">
                        <div class="w-24">
                            <span class="text-base text-stone-100">Bulan</span>
                            <select name="month"
                                class="p-1 outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                                onchange="submit()">
                                @if (request('month'))
                                    @for ($i = 1; $i < 13; $i++)
                                        @if ($i == request('month'))
                                            <option value="{{ $i }}" selected>{{ $bulan_full[$i] }}
                                            </option>
                                        @else
                                            <option value="{{ $i }}">{{ $bulan_full[$i] }}</option>
                                        @endif
                                    @endfor
                                @else
                                    @for ($i = 1; $i < 13; $i++)
                                        @if ($i == date('m'))
                                            <option value="{{ $i }}" selected>{{ $bulan_full[$i] }}
                                            </option>
                                        @else
                                            <option value="{{ $i }}">{{ $bulan_full[$i] }}</option>
                                        @endif
                                    @endfor
                                @endif
                            </select>
                        </div>
                        <div class="ml-2 w-20">
                            <span class="text-base text-stone-100">Tahun</span>
                            <select name="year"
                                class="p-1 text-center outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                                onchange="submit()">
                                @if (request('year'))
                                    @for ($i = date('Y'); $i > date('Y') - 3; $i--)
                                        @if ($i == request('year'))
                                            <option value="{{ $i }}" selected>{{ $i }}
                                            </option>
                                        @else
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endif
                                    @endfor
                                @else
                                    @for ($i = date('Y'); $i > date('Y') - 3; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                @endif
                            </select>
                        </div>
                    </div>
                </form>
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
                <!-- Alert end -->
            </div>
            <!-- View start -->
            <div class="w-full mt-2">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center">No
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center">Tanggal
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-48 text-center">
                                <button class="flex justify-center items-center w-full">@sortablelink('number', 'Nomor Penjualan')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-64">
                                Klien
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center">
                                Lokasi
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                                Jenis
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">
                                Periode
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                Harga
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                PPN
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                                Total
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-200">
                        @foreach ($sales as $sale)
                            @php
                                $client = json_decode($sale->quotation->clients);
                                $ppn = $sale->dpp * ($sale->ppn / 100);
                                $totalPpn = $totalPpn + $ppn;
                                $reviewed = false;
                            @endphp
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ date('d', strtotime($sale->created_at)) }}-{{ $bulan[(int) date('m', strtotime($sale->created_at))] }}-{{ date('Y', strtotime($sale->created_at)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $sale->number }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                    @if ($client->type == 'Perusahaan')
                                        {{ $client->company }}
                                    @else
                                        {{ $client->name }}
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                    {{ $sale->location->address }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @if ($sale->media_category->name == 'Service')
                                        Revisual
                                    @else
                                        Sewa Media
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @if ($sale->media_category->name == 'Service')
                                        -
                                    @else
                                        {{ $sale->duration }}
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                    {{ number_format($sale->price) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                    {{ number_format($ppn) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                    {{ number_format($sale->price + $ppn) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @foreach ($sale->sales_reviews as $review)
                                        @php
                                            if (auth()->user()->id == $review->user_id) {
                                                $reviewed = true;
                                            }
                                        @endphp
                                    @endforeach
                                    <div class="flex justify-center items-center">
                                        @if ($reviewed == false)
                                            <a href="/sales-review/review/{{ $sale->id }}"
                                                class="index-link text-white w-full rounded bg-amber-500 hover:bg-amber-600 drop-shadow-md m-1">
                                                <span>Check</span>
                                            </a>
                                        @else
                                            <a href="/sales-review/review/{{ $sale->id }}"
                                                class="index-link text-white w-full rounded bg-green-500 hover:bg-green-600 drop-shadow-md m-1">
                                                <span>Checked</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-stone-900 border border-stone-900 font-semibold text-sm text-right px-2"
                                colspan="7">Total</td>
                            <td class="text-stone-900 border border-stone-900 font-semibold text-sm text-right px-2">
                                {{ number_format($sales->sum('price')) }}</td>
                            <td class="text-stone-900 border border-stone-900 font-semibold text-sm text-right px-2">
                                {{ number_format($totalPpn) }}</td>
                            <td class="text-stone-900 border border-stone-900 font-semibold text-sm text-right px-2">
                                {{ number_format($sales->sum('price') + $totalPpn) }}</td>
                            <td
                                class="text-stone-900 border border-stone-900 font-semibold text-sm text-right px-2 bg-slate-500">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- View end -->
        </div>
    </div>
    <!-- Container end -->
@endsection
