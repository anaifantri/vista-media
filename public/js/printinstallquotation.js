const modal = document.getElementById("quotation_modal");
const previewModal = document.getElementById("preview_modal");
const btnCreate = document.getElementById("btnCreate");
const btnCancel = document.getElementById("btnCancel");
const btnPreviewCancel = document.getElementById("btnPreviewCancel");
const btnClose = document.getElementById("btnClose");
const btnChangeContact = document.getElementById("btnChangeContact");
const changeContact = document.getElementById("changeContact");
const clientContact = document.getElementById("clientContact");
const contactEmail = document.getElementById("contactEmail");
const contactPhone = document.getElementById("contactPhone");
const clientPreviewContact = document.getElementById("clientContact");
const contactPreviewEmail = document.getElementById("contactEmail");
const contactPreviewPhone = document.getElementById("contactPhone");
const btnAddNote = document.getElementById("btnAddNote");
const btnDelNote = document.getElementById("btnDelNote");
const notesQty = document.getElementById("notesQty");
const btnPreview = document.getElementById("btnPreview");

const printingProduct = document.getElementById("printing_product");
const printingProductPreview = document.getElementById("printingProductPreview");
const widePrint = document.getElementById("widePrint");
const widePrintPreview = document.getElementById("widePrintPreview");
const printingPrice = document.getElementById("printing_price");
const printingPricePreview = document.getElementById("printingPricePreview");
const totalPrint = document.getElementById("totalPrint");
const totalPrintPreview = document.getElementById("totalPrintPreview");
const printingProductName = document.getElementById("printing_product_name");
const usedPrint = document.getElementById("usedPrint");
const freePrint = document.getElementById("freePrint");


const installationProduct = document.getElementById("installation_product");
const installationProductPreview = document.getElementById("installationProductPreview");
const wideInstal = document.getElementById("wideInstal");
const wideInstalPreview = document.getElementById("wideInstalPreview");
const instalPrice = document.getElementById("instal_price");
const tdInstallPrice = document.getElementById("installPrice");
const installPricePreview = document.getElementById("installPricePreview");
const totalInstall = document.getElementById("total_install");
const tdTotalInstall = document.getElementById("totalInstal");
const totalInstalPreview = document.getElementById("totalInstalPreview");
const usedInstall = document.getElementById("usedInstall");
const freeInstall = document.getElementById("freeInstall");

const subTotal = document.getElementById("subTotal");
const subTotalPreview = document.getElementById("subTotalPreview");
const ppnValue = document.getElementById("ppnValue");
const ppnValuePreview = document.getElementById("ppnValuePreview");
const grandTotalPreview = document.getElementById("grandTotalPreview");
const diffPrint = document.getElementById("diffPrint");
const diffInstal = document.getElementById("diffInstal");

const saleId = document.getElementById("sale_id");
const billboardId = document.getElementById("billboard_id");
const billboardcode = document.getElementById("billboard_code");
const billboardAddress = document.getElementById("billboard_address");
const companyId = document.getElementById("company_id");
const contactId = document.getElementById("contact_id");
const clientId = document.getElementById("client_id");
const products = document.getElementById("products");
const notesPreview = document.getElementById("notesPreview");

btnCreate.addEventListener("click", function () {
    modal.classList.remove("hidden");
    modal.classList.add("flex");
});

btnCancel.addEventListener("click", function () {
    modal.classList.remove("flex");
    modal.classList.add("hidden");
});

btnPreviewCancel.addEventListener("click", function () {
    previewModal.classList.remove("flex");
    previewModal.classList.add("hidden");
});

// Button Change Contact Action --> start
btnChangeContact.addEventListener("click", function () {
    changeContact.classList.remove("hidden");
    changeContact.classList.add("flex");
});
// Button Change Contact Action --> end

// Button CLose Action --> start
btnClose.addEventListener("click", function () {
    changeContact.classList.remove("flex");
    changeContact.classList.add("hidden");
});
// Button CLose Action --> end

// Radio Function Action --> start
function radioFunction(sel) {
    var radioValueArray = sel.value.split("-");
    contactId.value = radioValueArray[0];
    clientContact.innerHTML = "";
    clientContact.innerHTML = radioValueArray[1];
    contactEmail.innerHTML = "";
    contactEmail.innerHTML = radioValueArray[2];
    contactPhone.innerHTML = "";
    contactPhone.innerHTML = radioValueArray[3];
    clientPreviewContact.innerHTML = "";
    clientPreviewContact.innerHTML = radioValueArray[1];
    contactPreviewEmail.innerHTML = "";
    contactPreviewEmail.innerHTML = radioValueArray[2];
    contactPreviewPhone.innerHTML = "";
    contactPreviewPhone.innerHTML = radioValueArray[3];
}
// Radio Function Action --> end

// Button Add Note Action --> start
btnAddNote.addEventListener("click", function () {
    if (notesQty.children.length < 5) {
        const divNotes = document.createElement("div");
        const labelNotes = document.createElement("label");
        const inputNotes = document.createElement("textarea");
        divNotes.classList.add("flex");
        labelNotes.classList.add("ml-1");
        labelNotes.classList.add("text-sm");
        labelNotes.innerHTML = "-";
        inputNotes.classList.add("text-area-notes");
        inputNotes.setAttribute("placeholder", "input catatan");
        inputNotes.setAttribute("rows", "1");

        divNotes.appendChild(labelNotes);
        divNotes.appendChild(inputNotes);

        notesQty.appendChild(divNotes);
    } else {
        alert("Maksimal 5 catatan");
    }
});
// Button Add Note Action --> end

