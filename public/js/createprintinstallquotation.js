let salesData = [];
let arrayProducts = [];
let newRow = [];
let cell = [];
let selectPrintProduct = [];
let optionPrintProduct = [];
let quotationProducts = [];
let dataProducts = {};
var subTotal = 0;
var salesPpn = 0;
var grandTotal = 0;

const quotationsTBody = document.getElementById("quotationsTBody");
const quotationsPreviewTBody = document.getElementById("quotationsPreviewTBody");
const contactsTBody = document.getElementById("contactsTBody");

const modal = document.getElementById("quotation_modal");
const previewModal = document.getElementById("preview_modal");
const btnCreate = document.getElementById("btnCreate");
const btnCancel = document.getElementById("btnCancel");
const btnPreviewCancel = document.getElementById("btnPreviewCancel");
const btnClose = document.getElementById("btnClose");
const btnChangeContact = document.getElementById("btnChangeContact");
const changeContact = document.getElementById("changeContact");
const clientCompany = document.getElementById("clientCompany");
const clientContact = document.getElementById("clientContact");
const contactEmail = document.getElementById("contactEmail");
const contactPhone = document.getElementById("contactPhone");
const previewClientCompany = document.getElementById("previewClientCompany");
const previewClientContact = document.getElementById("previewClientContact");
const previewContactEmail = document.getElementById("previewContactEmail");
const previewContactPhone = document.getElementById("previewContactPhone");
const btnAddNote = document.getElementById("btnAddNote");
const btnDelNote = document.getElementById("btnDelNote");
const notesQty = document.getElementById("notesQty");
const btnPreview = document.getElementById("btnPreview");
const paymentTerm1 = document.getElementById("paymentTerm1");

// Get Data Print Product --> start
let objPrintProduct = {};
let dataPrintProduct = [];
let printPrice = 0;

function salesCount(){
    subTotal = 0;
    for(let n = 0; n < arrayProducts.length; n++){
        subTotal = subTotal + arrayProducts[n].total;
    }

    salesPpn = (subTotal * 11) / 100;
    grandTotal = salesPpn + subTotal;
}

getDataPrintProduct();
function getDataPrintProduct() {
    const xhrPrintProduct = new XMLHttpRequest();
    const methodPrintProduct = "GET";
    const urlPrintProduct = "/showPrintProduct";

    xhrPrintProduct.open(methodPrintProduct, urlPrintProduct, true);
    xhrPrintProduct.send();

    xhrPrintProduct.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrPrintProduct.readyState === XMLHttpRequest.DONE) {
            const status = xhrPrintProduct.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objPrintProduct = JSON.parse(xhrPrintProduct.responseText);
                dataPrintProduct = objPrintProduct.dataPrintProduct;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}

