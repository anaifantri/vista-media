@extends('dashboard.layouts.main');

@section('container')
    <form id="formCreate" method="post" action="/user/users" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Show Title start -->
                <div class="flex w-full justify-center">
                    <div class="flex items-center w-[1000px] border-b p-1">
                        <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[650px]">MENAMBAHKAN DATA PENGGUNA
                        </h1>
                        <div class="flex w-full justify-end items-center p-1">
                            <button class="flex items-center justify-center btn-primary mx-1" type="button"
                                onclick="btnSaveAction()">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                </svg>
                                <span class="mx-2"> Save </span>
                            </button>
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
                        </div>
                    </div>
                </div>
                <!-- Show Title end -->
                <div class="flex w-full justify-center">
                    <div class="w-[1000px]">
                        <div class="flex justify-center mt-4">
                            <div class="flex justify-center border rounded-lg bg-stone-200 p-4  w-96">
                                <div>
                                    <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                                        src="/img/photo_profile.png">
                                    <label class="flex justify-center text-sm text-stone-900 mt-2">Photo Profile</label>
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
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Nama</label>
                                        <input
                                            class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                            type="text" name="name" placeholder="Nama Lengkap"
                                            value="{{ old('name') }}" autofocus required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2"><label class="text-sm text-stone-900">Username</label>
                                        <input
                                            class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('username') is-invalid @enderror"
                                            type="text" name="username" placeholder="Username"
                                            value="{{ old('username') }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2"><label class="text-sm text-stone-900">Email</label>
                                        <input
                                            class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                            type="text" name="email" placeholder="Email" value="{{ old('email') }}"
                                            required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2"><label class="text-sm text-stone-900">No. Handphone</label>
                                        <input
                                            class="flex in-out-spin-none px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                            min="0" type="number" name="phone" placeholder="No. Handphone"
                                            value="{{ old('phone') }}" required>
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
                                </div>
                            </div>
                            <div class="flex w-[280px] border rounded-lg bg-stone-200 p-4  ml-4">
                                <div class="w-full">
                                    <div class="mt-2"><label class="text-sm text-stone-900">Divisi</label>
                                        <input type="text" id="level" name="level" value="{{ old('level') }}"
                                            hidden>
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
                                        <select id="division" name="division"
                                            class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('division') is-invalid @enderror"
                                            value="{{ old('division') }}"
                                            onchange="selectDivision(this, document.getElementById('inputPosition'))"
                                            required>
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
                                    <div class="mt-2">
                                        <label class="text-sm text-stone-900">Jabatan</label>
                                        <input type="text" id="inputPosition" name="input_position"
                                            value="{{ old('input_position') }}" hidden>
                                        @if (old('division'))
                                            @if (old('division') != 'pilih')
                                                <select id="position" name="position"
                                                    class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('position') is-invalid @enderror"
                                                    value="{{ old('position') }}" onchange="selectPosition(this)"
                                                    required>
                                                    <option value="pilih">Pilih Jabatan</option>
                                                @else
                                                    <select id="position" name="position"
                                                        class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('position') is-invalid @enderror"
                                                        value="{{ old('position') }}" onchange="selectPosition(this)"
                                                        required disabled>
                                                        <option value="pilih">Pilih Jabatan</option>
                                            @endif
                                        @else
                                            <select id="position" name="position"
                                                class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('position') is-invalid @enderror"
                                                value="{{ old('position') }}" onchange="selectPosition(this)" required
                                                disabled>
                                                <option value="pilih">Pilih Jabatan</option>
                                        @endif
                                        </select>
                                        @error('position')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2 items-center">
                                        <label class="text-sm text-stone-900">Password</label>
                                        <input type="password"
                                            class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('password') is-invalid @enderror"
                                            placeholder="Password" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-2 items-center">
                                        <label class="text-sm text-stone-900">Konfirmasi Password</label>
                                        <input type="password"
                                            class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('confirm_password') is-invalid @enderror"
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
                        <div class="flex justify-center mt-2 border rounded-lg bg-stone-200 p-4 ">
                            <div>
                                <label class="text-sm text-stone-900">Hak Akses</label>
                                <input type="text" id="user_access" name="user_access"
                                    value="{{ old('user_access') }}" hidden>
                                @error('user_access')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="flex justify-center mt-2">
                                    @if (old('user_access'))
                                        @php
                                            $roles = json_decode(old('user_access'));
                                        @endphp
                                        <table class="table-auto w-full">
                                            <thead>
                                                <tr id="tableHeader">
                                                    <th id="mainMenu"
                                                        class="text-stone-900 font-semibold text-xs px-2 border" hidden>
                                                        <div>
                                                            <input class="outline-none" id="cbMainMenu" type="checkbox"
                                                                hidden disabled>
                                                            <label id="labelMainMenu" class="ml-2"></label>
                                                            <div class="flex">
                                                                <input id="cbCreate" class="outline-none ml-2"
                                                                    type="checkbox" disabled>
                                                                <label class="ml-1">C</label>
                                                                <input id="cbRead" class="outline-none ml-2"
                                                                    type="checkbox" disabled>
                                                                <label class="ml-1">R</label>
                                                                <input id="cbUpdate" class="outline-none ml-2"
                                                                    type="checkbox" disabled>
                                                                <label class="ml-1">U</label>
                                                                <input id="cbDelete" class="outline-none ml-2"
                                                                    type="checkbox" disabled>
                                                                <label class="ml-1">D</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    @foreach ($roles as $role)
                                                        <th id="mainMenu"
                                                            class="text-stone-900 font-semibold text-xs px-2 border">
                                                            <div>
                                                                <input class="outline-none" id="cbMainMenu"
                                                                    type="checkbox"
                                                                    value="{{ $role->permissions->title }}" hidden
                                                                    disabled>
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
                                                    <td id="subMenu" class="text-stone-900 text-xs border p-2 align-top"
                                                        hidden>

                                                    </td>
                                                    @foreach ($roles as $role)
                                                        <td id="subMenu"
                                                            class="text-stone-900 text-xs border p-2 align-top">
                                                            @if ($role->permissions->title == 'Data Media')
                                                                @foreach ($roles->objMedia->mediaRoles as $mediaRole)
                                                                    <div id="menuItems" class="flex items-center">
                                                                        @if ($mediaRole->access == true)
                                                                            <input class="outline-none" id="cbSubMenu"
                                                                                type="checkbox" checked>
                                                                        @else
                                                                            <input class="outline-none" id="cbSubMenu"
                                                                                type="checkbox">
                                                                        @endif
                                                                        <label
                                                                            class="ml-2 w-100">{{ $mediaRole->title }}</label>
                                                                    </div>
                                                                @endforeach
                                                            @elseif ($role->permissions->title == 'Data Pemasaran')
                                                                @foreach ($roles->objMarketing->marketingRoles as $marketingRole)
                                                                    <div id="menuItems" class="flex items-center">
                                                                        @if ($marketingRole->access == true)
                                                                            <input class="outline-none" id="cbSubMenu"
                                                                                type="checkbox" checked>
                                                                        @else
                                                                            <input class="outline-none" id="cbSubMenu"
                                                                                type="checkbox">
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
                                                                        @else
                                                                            <input class="outline-none" id="cbSubMenu"
                                                                                type="checkbox">
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
                                                                        @else
                                                                            <input class="outline-none" id="cbSubMenu"
                                                                                type="checkbox">
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
                                                                        @else
                                                                            <input class="outline-none" id="cbSubMenu"
                                                                                type="checkbox">
                                                                        @endif
                                                                        <label
                                                                            class="ml-2 w-100">{{ $userRole->title }}</label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            {{-- @foreach ($role->mediaRoles as $media)
                                                            <div id="menuItems" class="hidden items-center">
                                                                <input class="outline-none" id="cbSubMenu"
                                                                    type="checkbox" disabled>
                                                                <label class="ml-2 w-100">$media[0]->title</label>
                                                            </div>
                                                        @endforeach --}}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    @else
                                        <table class="table-auto w-full">
                                            <thead>
                                                <tr id="tableHeader">
                                                    <th id="mainMenu"
                                                        class="text-stone-900 font-semibold text-xs px-2 border" hidden>
                                                        <div>
                                                            <input class="outline-none" id="cbMainMenu" type="checkbox"
                                                                hidden disabled>
                                                            <label id="labelMainMenu" class="ml-2"></label>
                                                            <div class="flex">
                                                                <input id="cbCreate" class="outline-none ml-2"
                                                                    type="checkbox" disabled>
                                                                <label class="ml-1">C</label>
                                                                <input id="cbRead" class="outline-none ml-2"
                                                                    type="checkbox" disabled>
                                                                <label class="ml-1">R</label>
                                                                <input id="cbUpdate" class="outline-none ml-2"
                                                                    type="checkbox" disabled>
                                                                <label class="ml-1">U</label>
                                                                <input id="cbDelete" class="outline-none ml-2"
                                                                    type="checkbox" disabled>
                                                                <label class="ml-1">D</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="tableRow">
                                                    <td id="subMenu" class="text-stone-900 text-xs border p-2 align-top"
                                                        hidden>

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
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="/js/previewimage.js"></script>
    <script src="/js/createuser.js"></script>
@endsection
