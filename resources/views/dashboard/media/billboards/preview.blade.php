@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Billboard start -->
    <!-- Title Show Billboard start -->
    <div class="flex justify-center mt-8 overflow-y-scroll">
        <div>
            <div class="flex border-b p-2">
                <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider">DETAIL BILLBOARD</h1>
            </div>
            <!-- Title Show Billboard end -->
            <div class="lg:flex">
                <div class="flex">
                    <div class="flex justify-center w-full">
                        <div class="mt-0 w-full ml-0">
                            <div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center mt-1">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Kode
                                            Lokasi</label>
                                        <input id="code" name="code" type="text" value="{{ $billboard->code }}"
                                            hidden>
                                        <input id="id" name="id" type="text" value="{{ $billboard->id }}"
                                            hidden>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->code }} - {{ $billboard->city->code }}</label>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Area</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->area->area }}</label>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Kota</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->city->city }}</label>
                                        <input id="city" name="city" type="text"
                                            value="{{ $billboard->city->city }}" hidden>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-start">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Lokasi</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <textarea
                                            class="flex h-max text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 w-52 lg:w-60 2xl:w-72 ml-2"
                                            readonly>{{ $billboard->address }}</textarea>
                                        <input id="address" name="address" type="text"
                                            value="{{ $billboard->address }}" hidden>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Latitude</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <input id="lat" name="lat" type="text" value="{{ $billboard->lat }}"
                                            hidden>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->lat }}</label>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Longitude</label>
                                        <input id="lng" name="lng" type="text" value="{{ $billboard->lng }}"
                                            hidden>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->lng }}</label>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Penerangan</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->lighting }}</label>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Ukuran</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->size->size }} - {{ $billboard->size->orientation }} </label>
                                    </div>
                                </div>
                                @canany(['isAdmin', 'isMarketing', 'isAccounting', 'isOwner', 'isMedia', 'Workshop'])
                                    <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b ">
                                        <div class="flex items-center">
                                            <label
                                                class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Kondisi</label>
                                            <label
                                                class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                            <label
                                                class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                                {{ $billboard->condition }}</label>
                                        </div>
                                    </div>
                                @endcanany
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Type
                                            Jalan</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->road_segment }}</label>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Jarak
                                            Pandang</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->max_distance }}</label>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Kecepatan</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                            {{ $billboard->speed_average }}</label>
                                    </div>
                                </div>
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-start">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Kawasan</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <?php
                                        $data = $billboard->sector;
                                        $sectors = explode('-', $data);
                                        ?>
                                        <div class="w-48 lg:w-56 2xl:w-64 ml-2">
                                            @foreach ($sectors as $key => $sector)
                                                @if ($sector != end($sectors))
                                                    @if ($key % 2 == 0)
                                                        <div class="flex">
                                                            <label
                                                                class="text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 w-28 lg:w-32 2xl:w-36">-
                                                                {{ $sector }}</label>
                                                        @else
                                                            <label
                                                                class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 w-28 lg:w-32 2xl:w-36">-
                                                                {{ $sector }}</label>
                                                        </div>
                                                    @endif
                                                @endif
                                                @if ($sector == end($sectors) && $key % 2 != 0)
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @canany(['isAdmin', 'isMarketing', 'isAccounting', 'isOwner', 'isMedia', 'Workshop'])
                            <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                <div class="flex items-center">
                                    <label
                                        class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Dibuat
                                        Tanggal</label>
                                    <label
                                        class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                    <label
                                        class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                        {{ date('d-M-Y', strtotime($billboard->created_at)) }}</label>
                                </div>
                            </div>
                            @canany(['isAdmin', 'isOwner', 'isMarketing'])
                                <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                    <div class="flex items-center">
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Harga</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                        <label
                                            class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">Rp.
                                            {{ number_format($billboard->price) }},-</label>
                                    </div>
                                </div>
                            @endcanany
                            <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                <div class="flex items-center">
                                    <label
                                        class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Update
                                        Terakhir</label>
                                    <label
                                        class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                    <label
                                        class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                        {{ date('d-M-Y', strtotime($billboard->updated_at)) }}</label>
                                </div>
                            </div>
                            <div class="flex mx-1 lg:mx-5 lg:w-[400px] 2xl:w-[500px] border-b">
                                <div class="flex items-center">
                                    @if ($billboard->created_at != $billboard->updated_at)
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Diupdate
                                            Oleh</label>
                                    @else
                                        <label
                                            class="flex text-xs md:text-sm lg:text-md 2xl:text-lg text-teal-700 w-20 md:w-[88px] lg:w-32 2xl:w-40">Dibuat
                                            Oleh</label>
                                    @endif
                                    <label
                                        class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-5 md:ml-10">:</label>
                                    <label
                                        class="flex text-sm md:text-sm lg:text-md 2xl:text-lg font-semibold text-slate-500 ml-2">
                                        {{ $billboard->user->name }}</label>
                                </div>
                            </div>
                        @endcanany
                        <div class="flex mx-1 lg:mx-5 mt-2 mb-2">
                            @canany(['isAdmin', 'isMarketing', 'isAccounting', 'isOwner', 'isMedia'])
                                <a class="flex justify-center items-center mx-2 btn-primary"
                                    href="/dashboard/media/billboards">
                                    <svg class="fill-current w-4 lg:w-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="m10.978 14.999v3.251c0 .412-.335.75-.752.75-.188 0-.375-.071-.518-.206-1.775-1.685-4.945-4.692-6.396-6.069-.2-.189-.312-.452-.312-.725 0-.274.112-.536.312-.725 1.451-1.377 4.621-4.385 6.396-6.068.143-.136.33-.207.518-.207.417 0 .752.337.752.75v3.251h9.02c.531 0 1.002.47 1.002 1v3.998c0 .53-.471 1-1.002 1z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1 text-sm lg:text-md lg:mx-2">Back</span>
                                </a>
                            @endcanany
                            @canany(['isAdmin', 'isMarketing', 'isMedia'])
                                <a href="/dashboard/media/billboards/{{ $billboard->id }}/edit"
                                    class="flex justify-center items-center mx-1 btn-warning">
                                    <svg class="fill-current w-4 lg:w-5" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1 text-sm lg:text-md lg:mx-2">Edit</span>
                                </a>
                                <form action="/dashboard/media/billboards/{{ $billboard->id }}" method="post"
                                    class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="flex items-center justify-center btn-danger mx-1"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus {{ $billboard->billboard_category->name }} dengan kode {{ $billboard->code }} ?')">
                                        <svg class="fill-current w-4 lg:w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1 text-sm lg:text-md lg:mx-2"> Delete </span>
                                    </button>
                                </form>
                            @endcanany
                            <button id="btn-preview" name="btn-preview"
                                class="flex justify-center items-center mx-1 btn-success">
                                <svg class="fill-current w-4 lg:w-5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M24 11v12h-24v-12h4v-10h10.328c1.538 0 5.672 4.852 5.672 6.031v3.969h4zm-6-3.396c0-1.338-2.281-1.494-3.25-1.229.453-.813.305-3.375-1.082-3.375h-7.668v13h12v-8.396zm-2 5.396h-8v-1h8v1zm0-3h-8v1h8v-1zm0-2h-8v1h8v-1z" />
                                </svg>
                                <span class="mx-1 text-sm lg:text-md lg:mx-2">Preview</span>
                            </button>
                        </div>
                        <!-- Show Billboard end -->
                    </div>
                </div>
            </div>
            <div>
                <!-- Photo Billboard start -->
                <div>
                    <div>
                        <span class="mt-2 border-b flex justify-center text-base text-cyan-800 font-semibold">Photo
                            Lokasi</span>
                        @foreach ($billboard_photos as $photo)
                            @if ($photo->billboard_code == $billboard->code && $photo->company_id == '1')
                                <img class="img-preview m-photo-billboard sm:w-[495px] sm:h-[330px] lg:w-[550px] lg:h-[367px] 2xl:w-[640px] 2xl:h-[427px] rounded-xl"
                                    src="{{ asset('storage/' . $photo->photo) }}" alt="">
                            @endif
                        @endforeach
                    </div>
                    <!-- Photo Billboard end -->
                </div>
                <div>
                    <!-- Maps Billboard start -->
                    <span class="mt-2 border-b flex justify-center text-base text-cyan-800 font-semibold">Peta
                        Lokasi</span>
                    <div class="m-map-billboard sm:w-[495px] sm:h-[330px] lg:w-[550px] lg:h-[367px] 2xl:w-[640px] 2xl:h-[427px] rounded-xl mt-2 mb-10"
                        id="map">
                    </div>
                    <!-- Maps Billboard end -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Show Billboard end -->
    <!-- Preview Billboard start -->
    <div id="modal" name="modal"
        class="absolute justify-center top-0 w-full h-[1500px] bg-black bg-opacity-90 z-50 hidden">
        <div class="overflow-x-scroll">
            <div class="w-[800px] h-8 mt-2 ml-2">
                <div class="flex relative items-center">
                    {{-- <button title="Export to PNG" id="btn-png" name="btn-png"
                        class="flex justify-center items-center mx-1 btn-warning">Save as
                        PNG</button> --}}
                    <button title="Export to PDF" id="btn-pdf" name="btn-pdf"
                        class="flex justify-center items-center mx-1 btn-danger">Save as
                        PDF</button>
                    <?php
                    $src = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $billboard->lat . ',' . $billboard->lng . '&zoom=17&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' . $billboard->lat . ',' . $billboard->lng . '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                    ?>
                    <button id="btn-close" name="btn-close" class="flex absolute justify-center items-center ml-[750px]"
                        title="Close">
                        <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="preview" name="preview" class="ml-2 w-[780px] h-[1100px] bg-white mt-2">
                <div class="flex w-full justify-center items-center">
                    <img class="mt-3" src="/img/logo-vm.png" alt="">
                </div>
                <div class="flex w-full justify-center items-center mt-2">
                    <img src="/img/line-top.png" alt="">
                </div>
                <div class="flex w-full h-[44px] justify-center items-center mt-1">
                    <div class="flex w-[700px] h-[44px] justify-start items-center bg-slate-50 border rounded-t-xl">
                        <span
                            class="flex justify-end items-center w-20 h-[36px] text-lg text-red-700 font-bold">{{ $billboard->code }}</span>
                        <span class="flex justify-start items-center w-24 h-[36px] text-lg font-bold ml-1"> -
                            {{ $billboard->city->code }}</span>
                        <img class="h-10" src="/img/code-line.png" alt="">
                        <span
                            class="flex items-center w-[575px] h-[36px] text-base font-semibold">{{ $billboard->address }}
                            | {{ strtoupper($billboard->city->city) }}</span>
                    </div>
                </div>
                <div class="flex w-full h-[465px] justify-center mt-[1px]">
                    <div class="flex w-[700px] h-[465px] justify-center items-center bg-slate-50 border rounded-b-xl">
                        @foreach ($billboard_photos as $photo)
                            @if ($photo->billboard_code == $billboard->code && $photo->company_id == '1')
                                <img class="m-auto w-[670px] h-[435px]" src="{{ asset('storage/' . $photo->photo) }}"
                                    alt="">
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="flex w-full h-[385px] justify-center mt-1">
                    <div class="flex w-[700px] h-[385px] bg-white">
                        <div class="flex w-[476px] h-[385px] bg-white justify-center">
                            <div class="">
                                <div
                                    class="flex w-[476px] h-7 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                    Google Maps
                                    Koordinat :
                                    {{ number_format($billboard->lat, 7) . ', ' . number_format($billboard->lng, 7) }}
                                </div>
                                <div class="flex relative w-[476px] h-[355px] mt-[1px] rounded-b-lg">
                                    <div class="flex absolute w-[100px] mt-[250px] ml-1">
                                        {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $billboard->lat . ',' . $billboard->lng . '/@' . $billboard->lat . ',' . $billboard->lng . ',17z') }}
                                    </div>
                                    <img class="w-[476px] h-[355px] border rounded-b-xl" id="myImage" name="myImage"
                                        src="{{ $src }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="flex w-[220px] h-[385px] bg-white justify-center ml-1">
                            <div class="">
                                <div
                                    class="flex p-1 items-center justify-center w-[220px] h-7 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                    Deskripsi Billboard
                                </div>
                                <div class="w-[220px] h-[92px] bg-slate-50 mt-[1px] rounded-b-lg border">
                                    <div class="flex mt-1">
                                        <span
                                            class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Jenis</span>
                                        <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                            {{ $billboard->billboard_category->name }} </span>
                                    </div>
                                    <div class="flex mt-1">
                                        <span
                                            class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Ukuran</span>
                                        <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                            {{ $billboard->size->size }} x {{ $billboard->size->side }} sisi</span>
                                    </div>
                                    <div class="flex mt-1">
                                        <span
                                            class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Orientasi</span>
                                        <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                            {{ $billboard->size->orientation }}</span>
                                    </div>
                                    <div class="flex mt-1">
                                        <span
                                            class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Penerangan</span>
                                        <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                            {{ $billboard->lighting }} </span>
                                    </div>
                                </div>
                                <div
                                    class="flex w-[220px] h-7 p-1 bg-slate-50 mt-[1px] border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                    Informasi Area
                                </div>
                                <div class="flex w-[220px] h-[234px] border bg-slate-50 mt-[1px] rounded-b-lg">
                                    <div>
                                        <div class="flex">
                                            <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type Jalan</span>
                                            <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                {{ $billboard->road_segment }} </span>
                                        </div>
                                        <div class="flex">
                                            <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                                Pandang</span>
                                            <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                {{ $billboard->max_distance }} </span>
                                        </div>
                                        <div class="flex">
                                            <span
                                                class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                                Kend.</span>
                                            <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                                {{ $billboard->speed_average }} </span>
                                        </div>
                                        <div class="flex">
                                            <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                                <br><br><br><br><br>
                                                {{ QrCode::size(100)->generate('https://vistamedia.co.id/dashboard/media/billboards/preview/' . $billboard->id) }}
                                            </span>
                                            <span class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                                <div>:</div>
                                                <?php
                                                $data = $billboard->sector;
                                                $sectors = explode('-', $data);
                                                ?>
                                                <div>
                                                    @foreach ($sectors as $key => $sector)
                                                        @if ($sector != end($sectors))
                                                            <div>
                                                                - {{ $sector }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex
                            w-full h-max justify-center mt-1">
                    <img src="/img/line-bottom.png" alt="">
                </div>
                <div class="flex items-center w-full justify-center">
                    <span class="text-sm font-semibold">PT. Vista Media</span>
                </div>
                <div class="flex items-center w-full justify-center">
                    <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
                </div>
                <div class="flex items-center w-full justify-center">
                    <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                </div>
                <div class="flex items-center w-full justify-center">
                    <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                </div>
            </div>
            <div class="h-10"></div>
        </div>
    </div>
    </div>
    <!-- Preview Billboard end -->
    <!-- Script Billboard start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>

    <script>
        // Google Maps --> start
        let map;
        const latitude = document.getElementById("lat");
        const longitude = document.getElementById("lng");
        const code = document.getElementById("code");
        const city = document.getElementById("city");
        const address = document.getElementById("address");
        const id = document.getElementById("id");
        let myLatLng = {
            lat: Number(latitude.value),
            lng: Number(longitude.value)
        };

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 17,
                center: myLatLng,
            });

            const marker = new google.maps.Marker({
                position: myLatLng,
                map,
                title: code.value,
                icon: "/img/marker-red.png",
            });

            marker.addListener("click", () => {
                window.location.replace("https://vistamedia.co.id/dashboard/media/billboards/" + id.value);
            });
        }
        // Google Maps --> end
        // Preview Billboard Script start -->
        // document.getElementById("btn-png").onclick = function() {
        //     const pngTarget = document.getElementById("preview");

        //     html2canvas(pngTarget).then((canvas) => {
        //         const base64image = canvas.toDataURL("image/jpg");
        //         var anchor = document.createElement('a');
        //         anchor.setAttribute("href", base64image);
        //         anchor.setAttribute("download", code.value + " - " + city.value + " - " + address.value +
        //             ".jpg");
        //         anchor.click();
        //         anchor.remove();
        //     })
        // };

        document.getElementById("btn-pdf").onclick = function() {
            var element = document.getElementById('preview');
            var opt = {
                margin: 0,
                filename: code.value + ' - ' + city.value + ' - ' + address.value + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    dpi: 192,
                    scale: 4,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            html2pdf().set(opt).from(element).save();
        };

        const modal = document.getElementById("modal");
        const btnCLose = document.getElementById("btn-close");
        const btnPreview = document.getElementById("btn-preview");

        btnPreview.addEventListener('click', function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            window.scrollTo(0, 0);
        });

        btnCLose.addEventListener('click', function() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });

        // Preview Billboard Script end -->
    </script>
    <!-- Script Billboard end -->
@endsection
