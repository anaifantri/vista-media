<div class="h-28">
    <div class="flex w-full items-center px-10 pt-4 border-b pb-2">
        <img class="w-[72px]" src="/img/logo-vm.png" alt="">
        <div class="ml-4 w-[500px]">
            <span class="flex mt-1 text-sm font-semibold">PT. Vista Media</span>
            <span class="flex mt-1 text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
            <span class="flex mt-1 text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
            <span class="flex mt-1 text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
        </div>
        <div class="flex justify-end w-full">
            <div>
                <div class="flex mt-1">
                    <label class="flex text-xs w-28">Nama Vendor</label>
                    <label class="flex text-xs">:</label>
                    <select id="vendorId" name="vendor_id"
                        class="flex text-sm ml-1 w-60 font-semibold text-black border rounded-lg px-1 outline-none"
                        type="text" onchange="getVendor(this)">
                        @foreach ($vendors as $dataVendor)
                            @if ($dataVendor->id == $product->vendor_id)
                                <option id="{{ $dataVendor->address }}-{{ $dataVendor->phone }}" class="text-semibold"
                                    value="{{ $dataVendor->id }}" selected>
                                    {{ $dataVendor->company }}
                                </option>
                            @else
                                <option id="{{ $dataVendor->address }}-{{ $dataVendor->phone }}" class="text-semibold"
                                    value="{{ $dataVendor->id }}">
                                    {{ $dataVendor->company }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="flex mt-1">
                    <label class="flex text-xs w-28">Alamat</label>
                    <label class="flex text-xs">:</label>
                    <label id="vendorAddress"
                        class="flex text-xs ml-1 w-60 h-12 border rounded-sm p-1">{{ $product->vendor_address }}
                    </label>
                </div>
                <div class="flex mt-1">
                    <label class="flex text-xs w-28">No. Telp</label>
                    <label class="flex text-xs">:</label>
                    <label id="vendorPhone" class="flex text-xs ml-1 w-60">{{ $product->vendor_phone }}</label>
                </div>
            </div>
        </div>
    </div>
</div>
