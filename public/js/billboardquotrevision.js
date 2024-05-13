// Declaration Quotation Create --> start
const number = document.getElementById("number");
const noteQty = document.getElementById("noteQty");
const mainNumber = document.getElementById("mainNumber");
const revisionNumber = document.getElementById("revisionNumber");
const revisionNumberPreview = document.getElementById("revisionNumberPreview");
const btnPreview = document.getElementById("btnPreview");
const billboards = document.getElementById("billboards");
const note = document.getElementById("note");
const bodyEndBillboard = document.getElementById("bodyEndBillboard");
const pricePeriode = document.getElementById("price_periode");
const priceType = document.getElementById("priceType");
const aMonth = document.getElementById("aMonth");
const quarterYear = document.getElementById("quarterYear");
const halfYear = document.getElementById("halfYear");
const aYear = document.getElementById("aYear");
const manual = document.getElementById("manual");
const auto = document.getElementById("auto");
const oneMonth = document.getElementById("oneMonth");
const threeMonth = document.getElementById("threeMonth");
const sixMonth = document.getElementById("sixMonth");
const twelveMonth = document.getElementById("twelveMonth");
const cbBillboardNote1 = document.getElementById("cbBillboardNote-1");
const inputBBNote1 = document.getElementById("inputBBNote-1");
const cbBillboardNote2 = document.getElementById("cbBillboardNote-2");
const inputBBNote2 = document.getElementById("inputBBNote-2");
const cbBillboardNote3 = document.getElementById("cbBillboardNote-3");
const inputBBNote3 = document.getElementById("inputBBNote-3");
const labelBBNote3 = document.getElementById("labelBBNote-3");
const cbBillboardNote4 = document.getElementById("cbBillboardNote-4");
const labelBBNote4 = document.getElementById("labelBBNote-4");
const inputBBNote4 = document.getElementById("inputBBNote-4");
const inputBBNote5 = document.getElementById("inputBBNote-5");
const cbBillboardNote5 = document.getElementById("cbBillboardNote-5");
const labelBBNote5 = document.getElementById("labelBBNote-5");
const inputBBNote6 = document.getElementById("inputBBNote-6");
const cbBillboardNote6 = document.getElementById("cbBillboardNote-6");
const billboardNote7 = document.getElementById("billboardNote-7");
const cbBillboardNote8 = document.getElementById("cbBillboardNote-8");
const inputBBNote8 = document.getElementById("inputBBNote-8");
const cbBillboardNote9 = document.getElementById("cbBillboardNote-9");
const inputBBNote9 = document.getElementById("inputBBNote-9");
const cbBillboardNote10 = document.getElementById("cbBillboardNote10");
const inputBBNote10 = document.getElementById("inputBBNote10");
const btnAddPayment = document.getElementById("btnAddPayment");
const btnDelPayment = document.getElementById("btnDelPayment");
const btnAddNotes = document.getElementById("btnAddNotes");
const btnDelNotes = document.getElementById("btnDelNotes");
const billboardNote = document.getElementById("billboardNote");

const billboardTBody = document.getElementById("billboardTBody");

const attachmentBillboard = document.getElementById("attachmentBillboard");
const subjectBillboard = document.getElementById("subjectBillboard");
const clientCompany = document.getElementById("clientCompany");
const clientContact = document.getElementById("clientContact");
const contactEmail = document.getElementById("contactEmail");
const contactPhone = document.getElementById("contactPhone");
const bodyTopBillboard = document.getElementById("bodyTopBillboard");

const thAMonth = document.getElementById("thAMonth");
const thQuarterYear = document.getElementById("thQuarterYear");
const thHalfYear = document.getElementById("thHalfYear");
const thAYear = document.getElementById("thAYear");
const thPrice = document.getElementById("thPrice");
const previewTHPrice = document.getElementById("previewTHPrice");
const priceYear = document.getElementById("priceYear");

const termPayment = document.getElementById("termPayment");
const notesAdd = document.getElementById("notesAdd");

let indexNotes = 0;
let indexPayment = 0;
let divNotes = [];
let divPayment = [];
let labelPayment = [];
let paymentValue = [];
let paymentNote = [];
let cbNotes = [];
let inputNotes = [];
var totalPayment = 0;
var nolPercent = 0;
// Declaration Quotation Create --> end