// Button Remove Last Note Action --> start
btnDelNote.addEventListener("click", function () {
    if (notesQty.children.length > 0) {
        notesQty.removeChild(notesQty.lastChild);
    } else {
        alert("Tidak ada catatan");
    }
});
// Button Remove Last Note Action --> end

// Button Preview Action --> start
btnPreview.addEventListener("click", function () {
    if (printingProduct.value == "-pilih-" && diffPrint.value == 0) {
        alert("Bahan cetak belum di pilih");
    } else {
        previewModal.classList.remove("hidden");
        previewModal.classList.add("flex");
        fillProductData();
    }
});
// Button Preview Action --> end

// Fill data --> start
function fillProductData() {
    var noteIndex = 0;
    let items = {
        sale_id: saleId.value,
        billboard_id: billboardId.value,
        billboard_code: billboardcode.value,
        billboard_address: billboardAddress.value,
        print: true,
        install: true,
        wide: Number(widePrint.innerHTML),
        print_price: Number(printingPrice.value),
        printProduct: printingProductName.value,
        free_print: Number(freePrint.value),
        used_print: Number(usedPrint.value),
        install_price: instalPrice.value,
        installProduct: installationProduct.innerText,
        free_install: Number(freeInstall.value),
        used_install: Number(usedInstall),
        notes: []
    };

    let quotationProducts = [];
    quotationProducts[0] = items;

    if (totalInstall.value == 0) {
        quotationProducts[0].install = false;
    } else {
        quotationProducts[0].install = true;
    }

    if (Number(totalPrint.innerHTML) == 0) {
        quotationProducts[0].print = false;
    } else {
        quotationProducts[0].print = true;
    }

    for (i = 0; i < notesQty.children.length; i++) {
        if (notesQty.children[i].children[1].value != "") {
            quotationProducts[0].notes[noteIndex] =
                notesQty.children[i].children[1].value;
            noteIndex++;
        }
    }

    printingProductPreview.innerHTML = quotationProducts[0].printProduct;
    widePrintPreview.innerHTML = quotationProducts[0].wide;
    printingPricePreview.innerHTML = quotationProducts[0].print_price;
    totalPrintPreview.innerHTML =
        quotationProducts[0].print_price * quotationProducts[0].wide;

    installationProductPreview.innerHTML = quotationProducts[0].installProduct;
    wideInstalPreview.innerHTML = quotationProducts[0].wide;
    // installPricePreview.innerHTML = quotationProducts[0].install_price;
    installPricePreview.innerHTML = tdInstallPrice.innerHTML;
    // totalInstalPreview.innerHTML = quotationProducts[0].install_price * quotationProducts[0].wide;
    totalInstalPreview.innerHTML = tdTotalInstall.innerHTML;

    subTotalPreview.innerHTML =
        quotationProducts[0].print_price * quotationProducts[0].wide +
        quotationProducts[0].install_price * quotationProducts[0].wide;
    ppnValuePreview.innerHTML =
        ((quotationProducts[0].print_price * quotationProducts[0].wide +
            quotationProducts[0].install_price * quotationProducts[0].wide) *
            11) /
        100;

    grandTotalPreview.innerHTML =
        Number(subTotalPreview.innerHTML) + Number(ppnValuePreview.innerHTML);

    while (notesPreview.hasChildNodes()) {
        notesPreview.removeChild(notesPreview.firstChild);
    }

    for (i = 0; i < quotationProducts[0].notes.length; i++) {
        const divNotes = document.createElement("div");
        const labelNotes = document.createElement("label");
        const inputNotes = document.createElement("textarea");
        divNotes.classList.add("flex");
        labelNotes.classList.add("ml-1");
        labelNotes.classList.add("text-sm");
        labelNotes.innerHTML = "-";
        inputNotes.classList.add("text-area-notes");
        inputNotes.setAttribute("placeholder", "input catatan");
        inputNotes.setAttribute("rows", "1");
        inputNotes.innerHTML = quotationProducts[0].notes[i];

        divNotes.appendChild(labelNotes);
        divNotes.appendChild(inputNotes);

        notesPreview.appendChild(divNotes);
    }

    let dataProducts = {quotationProducts};

    products.value = JSON.stringify(dataProducts);
}
// Fill data --> end

// Get Printing Product --> start
function getPrintingProduct(sel) {
    var valuePriceArray = sel.value.split("-");
    var printProduct = valuePriceArray[2];
    var printPrice = valuePriceArray[1];

    printingPrice.value = Number(printPrice);
    printingProductName.value = printProduct;

    totalPrint.innerHTML = Number(printPrice) * Number(widePrint.innerHTML);
    subTotal.innerHTML =
        Number(totalPrint.innerHTML) + Number(totalInstall.value);
    ppnValue.innerHTML = (Number(subTotal.innerHTML) * 11) / 100;
    grandTotal.innerHTML =
        Number(subTotal.innerHTML) + Number(ppnValue.innerHTML);
}
// Get Printing Product --> end
