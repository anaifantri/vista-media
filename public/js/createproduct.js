const areaId = document.getElementById("area_id");
const city = document.getElementById("city");
const cityCode = document.getElementById("cityCode");
const cityId = document.getElementById("city_id");
const inputCity = document.getElementById("inputCity");
const lighting = document.getElementById("lighting");
const inputLighting = document.getElementById("inputLighting");
const propertyStatus = document.getElementById("property_status");
const inputPemilik = document.getElementById("inputPemilik");
const buildStatus = document.getElementById("build_status");
const buildSelect = document.getElementById("buildSelect");
const saleStatus = document.getElementById("sale_status");
const saleSelect = document.getElementById("saleSelect");
const periode = document.getElementById("periode");
const divKlien = document.getElementById("divKlien");
const harga = document.getElementById("harga");
const roadSegment = document.getElementById("road_segment");
const inputJalan = document.getElementById("inputJalan");
const maxDistance = document.getElementById("max_distance");
const inputJarak = document.getElementById("inputJarak");
const speedAverage = document.getElementById("speed_average");
const inputKecepatan = document.getElementById("inputKecepatan");
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

let lightingData = ['Frontlight', 'Backlight', 'Non Light'];
let property = ['Vista Media', 'Mitra'];
let sale = ['Available', 'Sold'];
let build = ['Terbangun', 'Pembangunan', 'Rencana'];
let road = ['2 Lajur', '4 Lajur', '6 Lajur', '8 Lajur'];
let distance = ['> 50 meter', '> 100 meter', '> 150 meter', '> 200 meter', '> 250 meter', '> 300 meter', '> 500 meter'];
let speed = ['0 - 10 km/jam', '0 - 20 km/jam', '10 - 20 km/jam', '10 - 40 km/jam', '20 - 40 km/jam', '20 - 60 km/jam'];

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
optionCity[0] = document.createElement('option');
optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
city.appendChild(optionCity[0]);

