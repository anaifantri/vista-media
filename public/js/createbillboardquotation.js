// Declaration Quotation Create --> start
const formCreate = document.getElementById("formCreate");
const areaId = document.getElementById("area_id");
const inputCity = document.getElementById("inputCity");
const inputClient = document.getElementById("inputClient");
const inputContact = document.getElementById("inputContact");
const inputEmail = document.getElementById("inputEmail");
const inputPhone = document.getElementById("inputPhone");
const btnPreview = document.getElementById("btnPreview");
const cityId = document.getElementById("city_id");
const clientId = document.getElementById("client_id");
const contactId = document.getElementById("contact_id");
const billboardCategory = document.getElementById("billboardCategory");
const billboardCategoryId = document.getElementById("billboard_category_id");
const number = document.getElementById("number");
const attachment = document.getElementById("attachment");
const subject = document.getElementById("subject");
const bodyTop = document.getElementById("body_top");
const billboards = document.getElementById("billboards");
const note = document.getElementById("note");
const bodyEnd = document.getElementById("body_end");
const bodyEndBillboard = document.getElementById("bodyEndBillboard");
const pricePeriode = document.getElementById("price_periode");
const priceType = document.getElementById("priceType");
// Declaration Quotation Create --> end

// Declaration Quotation Billboard --> start
// const quotationNumber = document.getElementById("quotationNumber");
const attachmentBillboard = document.getElementById("attachmentBillboard");
const subjectBillboard = document.getElementById("subjectBillboard");
const clientCompany = document.getElementById("clientCompany");
const clientContact = document.getElementById("clientContact");
const contactEmail = document.getElementById("contactEmail");
const contactPhone = document.getElementById("contactPhone");
const bodyTopBillboard = document.getElementById("bodyTopBillboard");
const btnAdd = document.getElementById("btnAdd");
const auto = document.getElementById("auto");
const manual = document.getElementById("manual");
const aMonth = document.getElementById("aMonth");
const oneMonth = document.getElementById("oneMonth");
const quarterYear = document.getElementById("quarterYear");
const threeMonth = document.getElementById("threeMonth");
const halfYear = document.getElementById("halfYear");
const sixMonth = document.getElementById("sixMonth");
const aYear = document.getElementById("aYear");
const twelveMonth = document.getElementById("twelveMonth");
const billboardQuotation = document.getElementById("billboardQuotation");
const billboardTable = document.getElementById("billboardTable");
const thAMonth = document.getElementById("thAMonth");
const thQuarterYear = document.getElementById("thQuarterYear");
const thHalfYear = document.getElementById("thHalfYear");
const thAYear = document.getElementById("thAYear");
const thManual = document.getElementById("thManual");
const billboardsTBody = document.getElementById("billboardsTBody");
const billboardNote = document.getElementById("billboardNote");
const billboardTArea = document.getElementById("billboardTArea");
const billboardNote01 = document.getElementById("billboardNote01");
const cbBillboardNote01 = document.getElementById("cbBillboardNote01");
const inputBBNote01 = document.getElementById("inputBBNote01");
const billboardNote02 = document.getElementById("billboardNote02");
const cbBillboardNote02 = document.getElementById("cbBillboardNote02");
const inputBBNote02 = document.getElementById("inputBBNote02");
const billboardNote03 = document.getElementById("billboardNote03");
const cbBillboardNote03 = document.getElementById("cbBillboardNote03");
const inputBBNote03 = document.getElementById("inputBBNote03");
const billboardNote04 = document.getElementById("billboardNote04");
const cbBillboardNote04 = document.getElementById("cbBillboardNote04");
const inputBBNote04 = document.getElementById("inputBBNote04");
const billboardNote05 = document.getElementById("billboardNote05");
const cbBillboardNote05 = document.getElementById("cbBillboardNote05");
const inputBBNote05 = document.getElementById("inputBBNote05");
const billboardNote06 = document.getElementById("billboardNote06");
const inputBBNote06 = document.getElementById("inputBBNote06");
const cbBillboardNote06 = document.getElementById("cbBillboardNote06");
const inputBBNote07 = document.getElementById("inputBBNote07");
const billboardNote07 = document.getElementById("billboardNote07");
const cbBillboardNote07 = document.getElementById("cbBillboardNote07");
const billboardNote08 = document.getElementById("billboardNote08");
const cbBillboardNote08 = document.getElementById("cbBillboardNote08");
const inputBBNote08 = document.getElementById("inputBBNote08");
const billboardNote09 = document.getElementById("billboardNote09");
const cbBillboardNote09 = document.getElementById("cbBillboardNote09");
const inputBBNote09 = document.getElementById("inputBBNote09");
const billboardNote10 = document.getElementById("billboardNote10");
const cbBillboardNote10 = document.getElementById("cbBillboardNote10");
const inputBBNote10 = document.getElementById("inputBBNote10");
// Declaration Quotation Billboard --> end

// Declaration Quotation Add Locations --> start
const modal = document.getElementById("modal");
const btnCLose = document.getElementById("btn-close");
const search = document.getElementById("search");
const getSelected = document.getElementById("getSelected");
const locationsTable = document.getElementById("locationsTable");
const tHead4 = document.getElementById("tHead4");
const tHead5 = document.getElementById("tHead5");
const locationTBody = document.getElementById("locationTBody");
// Declaration Quotation Add Locations --> end

// Declaration Quotation Billboard Preview --> start
const modalPreview = document.getElementById("modalPreview");
// const btnSavePdf = document.getElementById("btnSavePdf");
const btnClosePreview = document.getElementById("btnClosePreview");
const quotationNumberBBPreview = document.getElementById("quotationNumberBBPreview");
const attachmentBBPreview = document.getElementById("attachmentBBPreview");
const subjectBBPreview = document.getElementById("subjectBBPreview");
const clientBBPreview = document.getElementById("clientBBPreview");
const contactBBPreview = document.getElementById("contactBBPreview");
const contactEmailBBPreview = document.getElementById("contactEmailBBPreview");
const contactPhoneBBPreview = document.getElementById("contactPhoneBBPreview");
const letterBodyBBPreview = document.getElementById("letterBodyBBPreview");
const previewBBTBody = document.getElementById("previewBBTBody");
const previewBBthAMonth = document.getElementById("previewBBthAMonth");
const previewBBthQuarterYear = document.getElementById("previewBBthQuarterYear");
const previewBBthHalfYear = document.getElementById("previewBBthHalfYear");
const previewBBthAYear = document.getElementById("previewBBthAYear");
const previewBBthManual = document.getElementById("previewBBthManual");
const previewBBManualPrice = document.getElementById("previewBBManualPrice");
const tableWidth = document.getElementById("tableWidth");
const previewBBNote = document.getElementById("previewBBNote");
const previewBBNote01 = document.getElementById("previewBBNote01");
const inputPreviewBBNote01 = document.getElementById("inputPreviewBBNote01");
const previewBBNote02 = document.getElementById("previewBBNote02");
const inputPreviewBBNote02 = document.getElementById("inputPreviewBBNote02");
const previewBBNote03 = document.getElementById("previewBBNote03");
const inputPreviewBBNote03 = document.getElementById("inputPreviewBBNote03");
const previewBBNote04 = document.getElementById("previewBBNote04");
const inputPreviewBBNote04 = document.getElementById("inputPreviewBBNote04");
const previewBBNote05 = document.getElementById("previewBBNote05");
const previewBBNote06 = document.getElementById("previewBBNote06");
const inputPreviewBBNote06 = document.getElementById("inputPreviewBBNote06");
const previewBBNote07 = document.getElementById("previewBBNote07");
const inputPreviewBBNote07 = document.getElementById("inputPreviewBBNote07");
const previewBBNote08 = document.getElementById("previewBBNote08");
const previewBBTArea = document.getElementById("previewBBTArea");
const lablePreviewBBNote08 = document.getElementById("lablePreviewBBNote08");
const previewBBNote09 = document.getElementById("previewBBNote09");
const inputPreviewBBNote09 = document.getElementById("inputPreviewBBNote09");
const previewBBNote10 = document.getElementById("previewBBNote10");
const inputPreviewBBNote10 = document.getElementById("inputPreviewBBNote10");
const locationsImage = document.getElementById("locationsImage");
// Declaration Quotation Billboard Preview --> end

// const btnSave = document.getElementById("btnSave");

let objCity = {};
let objContact = {};
let objBillboard = {};
let objSize = {};
let objBillboardCategory = {};
let objBillboardQuotation = {};
let objBillboardPhoto = {};
let objBillboards = {};
let locations = [];
let objNote = {};
let notes = [];
let objQuotationCity = {};
let objQuotation = {};

let dataBillboardQuotation = [];
let dataCity = [];
let dataBillboardPhoto = [];
let dataContact = [];
let dataBillboard = [];
let dataSize = [];
let dataBillboardCategory = [];
let dataLocation = [];

let newRow = [];
let cell = [];
let sizeId = [];
let checkbox = [];
let radioButton = [];
let btnDel = [];
let inputPriceMonth = [];
let inputPriceQuarter = [];
let inputPriceHalf = [];
let inputPriceYear = [];
let previewInputPrice = [];

let iBillboard = 0;
let iSize = 0;
let iBillboardCategory = 0;
let iBillboardPhoto = 0;
let iCity = 0;
let priceColumn = 0;

let area = '';

const optionCity = [];

