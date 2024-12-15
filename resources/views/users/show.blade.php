@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Show Title start -->
            <div class="flex w-[1140px] items-center border-b p-1">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[550px]"> DETAIL DATA PENGGUNA </h1>
                <div class="flex w-full justify-end items-center">
                    @if (auth()->user()->level === 'Administrator')
                        <a href="/user/users" class="flex items-center justify-center btn-primary mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Back</span>
                        </a>
                    @else
                        <a href="/dashboard" class="flex items-center justify-center btn-primary mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Back to home </span>
                        </a>
                    @endif
                    @if ($user->id === auth()->user()->id)
                        <a href="/user/users/{{ $user->id }}/edit"
                            class="flex items-center justify-center btn-warning mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Edit </span>
                        </a>
                    @else
                        @can(['isAdmin'])
                            @can('isUserMenu')
                                @can('isUserEdit')
                                    <a href="/user/users/{{ $user->id }}/edit"
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
                        @endcan
                    @endif
                    @can(['isAdmin'])
                        @can('isUserMenu')
                            @can('isUserDelete')
                                <form action="/user/users/{{ $user->id }}" method="post" class="d-inline mt-4">
                                    @method('delete')
                                    @csrf
                                    <button class="flex items-center justify-center btn-danger mx-1"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus data pengguna dengan nama {{ $user->name }} ?')">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1"> Delete </span>
                                    </button>
                                </form>
                            @endcan
                        @endcan
                    @endcan
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
            <!-- Alert Delet start -->
            @error('delete')
                <div class="ml-2 flex alert-warning">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Warning!</span> {{ $message }}
                </div>
            @enderror
            <!-- Alert Delet end -->
            <div class="flex justify-center w-[1140px] mt-4">
                <div class="d-flex justify-center items-center border rounded-lg bg-stone-300 p-4 w-96">
                    @if ($user->avatar)
                        <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                            src="{{ asset('storage/' . $user->avatar) }}">
                    @else
                        <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                            src="/img/photo_profile.png">
                    @endif
                    <span class="flex justify-center font-semibold text-stone-900 border-b mt-3">{{ $user->name }}</span>
                    <span class="flex justify-center text-stone-900 text-sm">{{ $user->email }}</span>
                </div>
                <div class="flex w-[280px] border rounded-lg bg-stone-300 p-4 ml-4">
                    <div class="w-full">
                        <div class="border-b">
                            <label class="text-sm text-stone-900">Nama</label>
                            <h6 class="text-base font-semibold text-stone-900">{{ $user->name }}</h6>
                        </div>
                        <div class="border-b mt-2">
                            <label class="text-sm text-stone-900">Username</label>
                            <h6 class="text-base font-semibold text-stone-900">{{ $user->username }}</h6>
                        </div>
                        <div class="border-b mt-2">
                            <label class="text-sm text-stone-900">Email</label>
                            <h6 class="text-base font-semibold text-stone-900">{{ $user->email }}</h6>
                        </div>
                        <div class="border-b mt-2">
                            <label class="text-sm text-stone-900">No. Handphone</label>
                            <h6 class="text-base font-semibold text-stone-900">{{ $user->phone }}</h6>
                        </div>
                        <div class="border-b mt-2">
                            <label class="text-sm text-stone-900">Jenis Kelamin</label>
                            @if ($user->gender == 'Male')
                                <h6 class="text-base font-semibold text-stone-900">Laki-Laki</h6>
                            @elseif ($user->gender == 'Female')
                                <h6 class="text-base font-semibold text-stone-900">Perempuan</h6>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex w-[280px] border rounded-lg bg-stone-300 p-4 ml-4">
                    <div class="w-full">
                        <div class="border-b">
                            <label class="text-sm text-stone-900">Divisi</label>
                            <h6 class="text-base font-semibold text-stone-900">{{ $user->division }}</h6>
                        </div>
                        <div class="border-b mt-2">
                            <label class="text-sm text-stone-900">Jabatan</label>
                            <h6 class="text-base font-semibold text-stone-900">{{ $user->position }}</h6>
                        </div>
                        <div class="border-b mt-2">
                            <label class="text-sm text-stone-900">Level Akses</label>
                            <h6 class="text-base font-semibold text-stone-900">{{ $user->level }}</h6>
                        </div>
                        <div class="border-b mt-2">
                            <label class="text-sm text-stone-900">Tanggal Terdaftar</label>
                            <h6 class="text-base font-semibold text-stone-900">{{ $user->created_at->format('l, d-M-Y') }}
                            </h6>
                        </div>
                        <div class="border-b mt-2">
                            <label class="text-sm text-stone-900">Tanggal Perubahan Terakhir</label>
                            <h6 class="text-base font-semibold text-stone-900">{{ $user->updated_at->format('l, d-M-Y') }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center w-[1140px] border rounded-lg bg-stone-300 p-4 mt-2">
                <div>
                    <label class="text-sm text-stone-900">Hak Akses</label>
                    <div class="flex justify-center mt-2">
                        @php
                            $roles = json_decode($user->user_access);
                        @endphp
                        <table class="table-auto w-full">
                            <thead>
                                <tr id="tableHeader">
                                    @foreach ($roles as $role)
                                        <th id="mainMenu" class="text-stone-900 font-semibold text-xs px-2 border">
                                            <div>
                                                <input class="outline-none" id="cbMainMenu" type="checkbox"
                                                    value="{{ $role->permissions->title }}" hidden disabled>
                                                <label id="labelMainMenu"
                                                    class="ml-2">{{ $role->permissions->title }}</label>
                                                <div class="flex">
                                                    @if ($role->permissions->create == true)
                                                        <input id="cbCreate" class="outline-none ml-2" type="checkbox"
                                                            checked disabled>
                                                    @else
                                                        <input id="cbCreate" class="outline-none ml-2" type="checkbox"
                                                            disabled>
                                                    @endif
                                                    <label class="ml-1">C</label>
                                                    @if ($role->permissions->read == true)
                                                        <input id="cbRead" class="outline-none ml-2" type="checkbox"
                                                            checked disabled>
                                                    @else
                                                        <input id="cbRead" class="outline-none ml-2" type="checkbox"
                                                            disabled>
                                                    @endif
                                                    <label class="ml-1">R</label>
                                                    @if ($role->permissions->update == true)
                                                        <input id="cbUpdate" class="outline-none ml-2" type="checkbox"
                                                            checked disabled>
                                                    @else
                                                        <input id="cbUpdate" class="outline-none ml-2" type="checkbox"
                                                            disabled>
                                                    @endif
                                                    <label class="ml-1">U</label>
                                                    @if ($role->permissions->delete == true)
                                                        <input id="cbDelete" class="outline-none ml-2" type="checkbox"
                                                            checked disabled>
                                                    @else
                                                        <input id="cbDelete" class="outline-none ml-2" type="checkbox"
                                                            disabled>
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
                                    @foreach ($roles as $role)
                                        <td id="subMenu" class="text-stone-900 text-xs border p-2 align-top">
                                            @if ($role->permissions->title == 'Data Media')
                                                @foreach ($roles->objMedia->mediaRoles as $mediaRole)
                                                    <div id="menuItems" class="flex items-center">
                                                        @if ($mediaRole->access == true)
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled checked>
                                                        @else
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled>
                                                        @endif
                                                        <label class="ml-2 w-100">{{ $mediaRole->title }}</label>
                                                    </div>
                                                @endforeach
                                            @elseif ($role->permissions->title == 'Data Pemasaran')
                                                @foreach ($roles->objMarketing->marketingRoles as $marketingRole)
                                                    <div id="menuItems" class="flex items-center">
                                                        @if ($marketingRole->access == true)
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled checked>
                                                        @else
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled>
                                                        @endif
                                                        <label class="ml-2 w-100">{{ $marketingRole->title }}</label>
                                                    </div>
                                                @endforeach
                                            @elseif ($role->permissions->title == 'Data Keuangan')
                                                @foreach ($roles->objAccounting->accountingRoles as $accountingRole)
                                                    <div id="menuItems" class="flex items-center">
                                                        @if ($accountingRole->access == true)
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled checked>
                                                        @else
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled>
                                                        @endif
                                                        <label class="ml-2 w-100">{{ $accountingRole->title }}</label>
                                                    </div>
                                                @endforeach
                                            @elseif ($role->permissions->title == 'Data Produksi')
                                                @foreach ($roles->objWorkshop->workshopRoles as $workshopRole)
                                                    <div id="menuItems" class="flex items-center">
                                                        @if ($workshopRole->access == true)
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled checked>
                                                        @else
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled>
                                                        @endif
                                                        <label class="ml-2 w-100">{{ $workshopRole->title }}</label>
                                                    </div>
                                                @endforeach
                                            @elseif ($role->permissions->title == 'Data Pengguna')
                                                @foreach ($roles->objUser->userRoles as $userRole)
                                                    <div id="menuItems" class="flex items-center">
                                                        @if ($userRole->access == true)
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled checked>
                                                        @else
                                                            <input class="outline-none" id="cbSubMenu" type="checkbox"
                                                                disabled>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
