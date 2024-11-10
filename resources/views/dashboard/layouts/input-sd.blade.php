<!-- Input Slots & Duration start -->
<div class="mt-1">
    <label class="text-sm text-stone-900">Jumlah Slots dan Durasi Video</label>
    <div class="flex">
        <label class="flex text-semibold">Slots</label>
        @if ($category == 'Videotron')
            <input
                class="flex ml-2 text-semibold w-8 in-out-spin-none  border rounded-lg px-1 outline-none @error('slots') is-invalid @enderror"
                name="slots" id="slots" type="number" min="1" max="5" placeholder="0"
                value="{{ old('slots') }}" required>
        @elseif ($category == 'Signage')
            <input
                class="flex ml-2 text-semibold w-8 in-out-spin-none  border rounded-lg px-1 outline-none @error('slots') is-invalid @enderror"
                name="slots" id="slots" type="number" min="1" max="5" placeholder="0"
                value="{{ old('slots') }}">
        @endif
        <label class="flex ml-2 text-semibold">Durasi (detik)</label>
        @if ($category == 'Videotron')
            <input
                class="flex ml-2 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none @error('duration') is-invalid @enderror"
                name="duration" id="duration" type="number" min="0" max="60" placeholder="0"
                value="{{ old('duration') }}" required>
        @elseif ($category == 'Signage')
            <input
                class="flex ml-2 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none @error('duration') is-invalid @enderror"
                name="duration" id="duration" type="number" min="0" max="60" placeholder="0"
                value="{{ old('duration') }}">
        @endif
    </div>
    @error('slots')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    @error('duration')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Input Slots & Duration end -->