// Get Quotation Data --> start
getQuotationData();
function getQuotationData() {
    const xhrBillboardQuotation = new XMLHttpRequest();
    const methodBillboardQuotation = "GET";
    const urlBillboardQuotation = "/showBillboardQuotation";

    xhrBillboardQuotation.open(methodBillboardQuotation, urlBillboardQuotation, true);
    xhrBillboardQuotation.send();

    xhrBillboardQuotation.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrBillboardQuotation.readyState === XMLHttpRequest.DONE) {
            const status = xhrBillboardQuotation.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objBillboardQuotation = JSON.parse(xhrBillboardQuotation.responseText);
                dataBillboardQuotation = objBillboardQuotation.dataBillboardQuotation;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Quotation Data --> end

// Get Data Contact --> start
getDataContact();
function getDataContact() {
    const xhrContact = new XMLHttpRequest();
    const methodContact = "GET";
    const urlContact = "/showContact";

    xhrContact.open(methodContact, urlContact, true);
    xhrContact.send();

    xhrContact.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrContact.readyState === XMLHttpRequest.DONE) {
            const status = xhrContact.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objContact = JSON.parse(xhrContact.responseText);
                dataContact = objContact.dataContact;
                showContact();
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Data Contact --> end

// Get Object Billboard --> start
getDataBillboard();
function getDataBillboard() {
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
                objBillboard = JSON.parse(xhrBillboard.responseText);
                dataBillboard = objBillboard.dataBillboard;
                if (attachment.value != "") {
                    fillQuotation();
                    areaId.removeAttribute('disabled');
                    cityId.removeAttribute('disabled');
                    clientId.removeAttribute('disabled');
                    contactId.removeAttribute('disabled');
                    btnPreview.classList.add('btn-primary');
                    btnPreview.classList.remove('btn-disabled');
                    btnPreview.removeAttribute('disabled');
                    btnAdd.removeAttribute('disabled');
                    btnAdd.classList.remove('btn-disabled');
                    btnAdd.classList.add('btn-primary');
                }
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Object Billboard --> end

// Add Quotation Number --> start
function addQuotationNumber() {
    const date = new Date();
    const year = date.getFullYear();
    let month = "";
    // const day = date.getDay();

    if (date.getMonth() + 1 == 1) {
        month = "I";
    } else if (date.getMonth() + 1 == 2) {
        month = "II";
    } else if (date.getMonth() + 1 == 3) {
        month = "III";
    } else if (date.getMonth() + 1 == 4) {
        month = "IV";
    } else if (date.getMonth() + 1 == 5) {
        month = "V";
    } else if (date.getMonth() + 1 == 6) {
        month = "VI";
    } else if (date.getMonth() + 1 == 7) {
        month = "VII";
    } else if (date.getMonth() + 1 == 8) {
        month = "VIII";
    } else if (date.getMonth() + 1 == 9) {
        month = "IX";
    } else if (date.getMonth() + 1 == 10) {
        month = "X";
    } else if (date.getMonth() + 1 == 11) {
        month = "XI";
    } else if (date.getMonth() + 1 == 12) {
        month = "XII";
    }

    if (dataBillboardQuotation.length == 0) {
        var resultsNumber = 1;
    } else {
        for (i = 0; i < dataBillboardQuotation.length; i++) {
            var getNumber = dataBillboardQuotation[dataBillboardQuotation.length - 1].number;
            var resultsNumber = Number(getNumber.slice(0, 4)) + 1;
        }
    }
    if (resultsNumber < 10) {
        number.value = "000" + (resultsNumber) + "/APP/VM/" + month + "-" + year;
    } else if (resultsNumber < 100) {
        number.value = "00" + (resultsNumber) + "/APP/VM/" + month + "-" + year;
    } else if (resultsNumber < 1000) {
        number.value = "0" + (resultsNumber) + "/APP/VM/" + month + "-" + year;
    } else if (resultsNumber >= 1000) {
        number.value = (resultsNumber) + "/APP/VM/" + month + "-" + year;
    }

}
// Add Quotation Number --> end

// Fill Quotation --> start
function fillQuotation() {
    if (subject.value != "") {
        subjectBillboard.innerHTML = subject.value;
    };
    if (attachment.value != "") {
        attachmentBillboard.innerHTML = attachment.value;
    };
    if (bodyTop.value != "") {
        bodyTopBillboard.innerHTML = bodyTop.value;
    };
    if (bodyEnd.value != "") {
        bodyEndBillboard.innerHTML = bodyEnd.value;
    };

    if (inputContact.value != "") {
        clientContact.innerHTML = 'UP. Ibu ' + inputContact.value;
        contactEmail.innerHTML = inputEmail.value;
        contactPhone.innerHTML = inputPhone.value;
    }

    if (inputClient.value != "") {
        clientCompany.innerHTML = inputClient.value;
    }

    if (priceType.value != "") {
        if (priceType.value == "Harga Otomatis") {
            auto.checked = true;
        } else {
            auto.checked = false;
        }

        if (priceType.value == "Harga Manual") {
            manual.checked = true;
        } else {
            manual.checked = false;
        }
    }

    if (areaId.value != "Pilih Area" && cityId.value == "Pilih Kota") {
        dataLocation = [];
        let n = 0;
        for (i = 0; i < dataBillboard.length; i++) {
            if (dataBillboard[i].area_id == areaId.value && dataBillboard[i].billboard_category_id == billboardCategoryId.value) {
                dataLocation[n] = {
                    id: dataBillboard[i].id,
                    area: dataBillboard[i].area_id,
                    city: dataBillboard[i].city_id,
                    code: dataBillboard[i].code,
                    address: dataBillboard[i].address,
                    category: dataBillboard[i].billboard_category_id,
                    lighting: dataBillboard[i].lighting,
                    photo: dataBillboard[i].photo,
                    lat: dataBillboard[i].lat,
                    lng: dataBillboard[i].lng,
                    road: dataBillboard[i].road_segment,
                    distance: dataBillboard[i].max_distance,
                    speed: dataBillboard[i].speed_average,
                    sector: dataBillboard[i].sector,
                    size: dataBillboard[i].size_id,
                    price: dataBillboard[i].price
                };
                n++;
            }
        }
    } else if (areaId.value != "Pilih Area" && cityId.value != "Pilih Kota") {
        dataLocation = [];
        let n = 0;
        for (i = 0; i < dataBillboard.length; i++) {
            if (dataBillboard[i].area_id == areaId.value && dataBillboard[i].city_id == cityId.value && dataBillboard[i].billboard_category_id == billboardCategoryId.value) {
                dataLocation[n] = {
                    id: dataBillboard[i].id,
                    area: dataBillboard[i].area_id,
                    city: dataBillboard[i].city_id,
                    code: dataBillboard[i].code,
                    address: dataBillboard[i].address,
                    category: dataBillboard[i].billboard_category_id,
                    lighting: dataBillboard[i].lighting,
                    photo: dataBillboard[i].photo,
                    lat: dataBillboard[i].lat,
                    lng: dataBillboard[i].lng,
                    road: dataBillboard[i].road_segment,
                    distance: dataBillboard[i].max_distance,
                    speed: dataBillboard[i].speed_average,
                    sector: dataBillboard[i].sector,
                    size: dataBillboard[i].size_id,
                    price: dataBillboard[i].price
                };
                n++;
            }
        }
    }

    if (billboards.value != "") {
        let billboardsValue = JSON.parse(billboards.value);
        locations = billboardsValue.locations;
        while (billboardsTBody.hasChildNodes()) {
            billboardsTBody.removeChild(billboardsTBody.firstChild);
        }

        for (iBillboard = 0; iBillboard < locations.length; iBillboard++) {
            newRow[iBillboard] = billboardsTBody.insertRow(iBillboard);
            cell[0] = newRow[iBillboard].insertCell(0);
            cell[0].innerHTML = iBillboard + 1;
            cell[0].classList.add('td-table');
            cell[1] = newRow[iBillboard].insertCell(1);
            cell[1].innerHTML = locations[iBillboard].code;
            cell[1].classList.add('td-table');
            cell[2] = newRow[iBillboard].insertCell(2);
            cell[2].innerHTML = locations[iBillboard].address;
            cell[2].classList.add('text-xs');
            cell[2].classList.add('text-teal-700');
            cell[2].classList.add('border');
            cell[3] = newRow[iBillboard].insertCell(3);
            cell[3].innerHTML = "BB";
            cell[3].classList.add('td-table');
            cell[4] = newRow[iBillboard].insertCell(4);
            cell[4].innerHTML = locations[iBillboard].lighting;
            cell[4].classList.add('td-table');
            cell[5] = newRow[iBillboard].insertCell(5);
            cell[5].innerHTML = locations[iBillboard].size;
            cell[5].classList.add('td-table');
            cell[6] = newRow[iBillboard].insertCell(6);
            if (manual.checked == true) {
                inputPriceMonth[iBillboard] = document.createElement('input');
                inputPriceMonth[iBillboard].classList.add('input-price');
                inputPriceMonth[iBillboard].value = locations[iBillboard].price.periodeMonth.priceMonth;
                cell[6].appendChild(inputPriceMonth[iBillboard]);
            } else {
                // cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price) * 0.1);
                cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeMonth.priceMonth));
            }

            if (locations[iBillboard].price.periodeMonth.cbPeriode == true) {
                cell[6].removeAttribute('hidden');
                thAMonth.removeAttribute('hidden');
                aMonth.checked = true;
                previewBBthAMonth.removeAttribute('hidden');
            } else {
                cell[6].setAttribute('hidden', 'hidden');
                thAMonth.setAttribute('hidden', 'hidden');
                aMonth.checked = false;
                previewBBthAMonth.setAttribute('hidden', 'hidden');
            }

            cell[6].classList.add('td-table');
            cell[7] = newRow[iBillboard].insertCell(7);
            if (manual.checked == true) {
                inputPriceQuarter[iBillboard] = document.createElement('input');
                inputPriceQuarter[iBillboard].classList.add('input-price');
                inputPriceQuarter[iBillboard].value = locations[iBillboard].price.periodeQuarter.priceQuarter;
                cell[7].appendChild(inputPriceQuarter[iBillboard]);
            } else {
                cell[7].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeQuarter.priceQuarter));
            }
            cell[7].classList.add('td-table');
            if (locations[iBillboard].price.periodeQuarter.cbPeriode == true) {
                cell[7].removeAttribute('hidden');
                thQuarterYear.removeAttribute('hidden');
                quarterYear.checked = true;
                previewBBthQuarterYear.removeAttribute('hidden');
            } else {
                cell[7].setAttribute('hidden', 'hidden');
                thQuarterYear.setAttribute('hidden', 'hidden');
                quarterYear.checked = false;
                previewBBthQuarterYear.setAttribute('hidden', 'hidden');
            }
            cell[8] = newRow[iBillboard].insertCell(8);
            if (manual.checked == true) {
                inputPriceHalf[iBillboard] = document.createElement('input');
                inputPriceHalf[iBillboard].classList.add('input-price');
                inputPriceHalf[iBillboard].value = locations[iBillboard].price.periodeHalf.priceHalf;
                cell[8].appendChild(inputPriceHalf[iBillboard]);
            } else {
                cell[8].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeHalf.priceHalf));
            }
            cell[8].classList.add('td-table');
            if (locations[iBillboard].price.periodeHalf.cbPeriode == true) {
                cell[8].removeAttribute('hidden');
                thHalfYear.removeAttribute('hidden');
                halfYear.checked = true;
                previewBBthHalfYear.removeAttribute('hidden');
            } else {
                cell[8].setAttribute('hidden', 'hidden');
                thHalfYear.setAttribute('hidden', 'hidden');
                halfYear.checked = false;
                previewBBthHalfYear.setAttribute('hidden', 'hidden');
            }
            cell[9] = newRow[iBillboard].insertCell(9);
            if (manual.checked == true) {
                inputPriceYear[iBillboard] = document.createElement('input');
                inputPriceYear[iBillboard].classList.add('input-price');
                inputPriceYear[iBillboard].value = locations[iBillboard].price.periodeYear.priceYear;
                cell[9].appendChild(inputPriceYear[iBillboard]);
            } else {
                cell[9].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeYear.priceYear));
            }

            cell[9].classList.add('td-table');
            if (locations[iBillboard].price.periodeYear.cbPeriode == true) {
                cell[9].removeAttribute('hidden');
                thAYear.removeAttribute('hidden');
                aYear.checked = true;
                previewBBthAYear.removeAttribute('hidden');
            } else {
                cell[9].setAttribute('hidden', 'hidden');
                thAYear.setAttribute('hidden', 'hidden');
                aYear.checked = false;
                previewBBthAYear.setAttribute('hidden', 'hidden');
            }
        }
    }

}
// Fill Quotation --> End

