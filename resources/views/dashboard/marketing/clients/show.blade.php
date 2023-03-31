@extends('dashboard.layouts.main');

@section('container')
    <div class="flex relative mt-1">
        <div class="flex">
            <div class="flex justify-center items-center w-72">
                <div class="d-flex items-center p-8">
                    @if ($client->logo)
                        <img class="m-auto img-preview flex items-center w-48 h-48"
                            src="{{ asset('storage/' . $client->logo) }}">
                    @else
                        <img class="m-auto img-preview flex items-center w-48 h-48" src="/img/photo_profile.png">
                    @endif
                    <span class="flex justify-center font-semibold text-teal-900 border-b mt-3">{{ $client->name }}</span>
                    <span class="flex justify-center text-teal-700 text-sm">{{ $client->company }}</span>
                </div>
            </div>
            <div class="flex w-96">
                <div class="p-2 w-full">
                    <div class="flex items-center mb-3">
                        <h4 class="text-2xl font-semibold tracking-wider text-teal-900">Detail Klien</h4>
                    </div>
                    <div class="mt-5 w-full">
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Nama Klien</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $client->name }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Nama Perusahaan</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $client->company }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Alamat</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $client->address }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Katagori</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $client->category }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Email</label>
                            @if ($client->email)
                                <h6 class="text-base font-semibold text-teal-900">{{ $client->email }}</h6>
                            @else
                                <h6 class="text-base font-semibold text-teal-900">-</h6>
                            @endif
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">No. Telepon</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $client->phone }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Dibuat Oleh</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $client->username }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Tanggal Terdaftar</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $client->created_at->format('l, d-M-Y') }}
                            </h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Tanggal Perubahan Terakhir</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $client->updated_at->format('l, d-M-Y') }}
                            </h6>
                        </div>
                        <div class="flex mt-2">
                            <a href="/dashboard/clients" class="flex items-center justify-center btn-primary mx-1">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1"> Back to Klien </span>
                            </a>
                            <a href="/dashboard/clients/{{ $client->id }}/edit"
                                class="flex items-center justify-center btn-warning mx-1">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1"> Edit </span>
                            </a>
                            <form action="/dashboard/clients/{{ $client->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="flex items-center justify-center btn-danger mx-1"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus User {{ $client->username }} ?')">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1"> Delete </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex p-2 relative w-96 border-l">
                <div class="flex mb-3 mx-3">
                    <div class="w-48">
                        <h4 class="text-2xl font-semibold tracking-wider text-teal-900 w-48">Kontak Person</h4>
                    </div>
                    <div class="flex absolute w-48 mt-10">
                        <button class="flex items-center btn-primary mx-1" type="button" id="btnAdd" name="btnAdd">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Add Contact</span>
                        </button>
                    </div>
                </div>
                <div class="absolute items-center mt-[70px] p-2 w-96">
                    <div class="w-96 hidden border-t" id="addContact" name="addContact">
                        <form class="flex" method="post" action="/dashboard/contacts" enctype="multipart/form-data">
                            @csrf
                            <div class="flex justify-center w-44">
                                <div class="d-flex items-center p-8">
                                    <label class="flex justify-center text-sm text-teal-700 mb-2">Photo Profile</label>
                                    <img class="m-auto photo-preview rounded-full flex items-center w-20 h-20"
                                        src="/img/photo_profile.png">
                                    <input
                                        class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-40 mt-5 @error('avatar') is-invalid @enderror"
                                        type="file" id="photo" name="photo" onchange="previewPhoto()">
                                    @error('logo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2 w-52">
                                <div class="mt-1"><label class="text-sm text-teal-700">Nama</label>
                                    <input id="client_name" name="client_name"
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300"
                                        value="{{ $client->id }}" type="hidden">
                                    <input
                                        class="flex px-2 text-sm font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                        type="text" id="name" name="name" placeholder="Nama"
                                        value="{{ old('name') }}" autofocus required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-1"><label class="text-sm text-teal-700">Email</label>
                                    <input
                                        class="flex px-2 text-sm font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                        type="text" id="email" name="email" placeholder="Email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="border-b mt-1"><label class="text-sm text-teal-700">No. Handphone</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                        type="text" id="phone" name="phone" placeholder="No. Hp"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="border-b mt-1"><label class="text-sm text-teal-700">Jabatan</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('position') is-invalid @enderror"
                                        type="text" id="position" name="position" placeholder="Jabatan"
                                        value="{{ old('position') }}">
                                    @error('position')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="flex mt-2">
                                    <button class="flex items-center justify-center btn-primary mx-1" type="submit"
                                        id="btnSubmit" name="btnSubmit">
                                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                        </svg>
                                        <span class="mx-2"> Save </span>
                                    </button>
                                    <a href="/dashboard/clients/{{ $client->id }}"
                                        class="flex items-center justify-center btn-danger mx-1" id="btnCancel"
                                        name="btnCancel">
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
                        </form>
                    </div>
                    @foreach ($contacts as $contact)
                        {{-- @if ($contact->client_name === $client->name) --}}
                        <div class="flex w-96 border-t">
                            <h6 class="flex absolute text-sm mx-3 mt-3 font-semibold text-teal-900">
                                {{ $loop->iteration }}
                            </h6>
                            <div class="flex justify-center w-44">
                                <div class="flex p-2">
                                    @if ($contact->photo)
                                        <img class="m-auto rounded-full img-preview flex items-center w-28 h-28"
                                            src="{{ asset('storage/' . $contact->photo) }}">
                                    @else
                                        <img class="m-auto rounded-full img-preview flex items-center w-28 h-28"
                                            src="/img/photo_profile.png">
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2 w-52">
                                <div class="border-b mt-1"><label class="text-sm text-teal-700">Nama</label>
                                    <h6 class="text-sm font-semibold text-teal-900">{{ $contact->name }}</h6>
                                </div>
                                <div class="border-b mt-1"><label class="text-sm text-teal-700">Email</label>
                                    <h6 class="text-sm font-semibold text-teal-900">{{ $contact->email }}</h6>
                                </div>
                                <div class="border-b mt-1"><label class="text-sm text-teal-700">No. Handphone</label>
                                    <h6 class="text-sm font-semibold text-teal-900">{{ $contact->phone }}</h6>
                                </div>
                                <div class="border-b mt-1"><label class="text-sm text-teal-700">Jabatan</label>
                                    <h6 class="text-sm font-semibold text-teal-900">{{ $contact->position }}</h6>
                                </div>
                                <div class="flex mt-2">
                                    <a href="/dashboard/clients/{{ $contact->id }}/edit"
                                        class="flex items-center justify-center btn-warning mx-1">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1"> Edit </span>
                                    </a>
                                    <form action="/dashboard/contacts/{{ $contact->id }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="flex items-center justify-center btn-danger mx-1"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus Contact {{ $contact->name }} ?')">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="mx-1"> Delete </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- @endif --}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Script Preview Photo start-->
    <script>
        function previewPhoto() {
            const photo = document.querySelector('#photo');
            const photoPreview = document.querySelector('.photo-preview');

            // imgPreview.style.display = 'block';

            const oFReader = new FileReader();

            oFReader.readAsDataURL(photo.files[0]);

            oFReader.onload = function(oFREvent) {
                photoPreview.src = oFREvent.target.result;
            }
        }
    </script>
    <!-- Script Preview Photo end-->
    <script>
        const btnAdd = document.querySelector('#btnAdd');
        const btnCancel = document.querySelector('#btnCancel');
        const addContact = document.querySelector('#addContact');

        btnAdd.addEventListener('click', function() {
            addContact.classList.remove('hidden');
            addContact.classList.add('flex');
        });
        btnCancel.addEventListener('click', function() {
            addContact.classList.add('hidden');
            addContact.classList.remove('flex');
        });
    </script>
@endsection