function getPrintPrice(sel){
    let objProducts = {
        sale_id : "",
        total : 0
    };
    // fillProductData();
    if (salesData.length == 1) {
        for(let i = 0; i < dataPrintProduct.length; i++){
            if(sel.value != 'pilih'){
                if(dataPrintProduct[i].id == sel.value){
                    objProducts.sale_id = sel.name;
                    if(Number(salesData[0].free_install) - Number(salesData[0].used_install) == 0 && Number(salesData[0].free_print) - Number(salesData[0].used_print) == 0){
                        objProducts.total = (dataPrintProduct[i].price * salesData[0].wide) + Number(quotationsTBody.rows[Number(sel.id)+1].cells[3].innerHTML);
                    } else if(Number(salesData[0].free_install) - Number(salesData[0].used_install) > 0 && Number(salesData[0].free_print) - Number(salesData[0].used_print) == 0){
                        objProducts.total = dataPrintProduct[i].price * salesData[0].wide;
                    }
                    arrayProducts[0] = objProducts;

                    salesCount();
                    
                    quotationsTBody.rows[Number(sel.id)].cells[6].innerHTML = dataPrintProduct[i].price;
                    quotationsTBody.rows[Number(sel.id)].cells[7].innerHTML = dataPrintProduct[i].price*salesData[0].wide;
                    quotationsTBody.rows[salesData.length+1].cells[1].innerHTML = subTotal;
                    quotationsTBody.rows[salesData.length+2].cells[1].innerHTML = salesPpn;
                    quotationsTBody.rows[salesData.length+3].cells[1].innerHTML = grandTotal;

                    quotationsPreviewTBody.rows[Number(sel.id)].cells[4].innerHTML = dataPrintProduct[i].name;
                    quotationsPreviewTBody.rows[Number(sel.id)].cells[6].innerHTML = Intl.NumberFormat('en-US').format(dataPrintProduct[i].price);
                    quotationsPreviewTBody.rows[Number(sel.id)].cells[7].innerHTML = Intl.NumberFormat('en-US').format(dataPrintProduct[i].price*salesData[0].wide);
                    quotationsPreviewTBody.rows[salesData.length+1].cells[1].innerHTML = Intl.NumberFormat('en-US').format(subTotal);
                    quotationsPreviewTBody.rows[salesData.length+2].cells[1].innerHTML = Intl.NumberFormat('en-US').format(salesPpn);
                    quotationsPreviewTBody.rows[salesData.length+3].cells[1].innerHTML = Intl.NumberFormat('en-US').format(grandTotal);

                    quotationProducts[0].printProduct = sel.options[sel.selectedIndex].text;
                    quotationProducts[0].print_price = dataPrintProduct[i].price;
                }
            }
        }
    } else {
        for(let i = 0; i < dataPrintProduct.length; i++){
            if(sel.value != 'pilih'){
                if(dataPrintProduct[i].id == sel.value){
                    for(let index = 0; index < salesData.length; index++){
                        if(salesData[index].sale_id == sel.name){
                            objProducts.sale_id = sel.name;
                            var wide = salesData[index].wide;
                            if(Number(salesData[index].free_install) - Number(salesData[index].used_install) == 0 && Number(salesData[index].free_print) - Number(salesData[index].used_print) == 0){
                                objProducts.total = (dataPrintProduct[i].price * salesData[index].wide) + Number(quotationsTBody.rows[Number(sel.id)+1].cells[3].innerHTML);
                            } else if(Number(salesData[index].free_install) - Number(salesData[index].used_install) > 0 && Number(salesData[index].free_print) - Number(salesData[index].used_print) == 0){
                                objProducts.total = dataPrintProduct[i].price * salesData[index].wide;
                            }
                        }
                    }
                    for(let j = 0; j < arrayProducts.length; j++){
                        if(arrayProducts[j].sale_id == sel.name){
                            var getIndex = true;
                            var index = j;
                        } 
                    }

                    if(getIndex == true){
                        arrayProducts[index] = objProducts;
                    } else {
                        arrayProducts.push(objProducts);
                    }
                    
                    salesCount();
                    
                    quotationsTBody.rows[Number(sel.id)].cells[6].innerHTML = dataPrintProduct[i].price;
                    quotationsTBody.rows[Number(sel.id)].cells[7].innerHTML = dataPrintProduct[i].price*wide;
                    quotationsTBody.rows[salesData.length*2].cells[1].innerHTML = subTotal;
                    quotationsTBody.rows[(salesData.length*2)+1].cells[1].innerHTML = salesPpn;
                    quotationsTBody.rows[(salesData.length*2)+2].cells[1].innerHTML = grandTotal;

                    quotationsPreviewTBody.rows[Number(sel.id)].cells[4].innerHTML = dataPrintProduct[i].name;
                    quotationsPreviewTBody.rows[Number(sel.id)].cells[6].innerHTML = Intl.NumberFormat('en-US').format(dataPrintProduct[i].price);
                    quotationsPreviewTBody.rows[Number(sel.id)].cells[7].innerHTML = Intl.NumberFormat('en-US').format(dataPrintProduct[i].price*wide);
                    quotationsPreviewTBody.rows[salesData.length*2].cells[1].innerHTML = Intl.NumberFormat('en-US').format(subTotal);
                    quotationsPreviewTBody.rows[(salesData.length*2)+1].cells[1].innerHTML = Intl.NumberFormat('en-US').format(salesPpn);
                    quotationsPreviewTBody.rows[(salesData.length*2)+2].cells[1].innerHTML = Intl.NumberFormat('en-US').format(grandTotal);

                    for(let index = 0; index < quotationProducts.length; index++){
                        if(quotationProducts[index].sale_id == sel.name){
                            quotationProducts[index].printProduct = sel.options[sel.selectedIndex].text;
                            quotationProducts[index].print_price = dataPrintProduct[i].price;
                        }
                    }
                }
            }
        }
    }
}
// Get Data Print Product --> end

// Get Data Print Price --> start
// let objPrintPrice = {};
// let dataPrintPrice = [];

// getDataPrintPrice();
// function getDataPrintPrice() {
//     const xhrPrintPrice = new XMLHttpRequest();
//     const methodPrintPrice = "GET";
//     const urlPrintPrice = "/showPrintPrice";

//     xhrPrintPrice.open(methodPrintPrice, urlPrintPrice, true);
//     xhrPrintPrice.send();

//     xhrPrintPrice.onreadystatechange = () => {
//         // In local files, status is 0 upon success in Mozilla Firefox
//         if (xhrPrintPrice.readyState === XMLHttpRequest.DONE) {
//             const status = xhrPrintPrice.status;
//             if (status === 0 || (status >= 200 && status < 400)) {
//                 objPrintPrice = JSON.parse(xhrPrintPrice.responseText);
//                 dataPrintPrice = objPrintPrice.dataPrintPrice;
//             } else {
//                 // Oh no! There has been an error with the request!
//             }
//         }
//     }
// }
// Get Data Print Price --> end

// Get Data Contact --> start
let objContact = {};
let dataContact = [];

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

