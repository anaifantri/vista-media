@extends('dashboard.layouts.main');

@section('container')
    <!-- Create New Quotatin start -->
    <form id="formCreate" name="formCreate" class="flex justify-center" action="/dashboard/marketing/quotations" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center">
            <div class="mt-10">
                <!-- Title Create New Quotatin start -->
                <div class="flex border-b">
                    <h1 class="text-xl text-cyan-800 font-bold tracking-wider">MEMBUAT PENAWAWARAN</h1>
                </div>
                <!-- Title Create New Quotatin end -->
                <!-- Form Create New Quotatin start -->
                <div class="flex">
                    <input id="number" name="number" type="text" value="{{ old('number') }}" hidden readonly>
                    <input id="attachment" name="attachment" type="text" value="{{ old('attachment') }}" hidden readonly>
                    <input id="subject" name="subject" type="text" value="{{ old('subject') }}" hidden readonly>
                    <input id="body_top" name="body_top" type="text" value="{{ old('body_top') }}" hidden readonly>
                    <input id="products" name="products" type="text" value="{{ old('products') }}" hidden readonly>
                    <input id="note" name="note" type="text" value="{{ old('note') }}" hidden readonly>
                    <input id="body_end" name="body_end" type="text" value="{{ old('body_end') }}" hidden readonly>
                    <input id="price_type" name="price_type" type="text" value="{{ old('price_type') }}" hidden readonly>
                    <div class="flex justify-center">
                        <div class="flex mx-1">
                            <div class="">
                                <div class="mt-1">
                                    <div class="flex mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Katagori</label>
                                    </div>
                                    <div class="mt-1">
                                        <input id="quotationCategory" name="quotationCategory" type="text"
                                            value="{{ old('quotationCategory') }}" hidden>
                                        <select id="quotation_category_id" name="quotation_category_id"
                                            class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('quotation_category_id') is-invalid @enderror"
                                            type="text" value="{{ old('quotation_category_id') }}"
                                            onchange="getCategory(this)">
                                            <option value="Pilih Katagori">Pilih Katagori</option>
                                            @foreach ($quotation_categories as $quotation_category)
                                                @if (old('quotation_category_id') == $quotation_category->id)
                                                    <option value="{{ $quotation_category->id }}" selected>
                                                        {{ $quotation_category->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $quotation_category->id }}">
                                                        {{ $quotation_category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('quotation_category_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Area</label>
                                        {{-- <input id="area" name="area" type="text" hidden
                                            value="{{ old('area') }}"> --}}
                                        <select id="area_id" name="area_id"
                                            class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('area_id') is-invalid @enderror"
                                            type="text" value="{{ old('area_id') }}" onchange="getArea(this)" disabled>
                                            <option value="Pilih Area">Pilih Area</option>
                                            @foreach ($areas as $area)
                                                @if (old('area_id') == $area->id)
                                                    <option value="{{ $area->id }}" selected>{{ $area->area }}
                                                    </option>
                                                @else
                                                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kota</label>
                                        <select id="city_id" name="city_id"
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 w-36 xl:w-48 2xl:w-56  border rounded-lg p-1 outline-teal-300 @error('city') is-invalid @enderror"
                                            type="text" value="{{ old('city_id') }}" disabled onchange="getCity(this)">
                                        </select>
                                        @error('city_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="flex mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Klien</label>
                                    </div>
                                    <div class="mt-1">
                                        <select id="client_id" name="client_id"
                                            class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('client_id') is-invalid @enderror"
                                            type="text" value="{{ old('client_id') }}" disabled
                                            onchange="getClient(this)">
                                            <option value="Pilih Klien">Pilih Klien</option>
                                            @foreach ($clients as $client)
                                                @if (old('client_id') == $client->id)
                                                    <option value="{{ $client->id }}" selected>
                                                        @if ($client->company != '')
                                                            {{ $client->company }}
                                                        @else
                                                            {{ $client->name }}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="{{ $client->id }}">
                                                        @if ($client->company != '')
                                                            {{ $client->company }}
                                                        @else
                                                            {{ $client->name }}
                                                        @endif
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('client_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kontak</label>
                                        <select id="contact_id" name="contact_id"
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 w-36 xl:w-48 2xl:w-56  border rounded-lg p-1 outline-teal-300 @error('contact_id') is-invalid @enderror"
                                            type="text" disabled value="{{ old('contact_id') }}"
                                            onchange="getContact(this)">
                                        </select>
                                        @error('contact_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex justify-start mt-5">
                                    <button id="btnPreview" name="btnPreview"
                                        class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-disabled"
                                        type="button" disabled>
                                        <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                                        </svg>
                                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Preview</span>
                                    </button>
                                    <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                                        href="/dashboard/marketing/quotations">
                                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                        </svg>
                                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                                    </a>
                                </div>
                                <!-- Create New Quotatin end -->
                            </div>
                        </div>
                    </div>
                    @include('dashboard.marketing.quotations.billboard')

                    @include('dashboard.marketing.quotations.videotron')

                    <!-- Form Create New Quotatin end -->
                </div>
            </div>
        </div>
        <!-- Form Create New Quotatin end -->
        @include('dashboard.marketing.quotations.add-locations')

        @include('dashboard.marketing.quotations.billboard-preview')
    </form>

    <!-- Script start -->
    <script src="/js/createquotation.js"></script>
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <!-- Script end -->
@endsection
