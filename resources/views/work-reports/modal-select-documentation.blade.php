@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [
            1 => 'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des',
        ];
        if (count($sale->quotation->quotation_revisions) != 0) {
            $quotationDeal = $sale->quotation->quotation_revisions->last();
            $payment_terms = json_decode($quotationDeal->payment_terms);
        } else {
            $quotationDeal = $sale->quotation;
            $payment_terms = json_decode($quotationDeal->payment_terms);
        }
        $product = json_decode($sale->product);
        $description = json_decode($product->description);
        $client = json_decode($sale->quotation->clients);
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex items-center w-[1200px] border-b px-2">
                <!-- Title start -->
                <h1 class="index-h1 w-[1200px]">Membuat BAST</h1>
                <!-- Title end -->
                <div id="divButton" class="hidden w-[150px] justify-end">
                    <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
                        onclick="previewMediaBack()">
                        <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                        </svg>
                        <span class="mx-1 text-white">Back</span>
                    </button>
                    <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button">
                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                        </svg>
                        <span class="mx-1 text-white">Save</span>
                    </button>
                </div>
                <div>
                    <a href="/work-reports/index/{{ $company->id }}"
                        class="flex justify-center items-center mx-1 btn-danger" title="Cancel">
                        <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="mx-1 text-white">Cancel</span>
                    </a>
                </div>
            </div>
            <div class="flex w-full justify-center">
                <div class="w-[580px] bg-stone-200 border rounded-lg border-stone-400 my-2 p-2">
                    <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
                        <span class="text-center w-full text-lg font-semibold">Informasi Detail Penjualan</span>
                    </div>
                    <div class="w-[560px] border rounded-lg border-stone-900 mt-2 p-2">
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
                            <label class="ml-2">
                                @if ($sale->media_category->name == 'Service')
                                    Cetak/Pasang
                                @else
                                    {{ $sale->media_category->name }}
                                @endif
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-28">Lokasi</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ $product->address }}
                            </label>
                        </div>
                    </div>
                    <div class="w-[560px] border rounded-lg border-stone-900 mt-2 p-2">
                        <div class="flex">
                            <label class="w-32">No. Penawaran</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ $quotationDeal->number }}
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-32">Tgl. Penawaran</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ date('d', strtotime($quotationDeal->created_at)) }}
                                {{ $bulan[(int) date('m', strtotime($quotationDeal->created_at))] }}
                                {{ date('Y', strtotime($quotationDeal->created_at)) }}
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-32">Nama Klien</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ $client->name }}
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-32">Nama Perusahaan</label>
                            <label>:</label>
                            <label class="ml-2">
                                {{ $client->company }}
                            </label>
                        </div>
                    </div>
                    <div class="flex w-full bg-stone-400 rounded-xl items-center mt-2 px-10 pt-2 border-b pb-2">
                        <span class="text-center w-full text-lg font-semibold">Pilih Tema/Design</span>
                    </div>
                    <div class="flex w-full justify-center items-center p-2">
                        <table class="table-auto mt-2 w-full">
                            <thead>
                                <tr class="text-sm h-8">
                                    <th class="w-8 border border-black">No.</th>
                                    <th class="border border-black">Tema</th>
                                    <th class="w-24 border border-black">Tgl. Tayang</th>
                                    <th class="w-16 border border-black">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($install_orders as $install_order)
                                    <tr class="text-sm">
                                        <td class="border border-black px-1 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-black px-1">{{ $install_order->theme }}</td>
                                        <td class="border border-black px-1 text-center">
                                            {{ date('d', strtotime($install_order->install_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($install_order->install_at))] }}
                                            {{ date('Y', strtotime($install_order->install_at)) }}
                                        </td>
                                        <td class="border border-black px-1">
                                            <div class="flex justify-center w-full">
                                                @if ($loop->iteration == 1)
                                                    <input type="radio" name="select" checked>
                                                @else
                                                    <input type="radio" name="select">
                                                @endif
                                                <span class="ml-2">pilih</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-[580px] bg-stone-200 border rounded-lg border-stone-400 ml-2 my-2 p-2">
                    <div class="flex w-full bg-stone-400 rounded-xl items-center p-2 border-b">
                        <span class="text-center w-full text-lg font-semibold">Pilih Foto</span>
                    </div>
                    <div class="w-[560px] border rounded-lg border-stone-900 mt-2 p-2">
                        <div class="flex justify-center w-full">
                            <label class="flex text-sm font-semibold mr-1">Judul Foto :</label>
                            @if ($work_category != 'Service')
                                <input type="checkbox" class="outline-none ml-4" checked>
                            @else
                                <input type="checkbox" class="outline-none ml-4">
                            @endif
                            <label class="flex text-sm font-semibold ml-2">Foto Siang</label>
                            <input type="checkbox" class="outline-none ml-4">
                            <label class="flex text-sm font-semibold ml-2">Foto Malam</label>
                            @if ($work_category == 'Service')
                                <input type="checkbox" class="outline-none ml-4" checked>
                            @else
                                <input type="checkbox" class="outline-none ml-4">
                            @endif
                            <input type="text" class="ml-2 outline-none bg-white rounded-md px-1 w-32"
                                placeholder="input judul foto">
                        </div>
                        <div class="border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-6 p-1">
                            <img class="m-auto img-preview-first flex items-center bg-white rounded-lg"
                                src="/img/product-image.png">
                        </div>
                    </div>
                    <div class="w-[560px] border rounded-lg border-stone-900 mt-2 p-2">
                        <div class="flex justify-center w-full">
                            <label class="flex text-sm font-semibold mr-1">Judul Foto :</label>
                            <input type="checkbox" class="outline-none ml-4">
                            <label class="flex text-sm font-semibold ml-2">Foto Siang</label>
                            @if ($work_category != 'Service')
                                <input type="checkbox" class="outline-none ml-4" checked>
                            @else
                                <input type="checkbox" class="outline-none ml-4">
                            @endif
                            <label class="flex text-sm font-semibold ml-2">Foto Malam</label>
                            @if ($work_category == 'Service')
                                <input type="checkbox" class="outline-none ml-4" checked>
                            @else
                                <input type="checkbox" class="outline-none ml-4">
                            @endif
                            <input type="text" class="ml-2 outline-none bg-white rounded-md px-1 w-32"
                                placeholder="input judul foto">
                        </div>
                        <div class="border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-6 p-1">
                            <img class="m-auto img-preview-second flex items-center bg-white rounded-lg"
                                src="/img/product-image.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
                <a href="/accounting/work-reports/create" class="flex justify-center items-center mx-1 btn-primary"
                    title="Back">
                    <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                    </svg>
                    <span class="mx-1 text-white">Back</span>
                </a>
                <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
                    onclick="documentationNext()">
                    <span class="mx-1 text-white">Next</span>
                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Preview start-->
    @include('work-reports.modal-preview')
    <!-- Modal Preview end-->

    <script>
        function previewImageFirst(sel) {
            const imgPreview = document.querySelector('.img-preview-first');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(sel.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImageSecond(sel) {
            const imgPreview = document.querySelector('.img-preview-second');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(sel.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        // Function Modal Documentation start
        documentationNext = () => {
            // const firstImage = document.getElementById("firstImage");
            // const secondImage = document.getElementById("secondImage");
            // if (secondImage.files.length == 0 && firstImage.files.length == 0) {
            //     alert("Silahkan pilih foto terlebih dahulu..!");
            // } else {
            document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
            document.getElementById("modalPreview").removeAttribute('hidden');
            document.getElementById("divButton").classList.remove('hidden');
            document.getElementById("divButton").classList.add('flex');
            // saleHeader.classList.remove('flex');
            // saleHeader.classList.add('hidden');
            // }
        }
        documentationBack = () => {
            document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
            document.getElementById("modalSelectSale").removeAttribute('hidden');
            saleHeader.classList.remove('flex');
            saleHeader.classList.add('hidden');
        }
        // Function Modal Documentation end
    </script>
@endsection
