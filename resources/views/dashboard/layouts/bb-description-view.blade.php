<!-- Media Description start -->
<div class="flex">
    <label class="text-semibold">Deskripsi Media {{ $location->media_category->name }}</label>
</div>
<div class="flex">
    <label class="text-sm text-stone-900 w-28">Penerangan</label>
    <label class="text-semibold">: {{ $description->lighting }}</label>
</div>
<div class="flex">
    <label class="text-sm text-stone-900 w-28">Ukuran</label>
    <label class="text-semibold">: {{ $location->media_size->size }} - {{ $location->side }}</label>
</div>
<div class="flex">
    <label class="text-sm text-stone-900 w-28">Orientasi</label>
    <label class="text-semibold">: {{ $location->orientation }}</label>
</div>
<div class="flex">
    <label class="text-sm text-stone-900 w-28">Kondisi</label>
    <label class="text-semibold">: {{ $location->condition }}</label>
</div>
<!-- Media Description end -->
