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
                <form action="/print-orders/create-order/{{ $dataId }}/{{ $orderType }}">
                    <div class="flex mt-1">
                        <input name="productType" type="text" value="{{ $productType }}" hidden>
                        <label class="flex text-xs w-28">Nama Vendor</label>
                        <label class="flex text-xs">:</label>
                        <select id="vendorId" name="vendorId"
                            class="flex text-sm ml-1 w-60 font-semibold text-teal-900 border rounded-lg px-1 outline-none"
                            type="text" onchange="submit()">
                            <option class="text-semibold" value="pilih">-- pilih --</option>
                            @foreach ($vendors as $dataVendor)
                                @if (request('vendorId'))
                                    @if (request('vendorId') == $dataVendor->id)
                                        <option class="text-semibold" value="{{ $dataVendor->id }}" selected>
                                            {{ $dataVendor->company }}</option>
                                    @else
                                        <option class="text-semibold" value="{{ $dataVendor->id }}">
                                            {{ $dataVendor->company }}
                                        </option>
                                    @endif
                                @else
                                    <option class="text-semibold" value="{{ $dataVendor->id }}">
                                        {{ $dataVendor->company }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="flex mt-1">
                    <label class="flex text-xs w-28">Alamat</label>
                    <label class="flex text-xs">:</label>
                    @if ($vendor != null)
                        <textarea id="vendorAddress" class="flex text-xs ml-1 w-60 border rounded-sm outline-none p-1" rows="2" readonly>{{ $vendor->address }}
                    </textarea>
                    @else
                        <textarea id="vendorAddress" placeholder="Terisi otomatis"
                            class="flex text-xs ml-1 w-60 border rounded-sm outline-none p-1" rows="2" readonly></textarea>
                    @endif
                </div>
                <div class="flex mt-1">
                    <label class="flex text-xs w-28">No. Telp</label>
                    <label class="flex text-xs">:</label>
                    @if ($vendor != null)
                        <label id="vendorPhone" class="flex text-xs ml-1 w-60">{{ $vendor->phone }}</label>
                    @else
                        <label id="vendorPhone" class="flex text-xs ml-1 w-60"></label>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
