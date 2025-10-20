@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    @endphp
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">PILIH DATA YANG AKAN DI TAKE OUT</h1>
                <a href="/workshop/takeout-contents" class="flex items-center justify-center btn-danger mx-1">
                    <svg class="fill-current w-5 rotate-180" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                    </svg>
                    <span class="mx-1"> Cancel </span>
                </a>
                @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isAccounting', 'isMarketing'])
                    @can('isContent')
                        @can('isWorkshopCreate')
                            <div class="flex">
                                <a id="linkCreate" title="Tambah Data Takeout" class="index-link btn-primary cursor-pointer"
                                    onclick="linkCreateAction()">
                                    <svg class="fill-current w-[18px]" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1">Create</span>
                                </a>
                            </div>
                        @endcan
                    @endcan
                @endcanany
            </div>
            <div>
                <!-- Form search start -->
                <form action="/workshop/takeout-contents/create">
                    <div class="flex mt-1 ml-2">
                        <div class="ml-2 w-full">
                            <span class="text-base text-stone-100">Pencarian</span>
                            <div class="flex w-full">
                                <input id="search" name="search"
                                    class="flex border rounded-l-lg px-1 outline-none text-base text-stone-900"
                                    type="text" placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                    onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                                <button class="flex border px-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                    type="submit">
                                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Form search end -->
            </div>
            <!-- View start -->
            <div class="w-[1550px] mt-2">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-28 text-center" rowspan="2">Tgl.
                                Upload</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="3">Data
                                Lokasi</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20" rowspan="2">
                                Status</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-56" rowspan="2">
                                Client</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-96" rowspan="2">Tema
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24" rowspan="2">
                                Action</th>
                        </tr>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">Kode
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center">
                                Lokasi</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                Ukuran</th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-200">
                        @php
                            $number = 1 + ($publish_contents->currentPage() - 1) * $publish_contents->perPage();
                        @endphp
                        @foreach ($publish_contents as $content)
                            @php
                                if ($content->sale_id) {
                                    $client = json_decode($content->sale->quotation->clients);
                                }
                            @endphp
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $number++ }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ date('d', strtotime($content->publish_date)) }}-{{ $bulan[(int) date('m', strtotime($content->publish_date))] }}-{{ date('Y', strtotime($content->publish_date)) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $content->location->code }}-{{ $content->location->city->code }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-1">
                                    {{ $content->location->address }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $content->location->media_size->size }}-
                                    @if ($content->location->orientation == 'Vertikal')
                                        V
                                    @else
                                        H
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @if ($content->status == 'Free')
                                        Gratis
                                    @else
                                        Berbayar
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @if ($content->status == 'Free')
                                        -
                                    @else
                                        {{ $client->company }}
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $content->theme }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    <input type="radio" name="rbContent" value="{{ $content->id }}"
                                        onclick="rbContentAction(this)">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- View end -->

            <!-- Pagination start -->
            <div class="flex justify-center text-stone-100 mt-2">
                {!! $publish_contents->appends(Request::query())->render('dashboard.layouts.pagination') !!}
            </div>
            <!-- Pagination end -->
        </div>
    </div>
    <!-- Container end -->
    <script>
        var contentId = "";
        const linkCreate = document.getElementById("linkCreate");

        rbContentAction = (sel) => {
            contentId = sel.value;

            linkCreate.setAttribute('href', '/takeout-contents/create/' + contentId);
        }

        linkCreateAction = () => {
            if (contentId == "") {
                alert("Silahkan pilih data yang akan di take out terlebih dahulu..!!");
            } else {
                linkCreate.submit();
            }
        }
    </script>
@endsection
