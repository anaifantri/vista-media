@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center mt-10">
        <div class="md:flex">
            <div class="flex justify-center items-center w-full md:w-72">
                <div class="d-flex items-center p-8">
                    @if ($user->avatar)
                        <img class="m-auto img-preview flex rounded-full items-center w-48 h-48"
                            src="{{ asset('storage/' . $user->avatar) }}">
                    @else
                        <img class="m-auto img-preview flex rounded-full items-center w-48 h-48" src="/img/photo_profile.png">
                    @endif
                    <span class="flex justify-center font-semibold text-teal-900 border-b mt-3">{{ $user->name }}</span>
                    <span class="flex justify-center text-teal-700 text-sm">{{ $user->email }}</span>
                </div>
            </div>
            <div class="flex w-[350px] items-center">
                <div class="p-3 py-5 w-full">
                    @if (session()->has('success'))
                        <div class="flex alert-success">
                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                            </svg>
                            <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                        </div>
                    @endif
                    <div class="flex items-center mb-3">
                        <h4 class="text-2xl font-semibold tracking-wider text-teal-900">Detail User</h4>
                    </div>
                    <div class="mt-5 w-full">
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Nama</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $user->name }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Username</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $user->username }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Email</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $user->email }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">No. Handphone</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $user->phone }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Jenis Kelamin</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $user->gender }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Divisi</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $user->level }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Jabatan</label>
                            <h6 class="text-base font-semibold text-teal-900">{{ $user->position }}</h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Tanggal Terdaftar</label>
                            <h6 class="text-base font-semibold text-teal-900">
                                {{ $user->created_at->format('l, d-M-Y') }}
                            </h6>
                        </div>
                        <div class="border-b mt-2"><label class="text-sm text-teal-700">Tanggal Perubahan
                                Terakhir</label>
                            <h6 class="text-base font-semibold text-teal-900">
                                {{ $user->updated_at->format('l, d-M-Y') }}
                            </h6>
                        </div>
                        <div class="flex mt-2">
                            @if (auth()->user()->level === 'Administrator')
                                <a href="/dashboard/users/users" class="flex items-center justify-center btn-primary mx-1">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1"> Back to User </span>
                                </a>
                            @else
                                <a href="/dashboard" class="flex items-center justify-center btn-primary mx-1">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1"> Back to home </span>
                                </a>
                            @endif
                            @if ($user->id === auth()->user()->id)
                                <a href="/dashboard/users/users/{{ $user->id }}/edit"
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
                            @else
                                @can('isAdmin')
                                    <a href="/dashboard/users/users/{{ $user->id }}/edit"
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
                                @endcan
                            @endif
                            @can('isAdmin')
                                <form action="/dashboard/users/users/{{ $user->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="flex items-center justify-center btn-danger mx-1"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus User {{ $user->username }} ?')">
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
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
