@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation Videotron start -->
    <div class="flex justify-center">
        <div>
            <div class="mt-10">
                <div class="flex justify-center w-[950px] border-b">
                    <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider w-full py-1">Pilih Lokasi Videotron</h1>
                    <a class="flex justify-end w-full items-center ml-1 btn-danger"
                        href="/dashboard/marketing/videotron-quotations">
                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                    </a>
                </div>
                <form action="/dashboard/marketing/videotron-quotations/create/">
                    <div class="flex mt-1 ml-2">
                        <div class="w-full md:w-36">
                            <span class="text-base text-teal-900">Area</span>
                            <input type="text" id="requestArea" name="requestArea" value="{{ request('area') }}" hidden>
                            <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="area"
                                id="area" onchange="submit()" value="{{ request('area') }}">
                                <option value="All">All</option>
                                @foreach ($areas as $area)
                                    @if (request('area') == $area->id)
                                        <option value="{{ $area->id }}" selected>{{ $area->area }}</option>
                                    @else
                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-36 ml-2">
                            <span class="text-base text-teal-900">Kota</span>
                            @if (request('area'))
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="city"
                                    onchange="submit()">
                                    <option value="All">All</option>
                                    @foreach ($cities as $city)
                                        @if (request('area') == $city->area_id)
                                            @if (request('city') == $city->id)
                                                <option value="{{ $city->id }}" selected>{{ $city->city }}</option>
                                            @else
                                                <option value="{{ $city->id }}">{{ $city->city }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="city"
                                    onchange="submit()" disabled>
                                    <option value="All">All</option>
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="md:flex mt-2">
                        <div class="flex">
                            <input id="search" name="search"
                                class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900"
                                type="text" placeholder="Search" value="{{ request('search') }}">
                            <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                type="submit">
                                <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-[950px] mt-4">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-teal-100 h-10">
                            <th class="text-teal-700 border text-sm w-8 text-center">No</th>
                            <th class="text-teal-700 border text-sm w-24 text-center">Kode</th>
                            <th class="text-teal-700 border text-sm text-center">Lokasi</th>
                            <th class="text-teal-700 border text-sm text-center w-20">Area</th>
                            <th class="text-teal-700 border text-sm text-center w-28">Kota</th>
                            <th class="text-teal-700 border text-sm text-center w-28">Size - V/H</th>
                            <th class="text-teal-700 border text-sm text-center w-32">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($videotrons as $videotron)
                            <tr>
                                <td class="text-teal-700 border text-sm text-center">{{ $loop->iteration }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $videotron->code }} -
                                    {{ $videotron->city->code }}</td>
                                <td class="text-teal-700 border text-sm px-2">{{ $videotron->address }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $videotron->area->area }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $videotron->city->city }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $videotron->size->size }}
                                    -
                                    @if ($videotron->orientation == 'Vertikal')
                                        V
                                    @elseif ($videotron->orientation == 'Horizontal')
                                        H
                                    @endif
                                </td>
                                <td class="text-teal-700 border text-sm">
                                    <div class="flex justify-center items-center">
                                        <a href="/dashboard/marketing/videotron-quotations/create-quotations/{{ $videotron->id }}"
                                            class="index-link text-white w-16 `h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mx-1">
                                            <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 17.292l-4.5-4.364 1.857-1.858 2.643 2.506 5.643-5.784 1.857 1.857-7.5 7.643z" />
                                            </svg>
                                            <span class="text-white text-sm ml-1">Pilih</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="mt-10 z-0">
        <div class="flex justify-center w-full">
            <div class="w-[950px] h-[1345px] border mb-10 mt-1">
                <!-- Header start -->
                @include('dashboard.layouts.letter-header')
                <!-- Header end -->
                <!-- Body start -->
                <div class="h-[1125px]">
                    <div class="flex justify-center">
                        <div class="w-[725px] mt-2">
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex mt-4">
                                <div>
                                    <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                    <label class="ml-1 text-sm text-black flex font-semibold"></label>
                                    <label class="ml-1 text-sm text-black flex font-semibold"></label>
                                    <label class="ml-1 text-sm text-black flex">Di -</label>
                                    <label class="ml-6 text-sm text-black flex">Tempat</label>
                                </div>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label class="ml-1 text-sm text-black flex">-</label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label class="ml-1 text-sm text-black flex">-</label>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                            </div>
                            <div class="flex mt-2">
                                <textarea class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ................. area ............... dengan spesifikasi sebagai berikut :</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- videotron table start -->
                    <div class="ml-2">
                        <div class="flex justify-center">
                            <table class="table-auto mt-2">
                                <thead>
                                    <tr>
                                        <th class="text-sm text-teal-700 border w-60" rowspan="2">Deskripsi
                                        </th>
                                        <th class="text-sm text-teal-700 border w-[480px]" rowspan="2">
                                            Spesifikasi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Lokasi</td>
                                        <td class="px-4 text-sm text-teal-700 border">Jl. Sunset Road - Simpang Nakula</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Ukuran</td>
                                        <td class="px-4 text-sm text-teal-700 border">4,8 m x 9,6 m (width : 1.200 pixel
                                            height :
                                            600 pixel)</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Orientasi</td>
                                        <td class="px-4 text-sm text-teal-700 border">Horizontal</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Ukuran Pixel</td>
                                        <td class="px-4 text-sm text-teal-700 border">P8 SMD</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Konfigurasi Pixel</td>
                                        <td class="px-4 text-sm text-teal-700 border">1R1G1B</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Kerapatan Pixel</td>
                                        <td class="px-4 text-sm text-teal-700 border">15.625 dots/m2</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Jarak Pandang Terbaik</td>
                                        <td class="px-4 text-sm text-teal-700 border">≥ 8m</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Sudut Pandang Terbaik</td>
                                        <td class="px-4 text-sm text-teal-700 border">140°(W) 120°(H)</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Refresh Rate</td>
                                        <td class="px-4 text-sm text-teal-700 border">≥ 3840HZ</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Waktu Tayang</td>
                                        <td class="px-4 text-sm text-teal-700 border">07.00 s.d. 22.00 (15 jam / hari)</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Durasi Video</td>
                                        <td class="px-4 text-sm text-teal-700 border">30 detik</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-sm text-teal-700 border">Harga Sharing 4 (empat) Klien</td>
                                        <td class="px-4 text-sm text-teal-700 border">Rp. 800.000.000,- / Tahun (450
                                            tampilan per hari)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- videotron table end -->

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
                                    <label class="ml-2 text-sm text-black outline-none w-full">Biaya di atas belum termasuk
                                        PPN dan Desain Materi Iklan</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex">-</label>
                                    <label class="ml-2 text-sm text-black outline-none w-full">Harga tersebut termasuk
                                        :</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-4 text-sm text-black outline-none w-full">• Penggantian (upload / take
                                        out) materi iklan.</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-4 text-sm text-black outline-none w-full">• Sewa Lokasi, konsumsi
                                        listrik selama kontrak, maintenance selama kontrak.</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm">-</label>
                                    <label class="ml-2 text-sm text-black outline-none w-full">Harga & lokasi tidak
                                        mengikat, sewaktu-waktu dapat berubah sebelum ada persetujuan tertulis</label>
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
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
                            </div>
                            <div id="paymentTerms">
                                <div class="flex">
                                    <label class="ml-1 text-sm">-</label>
                                    <input class="text-sm ml-2 outline-none border rounded-md px-1 w-12" type="number"
                                        min="0" max="100" value="100">
                                    <textarea class="text-area-notes" rows="1">% sebelum materi iklan tayang</textarea>
                                </div>
                            </div>
                            <div>
                                <div class="flex mt-2">
                                    <button id="btnAddPayment" type="button"
                                        class="flex w-max h-5 bg-teal-500 text-sm rounded-md hover:bg-teal-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                        <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                fill-rule="nonzero" />
                                        </svg>add payment terms</button>
                                    <button id="btnDelPayment" type="button"
                                        class="flex w-max h-5 bg-red-600 text-sm rounded-md hover:bg-red-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                        <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                                                fill-rule="nonzero" />
                                        </svg>remove last payment terms</button>
                                </div>
                            </div>
                            <div>
                                <div class="flex">
                                    <label class="ml-1 text-sm">-</label>
                                    <label class="ml-2 text-sm text-black font-semibold outline-none w-full">OOH Premium
                                        milik kami
                                        tersebar di Area Lombok, Bali, Jawa Timur dan Kalimantan</label>
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

                    <div class="h-[1125px]">
                        <div class="flex justify-center">
                            <div class="flex mt-2">
                                <textarea class="ml-1 w-[721px] outline-none text-sm" rows="1">Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <?php
                            $quotationDate = date('d F Y');
                            ?>
                            <div class="w-[725px] mt-2">
                                <label class="ml-1 text-sm text-black flex">Denpasar, {{ $quotationDate }}</label>
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
                </div>
                <!-- Body end -->
                <!-- Footer start -->
                @include('dashboard.layouts.letter-footer')
            </div>
            <!-- Footer end -->
        </div>
        <!-- Get Location Data start -->
        <?php
        $vtlocations = [];
        ?>
        <!-- Get Location Data end -->

        <!-- View Location start -->
        @if ($vtlocations)
            @include('dashboard.layouts.vt-location')
        @endif
        <!-- View Location end -->

    </div> --}}
    <!-- Quotation Videotron start -->

    {{-- <script>
        const btnAddNote = document.getElementById("btnAddNote");
        const btnDelNote = document.getElementById("btnDelNote");
        const notesQty = document.getElementById("notesQty");
        const btnAddPayment = document.getElementById("btnAddPayment");
        const btnDelPayment = document.getElementById("btnDelPayment");
        const paymentTerms = document.getElementById("paymentTerms");

        // Button Add Note Action --> start
        btnAddNote.addEventListener("click", function() {
            if (notesQty.children.length < 8) {
                const divNotes = document.createElement("div");
                const labelNotes = document.createElement("label");
                const inputNotes = document.createElement("textarea");
                divNotes.classList.add("flex");
                labelNotes.classList.add("ml-1");
                labelNotes.classList.add("text-sm");
                labelNotes.innerHTML = "-";
                inputNotes.classList.add("text-area-notes");
                inputNotes.setAttribute("placeholder", "input catatan");
                inputNotes.setAttribute("rows", "1");

                divNotes.appendChild(labelNotes);
                divNotes.appendChild(inputNotes);

                notesQty.appendChild(divNotes);
            } else {
                alert("Maksimal tambahan 3 catatan");
            }
        });
        // Button Add Note Action --> end

        // Button Remove Last Note Action --> start
        btnDelNote.addEventListener("click", function() {
            if (notesQty.children.length > 5) {
                notesQty.removeChild(notesQty.lastChild);
            } else {
                alert("Tidak ada tambahan catatan yang bisa dihapus");
            }
        });
        // Button Remove Last Note Action --> end

        // Button Add Payment Action --> start
        btnAddPayment.addEventListener("click", function() {
            if (paymentTerms.children.length < 4) {
                const divPayment = document.createElement("div");
                const labelPayment = document.createElement("label");
                const termOfPayment = document.createElement("input");
                const paymentDescription = document.createElement("textarea");
                divPayment.classList.add("flex");

                labelPayment.classList.add("ml-1");
                labelPayment.classList.add("text-sm");
                labelPayment.innerHTML = "-";

                termOfPayment.setAttribute('min', 0);
                termOfPayment.setAttribute('max', 100);
                termOfPayment.setAttribute('type', 'number');
                termOfPayment.classList.add('term-of-payment');

                paymentDescription.classList.add("text-area-notes");
                paymentDescription.setAttribute("placeholder", "input keterangan");
                paymentDescription.setAttribute("rows", "1");

                divPayment.appendChild(labelPayment);
                divPayment.appendChild(termOfPayment);
                divPayment.appendChild(paymentDescription);

                paymentTerms.appendChild(divPayment);
            } else {
                alert("Maksimal 4 termin pembayaran");
            }
        });
        // Button Add Payment Action --> end

        // Button Remove Last Payment Action --> start
        btnDelPayment.addEventListener("click", function() {
            if (paymentTerms.children.length > 1) {
                paymentTerms.removeChild(paymentTerms.lastChild);
            } else {
                alert("Minimal 1 termin pembayaran");
            }
        });
        // Button Remove Last Payment Action --> end
    </script> --}}
@endsection
