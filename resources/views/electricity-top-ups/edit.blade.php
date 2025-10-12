@extends('dashboard.layouts.main');

@section('container')
    <!-- Form Create start -->
    <form action="/workshop/electricity-top-ups/{{ $electricity_top_up->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input name="user_id" value="{{ auth()->user()->id }}" type="text" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="p-4 w-[1000px] border rounded-lg bg-stone-700">
                <div class="flex items-center justify-center border-b p-1">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[750px]">EDIT DATA PENGISIAN PULSA
                        LISTRIK</h4>
                    <div class="flex justify-end w-full">
                        <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                            name="btnSubmit">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                            </svg>
                            <span class="mx-2"> Save </span>
                        </button>
                        <a href="/workshop/electricity-top-ups" class="flex items-center justify-center btn-danger mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Cancel </span>
                        </a>
                    </div>
                </div>
                <!-- View Create start -->
                <div class="flex w-full justify-center mt-4">
                    <div class="w-[485px] border rounded-lg p-2 bg-stone-200">
                        <div>
                            <label class="text-sm text-stone-900">ID Pelanggan</label>
                            <label
                                class="flex w-[310px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $electrical_power->id_number }}</label>
                        </div>
                        <div>
                            <label class="text-sm text-stone-900">Nama</label>
                            <label
                                class="flex w-[310px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $electrical_power->name }}</label>
                        </div>
                        <div>
                            <label class="text-sm text-stone-900">Daya</label>
                            <label
                                class="flex w-[310px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $electrical_power->power }}</label>
                        </div>
                    </div>
                    <div class="w-[485px] border rounded-lg p-2 bg-stone-200 ml-4">
                        <div>
                            <div class="flex items-center text-md text-stone-900 font-semibold border-b border-stone-900">
                                Daftar Lokasi Yang Menggunakan
                            </div>
                            @foreach ($electrical_power->locations as $location)
                                <div>
                                    <label class="text-sm text-stone-900">{{ $loop->iteration }}.</label>
                                    <label class="ml-2 text-sm text-stone-900">{{ $location->code }} |
                                        {{ $location->address }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex w-full justify-center mt-4">
                    <div class="flex w-[485px] border rounded-lg p-2 bg-stone-300">
                        <div>
                            <div>
                                <span class="text-sm text-stone-900">Tgl. Pengisian</span>
                                <input name="topup_date"
                                    class="flex w-[200px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('topup_date') is-invalid @enderror"
                                    value="{{ $electricity_top_up->topup_date }}" type="date" autofocus required>
                            </div>
                            @error('topup_date')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Nominal</span>
                                <input name="top_up_nominal"
                                    class=" flex w-[200px] text-sm in-out-spin-none font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('top_up_nominal') is-invalid @enderror"
                                    value="{{ $electricity_top_up->top_up_nominal }}" type="number" min="0"
                                    placeholder="Input Nominal" required>
                            </div>
                            @error('top_up_nominal')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Jumlah Kwh Pembelian</span>
                                <input id="kwh_qty" name="kwh_qty" onkeyup="countLastKwh()" step="any"
                                    class=" flex w-[200px] text-sm in-out-spin-none font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('kwh_qty') is-invalid @enderror"
                                    value="{{ $electricity_top_up->kwh_qty }}" type="number" min="0"
                                    placeholder="Input Jml. Kwh" required>
                            </div>
                            @error('kwh_qty')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <label class="text-sm text-stone-900">Kwh Sebelum Pengisian</label>
                                <input id="remaining_kwh_qty" name="remaining_kwh_qty" onkeyup="countLastKwh()"
                                    step="any"
                                    class="flex w-[200px] p-1 text-sm in-out-spin-none font-semibold text-stone-900 border rounded-lg px-1 outline-none @error('remaining_kwh_qty') is-invalid @enderror"
                                    value="{{ $electricity_top_up->remaining_kwh_qty }}" type="number" min="0"
                                    placeholder="0">
                            </div>
                            @error('remaining_kwh_qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <label class="text-sm text-stone-900">Kwh Setelah Pengisian</label>
                                <input id="last_kwh_qty" name="last_kwh_qty" step="any"
                                    class="flex w-[200px] p-1 text-sm in-out-spin-none font-semibold text-stone-900 border rounded-lg px-1 outline-none @error('last_kwh_qty') is-invalid @enderror"
                                    value="{{ $electricity_top_up->last_kwh_qty }}" type="number" min="0"
                                    placeholder="0" readonly>
                            </div>
                            @error('last_kwh_qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="ml-2">
                            <div class="w-[250px]">
                                <div class="flex justify-center items-center w-full">
                                    <label class="text-sm text-stone-900">Foto Kwh Sebelum Pengisian</label>
                                </div>
                                @if ($electricity_top_up->remaining_image)
                                    <img class="m-auto img-preview-remaining flex border rounded-lg items-center w-[200px] h-[100px] mt-1"
                                        src="{{ asset('storage/' . $electricity_top_up->remaining_image) }}">
                                @else
                                    <img
                                        class="m-auto img-preview-remaining flex border rounded-lg items-center w-[200px] h-[100px] mt-1">
                                @endif
                                <div class="flex justify-center w-[225px] mt-1">
                                    <button id="btnChooseImages"
                                        class="flex justify-center items-center w-44 btn-primary-small"
                                        title="Chose Files" type="button"
                                        onclick="document.getElementById('remaining_image').click()">
                                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                        </svg>
                                        @if ($electricity_top_up->remaining_image)
                                            <span class="ml-2 text-xs">Ganti Foto</span>
                                        @else
                                            <span class="ml-2 text-xs">Upload Foto</span>
                                        @endif
                                    </button>
                                </div>
                                @if ($electricity_top_up->remaining_image)
                                    <input type="text" name="oldRemainingImage"
                                        value="{{ $electricity_top_up->remaining_image }}" hidden>
                                @else
                                    <input type="text" name="oldRemainingImage" hidden>
                                @endif
                                <input accept="image/png, image/gif, image/jpeg, image/jpg"
                                    class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5 @error('remaining_image') is-invalid @enderror"
                                    type="file" id="remaining_image" name="remaining_image"
                                    onchange="previewImage(this, 'remaining')" hidden>
                                @error('remaining_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-4 w-[250px]">
                                <div class="flex justify-center items-center ww-full">
                                    <label class="text-sm text-stone-900">Foto Kwh Setelah Pengisian</label>
                                </div>
                                @if ($electricity_top_up->last_image)
                                    <img class="m-auto img-preview-last flex border rounded-lg items-center w-[200px] h-[100px] mt-1"
                                        src="{{ asset('storage/' . $electricity_top_up->last_image) }}">
                                @else
                                    <img
                                        class="m-auto img-preview-last flex border rounded-lg items-center w-[200px] h-[100px] mt-1">
                                @endif
                                <div class="flex justify-center w-[225px] mt-1">
                                    <button id="btnChooseImages"
                                        class="flex justify-center items-center w-44 btn-primary-small"
                                        title="Chose Files" type="button"
                                        onclick="document.getElementById('last_image').click()">
                                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                        </svg>
                                        @if ($electricity_top_up->last_image)
                                            <span class="ml-2 text-xs">Ganti Foto</span>
                                        @else
                                            <span class="ml-2 text-xs">Upload Foto</span>
                                        @endif
                                    </button>
                                </div>
                                @if ($electricity_top_up->last_image)
                                    <input type="text" name="oldLastImage"
                                        value="{{ $electricity_top_up->last_image }}" hidden>
                                @else
                                    <input type="text" name="oldLastImage" hidden>
                                @endif
                                <input accept="image/png, image/gif, image/jpeg, image/jpg"
                                    class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5 @error('last_image') is-invalid @enderror"
                                    type="file" id="last_image" name="last_image"
                                    onchange="previewImage(this, 'last')" hidden>
                                @error('last_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center w-[485px] border rounded-lg p-2 bg-stone-300 ml-4">
                        <div>
                            <div class="flex justify-center items-center w-full">
                                <label class="text-sm text-stone-900">Foto Nota Pembelian</label>
                            </div>
                            <div class="flex justify-center w-full mt-1">
                                <img class="m-auto img-preview-receipt flex border rounded-lg items-center max-w-[450px] max-h-[280px] mt-1"
                                    src="{{ asset('storage/' . $electricity_top_up->receipt_image) }}">
                            </div>
                            <div class="flex justify-center items-center w-full mt-2">
                                <button id="btnChooseImages"
                                    class="flex justify-center items-center w-64 btn-primary-small" title="Chose Files"
                                    type="button" onclick="document.getElementById('receipt_image').click()">
                                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                    </svg>
                                    <span class="ml-2 text-xs">Ganti Foto Nota Pembelian</span>
                                </button>
                            </div>
                            <input type="text" name="oldReceiptImage"
                                value="{{ $electricity_top_up->receipt_image }}" hidden>
                            <input accept="image/png, image/gif, image/jpeg, image/jpg"
                                class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5 @error('receipt_image') is-invalid @enderror"
                                type="file" id="receipt_image" name="receipt_image"
                                onchange="previewImage(this, 'receipt')" hidden>
                            @error('receipt_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- View Create end -->
            </div>
        </div>
    </form>
    <!-- Form Create end -->
    <script>
        function previewImage(sel, type) {
            var imgPreview = "";
            console.log(type);
            if (type == "receipt") {
                imgPreview = document.querySelector('.img-preview-receipt');
            } else if (type == "remaining") {
                imgPreview = document.querySelector('.img-preview-remaining');
            } else if (type == "last") {
                imgPreview = document.querySelector('.img-preview-last');
            }

            const oFReader = new FileReader();

            oFReader.readAsDataURL(sel.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function countLastKwh() {
            document.getElementById("last_kwh_qty").value = Number(document.getElementById("kwh_qty").value) + Number(
                document.getElementById("remaining_kwh_qty").value);
        }
    </script>
@endsection
