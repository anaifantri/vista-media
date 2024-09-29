//const client & contact
const contactId = document.getElementById("contact_id");
const clientCompany = document.getElementById("clientCompany");
const createClientContact = document.getElementById("createClientContact");
const createContactEmail = document.getElementById("createContactEmail");
const createContactPhone = document.getElementById("createContactPhone");
const divContact = document.getElementById("divContact");

//const notes
const btnAddNote = document.getElementById("btnAddNote");
const btnDelNote = document.getElementById("btnDelNote");
const notesQty = document.getElementById("notesQty");
const btnAddPayment = document.getElementById("btnAddPayment");
const btnDelPayment = document.getElementById("btnDelPayment");
const paymentTerms = document.getElementById("paymentTerms");

//const preview check
const btnPreview = document.getElementById("btnPreview");
const createNumber = document.getElementById("createNumber");
const labelNumber = document.getElementById("labelNumber");
const modalPreview = document.getElementById("modalPreview");
const btnClose = document.getElementById("btnClose");

//const select client
const selectClient = document.getElementById("selectClient");
const clientList = document.getElementById("clientList");
const dataClient = document.getElementById("dataClient");
const search = document.getElementById("search");
const clientListTable = document.getElementById("clientListTable");

//const data
const price = document.getElementById("price");
const createBodyTop = document.getElementById("createBodyTop");
const createBodyEnd = document.getElementById("createBodyEnd");
const createAttachment = document.getElementById("createAttachment");
const createSubject = document.getElementById("createSubject");

let companyClient = {}
let personalClient = {}
let clientType = "";

// Set Current Scroll --> start
document.addEventListener("DOMContentLoaded", function(event) { 
    var scrollpos = localStorage.getItem('scrollpos');
    if (scrollpos) window.scrollTo(0, scrollpos);
});

window.onbeforeunload = function(e) {
    localStorage.setItem('scrollpos', window.scrollY);
};
// Set Current Scroll --> end

