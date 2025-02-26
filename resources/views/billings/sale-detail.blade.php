<div id="saleHeader" class="flex w-full justify-center">
    <div class="w-[1180px] h-[200px] bg-stone-200 border rounded-lg border-stone-400 my-2 py-4 px-6">
        <div>
            <span class="text-md font-semibold"><u>Detail Penjualan :</u></span>
        </div>
        <div class="flex text-sm mt-2">
            <div id="saleDetail" class="w-[560px] border rounded-lg border-stone-900 p-2">
                <div class="flex">
                    <label class="w-28">No. Penjualan</label>
                    <label>:</label>
                    <label class="ml-2">{{ $sale->number }}</label>
                </div>
                <div class="flex">
                    <label class="w-28">Tgl. Penjualan</label>
                    <label>:</label>
                    <label class="ml-2">
                        {{ date('d', strtotime($sale->created_at)) }}
                        {{ $bulan[(int) date('m', strtotime($sale->created_at))] }}
                        {{ date('Y', strtotime($sale->created_at)) }}
                    </label>
                </div>
                <div class="flex">
                    <label class="w-28">Jenis</label>
                    <label>:</label>
                    <label class="ml-2">{{ $sale->media_category->name }}</label>
                </div>
                <div class="flex">
                    <label class="w-28">Lokasi</label>
                    <label>:</label>
                    <label class="ml-2">{{ $product->code }}-{{ $product->city_code }} |
                        {{ $product->address }}</label>
                </div>
                <div class="flex">
                    <label class="w-28">Harga</label>
                    <label>:</label>
                    <label class="ml-2">Rp. {{ number_format($sale->price) }},-</label>
                </div>
            </div>
            <div id="quotationDetail" class="w-[560px] border rounded-lg border-stone-900 ml-2 p-2">
                <div class="flex">
                    <label class="w-32">No. Penawaran</label>
                    <label>:</label>
                    <label class="ml-2">{{ $quotation_deal->number }}</label>
                </div>
                <div class="flex">
                    <label class="w-32">Tgl. Penawaran</label>
                    <label>:</label>
                    <label class="ml-2">
                        {{ date('d', strtotime($quotation_deal->created_at)) }}
                        {{ $bulan[(int) date('m', strtotime($quotation_deal->created_at))] }}
                        {{ date('Y', strtotime($quotation_deal->created_at)) }}
                    </label>
                </div>
                <div class="flex">
                    <label class="w-32">Nama Klien</label>
                    <label>:</label>
                    <label class="ml-2">{{ $client->name }}</label>
                </div>
                <div class="flex">
                    <label class="w-32">Nama Perusahaan</label>
                    <label>:</label>
                    <label class="ml-2">{{ $client->company }}</label>
                </div>
            </div>
        </div>
    </div>
</div>
