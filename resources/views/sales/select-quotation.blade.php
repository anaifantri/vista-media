@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex w-[1200px] border-b">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[600px] py-1">Pilih Penawaran
                    {{ $data_category->name }}</h1>
                <div class="flex justify-end w-full">
                    @canany(['isAdmin', 'isMarketing'])
                        @can('isQuotation')
                            @can('isMarketingCreate')
                                <button class="flex justify-center items-center btn-primary w-44" type="button" onclick="salesCreate()">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1">Buat Data Penjualan</span>
                                </button>
                            @endcan
                        @endcan
                    @endcanany
                    <a id="linkCreate" hidden></a>
                    <input type="text" name="category" id="category" value="{{ $data_category->name }}" hidden>
                    <input type="text" name="quotation_id" id="quotation_id" hidden>
                    <a class="flex justify-center items-center ml-1 btn-danger"
                        href="/marketing/sales/home/{{ $data_category->name }}/{{ $company->id }}">
                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-1">Cancel</span>
                    </a>
                </div>
            </div>
            <div class="w-[1200px] mt-4">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-16" rowspan="2">
                                Jenis
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-48 text-center" rowspan="2">
                                <button class="flex justify-center items-center w-48">@sortablelink('number', 'Nomor')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24" rowspan="2">
                                Tanggal</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="2">Data Klien
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-44" rowspan="2">
                                Lokasi
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20" rowspan="2">
                                status</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-16" rowspan="2">
                                Action</th>
                        </tr>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-32">Nama</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-52">Perusahaan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-300">
                        {{-- @php
                            $number = 1 + ($quotations->currentPage() - 1) * $quotations->perPage();
                        @endphp --}}
                        @foreach ($quotations as $quotation)
                            @php
                                $clients = json_decode($quotation->clients);
                                if (!$quotation->quotation_revisions->isEmpty()) {
                                    $lastRevision = $quotation->quotation_revisions->last();
                                    $status = $quotation->quot_revision_statuses->last();
                                    $products = json_decode($lastRevision->products);
                                } else {
                                    $status = $quotation->quotation_statuses->last();
                                    $products = json_decode($quotation->products);
                                }
                            @endphp
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $loop->iteration }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $quotation->media_category->name }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @if (!$quotation->quotation_revisions->isEmpty())
                                        {{ $lastRevision->number }}
                                    @else
                                        {{ $quotation->number }}
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @if (!$quotation->quotation_revisions->isEmpty())
                                        {{ date('d-m-Y', strtotime($lastRevision->created_at)) }}
                                    @else
                                        {{ date('d-m-Y', strtotime($quotation->created_at)) }}
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $clients->name }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @if ($clients->type == 'Perusahaan')
                                        {{ $clients->company }}
                                    @else
                                        -
                                    @endif

                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @foreach ($products as $product)
                                        @if ($loop->iteration != count($products))
                                            {{ $product->code }},
                                        @else
                                            {{ $product->code }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $status->status }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    <input name="choose_quotation" value="{{ $quotation->id }}" type="radio"
                                        title="pilih" onclick="getQuotation(this)">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (count($quotations) == 0)
                <div class="flex justify-center items-center h-16 text-amber-500">
                    ~~ Tidak ada penawaran {{ $data_category->name }} dengan status deal yang belum dimaksukkan kedalam
                    data penjualan ~~
                </div>
            @endif
            {{-- <div class="flex justify-center text-stone-100">
                {!! $quotations->appends(Request::query())->render() !!}
            </div> --}}
        </div>
    </div>

    <script>
        //Select quotation --> start
        getQuotation = (sel) => {
            document.getElementById("quotation_id").value = sel.value;
        }
        //Select quotation --> end

        //Btn Create Action --> start
        salesCreate = () => {
            const linkCreate = document.getElementById("linkCreate");
            const quotationId = document.getElementById("quotation_id");
            if (quotationId.value == "") {
                alert("Silahkan pilih penawaran terlebih dahulu...!!")
            } else {
                linkCreate.setAttribute('href', '/marketing/sales/create-sales/' + category.value +
                    '/' + quotationId.value);
                linkCreate.click();
            }
        }
        //Btn Create Action --> end
    </script>
@endsection
