<!-- Edit Location start -->
<div class="flex justify-center">
    <div class="flex justify-start border bg-stone-300 rounded-lg w-[250px] h-[550px] px-4 py-2">
        <div>
            @include('dashboard.layouts.select-category-edit')
            <div class="flex">
                <div class="mt-1">
                    <label class="text-sm text-stone-900">Kode Lokasi</label>
                    <input
                        class="flex text-semibold font-semibold w-32 border rounded-lg px-1 outline-none @error('code') is-invalid @enderror"
                        type="text" id="code" name="code" value="{{ $location->code }}">
                </div>
                @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @include('dashboard.layouts.select-area-edit')
            @include('dashboard.layouts.select-city-edit')
            @include('dashboard.layouts.input-address-edit')
            @include('dashboard.layouts.input-lat-lng-edit')
            @include('dashboard.layouts.select-size-edit')
            @include('dashboard.layouts.select-side-edit')
            @include('dashboard.layouts.select-orientation-edit')
            @include('dashboard.layouts.select-condition-edit')
        </div>
    </div>
    <div class="flex justify-start  border bg-stone-300 rounded-lg w-[250px] h-[550px] px-4 py-2 ml-4">
        <div>
            @if (old('category'))
                @if (old('category') != 'Videotron')
                    <div id="bbLighting">
                        @include('dashboard.layouts.select-lighting-edit')
                    </div>
                    <div id="ledEdit" hidden>
                        @include('dashboard.layouts.select-led-edit')
                        @include('dashboard.layouts.input-sd-edit')
                        @include('dashboard.layouts.input-time-edit')
                        @include('dashboard.layouts.input-screen-edit')
                    </div>
                @else
                    <div id="bbLighting" hidden>
                        @include('dashboard.layouts.select-lighting-edit')
                    </div>
                    <div id="ledEdit">
                        @include('dashboard.layouts.select-led-edit')
                        @include('dashboard.layouts.input-sd-edit')
                        @include('dashboard.layouts.input-time-edit')
                        @include('dashboard.layouts.input-screen-edit')
                    </div>
                @endif
            @else
                <div id="bbLighting" hidden>
                    @include('dashboard.layouts.select-lighting-edit')
                </div>
                <div id="ledEdit">
                    @include('dashboard.layouts.select-led-edit')
                    @include('dashboard.layouts.input-sd-edit')
                    @include('dashboard.layouts.input-time-edit')
                    @include('dashboard.layouts.input-screen-edit')
                </div>
            @endif
            @include('dashboard.layouts.select-road-edit')
            @include('dashboard.layouts.select-distance-edit')
            @include('dashboard.layouts.select-speed-edit')
            @include('dashboard.layouts.select-sector-edit')
            @canany(['isAdmin', 'isMedia', 'isMarketing'])
                @can('isLocation')
                    @can('isMediaEdit')
                        <div id="price" name="price" class="mt-1">
                            <label class="text-sm text-teal-700">Harga</label>
                            <input
                                class="flex w-[218px] text-semibold border mt-1 in-out-spin-none rounded-lg p-1 outline-none @error('price') is-invalid @enderror"
                                type="number" id="price" name="price" value="{{ $location->price }}">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endcan
                @endcan
            @endcanany
            <!-- Edit Location end -->
        </div>
    </div>
    @include('dashboard.layouts.photo-maps-edit')
    <!-- Edit Location end -->
</div>
<script>
    // Function Set Screen Size --> start
    const selectSize = document.getElementById("media_size_id");
    const selectLed = document.getElementById("led_id");
    const screenWidth = document.getElementById("screen_w");
    const screenHeight = document.getElementById("screen_h");

    let objSize = {};
    let objLed = {};

    selectSize.addEventListener('change', function() {
        objSize = JSON.parse(selectSize.options[selectSize.selectedIndex].id);
        objLed = JSON.parse(selectLed.options[selectLed.selectedIndex].id);
        var sizeWidth = objSize.width;
        var sizeHeight = objSize.height;
        var cabinetWidth = objLed.cabinet_width;
        var cabinetHeight = objLed.cabinet_height;
        var pixelPitch = objLed.pixel_pitch;
        screenWidth.value = parseInt(cabinetWidth / pixelPitch) * sizeWidth;
        screenHeight.value = parseInt(cabinetHeight / pixelPitch) * sizeHeight;
    })

    selectLed.addEventListener('change', function() {
        objSize = JSON.parse(selectSize.options[selectSize.selectedIndex].id);
        objLed = JSON.parse(selectLed.options[selectLed.selectedIndex].id);
        var sizeWidth = objSize.width;
        var sizeHeight = objSize.height;
        var cabinetWidth = objLed.cabinet_width;
        var cabinetHeight = objLed.cabinet_height;
        var pixelPitch = objLed.pixel_pitch;
        screenWidth.value = parseInt(cabinetWidth / pixelPitch) * sizeWidth;
        screenHeight.value = parseInt(cabinetHeight / pixelPitch) * sizeHeight;
    })
    // Function Set Screen Size --> end

    // Function Init Maps --> start
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: zoomMaps,
            center: myLatLng,
        });

        addMarker(myLatLng);

        map.addListener("click", (event) => {
            deleteMarkers();
            addMarker(event.latLng);
            latitude.value = event.latLng.lat();
            longitude.value = event.latLng.lng();
        });
    }
    // Function Init Maps --> end
</script>
