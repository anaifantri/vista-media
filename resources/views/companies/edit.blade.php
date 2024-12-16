@extends('dashboard.layouts.main');

@section('container')
    <form method="post" action="/media/companies/{{ $company->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex items-center w-[900px] border-b">
                    <!-- Title Area start -->
                    <h1 class="index-h1 w-[500px]">MERUBAH DATA PERUSAHAAN</h1>
                    <!-- Title Area end -->
                    <div class="flex w-full justify-end items-center p-1">
                        <button class="flex justify-center items-center mx-1 btn-primary" type="submit">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="mx-1">Save</span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger" href="/media/companies">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center items-center w-[900px] mt-2">
                    <div class="flex justify-center items-center w-[400px] h-[500px] p-4 border rounded-lg bg-stone-300">
                        <div>
                            <input type="hidden" name="oldLogo" value="{{ $company->logo }}">
                            @if ($company->logo)
                                <img class="m-auto img-preview rounded-lg flex items-center w-44"
                                    src="{{ asset('storage/' . $company->logo) }}">
                            @else
                                <img class="m-auto img-preview rounded-lg flex items-center w-44"
                                    src="/img/photo_profile.png">
                            @endif
                            <label class="flex justify-center text-sm text-stone-900 mt-2">Logo Perusahaan</label>
                            <input
                                class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-4 @error('logo') is-invalid @enderror"
                                type="file" id="logo" name="logo" onchange="previewImage(this)">
                            @error('logo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex ml-4 justify-center w-[500px] h-[500px] p-4 border rounded-lg bg-stone-300">
                        <div class="p-2 w-full">
                            <div class="border-b mt-2">
                                <label class="flex text-sm text-stone-900">Kode</label>
                                <label class="flex text-semibold">{{ $company->code }}</label>
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Nama Perusahaan</label>
                                <input
                                    class="flex px-2 text-semibold w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                    type="text" id="name" name="name" value="{{ $company->name }}" required
                                    autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Alamat Perusahaan</label>
                                <textarea
                                    class="flex px-2 text-semibold w-full border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                    name="address" id="address" placeholder="Input Alamat Perusahaan" required>{{ $company->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">Email</label>
                                <input
                                    class="flex px-2 text-semibold w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                    type="text" id="email" name="email" value="{{ $company->email }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">No. Telepon</label>
                                <input
                                    class="flex px-2 text-semibold w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                    type="text" id="phone" name="phone" value="{{ $company->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2"><label class="text-sm text-stone-900">No. Hp</label>
                                <input
                                    class="flex px-2 text-semibold w-full border rounded-lg p-1 outline-teal-300 @error('m_phone') is-invalid @enderror"
                                    type="text" id="m_phone" name="m_phone" value="{{ $company->m_phone }}">
                                @error('m_phone')
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

    <!-- Script Preview Image start-->
    <script src="/js/previewimage.js"></script>
    <!-- Script Preview Image end-->
@endsection
