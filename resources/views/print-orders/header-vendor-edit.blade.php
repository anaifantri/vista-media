<div class="h-28">
    <div class="flex w-full items-center px-10 pt-4 border-b pb-2">
        <img class="w-[72px]" src="{{ asset('storage/' . $company->logo) }}" alt="">
        <div class="ml-4 w-[500px]">
            <span class="flex mt-1 text-sm font-semibold">{{ $company->name }}</span>
            <span class="flex mt-1 text-xs">
                {{ $company->address }} | {{ $company->city }} - {{ $company->province }} {{ $company->post_code }}
            </span>
            <span class="flex mt-1 text-xs">Ph. {{ $company->phone }} | Mobile. {{ $company->m_phone }}</span>
            <span class="flex mt-1 text-xs">e-mail : {{ $company->email }} | website : {{ $company->website }}</span>
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