// Search Client --> start
function searchTable() {
    var filter, tr, td1, i, txtValue1;
    filter = search.value.toUpperCase();
    tr = clientListTable.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("td")[0];
        if (td1) {
            txtValue1 = td1.innerText;
            if (txtValue1.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
// Search Client --> end

//Select Client Action --> start
function selectClientAction(e){
    e.stopPropagation();
    clientList.classList.toggle("hidden");
}

var mainWrapper = document.getElementById("main-wrapper");
var mainHeader = document.getElementById("main-header");

mainWrapper.addEventListener('click', function () {
    clientList.classList.add("hidden");
    search.value = "";
    searchTable();
}, false);

mainHeader.addEventListener('click', function () {
    clientList.classList.add("hidden");
    search.value = "";
    searchTable();
}, false);

getSelect = (sel) => {
    var clientItems = sel.title.split("-")
    dataClient.value = sel.innerText;
    clientList.classList.add("hidden");
    search.value = "";
    searchTable();

    if(clientItems[1] == "Perorangan"){
        companyClient = {};
        divContact.classList.remove("flex");
        divContact.classList.add("hidden");
        contactId.setAttribute('disabled', 'disabled');
        clientCompany.classList.remove('flex');
        clientCompany.classList.add('hidden');
        personalClient = {
            type : clientItems[1],
            id : sel.id,
            name : clientItems[2],
            address : clientItems[5],
            email : clientItems[4],
            phone : clientItems[3]
        }
        createContactEmail.innerHTML = clientItems[4];
        createContactPhone.innerHTML = clientItems[3];
        createClientContact.innerHTML = clientItems[2];
        clientType = "Perorangan";
    }else if(clientItems[1] == "Perusahaan"){
        personalClient = {};
        divContact.classList.remove("hidden");
        divContact.classList.add("flex");
        contactId.removeAttribute('disabled');
        clientCompany.classList.add('flex');
        clientCompany.classList.remove('hidden');
        companyClient.type = clientItems[1];
        companyClient.id = sel.id;
        companyClient.name = clientItems[2];
        companyClient.company = clientItems[0];
        companyClient.address = clientItems[5];
        clientCompany.innerHTML = "";
        clientCompany.innerHTML = clientItems[0];
        createContactEmail.innerHTML = "-";
        createContactPhone.innerHTML = "-";
        createClientContact.innerHTML = "-";
        clientType = "Perusahaan";
    }
    showContact();    
}
//Select Client Action --> end

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

// Show Contact --> start
function showContact() {
    if(clientType == "Perusahaan"){
        while (contactId.hasChildNodes()) {
            contactId.removeChild(contactId.firstChild);
        }
        const optionContact = [];
        optionContact[0] = document.createElement('option');
        optionContact[0].appendChild(document.createTextNode(['Pilih Kontak']));
        optionContact[0].value = "pilih";
        contactId.appendChild(optionContact[0]);
    
        for (i = 0; i < dataContact.length; i++) {
            if (dataContact[i]['client_id'] == companyClient.id) {
                optionContact[i + 1] = document.createElement('option');
                optionContact[i + 1].appendChild(document.createTextNode(dataContact[i]['name']));
                optionContact[i + 1].setAttribute('value', dataContact[i]['id']);
                contactId.appendChild(optionContact[i + 1]);
            }
        }
    }
}
// Show Contact --> start

// Get Contact --> start
function getContact(sel) {
    for (i = 0; i < dataContact.length; i++) {
        if (dataContact[i]['name'] == sel.options[sel.selectedIndex].text) {
            if (dataContact[i]['gender'] == 'Male') {
                createClientContact.innerHTML = 'UP. Bapak ' + sel.options[sel.selectedIndex].text;
            } else if (dataContact[i]['gender'] == 'Female') {
                createClientContact.innerHTML = 'UP. Ibu ' + sel.options[sel.selectedIndex].text;
            }
            companyClient.contact_gender = dataContact[i]['gender'];
            companyClient.contact_name = dataContact[i]['name'];
            companyClient.contact_email = dataContact[i]['email'];
            companyClient.contact_phone = dataContact[i]['phone'];
            createContactEmail.innerHTML = dataContact[i]['email'];
            createContactPhone.innerHTML = dataContact[i]['phone'];
            console.log(companyClient);
        }
    }
}
// Get Contact --> end

// Button Add Note Action --> start
btnAddNote.addEventListener("click", function() {
    if (notesQty.children.length < 10) {
        const divNotes = document.createElement("div");
        const inputNotes = document.createElement("textarea");
        divNotes.classList.add("flex");
        inputNotes.classList.add("text-area-notes");
        inputNotes.value = "- ";
        inputNotes.setAttribute("rows", "1");

        divNotes.appendChild(inputNotes);

        // notesQty.appendChild(divNotes);
        notesQty.insertBefore(divNotes, notesQty.children[notesQty.children.length - 1]);
        inputNotes.focus();
    } else {
        alert("Maksimal tambahan 3 catatan");
    }
});
// Button Add Note Action --> end

// Button Remove Last Note Action --> start
btnDelNote.addEventListener("click", function() {
    if (notesQty.children.length > 7) {
        notesQty.removeChild(notesQty.children[notesQty.children.length - 2]);
    } else {
        alert("Tidak ada tambahan catatan yang bisa dihapus");
    }
});
// Button Remove Last Note Action --> end

// Button Add Payment Action --> start
btnAddPayment.addEventListener("click", function() {
    if (paymentTerms.children.length < 4) {
        const divPayment = document.createElement("div");
        const labelPayment = document.createElement("label");
        const termOfPayment = document.createElement("input");
        const paymentDescription = document.createElement("textarea");
        divPayment.classList.add("flex");

        labelPayment.classList.add("ml-1");
        labelPayment.classList.add("text-sm");
        labelPayment.innerHTML = "-";

        termOfPayment.setAttribute('min', 0);
        termOfPayment.setAttribute('max', 100);
        termOfPayment.setAttribute('type', 'number');
        termOfPayment.setAttribute('value', 0);
        termOfPayment.setAttribute('required', 'required');
        termOfPayment.classList.add('term-of-payment');

        paymentDescription.classList.add("text-area-notes");
        paymentDescription.value = "%";
        paymentDescription.setAttribute("rows", "1");

        divPayment.appendChild(labelPayment);
        divPayment.appendChild(termOfPayment);
        divPayment.appendChild(paymentDescription);

        paymentTerms.appendChild(divPayment);
        termOfPayment.focus();
    } else {
        alert("Maksimal 4 termin pembayaran");
    }
});
// Button Add Payment Action --> end

// Button Remove Last Payment Action --> start
btnDelPayment.addEventListener("click", function() {
    if (paymentTerms.children.length > 1) {
        paymentTerms.removeChild(paymentTerms.lastChild);
    } else {
        alert("Minimal 1 termin pembayaran");
    }
});
// Button Remove Last Payment Action --> end

// Button Preview Action --> start
btnPreview.addEventListener("click", function(){
    const category = document.getElementById("category");
    if(numberCheck() == true){
        if(clientCheck() == false) {
            alert("Silahkan pilih klien dan kontak");
        } else {
            if (paymentCheck() == true) {
                modalPreview.classList.remove("hidden");
                getNotes();
                getPayments();
                if(category.value == "Billboard"){
                    getBillboardPrice();
                } else if(category.value == "Signage"){
                    if(category.name == "Videotron"){
                        getVideotronPrice();
                    }else{
                        getBillboardPrice();
                    }
                }else{
                    getVideotronPrice();
                }
                fillData();
            }
        }
    }
})
// Button Preview Action --> end

// Button Close Action --> start
btnClose.addEventListener("click", function(){
    modalPreview.classList.add("hidden");
})
// Button Close Action --> end

// Function Number Check --> start
numberCheck = () => {
    const number = document.getElementById("createNumber");
    if(number.value == ""){
        alert('Silahkan masukkan nomor penawaran terlebih dahulu');
        number.focus();
    }else{
        return true
    }
  }
// Function Number Check --> end
// Function Client Check --> start
clientCheck = () => {
    if(clientType == ""){
        return false;
    } else if(clientType == "Perusahaan"){
        if(contactCheck() == false){
            return false;
        } else if(contactCheck() == true){
            return true;
        }
    }else{
        return true
    }
  }
// Function Client Check --> end

// Function Contact Check --> start
contactCheck = () => {
    if(contactId.value == "pilih"){
        return false;
    } else {
        return true;
    }
  }
// Function Contact Check --> end

// Function Payment Check --> start
paymentCheck = () => {
    var payment = 0;
    for (let i = 0; i < paymentTerms.children.length; i++) {
        if(paymentTerms.children[i].children[1].value == 0){
            payment = 0;
            alert("Silahkan input termin pembayaran yang masih kosong");
            paymentTerms.children[i].children[1].focus();
            return false;
        } else {
            payment = payment + Number(paymentTerms.children[i].children[1].value);
        }
    }
    if(payment != 100){
        alert("Total termin pembayaran tidak sama dengan 100%, silahkan sesuaikan lagi termin pembayaran");
        payment = 0;
        paymentTerms.children[0].children[1].focus();
    } else {
        return true;
    }
}
// Function Payment Check --> end

// Function Fill Data --> start
fillData = () => {
    document.getElementById("previewNumber").innerHTML  = createNumber.value + labelNumber.innerText;
    document.getElementById("number").value = createNumber.value + labelNumber.innerText;
    document.getElementById("previewAttachment").innerHTML  = createAttachment.innerText;
    document.getElementById("attachment").value = createAttachment.innerText;
    document.getElementById("previewSubject").innerHTML  = createSubject.innerText;
    document.getElementById("subject").value = createSubject.innerText;
    document.getElementById("previewSubject").innerHTML  = createSubject.innerText;
    if(clientType == "Perorangan"){
        document.getElementById("clients").value = JSON.stringify(personalClient);
        document.getElementById("previewClientContact").innerHTML = personalClient.name;
        document.getElementById("previewEmail").innerHTML = personalClient.email;
        document.getElementById("previewPhone").innerHTML = personalClient.phone;
    }else if(clientType == "Perusahaan"){
        document.getElementById("clients").value = JSON.stringify(companyClient);
        document.getElementById("previewClientCompany").innerHTML = companyClient.company;
        document.getElementById("previewClientContact").innerHTML = companyClient.name;
        document.getElementById("previewEmail").innerHTML = companyClient.contact_email;
        document.getElementById("previewPhone").innerHTML = companyClient.contact_phone;
    }
    document.getElementById("previewBodyTop").value = createBodyTop.value;
    document.getElementById("body_top").value = createBodyTop.value;
    document.getElementById("previewBodyEnd").value = createBodyEnd.value;
    document.getElementById("body_end").value = createBodyEnd.value;
    
}
// Function Fill Data --> 

// Function Get Note --> start
getNotes = () => {
    const notes = document.getElementById("notes");
    const previewNotesQty = document.getElementById("previewNotesQty");
    const category = document.getElementById("category");
    let objNotes = {};
    let dataNotes = []; 
    var freePrint = 0;
    var freeInstall = 0;   

    while (previewNotesQty.hasChildNodes()) {
        previewNotesQty.removeChild(previewNotesQty.firstChild);
    }

    for(let i = 0; i < notesQty.children.length; i++){
        if(category.value == "Billboard"){
            if(i == 2 || i == 3){
                if(notesQty.children[i].children[1].value != 0){
                    if(i == 2){
                        freeInstall = notesQty.children[i].children[1].value;
                        dataNotes.push(notesQty.children[i].children[0].innerText + " " + notesQty.children[i].children[1].value  + " "  + notesQty.children[i].children[2].innerText);
                    }
                    if(i == 3){
                        freePrint = notesQty.children[i].children[1].value;
                        dataNotes.push(notesQty.children[i].children[0].innerText + " " + notesQty.children[i].children[1].value  + " "  + notesQty.children[i].children[2].innerText);
                    }
                }
            } else{
                dataNotes.push(notesQty.children[i].children[0].value);
            }
        }else if(category.value == "Signage"){
            if(document.getElementById("signageType").value != "Videotron"){
                if(i == 2 || i == 3){
                    if(notesQty.children[i].children[1].value != 0){
                        if(i == 2){
                            freeInstall = notesQty.children[i].children[1].value;
                            dataNotes.push(notesQty.children[i].children[0].innerText + " " + notesQty.children[i].children[1].value  + " "  + notesQty.children[i].children[2].innerText);
                        }
                        if(i == 3){
                            freePrint = notesQty.children[i].children[1].value;
                            dataNotes.push(notesQty.children[i].children[0].innerText + " " + notesQty.children[i].children[1].value  + " "  + notesQty.children[i].children[2].innerText);
                        }
                    }
                } else{
                    dataNotes.push(notesQty.children[i].children[0].value);
                }
            } else {
                dataNotes.push(notesQty.children[i].children[0].value);
            }
        }else{
            dataNotes.push(notesQty.children[i].children[0].value);
        }
    }
    
    for(let i = 0; i < dataNotes.length; i++){
        const divNotes = document.createElement("div");
        const labelNotes = document.createElement("label");
        
        divNotes.classList.add("flex");
        labelNotes.classList.add("flex");
        labelNotes.classList.add("text-xs");
        labelNotes.classList.add("text-black");

        if(category.value == "Billboard"){
            if(freeInstall != 0 && freePrint != 0) {
                if(i == 2 || i == 3 || i == 4){
                    labelNotes.classList.add("ml-4");
                }
            }else if((freeInstall == 0 && freePrint != 0) || (freeInstall != 0 && freePrint == 0)){
                if(i == 2 || i == 3){
                    labelNotes.classList.add("ml-4");
                }
            } else if(freeInstall == 0 && freePrint == 0){
                if(i == 2){
                    labelNotes.classList.add("ml-4");
                }
            } else{
                labelNotes.classList.add("ml-1");
            }
        } else if(category.value == "Signage"){
            if(category.name == "Videotron"){
                if(i == 2 || i == 3 ){
                    labelNotes.classList.add("ml-4");
                } else {
                    labelNotes.classList.add("ml-1");
                }
            }else{
                if(freeInstall != 0 && freePrint != 0) {
                    if(i == 2 || i == 3 || i == 4){
                        labelNotes.classList.add("ml-4");
                    }
                }else if((freeInstall == 0 && freePrint != 0) || (freeInstall != 0 && freePrint == 0)){
                    if(i == 2 || i == 3){
                        labelNotes.classList.add("ml-4");
                    }
                } else if(freeInstall == 0 && freePrint == 0){
                    if(i == 2){
                        labelNotes.classList.add("ml-4");
                    }
                } else{
                    labelNotes.classList.add("ml-1");
                }
            }
            
        }else{
            if(i == 2 || i == 3 ){
                labelNotes.classList.add("ml-4");
            } else {
                labelNotes.classList.add("ml-1");
            }
        }
       

        labelNotes.innerHTML = dataNotes[i];

        divNotes.appendChild(labelNotes);
        previewNotesQty.appendChild(divNotes);
    }

    objNotes = {dataNotes, freePrint, freeInstall};
    console.log(objNotes);
    notes.value = JSON.stringify(objNotes);
}
// Function Get Note --> end

// Function Get Payment Terms --> start
getPayments = () => {
    const terms = document.getElementById("payment_terms");
    const previewPaymentTerms = document.getElementById("previewPaymentTerms");
    let objPayments = {};
    let dataPayments = [];

    while (previewPaymentTerms.hasChildNodes()) {
        previewPaymentTerms.removeChild(previewPaymentTerms.firstChild);
    }

    for(let i = 0; i < paymentTerms.children.length; i++){
            dataPayments[i] = {
                term : paymentTerms.children[i].children[1].value,
                note : paymentTerms.children[i].children[2].value,
            }

            const divTerms = document.createElement("div");
            const labelTerms = document.createElement("label");
            
            divTerms.classList.add("flex");
            labelTerms.classList.add("flex");
            labelTerms.classList.add("text-xs");
            labelTerms.classList.add("ml-1");
            labelTerms.classList.add("text-black");

            labelTerms.innerHTML = '- ' + paymentTerms.children[i].children[1].value + ' ' + paymentTerms.children[i].children[2].value;

            divTerms.appendChild(labelTerms);
            previewPaymentTerms.appendChild(divTerms);
    }

    objPayments = {dataPayments};
    terms.value = JSON.stringify(objPayments);
}
// Function Get Payment Terms --> end

// Function Get Billboard Price --> start
getBillboardPrice = () => {
    const thPrice = document.getElementById("thPrice");
    const divTable = document.getElementById("divTable");
    const cbBillboardTitle = document.querySelectorAll('[id=cbBillboardTitle]');
    const thTitle = document.querySelectorAll('[id=thTitle]');
    const billboardTitle = document.querySelectorAll('[id=billboardTitle]');
    const billboardPriceMonth = document.querySelectorAll('[id=billboardPriceMonth]');
    const tdPriceMonth = document.querySelectorAll('[id=tdPriceMonth]');
    const billboardPriceQuarter = document.querySelectorAll('[id=billboardPriceQuarter]');
    const tdPriceQuarter = document.querySelectorAll('[id=tdPriceQuarter]');
    const billboardPriceHalf = document.querySelectorAll('[id=billboardPriceHalf]');
    const tdPriceHalf = document.querySelectorAll('[id=tdPriceHalf]');
    const billboardPriceYear = document.querySelectorAll('[id=billboardPriceYear]');
    const tdPriceYear = document.querySelectorAll('[id=tdPriceYear]');
    
    let objPrice = {};
    let dataPrice = [];
    let dataTitle = [];
    let dataPriceMonth = [];
    let dataPriceQuarter = [];
    let dataPriceHalf = [];
    let dataPriceYear = [];
    var colSpan = 4;
    
    for(let i = 0; i < billboardPriceMonth.length; i++){
        dataPriceMonth[i] = {
            code : billboardPriceMonth[i].name,
            price : Number(billboardPriceMonth[i].value)
        }
        dataPriceQuarter[i] = {
            code : billboardPriceQuarter[i].name,
            price : Number(billboardPriceQuarter[i].value)
        }
        dataPriceHalf[i] = {
            code : billboardPriceHalf[i].name,
            price : Number(billboardPriceHalf[i].value)
        }
        dataPriceYear[i] = {
            code : billboardPriceYear[i].name,
            price : Number(billboardPriceYear[i].value)
        }
    }

    dataPrice[0] = dataPriceMonth;
    dataPrice[1] = dataPriceQuarter;
    dataPrice[2] = dataPriceHalf;
    dataPrice[3] = dataPriceYear;

    for (let i = 0; i < cbBillboardTitle.length; i++){
        dataTitle[i] = {
            checkbox : cbBillboardTitle[i].checked,
            title : billboardTitle[i].value
        }
    }

    objPrice = {dataTitle, dataPrice};
    price.value = JSON.stringify(objPrice);

    for(let i = 0; i < dataTitle.length; i++){
        if(dataTitle[i].checkbox == true){
            thTitle[i].innerHTML = dataTitle[i].title;
            thTitle[i].removeAttribute('hidden');
            if(i == 0){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceMonth[n].innerHTML = dataPriceMonth[n].price.toLocaleString();
                    tdPriceMonth[n].removeAttribute('hidden');
                }
            } else if(i == 1){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceQuarter[n].innerHTML = dataPriceQuarter[n].price.toLocaleString();
                    tdPriceQuarter[n].removeAttribute('hidden');
                }
            }else if(i == 2){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceHalf[n].innerHTML = dataPriceHalf[n].price.toLocaleString();
                    tdPriceHalf[n].removeAttribute('hidden');
                }
            }else if(i == 3){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceYear[n].innerHTML = dataPriceYear[n].price.toLocaleString();
                    tdPriceYear[n].removeAttribute('hidden');
                }   
            }
        }else{
            colSpan = colSpan - 1;
            thTitle[i].setAttribute('hidden', 'hidden');
            if(i == 0){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceMonth[n].setAttribute('hidden', 'hidden');
                }
            } else if(i == 1){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceQuarter[n].setAttribute('hidden', 'hidden');
                }
            }else if(i == 2){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceHalf[n].setAttribute('hidden', 'hidden');
                }
            }else if(i == 3){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceYear[n].setAttribute('hidden', 'hidden');
                }   
            }
        }
        thPrice.setAttribute('colspan', colSpan);
        if(colSpan > 2){
            divTable.classList.add('w-[800px]');
            divTable.classList.remove('w-[725px]');
        }else{
            divTable.classList.add('w-[725px]');
            divTable.classList.remove('w-[800px]');
        }
    }
}
// Function Get Billboard Price --> end

