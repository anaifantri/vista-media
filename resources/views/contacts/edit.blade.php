@extends('dashboard.layouts.main');

@section('container')
    <!-- Edit Kontak Person Start -->
    <div class="w-full flex justify-center mt-4" id="editContact" name="editContact">
        <div class="w-[600px] h-[400px] bg-white rounded-xl border flex mt-8">
            <div class="flex absolute w-[600px] p-1">
                <h4 class="p-2 text-lg text-center font-semibold tracking-wider text-teal-900 border-b w-full rounded-lg">
                    Edit
                    Kontak Person
                </h4>
            </div>
            <form class="flex" method="post" action="/marketing/contacts/{{ $contact->id }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="flex justify-center w-[290px] bg-white p-1 mt-12">
                    <div class="d-flex items-center p-3">
                        <input type="hidden" name="oldPhoto" value="{{ $contact->photo }}">
                        @if ($contact->photo)
                            <img class="m-auto img-preview rounded-full flex items-center w-40"
                                src="{{ asset('storage/' . $contact->photo) }}">
                        @else
                            <img class="m-auto img-preview rounded-full flex items-center w-40"
                                src="/img/photo_profile.png">
                        @endif
                        <label class="flex justify-center text-sm text-teal-700 mt-2">Photo Profile</label>
                        <input
                            class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-full mt-5 @error('avatar') is-invalid @enderror"
                            type="file" id="photo" name="photo" onchange="previewImage(this)">
                        @error('photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-12 w-[290px] bg-white p-1">
                    <div class="mt-1"><label class="text-sm text-teal-700">Nama Client</label>
                        <input id="client_name" name="client_name" title="Terisi otomatis"
                            class="flex px-2 text-sm font-semibold text-slate-400 w-full
                            border rounded-lg p-1 outline-none"
                            type="text" value="{{ $contact->client->name }}" required readonly>
                        <input id="client_id" name="client_id" value="{{ $contact->client_id }}" type="hidden">
                    </div>
                    <div class="mt-1"><label class="text-sm text-teal-700">Nama</label>
                        <input
                            class="flex px-2 text-sm font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                            type="text" id="name" name="name" placeholder="Input Nama"
                            value="{{ $contact->name }}" autofocus required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-1 items-center">
                        <label class="text-sm text-teal-700 w-[150px]">Jenis Kelamin</label>
                        @php
                            $genders = ['Male', 'Female'];
                        @endphp
                        <select
                            class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('gender') is-invalid @enderror"
                            name="gender" value="{{ $contact->gender }}" required>
                            @foreach ($genders as $gender)
                                @if ($contact->gender == $gender)
                                    <option value="{{ $gender }}" selected>
                                        @if ($gender == 'Male')
                                            Laki-Laki
                                        @elseif ($gender == 'Female')
                                            Perempuan
                                        @endif
                                    </option>
                                @else
                                    <option value="{{ $gender }}">
                                        @if ($gender == 'Male')
                                            Laki-Laki
                                        @elseif ($gender == 'Female')
                                            Perempuan
                                        @endif
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-1"><label class="text-sm text-teal-700">Email</label>
                        <input
                            class="flex px-2 text-sm font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                            type="text" id="email" name="email" placeholder="Input Email"
                            value="{{ $contact->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="border-b mt-1"><label class="text-sm text-teal-700">No. Handphone</label>
                        <input
                            class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                            type="text" id="phone" name="phone" placeholder="Input No. Hp"
                            value="{{ $contact->phone }}">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-1"><label class="text-sm text-teal-700">Jabatan</label>
                        <input
                            class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300"
                            type="text" id="position" name="position" placeholder="Input Jabatan"
                            value="{{ $contact->position }}">
                    </div>
                    <div class="flex mt-5">
                        <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="editSubmit"
                            name="editSubmit">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                            </svg>
                            <span class="mx-2"> Update </span>
                        </button>
                        <a href="/marketing/clients/{{ $contact->client_id }}"
                            class="flex items-center justify-center btn-danger mx-1" id="editCancel" name="editCancel">
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
            </form>
        </div>
    </div>
    <!-- Edit Kontak Person End -->

    <!-- Script Preview Image start-->
    <script src="/js/previewimage.js"></script>
    <!-- Script Preview Image end-->
@endsection
