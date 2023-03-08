const area = document.getElementById("area");
const latitude = document.getElementById("latitude");
const longitude = document.getElementById("longitude");
const zoom = document.getElementById("zoom");
const code = document.getElementById("code");
let map;
let lat = -1.7505372;
let lng = 118.0962239;
let zoomMaps = 4.35;

let myLatLng = {
    lat: lat,
    lng: lng
};

area.addEventListener('change', function () {
    if (area.value === '1') {
        lat = -8.4436802;
        lng = 115.1097609;
        zoomMaps = 9.3;
        myLatLng = {
            lat: lat,
            lng: lng
        };
        code.value = '7';
        latitude.value = lat;
        longitude.value = lng;
        zoom.value = zoomMaps;
        initMap();
    }
});


function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: zoomMaps,
        center: myLatLng,
    });
}