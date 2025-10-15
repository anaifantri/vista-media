@extends('dashboard.layouts.main');

@section('container')
    <!-- Form Create start -->
    <form action="/workshop/electrical-powers/{{ $electrical_power->id }}" method="post">
        @method('put')
        @csrf
        <input name="user_id" value="{{ auth()->user()->id }}" type="text" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="p-4 w-[1000px] border rounded-lg bg-stone-300">
                <div class="flex items-center justify-center border-b p-1">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-900 w-[600px]">EDIT DATA DAYA LISTRIK</h4>
                    <div class="flex justify-end w-full">
                        <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                            name="btnSubmit">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                            </svg>
                            <span class="mx-2"> Save </span>
                        </button>
                        <a href="/workshop/electrical-powers/{{ $electrical_power->id }}"
                            class="flex items-center justify-center btn-danger mx-1">
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
                <!-- View Create start -->
                <div class="flex w-full justify-center mt-4">
                    <div class="w-[485px] border rounded-lg p-2 bg-stone-200">
                        <div class="mt-2">
                            <span class="text-sm text-stone-900">ID Pelanggan</span>
                            <input name="id_number"
                                class="flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('id_number') is-invalid @enderror"
                                value="{{ $electrical_power->id_number }}" type="text" autofocus required>
                        </div>
                        @error('id_number')
                            <div class="text-red-600 flex mx-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-2">
                            <span class="text-sm text-stone-900">Nama</span>
                            <input name="name"
                                class=" flex w-[450px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('name') is-invalid @enderror"
                                value="{{ $electrical_power->name }}" type="text" required>
                        </div>
                        @error('name')
                            <div class="text-red-600 flex mx-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-[485px] border rounded-lg p-2 bg-stone-200 ml-4">
                        @php
                            $types = ['Prabayar', 'Pascabayar'];
                        @endphp
                        <div class="flex mt-1">
                            <label class="text-sm text-stone-900">Jenis Daya Listrik</label>
                        </div>
                        <div class="mt-2">
                            <select id="type" name="type"
                                class="w-[450px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none
                                    @error('type') is-invalid @enderror"
                                type="text" value="{{ $electrical_power }}">
                                @foreach ($types as $type)
                                    @if ($electrical_power == $type)
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
                        </div>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-2">
                            @php
                                $powers = [
                                    '1300',
                                    '2200',
                                    '3500',
                                    '4400',
                                    '5500',
                                    '6600',
                                    '7700',
                                    '13200',
                                    '23000',
                                    '33000',
                                    '41500',
                                ];
                            @endphp
                            <div class="flex mt-1">
                                <label class="text-sm text-stone-900">Besaran Daya Listrik</label>
                            </div>
                            <div class="mt-1">
                                <select name="power"
                                    class="w-[450px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none
                            @error('power') is-invalid @enderror"
                                    type="text" value="{{ $electrical_power->power }}">
                                    @foreach ($powers as $power)
                                        @if ($electrical_power->power == $power)
                                            <option value="{{ $power }}" selected>
                                                {{ $power }}
                                            </option>
                                        @else
                                            <option value="{{ $power }}">
                                                {{ $power }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('power')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <!-- View Create end -->
                <div class="flex border-b items-center">
                    <div class="flex items-center text-md text-stone-900 mt-4 font-semibold w-96">
                        Daftar Lokasi Yang Menggunakan
                    </div>
                    <div class="flex w-full justify-end">
                        <a href="/electrical-power/show-location/{{ $electrical_power->area_id }}/{{ $electrical_power->city_id }}/{{ $electrical_power->id }}"
                            class="flex items-center justify-center btn-primary mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Tambah Lokasi </span>
                        </a>
                    </div>
                </div>
                <!-- Alert start -->
                @if (session()->has('success'))
                    <div class="ml-2 flex alert-success">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
                <!-- Alert end -->
                <!-- Location start -->
                @foreach ($electrical_power->locations as $location)
                    @php
                        $description = json_decode($location->description);
                        $location_photos = $location->location_photos
                            ->where('company_id', $company->id)
                            ->where('set_default', true);
                    @endphp
                    <div class="flex justify-end mt-2">
                        <a href="/electrical-power/delete-location/{{ $location->id }}/{{ $electrical_power->id }}"
                            class="flex items-center justify-center btn-danger mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Hapus Lokasi </span>
                        </a>
                    </div>
                    <div class="flex w-full justify-center mt-1">
                        <div class="flex w-full justify-center mt-1">
                            <div class="w-[485px] border rounded-lg p-2 bg-stone-200">
                                <div>
                                    <label class="text-sm text-stone-900">Kode Lokasi</label>
                                    <label
                                        class="flex w-[150px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->code }}-{{ $location->city->code }}</label>
                                </div>
                                <div>
                                    <label class="text-sm text-stone-900">Alamat</label>
                                    <textarea class="flex w-[460px] bg-slate-50 text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none"
                                        rows="2" disabled>{{ $location->address }}</textarea>
                                </div>
                                <div class="flex">
                                    <div>
                                        <div>
                                            <label class="text-sm text-stone-900">Jenis</label>
                                            <label
                                                class="flex w-[220px] bg-slate-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">
                                                {{ $location->media_category->name }}
                                                @if (
                                                    $location->media_category->name != 'Videotron' ||
                                                        ($location->media_category->name == 'Signage' && $description->type != 'Videotron'))
                                                    - {{ $description->lighting }}
                                                @endif
                                            </label>
                                        </div>
                                        <div>
                                            <label class="text-sm text-stone-900">Ukuran</label>
                                            <label
                                                class="flex w-[220px] bg-slate-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->media_size->size }}
                                                - {{ $location->orientation }}</label>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div>
                                            <label class="text-sm text-stone-900">Area</label>
                                            <label
                                                class="flex w-[220px] bg-slate-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->area->area }}</label>
                                        </div>
                                        <div>
                                            <label class="text-sm text-stone-900">Kota</label>
                                            <label
                                                class="flex w-[220px] bg-slate-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->city->city }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex justify-center items-center w-[485px] border rounded-lg py-4 bg-stone-200 ml-4">
                                <img class="w-[420px] border rounded-lg"
                                    src="{{ asset('storage/' . $location_photos[0]->photo) }}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Location end -->
            </div>
        </div>
    </form>
    <!-- Form Create end -->
@endsection
