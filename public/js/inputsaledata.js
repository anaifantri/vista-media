const number = document.getElementById("number");
const saleCategoryId = document.getElementById("sale_category_id");
const quotationDeal = document.getElementById("quotationDeal");
const quotationNumber = document.getElementById("quotationNumber");
const client = document.getElementById("client");
const clientCompany = document.getElementById("clientCompany");
const clientAddress = document.getElementById("clientAddress");
const clientContact = document.getElementById("clientContact");
const contactPhone = document.getElementById("contactPhone");
const contactEmail = document.getElementById("contactEmail");
const thPeriode = document.getElementById("thPeriode");
const locationTBody = document.getElementById("locationTBody");
const multipleSale = document.getElementById("multipleSale");
const modalApproval = document.getElementById("modalApproval");
const modalPO = document.getElementById("modalPO");
const modalAgreement = document.getElementById("modalAgreement");
const btnApprovalClose = document.getElementById("btnApprovalClose");
const btnPOClose = document.getElementById("btnPOClose");
const btnAgreementClose = document.getElementById("btnAgreementClose");
const documentApproval = document.querySelector('#documentApproval');

const slidesApprovalPreview = document.getElementById("slidesApprovalPreview");
const numberApprovalFile = document.getElementById("numberApprovalFile");
const prevApprovalButton = document.getElementById("prevApprovalButton");
const nextApprovalButton = document.getElementById("nextApprovalButton");
const approvalImg = document.getElementById("approvalImg");

const slidesPOPreview = document.getElementById("slidesPOPreview");
const numberPOFile = document.getElementById("numberPOFile");
const prevPOButton = document.getElementById("prevPOButton");
const nextPOButton = document.getElementById("nextPOButton");
const poImg = document.getElementById("poImg");

const slidesAgreementPreview = document.getElementById("slidesAgreementPreview");
const numberAgreementFile = document.getElementById("numberAgreementFile");
const prevAgreementButton = document.getElementById("prevAgreementButton");
const nextAgreementButton = document.getElementById("nextAgreementButton");
const agreementImg = document.getElementById("agreementImg");

let objQuotation = {};
let objQuotRevision = {};
let objStatus = {};
let objContact = {};
let objClient = {};

let quotationData = [];
let quotRevisionData = [];
let quotStatus = [];
let locationsData = {};
let locations = [];
let dataContact = [];
let dataClient = [];
let newRow = [];
let cell = [];

let approvalImage = [];
let slideApprovalPreview = [];
let slideApprovalImage = [];
let slideApprovalIndex = 0;

let poImage = [];
let slidePOPreview = [];
let slidePOImage = [];
let slidePOIndex = 0;

let agreementImage = [];
let slideAgreementPreview = [];
let slideAgreementImage = [];
let slideAgreementIndex = 0;

// Get Quotation Data --> start
setTimeout(getQuotationData, 100);
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
                objQuotation = JSON.parse(xhrBillboardQuotation.responseText);
                quotationData = objQuotation.dataBillboardQuotation;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Quotation Data --> end

// Get Quote Revision Data --> start
setTimeout(getQuotateRevisionData, 100);
function getQuotateRevisionData() {
    const xhrBillboardQuotRevision = new XMLHttpRequest();
    const methodBillboardQuotRevision = "GET";
    const urlBillboardQuotRevision = "/showBillboardQuotRevision";

    xhrBillboardQuotRevision.open(methodBillboardQuotRevision, urlBillboardQuotRevision, true);
    xhrBillboardQuotRevision.send();

    xhrBillboardQuotRevision.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrBillboardQuotRevision.readyState === XMLHttpRequest.DONE) {
            const status = xhrBillboardQuotRevision.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objQuotRevision = JSON.parse(xhrBillboardQuotRevision.responseText);
                quotRevisionData = objQuotRevision.dataBillboardQuotRevision;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Quote Revision Data --> end

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
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Data Contact --> end

// Get Data Client --> start
getDataClient();
function getDataClient() {
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
                objClient = JSON.parse(xhrClient.responseText);
                dataClient = objClient.dataClient;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Data Client --> end


// Select Category Event --> start
saleCategoryId.addEventListener('change', function () {
    if (saleCategoryId.value != "Pilih Katagori") {
        quotationDeal.classList.remove("hidden");
        quotationDeal.classList.add("flex");
    } else {
        quotationDeal.classList.add("hidden");
        quotationDeal.classList.remove("flex");
    }

    while (poImg.hasChildNodes()) {
        poImg.removeChild(poImg.firstChild);
    }

    while (slidesPOPreview.hasChildNodes()) {
        slidesPOPreview.removeChild(slidesPOPreview.firstChild);
    }

    while (approvalImg.hasChildNodes()) {
        approvalImg.removeChild(approvalImg.firstChild);
    }

    while (slidesApprovalPreview.hasChildNodes()) {
        slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
    }

    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }
})
// Select Category Event --> end

// Select Quotation Deal Event --> start
quotationDeal.addEventListener('change', function () {
    const optionDeal = [];
    while (multipleSale.hasChildNodes()) {
        multipleSale.removeChild(multipleSale.firstChild);
    }

    while (poImg.hasChildNodes()) {
        poImg.removeChild(poImg.firstChild);
    }

    while (slidesPOPreview.hasChildNodes()) {
        slidesPOPreview.removeChild(slidesPOPreview.firstChild);
    }

    while (approvalImg.hasChildNodes()) {
        approvalImg.removeChild(approvalImg.firstChild);
    }

    while (slidesApprovalPreview.hasChildNodes()) {
        slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
    }

    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }

    if (quotationDeal.value.includes('rev') == false) {
        for (i = 0; i < quotationData.length; i++) {
            if (quotationData[i].number == quotationDeal.value) {
                locationsData = JSON.parse(quotationData[i].billboards);
                locations = locationsData.locations;
            }
        }
    } else {
        for (i = 0; i < quotRevisionData.length; i++) {
            if (quotRevisionData[i].number == quotationDeal.value) {
                locationsData = JSON.parse(quotRevisionData[i].billboards);
                locations = locationsData.locations;
            }
        }
    }

    for (i = 0; i < locations.length; i++) {
        createMultipleSale(locations, i);
    }
})
// Select Quotation Deal Event --> end

