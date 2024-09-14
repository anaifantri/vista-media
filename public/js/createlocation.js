const sector = document.getElementById("sector");
const description = document.getElementById("description");
const areaId = document.getElementById("area_id");
const cityId = document.getElementById("city_id");
const cbSector = document.querySelectorAll('[id=cbSector]');

let objSector = {};
let objDescription = {};
let dataSector = [];

let map;
let markers = [];
let latitude = -1.7505372;
let longitude = 118.0962239;
let zoomMaps = 4.35;

let myLatLng = {
    lat: latitude,
    lng: longitude
};

if(document.getElementById("lat").value == ""){
    if(areaId.value != "pilih"){
        if(cityId.value != "pilih"){
            let dataCity = JSON.parse(cityId.options[cityId.selectedIndex].id)
            myLatLng = {
                lat : Number(dataCity.lat),
                lng : Number(dataCity.lng)
            }
            zoomMaps = Number(dataCity.zoom);
        }else{
            let dataArea = JSON.parse(areaId.options[areaId.selectedIndex].id)
            myLatLng = {
                lat : Number(dataArea.lat),
                lng : Number(dataArea.lng)
            }
            zoomMaps = Number(dataArea.zoom);
        }
    }
}

if(sector.value != ""){
    var sectors = JSON.parse(sector.value);
    for(let i = 0; i < cbSector.length; i++){
        for(let n = 0; n < sectors.dataSector.length; n++){
            if(cbSector[i].value == sectors.dataSector[n]){
                cbSector[i].checked = true;
            }
        }
    }
}

for(let i = 0; i < cityId.options.length; i++){
    if(i > 0){
        let dataCity = JSON.parse(cityId.options[i].id);
        if(dataCity.area_id != areaId.value){
            cityId.options[i].setAttribute('hidden','hidden');
        } else {
            cityId.options[i].removeAttribute('hidden');
        }
    }
}

selectCity = (sel) => {
    let dataCity = JSON.parse(sel.options[sel.selectedIndex].id)
    myLatLng = {
        lat : Number(dataCity.lat),
        lng : Number(dataCity.lng)
    }
    zoomMaps = Number(dataCity.zoom);
    initMap();
}

selectArea = (sel) => {
    let dataArea = JSON.parse(sel.options[sel.selectedIndex].id)
    myLatLng = {
        lat : Number(dataArea.lat),
        lng : Number(dataArea.lng)
    }
    zoomMaps = Number(dataArea.zoom);
    initMap();
    cityId.options[0].selected = true;
    for(let i = 0; i < cityId.options.length; i++){
        if(i > 0){
            let dataCity = JSON.parse(cityId.options[i].id);
            if(dataCity.area_id != sel.value){
                cityId.options[i].setAttribute('hidden','hidden');
            } else {
                cityId.options[i].removeAttribute('hidden');
            }
        }
    }
}

// Function Preview Image start
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
// Function Preview Image end

// Google maps --> start

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

// Function Get Sector --> start
getSector = (sel) => {
    if(sector.value != ""){
        var sectors = JSON.parse(sector.value);
        dataSector = sectors.dataSector;
    }
    if(sel.checked == true){
        dataSector.push(sel.value);
    }else {
        for (let i = 0; i < dataSector.length; i++) {
            if (dataSector[i] == sel.value) {
                dataSector.splice(i, 1);
            }
        }
    }
    objSector = {dataSector};
    sector.value = JSON.stringify(objSector);
}
// Function Get Sector --> end