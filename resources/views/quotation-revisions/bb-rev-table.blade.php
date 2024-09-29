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
                <th class="text-[0.7rem] text-teal-700 border w-8" rowspan="2"></th>
            </tr>
            <tr>
                @foreach ($price->dataTitle as $title)
                    @if ($title->checkbox == true)
                        <th class="border w-[72px]">
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)" checked>
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}">
                            </div>
                        </th>
                    @else
                        <th class="border w-[72px]" hidden>
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)">
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}">
                            </div>
                        </th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ($products as $product)
                <?php
                $row = $loop->iteration - 1;
                ?>
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $product->code }}-{{ $product->city_code }}</td>
                    <td class="text-[0.7rem] text-teal-700 border">
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
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $product->code }}"
                                        class="text-center outline-none in-out-spin-none w-[64px]" type="number"
                                        min="0" value="{{ $priceValue[$row]->price }}">
                                </div>
                            </td>
                        @else
                            <td class="text-[0.7rem] text-teal-700 border text-center" hidden>
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $product->code }}"
                                        class="text-center outline-none in-out-spin-none w-[64px]" type="number"
                                        min="0" value="{{ $priceValue[$row]->price }}">
                                </div>
                            </td>
                        @endif
                    @endforeach
                    <td class="text-[0.7rem] text-teal-700 border">
                        <button type="button" id="{{ $loop->iteration - 1 }}" name="{{ $product->id }}"
                            class="btn-del-note w-max h-4" onclick="removeLocation(this)">
                            <svg class="fill-current w-3" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
