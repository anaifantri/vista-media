const area_id = document.getElementById("area_id");
const area = document.getElementById("area");
const city = document.getElementById("city");
const code = document.getElementById("code");
const lat = document.getElementById("lat");
const lng = document.getElementById("lng");
const zoom = document.getElementById("zoom");
const area_code = document.getElementById("area_code");

let obj = {};

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

            obj = JSON.parse(xhrArea.responseText);
            const option = [];

            if (area_code.value != '') {
                option[0] = document.createElement('option');
                option[0].appendChild(document.createTextNode(['Pilih Area']));
                option[0].setAttribute('value', 'Pilih Area');
                area_id.appendChild(option[0]);

                for (i = 0; i < obj.dataArea.length; i++) {
                    option[i + 1] = document.createElement('option');
                    option[i + 1].appendChild(document.createTextNode(obj.dataArea[i]['area']));
                    option[i + 1].setAttribute('value', obj.dataArea[i]['id']);
                    if (area_code.value == obj.dataArea[i]['area_code']) {
                        option[i + 1].setAttribute('selected', 'selected');
                    }
                    area_id.appendChild(option[i + 1]);
                }
            } else {

                option[0] = document.createElement('option');
                option[0].appendChild(document.createTextNode(['Pilih Area']));
                option[0].setAttribute('value', 'Pilih Area');
                area_id.appendChild(option[0]);

                for (i = 0; i < obj.dataArea.length; i++) {
                    option[i + 1] = document.createElement('option');
                    option[i + 1].appendChild(document.createTextNode(obj.dataArea[i]['area']));
                    option[i + 1].setAttribute('value', obj.dataArea[i]['id']);
                    area_id.appendChild(option[i + 1]);
                }
            }
        }
    } else {
        // Oh no! There has been an error with the request!
    }
}
// City --> start
class City {
    constructor(code, area, city, lat, lng, zoom) {
        this.code = code;
        this.area = area;
        this.city = city;
        this.lat = lat;
        this.lng = lng;
        this.zoom = zoom;
    }
}
//Area Bali
let kotaDenpasar = new City("DPS", "Bali", "Denpasar", -8.6604518, 115.2297791, 12.75);
let kabBadung = new City("BDG", "Bali", "Badung", -8.6703875, 115.1584738, 11.25);
let kabTabanan = new City("TBN", "Bali", "Tabanan", -8.4487956, 115.0811079, 11);
let kabJembrana = new City("NGR", "Bali", "Negara", -8.3081311, 114.6855932, 11.25);
let kabKarangasem = new City("KRS", "Bali", "Karangasem", -8.4501011, 115.5862558, 14);
let kabBuleleng = new City("SGR", "Bali", "Singaraja", -8.2708581, 114.9237865, 10.5);
let kabKlungkung = new City("KLK", "Bali", "Klungkung", -8.5179342, 115.3956393, 12.7);
let kabGianyar = new City("GYR", "Bali", "Gianyar", -8.494917, 115.2721698, 11.2);
let kabBangli = new City("BGL", "Bali", "Bangli", -8.3340052, 115.3630761, 11.2);
//Area Jawa Timur
let kotaSurabaya = new City("SBY", "Jatim", "Surabaya", -7.2757134, 112.7233596, 12);
let kabSidoarjo = new City("SDJ", "Jatim", "Sidoarjo", -7.4601224, 112.6729812, 11.75);
let kabBanyuwangi = new City("BWI", "Jatim", "Banyuwangi", -8.2125822, 114.2358363, 10.25);
let kotaMalang = new City("MLG", "Jatim", "Malang", -7.9761185, 112.619891, 12.5);
let kotaMojokerto = new City("MJK", "Jatim", "Mojokerto", -7.4720428, 112.4407848, 13.75);
let kabJember = new City("JBR", "Jatim", "Jember", -8.1851244, 113.7044038, 12);
let kabPamekasan = new City("PMK", "Jatim", "Pamekasan", -7.1782008, 113.481792, 12.5);
//Area Kalimantan
let banjarmasin = new City("BJM", "Kalimantan", "Banjarmasin", -3.317649, 114.5854566, 13);
let banjarbaru = new City("BJB", "Kalimantan", "Banjarbaru", -3.4608001, 114.7974584, 12.75);
let martapura = new City("MTP", "Kalimantan", "Martapura", -3.4265854, 114.7737913, 12.5);
let barito = new City("BAT", "Kalimantan", "Barito Kuala", -3.2652175, 114.6032853, 13.25);
let kandangan = new City("KDG", "Kalimantan", "Kandangan", -2.7834092, 115.271409, 13.5);
let balangan = new City("BLG", "Kalimantan", "Balangan", -2.3361292, 115.4602356, 14.5);
let barabai = new City("BRB", "Kalimantan", "Barabai", -2.5817574, 115.3839551, 14.25);
let tapin = new City("TPN", "Kalimantan", "Tapin", -3.0220571, 115.146846, 11.25);
let batulicin = new City("BLC", "Kalimantan", "Batulicin", -3.4768345, 115.997039, 13);
let tanjung = new City("TJG", "Kalimantan", "Tanjung", -2.1670513, 115.3997033, 13);
let tarakan = new City("TRK", "Kalimantan", "Tarakan", 3.3355728, 117.5841015, 12.75);
let samarinda = new City("SMD", "Kalimantan", "Samarinda", -0.5018035, 117.1480332, 13);
let sampit = new City("SPT", "Kalimantan", "Sampit", -2.5379729, 112.947809, 14.75);
let palangkaraya = new City("PKY", "Kalimantan", "Palangkaraya", -2.2109807, 113.9138929, 13.25);
let kapuas = new City("KPS", "Kalimantan", "Kapuas", -2.9871032, 114.4066379, 13);
let pontianak = new City("PNK", "Kalimantan", "Pontianak", -0.0668599, 109.3483369, 12.25);
let balikpapan = new City("BLP", "Kalimantan", "Balikpapan", -1.2488277, 116.8662009, 13.25);
//Area Lombok
let praya = new City("PRY", "Lombok", "Praya", -8.6905626, 116.2802245, 12.75);
let mataram = new City("MTR", "Lombok", "Mataram", -8.5906503, 116.1034722, 13.5);
let selong = new City("SLG", "Lombok", "Selong", -8.6626391, 116.5339923, 13.75);

