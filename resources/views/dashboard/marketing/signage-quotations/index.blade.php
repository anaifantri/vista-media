@extends('dashboard.layouts.main');

@section('container')
    <div class="mt-10 z-0">
        <div class="flex justify-center w-full">
            <div class="w-[1200px] p-2">
                <div class="flex">
                    <h1 class="index-h1"> Daftar Surat Penawaran Signage</h1>
                    <div class="flex border-b">
                        <a href="/dashboard/marketing/signage-quotations/create" class="index-link btn-primary">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Buat Penawaran</span>
                        </a>
                    </div>
                </div>
                <form class="flex mt-2" action="/dashboard/marketing/signage-quotations/">
                    <div class="flex">
                        <input id="search" name="search"
                            class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900" type="text"
                            placeholder="Search" value="{{ request('search') }}">
                        <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                            type="submit">
                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                            </svg>
                        </button>
                    </div>
                    @if (session()->has('success'))
                        <div class="ml-2 flex alert-success">
                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                            </svg>
                            <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="flex justify-center w-full">
            <div class="w-[1200px]">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="text-teal-700 bg-teal-100 h-8 border text-sm w-8">No.</th>
                            <th class="text-teal-700 bg-teal-100 h-8 border text-sm w-40">
                                <button class="flex justify-center items-center w-44">@sortablelink('number', 'Nomor Penawaran')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-teal-700 bg-teal-100 h-8 border text-sm w-32">Klien</th>
                            <th class="text-teal-700 bg-teal-100 h-8 border text-sm w-36">Kontak Person</th>
                            <th class="text-teal-700 bg-teal-100 h-8 border text-sm">Lokasi</th>
                            <th class="text-teal-700 bg-teal-100 h-8 border text-sm w-32">Status</th>
                            <th class="text-teal-700 bg-teal-100 h-8 border text-sm w-24">Tgl. Dibuat</th>
                            <th class="text-teal-700 bg-teal-100 h-8 border text-sm w-24">Dibuat Oleh</th>
                            <th class="text-teal-700 bg-teal-100 h-8 border text-sm w-16">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($signage_quotations as $signage_quotation)
                            <tr>
                                <td class="text-teal-700 border text-sm text-center">{{ $loop->iteration }}</td>
                                <td class="text-teal-700 border text-sm text-center">{{ $signage_quotation->number }}</td>
                                <td class="text-teal-700 border text-sm text-center">
                                    {{ $signage_quotation->client->name }}
                                </td>
                                <td class="text-teal-700 border text-sm text-center">
                                    {{ $signage_quotation->client_contact }}
                                </td>
                                <td class="text-teal-700 border w-60 text-sm text-center">
                                    <?php
                                    $products = json_decode($signage_quotation->products);
                                    ?>
                                    @foreach ($products as $product)
                                        @if ($product != end($products))
                                            {{ $product->code }} - {{ $product->city_code }} |
                                        @else
                                            {{ $product->code }} - {{ $product->city_code }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-teal-700 border text-sm text-center">
                                    @if ($signage_quotation->signage_quot_statuses[count($signage_quotation->signage_quot_statuses) - 1]->signage_quot_revision_id)
                                        Revision :
                                        {{ $signage_quotation->signage_quot_statuses[count($signage_quotation->signage_quot_statuses) - 1]->status }}
                                    @else
                                        Main :
                                        {{ $signage_quotation->signage_quot_statuses[count($signage_quotation->signage_quot_statuses) - 1]->status }}
                                    @endif
                                </td>
                                <td class="text-teal-700 border text-sm text-center">
                                    {{ date('d-M-Y', strtotime($signage_quotation->created_at)) }}</td>
                                <td class="text-teal-700 border text-sm text-center">
                                    <?php
                                    $created_by = json_decode($signage_quotation->created_by);
                                    ?>
                                    {{ $created_by->name }}
                                </td>
                                <td class="text-teal-700 border text-sm text-center align-center">
                                    <div class="flex justify-center">
                                        <a href="/dashboard/marketing/signage-quotations/{{ $signage_quotation->id }}"
                                            class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mr-1">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center text-teal-900">
            {{ $signage_quotations->links() }}
        </div>
    </div>
@endsection
