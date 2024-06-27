const btnSave = document.getElementById("btnSave");
const salesValue = document.getElementById("sales_value");
const btnPreview = document.getElementById("btnPreview");
const modalPreview = document.getElementById("modalPreview");
const salesPreview = document.getElementById("salesPreview");
const btnClosePreview = document.getElementById("btnClosePreview");
// const number = document.getElementById("number");
const saleCategoryId = document.getElementById("sale_category_id");
const quotationDeal = document.getElementById("quotationDeal");
const printInstallDeal = document.getElementById("printInstallDeal");
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
const btnCloseApproval = document.getElementById("btnCloseApproval");
const btnPOSubmit = document.getElementById("btnPOSubmit");
const btnPOCancel = document.getElementById("btnPOCancel");
const orderNumber = document.getElementById("order_number");
const orderDate = document.getElementById("order_date");
const documentPO = document.getElementById("documentPO");
const btnAgreementSubmit = document.getElementById("btnAgreementSubmit");
const btnAgreementCancel = document.getElementById("btnAgreementCancel");
const agreementNumber = document.getElementById("agreement_number");
const agreementDate = document.getElementById("agreement_date");
const documentApproval = document.querySelector('#documentApproval');
const documentAgreement = document.getElementById("documentAgreement");

const slidesApprovalPreview = document.getElementById("slidesApprovalPreview");
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
// const startPeriode0 = document.getElementById("startPeriode0");
// const startPeriode1 = document.getElementById("startPeriode1");
// const startPeriode2 = document.getElementById("startPeriode2");
// const startPeriode3 = document.getElementById("startPeriode3");
// const startPeriode4 = document.getElementById("startPeriode4");

var saleNumber = [];
var saleClientId = "";
var saleClientName = "";
var saleClientCompany = "";
var saleClientAddress = "";
var saleContactId = "";
var saleContactName = "";
var saleContactPhone = "";
var saleContactEmail = "";
var SaleCompanyId = "";
var saleBBQuotationId = "";
var saleBBQuotRevisionId = "";
var saleBBQuotNumber = "";
var saleQuotDate = "";
var salePrice = [];
var saleDpp = [];
var saleCategory = "";
var saleDuration = "";
var saleStartAt = [];
var saleEndAt = [];
// let saleTermsPayment = {};
var saleFreePrint = 0;
var saleFreeInstal = 0;
var clientApprovals = "";
var clientOrders = "";
var clientAgreements = "";

var salesApproval = [];
var saleTable = [];
var salePreviewTable = [];
var radioYes = [];
var radioNo = [];
var dpp = [];
var inputDPP = [];
var inputDPPValue = 0;
var startPeriode = [];
var endPeriode = [];

let objQuotation = {};
let objQuotRevision = {};
let objStatus = {};
let objContact = {};
let objClient = {};
let objSales = {};
let objApproval = {};
let objDataSales = {};

let quotationData = [];
let approvalData = [];
let quotRevisionData = [];
let quotStatus = [];
let locationsData = {};
let notesData = {};
let paymentsData = {};
let locations = [];
let notes = [];
let payments = [];
let dataContact = [];
let dataClient = [];
let newRow = [];
let cell = [];
let sales = [];
let salesData = [];

let approvalUrl = [];
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
var divTerms = [];
var labelTerms = [];
var labelTermsNumber = [];
var labelServices = [];
var lineLabel = [];
var trSign = [];
var thSign = [];
var tdSign = [];

const date = new Date();
const year = date.getFullYear();
let month = "";
let options = [{ day: 'numeric' }, { month: 'short' }, { year: 'numeric' }];
let saleDate = getFormatDate(new Date, options, '-');

