@extends('dashboard.layouts.main');

@section('container')
    <form id="formUpdate" method="post" action="/user/users/{{ $user->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Show Title start -->
                <div class="flex w-[1140px] items-center border-b p-1">
                    <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[550px]">MERUBAH DATA PENGGUNA </h1>
                    <div class="flex w-full justify-end items-center">
                        @if (auth()->user()->level == 'Administrator')
                            <button class="flex items-center justify-center btn-primary mx-1" type="button"
                                onclick="btnSaveAction()">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                </svg>
                                <span class="mx-2"> Save </span>
                            </button>
                        @else
                            <button class="flex items-center justify-center btn-primary mx-1" type="submit">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                </svg>
                                <span class="mx-2"> Save </span>
                            </button>
                        @endif
                        @if (auth()->user()->level == 'Administrator')
                            <a href="/user/users" class="flex items-center justify-center btn-danger mx-1">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1"> Cancel </span>
                            </a>
                        @else
                            <a href="/user/users/{{ $user->id }}"
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
                        @endif
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
                    <div class="flex justify-center border rounded-lg bg-stone-200 p-4 w-96">
                        <div>
                            <label class="flex justify-center text-sm text-stone-900 mt-2">Photo Profile</label>
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
                    <div class="flex w-[280px] border rounded-lg bg-stone-200 p-4 ml-4">
                        <div class="w-full">
                            <div class="w-full">
                                <div class="mt-2"><label class="text-sm text-stone-900">Nama</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                        type="text" id="name" name="name" value="{{ $user->name }}" autofocus
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2"><label class="text-sm text-stone-900">Username</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('username') is-invalid @enderror"
                                        type="text" id="username" name="username" value="{{ $user->username }}"
                                        required>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2"><label class="text-sm text-stone-900">Email</label>
                                    <input
                                        class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                        type="text" id="email" name="email" value="{{ $user->email }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2"><label class="text-sm text-stone-900">No. Handphone</label>
                                    <input
                                        class="flex px-2 text-base font-semibold in-out-spin-none text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                        type="number" id="phone" name="phone" value="{{ $user->phone }}"
                                        required>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2"><label class="text-sm text-stone-900">Jenis Kelamin</label>
                                    @php
                                        $genders = ['Male', 'Female'];
                                    @endphp
                                    <select
                                        class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('gender') is-invalid @enderror"
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
                            </div>
                        </div>
                    </div>
                    <div class="flex w-[280px] border rounded-lg bg-stone-200 p-4 ml-4">
                        <div class="w-full">
                            @can('isAdmin')
                                <div class="mt-2"><label class="text-sm text-stone-900">Divisi</label>
                                    <input type="text" id="level" name="level" value="{{ $user->level }}" hidden>
                                    @php
                                        $divisions = [
                                            'Administrator',
                                            'Owner',
                                            'Media',
                                            'Marketing',
                                            'Accounting',
                                            'Workshop',
                                        ];
                                    @endphp
                                    @if (old('division'))
                                        <select id="division"
                                            class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('division') is-invalid @enderror"
                                            name="division" value="{{ $user->division }}"
                                            onchange="selectDivision(this, document.getElementById('inputPosition'))" required>
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
                                    @else
                                        <select id="division"
                                            class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('division') is-invalid @enderror"
                                            name="division" value="{{ $user->division }}"
                                            onchange="selectDivision(this, document.getElementById('inputPosition'))" required>
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
                                    @endif
                                    @error('division')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label class="text-sm text-stone-900">Jabatan</label>
                                    @if (old('position'))
                                        <input type="text" id="inputPosition" name="input_position"
                                            value="{{ old('position') }}" hidden>
                                    @else
                                        <input type="text" id="inputPosition" name="input_position"
                                            value="{{ $user->position }}" hidden>
                                    @endif
                                    <select id="position" name="position"
                                        class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('position') is-invalid @enderror"
                                        onchange="selectPosition(this)" required disabled>
                                        <option value="pilih">Pilih Jabatan</option>
                                    </select>
                                    @error('position')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- <div class="mt-2">
                                    <label class="text-sm text-stone-900">Status</label>
                                    <div class="flex">
                                        <input class="outline-none" type="radio" name="active_status" value="true"
                                            checked>
                                        <label class="ml-2 text-sm font-semibold text-stone-900">Aktif</label>
                                        <input class="ml-2 outline-none" type="radio" name="active_status" value="false">
                                        <label class="ml-2 text-sm font-semibold text-stone-900">Non Aktif</label>
                                    </div>
                                    @error('active_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                            @endcan
                            <div class="mt-2 items-center">
                                <input type="text" id="cbPasswordValue" name="cbPasswordValue"
                                    value="{{ old('cbPasswordValue') }}" hidden>
                                <input class="items-center mt-0" id="cbPassword" name="cbPassword" type="checkbox"
                                    aria-label="Checkbox for following text input" onclick="changePassword(this)">
                                <label class="text-sm text-stone-900">Rubah Password?</label>
                            </div>
                            <div id="divPassword" class="mt-2 items-center" hidden>
                                <label class="text-sm text-stone-900">Password</label>
                                <input type="hidden" id="oldPassword" name="oldPassword"
                                    value="{{ $user->password }}">
                                <input type="password"
                                    class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('password') is-invalid @enderror"
                                    id="password" placeholder="New Password" name="password"
                                    aria-label="Text input with checkbox" disabled>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div id="divConfirmPassword" class="mt-2 items-center" hidden>
                                <label class="text-sm text-stone-900">Konfirmasi Password</label>
                                <input type="password" id="confirmPassword"
                                    class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('confirm_password') is-invalid @enderror"
                                    placeholder="Confirm Password" name="confirm_password" disabled>
                                @error('confirm_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @can('isAdmin')
                    <div class="flex justify-center w-[1140px] border rounded-lg bg-stone-200 p-4 mt-4">
                        <div>
                            <label class="text-sm text-stone-900">Hak Akses</label>
                            @if (old('user_access'))
                                <input type="text" id="user_access" name="user_access" value="{{ old('user_access') }}"
                                    hidden>
                            @else
                                <input type="text" id="user_access" name="user_access" value="{{ $user->user_access }}"
                                    hidden>
                            @endif
                            @error('user_access')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="flex justify-center mt-2">
                                @if ($user->user_access)
                                    @php
                                        if (old('user_access')) {
                                            $roles = json_decode(old('user_access'));
                                        } else {
                                            $roles = json_decode($user->user_access);
                                        }
                                    @endphp
                                    <table class="table-auto w-full">
                                        <thead>
                                            <tr id="tableHeader">
                                                <th id="mainMenu" class="text-stone-900 font-semibold text-xs px-2 border"
                                                    hidden>
                                                    <div>
                                                        <input class="outline-none" id="cbMainMenu" type="checkbox" hidden
                                                            disabled>
                                                        <label id="labelMainMenu" class="ml-2"></label>
                                                        <div class="flex">
                                                            <input id="cbCreate" class="outline-none ml-2" type="checkbox"
                                                                disabled>
                                                            <label class="ml-1">C</label>
                                                            <input id="cbRead" class="outline-none ml-2" type="checkbox"
                                                                disabled>
                                                            <label class="ml-1">R</label>
                                                            <input id="cbUpdate" class="outline-none ml-2" type="checkbox"
                                                                disabled>
                                                            <label class="ml-1">U</label>
                                                            <input id="cbDelete" class="outline-none ml-2" type="checkbox"
                                                                disabled>
                                                            <label class="ml-1">D</label>
                                                        </div>
                                                    </div>
                                                </th>
                                                @foreach ($roles as $role)
                                                    <th id="mainMenu"
                                                        class="text-stone-900 font-semibold text-xs px-2 border">
                                                        <div>
                                                            <input class="outline-none" id="cbMainMenu" type="checkbox"
                                                                value="{{ $role->permissions->title }}" hidden disabled>
                                                            <label id="labelMainMenu"
                                                                class="ml-2">{{ $role->permissions->title }}</label>
                                                            <div class="flex">
                                                                @if ($role->permissions->create == true)
                                                                    <input id="cbCreate" class="outline-none ml-2"
                                                                        type="checkbox" checked>
                                                                @else
                                                                    <input id="cbCreate" class="outline-none ml-2"
                                                                        type="checkbox" disabled>
                                                                @endif
                                                                <label class="ml-1">C</label>
                                                                @if ($role->permissions->read == true)
                                                                    <input id="cbRead" class="outline-none ml-2"
                                                                        type="checkbox" checked>
                                                                @else
                                                                    <input id="cbRead" class="outline-none ml-2"
                                                                        type="checkbox" disabled>
                                                                @endif
                                                                <label class="ml-1">R</label>
                                                                @if ($role->permissions->update == true)
                                                                    <input id="cbUpdate" class="outline-none ml-2"
                                                                        type="checkbox" checked>
                                                                @else
                                                                    <input id="cbUpdate" class="outline-none ml-2"
                                                                        type="checkbox" disabled>
                                                                @endif
                                                                <label class="ml-1">U</label>
                                                                @if ($role->permissions->delete == true)
                                                                    <input id="cbDelete" class="outline-none ml-2"
                                                                        type="checkbox" checked>
                                                                @else
                                                                    <input id="cbDelete" class="outline-none ml-2"
                                                                        type="checkbox" disabled>
                                                                @endif
                                                                <label class="ml-1">D</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="tableRow">
                                                <td id="subMenu" class="text-stone-900 text-xs border p-2 align-top" hidden>
                                                </td>
                                                @foreach ($roles as $role)
                                                    <td id="subMenu" class="text-stone-900 text-xs border p-2 align-top">
                                                        @if ($role->permissions->title == 'Data Media')
                                                            @foreach ($roles->objMedia->mediaRoles as $mediaRole)
                                                                <div id="menuItems" class="flex items-center">
                                                                    @if ($mediaRole->access == true)
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox" checked>
                                                                    @elseif(
                                                                        $user->division == 'Administrator' ||
                                                                            $user->division == 'Owner' ||
                                                                            $user->division == 'Media' ||
                                                                            $user->division == 'Marketing' ||
                                                                            $user->division == 'Accounting')
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox">
                                                                    @else
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox" disabled>
                                                                    @endif
                                                                    <label class="ml-2 w-100">{{ $mediaRole->title }}</label>
                                                                </div>
                                                            @endforeach
                                                        @elseif ($role->permissions->title == 'Data Pemasaran')
                                                            @foreach ($roles->objMarketing->marketingRoles as $marketingRole)
                                                                <div id="menuItems" class="flex items-center">
                                                                    @if ($marketingRole->access == true)
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox" checked>
                                                                    @elseif(
                                                                        $user->division == 'Administrator' ||
                                                                            $user->division == 'Owner' ||
                                                                            $user->division == 'Marketing' ||
                                                                            $user->division == 'Accounting')
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox">
                                                                    @else
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox"disabled>
                                                                    @endif
                                                                    <label
                                                                        class="ml-2 w-100">{{ $marketingRole->title }}</label>
                                                                </div>
                                                            @endforeach
                                                        @elseif ($role->permissions->title == 'Data Keuangan')
                                                            @foreach ($roles->objAccounting->accountingRoles as $accountingRole)
                                                                <div id="menuItems" class="flex items-center">
                                                                    @if ($accountingRole->access == true)
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox" checked>
                                                                    @elseif(
                                                                        $user->division == 'Administrator' ||
                                                                            $user->division == 'Owner' ||
                                                                            $user->division == 'Marketing' ||
                                                                            $user->division == 'Accounting')
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox">
                                                                    @else
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox" disabled>
                                                                    @endif
                                                                    <label
                                                                        class="ml-2 w-100">{{ $accountingRole->title }}</label>
                                                                </div>
                                                            @endforeach
                                                        @elseif ($role->permissions->title == 'Data Produksi')
                                                            @foreach ($roles->objWorkshop->workshopRoles as $workshopRole)
                                                                <div id="menuItems" class="flex items-center">
                                                                    @if ($workshopRole->access == true)
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox" checked>
                                                                    @elseif(
                                                                        $user->division == 'Administrator' ||
                                                                            $user->division == 'Owner' ||
                                                                            $user->division == 'Workshop' ||
                                                                            $user->division == 'Marketing' ||
                                                                            $user->division == 'Accounting')
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox">
                                                                    @else
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox" disabled>
                                                                    @endif
                                                                    <label
                                                                        class="ml-2 w-100">{{ $workshopRole->title }}</label>
                                                                </div>
                                                            @endforeach
                                                        @elseif ($role->permissions->title == 'Data Pengguna')
                                                            @foreach ($roles->objUser->userRoles as $userRole)
                                                                <div id="menuItems" class="flex items-center">
                                                                    @if ($userRole->access == true)
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox" checked>
                                                                    @elseif($user->division == 'Administrator' || $user->division == 'Owner')
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox">
                                                                    @else
                                                                        <input class="outline-none" id="cbSubMenu"
                                                                            type="checkbox" disabled>
                                                                    @endif
                                                                    <label class="ml-2 w-100">{{ $userRole->title }}</label>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="table-auto w-full">
                                        <thead>
                                            <tr id="tableHeader">
                                                <th id="mainMenu" class="text-stone-900 font-semibold text-xs px-2 border"
                                                    hidden>
                                                    <div>
                                                        <input class="outline-none" id="cbMainMenu" type="checkbox" hidden
                                                            disabled>
                                                        <label id="labelMainMenu" class="ml-2"></label>
                                                        <div class="flex">
                                                            <input id="cbCreate" class="outline-none ml-2" type="checkbox"
                                                                disabled>
                                                            <label class="ml-1">C</label>
                                                            <input id="cbRead" class="outline-none ml-2" type="checkbox"
                                                                disabled>
                                                            <label class="ml-1">R</label>
                                                            <input id="cbUpdate" class="outline-none ml-2" type="checkbox"
                                                                disabled>
                                                            <label class="ml-1">U</label>
                                                            <input id="cbDelete" class="outline-none ml-2" type="checkbox"
                                                                disabled>
                                                            <label class="ml-1">D</label>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="tableRow">
                                                <td id="subMenu" class="text-stone-900 text-xs border p-2 align-top" hidden>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div id="menuItems" class="hidden items-center">
                                <input class="outline-none" id="cbSubMenu" type="checkbox" disabled>
                                <label class="ml-2 w-100">Test</label>
                            </div>
                            @error('level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </form>

    <script src="/js/previewimage.js"></script>
    <script src="/js/edituser.js"></script>
@endsection
