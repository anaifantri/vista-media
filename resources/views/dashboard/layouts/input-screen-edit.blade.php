<!-- Input Screen Size start -->
<div class="mt-1">
    <label class="text-sm text-teal-700">Ukuran Screen</label>
    <div class="flex">
        <label class="flex text-semibold">W (pixel)</label>
        <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none" id="screen_w"
            name="screen_w" type="number" min="0" placeholder="0" title="Terisi Otomatis"
            value="{{ $description->screen_w }}" readonly>
        <label class="flex ml-2
                text-semibold">H (pixel)</label>
        <input class="flex ml-1 text-semibold w-10 in-out-spin-none  border rounded-lg px-1 outline-none" id="screen_h"
            name="screen_h" type="number" min="0" placeholder="0" title="Terisi Otomatis"
            value="{{ $description->screen_h }}" readonly>
    </div>
</div>
<!-- Input Screen Size end -->