//Get Document Approval --> start
getSalesData();
function getSalesData() {
    const xhrSales = new XMLHttpRequest();
    const methodSales = "GET";
    const urlSales = "/showSale";

    xhrSales.open(methodSales, urlSales, true);
    xhrSales.send();

    xhrSales.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrSales.readyState === XMLHttpRequest.DONE) {
            const status = xhrSales.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objDataSales = JSON.parse(xhrSales.responseText);
                salesData = objDataSales.dataSale;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
//Get Document Approval --> end

//Get Document Approval --> start
getApprovalData();
function getApprovalData() {
    const xhrDocumentApproval = new XMLHttpRequest();
    const methodDocumentApproval = "GET";
    const urlDocumentApproval = "/showClientApproval";

    xhrDocumentApproval.open(methodDocumentApproval, urlDocumentApproval, true);
    xhrDocumentApproval.send();

    xhrDocumentApproval.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrDocumentApproval.readyState === XMLHttpRequest.DONE) {
            const status = xhrDocumentApproval.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objApproval = JSON.parse(xhrDocumentApproval.responseText);
                approvalData = objApproval.dataClientApproval;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
//Get Document Approval --> end

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
function getSaleCategory(sel) {
    quotationDeal.options[0].selected = 'selected';
    printInstallDeal.options[0].selected = 'selected';
    btnPreview.classList.remove("flex");
    btnPreview.classList.add("hidden");
    if (sel.value == "pilih") {
        quotationDeal.classList.add("hidden");
        quotationDeal.classList.remove("flex");
        printInstallDeal.classList.add("hidden");
        printInstallDeal.classList.remove("flex");
    } else if(sel.options[sel.selectedIndex].text == "Billboard"){
        printInstallDeal.classList.add("hidden");
        printInstallDeal.classList.remove("flex");
        quotationDeal.classList.remove("hidden");
        quotationDeal.classList.add("flex");
    } else if(sel.options[sel.selectedIndex].text == "Print & Instal"){
        quotationDeal.classList.add("hidden");
        quotationDeal.classList.remove("flex");
        printInstallDeal.classList.remove("hidden");
        printInstallDeal.classList.add("flex");
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
    while (multipleSale.hasChildNodes()) {
        multipleSale.removeChild(multipleSale.firstChild);
    }
    saleCategory = "";
    saleCategory = sel.options[sel.selectedIndex].text;
}

// Select Print & Install Quotation Deal Event --> start
// printInstallDeal.addEventListener('change', () => {
//     if(printInstallDeal.value == "pilih"){
//         btnPreview.classList.add("hidden");
//         btnPreview.classList.remove("flex");

//         // Clear multiple sale --> start
//         while (multipleSale.hasChildNodes()) {
//             multipleSale.removeChild(multipleSale.firstChild);
//         }
//         // Clear multiple sale --> end
//     } else {
//         btnPreview.classList.add("flex");
//         btnPreview.classList.remove("hidden");

//         // Clear multiple sale --> start
//         while (multipleSale.hasChildNodes()) {
//             multipleSale.removeChild(multipleSale.firstChild);
//         }
//         // Clear multiple sale --> end

//         printSales();

//     }
// })
// Select Print & Install Quotation Deal Event --> end

// Select Quotation Deal Event --> start
quotationDeal.addEventListener('change', function () {
    // Clear Document PO --> start
    documentPO.value = null;
    while (poImg.hasChildNodes()) {
        poImg.removeChild(poImg.firstChild);
    }

    while (slidesPOPreview.hasChildNodes()) {
        slidesPOPreview.removeChild(slidesPOPreview.firstChild);
    }

    numberPOFile.innerHTML = "No Files Chosen";
    orderDate.value = null;
    orderNumber.value = null;
    // Clear Document PO --> end

    // Clear Document Agreement --> start
    documentAgreement.value = null;
    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }
    numberAgreementFile.innerHTML = "No Files Chosen";
    agreementDate.value = null;
    agreementNumber.value = null;
    // Clear Document Agreement --> end

    // Clear Document Approval --> start
    while (approvalImg.hasChildNodes()) {
        approvalImg.removeChild(approvalImg.firstChild);
    }

    while (slidesApprovalPreview.hasChildNodes()) {
        slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
    }
    // Clear Document Approval --> end

    // Clear multiple sale --> start
    while (multipleSale.hasChildNodes()) {
        multipleSale.removeChild(multipleSale.firstChild);
    }
    // Clear multiple sale --> end

    if(quotationDeal.value == "pilih"){
        btnPreview.classList.add("hidden");
        btnPreview.classList.remove("flex");
    } else {
        btnPreview.classList.add("flex");
        btnPreview.classList.remove("hidden");

         // Check and get quotation data / quotation revision data --> start
    if (quotationDeal.value.includes('rev') == false) {
        for (i = 0; i < quotationData.length; i++) {
            if (quotationData[i].number == quotationDeal.value) {
                locationsData = JSON.parse(quotationData[i].billboards);
                notesData = JSON.parse(quotationData[i].note);
                notes = notesData.notes;
                payments = notes[6];
                locations = locationsData.locations;
                saleClientId = quotationData[i].client_id;
                saleContactId = quotationData[i].contact_id;
                saleBBQuotationId = quotationData[i].id;
                saleBBQuotNumber = quotationData[i].number;
                var a = 0;
                approvalUrl = [];
                for (n = 0; n < approvalData.length; n++) {
                    if (approvalData[n].billboard_quotation_id == quotationData[i].id) {
                        approvalUrl[a] = approvalData[n].approval_image;
                        a = a + 1;
                    }
                }
            }
        }
    } else {
        for (i = 0; i < quotRevisionData.length; i++) {
            if (quotRevisionData[i].number == quotationDeal.value) {
                locationsData = JSON.parse(quotRevisionData[i].billboards);
                notesData = JSON.parse(quotRevisionData[i].note);
                notes = notesData.notes;
                payments = notes[6];
                locations = locationsData.locations;
                saleBBQuotRevisionId = quotRevisionData[i].id;
                saleBBQuotNumber = quotRevisionData[i].number;
                for (j = 0; j < quotationData.length; j++) {
                    if (quotationData[j].id == quotRevisionData[i].billboard_quotation_id) {
                        saleClientId = quotationData[j].client_id;
                        saleContactId = quotationData[j].contact_id;
                    }
                }
                var a = 0;
                approvalUrl = [];
                for (n = 0; n < approvalData.length; n++) {
                    if (approvalData[n].billboard_quot_revision_id == quotRevisionData[i].id) {
                        approvalUrl[a] = approvalData[n].approval_image;
                        a = a + 1;
                    }
                }
            }
        }
    }
    // Check and get quotation data / quotation revision data --> end

    // Create multiple sale view --> start
    for (i = 0; i < locations.length; i++) {
        createMultipleSale(locations, i);
    }
    // Create multiple sale view --> end
    }
})
// Select Quotation Deal Event --> end

function setDPP(sel) {
    console.log(sel.value);
    if (sel.value == "yes") {
        saleTable[Number(sel.name)].tBodies[0].rows[1].cells[1].innerHTML = "";
        if (locations[Number(sel.name)].price.periodeYear.cbPeriode == true) {
            dpp[Number(sel.name)] = Number(locations[Number(sel.name)].price.periodeYear.priceYear);
            saleDpp[Number(sel.name)] = dpp[Number(sel.name)];
        }
        if (locations[Number(sel.name)].price.periodeHalf.cbPeriode == true) {
            dpp[Number(sel.name)] = Number(locations[Number(sel.name)].price.periodeHalf.priceHalf);
            saleDpp[Number(sel.name)] = dpp[Number(sel.name)];
        }
        if (locations[Number(sel.name)].price.periodeQuarter.cbPeriode == true) {
            dpp[Number(sel.name)] = Number(locations[Number(sel.name)].price.periodeQuarter.priceQuarter);
            saleDpp[Number(sel.name)] = dpp[Number(sel.name)];
        }
        if (locations[Number(sel.name)].price.periodeMonth.cbPeriode == true) {
            dpp[Number(sel.name)] = Number(locations[Number(sel.name)].price.periodeMonth.priceMonth);
            saleDpp[Number(sel.name)] = dpp[Number(sel.name)];
        }
        saleTable[Number(sel.name)].tBodies[0].rows[1].cells[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[Number(sel.name)]);
        saleTable[Number(sel.name)].tBodies[0].rows[2].cells[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[Number(sel.name)] * (11 / 100));
        saleTable[Number(sel.name)].tBodies[0].rows[3].cells[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[Number(sel.name)] * (2 / 100));
        saleTable[Number(sel.name)].tBodies[0].rows[4].cells[1].innerHTML = Intl.NumberFormat('en-US').format(salePrice[sel.name] + (dpp[Number(sel.name)] * (11 / 100)) - (dpp[Number(sel.name)] * (2 / 100)));
    } else {
        saleTable[Number(sel.name)].tBodies[0].rows[1].cells[1].innerHTML = "";
        inputDPP[Number(sel.name)] = document.createElement("input");
        inputDPP[Number(sel.name)].classList.add("input-dpp");
        inputDPP[Number(sel.name)].setAttribute('placeholder', 'Input DPP');
        inputDPP[Number(sel.name)].setAttribute('name', Number(sel.name));
        inputDPP[Number(sel.name)].setAttribute('type', 'number');
        inputDPP[Number(sel.name)].setAttribute('min', '0');
        inputDPP[Number(sel.name)].setAttribute('onchange', 'dppKeypress(this)');
        saleTable[Number(sel.name)].tBodies[0].rows[1].cells[1].appendChild(inputDPP[Number(sel.name)]);
    }
}

function dppKeypress(sel) {
    saleTable[Number(sel.name)].tBodies[0].rows[2].cells[1].innerHTML = "";
    dpp[Number(sel.name)] = 0;
    dpp[Number(sel.name)] = Number(inputDPP[Number(sel.name)].value);
    saleDpp[Number(sel.name)] = dpp[Number(sel.name)];
    saleTable[Number(sel.name)].tBodies[0].rows[2].cells[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[Number(sel.name)] * (11 / 100));
    saleTable[Number(sel.name)].tBodies[0].rows[3].cells[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[Number(sel.name)] * (2 / 100));
    saleTable[Number(sel.name)].tBodies[0].rows[4].cells[1].innerHTML = Intl.NumberFormat('en-US').format(salePrice[sel.name] + (dpp[Number(sel.name)] * (11 / 100)) - (dpp[Number(sel.name)] * (2 / 100)));
}

//Letter Header --> start
letterHeader = (bgElement) => {
    var header = document.createElement("div");
    var logo = document.createElement("div");
    var imgLogo = document.createElement("img");
    var lineHeader = document.createElement("div");
    var lineHeaderImg = document.createElement("img");

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
}
//Letter Header --> end

//Location Photo --> start
locationPhoto = (locationPhoto,body) => {
var bodyBottom = document.createElement("div");    
var photoLocation = document.createElement("div");
var qrCodeSale = document.createElement("div");
var imageLocation = document.createElement("img");

imageLocation.classList.add("img-location-sale");
imageLocation.setAttribute('src', '/storage/' + locationPhoto);
photoLocation.classList.add("sale-detail");
photoLocation.appendChild(imageLocation);
bodyBottom.classList.add("body-bottom-sale");
qrCodeSale.classList.add("qr-code-sale");
qrCodeSale.classList.add("ml-4");
bodyBottom.appendChild(photoLocation);
bodyBottom.appendChild(qrCodeSale);
body.appendChild(bodyBottom);
}
//Location Photo --> end

//Body Title --> start
letterBodyTitle = (body, title) => {
    var bodyTitle = document.createElement("div");
    var labelTitle = document.createElement("label");

    bodyTitle.classList.add("flex");
    bodyTitle.classList.add("justify-center");
    bodyTitle.classList.add("mt-4");
    labelTitle.classList.add("sale-label-title");
    labelTitle.innerHTML = title;
    bodyTitle.appendChild(labelTitle);
    body.appendChild(bodyTitle);
}
//Body Title --> end

// Sign element --> start
letterSign = (body) => {
    var signArea = document.createElement("div");
    var divSign = document.createElement("div");
    var tableSign = document.createElement("table");
    var theadSign = document.createElement("thead");
    var tbodySign = document.createElement("tbody");
    var thTitleSign = document.createElement("th");

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
}
// Sign element --> end

//Letter Footer --> start
letterFooter = (bgElement) => {
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
//Letter Footer --> end

// Create Multiple Sales --> start
function createMultipleSale(locations, i) {
    var bgElement = document.createElement("div");
    var body = document.createElement("div");

    var bodyDetail = document.createElement("div");
    var saleDetail = document.createElement("div");
    var quotationDetail = document.createElement("div");

    var saleData = document.createElement("div");
    var divTable = document.createElement("div");
    var saleTHead = document.createElement("thead");
    var saleTBody = document.createElement("tbody");

    var saleNote = document.createElement("div");
    var divSaleNotes = document.createElement("div");
    var termsNote = document.createElement("div");
    var labelTermTitle = document.createElement("label");
    var divServices = document.createElement("div");
    var labelServiceTitle = document.createElement("label");
    var divOtherNotes = document.createElement("div");
    var divNotes = document.createElement("div");
    var labelNoteTitle = document.createElement("label");

    // Main element --> start
    bgElement.classList.add("w-[950px]");
    bgElement.classList.add("h-[1345px]");
    bgElement.classList.add("border");
    bgElement.classList.add("mb-10");
    bgElement.classList.add("bg-white");
    // Main element --> end

    letterHeader(bgElement);

    // Body element --> start
    body.classList.add("h-[1125px]");

    letterBodyTitle(body,"DATA PENJUALAN BILLBOARD")

    bodyDetail.classList.add("body-detail");
    saleDetail.classList.add("sale-detail");
    for (j = 0; j < 8; j++) {
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
            labelSaleValue[j].innerHTML = "";
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
            spanButton[j].innerHTML = "View";
            btnApproval[i] = document.createElement("button");
            btnApproval[i].classList.add("btn-sale");
            btnApproval[i].setAttribute('type', 'button');
            btnApproval[i].setAttribute('onclick', 'previewAppovalImage()');
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
        } else if (j == 5) {
            var titlePeriode = document.createElement("label");
            titlePeriode.classList.add("title-periode");
            titlePeriode.innerHTML = "PERIODE KONTRAK";
            divSale[j].appendChild(titlePeriode);
        } else if (j == 6) {
            labelSale[j].innerHTML = "Awal Kotrak";
            divSale[j].appendChild(labelSale[j]);
            divSale[j].appendChild(labelSaleColon[j]);
            startPeriode[i] = document.createElement("input");
            startPeriode[i].setAttribute('type', 'date');
            startPeriode[i].setAttribute('name', i);
            startPeriode[i].setAttribute('id', 'startPeriode' + i);
            startPeriode[i].setAttribute('onchange', 'setStartAt(this)');
            startPeriode[i].classList.add("date-periode");
            divSale[j].appendChild(startPeriode[i]);
        } else if (j == 7) {
            labelSale[j].innerHTML = "Akhir Kotrak";
            divSale[j].appendChild(labelSale[j]);
            divSale[j].appendChild(labelSaleColon[j]);
            endPeriode[i] = document.createElement("input");
            endPeriode[i].setAttribute('type', 'date');
            endPeriode[i].classList.add("date-periode");
            endPeriode[i].setAttribute('name', i);
            endPeriode[i].setAttribute('onchange', 'setEndAt(this)');
            divSale[j].appendChild(endPeriode[i]);
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
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 1) {
            labelQuotation[n].innerHTML = "Tgl. Penawaran";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 2) {
            labelQuotation[n].innerHTML = "Nama Klien";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 3) {
            labelQuotation[n].innerHTML = "Perusahaan";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 4) {
            labelQuotation[n].innerHTML = "Alamat";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 5) {
            labelQuotation[n].innerHTML = "Kontak Person";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 6) {
            labelQuotation[n].innerHTML = "No. Telp./Hp.";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 7) {
            labelQuotation[n].innerHTML = "Email";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        }

        quotationDetail.appendChild(divQuotation[n]);
    }
    quotationDetail.classList.add("sale-detail");
    quotationDetail.classList.add("ml-4");
    bodyDetail.appendChild(saleDetail);
    bodyDetail.appendChild(quotationDetail);

    body.appendChild(bodyDetail);
    // Sale detail element --> end

    // Sale location element --> start
    saleTable[i] = document.createElement("table");
    saleTable[i].setAttribute('name', 'sale-table-' + i);
    saleTable[i].classList.add("table-auto");
    saleTable[i].classList.add("mt-2");
    saleTable[i].classList.add("w-[780px]");

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
        dpp[i] = Number(locations[i].price.periodeYear.priceYear);
        saleDpp[i] = dpp[i];
        saleDuration = locations[i].price.periodeYear.periode;
        salePrice[i] = Number(locations[i].price.periodeYear.priceYear);
    }
    if (locations[i].price.periodeHalf.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeHalf.priceHalf));
        dpp[i] = Number(locations[i].price.periodeHalf.priceHalf);
        saleDpp[i] = dpp[i];
        saleDuration = locations[i].price.periodeHalf.periode;
        salePrice[i] = Number(locations[i].price.periodeHalf.priceHalf);
    }
    if (locations[i].price.periodeQuarter.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeQuarter.priceQuarter));
        dpp[i] = Number(locations[i].price.periodeQuarter.priceQuarter);
        saleDpp[i] = dpp[i];
        saleDuration = locations[i].price.periodeQuarter.periode;
        salePrice[i] = Number(locations[i].price.periodeQuarter.priceQuarter);
    }
    if (locations[i].price.periodeMonth.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeMonth.priceMonth));
        dpp[i] = Number(locations[i].price.periodeMonth.priceMonth);
        saleDpp[i] = dpp[i];
        saleDuration = locations[i].price.periodeMonth.periode;
        salePrice[i] = Number(locations[i].price.periodeMonth.priceMonth);
    }

    cell[6].classList.add('td-table-sale');

    newRow[1] = saleTBody.insertRow(1);
    cell[0] = newRow[1].insertCell(0);
    cell[0].innerHTML = "Apakah DPP  sama dengan harga ? ";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    var labelYes = document.createElement("label");
    labelYes.innerHTML = "Yes";
    labelYes.classList.add("label-radio");
    var labelNo = document.createElement("label");
    labelNo.innerHTML = "No";
    labelNo.classList.add("label-radio");
    radioYes[i] = document.createElement("input");
    radioYes[i].classList.add("label-radio");
    radioYes[i].setAttribute('type', 'radio');
    radioYes[i].setAttribute('value', 'yes');
    radioYes[i].setAttribute('checked', 'checked');
    radioYes[i].setAttribute('name', i);
    radioYes[i].setAttribute('onclick', 'setDPP(this)');
    radioNo[i] = document.createElement("input");
    radioNo[i].classList.add("label-radio");
    radioNo[i].setAttribute('type', 'radio');
    radioNo[i].setAttribute('value', 'no');
    radioNo[i].setAttribute('name', i);
    radioNo[i].setAttribute('onclick', 'setDPP(this)');
    cell[0].appendChild(radioYes[i]);
    cell[0].appendChild(labelYes);
    cell[0].appendChild(radioNo[i]);
    cell[0].appendChild(labelNo);
    cell[1] = newRow[1].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[i]);
    cell[1].classList.add('td-table-sale');

    newRow[2] = saleTBody.insertRow(2);
    cell[0] = newRow[2].insertCell(0);
    cell[0].innerHTML = "PPN 11% (A)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[2].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[i] * (11 / 100));
    cell[1].classList.add('td-table-sale');

    newRow[3] = saleTBody.insertRow(3);
    cell[0] = newRow[3].insertCell(0);
    cell[0].innerHTML = "PPh 23 2% (B)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[3].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[i] * (2 / 100));
    cell[1].classList.add('td-table-sale');

    newRow[4] = saleTBody.insertRow(4);
    cell[0] = newRow[4].insertCell(0);
    cell[0].innerHTML = "Grand Total ((Harga + A) - B)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[4].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(salePrice[i] + (dpp[i] * (11 / 100)) - (dpp[i] * (2 / 100)));
    cell[1].classList.add('td-table-sale');

    saleTable[i].appendChild(saleTHead);
    saleTable[i].appendChild(saleTBody);
    divTable.appendChild(saleTable[i]);
    divTable.classList.add("flex");
    divTable.classList.add("justify-center");
    saleData.classList.add("mt-4");
    saleData.appendChild(divTable);
    body.appendChild(saleData);
    // Sale location element --> end

    // Notes element --> start
    labelTermTitle.classList.add("sale-note-title");
    labelTermTitle.innerHTML = "Termin Pembayaran";
    termsNote.appendChild(labelTermTitle);
    for (a = 0; a < payments.length; a++) {
        divTerms[a] = document.createElement("div");
        divTerms[a].classList.add("flex");
        labelTermsNumber[a] = document.createElement("label");
        labelTermsNumber[a].classList.add("label-number-notes");
        labelTermsNumber[a].innerHTML = payments[a].termNumber + ".";

        labelTerms[a] = document.createElement("label");
        labelTerms[a].classList.add("label-sale-notes");
        labelTerms[a].innerHTML = payments[a].termValue + "% " + payments[a].termNote;
        divTerms[a].appendChild(labelTermsNumber[a]);
        divTerms[a].appendChild(labelTerms[a]);
        termsNote.appendChild(divTerms[a]);
    }
    divSaleNotes.appendChild(termsNote);

    labelServiceTitle.classList.add("sale-note-title");
    labelServiceTitle.innerHTML = "Services";
    divServices.appendChild(labelServiceTitle);
    for (a = 0; a < 2; a++) {
        if (a == 0) {
            if (notes[2].freeInstal != "") {
                labelServices[a] = document.createElement("label");
                labelServices[a].classList.add("label-sale-notes");
                labelServices[a].innerHTML = "• Free pemasangan " + notes[2].freeInstal + "x";
                divServices.appendChild(labelServices[a]);
                saleFreeInstal = notes[2].freeInstal;
            } else {
                labelServices[a] = document.createElement("label");
                labelServices[a].classList.add("label-sale-notes");
                labelServices[a].innerHTML = "• Tidak ada free pemasangan";
                divServices.appendChild(labelServices[a]);
            }

        } else if (a == 1) {
            if (notes[3].freePrint != "") {
                labelServices[a] = document.createElement("label");
                labelServices[a].classList.add("label-sale-notes");
                labelServices[a].innerHTML = "• Free cetak " + notes[3].freePrint + "x";
                divServices.appendChild(labelServices[a]);
                saleFreePrint = notes[3].freePrint;
            } else {
                labelServices[a] = document.createElement("label");
                labelServices[a].classList.add("label-sale-notes");
                labelServices[a].innerHTML = "• Tidak ada free cetak";
                divServices.appendChild(labelServices[a]);
            }
        }
    }
    divServices.classList.add("mt-4");
    divSaleNotes.appendChild(divServices);
    divSaleNotes.classList.add("div-sale-notes");
    divSaleNotes.classList.add("w-[325px]");

    divOtherNotes.classList.add("div-sale-notes");
    divOtherNotes.classList.add("w-[435px]");
    divOtherNotes.classList.add("ml-5");
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
    letterSign(body);

    locationPhoto(locations[i].photo,body);

    bgElement.appendChild(body);

    // Body element --> end

    letterFooter(bgElement);

    multipleSale.appendChild(bgElement);

    // Fill element --> start
    if (quotationDeal.value.includes('rev') == false) {
        for (a = 0; a < quotationData.length; a++) {
            if (quotationData[a].number == quotationDeal.value) {
                labelQuotationValue[0].innerHTML = "";
                labelQuotationValue[0].innerHTML = quotationData[a].number;
                labelQuotationValue[1].innerHTML = "";
                labelQuotationValue[1].innerHTML = getFormatDate(new Date(quotationData[a].created_at), options, '-');
                saleQuotDate = quotationData[a].created_at;
                for (n = 0; n < dataClient.length; n++) {
                    if (dataClient[n].id == saleClientId) {
                        labelQuotationValue[2].innerHTML = "";
                        labelQuotationValue[2].innerHTML = dataClient[n].name;
                        labelQuotationValue[3].innerHTML = "";
                        labelQuotationValue[3].innerHTML = dataClient[n].company;
                        labelQuotationValue[4].innerHTML = "";
                        labelQuotationValue[4].innerHTML = dataClient[n].address;
                        saleClientName = dataClient[n].name;
                        saleClientCompany = dataClient[n].company;
                        saleClientAddress = dataClient[n].address;
                        for (j = 0; j < dataContact.length; j++) {
                            if (dataContact[j].id == saleContactId) {
                                labelQuotationValue[5].innerHTML = "";
                                labelQuotationValue[5].innerHTML = dataContact[j].name;
                                labelQuotationValue[6].innerHTML = "";
                                labelQuotationValue[6].innerHTML = dataContact[j].phone;
                                labelQuotationValue[7].innerHTML = "";
                                labelQuotationValue[7].innerHTML = dataContact[j].email;
                                saleContactName = dataContact[j].name;
                                saleContactPhone = dataContact[j].phone;
                                saleContactEmail = dataContact[j].email;
                            }
                        }
                    }
                }
            }
        }
    } else {
        for (a = 0; a < quotRevisionData.length; a++) {
            if (quotRevisionData[a].number == quotationDeal.value) {
                labelQuotationValue[0].innerHTML = "";
                labelQuotationValue[0].innerHTML = quotRevisionData[a].number;
                labelQuotationValue[1].innerHTML = "";
                labelQuotationValue[1].innerHTML = getFormatDate(new Date(quotRevisionData[a].created_at), options, '-');
                saleQuotDate = quotRevisionData[a].created_at;
                for (n = 0; n < dataClient.length; n++) {
                    if (dataClient[n].id == saleClientId) {
                        labelQuotationValue[2].innerHTML = "";
                        labelQuotationValue[2].innerHTML = dataClient[n].name;
                        labelQuotationValue[3].innerHTML = "";
                        labelQuotationValue[3].innerHTML = dataClient[n].company;
                        labelQuotationValue[4].innerHTML = "";
                        labelQuotationValue[4].innerHTML = dataClient[n].address;
                        saleClientName = dataClient[n].name;
                        saleClientCompany = dataClient[n].company;
                        saleClientAddress = dataClient[n].address;
                        for (j = 0; j < dataContact.length; j++) {
                            if (dataContact[j].id == saleContactId) {
                                labelQuotationValue[5].innerHTML = "";
                                labelQuotationValue[5].innerHTML = dataContact[j].name;
                                labelQuotationValue[6].innerHTML = "";
                                labelQuotationValue[6].innerHTML = dataContact[j].phone;
                                labelQuotationValue[7].innerHTML = "";
                                labelQuotationValue[7].innerHTML = dataContact[j].email;
                                saleContactName = dataContact[j].name;
                                saleContactPhone = dataContact[j].phone;
                                saleContactEmail = dataContact[j].email;
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
    modalApproval.classList.remove("hidden");
    modalApproval.classList.add("flex");
    window.scrollTo(0, 0);
    slideApprovalIndex = 0;

    while (approvalImg.hasChildNodes()) {
        approvalImg.removeChild(approvalImg.firstChild);
    }

    while (slidesApprovalPreview.hasChildNodes()) {
        slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
    }

    if (approvalUrl.length != 0) {

        for (n = 0; n < approvalUrl.length; n++) {
            // const file = documentApproval.files[n];
            // const objectUrl = URL.createObjectURL(file);

            approvalImage[n] = document.createElement("img")
            if (n == 0) {
                approvalImage[n].classList.add("document-approval-active");
            } else {
                approvalImage[n].classList.add("document-approval");
            }

            approvalImage[n].src = '/storage/' + approvalUrl[n];
            approvalImage[n].setAttribute('id', n);
            approvalImage[n].setAttribute('onclick', 'myApprovalSlide(this)');
            console.log(approvalImage[n]);
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
            slideApprovalImage[n].src = '/storage/' + approvalUrl[n];
            slideApprovalPreview[n].appendChild(slideApprovalImage[n]);
            slidesApprovalPreview.appendChild(slideApprovalPreview[n]);
        }

        prevApprovalButton.removeAttribute('hidden');
        nextApprovalButton.removeAttribute('hidden');
    }
}

prevApprovalButton.addEventListener('click', function () {
    console.log(slideApprovalIndex);
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
        slideApprovalIndex = approvalUrl.length - 1;
        slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
        approvalImage[slideApprovalIndex].classList.remove("document-approval");
        approvalImage[slideApprovalIndex].classList.add("document-approval-active");
    }
})

nextApprovalButton.addEventListener('click', function () {
    console.log(slideApprovalIndex);
    if (slideApprovalIndex != approvalUrl.length - 1) {
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

function myApprovalSlide(img) {
    slideApprovalImage[slideApprovalIndex].classList.add("hidden");
    approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
    approvalImage[slideApprovalIndex].classList.add("document-approval");
    slideApprovalIndex = Number(img.id);
    slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
    approvalImage[slideApprovalIndex].classList.remove("document-approval");
    approvalImage[slideApprovalIndex].classList.add("document-approval-active");
}

btnCloseApproval.addEventListener('click', function () {
    modalApproval.classList.add("hidden");
    modalApproval.classList.remove("flex");
})

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

function myPOSlide(img) {
    slidePOImage[slidePOIndex].classList.add("hidden");
    poImage[slidePOIndex].classList.remove("document-approval-active");
    poImage[slidePOIndex].classList.add("document-approval");
    slidePOIndex = Number(img.id);
    slidePOImage[slidePOIndex].classList.remove("hidden");
    poImage[slidePOIndex].classList.remove("document-approval");
    poImage[slidePOIndex].classList.add("document-approval-active");
}

function btnPOEvent() {
    modalPO.classList.remove("hidden");
    modalPO.classList.add("flex");
    window.scrollTo(0, 0);
}

btnPOSubmit.addEventListener('click', function () {
    if (documentPO.files.length == 0) {
        alert("Dokumen po/spk dipilih")
    } else if (orderNumber.value == "") {
        alert("Nomor po/spk belum di input")
    } else if (orderDate.value == "") {
        alert("Tanggal po/spk belum diinput")
    } else {
        modalPO.classList.add("hidden");
        modalPO.classList.remove("flex");
    }
})

btnPOCancel.addEventListener('click', function () {
    modalPO.classList.add("hidden");
    modalPO.classList.remove("flex");
    documentPO.value = null;
    while (poImg.hasChildNodes()) {
        poImg.removeChild(poImg.firstChild);
    }

    while (slidesPOPreview.hasChildNodes()) {
        slidesPOPreview.removeChild(slidesPOPreview.firstChild);
    }

    numberPOFile.innerHTML = "No Files Chosen";
    orderDate.value = null;
    orderNumber.value = null;
})

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

function myAgreementSlide(img) {
    slideAgreementImage[slideAgreementIndex].classList.add("hidden");
    agreementImage[slideAgreementIndex].classList.remove("document-approval-active");
    agreementImage[slideAgreementIndex].classList.add("document-approval");
    slideAgreementIndex = Number(img.id);
    slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
    agreementImage[slideAgreementIndex].classList.remove("document-approval");
    agreementImage[slideAgreementIndex].classList.add("document-approval-active");
}

function btnAgreementEvent() {
    modalAgreement.classList.remove("hidden");
    modalAgreement.classList.add("flex");
    window.scrollTo(0, 0);
}

btnAgreementSubmit.addEventListener('click', function () {
    if (documentAgreement.files.length == 0) {
        alert("Dokumen perjanjian dipilih")
    } else if (agreementNumber.value == "") {
        alert("Nomor perjanjian belum di input")
    } else if (agreementDate.value == "") {
        alert("Tanggal perjanjian belum diinput")
    } else {
        modalAgreement.classList.add("hidden");
        modalAgreement.classList.remove("flex");
    }
})

btnAgreementCancel.addEventListener('click', function () {
    modalAgreement.classList.add("hidden");
    modalAgreement.classList.remove("flex");
    documentAgreement.value = null;
    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }
    numberAgreementFile.innerHTML = "No Files Chosen";
    agreementDate.value = null;
    agreementNumber.value = null;
})

// Preview Agreement Document --> end

function setStartAt(sel) {
    saleStartAt[Number(sel.name)] = startPeriode[Number(sel.name)].value;
}

function setEndAt(sel) {
    saleEndAt[Number(sel.name)] = endPeriode[Number(sel.name)].value;
}

// Fill sales data --> start
function fillSales() {
    sales = [];
    for (i = 0; i < locations.length; i++) {
        if (startPeriode[i].value) {

        } else {
            saleStartAt[i] = "";
        }

        if (endPeriode[i].value) {

        } else {
            saleEndAt[i] = "";
        }
        paymentsData = { payments };
        sales[i] = {
            number: saleNumber[i],
            date: saleDate,
            company_id: "1",
            client_approvals: clientApprovals,
            client_orders: clientOrders,
            client_agreements: clientAgreements,
            client_id: saleClientId,
            client_name: saleClientName,
            client_company: saleClientCompany,
            client_address: saleClientAddress,
            contact_id: saleContactId,
            contact_name: saleContactName,
            contact_email: saleContactEmail,
            contact_phone: saleContactPhone,
            billboard_id: locations[i].id,
            billboard_code: locations[i].code,
            billboard_address: locations[i].address,
            billboard_size: locations[i].size,
            billboard_category: locations[i].category,
            billboard_lighting: locations[i].lighting,
            billboard_photo: locations[i].photo,
            billboard_orientation: locations[i].orientation,
            billboard_quotation_id: saleBBQuotationId,
            billboard_quot_revision_id: saleBBQuotRevisionId,
            quot_number: saleBBQuotNumber,
            quot_date: saleQuotDate,
            price: salePrice[i],
            dpp: saleDpp[i],
            category: saleCategory,
            duration: saleDuration,
            start_at: saleStartAt[i],
            end_at: saleEndAt[i],
            terms_of_payment: JSON.stringify(paymentsData),
            free_instalation: saleFreeInstal,
            free_print: saleFreePrint,
        };
    }
    objSales = { sales };
    salesValue.value = JSON.stringify(objSales);
}
// Fill sales data --> end

btnPreview.addEventListener('click', function () {
    inputDPPValue = 0;
    for (i = 0; i < locations.length; i++) {
        if (radioNo[i].checked == true) {
            if (inputDPP[i].value == "") {
                inputDPPValue = inputDPPValue + 1;
            }
        }
    }
    if (inputDPPValue != 0) {
        alert("DPP belum di input");
    } else {
        while (salesPreview.hasChildNodes()) {
            salesPreview.removeChild(salesPreview.firstChild);
        }
        modalPreview.classList.remove("hidden");
        modalPreview.classList.add("flex");
        window.scrollTo(0, 0);
        for (i = 0; i < locations.length; i++) {
            createPreviewSale(locations, i);
        }
        fillSales();
    }
})

// Create Preview Sales --> start
function createPreviewSale(locations, i) {
    var bgElement = document.createElement("div");
    var body = document.createElement("div");
    var saleNote = document.createElement("div");

    var bodyDetail = document.createElement("div");
    var saleDetail = document.createElement("div");
    var quotationDetail = document.createElement("div");
    var divPreviewSale = [];
    var divQuotationPreview = [];
    var labelPreviewSale = [];
    var labelPreviewQuotation = [];
    var labelPreviewSaleColon = [];
    var labelPreviewQuotationColon = [];
    var labelPreviewSaleValue = [];
    var labelPreviewQuotationValue = [];

    var saleData = document.createElement("div");
    var divTable = document.createElement("div");
    var saleTHead = document.createElement("thead");
    var saleTBody = document.createElement("tbody");

    // var saleNote = document.createElement("div");
    var divPreviewSaleNotes = document.createElement("div");
    var divPreviewTerms = [];
    var termsNote = document.createElement("div");
    var labelTermTitle = document.createElement("label");
    var labelPreviewTerms = [];
    var labelPreviewTermsNumber = [];
    var divServices = document.createElement("div");
    var labelServiceTitle = document.createElement("label");
    var labelPreviewServices = [];
    var divOtherNotes = document.createElement("div");
    var divNotes = document.createElement("div");
    var labelNoteTitle = document.createElement("label");
    var linePreviewLabel = [];

    // Main element --> start
    bgElement.classList.add("w-[950px]");
    bgElement.classList.add("h-[1345px]");
    bgElement.classList.add("border");
    bgElement.classList.add("mb-10");
    bgElement.classList.add("bg-white");
    // Main element --> end

    // Header element --> start
   letterHeader(bgElement);
    // Header element --> end

    // Body element --> start
    body.classList.add("h-[1125px]");

    letterBodyTitle(body, "DATA PENJUALAN BILLBOARD")

    // Sale detail element --> start
    bodyDetail.classList.add("body-detail");
    saleDetail.classList.add("sale-detail");
    
    for (j = 0; j < 8; j++) {
        divPreviewSale[j] = document.createElement("div");
        divPreviewSale[j].classList.add("div-sale");
        labelPreviewSale[j] = document.createElement("label");
        labelPreviewSale[j].classList.add("label-sale-01");
        labelPreviewSaleValue[j] = document.createElement("label");
        labelPreviewSaleValue[j].classList.add("label-sale-02");
        labelPreviewSaleColon[j] = document.createElement("label");
        labelPreviewSaleColon[j].classList.add("label-sale-02");
        labelPreviewSaleColon[j].innerHTML = ":";
        if (j == 0) {
            console.log(labelSaleValue[j].innerHTML);
            labelPreviewSale[j].innerHTML = "No. Penjualan";
            divPreviewSale[j].appendChild(labelPreviewSale[j]);
            labelPreviewSaleValue[j].innerHTML = "";
            saleNumber[i] = labelPreviewSaleValue[j].innerText;
            divPreviewSale[j].appendChild(labelPreviewSaleColon[j]);
            divPreviewSale[j].appendChild(labelPreviewSaleValue[j]);
        } else if (j == 1) {
            labelPreviewSale[j].innerHTML = "Tgl. Penjualan";
            labelPreviewSaleValue[j].innerHTML = saleDate;
            divPreviewSale[j].appendChild(labelPreviewSale[j]);
            divPreviewSale[j].appendChild(labelPreviewSaleColon[j]);
            divPreviewSale[j].appendChild(labelPreviewSaleValue[j]);
        } else if (j == 2) {
            labelPreviewSale[j].innerHTML = "Dok. Approval";
            divPreviewSale[j].appendChild(labelPreviewSale[j]);
            divPreviewSale[j].appendChild(labelPreviewSaleColon[j]);
            if (approvalUrl.length != 0) {
                labelPreviewSaleValue[j].innerHTML = approvalUrl.length + " images file";
                clientApprovals = approvalUrl.length + " images file";
            } else {
                labelPreviewSaleValue[j].innerHTML = "-";
                clientApprovals = "-";
            }
            divPreviewSale[j].appendChild(labelPreviewSaleValue[j]);
        } else if (j == 3) {
            labelPreviewSale[j].innerHTML = "Dok. PO/SPK";
            divPreviewSale[j].appendChild(labelPreviewSale[j]);
            divPreviewSale[j].appendChild(labelPreviewSaleColon[j]);
            if (documentPO.files.length != 0) {
                labelPreviewSaleValue[j].innerHTML = documentPO.files.length + " images file";
                clientOrders = documentPO.files.length + " images file";
            } else {
                labelPreviewSaleValue[j].innerHTML = "-";
                clientOrders = "-";
            }

            divPreviewSale[j].appendChild(labelPreviewSaleValue[j]);
        } else if (j == 4) {
            labelPreviewSale[j].innerHTML = "Dok. Agreement";
            divPreviewSale[j].appendChild(labelPreviewSale[j]);
            divPreviewSale[j].appendChild(labelPreviewSaleColon[j]);
            if (documentAgreement.files.length != 0) {
                labelPreviewSaleValue[j].innerHTML = documentAgreement.files.length + " images file";
                clientAgreements = documentAgreement.files.length + " images file";
            } else {
                labelPreviewSaleValue[j].innerHTML = "-";
                clientAgreements = "-";
            }

            divPreviewSale[j].appendChild(labelPreviewSaleValue[j]);
        } else if (j == 5) {
            var titlePeriode = document.createElement("label");
            titlePeriode.classList.add("title-periode");
            titlePeriode.innerHTML = "PERIODE KONTRAK";
            divPreviewSale[j].appendChild(titlePeriode);
        } else if (j == 6) {
            labelPreviewSale[j].innerHTML = "Awal Kotrak";
            divPreviewSale[j].appendChild(labelPreviewSale[j]);
            divPreviewSale[j].appendChild(labelPreviewSaleColon[j]);
            if (startPeriode[i].value) {
                labelPreviewSaleValue[j].innerHTML = getFormatDate(new Date(startPeriode[i].value), options, '-');
            } else {
                labelPreviewSaleValue[j].innerHTML = "-";
            }
            divPreviewSale[j].appendChild(labelPreviewSaleValue[j]);
        } else if (j == 7) {
            labelPreviewSale[j].innerHTML = "Akhir Kotrak";
            divPreviewSale[j].appendChild(labelPreviewSale[j]);
            divPreviewSale[j].appendChild(labelPreviewSaleColon[j]);
            if (endPeriode[i].value) {
                labelPreviewSaleValue[j].innerHTML = getFormatDate(new Date(endPeriode[i].value), options, '-');
            } else {
                labelPreviewSaleValue[j].innerHTML = "-";
            }
            divPreviewSale[j].appendChild(labelPreviewSaleValue[j]);
        }

        saleDetail.appendChild(divPreviewSale[j]);
    }

    for (n = 0; n < 8; n++) {
        divQuotationPreview[n] = document.createElement("div");
        divQuotationPreview[n].classList.add("div-sale");
        labelPreviewQuotation[n] = document.createElement("label");
        labelPreviewQuotation[n].classList.add("label-sale-01");
        labelPreviewQuotationValue[n] = document.createElement("label");
        labelPreviewQuotationValue[n].classList.add("label-sale-02");
        labelPreviewQuotationColon[n] = document.createElement("label");
        labelPreviewQuotationColon[n].classList.add("label-sale-02");
        labelPreviewQuotationColon[n].innerHTML = ":";
        if (n == 0) {
            labelPreviewQuotation[n].innerHTML = "No. Penawaran";
            labelPreviewQuotationValue[n].innerHTML = labelQuotationValue[0].innerHTML;
            divQuotationPreview[n].appendChild(labelPreviewQuotation[n]);
            divQuotationPreview[n].appendChild(labelPreviewQuotationColon[n]);
            labelPreviewQuotationValue[n].classList.add("w-60");
            divQuotationPreview[n].appendChild(labelPreviewQuotationValue[n]);
        } else if (n == 1) {
            labelPreviewQuotation[n].innerHTML = "Tgl. Penawaran";
            labelPreviewQuotationValue[n].innerHTML = labelQuotationValue[1].innerHTML;
            divQuotationPreview[n].appendChild(labelPreviewQuotation[n]);
            divQuotationPreview[n].appendChild(labelPreviewQuotationColon[n]);
            labelPreviewQuotationValue[n].classList.add("w-60");
            divQuotationPreview[n].appendChild(labelPreviewQuotationValue[n]);
        } else if (n == 2) {
            labelPreviewQuotation[n].innerHTML = "Nama Klien";
            labelPreviewQuotationValue[n].innerHTML = labelQuotationValue[2].innerHTML;
            divQuotationPreview[n].appendChild(labelPreviewQuotation[n]);
            divQuotationPreview[n].appendChild(labelPreviewQuotationColon[n]);
            labelPreviewQuotationValue[n].classList.add("w-60");
            divQuotationPreview[n].appendChild(labelPreviewQuotationValue[n]);
        } else if (n == 3) {
            labelPreviewQuotation[n].innerHTML = "Perusahaan";
            labelPreviewQuotationValue[n].innerHTML = labelQuotationValue[3].innerHTML;
            divQuotationPreview[n].appendChild(labelPreviewQuotation[n]);
            divQuotationPreview[n].appendChild(labelPreviewQuotationColon[n]);
            labelPreviewQuotationValue[n].classList.add("w-60");
            divQuotationPreview[n].appendChild(labelPreviewQuotationValue[n]);
        } else if (n == 4) {
            labelPreviewQuotation[n].innerHTML = "Alamat";
            labelPreviewQuotationValue[n].innerHTML = labelQuotationValue[4].innerHTML;
            divQuotationPreview[n].appendChild(labelPreviewQuotation[n]);
            divQuotationPreview[n].appendChild(labelPreviewQuotationColon[n]);
            labelPreviewQuotationValue[n].classList.add("w-60");
            divQuotationPreview[n].appendChild(labelPreviewQuotationValue[n]);
        } else if (n == 5) {
            labelPreviewQuotation[n].innerHTML = "Kontak Person";
            labelPreviewQuotationValue[n].innerHTML = labelQuotationValue[5].innerHTML;
            divQuotationPreview[n].appendChild(labelPreviewQuotation[n]);
            divQuotationPreview[n].appendChild(labelPreviewQuotationColon[n]);
            labelPreviewQuotationValue[n].classList.add("w-60");
            divQuotationPreview[n].appendChild(labelPreviewQuotationValue[n]);
        } else if (n == 6) {
            labelPreviewQuotation[n].innerHTML = "No. Telp./Hp.";
            labelPreviewQuotationValue[n].innerHTML = labelQuotationValue[6].innerHTML;
            divQuotationPreview[n].appendChild(labelPreviewQuotation[n]);
            divQuotationPreview[n].appendChild(labelPreviewQuotationColon[n]);
            labelPreviewQuotationValue[n].classList.add("w-60");
            divQuotationPreview[n].appendChild(labelPreviewQuotationValue[n]);
        } else if (n == 7) {
            labelPreviewQuotation[n].innerHTML = "Email";
            labelPreviewQuotationValue[n].innerHTML = labelQuotationValue[7].innerHTML;
            divQuotationPreview[n].appendChild(labelPreviewQuotation[n]);
            divQuotationPreview[n].appendChild(labelPreviewQuotationColon[n]);
            labelPreviewQuotationValue[n].classList.add("w-60");
            divQuotationPreview[n].appendChild(labelPreviewQuotationValue[n]);
        }

        quotationDetail.appendChild(divQuotationPreview[n]);
    }
    quotationDetail.classList.add("sale-detail");
    quotationDetail.classList.add("ml-4");
    bodyDetail.appendChild(saleDetail);
    bodyDetail.appendChild(quotationDetail);

    body.appendChild(bodyDetail);
    // Sale detail element --> end

    // Sale location element --> start
    salePreviewTable[i] = document.createElement("table");
    salePreviewTable[i].setAttribute('name', 'sale-table-' + i);
    salePreviewTable[i].classList.add("table-auto");
    salePreviewTable[i].classList.add("mt-2");
    salePreviewTable[i].classList.add("w-[780px]");

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
    }
    if (locations[i].price.periodeHalf.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeHalf.priceHalf));
    }
    if (locations[i].price.periodeQuarter.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeQuarter.priceQuarter));
    }
    if (locations[i].price.periodeMonth.cbPeriode == true) {
        cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(locations[i].price.periodeMonth.priceMonth));
    }

    cell[6].classList.add('td-table-sale');

    newRow[1] = saleTBody.insertRow(1);
    cell[0] = newRow[1].insertCell(0);
    cell[0].innerHTML = "DPP";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[1].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[i]);
    cell[1].classList.add('td-table-sale');

    newRow[2] = saleTBody.insertRow(2);
    cell[0] = newRow[2].insertCell(0);
    cell[0].innerHTML = "PPN 11% (A)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[2].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[i] * (11 / 100));
    cell[1].classList.add('td-table-sale');

    newRow[3] = saleTBody.insertRow(3);
    cell[0] = newRow[3].insertCell(0);
    cell[0].innerHTML = "PPh 23 2% (B)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[3].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(dpp[i] * (2 / 100));
    cell[1].classList.add('td-table-sale');

    newRow[4] = saleTBody.insertRow(4);
    cell[0] = newRow[4].insertCell(0);
    cell[0].innerHTML = "Grand Total ((Harga + A) - B)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '6');
    cell[1] = newRow[4].insertCell(1);
    cell[1].innerHTML = Intl.NumberFormat('en-US').format(salePrice[i] + (dpp[i] * (11 / 100)) - (dpp[i] * (2 / 100)));
    cell[1].classList.add('td-table-sale');

    salePreviewTable[i].appendChild(saleTHead);
    salePreviewTable[i].appendChild(saleTBody);
    divTable.appendChild(salePreviewTable[i]);
    divTable.classList.add("flex");
    divTable.classList.add("justify-center");
    saleData.classList.add("mt-4");
    saleData.appendChild(divTable);
    body.appendChild(saleData);
    // Sale location element --> end

    // Notes element --> start
    labelTermTitle.classList.add("sale-note-title");
    labelTermTitle.innerHTML = "Termin Pembayaran";
    termsNote.appendChild(labelTermTitle);
    for (a = 0; a < payments.length; a++) {
        divPreviewTerms[a] = document.createElement("div");
        divPreviewTerms[a].classList.add("flex");
        labelPreviewTermsNumber[a] = document.createElement("label");
        labelPreviewTermsNumber[a].classList.add("label-number-notes");
        labelPreviewTermsNumber[a].innerHTML = payments[a].termNumber + ".";

        labelPreviewTerms[a] = document.createElement("label");
        labelPreviewTerms[a].classList.add("label-sale-notes");
        labelPreviewTerms[a].innerHTML = payments[a].termValue + "% " + payments[a].termNote;
        divPreviewTerms[a].appendChild(labelPreviewTermsNumber[a]);
        divPreviewTerms[a].appendChild(labelPreviewTerms[a]);
        termsNote.appendChild(divPreviewTerms[a]);
    }
    divPreviewSaleNotes.appendChild(termsNote);

    labelServiceTitle.classList.add("sale-note-title");
    labelServiceTitle.innerHTML = "Services";
    divServices.appendChild(labelServiceTitle);
    for (a = 0; a < 2; a++) {
        if (a == 0) {
            if (notes[2].freeInstal != "") {
                labelPreviewServices[a] = document.createElement("label");
                labelPreviewServices[a].classList.add("label-sale-notes");
                labelPreviewServices[a].innerHTML = "• Free pemasangan " + notes[2].freeInstal + "x";
                divServices.appendChild(labelPreviewServices[a]);
                saleFreeInstal = notes[2].freeInstal;
            } else {
                labelPreviewServices[a] = document.createElement("label");
                labelPreviewServices[a].classList.add("label-sale-notes");
                labelPreviewServices[a].innerHTML = "• Tidak ada free pemasangan";
                divServices.appendChild(labelPreviewServices[a]);
            }

        } else if (a == 1) {
            if (notes[3].freePrint != "") {
                labelPreviewServices[a] = document.createElement("label");
                labelPreviewServices[a].classList.add("label-sale-notes");
                labelPreviewServices[a].innerHTML = "• Free cetak " + notes[3].freePrint + "x";
                divServices.appendChild(labelPreviewServices[a]);
                saleFreePrint = notes[3].freePrint;
            } else {
                labelPreviewServices[a] = document.createElement("label");
                labelPreviewServices[a].classList.add("label-sale-notes");
                labelPreviewServices[a].innerHTML = "• Tidak ada free cetak";
                divServices.appendChild(labelPreviewServices[a]);
            }
        }
    }
    divServices.classList.add("mt-4");
    divPreviewSaleNotes.appendChild(divServices);
    divPreviewSaleNotes.classList.add("div-sale-notes");
    divPreviewSaleNotes.classList.add("w-[325px]");

    divOtherNotes.classList.add("div-sale-notes");
    divOtherNotes.classList.add("w-[435px]");
    divOtherNotes.classList.add("ml-4");
    divOtherNotes.appendChild(divNotes);
    labelNoteTitle.classList.add("sale-note-title");
    labelNoteTitle.innerHTML = "Keterangan Tambahan :";
    divNotes.appendChild(labelNoteTitle);
    for (a = 0; a < 6; a++) {
        linePreviewLabel[a] = document.createElement("label");
        linePreviewLabel[a].classList.add("line-label");
        divNotes.appendChild(linePreviewLabel[a]);
    }
    saleNote.classList.add("sale-note");

    saleNote.appendChild(divPreviewSaleNotes);
    saleNote.appendChild(divOtherNotes);
    body.appendChild(saleNote);
    // Notes element --> end

    // Sign Area --> start
    letterSign(body);
    // Sign Area --> end

    // Location photo --> start
    locationPhoto(locations[i].photo, body);
    // Location photo --> end

    bgElement.appendChild(body);

    // Body element --> end

    // Footer element --> start
    letterFooter(bgElement);
    // Footer element --> end

    salesPreview.appendChild(bgElement);

    // Fill element --> start
    if (quotationDeal.value.includes('rev') == false) {
        for (a = 0; a < quotationData.length; a++) {
            if (quotationData[a].number == quotationDeal.value) {
                labelQuotationValue[0].innerHTML = "";
                labelQuotationValue[0].innerHTML = quotationData[a].number;
                labelQuotationValue[1].innerHTML = "";
                labelQuotationValue[1].innerHTML = getFormatDate(new Date(quotationData[a].created_at), options, '-');
                for (n = 0; n < dataClient.length; n++) {
                    if (dataClient[n].id == saleClientId) {
                        labelQuotationValue[2].innerHTML = "";
                        labelQuotationValue[2].innerHTML = dataClient[n].name;
                        labelQuotationValue[3].innerHTML = "";
                        labelQuotationValue[3].innerHTML = dataClient[n].company;
                        labelQuotationValue[4].innerHTML = "";
                        labelQuotationValue[4].innerHTML = dataClient[n].address;
                    }
                }
                for (j = 0; j < dataContact.length; j++) {
                    if (dataContact[j].id == saleContactId) {
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
    } else {
        for (a = 0; a < quotRevisionData.length; a++) {
            if (quotRevisionData[a].number == quotationDeal.value) {
                labelQuotationValue[0].innerHTML = "";
                labelQuotationValue[0].innerHTML = quotRevisionData[a].number;
                labelQuotationValue[1].innerHTML = "";
                labelQuotationValue[1].innerHTML = getFormatDate(new Date(quotRevisionData[a].created_at), options, '-');
                for (n = 0; n < dataClient.length; n++) {
                    if (dataClient[n].id == saleClientId) {
                        labelQuotationValue[2].innerHTML = "";
                        labelQuotationValue[2].innerHTML = dataClient[n].name;
                        labelQuotationValue[3].innerHTML = "";
                        labelQuotationValue[3].innerHTML = dataClient[n].company;
                        labelQuotationValue[4].innerHTML = "";
                        labelQuotationValue[4].innerHTML = dataClient[n].address;
                        for (j = 0; j < dataContact.length; j++) {
                            if (dataContact[j].id == dataContact[j].saleContactId) {
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
// Create Preview Sales --> end

// Button Close Preview Event --> start
btnClosePreview.addEventListener('click', function () {
    modalPreview.classList.add("hidden");
    modalPreview.classList.remove("flex");
})
// Button Close Preview Event --> end

//Create print sales --> start
printSales = () => {
    var bgElement = document.createElement("div");
    var body = document.createElement("div"); 
    
    var bodyDetail = document.createElement("div");
    var saleDetail = document.createElement("div");
    var quotationDetail = document.createElement("div");

    var saleData = document.createElement("div");
    var divTable = document.createElement("div");
    var saleTHead = document.createElement("thead");
    var saleTBody = document.createElement("tbody");

    var saleNote = document.createElement("div");
    var divSaleNotes = document.createElement("div");
    var termsNote = document.createElement("div");
    var labelTermTitle = document.createElement("label");
    var divServices = document.createElement("div");
    var labelServiceTitle = document.createElement("label");
    var divOtherNotes = document.createElement("div");
    var divNotes = document.createElement("div");
    var labelNoteTitle = document.createElement("label");

    // Main element --> start
    bgElement.classList.add("w-[950px]");
    bgElement.classList.add("h-[1345px]");
    bgElement.classList.add("border");
    bgElement.classList.add("mb-10");
    bgElement.classList.add("bg-white");
    // Main element --> end

    letterHeader(bgElement);

    // Body element --> start
    // Title element --> start
    body.classList.add("h-[1125px]");

    letterBodyTitle(body, "DATA PENJUALAN CETAK & PASANG");

    bodyDetail.classList.add("body-detail");
    saleDetail.classList.add("sale-detail");
    for (let j = 0; j < 5; j++) {
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
            labelSaleValue[j].innerHTML = "";
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
            spanButton[j].innerHTML = "View";
            // btnApproval[i] = document.createElement("button");
            // btnApproval[i].classList.add("btn-sale");
            // btnApproval[i].setAttribute('type', 'button');
            // btnApproval[i].setAttribute('onclick', 'previewAppovalImage()');
            // btnApproval[i].appendChild(spanButton[j]);
            // divSale[j].appendChild(btnApproval[i]);
        } else if (j == 3) {
            labelSale[j].innerHTML = "Dok. PO/SPK";
            divSale[j].appendChild(labelSale[j]);
            divSale[j].appendChild(labelSaleColon[j]);
            spanButton[j] = document.createElement("span");
            spanButton[j].classList.add("text-sm");
            spanButton[j].classList.add("mx-2");
            spanButton[j].innerHTML = "Add/View";
            // btnPO[i] = document.createElement("button");
            // btnPO[i].classList.add("btn-sale");
            // btnPO[i].setAttribute('type', 'button');
            // btnPO[i].setAttribute('onclick', 'btnPOEvent()');
            // btnPO[i].appendChild(spanButton[j]);
            // divSale[j].appendChild(btnPO[i]);
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
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 1) {
            labelQuotation[n].innerHTML = "Tgl. Penawaran";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 2) {
            labelQuotation[n].innerHTML = "Nama Klien";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 3) {
            labelQuotation[n].innerHTML = "Perusahaan";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 4) {
            labelQuotation[n].innerHTML = "Alamat";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 5) {
            labelQuotation[n].innerHTML = "Kontak Person";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 6) {
            labelQuotation[n].innerHTML = "No. Telp./Hp.";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        } else if (n == 7) {
            labelQuotation[n].innerHTML = "Email";
            divQuotation[n].appendChild(labelQuotation[n]);
            divQuotation[n].appendChild(labelQuotationColon[n]);
            labelQuotationValue[n].classList.add("w-60");
            divQuotation[n].appendChild(labelQuotationValue[n]);
        }

        quotationDetail.appendChild(divQuotation[n]);
    }
    quotationDetail.classList.add("sale-detail");
    quotationDetail.classList.add("ml-4");
    bodyDetail.appendChild(saleDetail);
    bodyDetail.appendChild(quotationDetail);

    body.appendChild(bodyDetail);

    // Sale location element --> start
    var printInstallTable = document.createElement("table");
    printInstallTable.classList.add("table-auto");
    printInstallTable.classList.add("mt-2");
    printInstallTable.classList.add("w-[780px]");

    newRow[0] = saleTHead.insertRow(0);
    cell[0] = newRow[0].insertCell(0);
    cell[0].innerHTML = "No.";
    cell[0].classList.add('th-table');
    cell[0].classList.add('w-8');
    cell[0].setAttribute('rowspan', '2');
    cell[1] = newRow[0].insertCell(1);
    cell[1].innerHTML = "Jenis";
    cell[1].classList.add('th-table');
    cell[1].classList.add('w-14');
    cell[1].setAttribute('rowspan', '2');
    cell[2] = newRow[0].insertCell(2);
    cell[2].innerHTML = "Lokasi";
    cell[2].classList.add('th-table');
    cell[2].setAttribute('colspan', '2');
    cell[3] = newRow[0].insertCell(3);
    cell[3].innerHTML = "Deskripsi";
    cell[3].classList.add('th-table');
    cell[3].classList.add('w-72');
    cell[3].setAttribute('colspan', '4');
    newRow[1] = saleTHead.insertRow(1);
    cell[0] = newRow[1].insertCell(0);
    cell[0].innerHTML = "Kode";
    cell[0].classList.add('th-table');
    cell[0].classList.add('w-24');
    cell[1] = newRow[1].insertCell(1);
    cell[1].innerHTML = "Alamat";
    cell[1].classList.add('th-table');
    // cell[1].classList.add('w-10');
    cell[2] = newRow[1].insertCell(2);
    cell[2].innerHTML = "Bahan";
    cell[2].classList.add('th-table');
    cell[2].classList.add('w-28');
    cell[3] = newRow[1].insertCell(3);
    cell[3].classList.add('th-table');
    cell[3].classList.add('w-8');
    cell[3].innerHTML = "Luas";
    cell[4] = newRow[1].insertCell(4);
    cell[4].classList.add('th-table');
    cell[4].classList.add('w-16');
    cell[4].innerHTML = "Harga";
    cell[5] = newRow[1].insertCell(5);
    cell[5].classList.add('th-table');
    cell[5].classList.add('w-20');
    cell[5].innerHTML = "Total";

    while (saleTBody.hasChildNodes()) {
        saleTBody.removeChild(saleTBody.firstChild);
    }

    newRow[0] = saleTBody.insertRow(0);
    cell[0] = newRow[0].insertCell(0);
    cell[0].innerHTML = 1;
    cell[0].classList.add('td-table');
    cell[0].setAttribute('rowspan', '2');
    cell[1] = newRow[0].insertCell(1);
    cell[1].innerHTML = "Cetak";
    cell[1].classList.add('td-table');
    cell[2] = newRow[0].insertCell(2);
    cell[2].innerHTML = "7001 - BDG";
    cell[2].classList.add('td-table');
    cell[2].setAttribute('rowspan', '2');
    cell[3] = newRow[0].insertCell(3);
    cell[3].classList.add('text-xs');
    cell[3].classList.add('text-teal-700');
    cell[3].classList.add('border');
    cell[3].classList.add('px-1');
    cell[3].innerHTML = "Jl. Bypass Ngurah Rai";
    cell[3].setAttribute('rowspan', '2');
    cell[4] = newRow[0].insertCell(4);
    cell[4].innerHTML = "FL 380";
    cell[4].classList.add('td-table');
    cell[5] = newRow[0].insertCell(5);
    cell[5].innerHTML = "50";
    cell[5].classList.add('td-table');
    cell[6] = newRow[0].insertCell(6);
    cell[6].innerHTML = "50000";
    cell[6].classList.add('td-table');

    cell[7] = newRow[0].insertCell(7);
    cell[7].innerHTML = "2500000";

    cell[7].classList.add('td-table-sale');

    newRow[1] = saleTBody.insertRow(1);
    cell[0] = newRow[1].insertCell(0);
    cell[0].innerHTML = "Pasang";
    cell[0].classList.add('td-table');
    cell[1] = newRow[1].insertCell(1);
    cell[1].innerHTML = "FL 380";
    cell[1].classList.add('td-table');
    cell[2] = newRow[1].insertCell(2);
    cell[2].innerHTML = "50";
    cell[2].classList.add('td-table');
    cell[3] = newRow[1].insertCell(3);
    cell[3].innerHTML = "50000";
    cell[3].classList.add('td-table');

    cell[4] = newRow[1].insertCell(4);
    cell[4].innerHTML = "2500000";
    cell[4].classList.add('td-table-sale');


    newRow[2] = saleTBody.insertRow(2);
    cell[0] = newRow[2].insertCell(0);
    cell[0].innerHTML = "PPN 11% (A)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '7');
    cell[1] = newRow[2].insertCell(1);
    cell[1].innerHTML = "";
    cell[1].classList.add('td-table-sale');

    newRow[3] = saleTBody.insertRow(3);
    cell[0] = newRow[3].insertCell(0);
    cell[0].innerHTML = "PPh 23 2% (B)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '7');
    cell[1] = newRow[3].insertCell(1);
    cell[1].innerHTML = "";
    cell[1].classList.add('td-table-sale');

    newRow[4] = saleTBody.insertRow(4);
    cell[0] = newRow[4].insertCell(0);
    cell[0].innerHTML = "Grand Total ((Harga + A) - B)";
    cell[0].classList.add('td-table-sale');
    cell[0].setAttribute('colspan', '7');
    cell[1] = newRow[4].insertCell(1);
    cell[1].innerHTML = "";
    cell[1].classList.add('td-table-sale');

    printInstallTable.appendChild(saleTHead);
    printInstallTable.appendChild(saleTBody);
    divTable.appendChild(printInstallTable);
    divTable.classList.add("flex");
    divTable.classList.add("justify-center");
    saleData.classList.add("mt-4");
    saleData.appendChild(divTable);
    body.appendChild(saleData);
    // Sale location element --> end

    // Notes element --> start
    labelTermTitle.classList.add("sale-note-title");
    labelTermTitle.innerHTML = "Termin Pembayaran";
    termsNote.appendChild(labelTermTitle);
    divSaleNotes.appendChild(termsNote);

    divSaleNotes.appendChild(divServices);
    divSaleNotes.classList.add("div-sale-notes");
    divSaleNotes.classList.add("w-[325px]");

    divOtherNotes.classList.add("div-sale-notes");
    divOtherNotes.classList.add("w-[435px]");
    divOtherNotes.classList.add("ml-5");
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

    // Sign Area --> start
    letterSign(body);
    // Sign Area --> end

    // Location photo --> start
    locationPhoto("test", body);
    // Location photo --> end

    bgElement.appendChild(body);
    // Body element --> end

    // Footer element --> start
    letterFooter(bgElement);
    // Footer element --> end

    multipleSale.appendChild(bgElement);
}
//Create print sales --> end