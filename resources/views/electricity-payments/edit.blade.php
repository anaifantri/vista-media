@extends('dashboard.layouts.main');

@section('container')
    <!-- Form Create start -->
    <form action="/workshop/electricity-payments/{{ $electricity_payment->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input name="user_id" value="{{ auth()->user()->id }}" type="text" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="p-4 w-[1000px] border rounded-lg bg-stone-700">
                <div class="flex items-center justify-center border-b p-1">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[750px]">EDIT DATA PEMBAYARAN LISTRIK
                    </h4>
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
                        <a href="/workshop/electricity-payments" class="flex items-center justify-center btn-danger mx-1">
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
                <!-- View Edit start -->
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
                                <span class="text-sm text-stone-900">Tagihan Bulan</span>
                                <input name="bill_date"
                                    class="flex w-40 text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('bill_date') is-invalid @enderror"
                                    value="{{ date('Y-m', strtotime($electricity_payment->bill_date)) }}" type="month"
                                    autofocus required>
                            </div>
                            @error('bill_date')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div>
                                <span class="text-sm text-stone-900">Tgl. Pembayaran</span>
                                <input name="payment_date"
                                    class="flex w-40 text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('payment_date') is-invalid @enderror"
                                    value="{{ $electricity_payment->payment_date }}" type="date" required>
                            </div>
                            @error('payment_date')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Nominal</span>
                                <input name="payment"
                                    class=" flex w-40 text-sm in-out-spin-none font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('payment') is-invalid @enderror"
                                    value="{{ $electricity_payment->payment }}" type="number" min="0" required>
                            </div>
                            @error('payment')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-center items-center w-[485px] border rounded-lg p-2 bg-stone-300 ml-4">
                        <div>
                            <div class="flex justify-center items-center w-full mt-1">
                                <button id="btnChooseImages" class="flex justify-center items-center w-64 btn-primary-small"
                                    title="Chose Files" type="button"
                                    onclick="document.getElementById('payment_image').click()">
                                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                    </svg>
                                    <span class="ml-2 text-xs">Ganti Bukti Pembayaran</span>
                                </button>
                            </div>
                            <div class="flex justify-center w-full mt-1">
                                <img class="m-auto img-preview flex border rounded-lg items-center max-w-[450px] max-h-[280px] mt-1"
                                    src="{{ asset('storage/' . $electricity_payment->payment_image) }}">
                            </div>
                            <input type="text" name="oldPaymentImage" value="{{ $electricity_payment->payment_image }}"
                                hidden>
                            <input accept="image/png, image/gif, image/jpeg, image/jpg"
                                class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5 @error('payment_image') is-invalid @enderror"
                                type="file" id="payment_image" name="payment_image" onchange="previewImage(this)" hidden>
                            @error('payment_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- View Edit end -->
            </div>
        </div>
    </form>
    <!-- Form Create end -->
    <script>
        function previewImage(sel) {
            const imgPreview = document.querySelector('.img-preview');

            const oFReader = new FileReader();

            oFReader.readAsDataURL(sel.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
