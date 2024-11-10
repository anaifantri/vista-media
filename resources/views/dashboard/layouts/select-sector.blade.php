<!-- Select Sector start -->
@php
    $sectors = [
        'Bandara',
        'Hotel',
        'Restoran',
        'Perumahan',
        'Pertokoan',
        'Perkantoran',
        'Area Wisata',
        'Mall',
        'Taman Kota',
        'Pasar',
        'Jalan Tol',
        'Tempat Hiburan',
    ];
@endphp
<div class="mt-1">
    <input class="@error('sector') is-invalid @enderror" type="text" id="sector" name="sector"
        value="{{ old('sector') }}" hidden>
    <label class="text-sm text-stone-900 border-b w-[218px] flex px-1">Kawasan</label>
    @error('sector')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    <div class="flex w-[218px] mt-2">
        <div class="w-[109px]">
            @foreach ($sectors as $sector)
                @if ($loop->iteration - 1 < 6)
                    <div class="flex items-center">
                        <input type="checkbox" id="cbSector" value="{{ $sector }}" onclick="getSector(this)">
                        <label class="ml-1 text-[0.65rem] text-stone-900 flex w-20">{{ $sector }}</label>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="w-[109px]">
            @foreach ($sectors as $sector)
                @if ($loop->iteration - 1 > 5)
                    <div class="flex items-center">
                        <input type="checkbox" id="cbSector" value="{{ $sector }}" onclick="getSector(this)">
                        <label class="ml-1 text-[0.65rem] text-stone-900 flex w-20">{{ $sector }}</label>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<!-- Select Sector end -->