// Add attachment & quotation subject --> start
function getCategory(sel) {
    addQuotationNumber();
    areaId.value = 'Pilih Area';
    showCity();
    while (billboardsTBody.hasChildNodes()) {
        billboardsTBody.removeChild(billboardsTBody.firstChild);
    }
    locations = [];
    btnAdd.setAttribute('disabled', 'disabled');
    btnAdd.classList.add('btn-disabled');
    btnAdd.classList.remove('btn-primary');
    billboardCategory.value = sel.options[sel.selectedIndex].text;
    if (billboardCategory.value == "Billboard") {
        btnPreview.classList.add('btn-primary');
        btnPreview.classList.remove('btn-disabled');
        btnPreview.removeAttribute('disabled');
        subjectBillboard.innerHTML = "Penawaran Harga Penggunaan Media Reklame Billboard";
        bodyTopBillboard.innerHTML = '';
        bodyTopBillboard.innerHTML = 'Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ' + billboardCategory.value + ' area ............. dengan spesifikasi sebagai berikut :';
        areaId.removeAttribute('disabled');
        cityId.removeAttribute('disabled');
        clientId.removeAttribute('disabled');
        contactId.removeAttribute('disabled');
        attachmentBillboard.innerHTML = "Foto dan Denah Lokasi";
    } else if (billboardCategory.value == "Bando") {
        btnPreview.classList.add('btn-primary');
        btnPreview.classList.remove('btn-disabled');
        btnPreview.removeAttribute('disabled');
        subjectBillboard.innerHTML = "Penawaran Harga Penggunaan Media Reklame " + billboardCategory.value;
        bodyTopBillboard.innerHTML = '';
        bodyTopBillboard.innerHTML = 'Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ' + billboardCategory.value + ' area ............. dengan spesifikasi sebagai berikut :';
        areaId.removeAttribute('disabled');
        cityId.removeAttribute('disabled');
        clientId.removeAttribute('disabled');
        contactId.removeAttribute('disabled');
        attachmentBillboard.innerHTML = "Foto dan Denah Lokasi";
    } else if (billboardCategory.value == "Baliho") {
        btnPreview.classList.add('btn-primary');
        btnPreview.classList.remove('btn-disabled');
        btnPreview.removeAttribute('disabled');
        subjectBillboard.innerHTML = "Penawaran Harga Penggunaan Media Reklame " + billboardCategory.value;
        bodyTopBillboard.innerHTML = '';
        bodyTopBillboard.innerHTML = 'Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ' + billboardCategory.value + ' area ............. dengan spesifikasi sebagai berikut :';
        areaId.removeAttribute('disabled');
        cityId.removeAttribute('disabled');
        clientId.removeAttribute('disabled');
        contactId.removeAttribute('disabled');
        attachmentBillboard.innerHTML = "Foto dan Denah Lokasi";
    } else if (billboardCategory.value == "Midiboard") {
        btnPreview.classList.add('btn-primary');
        btnPreview.classList.remove('btn-disabled');
        btnPreview.removeAttribute('disabled');
        subjectBillboard.innerHTML = "Penawaran Harga Penggunaan Media Reklame " + billboardCategory.value;
        bodyTopBillboard.innerHTML = '';
        bodyTopBillboard.innerHTML = 'Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ' + billboardCategory.value + ' area ............. dengan spesifikasi sebagai berikut :';
        areaId.removeAttribute('disabled');
        cityId.removeAttribute('disabled');
        clientId.removeAttribute('disabled');
        contactId.removeAttribute('disabled');
        attachmentBillboard.innerHTML = "Foto dan Denah Lokasi";
    } else if (billboardCategory.value == "Pilih Katagori") {
        btnPreview.classList.add('btn-disabled');
        btnPreview.classList.remove('btn-primary');
        btnPreview.setAttribute('disabled', 'disabled');
        areaId.setAttribute('disabled', 'disabled');
        cityId.setAttribute('disabled', 'disabled');
        clientId.setAttribute('disabled', 'disabled');
        contactId.setAttribute('disabled', 'disabled')
        clientId.value = "Pilih Klien";
        while (contactId.hasChildNodes()) {
            contactId.removeChild(contactId.firstChild);
        }
        optionContact[0] = document.createElement('option');
        optionContact[0].appendChild(document.createTextNode(['Pilih Kontak']));
        contactId.appendChild(optionContact[0]);
    }
}

// Add attachment & quotation subject --> end

// Show City --> start
function showCity() {
    optionCity[0] = document.createElement('option');
    optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
    optionCity[0].setAttribute('value', 'Pilih Kota');
    cityId.appendChild(optionCity[0]);

    if (inputCity.value != '' && inputCity.value != 'Pilih Kota') {
        while (cityId.hasChildNodes()) {
            cityId.removeChild(cityId.firstChild);
        }
        optionCity[0] = document.createElement('option');
        optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
        optionCity[0].setAttribute('value', 'Pilih Kota');
        cityId.appendChild(optionCity[0]);
        for (i = 0; i < dataCity.length; i++) {
            if (dataCity[i]['area_id'] == areaId.value) {
                optionCity[i + 1] = document.createElement('option');
                optionCity[i + 1].appendChild(document.createTextNode(dataCity[i]['city']));
                if (inputCity.value == dataCity[i]['id']) {
                    optionCity[i + 1].setAttribute('selected', 'selected');
                }
                optionCity[i + 1].setAttribute('value', dataCity[i]['id']);
                cityId.appendChild(optionCity[i + 1]);
            }
        }
    } else {
        while (cityId.hasChildNodes()) {
            cityId.removeChild(cityId.firstChild);
        }
        optionCity[0] = document.createElement('option');
        optionCity[0].appendChild(document.createTextNode(['Pilih Kota']));
        cityId.appendChild(optionCity[0]);

        for (i = 0; i < dataCity.length; i++) {
            if (dataCity[i]['area_id'] == areaId.value) {
                optionCity[i + 1] = document.createElement('option');
                optionCity[i + 1].appendChild(document.createTextNode(dataCity[i]['city']));
                optionCity[i + 1].setAttribute('value', dataCity[i]['id']);
                cityId.appendChild(optionCity[i + 1]);
            }
        }
    }
}

