<!-- sign area start -->
<div class="flex justify-center mt-1">
    <div class="flex justify-center w-[790px] h-44">
        <table class="table-sign">
            <thead>
                <tr>
                    <th class="text-teal-900 font-semibold text-sm border w-[260px]">Kode Lokasi :
                        {{ $code }}-{{ $cityCode }}</th>
                    @if ($orderType == 'sale')
                        <th class="text-teal-900 text-sm font-semibold border">Data Penjualan</th>
                    @else
                        <th class="text-teal-900 font-semibold text-sm border">Google Maps</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-1 text-center">
                        <div class="flex justify-center items-center border mt-1 p-1">
                            <img class="m-auto flex items-center justify-center max-w-[260px]"
                                src="{{ asset('storage/' . $location_photo) }}">
                        </div>
                    </td>
                    <td class="border p-1 text-center">
                        @if ($orderType == 'sale')
                            <label class="flex justify-center text-sm text-teal-900">No. Penjualan</label>
                            <label class="flex justify-center text-sm text-teal-900">{{ $dataOrder->number }}</label>
                        @endif
                        <div class="flex w-full justify-center items-center mt-4">
                            {{ QrCode::size(100)->generate('https://vistamedia.co.id/') }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- sign area end -->
