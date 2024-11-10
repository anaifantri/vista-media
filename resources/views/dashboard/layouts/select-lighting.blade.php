<!-- Select Lighting start -->
<div class="mt-1">
    @php
        $lightings = ['Frontlight', 'Backlight', 'Nonlight'];
    @endphp
    <div class="flex">
        <label class="text-sm text-stone-900">Penerangan</label>
    </div>
    <div class="mt-1">
        <select id="lighting" name="lighting"
            class="w-[218px]  text-semibold border rounded-lg px-1 outline-none
                @error('lighting') is-invalid @enderror"
            type="text" value="{{ old('lighting') }}">
            <option value="pilih">- pilih -</option>
            @foreach ($lightings as $lighting)
                @if (old('lighting') == $lighting)
                    <option value="{{ $lighting }}" selected>
                        {{ $lighting }}
                    </option>
                @else
                    <option value="{{ $lighting }}">
                        {{ $lighting }}
                    </option>
                @endif
            @endforeach
        </select>
        @error('lighting')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<!-- Select Lighting end -->
