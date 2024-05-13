const areaId = document.getElementById("area_id");
const cityId = document.getElementById("city_id");
const city = document.getElementById("city");
// const vista = document.getElementById("vista");
// const mitra = document.getElementById("mitra");
// const vendorId = document.getElementById("vendor_id");
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

let objCity = {};

let map;
let markers = [];
let latitude = -1.7505372;
let longitude = 118.0962239;
let zoomMaps = 4.35;

let myLatLng = {
    lat: latitude,
    lng: longitude
};

// Show City --> start
const optionCity = [];
if (areaId.value != 'pilih') {
    if (cityId.value != 'pilih') {
        while (city.hasChildNodes()) {
            city.removeChild(city.firstChild);
        }
        optionCity[0] = document.createElement('option');
        optionCity[0].appendChild(document.createTextNode(['-- pilih --']));
        optionCity[0].setAttribute('value', 'pilih');
        city.appendChild(optionCity[0]);

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
                            if (cityId.value == objCity.dataCity[i]['id']) {
                                optionCity[i + 1].setAttribute('selected', 'selected');
                                latitude = Number(objCity.dataCity[i]['lat']);
                                longitude = Number(objCity.dataCity[i]['lng']);
                                zoomMaps = Number(objCity.dataCity[i]['zoom']);
                                myLatLng = {
                                    lat: latitude,
                                    lng: longitude
                                };
                                initMap();
                            }
                            optionCity[i + 1].setAttribute('value', objCity.dataCity[i]['id']);
                            city.appendChild(optionCity[i + 1]);
                        }
                    }
                } else {
                    // Oh no! There has been an error with the request!
                }
            }
        }
    } else {
        while (city.hasChildNodes()) {
            city.removeChild(city.firstChild);
        }
        optionCity[0] = document.createElement('option');
        optionCity[0].appendChild(document.createTextNode(['-- pilih --']));
        optionCity[0].setAttribute('value', 'pilih');
        city.appendChild(optionCity[0]);

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
                            optionCity[i + 1].setAttribute('value', objCity.dataCity[i]['id']);
                            city.appendChild(optionCity[i + 1]);
                        }
                    }
                } else {
                    // Oh no! There has been an error with the request!
                }
            }
        }
    }
} else {
    optionCity[0] = document.createElement('option');
    optionCity[0].appendChild(document.createTextNode(['-- pilih --']));
    optionCity[0].setAttribute('value', 'pilih');
    city.appendChild(optionCity[0]);
}

areaId.addEventListener('change', function () {
    cityId.value = 'pilih';
    while (city.hasChildNodes()) {
        city.removeChild(city.firstChild);
    }
    optionCity[0] = document.createElement('option');
    optionCity[0].appendChild(document.createTextNode(['-- pilih --']));
    optionCity[0].setAttribute('value', 'pilih');
    city.appendChild(optionCity[0]);

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

// Ownership event --> start
// mitra.addEventListener('click', function () {
//     vendorId.removeAttribute('hidden');
// })
// vista.addEventListener('click', function () {
//     vendorId.setAttribute('hidden', 'hidden');
// })
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

    map.addListener("click", (event) => {
        deleteMarkers();
        addMarker(event.latLng);
        var koordinate = event.latLng;
        console.log(koordinate);
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    });
}

// Adds a marker to the map and push to the array.
function addMarker(position) {
    const marker = new google.maps.Marker({
        position,
        map,
    });

    markers.push(marker);
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
