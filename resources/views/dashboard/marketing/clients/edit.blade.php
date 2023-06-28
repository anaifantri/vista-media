@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center mt-10">
        <div class="md:flex">
            <form class="md:flex" method="post" action="/dashboard/marketing/clients/{{ $client->id }}"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="flex justify-center items-center w-60 md:w-72">
                    <div class="d-flex justify-center items-center p-8">
                        <label class="flex justify-center text-sm text-teal-700 mb-2">Photo Profile</label>
                        <input type="hidden" name="oldLogo" value="{{ $client->logo }}">
                        @if ($client->logo)
                            <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                                src="{{ asset('storage/' . $client->logo) }}">
                        @else
                            <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                                src="/img/photo_profile.png">
                        @endif
                        <input
                            class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-60 md:w-72 mt-5 @error('logo') is-invalid @enderror"
                            type="file" id="logo" name="logo" onchange="previewImage()">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="flex w-72 md:w-96 items-center">
                    <div class="p-3 py-3 w-full">
                        <div class="flex items-center mb-2">
                            <h4 class="text-2xl font-semibold tracking-wider text-teal-900">Edit Klien</h4>
                        </div>
                        <div class="mt-5 w-full">
                            <div class="mt-2"><label class="text-sm text-teal-700">Nama Klien</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                    type="text" id="name" name="name" value="{{ $client->name }}" autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">Nama Perusahaan</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('company') is-invalid @enderror"
                                    type="text" id="company" name="company" value="{{ $client->company }}">
                                @error('company')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">Alamat Perusahaan</label>
                                <textarea
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                    name="address" id="address" required placeholder="Alamat Perusahaan">{{ $client->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">Katagori</label>
                                @php
                                    $number = 0;
                                    $categories = ['Pilih Katagori', 'Rokok', 'Operator', 'Cellular', 'Hotel', 'Restoran', 'Club', 'Minuman', 'Bank', 'Startup', 'Lainnya'];
                                @endphp
                                <select
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('client_category_id') is-invalid @enderror"
                                    name="client_category_id" id="client_category_id"
                                    value="{{ $client->client_category_id }}">
                                    <option value="Pilih Katagori">Pilih Katagori</option>
                                    @foreach ($client_categories as $client_category)
                                        @if ($client->client_category_id == $client_category->id)
                                            <option value="{{ $client_category->id }}" selected>
                                                {{ $client_category->name }}
                                            </option>
                                        @else
                                            <option value="{{ $client_category->id }}">
                                                {{ $client_category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('client_category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">Email</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                    type="text" id="email" name="email" value="{{ $client->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">No. Telepon</label>
                                <input
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                    type="text" id="phone" name="phone" value="{{ $client->phone }}">
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
@endsection
