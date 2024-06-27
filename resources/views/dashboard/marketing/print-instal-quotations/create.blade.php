@extends('dashboard.layouts.main');

@section('container')
    <!-- Select Sale Data start -->
    <div class="mt-10 z-0">
        <div class="flex justify-center w-full">
            <div class="w-[1100px] p-2">
                <div class="flex">
                    <h1 class="index-h1"> Pilih Data Dari Daftar Penjualan</h1>
                    <div class="flex border-b">
                        <button id="btnCreate" class="index-link btn-primary" type="button">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Buat Penawaran</span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/dashboard/marketing/print-instal-quotations">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <form class="flex mt-2" action="/dashboard/marketing/sales/">
                    <div class="flex">
                        <input id="search" name="search"
                            class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900" type="text"
                            placeholder="Search" value="{{ request('search') }}">
                        <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                            type="submit">
                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex justify-center px-2 pb-8 w-full z-0">
            <div class="w-[1100px] h-[450px] overflow-y-auto">
                <table class="table-auto w-full mb-6">
                    <thead class="sticky top-0 z-10">
                        <tr class="bg-teal-100 h-8">
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-8">No.</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-44 text-center">
                                <button class="flex justify-center items-center w-44">@sortablelink('number', 'Data Penjualan')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem]">Data Reklame
                            </th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-52">Klien</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-36">Deskripsi</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-48">Detail Cetak & Pasang</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 0;
                        ?>
                        @foreach ($sales as $sale)
                            <?php
                            $usedPrint = 0;
                            $usedInstall = 0;
                            ?>
                            @foreach ($w_o_prints as $woPrint)
                                @if ($woPrint->sale_id == $sale->id)
                                    <?php
                                    $usedPrint++;
                                    ?>
                                @endif
                            @endforeach
                            @foreach ($w_o_installs as $woInstall)
                                @if ($woInstall->sale_id == $sale->id)
                                    <?php
                                    $usedInstall++;
                                    ?>
                                @endif
                            @endforeach
                            @if (strtotime($sale->end_at) > strtotime(date('Y/m/d')))
                                @if ($sale->free_instalation - $usedInstall == 0 || $sale->free_print - $usedPrint == 0)
                                    <?php
                                    $index++;
                                    ?>
                                    <tr>
                                        <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                            {{ $index }}</td>
                                        <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                            <div>
                                                <div class="flex ml-1">
                                                    <label class="w-6">No.</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2">{{ $sale->number }}</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-6">Tgl.</label>
                                                    <label class="ml-1">:</label>
                                                    <label
                                                        class="ml-2">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-6">Oleh</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2">{{ $sale->user->name }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                            <div>
                                                <div class="flex ml-1">
                                                    <label class="w-8">Kode</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2">{{ $sale->billboard->code }}</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-8">Lokasi</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2">{{ $sale->billboard->address }}</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-8">Size</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2">{{ $sale->billboard->size->size }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                            <div>
                                                <div class="flex ml-1">
                                                    <label class="w-14">Klien</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2 w-36">{{ $sale->client->name }}</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-14">Perusahaan</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2 w-36">{{ $sale->client->company }}</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-14">Kontak</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2 w-36">{{ $sale->contact->name }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                            <div>
                                                <div class="flex ml-1">
                                                    <label class="w-10">Jenis</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2">{{ $sale->category }}</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-10">Periode</label>
                                                    <label class="ml-1">:</label>
                                                    <label class="ml-2">{{ $sale->duration }}</label>
                                                </div>
                                                @if ($sale->start_at || $sale->end_at)
                                                    <div class="flex ml-1">
                                                        <label class="w-10">Awal</label>
                                                        <label class="ml-1">:</label>
                                                        @if ($sale->start_at)
                                                            <label
                                                                class="ml-2">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                                        @else
                                                            {{-- <label class="ml-2">-</label> --}}
                                                            <input
                                                                class="text-[0.65rem] text-teal-700 ml-2 outline-none border rounded-sm w-20"
                                                                type="date" name="start_at" id="start_at">
                                                        @endif
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-10">Akhir</label>
                                                        <label class="ml-1">:</label>
                                                        @if ($sale->end_at)
                                                            <label
                                                                class="ml-2">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                                        @else
                                                            {{-- <label class="ml-2">-</label> --}}
                                                            <input
                                                                class="text-[0.65rem] text-teal-700 ml-2 outline-none border rounded-sm w-20"
                                                                type="date" name="end_at" id="end_at">
                                                        @endif
                                                    </div>
                                                @else
                                                    <form class="flex"
                                                        action="/dashboard/marketing/sales/{{ $sale->id }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <div class="flex items-center">
                                                            <div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-10">Awal</label>
                                                                    <label class="ml-1">:</label>
                                                                    @if ($sale->start_at)
                                                                        <label
                                                                            class="ml-2">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                                                    @else
                                                                        {{-- <label class="ml-2">-</label> --}}
                                                                        <input
                                                                            class="text-[0.65rem] text-teal-700 ml-2 outline-none border rounded-sm w-20"
                                                                            type="date" name="start_at"
                                                                            id="start_at">
                                                                    @endif
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-10">Akhir</label>
                                                                    <label class="ml-1">:</label>
                                                                    @if ($sale->end_at)
                                                                        <label
                                                                            class="ml-2">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                                                    @else
                                                                        {{-- <label class="ml-2">-</label> --}}
                                                                        <input
                                                                            class="text-[0.65rem] text-teal-700 ml-2 outline-none border rounded-sm w-20"
                                                                            type="date" name="end_at" id="end_at">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="ml-2">
                                                                <button
                                                                    class="index-link text-white w-8 h-5 rounded bg-green-700 hover:bg-green-900 drop-shadow-md mr-1"
                                                                    onclick="return confirm('Apakah anda yakin ingin update data penjualan {{ $sale->number }} ?')"
                                                                    title="Update" type="submit">
                                                                    <svg class="fill-current w-4" clip-rule="evenodd"
                                                                        fill-rule="evenodd" stroke-linejoin="round"
                                                                        stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                        <?php
                                        $quotID = '';
                                        $quot = '';
                                        ?>
                                        @if ($sale->billboard_quotation_id)
                                            <?php
                                            $quotID = $sale->billboard_quotation_id;
                                            $quot = 'Main';
                                            ?>
                                            <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                <div>
                                                    <div class="flex ml-1">
                                                        <label class="w-16">Free Cetak</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-6">{{ $sale->free_print }}</label>
                                                        <label class="w-6 ml-2">Sisa</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ $sale->free_print - $usedPrint }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-16">Terpakai</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ $sale->free_print }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-16">Free Pasang</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-6">{{ $sale->free_instalation }}</label>
                                                        <label class="w-6 ml-2">Sisa</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ $sale->free_instalation - $usedInstall }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-16">Terpakai</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ $usedInstall }}</label>
                                                    </div>
                                                </div>
                                            </td>
                                        @elseif($sale->billboard_quot_revision_id)
                                            <?php
                                            $quotID = $sale->billboard_quot_revision_id;
                                            $quot = 'Revision';
                                            ?>
                                            <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                <div>
                                                    <div class="flex ml-1">
                                                        <label class="w-16">Free Cetak</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-6">{{ $sale->free_print }}</label>
                                                        <label class="w-6 ml-2">Sisa</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ $sale->free_print - $usedPrint }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-16">Terpakai</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ $sale->free_print }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-16">Free Pasang</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2 w-6">{{ $sale->free_instalation }}</label>
                                                        <label class="w-6 ml-2">Sisa</label>
                                                        <label class="ml-1">:</label>
                                                        <label
                                                            class="ml-2">{{ $sale->free_instalation - $usedInstall }}</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-16">Terpakai</label>
                                                        <label class="ml-1">:</label>
                                                        <label class="ml-2">{{ $usedInstall }}</label>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                        <td class="text-teal-700 border text-[0.65rem] text-center align-center">
                                            <?php
                                            $geeks = $sale->billboard->size->size;
                                            preg_match_all('!\d+!', $geeks, $matches);
                                            $wide = $matches[0][0] * $matches[0][1];
                                            $totalInstall = 0;
                                            $diffPrint = $sale->free_print - $usedPrint;
                                            $diffInstall = $sale->free_instalation - $usedInstall;
                                            ?>
                                            @foreach ($installation_prices as $installation_price)
                                                @if ($installation_price->type == $sale->billboard->lighting)
                                                    <?php
                                                    $install_price = $installation_price->price;
                                                    $install_product = $installation_price->type;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($diffInstall > 0)
                                                <?php
                                                $install_price = 0;
                                                ?>
                                            @endif
                                            <div class="flex justify-center">
                                                <input class="outline-none" type="checkbox"
                                                    value="{{ $sale->id }})({{ $sale->billboard->id }})({{ $sale->billboard->code }} - {{ $sale->billboard->city->code }})({{ $sale->billboard->address }})({{ $wide }})({{ $diffPrint }})({{ $diffInstall }})({{ $install_price }})({{ $install_product }})({{ $sale->contact_id }})({{ $sale->client_id }})({{ $sale->client->company }})({{ $sale->contact->name }})({{ $sale->contact->phone }})({{ $sale->contact->email }})({{ $sale->contact->gender }})({{ $sale->free_print }})({{ $usedPrint }})({{ $sale->free_instalation }})({{ $usedInstall }}"
                                                    onclick="getSalesData(this)">
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Select Sale Data end -->

    <!-- Create New Quotatin start -->
    <div id="quotation_modal" name="quotation_modal"
        class="absolute justify-center top-0 w-full h-[full] bg-black bg-opacity-90 z-20 hidden">
        <div class="mt-10">
            <div class="flex w-full justify-center">
                <div class="flex w-[950px] justify-end">
                    <button id="btnPreview" class="flex justify-center items-center mx-1 btn-primary" title="Preview"
                        type="button">
                        <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                        </svg>
                        <span class="ml-2 text-white">Preview</span>
                    </button>
                    <button id="btnCancel" class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger">
                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                    </button>
                </div>
            </div>
            <div class="w-[950px] h-[1345px] border mb-10 mt-2 bg-white">
                <!-- Header start -->
                <div class="h-28">
                    <div class="flex w-full justify-center items-center">
                        <img class="mt-3" src="/img/logo-vm.png" alt="">
                    </div>
                    <div class="flex w-full justify-center items-center mt-2">
                        <img src="/img/line-top.png" alt="">
                    </div>
                </div>
                <!-- Header end -->
                <!-- Body start -->
                <div class="h-[1125px]">
                    <div class="flex justify-center">
                        <div class="w-[725px] mt-2">
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label class="ml-1 text-sm text-gray-500 flex">Auto Number</label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label class="ml-1 text-sm text-black flex">-</label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="subjectBillboard" class="ml-1 text-sm text-black font-semibold flex">Penawaran
                                    Biaya Cetak dan Pasang Materi Iklan Billboard</label>
                            </div>
                            <div class="flex mt-4">
                                <div>
                                    <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                    <label id="clientCompany" class="ml-1 text-sm text-black flex font-semibold"></label>
                                    <div class="flex">
                                        <label id="clientContact"
                                            class="ml-1 text-sm text-black flex font-semibold"></label>
                                        <button id="btnChangeContact" type="button"
                                            class="flex w-max h-5 bg-teal-500 text-sm rounded-md hover:bg-teal-900 cursor-pointer ml-8 justify-center items-center text-white p-1">
                                            <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9 12l-4.463 4.969-4.537-4.969h3c0-4.97 4.03-9 9-9 2.395 0 4.565.942 6.179 2.468l-2.004 2.231c-1.081-1.05-2.553-1.699-4.175-1.699-3.309 0-6 2.691-6 6h3zm10.463-4.969l-4.463 4.969h3c0 3.309-2.691 6-6 6-1.623 0-3.094-.65-4.175-1.699l-2.004 2.231c1.613 1.526 3.784 2.468 6.179 2.468 4.97 0 9-4.03 9-9h3l-4.537-4.969z" />
                                            </svg>Ganti Kontak</button>
                                    </div>
                                    <label class="ml-1 text-sm text-black flex">Di -</label>
                                    <label class="ml-6 text-sm text-black flex">Tempat</label>
                                </div>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="contactEmail" class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="contactPhone" class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                            </div>
                            <div class="flex mt-2">
                                <textarea id="bodyTop" class="ml-1 w-[721px] outline-none text-sm" readonly>Bersama ini kami menyampaikan surat penawaran biaya cetak dan pasang materi billboard dengan spesifikasi sebagai berikut :</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- quotation table start -->
                    <div id="billboardQuotation" class="ml-2">
                        <div class="flex justify-center">
                            <div id="billboardTableWidth" class="w-[725px]">
                                <table id="billboardTable" class="table-fix mt-2 w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-xs text-teal-700 border w-6" rowspan="2">No</th>
                                            <th class="text-xs text-teal-700 border w-16" rowspan="2">Jenis</th>
                                            <th class="text-xs text-teal-700 border" colspan="2">Lokasi</th>
                                            <th class="text-xs text-teal-700 border w-[300px]" colspan="4">
                                                Deskripsi
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-xs text-teal-700 border w-20">Kode</th>
                                            <th class="text-xs text-teal-700 border">Alamat</th>
                                            <th class="text-xs text-teal-700 border w-28">Bahan</th>
                                            <th class="text-xs text-teal-700 border w-8">Luas</th>
                                            <th class="text-xs text-teal-700 border w-14">Harga</th>
                                            <th class="text-xs text-teal-700 border w-[100px]">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="quotationsTBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- quotation table end -->

                    <!-- quotation note start -->
                    <div class="flex justify-center">
                        <div class="w-[725px] mt-2">
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                            </div>
                            <div id="notesQty">
                                <div class="flex">
                                    <label class="ml-1 text-sm">-</label>
                                    <textarea class="text-area-notes" rows="1" placeholder="input catatan" readonly>Harga di atas sudah termasuk PPN.</textarea>
                                </div>
                            </div>
                            <div class="flex">
                                <button id="btnAddNote" type="button"
                                    class="flex w-max h-5 bg-teal-500 text-sm rounded-md hover:bg-teal-900 cursor-pointer ml-4 justify-center items-center text-white p-1">
                                    <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                            fill-rule="nonzero" />
                                    </svg>add
                                    note</button>
                                <button id="btnDelNote" type="button"
                                    class="flex w-max h-5 bg-red-600 text-sm rounded-md hover:bg-red-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                    <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                                            fill-rule="nonzero" />
                                    </svg>remove last note</button>
                            </div>
                            <div class="flex mt-2">
                                <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
                            </div>
                            <div id="paymentTerms">
                                <div class="flex">
                                    <label class="ml-1 text-sm">-</label>
                                    <input id="paymentTerm1" class="text-sm ml-2 outline-none border rounded-md px-1 w-12"
                                        type="number" min="0" max="100" value="100" readonly>
                                    <textarea class="text-area-notes" rows="1" placeholder="input catatan" readonly>% setelah cetak dan pemasangan</textarea>
                                </div>
                            </div>
                        </div>
                        @error('note')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- quotation note end -->

                    <div class="flex justify-center">
                        <div class="flex mt-2">
                            <textarea id="bodyEndBillboard" class="ml-1 w-[721px] outline-none text-sm" rows="1" readonly>Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-[725px] mt-4">
                            <?php
                            $searchDate = strtotime(request('search'));
                            $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            ?>
                            <label class="ml-1 text-sm text-black flex">Denpasar, {{ date('j') }}
                                {{ $bulan[(int) date('m')] }} {{ date('Y') }}</label>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-[725px]">
                            <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-[725px] mt-16">
                            <label id="salesUser"
                                class="ml-1 text-sm text-black flex font-semibold">{{ auth()->user()->name }}</label>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-[725px]">
                            <label id="salesPotition"
                                class="ml-1 text-sm text-black flex">{{ auth()->user()->level }}</label>
                        </div>
                    </div>
                </div>
                <!-- Body end -->
                <!-- Footer start -->
                <div class="flex items-end justify-center">
                    <div>
                        <div class="flex w-full h-max justify-center mt-2">
                            <img src="/img/line-bottom.png" alt="">
                        </div>
                        <div class="flex items-center w-full justify-center">
                            <span class="text-sm font-semibold">PT. Vista Media</span>
                        </div>
                        <div class="flex items-center w-full justify-center">
                            <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
                        </div>
                        <div class="flex items-center w-full justify-center">
                            <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                        </div>
                        <div class="flex items-center w-full justify-center">
                            <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                        </div>
                    </div>
                </div>
                <!-- Footer end -->
            </div>

            {{-- </form> --}}
        </div>
        <div id="changeContact" name="changeContact"
            class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
            <div class="mt-10 flex justify-center w-full">
                <div class="w-[600px] h-max px-4 pb-4 bg-white">
                    <div class="flex w-[576px] justify-end mt-2 mr-2">
                        <button id="btnClose" class="flex" title="Close" type="button">
                            <svg class="fill-gray-500 w-6 m-auto hover:fill-red-700" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex w-full justify-center">
                        <label class="text-xs text-teal-700 border-b my-2 font-semibold"> DAFTAR
                            KONTAK</label>
                    </div>
                    <table class="table-auto mt-2 w-full">
                        <thead>
                            <tr>
                                <th class="text-xs text-teal-700 border w-6">No</th>
                                <th class="text-xs text-teal-700 border w-40">Nama</th>
                                <th class="text-xs text-teal-700 border">Email</th>
                                <th class="text-xs text-teal-700 border w-32">Phone</th>
                            </tr>
                        </thead>
                        <tbody id="contactsTBody">
                            {{-- <?php
                            $i = 0;
                            ?>
                                @foreach ($contacts as $contact)
                                    @if ($contact->client_id == $sale->client_id)
                                        <?php
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-center p-1">
                                                {{ $i }}</td>
                                            <td class="text-xs text-teal-700 border p-1">
                                                <div class="flex items-center">
                                                    <input type="radio" name="contact"
                                                        value="{{ $contact->id }}-{{ $contact->name }}-{{ $contact->email }}-{{ $contact->phone }}"
                                                        onclick="radioFunction(this)">
                                                    <label class="ml-2">{{ $contact->name }}</label>
                                                </div>
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center p-1">
                                                {{ $contact->email }}</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">
                                                {{ $contact->phone }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <input id="contactQty" type="text" value="{{ $i }}" hidden> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Create New Quotatin end -->

    <!-- Form Create New Quotatin / Preview Save start -->
    <form class="flex justify-center" action="/dashboard/marketing/print-instal-quotations" method="post"
        enctype="multipart/form-data">
        @csrf
        <div id="preview_modal" name="preview_modal"
            class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
            <div class="mt-10">
                <div class="flex w-full justify-center">
                    <div class="flex w-[950px] justify-end">
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Save">
                            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="ml-2 text-white">Save</span>
                        </button>
                        <button id="btnPreviewCancel"
                            class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger" type="button">
                            <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                            </svg>
                            <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Close</span>
                        </button>
                    </div>
                </div>
                <input type="text" id="sale_id" name="sale_id" value="{{ $sale->id }}" hidden>
                <input type="text" id="billboard_id" name="billboard_id" value="{{ $sale->billboard_id }}" hidden>
                <input type="text" id="billboard_code" name="billboard_code" value="{{ $sale->billboard->code }}"
                    hidden>
                <input type="text" id="billboard_address" name="billboard_address"
                    value="{{ $sale->billboard->address }}" hidden>
                <input type="text" id="company_id" name="company_id" value="{{ $sale->company_id }}" hidden>
                <input type="text" id="client_id" name="client_id" value="{{ $sale->client_id }}" hidden>
                <input type="text" id="contact_id" name="contact_id" value="{{ $sale->contact_id }}" hidden>
                <input type="text" id="products" name="products" hidden>
                <div class="w-[950px] h-[1345px] border mb-10 mt-2 bg-white">
                    <!-- Header start -->
                    <div class="h-28">
                        <div class="flex w-full justify-center items-center">
                            <img class="mt-3" src="/img/logo-vm.png" alt="">
                        </div>
                        <div class="flex w-full justify-center items-center mt-2">
                            <img src="/img/line-top.png" alt="">
                        </div>
                    </div>
                    <!-- Header end -->
                    <!-- Body start -->
                    <div class="h-[1125px]">
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-2">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label class="ml-1 text-sm text-gray-500 flex">Auto Number</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label class="ml-1 text-sm text-black flex">-</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label class="ml-1 text-sm text-black font-semibold flex">Penawaran
                                        Biaya Cetak dan Pasang Materi Iklan Billboard</label>
                                </div>
                                <div class="flex mt-4">
                                    <div>
                                        <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                        <label id="previewClientCompany"
                                            class="ml-1 text-sm text-black flex font-semibold">{{ $sale->client->company }}</label>
                                        <div class="flex">
                                            <label id="previewClientContact"
                                                class="ml-1 text-sm text-black flex font-semibold">{{ $sale->contact->name }}</label>
                                        </div>
                                        <label class="ml-1 text-sm text-black flex">Di -</label>
                                        <label class="ml-6 text-sm text-black flex">Tempat</label>
                                    </div>
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label id="previewContactEmail"
                                        class="ml-1 text-sm text-black flex">{{ $sale->contact->email }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                    <label id="previewContactPhone"
                                        class="ml-1 text-sm text-black flex">{{ $sale->contact->phone }}</label>
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                </div>
                                <div class="flex mt-2">
                                    <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>Bersama ini kami menyampaikan surat penawaran biaya cetak dan pasang materi billboard dengan spesifikasi sebagai berikut :</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- quotation table start -->
                        <div class="ml-2">
                            <div class="flex justify-center">
                                <div class="w-[725px]">
                                    <table id="billboardTable" class="table-fix mt-2 w-full">
                                        <thead>
                                            <tr>
                                                <th class="text-xs text-teal-700 border w-6" rowspan="2">No</th>
                                                <th class="text-xs text-teal-700 border w-16" rowspan="2">Jenis</th>
                                                <th class="text-xs text-teal-700 border" colspan="2">Lokasi</th>
                                                <th class="text-xs text-teal-700 border w-[300px]" colspan="4">
                                                    Deskripsi
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-xs text-teal-700 border w-20">Kode</th>
                                                <th class="text-xs text-teal-700 border">Alamat</th>
                                                <th class="text-xs text-teal-700 border w-28">Bahan</th>
                                                <th class="text-xs text-teal-700 border w-8">Luas</th>
                                                <th class="text-xs text-teal-700 border w-14">Harga</th>
                                                <th class="text-xs text-teal-700 border w-[100px]">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="quotationsPreviewTBody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- quotation table end -->

                        <!-- quotation note start -->
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-2">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                </div>
                                <div id="notesQty">
                                    <div class="flex">
                                        <label class="ml-1 text-sm">-</label>
                                        <textarea class="text-area-notes" rows="1" placeholder="input catatan" readonly>Harga di atas sudah termasuk PPN.</textarea>
                                    </div>
                                </div>
                                <div class="flex mt-2">
                                    <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
                                </div>
                                <div id="paymentTerms">
                                    <div class="flex">
                                        <label class="ml-1 text-sm">-</label>
                                        <input id="paymentTerm1"
                                            class="text-sm ml-2 outline-none border rounded-md px-1 w-12" type="number"
                                            min="0" max="100" value="100" readonly>
                                        <textarea class="text-area-notes" rows="1" placeholder="input catatan" readonly>% setelah cetak dan pemasangan</textarea>
                                    </div>
                                </div>
                                {{-- <div id="notesPreview">
                                </div> --}}
                            </div>
                        </div>
                        <!-- quotation note end -->

                        <div class="flex justify-center">
                            <div class="flex mt-2">
                                <textarea class="ml-1 w-[721px] outline-none text-sm" rows="1" readonly>Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-4">
                                <?php
                                $searchDate = strtotime(request('search'));
                                $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                ?>
                                <label class="ml-1 text-sm text-black flex">Denpasar, {{ date('j') }}
                                    {{ $bulan[(int) date('m')] }} {{ date('Y') }}</label>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="w-[725px]">
                                <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-16">
                                <label id="salesUser"
                                    class="ml-1 text-sm text-black flex font-semibold">{{ auth()->user()->name }}</label>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="w-[725px]">
                                <label id="salesPotition"
                                    class="ml-1 text-sm text-black flex">{{ auth()->user()->level }}</label>
                            </div>
                        </div>
                    </div>
                    <!-- Body end -->
                    <!-- Footer start -->
                    <div class="flex items-end justify-center">
                        <div>
                            <div class="flex w-full h-max justify-center mt-2">
                                <img src="/img/line-bottom.png" alt="">
                            </div>
                            <div class="flex items-center w-full justify-center">
                                <span class="text-sm font-semibold">PT. Vista Media</span>
                            </div>
                            <div class="flex items-center w-full justify-center">
                                <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
                            </div>
                            <div class="flex items-center w-full justify-center">
                                <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                            </div>
                            <div class="flex items-center w-full justify-center">
                                <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                            </div>
                        </div>
                    </div>
                    <!-- Footer end -->
                </div>
            </div>
        </div>
    </form>
    <!-- Form Create New Quotatin / Preview Save end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <script src="/js/createprintinstallquotation.js"></script>
    <!-- Script end -->
@endsection
