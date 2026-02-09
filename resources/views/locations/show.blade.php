@extends('dashboard.layouts.main');

@section('container')
    @php
        $description = json_decode($location->description);
        $sectors = json_decode($location->sector);
        $created_by = json_decode($location->created_by);
        $updated_by = json_decode($location->updated_by);
        $name = $location->code . '-' . $location->city->code . '-' . $location->address;

        if ($location->media_category->name == 'Signage') {
            $mapsLink =
                'https://maps.googleapis.com/maps/api/staticmap?center=' .
                $description->lat[0] .
                ',' .
                $description->lng[0] .
                '&zoom=17&size=480x355&maptype=terrain';
            $mapsMarkers = '';
            $googleKey = '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
            for ($i = 0; $i < count($description->lat); $i++) {
                $mapsMarkers =
                    $mapsMarkers .
                    '&markers=icon:https://' .
                    $company->website .
                    '/img/marker-red.png%7C' .
                    $description->lat[$i] .
                    ',' .
                    $description->lng[$i];
            }
            $src = $mapsLink . $mapsMarkers . $googleKey;
        } else {
            $src =
                'https://maps.googleapis.com/maps/api/staticmap?center=' .
                $description->lat .
                ',' .
                $description->lng .
                '&zoom=16&size=480x355&maptype=terrain&markers=icon:https://' .
                $company->website .
                '/img/marker-red.png%7C' .
                $description->lat .
                ',' .
                $description->lng .
                '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
        }

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
        $month = [
            1 => 'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des',
        ];
    @endphp
    <input id="lat" type="text" value="{{ json_encode($description->lat) }}" hidden>
    <input id="lng" type="text" value="{{ json_encode($description->lng) }}" hidden>
    <input id="category" type="text" value="{{ $location->media_category->name }}" hidden>
    <input id="saveName" type="text" value="{{ $name }}" hidden>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Show Location Title start -->
            <div class="flex w-[1140px] items-center border-b">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[550px]"> DETAIL LOKASI
                    {{ strtoupper($category) }}</h1>
                <div class="flex w-full p-1 justify-end">
                    <a class="flex justify-center items-center ml-1 btn-primary"
                        href="/media/locations/home/{{ $category }}">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="m10.978 14.999v3.251c0 .412-.335.75-.752.75-.188 0-.375-.071-.518-.206-1.775-1.685-4.945-4.692-6.396-6.069-.2-.189-.312-.452-.312-.725 0-.274.112-.536.312-.725 1.451-1.377 4.621-4.385 6.396-6.068.143-.136.33-.207.518-.207.417 0 .752.337.752.75v3.251h9.02c.531 0 1.002.47 1.002 1v3.998c0 .53-.471 1-1.002 1z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="ml-1 text-sm">Back</span>
                    </a>
                    @canany(['isAdmin', 'isMedia', 'isMarketing'])
                        @can('isLocation')
                            @can('isMediaEdit')
                                <a href="/media/locations/{{ $location->id }}/edit"
                                    class="flex justify-center items-center mx-1 btn-warning">
                                    <svg class="fill-current w-4 lg:w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1 text-sm">Edit</span>
                                </a>
                            @endcan
                        @endcan
                    @endcanany
                    @canany(['isAdmin', 'isMedia', 'isMarketing'])
                        @can('isLocation')
                            @can('isMediaDelete')
                                <form action="/media/locations/{{ $location->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="hidden items-center justify-center btn-danger mx-1"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus {{ $location->media_category->name }} dengan kode {{ $location->code }} ?')">
                                        <svg class="fill-current w-4 lg:w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1 text-sm"> Delete </span>
                                    </button>
                                </form>
                            @endcan
                        @endcan
                    @endcanany
                    <button id="btn-preview" name="btn-preview" class="flex justify-center items-center mx-1 btn-success"
                        onclick="btnPreview()">
                        <svg class="fill-current w-4 lg:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M24 11v12h-24v-12h4v-10h10.328c1.538 0 5.672 4.852 5.672 6.031v3.969h4zm-6-3.396c0-1.338-2.281-1.494-3.25-1.229.453-.813.305-3.375-1.082-3.375h-7.668v13h12v-8.396zm-2 5.396h-8v-1h8v1zm0-3h-8v1h8v-1zm0-2h-8v1h8v-1z" />
                        </svg>
                        <span class="mx-1 text-sm lg:text-md lg:mx-2">Preview</span>
                    </button>
                </div>
            </div>
            <!-- Show Location Title end -->

            <!-- Show Location start -->
            <div class="flex justify-center w-full mt-2">
                @include('dashboard.layouts.location-show')
            </div>
            <!-- Show Location end -->

        </div>
    </div>

    <!-- Detail Location start -->
    <div class="flex justify-center pl-14 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-4 border rounded-md w-[1180px] text-stone-100">
            <div class="flex items-center border-b font-semibold text-xl">DATA PENJUALAN / SEWA MEDIA</div>
            <div class="flex justify-center items-center w-full">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm w-10 text-center">No.</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-28 text-center">Tgl. Penjualan</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-48 text-center">No. Penjualan</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center">Nama Klien
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center">Periode</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-28 text-center">Awal Kontrak
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-28 text-center">Akhir Kontrak
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-32 text-center">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 0;
                            $totalMediaSales = 0;
                        @endphp
                        @foreach ($location->sales as $sale)
                            @if ($sale->media_category->name != 'Service')
                                @php
                                    $number++;
                                    $totalMediaSales = $totalMediaSales + $sale->price;
                                    $client = json_decode($sale->quotation->clients);
                                @endphp
                                <tr class="bg-white">
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $number }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ date('d', strtotime($sale->created_at)) }}-{{ $month[(int) date('m', strtotime($sale->created_at))] }}-{{ date('Y', strtotime($sale->created_at)) }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $sale->number }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                        {{ $client->company }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $sale->duration }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ date('d', strtotime($sale->start_at)) }}-{{ $month[(int) date('m', strtotime($sale->start_at))] }}-{{ date('Y', strtotime($sale->start_at)) }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ date('d', strtotime($sale->end_at)) }}-{{ $month[(int) date('m', strtotime($sale->end_at))] }}-{{ date('Y', strtotime($sale->end_at)) }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                        {{ number_format($sale->price) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <tr class="bg-white">
                            <td class="text-stone-900 border border-stone-900 text-sm font-semibold text-right px-2"
                                colspan="7">
                                Total Penjualan
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-right px-2 font-semibold">
                                {{ number_format($totalMediaSales) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center border-b font-semibold text-xl mt-6">DATA PENJUALAN CETAK / PASANG</div>
            <div class="flex justify-center items-center w-full">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm w-10 text-center">No.</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-28 text-center">Tgl. Penjualan</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-48 text-center">No. Penjualan</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center">
                                Nama Klien
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-32 text-center">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 0;
                            $totalServiceSales = 0;
                        @endphp
                        @foreach ($location->sales as $sale)
                            @if ($sale->media_category->name == 'Service')
                                @php
                                    $number++;
                                    $totalServiceSales = $totalServiceSales + $sale->price;
                                    $client = json_decode($sale->quotation->clients);
                                @endphp
                                <tr class="bg-white">
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $number }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ date('d', strtotime($sale->created_at)) }}-{{ $month[(int) date('m', strtotime($sale->created_at))] }}-{{ date('Y', strtotime($sale->created_at)) }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $sale->number }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                        {{ $client->company }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                        {{ number_format($sale->price) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <tr class="bg-white">
                            <td class="text-stone-900 border border-stone-900 text-sm font-semibold text-right px-2"
                                colspan="4">
                                Total Penjualan
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-right px-2 font-semibold">
                                {{ number_format($totalServiceSales) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center border-b font-semibold text-xl mt-6">DATA SEWA LAHAN</div>
            <div class="flex justify-center items-center w-full">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm w-10 text-center">No.</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-28 text-center">Tgl. Perjanjian
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-48 text-center">No. Perjanjian</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center">Pemilik</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-36 text-center">No. Hp</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center">Masa Sewa</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-32 text-center">Harga</th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-32 text-center">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 0;
                            $totalRentalPrice = 0;
                        @endphp
                        @foreach ($location->land_agreements as $agreement)
                            @php
                                $number++;
                                $landOwner = json_decode($agreement->second_party);
                                $totalRentalPrice = $totalRentalPrice + $agreement->price * $agreement->duration;
                            @endphp
                            <tr class="bg-white">
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $number }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ date('d', strtotime($agreement->published)) }}-{{ $month[(int) date('m', strtotime($agreement->published))] }}-{{ date('Y', strtotime($agreement->published)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $agreement->number }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                    {{ $landOwner->name }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $landOwner->phone }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $agreement->duration }} tahun
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                    {{ number_format($agreement->price) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                    {{ number_format($agreement->price * $agreement->duration) }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-white">
                            <td class="text-stone-900 border border-stone-900 text-sm font-semibold text-right px-2"
                                colspan="7">
                                Total Harga Sewa Lahan
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-right px-2 font-semibold">
                                {{ number_format($totalRentalPrice) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center border-b font-semibold text-xl mt-6">DATA LISTRIK</div>
            @if ($location->electrical_powers)
                @foreach ($location->electrical_powers as $electrical)
                    <div>
                        <div class="flex mt-2">
                            <label class="text-sm w-36">ID Pelanggan</label>
                            <label class="text-sm">:</label>
                            <label class="text-sm ml-2">{{ $electrical->id_number }}</label>
                        </div>
                        <div class="flex mt-1">
                            <label class="text-sm w-36">Nama Pelanggan</label>
                            <label class="text-sm">:</label>
                            <label class="text-sm ml-2">{{ $electrical->name }}</label>
                        </div>
                        <div class="flex mt-1">
                            <label class="text-sm w-36">Daya Listrik</label>
                            <label class="text-sm">:</label>
                            <label class="text-sm ml-2">{{ $electrical->power }}</label>
                        </div>
                        <div class="flex mt-1">
                            <label class="text-sm w-36">Jenis</label>
                            <label class="text-sm">:</label>
                            <label class="text-sm ml-2">{{ $electrical->type }}</label>
                        </div>
                        @if ($electrical->type == 'Prabayar')
                            <div class="flex items-center w-full mt-2">
                                <table class="table-auto">
                                    <thead>
                                        <tr class="bg-stone-400">
                                            <th class="text-stone-900 border border-stone-900 text-sm w-10 text-center">No.
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-sm w-32 text-center">
                                                Tgl. Isi Pulsa</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm w-36 text-center">
                                                Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $number = 0;
                                            $totalTopup = 0;
                                        @endphp
                                        @foreach ($electrical->electricity_top_ups as $topup)
                                            @php
                                                $number++;
                                                $totalTopup = $totalTopup + $topup->top_up_nominal;
                                            @endphp
                                            <tr class="bg-white">
                                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    {{ $number }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    {{ date('d', strtotime($topup->topup_date)) }}-{{ $month[(int) date('m', strtotime($topup->topup_date))] }}-{{ date('Y', strtotime($topup->topup_date)) }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                                    {{ number_format($topup->top_up_nominal) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="bg-white">
                                            <td class="text-stone-900 border border-stone-900 text-sm font-semibold text-right px-2"
                                                colspan="2">
                                                Total Pengisian Pulsa
                                            </td>
                                            <td
                                                class="text-stone-900 border border-stone-900 text-sm text-right px-2 font-semibold">
                                                {{ number_format($totalTopup) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="flex items-center w-full mt-2">
                                <table class="table-auto">
                                    <thead>
                                        <tr class="bg-stone-400">
                                            <th class="text-stone-900 border border-stone-900 text-sm w-10 text-center">No.
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-sm w-36 text-center">
                                                Tgl. Pembayaran</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm w-36 text-center">
                                                Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $number = 0;
                                            $totalPayment = 0;
                                        @endphp
                                        @foreach ($electrical->electricity_payments as $payment)
                                            @php
                                                $number++;
                                                $totalPayment = $totalPayment + $payment->payment;
                                            @endphp
                                            <tr class="bg-white">
                                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    {{ $number }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    {{ date('d', strtotime($payment->payment_date)) }}-{{ $month[(int) date('m', strtotime($payment->payment_date))] }}-{{ date('Y', strtotime($payment->payment_date)) }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                                    {{ number_format($payment->payment) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="bg-white">
                                            <td class="text-stone-900 border border-stone-900 text-sm font-semibold text-right px-2"
                                                colspan="2">
                                                Total Pembayaran Listrik
                                            </td>
                                            <td
                                                class="text-stone-900 border border-stone-900 text-sm text-right px-2 font-semibold">
                                                {{ number_format($totalPayment) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- Detail Location end -->

    <!-- Script Show Location start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/showlocation.js"></script>
    <script src="/js/savepdf.js"></script>
    <!-- Script Show Location end -->
@endsection