btnCreate.addEventListener("click", function() {
    if(salesData.length == 0){
        alert("Anda belum memilih data penjualan");
    } else if(salesData.length == 1){
        clientCompany.innerHTML = salesData[0].client_company;
        previewClientCompany.innerHTML = salesData[0].client_company;
        if(salesData[0].contact_gender == "Laki-Laki"){
            clientContact.innerHTML = "UP. Bapak " + salesData[0].contact_name;
            previewClientContact.innerHTML = "UP. Bapak " + salesData[0].contact_name;
        } else {
            clientContact.innerHTML = "UP. Ibu " + salesData[0].contact_name;
            previewClientContact.innerHTML = "UP. Ibu " + salesData[0].contact_name;
        }
        contactEmail.innerHTML = salesData[0].contact_email;
        previewContactEmail.innerHTML = salesData[0].contact_email;
        contactPhone.innerHTML = salesData[0].contact_phone;
        previewContactPhone.innerHTML = salesData[0].contact_phone;
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        createRowsTable();
    } else {
        for(let j = 0; j < salesData.length; j++){
            if(salesData[j].client_id == salesData[0].client_id){
                var sameClient = true;
            } else {
                var sameClient = false;
            }
        }
        if(sameClient == true){
            clientCompany.innerHTML = salesData[0].client_company;
            previewClientCompany.innerHTML = salesData[0].client_company;
            if(salesData[0].contact_gender == "Laki-Laki"){
                clientContact.innerHTML = "UP. Bapak " + salesData[0].contact_name;
                previewClientContact.innerHTML = "UP. Bapak " + salesData[0].contact_name;
            } else {
                clientContact.innerHTML = "UP. Ibu " + salesData[0].contact_name;
                previewClientContact.innerHTML = "UP. Ibu " + salesData[0].contact_name;
            }
            contactEmail.innerHTML = salesData[0].contact_email;
            previewContactEmail.innerHTML = salesData[0].contact_email;
            contactPhone.innerHTML = salesData[0].contact_phone;
            previewContactPhone.innerHTML = salesData[0].contact_phone;
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            createRowsTable();
        } else {
            alert("Silahkan pilih data penjualan dengan klien yang sama");
        }
    }
});

btnCancel.addEventListener("click", function() {
    modal.classList.remove("flex");
    modal.classList.add("hidden");
    arrayProducts = [];
});

btnPreviewCancel.addEventListener("click", function() {
    previewModal.classList.remove("flex");
    previewModal.classList.add("hidden");
});

// Button Change Contact Action --> start
let quotationContact = [];

btnChangeContact.addEventListener("click", function() {
    changeContact.classList.remove("hidden");
    changeContact.classList.add("flex");

    quotationContact = [];

    for(let i = 0; i <dataContact.length; i++){
        if(dataContact[i].client_id == salesData[0].client_id){
            let contacts = {
                contact_id : dataContact[i].id,
                contact_name : dataContact[i].name,
                contact_email : dataContact[i].email,
                contact_phone : dataContact[i].phone
            }

            quotationContact.push(contacts);
        }
    }

    while (contactsTBody.hasChildNodes()) {
        contactsTBody.removeChild(contactsTBody.firstChild);
    }

    for(let i = 0; i < quotationContact.length; i++){
        newRow[i] = contactsTBody.insertRow(i);
        cell[0] = newRow[i].insertCell(0);
        cell[0].innerHTML = i + 1;
        cell[0].classList.add('td-print-install');
        cell[1] = newRow[i].insertCell(1);
        cell[1].classList.add('td-address-print-install');

        radioContact = document.createElement('input');
        radioContact.classList.add('outline-none');
        radioContact.setAttribute('type', 'radio');
        radioContact.setAttribute('value', quotationContact[i].id + '-' + quotationContact[i].contact_name + '-'  + quotationContact[i].contact_email + '-' + quotationContact[i].contact_phone);
        radioContact.setAttribute('onclick', 'radioFunction(this)');

        labelContact = document.createElement('label');
        labelContact.classList.add("ml-2");
        labelContact.innerHTML = quotationContact[i].contact_name;


        cell[1].appendChild(radioContact);
        cell[1].appendChild(labelContact);
        // cell[1].innerHTML = quotationContact[i].contact_name;
        cell[2] = newRow[i].insertCell(2);
        cell[2].innerHTML = quotationContact[i].contact_email;
        cell[2].classList.add('td-print-install');
        cell[3] = newRow[i].insertCell(3);
        cell[3].innerHTML = quotationContact[i].contact_phone;
        cell[3].classList.add('td-print-install');
    }
});
// Button Change Contact Action --> end

// Button CLose Action --> start
btnClose.addEventListener("click", function() {
    changeContact.classList.remove("flex");
    changeContact.classList.add("hidden");
});
// Button CLose Action --> end

