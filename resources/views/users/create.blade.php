@extends('dashboard.layouts.main');

@section('container')
    <form method="post" action="/users" enctype="multipart/form-data">
        @csrf
        <div class="mt-10">
            <!-- Show Title start -->
            <div class="flex w-full justify-center">
                <div class="flex items-center w-[1000px] border-b">
                    <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider w-[650px]">MENAMBAHKAN DATA PENGGUNA </h1>
                    <div class="flex w-full justify-end items-center p-1">
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
            </div>
            <!-- Show Title end -->
            <div class="flex w-full justify-center">
                <div class="flex w-[1000px] mt-4">
                    <div class="flex justify-center w-96">
                        <div>
                            <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                                src="/img/photo_profile.png">
                            <label class="flex justify-center text-sm text-teal-700 mt-2">Photo Profile</label>
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
                                        type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}"
                                        autofocus required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2"><label class="text-sm text-teal-700">Username</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('username') is-invalid @enderror"
                                        type="text" name="username" placeholder="Username" value="{{ old('username') }}"
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
                                        type="text" name="email" placeholder="Email" value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2"><label class="text-sm text-teal-700">No. Handphone</label>
                                    <input
                                        class="flex in-out-spin-none px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                        min="0" type="number" name="phone" placeholder="No. Handphone"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2 items-center">
                                    <label class="text-sm text-teal-700">Password</label>
                                    <input type="password"
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('password') is-invalid @enderror"
                                        placeholder="Password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2 items-center">
                                    <label class="text-sm text-teal-700">Password</label>
                                    <input type="password"
                                        class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('confirm_password') is-invalid @enderror"
                                        placeholder="Confirm Password" name="confirm_password" required>
                                    @error('confirm_password')
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
                                    name="gender" value="{{ old('gender') }}" required>
                                    <option value="pilih">Pilih Jenis Kelamin</option>
                                    @foreach ($genders as $gender)
                                        @if (old('gender') == $gender)
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
                                    name="division" value="{{ old('division') }}" required>
                                    <option value="pilih">Pilih Divisi</option>
                                    @foreach ($divisions as $division)
                                        @if (old('division') == $division)
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
                                    name="position" value="{{ old('position') }}" required>
                                    <option value="pilih">Pilih Jabatan</option>
                                    @foreach ($positions as $position)
                                        @if (old('position') == $position)
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
                                    name="level" value="{{ old('level') }}" required>
                                    <option value="pilih">Pilih Level</option>
                                    @foreach ($levels as $level)
                                        @if (old('level') == $level)
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
@endsection
