<!-- Input Quantity start -->
<div class="mt-1">
    <label class="text-sm text-stone-900">Jumlah Signage</label>
    <div class="flex">
        <input
            class="flex ml-2 text-semibold w-16 in-out-spin-none  border rounded-lg px-1 outline-none @error('qty') is-invalid @enderror"
            name="qty" id="qty" type="number" min="1" max="5" value="{{ $description->qty }}"
            onchange="inputQuantity(this)">
    </div>
    @error('qty')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Input Quantity end -->
