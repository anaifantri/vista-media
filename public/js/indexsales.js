const documentApproval = document.querySelector('#documentApproval');
const slidesApprovalPreview = document.getElementById("slidesApprovalPreview");
const prevApprovalButton = document.getElementById("prevApprovalButton");
const nextApprovalButton = document.getElementById("nextApprovalButton");
const approvalImg = document.getElementById("approvalImg");
const btnCloseApproval = document.getElementById("btnCloseApproval");
const btnClosePO = document.getElementById("btnClosePO");
const btnCloseAgreement = document.getElementById("btnCloseAgreement");
const btnPOUpload = document.getElementById("btnPOUpload");
const btnPOSave = document.getElementById("btnPOSave");
const btnPOCancel = document.getElementById("btnPOCancel");
const orderNumber = document.getElementById("order_number");
const orderDate = document.getElementById("order_date");
const documentPO = document.getElementById("documentPO");
const poBillboardQuotationId = document.getElementById("poBillboardQuotationId");
const poBillboardQuotRevisionId = document.getElementById("poBillboardQuotRevisionId");
const btnAgreementUpload = document.getElementById("btnAgreementUpload");
const btnAgreementSave = document.getElementById("btnAgreementSave");
const btnAgreementCancel = document.getElementById("btnAgreementCancel");
const agreementBillboardQuotationId = document.getElementById("agreementBillboardQuotationId");
const agreementBillboardQuotRevisionId = document.getElementById("agreementBillboardQuotRevisionId");
const agreementNumber = document.getElementById("agreement_number");
const agreementDate = document.getElementById("agreement_date");
const documentAgreement = document.getElementById("documentAgreement");
const slidesPOPreview = document.getElementById("slidesPOPreview");
const numberPOFile = document.getElementById("numberPOFile");
const prevPOButton = document.getElementById("prevPOButton");
const nextPOButton = document.getElementById("nextPOButton");
const poImg = document.getElementById("poImg");
const btnChosePO = document.getElementById("btnChosePO");
const btnChoseAgreement = document.getElementById("btnChoseAgreement");
const orderPO = document.getElementById("order_po");
const orderSPK = document.getElementById("order_spk");
const sessionAgreement = document.getElementById("sessionAgreement");
const sessionOrder = document.getElementById("sessionOrder");
const btnPO = document.getElementById("btnPO");
const spanBtnPO = document.getElementById("spanBtnPO");
const btnAgreement = document.getElementById("btnAgreement");
const spanBtnAgreement = document.getElementById("spanBtnAgreement");

const slidesAgreementPreview = document.getElementById("slidesAgreementPreview");
const numberAgreementFile = document.getElementById("numberAgreementFile");
const prevAgreementButton = document.getElementById("prevAgreementButton");
const nextAgreementButton = document.getElementById("nextAgreementButton");
const agreementImg = document.getElementById("agreementImg");

let objApproval = {};
let approvalData = [];
let objOrder = {};
let orderData = [];
let objAgreement = {};
let agreementData = [];

let approvalUrl = [];
let approvalImage = [];
let slideApprovalPreview = [];
let slideApprovalImage = [];
let slideApprovalIndex = 0;

let orderUrl = [];
let orderNameValue = "";
let orderNumberValue = "";
let orderDateValue = "";
let poImage = [];
let slidePOPreview = [];
let slidePOImage = [];
let slidePOIndex = 0;

let agreementImage = [];
let agreementUrl = [];
let agreementNumberValue = "";
let agreementDateValue = "";
let slideAgreementPreview = [];
let slideAgreementImage = [];
let slideAgreementIndex = 0;

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

//Get Document Order --> start
getOrderData();