// Function Get Videotron Price --> start
getVideotronPrice = () => {
    const cbShareTitle = document.querySelectorAll('[id=cbShareTitle]');
    const shareTitle = document.querySelectorAll('[id=shareTitle]');
    const tdShareTitle = document.querySelectorAll('[id=tdShareTitle]');
    const sharePrice = document.querySelectorAll('[id=sharePrice]');
    const tdSharePrice = document.querySelectorAll('[id=tdSharePrice]');
    const cbExTitle = document.querySelectorAll('[id=cbExTitle]');
    const exTitle = document.querySelectorAll('[id=exTitle]');
    const tdExTitle = document.querySelectorAll('[id=tdExTitle]');
    const exPrice = document.querySelectorAll('[id=exPrice]');
    const tdExPrice = document.querySelectorAll('[id=tdExPrice]');
    const cbSharing = document.getElementById("cbSharing");
    const cbExclusive = document.getElementById("cbExclusive");
    
    let objPrice = {};
    let dataSharingPrice = [];
    let dataExclusivePrice = [];
    let priceType = [];
    var slotQty = document.getElementById("slotQty").value;
    
    for(let i = 0; i < cbShareTitle.length; i++){
        dataSharingPrice[i] = {
            checkbox : cbShareTitle[i].checked,
            title : shareTitle[i].value,
            price : Number(sharePrice[i].value)
        }
    }
    for(let i = 0; i < cbExTitle.length; i++){
        dataExclusivePrice[i] = {
            checkbox : cbExTitle[i].checked,
            title : exTitle[i].value,
            price : Number(exPrice[i].value)
        }
    }

    if(cbSharing.checked == true){
        priceType[0] = true;
    }else{
        priceType[0] = false;
    }

    if(cbExclusive.checked == true){
        priceType[1] = true;
    }else{
        priceType[1] = false;
    }

    objPrice = {dataSharingPrice, dataExclusivePrice, priceType, slotQty};
    price.value = JSON.stringify(objPrice);

    if(objPrice.priceType[0] == true){
        document.getElementById("trSharing").removeAttribute('hidden');
        document.getElementById("tdSharing").innerHTML = "Harga Sharing " + document.getElementById("slotQty").value + " Slot";
        document.getElementById("trSharingPrice").removeAttribute('hidden');
        for(let i = 0; i < 4; i++){
            if(objPrice.dataSharingPrice[i].checkbox == true){
                tdShareTitle[i].innerHTML = objPrice.dataSharingPrice[i].title;
                tdShareTitle[i].removeAttribute('hidden');
                tdSharePrice[i].innerHTML = objPrice.dataSharingPrice[i].price.toLocaleString();
                tdSharePrice[i].removeAttribute('hidden');
            }else{
                tdShareTitle[i].setAttribute('hidden', 'hidden');
                tdSharePrice[i].setAttribute('hidden', 'hidden');
            }
        }
    }else{
        document.getElementById("trSharing").setAttribute('hidden', 'hidden');
        document.getElementById("trSharingPrice").setAttribute('hidden', 'hidden');
    }
    if(objPrice.priceType[1] == true){
        document.getElementById("trExclusive").removeAttribute('hidden');
        document.getElementById("trExclusivePrice").removeAttribute('hidden');
        for(let i = 0; i < 4; i++){
            if(objPrice.dataExclusivePrice[i].checkbox == true){
                tdExTitle[i].innerHTML = objPrice.dataExclusivePrice[i].title;
                tdExTitle[i].removeAttribute('hidden');
                tdExPrice[i].innerHTML = objPrice.dataExclusivePrice[i].price.toLocaleString();
                tdExPrice[i].removeAttribute('hidden');
            }else{
                tdExTitle[i].setAttribute('hidden', 'hidden');
                tdExPrice[i].setAttribute('hidden', 'hidden');
            }
        }
    }else{
        document.getElementById("trExclusive").setAttribute('hidden', 'hidden');
        document.getElementById("trExclusivePrice").setAttribute('hidden', 'hidden');
    }
}
// Function Get Videotron Price --> end

