<!-- Input Latitude - longitude start -->
<div class="mt-1" hidden>
    <label class="text-sm text-stone-900">Latitude</label>
    @if ($category == 'Signage')
        <input
            class="flex text-sm text-slate-500 font-semibold w-[218px]  border rounded-lg px-1 outline-none @error('lat') is-invalid @enderror"
            type="text" id="lat" name="lat" value="{{ json_encode($description->lat) }}" required
            title="Latitude select from map">
    @else
        <input
            class="flex text-sm text-slate-500 font-semibold w-[218px]  border rounded-lg px-1 outline-none @error('lat') is-invalid @enderror"
            type="text" id="lat" name="lat" value="{{ $description->lat }}" required
            title="Latitude select from map">
    @endif

    @error('lat')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mt-1" hidden>
    <label class="text-sm text-stone-900">Longitude</label>
    @if ($category == 'Signage')
        <input
            class="flex text-sm text-slate-500 font-semibold w-[218px]  border rounded-lg px-1 outline-none @error('lng') is-invalid @enderror"
            type="text" id="lng" name="lng" value="{{ json_encode($description->lng) }}" required
            title="Longitude select from map">
    @else
        <input
            class="flex text-sm text-slate-500 font-semibold w-[218px]  border rounded-lg px-1 outline-none @error('lng') is-invalid @enderror"
            type="text" id="lng" name="lng" value="{{ $description->lng }}" required
            title="Longitude select from map">
    @endif
    @error('lng')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Input Latitude - longitude end -->
