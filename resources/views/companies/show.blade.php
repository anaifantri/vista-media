@extends('dashboard.layouts.main');

@section('container')
    <?php
    $createdDate = strtotime($company->created_at);
    $updatedDate = strtotime($company->updated_at);
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <div class="flex justify-center">
        <div class="mt-10">
            <!-- Show Title start -->
            <div class="flex w-[900px] items-center border-b">
                <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider w-[800px]">DATA PERUSAHAAN
                    {{ strtoupper($company->name) }} </h1>
                <div class="flex w-full justify-end items-center">
                    <a href="/companies" class="flex items-center justify-center btn-primary mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Back</span>
                    </a>
                    @can('isAdmin')
                        <a href="/companies/{{ $company->id }}/edit" class="flex items-center justify-center btn-warning mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Edit </span>
                        </a>
                        <form action="/companies/{{ $company->id }}" method="post" class="d-inline mt-4">
                            @method('delete')
                            @csrf
                            <button class="flex items-center justify-center btn-danger mx-1"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data perusahaan dengan nama {{ $company->name }} ?')">
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
                </div>
            </div>
            <!-- Show Title end -->
            <div class="flex justify-center items-center w-[900px]">
                <!-- Logo Company Start -->
                <div class="flex justify-center mt-2 w-[400px]">
                    <div>
                        @if ($company->logo)
                            <img class="m-auto img-preview flex items-center w-44"
                                src="{{ asset('storage/' . $company->logo) }}">
                        @else
                            <img class="m-auto img-preview flex items-center w-44" src="/img/photo_profile.png">
                        @endif
                        <span
                            class="flex justify-center font-semibold text-teal-900 border-b mt-3">{{ $company->name }}</span>
                        <span class="flex justify-center text-teal-700 text-sm text-center">{{ $company->address }}</span>
                    </div>
                </div>
                <!-- Logo Company End -->
                <!-- Detail Company Start -->
                <div class="flex justify-center w-[500px] mt-2">
                    <div>
                        <div class="border-b mt-2">
                            <label class="flex text-sm text-teal-700">Kode</label>
                            <label class="flex text-semibold">{{ $company->code }}</label>
                        </div>
                        <div class="border-b mt-2">
                            <label class="flex text-sm text-teal-700">Nama Perusahaan</label>
                            <label class="flex text-semibold">{{ $company->name }}</label>
                        </div>
                        <div class="border-b mt-2">
                            <label class="flex text-sm text-teal-700">Alamat</label>
                            <label class="flex text-semibold">{{ $company->address }}</label>
                        </div>
                        <div class="border-b mt-2">
                            <label class="flex text-sm text-teal-700">Email</label>
                            @if ($company->email)
                                <label class="flex text-semibold">{{ $company->email }}</label>
                            @else
                                <label class="flex text-semibold">-</label>
                            @endif
                        </div>
                        @if ($company->phone)
                            <div class="border-b mt-2">
                                <label class="flex text-sm text-teal-700">No. Telepon</label>
                                <label class="flex text-semibold">{{ $company->phone }}</label>
                            </div>
                        @endif
                        @if ($company->m_phone)
                            <div class="border-b mt-2">
                                <label class="flex text-sm text-teal-700">No. Hp.</label>
                                <label class="flex text-semibold">{{ $company->m_phone }}</label>
                            </div>
                        @endif
                        @if ($company->created_at != $company->updated_at)
                            <div class="border-b mt-2">
                                <label class="flex text-sm text-teal-700">Diupdate Oleh</label>
                                <label class="flex text-semibold">{{ $company->user->name }}</label>
                            </div>
                        @else
                            <div class="border-b mt-2">
                                <label class="flex text-sm text-teal-700">Dibuat Oleh</label>
                                <label class="flex text-semibold">{{ $company->user->name }}</label>
                            </div>
                        @endif
                        <div class="border-b mt-2">
                            <label class="flex text-sm text-teal-700">Tanggal Dibuat</label>
                            <label class="flex text-semibold">{{ date('d', $createdDate) }}
                                {{ $bulan[(int) date('m', $createdDate)] }}
                                {{ date('Y', $createdDate) }}</label>
                        </div>
                        <div class="border-b mt-2">
                            <label class="flex text-sm text-teal-700">Tanggal Perubahan Terakhir</label>
                            <label class="flex text-semibold">{{ date('d', $updatedDate) }}
                                {{ $bulan[(int) date('m', $updatedDate)] }}
                                {{ date('Y', $updatedDate) }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Detail Company End -->
        </div>
    </div>
    </div>
    <!-- Script Preview Photo start-->
    <script>
        function previewPhoto() {
            const photo = document.querySelector('#photo');
            const photoPreview = document.querySelector('.photo-preview');

            // imgPreview.style.display = 'block';

            const oFReader = new FileReader();

            oFReader.readAsDataURL(photo.files[0]);

            oFReader.onload = function(oFREvent) {
                photoPreview.src = oFREvent.target.result;
            }
        }
    </script>
    <!-- Script Preview Photo end-->
@endsection
