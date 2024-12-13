@extends('dashboard.layouts.main');

@section('container')
    <?php
    $createdDate = strtotime($vendor->created_at);
    $updatedDate = strtotime($vendor->updated_at);
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <!-- Logo Vendor Start -->
        <div class="flex justify-center items-center w-64 h-[550px] m-1 border rounded-lg bg-stone-300">
            <div>
                @if ($vendor->logo)
                    <img class="m-auto img-preview flex items-center rounded-full w-48 "
                        src="{{ asset('storage/' . $vendor->logo) }}">
                @else
                    <img class="m-auto img-preview flex rounded-full items-center w-48" src="/img/photo_profile.png">
                @endif
                <span class="flex justify-center font-semibold text-stone-900 border-b mt-3">{{ $vendor->name }}</span>
                <span class="flex justify-center text-stone-900 text-sm text-center">{{ $vendor->company }}</span>
            </div>
        </div>
        <!-- Logo Vendor End -->
        <!-- Detail Vendor Start -->
        <div class="flex justify-center w-[500px] h-[550px] m-1 border rounded-lg bg-stone-300">
            <div class="p-2 w-full justify-center">
                <div class="flex items-center w-full border-b">
                    <h4 class="text-2xl font-semibold tracking-wider text-stone-900">DATA VENDOR</h4>
                </div>
                <div class="mt-2 w-full">
                    <div class="border-b mt-1"><label class="text-sm text-stone-900">Nama Vendor</label>
                        <h6 class="text-base font-semibold text-stone-900">{{ $vendor->name }}</h6>
                    </div>
                    <div class="border-b mt-1"><label class="text-sm text-stone-900">Nama Perusahaan</label>
                        <h6 class="text-base font-semibold text-stone-900">{{ $vendor->company }}</h6>
                    </div>
                    <div class="border-b mt-1"><label class="text-sm text-stone-900">Alamat</label>
                        <h6 class="text-base font-semibold text-stone-900">{{ $vendor->address }}</h6>
                    </div>
                    <div class="border-b mt-1"><label class="text-sm text-stone-900">Katagori</label>
                        <h6 class="text-base font-semibold text-stone-900">{{ $vendor->vendor_category->name }}</h6>
                    </div>
                    <div class="border-b mt-1"><label class="text-sm text-stone-900">Email</label>
                        @if ($vendor->email)
                            <h6 class="text-base font-semibold text-stone-900">{{ $vendor->email }}</h6>
                        @else
                            <h6 class="text-base font-semibold text-stone-900">-</h6>
                        @endif
                    </div>
                    <div class="border-b mt-1"><label class="text-sm text-stone-900">No. Telepon</label>
                        @if ($vendor->phone)
                            <h6 class="text-base font-semibold text-stone-900">{{ $vendor->phone }}</h6>
                        @else
                            <h6 class="text-base font-semibold text-stone-900">-</h6>
                        @endif
                    </div>
                    <div class="border-b mt-1"><label class="text-sm text-stone-900">Dibuat Oleh</label>
                        <h6 class="text-base font-semibold text-stone-900">{{ $vendor->user->name }}</h6>
                    </div>
                    <div class="border-b mt-1"><label class="text-sm text-stone-900">Tanggal Terdaftar</label>
                        <h6 class="text-base font-semibold text-stone-900">{{ date('d', $createdDate) }}
                            {{ $bulan[(int) date('m', $createdDate)] }}
                            {{ date('Y', $createdDate) }}
                        </h6>
                    </div>
                    <div class="border-b mt-1"><label class="text-sm text-stone-900">Tanggal Perubahan Terakhir</label>
                        <h6 class="text-base font-semibold text-stone-900">{{ date('d', $updatedDate) }}
                            {{ $bulan[(int) date('m', $updatedDate)] }}
                            {{ date('Y', $updatedDate) }}
                        </h6>
                    </div>
                    <div class="flex mt-1">
                        <a href="/marketing/vendors" class="flex items-center justify-center btn-primary mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Back </span>
                        </a>
                        @canany(['isAdmin', 'isMarketing'])
                            @can('isVendor')
                                @can('isMarketingEdit')
                                    <a href="/marketing/vendors/{{ $vendor->id }}/edit"
                                        class="flex items-center justify-center btn-warning mx-1">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1"> Edit </span>
                                    </a>
                                @endcan
                            @endcan
                        @endcanany
                        @canany(['isAdmin', 'isMarketing'])
                            @can('isVendor')
                                @can('isMarketingDelete')
                                    <form action="/marketing/vendors/{{ $vendor->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="flex items-center justify-center btn-danger mx-1"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data vendor dengan nama {{ $vendor->username }} ?')">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="mx-1"> Delete </span>
                                    </form>
                                @endcan
                            @endcan
                        @endcanany
                    </div>
                </div>
            </div>
        </div>
        <!-- Detail Vendor End -->
        <!-- Kontak Person Start -->
        <div
            class="justify-center relative w-[475px] border-l h-[550px] m-1 border rounded-lg bg-stone-300 overflow-y-auto">
            <div class="flex bg-stone-300 w-full">
                <div class="w-[470px] p-2">
                    <div class="flex items-center w-full border-b p-1">
                        <!-- Title Start -->
                        <h4 class="text-2xl font-semibold tracking-wider text-stone-900 w-[400px]">KONTAK PERSON</h4>
                        <!-- Title End -->
                        <!-- Button Add Contact Start -->
                        <div class="flex w-full items-center justify-end">
                            <button class="flex items-center btn-primary" type="button" id="btnAdd" name="btnAdd"
                                onclick="addContact(this)">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1">Tambah Kontak</span>
                            </button>
                        </div>
                        <!-- Button Add Contact End -->
                    </div>
                    @if (session()->has('success'))
                        <div class="mt-2 flex alert-success">
                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                            </svg>
                            <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any(['name', 'email', 'phone']))
                        <div id="divAddContact">
                            <form method="post" action="/marketing/vendor-contacts" enctype="multipart/form-data">
                                @csrf
                                <div class="flex justify-center w-full mt-2">
                                    <div>
                                        <img class="m-auto photo-preview rounded-full flex items-center w-32"
                                            src="/img/photo_profile.png">
                                        <label class="flex justify-center text-sm text-stone-900 mb-2">Photo
                                            Profile</label>
                                        <input
                                            class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-full mt-5 @error('avatar') is-invalid @enderror"
                                            type="file" id="photo" name="photo" onchange="previewPhoto(this)">
                                        @error('logo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex justify-center w-full mt-2">
                                    <div>
                                        <div class="flex mt-1 items-center">
                                            <input name="vendor_id" value="{{ $vendor->id }}" type="hidden">
                                            <label class="text-sm text-stone-900 w-[150px]">Nama Vendor</label>
                                            <input id="vendor_name" name="vendor_name"
                                                class="flex px-2 text-sm font-semibold text-slate-400 w-full border rounded-lg p-1 outline-none"
                                                type="text" title="Terisi otomatis" value="{{ $vendor->name }}"
                                                required readonly>
                                        </div>
                                        <div class="flex mt-1 items-center">
                                            <label class="text-sm text-stone-900 w-[150px]">Nama</label>
                                            <input
                                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                                type="text" id="name" name="name" placeholder="Input Nama"
                                                value="{{ old('name') }}" autofocus required>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="flex mt-1 items-center">
                                            <label class="text-sm text-stone-900 w-[150px]">Email</label>
                                            <input
                                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                                type="email" id="email" name="email" placeholder="Input Email"
                                                value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="flex mt-1 items-center">
                                            <label class="text-sm text-stone-900 w-[150px]">No. Handphone</label>
                                            <input
                                                class="flex px-2 text-base in-out-spin-none font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                                type="number" min="0" id="phone" name="phone"
                                                placeholder="Input No. Handphone" value="{{ old('phone') }}" required>
                                        </div>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="flex mt-1 items-center">
                                            <label class="text-sm text-stone-900 w-[150px]">Jabatan</label>
                                            <input
                                                class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('position') is-invalid @enderror"
                                                type="text" id="position" name="position"
                                                placeholder="Input Jabatan" value="{{ old('position') }}">
                                        </div>
                                        <div class="flex mt-5">
                                            <button class="flex items-center justify-center btn-primary mx-1"
                                                type="submit">
                                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24">
                                                    <path
                                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                                </svg>
                                                <span class="mx-2"> Save </span>
                                            </button>
                                            <button class="flex items-center justify-center btn-danger mx-1"
                                                onclick="closeAddContact(this)" type="button">
                                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                                <span class="mx-1"> Close </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div id="divAddContact" hidden>
                            <form method="post" action="/marketing/vendor-contacts" enctype="multipart/form-data">
                                @csrf
                                <div class="flex justify-center w-full mt-2">
                                    <div>
                                        <img class="m-auto photo-preview rounded-full flex items-center w-32"
                                            src="/img/photo_profile.png">
                                        <label class="flex justify-center text-sm text-stone-900 mb-2">Photo
                                            Profile</label>
                                        <input
                                            class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-full mt-5 @error('avatar') is-invalid @enderror"
                                            type="file" id="photo" name="photo" onchange="previewPhoto(this)">
                                        @error('logo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex justify-center w-full mt-2">
                                    <div>
                                        <div class="flex mt-1 items-center">
                                            <input name="vendor_id" value="{{ $vendor->id }}" type="hidden">
                                            <label class="text-sm text-stone-900 w-[150px]">Nama Vendor</label>
                                            <input id="vendor_name" name="vendor_name" title="Terisi otomatis"
                                                class="flex px-2 text-sm font-semibold text-slate-400 w-full border rounded-lg p-1 outline-none"
                                                type="text" value="{{ $vendor->name }}" required readonly>
                                        </div>
                                        <div class="flex mt-1 items-center">
                                            <label class="text-sm text-stone-900 w-[150px]">Nama</label>
                                            <input
                                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                                type="text" id="name" name="name" placeholder="Input Nama"
                                                value="{{ old('name') }}" autofocus required>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="flex mt-1 items-center">
                                            <label class="text-sm text-stone-900 w-[150px]">Email</label>
                                            <input
                                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                                type="email" id="email" name="email" placeholder="Input Email"
                                                value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="flex mt-1 items-center">
                                            <label class="text-sm text-stone-900 w-[150px]">No. Handphone</label>
                                            <input
                                                class="flex px-2 text-base in-out-spin-none font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                                type="number" min="0" id="phone" name="phone"
                                                placeholder="Input No. Handphone" value="{{ old('phone') }}" required>
                                        </div>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="flex mt-1 items-center">
                                            <label class="text-sm text-stone-900 w-[150px]">Jabatan</label>
                                            <input
                                                class="flex px-2 text-base font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('position') is-invalid @enderror"
                                                type="text" id="position" name="position"
                                                placeholder="Input Jabatan" value="{{ old('position') }}">
                                        </div>
                                        <div class="flex mt-5">
                                            <button class="flex items-center justify-center btn-primary mx-1"
                                                type="submit">
                                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24">
                                                    <path
                                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                                </svg>
                                                <span class="mx-2"> Save </span>
                                            </button>
                                            <button class="flex items-center justify-center btn-danger mx-1"
                                                onclick="closeAddContact(this)" type="button">
                                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                                <span class="mx-1"> Close </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="items-center p-2 relative w-full">
                <!-- Show Kontak Person Start -->
                <?php
                $i = 0;
                ?>
                @foreach ($vendor_contacts as $contact)
                    @if ($contact->vendor_id == $vendor->id)
                        <?php
                        $i = $i + 1;
                        ?>
                        <div class="flex border-t">
                            <h6 class="flex absolute text-sm mx-3 mt-3 font-semibold text-stone-900">
                                {{ $i }}
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
                                <div class="border-b mt-1"><label class="text-sm text-stone-900">Nama</label>
                                    <h6 class="text-sm font-semibold text-stone-900">{{ $contact->name }}</h6>
                                </div>
                                <div class="border-b mt-1">
                                    <label class="text-sm text-stone-900">Email</label>
                                    @if ($contact->email)
                                        <h6 class="text-sm font-semibold text-stone-900">{{ $contact->email }}</h6>
                                    @else
                                        <h6 class="text-sm font-semibold text-stone-900">-</h6>
                                    @endif
                                </div>
                                <div class="border-b mt-1"><label class="text-sm text-stone-900">No. Handphone</label>
                                    <h6 class="text-sm font-semibold text-stone-900">{{ $contact->phone }}</h6>
                                </div>
                                <div class="border-b mt-1"><label class="text-sm text-stone-900">Jabatan</label>
                                    @if ($contact->position)
                                        <h6 class="text-sm font-semibold text-stone-900">{{ $contact->position }}</h6>
                                    @else
                                        <h6 class="text-sm font-semibold text-stone-900">-</h6>
                                    @endif
                                </div>
                                <div class="flex mt-2">
                                    <a href="/marketing/vendor-contacts/{{ $contact->id, $vendor->id }}/edit"
                                        class="flex items-center justify-center btn-warning mx-1" name="btnEdit"
                                        id="btnEdit">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1"> Edit </span>
                                    </a>
                                    <form action="/marketing/vendor-contacts/{{ $contact->id }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="flex items-center justify-center btn-danger mx-1"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus kontak person dengan nama {{ $contact->name }} ?')">
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
                    @endif
                @endforeach
                <!-- Show Kontak Person End -->
            </div>
        </div>
    </div>
    <!-- Script Preview Photo start-->
    <script src="/js/previewimage.js"></script>
    <script>
        addContact = (sel) => {
            document.getElementById("divAddContact").removeAttribute('hidden');
        }

        closeAddContact = (sel) => {
            document.getElementById("divAddContact").setAttribute('hidden', 'hidden');
        }

        function previewPhoto(sel) {
            const photoPreview = document.querySelector('.photo-preview');

            // photoPreview.style.display = 'block';

            const oFReader = new FileReader();

            oFReader.readAsDataURL(sel.files[0]);

            oFReader.onload = function(oFREvent) {
                photoPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
