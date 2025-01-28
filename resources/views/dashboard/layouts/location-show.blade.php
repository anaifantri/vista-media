<!-- Show Location start -->
@php
    $description = json_decode($location->description);
    $location_photos = $data_photos->where('company_id', $company->id);
@endphp
<div class="flex justify-center">
    <input type="text" name="description" id="description" hidden>
    <div class="flex justify-start border bg-stone-300 rounded-lg w-[500px] h-[500px] px-4 py-2 overflow-y-scroll">
        <div>
            <!-- Location Data start -->
            <div class="w-[450px] border rounded-lg p-2 mt-2 bg-stone-200">
                <div class="flex">
                    <label class="text-semibold">Data Lokasi</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Kode</label>
                    <label class="text-sm text-stone-900">:</label>
                    <label class="text-semibold ml-2">{{ $location->code }}-{{ $location->city->code }}</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Area</label>
                    <label class="text-sm text-stone-900">:</label>
                    <label class="text-semibold ml-2">{{ $location->area->area }}</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Kota</label>
                    <label class="text-sm text-stone-900">:</label>
                    <label class="text-semibold ml-2">{{ $location->city->city }}</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Lokasi</label>
                    <label class="text-sm text-stone-900">:</label>
                    <label class="text-semibold w-[300px] ml-2">{{ $location->address }}</label>
                </div>
                @if ($location->media_category->name == 'Signage')
                    <div class="flex">
                        <label class="text-sm text-stone-900 w-28">Koordinat</label>
                        <label class="text-sm text-stone-900">: </label>
                        <div class="text-semibold ml-2">
                            @foreach ($description->lat as $coordinat)
                                <div>
                                    {{ $loop->iteration }}. {{ $coordinat }},
                                    {{ $description->lng[$loop->iteration - 1] }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="flex">
                        <label class="text-sm text-stone-900 w-28">Koordinat</label>
                        <label class="text-sm text-stone-900">:</label>
                        <label class="text-semibold ml-2">{{ number_format($description->lat, 7) }},
                            {{ number_format($description->lng, 7) }}</label>
                    </div>
                @endif

            </div>
            <!-- Location Data end -->

            <!-- Deskription start -->
            <div class="w-[450px] border rounded-lg p-2 mt-2 bg-stone-200">
                @if ($location->media_category->name == 'Videotron')
                    @include('dashboard.layouts.vt-description-view')
                @elseif ($location->media_category->name == 'Signage')
                    @include('dashboard.layouts.sn-description-view')
                @else
                    @include('dashboard.layouts.bb-description-view')
                @endif
            </div>
            <!-- Deskription end -->

            <!-- Information Area start -->
            <div class="w-[450px] border rounded-lg p-2 mt-2 bg-stone-200">
                <div class="flex">
                    <label class="text-semibold">Informasi Area</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Jumlah Lajur</label>
                    <label class="text-semibold">: {{ $location->road_segment }}</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Jarak Pandang</label>
                    <label class="text-semibold">: {{ $location->max_distance }}</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Kecepatan</label>
                    <label class="text-semibold">: {{ $location->speed_average }}</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Kawasan</label>
                    <label class="text-sm text-stone-900">: </label>
                    <div class="text-semibold ml-2">
                        @foreach ($sectors->dataSector as $sector)
                            <div>
                                - {{ $sector }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Information Area end -->
            @canany(['isAdmin', 'isMedia', 'isMarketing', 'isAccounting', 'isOwner'])
                @can('isLocation')
                    <div class="w-[450px] border rounded-lg p-2 mt-2 bg-stone-200">
                        <div class="flex">
                            <label class="text-semibold">Data Harga</label>
                        </div>
                        <div class="flex">
                            <label class="text-sm text-stone-900 w-28">Harga</label>
                            <label class="text-semibold">: Rp. {{ number_format($location->price) }},-</label>
                        </div>
                    </div>
                @endcan
            @endcanany

            <!-- Information Area start -->
            <div class="w-[450px] border rounded-lg p-2 mt-2 bg-stone-200">
                <div class="flex">
                    <label class="text-semibold">Informasi Lainnya</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Dibuat Tanggal</label>
                    <label class="text-semibold">: {{ date('d', strtotime($location->created_at)) }}
                        {{ $bulan[(int) date('m', strtotime($location->created_at))] }}
                        {{ date('Y', strtotime($location->created_at)) }}</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Dibuat Oleh</label>
                    <label class="text-semibold">: {{ $created_by->name }}</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Tanggal Update</label>
                    <label class="text-semibold">: {{ date('d', strtotime($location->updated_at)) }}
                        {{ $bulan[(int) date('m', strtotime($location->updated_at))] }}
                        {{ date('Y', strtotime($location->updated_at)) }}</label>
                </div>
                <div class="flex">
                    <label class="text-sm text-stone-900 w-28">Diupdate Oleh</label>
                    <label class="text-semibold">: {{ $created_by->name }}</label>
                </div>
            </div>
            <!-- Information Area end -->
        </div>
    </div>
    <!-- Location Photo & Maps start -->
    <div class="flex justify-center bg-stone-300 w-[650px] p-4 ml-4">
        <div>
            <div>
                <!-- Location Photo start -->
                <span class="flex justify-center border-b text-base font-semibold">Foto Lokasi</span>
                <figure id="figure"
                    class="flex w-[600px] bg-stone-800 rounded-lg justify-center overflow-x-auto border-b-2 border-stone-900">
                    @foreach ($location_photos as $photo)
                        @if ($photo->set_default == true)
                            <img id="{{ $photo->id }}" class="photo-active"
                                src="{{ asset('storage/' . $photo->photo) }}" alt=""
                                onclick="figureAction(this)">
                        @else
                            <img id="{{ $photo->id }}" class="photo" src="{{ asset('storage/' . $photo->photo) }}"
                                alt="" onclick="figureAction(this)">
                        @endif
                    @endforeach
                </figure>
                <div class=" relative mt-2 lg-photo-product border ">
                    <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                        <button
                            class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                            type="button" onclick="buttonPrev()">
                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                clip-rule="evenodd" viewBox="0 0 24 24">
                                <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                            </svg>
                        </button>
                    </div>
                    <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                        <button type="button"
                            class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                            onclick="buttonNext()">
                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                clip-rule="evenodd" viewBox="0 0 24 24">
                                <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                            </svg>
                        </button>
                    </div>
                    @foreach ($location_photos as $photo)
                        <div id="{{ $photo->set_default }}" class="divImage" hidden>
                            <div class="absolute bottom-2 left-0 w-full h-14 bg-black bg-opacity-80 p-2">
                                <div class="flex items-center">
                                    <div class="w-64">
                                        <div class="flex">
                                            <label class="text-sm text-yellow-400 w-28 mx-1">Tanggal Upload</label>
                                            <label class="text-sm text-yellow-400">:</label>
                                            <label
                                                class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($photo->created_at)) }}
                                                {{ $bulan[(int) date('m', strtotime($photo->created_at))] }}
                                                {{ date('Y', strtotime($photo->created_at)) }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="text-sm text-yellow-400 w-28 mx-1">Diupload Oleh</label>
                                            <label class="text-sm text-yellow-400">: </label>
                                            <label
                                                class="text-sm text-yellow-400 ml-2 w-40">{{ $photo->user->name }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img class="lg-photo-product" src="{{ asset('storage/' . $photo->photo) }}"
                                alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Location Photo end -->

            <!-- Location Maps start -->
            <span class="flex justify-center border-b mt-4 text-base font-semibold">Peta Lokasi</span>
            <div class="lg-map-product mt-2" id="map">
            </div>
            <!-- Location Maps end -->
        </div>
    </div>
    <!-- Location Photo & Maps end -->
    <!-- Show Location end -->
</div>

<!-- Modal Preview start -->
<div id="modal" name="modal"
    class="absolute justify-center top-0 w-full h-[1500px] bg-black bg-opacity-90 z-50 hidden">
    <div>
        <div class="w-[950px] h-8 mt-10 ml-2">
            <div class="flex items-center">
                <div class="w-32">
                    <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2"
                        title="Create PDF" type="button" onclick="savePdf()">
                        <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                        </svg>
                        <span class="ml-2 text-white">Save PDF</span>
                    </button>
                </div>
                <div class="flex w-full justify-end px-4">
                    <button id="btn-close" name="btn-close" class="flex justify-center items-center" title="Close"
                        onclick="btnClose()">
                        <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @include('dashboard.layouts.location-preview')
        <div class="h-10"></div>
    </div>
</div>
<!-- Modal Preview end -->