function getOrderData() {
    const xhrDocumentOrder = new XMLHttpRequest();
    const methodDocumentOrder = "GET";
    const urlDocumentOrder = "/showClientOrder";

    xhrDocumentOrder.open(methodDocumentOrder, urlDocumentOrder, true);
    xhrDocumentOrder.send();

    xhrDocumentOrder.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrDocumentOrder.readyState === XMLHttpRequest.DONE) {
            const status = xhrDocumentOrder.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objOrder = JSON.parse(xhrDocumentOrder.responseText);
                orderData = objOrder.dataClientOrder;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
//Get Document Order --> end

//Get Document Agreement --> start
getAgreementData();

function getAgreementData() {
    const xhrDocumentAgreement = new XMLHttpRequest();
    const methodDocumentAgreement = "GET";
    const urlDocumentAgreement = "/showClientAgreement";

    xhrDocumentAgreement.open(methodDocumentAgreement, urlDocumentAgreement, true);
    xhrDocumentAgreement.send();

    xhrDocumentAgreement.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrDocumentAgreement.readyState === XMLHttpRequest.DONE) {
            const status = xhrDocumentAgreement.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objAgreement = JSON.parse(xhrDocumentAgreement.responseText);
                agreementData = objAgreement.dataClientAgreement;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
//Get Document Agreement --> end

// Preview Approval Document --> start
function previewAppovalImage(quotID, quot) {
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

    var a = 0;
    approvalUrl = [];

    if (quot == "Main") {
        for (i = 0; i < approvalData.length; i++) {
            if (approvalData[i].billboard_quotation_id == quotID) {
                approvalUrl[a] = approvalData[i].approval_image;
                a = a + 1;
            }
        }
    } else if (quot == "Revision") {
        for (i = 0; i < approvalData.length; i++) {
            if (approvalData[i].billboard_quot_revision_id == quotID) {
                approvalUrl[a] = approvalData[i].approval_image;
                a = a + 1;
            }
        }
    }

    if (approvalUrl.length != 0) {
        for (n = 0; n < approvalUrl.length; n++) {
            approvalImage[n] = document.createElement("img")
            if (n == 0) {
                approvalImage[n].classList.add("document-approval-active");
            } else {
                approvalImage[n].classList.add("document-approval");
            }

            approvalImage[n].src = '/storage/' + approvalUrl[n];
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
            slideApprovalImage[n].src = '/storage/' + approvalUrl[n];
            slideApprovalPreview[n].appendChild(slideApprovalImage[n]);
            slidesApprovalPreview.appendChild(slideApprovalPreview[n]);
        }

        prevApprovalButton.removeAttribute('hidden');
        nextApprovalButton.removeAttribute('hidden');
    }
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
        slideApprovalIndex = approvalUrl.length - 1;
        slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
        approvalImage[slideApprovalIndex].classList.remove("document-approval");
        approvalImage[slideApprovalIndex].classList.add("document-approval-active");
    }
})

