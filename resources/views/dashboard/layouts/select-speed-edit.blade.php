<!-- Select Speed start -->
@php
    $speeds = [
        '0 - 10 km/jam',
        '0 - 20 km/jam',
        '10 - 20 km/jam',
        '10 - 40 km/jam',
        '20 - 40 km/jam',
        '20 - 60 km/jam',
        '40 - 60 km/jam',
        '40 - 80 km/jam',
    ];
@endphp
<div class="mt-1">
    <label class="text-sm text-stone-900">Kecepatan Kendaraan</label>
    <select id="speed_average" name="speed_average"
        class="flex w-[218px] text-semibold border rounded-lg px-1 outline-none @error('speed_average') is-invalid @enderror"
        type="text" value="{{ $location->speed_average }}">
        @foreach ($speeds as $speed)
            @if ($location->speed_average == $speed)
                <option value="{{ $speed }}" selected>
                    {{ $speed }}
                </option>
            @else
                <option value="{{ $speed }}">
                    {{ $speed }}
                </option>
            @endif
        @endforeach
    </select>
    @error('speed_average')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select Speed end -->