if (inputCity.value != '') {
    while (city.hasChildNodes()) {
        city.removeChild(city.firstChild);
    }
    // console.log(inputCity.value);
    optionCity[0] = document.createElement('option');
    optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
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
                        if (inputCity.value == objCity.dataCity[i]['city']) {
                            optionCity[i + 1].setAttribute('selected', 'selected');
                            latitude = objCity.dataCity[i]['lat'];
                            longitude = objCity.dataCity[i]['lng'];
                            zoomMaps = objCity.dataCity[i]['zoom'];
                            myLatLng = {
                                lat: latitude,
                                lng: longitude
                            };
                            initMap();
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
    optionCity[0] = document.createElement('option');
    optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
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
    optionCity[0] = document.createElement('option');
    optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
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
                        // option[i + 1].setAttribute('value', i + 1);
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

// Show Lighting --> start
lighting.addEventListener('change', function () {
    inputLighting.value = lighting.value;
    // console.log(inputPemilik.value);
})

const optionLighting = [];
if (inputLighting.value == '') {
    optionLighting[0] = document.createElement('option');
    optionLighting[0].appendChild(document.createTextNode(['Pilih Lampu']));
    lighting.appendChild(optionLighting[0]);
    for (i = 0; i < lightingData.length; i++) {
        optionLighting[i + 1] = document.createElement('option');
        optionLighting[i + 1].appendChild(document.createTextNode(lightingData[i]));
        lighting.appendChild(optionLighting[i + 1]);
    }
} else {
    optionLighting[0] = document.createElement('option');
    optionLighting[0].appendChild(document.createTextNode(['Pilih Kepemilikan']));
    lighting.appendChild(optionLighting[0]);
    for (i = 0; i < lightingData.length; i++) {
        optionLighting[i + 1] = document.createElement('option');
        optionLighting[i + 1].appendChild(document.createTextNode(lightingData[i]));
        if (inputLighting.value == lightingData[i]) {
            optionLighting[i + 1].setAttribute('selected', 'selected');
        }
        lighting.appendChild(optionLighting[i + 1]);
    }
}

// Show Lighting --> end

// Show Property Status --> start
propertyStatus.addEventListener('change', function () {
    inputPemilik.value = propertyStatus.value;
    // console.log(inputPemilik.value);
    if (inputPemilik.value == 'Mitra') {
        for (i = 0; i < build.length; i++) {
            if (build[i] == 'Terbangun') {
                optionBuild[i + 1].setAttribute('selected', 'selected');
                buildSelect.setAttribute('disabled', true);
                buildStatus.value = buildSelect.value;
            }
        }
    } else {
        buildSelect.removeAttribute('disabled');
        for (i = 0; i < build.length; i++) {
            if (build[i] == 'Terbangun') {
                optionBuild[i + 1].removeAttribute('selected', 'selected');
                buildStatus.value = '';
            }
        }
    }
})

const optionProperty = [];
if (inputPemilik.value === '') {
    optionProperty[0] = document.createElement('option');
    optionProperty[0].appendChild(document.createTextNode(['Pilih Kepemilikan']));
    propertyStatus.appendChild(optionProperty[0]);
    for (i = 0; i < property.length; i++) {
        optionProperty[i + 1] = document.createElement('option');
        optionProperty[i + 1].appendChild(document.createTextNode(property[i]));
        propertyStatus.appendChild(optionProperty[i + 1]);
    }
} else {
    optionProperty[0] = document.createElement('option');
    optionProperty[0].appendChild(document.createTextNode(['Pilih Kepemilikan']));
    propertyStatus.appendChild(optionProperty[0]);
    for (i = 0; i < property.length; i++) {
        optionProperty[i + 1] = document.createElement('option');
        optionProperty[i + 1].appendChild(document.createTextNode(property[i]));
        if (inputPemilik.value == property[i]) {
            optionProperty[i + 1].setAttribute('selected', 'selected');
        }
        propertyStatus.appendChild(optionProperty[i + 1]);
    }
}

// Show Property Status --> end

// Show Build Status --> start
buildSelect.addEventListener('change', function () {
    buildStatus.value = buildSelect.value;
    // console.log(buildStatus.value);
})

const optionBuild = [];
if (buildStatus.value == '') {
    optionBuild[0] = document.createElement('option');
    optionBuild[0].appendChild(document.createTextNode(['Pilih Kondisi']));
    buildSelect.appendChild(optionBuild[0]);
    for (i = 0; i < build.length; i++) {
        optionBuild[i + 1] = document.createElement('option');
        optionBuild[i + 1].appendChild(document.createTextNode(build[i]));
        buildSelect.appendChild(optionBuild[i + 1]);
    }
} else {
    if (inputPemilik.value == 'Mitra') {
        buildSelect.setAttribute('disabled', true);
    } else {
        buildSelect.removeAttribute('disabled');
    }
    optionBuild[0] = document.createElement('option');
    optionBuild[0].appendChild(document.createTextNode(['Pilih Kondisi']));
    buildStatus.appendChild(optionBuild[0]);
    for (i = 0; i < build.length; i++) {
        optionBuild[i + 1] = document.createElement('option');
        optionBuild[i + 1].appendChild(document.createTextNode(build[i]));
        if (buildStatus.value == build[i]) {
            optionBuild[i + 1].setAttribute('selected', 'selected');
        }
        buildSelect.appendChild(optionBuild[i + 1]);
    }
}
// Show Build Status --> end

// Show Sale Status --> start
saleSelect.addEventListener('change', function () {
    saleStatus.value = saleSelect.value;
    if (saleSelect.value == 'Sold') {
        periode.removeAttribute('hidden');
        divKlien.removeAttribute('hidden');
        harga.removeAttribute('hidden');
    } else {
        periode.setAttribute('hidden', 'hidden');
        divKlien.setAttribute('hidden', 'hidden');
        harga.setAttribute('hidden', 'hidden');
    }
    // console.log(buildStatus.value);
})

const optionSale = [];
if (saleStatus.value == '') {
    optionSale[0] = document.createElement('option');
    optionSale[0].appendChild(document.createTextNode(['Pilih Status']));
    saleSelect.appendChild(optionSale[0]);
    for (i = 0; i < sale.length; i++) {
        optionSale[i + 1] = document.createElement('option');
        optionSale[i + 1].appendChild(document.createTextNode(sale[i]));
        saleSelect.appendChild(optionSale[i + 1]);
    }
} else {
    optionSale[0] = document.createElement('option');
    optionSale[0].appendChild(document.createTextNode(['Pilih Status']));
    saleStatus.appendChild(optionSale[0]);
    for (i = 0; i < sale.length; i++) {
        optionSale[i + 1] = document.createElement('option');
        optionSale[i + 1].appendChild(document.createTextNode(sale[i]));
        if (saleStatus.value == sale[i]) {
            optionSale[i + 1].setAttribute('selected', 'selected');
        }
        saleSelect.appendChild(optionSale[i + 1]);
    }
}
console.log(saleSelect.value)
if (saleSelect.value == 'Sold') {
    periode.removeAttribute('hidden');
    divKlien.removeAttribute('hidden');
    harga.removeAttribute('hidden');
} else {
    periode.setAttribute('hidden', 'hidden');
    divKlien.setAttribute('hidden', 'hidden');
    harga.setAttribute('hidden', 'hidden');
}
// Show Sale Status --> end

// Show Road Segment --> start
roadSegment.addEventListener('change', function () {
    inputJalan.value = roadSegment.value;
    // console.log(inputJalan.value);
})
const optionRoad = [];
if (inputJalan.value === '') {
    optionRoad[0] = document.createElement('option');
    optionRoad[0].appendChild(document.createTextNode(['Pilih Type Jalan']));
    roadSegment.appendChild(optionRoad[0]);
    for (i = 0; i < road.length; i++) {
        optionRoad[i + 1] = document.createElement('option');
        optionRoad[i + 1].appendChild(document.createTextNode(road[i]));
        roadSegment.appendChild(optionRoad[i + 1]);
    }
} else {
    optionRoad[0] = document.createElement('option');
    optionRoad[0].appendChild(document.createTextNode(['Pilih Type Jalan']));
    roadSegment.appendChild(optionRoad[0]);
    for (i = 0; i < road.length; i++) {
        optionRoad[i + 1] = document.createElement('option');
        optionRoad[i + 1].appendChild(document.createTextNode(road[i]));
        if (inputJalan.value == road[i]) {
            optionRoad[i + 1].setAttribute('selected', 'selected');
        }
        roadSegment.appendChild(optionRoad[i + 1]);
    }
}

// Show Road Segment --> end

// Show Max Distance --> start
maxDistance.addEventListener('change', function () {
    inputJarak.value = maxDistance.value;
    // console.log(inputJarak.value);
})
const optionDistance = [];
if (inputJarak.value === '') {
    optionDistance[0] = document.createElement('option');
    optionDistance[0].appendChild(document.createTextNode(['Pilih Jarak Pandang']));
    maxDistance.appendChild(optionDistance[0]);
    for (i = 0; i < distance.length; i++) {
        optionDistance[i + 1] = document.createElement('option');
        optionDistance[i + 1].appendChild(document.createTextNode(distance[i]));
        maxDistance.appendChild(optionDistance[i + 1]);
    }
} else {
    optionDistance[0] = document.createElement('option');
    optionDistance[0].appendChild(document.createTextNode(['Pilih Jarak Pandang']));
    maxDistance.appendChild(optionDistance[0]);
    for (i = 0; i < distance.length; i++) {
        optionDistance[i + 1] = document.createElement('option');
        optionDistance[i + 1].appendChild(document.createTextNode(distance[i]));
        if (inputJarak.value == distance[i]) {
            optionDistance[i + 1].setAttribute('selected', 'selected');
        }
        maxDistance.appendChild(optionDistance[i + 1]);
    }
}

// Show Max Distance --> end

// Show Speed Average --> start
speedAverage.addEventListener('change', function () {
    inputKecepatan.value = speedAverage.value;
    // console.log(inputKecepatan.value);
})
const optionSpeed = [];
if (inputKecepatan.value === '') {
    optionSpeed[0] = document.createElement('option');
    optionSpeed[0].appendChild(document.createTextNode(['Pilih Kec. Kendaraan']));
    speedAverage.appendChild(optionSpeed[0]);
    for (i = 0; i < speed.length; i++) {
        optionSpeed[i + 1] = document.createElement('option');
        optionSpeed[i + 1].appendChild(document.createTextNode(speed[i]));
        speedAverage.appendChild(optionSpeed[i + 1]);
    }
} else {
    optionSpeed[0] = document.createElement('option');
    optionSpeed[0].appendChild(document.createTextNode(['Pilih Kecepatan Kendaraan']));
    speedAverage.appendChild(optionSpeed[0]);
    for (i = 0; i < speed.length; i++) {
        optionSpeed[i + 1] = document.createElement('option');
        optionSpeed[i + 1].appendChild(document.createTextNode(speed[i]));
        if (inputKecepatan.value == speed[i]) {
            optionSpeed[i + 1].setAttribute('selected', 'selected');
        }
        speedAverage.appendChild(optionSpeed[i + 1]);
    }
}
// Show Speed Average --> end

// Show Sector --> start
let split = [];
let word = '';
console.log(sector.value);

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
    inputCity.value = city.value;
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
                    if (objCity.dataCity[i]['city'] === city.value) {
                        latitude = objCity.dataCity[i]['lat'];
                        cityId.value = objCity.dataCity[i]['id'];
                        cityCode.value = objCity.dataCity[i]['code'];
                        console.log(cityId.value);
                        longitude = objCity.dataCity[i]['lng'];
                        zoomMaps = objCity.dataCity[i]['zoom'];
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
