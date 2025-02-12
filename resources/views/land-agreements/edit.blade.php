@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $firstParty = json_decode($land_agreement->first_party);
    $secondParty = json_decode($land_agreement->second_party);
    $location = $land_agreement->location;
    $description = json_decode($location->description);
    ?>
    <!-- Container start -->
    <form action="/media/land-agreements/{{ $land_agreement->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center py-10 px-14 bg-stone-800">
            <div class="bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[850px]">EDIT DATA SEWA LAHAN</h1>
                    <div class="flex items-center w-full justify-end">
                        <button id="btnSave" name="btnSave" class="flex justify-center items-center ml-1 btn-primary"
                            type="submit">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Save</span>
                        </button>
                        <a class="flex justify-center items-center ml-1 btn-danger"
                            href="/show-land-agreement/{{ $land_agreement->location->id }}">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Close</span>
                        </a>
                    </div>
                </div>
                <!-- Title end -->

                <!-- View Input start -->
                <div class="flex justify-center w-full mt-2">
                    <div class="w-[1200px]">
                        <!-- Location start -->
                        <div class="grid grid-cols-2 gap-2 w-full justify-center mt-2 p-2">
                            <div class="border rounded-lg p-2 bg-stone-200">
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Kode Lokasi</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->code }}-{{ $location->city->code }}</label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Lokasi</label>
                                    <label>:</label>
                                    <label class="ml-1">
                                        @if (strlen($location->address) > 65)
                                            {{ substr($location->address, 0, 65) }}..
                                        @else
                                            {{ $location->address }}
                                        @endif
                                    </label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Ukuran</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->media_size->size }}-{{ $location->side }}</label>
                                </div>
                            </div>
                            <div class="border rounded-lg p-2 bg-stone-200 ml-4">
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Jenis</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->media_category->name }}</label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Area</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->area->area }}</label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Kota</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->city->city }}</label>
                                </div>
                            </div>
                        </div>
                        <!-- Location end -->
                        <div>
                            <div class="flex justify-center border rounded-lg w-[1200px] p-2 mt-2">
                                <div class="w-[580px] p-2 border rounded-lg bg-stone-300">
                                    <div class="flex">
                                        <label class="text-xs text-stone-900 w-36">Nomor Perjanjian</label>
                                        <input type="text" id="number" name="number"
                                            value="{{ $land_agreement->number }}"
                                            class="flex text-semibold w-96 border rounded-lg px-1 outline-none @error('number') is-invalid @enderror"
                                            autofocus required>
                                        @error('number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Tanggal Perjanjian</label>
                                        <input type="date" id="published" name="published"
                                            value="{{ $land_agreement->published }}"
                                            class="flex text-semibold border rounded-lg px-1 outline-none @error('published') is-invalid @enderror"
                                            required>
                                        @error('published')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Keterangan</label>
                                        <textarea class="flex text-semibold w-96  border rounded-lg p-1 outline-none @error('notes') is-invalid @enderror"
                                            name="notes" rows="3" id="notes">{{ $land_agreement->notes }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-[580px] p-2 ml-4 border rounded-lg bg-stone-300">
                                    <div class="flex">
                                        <label class="text-xs text-stone-900 w-36">Durasi Sewa</label>
                                        <input id="duration" name="duration" onkeyup="countTotal()" type="number"
                                            min="0" value="{{ $land_agreement->duration }}"
                                            class="flex text-semibold w-20 in-out-spin-none border rounded-lg px-1 outline-none @error('duration') is-invalid @enderror"
                                            required>
                                        <label class="text-xs text-stone-900 ml-2">Tahun</label>
                                        @error('duration')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Harga Sewa</label>
                                        <input id="price" name="price" onkeyup="countTotal()"
                                            class="flex text-semibold in-out-spin-none w-32 border rounded-lg px-1 outline-none @error('price') is-invalid @enderror"
                                            type="number" min="0" value="{{ $land_agreement->price }}" required>
                                        <label class="text-xs text-stone-900 ml-2">/ Tahun</label>
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Total Harga</label>
                                        <input id="totalPrice" name="totalPrice" type="number" min="0"
                                            placeholder="0"
                                            value="{{ $land_agreement->price * $land_agreement->duration }}"
                                            class="flex text-semibold in-out-spin-none w-32 border rounded-lg px-1 outline-none"
                                            readonly>
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Tgl. Awal Perjanjian</label>
                                        <input id="start_at" name="start_at" type="date"
                                            value="{{ $land_agreement->start_at }}"
                                            class="flex text-semibold border rounded-lg px-1 outline-none @error('start_at') is-invalid @enderror"
                                            required>
                                        @error('start_at')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-36">Tgl. Akhir Perjanjian</label>
                                        <input min="0" id="end_at" name="end_at" type="date"
                                            value="{{ $land_agreement->end_at }}"
                                            class="flex text-semibold border rounded-lg px-1 outline-none @error('end_at') is-invalid @enderror"
                                            required>
                                        @error('end_at')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center border rounded-lg w-[1200px] p-2 mt-2">
                                <div class="flex border rounded-lg w-[580px] p-2 bg-stone-300">
                                    <div class="w-[275px] pl-2 py-2">
                                        <label
                                            class="text-xs font-semibold text-stone-900 flex justify-center w-full border-b">PIHAK
                                            PERTAMA</label>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">Nama</label>
                                            <input type="text" id="nameFirst" name="nameFirst"
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('nameFirst') is-invalid @enderror"
                                                value="{{ $firstParty->name }}" required>
                                            @error('nameFirst')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">Alamat</label>
                                            <textarea
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('addressFirst') is-invalid @enderror"
                                                id="addressFirst" name="addressFirst" rows="5" required>{{ $firstParty->address }}</textarea>
                                            @error('addressFirst')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">No. KTP</label>
                                            <input type="text" id="idNumberFirst" name="idNumberFirst"
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('idNumberFirst') is-invalid @enderror"
                                                value="{{ $firstParty->idNumber }}" required>
                                            @error('idNumberFirst')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">No. Hp</label>
                                            <input type="text" id="phoneFirst" name="phoneFirst"
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('phoneFirst') is-invalid @enderror"
                                                value="{{ $firstParty->phone }}" required>
                                            @error('phoneFirst')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="w-[275px] ml-2 p-2 border-l">
                                        <div class="flex justify-center items-center">
                                            <input type="text" id="oldKtpFirst" name="oldKtpFirst"
                                                value="{{ $firstParty->idCard }}" hidden>
                                            <input type="file" id="ktpFirst" name="ktpFirst"
                                                onchange="previewImageFirst(this)" hidden>
                                            <button class="flex justify-center text-xs items-center w-36 btn-primary-small"
                                                title="Chose Files" type="button"
                                                onclick="document.getElementById('ktpFirst').click()">
                                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                    <path
                                                        d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                                </svg>
                                                <span class="ml-2">Ganti KTP</span>
                                            </button>
                                        </div>
                                        @error('ktpFirst')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @error('ktpFirst.*')
                                            <div class="invalid-feedback">
                                                Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                            </div>
                                        @enderror
                                        <div class="flex m-auto w-[275px] h-max mt-2">
                                            <img class="m-auto img-preview-first flex items-center bg-white rounded-lg"
                                                src="{{ asset('storage/' . $firstParty->idCard) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex border rounded-lg w-[580px] bg-stone-300 ml-4">
                                    <div class="w-[275px] pl-2 py-2">
                                        <label
                                            class="text-xs font-semibold text-stone-900 flex justify-center w-full border-b">PIHAK
                                            KEDUA</label>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">Nama</label>
                                            <input type="text" id="nameSecond" name="nameSecond"
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('nameSecond') is-invalid @enderror"
                                                value="{{ $secondParty->name }}" required>
                                            @error('nameSecond')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">Alamat</label>
                                            <textarea
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('addressSecond') is-invalid @enderror"
                                                id="addressSecond" name="addressSecond" rows="5" required>{{ $secondParty->address }}</textarea>
                                            @error('addressSecond')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">No. KTP</label>
                                            <input
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('idNumberSecond') is-invalid @enderror"
                                                type="text" id="idNumberSecond" name="idNumberSecond"
                                                value="{{ $secondParty->idNumber }}" required>
                                            @error('idNumberSecond')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="text-xs text-stone-900 w-16">No. Hp</label>
                                            <input
                                                class="flex text-semibold w-48 border rounded-lg px-1 outline-none @error('phoneSecond') is-invalid @enderror"
                                                type="text" id="phoneSecond" name="phoneSecond"
                                                value="{{ $secondParty->phone }}" required>
                                            @error('phoneSecond')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="w-[275px] ml-2 p-2 border-l">
                                        <div class="flex justify-center items-center">
                                            <input type="text" id="oldKtpSecond" name="oldKtpSecond"
                                                value="{{ $secondParty->idCard }}" hidden>
                                            <input type="file" id="ktpSecond" name="ktpSecond"
                                                onchange="previewImageSecond(this)" hidden>
                                            <button id="btnChooseImages"
                                                class="flex justify-center text-xs items-center w-36 btn-primary-small"
                                                title="Chose Files" type="button"
                                                onclick="document.getElementById('ktpSecond').click()">
                                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                    <path
                                                        d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                                </svg>
                                                <span class="ml-2">Ganti KTP</span>
                                            </button>
                                        </div>
                                        @error('ktpSecond')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @error('ktpSecond.*')
                                            <div class="invalid-feedback">
                                                Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                            </div>
                                        @enderror
                                        <div class="flex m-auto w-[275px] h-max mt-2">
                                            <img class="m-auto img-preview-second flex items-center bg-white rounded-lg"
                                                src="{{ asset('storage/' . $secondParty->idCard) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center border rounded-lg w-[1200px] p-2 mt-4">
                            <div>
                                <!-- Alert start -->
                                @if (session()->has('success'))
                                    <div class="ml-2 flex alert-success">
                                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                        </svg>
                                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                                    </div>
                                @endif
                                @error('delete')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!-- Alert end -->
                                @include('land-agreements.edit-agreement-document')
                                @include('land-agreements.edit-certificate-document')
                                @include('land-agreements.edit-receipt-document')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- View Input end -->
            </div>
        </div>
    </form>
    <form id="formDelete" method="post" hidden>
        @method('delete')
        @csrf
    </form>
    <!-- Container end -->
    <!-- Script start -->
    <script src="/js/editlandagreement.js"></script>

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

        countTotal = () => {
            const duration = document.getElementById("duration");
            const price = document.getElementById("price");
            const totalPrice = document.getElementById("totalPrice");

            totalPrice.value = Number(price.value) * Number(duration.value);
        }
    </script>
    <!-- Script end -->
@endsection
