@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center mt-10">
        <form class="md:flex" method="post" action="/dashboard/media/signage-categories" enctype="multipart/form-data">
            @csrf
            <div class="flex w-[300px] justify-center items-center">
                <div class="p-3 w-full">
                    <div class="flex items-center justify-center mb-2 border-b w-full">
                        <h4 class="text-xl font-semibold tracking-wider text-teal-900">Tambah Katagori Signage</h4>
                    </div>
                    <div class="flex justify-center mt-5 w-full">
                        <div>
                            <div class="mt-1">
                                <label class="text-sm text-teal-700">Katagori</label>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-[250px] border rounded-lg p-1 outline-none @error('name') is-invalid @enderror"
                                    type="text" id="name" name="name" placeholder="Input nama katagori"
                                    value="{{ old('name') }}" autofocus required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-1">
                                <label class="text-sm text-teal-700">Deskripsi</label>
                                <textarea
                                    class="flex text-sm font-semibold text-teal-900 w-[250px]  border rounded-lg p-1 outline-none @error('description') is-invalid @enderror"
                                    name="description" id="description" placeholder="Input deskripsi katagori">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex mt-5">
                                <button class="flex items-center justify-center btn-primary mx-1">
                                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                    </svg>
                                    <span class="mx-2"> Save </span>
                                </button>
                                <a href="/dashboard/media/signage-categories"
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
