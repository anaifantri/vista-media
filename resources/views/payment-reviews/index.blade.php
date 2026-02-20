@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $bulan_full = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                @if (request('month'))
                    <h1 class="index-h1">Daftar Pembayaran Bulan {{ $bulan_full[(int) request('month')] }}
                        {{ request('year') }}</h1>
                @else
                    <h1 class="index-h1">Daftar Pembayaran Bulan {{ $bulan_full[(int) date('m')] }} {{ date('Y') }}</h1>
                @endif
                <!-- Title end -->
            </div>
            <div>
                <form action="/payment-review/{{ $company->id }}">
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
                        <tr class="bg-stone-400 h-8">
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">
                                No.</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" colspan="5">
                                Data Tagihan</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" colspan="3">
                                Data Pembayaran</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20" rowspan="2">
                                Action
                            </th>
                        </tr>
                        <tr class="bg-stone-400 h-8">
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-64">
                                Klien
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center">
                                Lokasi
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-56">
                                Nomor Invoice
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                Tgl. Invoice
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                Tagihan
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                Tgl Bayar
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">
                                Pot. PPh
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                Pembayaran
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-200">
                        @foreach ($payments as $payment)
                            @php
                                $client = json_decode($payment->billings[0]->client);
                                $reviewed = false;
                            @endphp
                            <tr>
                                <td class="text-stone-900 px-1 border border-stone-900 text-sm  text-center align-top">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-1 align-top">
                                    @if (isset($client->company))
                                        {{ $client->company }}
                                    @elseif (isset($client->name))
                                        {{ $client->name }}
                                    @else
                                        {{ $client->contact_name }}
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-1 align-top">
                                </td>
                                <td class="text-stone-900 px-1 border border-stone-900 text-sm text-center align-top">
                                    <div>
                                        @foreach ($payment->billings as $itemBilling)
                                            <a
                                                href="/accounting/billings/{{ $itemBilling->id }}">{{ $itemBilling->invoice_number }}</a>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-stone-900 px-1 border border-stone-900 text-sm text-center align-top">
                                    <div>
                                        @foreach ($payment->billings as $itemBilling)
                                            <span>
                                                {{ date('d', strtotime($itemBilling->created_at)) }}-{{ $bulan[(int) date('m', strtotime($itemBilling->created_at))] }}-{{ date('Y', strtotime($itemBilling->created_at)) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td
                                    class="text-stone-900 bg-teal-100 px-1 border border-stone-900 text-sm text-right align-top">
                                    <div>
                                        @php
                                            $totalBilling = 0;
                                        @endphp
                                        @foreach ($payment->billings as $itemBilling)
                                            <span>{{ number_format($itemBilling->nominal + $itemBilling->ppn) }}</span>
                                            @php
                                                $totalBilling =
                                                    $totalBilling + $itemBilling->nominal + $itemBilling->ppn;
                                            @endphp
                                        @endforeach
                                        @if (count($payment->billings) > 1)
                                            <span class="border-t border-black">{{ number_format($totalBilling) }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-stone-900 px-1 border border-stone-900 text-sm  text-center align-top">
                                    {{ date('d', strtotime($payment->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($payment->payment_date))] }}-{{ date('Y', strtotime($payment->payment_date)) }}
                                </td>
                                <td
                                    class="text-stone-900 px-1 bg-amber-100 border border-stone-900 text-sm text-right align-top">
                                    <div>
                                        @php
                                            $totalTaxes = 0;
                                        @endphp
                                        @foreach ($payment->billings as $itemBilling)
                                            <span>{{ number_format($itemBilling->income_taxes->where('payment_id', $payment->id)->sum('nominal')) }}</span>
                                            @php
                                                $totalTaxes =
                                                    $totalTaxes +
                                                    $itemBilling->income_taxes
                                                        ->where('payment_id', $payment->id)
                                                        ->sum('nominal');
                                            @endphp
                                        @endforeach
                                        @if (count($payment->billings) > 1)
                                            <span class="border-t border-black">{{ number_format($totalTaxes) }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td
                                    class="text-stone-900 px-1 bg-amber-100 border border-stone-900 text-sm text-right align-top">
                                    {{ number_format($payment->nominal) }}
                                </td>
                                <td class="text-stone-900 px-1 border border-stone-900 text-sm text-center align-top">
                                    @foreach ($payment->payment_reviews as $review)
                                        @php
                                            if (auth()->user()->id == $review->user_id) {
                                                $reviewed = true;
                                            }
                                        @endphp
                                    @endforeach
                                    <div class="flex justify-center items-center">
                                        @if ($reviewed == false)
                                            <a href="/payment-review/review/{{ $payment->id }}"
                                                class="index-link text-white w-full rounded bg-amber-500 hover:bg-amber-600 drop-shadow-md m-1">
                                                <span>Check</span>
                                            </a>
                                        @else
                                            <a href="/payment-review/review/{{ $payment->id }}"
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
                                colspan="8">Total Pembayaran</td>
                            <td class="text-stone-900 border border-stone-900 font-semibold text-sm text-right px-2">
                                {{ number_format($payments->sum('nominal')) }}</td>
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