const objCity = [kotaDenpasar, kabBadung, kabTabanan, kabJembrana, kabKarangasem, kabBuleleng, kabKlungkung, kabGianyar, kabBangli, kotaSurabaya, kabSidoarjo, kabBanyuwangi, kotaMalang, kotaMojokerto, kabJember, kabPamekasan, banjarmasin, banjarbaru, martapura, barito, kandangan, balangan, barabai, tapin, batulicin, tanjung, tarakan, samarinda, sampit, palangkaraya, pontianak, balikpapan, kapuas, praya, mataram, selong];

const optionCity = [];

optionCity[0] = document.createElement('option');
optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
city.appendChild(optionCity[0]);

if (area.value != '') {
    // console.log(area.value);
    while (city.hasChildNodes()) {
        city.removeChild(city.firstChild);
    }

    optionCity[0] = document.createElement('option');
    optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
    optionCity[0].setAttribute('value', 'Pilih Kota');
    city.appendChild(optionCity[0]);

    for (let i = 0; i < objCity.length; i++) {
        if (objCity[i].area == area.value) {
            optionCity[i + 1] = document.createElement('option');
            optionCity[i + 1].appendChild(document.createTextNode(objCity[i].city));
            optionCity[i + 1].setAttribute('value', objCity[i].city);
            city.appendChild(optionCity[i + 1]);
        }
    }
}

area_id.addEventListener('change', function () {
    for (i = 0; i < obj.dataArea.length; i++) {
        if (obj.dataArea[i].id == area_id.value) {
            area.value = obj.dataArea[i].area;
            area_code.value = obj.dataArea[i].area_code;
        }
    }

    while (city.hasChildNodes()) {
        city.removeChild(city.firstChild);
    }

    optionCity[0] = document.createElement('option');
    optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
    optionCity[0].setAttribute('value', 'Pilih Kota');
    city.appendChild(optionCity[0]);
    for (let i = 0; i < objCity.length; i++) {
        if (objCity[i].area == area.value) {
            optionCity[i + 1] = document.createElement('option');
            optionCity[i + 1].appendChild(document.createTextNode(objCity[i].city));
            optionCity[i + 1].setAttribute('value', objCity[i].city);
            city.appendChild(optionCity[i + 1]);
        }
    }
    // for (let i = 0; i < obj.dataArea.length; i++) {
    //     if (obj.dataArea[i].area == area_id.value) {
    //         area_code.value = obj.dataArea[i].area_code;
    //     }
    // }
})

// City --> end
// Google Maps --> start
let map;
let latitude = -1.7505372;
let longitude = 118.0962239;
let zoomMaps = 4.35;

let myLatLng = {
    lat: latitude,
    lng: longitude
};

city.addEventListener('change', function () {
    for (let i = 0; i < objCity.length; i++) {
        if (city.value === objCity[i].city) {
            latitude = objCity[i].lat;
            longitude = objCity[i].lng;
            zoomMaps = objCity[i].zoom;
            myLatLng = {
                lat: latitude,
                lng: longitude
            };
            code.value = objCity[i].code;
            lat.value = latitude;
            lng.value = longitude;
            zoom.value = zoomMaps;
            initMap();
        }
    }
});


function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: zoomMaps,
        center: myLatLng,
    });
}

// Google maps --> end
