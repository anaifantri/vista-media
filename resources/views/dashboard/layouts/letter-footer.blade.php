<div class="flex items-end justify-center">
    <div>
        <div class="flex w-full h-max justify-center mt-2">
            <img src="/img/line-bottom.png" alt="">
        </div>
        <div class="flex items-center w-full justify-center">
            <span class="text-sm font-semibold">{{ $company->name }}</span>
        </div>
        <div class="flex items-center w-full justify-center">
            <span class="text-xs">{{ $company->address }}</span>
        </div>
        <div class="flex items-center w-full justify-center">
            <span class="text-xs">Ph. {{ $company->phone }} | Mobile. {{ $company->m_phone }} </span>
        </div>
        <div class="flex items-center w-full justify-center">
            <span class="text-xs">e-mail : {{ $company->email }} | {{ $company->website }}</span>
        </div>
    </div>
</div>
