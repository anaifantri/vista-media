@if ($category == 'Videotron')
    <div class="mt-1">
        <label class="text-sm text-stone-900">Jenis LED</label>
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
@elseif ($category == 'Signage')
    @if ($description->type == 'Videotron')
        <div class="mt-1">
            <label class="text-sm text-stone-900">Jenis LED</label>
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
    @else
        <div class="mt-1">
            <label class="text-sm text-stone-900">Jenis LED</label>
            <select id="led_id" name="led_id"
                class="flex w-[218px]  text-semibold border rounded-lg px-1 outline-none @error('led_id') is-invalid @enderror"
                type="text" value="{{ old('led_id') }}">
                <option value="pilih">-- pilih --</option>
                @foreach ($leds as $led)
                    @if (old('led_id') == $led->id)
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
    @endif
@else
    <div class="mt-1">
        <label class="text-sm text-stone-900">Jenis LED</label>
        <select id="led_id" name="led_id"
            class="flex w-[218px]  text-semibold border rounded-lg px-1 outline-none @error('led_id') is-invalid @enderror"
            type="text" value="{{ old('led_id') }}">
            <option value="pilih">-- pilih --</option>
            @foreach ($leds as $led)
                @if (old('led_id') == $led->id)
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
@endif
