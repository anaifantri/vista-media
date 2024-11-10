<div class="mt-1">
    <label class="text-sm text-stone-900">Area</label>
    <select id="area_id" name="area_id"
        class="flex w-[218px]  text-semibold border rounded-lg px-1 outline-none @error('area_id') is-invalid @enderror"
        type="text" value="{{ $location->area_id }}" onchange="selectArea(this)">
        @foreach ($areas as $area)
            @if ($location->area_id == $area->id)
                <option id="{{ $area }}" value="{{ $area->id }}" selected>{{ $area->area }}
                </option>
            @else
                <option id="{{ $area }}" value="{{ $area->id }}">{{ $area->area }}</option>
            @endif
        @endforeach
    </select>
    @error('area_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
