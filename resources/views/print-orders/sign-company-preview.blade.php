<!-- sign area start -->
<div class="flex justify-center mt-2">
    <div class="flex justify-center w-[790px] h-40">
        <table class="table-sign">
            <thead>
                <tr class="h-6">
                    <th class="text-teal-900 font-semibold text-sm border" colspan="2">Mengetahui :</th>
                    <th class="text-teal-900 font-semibold text-sm border">Data Lokasi</th>
                    @if ($print_orders->sale_id)
                        <th class="text-teal-900 font-semibold text-sm border">Data Penjualan</th>
                    @else
                        <th></th>
                    @endif
                </tr>
                <tr>
                    <th class="text-teal-900 font-semibold text-sm border">PT. Vista Media,</th>
                    <th class="text-teal-900 font-semibold text-sm border">{{ $product->vendor_company }}</th>
                    <th class="text-teal-900 text-sm font-semibold border">Kode : {{ $product->location_code }} -
                        {{ $product->city_code }}</th>
                    @if ($print_orders->sale_id)
                        <th class="text-teal-900 text-sm font-semibold border">{{ $product->sale_number }}</th>
                    @else
                        <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-sign">(<u>{{ $created_by->name }}</u>)</td>
                    <td class="td-sign">(___________________________)</td>
                    <td class="text-teal-900 text-sm border text-center">
                        <div class="flex w-full justify-center items-center">
                            {{ QrCode::size(75)->generate('https://vistamedia.co.id/') }}
                        </div>
                    </td>
                    @if ($print_orders->sale_id)
                        <td class="text-teal-900 text-sm border align-middle text-center">
                            <div class="flex w-full justify-center items-center">
                                {{ QrCode::size(75)->generate('https://vistamedia.co.id/') }}
                            </div>
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="text-slate-500 text-xs ml-20">
    <i>* Lembar untuk PT. Vista Media</i>
</div>
<!-- sign area end -->
