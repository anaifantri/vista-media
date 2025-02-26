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
                <label class="flex justify-center w-full text-2xl font-serif font-bold tracking-wider mt-4">
                    <u>KWITANSI</u>
                </label>
                <div class="flex justify-center w-full text-slate-300 text-lg font-semibold mt-1">
                    <label>No. :</label>
                    <label class="ml-2">Penomoran otomatis</label>
                </div>
            </div>
        </div>
    </div>
</div>
