@php
    $cbTitle = 0;
    foreach ($price->dataTitle as $dataTitle) {
        if ($dataTitle->checkbox == true) {
            $cbTitle = $cbTitle + 1;
        }
    }
    if ($cbTitle > 2) {
        $width = 850;
    } else {
        $width = 725;
    }
@endphp
<div class="w-[{{ $width }}px]">
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No
                </th>
                <th class="text-[0.7rem] text-teal-700 border w-[72px]" rowspan="2">
                    Kode
                </th>
                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-teal-700 border w-28" rowspan="2">Size - Side - V/H
                </th>
                <th class="text-[0.7rem] text-teal-700 border" colspan="{{ $cbTitle }}">Harga
                    (Rp.)
                </th>
            </tr>
            <tr>
                @foreach ($price->dataTitle as $title)
                    @if ($title->checkbox == true)
                        <th class="text-[0.7rem] text-teal-700 border w-[90px]">
                            {{ $title->title }}</th>
                    @else
                        <th class="text-[0.7rem] text-teal-700 border w-[90px]" hidden>
                            {{ $title->title }}</th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody id="previewTBody">
            @foreach ($products as $product)
                <?php
                $row = $loop->iteration - 1;
                ?>
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $product->code }} - {{ $product->city_code }}</td>
                    <td class="text-[0.7rem] text-teal-700 border px-2">
                        {{ $product->address }}
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $product->size }} x {{ $product->side }} -
                        @if ($product->orientation == 'Vertikal')
                            V
                        @elseif ($product->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    @foreach ($price->dataPrice as $priceValue)
                        @if ($price->dataTitle[$loop->iteration - 1]->checkbox == true)
                            <td class="text-[0.7rem] text-teal-700 border text-center">
                                {{ number_format($priceValue[$row]->price) }}</td>
                        @else
                            <td class="text-[0.7rem] text-teal-700 border text-center" hidden>
                                {{ number_format($priceValue[$row]->price) }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
