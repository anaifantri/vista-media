<!-- Select Category start -->
<div class="mt-1">
    <label class="text-sm text-stone-900">Media Katagori</label>
    @if (old('media_category_id'))
        <select id="media_category_id" name="media_category_id"
            class="flex text-semibold w-[218px] border rounded-lg px-1 outline-none @error('media_category_id') is-invalid @enderror"
            value="{{ old('media_category_id') }}" onchange="getCategory(this)">
            @foreach ($categories as $media_category)
                @if ($media_category->name != 'Service' && $media_category->name != 'Signage')
                    @if (old('media_category_id') == $media_category->id)
                        <option value="{{ $media_category->id }}" selected>
                            {{ $media_category->name }}
                        </option>
                    @else
                        <option value="{{ $media_category->id }}">{{ $media_category->name }}
                        </option>
                    @endif
                @endif
            @endforeach
        </select>
    @else
        <select id="media_category_id" name="media_category_id"
            class="flex text-semibold w-[218px] border rounded-lg px-1 outline-none @error('media_category_id') is-invalid @enderror"
            value="{{ $location->media_category->id }}" onchange="getCategory(this)">
            @foreach ($categories as $media_category)
                @if ($media_category->name != 'Service' && $media_category->name != 'Signage')
                    @if ($location->media_category->id == $media_category->id)
                        <option value="{{ $media_category->id }}" selected>
                            {{ $media_category->name }}
                        </option>
                    @else
                        <option value="{{ $media_category->id }}">{{ $media_category->name }}
                        </option>
                    @endif
                @endif
            @endforeach
        </select>
    @endif
    @error('media_category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select Category end -->
