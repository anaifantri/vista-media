const provinsi = document.getElementById("provinsi");
const area = document.getElementById("area");
const lat = document.getElementById("lat");
const lng = document.getElementById("lng");
const zoom = document.getElementById("zoom");
const area_code = document.getElementById("area_code");

// Provinsi --> start
class Provinsi {
    constructor(name, area, lat, lng, zoom, code) {
        this.name = name;
        this.area = area;
        this.lat = lat;
        this.lng = lng;
        this.zoom = zoom;
        this.code = code;
    }
}

let provBali = new Provinsi("Bali", "Bali", -8.4436802, 115.1097609, 9.3, "7");
let provJatim = new Provinsi("Jawa Timur", "Jatim", -7.7058367, 112.5401473, 8, "6");
let provKalimantan = new Provinsi("Kalimantan", "Kalimantan", 1.2343256, 115.2584841, 5.5, "5");
let provLombok = new Provinsi("Lombok", "Lombok", -8.6783228, 117.4268288, 8, "8");

const objProvinsi = [provBali, provJatim, provKalimantan, provLombok];

const option = [];

// while (provinsi.hasChildNodes()) {
//     provinsi.removeChild(provinsi.firstChild);
// }

option[0] = document.createElement('option');
option[0].appendChild(document.createTextNode(['Pilih Provinsi']));
provinsi.appendChild(option[0]);

for (let i = 0; i < objProvinsi.length; i++) {
    option[i + 1] = document.createElement('option');
    option[i + 1].appendChild(document.createTextNode(objProvinsi[i].name));
    option[i + 1].setAttribute('value', objProvinsi[i].name);
    provinsi.appendChild(option[i + 1]);
}
// Provinsi --> end
// Google Maps --> start
let map;
let latitude = -1.7505372;
let longitude = 118.0962239;
let zoomMaps = 4.35;

let myLatLng = {
    lat: latitude,
    lng: longitude
};

provinsi.addEventListener('change', function () {
    const areaAlert = document.getElementById("areaAlert");
    for (let i = 0; i < objProvinsi.length; i++) {
        if (provinsi.value === objProvinsi[i].name) {
            latitude = objProvinsi[i].lat;
            longitude = objProvinsi[i].lng;
            zoomMaps = objProvinsi[i].zoom;
            myLatLng = {
                lat: latitude,
                lng: longitude
            };
            area_code.value = objProvinsi[i].code;
            provinsi.value = objProvinsi[i].name;
            area.value = objProvinsi[i].area
            lat.value = latitude;
            lng.value = longitude;
            zoom.value = zoomMaps;
            initMap();
        }
    }
    areaAlert.classList.add('hidden');
});


function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: zoomMaps,
        center: myLatLng,
    });
}

// Google maps --> end
