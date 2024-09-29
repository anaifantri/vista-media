@extends('dashboard.layouts.main');

@section('container')
    <form class="md:flex" method="post" action="/users/{{ $user->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center">
            <div class="mt-10">
                <!-- Show Title start -->
                <div class="flex w-[1140px] items-center border-b">
                    <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider w-[550px]">MERUBAH DATA PENGGUNA </h1>
                    <div class="flex w-full justify-end items-center">
                        <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                            name="btnSubmit">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                            </svg>
                            <span class="mx-2"> Save </span>
                        </button>
                        <a href="/users" class="flex items-center justify-center btn-danger mx-1">
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
                <!-- Show Title end -->
                @if (session()->has('success'))
                    <div class="flex alert-success">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
                <div class="flex justify-center w-[1140px] mt-4">
                    <div class="flex justify-center w-96">
                        <div>
                            <label class="flex justify-center text-sm text-teal-700 mt-2">Photo Profile</label>
                            <input type="hidden" name="oldAvatar" value="{{ $user->avatar }}">
                            @if ($user->avatar)
                                <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                                    src="{{ asset('storage/' . $user->avatar) }}">
                            @else
                                <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                                    src="/img/photo_profile.png">
                            @endif
                            <input
                                class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5 @error('avatar') is-invalid @enderror"
                                type="file" id="avatar" name="avatar" onchange="previewImage(this)">
                            @error('avatar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex w-[280px]">
                        <div class="w-full">
                            <div class="mt-5 w-full">
                                <div class="mt-2"><label class="text-sm text-teal-700">Nama</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                        type="text" id="name" name="name" value="{{ $user->name }}" autofocus
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2"><label class="text-sm text-teal-700">Username</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('username') is-invalid @enderror"
                                        type="text" id="username" name="username" value="{{ $user->username }}"
                                        required>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2"><label class="text-sm text-teal-700">Email</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                        type="text" id="email" name="email" value="{{ $user->email }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2"><label class="text-sm text-teal-700">No. Handphone</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                        type="number" id="phone" name="phone" value="{{ $user->phone }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2 items-center">
                                    <input class="items-center mt-0" id="cbPassword" name="cbPassword" type="checkbox"
                                        aria-label="Checkbox for following text input" onclick="changePassword(this)">
                                    <label class="text-sm text-teal-700">Rubah Password?</label>
                                    <input type="hidden" id="oldPassword" name="oldPassword"
                                        value="{{ $user->password }}">
                                    <input type="password"
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('password') is-invalid @enderror"
                                        id="password" placeholder="New Password" value="" name="password"
                                        aria-label="Text input with checkbox" disabled>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-[280px] ml-4">
                        <div class="mt-5 w-full">
                            <div class="mt-2"><label class="text-sm text-teal-700">Jenis Kelamin</label>
                                @php
                                    $genders = ['Male', 'Female'];
                                @endphp
                                <select
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('gender') is-invalid @enderror"
                                    name="gender" id="gender" value="{{ $user->gender }}" required>
                                    @foreach ($genders as $gender)
                                        @if ($user->gender == $gender)
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
                            <div class="mt-2"><label class="text-sm text-teal-700">Divisi</label>
                                @php
                                    $divisions = ['Administrator', 'Owner', 'Media', 'Pemasaran', 'Keuangan', 'Gudang'];
                                @endphp
                                <select
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('division') is-invalid @enderror"
                                    name="division" value="{{ $user->division }}" required>
                                    @foreach ($divisions as $division)
                                        @if ($user->division == $division)
                                            <option value="{{ $division }}" selected>
                                                {{ $division }}
                                            </option>
                                        @else
                                            <option value="{{ $division }}">
                                                {{ $division }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('division')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">Jabatan</label>
                                @php
                                    $positions = [
                                        'Administrator',
                                        'Direktur',
                                        'Manager Operasional',
                                        'Manager Pemasaran',
                                        'Manager Keuangan',
                                        'Manager IT',
                                        'Staff',
                                    ];
                                @endphp
                                <select
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('position') is-invalid @enderror"
                                    name="position" id="position" value="{{ $user->position }}" required>
                                    @foreach ($positions as $position)
                                        @if ($user->position == $position)
                                            <option value="{{ $position }}" selected>
                                                {{ $position }}
                                            </option>
                                        @else
                                            <option value="{{ $position }}">
                                                {{ $position }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-teal-700">Level Akses</label>
                                @php
                                    $levels = [
                                        'Administrator',
                                        'Owner',
                                        'Media',
                                        'Marketing',
                                        'Accounting',
                                        'Workshop',
                                    ];
                                @endphp
                                <select
                                    class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('level') is-invalid @enderror"
                                    name="level" value="{{ $user->level }}" required>
                                    <option value="pilih">Pilih Level</option>
                                    @foreach ($levels as $level)
                                        @if ($user->level == $level)
                                            <option value="{{ $level }}" selected>
                                                {{ $level }}
                                            </option>
                                        @else
                                            <option value="{{ $level }}">
                                                {{ $level }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <script src="/js/previewimage.js"></script>
    <script>
        changePassword = (sel) => {
            password.disabled = !sel.checked;
            password.value = "";
            password.focus();
        };
    </script>
@endsection
