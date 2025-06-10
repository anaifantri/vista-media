<!-- Edit Location start -->
@if ($description->type != 'Videotron')
    <input type="text" name="lighting" id="lighting" value="{{ $description->lighting }}" hidden>
@else
    <input type="text" name="lighting" id="lighting" value="{{ old('lighting') }}" hidden>
@endif
<div class="flex justify-center">
    <div class="flex justify-start border bg-stone-300 rounded-lg w-[250px] h-[575px] px-4 py-2">
        <div>
            {{-- @include('dashboard.layouts.select-category-edit') --}}
            <input name="media_category_id" type="text" value="{{ $location->media_category->id }}" hidden>
            <div class="flex">
                <div class="mt-1">
                    <label class="text-sm text-stone-900">Kode Lokasi</label>
                    <input
                        class="flex in-out-spin-none text-semibold font-semibold w-32 border rounded-lg px-1 outline-none @error('code') is-invalid @enderror"
                        type="number" min="0" id="code" name="code" value="{{ $location->code }}">
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
            @include('dashboard.layouts.select-road-edit')
            @include('dashboard.layouts.select-distance-edit')
            @include('dashboard.layouts.select-speed-edit')
        </div>
    </div>
    <div class="flex justify-start  border bg-stone-300 rounded-lg w-[250px] h-[575px] px-4 py-2 ml-4">
        <div>
            @include('dashboard.layouts.select-sn-type-edit')
            @include('dashboard.layouts.input-qty-edit')
            @if (old('signage_type'))
                @if (old('signage_type') == 'Videotron')
                    <div id="divVideotron">
                        @include('dashboard.layouts.select-led-edit')
                        @include('dashboard.layouts.input-sd-edit')
                        @include('dashboard.layouts.input-time-edit')
                        @include('dashboard.layouts.input-screen-edit')
                    </div>
                @else
                    <div id="divVideotron" hidden>
                        @include('dashboard.layouts.select-led-edit')
                        @include('dashboard.layouts.input-sd-edit')
                        @include('dashboard.layouts.input-time-edit')
                        @include('dashboard.layouts.input-screen-edit')
                    </div>
                @endif
            @else
                @if ($description->type == 'Videotron')
                    <div id="divVideotron">
                        @include('dashboard.layouts.select-led-edit')
                        @include('dashboard.layouts.input-sd-edit')
                        @include('dashboard.layouts.input-time-edit')
                        @include('dashboard.layouts.input-screen-edit')
                    </div>
                @else
                    <div id="divVideotron" hidden>
                        @include('dashboard.layouts.select-led-edit')
                        @include('dashboard.layouts.input-sd-edit')
                        @include('dashboard.layouts.input-time-edit')
                        @include('dashboard.layouts.input-screen-edit')
                    </div>
                @endif
            @endif
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
    const divVideotron = document.getElementById("divVideotron");
    const signageType = document.getElementById("signage_type");
    const qty = document.getElementById("qty");

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
        } else {
            screenWidth.value = 0;
            screenHeight.value = 0;
        }
    })
    // Function Set Screen Size --> end

    // Function Signage Type --> start
    if (signageType.value == "Videotron") {
        divVideotron.removeAttribute('hidden');
    } else {
        divVideotron.setAttribute('hidden', 'hidden');
    }

    getSignageType = (sel) => {
        if (sel.value == "Videotron") {
            divVideotron.children[1].children[1].children[1].setAttribute('required', 'required');
            divVideotron.children[1].children[1].children[3].setAttribute('required', 'required');
            divVideotron.children[2].children[1].children[1].setAttribute('required', 'required');
            divVideotron.children[2].children[1].children[3].setAttribute('required', 'required');
            divVideotron.removeAttribute('hidden');
            lighting.value = "LED";
        } else if (sel.value == "Neon Box") {
            divVideotron.children[1].children[1].children[1].removeAttribute('required');
            divVideotron.children[1].children[1].children[3].removeAttribute('required');
            divVideotron.children[2].children[1].children[1].removeAttribute('required');
            divVideotron.children[2].children[1].children[3].removeAttribute('required');
            divVideotron.setAttribute('hidden', 'hidden');
            lighting.value = "Backlight";
        } else if (sel.value == "Papan") {
            divVideotron.children[1].children[1].children[1].removeAttribute('required');
            divVideotron.children[1].children[1].children[3].removeAttribute('required');
            divVideotron.children[2].children[1].children[1].removeAttribute('required');
            divVideotron.children[2].children[1].children[3].removeAttribute('required');
            divVideotron.setAttribute('hidden', 'hidden');
            lighting.value = "Nonlight"
        }
    }
    // Function Signage Type --> end

    // Function End At Type --> start
    inputQuantity = (sel) => {
        deleteMarkers();
        dataLat = [];
        dataLng = [];
        latitude.value = "";
        longitude.value = "";
    }
    // Function End At Type --> end

    // Function Init Map --> start
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: zoomMaps,
            center: myLatLng,
        });

        for (let i = 0; i < lat.length; i++) {
            myLatLng = {
                lat: lat[i],
                lng: lng[i]
            };
            addMarker(myLatLng);
        }
        map.addListener("click", (event) => {
            if (Number(qty.value) == 0 || Number(qty.value) == null) {
                alert("Jumlah signage belum di input")
            } else {
                if (dataLat.length < Number(qty.value)) {
                    addMarker(event.latLng);
                    dataLat.push(event.latLng.lat());
                    dataLng.push(event.latLng.lng());
                } else(
                    alert("Jumlah marker sudah sama dengan jumlah signage")
                )
            }

            latitude.value = JSON.stringify(lat);
            longitude.value = JSON.stringify(lng);
        });
    }
    // Function Init Map --> end
</script>
