<div class="col-span-2 border rounded-lg border-stone-900 p-2">
    <div class="flex">
        <label class="w-36">No. Penjualan</label>
        <label>:</label>
        <label class="ml-2">{{ $sale->number }}</label>
    </div>
    <div class="flex">
        <label class="w-36">Tgl. Penjualan</label>
        <label>:</label>
        <label class="ml-2">
            {{ date('d', strtotime($sale->created_at)) }}
            {{ $bulan[(int) date('m', strtotime($sale->created_at))] }}
            {{ date('Y', strtotime($sale->created_at)) }}
        </label>
    </div>
    <div class="flex">
        <label class="w-36">Jenis</label>
        <label>:</label>
        <label class="ml-2">{{ $sale->media_category->name }}</label>
    </div>
    <div class="flex">
        <label class="w-36">Lokasi</label>
        <label>:</label>
        <label class="ml-2">{{ $product->code }}-{{ $product->city_code }} |
            {{ $product->address }}</label>
    </div>
    <div class="flex">
        <label class="w-36">Harga</label>
        <label>:</label>
        <label class="ml-2">Rp. {{ number_format($sale->price) }},-</label>
    </div>
    <div class="flex">
        <label class="w-36">No. Penawaran</label>
        <label>:</label>
        <label class="ml-2">{{ $quotationDeal->number }}</label>
    </div>
    <div class="flex">
        <label class="w-36">Tgl. Penawaran</label>
        <label>:</label>
        <label class="ml-2">
            {{ date('d', strtotime($quotationDeal->created_at)) }}
            {{ $bulan[(int) date('m', strtotime($quotationDeal->created_at))] }}
            {{ date('Y', strtotime($quotationDeal->created_at)) }}
        </label>
    </div>
    <div class="flex">
        <label class="w-36">Nama Klien</label>
        <label>:</label>
        <label class="ml-2">{{ $client->name }}</label>
    </div>
    <div class="flex">
        <label class="w-36">Nama Perusahaan</label>
        <label>:</label>
        <label class="ml-2">
            @if ($client->type == 'Perusahaan')
                {{ $client->company }}
            @else
                -
            @endif
        </label>
    </div>
</div>
