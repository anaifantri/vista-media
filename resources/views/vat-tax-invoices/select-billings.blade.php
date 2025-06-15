@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    @endphp
    <div class="flex justify-center bg-black p-10">
        <div>
            <div class="flex items-center w-[1200px] border-b px-2">
                <!-- Title start -->
                <h1 class="index-h1 w-[1200px]">Upload Faktur PPN</h1>
                <!-- Title end -->
                <div class="flex w-[150px] justify-end">
                    <button id="divButton" class="hidden justify-center items-center mx-1 btn-success" title="Next"
                        type="button">
                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                        </svg>
                        <span class="mx-1 text-white">Save</span>
                    </button>
                    <a href="/vat-tax-invoices/index/{{ $company->id }}"
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
            <div class="flex justify-center w-full">
                <div class="w-[1200px] mb-10 p-2">
                    <div class="flex w-full bg-stone-400 rounded-xl items-center border-b p-2">
                        <span class="text-center w-full text-lg font-semibold">PILIH DATA TAGIHAN</span>
                    </div>
                    <div
                        class="flex w-full h-[560px] bg-stone-200 items-center justify-center border rounded-lg border-stone-400 my-2 p-4 pt-2 border-b pb-2">
                        <div class="w-[1135px]">
                            <div class="flex">
                                <input
                                    id="search"class="flex border border-stone-900 rounded-lg p-1 outline-none text-sm text-stone-900"
                                    type="text" placeholder="Search"onkeyup="searchTable()" autofocus>
                            </div>
                            <div class="h-[504px] overflow-y-auto mt-1">
                                <table id="salesTable" class="table-auto w-full">
                                    <thead>
                                        <tr class="bg-stone-400">
                                            <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center"
                                                rowspan="2">
                                                No.</th>
                                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-48"
                                                rowspan="2">
                                                <button class="flex justify-center items-center w-full">@sortablelink('invoice_number', 'No. Invoice')
                                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24">
                                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                    </svg>
                                                </button>
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-24"
                                                rowspan="2">
                                                Tgl. Tagihan
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-52"
                                                rowspan="2">
                                                Klien
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-xs text-center"
                                                colspan="4">Detail
                                                Tagihan
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-20"
                                                rowspan="2">
                                                Action
                                            </th>
                                        </tr>
                                        <tr class="bg-stone-400">
                                            <th class="text-stone-900 border border-stone-900 text-xs w-32 text-center">
                                                Jenis
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">
                                                Nominal
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-16">
                                                PPN
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-stone-200">
                                        @foreach ($billings as $billing)
                                            @php
                                                $client = json_decode($billing->client);
                                            @endphp
                                            <tr>
                                                <td
                                                    class="text-stone-900 px-1 border border-stone-900 text-xs  text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                                    {{ $billing->invoice_number }}
                                                </td>
                                                <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                                    {{ date('d', strtotime($billing->created_at)) }}-{{ $bulan[(int) date('m', strtotime($billing->created_at))] }}-{{ date('Y', strtotime($billing->created_at)) }}
                                                </td>
                                                <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                                    @if (isset($client->company))
                                                        {{ $client->company }}
                                                    @elseif (isset($client->name))
                                                        {{ $client->name }}
                                                    @else
                                                        {{ $client->contact_name }}
                                                    @endif
                                                </td>
                                                <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                                    @if ($billing->category == 'Media')
                                                        Sewa Media
                                                    @elseif($billing->category == 'Service')
                                                        Cetak/Pasang
                                                    @endif
                                                </td>
                                                <td class="text-stone-900 px-1 border border-stone-900 text-xs text-right">
                                                    {{ number_format($billing->nominal) }}
                                                </td>
                                                <td class="text-stone-900 px-1 border border-stone-900 text-xs text-right">
                                                    {{ number_format($billing->ppn) }}
                                                </td>
                                                <td class="text-stone-900 px-1 border border-stone-900 text-xs  text-right">
                                                    {{ number_format($billing->nominal + $billing->ppn) }}
                                                </td>
                                                <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                                    <input value="{{ $billing->id }}" type="radio" name="chooseBilling"
                                                        title="pilih" onclick="getBilling(this)">
                                                    <label class="ml-1">Pilih</label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
                        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
                            onclick="btnNextAction()">
                            <span class="mx-1 text-white">Next</span>
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="formSelectBilling">
    </form>

    <script>
        const formSelectBilling = document.getElementById("formSelectBilling");

        getBilling = (sel) => {
            formSelectBilling.setAttribute('action', '/vat-tax-invoices/create/' + sel.value);
        }

        btnNextAction = () => {
            formSelectBilling.submit();
        }

        // Search Table --> start
        function searchTable() {
            const search = document.getElementById("search");
            const salesTable = document.getElementById("salesTable");
            var filter, tr, td, i, found, tdText;
            filter = search.value.toUpperCase();
            tr = salesTable.getElementsByTagName("tr");
            for (i = 2; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    tdText = tr[i].getElementsByTagName("td")[j];
                    if (tdText.innerText.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
                if (found == true) {
                    tr[i].style.display = "";
                    found = false;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>
    <!-- Script Preview Image end-->
@endsection
