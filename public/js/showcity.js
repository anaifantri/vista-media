// Google Maps --> start
let map;
let markers = [];
const city = document.getElementById("city");
let latitude = document.getElementById("lat").textContent;
let longitude = document.getElementById("lng").textContent;
let zoomMaps = document.getElementById("zoom").textContent;
let dataSales = {};
let dataLocations = {};

let myLatLng = {
    lat: Number(latitude),
    lng: Number(longitude)
};

let posisi = { lat: Number(latitude), lng: Number(longitude) };
let description = {};

// Get Sales Data --> start
function getSales() {
    return fetch('/get-sales/'+city.value+'/city')
      .then(status)
      .then(json);
  }

function status(response) {
    if (response.status >= 200 && response.status < 300) {
      return Promise.resolve(response)
    } else {
      return Promise.reject(new Error(response.statusText))
    }
  }
  
  function json(response) {
    return response.json()
  }
// Get Sales Data --> end

// Get Locations --> start
getLocations = () =>{
    return fetch('/get-locations/'+city.value+'/city')
      .then(status)
      .then(json);
}
// Get Locations --> end

// Show Add & Marker--> start
showMarker();
function showMarker(){
    getLocations()
    .then(function(data) {
      dataLocations = data.locations;
      getSales()
      .then(function(data) {
          dataSales = data.sales;
          for (let i = 0; i < dataLocations.length; i++) {
            var saleStatus = false;
            description = JSON.parse(dataLocations[i].description);
            posisi = { lat: Number(description.lat), lng: Number(description.lng) };
            for(let j = 0; j < dataSales.length; j++){
                if(dataSales[j].location_id == dataLocations[i].id){
                    saleStatus = true;
                }
            }
            if(saleStatus == true){
                console.log(dataLocations[i].code);
                addMarker(posisi, title = "Kode : " + dataLocations[i].code + " \nLokasi : " + dataLocations[i].address, icon = "/img/marker-red.png", id = dataLocations[i].id);
            }else{
                addMarker(posisi, title = "Kode : " + dataLocations[i].code + " \nLokasi : " + dataLocations[i].address, icon = "/img/marker-green.png", id = dataLocations[i].id);
            }
          }
      })
      .catch(function(error) {
        console.log('Request failed', error);
      });
    })
    .catch(function(error) {
      console.log('Request failed', error);
    });    

}
// Show Add & Marker--> end

// Get Billboard Data & Add Marker --> start
// setTimeout(getBillboardData, 100);
// function getBillboardData() {
//     const xhrBillboard = new XMLHttpRequest();
//     const methodBillboard = "GET";
//     const urlBillboard = "/showBillboard";

//     xhrBillboard.open(methodBillboard, urlBillboard, true);
//     xhrBillboard.send();

//     xhrBillboard.onreadystatechange = () => {
//         // In local files, status is 0 upon success in Mozilla Firefox
//         if (xhrBillboard.readyState === XMLHttpRequest.DONE) {
//             const status = xhrBillboard.status;
//             if (status === 0 || (status >= 200 && status < 400)) {
//                 // The request has been completed successfully

//                 var obj = JSON.parse(xhrBillboard.responseText);
//                 const month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
//                 var start_contract = new Date();
//                 let startMonth = month[start_contract.getMonth()];
//                 var end_contract = new Date();
//                 let endMonth = month[end_contract.getMonth()];
//                 let price = 0;
//                 let hasClient = false;
//                 let client = '';

//                 for (i = 0; i < obj.dataBillboard.length; i++) {
//                     if (obj.dataBillboard[i].city_id == city.value) {
//                         posisi = { lat: Number(obj.dataBillboard[i].lat), lng: Number(obj.dataBillboard[i].lng) };
//                         hasClient = false;
//                         for (j = 0; j < dataSales.length; j++) {
//                             var endAt = new Date(dataSales[j].end_at);
//                             if (dataSales[j].billboard_id == obj.dataBillboard[i].id && endAt > new Date()) {
//                                 start_contract = new Date(dataSales[j].start_at);
//                                 end_contract = new Date(dataSales[j].end_at);
//                                 startMonth = month[start_contract.getMonth()];
//                                 endMonth = month[end_contract.getMonth()];

//                                 price = dataSales[j].price;
//                                 hasClient = true;

//                                 for (k = 0; k < dataClients.length; k++) {
//                                     if (dataClients[k].id == dataSales[j].client_id) {
//                                         client = dataClients[k].name;
//                                     }
//                                 }
//                             }
//                         }

//                         if (hasClient == true) {
//                             var priceFormat = price.toLocaleString();
//                             addMarker(posisi, title = "Kode : " + obj.dataBillboard[i].code + " \nLokasi : " + obj.dataBillboard[i].address + " \nKlien : " + client + " \nHarga : Rp. " + priceFormat + ",- \nAwal Kontrak : " + start_contract.getDate() + "-" + startMonth + "-" + start_contract.getFullYear() + " \nAkhir Kontrak : " + end_contract.getDate() + "-" + endMonth + "-" + end_contract.getFullYear(), icon = "/img/marker-red.png", id = obj.dataBillboard[i].id);
//                         } else {
//                             addMarker(posisi, title = "Kode : " + obj.dataBillboard[i].code + " \nLokasi : " + obj.dataBillboard[i].address, icon = "/img/marker-green.png", id = obj.dataBillboard[i].id);
//                         }
//                     }
//                 }
//             } else {
//                 // Oh no! There has been an error with the request!
//             }
//         }
//     };
// };
// Get Billboard Data & Add Marker --> end

// Init Map --> start
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: Number(zoomMaps),
        center: myLatLng,
    });
};
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
        window.open("http://vistamedia.co.id/media/locations/" + marker.get("id"));
    });
};

// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
};

// Google maps --> end
