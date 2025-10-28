@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;

        $itemDescriptions = ['Pemasangan Gambar', 'Lampu Penerangan', 'Halangan', 'Lainnya'];
        if (old('descriptions')) {
            $descriptions = json_decode(old('descriptions'));
        } else {
            $descriptions = [];
            $i = 0;
            foreach ($itemDescriptions as $item) {
                $description = new stdClass();
                $description->id = $i;
                $description->name = $item;
                $description->checked = false;
                array_push($descriptions, $description);
                $i++;
            }
        }

        $product = json_decode($sale->product);
        $client = json_decode($sale->quotation->clients);
    @endphp
    <!-- Form Create start -->
    <form id="formCreate" action="/workshop/complaints" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
        <input type="text" name="location_id" value="{{ $product->id }}" hidden>
        <input type="text" name="created_by" id="created_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="updated_by" id="updated_by" value="{{ json_encode($created_by) }}" hidden>
        @if (old('descriptions'))
            <input type="text" name="descriptions" id="inputDescriptions" value="{{ old('descriptions') }}" hidden>
        @else
            <input type="text" name="descriptions" id="inputDescriptions" value="{{ json_encode($descriptions) }}"
                hidden>
        @endif
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="p-4 w-[1000px] border rounded-lg bg-stone-700">
                <div class="flex items-center justify-center border-b p-1">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[950px]">TAMBAH DATA KOMPLAIN DARI
                        KLIEN</h4>
                    <div class="flex justify-end w-full">
                        <a href="/workshop/complaints/create" class="flex items-center justify-center btn-danger mx-1">
                            <svg class="fill-current w-5 rotate-180" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1"> Back </span>
                        </a>
                        <button class="flex items-center justify-center btn-primary mx-1" type="button"
                            onclick="cbDescriptionCheck()">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                            </svg>
                            <span class="mx-2"> Save </span>
                        </button>
                    </div>
                </div>
                <!-- View Create start -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="border rounded-lg p-2 bg-stone-200 w-full">
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Kode Lokasi</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ $product->code }}-{{ $product->city_code }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Lokasi</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ $product->address }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Ukuran</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ $product->size }}-{{ $product->orientation }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Nama Klien</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ $client->company }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900 w-24">Periode Kontrak</label>
                            <label
                                class="flex w-[450px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg px-2 py-1">
                                {{ date('d', strtotime($sale->start_at)) }}-{{ $bulan[(int) date('m', strtotime($sale->start_at))] }}-{{ date('Y', strtotime($sale->start_at)) }}
                                s.d.
                                {{ date('d', strtotime($sale->end_at)) }}-{{ $bulan[(int) date('m', strtotime($sale->end_at))] }}-{{ date('Y', strtotime($sale->end_at)) }}
                            </label>
                        </div>
                    </div>
                    <div class="border rounded-lg p-2 bg-stone-300">
                        <div>
                            <div>
                                <span class="text-sm text-stone-900">Tgl. Komplain</span>
                                <input name="complaint_date"
                                    class="flex w-[150px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('complaint_date') is-invalid @enderror"
                                    value="{{ old('complaint_date') }}" type="date" required>
                            </div>
                            @error('complaint_date')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Deskripsi</span>
                                <div class="grid grid-cols-2 gap-2 p-1">
                                    @foreach ($descriptions as $description)
                                        <div class="flex">
                                            @if ($description->checked == true)
                                                <input id="cbDescription" type="checkbox" value="{{ $description->id }}"
                                                    class="outline-none" onchange="descriptionCheck(this)" checked>
                                            @else
                                                <input id="cbDescription" type="checkbox" value="{{ $description->id }}"
                                                    class="outline-none" onchange="descriptionCheck(this)">
                                            @endif
                                            <span class="ml-2 text-sm font-semibold">{{ $description->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('descriptions')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Catatan</span>
                                <textarea
                                    class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('notes') is-invalid @enderror"
                                    name="notes" rows="5" placeholder="Input Catatan" required>{{ old('notes') }}</textarea>
                            </div>
                            @error('notes')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- View Create end -->
                <!-- New Foto start -->
                <div class="flex justify-center w-full mt-2">
                    <div class="flex justify-start border rounded-lg w-[960px] p-4">
                        <div class="w-[925px]">
                            <div class="flex w-full justify-center">
                                <input id="images" name="images[]" type="file"
                                    accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)" multiple
                                    hidden>
                                <button id="btnChooseImages"
                                    class="flex justify-center items-center w-44 btn-primary-small" title="Chose Files"
                                    type="button" onclick="document.getElementById('images').click()">
                                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                    </svg>
                                    <span class="ml-2">Pilih Foto</span>
                                </button>
                            </div>
                            <div class="flex items-center mt-2 w-full justify-center border rounded-lg">
                                <label class="text-sm text-stone-100 w-20">Jumlah File</label>
                                <label class="text-sm text-stone-100 ml-2">:</label>
                                <label id="numberImagesFile" class="text-sm text-stone-100 ml-2"> 0 file yang
                                    dipilih</label>
                            </div>
                            @error('images')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('images.*')
                                <div class="invalid-feedback">
                                    Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                </div>
                            @enderror
                            <figure class="flex w-[925px] justify-center overflow-x-auto border-b-2 border-stone-100 mt-2"
                                id="figureImages">

                            </figure>
                            <div class="relative m-auto w-[925px] h-max mt-2">
                                <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button" onclick="prevButtonAction()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        onclick="nextButtonAction()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="slidesPreview" class="mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Foto end -->
            </div>
        </div>
    </form>
    <!-- Form Create end -->
    <!-- Script start -->
    <script src="/js/addinstallationphotos.js"></script>
    <script>
        let getDescriptions = @json($descriptions);
        const inputDescriptions = document.getElementById("inputDescriptions");
        const formCreate = document.getElementById("formCreate");

        descriptionCheck = (sel) => {
            if (sel.checked == true) {
                getDescriptions[sel.value].checked = true;
            } else {
                getDescriptions[sel.value].checked = false;
            }
            inputDescriptions.value = JSON.stringify(getDescriptions);
        }

        cbDescriptionCheck = () => {
            const cbDescription = document.querySelectorAll("[id=cbDescription]");
            var totalDescription = 0;
            for (let index = 0; index < cbDescription.length; index++) {
                if (cbDescription[index].checked == true) {
                    totalDescription++;
                }
            }
            if (totalDescription == 0) {
                alert("Silahkan pilih minimal 1 item deskripsi..!!")
            } else {
                formCreate.submit();
            }
        }
    </script>
    <!-- Script end -->
@endsection
