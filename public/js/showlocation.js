// Google Maps --> start
let map;
const latitude = document.getElementById("lat");
const longitude = document.getElementById("lng");
const category = document.getElementById("category");
var lat = 0;
var lng = 0;
let myLatLng = {
    lat: 0,
    lng: 0
};

if(category.value == "Signage"){
    lat = JSON.parse(latitude.value);
    lng = JSON.parse(longitude.value);
    myLatLng = {
        lat: lat[0],
        lng: lng[0]
    };
} else {
    lat = Number(latitude.value);
    lng = Number(longitude.value);
    myLatLng = {
        lat: lat,
        lng: lng
    };
}

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 16,
        center: myLatLng,
    });

    if (category.value == "Signage"){
        for(let i = 0; i < lat.length; i++){
            myLatLng = {
                lat: lat[i],
                lng: lng[i]
            };
            const marker = new google.maps.Marker({
                position: myLatLng,
                map,
                icon: "/img/marker-red.png"
            });
        }
    } else {
        const marker = new google.maps.Marker({
            position: myLatLng,
            map,
            icon: "/img/marker-red.png"
        });
    }
}
// Google Maps --> end

// Modal Preview Script start -->
btnPreview = () => {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    window.scrollTo(0, 0);
};

btnClose = () => {
    modal.classList.remove('flex');
    modal.classList.add('hidden');
};
// Modal Preview Script end -->

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