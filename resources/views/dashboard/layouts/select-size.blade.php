<!-- Select Size start -->
<div class="mt-1">
    <label class="text-sm text-stone-900">Ukuran</label>
    <select id="media_size_id" name="media_size_id"
        class="flex w-[218px]  text-semibold border rounded-lg px-1 outline-none @error('media_size_id') is-invalid @enderror"
        type="text" value="{{ old('media_size_id') }}">
        <option value="pilih">- pilih -</option>
        @foreach ($media_sizes as $size)
            @if ($size->media_category->name == $category)
                @if (old('media_size_id') == $size->id)
                    <option id="{{ json_encode($size) }}" value="{{ $size->id }}" selected>{{ $size->size }}
                    </option>
                @else
                    <option id="{{ json_encode($size) }}" value="{{ $size->id }}">{{ $size->size }}</option>
                @endif
            @endif
        @endforeach
    </select>
    @error('media_size_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select Size end -->
