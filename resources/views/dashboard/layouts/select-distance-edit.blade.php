<!-- Select Distance start -->
@php
    $distances = [
        '> 50 meter',
        '> 100 meter',
        '> 150 meter',
        '> 200 meter',
        '> 250 meter',
        '> 300 meter',
        '> 500 meter',
    ];
@endphp
<div class="mt-1">
    <label class="text-sm text-teal-700">Jarak Pandang</label>
    <select id="max_distance" name="max_distance"
        class="flex w-[218px] text-semibold border rounded-lg px-1 outline-none @error('max_distance') is-invalid @enderror"
        type="text" value="{{ $location->max_distance }}">
        @foreach ($distances as $distance)
            @if ($location->max_distance == $distance)
                <option value="{{ $distance }}" selected>
                    {{ $distance }}
                </option>
            @else
                <option value="{{ $distance }}">
                    {{ $distance }}
                </option>
            @endif
        @endforeach
    </select>
    @error('max_distance')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select Distance end -->