const areaId = document.getElementById("area_id");
const cityId = document.getElementById("city_id");
const city = document.getElementById("city");
const qty = document.getElementById("qty");
const locations = document.getElementById("locations");
const lokasi = document.getElementById("lokasi");
const vista = document.getElementById("vista");
const mitra = document.getElementById("mitra");
const vendorId = document.getElementById("vendor_id");
const signageCategoryId = document.getElementById("signage_category_id");
const signageCategory = document.getElementById("signageCategory");
const ledType = document.getElementById("ledType");
const slotQty = document.getElementById("slotQty");
const on = document.getElementById("on");
const off = document.getElementById("off");
const eksklusif = document.getElementById("eksklusif");
const sharing = document.getElementById("sharing");
const harga = document.getElementById("harga");
const sector = document.getElementById("sector");
const airport = document.getElementById("airport");
const tol = document.getElementById("tol");
const hotel = document.getElementById("hotel");
const restaurant = document.getElementById("restaurant");
const shops = document.getElementById("shops");
const office = document.getElementById("office");
const mall = document.getElementById("mall");
const garden = document.getElementById("garden");
const market = document.getElementById("market");
const house = document.getElementById("house");
let signageLocations = [];
let objLocations = {};

let objCity = {};


let map;
let markers = [];
let zoomMaps = 18;
dataObject = JSON.parse(locations.value)
objLocations = dataObject.signageLocations;

let latitude = Number(objLocations[0].lat);
let longitude = Number(objLocations[0].lng);

let myLatLng = {
    lat: latitude,
    lng: longitude
};

// Show City --> start
const optionCity = [];

if (cityId.value != '') {
    while (city.hasChildNodes()) {
        city.removeChild(city.firstChild);
    }

    const xhrCity = new XMLHttpRequest();
    const methodCity = "GET";
    const urlCity = "/showCity";

    xhrCity.open(methodCity, urlCity, true);
    xhrCity.send();

    xhrCity.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrCity.readyState === XMLHttpRequest.DONE) {
            const status = xhrCity.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objCity = JSON.parse(xhrCity.responseText);

                for (i = 0; i < objCity.dataCity.length; i++) {
                    if (objCity.dataCity[i]['area_id'] == areaId.value) {
                        optionCity[i + 1] = document.createElement('option');
                        optionCity[i + 1].appendChild(document.createTextNode(objCity.dataCity[i]['city']));
                        if (city.value == objCity.dataCity[i]['city']) {
                            optionCity[i + 1].setAttribute('selected', 'selected');
                        }
                        city.appendChild(optionCity[i + 1]);
                    }
                }
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
} else if (areaId.value != '') {
    while (city.hasChildNodes()) {
        city.removeChild(city.firstChild);
    }
    const xhrCity = new XMLHttpRequest();
    const methodCity = "GET";
    const urlCity = "/showCity";

    xhrCity.open(methodCity, urlCity, true);
    xhrCity.send();

    xhrCity.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrCity.readyState === XMLHttpRequest.DONE) {
            const status = xhrCity.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objCity = JSON.parse(xhrCity.responseText);
                for (i = 0; i < objCity.dataCity.length; i++) {
                    if (objCity.dataCity[i]['area_id'] == areaId.value) {
                        optionCity[i + 1] = document.createElement('option');
                        optionCity[i + 1].appendChild(document.createTextNode(objCity.dataCity[i]['city']));
                        city.appendChild(optionCity[i + 1]);
                    }
                }
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}

areaId.addEventListener('change', function () {
    while (city.hasChildNodes()) {
        city.removeChild(city.firstChild);
    }

    const xhrCity = new XMLHttpRequest();
    const methodCity = "GET";
    const urlCity = "/showCity";

    xhrCity.open(methodCity, urlCity, true);
    xhrCity.send();

    xhrCity.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrCity.readyState === XMLHttpRequest.DONE) {
            const status = xhrCity.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                // The request has been completed successfully
                objCity = JSON.parse(xhrCity.responseText);
                for (i = 0; i < objCity.dataCity.length; i++) {
                    if (objCity.dataCity[i]['area_id'] == areaId.value) {
                        optionCity[i + 1] = document.createElement('option');
                        optionCity[i + 1].appendChild(document.createTextNode(objCity.dataCity[i]['city']));
                        optionCity[i + 1].setAttribute('value', objCity.dataCity[i]['id']);
                        city.appendChild(optionCity[i + 1]);
                    }
                }
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }

})
// Show City --> end

