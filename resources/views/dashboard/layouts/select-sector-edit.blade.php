<!-- Select Sector start -->
@php
    $dataSectors = [
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
    <label class="text-sm text-stone-900 border-b w-[218px] flex px-1">Kawasan</label>
    @error('sector')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    <div class="flex w-[218px] mt-2">
        <div class="w-[109px]">
            @foreach ($dataSectors as $dataSector)
                @php
                    $check = false;
                @endphp
                @if ($loop->iteration - 1 < 6)
                    <div class="flex items-center">
                        @foreach ($sectors->dataSector as $sector)
                            @if ($dataSector == $sector)
                                @php
                                    $check = true;
                                @endphp
                            @endif
                        @endforeach
                        @if ($check == true)
                            <input type="checkbox" id="cbSector" value="{{ $dataSector }}" onclick="getSector(this)"
                                checked>
                        @else
                            <input type="checkbox" id="cbSector" value="{{ $dataSector }}" onclick="getSector(this)">
                        @endif
                        <label class="ml-1 text-[0.65rem] text-stone-900 flex w-20">{{ $dataSector }}</label>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="w-[109px]">
            @foreach ($dataSectors as $dataSector)
                @php
                    $check = false;
                @endphp
                @if ($loop->iteration - 1 > 5)
                    <div class="flex items-center">
                        @foreach ($sectors->dataSector as $sector)
                            @if ($dataSector == $sector)
                                @php
                                    $check = true;
                                @endphp
                            @endif
                        @endforeach
                        @if ($check == true)
                            <input type="checkbox" id="cbSector" value="{{ $dataSector }}" onclick="getSector(this)"
                                checked>
                        @else
                            <input type="checkbox" id="cbSector" value="{{ $dataSector }}" onclick="getSector(this)">
                        @endif
                        <label class="ml-1 text-[0.65rem] text-stone-900 flex w-20">{{ $dataSector }}</label>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<!-- Select Sector end -->