// Declaration Quotation Billboard Preview --> start
const billboardTable = document.getElementById("billboardTable");
const modalPreview = document.getElementById("modalPreview");
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
const previewTableWidth = document.getElementById("previewTableWidth");
const previewBBNote = document.getElementById("previewBBNote");
const previewBBNote1 = document.getElementById("previewBBNote-1");
const labelPreviewBBNote1 = document.getElementById("labelPreviewBBNote-1");
const previewBBNote2 = document.getElementById("previewBBNote-2");
const labelPreviewBBNote2 = document.getElementById("labelPreviewBBNote-2");
const previewBBNote3 = document.getElementById("previewBBNote-3");
const labelPreviewBBNote3 = document.getElementById("labelPreviewBBNote-3");
const previewBBNote4 = document.getElementById("previewBBNote-4");
const labelPreviewBBNote4 = document.getElementById("labelPreviewBBNote-4");
const previewBBNote5 = document.getElementById("previewBBNote-5");
const labelPreviewBBNote5 = document.getElementById("labelPreviewBBNote-5");
const previewBBNote6 = document.getElementById("previewBBNote-6");
const labelPreviewBBNote6 = document.getElementById("labelPreviewBBNote-6");
const previewBBNote7 = document.getElementById("previewBBNote-7");
const labelPreviewBBNote7 = document.getElementById("labelPreviewBBNote-7");
const previewBBNote8 = document.getElementById("previewBBNote-8");
const labelPreviewBBNote8 = document.getElementById("labelPreviewBBNote-8");
const previewBBNote9 = document.getElementById("previewBBNote-9");
const labelPreviewBBNote9 = document.getElementById("labelPreviewBBNote-9");
const previewBBNote10 = document.getElementById("previewBBNote10");
const labelPreviewBBNote10 = document.getElementById("labelPreviewBBNote10");
const locationsImage = document.getElementById("locationsImage");
let divPreviewBBNote = [];
let labelPreviewBBNote = [];
// Declaration Quotation Billboard Preview --> end

let objBillboardQuotRevision = {};
let objBillboards = {};
let objLocations = JSON.parse(billboards.value);
let objBillboardQuotation = {};

let dataBillboardQuotRevision = [];
let locations = objLocations.locations;
let dataBillboardQuotation = [];

let newRow = [];
let cell = [];
let notes = [];
let payment = [];
let mainId = 0;

const date = new Date();
const year = date.getFullYear();
let month = "";
// var getMainNumber = mainNumber.innerText;
var frontMainNumber = mainNumber.innerText.slice(0, 4);
var rearMainNumber = mainNumber.innerText.substring(4);
let resultsNumber = 0;
let revisionQty = 0;

setTableWidth();
function setTableWidth() {
    var setColumn = 0;
    if (aMonth.checked == true) {
        setColumn = setColumn + 1;
    }
    if (quarterYear.checked == true) {
        setColumn = setColumn + 1;
    }
    if (halfYear.checked == true) {
        setColumn = setColumn + 1;
    }
    if (aYear.checked == true) {
        setColumn = setColumn + 1;
    }

    console.log(setColumn);

    if (setColumn == 1 || setColumn == 2) {
        tableWidth.classList.add('w-[725px]');
        tableWidth.classList.remove('w-[800px]');
        previewTableWidth.classList.add('w-[650px]');
        previewTableWidth.classList.remove('w-[725px]');
    } else {
        tableWidth.classList.add('w-[800px]');
        tableWidth.classList.remove('w-[725px]');
        previewTableWidth.classList.add('w-[725px]');
        previewTableWidth.classList.remove('w-[650px]');
    }
}

setColSpan();
function setColSpan() {
    var colSpan = 0;
    if (aMonth.checked == true) {
        colSpan = colSpan + 1;
    }
    if (quarterYear.checked == true) {
        colSpan = colSpan + 1;
    }
    if (halfYear.checked == true) {
        colSpan = colSpan + 1;
    }
    if (aYear.checked == true) {
        colSpan = colSpan + 1;
    }

    thPrice.removeAttribute('colspan');
    thPrice.setAttribute('colspan', colSpan);
    previewTHPrice.removeAttribute('colspan');
    previewTHPrice.setAttribute('colspan', colSpan);
}


function showPriceMonth() {
    for (i = 0; i < locations.length; i++) {
        if (aMonth.checked == true) {
            billboardTBody.rows[i].cells[6].removeAttribute('hidden');
            locations[i].price.periodeMonth.cbPeriode = true;
        } else {
            billboardTBody.rows[i].cells[6].setAttribute('hidden', 'hidden');
            locations[i].price.periodeMonth.cbPeriode = false;
        }
    }
}

function showPriceQuarter() {
    for (i = 0; i < locations.length; i++) {
        if (quarterYear.checked == true) {
            billboardTBody.rows[i].cells[7].removeAttribute('hidden');
            locations[i].price.periodeQuarter.cbPeriode = true;
        } else {
            billboardTBody.rows[i].cells[7].setAttribute('hidden', 'hidden');
            locations[i].price.periodeQuarter.cbPeriode = false;
        }
    }
}

function showPriceHalf() {
    for (i = 0; i < locations.length; i++) {
        if (halfYear.checked == true) {
            billboardTBody.rows[i].cells[8].removeAttribute('hidden');
            locations[i].price.periodeHalf.cbPeriode = true;
        } else {
            billboardTBody.rows[i].cells[8].setAttribute('hidden', 'hidden');
            locations[i].price.periodeHalf.cbPeriode = false;
        }
    }
}