// Signage Qty event --> start
if (qty.value != '') {
    if (qty.value != 0) {
        lokasi.removeAttribute('hidden');
        var label = document.createElement('label');
        label.innerHTML = "Latitude, Longitude";
        label.classList.add("label");
        label.classList.add("xl:text-md");
        label.classList.add("2xl:text-lg");
        lokasi.appendChild(label);
        for (i = 0; i < objLocations.length; i++) {
            var label = document.createElement('label');
            label.innerHTML = i + 1 + ". ";
            label.classList.add("label");
            label.classList.add("xl:text-md");
            label.classList.add("2xl:text-lg");
            label.classList.add("flex");
            lokasi.appendChild(label);
            var input = document.createElement('input');
            input.classList.add("input");
            input.classList.add("xl:text-md");
            input.classList.add("xl:w-48");
            input.classList.add("2xl:w-56");
            input.classList.add("2xl:text-lg");
            input.setAttribute('name', 'input' + i);
            input.setAttribute('id', 'input' + i);
            input.setAttribute('value', objLocations[i].lat.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + ', ' + objLocations[i].lng.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }))
            lokasi.appendChild(input);
        }
    } else {
        lokasi.setAttribute('hidden', 'hidden');
    }
} else {
    lokasi.setAttribute('hidden', 'hidden');
}

qty.addEventListener('keyup', function () {
    markers.length = 0;
    locations.value = "";
    signageLocations = [];
    deleteMarkers();
    initMap();
    while (lokasi.hasChildNodes()) {
        lokasi.removeChild(lokasi.firstChild);
    }
    if (qty.value != '') {
        if (qty.value != 0) {
            lokasi.removeAttribute('hidden');
            var label = document.createElement('label');
            label.innerHTML = "Latitude, Longitude";
            label.classList.add("label");
            label.classList.add("xl:text-md");
            label.classList.add("2xl:text-lg");
            lokasi.appendChild(label);
            for (i = 0; i < Number(qty.value); i++) {
                var label = document.createElement('label');
                label.innerHTML = i + 1 + ". ";
                label.classList.add("label");
                label.classList.add("xl:text-md");
                label.classList.add("2xl:text-lg");
                label.classList.add("flex");
                lokasi.appendChild(label);
                var input = document.createElement('input');
                input.classList.add("input");
                input.classList.add("xl:text-md");
                input.classList.add("xl:w-48");
                input.classList.add("2xl:w-56");
                input.classList.add("2xl:text-lg");
                input.setAttribute('name', 'input' + i);
                input.setAttribute('id', 'input' + i);
                lokasi.appendChild(input);
            }
        } else {
            lokasi.setAttribute('hidden', 'hidden');
        }
    } else {
        lokasi.setAttribute('hidden', 'hidden');
    }
})
// Signage Qty event --> end

// Signage Category event --> start
signageCategoryId.addEventListener('change', function () {
    signageCategory.value = signageCategoryId.options[signageCategoryId.value].text;
    if (signageCategoryId.options[signageCategoryId.value].text == "Videotron") {
        ledType.removeAttribute('hidden');
        slotQty.removeAttribute('hidden');
        on.removeAttribute('hidden');
        off.removeAttribute('hidden');
        eksklusif.removeAttribute('hidden');
        sharing.removeAttribute('hidden');
        harga.setAttribute('hidden', 'hidden');
    } else {
        ledType.setAttribute('hidden', 'hidden');
        slotQty.setAttribute('hidden', 'hidden');
        on.setAttribute('hidden', 'hidden');
        off.setAttribute('hidden', 'hidden');
        eksklusif.setAttribute('hidden', 'hidden');
        sharing.setAttribute('hidden', 'hidden');
        harga.removeAttribute('hidden');
    }
})
// Signage Category event --> end

// Ownership event --> start
mitra.addEventListener('click', function () {
    vendorId.removeAttribute('hidden');
})
vista.addEventListener('click', function () {
    vendorId.setAttribute('hidden', 'hidden');
})
// Ownership event --> end

// Show Sector --> start
let split = [];
let word = '';

if (sector.value != '') {
    word = sector.value;
    split = word.split('-');
    console.log(split);

    for (i = 0; i < split.length; i++) {
        if (split[i] == airport.value) {
            airport.checked = true;
        }
        if (split[i] == tol.value) {
            tol.checked = true;
        }
        if (split[i] == hotel.value) {
            hotel.checked = true;
        }
        if (split[i] == restaurant.value) {
            restaurant.checked = true;
        }
        if (split[i] == shops.value) {
            shops.checked = true;
        }
        if (split[i] == office.value) {
            office.checked = true;
        }
        if (split[i] == tourist.value) {
            tourist.checked = true;
        }
        if (split[i] == mall.value) {
            mall.checked = true;
        }
        if (split[i] == garden.value) {
            garden.checked = true;
        }
        if (split[i] == market.value) {
            market.checked = true;
        }
        if (split[i] == house.value) {
            house.checked = true;
        }
    }
}

