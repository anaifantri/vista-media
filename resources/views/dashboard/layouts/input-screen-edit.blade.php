<!-- Input Screen Size start -->
@if ($category == 'Videotron')
    <div class="mt-1">
        <label class="text-sm text-stone-900">Ukuran Screen</label>
        <div class="flex">
            <label class="flex text-semibold">W (pixel)</label>
            @if (old('screen_w'))
                <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                    id="screen_w" name="screen_w" type="number" min="0" title="Terisi Otomatis"
                    value="{{ old('screen_w') }}" readonly>
            @else
                <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                    id="screen_w" name="screen_w" type="number" min="0" title="Terisi Otomatis"
                    value="{{ $description->screen_w }}" readonly>
            @endif
            <label class="flex ml-2
                text-semibold">H (pixel)</label>
            @if (old('screen_h'))
                <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                    id="screen_h" name="screen_h" type="number" min="0" title="Terisi Otomatis"
                    value="{{ old('screen_h') }}" readonly>
            @else
                <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                    id="screen_h" name="screen_h" type="number" min="0" title="Terisi Otomatis"
                    value="{{ $description->screen_h }}" readonly>
            @endif
        </div>
    </div>
@elseif($category == 'Signage')
    @if ($description->type == 'Videotron')
        <div class="mt-1">
            <label class="text-sm text-stone-900">Ukuran Screen</label>
            <div class="flex">
                <label class="flex text-semibold">W (pixel)</label>
                @if (old('screen_w'))
                    <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                        id="screen_w" name="screen_w" type="number" min="0" title="Terisi Otomatis"
                        value="{{ old('screen_w') }}" readonly>
                @else
                    <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                        id="screen_w" name="screen_w" type="number" min="0" title="Terisi Otomatis"
                        value="{{ $description->screen_w }}" readonly>
                @endif
                <label class="flex ml-2
                text-semibold">H (pixel)</label>
                @if (old('screen_h'))
                    <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                        id="screen_h" name="screen_h" type="number" min="0" title="Terisi Otomatis"
                        value="{{ old('screen_h') }}" readonly>
                @else
                    <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                        id="screen_h" name="screen_h" type="number" min="0" title="Terisi Otomatis"
                        value="{{ $description->screen_h }}" readonly>
                @endif
            </div>
        </div>
    @else
        <div class="mt-1">
            <label class="text-sm text-stone-900">Ukuran Screen</label>
            <div class="flex">
                <label class="flex text-semibold">W (pixel)</label>
                <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                    id="screen_w" name="screen_w" type="number" min="0" placeholder="0" title="Terisi Otomatis"
                    value="{{ old('screen_w') }}" readonly>
                <label class="flex ml-2
                        text-semibold">H (pixel)</label>
                <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                    id="screen_h" name="screen_h" type="number" min="0" placeholder="0" title="Terisi Otomatis"
                    value="{{ old('screen_h') }}" readonly>
            </div>
        </div>
    @endif
@else
    <div class="mt-1">
        <label class="text-sm text-stone-900">Ukuran Screen</label>
        <div class="flex">
            <label class="flex text-semibold">W (pixel)</label>
            <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                id="screen_w" name="screen_w" type="number" min="0" placeholder="0" title="Terisi Otomatis"
                value="{{ old('screen_w') }}" readonly>
            <label class="flex ml-2
                    text-semibold">H (pixel)</label>
            <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none"
                id="screen_h" name="screen_h" type="number" min="0" placeholder="0"
                title="Terisi Otomatis" value="{{ old('screen_h') }}" readonly>
        </div>
    </div>
@endif
<!-- Input Screen Size end -->