// Function Sharing Price Action --> start
sharingPrice = (sel) => {
    const cbShareTitle = document.querySelectorAll('[id=cbShareTitle]');
    const shareTitle = document.querySelectorAll('[id=shareTitle]');
    const sharePrice = document.querySelectorAll('[id=sharePrice]');

    if(sel.checked == true){
        for(let i = 0; i < cbShareTitle.length; i++){
            cbShareTitle[i].checked = true;
            cbShareTitle[i].removeAttribute('disabled');
            shareTitle[i].removeAttribute('disabled');
            shareTitle[i].value = shareTitle[i].defaultValue;
            sharePrice[i].value = sharePrice[i].defaultValue;
        }
    } else{
        if(document.getElementById("cbExclusive").checked == false){
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
        } else{
            for(let i = 0; i < cbShareTitle.length; i++){
                cbShareTitle[i].checked = false;
                cbShareTitle[i].setAttribute('disabled', 'disabled');
                shareTitle[i].setAttribute('disabled', 'disabled');
                shareTitle[i].value = "";
                sharePrice[i].value = "";
            }
        }
    }
}
// Function Sharing Price Action --> end

// Function Exclusive Price Action --> start
exclusivePrice = (sel) => {
    const cbExTitle = document.querySelectorAll('[id=cbExTitle]');
    const exTitle = document.querySelectorAll('[id=exTitle]');
    const exPrice = document.querySelectorAll('[id=exPrice]');

    if(sel.checked == true){
        for(let i = 0; i < cbExTitle.length; i++){
            cbExTitle[i].checked = true;
            cbExTitle[i].removeAttribute('disabled');
            exTitle[i].removeAttribute('disabled');
            exTitle[i].value = exTitle[i].defaultValue;
            exPrice[i].value = exPrice[i].defaultValue;
        }
    } else{
        if(document.getElementById("cbSharing").checked == false){
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
        }else{
            for(let i = 0; i < cbExTitle.length; i++){
                cbExTitle[i].checked = false;
                cbExTitle[i].setAttribute('disabled', 'disabled');
                exTitle[i].setAttribute('disabled', 'disabled');
                exTitle[i].value = "";
                exPrice[i].value = "";
            }
        }
    }
}
// Function Exclusive Price Action --> end

