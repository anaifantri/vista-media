const area = document.getElementById("area");
const city = document.getElementById("city");
const size = document.getElementById("size");
const category = document.getElementById("category");

let objArea = {};
let objCity = {};
let objSize = {};
let objCategory = {};

// Show Area --> start
const xhrArea = new XMLHttpRequest();
const methodArea = "GET";
const urlArea = "/showArea";

xhrArea.open(methodArea, urlArea, true);
xhrArea.send();

xhrArea.onreadystatechange = () => {
    // In local files, status is 0 upon success in Mozilla Firefox
    if (xhrArea.readyState === XMLHttpRequest.DONE) {
        const status = xhrArea.status;
        if (status === 0 || (status >= 200 && status < 400)) {
            // The request has been completed successfully
            // console.log(xhrArea.responseText);
            objArea = JSON.parse(xhrArea.responseText);
            const option = [];

            // console.log(objArea.dataArea);
            // console.log(objArea.dataArea[0]['area']);

            option[0] = document.createElement('option');
            option[0].appendChild(document.createTextNode(['Pilih Area']));
            area.appendChild(option[0]);

            for (i = 0; i < objArea.dataArea.length; i++) {
                option[i + 1] = document.createElement('option');
                option[i + 1].appendChild(document.createTextNode(objArea.dataArea[i]['area']));
                // option[i + 1].setAttribute('value', i + 1);
                area.appendChild(option[i + 1]);
            }
        } else {
            // Oh no! There has been an error with the request!
        }
    }
}
// Show Area --> end

// Show City --> start
area.addEventListener('change', function () {
    while (city.hasChildNodes()) {
        city.removeChild(city.firstChild);
    }
    const optionCity = [];
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
                // console.log(xhrCity.responseText);
                objCity = JSON.parse(xhrCity.responseText);

                // console.log(objCity.dataCity);
                // console.log(objCity.dataCity[0]['city']);

                for (i = 0; i < objCity.dataCity.length; i++) {
                    if (objCity.dataCity[i]['area'] === area.value) {
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

// Show Category --> start
const xhrCategory = new XMLHttpRequest();
const methodCategory = "GET";
const urlCategory = "/showCategory";

xhrCategory.open(methodCategory, urlCategory, true);
xhrCategory.send();

xhrCategory.onreadystatechange = () => {
    // In local files, status is 0 upon success in Mozilla Firefox
    if (xhrCategory.readyState === XMLHttpRequest.DONE) {
        const status = xhrCategory.status;
        if (status === 0 || (status >= 200 && status < 400)) {
            // The request has been completed successfully
            // console.log(xhrCategory.responseText);
            objCategory = JSON.parse(xhrCategory.responseText);
            const option = [];

            // console.log(objCategory.dataCategory);
            // console.log(objCategory.dataCategory[0]['Category']);

            option[0] = document.createElement('option');
            option[0].appendChild(document.createTextNode(['Pilih Category']));
            category.appendChild(option[0]);

            for (i = 0; i < objCategory.dataCategory.length; i++) {
                option[i + 1] = document.createElement('option');
                option[i + 1].appendChild(document.createTextNode(objCategory.dataCategory[i]['name'] + " - " + objCategory.dataCategory[i]['lighting']));
                // option[i + 1].setAttribute('value', i + 1);
                category.appendChild(option[i + 1]);
            }
        } else {
            // Oh no! There has been an error with the request!
        }
    }
}
// Show Category --> end

// Show Size --> start
const xhrSize = new XMLHttpRequest();
const methodSize = "GET";
const urlSize = "/showSize";

xhrSize.open(methodSize, urlSize, true);
xhrSize.send();

xhrSize.onreadystatechange = () => {
    // In local files, status is 0 upon success in Mozilla Firefox
    if (xhrSize.readyState === XMLHttpRequest.DONE) {
        const status = xhrSize.status;
        if (status === 0 || (status >= 200 && status < 400)) {
            // The request has been completed successfully
            // console.log(xhrSize.responseText);
            objSize = JSON.parse(xhrSize.responseText);
            const option = [];

            // console.log(objSize.dataSize);
            // console.log(objSize.dataSize[0]['Size']);

            option[0] = document.createElement('option');
            option[0].appendChild(document.createTextNode(['Pilih Size']));
            size.appendChild(option[0]);

            for (i = 0; i < objSize.dataSize.length; i++) {
                option[i + 1] = document.createElement('option');
                option[i + 1].appendChild(document.createTextNode(objSize.dataSize[i]['size'] + " - " + objSize.dataSize[i]['side'] + " Sisi - " + objSize.dataSize[i]['orientation']));
                // option[i + 1].setAttribute('value', i + 1);
                size.appendChild(option[i + 1]);
            }
        } else {
            // Oh no! There has been an error with the request!
        }
    }
}
// Show Size --> end

// Google Maps --> start
let map;
let latitude = -1.7505372;
let longitude = 118.0962239;
let zoomMaps = 4.35;

let myLatLng = {
    lat: latitude,
    lng: longitude
};

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: zoomMaps,
        center: myLatLng,
    });
}
window.initMap = initMap;
// Google maps --> end
