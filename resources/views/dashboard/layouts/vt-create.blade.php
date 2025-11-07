<!-- Create New Location start -->
<div class="flex justify-center">
    <div class="flex justify-start border bg-stone-300 rounded-lg w-[250px] h-[550px] px-4 py-2">
        <div>
            {{-- @include('dashboard.layouts.select-company') --}}
            <input type="text" hidden name="company_id" value="{{ $company->id }}" hidden>
            <div class="flex">
                <div class="mt-1">
                    <label class="text-sm text-stone-900">Kode Lokasi</label>
                    <input
                        class="flex text-semibold w-32 border rounded-lg px-1 outline-none @error('code') is-invalid @enderror"
                        type="text" id="code" name="code" value="{{ old('code') }}" placeholder="Input Kode"
                        required>
                </div>
                @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @include('dashboard.layouts.select-area')
            @include('dashboard.layouts.select-city')
            @include('dashboard.layouts.input-address')
            @include('dashboard.layouts.input-lat-lng')
            @include('dashboard.layouts.select-size')
            @include('dashboard.layouts.select-side')
            @include('dashboard.layouts.select-orientation')
            @include('dashboard.layouts.select-condition')
        </div>
    </div>
    <div class="flex justify-start  border bg-stone-300 rounded-lg w-[250px] h-[550px] px-4 py-2 ml-4">
        <div>
            @include('dashboard.layouts.select-led')
            @include('dashboard.layouts.input-sd')
            @include('dashboard.layouts.input-time')
            @include('dashboard.layouts.input-screen')
            @include('dashboard.layouts.select-road')
            @include('dashboard.layouts.select-distance')
            @include('dashboard.layouts.select-speed')
            @include('dashboard.layouts.select-sector')
            @canany(['isAdmin', 'isMarketing', 'isMedia'])
                <div id="price" name="price" class="mt-1">
                    <label class="text-sm text-teal-700">Harga</label>
                    <input
                        class="flex w-[218px] text-semibold border mt-1 in-out-spin-none rounded-lg p-1 outline-none @error('price') is-invalid @enderror"
                        type="number" id="price" name="price" value="{{ old('price') }}" placeholder="Input Harga">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endcanany
            <!-- Create New Location end -->
        </div>
    </div>
    @include('dashboard.layouts.photo-maps')
    <!-- Create New Location end -->
</div>
<script>
    // Function Init Map --> star
    function initMap() {
        if (document.getElementById('lat').value != "") {
            myLatLng = {
                lat: Number(document.getElementById('lat').value),
                lng: Number(document.getElementById('lng').value)
            };
            zoomMaps = 16;
        }

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: zoomMaps,
            center: myLatLng,
        });

        if (document.getElementById('lat').value != "") {
            addMarker(myLatLng);
        }

        map.addListener("click", (event) => {
            deleteMarkers();
            addMarker(event.latLng);
            document.getElementById('lat').value = event.latLng.lat();
            document.getElementById('lng').value = event.latLng.lng();
            objDescription.lat = event.latLng.lat();
            objDescription.lng = event.latLng.lng();
            description.value = JSON.stringify(objDescription);
        });
    }
    // Function Init Map --> end

    // Function Set Screen Size --> start
    const selectSize = document.getElementById("media_size_id");
    const selectLed = document.getElementById("led_id");
    const screenWidth = document.getElementById("screen_w");
    const screenHeight = document.getElementById("screen_h");

    let objSize = {};
    let objLed = {};

    selectSize.addEventListener('change', function() {
        if (selectSize.value != 'pilih') {
            if (selectLed.value != "pilih") {
                objSize = JSON.parse(selectSize.options[selectSize.selectedIndex].id);
                objLed = JSON.parse(selectLed.options[selectLed.selectedIndex].id);
                var sizeWidth = objSize.width;
                var sizeHeight = objSize.height;
                var cabinetWidth = objLed.cabinet_width;
                var cabinetHeight = objLed.cabinet_height;
                var pixelPitch = objLed.pixel_pitch;
                screenWidth.value = parseInt(cabinetWidth / pixelPitch) * sizeWidth;
                screenHeight.value = parseInt(cabinetHeight / pixelPitch) * sizeHeight;
            }
        }
    })

    selectLed.addEventListener('change', function() {
        if (selectLed.value != 'pilih') {
            if (selectLed.value != "pilih") {
                objSize = JSON.parse(selectSize.options[selectSize.selectedIndex].id);
                objLed = JSON.parse(selectLed.options[selectLed.selectedIndex].id);
                var sizeWidth = objSize.width;
                var sizeHeight = objSize.height;
                var cabinetWidth = objLed.cabinet_width;
                var cabinetHeight = objLed.cabinet_height;
                var pixelPitch = objLed.pixel_pitch;
                screenWidth.value = parseInt(cabinetWidth / pixelPitch) * sizeWidth;
                screenHeight.value = parseInt(cabinetHeight / pixelPitch) * sizeHeight;
            }
        }
    })
    // Function Set Screen Size --> end
</script>
