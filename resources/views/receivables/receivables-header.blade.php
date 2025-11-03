<form action="/marketing/sales-report/receivables-report/{{ $company->id }}">
    <div class="flex justify-center">
        <div class="flex justify-center items-center border rounded-lg mt-2 p-2 w-[1580px]">
            <div>
                <div class="flex h-14">
                    <div>
                        <span class="text-base text-stone-100">Pilih Klien</span>
                        <select name="client" id="" onchange="submit()"
                            class="p-1 outline-none border w-72 text-md text-stone-900 rounded-md bg-stone-100">
                            <option value="All">All</option>
                            @if (request('client'))
                                @foreach ($dataClients as $showClient)
                                    @if ($showClient == request('client'))
                                        <option value="{{ $showClient }}" selected>{{ $showClient }}</option>
                                    @else
                                        <option value="{{ $showClient }}">{{ $showClient }}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($dataClients as $showClient)
                                    <option value="{{ $showClient }}">{{ $showClient }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="ml-4">
                        <span class="text-base text-stone-100">Pilih Data</span>
                        <div class="flex">
                            <select name="fromData" id="" onchange="submit()"
                                class="p-1 outline-none border w-32 text-md text-stone-900 rounded-md bg-stone-100">
                                @if (request('fromData'))
                                    @if (request('fromData') == 'INVOICE')
                                        <option value="INVOICE" selected>Invoice</option>
                                        <option value="PENJUALAN">Penjualan</option>
                                    @else
                                        <option value="INVOICE">Invoice</option>
                                        <option value="PENJUALAN" selected>Penjualan</option>
                                    @endif
                                @else
                                    <option value="INVOICE">Invoice</option>
                                    <option value="PENJUALAN">Penjualan</option>
                                @endif
                            </select>
                            {{-- <button class="flex ml-4 text-teal-400 hover:text-teal-600" type="submit">
                                <svg class="fill-current w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="m12.007 2c-5.518 0-9.998 4.48-9.998 9.998 0 5.517 4.48 9.997 9.998 9.997s9.998-4.48 9.998-9.997c0-5.518-4.48-9.998-9.998-9.998zm1.523 6.21s1.502 1.505 3.255 3.259c.147.147.22.339.22.531s-.073.383-.22.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.335.217-.526.217-.192-.001-.384-.074-.531-.221-.292-.293-.294-.766-.003-1.057l1.977-1.977h-6.693c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.693l-1.978-1.979c-.29-.289-.287-.762.006-1.054.147-.147.339-.221.53-.222.19 0 .38.071.524.215z"
                                        fill-rule="nonzero" />
                                </svg>
                            </button> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div id="divButton" class="flex justify-end w-full">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary"
                    title="Simpan dalam bentuk pdf" type="button">
                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1">Save PDF</span>
                </button>
                <button id="btnExportExcel" class="flex justify-center items-center mx-1 btn-success" title="Create PDF"
                    type="button">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1 text-white">Export to EXCEL</span>
                </button>
                <a class="flex justify-center items-center mx-1 btn-danger"
                    href="/marketing/sales-report/{{ $company->id }}">
                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="mx-1">Close</span>
                </a>
            </div>
        </div>
    </div>
</form>