function showPriceYear() {
    for (i = 0; i < locations.length; i++) {
        if (aYear.checked == true) {
            billboardTBody.rows[i].cells[9].removeAttribute('hidden');
            locations[i].price.periodeYear.cbPeriode = true;
        } else {
            billboardTBody.rows[i].cells[9].setAttribute('hidden', 'hidden');
            locations[i].price.periodeYear.cbPeriode = false;
        }
    }
}

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
                objBillboardQuotation = JSON.parse(xhrBillboardQuotation.responseText);
                dataBillboardQuotation = objBillboardQuotation.dataBillboardQuotation;
                for (i = 0; i < dataBillboardQuotation.length; i++) {
                    if (dataBillboardQuotation[i].number == mainNumber.innerText) {
                        mainId = dataBillboardQuotation[i].id;
                    }
                }
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
                objBillboardQuotRevision = JSON.parse(xhrBillboardQuotRevision.responseText);
                dataBillboardQuotRevision = objBillboardQuotRevision.dataBillboardQuotRevision;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
// Get Quote Revision Data --> end

// Add Quote Revision Number --> start
setTimeout(addQuotationNumber, 1000);
function addQuotationNumber() {
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
    if (dataBillboardQuotRevision.length == 0) {
        resultsNumber = 1;
    } else {
        for (i = 0; i < dataBillboardQuotRevision.length; i++) {
            if (dataBillboardQuotRevision[i].billboard_quotation_id == mainId) {
                revisionQty = revisionQty + 1;
                resultsNumber = revisionQty + 1;
            }
        }
        if (revisionQty == 0) {
            resultsNumber = 1;
        }
    }
    if (resultsNumber < 10) {
        number.value = frontMainNumber + "_rev" + (resultsNumber) + rearMainNumber;
    } else if (resultsNumber < 100) {
        number.value = frontMainNumber + "_rev" + (resultsNumber) + rearMainNumber;
    } else if (resultsNumber < 1000) {
        number.value = frontMainNumber + "_rev" + (resultsNumber) + rearMainNumber;
    } else if (resultsNumber >= 1000) {
        number.value = frontMainNumber + "_rev" + (resultsNumber) + rearMainNumber;
    }
    revisionNumber.innerHTML = number.value;
    revisionNumberPreview.innerHTML = number.value;
}
// Add Quote Revision Number --> end

