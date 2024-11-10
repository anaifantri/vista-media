<!-- Input Address start -->
<div class="mt-1">
    <label class="text-sm text-stone-900">Lokasi</label>
    <textarea
        class="flex text-semibold w-[218px]  border rounded-lg px-1 outline-none @error('address') is-invalid @enderror"
        name="address" id="address" rows="3" placeholder="Input Lokasi Billboard" required>{{ old('address') }}</textarea>
    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Input Address end -->
