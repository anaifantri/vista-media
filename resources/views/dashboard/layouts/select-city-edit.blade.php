<!-- Select City start -->
<div class="mt-1">
    <label class="text-sm text-stone-900">Kota</label>
    <select id="city_id" name="city_id"
        class="flex text-semibold w-[218px]  border rounded-lg px-1 outline-none @error('city_id') is-invalid @enderror"
        type="text" value="{{ $location->city_id }}" onchange="selectCity(this)">
        <option value="pilih">Pilih Kota</option>
        @foreach ($cities as $city)
            @if ($city->area_id == $location->area_id)
                @if ($location->city_id == $city->id)
                    <option id="{{ $city }}" value="{{ $city->id }}" selected>
                        {{ $city->city }}
                    </option>
                @else
                    <option id="{{ $city }}" value="{{ $city->id }}">{{ $city->city }}
                    </option>
                @endif
            @else
                <option id="{{ $city }}" value="{{ $city->id }}" hidden>{{ $city->city }}
                </option>
            @endif
        @endforeach
    </select>
    @error('city_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select City end -->