// Preview --> start
btnPreview.addEventListener('click', function () {
    checkPaymentTerms();
    if (cbBillboardNote3.checked == true && inputBBNote3.value == 0) {
        alert("Free pemasangan belum diinput!! \n Silahkan uncheck atau input free pemasangan");
    } else if (cbBillboardNote4.checked == true && inputBBNote4.value == 0) {
        alert("Free cetak belum diinput!! \n Silahkan uncheck atau input free cetak atau");
    } else if (nolPercent != 0) {
        alert("Ada termin pembayaran 0% !!! \n Silahkan perbaiki termin pembayaran");
    } else if (totalPayment != 100) {
        alert("Total Termin Pembayaran Tidak = 100% !!! \n Silahkan perbaiki termin pembayaran");
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
        attachmentBBPreview.innerHTML = attachmentBillboard.innerText;
        subjectBBPreview.innerHTML = subjectBillboard.innerText;
        clientBBPreview.innerHTML = clientCompany.innerText;
        contactBBPreview.innerHTML = clientContact.innerText;
        contactEmailBBPreview.innerHTML = contactEmail.innerText;
        contactPhoneBBPreview.innerHTML = contactPhone.innerText;
        letterBodyBBPreview.innerHTML = bodyTopBillboard.innerText;

        while (previewBBTBody.hasChildNodes()) {
            previewBBTBody.removeChild(previewBBTBody.firstChild);
        }

        if (aMonth.checked == true) {
            previewBBthAMonth.removeAttribute('hidden');
            previewBBthAMonth.innerHTML = oneMonth.value;
        } else {
            previewBBthAMonth.setAttribute('hidden', 'hidden');
            previewBBthAMonth.innerHTML = oneMonth.value;
        }

        if (quarterYear.checked == true) {
            previewBBthQuarterYear.removeAttribute('hidden');
            previewBBthQuarterYear.innerHTML = threeMonth.value;
        } else {
            previewBBthQuarterYear.setAttribute('hidden', 'hidden');
            previewBBthQuarterYear.innerHTML = threeMonth.value;
        }

        if (halfYear.checked == true) {
            previewBBthHalfYear.removeAttribute('hidden');
            previewBBthHalfYear.innerHTML = sixMonth.value;
        } else {
            previewBBthHalfYear.setAttribute('hidden', 'hidden');
            previewBBthHalfYear.innerHTML = sixMonth.value;
        }

        if (aYear.checked == true) {
            previewBBthAYear.removeAttribute('hidden');
            previewBBthAYear.innerHTML = twelveMonth.value;
        } else {
            previewBBthAYear.setAttribute('hidden', 'hidden');
            previewBBthAYear.innerHTML = twelveMonth.value;
        }

        for (i = 0; i < locations.length; i++) {
            newRow[i] = previewBBTBody.insertRow(i);
            cell[0] = newRow[i].insertCell(0);
            cell[0].innerHTML = i + 1;
            cell[0].classList.add('td-table-preview');
            cell[1] = newRow[i].insertCell(1);
            cell[1].innerHTML = billboardTBody.rows[i].cells[1].innerText;
            cell[1].classList.add('td-table-preview');
            cell[2] = newRow[i].insertCell(2);
            cell[2].innerHTML = billboardTBody.rows[i].cells[2].innerText;
            cell[2].classList.add('text-[0.65rem]');
            cell[2].classList.add('text-teal-700');
            cell[2].classList.add('border');
            cell[3] = newRow[i].insertCell(3);
            cell[3].innerHTML = billboardTBody.rows[i].cells[3].innerText;
            cell[3].classList.add('td-table-preview');
            cell[4] = newRow[i].insertCell(4);
            cell[4].innerHTML = billboardTBody.rows[i].cells[4].innerText;
            cell[4].classList.add('td-table-preview');
            cell[5] = newRow[i].insertCell(5);
            cell[5].innerHTML = billboardTBody.rows[i].cells[5].innerText;
            cell[5].classList.add('td-table-preview');
            cell[6] = newRow[i].insertCell(6);
            cell[6].classList.add('td-table-preview');
            if (aMonth.checked == true) {
                cell[6].removeAttribute('hidden');
                cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[6].children[0].value));
                locations[i].price.periodeMonth.priceMonth = billboardTBody.rows[i].cells[6].children[0].value;
                locations[i].price.periodeMonth.periode = oneMonth.value;
            } else {
                cell[6].setAttribute('hidden', 'hidden');
                cell[6].innerHTML = Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[6].children[0].value));
                locations[i].price.periodeMonth.priceMonth = billboardTBody.rows[i].cells[6].children[0].value;
                locations[i].price.periodeMonth.periode = oneMonth.value;
            }
            cell[7] = newRow[i].insertCell(7);
            cell[7].classList.add('td-table-preview');
            if (quarterYear.checked == true) {
                cell[7].removeAttribute('hidden');
                cell[7].innerHTML = Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[7].children[0].value));
                locations[i].price.periodeQuarter.priceQuarter = billboardTBody.rows[i].cells[7].children[0].value;
                locations[i].price.periodeQuarter.periode = threeMonth.value;
            } else {
                cell[7].setAttribute('hidden', 'hidden');
                cell[7].innerHTML = Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[7].children[0].value));
                locations[i].price.periodeQuarter.priceQuarter = billboardTBody.rows[i].cells[7].children[0].value;
                locations[i].price.periodeQuarter.periode = threeMonth.value;
            }
            cell[8] = newRow[i].insertCell(8);
            cell[8].classList.add('td-table-preview');
            if (halfYear.checked == true) {
                cell[8].removeAttribute('hidden');
                cell[8].innerHTML = Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[8].children[0].value));
                locations[i].price.periodeHalf.priceHalf = billboardTBody.rows[i].cells[8].children[0].value;
                locations[i].price.periodeHalf.periode = sixMonth.value;
            } else {
                cell[8].setAttribute('hidden', 'hidden');
                cell[8].innerHTML = Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[8].children[0].value));
                locations[i].price.periodeHalf.priceHalf = billboardTBody.rows[i].cells[8].children[0].value;
                locations[i].price.periodeHalf.periode = sixMonth.value;
            }
            cell[9] = newRow[i].insertCell(9);
            cell[9].classList.add('td-table-preview');
            if (aYear.checked == true) {
                cell[9].removeAttribute('hidden');
                cell[9].innerHTML = Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[9].children[0].value));
                locations[i].price.periodeYear.priceYear = billboardTBody.rows[i].cells[9].children[0].value;
                locations[i].price.periodeYear.periode = twelveMonth.value;
            } else {
                cell[9].setAttribute('hidden', 'hidden');
                cell[9].innerHTML = Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[9].children[0].value));
                locations[i].price.periodeYear.priceYear = billboardTBody.rows[i].cells[9].children[0].value;
                locations[i].price.periodeYear.periode = twelveMonth.value;
            }
        }
        objBillboards = { locations };
        billboards.value = "";
        billboards.value = JSON.stringify(objBillboards);

        while (previewBBNote.children.length > 11) {
            previewBBNote.removeChild(previewBBNote.children[previewBBNote.children.length - 3]);
        }
        while (previewBBNote7.hasChildNodes()) {
            previewBBNote7.removeChild(previewBBNote7.firstChild);
        }
        console.log(noteQty.value);
        // for (i = 0; i < billboardNote.children.length; i++) {
        for (i = 0; i < Number(noteQty.value); i++) {
            if (i + 1 == 2) {
                labelPreviewBBNote1.innerHTML = inputBBNote1.value;
                if (cbBillboardNote1.checked == true) {
                    previewBBNote1.removeAttribute('hidden');
                    notes[0] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: labelPreviewBBNote1.innerHTML
                    }
                } else {
                    previewBBNote1.setAttribute('hidden', 'hidden');
                    notes[0] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: labelPreviewBBNote1.innerHTML
                    }
                }
            } else if (i + 1 == 3) {
                labelPreviewBBNote2.innerHTML = inputBBNote2.value;
                if (cbBillboardNote2.checked == true) {
                    previewBBNote2.removeAttribute('hidden');
                    notes[1] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: labelPreviewBBNote2.innerHTML
                    }
                } else {
                    previewBBNote2.setAttribute('hidden', 'hidden');
                    notes[1] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: labelPreviewBBNote2.innerHTML
                    }
                }
            } else if (i + 1 == 4) {
                labelPreviewBBNote3.innerHTML = '• Free pemasangan visual ' + inputBBNote3.value + ' ' + labelBBNote3.innerHTML;
                if (cbBillboardNote3.checked == true) {
                    if (inputBBNote4.value == 0) {
                        labelPreviewBBNote3.innerHTML = '• Free pemasangan visual ' + inputBBNote3.value + ' ' + 'x selama kontrak diluar biaya cetak dan design.';
                    }
                    previewBBNote3.removeAttribute('hidden');
                    notes[2] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: labelPreviewBBNote3.innerHTML,
                        freeInstal: inputBBNote3.value
                    }
                } else {
                    previewBBNote3.setAttribute('hidden', 'hidden');
                    notes[2] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: labelPreviewBBNote3.innerHTML,
                        freeInstal: inputBBNote3.value
                    }
                }
            } else if (i + 1 == 5) {
                labelPreviewBBNote4.innerHTML = '• Free cetak materi visual ' + inputBBNote4.value + ' ' + labelBBNote4.innerHTML;
                if (cbBillboardNote4.checked == true) {
                    previewBBNote4.removeAttribute('hidden');
                    notes[3] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: labelPreviewBBNote4.innerHTML,
                        freePrint: inputBBNote4.value
                    }
                } else {
                    previewBBNote4.setAttribute('hidden', 'hidden');
                    notes[3] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: labelPreviewBBNote4.innerHTML,
                        freePrint: inputBBNote4.value
                    }
                }
            } else if (i + 1 == 6) {
                labelPreviewBBNote5.innerHTML = inputBBNote5.value;
                if (cbBillboardNote5.checked == true) {
                    previewBBNote5.removeAttribute('hidden');
                    notes[4] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: labelPreviewBBNote5.innerHTML
                    }
                } else {
                    previewBBNote5.setAttribute('hidden', 'hidden');
                    notes[4] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: labelPreviewBBNote5.innerHTML
                    }
                }
            } else if (i + 1 == 7) {
                labelPreviewBBNote6.innerHTML = inputBBNote6.value;
                if (cbBillboardNote6.checked == true) {
                    previewBBNote6.removeAttribute('hidden');
                    notes[5] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: labelPreviewBBNote6.innerHTML
                    }
                } else {
                    previewBBNote6.setAttribute('hidden', 'hidden');
                    notes[5] = {
                        cbNote: false,
                        labelNote: "",
                        textNote: labelPreviewBBNote6.innerHTML
                    }
                }
            } else if (i + 1 == 8) {
                for (n = 0; n < indexPayment; n++) {
                    const divLabel = document.createElement("div");
                    const labelPayment = document.createElement("label");

                    labelPayment.classList.add("label-payment");
                    labelPayment.innerHTML = '• ' + paymentValue[n].value + ' % ' + paymentNote[n].value;

                    divLabel.appendChild(labelPayment);
                    previewBBNote7.appendChild(divLabel);
                    payment[n] = {
                        termNumber: n + 1,
                        termValue: paymentValue[n].value,
                        termNote: paymentNote[n].value
                    };
                }
                if (cbBillboardNote6.checked == true) {
                    previewBBNote7.removeAttribute('hidden');
                    notes[6] = payment;
                } else {
                    previewBBNote7.setAttribute('hidden', 'hidden');
                    notes[6] = payment;
                }
            } else if (i + 1 == 9) {
                labelPreviewBBNote8.innerHTML = inputBBNote8.value;
                if (cbBillboardNote8.checked == true) {
                    previewBBTArea.removeAttribute('hidden');
                    notes[7] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: labelPreviewBBNote8.innerHTML
                    }
                } else {
                    previewBBTArea.setAttribute('hidden', 'hidden');
                    notes[7] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: labelPreviewBBNote8.innerHTML
                    }
                }
            } else if (i + 1 == 10) {
                labelPreviewBBNote9.innerHTML = inputBBNote9.value;
                if (cbBillboardNote9.checked == true) {
                    previewBBNote9.removeAttribute('hidden');
                    notes[8] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: labelPreviewBBNote9.innerHTML
                    }
                } else {
                    previewBBNote9.setAttribute('hidden', 'hidden');
                    notes[8] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: labelPreviewBBNote9.innerHTML
                    }
                }
            } else if (i + 1 == 11) {
                labelPreviewBBNote10.innerHTML = inputBBNote10.value;
                if (cbBillboardNote10.checked == true) {
                    previewBBNote10.removeAttribute('hidden');
                    notes[9] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: labelPreviewBBNote10.innerHTML
                    }
                } else {
                    previewBBNote10.setAttribute('hidden', 'hidden');
                    notes[9] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: labelPreviewBBNote10.innerHTML
                    }
                }
            } else if (i + 1 > 11 && i < billboardNote.children.length - 1) {
                divPreviewBBNote[i - 11] = document.createElement("div");
                labelPreviewBBNote[i - 11] = document.createElement("label");
                labelPreviewBBNote[i - 11].classList.add("label-preview-bb-note");
                labelPreviewBBNote[i - 11].innerHTML = '-  ' + inputNotes[i - 11].value;
                divPreviewBBNote[i - 11].appendChild(labelPreviewBBNote[i - 11]);
                previewBBNote.insertBefore(divPreviewBBNote[i - 11], previewBBNote.children[previewBBNote.children.length - 2]);

                if (cbNotes[i - 11].checked == true) {
                    notes[i - 1] = {
                        cbNote: true,
                        labelNote: "-",
                        textNote: inputNotes[i - 11].value
                    }
                } else {
                    notes[i - 1] = {
                        cbNote: false,
                        labelNote: "-",
                        textNote: inputNotes[i - 11].value
                    }
                }
            }
        }
        objNote = { notes };
        note.value = "";
        note.value = JSON.stringify(objNote);
        console.log(objNote);
    }
})

