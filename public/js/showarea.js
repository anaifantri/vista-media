// Google Maps --> start
let map;
let latitude = document.getElementById("lat").textContent;
let longitude = document.getElementById("lng").textContent;
let zoomMaps = document.getElementById("zoom").textContent;

console.log(latitude);
console.log(longitude);
console.log(zoomMaps);

let myLatLng = {
    lat: Number(latitude),
    lng: Number(longitude)
};

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: Number(zoomMaps),
        center: myLatLng,
    });
}

initMap();

// Google maps --> end