// Button Add Note Action --> start
btnAddNote.addEventListener("click", function() {
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
btnDelNote.addEventListener("click", function() {
    if (notesQty.children.length > 1) {
        notesQty.removeChild(notesQty.lastChild);
    } else {
        alert("Tidak ada catatan tambahan yang dapat dihapus");
    }
});
// Button Remove Last Note Action --> end

// Button Preview Action --> start
btnPreview.addEventListener("click", function() {
    var selectPrint = true;
    for(let i = 0; i < quotationProducts.length; i++){
        if(quotationProducts[i].print == true && quotationProducts[i].printProduct == ""){
            selectPrint = false;
        }
    }
    if(selectPrint == false){
        alert("Bahan cetak belum di pilih");
    } else {
        previewModal.classList.remove("hidden");
        previewModal.classList.add("flex");
        products.value = JSON.stringify(dataProducts);   
        console.log(dataProducts);
    }
});
// Button Preview Action --> end

// Function Get Sales Data --> start
function getSalesData(sel) {
    var data = sel.value;
    var arrayData = data.split(")(");
    let objSalesData = {
        sale_id : arrayData[0],
        billboard_id : arrayData[1],
        billboard_code : arrayData[2],
        billboard_address : arrayData[3],
        wide : arrayData[4],
        diff_print : arrayData[5],
        diff_install : arrayData[6],
        install_price : arrayData[7],
        install_type : arrayData[8],
        contact_id : arrayData[9],
        client_id : arrayData[10],
        client_company : arrayData[11],
        contact_name : arrayData[12],
        contact_phone : arrayData[13],
        contact_email : arrayData[14],
        contact_gender : arrayData[15],
        free_print : arrayData[16],
        used_print : arrayData[17],
        free_install : arrayData[18],
        used_install : arrayData[19]
    };
    if (salesData.lenght == 0) {
        salesData[0] = objSalesData;
    } else {
        if (sel.checked == true) {
            salesData.push(objSalesData);
        } else {
            for (let i = 0; i < salesData.length; i++) {
                if (salesData[i].sale_id == objSalesData.sale_id) {
                    salesData.splice(i, 1);
                }
            }
        }
    }
    fillProductData();
}
// Function Get Sales Data --> end

// Fill data --> start
function fillProductData() {
    quotationProducts = [];
    for(let i = 0; i < salesData.length; i++){
        quotationProducts[i] = {
            sale_id: salesData[i].sale_id,
            billboard_id: salesData[i].billboard_id,
            billboard_code: salesData[i].billboard_code,
            billboard_address: salesData[i].billboard_address,
            print: false,
            install: false,
            wide: Number(salesData[i].wide),
            print_price: 0,
            printProduct: "",
            free_print: Number(salesData[i].free_print),
            used_print: Number(salesData[i].used_print),
            install_price: Number(salesData[i].install_price),
            installProduct: salesData[i].install_type,
            free_install: Number(salesData[i].free_install),
            used_install: Number(salesData[i].used_install),
            notes: [],
            paymentTerms:[paymentTerm1.value]
        };

        if (Number(salesData[i].free_install) - Number(salesData[i].used_install) == 0) {
            quotationProducts[i].install = true;
        } else {
            quotationProducts[i].install = false;
        }
    
        if (Number(salesData[i].free_print) - Number(salesData[i].used_print) == 0) {
            quotationProducts[i].print = true;
        } else {
            quotationProducts[i].print = false;
        }
    
        for (let j = 0; j < notesQty.children.length; j++) {
            if (notesQty.children[j].children[1].value != "") {
                quotationProducts[i].notes[j] = notesQty.children[j].children[1].value;
            }
        }
    }

    dataProducts = {quotationProducts};
}
// Fill data --> end

// Function Create Row Table --> start
function createRowsTable() {
    let i =0;
    while (quotationsTBody.hasChildNodes()) {
        quotationsTBody.removeChild(quotationsTBody.firstChild);
    }
    while (quotationsPreviewTBody.hasChildNodes()) {
        quotationsPreviewTBody.removeChild(quotationsPreviewTBody.firstChild);
    }
    for (i = 0; i < salesData.length; i++) {
        if(i == 0){
            // Function Quotation Create Row Table --> start
            newRow[i] = quotationsTBody.insertRow(i);
            cell[0] = newRow[i].insertCell(0);
            cell[0].innerHTML = i + 1;
            cell[0].classList.add('td-print-install');
            cell[0].setAttribute('rowspan', '2');
            cell[1] = newRow[i].insertCell(1);
            cell[1].innerHTML = "Cetak";
            cell[1].classList.add('td-print-install');
            cell[2] = newRow[i].insertCell(2);
            cell[2].innerHTML = salesData[i].billboard_code;
            cell[2].classList.add('td-print-install');
            cell[2].setAttribute('rowspan', '2');
            cell[3] = newRow[i].insertCell(3);
            cell[3].innerHTML = salesData[i].billboard_address;
            cell[3].classList.add('td-address-print-install');
            cell[3].setAttribute('rowspan', '2');
            cell[4] = newRow[i].insertCell(4);
            cell[4].classList.add('td-print-install');
            if(Number(salesData[i].free_print) - Number(salesData[i].used_print) == 0){
                selectPrintProduct[i] = document.createElement('select');
                selectPrintProduct[i].classList.add('select-print-product');
                var nOption = 0;
                optionPrintProduct[nOption] = document.createElement('option');
                optionPrintProduct[nOption].appendChild(document.createTextNode(['-- pilih --']));
                optionPrintProduct[nOption].value = 'pilih';
                selectPrintProduct[i].appendChild(optionPrintProduct[nOption]);
                for(let n = 0; n < dataPrintProduct.length; n++){
                    if(dataPrintProduct[n].type == salesData[i].install_type){
                        nOption++;
                        optionPrintProduct[nOption] = document.createElement('option');
                        optionPrintProduct[nOption].value = dataPrintProduct[n].id;
                        optionPrintProduct[nOption].appendChild(document.createTextNode([dataPrintProduct[n].name]));
                        selectPrintProduct[i].appendChild(optionPrintProduct[nOption]);
                    }
                }
                selectPrintProduct[i].setAttribute('id',i);
                selectPrintProduct[i].setAttribute('name',salesData[i].sale_id);
                selectPrintProduct[i].setAttribute('onchange', 'getPrintPrice(this)');
                cell[4].appendChild(selectPrintProduct[i]);
                cell[5] = newRow[i].insertCell(5);
                cell[5].innerHTML = salesData[i].wide;
                cell[5].setAttribute('rowspan', '2');
                cell[5].classList.add('td-print-install');
                cell[6] = newRow[i].insertCell(6);
                cell[6].classList.add('td-price-print-install');
                cell[7] = newRow[i].insertCell(7);
                cell[7].classList.add('td-price-print-install');
            } else{
                cell[4].innerHTML = "Free";
                cell[5] = newRow[i].insertCell(5);
                cell[5].innerHTML = salesData[i].wide;
                cell[5].setAttribute('rowspan', '2');
                cell[5].classList.add('td-print-install');
                cell[6] = newRow[i].insertCell(6);
                cell[6].classList.add('td-print-install');
                cell[6].innerHTML = "Free";
                cell[7] = newRow[i].insertCell(7);
                cell[7].classList.add('td-print-install');
                cell[7].innerHTML = "Free ke " + (Number(salesData[i].used_print) + 1) + " dari " + salesData[i].free_print; 

                let objProducts = {
                    sale_id : "",
                    total : 0
                };
                if(Number(salesData[i].free_install) - Number(salesData[i].used_install) == 0){
                    objProducts.sale_id = salesData[i].sale_id;
                    objProducts.total = salesData[i].install_price * salesData[i].wide;
                    arrayProducts.push(objProducts);
                } else {
                    objProducts.sale_id = salesData[i].sale_id;
                    objProducts.total = 0;
                    arrayProducts.push(objProducts);
                }
            }

            newRow[i+1] = quotationsTBody.insertRow(i+1);
            cell[0] = newRow[i+1].insertCell(0);
            cell[0].innerHTML = "Pasang";
            cell[0].classList.add('td-print-install');
            if(Number(salesData[i].free_install) - Number(salesData[i].used_install) == 0){
                cell[1] = newRow[i+1].insertCell(1);
                cell[1].innerHTML = salesData[i].install_type;
                cell[1].classList.add('td-print-install');
                cell[2] = newRow[i+1].insertCell(2);
                cell[2].innerHTML = salesData[i].install_price;
                cell[2].classList.add('td-price-print-install');
                cell[3] = newRow[i+1].insertCell(3);
                cell[3].innerHTML = Number(salesData[i].wide)*Number(salesData[i].install_price);
                cell[3].classList.add('td-price-print-install');    
            } else {
                cell[1] = newRow[i+1].insertCell(1);
                cell[1].innerHTML = "Free";
                cell[1].classList.add('td-print-install');
                cell[2] = newRow[i+1].insertCell(2);
                cell[2].innerHTML = "Free";
                cell[2].classList.add('td-print-install');
                cell[3] = newRow[i+1].insertCell(3);
                cell[3].innerHTML = "Free ke "+ (Number(salesData[i].used_install) + 1) + " dari " + salesData[i].free_install;
                cell[3].classList.add('td-print-install');    
            }
            // Function Quotation Create Row Table --> end

            // Function Quotation Preview Row Table --> start
            newRow[i] = quotationsPreviewTBody.insertRow(i);
            cell[0] = newRow[i].insertCell(0);
            cell[0].innerHTML = i + 1;
            cell[0].classList.add('td-print-install');
            cell[0].setAttribute('rowspan', '2');
            cell[1] = newRow[i].insertCell(1);
            cell[1].innerHTML = "Cetak";
            cell[1].classList.add('td-print-install');
            cell[2] = newRow[i].insertCell(2);
            cell[2].innerHTML = salesData[i].billboard_code;
            cell[2].classList.add('td-print-install');
            cell[2].setAttribute('rowspan', '2');
            cell[3] = newRow[i].insertCell(3);
            cell[3].innerHTML = salesData[i].billboard_address;
            cell[3].classList.add('td-address-print-install');
            cell[3].setAttribute('rowspan', '2');
            cell[4] = newRow[i].insertCell(4);
            cell[4].classList.add('td-print-install');
            if(Number(salesData[i].free_print) - Number(salesData[i].used_print) == 0){
                cell[5] = newRow[i].insertCell(5);
                cell[5].innerHTML = salesData[i].wide;
                cell[5].setAttribute('rowspan', '2');
                cell[5].classList.add('td-print-install');
                cell[6] = newRow[i].insertCell(6);
                cell[6].classList.add('td-price-print-install');
                cell[7] = newRow[i].insertCell(7);
                cell[7].classList.add('td-price-print-install');
            } else{
                cell[4].innerHTML = "Free";
                cell[5] = newRow[i].insertCell(5);
                cell[5].innerHTML = salesData[i].wide;
                cell[5].setAttribute('rowspan', '2');
                cell[5].classList.add('td-print-install');
                cell[6] = newRow[i].insertCell(6);
                cell[6].classList.add('td-print-install');
                cell[6].innerHTML = "Free";
                cell[7] = newRow[i].insertCell(7);
                cell[7].classList.add('td-print-install');
                cell[7].innerHTML = "Free ke " + (Number(salesData[i].used_print) + 1) + " dari " + salesData[i].free_print; 
            }

            newRow[i+1] = quotationsPreviewTBody.insertRow(i+1);
            cell[0] = newRow[i+1].insertCell(0);
            cell[0].innerHTML = "Pasang";
            cell[0].classList.add('td-print-install');
            if(Number(salesData[i].free_install) - Number(salesData[i].used_install) == 0){
                cell[1] = newRow[i+1].insertCell(1);
                cell[1].innerHTML = salesData[i].install_type;
                cell[1].classList.add('td-print-install');
                cell[2] = newRow[i+1].insertCell(2);
                cell[2].innerHTML = salesData[i].install_price;
                cell[2].classList.add('td-price-print-install');
                cell[3] = newRow[i+1].insertCell(3);
                cell[3].innerHTML = Number(salesData[i].wide)*Number(salesData[i].install_price);
                cell[3].classList.add('td-price-print-install');    
            } else {
                cell[1] = newRow[i+1].insertCell(1);
                cell[1].innerHTML = "Free";
                cell[1].classList.add('td-print-install');
                cell[2] = newRow[i+1].insertCell(2);
                cell[2].innerHTML = "Free";
                cell[2].classList.add('td-print-install');
                cell[3] = newRow[i+1].insertCell(3);
                cell[3].innerHTML = "Free ke "+ (Number(salesData[i].used_install) + 1) + " dari " + salesData[i].free_install;
                cell[3].classList.add('td-print-install');    
            }
            // Function Quotation Preview Row Table --> end
        } else {
            // Function Quotation Create Row Table --> start
            newRow[2*i] = quotationsTBody.insertRow(2*i);
            cell[0] = newRow[2*i].insertCell(0);
            cell[0].innerHTML = i + 1;
            cell[0].classList.add('td-print-install');
            cell[0].setAttribute('rowspan', '2');
            cell[1] = newRow[2*i].insertCell(1);
            cell[1].innerHTML = "Cetak";
            cell[1].classList.add('td-print-install');
            cell[2] = newRow[2*i].insertCell(2);
            cell[2].innerHTML = salesData[i].billboard_code;
            cell[2].classList.add('td-print-install');
            cell[2].setAttribute('rowspan', '2');
            cell[3] = newRow[2*i].insertCell(3);
            cell[3].innerHTML = salesData[i].billboard_address;
            cell[3].classList.add('td-address-print-install');
            cell[3].setAttribute('rowspan', '2');
            cell[4] = newRow[2*i].insertCell(4);
            cell[4].classList.add('td-print-install');
            if(Number(salesData[i].free_print) - Number(salesData[i].used_print) == 0){
                selectPrintProduct[i] = document.createElement('select');
                selectPrintProduct[i].classList.add('select-print-product');
                var nOption = 0;
                optionPrintProduct[nOption] = document.createElement('option');
                optionPrintProduct[nOption].appendChild(document.createTextNode(['-- pilih --']));
                optionPrintProduct[nOption].value = 'pilih';
                selectPrintProduct[i].appendChild(optionPrintProduct[nOption]);
                for(let n = 0; n < dataPrintProduct.length; n++){
                    if(dataPrintProduct[n].type == salesData[i].install_type){
                        nOption++;
                        optionPrintProduct[nOption] = document.createElement('option');
                        optionPrintProduct[nOption].value = dataPrintProduct[n].id;
                        optionPrintProduct[nOption].appendChild(document.createTextNode([dataPrintProduct[n].name]));
                        selectPrintProduct[i].appendChild(optionPrintProduct[nOption]);
                    }
                }
                selectPrintProduct[i].setAttribute('id',2*i);
                selectPrintProduct[i].setAttribute('name',salesData[i].sale_id);
                selectPrintProduct[i].setAttribute('onchange', 'getPrintPrice(this)');
                cell[4].appendChild(selectPrintProduct[i]);
                cell[5] = newRow[2*i].insertCell(5);
                cell[5].innerHTML = salesData[i].wide;
                cell[5].setAttribute('rowspan', '2');
                cell[5].classList.add('td-print-install');
                cell[6] = newRow[2*i].insertCell(6);
                cell[6].innerHTML = "";
                cell[6].classList.add('td-price-print-install');
                cell[7] = newRow[2*i].insertCell(7);
                cell[7].innerHTML = "";
                cell[7].classList.add('td-price-print-install');
            } else {
                cell[4].innerHTML = "Free";
                cell[5] = newRow[2*i].insertCell(5);
                cell[5].innerHTML = salesData[i].wide;
                cell[5].setAttribute('rowspan', '2');
                cell[5].classList.add('td-print-install');
                cell[6] = newRow[2*i].insertCell(6);
                cell[6].innerHTML = "";
                cell[6].classList.add('td-print-install');
                cell[6].innerHTML = "Free";
                cell[7] = newRow[2*i].insertCell(7);
                cell[7].innerHTML = "";
                cell[7].classList.add('td-print-install');
                cell[7].innerHTML = "Free ke " + (Number(salesData[i].used_print) + 1) + " dari " + salesData[i].free_print; 

                let objProducts = {
                    sale_id : "",
                    total : 0
                };
                if(Number(salesData[i].free_install) - Number(salesData[i].used_install) == 0){
                    objProducts.sale_id = salesData[i].sale_id;
                    objProducts.total = salesData[i].install_price * salesData[i].wide;
                    arrayProducts.push(objProducts);
                } else {
                    objProducts.sale_id = salesData[i].sale_id;
                    objProducts.total = 0;
                    arrayProducts.push(objProducts);
                }
            }

            newRow[(2*i)+1] = quotationsTBody.insertRow((2*i)+1);
            cell[0] = newRow[(2*i)+1].insertCell(0);
            cell[0].innerHTML = "Pasang";
            cell[0].classList.add('td-print-install');
            if(Number(salesData[i].free_install) - Number(salesData[i].used_install) == 0){
                cell[1] = newRow[(2*i)+1].insertCell(1);
                cell[1].innerHTML = salesData[i].install_type;
                cell[1].classList.add('td-print-install');
                cell[2] = newRow[(2*i)+1].insertCell(2);
                cell[2].innerHTML = salesData[i].install_price;
                cell[2].classList.add('td-price-print-install');
                cell[3] = newRow[(2*i)+1].insertCell(3);
                cell[3].innerHTML = Number(salesData[i].wide)*Number(salesData[i].install_price);
                cell[3].classList.add('td-price-print-install');   
            } else {
                cell[1] = newRow[(2*i)+1].insertCell(1);
                cell[1].innerHTML = "Free";
                cell[1].classList.add('td-print-install');
                cell[2] = newRow[(2*i)+1].insertCell(2);
                cell[2].innerHTML = "Free";
                cell[2].classList.add('td-print-install');
                cell[3] = newRow[(2*i)+1].insertCell(3);
                cell[3].innerHTML = "Free ke "+ (Number(salesData[i].used_install) + 1) + " dari " + salesData[i].free_install;
                cell[3].classList.add('td-print-install'); 
            }
            // Function Quotation Create Row Table --> end

            // Function Quotation Preview Row Table --> start
            newRow[2*i] = quotationsPreviewTBody.insertRow(2*i);
            cell[0] = newRow[2*i].insertCell(0);
            cell[0].innerHTML = i + 1;
            cell[0].classList.add('td-print-install');
            cell[0].setAttribute('rowspan', '2');
            cell[1] = newRow[2*i].insertCell(1);
            cell[1].innerHTML = "Cetak";
            cell[1].classList.add('td-print-install');
            cell[2] = newRow[2*i].insertCell(2);
            cell[2].innerHTML = salesData[i].billboard_code;
            cell[2].classList.add('td-print-install');
            cell[2].setAttribute('rowspan', '2');
            cell[3] = newRow[2*i].insertCell(3);
            cell[3].innerHTML = salesData[i].billboard_address;
            cell[3].classList.add('td-address-print-install');
            cell[3].setAttribute('rowspan', '2');
            cell[4] = newRow[2*i].insertCell(4);
            cell[4].classList.add('td-print-install');
            if(Number(salesData[i].free_print) - Number(salesData[i].used_print) == 0){
                cell[5] = newRow[2*i].insertCell(5);
                cell[5].innerHTML = salesData[i].wide;
                cell[5].setAttribute('rowspan', '2');
                cell[5].classList.add('td-print-install');
                cell[6] = newRow[2*i].insertCell(6);
                cell[6].innerHTML = "";
                cell[6].classList.add('td-price-print-install');
                cell[7] = newRow[2*i].insertCell(7);
                cell[7].innerHTML = "";
                cell[7].classList.add('td-price-print-install');
            } else {
                cell[4].innerHTML = "Free";
                cell[5] = newRow[2*i].insertCell(5);
                cell[5].innerHTML = salesData[i].wide;
                cell[5].setAttribute('rowspan', '2');
                cell[5].classList.add('td-print-install');
                cell[6] = newRow[2*i].insertCell(6);
                cell[6].innerHTML = "";
                cell[6].classList.add('td-print-install');
                cell[6].innerHTML = "Free";
                cell[7] = newRow[2*i].insertCell(7);
                cell[7].innerHTML = "";
                cell[7].classList.add('td-print-install');
                cell[7].innerHTML = "Free ke " + (Number(salesData[i].used_print) + 1) + " dari " + salesData[i].free_print; 
            }

            newRow[(2*i)+1] = quotationsPreviewTBody.insertRow((2*i)+1);
            cell[0] = newRow[(2*i)+1].insertCell(0);
            cell[0].innerHTML = "Pasang";
            cell[0].classList.add('td-print-install');
            if(Number(salesData[i].free_install) - Number(salesData[i].used_install) == 0){
                cell[1] = newRow[(2*i)+1].insertCell(1);
                cell[1].innerHTML = salesData[i].install_type;
                cell[1].classList.add('td-print-install');
                cell[2] = newRow[(2*i)+1].insertCell(2);
                cell[2].innerHTML = salesData[i].install_price;
                cell[2].classList.add('td-price-print-install');
                cell[3] = newRow[(2*i)+1].insertCell(3);
                cell[3].innerHTML = Number(salesData[i].wide)*Number(salesData[i].install_price);
                cell[3].classList.add('td-price-print-install');   
            } else {
                cell[1] = newRow[(2*i)+1].insertCell(1);
                cell[1].innerHTML = "Free";
                cell[1].classList.add('td-print-install');
                cell[2] = newRow[(2*i)+1].insertCell(2);
                cell[2].innerHTML = "Free";
                cell[2].classList.add('td-print-install');
                cell[3] = newRow[(2*i)+1].insertCell(3);
                cell[3].innerHTML = "Free ke "+ (Number(salesData[i].used_install) + 1) + " dari " + salesData[i].free_install;
                cell[3].classList.add('td-print-install'); 
            }
            // Function Quotation Preview Row Table --> end
        }
    }
    if(i == 1){
        // Function Quotation Create Row Table --> start
        salesCount();
        newRow[i+1] = quotationsTBody.insertRow(i+1);
        cell[0] = newRow[i+1].insertCell(0);
        cell[0].innerHTML = "SUB TOTAL";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[i+1].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].innerHTML = subTotal;

        newRow[i+2] = quotationsTBody.insertRow(i+2);
        cell[0] = newRow[i+2].insertCell(0);
        cell[0].innerHTML = "PPN 11%";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[i+2].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].innerHTML = salesPpn;

        newRow[i+3] = quotationsTBody.insertRow(i+3);
        cell[0] = newRow[i+3].insertCell(0);
        cell[0].innerHTML = "GRAND TOTAL";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[i+3].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].innerHTML = grandTotal;
        // Function Quotation Create Row Table --> end

        // Function Quotation Preview Row Table --> start
        newRow[i+1] = quotationsPreviewTBody.insertRow(i+1);
        cell[0] = newRow[i+1].insertCell(0);
        cell[0].innerHTML = "SUB TOTAL";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[i+1].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].innerHTML = subTotal;

        newRow[i+2] = quotationsPreviewTBody.insertRow(i+2);
        cell[0] = newRow[i+2].insertCell(0);
        cell[0].innerHTML = "PPN 11%";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[i+2].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].innerHTML = salesPpn;

        newRow[i+3] = quotationsPreviewTBody.insertRow(i+3);
        cell[0] = newRow[i+3].insertCell(0);
        cell[0].innerHTML = "GRAND TOTAL";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[i+3].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].innerHTML = grandTotal;
        // Function Quotation Preview Row Table --> end
    } else if(i > 1){
        // Function Quotation Create Row Table --> start
        salesCount();
        newRow[2*i] = quotationsTBody.insertRow(2*i);
        cell[0] = newRow[2*i].insertCell(0);
        cell[0].innerHTML = "SubTotal";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[2*i].insertCell(1);
        cell[1].classList.add('td-price-print-install');
        cell[1].classList.add('font-semibold');
        cell[1].innerHTML = subTotal;

        newRow[(2*i)+1] = quotationsTBody.insertRow((2*i)+1);
        cell[0] = newRow[(2*i)+1].insertCell(0);
        cell[0].innerHTML = "PPN 11%";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[(2*i)+1].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].classList.add('font-semibold');
        cell[1].innerHTML = salesPpn;

        newRow[(2*i)+2] = quotationsTBody.insertRow((2*i)+2);
        cell[0] = newRow[(2*i)+2].insertCell(0);
        cell[0].innerHTML = "GRAND TOTAL";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[(2*i)+2].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].classList.add('font-semibold');
        cell[1].innerHTML = grandTotal;
        // Function Quotation Create Row Table --> end

        // Function Quotation Preview Row Table --> start
        newRow[2*i] = quotationsPreviewTBody.insertRow(2*i);
        cell[0] = newRow[2*i].insertCell(0);
        cell[0].innerHTML = "SubTotal";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[2*i].insertCell(1);
        cell[1].classList.add('td-price-print-install');
        cell[1].classList.add('font-semibold');
        cell[1].innerHTML = subTotal;

        newRow[(2*i)+1] = quotationsPreviewTBody.insertRow((2*i)+1);
        cell[0] = newRow[(2*i)+1].insertCell(0);
        cell[0].innerHTML = "PPN 11%";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[(2*i)+1].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].classList.add('font-semibold');
        cell[1].innerHTML = salesPpn;

        newRow[(2*i)+2] = quotationsPreviewTBody.insertRow((2*i)+2);
        cell[0] = newRow[(2*i)+2].insertCell(0);
        cell[0].innerHTML = "GRAND TOTAL";
        cell[0].classList.add('td-price-print-install');
        cell[0].classList.add('font-semibold');
        cell[0].setAttribute('colspan', '7');
        cell[1] = newRow[(2*i)+2].insertCell(1);
        cell[1].classList.add('font-semibold');
        cell[1].classList.add('td-price-print-install');
        cell[1].classList.add('font-semibold');
        cell[1].innerHTML = grandTotal;
        // Function Quotation Preview Row Table --> end
    }
}
// Function Create Row Table --> end

// Radio Function Action --> start
function radioFunction(sel) {
    var radioValueArray = sel.value.split("-");
    // contactId.value = radioValueArray[0];
    clientContact.innerHTML = "";
    clientContact.innerHTML = radioValueArray[1];
    previewClientContact.innerHTML = "";
    previewClientContact.innerHTML = radioValueArray[1];
    contactEmail.innerHTML = "";
    contactEmail.innerHTML = radioValueArray[2];
    previewContactEmail.innerHTML = "";
    previewContactEmail.innerHTML = radioValueArray[2];
    contactPhone.innerHTML = "";
    contactPhone.innerHTML = radioValueArray[3];
    previewContactPhone.innerHTML = "";
    previewContactPhone.innerHTML = radioValueArray[3];
}
// Radio Function Action --> end