// Preview --> end


//Create Image Locations --> start
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
    addressPreview.innerHTML = locations[i].address + " | " + locations[i].area.toUpperCase();
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
    imageMap.setAttribute('src', 'https://maps.googleapis.com/maps/api/staticmap?center=' + locations[i].lat + ',' + locations[i].lng + '&zoom=16&size=476x330&maptype=roadmap&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' + locations[i].lat + ',' + locations[i].lng + '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg');
    qrCodeMapDisplay.classList.add("mb-2");
    qrCodeMapDisplay.classList.add("ml-2");
    qrCodeMapDisplay.classList.add("absolute");
    qrCodeMapDisplay.classList.add("w-[100px]")
    new QRCode(qrCodeMapDisplay, 'https://www.google.co.id/maps/place/' + locations[i].lat + ',' + locations[i].lng + '/@' + locations[i].lat + ',' + locations[i].lng + ',16z');
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
    new QRCode(qrCodeDisplay, "/dashboard/marketing/quotation-revisions/preview/" + locations[i].id);
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
//Create Image Locations --> end

auto.addEventListener('click', function () {
    oneMonth.setAttribute('readonly', 'readonly');
    threeMonth.setAttribute('readonly', 'readonly');
    sixMonth.setAttribute('readonly', 'readonly');
    twelveMonth.setAttribute('readonly', 'readonly');
})

