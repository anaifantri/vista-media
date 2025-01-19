<!-- sign area start -->
<div class="flex justify-center mt-2">
    <div class="flex justify-center w-[790px] h-40">
        <table class="table-sign">
            <thead>
                <tr class="h-6">
                    <th class="text-teal-900 font-semibold text-sm border" colspan="2">Mengetahui :</th>
                    <th class="text-teal-900 font-semibold text-sm border">Data Lokasi</th>
                    @if ($orderType == 'sale')
                        <th class="text-teal-900 font-semibold text-sm border">Data Penjualan</th>
                    @else
                        <th class="text-teal-900 font-semibold text-sm"></th>
                    @endif
                </tr>
                <tr>
                    <th class="text-teal-900 font-semibold text-sm border">{{ $company->name }},</th>
                    <th id="vendorSignCopyPreview" class="text-teal-900 font-semibold text-sm border"></th>
                    <th class="text-teal-900 text-sm font-semibold border">Kode : {{ $code }} -
                        {{ $cityCode }}</th>
                    @if ($orderType == 'sale')
                        <th class="text-teal-900 text-sm font-semibold border">{{ $dataOrder->number }}</th>
                    @else
                        <th class="text-teal-900 text-sm font-semibold"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-sign">(<u>{{ auth()->user()->name }})</u></td>
                    <td class="td-sign">(___________________________)</td>
                    <td class="text-teal-900 text-sm border text-center">
                        <div class="flex w-full justify-center items-center">
                            {{ QrCode::size(75)->generate('https://vistamedia.co.id/') }}
                        </div>
                    </td>
                    @if ($orderType == 'sale')
                        <td class="text-teal-900 text-sm border align-middle text-center">
                            <div class="flex w-full justify-center items-center">
                                {{ QrCode::size(75)->generate('https://vistamedia.co.id/') }}
                            </div>
                        </td>
                    @else
                        <td class="text-teal-900 text-sm align-middle text-center"></td>
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