nextApprovalButton.addEventListener('click', function () {
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
function previewPOImage(quotID, quot) {
    modalPO.classList.remove("hidden");
    modalPO.classList.add("flex");
    window.scrollTo(0, 0);

    while (poImg.hasChildNodes()) {
        poImg.removeChild(poImg.firstChild);
    }

    while (slidesPOPreview.hasChildNodes()) {
        slidesPOPreview.removeChild(slidesPOPreview.firstChild);
    }

    var a = 0;
    orderUrl = [];

    if (quot == "Main") {
        poBillboardQuotationId.value = "";
        poBillboardQuotationId.value = quotID;
        for (i = 0; i < orderData.length; i++) {
            if (orderData[i].billboard_quotation_id == quotID) {
                orderUrl[a] = orderData[i].order_image;
                orderNameValue = "";
                orderNameValue = orderData[i].name;
                orderNumberValue = "";
                orderNumberValue = orderData[i].number;
                orderDateValue = "";
                orderDateValue = orderData[i].order_date;
                a = a + 1;
            }
        }
    } else if (quot == "Revision") {
        poBillboardQuotRevisionId.value = "";
        poBillboardQuotRevisionId.value = quotID;
        for (i = 0; i < orderData.length; i++) {
            if (orderData[i].billboard_quot_revision_id == quotID) {
                orderUrl[a] = orderData[i].order_image;
                orderNameValue = "";
                orderNameValue = orderData[i].name;
                orderNumberValue = "";
                orderNumberValue = orderData[i].number;
                orderDateValue = "";
                orderDateValue = orderData[i].order_date;
                a = a + 1;
            }
        }
    }

    if (orderUrl.length != 0) {
        btnChosePO.classList.add("hidden");
        btnChosePO.classList.remove("flex");
        btnPOCancel.classList.add("hidden");
        btnPOUpload.classList.add("hidden");
        btnPOCancel.classList.remove("flex");
        btnPOUpload.classList.remove("flex");
        btnClosePO.classList.remove("hidden");
        btnClosePO.classList.add("flex");
        if (orderNameValue == "po") {
            orderPO.setAttribute('checked', 'checked');
            orderPO.setAttribute('readonly', 'readonly');
            orderSPK.removeAttribute('checked');
            orderSPK.setAttribute('readonly', 'readonly');
        } else if (orderNameValue == "spk") {
            orderPO.removeAttribute('checked');
            orderPO.setAttribute('readonly', 'readonly');
            orderSPK.setAttribute('checked', 'checked');
            orderSPK.setAttribute('readonly', 'readonly');
        }
        orderNumber.value = orderNumberValue;
        orderNumber.setAttribute('readonly', 'readonly');
        orderDate.value = orderDateValue;
        orderDate.setAttribute('readonly', 'readonly');
        numberPOFile.innerHTML = "";
        numberPOFile.innerHTML = orderUrl.length + " images";
        for (n = 0; n < orderUrl.length; n++) {
            // const file = documentPO.files[n];
            // const objectUrl = URL.createObjectURL(file);

            poImage[n] = document.createElement("img")
            if (n == 0) {
                poImage[n].classList.add("document-approval-active");
            } else {
                poImage[n].classList.add("document-approval");
            }

            poImage[n].src = '/storage/' + orderUrl[n];
            console.log('/storage/' + orderUrl[n]);
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
            slidePOImage[n].src = '/storage/' + orderUrl[n];
            slidePOPreview[n].appendChild(slidePOImage[n]);
            slidesPOPreview.appendChild(slidePOPreview[n]);
        }

        prevPOButton.removeAttribute('hidden');
        nextPOButton.removeAttribute('hidden');
    } else {
        orderPO.setAttribute('checked', 'checked');
        orderPO.removeAttribute('readonly');
        orderSPK.removeAttribute('checked');
        orderSPK.removeAttribute('readonly');
        btnChosePO.classList.remove("hidden");
        btnChosePO.classList.add("flex");
        btnPOCancel.classList.remove("hidden");
        btnPOUpload.classList.remove("hidden");
        btnPOCancel.classList.add("flex");
        btnPOUpload.classList.add("flex");
        btnClosePO.classList.add("hidden");
        btnClosePO.classList.remove("flex");
        orderNumber.value = "";
        orderNumber.removeAttribute('readonly');
        orderDate.value = "";
        orderDate.removeAttribute('readonly');
        numberPOFile.innerHTML = "No Files Chosen";
    }
}

function chosePOImage() {
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
    if (orderUrl != 0) {
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
            slidePOIndex = orderUrl.length - 1;
            slidePOImage[slidePOIndex].classList.remove("hidden");
            poImage[slidePOIndex].classList.remove("document-approval");
            poImage[slidePOIndex].classList.add("document-approval-active");
        }
    } else {
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
    }
})