// Create Multiple Sales --> start
function createMultipleSale(locations, i) {
    var bgElement = document.createElement("div");

    var header = document.createElement("div");
    var logo = document.createElement("div");
    var imgLogo = document.createElement("img");
    var lineHeader = document.createElement("div");
    var lineHeaderImg = document.createElement("img");

    var body = document.createElement("div");
    var bodyTitle = document.createElement("div");
    var labelTitle = document.createElement("label");

    var bodyDetail = document.createElement("div");
    var saleDetail = document.createElement("div");
    var quotationDetail = document.createElement("div");
    var divSale = [];
    var divQuotation = [];
    var labelSale = [];
    var labelQuotation = [];
    var labelSaleColon = [];
    var labelQuotationColon = [];
    var labelSaleValue = [];
    var labelQuotationValue = [];
    var btnPO = [];
    var btnApproval = [];
    var btnAgreement = [];
    var spanButton = [];

    var saleData = document.createElement("div");
    var divTable = document.createElement("div");
    var saleTable = document.createElement("table");
    var saleTHead = document.createElement("thead");
    var saleTBody = document.createElement("tbody");

    var saleNote = document.createElement("div");
    var divSaleNotes = document.createElement("div");
    var divTerms = document.createElement("div");
    var labelTermTitle = document.createElement("label");
    var labelTerms = [];
    var divServices = document.createElement("div");
    var labelServiceTitle = document.createElement("label");
    var labelServices = [];
    var divOtherNotes = document.createElement("div");
    var divNotes = document.createElement("div");
    var labelNoteTitle = document.createElement("label");
    var lineLabel = [];

    var signArea = document.createElement("div");
    var divSign = document.createElement("div");
    var tableSign = document.createElement("table");
    var theadSign = document.createElement("thead");
    var tbodySign = document.createElement("tbody");
    var thTitleSign = document.createElement("th");
    var trSign = [];
    var thSign = [];
    var tdSign = [];

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
    bgElement.classList.add("w-[950px]");
    bgElement.classList.add("h-[1345px]");
    bgElement.classList.add("border");
    bgElement.classList.add("mb-10");
    bgElement.classList.add("bg-white");
    multipleSale.appendChild(bgElement);
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

    // Body element --> start
    // Title element --> start
    body.classList.add("h-[1125px]");

    bodyTitle.classList.add("flex");
    bodyTitle.classList.add("justify-center");
    bodyTitle.classList.add("mt-4");
    labelTitle.classList.add("sale-label-title");
    labelTitle.innerHTML = "DATA PENJUALAN";
    body.appendChild(bodyTitle);
    // Title element --> end

    // Sale detail element --> start
    const date = new Date();
    const year = date.getFullYear();
    let month = "";
    let options = [{ day: 'numeric' }, { month: 'short' }, { year: 'numeric' }];
    let saleDate = getFormatDate(new Date, options, '-');
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

    bodyDetail.classList.add("body-detail");
    saleDetail.classList.add("sale-detail");
    for (j = 0; j < 5; j++) {
        divSale[j] = document.createElement("div");
        divSale[j].classList.add("div-sale");
        labelSale[j] = document.createElement("label");
        labelSale[j].classList.add("label-sale-01");
        labelSaleValue[j] = document.createElement("label");
        labelSaleValue[j].classList.add("label-sale-02");
        labelSaleColon[j] = document.createElement("label");
        labelSaleColon[j].classList.add("label-sale-02");
        labelSaleColon[j].innerHTML = ":";
        if (j == 0) {
            labelSale[j].innerHTML = "No. Penjualan";
            divSale[j].appendChild(labelSale[j]);
            if (i == 0) {
                if (number.value < 10) {
                    labelSaleValue[j].innerHTML = "000" + (number.value) + "/APP/PJ/VM/" + month + "-" + year;
                } else if (resultsNumber < 100) {
                    labelSaleValue[j].innerHTML = "00" + (number.value) + "/APP/PJ/VM/" + month + "-" + year;
                } else if (resultsNumber < 1000) {
                    labelSaleValue[j].innerHTML = "0" + (number.value) + "/APP/PJ/VM/" + month + "-" + year;
                } else if (number.valuer >= 1000) {
                    labelSaleValue[j].innerHTML = (number.value) + "/APP/VM/PJ/" + month + "-" + year;
                }
            } else {
                if (number.value < 10) {
                    labelSaleValue[j].innerHTML = "000" + (Number(number.value) + i) + "/APP/PJ/VM/" + month + "-" + year;
                } else if (resultsNumber < 100) {
                    labelSaleValue[j].innerHTML = "00" + (Number(number.value) + i) + "/APP/PJ/VM/" + month + "-" + year;
                } else if (resultsNumber < 1000) {
                    labelSaleValue[j].innerHTML = "0" + (Number(number.value) + i) + "/APP/PJ/VM/" + month + "-" + year;
                } else if (number.valuer >= 1000) {
                    labelSaleValue[j].innerHTML = (Number(number.value) + i) + "/APP/VM/PJ/" + month + "-" + year;
                }
            }
            divSale[j].appendChild(labelSaleColon[j]);
            divSale[j].appendChild(labelSaleValue[j]);
        } else if (j == 1) {
            labelSale[j].innerHTML = "Tgl. Penjualan";
            labelSaleValue[j].innerHTML = saleDate;
            divSale[j].appendChild(labelSale[j]);
            divSale[j].appendChild(labelSaleColon[j]);
            divSale[j].appendChild(labelSaleValue[j]);
        } else if (j == 2) {
            labelSale[j].innerHTML = "Dok. Approval";
            divSale[j].appendChild(labelSale[j]);
            divSale[j].appendChild(labelSaleColon[j]);
            spanButton[j] = document.createElement("span");
            spanButton[j].classList.add("text-sm");
            spanButton[j].classList.add("mx-2");
            spanButton[j].innerHTML = "Add/View";
            btnApproval[i] = document.createElement("button");
            btnApproval[i].classList.add("btn-sale");
            btnApproval[i].setAttribute('type', 'button');
            btnApproval[i].setAttribute('onclick', 'btnApprovalEvent()');
            btnApproval[i].appendChild(spanButton[j]);
            divSale[j].appendChild(btnApproval[i]);
        } else if (j == 3) {
            labelSale[j].innerHTML = "Dok. PO/SPK";
            divSale[j].appendChild(labelSale[j]);
            divSale[j].appendChild(labelSaleColon[j]);
            spanButton[j] = document.createElement("span");
            spanButton[j].classList.add("text-sm");
            spanButton[j].classList.add("mx-2");
            spanButton[j].innerHTML = "Add/View";
            btnPO[i] = document.createElement("button");
            btnPO[i].classList.add("btn-sale");
            btnPO[i].setAttribute('type', 'button');
            btnPO[i].setAttribute('onclick', 'btnPOEvent()');
            btnPO[i].appendChild(spanButton[j]);
            divSale[j].appendChild(btnPO[i]);
        } else if (j == 4) {
            labelSale[j].innerHTML = "Dok. Agreement";
            divSale[j].appendChild(labelSale[j]);
            divSale[j].appendChild(labelSaleColon[j]);
            spanButton[j] = document.createElement("span");
            spanButton[j].classList.add("text-sm");
            spanButton[j].classList.add("mx-2");
            spanButton[j].innerHTML = "Add/View";
            btnAgreement[i] = document.createElement("button");
            btnAgreement[i].classList.add("btn-sale");
            btnAgreement[i].setAttribute('type', 'button');
            btnAgreement[i].setAttribute('onclick', 'btnAgreementEvent()');
            btnAgreement[i].appendChild(spanButton[j]);
            divSale[j].appendChild(btnAgreement[i]);
        }

        saleDetail.appendChild(divSale[j]);
    }

    for (n = 0; n < 8; n++) {
        divQuotation[n] = document.createElement("div");
        divQuotation[n].classList.add("div-sale");
        labelQuotation[n] = document.createElement("label");
        labelQuotation[n].classList.add("label-sale-01");
        labelQuotationValue[n] = document.createElement("label");
        labelQuotationValue[n].classList.add("label-sale-02");
        labelQuotationColon[n] = document.createElement("label");
        labelQuotationColon[n].classList.add("label-sale-02");
        labelQuotationColon[n].innerHTML = ":";
        if (n == 0) {
            labelQuotation[n].innerHTML = "No. Penawaran";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 1) {
            labelQuotation[n].innerHTML = "Tgl. Penawaran";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 2) {
            labelQuotation[n].innerHTML = "Nama Klien";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 3) {
            labelQuotation[n].innerHTML = "Perusahaan";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 4) {
            labelQuotation[n].innerHTML = "Alamat";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 5) {
            labelQuotation[n].innerHTML = "Kontak Person";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 6) {
            labelQuotation[n].innerHTML = "No. Telp./Hp.";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 7) {
            labelQuotation[n].innerHTML = "Email";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            divQuotation[n].appendChild(labelQuotationValue[n]);
        }

        quotationDetail.appendChild(divQuotation[n]);
    }
    quotationDetail.classList.add("sale-detail");
    quotationDetail.classList.add("ml-4");
    bodyDetail.appendChild(saleDetail);
    bodyDetail.appendChild(quotationDetail);

    bodyTitle.appendChild(labelTitle);
    body.appendChild(bodyDetail);
    // Sale detail element --> end

    // Sale location element --> start
    saleTable.classList.add("table-auto");
    saleTable.classList.add("mt-2");
    saleTable.classList.add("w-[790px]");
    newRow[0] = saleTHead.insertRow(0);
    cell[0] = newRow[0].insertCell(0);
    cell[0].innerHTML = "No.";
    cell[0].classList.add('th-table');
    cell[0].classList.add('w-8');
    cell[0].setAttribute('rowspan', '2');
    cell[1] = newRow[0].insertCell(1);
    cell[1].innerHTML = "Kode";
    cell[1].classList.add('th-table');
    cell[1].classList.add('w-20');
    cell[1].setAttribute('rowspan', '2');
    cell[2] = newRow[0].insertCell(2);
    cell[2].innerHTML = "Lokasi";
    cell[2].classList.add('th-table');
    cell[2].setAttribute('rowspan', '2');
    cell[3] = newRow[0].insertCell(3);
    cell[3].innerHTML = "Deskripsi";
    cell[3].classList.add('th-table');
    cell[3].classList.add('w-48');
    cell[3].setAttribute('colspan', '3');
    cell[4] = newRow[0].insertCell(4);
    cell[4].innerHTML = "Harga";
    cell[4].classList.add('th-table');
    cell[4].classList.add('w-28');
    newRow[1] = saleTHead.insertRow(1);
    cell[0] = newRow[1].insertCell(0);
    cell[0].innerHTML = "Jenis";
    cell[0].classList.add('th-table');
    cell[0].classList.add('w-10');
    cell[1] = newRow[1].insertCell(1);
    cell[1].innerHTML = "BL/FL";
    cell[1].classList.add('th-table');
    cell[1].classList.add('w-10');
    cell[2] = newRow[1].insertCell(2);
    cell[2].innerHTML = "Size - V/H";
    cell[2].classList.add('th-table');
    cell[2].classList.add('w-28');
    cell[3] = newRow[1].insertCell(3);
    cell[3].classList.add('th-table');
    cell[3].classList.add('w-28');
    if (locations[i].price.periodeYear.cbPeriode == true) {
        cell[3].innerHTML = locations[i].price.periodeYear.periode;
    }
    if (locations[i].price.periodeHalf.cbPeriode == true) {
        cell[3].innerHTML = locations[i].price.periodeHalf.periode;
    }
    if (locations[i].price.periodeQuarter.cbPeriode == true) {
        cell[3].innerHTML = locations[i].price.periodeQuarter.periode;
    }
    if (locations[i].price.periodeMonth.cbPeriode == true) {
        cell[3].innerHTML = locations[i].price.periodeMonth.periode;
    }

    while (saleTBody.hasChildNodes()) {
        saleTBody.removeChild(saleTBody.firstChild);
    }

    newRow[0] = saleTBody.insertRow(0);
    cell[0] = newRow[0].insertCell(0);
    cell[0].innerHTML = 1;
    cell[0].classList.add('td-table');
    cell[1] = newRow[0].insertCell(1);
    cell[1].innerHTML = locations[i].code;
    cell[1].classList.add('td-table');
    cell[2] = newRow[0].insertCell(2);
    cell[2].innerHTML = locations[i].address;
    cell[2].classList.add('text-xs');
    cell[2].classList.add('text-teal-700');
    cell[2].classList.add('border');
    cell[3] = newRow[0].insertCell(3);
    cell[3].innerHTML = "BB";
    cell[3].classList.add('td-table');
    cell[4] = newRow[0].insertCell(4);
    cell[4].innerHTML = locations[i].lighting;
    cell[4].classList.add('td-table');
    cell[5] = newRow[0].insertCell(5);
    cell[5].innerHTML = locations[i].size;
    cell[5].classList.add('td-table');

    cell[6] = newRow[0].insertCell(6);

    if (locations[i].price.periodeYear.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeYear.priceYear));
        var dpp = Number(locations[i].price.periodeYear.priceYear);
    }
    if (locations[i].price.periodeHalf.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeHalf.priceHalf));
        var dpp = Number(locations[i].price.periodeHalf.priceHalf);
    }
    if (locations[i].price.periodeQuarter.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeQuarter.priceQuarter));
        var dpp = Number(locations[i].price.periodeQuarter.priceQuarter);
    }
    if (locations[i].price.periodeMonth.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeMonth.priceMonth));
        var dpp = Number(locations[i].price.periodeMonth.priceMonth);
    }

    cell[6].classList.add('td-table-sale');

    newRow[1] = saleTBody.insertRow(1);
    cell[0] = newRow[1].insertCell(0);
    cell[0].innerHTML = "DPP";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[1].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp);
    cell[1].classList.add('td-table-sale');

    newRow[2] = saleTBody.insertRow(2);
    cell[0] = newRow[2].insertCell(0);
    cell[0].innerHTML = "PPN 11% (A)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[2].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp * (11 / 100));
    cell[1].classList.add('td-table-sale');

    newRow[3] = saleTBody.insertRow(3);
    cell[0] = newRow[3].insertCell(0);
    cell[0].innerHTML = "PPh 23 2% (B)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[3].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp * (2 / 100));
    cell[1].classList.add('td-table-sale');

    newRow[4] = saleTBody.insertRow(4);
    cell[0] = newRow[4].insertCell(0);
    cell[0].innerHTML = "Grand Total ((Harga + A) - B)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[4].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp + (dpp * (11 / 100)) - (dpp * (2 / 100)));
    cell[1].classList.add('td-table-sale');

    saleTable.appendChild(saleTHead);
    saleTable.appendChild(saleTBody);
    divTable.appendChild(saleTable);
    divTable.classList.add("flex");
    divTable.classList.add("justify-center");
    saleData.classList.add("mt-4");
    saleData.appendChild(divTable);
    body.appendChild(saleData);
    // Sale location element --> end

    // Notes element --> start
    labelTermTitle.classList.add("sale-note-title");
    labelTermTitle.innerHTML = "Termin Pembayaran";
    divTerms.appendChild(labelTermTitle);
    for (a = 0; a < 2; a++) {
        if (a == 0) {
            labelTerms[a] = document.createElement("label");
            labelTerms[a].classList.add("label-sale-notes");
            labelTerms[a].innerHTML = "1. 50 % DP sebelum materi iklan tayang";
            divTerms.appendChild(labelTerms[a]);
        } else if (a == 1) {
            labelTerms[a] = document.createElement("label");
            labelTerms[a].classList.add("label-sale-notes");
            labelTerms[a].innerHTML = "2. 50 % pelunasan setelah BAPP";
            divTerms.appendChild(labelTerms[a]);
        }

    }
    divSaleNotes.appendChild(divTerms);

    labelServiceTitle.classList.add("sale-note-title");
    labelServiceTitle.innerHTML = "Services";
    divServices.appendChild(labelServiceTitle);
    for (a = 0; a < 2; a++) {
        if (a == 0) {
            labelServices[a] = document.createElement("label");
            labelServices[a].classList.add("label-sale-notes");
            labelServices[a].innerHTML = "1. Free biaya cetak 12x";
            divServices.appendChild(labelServices[a]);
        } else if (a == 1) {
            labelServices[a] = document.createElement("label");
            labelServices[a].classList.add("label-sale-notes");
            labelServices[a].innerHTML = "2. Free biaya pemasangan 12x";
            divServices.appendChild(labelServices[a]);
        }

    }
    divServices.classList.add("mt-4");
    divSaleNotes.appendChild(divServices);
    divSaleNotes.classList.add("div-sale-notes");
    divSaleNotes.classList.add("w-[325px]");

    divOtherNotes.classList.add("div-sale-notes");
    divOtherNotes.classList.add("w-[435px]");
    divOtherNotes.classList.add("ml-4");
    divOtherNotes.appendChild(divNotes);
    labelNoteTitle.classList.add("sale-note-title");
    labelNoteTitle.innerHTML = "Keterangan Tambahan :";
    divNotes.appendChild(labelNoteTitle);
    for (a = 0; a < 6; a++) {
        lineLabel[a] = document.createElement("label");
        lineLabel[a].classList.add("line-label");
        divNotes.appendChild(lineLabel[a]);
    }
    saleNote.classList.add("sale-note");

    saleNote.appendChild(divSaleNotes);
    saleNote.appendChild(divOtherNotes);
    body.appendChild(saleNote);
    // Notes element --> start

    // Sign element --> start
    thTitleSign.classList.add("th-title-sign");
    thTitleSign.setAttribute('colspan', '4');
    thTitleSign.innerHTML = "Mengetahui :";
    trSign[0] = document.createElement("tr");
    trSign[0].appendChild(thTitleSign);
    theadSign.appendChild(trSign[0]);
    trSign[1] = document.createElement("tr");
    for (a = 0; a < 4; a++) {
        if (a == 0) {
            thSign[a] = trSign[0] = document.createElement("th");
            thSign[a].classList.add("th-sign");
            thSign[a].innerHTML = "Penjualan dan Pemasaran";
        } else if (a == 1) {
            thSign[a] = trSign[0] = document.createElement("th");
            thSign[a].classList.add("th-sign");
            thSign[a].innerHTML = "Penagihan";
        } else if (a == 2) {
            thSign[a] = trSign[0] = document.createElement("th");
            thSign[a].classList.add("th-sign");
            thSign[a].innerHTML = "Keuangan";
        } else if (a == 3) {
            thSign[a] = trSign[0] = document.createElement("th");
            thSign[a].classList.add("th-sign");
            thSign[a].innerHTML = "Direktur";
        }
        trSign[1].appendChild(thSign[a]);
    }
    theadSign.appendChild(trSign[1]);
    tableSign.appendChild(theadSign);
    trSign[2] = trSign[0] = document.createElement("tr");
    for (a = 0; a < 4; a++) {
        if (a == 0) {
            tdSign[a] = trSign[0] = document.createElement("td");
            tdSign[a].classList.add("td-sign");
            tdSign[a].innerHTML = "Nur Cahyono";
        } else if (a == 1) {
            tdSign[a] = trSign[0] = document.createElement("td");
            tdSign[a].classList.add("td-sign");
            tdSign[a].innerHTML = "Yudhi Pratama";
        } else if (a == 2) {
            tdSign[a] = trSign[0] = document.createElement("td");
            tdSign[a].classList.add("td-sign");
            tdSign[a].innerHTML = "Ayu Putri Lestari";
        } else if (a == 3) {
            tdSign[a] = trSign[0] = document.createElement("td");
            tdSign[a].classList.add("td-sign");
            tdSign[a].innerHTML = "Sandy Kamboy";
        }
        trSign[2].appendChild(tdSign[a]);
    }
    tbodySign.appendChild(trSign[2])
    tableSign.appendChild(tbodySign);
    tableSign.classList.add("table-sign");
    divSign.appendChild(tableSign);
    divSign.classList.add("div-sign")
    signArea.classList.add("sign-area")
    signArea.appendChild(divSign);
    body.appendChild(signArea);
    // Sign element --> end

    // Body Bottom --> start
    var bodyBottom = document.createElement("div");
    var photoLocation = document.createElement("div");
    var qrCodeSale = document.createElement("div");
    var imageLocation = document.createElement("img");
    var qrCodeImage = document.createElement("div");

    imageLocation.classList.add("img-location-sale");
    imageLocation.setAttribute('src', '/storage/' + locations[i].photo);
    photoLocation.classList.add("sale-detail");
    photoLocation.appendChild(imageLocation);
    bodyBottom.classList.add("body-bottom-sale");
    qrCodeSale.classList.add("qr-code-sale");
    qrCodeSale.classList.add("ml-4");
    qrCodeImage.classList.add("qrcode-img-sale");
    new QRCode(qrCodeImage, "https://vistamedia.co.id/preview/");
    qrCodeSale.appendChild(qrCodeImage);
    bodyBottom.appendChild(photoLocation);
    bodyBottom.appendChild(qrCodeSale);
    body.appendChild(bodyBottom);
    // Body Bottom --> end

    bgElement.appendChild(body);

    // Body element --> end


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

    // Fill element --> start
    if (quotationDeal.value.includes('rev') == false) {
        for (i = 0; i < quotationData.length; i++) {
            if (quotationData[i].number == quotationDeal.value) {
                labelQuotationValue[0].innerHTML = "";
                labelQuotationValue[0].innerHTML = quotationData[i].number;
                labelQuotationValue[1].innerHTML = "";
                labelQuotationValue[1].innerHTML = getFormatDate(new Date(quotationData[i].created_at), options, '-');
                for (n = 0; n < dataClient.length; n++) {
                    if (dataClient[n].id == quotationData[i].client_id) {
                        labelQuotationValue[2].innerHTML = "";
                        labelQuotationValue[2].innerHTML = dataClient[n].name;
                        labelQuotationValue[3].innerHTML = "";
                        labelQuotationValue[3].innerHTML = dataClient[n].company;
                        labelQuotationValue[4].innerHTML = "";
                        labelQuotationValue[4].innerHTML = dataClient[n].address;
                        for (j = 0; j < dataContact.length; j++) {
                            if (dataClient[n].id == dataContact[j].client_id) {
                                labelQuotationValue[5].innerHTML = "";
                                labelQuotationValue[5].innerHTML = dataContact[j].name;
                                labelQuotationValue[6].innerHTML = "";
                                labelQuotationValue[6].innerHTML = dataContact[j].phone;
                                labelQuotationValue[7].innerHTML = "";
                                labelQuotationValue[7].innerHTML = dataContact[j].email;
                            }
                        }
                    }
                }
            }
        }
    } else {
        for (i = 0; i < quotRevisionData.length; i++) {
            if (quotRevisionData[i].number == quotationDeal.value) {
                labelQuotationValue[0].innerHTML = "";
                labelQuotationValue[0].innerHTML = quotRevisionData[i].number;
                labelQuotationValue[1].innerHTML = "";
                labelQuotationValue[1].innerHTML = getFormatDate(new Date(quotationData[i].created_at), options, '-');
                for (n = 0; n < dataClient.length; n++) {
                    if (dataClient[n].id == quotationData[i].client_id) {
                        labelQuotationValue[2].innerHTML = "";
                        labelQuotationValue[2].innerHTML = dataClient[n].name;
                        labelQuotationValue[3].innerHTML = "";
                        labelQuotationValue[3].innerHTML = dataClient[n].company;
                        labelQuotationValue[4].innerHTML = "";
                        labelQuotationValue[4].innerHTML = dataClient[n].address;
                        for (j = 0; j < dataContact.length; j++) {
                            if (dataClient[n].id == dataContact[j].client_id) {
                                labelQuotationValue[5].innerHTML = "";
                                labelQuotationValue[5].innerHTML = dataContact[j].name;
                                labelQuotationValue[6].innerHTML = "";
                                labelQuotationValue[6].innerHTML = dataContact[j].phone;
                                labelQuotationValue[7].innerHTML = "";
                                labelQuotationValue[7].innerHTML = dataContact[j].email;
                            }
                        }
                    }
                }
            }
        }
    }
    // Fill element --> end
}
// Create Multiple Sales --> end

