@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center mt-10">
        <form class="md:flex" method="post" action="/dashboard/users/users" enctype="multipart/form-data">
            @csrf
            <div class="flex justify-center items-center w-full md:w-72">
                <div class="d-flex items-center p-8">
                    <label class="flex justify-center text-sm text-teal-700 mb-2">Photo Profile</label>
                    <img class="m-auto img-preview flex rounded-full items-center w-48 h-48" src="/img/photo_profile.png">
                    <input
                        class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5 @error('avatar') is-invalid @enderror"
                        type="file" id="avatar" name="avatar" onchange="previewImage()">
                    @error('avatar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="flex w-[350px] items-center">
                <div class="p-3 py-5 w-full">
                    <div class="flex items-center mb-3">
                        <h4 class="text-2xl font-semibold tracking-wider text-teal-900">Create User</h4>
                    </div>
                    <div class="mt-5 w-full">
                        <div class="mt-2"><label class="text-sm text-teal-700">Nama</label>
                            <input
                                class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('name') is-invalid @enderror"
                                type="text" id="name" name="name" placeholder="Nama Lengkap"
                                value="{{ old('name') }}" autofocus required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2"><label class="text-sm text-teal-700">Username</label>
                            <input
                                class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('username') is-invalid @enderror"
                                type="text" id="username" name="username" placeholder="Username"
                                value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2"><label class="text-sm text-teal-700">Email</label>
                            <input
                                class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('email') is-invalid @enderror"
                                type="text" id="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2"><label class="text-sm text-teal-700">No. Handphone</label>
                            <input
                                class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('phone') is-invalid @enderror"
                                type="number" id="phone" name="phone" placeholder="No. Handphone"
                                value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2"><label class="text-sm text-teal-700">Jenis Kelamin</label>
                            @php
                                $numberGender = 0;
                                $genders = ['Laki-Laki', 'Perempuan'];
                            @endphp
                            <select
                                class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('gender') is-invalid @enderror"
                                name="gender" id="gender" value="{{ old('gender') }}" required>
                                <option value="Pilih Jenis Kelamin">Pilih Jenis Kelamin</option>
                                @for ($numberGender = 0; $numberGender < count($genders); $numberGender++)
                                    @if (old('gender') == $genders[$numberGender])
                                        <option value="{{ $genders[$numberGender] }}" selected>
                                            {{ $genders[$numberGender] }}
                                        </option>
                                    @else
                                        <option value="{{ $genders[$numberGender] }}">
                                            {{ $genders[$numberGender] }}
                                        </option>
                                    @endif
                                @endfor
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2"><label class="text-sm text-teal-700">Divisi</label>
                            @php
                                $numberDivision = 0;
                                $divisions = ['Administrator', 'Media', 'Marketing', 'Accounting', 'Workshop', 'Owner', 'Guest'];
                            @endphp
                            <select
                                class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('level') is-invalid @enderror"
                                name="level" id="level" value="{{ old('level') }}" required>
                                <option value="Pilih Divisi">Pilih Divisi</option>
                                @for ($numberDivision = 0; $numberDivision < count($divisions); $numberDivision++)
                                    @if (old('level') == $divisions[$numberDivision])
                                        <option value="{{ $divisions[$numberDivision] }}" selected>
                                            {{ $divisions[$numberDivision] }}
                                        </option>
                                    @else
                                        <option value="{{ $divisions[$numberDivision] }}">
                                            {{ $divisions[$numberDivision] }}
                                        </option>
                                    @endif
                                @endfor
                            </select>
                            @error('level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2"><label class="text-sm text-teal-700">Jabatan</label>
                            @php
                                $numberPosition = 0;
                                $positions = ['Direktur', 'Sales & Marketing', 'Bagian Keuangan', 'IT'];
                            @endphp
                            <select
                                class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('position') is-invalid @enderror"
                                name="position" id="position" value="{{ old('position') }}" required>
                                <option value="Pilih Jabatan">Pilih Jabatan</option>
                                @for ($numberPosition = 0; $numberPosition < count($positions); $numberPosition++)
                                    @if (old('position') == $positions[$numberPosition])
                                        <option value="{{ $positions[$numberPosition] }}" selected>
                                            {{ $positions[$numberPosition] }}
                                        </option>
                                    @else
                                        <option value="{{ $positions[$numberPosition] }}">
                                            {{ $positions[$numberPosition] }}
                                        </option>
                                    @endif
                                @endfor
                            </select>
                            @error('position')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2 items-center">
                            <label class="text-sm text-teal-700">Password</label>
                            <input type="password"
                                class="flex px-2 text-base font-semibold text-teal-900 w-full border rounded-lg p-1 outline-teal-300 @error('password') is-invalid @enderror"
                                id="password" placeholder="Password" value="" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex mt-5">
                            <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                                name="btnSubmit">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                </svg>
                                <span class="mx-2"> Save </span>
                            </button>
                            <a href="/dashboard/users/users" class="flex items-center justify-center btn-danger mx-1">
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
            </div>
        </form>
    </div>
    <!-- Script Preview Image start-->
    <script>
        function previewImage() {
            const avatar = document.querySelector('#avatar');
            const imgPreview = document.querySelector('.img-preview');

            // imgPreview.style.display = 'block';

            const oFReader = new FileReader();

            oFReader.readAsDataURL(avatar.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
    <!-- Script Preview Image end-->
    <!-- Script Set Divisi start-->
    <script>
        // const level = document.getElementById('level');
        // const option = [];
        // const arrayLevel = ['Administrator', 'Media', 'Marketing', 'Accounting', 'Workshop', 'Owner', 'Guest'];

        // option[0] = document.createElement('option');
        // option[0].appendChild(document.createTextNode(['Pilih Divisi']));
        // option[0].setAttribute('value', 'Pilih Divisi');
        // level.appendChild(option[0]);

        // for (i = 0; i < arrayLevel.length; i++) {
        //     option[i + 1] = document.createElement('option');
        //     option[i + 1].appendChild(document.createTextNode(arrayLevel[i]));
        //     option[i + 1].setAttribute('value', arrayLevel[i]);
        //     level.appendChild(option[i + 1]);
        // }
    </script>
    <!-- Script Set Divisi end-->
@endsection
