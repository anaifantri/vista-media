<!-- Input Time Show start -->
<div class="mt-1">
    <label class="text-sm text-teal-700">Waktu Tayang</label>
    <div class="flex">
        <label class="flex text-semibold">On</label>
        @if ($category == 'Videotron')
            <input
                class="flex ml-1 text-semibold w-[72px] border rounded-lg px-1 outline-none @error('start_at') is-invalid @enderror"
                name="start_at" id="start_at" type="time" placeholder="start_at" value="{{ old('start_at') }}"
                onchange="inputStartAt(this)" required>
        @elseif ($category == 'Signage')
            <input
                class="flex ml-1 text-semibold w-[72px] border rounded-lg px-1 outline-none @error('start_at') is-invalid @enderror"
                name="start_at" id="start_at" type="time" placeholder="start_at" value="{{ old('start_at') }}"
                onchange="inputStartAt(this)">
        @endif

        <label class="flex ml-2 text-semibold">off</label>
        @if ($category == 'Videotron')
            <input
                class="flex ml-1 text-semibold w-[72px] border rounded-lg px-1 outline-none @error('end_at') is-invalid @enderror"
                name="end_at" id="end_at" type="time" placeholder="end_at" value="{{ old('end_at') }}"
                onchange="inputEndAt(this)" required>
        @elseif ($category == 'Signage')
            <input
                class="flex ml-1 text-semibold w-[72px] border rounded-lg px-1 outline-none @error('end_at') is-invalid @enderror"
                name="end_at" id="end_at" type="time" placeholder="end_at" value="{{ old('end_at') }}"
                onchange="inputEndAt(this)">
        @endif
    </div>
    @error('start_at')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    @error('end_at')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Input Time Show end -->
