@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quote Revision start -->
    <div class="flex justify-center">
        <div class="mt-10">
            <!-- Title Show Quote Revision start -->
            <div class="flex border-b">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
                    type="button">
                    <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="ml-2 text-white">Save PDF</span>
                </button>
                <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                    href="/dashboard/marketing/billboard-quotations">
                    <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Close</span>
                </a>
                @if (session()->has('success'))
                    <div class="ml-2 flex alert-success">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
            </div>
            <!-- Title Show Quote Revision end -->
            <div>
                <div id="pdfPreview" class="w-[780px] max-h-max">
                    <!-- Header start -->
                    <div class="w-[780px] h-[1100px] mt-2 bg-white">
                        <div class="h-24 mt-4">
                            <div class="flex w-full justify-center items-center">
                                <img class="mt-3" src="/img/logo-vm.png" alt="">
                            </div>
                            <div class="flex w-full justify-center items-center mt-2">
                                <img src="/img/line-top.png" alt="">
                            </div>
                        </div>
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[900px]">
                            <div class="flex justify-center">
                                <div class="w-[650px] mt-4">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label id="quotationNumberBBPreview"
                                            class="ml-1 text-sm text-black flex">{{ $billboard_quot_revision->number }}</label>
                                        <?php
                                        $number = Str::substr($billboard_quot_revision->number, 0, 4);
                                        $getCode = '';
                                        ?>
                                        @foreach ($billboard_categories as $category)
                                            @if ($billboard_quotation->billboard_category_id == $category->id)
                                                <?php
                                                $getCategory = $category->name;
                                                ?>
                                            @endif
                                        @endforeach
                                        @foreach (json_decode($billboard_quot_revision->billboards) as $billboard)
                                            @foreach ($billboard as $location)
                                                <?php
                                                if ($getCode == '') {
                                                    $getCode = $location->code;
                                                } else {
                                                    $getCode = $getCode . '-' . $location->code;
                                                }
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <input id="fileName" type="text"
                                            value="{{ $number }}-{{ $billboard_quotation->client->name }}-{{ $getCategory }}-{{ $getCode }}"
                                            hidden>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label id="attachmentBBPreview"
                                            class="ml-1 text-sm text-black flex">{{ $billboard_quot_revision->attachment }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label id="subjectBBPreview"
                                            class="ml-1 text-sm text-black flex">{{ $billboard_quot_revision->subject }}</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <div>
                                            <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                            <label id="clientBBPreview"
                                                class="ml-1 text-sm text-black flex font-semibold">{{ $billboard_quotation->client->company }}</label>
                                            <label id="contactBBPreview"
                                                class="ml-1 text-sm text-black flex font-semibold">UP.
                                                {{ $billboard_quotation->contact->name }}</label>
                                            <label class="ml-1 text-sm text-black flex">Di -</label>
                                            <label class="ml-6 text-sm text-black flex">Tempat</label>
                                        </div>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label id="contactEmailBBPreview"
                                            class="ml-1 text-sm text-black flex">{{ $billboard_quotation->contact->email }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label id="contactPhoneBBPreview"
                                            class="ml-1 text-sm text-black flex">{{ $billboard_quotation->contact->phone }}</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <label id="letterBodyBBPreview"
                                            class="ml-1 w-[650px] h-max text-sm text-black flex">{{ $billboard_quot_revision->body_top }}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Billboard Location Table Preview start -->
                            <div id="" class="ml-2">
                                <div class="flex justify-center">
                                    <div id="tableWidth" class="w-[650px]">
                                        <table id="" class="table-fix mt-2 w-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-16" rowspan="2">
                                                        Kode
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border" rowspan="2">
                                                        Lokasi
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-[116px]" colspan="3">
                                                        Deskripsi
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border" colspan="5">
                                                        Harga
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-[0.7rem] text-teal-700 border w-max">Jenis</th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-max">BL/FL</th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-20">Size - V/H
                                                    </th>
                                                    <?php
                                                    $objLocations = json_decode($billboard_quot_revision->billboards);
                                                    ?>
                                                    @if ($objLocations->locations[0]->price->periodeMonth->cbPeriode == true)
                                                        <th class="text-[0.7rem] text-teal-700 border w-max">
                                                            {{ $objLocations->locations[0]->price->periodeMonth->periode }}
                                                        </th>
                                                    @endif
                                                    @if ($objLocations->locations[0]->price->periodeQuarter->cbPeriode == true)
                                                        <th class="text-[0.7rem] text-teal-700 border w-max">
                                                            {{ $objLocations->locations[0]->price->periodeQuarter->periode }}
                                                        </th>
                                                    @endif
                                                    @if ($objLocations->locations[0]->price->periodeHalf->cbPeriode == true)
                                                        <th class="text-[0.7rem] text-teal-700 border w-max">
                                                            {{ $objLocations->locations[0]->price->periodeHalf->periode }}
                                                        </th>
                                                    @endif
                                                    @if ($objLocations->locations[0]->price->periodeYear->cbPeriode == true)
                                                        <th class="text-[0.7rem] text-teal-700 border w-max">
                                                            {{ $objLocations->locations[0]->price->periodeYear->periode }}
                                                        </th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody id="previewBBTBody">
                                                <?php
                                                $objLocations = json_decode($billboard_quot_revision->billboards);
                                                $dataLocations = $objLocations->locations;
                                                ?>
                                                @foreach ($dataLocations as $location)
                                                    <tr>
                                                        <td class="text-[0.7rem] text-center text-teal-700 border">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td class="text-[0.7rem] text-center text-teal-700 border">
                                                            {{ $location->code }}
                                                        </td>
                                                        <td class="text-[0.7rem] text-teal-700 border">
                                                            {{ $location->address }}
                                                        </td>
                                                        <td class="text-[0.7rem] text-center text-teal-700 border">
                                                            @if ($location->category == 'Billboard')
                                                                BB
                                                            @elseif ($location->category == 'Bando')
                                                                BD
                                                            @elseif ($location->category == 'Baliho')
                                                                BLH
                                                            @elseif ($location->category == 'Midiboard')
                                                                MB
                                                            @endif
                                                        </td>
                                                        <td class="text-[0.7rem] text-center text-teal-700 border">
                                                            @if ($location->lighting == 'Frontlight')
                                                                FL
                                                            @elseif ($location->lighting == 'Backlight')
                                                                BL
                                                            @endif
                                                        </td>
                                                        <td class="text-[0.7rem] text-center text-teal-700 border">
                                                            {{ $location->size }} -
                                                            @if ($location->orientation == 'Horizontal')
                                                                H
                                                            @elseif ($location->orientation == 'Vertikal')
                                                                V
                                                            @endif
                                                        </td>
                                                        @if ($location->price->periodeMonth->cbPeriode == true)
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">Rp.
                                                                {{ number_format($location->price->periodeMonth->priceMonth) }},-
                                                            </td>
                                                        @endif
                                                        @if ($location->price->periodeQuarter->cbPeriode == true)
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">Rp.
                                                                {{ number_format($location->price->periodeQuarter->priceQuarter) }},-
                                                            </td>
                                                        @endif
                                                        @if ($location->price->periodeHalf->cbPeriode == true)
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">Rp.
                                                                {{ number_format($location->price->periodeHalf->priceHalf) }},-
                                                            </td>
                                                        @endif
                                                        @if ($location->price->periodeYear->cbPeriode == true)
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">Rp.
                                                                {{ number_format($location->price->periodeYear->priceYear) }},-
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Billboard Location Table Preview end -->

                            <!-- billboard note start -->
                            <div class="flex justify-center">
                                <div id="previewBBNote" class="w-[650px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-[0.7rem] text-black flex w-20">Catatan</label>
                                        <label class="ml-1 text-[0.7rem] text-black flex">:</label>
                                    </div>
                                    <?php
                                    $objNotes = json_decode($billboard_quot_revision->note);
                                    ?>
                                    @foreach ($objNotes->notes as $note)
                                        @if ($note->cbNote == 'true')
                                            <div>
                                                <div class="flex">
                                                    <label
                                                        class="ml-1 text-[0.7rem] text-black flex">{{ $note->labelNote }}</label>
                                                    <label
                                                        class="ml-2 text-[0.7rem] text-black w-full">{{ $note->textNote }}</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <!-- billboard note end -->

                            <div class="flex justify-center">
                                <div class="flex mt-2 w-[650px]">
                                    <label
                                        class="ml-1 w-[650px] h-max text-sm text-black flex">{{ $billboard_quot_revision->body_end }}</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <?php
                                $quotationDate = date('d F Y');
                                ?>
                                <div class="w-[650px] mt-2">
                                    <label class="ml-1 text-sm text-black flex">Denpasar,
                                        {{ date('d F Y', strtotime($billboard_quot_revision->created_at)) }}</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[250px]">
                                    <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                                    <label class="ml-1 my-2 text-xs text-slate-300 flex">Ditandatangani secara
                                        elektronik
                                        oleh
                                        :</label>
                                    <label id="salesUser"
                                        class="ml-1 text-sm text-black flex font-semibold">{{ $billboard_quot_revision->user->name }}</label>
                                    <label id="salesPotition"
                                        class="ml-1 text-sm text-black flex">{{ $billboard_quot_revision->user->level }}</label>
                                </div>
                                <div class="w-[400px]">
                                    <div>
                                        {{ QrCode::size(100)->generate('https://www.vistamedia.co.id/dashboard/marketing/billboard-quotations/' . $billboard_quot_revision->id) }}
                                    </div>
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
                    </div>
                    <!-- Footer end -->
                    <div id="locationsImage" class="h-max">

                    </div>
                    <!-- Footer end -->
                    <?php
                    $objLocations = json_decode($billboard_quot_revision->billboards);
                    ?>
                    @foreach ($objLocations->locations as $location)
                        <div id="preview" name="preview" class="ml-2 w-[780px] h-[1100px] bg-white mt-2">
                            <div class="flex w-full justify-center items-center">
                                <img class="mt-3" src="/img/logo-vm.png" alt="">
                            </div>
                            <div class="flex w-full justify-center items-center mt-2">
                                <img src="/img/line-top.png" alt="">
                            </div>
                            <div class="flex w-full h-[44px] justify-center items-center mt-1">
                                <div
                                    class="flex w-[700px] h-[44px] justify-start items-center bg-slate-50 border rounded-t-xl">
                                    <span
                                        class="flex justify-end items-center w-20 h-[36px] text-lg text-red-700 font-bold">{{ $location->code }}</span>
                                    <span class="flex justify-start items-center w-24 h-[36px] text-lg font-bold ml-1"> -
                                        {{ $location->city }}
                                    </span>
                                    <img class="h-10" src="/img/code-line.png" alt="">
                                    <span
                                        class="flex items-center w-[575px] h-[36px] text-base font-semibold">{{ $location->address }}</span>
                                </div>
                            </div>
                            <div class="flex w-full h-[465px] justify-center mt-[1px]">
                                <div
                                    class="flex w-[700px] h-[465px] justify-center items-center bg-slate-50 border rounded-b-xl">
                                    <img class="m-auto w-[670px] h-[435px]"
                                        src="{{ asset('storage/' . $location->photo) }}" alt="">
                                </div>
                            </div>
                            <div class="flex w-full h-[385px] justify-center mt-1">
                                <div class="flex w-[700px] h-[385px] bg-white">
                                    <div class="flex w-[476px] h-[385px] bg-white justify-center">
                                        <div class="">
                                            <div
                                                class="flex w-[476px] h-7 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                Google Maps
                                                Koordinat :
                                                {{ number_format($location->lat, 7) . ', ' . number_format($location->lng, 7) }}
                                            </div>
                                            <div class="flex relative w-[476px] h-[355px] mt-[1px] rounded-b-lg">
                                                <div class="flex absolute w-[100px] mt-[250px] ml-1">
                                                    {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $location->lat . ',' . $location->lng . '/@' . $location->lat . ',' . $location->lng . ',15z') }}
                                                </div>
                                                <?php
                                                $src = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $location->lat . ',' . $location->lng . '&zoom=15&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' . $location->lat . ',' . $location->lng . '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                                                ?>
                                                <img class="w-[476px] h-[355px] border rounded-b-xl" id="myImage"
                                                    name="myImage" src="{{ $src }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex w-[220px] h-[385px] bg-white justify-center ml-1">
                                        <div class="">
                                            <div
                                                class="flex p-1 items-center justify-center w-[220px] h-7 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                Deskripsi Billboard
                                            </div>
                                            <div class="w-[220px] h-[92px] bg-slate-50 mt-[1px] rounded-b-lg border">
                                                <div class="flex mt-1">
                                                    <span
                                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Jenis</span>
                                                    <span
                                                        class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                        {{ $location->category }}
                                                    </span>
                                                </div>
                                                <div class="flex mt-1">
                                                    <span
                                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Ukuran</span>
                                                    <span
                                                        class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                        {{ $location->size }}
                                                        sisi</span>
                                                </div>
                                                <div class="flex mt-1">
                                                    <span
                                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Orientasi</span>
                                                    <span
                                                        class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                        {{ $location->orientation }}
                                                    </span>
                                                </div>
                                                <div class="flex mt-1">
                                                    <span
                                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Penerangan</span>
                                                    <span
                                                        class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                        {{ $location->lighting }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div
                                                class="flex w-[220px] h-7 p-1 bg-slate-50 mt-[1px] border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                Informasi Area
                                            </div>
                                            <div class="flex w-[220px] h-[234px] border bg-slate-50 mt-[1px] rounded-b-lg">
                                                <div>
                                                    <div class="flex">
                                                        <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type
                                                            Jalan</span>
                                                        <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                            {{ $location->road }}
                                                        </span>
                                                    </div>
                                                    <div class="flex">
                                                        <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                                            Pandang</span>
                                                        <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                            {{ $location->distance }}
                                                        </span>
                                                    </div>
                                                    <div class="flex">
                                                        <span
                                                            class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                                            Kend.</span>
                                                        <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                                            {{ $location->speed }}
                                                        </span>
                                                    </div>
                                                    <div class="flex">
                                                        <span
                                                            class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                                            <br><br><br><br><br>
                                                            {{ QrCode::size(100)->generate('https://vistamedia.co.id/preview/' . $location->id) }}
                                                        </span>
                                                        <span
                                                            class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                                            <div>:</div>

                                                            <?php
                                                            $data = $location->sector;
                                                            $sectors = explode('-', $data);
                                                            ?>
                                                            <div>
                                                                @foreach ($sectors as $key => $sector)
                                                                    @if ($sector != end($sectors))
                                                                        <div>
                                                                            - {{ $sector }}
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex
                                w-full h-max justify-center mt-1">
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
                    @endforeach
                </div>
                <div class="h-10"></div>
            </div>
        </div>
    </div>
    </div>
    <!-- Show Quote Revision end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const saveName = document.getElementById("fileName");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: saveName.value,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 192,
                    scale: 4,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            // html2pdf(element, opt);
            html2pdf().set(opt).from(element).save();
        };
    </script>
    <!-- Script end -->
@endsection
