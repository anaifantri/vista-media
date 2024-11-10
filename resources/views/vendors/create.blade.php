@extends('dashboard.layouts.main');

@section('container')
    <form method="post" action="/marketing/vendors" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="flex">
                <div class="flex justify-center items-center w-96 border rounded-lg bg-stone-300 p-4">
                    <div class="d-flex justify-center items-center p-8">
                        <label class="flex justify-center text-sm text-stone-900 mb-2">Logo Perusahaan</label>
                        <img class="m-auto img-preview flex items-center w-36 h-36 md:w-48 md:h-48"
                            src="/img/photo_profile.png">
                        <input
                            class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5 @error('photo') is-invalid @enderror"
                            type="file" id="logo" name="logo" onchange="previewImage(this)">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="flex w-96 items-center border rounded-lg bg-stone-300 ml-4 p-4">
                    <div class="p-3 py-5 w-full">
                        <div class="flex items-center mb-3">
                            <h4 class="text-2xl font-semibold tracking-wider text-stone-900">Menambah Vendor</h4>
                        </div>
                        <div class="mt-5 w-full">
                            <div class="mt-2"><label class="text-sm text-stone-900">Nama Vendor</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                    type="text" id="name" name="name" placeholder="Nama Vendor"
                                    value="{{ old('name') }}" autofocus required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Nama Perusahaan</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('company') is-invalid @enderror"
                                    type="text" id="company" name="company" placeholder="Nama Perusahaan"
                                    value="{{ old('company') }}" required>
                                @error('company')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Alamat Perusahaan</label>
                                <textarea
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                    name="address" id="address" required placeholder="Alamat Perusahaan">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Katagori</label>
                                <select
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('vendor_category_id') is-invalid @enderror"
                                    name="vendor_category_id" id="vendor_category_id"
                                    value="{{ old('vendor_category_id') }}" required>
                                    <option value="Pilih Katagori">Pilih Katagori</option>
                                    @foreach ($vendor_categories as $category)
                                        @if ($category->id == old('vendor_category_id'))
                                            <option value="{{ $category->id }}" selected>
                                                {{ $category->name }}
                                            </option>
                                        @else
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('vendor_category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Email</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                    type="email" id="email" name="email" placeholder="Email Perusahaan"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">No. Telepon</label>
                                <input
                                    class="flex px-2 in-out-spin-none text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                    type="number" min="0" id="phone" name="phone"
                                    placeholder="No. Telepon Perusahaan" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex mt-5">
                                <button class="flex items-center justify-center btn-primary mx-1" type="submit"
                                    id="btnSubmit" name="btnSubmit">
                                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                    </svg>
                                    <span class="mx-2"> Save </span>
                                </button>
                                <a href="/marketing/vendors" class="flex items-center justify-center btn-danger mx-1">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1"> Cancel </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Script Preview Image start-->
    <script src="/js/previewimage.js"></script>
    <!-- Script Preview Image end-->
@endsection
