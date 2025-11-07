<!-- Create New Location start -->
<input type="text" name="lighting" id="lighting" value="{{ old('lighting') }}" hidden>
<div class="flex justify-center">
    <div class="flex justify-start border bg-stone-300 rounded-lg w-[250px] h-[600px] px-4 py-2">
        <div>
            {{-- @include('dashboard.layouts.select-company') --}}
            <input type="text" hidden name="company_id" value="{{ $company->id }}" hidden>
            <div class="flex">
                <div class="mt-1">
                    <label class="text-sm text-stone-900">Kode Lokasi</label>
                    <input
                        class="flex text-semibold w-32 border rounded-lg px-1 outline-none @error('code') is-invalid @enderror"
                        type="text" id="code" name="code" value="{{ old('code') }}" autofocus
                        placeholder="Input Kode" required>
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
            <div hidden>
                @include('dashboard.layouts.input-lat-lng')
            </div>
            @include('dashboard.layouts.select-size')
            @include('dashboard.layouts.select-side')
            @include('dashboard.layouts.select-orientation')
            @include('dashboard.layouts.select-condition')
            @include('dashboard.layouts.select-road')
            @include('dashboard.layouts.select-speed')
        </div>
    </div>
    <div class="flex justify-start  border bg-stone-300 rounded-lg w-[250px] h-[600px] px-4 py-2 ml-4">
        <div>
            @include('dashboard.layouts.select-sn-type')
            <div id="divQty" hidden>
                @include('dashboard.layouts.input-qty')
            </div>
            <div id="divVideotron" hidden>
                @include('dashboard.layouts.select-led')
                @include('dashboard.layouts.input-sd')
                @include('dashboard.layouts.input-time')
                @include('dashboard.layouts.input-screen')
            </div>
            @include('dashboard.layouts.select-distance')
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
    const divQty = document.getElementById("divQty");
    const qty = document.getElementById("qty");
    const inputLat = document.getElementById("lat");
    const inputLng = document.getElementById("lng");
    const lighting = document.getElementById("lighting");
    const signageType = document.getElementById("signage_type");
    const divVideotron = document.getElementById("divVideotron");
    let objLatitude = {};
    let objLongitude = {};
    var lat = [];
    var lng = [];


    if (signageType.value == "pilih") {
        divVideotron.setAttribute('hidden', 'hidden');
        divQty.setAttribute('hidden', 'hidden');
    } else if (signageType.value == "Videotron") {
        divVideotron.removeAttribute('hidden');
        divQty.removeAttribute('hidden');
    } else {
        divVideotron.setAttribute('hidden', 'hidden');
        divQty.removeAttribute('hidden', 'hidden');
    }

    // Function Get Signage Type --> start
    getSignageType = (sel) => {
        if (sel.value == "pilih") {
            divVideotron.children[1].children[1].children[1].removeAttribute('required');
            divVideotron.children[1].children[1].children[3].removeAttribute('required');
            divVideotron.children[2].children[1].children[1].removeAttribute('required');
            divVideotron.children[2].children[1].children[3].removeAttribute('required');
            divQty.children[0].children[1].children[0].removeAttribute('required');
            divVideotron.removeAttribute('required');
            divVideotron.setAttribute('hidden', 'hidden');
            divQty.setAttribute('hidden', 'hidden');
            lighting.value = "";
        } else if (sel.value == "Videotron") {
            divVideotron.children[1].children[1].children[1].setAttribute('required', 'required');
            divVideotron.children[1].children[1].children[3].setAttribute('required', 'required');
            divVideotron.children[2].children[1].children[1].setAttribute('required', 'required');
            divVideotron.children[2].children[1].children[3].setAttribute('required', 'required');
            divQty.children[0].children[1].children[0].setAttribute('required', 'required');
            divVideotron.removeAttribute('hidden');
            divQty.removeAttribute('hidden');
            lighting.value = "LED";
        } else if (sel.value == "Neon Box") {
            divVideotron.children[1].children[1].children[1].removeAttribute('required');
            divVideotron.children[1].children[1].children[3].removeAttribute('required');
            divVideotron.children[2].children[1].children[1].removeAttribute('required');
            divVideotron.children[2].children[1].children[3].removeAttribute('required');
            divQty.children[0].children[1].children[0].setAttribute('required', 'required');
            divVideotron.setAttribute('hidden', 'hidden');
            divQty.removeAttribute('hidden', 'hidden');
            lighting.value = "Backlight";
        } else if (sel.value == "Papan") {
            divVideotron.children[1].children[1].children[1].removeAttribute('required');
            divVideotron.children[1].children[1].children[3].removeAttribute('required');
            divVideotron.children[2].children[1].children[1].removeAttribute('required');
            divVideotron.children[2].children[1].children[3].removeAttribute('required');
            divQty.children[0].children[1].children[0].setAttribute('required', 'required');
            divVideotron.setAttribute('hidden', 'hidden');
            divQty.removeAttribute('hidden', 'hidden');
            lighting.value = "Nonlight"
        }
    }
    // Function Get Signage Type --> end

    // Function End At Type --> start
    inputQuantity = (sel) => {
        deleteMarkers();
        lat = [];
        lng = [];
        inputLat.value = "";
        inputLng.value = "";
    }
    // Function End At Type --> end

    // Function Init Map --> star
    function initMap() {
        if (inputLat.value != "") {
            objLatitude = JSON.parse(inputLat.value);
            objLongitude = JSON.parse(inputLng.value);
            myLatLng = {
                lat: objLatitude[0],
                lng: objLongitude[0]
            };
            zoomMaps = 16;
        } else {
            if (areaId.value != "pilih") {
                if (cityId.value != "pilih") {
                    let dataCity = JSON.parse(cityId.options[cityId.selectedIndex].id)
                    myLatLng = {
                        lat: Number(dataCity.lat),
                        lng: Number(dataCity.lng)
                    }
                    zoomMaps = Number(dataCity.zoom);
                } else {
                    let dataArea = JSON.parse(areaId.options[areaId.selectedIndex].id)
                    myLatLng = {
                        lat: Number(dataArea.lat),
                        lng: Number(dataArea.lng)
                    }
                    zoomMaps = Number(dataArea.zoom);
                }
            }
        }

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: zoomMaps,
            center: myLatLng,
        });
        if (inputLat.value != "") {
            for (let i = 0; i < objLatitude.length; i++) {
                myLatLng = {
                    lat: objLatitude[i],
                    lng: objLongitude[i]
                };
                addMarker(myLatLng);
            }
        }

        map.addListener("click", (event) => {
            if (Number(qty.value) == 0 || Number(qty.value) == null) {
                alert("Jumlah signage belum di input")
            } else {
                if (lat.length < Number(qty.value)) {
                    addMarker(event.latLng);
                    lat.push(event.latLng.lat());
                    lng.push(event.latLng.lng());
                } else(
                    alert("Jumlah marker sudah sama dengan jumlah signage")
                )
            }

            inputLat.value = JSON.stringify(lat);
            inputLng.value = JSON.stringify(lng);
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
                screenWidth.value = (cabinetWidth / pixelPitch) * sizeWidth;
                screenHeight.value = (cabinetHeight / pixelPitch) * sizeHeight;
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
                screenWidth.value = (cabinetWidth / pixelPitch) * sizeWidth;
                screenHeight.value = (cabinetHeight / pixelPitch) * sizeHeight;
            }
        }
    })
    // Function Set Screen Size --> end
</script>