// Get City Data --> start
getDataCity();
function getDataCity() {
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
                objCity = JSON.parse(xhrCity.responseText);
                dataCity = objCity.dataCity;
                showCity();
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get City Data --> end


function getArea(sel) {
    while (billboardsTBody.hasChildNodes()) {
        billboardsTBody.removeChild(billboardsTBody.firstChild);
    }
    area = sel.options[sel.selectedIndex].text;
    if (billboardCategory.value != '' && sel.options[sel.selectedIndex].text != 'Pilih Area') {
        subjectBillboard.innerHTML = '';
        subjectBillboard.innerHTML = 'Penawaran Harga Penggunaan Media Reklame ' + billboardCategory.value + '<br> Area ' + sel.options[sel.selectedIndex].text;
        bodyTopBillboard.innerHTML = '';
        bodyTopBillboard.innerHTML = 'Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ' + billboardCategory.value + ' area ' + area + ' dengan spesifikasi sebagai berikut :';
        btnAdd.removeAttribute('disabled');
        btnAdd.classList.remove('btn-disabled');
        btnAdd.classList.add('btn-primary');
    } else {
        subjectBillboard.innerHTML = '';
        subjectBillboard.innerHTML = 'Penawaran Harga Penggunaan Media Reklame ' + billboardCategory.value;
        bodyTopBillboard.innerHTML = '';
        bodyTopBillboard.innerHTML = 'Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ' + billboardCategory.value + ' area ............. dengan spesifikasi sebagai berikut :';
        btnAdd.setAttribute('disabled', 'disabled');
        btnAdd.classList.add('btn-disabled');
        btnAdd.classList.remove('btn-primary');
    }
    if (sel.options[sel.selectedIndex].text == 'Bali') {
        cbBillboardNote08.setAttribute('checked', 'checked');
    } else {
        cbBillboardNote08.removeAttribute('checked');
    }
    dataLocation = [];
    let n = 0;
    for (i = 0; i < dataBillboard.length; i++) {
        if (dataBillboard[i].area_id == areaId.value && dataBillboard[i].billboard_category_id == billboardCategoryId.value) {
            dataLocation[n] = {
                id: dataBillboard[i].id,
                area: dataBillboard[i].area_id,
                city: dataBillboard[i].city_id,
                code: dataBillboard[i].code,
                address: dataBillboard[i].address,
                category: dataBillboard[i].billboard_category_id,
                lighting: dataBillboard[i].lighting,
                photo: dataBillboard[i].photo,
                lat: dataBillboard[i].lat,
                lng: dataBillboard[i].lng,
                road: dataBillboard[i].road_segment,
                distance: dataBillboard[i].max_distance,
                speed: dataBillboard[i].speed_average,
                sector: dataBillboard[i].sector,
                size: dataBillboard[i].size_id,
                price: dataBillboard[i].price
            };
            n++;
        }
    }

    showCity();

}

function getCity(sel) {
    inputCity.value = cityId.value;
    console.log(inputCity.value);
    while (billboardsTBody.hasChildNodes()) {
        billboardsTBody.removeChild(billboardsTBody.firstChild);
    }
    if (billboardCategory.value != '' && sel.options[sel.selectedIndex].text != 'Pilih Kota' && area != 'Pilih Area') {
        subjectBillboard.innerHTML = '';
        subjectBillboard.innerHTML = 'Penawaran Harga Penggunaan Media Reklame ' + billboardCategory.value + '<br> Area ' + area + ' Kota ' + sel.options[sel.selectedIndex].text;
        bodyTopBillboard.innerHTML = '';
        bodyTopBillboard.innerHTML = 'Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ' + billboardCategory.value + ' area ' + area + ' kota ' + sel.options[sel.selectedIndex].text + ' dengan spesifikasi sebagai berikut :';
    } else {
        subjectBillboard.innerHTML = '';
        subjectBillboard.innerHTML = 'Penawaran Harga Penggunaan Media Reklame ' + billboardCategory.value + '<br> Area ' + area;
        bodyTopBillboard.innerHTML = '';
        bodyTopBillboard.innerHTML = 'Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ' + billboardCategory.value + ' area ' + area + ' dengan spesifikasi sebagai berikut :';
    }

    if (sel.options[sel.selectedIndex].text == 'Denpasar' || sel.options[sel.selectedIndex].text == 'Badung') {
        cbBillboardNote08.setAttribute('checked', 'checked');
    } else {
        cbBillboardNote08.removeAttribute('checked');
    }

    dataLocation = [];
    let n = 0;
    for (i = 0; i < dataBillboard.length; i++) {
        if (cityId.value == 'Pilih Kota') {
            if (dataBillboard[i].area_id == areaId.value && dataBillboard[i].billboard_category_id == billboardCategoryId.value) {
                dataLocation[n] = {
                    id: dataBillboard[i].id,
                    area: dataBillboard[i].area_id,
                    city: dataBillboard[i].city_id,
                    code: dataBillboard[i].code,
                    address: dataBillboard[i].address,
                    category: dataBillboard[i].billboard_category_id,
                    lighting: dataBillboard[i].lighting,
                    photo: dataBillboard[i].photo,
                    lat: dataBillboard[i].lat,
                    lng: dataBillboard[i].lng,
                    road: dataBillboard[i].road_segment,
                    distance: dataBillboard[i].max_distance,
                    speed: dataBillboard[i].speed_average,
                    sector: dataBillboard[i].sector,
                    size: dataBillboard[i].size_id,
                    price: dataBillboard[i].price
                };
                n++;
            }
        } else {
            if (dataBillboard[i].area_id == areaId.value && dataBillboard[i].city_id == cityId.value && dataBillboard[i].billboard_category_id == billboardCategoryId.value) {
                dataLocation[n] = {
                    id: dataBillboard[i].id,
                    area: dataBillboard[i].area_id,
                    city: dataBillboard[i].city_id,
                    code: dataBillboard[i].code,
                    address: dataBillboard[i].address,
                    category: dataBillboard[i].billboard_category_id,
                    lighting: dataBillboard[i].lighting,
                    photo: dataBillboard[i].photo,
                    lat: dataBillboard[i].lat,
                    lng: dataBillboard[i].lng,
                    road: dataBillboard[i].road_segment,
                    distance: dataBillboard[i].max_distance,
                    speed: dataBillboard[i].speed_average,
                    sector: dataBillboard[i].sector,
                    size: dataBillboard[i].size_id,
                    price: dataBillboard[i].price
                };
                n++;
            }
        }
    }
}
// Show City --> end

// Get Client --> start
function getClient(sel) {
    clientCompany.innerHTML = sel.options[sel.selectedIndex].text;
    inputClient.value = sel.options[sel.selectedIndex].text;

    showContact();

}
// Get Client --> end

// Show Contact --> start
function showContact() {
    const optionContact = [];
    optionContact[0] = document.createElement('option');
    optionContact[0].appendChild(document.createTextNode(['Pilih Kontak']));
    contactId.appendChild(optionContact[0]);

    if (inputContact.value != '' && inputContact.value != 'Pilih Kontak') {
        while (contactId.hasChildNodes()) {
            contactId.removeChild(contactId.firstChild);
        }
        optionContact[0] = document.createElement('option');
        optionContact[0].appendChild(document.createTextNode(['Pilih Kontak']));
        contactId.appendChild(optionContact[0]);

        for (i = 0; i < dataContact.length; i++) {
            if (dataContact[i]['client_id'] == clientId.value) {
                optionContact[i + 1] = document.createElement('option');
                optionContact[i + 1].appendChild(document.createTextNode(dataContact[i][
                    'name'
                ]));
                if (inputContact.value == dataContact[i]['name']) {
                    optionContact[i + 1].setAttribute('selected', 'selected');
                }
                optionContact[i + 1].setAttribute('value', dataContact[i]['id']);
                contactId.appendChild(optionContact[i + 1]);
            }
        }
    } else {
        while (contactId.hasChildNodes()) {
            contactId.removeChild(contactId.firstChild);
        }
        optionContact[0] = document.createElement('option');
        optionContact[0].appendChild(document.createTextNode(['Pilih Kontak']));
        contactId.appendChild(optionContact[0]);

        for (i = 0; i < dataContact.length; i++) {
            if (dataContact[i]['client_id'] == clientId.value) {
                optionContact[i + 1] = document.createElement('option');
                optionContact[i + 1].appendChild(document.createTextNode(dataContact[i][
                    'name'
                ]));
                optionContact[i + 1].setAttribute('value', dataContact[i]['id']);
                contactId.appendChild(optionContact[i + 1]);
            }
        }
    }
}

// Get Contact --> start
function getContact(sel) {
    for (i = 0; i < dataContact.length; i++) {
        if (dataContact[i]['name'] == sel.options[sel.selectedIndex].text) {
            if (dataContact[i]['gender'] == 'Laki-Laki') {
                clientContact.innerHTML = 'UP. Bapak ' + sel.options[sel.selectedIndex].text;
            } else if (dataContact[i]['gender'] == 'Perempuan') {
                clientContact.innerHTML = 'UP. Ibu ' + sel.options[sel.selectedIndex].text;
            }
            contactEmail.innerHTML = dataContact[i]['email'];
            contactPhone.innerHTML = dataContact[i]['phone'];
            inputEmail.value = contactEmail.innerHTML;
            inputPhone.value = contactPhone.innerHTML;

        }
    }
    inputContact.value = sel.options[sel.selectedIndex].text;
}
// Get Contact --> end

// Show Contact --> end

// Get Object Size --> start
getDataSize()
function getDataSize() {
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
                objSize = JSON.parse(xhrSize.responseText);
                dataSize = objSize.dataSize;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Object Size --> end

// Get Object BillboardPhoto --> start
getDataBillboardPhoto()
function getDataBillboardPhoto() {
    const xhrBillboardPhoto = new XMLHttpRequest();
    const methodBillboardPhoto = "GET";
    const urlBillboardPhoto = "/showBillboardPhoto";

    xhrBillboardPhoto.open(methodBillboardPhoto, urlBillboardPhoto, true);
    xhrBillboardPhoto.send();

    xhrBillboardPhoto.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrBillboardPhoto.readyState === XMLHttpRequest.DONE) {
            const status = xhrBillboardPhoto.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objBillboardPhoto = JSON.parse(xhrBillboardPhoto.responseText);
                dataBillboardPhoto = objBillboardPhoto.dataBillboardPhoto;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Object BillboardPhoto --> end

// Get Object BillboardCategory --> start
getDataBillboardCategory()
function getDataBillboardCategory() {
    const xhrBillboardCategory = new XMLHttpRequest();
    const methodBillboardCategory = "GET";
    const urlBillboardCategory = "/showBillboardCategory";

    xhrBillboardCategory.open(methodBillboardCategory, urlBillboardCategory, true);
    xhrBillboardCategory.send();

    xhrBillboardCategory.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrBillboardCategory.readyState === XMLHttpRequest.DONE) {
            const status = xhrBillboardCategory.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objBillboardCategory = JSON.parse(xhrBillboardCategory.responseText);
                dataBillboardCategory = objBillboardCategory.dataBillboardCategory;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Object BillboardCategory --> end

// Preview --> start
btnPreview.addEventListener('click', function () {
    if (billboardCategoryId.value == 'Pilih Katagori') {
        alert('Anda belum memilih katagori')
    } else if (areaId.value == 'Pilih Area') {
        alert('Anda belum memilih area')
    } else if (clientId.value == 'Pilih Klien') {
        alert('Anda belum memilih klien')
    } else if (contactId.value == 'Pilih Kontak') {
        alert('Anda belum memilih kontak')
    } else if (locations.length == 0) {
        alert('Anda belum memilih lokasi ' + billboardCategory.value)
    } else {
        if (locations.length != 0) {
            while (locationsImage.hasChildNodes()) {
                locationsImage.removeChild(locationsImage.firstChild);
            }
            for (i = 0; i < locations.length; i++) {
                createImageLocations(locations, i);
            }
        } else {
            while (locationsImage.hasChildNodes()) {
                locationsImage.removeChild(locationsImage.firstChild);
            }
        }

        modalPreview.classList.remove('hidden');
        modalPreview.classList.add('flex');
        window.scrollTo(0, 0);
        quotationNumberBBPreview.innerHTML = number.value;
        attachmentBBPreview.innerHTML = attachmentBillboard.textContent;
        attachment.value = "";
        attachment.value = attachmentBBPreview.textContent;
        subjectBBPreview.innerHTML = subjectBillboard.textContent;
        subject.value = "";
        subject.value = subjectBBPreview.textContent;
        clientBBPreview.innerHTML = clientCompany.textContent;
        contactBBPreview.innerHTML = clientContact.textContent;
        contactEmailBBPreview.innerHTML = contactEmail.textContent;
        contactPhoneBBPreview.innerHTML = contactPhone.textContent;
        letterBodyBBPreview.innerHTML = bodyTopBillboard.textContent;
        bodyTop.value = "";
        bodyTop.value = letterBodyBBPreview.textContent;

        while (previewBBTBody.hasChildNodes()) {
            previewBBTBody.removeChild(previewBBTBody.firstChild);
        }

        previewBBthAMonth.innerHTML = oneMonth.value;
        previewBBthQuarterYear.innerHTML = threeMonth.value;
        previewBBthHalfYear.innerHTML = sixMonth.value;
        previewBBthAYear.innerHTML = twelveMonth.value;

        for (iBillboard = 0; iBillboard < locations.length; iBillboard++) {
            newRow[iBillboard] = previewBBTBody.insertRow(iBillboard);
            cell[0] = newRow[iBillboard].insertCell(0);
            cell[0].innerHTML = iBillboard + 1;
            cell[0].classList.add('td-table-preview');
            cell[1] = newRow[iBillboard].insertCell(1);
            cell[1].innerHTML = locations[iBillboard].code;
            cell[1].classList.add('td-table-preview');
            cell[2] = newRow[iBillboard].insertCell(2);
            cell[2].innerHTML = locations[iBillboard].address;
            cell[2].classList.add('text-[0.7rem]');
            cell[2].classList.add('text-teal-700');
            cell[2].classList.add('border');
            cell[3] = newRow[iBillboard].insertCell(3);
            cell[3].innerHTML = "BB";
            cell[3].classList.add('td-table-preview');
            cell[4] = newRow[iBillboard].insertCell(4);
            if (locations[iBillboard].lighting == 'Frontlight') {
                cell[4].innerHTML = 'FL';
            } else if (locations[iBillboard].lighting == 'Backlight') {
                cell[4].innerHTML = 'BL';
            } else if (locations[iBillboard].lighting == 'Nonlight') {
                cell[4].innerHTML = 'NL';
            }
            cell[4].classList.add('td-table-preview');
            cell[5] = newRow[iBillboard].insertCell(5);
            cell[5].innerHTML = locations[iBillboard].size;
            cell[5].classList.add('td-table-preview');
            cell[6] = newRow[iBillboard].insertCell(6);
            if (manual.checked == true) {
                locations[iBillboard].price.periodeMonth.priceMonth = Number(inputPriceMonth[iBillboard].value);
                cell[6].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeMonth.priceMonth)) + ',-';
            } else {
                cell[6].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeMonth.priceMonth)) + ',-';
            }
            cell[6].classList.add('td-table-preview');
            if (aMonth.checked == true) {
                cell[6].removeAttribute('hidden');
            } else {
                cell[6].setAttribute('hidden', 'hidden');
            }
            cell[7] = newRow[iBillboard].insertCell(7);
            if (manual.checked == true) {
                locations[iBillboard].price.periodeQuarter.priceQuarter = Number(inputPriceQuarter[iBillboard].value);
                cell[7].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeQuarter.priceQuarter)) + ',-';
            } else {
                cell[7].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeQuarter.priceQuarter)) + ',-';
            }
            cell[7].classList.add('td-table-preview');
            if (quarterYear.checked == true) {
                cell[7].removeAttribute('hidden');
            } else {
                cell[7].setAttribute('hidden', 'hidden');
            }
            cell[8] = newRow[iBillboard].insertCell(8);
            if (manual.checked == true) {
                locations[iBillboard].price.periodeHalf.priceHalf = Number(inputPriceHalf[iBillboard].value);
                cell[8].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeHalf.priceHalf)) + ',-';
            } else {
                cell[8].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeHalf.priceHalf)) + ',-';
            }
            cell[8].classList.add('td-table-preview');
            if (halfYear.checked == true) {
                cell[8].removeAttribute('hidden');
            } else {
                cell[8].setAttribute('hidden', 'hidden');
            }
            cell[9] = newRow[iBillboard].insertCell(9);
            if (manual.checked == true) {
                locations[iBillboard].price.periodeYear.priceYear = inputPriceYear[iBillboard].value;
                cell[9].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeYear.priceYear)) + ',-';
            } else {
                cell[9].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeYear.priceYear)) + ',-';
            }
            cell[9].classList.add('td-table-preview');
            if (aYear.checked == true) {
                cell[9].removeAttribute('hidden');
            } else {
                cell[9].setAttribute('hidden', 'hidden');
            }
        }
        objBillboards = { locations };
        console.log(objBillboards);
        billboards.value = "";
        billboards.value = JSON.stringify(objBillboards);

        for (i = 0; i < 10; i++) {
            if (i + 1 == 1) {
                inputPreviewBBNote01.value = inputBBNote01.value;
                if (cbBillboardNote01.checked == true) {
                    previewBBNote01.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: inputPreviewBBNote01.value
                    }
                } else {
                    previewBBNote01.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: inputPreviewBBNote01.value
                    }
                }
            } else if (i + 1 == 2) {
                inputPreviewBBNote02.value = inputBBNote02.value;
                if (cbBillboardNote02.checked == true) {
                    previewBBNote02.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: inputPreviewBBNote02.value
                    }
                } else {
                    previewBBNote02.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: inputPreviewBBNote02.value
                    }
                }
            } else if (i + 1 == 3) {
                inputPreviewBBNote03.value = inputBBNote03.value;
                if (cbBillboardNote03.checked == true) {
                    previewBBNote03.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: inputPreviewBBNote03.value
                    }
                } else {
                    previewBBNote03.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: inputPreviewBBNote03.value
                    }
                }
            } else if (i + 1 == 4) {
                inputPreviewBBNote04.value = inputBBNote04.value;
                if (cbBillboardNote04.checked == true) {
                    previewBBNote04.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: inputPreviewBBNote04.value
                    }
                } else {
                    previewBBNote04.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: inputPreviewBBNote04.value
                    }
                }
            } else if (i + 1 == 5) {
                if (cbBillboardNote05.checked == true) {
                    previewBBNote05.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: "Sistem Pembayaran :"
                    }
                } else {
                    previewBBNote05.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "",
                        textNote: "Sistem Pembayaran :"
                    }
                }
            } else if (i + 1 == 6) {
                inputPreviewBBNote06.value = inputBBNote06.value;
                if (cbBillboardNote06.checked == true) {
                    previewBBNote06.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: inputPreviewBBNote06.value
                    }
                } else {
                    previewBBNote06.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: inputPreviewBBNote06.value
                    }
                }
            } else if (i + 1 == 7) {
                inputPreviewBBNote07.value = inputBBNote07.value;
                if (cbBillboardNote07.checked == true) {
                    previewBBNote07.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: inputPreviewBBNote07.value
                    }
                } else {
                    previewBBNote07.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: inputPreviewBBNote07.value
                    }
                }
            } else if (i + 1 == 8) {
                lablePreviewBBNote08.innerHTML = inputBBNote08.value;
                if (cbBillboardNote08.checked == true) {
                    previewBBTArea.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: lablePreviewBBNote08.textContent
                    }
                } else {
                    previewBBTArea.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: lablePreviewBBNote08.textContent
                    }
                }
            } else if (i + 1 == 9) {
                inputPreviewBBNote09.value = inputBBNote09.value;
                if (cbBillboardNote09.checked == true) {
                    previewBBNote09.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: inputPreviewBBNote09.value
                    }
                } else {
                    previewBBNote09.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: inputPreviewBBNote09.value
                    }
                }
            } else if (i + 1 == 10) {
                inputPreviewBBNote10.value = inputBBNote10.value;
                if (cbBillboardNote10.checked == true) {
                    previewBBNote10.removeAttribute('hidden');
                    notes[i] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: inputPreviewBBNote10.value
                    }
                } else {
                    previewBBNote10.setAttribute('hidden', 'hidden');
                    notes[i] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: inputPreviewBBNote10.value
                    }
                }
            }
        }
        objNote = { notes };
        note.value = "";
        note.value = JSON.stringify(objNote);
    }
    bodyEnd.value = "Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih";
})