airport.addEventListener('click', function () {
    if (airport.checked == true) {
        sector.value = sector.value + airport.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === airport.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

tol.addEventListener('click', function () {
    if (tol.checked == true) {
        sector.value = sector.value + tol.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === tol.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

hotel.addEventListener('click', function () {
    if (hotel.checked == true) {
        sector.value = sector.value + hotel.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === hotel.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

restaurant.addEventListener('click', function () {
    if (restaurant.checked == true) {
        sector.value = sector.value + restaurant.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === restaurant.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

shops.addEventListener('click', function () {
    if (shops.checked == true) {
        sector.value = sector.value + shops.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === shops.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

office.addEventListener('click', function () {
    if (office.checked == true) {
        sector.value = sector.value + office.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === office.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

tourist.addEventListener('click', function () {
    if (tourist.checked == true) {
        sector.value = sector.value + tourist.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === tourist.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

mall.addEventListener('click', function () {
    if (mall.checked == true) {
        sector.value = sector.value + mall.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === mall.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

garden.addEventListener('click', function () {
    if (garden.checked == true) {
        sector.value = sector.value + garden.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === garden.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

market.addEventListener('click', function () {
    if (market.checked == true) {
        sector.value = sector.value + market.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === market.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

house.addEventListener('click', function () {
    if (house.checked == true) {
        sector.value = sector.value + house.value + '-';
        // console.log(sector.value);
    } else {
        word = sector.value;
        sector.value = '';
        split = word.split('-');
        for (i = 0; i < split.length; i++) {
            if (split[i] === house.value) {
                split.splice(i, 1);
            }
            if (split[i] === '') {
                split.splice(i, 1);
            }
        }
        for (i = 0; i < split.length; i++) {
            sector.value = sector.value + split[i] + '-';
        }
        // console.log(sector.value);
    }
})

// Show Sector --> end

// Google Maps --> start
city.addEventListener('change', function () {
    cityId.value = city.value;
    const xhrCity = new XMLHttpRequest();
    const methodCity = "GET";
    const urlCity = "/showCity";

    xhrCity.open(methodCity, urlCity, true);
    xhrCity.send();

    xhrCity.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrCity.readyState === XMLHttpRequest.DONE) {
            const status = xhrCity.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                // The request has been completed successfully
                objCity = JSON.parse(xhrCity.responseText);

                for (i = 0; i < objCity.dataCity.length; i++) {
                    if (objCity.dataCity[i]['id'] == city.value) {
                        latitude = Number(objCity.dataCity[i]['lat']);
                        longitude = Number(objCity.dataCity[i]['lng']);
                        zoomMaps = Number(objCity.dataCity[i]['zoom']);
                        myLatLng = {
                            lat: latitude,
                            lng: longitude
                        };
                        initMap();
                    }
                }
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
});

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: zoomMaps,
        center: myLatLng,
    });

    // Show Marker
    if (qty.value == objLocations.length) {
        for (i = 0; i < objLocations.length; i++) {
            latitude = Number(objLocations[i].lat);
            longitude = Number(objLocations[i].lng);
            myLatLng = {
                lat: latitude,
                lng: longitude
            };
            addMarker(myLatLng);
        }
    }

    map.addListener("click", (event) => {
        // deleteMarkers();
        if (qty.value != "") {
            if (qty.value != 0) {
                if (markers.length < qty.value) {
                    addMarker(event.latLng);
                    let num1 = event.latLng.lat();
                    let num2 = event.latLng.lng();
                    document.getElementById('input' + (markers.length - 1)).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
                    signageLocations[markers.length - 1] = { number: markers.length, lat: event.latLng.lat(), lng: event.latLng.lng() }
                    objLocations = { signageLocations };
                    locations.value = JSON.stringify(objLocations);
                    console.log(locations.value);
                } else {
                    console.log("Marker sudah " + qty.value + " lokasi");
                    alert("Marker sudah " + qty.value + " lokasi");
                }
            } else {
                console.log("Jumlah Signage tidak boleh 0");
                alert("Jumlah Signage tidak boleh 0");
            }
        } else {
            console.log("Silahkan input jumlah lokasi terlebih dahulu");
            alert("Silahkan input jumlah lokasi terlebih dahulu");
        }
    });
}

// Adds a marker to the map and push to the array.
function addMarker(position) {
    const marker = new google.maps.Marker({
        position,
        draggable: true,
        map,
    });

    markers.push(marker);
    if (markers.length != 0) {
        if (markers.length == 1) {
            markers[0].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 0).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
        }
        if (markers.length == 2) {
            markers[0].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 0).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[1].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 1).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
        }
        if (markers.length == 3) {
            markers[0].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 0).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[1].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 1).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[2].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 2).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
        }
        if (markers.length == 4) {
            markers[0].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 0).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[1].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 1).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[2].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 2).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[3].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 3).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
        }
        if (markers.length == 5) {
            markers[0].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 0).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[1].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 1).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[2].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 2).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[3].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 3).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
            markers[3].addListener("dragend", (event) => {
                let num1 = event.latLng.lat();
                let num2 = event.latLng.lng();
                console.log(event);
                document.getElementById('input' + 4).value = num1.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 }) + "," + num2.toLocaleString(undefined, { maximumFractionDigits: 7, minimumFractionDigits: 7 });
            });
        }
    }
    // marker.addListener('drag', handleEvent);
    // marker.addListener('dragend', handleEvent);
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    setMapOnAll(null);
    markers = [];
}
// Google maps --> end

// Script Preview Image start

function previewImage() {
    const photo = document.querySelector('#photo');
    const imgPreview = document.querySelector('.img-preview');

    // imgPreview.style.display = 'block';

    const oFReader = new FileReader();

    oFReader.readAsDataURL(photo.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
// Script Preview Image end
