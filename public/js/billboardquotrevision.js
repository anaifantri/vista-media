// Declaration Quotation Create --> start
const number = document.getElementById("number");
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
const cbBillboardNote01 = document.getElementById("cbBillboardNote01");
const inputBBNote01 = document.getElementById("inputBBNote01");
const billboardTBody = document.getElementById("billboardTBody");
// Declaration Quotation Create --> end

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
const lablePreviewBBNote08 = document.getElementById("lablePreviewBBNote08");
const previewBBNote09 = document.getElementById("previewBBNote09");
const inputPreviewBBNote09 = document.getElementById("inputPreviewBBNote09");
const previewBBNote10 = document.getElementById("previewBBNote10");
const inputPreviewBBNote10 = document.getElementById("inputPreviewBBNote10");
const locationsImage = document.getElementById("locationsImage");
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

let mainId = 0;

const date = new Date();
const year = date.getFullYear();
let month = "";
// var getMainNumber = mainNumber.textContent;
var frontMainNumber = mainNumber.textContent.slice(0, 4);
var rearMainNumber = mainNumber.textContent.substring(4);
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

    if (setColumn == 1 || setColumn == 2) {
        tableWidth.classList.add('w-[650px]');
        tableWidth.classList.remove('w-[725px]');
        previewTableWidth.classList.add('w-[650px]');
        previewTableWidth.classList.remove('w-[725px]');
    } else {
        tableWidth.classList.add('w-[725px]');
        tableWidth.classList.remove('w-[650px]');
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
                    if (dataBillboardQuotation[i].number == mainNumber.textContent) {
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
    subjectBBPreview.innerHTML = subjectBillboard.textContent;
    clientBBPreview.innerHTML = clientCompany.textContent;
    contactBBPreview.innerHTML = clientContact.textContent;
    contactEmailBBPreview.innerHTML = contactEmail.textContent;
    contactPhoneBBPreview.innerHTML = contactPhone.textContent;
    letterBodyBBPreview.innerHTML = bodyTopBillboard.textContent;

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
        cell[1].innerHTML = billboardTBody.rows[i].cells[1].textContent;
        cell[1].classList.add('td-table-preview');
        cell[2] = newRow[i].insertCell(2);
        cell[2].innerHTML = billboardTBody.rows[i].cells[2].textContent;
        cell[2].classList.add('text-[0.65rem]');
        cell[2].classList.add('text-teal-700');
        cell[2].classList.add('border');
        cell[3] = newRow[i].insertCell(3);
        cell[3].innerHTML = billboardTBody.rows[i].cells[3].textContent;
        cell[3].classList.add('td-table-preview');
        cell[4] = newRow[i].insertCell(4);
        cell[4].innerHTML = billboardTBody.rows[i].cells[4].textContent;
        cell[4].classList.add('td-table-preview');
        cell[5] = newRow[i].insertCell(5);
        cell[5].innerHTML = billboardTBody.rows[i].cells[5].textContent;
        cell[5].classList.add('td-table-preview');
        cell[6] = newRow[i].insertCell(6);
        cell[6].classList.add('td-table-preview');
        if (aMonth.checked == true) {
            cell[6].removeAttribute('hidden');
            cell[6].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[6].children[0].value)) + ',-';
            locations[i].price.periodeMonth.priceMonth = billboardTBody.rows[i].cells[6].children[0].value;
            locations[i].price.periodeMonth.periode = thAMonth.textContent;
        } else {
            cell[6].setAttribute('hidden', 'hidden');
            cell[6].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[6].children[0].value)) + ',-';
            locations[i].price.periodeMonth.priceMonth = billboardTBody.rows[i].cells[6].children[0].value;
            locations[i].price.periodeMonth.periode = thAMonth.textContent;
        }
        cell[7] = newRow[i].insertCell(7);
        cell[7].classList.add('td-table-preview');
        if (quarterYear.checked == true) {
            cell[7].removeAttribute('hidden');
            cell[7].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[7].children[0].value)) + ',-';
            locations[i].price.periodeQuarter.priceQuarter = billboardTBody.rows[i].cells[7].children[0].value;
            locations[i].price.periodeQuarter.periode = thQuarterYear.textContent;
        } else {
            cell[7].setAttribute('hidden', 'hidden');
            cell[7].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[7].children[0].value)) + ',-';
            locations[i].price.periodeQuarter.priceQuarter = billboardTBody.rows[i].cells[7].children[0].value;
            locations[i].price.periodeQuarter.periode = thQuarterYear.textContent;
        }
        cell[8] = newRow[i].insertCell(8);
        cell[8].classList.add('td-table-preview');
        if (halfYear.checked == true) {
            cell[8].removeAttribute('hidden');
            cell[8].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[8].children[0].value)) + ',-';
            locations[i].price.periodeHalf.priceHalf = billboardTBody.rows[i].cells[8].children[0].value;
            locations[i].price.periodeHalf.periode = thQuarterYear.textContent;
        } else {
            cell[8].setAttribute('hidden', 'hidden');
            cell[8].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[8].children[0].value)) + ',-';
            locations[i].price.periodeHalf.priceHalf = billboardTBody.rows[i].cells[8].children[0].value;
            locations[i].price.periodeHalf.periode = thQuarterYear.textContent;
        }
        cell[9] = newRow[i].insertCell(9);
        cell[9].classList.add('td-table-preview');
        if (aYear.checked == true) {
            cell[9].removeAttribute('hidden');
            cell[9].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[9].children[0].value)) + ',-';
            locations[i].price.periodeYear.priceYear = billboardTBody.rows[i].cells[9].children[0].value;
            locations[i].price.periodeYear.periode = thAYear.textContent;
        } else {
            cell[9].setAttribute('hidden', 'hidden');
            cell[9].innerHTML = 'Rp. ' + Intl.NumberFormat('en-US').format(Number(billboardTBody.rows[i].cells[9].children[0].value)) + ',-';
            locations[i].price.periodeYear.priceYear = billboardTBody.rows[i].cells[9].children[0].value;
            locations[i].price.periodeYear.periode = thAYear.textContent;
        }
    }
    objBillboards = { locations };
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
    for (i = 0; i < locations.length; i++) {
        if (locations[i].code == cellCode) {
            locations.splice(i, 1);
        }
    }
    billboardTable.deleteRow(n);
}