// Function Checkbox Sharing Check Action --> start
cbShareCheck = (sel) => {
    const cbShareTitle = document.querySelectorAll('[id=cbShareTitle]');
    const shareTitle = document.querySelectorAll('[id=shareTitle]');
    const sharePrice = document.querySelectorAll('[id=sharePrice]');

    var index = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    function check(){
        for(let i = 0; i < cbShareTitle.length; i++){
            if( cbShareTitle[i].checked == true ){
                return true;
            }
        }
    }
    if(check() == true){
        if(sel.checked == true){
            for(let i = 0; i < cbShareTitle.length; i++){
                if(i == index){
                    shareTitle[i].removeAttribute('hidden');
                    sharePrice[i].classList.add('flex');
                    sharePrice[i].classList.remove('hidden');
                    shareTitle[i].value = shareTitle[i].defaultValue;
                    sharePrice[i].value = sharePrice[i].defaultValue;
                }
            }
        }else {
            for(let i = 0; i < cbShareTitle.length; i++){
                if(i == index){
                    shareTitle[i].setAttribute('hidden', 'hidden');
                    sharePrice[i].classList.add('hidden');
                    sharePrice[i].classList.remove('flex');
                    shareTitle[i].value = "";
                    sharePrice[i].value = "";
                }
            }
        }
    } else{
        if(document.getElementById("cbExclusive").checked == false){
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
        } else{
            for(let i = 0; i < cbShareTitle.length; i++){
                if(i == index){
                    shareTitle[i].setAttribute('hidden', 'hidden');
                    sharePrice[i].classList.add('hidden');
                    sharePrice[i].classList.remove('flex');
                    shareTitle[i].value = "";
                    sharePrice[i].value = "";
                }
            }
            document.getElementById("cbSharing").click();
        }
    }
}
// Function Checkbox Sharing Check Action --> end

