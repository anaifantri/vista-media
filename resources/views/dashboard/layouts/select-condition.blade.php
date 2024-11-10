<!-- Select Condition start -->
@php
    $conditions = ['Terbangun', 'Rencana'];
@endphp
<div class="mt-1">
    <label class="text-sm text-stone-900">Kondisi</label>
    <select id="condition" name="condition"
        class="flex w-[218px] text-semibold border rounded-lg px-1 outline-none @error('condition') is-invalid @enderror"
        type="text" value="{{ old('condition') }}">
        <option value="pilih">- pilih -</option>
        @foreach ($conditions as $condition)
            @if (old('condition') == $condition)
                <option value="{{ $condition }}" selected>
                    {{ $condition }}
                </option>
            @else
                <option value="{{ $condition }}">
                    {{ $condition }}
                </option>
            @endif
        @endforeach
    </select>
    @error('condition')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select Condition end -->
