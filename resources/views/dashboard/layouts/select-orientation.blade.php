<!-- Select Orientation start -->
@php
    $orientations = ['Vertikal', 'Horizontal'];
@endphp
<div class="flex">
    <label class="text-sm text-stone-900">Orientasi</label>
</div>
<div class="mt-1">
    <select id="orientation" name="orientation"
        class="w-[218px]  text-semibold border rounded-lg px-1 outline-none
                @error('orientation') is-invalid @enderror"
        type="text" value="{{ old('orientation') }}">
        <option value="pilih">- pilih -</option>
        @foreach ($orientations as $orientation)
            @if (old('orientation') == $orientation)
                <option value="{{ $orientation }}" selected>
                    {{ $orientation }}
                </option>
            @else
                <option value="{{ $orientation }}">
                    {{ $orientation }}
                </option>
            @endif
        @endforeach
    </select>
    @error('orientation')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select Orientation end -->
