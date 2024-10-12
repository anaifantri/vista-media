// Google Maps --> start
let map;
let markers = [];
const sector = document.getElementById("sector");
// const description = document.getElementById("description");
const areaId = document.getElementById("area_id");
const cityId = document.getElementById("city_id");
const cbSector = document.querySelectorAll('[id=cbSector]');
const latitude = document.getElementById("lat");
const longitude = document.getElementById("lng");
const category = document.getElementById("category");

let objSector = {};
// let objDescription = JSON.parse(description.value);
let dataSector = [];

var lat = 0;
var lng = 0;
var dataLat = JSON.parse(latitude.value);
var dataLng = JSON.parse(longitude.value);
let myLatLng = {
    lat: 0,
    lng: 0
};
let zoomMaps = 4.35;

if(category.value == "Signage"){
    lat = JSON.parse(latitude.value);
    lng = JSON.parse(longitude.value);
    myLatLng = {
        lat: lat[0],
        lng: lng[0]
    };
    zoomMaps = 16;
} else {
    lat = Number(latitude.value);
    lng = Number(longitude.value);
    myLatLng = {
        lat: lat,
        lng: lng
    };
    zoomMaps = 16;
}
// Google Maps --> end

// Function Select City --> start
selectCity = (sel) => {
    let dataCity = JSON.parse(sel.options[sel.selectedIndex].id)
    myLatLng = {
        lat : Number(dataCity.lat),
        lng : Number(dataCity.lng)
    }
    zoomMaps = Number(dataCity.zoom);
    initMap();
    deleteMarkers();
    latitude.value = "";
    longitude.value = "";
}
// Function Select City --> end

// Function Select Area --> start
selectArea = (sel) => {
    let dataArea = JSON.parse(sel.options[sel.selectedIndex].id)
    myLatLng = {
        lat : Number(dataArea.lat),
        lng : Number(dataArea.lng)
    }
    zoomMaps = Number(dataArea.zoom);
    initMap();
    deleteMarkers();
    latitude.value = "";
    longitude.value = "";
    cityId.options[0].selected = true;
    for(let i = 0; i < cityId.options.length; i++){
        if(i > 0){
            let dataCity = JSON.parse(cityId.options[i].id);
            if(dataCity.area_id == sel.value){
                cityId.options[i].removeAttribute('hidden');
            } else {
                cityId.options[i].setAttribute('hidden','hidden');
            }
        }
    }
}
// Function Select Area --> end

// Function Preview Image start
function previewImage() {
    const addPhoto = document.querySelector('#add_photo');
    const imgPreview = document.querySelector('.img-preview');

    // imgPreview.style.display = 'block';

    const oFReader = new FileReader();

    oFReader.readAsDataURL(addPhoto.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
// Function Preview Image end

// Function Preview Update Image start
function previewImageUpdate() {
    const updatePhoto = document.querySelector('#update_photo');
    const imgPreview = document.querySelector('.img-preview');

    // imgPreview.style.display = 'block';

    const oFReader = new FileReader();

    oFReader.readAsDataURL(updatePhoto.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
// Function Preview Update Image end

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

// Modal Add Script start -->
showModalAdd = () => {
    document.getElementById("divUpdate").classList.add('hidden');
    document.getElementById("divUpdate").classList.remove('flex');
    document.getElementById("divUpdateDefault").classList.add('hidden');
    document.getElementById("divUpdateDefault").classList.remove('flex');
    document.getElementById("divAdd").classList.remove('hidden');
    document.getElementById("divAdd").classList.add('flex');
    document.getElementById("divAddDefault").classList.remove('hidden');
    document.getElementById("divAddDefault").classList.add('flex');
    document.getElementById("divTitle").innerHTML = "Tambah Foto";
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    window.scrollTo(0, 0);
};

showModalUpdate = (sel) => {
    document.getElementById("btnUpdate").setAttribute('name', sel.id);
    document.getElementById("old_photo").value = sel.name;
    console.log(document.getElementById("old_photo").value);
    document.getElementById("divAdd").classList.add('hidden');
    document.getElementById("divAdd").classList.remove('flex');
    document.getElementById("divAddDefault").classList.add('hidden');
    document.getElementById("divAddDefault").classList.remove('flex');
    document.getElementById("divUpdate").classList.remove('hidden');
    document.getElementById("divUpdate").classList.add('flex');
    document.getElementById("divUpdateDefault").classList.remove('hidden');
    document.getElementById("divUpdateDefault").classList.add('flex');
    document.getElementById("divTitle").innerHTML = "Update Foto";
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    window.scrollTo(0, 0);
};

deletePhoto = (sel) => {
    if(confirm("Anda yakin ingin menghapus foto?")) {
        document.getElementById("formDelete").action = "/media/location-photos/"+ sel.id;
        document.getElementById("formDelete").submit();
    }
}

updateDefault = (sel) => {
    document.getElementById("formDefault").action = "/media/location-photos/"+ sel.id;
    document.getElementById("formDefault").submit();
}

actionSubmit = (sel) => {
    document.getElementById("formUpdate").action = "/media/location-photos/"+ sel.name;
    document.getElementById("formUpdate").submit();
};

btnClose = () => {
    modal.classList.remove('flex');
    modal.classList.add('hidden');
};
// Modal Add Script end -->

// Funtion Button Next-Prev-figure start -->
const imageViews = document.querySelectorAll(".divImage");
const figure = document.getElementById("figure");
const figureImages = figure.getElementsByTagName("img");
var index = 0;

for(let i = 0; i < imageViews.length; i++){
    if(imageViews[i].id == 1){
        index = i;
        imageViews[i].removeAttribute('hidden');
    } else {
        imageViews[i].setAttribute('hidden', 'hidden');
    }
}
buttonNext = () => {
    if(index == imageViews.length - 1){
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[0].classList.remove('photo');
        figureImages[0].classList.add('photo-active');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[0].removeAttribute('hidden');
        index = 0;
    } else {
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[index + 1].classList.add('photo-active');
        figureImages[index + 1].classList.remove('photo');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[index + 1].removeAttribute('hidden');
        index = index + 1;
    }
}
buttonPrev = () => {
    if(index == 0){
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[imageViews.length - 1].classList.remove('photo');
        figureImages[imageViews.length - 1].classList.add('photo-active');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[imageViews.length - 1].removeAttribute('hidden');
        index = imageViews.length - 1;
    } else {
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[index - 1].classList.add('photo-active');
        figureImages[index - 1].classList.remove('photo');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[index - 1].removeAttribute('hidden');
        index = index - 1;
    }
}
figureAction = (sel) => {
    for(let i = 0; i < figureImages.length; i++){
        if(figureImages[i].id == sel.id){
            figureImages[i].classList.remove('photo');
            figureImages[i].classList.add('photo-active');
            imageViews[i].removeAttribute('hidden');
        } else {
            figureImages[i].classList.add('photo');
            figureImages[i].classList.remove('photo-active');
            imageViews[i].setAttribute('hidden', 'hidden');
        }
    }
}
// Funtion Button Next-Prev-figure end -->