// Preview --> end

// Add Billboard Location --> start
btnAdd.addEventListener('click', function () {
    while (locationTBody.hasChildNodes()) {
        locationTBody.removeChild(locationTBody.firstChild);
    }

    let orientation = "";
    let row = 0;
    tHead4.innerHTML = "";
    tHead5.innerHTML = "";

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    window.scrollTo(0, 0);
    tHead4.innerHTML = "Jenis";
    tHead5.innerHTML = "BL/FL";
    if (locations.length == 0) {
        for (iBillboard = 0; iBillboard < dataLocation.length; iBillboard++) {
            if (cityId.value == 'Pilih Kota') {
                newRow[row] = locationTBody.insertRow(row);
                cell[0] = newRow[row].insertCell(0);
                cell[0].innerHTML = row + 1;
                cell[0].classList.add('td-table');
                cell[1] = newRow[row].insertCell(1);
                for (iCity = 0; iCity < dataCity.length; iCity++) {
                    if (dataLocation[iBillboard].city == dataCity[iCity].id) {
                        var cityCode = dataCity[iCity].code;
                    }
                }
                cell[1].innerHTML = dataLocation[iBillboard].code + ' - ' + cityCode;
                cell[1].classList.add('td-table');
                cell[2] = newRow[row].insertCell(2);
                cell[2].innerHTML = dataLocation[iBillboard].address;
                cell[2].classList.add('text-sm');
                cell[2].classList.add('text-teal-700');
                cell[2].classList.add('border');
                cell[3] = newRow[row].insertCell(3);
                for (i = 0; i < dataBillboardCategory.length; i++) {
                    if (dataLocation[iBillboard].category == dataBillboardCategory[i].id) {
                        if (dataBillboardCategory[i].name == 'Billboard') {
                            cell[3].innerHTML = "BB";
                        } else if (dataBillboardCategory[i].name == 'Bando') {
                            cell[3].innerHTML = "BD";
                        } else if (dataBillboardCategory[i].name == 'Baliho') {
                            cell[3].innerHTML = "BLH";
                        } else if (dataBillboardCategory[i].name == 'Midiboard') {
                            cell[3].innerHTML = "MB";
                        }
                    }
                }
                cell[3].classList.add('td-table');
                cell[4] = newRow[row].insertCell(4);
                if (dataLocation[iBillboard].lighting == 'Frontlight') {
                    cell[4].innerHTML = "FL";
                } else if (dataLocation[iBillboard].lighting == 'Backlight') {
                    cell[4].innerHTML = "BL";
                }
                cell[4].classList.add('td-table');
                //show Size --> start
                cell[5] = newRow[row].insertCell(5);
                for (iSize = 0; iSize < objSize.dataSize.length; iSize++) {
                    if (dataLocation[iBillboard].size == objSize.dataSize[iSize].id) {
                        orientation = objSize.dataSize[iSize].orientation;
                        if (orientation == "Vertikal") {
                            cell[5].innerHTML = objSize.dataSize[iSize].size + " - V";
                        } else if (orientation == "Horizontal") {
                            cell[5].innerHTML = objSize.dataSize[iSize].size + " - H";
                        }
                    }
                }
                cell[5].classList.add('td-table');
                cell[6] = newRow[row].insertCell(6);
                cell[6].innerHTML = Intl.NumberFormat('en-US').format(dataLocation[iBillboard]
                    .price);
                cell[6].classList.add('td-table');
                cell[7] = newRow[row].insertCell(7);
                cell[7].classList.add('td-table');
                checkbox[row] = document.createElement('input');
                checkbox[row].setAttribute('type', 'checkbox');
                checkbox[row].setAttribute('value', dataLocation[iBillboard].code);
                checkbox[row].setAttribute('onclick', 'checkboxClick()');
                cell[7].appendChild(checkbox[row]);
                // show Size --> end
                row++;
            } else {
                newRow[row] = locationTBody.insertRow(row);
                cell[0] = newRow[row].insertCell(0);
                cell[0].innerHTML = row + 1;
                cell[0].classList.add('td-table');
                cell[1] = newRow[row].insertCell(1);
                for (iCity = 0; iCity < dataCity.length; iCity++) {
                    if (dataLocation[iBillboard].city == dataCity[iCity].id) {
                        var cityCode = dataCity[iCity].code;
                    }
                }
                cell[1].innerHTML = dataLocation[iBillboard].code + ' - ' + cityCode;
                cell[1].classList.add('td-table');
                cell[2] = newRow[row].insertCell(2);
                cell[2].innerHTML = dataLocation[iBillboard].address;
                cell[2].classList.add('text-sm');
                cell[2].classList.add('text-teal-700');
                cell[2].classList.add('border');
                cell[3] = newRow[row].insertCell(3);
                for (i = 0; i < dataBillboardCategory.length; i++) {
                    if (dataLocation[iBillboard].category == dataBillboardCategory[i].id) {
                        if (dataBillboardCategory[i].name == 'Billboard') {
                            cell[3].innerHTML = "BB";
                        } else if (dataBillboardCategory[i].name == 'Bando') {
                            cell[3].innerHTML = "BD";
                        } else if (dataBillboardCategory[i].name == 'Baliho') {
                            cell[3].innerHTML = "BLH";
                        } else if (dataBillboardCategory[i].name == 'Midiboard') {
                            cell[3].innerHTML = "MB";
                        }
                    }
                }
                cell[3].classList.add('td-table');
                cell[4] = newRow[row].insertCell(4);
                if (dataLocation[iBillboard].lighting == 'Frontlight') {
                    cell[4].innerHTML = "FL";
                } else if (dataLocation[iBillboard].lighting == 'Backlight') {
                    cell[4].innerHTML = "BL";
                }
                cell[4].classList.add('td-table');
                //show Size --> start
                cell[5] = newRow[row].insertCell(5);
                for (iSize = 0; iSize < objSize.dataSize.length; iSize++) {
                    if (dataLocation[iBillboard].size == objSize.dataSize[iSize].id) {
                        orientation = objSize.dataSize[iSize].orientation;
                        if (orientation == "Vertikal") {
                            cell[5].innerHTML = objSize.dataSize[iSize].size + " - V";
                        } else if (orientation == "Horizontal") {
                            cell[5].innerHTML = objSize.dataSize[iSize].size + " - H";
                        }
                    }
                }
                cell[5].classList.add('td-table');
                cell[6] = newRow[row].insertCell(6);
                cell[6].innerHTML = Intl.NumberFormat('en-US').format(dataLocation[iBillboard]
                    .price);
                cell[6].classList.add('td-table');
                cell[7] = newRow[row].insertCell(7);
                cell[7].classList.add('td-table');
                checkbox[row] = document.createElement('input');
                checkbox[row].setAttribute('type', 'checkbox');
                checkbox[row].setAttribute('value', dataLocation[iBillboard].code);
                checkbox[row].setAttribute('onclick', 'checkboxClick()');
                cell[7].appendChild(checkbox[row]);
                // show Size --> end
                row++;
            }
        }
    } else {
        console.log(dataLocation.length);
        for (iBillboard = 0; iBillboard < dataLocation.length; iBillboard++) {
            if (cityId.value == 'Pilih Kota') {
                newRow[row] = locationTBody.insertRow(row);
                cell[0] = newRow[row].insertCell(0);
                cell[0].innerHTML = iBillboard + 1;
                cell[0].classList.add('td-table');
                cell[1] = newRow[row].insertCell(1);
                for (iCity = 0; iCity < dataCity.length; iCity++) {
                    if (dataLocation[iBillboard].city == dataCity[iCity].id) {
                        var cityCode = dataCity[iCity].code;
                    }
                }
                cell[1].innerHTML = dataLocation[iBillboard].code + ' - ' + cityCode;
                cell[1].classList.add('td-table');
                cell[2] = newRow[row].insertCell(2);
                cell[2].innerHTML = dataLocation[iBillboard].address;
                cell[2].classList.add('text-xs');
                cell[2].classList.add('text-teal-700');
                cell[2].classList.add('border');
                cell[3] = newRow[row].insertCell(3);
                for (i = 0; i < dataBillboardCategory.length; i++) {
                    if (dataLocation[iBillboard].category == dataBillboardCategory[i].id) {
                        if (dataBillboardCategory[i].name == 'Billboard') {
                            cell[3].innerHTML = "BB";
                        } else if (dataBillboardCategory[i].name == 'Bando') {
                            cell[3].innerHTML = "BD";
                        } else if (dataBillboardCategory[i].name == 'Baliho') {
                            cell[3].innerHTML = "BLH";
                        } else if (dataBillboardCategory[i].name == 'Midiboard') {
                            cell[3].innerHTML = "MB";
                        }
                    }
                }
                cell[3].classList.add('td-table');
                cell[4] = newRow[row].insertCell(4);
                if (dataLocation[iBillboard].lighting == 'Frontlight') {
                    cell[4].innerHTML = "FL";
                } else if (dataLocation[iBillboard].lighting == 'Backlight') {
                    cell[4].innerHTML = "BL";
                }
                cell[4].classList.add('td-table');
                //show Size --> start
                cell[5] = newRow[row].insertCell(5);
                for (iSize = 0; iSize < objSize.dataSize.length; iSize++) {
                    if (dataLocation[iBillboard].size == objSize.dataSize[iSize].id) {
                        orientation = objSize.dataSize[iSize].orientation;
                        if (orientation == "Vertikal") {
                            cell[5].innerHTML = objSize.dataSize[iSize].size + " - V";
                        } else if (orientation == "Horizontal") {
                            cell[5].innerHTML = objSize.dataSize[iSize].size + " - H";
                        }
                    }
                }
                cell[5].classList.add('td-table');
                cell[6] = newRow[row].insertCell(6);
                cell[6].innerHTML = Intl.NumberFormat('en-US').format(dataLocation[iBillboard]
                    .price);
                cell[6].classList.add('td-table');
                cell[7] = newRow[row].insertCell(7);
                cell[7].classList.add('td-table');
                checkbox[row] = document.createElement('input');
                checkbox[row].setAttribute('type', 'checkbox');
                checkbox[row].setAttribute('value', dataLocation[iBillboard].code);
                checkbox[row].setAttribute('onclick', 'checkboxClick()');
                for (i = 0; i < locations.length; i++) {
                    if (locations[i].code == dataLocation[iBillboard].code) {
                        checkbox[row].checked = true;
                    }
                }
                cell[7].appendChild(checkbox[row]);
                // show Size --> end
                row++;
            } else {
                newRow[row] = locationTBody.insertRow(row);
                cell[0] = newRow[row].insertCell(0);
                cell[0].innerHTML = iBillboard + 1;
                cell[0].classList.add('td-table');
                cell[1] = newRow[row].insertCell(1);
                for (iCity = 0; iCity < dataCity.length; iCity++) {
                    if (dataLocation[iBillboard].city == dataCity[iCity].id) {
                        var cityCode = dataCity[iCity].code;
                    }
                }
                cell[1].innerHTML = dataLocation[iBillboard].code + ' - ' + cityCode;
                cell[1].classList.add('td-table');
                cell[2] = newRow[row].insertCell(2);
                cell[2].innerHTML = dataLocation[iBillboard].address;
                cell[2].classList.add('text-xs');
                cell[2].classList.add('text-teal-700');
                cell[2].classList.add('border');
                cell[3] = newRow[row].insertCell(3);
                for (i = 0; i < dataBillboardCategory.length; i++) {
                    if (dataLocation[iBillboard].category == dataBillboardCategory[i].id) {
                        if (dataBillboardCategory[i].name == 'Billboard') {
                            cell[3].innerHTML = "BB";
                        } else if (dataBillboardCategory[i].name == 'Bando') {
                            cell[3].innerHTML = "BD";
                        } else if (dataBillboardCategory[i].name == 'Baliho') {
                            cell[3].innerHTML = "BLH";
                        } else if (dataBillboardCategory[i].name == 'Midiboard') {
                            cell[3].innerHTML = "MB";
                        }
                    }
                }
                cell[3].classList.add('td-table');
                cell[4] = newRow[row].insertCell(4);
                if (dataLocation[iBillboard].lighting == 'Frontlight') {
                    cell[4].innerHTML = "FL";
                } else if (dataLocation[iBillboard].lighting == 'Backlight') {
                    cell[4].innerHTML = "BL";
                }
                cell[4].classList.add('td-table');
                //show Size --> start
                cell[5] = newRow[row].insertCell(5);
                for (iSize = 0; iSize < objSize.dataSize.length; iSize++) {
                    if (dataLocation[iBillboard].size == objSize.dataSize[iSize].id) {
                        orientation = objSize.dataSize[iSize].orientation;
                        if (orientation == "Vertikal") {
                            cell[5].innerHTML = objSize.dataSize[iSize].size + " - V";
                        } else if (orientation == "Horizontal") {
                            cell[5].innerHTML = objSize.dataSize[iSize].size + " - H";
                        }
                    }
                }
                cell[5].classList.add('td-table');
                cell[6] = newRow[row].insertCell(6);
                cell[6].innerHTML = Intl.NumberFormat('en-US').format(dataLocation[iBillboard]
                    .price);
                cell[6].classList.add('td-table');
                cell[7] = newRow[row].insertCell(7);
                cell[7].classList.add('td-table');
                checkbox[row] = document.createElement('input');
                checkbox[row].setAttribute('type', 'checkbox');
                checkbox[row].setAttribute('value', dataLocation[iBillboard].code);
                checkbox[row].setAttribute('onclick', 'checkboxClick()');
                for (i = 0; i < locations.length; i++) {
                    if (locations[i].code == dataLocation[iBillboard].code) {
                        checkbox[row].checked = true;
                    }
                }
                cell[7].appendChild(checkbox[row]);
                // show Size --> end
                row++;
            }
        }
    }

    if (locations.length != 0) {
        if (locations.length < 5) {
            for (iBillboard = 0; iBillboard < dataLocation.length; iBillboard++) {
                checkbox[iBillboard].removeAttribute('disabled');
            }
        } else {
            for (iBillboard = 0; iBillboard < dataLocation.length; iBillboard++) {
                if (checkbox[iBillboard].checked == false) {
                    checkbox[iBillboard].setAttribute('disabled', 'disabled');
                }
            }
        }
    }
});

