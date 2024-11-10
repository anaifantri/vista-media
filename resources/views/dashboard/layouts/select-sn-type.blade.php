<!-- Select Signage Type start -->
@php
    $signageType = ['Neon Box', 'Videotron', 'Papan'];
@endphp
<div class="flex">
    <label class="text-sm text-stone-900">Jenis Signage</label>
</div>
<div class="mt-1">
    <select id="signage_type" name="signage_type"
        class="w-[218px]  text-semibold border rounded-lg px-1 outline-none
                @error('signage_type') is-invalid @enderror"
        type="text" value="{{ old('signage_type') }}" onchange="getSignageType(this)">
        <option value="pilih">- pilih -</option>
        @foreach ($signageType as $type)
            @if (old('signage_type') == $type)
                <option value="{{ $type }}" selected>
                    {{ $type }}
                </option>
            @else
                <option value="{{ $type }}">
                    {{ $type }}
                </option>
            @endif
        @endforeach
    </select>
    @error('signage_type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select Signage Type end -->
