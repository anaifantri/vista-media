// Google Maps --> start
let map;
let markers = [];
const area = document.getElementById("area");
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
    return fetch('/get-sales/'+area.value+'/area')
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
    return fetch('/get-locations/'+area.value+'/area')
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
        window.open("http://vistamedia.co.id/media/locations/" + marker.get("id"));
    });
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}