// Function Checkbox Exclusive Check Action --> start
cbExclusiveCheck = (sel) => {
    const cbExTitle = document.querySelectorAll('[id=cbExTitle]');
    const exTitle = document.querySelectorAll('[id=exTitle]');
    const exPrice = document.querySelectorAll('[id=exPrice]');

    var index = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    function check(){
        for(let i = 0; i < cbExTitle.length; i++){
            if( cbExTitle[i].checked == true ){
                return true;
            }
        }
    }
    if(check() == true){
        if(sel.checked == true){
            for(let i = 0; i < cbExTitle.length; i++){
                if(i == index){
                    exTitle[i].removeAttribute('hidden');
                    exPrice[i].classList.add('flex');
                    exPrice[i].classList.remove('hidden');
                    exTitle[i].value = exTitle[i].defaultValue;
                    exPrice[i].value = exPrice[i].defaultValue;
                }
            }
        }else {
            for(let i = 0; i < cbExTitle.length; i++){
                if(i == index){
                    exTitle[i].setAttribute('hidden', 'hidden');
                    exPrice[i].classList.add('hidden');
                    exPrice[i].classList.remove('flex');
                    exTitle[i].value = "";
                    exPrice[i].value = "";
                }
            }
        }
    } else{
        if(document.getElementById("cbSharing").checked == false){
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
        } else{
            for(let i = 0; i < cbExTitle.length; i++){
                if(i == index){
                    exTitle[i].setAttribute('hidden', 'hidden');
                    exPrice[i].classList.add('hidden');
                    exPrice[i].classList.remove('flex');
                    exTitle[i].value = "";
                    exPrice[i].value = "";
                }
            }
            document.getElementById("cbExclusive").click();
        }
    }
}
// Function Checkbox Exclusive Check Action --> end

