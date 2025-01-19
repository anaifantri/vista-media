<!-- sign area start -->
<div class="flex justify-center mt-2">
    <div class="flex justify-center w-[790px] h-40">
        <table class="table-sign">
            <thead>
                <tr class="h-6">
                    <th class="text-black font-semibold text-sm border" colspan="2">Mengetahui :</th>
                    <th class="text-black font-semibold text-sm border">Data Lokasi</th>
                    @if ($product->order_type == 'sales' || $product->order_type == 'free')
                        <th class="text-black font-semibold text-sm border">Data Penjualan</th>
                    @else
                        <th class="text-black font-semibold text-sm"></th>
                    @endif
                </tr>
                <tr>
                    <th class="text-black font-semibold text-sm border">{{ $company->name }},</th>
                    <th id="vendorSignCopy" class="text-black font-semibold text-sm border"></th>
                    <th class="text-black text-sm font-semibold border">Kode : {{ $product->location_code }} -
                        {{ $product->city_code }}</th>
                    @if ($product->order_type == 'sales' || $product->order_type == 'free')
                        <th id="thSaleNumber" class="text-black text-sm font-semibold border">
                            {{ $product->sale_number }}</th>
                    @else
                        <th id="thSaleNumber" class="text-black text-sm font-semibold"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-sign">(<u>{{ $updated_by->name }})</u></td>
                    <td class="td-sign">(___________________________)</td>
                    <td class="text-black text-sm border text-center">
                        <div class="flex w-full justify-center items-center">
                        </div>
                    </td>
                    @if ($product->order_type == 'sales' || $product->order_type == 'free')
                        <td class="text-black text-sm border align-middle text-center">
                            <div class="flex w-full justify-center items-center">
                            </div>
                        </td>
                    @else
                        <td class="text-black text-sm align-middle text-center"></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="text-slate-500 text-xs ml-20">
    <i>* Lembar untuk {{ $company->name }}</i>
</div>
<!-- sign area end -->
