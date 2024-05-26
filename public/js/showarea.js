// Google Maps --> start
let map;
let markers = [];
const area = document.getElementById("area");
let latitude = document.getElementById("lat").textContent;
let longitude = document.getElementById("lng").textContent;
let zoomMaps = document.getElementById("zoom").textContent;
let objSales = {};
let dataSales = [];
let objClients = {};
let dataClients = [];

let myLatLng = {
    lat: Number(latitude),
    lng: Number(longitude)
};

let posisi = { lat: Number(latitude), lng: Number(longitude) };

// Get Sales Data --> start
const xhrSale = new XMLHttpRequest();
const methodSale = "GET";
const urlSale = "/showSale";

xhrSale.open(methodSale, urlSale, true);
xhrSale.send();

xhrSale.onreadystatechange = () => {
    // In local files, status is 0 upon success in Mozilla Firefox
    if (xhrSale.readyState === XMLHttpRequest.DONE) {
        const status = xhrSale.status;
        if (status === 0 || (status >= 200 && status < 400)) {
            // The request has been completed successfully

            objSales = JSON.parse(xhrSale.responseText);
            dataSales = objSales.dataSale;
        }
    }
}
// Get Sales Data --> end

// Get Clients Data --> start
const xhrClient = new XMLHttpRequest();
const methodClient = "GET";
const urlClient = "/showClient";

xhrClient.open(methodClient, urlClient, true);
xhrClient.send();

xhrClient.onreadystatechange = () => {
    // In local files, status is 0 upon success in Mozilla Firefox
    if (xhrClient.readyState === XMLHttpRequest.DONE) {
        const status = xhrClient.status;
        if (status === 0 || (status >= 200 && status < 400)) {
            // The request has been completed successfully

            objClients = JSON.parse(xhrClient.responseText);
            dataClients = objClients.dataClient;
        }
    }
}
// Get Clients Data --> end

// Get Billboard Data & Add Marker --> start
setTimeout(getBillboardData, 100);
function getBillboardData() {
    const xhrBillboard = new XMLHttpRequest();
    const methodBillboard = "GET";
    const urlBillboard = "/showBillboard";

    xhrBillboard.open(methodBillboard, urlBillboard, true);
    xhrBillboard.send();

    xhrBillboard.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrBillboard.readyState === XMLHttpRequest.DONE) {
            const status = xhrBillboard.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                // The request has been completed successfully

                var obj = JSON.parse(xhrBillboard.responseText);
                const month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                var start_contract = new Date('2023/5/25');
                let startMonth = month[start_contract.getMonth()];
                var end_contract = new Date('2023/5/25');
                let endMonth = month[end_contract.getMonth()];
                let price = 0;
                let hasClient = false;
                let client = '';

                for (i = 0; i < obj.dataBillboard.length; i++) {
                    if (obj.dataBillboard[i].area_id == area.value) {
                        hasClient = false;
                        posisi = { lat: Number(obj.dataBillboard[i].lat), lng: Number(obj.dataBillboard[i].lng) };
                        for (j = 0; j < dataSales.length; j++) {
                            var endAt = new Date(dataSales[j].end_at);
                            if (dataSales[j].billboard_id == obj.dataBillboard[i].id && endAt > new Date()) {
                                start_contract = new Date(dataSales[j].start_at);
                                end_contract = new Date(dataSales[j].end_at);
                                startMonth = month[start_contract.getMonth()];
                                endMonth = month[end_contract.getMonth()];

                                price = dataSales[j].price;
                                hasClient = true;
                                for (k = 0; k < dataClients.length; k++) {
                                    if (dataClients[k].id == dataSales[j].client_id) {
                                        client = dataClients[k].name;
                                    }
                                }
                            }
                        }

                        if (hasClient == true) {
                            var priceFormat = price.toLocaleString();
                            addMarker(posisi, title = "Kode : " + obj.dataBillboard[i].code + " \nLokasi : " + obj.dataBillboard[i].address + " \nKlien : " + client + " \nHarga : Rp. " + priceFormat + ",- \nAwal Kontrak : " + start_contract.getDate() + "-" + startMonth + "-" + start_contract.getFullYear() + " \nAkhir Kontrak : " + end_contract.getDate() + "-" + endMonth + "-" + end_contract.getFullYear(), icon = "/img/marker-red.png", id = obj.dataBillboard[i].id);
                        } else {
                            addMarker(posisi, title = "Kode : " + obj.dataBillboard[i].code + " \nLokasi : " + obj.dataBillboard[i].address, icon = "/img/marker-green.png", id = obj.dataBillboard[i].id);
                        }
                    }
                }

            } else {
                // Oh no! There has been an error with the request!
            }
        }
    };
};

// Get Billboard Data & Add Marker --> end


// Init Map --> start
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: Number(zoomMaps),
        center: myLatLng,
    });
}
// Init Map --> end

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
        window.open("http://vistamedia.co.id/dashboard/media/billboards/" + marker.get("id"));
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

// Google maps --> end
