<!-- Input Latitude - longitude start -->
<div class="mt-1">
    <label class="text-sm text-stone-900">Latitude</label>
    <input class="flex text-semibold w-[218px]  border rounded-lg px-1 outline-none @error('lat') is-invalid @enderror"
        type="text" id="lat" name="lat" placeholder="Latitude terisi otomatis" value="{{ old('lat') }}"
        required readonly title="Latitude select from map">
    @error('lat')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mt-1">
    <label class="text-sm text-stone-900">Longitude</label>
    <input class="flex text-semibold w-[218px]  border rounded-lg px-1 outline-none @error('lng') is-invalid @enderror"
        type="text" id="lng" name="lng" placeholder="Longitude terisi otomatis" value="{{ old('lng') }}"
        required readonly title="Longitude select from map">
    @error('lng')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Input Latitude - longitude end -->
