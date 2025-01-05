@extends('dashboard.layouts.main');

@section('container')
    <form method="post" action="/marketing/clients" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            @if (request('clientType') == 'Perorangan' || old('type') == 'Perorangan')
                <div class="flex justify-center items-center w-[350px] h-[550px] border rounded-lg bg-stone-300">
                    <div>
                        <img class="m-auto img-preview flex items-center w-36 h-36 md:w-48 md:h-48"
                            src="/img/photo_profile.png">
                        <label class="flex justify-center text-sm text-stone-900 mb-2">Foto Profil</label>
                        <input
                            class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-60 mt-5 @error('photo') is-invalid @enderror"
                            type="file" id="logo" name="logo" onchange="previewImage(this)">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            @elseif (request('clientType') == 'Perusahaan' || old('type') == 'Perusahaan')
                <div class="flex justify-center items-center w-[350px] h-[550px] border rounded-lg bg-stone-300">
                    <div>
                        <img class="m-auto img-preview flex items-center w-36 h-36 md:w-48 md:h-48"
                            src="/img/photo_profile.png">
                        <label class="flex justify-center text-sm text-stone-900 mb-2">Logo Perusahaan</label>
                        <input
                            class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-60 mt-5 @error('photo') is-invalid @enderror"
                            type="file" id="logo" name="logo" onchange="previewImage(this)">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            @endif
            <div class="mx-4 px-4 py-2 w-[350px] h-[550px] border rounded-lg bg-stone-300">
                <div class="flex items-center justify-center border-b">
                    <h4 class="text-2xl font-semibold tracking-wider text-stone-900">TAMBAH DATA KLIEN</h4>
                </div>
                <div class="mt-2">
                    @php
                        $types = ['Perusahaan', 'Perorangan'];
                    @endphp
                    <label class="text-sm text-stone-900">Jenis Klien</label>
                    @if (request('clientType'))
                        <select
                            class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('type') is-invalid @enderror"
                            name="type" id="type" value="{{ request('clientType') }}" onchange="submitType(this)"
                            required>
                            <option value="pilih">Pilih Jenis Klien</option>
                            @foreach ($types as $type)
                                @if (request('clientType') == $type)
                                    <option value="{{ $type }}" selected>
                                        {{ $type }}
                                    </option>
                                @else
                                    <option value="{{ $type }}">
                                        {{ $type }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <select
                            class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('type') is-invalid @enderror"
                            name="type" id="type" value="{{ old('type') }}" onchange="submitType(this)" required>
                            <option value="pilih">Pilih Jenis Klien</option>
                            @foreach ($types as $type)
                                @if (old('type') == $type)
                                    <option value="{{ $type }}" selected>
                                        {{ $type }}
                                    </option>
                                @else
                                    <option value="{{ $type }}">
                                        {{ $type }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    @endif
                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if (request('clientType') == 'Perorangan' || old('type') == 'Perorangan')
                    <div id="divPersonal" class="w-full">
                        <div class="mt-2">
                            <label class="text-sm text-stone-900">Nama</label>
                            <input
                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                type="text" id="name" name="name" placeholder="Nama Klien"
                                value="{{ old('name') }}" autofocus required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900">Alamat</label>
                            <textarea
                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                name="address" rows="3" id="address" required placeholder="Alamat Perusahaan">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900">Email</label>
                            <input
                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                type="email" id="email" name="email" placeholder="Email Perusahaan"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label class="text-sm text-stone-900">No. Handphone</label>
                            <input
                                class="flex px-2 text-sm in-out-spin-none font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                type="number" min="0" id="phone" name="phone" placeholder="No. Handphone"
                                value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex justify-center mt-2">
                            <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                                name="btnSubmit">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                </svg>
                                <span class="mx-2"> Save </span>
                            </button>
                            <a href="/marketing/clients" class="flex items-center justify-center btn-danger mx-1">
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
                @elseif (request('clientType') == 'Perusahaan' || old('type') == 'Perusahaan')
                    <div id="divCompany" class="w-full">
                        <div class="mt-1">
                            <label class="text-sm text-stone-900">Nama Klien</label>
                            <input
                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                type="text" id="name" name="name" placeholder="Nama Klien"
                                value="{{ old('name') }}" autofocus required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-1">
                            <label class="text-sm text-stone-900">Nama Perusahaan</label>
                            <input
                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('company') is-invalid @enderror"
                                type="text" id="company" name="company" placeholder="Nama Perusahaan"
                                value="{{ old('company') }}" required>
                            @error('company')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-1">
                            <label class="text-sm text-stone-900">Alamat Perusahaan</label>
                            <textarea
                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                name="address" rows="3" id="address" required placeholder="Alamat Perusahaan">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-1">
                            <label class="text-sm text-stone-900">Katagori</label>
                            <select
                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('client_category_id') is-invalid @enderror"
                                name="client_category_id" id="client_category_id"
                                value="{{ old('client_category_id') }}" required>
                                <option value="pilih">Pilih Katagori</option>
                                @foreach ($client_categories as $client_category)
                                    @if (old('client_category_id') == $client_category->id)
                                        <option value="{{ $client_category->id }}" selected>
                                            {{ $client_category->name }}
                                        </option>
                                    @else
                                        <option value="{{ $client_category->id }}">
                                            {{ $client_category->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('client_category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-1">
                            <label class="text-sm text-stone-900">Email</label>
                            <input
                                class="flex px-2 text-sm font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                type="email" id="email" name="email" placeholder="Email Perusahaan"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-1">
                            <label class="text-sm text-stone-900">No. Telepon</label>
                            <input
                                class="flex px-2 text-sm in-out-spin-none font-semibold text-stone-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                type="number" min="0" id="phone" name="phone"
                                placeholder="No. Telepon Perusahaan" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex justify-center mt-2">
                            <button class="flex items-center justify-center btn-primary mx-1" type="submit"
                                id="btnSubmit" name="btnSubmit">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                </svg>
                                <span class="mx-2"> Save </span>
                            </button>
                            <a href="/marketing/clients" class="flex items-center justify-center btn-danger mx-1">
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
                @endif
            </div>
        </div>
    </form>
    <form id="formType" action="/marketing/clients/create">
        <input id="clientType" name="clientType" type="text" hidden>
    </form>

    <!-- Script Preview Image start-->
    <script src="/js/previewimage.js"></script>
    <!-- Script Preview Image end-->
    <script>
        submitType = (sel) => {
            if (sel.value != "pilih") {
                document.getElementById("clientType").value = sel.value;
                document.getElementById("formType").submit();
            }
        }
    </script>
@endsection