getSelected.addEventListener('click', function () {
    let i = 0;
    locations = [];
    let locationPrice = [];

    for (iBillboard = 0; iBillboard < dataLocation.length; iBillboard++) {
        if (checkbox[iBillboard].checked == true) {
            for (iCity = 0; iCity < dataCity.length; iCity++) {
                if (dataLocation[iBillboard].city == dataCity[iCity].id) {
                    var cityCode = dataCity[iCity].code;
                }
            }

            for (iSize = 0; iSize < dataSize.length; iSize++) {
                if (dataLocation[iBillboard].size == dataSize[iSize].id) {
                    var getSize = dataSize[iSize].size;
                    var getOrientation = dataSize[iSize].orientation;
                }
            }

            for (iBillboardPhoto = 0; iBillboardPhoto < dataBillboardPhoto.length; iBillboardPhoto++) {
                if (dataLocation[iBillboard].code == dataBillboardPhoto[iBillboardPhoto].billboard_code && dataBillboardPhoto[iBillboardPhoto].company_id == '1') {
                    var getBillboardPhoto = dataBillboardPhoto[iBillboardPhoto].photo;
                }
            }

            for (iBillboardCategory = 0; iBillboardCategory < dataBillboardCategory.length; iBillboardCategory++) {
                if (dataLocation[iBillboard].category == dataBillboardCategory[iBillboardCategory].id) {
                    var getBillboardCategory = dataBillboardCategory[iBillboardCategory].name;
                }
            }
            locations[i] = {
                id: dataLocation[iBillboard].id,
                area: dataLocation[iBillboard].area_id,
                city: cityCode,
                code: dataLocation[iBillboard].code,
                address: dataLocation[iBillboard].address,
                category: getBillboardCategory,
                lighting: dataLocation[iBillboard].lighting,
                lat: dataLocation[iBillboard].lat,
                lng: dataLocation[iBillboard].lng,
                road: dataLocation[iBillboard].road,
                distance: dataLocation[iBillboard].distance,
                speed: dataLocation[iBillboard].speed,
                sector: dataLocation[iBillboard].sector,
                size: getSize,
                photo: getBillboardPhoto,
                orientation: getOrientation,
                price: {
                    periodeMonth: {
                        cbPeriode: aMonth.checked,
                        periode: oneMonth.value,
                        priceMonth: Number(dataLocation[iBillboard].price) * 0.1
                    },
                    periodeQuarter: {
                        cbPeriode: quarterYear.checked,
                        periode: threeMonth.value,
                        priceQuarter: Number(dataLocation[iBillboard].price) * 0.275
                    },
                    periodeHalf: {
                        cbPeriode: halfYear.checked,
                        periode: sixMonth.value,
                        priceHalf: Number(dataLocation[iBillboard].price) * 0.525
                    },
                    periodeYear: {
                        cbPeriode: aYear.checked,
                        periode: twelveMonth.value,
                        priceYear: Number(dataLocation[iBillboard].price)
                    }
                }
            };
            i++;
        }
    }

    modal.classList.remove('flex');
    modal.classList.add('hidden');

    // fillTable();

    while (billboardsTBody.hasChildNodes()) {
        billboardsTBody.removeChild(billboardsTBody.firstChild);
    }

    for (iBillboard = 0; iBillboard < locations.length; iBillboard++) {
        newRow[iBillboard] = billboardsTBody.insertRow(iBillboard);
        cell[0] = newRow[iBillboard].insertCell(0);
        cell[0].innerHTML = iBillboard + 1;
        cell[0].classList.add('td-table');
        cell[1] = newRow[iBillboard].insertCell(1);
        cell[1].innerHTML = locations[iBillboard].code;
        cell[1].classList.add('td-table');
        cell[2] = newRow[iBillboard].insertCell(2);
        cell[2].innerHTML = locations[iBillboard].address;
        cell[2].classList.add('text-xs');
        cell[2].classList.add('text-teal-700');
        cell[2].classList.add('border');
        cell[3] = newRow[iBillboard].insertCell(3);
        cell[3].innerHTML = "BB";
        cell[3].classList.add('td-table');
        cell[4] = newRow[iBillboard].insertCell(4);
        if (locations[iBillboard].lighting == 'Frontlight') {
            cell[4].innerHTML = 'FL';
        } else if (locations[iBillboard].lighting == 'Backlight') {
            cell[4].innerHTML = 'BL';
        } else if (locations[iBillboard].lighting == 'Nonlight') {
            cell[4].innerHTML = 'NL';
        }
        cell[4].classList.add('td-table');
        cell[5] = newRow[iBillboard].insertCell(5);
        cell[5].innerHTML = locations[iBillboard].size;
        cell[5].classList.add('td-table');
        cell[6] = newRow[iBillboard].insertCell(6);
        if (manual.checked == true) {
            inputPriceMonth[iBillboard] = document.createElement('input');
            inputPriceMonth[iBillboard].classList.add('input-price');
            inputPriceMonth[iBillboard].setAttribute('placeholder', 'Input Harga');
            cell[6].appendChild(inputPriceMonth[iBillboard]);
        } else {
            cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeMonth.priceMonth));
        }

        if (aMonth.checked == true) {
            cell[6].removeAttribute('hidden');
        } else {
            cell[6].setAttribute('hidden', 'hidden');
        }

        cell[6].classList.add('td-table');
        cell[7] = newRow[iBillboard].insertCell(7);
        if (manual.checked == true) {
            inputPriceQuarter[iBillboard] = document.createElement('input');
            inputPriceQuarter[iBillboard].classList.add('input-price');
            inputPriceQuarter[iBillboard].setAttribute('placeholder', 'Input Harga');
            cell[7].appendChild(inputPriceQuarter[iBillboard]);
        } else {
            cell[7].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeQuarter.priceQuarter))
        }
        cell[7].classList.add('td-table');
        if (quarterYear.checked == true) {
            cell[7].removeAttribute('hidden');
        } else {
            cell[7].setAttribute('hidden', 'hidden');
        }
        cell[8] = newRow[iBillboard].insertCell(8);
        if (manual.checked == true) {
            inputPriceHalf[iBillboard] = document.createElement('input');
            inputPriceHalf[iBillboard].classList.add('input-price');
            inputPriceHalf[iBillboard].setAttribute('placeholder', 'Input Harga');
            cell[8].appendChild(inputPriceHalf[iBillboard]);
        } else {
            cell[8].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeHalf.priceHalf))
        }
        cell[8].classList.add('td-table');
        if (halfYear.checked == true) {
            cell[8].removeAttribute('hidden');
        } else {
            cell[8].setAttribute('hidden', 'hidden');
        }
        cell[9] = newRow[iBillboard].insertCell(9);
        if (manual.checked == true) {
            inputPriceYear[iBillboard] = document.createElement('input');
            inputPriceYear[iBillboard].classList.add('input-price');
            inputPriceYear[iBillboard].setAttribute('placeholder', 'Input Harga');
            cell[9].appendChild(inputPriceYear[iBillboard]);
        } else {
            cell[9].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[iBillboard].price.periodeYear.priceYear))
        }

        cell[9].classList.add('td-table');
        if (aYear.checked == true) {
            cell[9].removeAttribute('hidden');
        } else {
            cell[9].setAttribute('hidden', 'hidden');
        }
    }
})

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    var isi = r;
    billboardTable.deleteRow(i);
    console.log(isi);
    console.log(locations);
    for (iBillboard = 0; iBillboard < locations.length; iBillboard++) {
        if (locations[iBillboard].code == isi.value) {
            locations.splice(iBillboard, 1)
        }
    }
}

btnCLose.addEventListener('click', function () {
    modal.classList.remove('flex');
    modal.classList.add('hidden');
});

btnClosePreview.addEventListener('click', function () {
    modalPreview.classList.remove('flex');
    modalPreview.classList.add('hidden');
});

// Add Billboard Location --> end