// Function Checkbox Billboard Check Action --> start
cbBillboardCheck = (sel) => {
    const cbBillboardTitle = document.querySelectorAll('[id=cbBillboardTitle]');
    const billboardTitle = document.querySelectorAll('[id=billboardTitle]');
    const billboardPriceMonth = document.querySelectorAll('[id=billboardPriceMonth]');
    const billboardPriceQuarter = document.querySelectorAll('[id=billboardPriceQuarter]');
    const billboardPriceHalf = document.querySelectorAll('[id=billboardPriceHalf]');
    const billboardPriceYear = document.querySelectorAll('[id=billboardPriceYear]');

    var index = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));

    function check(){
        for(let i = 0; i < cbBillboardTitle.length; i++){
            if( cbBillboardTitle[i].checked == true ){
                return true;
            }
        }
    }

    if(check() == true){
        if(sel.checked == true){
            for(let i = 0; i < cbBillboardTitle.length; i++){
                if(i == index){
                    billboardTitle[i].removeAttribute('disabled');
                    billboardTitle[i].value = billboardTitle[i].defaultValue;
                    
                    for(let n = 0; n < billboardPriceMonth.length; n++){
                        if(index == 0){
                            billboardPriceMonth[n].value = billboardPriceMonth[n].defaultValue;
                            billboardPriceMonth[n].removeAttribute('disabled');
                        }else if(index == 1){
                            billboardPriceQuarter[n].value = billboardPriceQuarter[n].defaultValue;
                            billboardPriceQuarter[n].removeAttribute('disabled');
                        }else if(index == 2){
                            billboardPriceHalf[n].value = billboardPriceHalf[n].defaultValue;
                            billboardPriceHalf[n].removeAttribute('disabled');
                        }else if(index == 3){
                            billboardPriceYear[n].value = billboardPriceYear[n].defaultValue;
                            billboardPriceYear[n].removeAttribute('disabled')
                        }
                    }
                }
            }
        }else {
            for(let i = 0; i < cbBillboardTitle.length; i++){
                if(i == index){
                    billboardTitle[i].setAttribute('disabled', 'disabled');
                    billboardTitle[i].value = "";
                    for(let n = 0; n < billboardPriceMonth.length; n++){
                        if(index == 0){
                            billboardPriceMonth[n].value = "";
                            billboardPriceMonth[n].setAttribute('disabled', 'disabled');
                        }else if(index == 1){
                            billboardPriceQuarter[n].value = "";
                            billboardPriceQuarter[n].setAttribute('disabled', 'disabled');
                        }else if(index == 2){
                            billboardPriceHalf[n].value = "";
                            billboardPriceHalf[n].setAttribute('disabled', 'disabled');
                        }else if(index == 3){
                            billboardPriceYear[n].value = "";
                            billboardPriceYear[n].setAttribute('disabled', 'disabled');
                        }
                    }
                }
            }
        }
    } else{
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
    }
}
// Function Checkbox Billboard Check Action --> end

// Function Input Slot Action --> start
setSLot = (sel) => {
    const sharePrice = document.querySelectorAll('[id=sharePrice]');
    console.log(sel.value);
    if(Number(sel.value) < 4 && Number(sel.value) > 0){
        for(let i = 0; i < sharePrice.length; i++){
            sharePrice[i].value = Number(sharePrice[i].defaultValue) * Number(sel.value);
        }
    }else if(sel.value != ""){
        alert('Jumlah slot minimal 1 dan maksimal 3');
        sel.value = sel.defaultValue;
        for(let i = 0; i < sharePrice.length; i++){
            sharePrice[i].value = Number(sharePrice[i].defaultValue);
        }
    } else {
        for(let i = 0; i < sharePrice.length; i++){
            sharePrice[i].value = 0;
        }
    }
    
}
// Function Input Slot Action --> end
