<!-- Select Road start -->
@php
    $roads = ['2 Lajur', '3 Lajur', '4 Lajur', '6 Lajur', '8 Lajur'];
@endphp
<div class="mt-1">
    <label class="text-sm text-stone-900">Type Jalan</label>
    <select id="road_segment" name="road_segment"
        class="flex w-[218px] text-semibold border rounded-lg px-1 outline-none @error('road_segment') is-invalid @enderror"
        type="text" value="{{ old('road_segment') }}">
        <option value="pilih">- pilih -</option>
        @foreach ($roads as $road)
            @if (old('road_segment') == $road)
                <option value="{{ $road }}" selected>
                    {{ $road }}
                </option>
            @else
                <option value="{{ $road }}">
                    {{ $road }}
                </option>
            @endif
        @endforeach
    </select>
    @error('road_segment')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select Road end -->