// Search locations --> start
function searchTable() {
    var filter, tr, td1, td2, i, txtValue1, txtValue2;
    filter = search.value.toUpperCase();
    tr = locationsTable.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("td")[1];
        td2 = tr[i].getElementsByTagName("td")[2];
        if (td1 || td2) {
            txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
// Search locations --> end

// Price Periode --> start

// Fill Price Periode --> start
auto.addEventListener('click', function () {
    if (auto.checked == true) {
        oneMonth.setAttribute('readonly', 'readonly');
        threeMonth.setAttribute('readonly', 'readonly');
        sixMonth.setAttribute('readonly', 'readonly');
        twelveMonth.setAttribute('readonly', 'readonly');
        oneMonth.value = "1 Bulan";
        threeMonth.value = "3 Bulan";
        sixMonth.value = "6 Bulan";
        twelveMonth.value = "1 Tahun";
        thAMonth.innerHTML = "";
        thAMonth.innerHTML = "1 Bulan";
        thQuarterYear.innerHTML = "";
        thQuarterYear.innerHTML = "3 Bulan";
        thHalfYear.innerHTML = "";
        thHalfYear.innerHTML = "6 Bulan";
        thAYear.innerHTML = "";
        thAYear.innerHTML = "1 Tahun";
        priceType.value = auto.value;
    }

    if (locations.length != 0) {
        for (i = 0; i < locations.length; i++) {
            billboardsTBody.rows[i].cells[6].removeChild(billboardsTBody.rows[i].cells[6].firstChild);
            billboardsTBody.rows[i].cells[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeMonth.priceMonth));
            billboardsTBody.rows[i].cells[7].removeChild(billboardsTBody.rows[i].cells[7].firstChild);
            billboardsTBody.rows[i].cells[7].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeQuarter.priceQuarter));
            billboardsTBody.rows[i].cells[8].removeChild(billboardsTBody.rows[i].cells[8].firstChild);
            billboardsTBody.rows[i].cells[8].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeHalf.priceHalf));
            billboardsTBody.rows[i].cells[9].removeChild(billboardsTBody.rows[i].cells[9].firstChild);
            billboardsTBody.rows[i].cells[9].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeYear.priceYear));
        }
    }
})

manual.addEventListener('click', function () {
    if (manual.checked == true) {
        if (aMonth.checked == true) {
            oneMonth.removeAttribute('readonly');
        }
        if (quarterYear.checked == true) {
            threeMonth.removeAttribute('readonly');
        }
        if (halfYear.checked == true) {
            sixMonth.removeAttribute('readonly');
        }
        if (aYear.checked == true) {
            twelveMonth.removeAttribute('readonly');
        }
        priceType.value = manual.value;
    }

    if (locations.length != 0) {
        for (i = 0; i < locations.length; i++) {
            billboardsTBody.rows[i].cells[6].removeChild(billboardsTBody.rows[i].cells[6].firstChild);
            inputPriceMonth[i] = document.createElement('input');
            inputPriceMonth[i].classList.add('input-price');
            inputPriceMonth[i].setAttribute('placeholder', 'Input Harga');
            billboardsTBody.rows[i].cells[6].appendChild(inputPriceMonth[i]);

            billboardsTBody.rows[i].cells[7].removeChild(billboardsTBody.rows[i].cells[7].firstChild);
            inputPriceQuarter[i] = document.createElement('input');
            inputPriceQuarter[i].classList.add('input-price');
            inputPriceQuarter[i].setAttribute('placeholder', 'Input Harga');
            billboardsTBody.rows[i].cells[7].appendChild(inputPriceQuarter[i]);

            billboardsTBody.rows[i].cells[8].removeChild(billboardsTBody.rows[i].cells[8].firstChild);
            inputPriceHalf[i] = document.createElement('input');
            inputPriceHalf[i].classList.add('input-price');
            inputPriceHalf[i].setAttribute('placeholder', 'Input Harga');
            billboardsTBody.rows[i].cells[8].appendChild(inputPriceHalf[i]);

            billboardsTBody.rows[i].cells[9].removeChild(billboardsTBody.rows[i].cells[9].firstChild);
            inputPriceYear[i] = document.createElement('input');
            inputPriceYear[i].classList.add('input-price');
            inputPriceYear[i].setAttribute('placeholder', 'Input Harga');
            billboardsTBody.rows[i].cells[9].appendChild(inputPriceYear[i]);
        }
    }
})

// Fill Price Periode --> start

//oneMonth event -- start
oneMonth.addEventListener('change', function () {
    thAMonth.innerHTML = "";
    thAMonth.innerHTML = oneMonth.value;
})
//oneMonth event -- start

//threeMonth event -- start
threeMonth.addEventListener('change', function () {
    thQuarterYear.innerHTML = "";
    thQuarterYear.innerHTML = threeMonth.value;
})
//threeMonth event -- start

//sixMonth event -- start
sixMonth.addEventListener('change', function () {
    thHalfYear.innerHTML = "";
    thHalfYear.innerHTML = sixMonth.value;
})
//sixMonth event -- start

//twelveMonth event -- start
twelveMonth.addEventListener('change', function () {
    thAYear.innerHTML = "";
    thAYear.innerHTML = twelveMonth.value;
})
//twelveMonth event -- start