manual.addEventListener('click', function () {
    if (aMonth.checked == true) {
        oneMonth.removeAttribute('readonly');
    } else {
        oneMonth.setAttribute('readonly', 'readonly');
    }
    if (quarterYear.checked == true) {
        threeMonth.removeAttribute('readonly');
    } else {
        threeMonth.setAttribute('readonly', 'readonly');
    }
    if (halfYear.checked == true) {
        sixMonth.removeAttribute('readonly');
    } else {
        sixMonth.setAttribute('readonly', 'readonly');
    }
    if (aYear.checked == true) {
        twelveMonth.removeAttribute('readonly');
    } else {
        twelveMonth.setAttribute('readonly', 'readonly');
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
    showPriceMonth();
    showPriceQuarter();
    showPriceHalf();
    showPriceYear();
    if (aMonth.checked == true) {
        if (manual.checked == true) {
            oneMonth.removeAttribute('readonly');
        }
        thAMonth.removeAttribute('hidden');
    } else {
        oneMonth.setAttribute('readonly', 'readonly');
        oneMonth.value = "1 Bulan";
        thAMonth.innerHTML = "";
        thAMonth.innerHTML = "1 Bulan";
        thAMonth.setAttribute('hidden', 'hidden');
    }
    setColSpan();
    setTableWidth();
})
// aMonth event --> end

// quarter year event --> start
quarterYear.addEventListener('click', function () {
    showPriceMonth();
    showPriceQuarter();
    showPriceHalf();
    showPriceYear();
    if (quarterYear.checked == true) {
        if (manual.checked == true) {
            threeMonth.removeAttribute('readonly');
        }
        thQuarterYear.removeAttribute('hidden');
    } else {
        threeMonth.setAttribute('readonly', 'readonly');
        threeMonth.value = "3 Bulan";
        thQuarterYear.innerHTML = "";
        thQuarterYear.innerHTML = "3 Bulan";
        thQuarterYear.setAttribute('hidden', 'hidden');
    }
    setColSpan();
    setTableWidth();

})
// quarter year event --> end

// half year event --> start
halfYear.addEventListener('click', function () {
    showPriceMonth();
    showPriceQuarter();
    showPriceHalf();
    showPriceYear();
    if (halfYear.checked == true) {
        if (manual.checked == true) {
            sixMonth.removeAttribute('readonly');
        }
        thHalfYear.removeAttribute('hidden');
    } else {
        sixMonth.setAttribute('readonly', 'readonly');
        sixMonth.value = "6 Bulan";
        thHalfYear.innerHTML = "";
        thHalfYear.innerHTML = "6 Bulan";
        thHalfYear.setAttribute('hidden', 'hidden');
    }
    setColSpan();
    setTableWidth();

})
// half year event --> end

// a year event --> start
aYear.addEventListener('click', function () {
    showPriceMonth();
    showPriceQuarter();
    showPriceHalf();
    showPriceYear();
    if (aYear.checked == true) {
        if (manual.checked == true) {
            twelveMonth.removeAttribute('readonly');
        }
        thAYear.removeAttribute('hidden');
    } else {
        twelveMonth.setAttribute('readonly', 'readonly');
        twelveMonth.value = "1 Tahun";
        thAYear.innerHTML = "";
        thAYear.innerHTML = "1 Tahun";
        thAYear.setAttribute('hidden', 'hidden');
    }
    setColSpan();
    setTableWidth();
})
// a year event --> end

btnClosePreview.addEventListener('click', function () {
    modalPreview.classList.remove('flex');
    modalPreview.classList.add('hidden');
});

function deleteRow(r) {
    var n = r.parentNode.parentNode.rowIndex;
    var cellCode = "";
    if (billboardTable.rows[n].cells[1].innerText.substring(4, 5) != "/") {
        cellCode = billboardTable.rows[n].cells[1].innerText.substring(0, 5);
    } else {
        cellCode = billboardTable.rows[n].cells[1].innerText.substring(0, 4);
    }
    if (locations.length > 1) {
        for (i = 0; i < locations.length; i++) {
            if (locations[i].code == cellCode) {
                locations.splice(i, 1);
            }
        }
        billboardTable.deleteRow(n);
    } else {
        alert("Minimal harus ada 1 lokasi, penawaran")
    }
}

addPaymentTerms();
function addPaymentTerms() {
    const obj = JSON.parse(termPayment.value);
    for (i = 0; i < obj.length; i++) {
        divPayment[indexPayment] = document.createElement("div");
        labelPayment[indexPayment] = document.createElement("label");
        paymentValue[indexPayment] = document.createElement("input");
        const percentLabel = document.createElement("label");
        paymentNote[indexPayment] = document.createElement("input");

        labelPayment[indexPayment].innerHTML = "• ";
        labelPayment[indexPayment].classList.add("ml-8");

        paymentValue[indexPayment].setAttribute('type', 'number');
        paymentValue[indexPayment].classList.add("payment-value");
        paymentValue[indexPayment].setAttribute('placeholder', '0');
        paymentValue[indexPayment].setAttribute('min', '0');
        paymentValue[indexPayment].setAttribute('max', '100');

        percentLabel.classList.add("percent-label");
        percentLabel.innerHTML = "%";

        paymentNote[indexPayment].setAttribute('type', 'text');
        paymentNote[indexPayment].setAttribute('placeholder', 'input keterangan');
        paymentNote[indexPayment].classList.add("payment-note");


        paymentValue[indexPayment].value = obj[i].termValue;
        paymentNote[indexPayment].value = obj[i].termNote;

        divPayment[indexPayment].classList.add("flex");
        divPayment[indexPayment].appendChild(labelPayment[indexPayment]);
        divPayment[indexPayment].appendChild(paymentValue[indexPayment]);
        divPayment[indexPayment].appendChild(percentLabel);
        divPayment[indexPayment].appendChild(paymentNote[indexPayment]);

        billboardNote7.insertBefore(divPayment[indexPayment], billboardNote7.lastElementChild);
        indexPayment = indexPayment + 1;
    }
}

addNotes();
function addNotes() {
    const objNotes = JSON.parse(notesAdd.value);

    for (i = 0; i < objNotes.notes.length; i++) {
        if (i > 9) {
            divNotes[indexNotes] = document.createElement("div");
            cbNotes[indexNotes] = document.createElement("input");
            const notesLabel = document.createElement("label");
            inputNotes[indexNotes] = document.createElement("input");

            cbNotes[indexNotes].setAttribute('type', 'checkbox');
            cbNotes[indexNotes].classList.add("ml-1");
            cbNotes[indexNotes].setAttribute('checked', 'checked');

            notesLabel.classList.add("percent-label");
            notesLabel.innerHTML = "-";

            inputNotes[indexNotes].classList.add("payment-note");
            inputNotes[indexNotes].value = objNotes.notes[i].textNote;

            divNotes[indexNotes].classList.add("flex");

            divNotes[indexNotes].appendChild(cbNotes[indexNotes]);
            divNotes[indexNotes].appendChild(notesLabel);
            divNotes[indexNotes].appendChild(inputNotes[indexNotes]);

            billboardNote.insertBefore(divNotes[indexNotes], billboardNote.children[billboardNote.children.length - 3]);

            indexNotes = indexNotes + 1;
        }
    }
}

// Add Payment Terms Button Event --> start
btnAddPayment.addEventListener('click', function () {
    if (indexPayment < 5) {
        divPayment[indexPayment] = document.createElement("div");
        labelPayment[indexPayment] = document.createElement("label");
        paymentValue[indexPayment] = document.createElement("input");
        const percentLabel = document.createElement("label");
        paymentNote[indexPayment] = document.createElement("input");

        labelPayment[indexPayment].innerHTML = "• ";
        labelPayment[indexPayment].classList.add("ml-8");

        paymentValue[indexPayment].setAttribute('type', 'number');
        paymentValue[indexPayment].classList.add("payment-value");
        paymentValue[indexPayment].setAttribute('placeholder', '0');
        paymentValue[indexPayment].setAttribute('min', '0');
        paymentValue[indexPayment].setAttribute('max', '100');

        percentLabel.classList.add("percent-label");
        percentLabel.innerHTML = "%";

        paymentNote[indexPayment].setAttribute('type', 'text');
        paymentNote[indexPayment].setAttribute('placeholder', 'input keterangan');
        paymentNote[indexPayment].classList.add("payment-note");

        divPayment[indexPayment].classList.add("flex");
        divPayment[indexPayment].appendChild(labelPayment[indexPayment]);
        divPayment[indexPayment].appendChild(paymentValue[indexPayment]);
        divPayment[indexPayment].appendChild(percentLabel);
        divPayment[indexPayment].appendChild(paymentNote[indexPayment]);

        billboardNote7.insertBefore(divPayment[indexPayment], billboardNote7.lastElementChild);
        indexPayment = indexPayment + 1;
    } else {
        alert("Maksimal 5 termin pembayaran");
    }
})
// Add Payment Terms Button Event --> end

// Delete Payment Terms Button Event --> start
btnDelPayment.addEventListener('click', function () {
    if (billboardNote7.children.length > 2 && billboardNote7.children.length != 1) {
        billboardNote7.removeChild(billboardNote7.children[billboardNote7.children.length - 2]);
        indexPayment = indexPayment - 1;
    } else {
        alert("MMinimal 1 termin pembayaran");
    }
})
// Delete Payment Terms Button Event --> end

// Add Notes Button Event --> start
btnAddNotes.addEventListener('click', function () {
    if (indexNotes < 3) {
        divNotes[indexNotes] = document.createElement("div");
        cbNotes[indexNotes] = document.createElement("input");
        const notesLabel = document.createElement("label");
        inputNotes[indexNotes] = document.createElement("input");

        cbNotes[indexNotes].setAttribute('type', 'checkbox');
        cbNotes[indexNotes].classList.add("ml-1");
        cbNotes[indexNotes].setAttribute('checked', 'checked');

        notesLabel.classList.add("percent-label");
        notesLabel.innerHTML = "-";

        inputNotes[indexNotes].classList.add("payment-note");
        inputNotes[indexNotes].setAttribute('placeholder', 'input keterangan');

        divNotes[indexNotes].classList.add("flex");

        divNotes[indexNotes].appendChild(cbNotes[indexNotes]);
        divNotes[indexNotes].appendChild(notesLabel);
        divNotes[indexNotes].appendChild(inputNotes[indexNotes]);

        billboardNote.insertBefore(divNotes[indexNotes], billboardNote.children[billboardNote.children.length - 3]);

        indexNotes = indexNotes + 1;
    } else {
        alert("Maksimal tambahan 3 catatan");
    }
})
// Add Notes Button Event --> end

// Delete Notes Button Event --> start
btnDelNotes.addEventListener('click', function () {
    if (billboardNote.children.length > 12) {
        billboardNote.removeChild(billboardNote.children[billboardNote.children.length - 4]);
        indexNotes = indexNotes - 1;
    }
    // if (previewBBNote.children.length > 11) {
    //     previewBBNote.removeChild(previewBBNote.children[previewBBNote.children.length - 2]);
    // }
})
// Delete Notes Button Event --> end

// Checkbox free print Event --> start
cbBillboardNote4.addEventListener('click', function () {
    if (cbBillboardNote4.checked == true) {
        labelBBNote3.innerHTML = "";
        labelBBNote3.innerHTML = "x selama kontrak.";
        inputBBNote4.removeAttribute('readonly');

    } else {
        labelBBNote3.innerHTML = "";
        labelBBNote3.innerHTML = "x selama kontrak diluar biaya cetak dan design.";
        inputBBNote4.setAttribute('readonly', 'readonly');
        inputBBNote4.value = 0;
    }
})
// Checkbox free print Event --> end

// Cek payment terms --> start
function checkPaymentTerms() {
    nolPercent = 0;
    totalPayment = 0;
    for (i = 0; i < indexPayment; i++) {
        if (paymentValue[i].value == 0) {
            nolPercent = nolPercent + 1;
        }
    }
    if (nolPercent == 0) {
        for (i = 0; i < indexPayment; i++) {
            totalPayment = totalPayment + Number(paymentValue[i].value);
        }
    }
}
// Cek payment terms --> end
