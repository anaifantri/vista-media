<!-- Media Description start -->
<?php
if ($description->type == 'Videotron') {
    $start = explode(':', date('H:i', strtotime($description->start_at)));
    $end = explode(':', date('H:i', strtotime($description->end_at)));
    $duration_hours = (int) $end[0] - (int) $start[0];
    $duration_second = $duration_hours * 60 * 60;
}
?>
<div class="flex">
    <label class="text-semibold">Deskripsi Media {{ $location->media_category->name }}</label>
</div>
<div class="flex">
    <label class="text-sm text-stone-900 w-28">Jenis</label>
    <label class="text-semibold">: {{ $description->type }}</label>
</div>
@if ($description->type != 'Videotron')
    <div class="flex">
        <label class="text-sm text-stone-900 w-28">Penerangan</label>
        <label class="text-semibold">: {{ $description->lighting }}</label>
    </div>
@endif
<div class="flex">
    <label class="text-sm text-stone-900 w-28">Ukuran</label>
    <label class="text-semibold">: {{ $location->media_size->size }} - {{ $location->side }}</label>
</div>
@if ($description->type == 'Videotron')
    <div class="flex">
        <label class="text-sm text-stone-900 w-28">Screen Size</label>
        @if ($description->screen_w < $description->screen_h)
            <label class="text-semibold">: {{ $description->screen_w }} pixel x {{ $description->screen_h }}
                pixel</label>
        @else
            <label class="text-semibold">: {{ $description->screen_h }} pixel x {{ $description->screen_w }}
                pixel</label>
        @endif
    </div>
@endif
<div class="flex">
    <label class="text-sm text-stone-900 w-28">Jumlah Signage</label>
    <label class="text-semibold">: {{ $description->qty }} unit</label>
</div>
<div class="flex">
    <label class="text-sm text-stone-900 w-28">Orientasi</label>
    <label class="text-semibold">: {{ $location->orientation }}</label>
</div>
<div class="flex">
    <label class="text-sm text-stone-900 w-28">Kondisi</label>
    <label class="text-semibold">: {{ $location->condition }}</label>
</div>
@if ($description->type == 'Videotron')
    <div class="flex">
        <label class="text-sm text-stone-900 w-28">Waktu Tayang</label>
        <label class="text-semibold">:
            {{ date('H:i', strtotime($description->start_at)) }} s.d
            {{ date('H:i', strtotime($description->end_at)) }}
            ({{ $duration_hours }} jam per hari)
        </label>
    </div>
    <div class="flex">
        <label class="text-sm text-stone-900 w-28">Jumlah Slot</label>
        <label class="text-semibold">: {{ $description->slots }} slot</label>
    </div>
    <div class="flex">
        <label class="text-sm text-stone-900 w-28">Durasi Video</label>
        <label class="text-semibold">: {{ $description->duration }} slot</label>
    </div>
    <div class="flex">
        <label class="text-sm text-stone-900 w-28">Jumlah Tampilan</label>
        <label class="text-semibold">:
            {{ $duration_second / $description->duration / $description->slots }} tampilan / slot / hari
        </label>
    </div>
@endif

<!-- Media Description end -->