//Format date --> start
function getFormatDate(date, options, separator) {
    function format(option) {
        let formatter = new Intl.DateTimeFormat('en', option);
        return formatter.format(date);
    }
    return options.map(format).join(separator);
}
//Format date --> end

// Preview Approval Document --> start
function previewAppovalImage() {
    while (approvalImg.hasChildNodes()) {
        approvalImg.removeChild(approvalImg.firstChild);
    }

    while (slidesApprovalPreview.hasChildNodes()) {
        slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
    }

    if (documentApproval.files.length != 0) {
        numberApprovalFile.innerHTML = "";
        numberApprovalFile.innerHTML = documentApproval.files.length + " images selected";

        for (n = 0; n < documentApproval.files.length; n++) {
            const file = documentApproval.files[n];
            const objectUrl = URL.createObjectURL(file);

            approvalImage[n] = document.createElement("img")
            if (n == 0) {
                approvalImage[n].classList.add("document-approval-active");
            } else {
                approvalImage[n].classList.add("document-approval");
            }

            approvalImage[n].src = objectUrl;
            approvalImage[n].setAttribute('id', n);
            approvalImage[n].setAttribute('onclick', 'myApprovalSlide(this)');
            approvalImg.appendChild(approvalImage[n]);

            slideApprovalPreview[n] = document.createElement("figure");
            slideApprovalPreview[n].classList.add("mySlides");
            slideApprovalPreview[n].classList.add("fade");
            slideApprovalImage[n] = document.createElement("img");
            if (n != 0) {
                slideApprovalImage[n].classList.add("hidden");
            }
            slideApprovalImage[n].classList.add("w-full");
            slideApprovalImage[n].classList.add("mt-2");
            slideApprovalImage[n].src = objectUrl;
            slideApprovalPreview[n].appendChild(slideApprovalImage[n]);
            slidesApprovalPreview.appendChild(slideApprovalPreview[n]);
        }

        prevApprovalButton.removeAttribute('hidden');
        nextApprovalButton.removeAttribute('hidden');
    }

    prevApprovalButton.addEventListener('click', function () {
        if (slideApprovalIndex != 0) {
            slideApprovalImage[slideApprovalIndex].classList.add("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
            approvalImage[slideApprovalIndex].classList.add("document-approval");
            slideApprovalIndex = slideApprovalIndex - 1;
            slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval");
            approvalImage[slideApprovalIndex].classList.add("document-approval-active");
        } else {
            slideApprovalImage[slideApprovalIndex].classList.add("hidden");
            approvalImage[0].classList.remove("document-approval-active");
            approvalImage[0].classList.add("document-approval");
            slideApprovalIndex = documentApproval.files.length - 1;
            slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval");
            approvalImage[slideApprovalIndex].classList.add("document-approval-active");
        }
    })

    nextApprovalButton.addEventListener('click', function () {
        if (slideApprovalIndex != documentApproval.files.length - 1) {
            slideApprovalImage[slideApprovalIndex].classList.add("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
            approvalImage[slideApprovalIndex].classList.add("document-approval");
            slideApprovalIndex = slideApprovalIndex + 1;
            slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval");
            approvalImage[slideApprovalIndex].classList.add("document-approval-active");
        } else {
            slideApprovalImage[slideApprovalIndex].classList.add("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
            approvalImage[slideApprovalIndex].classList.add("document-approval");
            slideApprovalIndex = 0;
            slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval");
            approvalImage[slideApprovalIndex].classList.add("document-approval-active");
        }
    })
}

function myApprovalSlide(img) {
    slideApprovalImage[slideApprovalIndex].classList.add("hidden");
    approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
    approvalImage[slideApprovalIndex].classList.add("document-approval");
    slideApprovalIndex = Number(img.id);
    slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
    approvalImage[slideApprovalIndex].classList.remove("document-approval");
    approvalImage[slideApprovalIndex].classList.add("document-approval-active");
}

// Preview Approval Document --> end

// Preview PO/SPK Document --> start
function previewPOImage() {
    while (poImg.hasChildNodes()) {
        poImg.removeChild(poImg.firstChild);
    }

    while (slidesPOPreview.hasChildNodes()) {
        slidesPOPreview.removeChild(slidesPOPreview.firstChild);
    }

    if (documentPO.files.length != 0) {
        numberPOFile.innerHTML = "";
        numberPOFile.innerHTML = documentPO.files.length + " images selected";

        for (n = 0; n < documentPO.files.length; n++) {
            const file = documentPO.files[n];
            const objectUrl = URL.createObjectURL(file);

            poImage[n] = document.createElement("img")
            if (n == 0) {
                poImage[n].classList.add("document-approval-active");
            } else {
                poImage[n].classList.add("document-approval");
            }

            poImage[n].src = objectUrl;
            poImage[n].setAttribute('id', n);
            poImage[n].setAttribute('onclick', 'myPOSlide(this)');
            poImg.appendChild(poImage[n]);

            slidePOPreview[n] = document.createElement("figure");
            slidePOPreview[n].classList.add("mySlides");
            slidePOPreview[n].classList.add("fade");
            slidePOImage[n] = document.createElement("img");
            if (n != 0) {
                slidePOImage[n].classList.add("hidden");
            }
            slidePOImage[n].classList.add("w-full");
            slidePOImage[n].classList.add("mt-2");
            slidePOImage[n].src = objectUrl;
            slidePOPreview[n].appendChild(slidePOImage[n]);
            slidesPOPreview.appendChild(slidePOPreview[n]);
        }

        prevPOButton.removeAttribute('hidden');
        nextPOButton.removeAttribute('hidden');
    }

    prevPOButton.addEventListener('click', function () {
        if (slidePOIndex != 0) {
            slidePOImage[slidePOIndex].classList.add("hidden");
            poImage[slidePOIndex].classList.remove("document-approval-active");
            poImage[slidePOIndex].classList.add("document-approval");
            slidePOIndex = slidePOIndex - 1;
            slidePOImage[slidePOIndex].classList.remove("hidden");
            poImage[slidePOIndex].classList.remove("document-approval");
            poImage[slidePOIndex].classList.add("document-approval-active");
        } else {
            slidePOImage[slidePOIndex].classList.add("hidden");
            poImage[0].classList.remove("document-approval-active");
            poImage[0].classList.add("document-approval");
            slidePOIndex = documentPO.files.length - 1;
            slidePOImage[slidePOIndex].classList.remove("hidden");
            poImage[slidePOIndex].classList.remove("document-approval");
            poImage[slidePOIndex].classList.add("document-approval-active");
        }
    })

    nextPOButton.addEventListener('click', function () {
        if (slidePOIndex != documentPO.files.length - 1) {
            slidePOImage[slidePOIndex].classList.add("hidden");
            poImage[slidePOIndex].classList.remove("document-approval-active");
            poImage[slidePOIndex].classList.add("document-approval");
            slidePOIndex = slidePOIndex + 1;
            slidePOImage[slidePOIndex].classList.remove("hidden");
            poImage[slidePOIndex].classList.remove("document-approval");
            poImage[slidePOIndex].classList.add("document-approval-active");
        } else {
            slidePOImage[slidePOIndex].classList.add("hidden");
            poImage[slidePOIndex].classList.remove("document-approval-active");
            poImage[slidePOIndex].classList.add("document-approval");
            slidePOIndex = 0;
            slidePOImage[slidePOIndex].classList.remove("hidden");
            poImage[slidePOIndex].classList.remove("document-approval");
            poImage[slidePOIndex].classList.add("document-approval-active");
        }
    })
}

function myPOSlide(img) {
    slidePOImage[slidePOIndex].classList.add("hidden");
    poImage[slidePOIndex].classList.remove("document-approval-active");
    poImage[slidePOIndex].classList.add("document-approval");
    slidePOIndex = Number(img.id);
    slidePOImage[slidePOIndex].classList.remove("hidden");
    poImage[slidePOIndex].classList.remove("document-approval");
    poImage[slidePOIndex].classList.add("document-approval-active");
}

// Preview PO/SPK Document --> end

// Preview Agreement Document --> start
function previewAgreementImage() {
    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }

    if (documentAgreement.files.length != 0) {
        numberAgreementFile.innerHTML = "";
        numberAgreementFile.innerHTML = documentAgreement.files.length + " images selected";

        for (n = 0; n < documentAgreement.files.length; n++) {
            const file = documentAgreement.files[n];
            const objectUrl = URL.createObjectURL(file);

            agreementImage[n] = document.createElement("img")
            if (n == 0) {
                agreementImage[n].classList.add("document-approval-active");
            } else {
                agreementImage[n].classList.add("document-approval");
            }

            agreementImage[n].src = objectUrl;
            agreementImage[n].setAttribute('id', n);
            agreementImage[n].setAttribute('onclick', 'myAgreementSlide(this)');
            agreementImg.appendChild(agreementImage[n]);

            slideAgreementPreview[n] = document.createElement("figure");
            slideAgreementPreview[n].classList.add("mySlides");
            slideAgreementPreview[n].classList.add("fade");
            slideAgreementImage[n] = document.createElement("img");
            if (n != 0) {
                slideAgreementImage[n].classList.add("hidden");
            }
            slideAgreementImage[n].classList.add("w-full");
            slideAgreementImage[n].classList.add("mt-2");
            slideAgreementImage[n].src = objectUrl;
            slideAgreementPreview[n].appendChild(slideAgreementImage[n]);
            slidesAgreementPreview.appendChild(slideAgreementPreview[n]);
        }

        prevAgreementButton.removeAttribute('hidden');
        nextAgreementButton.removeAttribute('hidden');
    }

    prevAgreementButton.addEventListener('click', function () {
        if (slideAgreementIndex != 0) {
            slideAgreementImage[slideAgreementIndex].classList.add("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval-active");
            agreementImage[slideAgreementIndex].classList.add("document-approval");
            slideAgreementIndex = slideAgreementIndex - 1;
            slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval");
            agreementImage[slideAgreementIndex].classList.add("document-approval-active");
        } else {
            slideAgreementImage[slideAgreementIndex].classList.add("hidden");
            agreementImage[0].classList.remove("document-approval-active");
            agreementImage[0].classList.add("document-approval");
            slideAgreementIndex = documentAgreement.files.length - 1;
            slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval");
            agreementImage[slideAgreementIndex].classList.add("document-approval-active");
        }
    })

    nextAgreementButton.addEventListener('click', function () {
        if (slideAgreementIndex != documentAgreement.files.length - 1) {
            slideAgreementImage[slideAgreementIndex].classList.add("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval-active");
            agreementImage[slideAgreementIndex].classList.add("document-approval");
            slideAgreementIndex = slideAgreementIndex + 1;
            slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval");
            agreementImage[slideAgreementIndex].classList.add("document-approval-active");
        } else {
            slideAgreementImage[slideAgreementIndex].classList.add("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval-active");
            agreementImage[slideAgreementIndex].classList.add("document-approval");
            slideAgreementIndex = 0;
            slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval");
            agreementImage[slideAgreementIndex].classList.add("document-approval-active");
        }
    })
}

function myAgreementSlide(img) {
    slideAgreementImage[slideAgreementIndex].classList.add("hidden");
    agreementImage[slideAgreementIndex].classList.remove("document-approval-active");
    agreementImage[slideAgreementIndex].classList.add("document-approval");
    slideAgreementIndex = Number(img.id);
    slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
    agreementImage[slideAgreementIndex].classList.remove("document-approval");
    agreementImage[slideAgreementIndex].classList.add("document-approval-active");
}

// Preview Agreement Document --> end

// Function Button Approval Event --> start
function btnApprovalEvent() {
    modalApproval.classList.remove("hidden");
    modalApproval.classList.add("flex");
    window.scrollTo(0, 0);
}

btnApprovalClose.addEventListener('click', function () {
    modalApproval.classList.add("hidden");
    modalApproval.classList.remove("flex");
})
// Function Button Approval Event --> end

// Function Button PO Event --> start
function btnPOEvent() {
    modalPO.classList.remove("hidden");
    modalPO.classList.add("flex");
    window.scrollTo(0, 0);
}

btnPOClose.addEventListener('click', function () {
    modalPO.classList.add("hidden");
    modalPO.classList.remove("flex");
})
// Function Button PO Event --> end

// Function Button Agreement Event --> start
function btnAgreementEvent() {
    modalAgreement.classList.remove("hidden");
    modalAgreement.classList.add("flex");
    window.scrollTo(0, 0);
}

btnAgreementClose.addEventListener('click', function () {
    modalAgreement.classList.add("hidden");
    modalAgreement.classList.remove("flex");
})
// Function Button Agreement Event --> end