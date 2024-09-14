<div class="mt-1">
    <label class="text-sm text-teal-700">Jenis LED</label>
    <select id="led_id" name="led_id"
        class="flex w-[218px]  text-semibold border rounded-lg px-1 outline-none @error('led_id') is-invalid @enderror"
        type="text" value="{{ $description->led_id }}">
        @foreach ($leds as $led)
            @if ($description->led_id == $led->id)
                <option id="{{ $led }}" value="{{ $led->id }}" selected>{{ $led->name }}
                </option>
            @else
                <option id="{{ $led }}" value="{{ $led->id }}">{{ $led->name }}</option>
            @endif
        @endforeach
    </select>
    @error('led_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>