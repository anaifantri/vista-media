<div class="h-28">
    <div class="flex w-full items-center px-10 pt-4 border-b pb-2">
        <img class="w-[72px]" src="{{ asset('storage/' . $company->logo) }}" alt="">
        <div class="ml-4 w-[700px]">
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
                    <label class="flex text-xs px-1 w-60">{{ $product->vendor_company }}</label>
                </div>
                <div class="flex mt-1">
                    <label class="flex text-xs w-28">Alamat</label>
                    <label class="flex text-xs">:</label>
                    <label class="flex text-xs ml-1 w-60 px-1">{{ $product->vendor_address }}</label>
                </div>
                <div class="flex mt-1">
                    <label class="flex text-xs w-28">No. Telp</label>
                    <label class="flex text-xs">:</label>
                    <label class="flex text-xs ml-1 w-60 px-1">{{ $product->vendor_phone }}</label>
                </div>
            </div>
        </div>
    </div>
</div>
