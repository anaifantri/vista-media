@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $published = date('d', strtotime($land_agreement->published)) . ' ' . $bulan[(int) date('m', strtotime($land_agreement->published))] . ' ' . date('Y', strtotime($land_agreement->published));
    $start_at = date('d', strtotime($land_agreement->start_at)) . ' ' . $bulan[(int) date('m', strtotime($land_agreement->start_at))] . ' ' . date('Y', strtotime($land_agreement->start_at));
    $end_at = date('d', strtotime($land_agreement->end_at)) . ' ' . $bulan[(int) date('m', strtotime($land_agreement->end_at))] . ' ' . date('Y', strtotime($land_agreement->end_at));
    $firstParty = json_decode($land_agreement->first_party);
    $secondParty = json_decode($land_agreement->second_party);
    $location = $land_agreement->location;
    $description = json_decode($location->description);
    ?>
    <!-- Container start -->
    <div class="flex justify-center py-10 px-14 bg-stone-800">
        <div class="bg-stone-700 p-2 border rounded-md">
            <!-- Title start -->
            <div class="flex w-[1200px] items-center border-b p-1">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[850px]">DETAIL PERJANIAN SEWA LAHAN</h1>
                <div class="flex items-center w-full justify-end">
                    <a href="/show-land-agreement/{{ $land_agreement->location->id }}"
                        class="flex items-center justify-center btn-primary mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Back </span>
                    </a>
                    @canany(['isAdmin', 'isMedia'])
                        @can('isLegal')
                            @can('isMediaEdit')
                                <a href="/media/land-agreements/{{ $land_agreement->id }}/edit"
                                    class="flex items-center justify-center btn-warning">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1"> Edit </span>
                                </a>
                            @endcan
                        @endcan
                    @endcanany
                    @canany(['isAdmin', 'isMedia'])
                        @can('isLegal')
                            @can('isMediaDelete')
                                <form action="/media/land-agreements/{{ $land_agreement->id }}" method="post" class="d-inline m-1">
                                    @method('delete')
                                    @csrf
                                    <button class="flex items-center justify-center btn-danger"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus data izin dengan nomor {{ $land_agreement->number }} ?')">
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
                        @endcan
                    @endcanany
                </div>
            </div>
            <!-- Title end -->

            <!-- View Land Agreement start -->
            <div class="flex justify-center w-full mt-2">
                <div class="w-[1200px]">
                    <div>
                        <!-- Location start -->
                        <div class="grid grid-cols-2 gap-2 w-full justify-center mt-2 p-2">
                            <div class="border rounded-lg p-2 bg-stone-200">
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Kode Lokasi</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->code }}-{{ $location->city->code }}</label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Lokasi</label>
                                    <label>:</label>
                                    <label class="ml-1">
                                        @if (strlen($location->address) > 65)
                                            {{ substr($location->address, 0, 65) }}..
                                        @else
                                            {{ $location->address }}
                                        @endif
                                    </label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Ukuran</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->media_size->size }}-{{ $location->side }}</label>
                                </div>
                            </div>
                            <div class="border rounded-lg p-2 bg-stone-200 ml-4">
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Jenis</label>
                                    <label>:</label>
                                    <label class="ml-1">
                                        {{ $location->media_category->name }}
                                        @if (
                                            $location->media_category->name != 'Videotron' ||
                                                ($location->media_category->name == 'Signage' && $description->type != 'Videotron'))
                                            - {{ $description->lighting }}
                                        @endif
                                    </label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Area</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->area->area }}</label>
                                </div>
                                <div class="flex text-stone-900 text-sm font-semibold">
                                    <label class="w-24">Kota</label>
                                    <label>:</label>
                                    <label class="ml-1">{{ $location->city->city }}</label>
                                </div>
                            </div>
                        </div>
                        <!-- Location end -->
                        <div class="flex justify-center border rounded-lg w-[1200px] p-2 mt-2">
                            <div class="w-[580px] p-2 border rounded-lg bg-stone-300">
                                <div class="flex">
                                    <label class="flex text-xs text-stone-900 w-36">Nomor Perjanjian</label>
                                    <label
                                        class="flex text-semibold w-96 border rounded-lg px-1 bg-white">{{ $land_agreement->number }}</label>
                                </div>
                                <div class="flex mt-2">
                                    <label class="text-xs text-stone-900 w-36">Tanggal Perjanjian</label>
                                    <label class="flex text-semibold w-96 border rounded-lg px-1 bg-white">
                                        {{ date('d', strtotime($land_agreement->published)) }}
                                        {{ $bulan[(int) date('m', strtotime($land_agreement->published))] }}
                                        {{ date('Y', strtotime($land_agreement->published)) }}
                                    </label>
                                </div>
                                <div class="flex mt-2">
                                    <label class="text-xs text-stone-900 w-36">Keterangan</label>
                                    <textarea class="flex text-semibold w-96  border rounded-lg p-1 outline-none" name="notes" rows="3"
                                        id="notes" readonly>{{ $land_agreement->notes }}</textarea>
                                </div>
                            </div>
                            <div class="w-[580px] p-2 ml-4 border rounded-lg bg-stone-300">
                                <div class="flex">
                                    <label class="text-xs text-stone-900 w-36">Durasi Sewa</label>
                                    <label
                                        class="flex text-semibold w-96 border rounded-lg px-1 bg-white">{{ $land_agreement->duration }}
                                        tahun</label>
                                </div>
                                <div class="flex mt-2">
                                    <label class="text-xs text-stone-900 w-36">Harga Sewa</label>
                                    <label class="flex text-semibold w-96 border rounded-lg px-1 bg-white">Rp.
                                        {{ number_format($land_agreement->price) }},-
                                        / Tahun</label>
                                </div>
                                <div class="flex mt-2">
                                    <label class="text-xs text-stone-900 w-36">Total Harga</label>
                                    <label class="flex text-semibold w-96 border rounded-lg px-1 bg-white">Rp.
                                        {{ number_format($land_agreement->price * $land_agreement->duration) }},-</label>
                                </div>
                                <div class="flex mt-2">
                                    <label class="text-xs text-stone-900 w-36">Tgl. Awal Masa Sewa</label>
                                    <label class="flex text-semibold w-96 border rounded-lg px-1 bg-white">
                                        {{ date('d', strtotime($land_agreement->start_at)) }}
                                        {{ $bulan[(int) date('m', strtotime($land_agreement->start_at))] }}
                                        {{ date('Y', strtotime($land_agreement->start_at)) }}
                                    </label>
                                </div>
                                <div class="flex mt-2">
                                    <label class="text-xs text-stone-900 w-36">Tgl. Akhir Masa Sewa</label>
                                    <label class="flex text-semibold w-96 border rounded-lg px-1 bg-white">
                                        {{ date('d', strtotime($land_agreement->end_at)) }}
                                        {{ $bulan[(int) date('m', strtotime($land_agreement->end_at))] }}
                                        {{ date('Y', strtotime($land_agreement->end_at)) }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center border rounded-lg w-[1200px] p-2 mt-2">
                            <div class="flex border rounded-lg w-[580px] p-2 bg-stone-300">
                                <div class="w-[275px] pl-2 py-2">
                                    <label
                                        class="text-xs font-semibold text-stone-900 flex justify-center w-full border-b">PIHAK
                                        PENYEWA</label>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-16">Nama</label>
                                        <label
                                            class="flex text-semibold w-48 border rounded-lg px-1 bg-white">{{ $firstParty->name }}</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-16">Alamat</label>
                                        <textarea class="flex text-semibold w-48  border rounded-lg p-1 outline-none" rows="5" readonly>{{ $firstParty->address }}</textarea>
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-16">No. KTP</label>
                                        <label
                                            class="flex text-semibold w-48 border rounded-lg px-1 bg-white">{{ $firstParty->idNumber }}</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-16">No. Hp</label>
                                        <label
                                            class="flex text-semibold w-48 border rounded-lg px-1 bg-white">{{ $firstParty->phone }}</label>
                                    </div>
                                </div>
                                <div class="w-[275px] ml-2 p-2 border-l">
                                    <div class="flex justify-center items-center">KTP</div>
                                    <div class="flex m-auto w-[275px] h-max mt-2">
                                        <img class="m-auto img-preview-first flex items-center bg-white rounded-lg"
                                            src="{{ asset('storage/' . $firstParty->idCard) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="flex border rounded-lg w-[580px] bg-stone-300 ml-4">
                                <div class="w-[275px] pl-2 py-2">
                                    <label
                                        class="text-xs font-semibold text-stone-900 flex justify-center w-full border-b">PIHAK
                                        YANG MENYEWAKAN</label>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-16">Nama</label>
                                        <label
                                            class="flex text-semibold w-48 border rounded-lg px-1 bg-white">{{ $secondParty->name }}</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-16">Alamat</label>
                                        <textarea class="flex text-semibold w-48  border rounded-lg p-1 outline-none" rows="5" readonly>{{ $secondParty->address }}</textarea>
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-16">No. KTP</label>
                                        <label
                                            class="flex text-semibold w-48 border rounded-lg px-1 bg-white">{{ $secondParty->idNumber }}</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="text-xs text-stone-900 w-16">No. Hp</label>
                                        <label
                                            class="flex text-semibold w-48 border rounded-lg px-1 bg-white">{{ $secondParty->phone }}</label>
                                    </div>
                                </div>
                                <div class="w-[275px] ml-2 p-2 border-l">
                                    <div class="flex justify-center items-center">KTP</div>
                                    <div class="flex m-auto w-[275px] h-max mt-2">
                                        <img class="m-auto img-preview-second flex items-center bg-white rounded-lg"
                                            src="{{ asset('storage/' . $secondParty->idCard) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center border rounded-lg w-[1200px] p-2 mt-4 bg-stone-300">
                        <div>
                            @include('land-agreements.agreement-documents')
                            @include('land-agreements.certificate-documents')
                            @include('land-agreements.receipt-documents')
                        </div>
                    </div>
                </div>
            </div>
            <!-- View Land Agreement end -->
        </div>
    </div>
    <!-- Container end -->
    <!-- Script start -->
    <script src="/js/showlanddocument.js"></script>
    <!-- Script end -->
@endsection