nextPOButton.addEventListener('click', function () {
    if (orderUrl != 0) {
        if (slidePOIndex != orderUrl.length - 1) {
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
    } else {
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

btnPOUpload.addEventListener('click', function () {
    if (documentPO.files.length == 0) {
        alert("Dokumen po/spk dipilih")
    } else if (orderNumber.value == "") {
        alert("Nomor po/spk belum di input")
    } else if (orderDate.value == "") {
        alert("Tanggal po/spk belum diinput")
    } else {
        alert("Apakah anda yakin dokumen PO/SPK yang akan di upload sudah benar?");
        btnPOSave.click();
        // modalPO.classList.add("hidden");
        // modalPO.classList.remove("flex");
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

btnClosePO.addEventListener('click', function () {
    modalPO.classList.add("hidden");
    modalPO.classList.remove("flex");
    while (poImg.hasChildNodes()) {
        poImg.removeChild(poImg.firstChild);
    }

    while (slidesPOPreview.hasChildNodes()) {
        slidesPOPreview.removeChild(slidesPOPreview.firstChild);
    }
})

// Preview PO/SPK Document --> end

// Preview Agreement Document --> start
function previewAgreementImage(quotID, quot) {
    modalAgreement.classList.remove("hidden");
    modalAgreement.classList.add("flex");
    window.scrollTo(0, 0);

    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }

    var a = 0;
    agreementUrl = [];

    if (quot == "Main") {
        agreementBillboardQuotationId.value = "";
        agreementBillboardQuotationId.value = quotID;
        for (i = 0; i < agreementData.length; i++) {
            if (agreementData[i].billboard_quotation_id == quotID) {
                agreementUrl[a] = agreementData[i].agreement_image;
                agreementNumberValue = "";
                agreementNumberValue = agreementData[i].number;
                agreementDateValue = "";
                agreementDateValue = agreementData[i].date;
                a = a + 1;
            }
        }
    } else if (quot == "Revision") {
        agreementBillboardQuotRevisionId.value = "";
        agreementBillboardQuotRevisionId.value = quotID;
        for (i = 0; i < agreementData.length; i++) {
            if (agreementData[i].billboard_quot_revision_id == quotID) {
                agreementUrl[a] = agreementData[i].agreement_image;
                agreementNumberValue = "";
                agreementNumberValue = agreementData[i].number;
                agreementDateValue = "";
                agreementDateValue = agreementData[i].date;
                a = a + 1;
            }
        }
    }

    if (agreementUrl.length != 0) {
        btnChoseAgreement.classList.add("hidden");
        btnChoseAgreement.classList.remove("flex");
        btnAgreementCancel.classList.add("hidden");
        btnAgreementUpload.classList.add("hidden");
        btnAgreementCancel.classList.remove("flex");
        btnAgreementUpload.classList.remove("flex");
        btnCloseAgreement.classList.remove("hidden");
        btnCloseAgreement.classList.add("flex");
        agreementNumber.value = agreementNumberValue;
        agreementNumber.setAttribute('readonly', 'readonly');
        agreementDate.value = agreementDateValue;
        agreementDate.setAttribute('readonly', 'readonly');
        numberAgreementFile.innerHTML = "";
        numberAgreementFile.innerHTML = agreementUrl.length + " images";
        for (n = 0; n < agreementUrl.length; n++) {

            agreementImage[n] = document.createElement("img")
            if (n == 0) {
                agreementImage[n].classList.add("document-approval-active");
            } else {
                agreementImage[n].classList.add("document-approval");
            }

            agreementImage[n].src = '/storage/' + agreementUrl[n];
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
            slideAgreementImage[n].src = '/storage/' + agreementUrl[n];
            slideAgreementPreview[n].appendChild(slideAgreementImage[n]);
            slidesAgreementPreview.appendChild(slideAgreementPreview[n]);
        }

        prevAgreementButton.removeAttribute('hidden');
        nextAgreementButton.removeAttribute('hidden');
    } else {
        btnChoseAgreement.classList.remove("hidden");
        btnChoseAgreement.classList.add("flex");
        btnAgreementCancel.classList.remove("hidden");
        btnAgreementUpload.classList.remove("hidden");
        btnAgreementCancel.classList.add("flex");
        btnAgreementUpload.classList.add("flex");
        btnCloseAgreement.classList.add("hidden");
        btnCloseAgreement.classList.remove("flex");
        agreementNumber.value = "";
        agreementNumber.removeAttribute('readonly');
        agreementDate.value = "";
        agreementDate.removeAttribute('readonly');
        numberAgreementFile.innerHTML = "No Files Chosen";
    }
}

function choseAgreementImage() {
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
    if (agreementUrl != 0) {
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
            slideAgreementIndex = agreementUrl.length - 1;
            slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval");
            agreementImage[slideAgreementIndex].classList.add("document-approval-active");
        }
    } else {
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
    }
})

nextAgreementButton.addEventListener('click', function () {
    if (agreementUrl != 0) {
        if (slideAgreementIndex != agreementUrl.length - 1) {
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
    } else {
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

btnAgreementUpload.addEventListener('click', function () {
    if (documentAgreement.files.length == 0) {
        alert("Dokumen perjanjian dipilih")
    } else if (agreementNumber.value == "") {
        alert("Nomor perjanjian belum di input")
    } else if (agreementDate.value == "") {
        alert("Tanggal perjanjian belum diinput")
    } else {
        alert("Apakah anda yakin dokumen agreement yang akan di upload sudah benar?");
        btnAgreementSave.click();
        // modalAgreement.classList.add("hidden");
        // modalAgreement.classList.remove("flex");
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

btnCloseAgreement.addEventListener('click', function () {
    modalAgreement.classList.add("hidden");
    modalAgreement.classList.remove("flex");
    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }
})

setTimeout(sessionAgreementCheck, 500);
function sessionAgreementCheck() {
    if (sessionAgreement.checked == true) {
        btnAgreement.click();
    }
}

setTimeout(sessionOrderCheck, 500);
function sessionOrderCheck() {
    if (sessionOrder.checked == true) {
        btnPO.click();
    }
}

// Preview Agreement Document --> end