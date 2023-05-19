@extends('dashboard.layouts.main');

@section('container')
    <div class="flex relative mt-5 items-center">
        <div class="flex">
            <form class="flex" method="post" action="/dashboard/marketing/clients" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-center items-center w-72">
                    <div class="d-flex items-center p-8">
                        <label class="flex justify-center text-sm text-teal-700 mb-2">Logo Perusahaan</label>
                        <img class="m-auto img-preview flex items-center w-48 h-48" src="/img/photo_profile.png">
                        <input
                            class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5 @error('photo') is-invalid @enderror"
                            type="file" id="logo" name="logo" onchange="previewImage()">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="flex w-96 items-center">
                    <div class="p-3 py-5 w-full">
                        <div class="flex items-center mb-3">
                            <h4 class="text-2xl font-semibold tracking-wider text-teal-900">Create Client</h4>
                        </div>
                        <div class="mt-5 w-full">
                            <div class="mt-2"><label class="text-sm text-teal-700">Nama Klien</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                    type="text" id="name" name="name" placeholder="Nama Klien"
                                    value="{{ old('name') }}" autofocus required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">Nama Perusahaan</label>
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
                            <div class="mt-2"><label class="text-sm text-teal-700">Alamat Perusahaan</label>
                                <textarea
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                    name="address" id="address" required placeholder="Alamat Perusahaan">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">Katagori</label>
                                <select
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('category') is-invalid @enderror"
                                    name="category" id="category" value="{{ old('category') }}" required>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">Email</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                    type="text" id="email" name="email" placeholder="Email Perusahaan"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">No. Telepon</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                    type="text" id="phone" name="phone" placeholder="No. Telepon Perusahaan"
                                    value="{{ old('phone') }}">
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
                                <a href="/dashboard/marketing/clients"
                                    class="flex items-center justify-center btn-danger mx-1">
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
            </form>
        </div>
    </div>

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
    <!-- Script Set Category start-->
    <script>
        const category = document.getElementById('category');
        const option = [];
        const arraycategory = ['Rokok', 'Operator Cellular', 'Hotel', 'Restoran', 'Club Malam', 'minuman', 'Bank',
            'Startup', 'Lainnya'
        ];

        option[0] = document.createElement('option');
        option[0].appendChild(document.createTextNode(['Pilih Katagori']));
        option[0].setAttribute('value', 'Pilih Katagori');
        category.appendChild(option[0]);

        for (i = 0; i < arraycategory.length; i++) {
            option[i + 1] = document.createElement('option');
            option[i + 1].appendChild(document.createTextNode(arraycategory[i]));
            option[i + 1].setAttribute('value', arraycategory[i]);
            category.appendChild(option[i + 1]);
        }
    </script>
    <!-- Script Set Category end-->
@endsection
