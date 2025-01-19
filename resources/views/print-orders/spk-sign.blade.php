<!-- sign area start -->
<div class="flex justify-center mt-4">
    <div class="flex justify-center w-[790px] h-40">
        <table class="table-sign">
            <thead>
                <tr class="h-6">
                    <th class="text-black font-semibold text-sm border" colspan="2">Mengetahui :</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th class="text-black font-semibold text-sm border">{{ $company->name }},</th>
                    <th id="vendorSign" class="text-black font-semibold text-sm border"></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-sign">(<u>{{ auth()->user()->name }})</u></td>
                    <td class="td-sign">(___________________________)</td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="text-slate-500 text-xs ml-20">
    <i>* Lembar untuk vendor</i>
</div>
<!-- sign area end -->
