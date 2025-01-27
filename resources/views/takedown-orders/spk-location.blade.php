<!-- sign area start -->
<div class="flex justify-center mt-1">
    <div class="flex justify-center w-[790px] h-44">
        <table class="table-sign">
            <thead>
                <tr>
                    <th class="text-black font-semibold text-sm border w-[260px]">Kode Lokasi :
                        {{ $location->code }}-{{ $location->city->code }}</th>
                    <th class="text-black font-semibold text-sm border">Google Maps</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-1 text-center">
                        <div class="flex justify-center items-center border mt-1 p-1">
                            <img class="m-auto flex items-center justify-center max-w-[260px]"
                                src="{{ asset('storage/' . $photo->photo) }}">
                        </div>
                    </td>
                    <td class="border p-1 text-center">
                        <div class="flex w-full justify-center items-center">
                            QR CODE
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- sign area end -->
