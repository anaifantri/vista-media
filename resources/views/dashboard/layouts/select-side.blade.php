<!-- Select Orientation start -->
@php
    $sides = ['1 Sisi', '2 Sisi'];
@endphp
<div class="flex">
    <label class="text-sm text-stone-900">Jumlah Sisi</label>
</div>
<div class="mt-1">
    <select id="side" name="side"
        class="w-[218px]  text-semibold border rounded-lg px-1 outline-none
                @error('side') is-invalid @enderror"
        type="text" value="{{ old('side') }}">
        <option value="pilih">- pilih -</option>
        @foreach ($sides as $side)
            @if (old('side') == $side)
                <option value="{{ $side }}" selected>
                    {{ $side }}
                </option>
            @else
                <option value="{{ $side }}">
                    {{ $side }}
                </option>
            @endif
        @endforeach
    </select>
    @error('side')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select Orientation end -->