// aMonth event --> start
aMonth.addEventListener('click', function () {
    priceColumn = 0;
    if (aMonth.checked == true) {
        if (manual.checked == true) {
            oneMonth.removeAttribute('readonly');
        }
        thAMonth.removeAttribute('hidden');
        previewBBthAMonth.removeAttribute('hidden');
        if (locations.length != 0) {
            for (i = 0; i < locations.length; i++) {
                billboardsTBody.rows[i].cells[6].removeAttribute('hidden');
                locations[i].price.periodeMonth.cbPeriode = true;
            }
        }
    } else {
        oneMonth.setAttribute('readonly', 'readonly');
        oneMonth.value = "1 Bulan";
        thAMonth.innerHTML = "";
        thAMonth.innerHTML = "1 Bulan";
        thAMonth.setAttribute('hidden', 'hidden');
        previewBBthAMonth.setAttribute('hidden', 'hidden');
        if (locations.length != 0) {
            for (i = 0; i < locations.length; i++) {
                billboardsTBody.rows[i].cells[6].setAttribute('hidden', 'hidden');
                locations[i].price.periodeMonth.cbPeriode = false;
            }
        }
    }
    if (aMonth.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (quarterYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (halfYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (aYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (priceColumn == 1 || priceColumn == 2) {
        tableWidth.classList.add('w-[650px]');
        tableWidth.classList.remove('w-[700px]');
    } else {
        tableWidth.classList.add('w-[700px]');
        tableWidth.classList.remove('w-[650px]');
    }
})
// aMonth event --> end

// quarter year event --> start
quarterYear.addEventListener('click', function () {
    priceColumn = 0;
    if (quarterYear.checked == true) {
        if (manual.checked == true) {
            threeMonth.removeAttribute('readonly');
        }
        thQuarterYear.removeAttribute('hidden');
        previewBBthQuarterYear.removeAttribute('hidden');
        if (locations.length != 0) {
            for (i = 0; i < locations.length; i++) {
                billboardsTBody.rows[i].cells[7].removeAttribute('hidden');
                locations[i].price.periodeQuarter.cbPeriode = true;
            }
        }
    } else {
        threeMonth.setAttribute('readonly', 'readonly');
        threeMonth.value = "3 Bulan";
        thQuarterYear.innerHTML = "";
        thQuarterYear.innerHTML = "3 Bulan";
        thQuarterYear.setAttribute('hidden', 'hidden');
        previewBBthQuarterYear.setAttribute('hidden', 'hidden');
        if (locations.length != 0) {
            for (i = 0; i < locations.length; i++) {
                billboardsTBody.rows[i].cells[7].setAttribute('hidden', 'hidden');
                locations[i].price.periodeQuarter.cbPeriode = false;
            }
        }
    }
    if (aMonth.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (quarterYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (halfYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (aYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (priceColumn == 1 || priceColumn == 2) {
        tableWidth.classList.add('w-[650px]');
        tableWidth.classList.remove('w-[700px]');
    } else {
        tableWidth.classList.add('w-[700px]');
        tableWidth.classList.remove('w-[650px]');
    }
})
// quarter year event --> end

// half year event --> start
halfYear.addEventListener('click', function () {
    priceColumn = 0;
    if (halfYear.checked == true) {
        if (manual.checked == true) {
            sixMonth.removeAttribute('readonly');
        }
        thHalfYear.removeAttribute('hidden');
        previewBBthHalfYear.removeAttribute('hidden');
        if (locations.length != 0) {
            for (i = 0; i < locations.length; i++) {
                billboardsTBody.rows[i].cells[8].removeAttribute('hidden');
                locations[i].price.periodeHalf.cbPeriode = true;
            }
        }
    } else {
        sixMonth.setAttribute('readonly', 'readonly');
        sixMonth.value = "6 Bulan";
        thHalfYear.innerHTML = "";
        thHalfYear.innerHTML = "6 Bulan";
        thHalfYear.setAttribute('hidden', 'hidden');
        previewBBthHalfYear.setAttribute('hidden', 'hidden');
        if (locations.length != 0) {
            for (i = 0; i < locations.length; i++) {
                billboardsTBody.rows[i].cells[8].setAttribute('hidden', 'hidden');
                locations[i].price.periodeHalf.cbPeriode = false;
            }
        }
    }
    if (aMonth.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (quarterYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (halfYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (aYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (priceColumn == 1 || priceColumn == 2) {
        tableWidth.classList.add('w-[650px]');
        tableWidth.classList.remove('w-[700px]');
    } else {
        tableWidth.classList.add('w-[700px]');
        tableWidth.classList.remove('w-[650px]');
    }
})
// half year event --> end

// a year event --> start
aYear.addEventListener('click', function () {
    priceColumn = 0;
    if (aYear.checked == true) {
        if (manual.checked == true) {
            twelveMonth.removeAttribute('readonly');
        }
        thAYear.removeAttribute('hidden');
        previewBBthAYear.removeAttribute('hidden');
        if (locations.length != 0) {
            for (i = 0; i < locations.length; i++) {
                billboardsTBody.rows[i].cells[9].removeAttribute('hidden');
                locations[i].price.periodeYear.cbPeriode = true;
            }
        }
    } else {
        twelveMonth.setAttribute('readonly', 'readonly');
        twelveMonth.value = "1 Tahun";
        thAYear.innerHTML = "";
        thAYear.innerHTML = "1 Tahun";
        thAYear.setAttribute('hidden', 'hidden');
        previewBBthAYear.setAttribute('hidden', 'hidden');
        if (locations.length != 0) {
            for (i = 0; i < locations.length; i++) {
                billboardsTBody.rows[i].cells[9].setAttribute('hidden', 'hidden');
                locations[i].price.periodeYear.cbPeriode = false;
            }
        }
    }
    if (aMonth.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (quarterYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (halfYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (aYear.checked == true) {
        priceColumn = priceColumn + 1;
    }
    if (priceColumn == 1 || priceColumn == 2) {
        tableWidth.classList.add('w-[650px]');
        tableWidth.classList.remove('w-[700px]');
    } else {
        tableWidth.classList.add('w-[700px]');
        tableWidth.classList.remove('w-[650px]');
    }
})
// a year event --> end

// Price Periode --> end

function checkboxClick() {
    let cbChecked = 0;
    cbChecked = 0;
    for (iBillboard = 0; iBillboard < dataLocation.length; iBillboard++) {
        if (checkbox[iBillboard].checked == true) {
            cbChecked++;
        }
    }
    if (cbChecked < 5) {
        for (iBillboard = 0; iBillboard < dataLocation.length; iBillboard++) {
            checkbox[iBillboard].removeAttribute('disabled');
        }
    } else {
        for (iBillboard = 0; iBillboard < dataLocation.length; iBillboard++) {
            if (checkbox[iBillboard].checked == false) {
                checkbox[iBillboard].setAttribute('disabled', 'disabled');
            }
        }
    }
}

// document.getElementById("btnSavePrint").onclick = function () {
//     // formCreate.submit();
//     var element = document.getElementById('pdfPreview');
//     var opt = {
//         margin: 0,
//         filename: 'test.pdf',
//         image: {
//             type: 'jpeg',
//             quality: 1
//         },
//         pagebreak: {
//             mode: ['avoid-all', 'css', 'legacy']
//         },
//         html2canvas: {
//             dpi: 192,
//             scale: 4,
//             letterRendering: true,
//             useCORS: true
//         },
//         jsPDF: {
//             unit: 'in',
//             format: 'a4',
//             orientation: 'portrait',
//             putTotalPages: true
//         }
//     };
//     // html2pdf(element, opt);
//     html2pdf().set(opt).from(element).save();
// };

function createImageLocations(locations, i) {
    var bgElement = document.createElement("div");

    var header = document.createElement("div");
    var logo = document.createElement("div");
    var imgLogo = document.createElement("img");
    var lineHeader = document.createElement("div");
    var lineHeaderImg = document.createElement("img");

    var body = document.createElement("div");
    var mainTitle = document.createElement("div");
    var title = document.createElement("div");
    var codeNumber = document.createElement("span");
    var codeCity = document.createElement("span");
    var codeLine = document.createElement("img");
    var addressPreview = document.createElement("span");

    var mainImage = document.createElement("div");
    var imageFrame = document.createElement("div");
    var imagePreview = document.createElement("img");

    var bodyBottom = document.createElement("div");
    var mainBottom = document.createElement("div");
    var mainMap = document.createElement("div");
    var mapTitle = document.createElement("div");
    var mapPreview = document.createElement("div");
    var imageMap = document.createElement("img");

    var mainDescription = document.createElement("div");
    var descriptionTitle = document.createElement("div");
    var description = document.createElement("div");
    var descriptionType = document.createElement("div");
    var typeName = document.createElement("span");
    var typeValue = document.createElement("span");
    var descriptionSize = document.createElement("div");
    var sizeName = document.createElement("span");
    var sizeValue = document.createElement("span");
    var descriptionOrientation = document.createElement("div");
    var orientationName = document.createElement("span");
    var orientationValue = document.createElement("span");
    var descriptionLighting = document.createElement("div");
    var lightingName = document.createElement("span");
    var lightingValue = document.createElement("span");
    var areaTitle = document.createElement("div");
    var areaInformation = document.createElement("div");
    var road = document.createElement("div");
    var roadName = document.createElement("span");
    var roadValue = document.createElement("span");
    var distance = document.createElement("div");
    var distanceName = document.createElement("span");
    var distanceValue = document.createElement("span");
    var speed = document.createElement("div");
    var speedName = document.createElement("span");
    var speedValue = document.createElement("span");
    var areal = document.createElement("div");
    var arealName = document.createElement("span");
    var qrCodeDisplay = document.createElement("div");
    var qrCodeMapDisplay = document.createElement("div");
    var arealValue = document.createElement("span");
    var sector = document.createElement("div");
    var sectors = document.createElement("div");
    var sectorsValue = [];

    var footer = document.createElement("div");
    var footerLine = document.createElement("div");
    var footerLineImg = document.createElement("img");
    var footerCompany = document.createElement("div");
    var company = document.createElement("span");
    var footerAddress = document.createElement("div");
    var address = document.createElement("span");
    var footerPhone = document.createElement("div");
    var phone = document.createElement("span");
    var footerEmail = document.createElement("div");
    var email = document.createElement("span");


    // Main element --> start
    bgElement.classList.add("w-[780px]");
    bgElement.classList.add("h-[1100px]");
    bgElement.classList.add("bg-white");
    locationsImage.appendChild(bgElement);
    // Main element --> end

    // Header element --> start
    header.classList.add("h-24");
    header.classList.add("mt-2");
    bgElement.appendChild(header);

    logo.classList.add("flex");
    logo.classList.add("w-full");
    logo.classList.add("justify-center");
    logo.classList.add("items-center");
    header.appendChild(logo);

    imgLogo.classList.add("mt-3");
    imgLogo.setAttribute('src', '/img/logo-vm.png');
    logo.appendChild(imgLogo);

    lineHeader.classList.add("flex");
    lineHeader.classList.add("w-full");
    lineHeader.classList.add("justify-center");
    lineHeader.classList.add("items-center");
    lineHeader.classList.add("mt-2");
    header.appendChild(lineHeader);

    lineHeaderImg.setAttribute('src', '/img/line-top.png');
    lineHeader.appendChild(lineHeaderImg);
    // Header element --> end

    // Body title element --> start
    body.classList.add("h-[875px]");
    body.classList.add("mt-6");
    bgElement.appendChild(body);

    mainTitle.classList.add("main-title");

    title.classList.add("title");
    mainTitle.appendChild(title);

    codeNumber.classList.add("code-number");
    codeNumber.innerHTML = locations[i].code;

    codeCity.classList.add("code-city");
    codeCity.innerHTML = "- " + locations[i].city;
    codeLine.classList.add("h-10");
    codeLine.setAttribute('src', '/img/code-line.png');

    addressPreview.classList.add("address-preview");
    addressPreview.innerHTML = locations[i].address;
    title.appendChild(codeNumber);
    title.appendChild(codeCity);
    title.appendChild(codeLine);
    title.appendChild(addressPreview);
    // Body title element --> end

    // Body image element --> start
    mainImage.classList.add("main-image");
    imageFrame.classList.add("image-frame");
    imagePreview.classList.add("image-preview");
    imagePreview.setAttribute('src', '/storage/' + locations[i].photo);
    mainImage.appendChild(imageFrame);
    imageFrame.appendChild(imagePreview);
    // Body image element --> end

    // Body bottom element --> start
    bodyBottom.classList.add("body-bottom");
    mainBottom.classList.add("main-bottom");
    mainMap.classList.add("main-map");
    mapTitle.classList.add("map-title");
    mapTitle.innerHTML = "Google Maps Koordinat : " + Number(locations[i].lat).toFixed(7) + ',  ' + Number(locations[i].lng).toFixed(7);
    mapPreview.classList.add("map-preview");
    mapPreview.classList.add("items-end");
    imageMap.classList.add("image-map");
    imageMap.setAttribute('src', 'https://maps.googleapis.com/maps/api/staticmap?center=' + locations[i].lat + ',' + locations[i].lng + '&zoom=15&size=476x330&maptype=roadmap&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' + locations[i].lat + ',' + locations[i].lng + '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg');
    qrCodeMapDisplay.classList.add("mb-2");
    qrCodeMapDisplay.classList.add("ml-2");
    qrCodeMapDisplay.classList.add("absolute");
    qrCodeMapDisplay.classList.add("w-[100px]")
    new QRCode(qrCodeMapDisplay, 'https://www.google.co.id/maps/place/' + locations[i].lat + ',' + locations[i].lng + '/@' + locations[i].lat + ',' + locations[i].lng + ',15z');
    mapPreview.appendChild(imageMap);
    mapPreview.appendChild(qrCodeMapDisplay);
    mainMap.appendChild(mapTitle);
    mainMap.appendChild(mapPreview);


    mainDescription.classList.add("main-description");
    descriptionTitle.classList.add("description-title");
    descriptionTitle.innerHTML = "Deskripsi Billboard";
    description.classList.add("description");
    descriptionType.classList.add("description-element");
    typeName.classList.add("description-name");
    typeName.innerHTML = "Jenis";
    typeValue.classList.add("description-value");
    typeValue.innerHTML = ': ' + locations[i].category;
    console.log(locations[i].category);
    descriptionSize.classList.add("description-element");
    sizeName.classList.add("description-name");
    sizeName.innerHTML = "Ukuran";
    sizeValue.classList.add("description-value");
    sizeValue.innerHTML = ': ' + locations[i].size;
    descriptionOrientation.classList.add("description-element");
    orientationName.classList.add("description-name");
    orientationName.innerHTML = "Orientasi";
    orientationValue.classList.add("description-value");
    orientationValue.innerHTML = ': ' + locations[i].orientation;
    descriptionLighting.classList.add("description-element");
    lightingName.classList.add("description-name");
    lightingName.innerHTML = "Penerangan";
    lightingValue.classList.add("description-value");
    lightingValue.innerHTML = ': ' + locations[i].lighting;
    areaTitle.classList.add("area-title");
    areaTitle.innerHTML = "Informasi Area";
    areaInformation.classList.add("area-information");
    road.classList.add("area-element");
    roadName.classList.add("area-name");
    roadName.innerHTML = "Type Jalan";
    roadValue.classList.add("area-value");
    roadValue.innerHTML = ': ' + locations[i].road;
    distance.classList.add("area-element");
    distanceName.classList.add("area-name");
    distanceName.innerHTML = "Jarak Pandang";
    distanceValue.classList.add("area-value");
    distanceValue.innerHTML = ': ' + locations[i].distance;
    speed.classList.add("area-element");
    speedName.classList.add("area-name");
    speedName.innerHTML = "Kecepatan";
    speedValue.classList.add("area-value");
    speedValue.innerHTML = ': ' + locations[i].speed;
    areal.classList.add("area-element");
    arealName.classList.add("area-name");
    arealName.innerHTML = "Kawasan";
    qrCodeDisplay.classList.add("mt-10");
    new QRCode(qrCodeDisplay, "https://vistamedia.co.id/preview/" + locations[i].id);
    arealName.appendChild(qrCodeDisplay);
    arealValue.classList.add("area-value");
    const sectorText = locations[i].sector;
    const sectorData = sectorText.split("-");
    for (z = 0; z < sectorData.length; z++) {
        if (sectorData[z] != sectorData[sectorData.length - 1]) {
            sectorsValue[z] = document.createElement("div");
            sectorsValue[z].innerHTML = '- ' + sectorData[z];
            sectors.appendChild(sectorsValue[z]);
        }
    }
    sector.innerHTML = ": ";
    arealValue.appendChild(sector);
    arealValue.appendChild(sectors);

    descriptionType.appendChild(typeName);
    descriptionType.appendChild(typeValue);
    description.appendChild(descriptionType);
    descriptionSize.appendChild(sizeName);
    descriptionSize.appendChild(sizeValue);
    description.appendChild(descriptionSize);
    descriptionOrientation.appendChild(orientationName);
    descriptionOrientation.appendChild(orientationValue);
    description.appendChild(descriptionOrientation);
    descriptionLighting.appendChild(lightingName);
    descriptionLighting.appendChild(lightingValue);
    description.appendChild(descriptionLighting);

    road.appendChild(roadName);
    road.appendChild(roadValue);
    areaInformation.appendChild(road);
    distance.appendChild(distanceName);
    distance.appendChild(distanceValue);
    areaInformation.appendChild(distance);
    speed.appendChild(speedName);
    speed.appendChild(speedValue);
    areaInformation.appendChild(speed);
    areal.appendChild(arealName);
    areal.appendChild(arealValue);
    areaInformation.appendChild(areal);

    mainDescription.appendChild(descriptionTitle);
    mainDescription.appendChild(description);
    mainDescription.appendChild(areaTitle);
    mainDescription.appendChild(areaInformation);


    mainBottom.appendChild(mainMap);
    mainBottom.appendChild(mainDescription);
    bodyBottom.appendChild(mainBottom);
    // Body bottom element --> end

    body.appendChild(mainTitle);
    body.appendChild(mainImage);
    body.appendChild(bodyBottom);

    // Footer element --> start
    footer.classList.add("footer");
    footerLine.classList.add("footer-line");
    footerLineImg.classList.add("footter-line-img");
    footerLineImg.setAttribute('src', '/img/line-bottom.png');
    footerCompany.classList.add("footer-company");
    company.innerHTML = "PT. Vista Media";
    company.classList.add("company");
    footerAddress.classList.add("footer-element");
    address.classList.add("footer-text");
    address.innerHTML = "Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia"
    footerPhone.classList.add("footer-element");
    phone.classList.add("footer-text");
    phone.innerHTML = "Ph. +62 361 230000 | Fax. +62 361 237800";
    footerEmail.classList.add("footer-element");
    email.classList.add("footer-text");
    email.innerHTML = "e-mail : info@vistamedia.co.id | www.vistamedia.co.id";

    footerLine.appendChild(footerLineImg);
    footer.appendChild(footerLine);
    footerCompany.appendChild(company);
    footer.appendChild(footerCompany);
    footerAddress.appendChild(address);
    footer.appendChild(footerAddress);
    footerPhone.appendChild(phone);
    footer.appendChild(footerPhone);
    footerEmail.appendChild(email);
    footer.appendChild(footerEmail);
    bgElement.appendChild(footer);
    // Footer element --> end
}
