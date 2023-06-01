@extends('dashboard.layouts.main');

@section('container')
    <!-- Container Index Area start -->
    <div class="Flex justify-center mt-10">
        <div class="index-container">
            <!-- Title Area start -->
            <div class="index-title">
                <h1 class="index-h1"> DAFTAR AREA</h1>
            </div>
            <!-- Title Area end -->
            <!-- Button Create New Area start -->
            @canany(['isAdmin', 'isMarketing'])
                <div class="index-btnAdd">
                    <a href="/dashboard/media/area/create" class="index-link btn-primary"><span></span>
                        <svg class="fill-current w-6 mx-1" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Tambah Area</span>
                    </a>
                </div>
            @endcanany
            <!-- Button Create New Area end -->
            <!-- Alert Success Create New Area start -->
            @if (session()->has('success'))
                <div class="index-alert alert-success" role="alert">
                    <svg class="fill-current mx-1 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="mx-1"> {{ session('success') }} </span>
                </div>
            @endif
            <!-- Alert Success Create New Area end -->
            <!-- View Area start -->
            <div class="index-table">
                <table class="table-auto bg-white">
                    <thead class="bg-slate-100">
                        <tr class="index-tr">
                            <th class="index-td w-8">No.</th>
                            <th class="index-td w-16">Kode</th>
                            <th class="index-td w-36">Provinsi</th>
                            <th class="index-td w-36">Nama Area</th>
                            <th class="index-td w-24">Latitude</th>
                            <th class="index-td w-24">Longitude</th>
                            <th class="index-td w-20">Zoom</th>
                            <th class="index-td w-24">Dibuat Oleh</th>
                            <th class="index-td w-36">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $area)
                            <tr class="index-tr">
                                <td class="index-td w-8">{{ $loop->iteration }}</td>
                                <td class="index-td w-16">{{ $area->area_code }}</td>
                                <td class="index-td w-36">{{ $area->provinsi }}</td>
                                <td class="index-td w-36">{{ $area->area }}</td>
                                <td class="index-td w-24">{{ $area->lat }}</td>
                                <td class="index-td w-24">{{ $area->lng }}</td>
                                <td class="index-td w-20">{{ $area->zoom }}</td>
                                <td class="index-td w-24">{{ $area->user->name }}</td>
                                <td class="index-td w-36">
                                    <a href="/dashboard/media/area/{{ $area->id }}"
                                        class="index-link text-white m-1 w-7 h-5 bg-cyan-400 rounded-md hover:bg-cyan-500">
                                        <svg class="w-5 fill-current" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <title>VIEW</title>
                                            <path
                                                d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                                                fill-rule="nonzero" />
                                        </svg>
                                    </a>
                                    @canany(['isAdmin', 'isMarketing'])
                                        <form action="/dashboard/media/area/{{ $area->id }}" method="post"
                                            class="d-inline m-1">
                                            @method('delete')
                                            @csrf
                                            <button class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus area {{ $area->area }} ?')">
                                                <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <title>DELETE</title>
                                                    <path
                                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endcanany
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- View Area end -->
        </div>
    </div>
    <!-- Container Index Area end -->
@endsection
