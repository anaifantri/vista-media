// Google Maps --> start
let map;
let markers = [];
const area = document.getElementById("area");
let latitude = document.getElementById("lat").textContent;
let longitude = document.getElementById("lng").textContent;
let zoomMaps = document.getElementById("zoom").textContent;


let myLatLng = {
    lat: Number(latitude),
    lng: Number(longitude)
};

let posisi = { lat: Number(latitude), lng: Number(longitude) };

const xhrProduct = new XMLHttpRequest();
const methodProduct = "GET";
const urlProduct = "/showProduct";

xhrProduct.open(methodProduct, urlProduct, true);
xhrProduct.send();

xhrProduct.onreadystatechange = () => {
    // In local files, status is 0 upon success in Mozilla Firefox
    if (xhrProduct.readyState === XMLHttpRequest.DONE) {
        const status = xhrProduct.status;
        if (status === 0 || (status >= 200 && status < 400)) {
            // The request has been completed successfully

            var obj = JSON.parse(xhrProduct.responseText);
            const month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var start_contract = new Date('2023/5/25');
            let startMMM = month[start_contract.getMonth()];
            var end_contract = new Date('2023/5/25');
            let endMMM = month[end_contract.getMonth()];

            for (i = 0; i < obj.dataProduct.length; i++) {
                if (obj.dataProduct[i].area_id == area.value) {
                    posisi = { lat: Number(obj.dataProduct[i].lat), lng: Number(obj.dataProduct[i].lng) };
                    start_contract = new Date(obj.dataProduct[i].start_contract);
                    startMMM = month[start_contract.getMonth()];
                    end_contract = new Date(obj.dataProduct[i].end_contract);
                    endMMM = month[end_contract.getMonth()];
                    if (obj.dataProduct[i].sale_status == "Sold") {
                        let price = obj.dataProduct[i].price;
                        var priceFormat = price.toLocaleString();
                        addMarker(posisi, title = "Kode : " + obj.dataProduct[i].code + " \n Klien : " + obj.dataProduct[i].client + " \n Harga : Rp. " + priceFormat + ",- \n Awal Kontrak : " + start_contract.getDate() + "-" + startMMM + "-" + start_contract.getFullYear() + " \n Akhir Kontrak : " + end_contract.getDate() + "-" + endMMM + "-" + end_contract.getFullYear(), icon = "/img/marker-red.png", id = obj.dataProduct[i].id);
                    } else if ((obj.dataProduct[i].build_status == "Rencana" || obj.dataProduct[i].build_status == "Pembangunan") && obj.dataProduct[i].sale_status == "Available") {
                        addMarker(posisi, title = "Kode : " + obj.dataProduct[i].code + " \nKondisi : " + obj.dataProduct[i].build_status + " \nStatus : " + obj.dataProduct[i].sale_status, icon = "/img/marker-yellow.png", id = obj.dataProduct[i].id);
                    } else if (obj.dataProduct[i].sale_status == "Available" && obj.dataProduct[i].build_status == "Terbangun") {
                        addMarker(posisi, title = "Kode : " + obj.dataProduct[i].code + " \nStatus : " + obj.dataProduct[i].sale_status, icon = "/img/marker-green.png", id = obj.dataProduct[i].id);
                    }
                }
            }

        } else {
            // Oh no! There has been an error with the request!
        }
    }
};

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: Number(zoomMaps),
        center: myLatLng,
    });
}

// Adds a marker to the map and push to the array.
function addMarker(position, title, icon, id) {
    const marker = new google.maps.Marker({
        position,
        map,
        title,
        icon,
        id,
        optimized: false,
    });
    const infoWindow = new google.maps.InfoWindow();
    markers.push(marker);

    marker.addListener("click", () => {
        // infoWindow.close();
        // infoWindow.setContent(marker.getTitle());
        // infoWindow.open(marker.getMap(), marker);
        window.open("http://vistamedia.co.id/dashboard/media/products/" + marker.get("id"));
    });
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

// initMap();

// Google maps --> end
