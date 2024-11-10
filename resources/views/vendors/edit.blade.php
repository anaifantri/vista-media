@extends('dashboard.layouts.main');

@section('container')
    <form method="post" action="/marketing/vendors/{{ $vendor->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="flex">
                <div class="flex justify-center items-center w-96 bg-stone-300 p-4 border rounded-lg">
                    <div class="d-flex justify-center items-center p-8">
                        <label class="flex justify-center text-sm text-stone-900 mb-2">Logo Vendor</label>
                        <input type="hidden" name="oldLogo" value="{{ $vendor->logo }}">
                        @if ($vendor->logo)
                            <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                                src="{{ asset('storage/' . $vendor->logo) }}">
                        @else
                            <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                                src="/img/photo_profile.png">
                        @endif
                        <input
                            class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5 @error('logo') is-invalid @enderror"
                            type="file" id="logo" name="logo" onchange="previewImage()">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="flex w-96 bg-stone-300 p-4 border rounded-lg items-center ml-4">
                    <div class="p-3 py-3 w-full">
                        <div class="flex items-center border-b w-full">
                            <h4 class="text-2xl font-semibold tracking-wider text-stone-900">EDIT DATA VENDOR</h4>
                        </div>
                        <div class="mt-5 w-full">
                            <div class="mt-2"><label class="text-sm text-stone-900">Nama Vendor</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                    type="text" id="name" name="name" value="{{ $vendor->name }}" autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Nama Perusahaan</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('company') is-invalid @enderror"
                                    type="text" id="company" name="company" value="{{ $vendor->company }}">
                                @error('company')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Alamat Perusahaan</label>
                                <textarea
                                    class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                    name="address" id="address" required placeholder="Alamat Perusahaan">{{ $vendor->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Katagori</label>
                                <select
                                    class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('vendor_category_id') is-invalid @enderror"
                                    name="vendor_category_id" id="vendor_category_id"
                                    value="{{ $vendor->vendor_category_id }}">
                                    @foreach ($vendor_categories as $category)
                                        @if ($category->id == $vendor->vendor_category_id)
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
                                    class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                    type="text" id="email" name="email" value="{{ $vendor->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">No. Telepon</label>
                                <input
                                    class="flex px-2 in-out-spin-none text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                    type="number" min="0" id="phone" name="phone"
                                    value="{{ $vendor->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex mt-5">
                                <button class="flex items-center justify-center btn-primary mx-1" type="submit">
                                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                    </svg>
                                    <span class="mx-1"> Update </span>
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
    <script>
        function previewImage() {
            const logo = document.querySelector('#logo');
            const imgPreview = document.querySelector('.img-preview');

            // imgPreview.style.display = 'block';

            const oFReader = new FileReader();

            oFReader.readAsDataURL(logo.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
    <!-- Script Preview Image end-->
@endsection
