<div class="w-[256px] h-[170px] bg-slate-50 mt-1 rounded-b-lg border">
    <div class="flex mt-1">
        <span class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Jenis</span>
        <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
            {{ $location->category }}</span>
    </div>
    <div class="flex mt-1">
        <span class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Ukuran</span>
        <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
            {{ $location->size }} - {{ $location->side }}</span>
    </div>
    <div class="flex mt-1">
        <span class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Orientasi</span>
        <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
            {{ $location->orientation }}</span>
    </div>
    <div class="flex mt-1">
        <span class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Penerangan</span>
        <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
            {{ $description->lighting }}
        </span>
    </div>
</div>
