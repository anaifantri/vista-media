//const client & contact
const clientId = document.getElementById("client_id");
const contactId = document.getElementById("contact_id");
const clientCompany = document.getElementById("clientCompany");
const previewClientCompany = document.getElementById("previewClientCompany");
const createClientContact = document.getElementById("createClientContact");
const previewClientContact = document.getElementById("previewClientContact");
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
const modalPreview = document.getElementById("modalPreview");
const btnClose = document.getElementById("btnClose");

//const select client
const selectClient = document.getElementById("selectClient");
const clientList = document.getElementById("clientList");
const client = document.getElementById("client");
const search = document.getElementById("search");
const clientListTable = document.getElementById("clientListTable");

//const data
const price = document.getElementById("price");
const createBodyTop = document.getElementById("createBodyTop");
const createBodyEnd = document.getElementById("createBodyEnd");
const createAttachment = document.getElementById("createAttachment");
const createSubject = document.getElementById("createSubject");
const clientContact = document.getElementById("client_contact");
const contactEmail = document.getElementById("contact_email");
const previewEmail = document.getElementById("previewEmail");
const contactPhone = document.getElementById("contact_phone");
const previewPhone = document.getElementById("previewPhone");
const bodyTop = document.getElementById("body_top");
const bodyEnd = document.getElementById("body_end");
const attachment = document.getElementById("attachment");
const previewAttachment = document.getElementById("previewAttachment");
const subject = document.getElementById("subject");
const previewSubject = document.getElementById("previewSubject");

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
    client.value = sel.innerText;
    clientId.value = sel.id;
    clientList.classList.add("hidden");
    search.value = "";
    searchTable();

    divContact.classList.remove("hidden");
    divContact.classList.add("flex");
    contactId.removeAttribute('disabled');
    clientCompany.innerHTML = "";
    clientCompany.innerHTML = sel.title;
    previewClientCompany.innerHTML = "";
    previewClientCompany.innerHTML = sel.title;

    createContactEmail.innerHTML = "-";
    createContactPhone.innerHTML = "-";
    createClientContact.innerHTML = "-";
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
    while (contactId.hasChildNodes()) {
        contactId.removeChild(contactId.firstChild);
    }
    const optionContact = [];
    optionContact[0] = document.createElement('option');
    optionContact[0].appendChild(document.createTextNode(['Pilih Kontak']));
    optionContact[0].value = "pilih";
    contactId.appendChild(optionContact[0]);

    for (i = 0; i < dataContact.length; i++) {
        if (dataContact[i]['client_id'] == clientId.value) {
            optionContact[i + 1] = document.createElement('option');
            optionContact[i + 1].appendChild(document.createTextNode(dataContact[i]['name']));
            optionContact[i + 1].setAttribute('value', dataContact[i]['id']);
            contactId.appendChild(optionContact[i + 1]);
        }
    }
}

// Get Contact --> start
function getContact(sel) {
    for (i = 0; i < dataContact.length; i++) {
        if (dataContact[i]['name'] == sel.options[sel.selectedIndex].text) {
            if (dataContact[i]['gender'] == 'Laki-Laki') {
                createClientContact.innerHTML = 'UP. Bapak ' + sel.options[sel.selectedIndex].text;
                previewClientContact.innerHTML = 'UP. Bapak ' + sel.options[sel.selectedIndex].text;
                clientContact.value = sel.options[sel.selectedIndex].text;
            } else if (dataContact[i]['gender'] == 'Perempuan') {
                createClientContact.innerHTML = 'UP. Ibu ' + sel.options[sel.selectedIndex].text;
                previewClientContact.innerHTML = 'UP. Ibu ' + sel.options[sel.selectedIndex].text;
                clientContact.value = sel.options[sel.selectedIndex].text;
            }
            createContactEmail.innerHTML = dataContact[i]['email'];
            contactEmail.value = dataContact[i]['email'];
            previewEmail.innerHTML = dataContact[i]['email'];
            createContactPhone.innerHTML = dataContact[i]['phone'];
            contactPhone.value = dataContact[i]['phone'];
            previewPhone.innerHTML = dataContact[i]['phone'];

        }
    }
}
// Get Contact --> end

// Button Add Note Action --> start
btnAddNote.addEventListener("click", function() {
    if (notesQty.children.length < 9) {
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
    if (notesQty.children.length > 6) {
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
        labelPayment.classList.add("text-xs");
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
    if(clientCheck() == false) {
        alert("Silahkan pilih klien dan kontak");
    } else {
        if (paymentCheck() == true && getPrice() == true) {
        // if (paymentCheck() == true) {
            modalPreview.classList.remove("hidden");
            fillData();
            getNotes();
            getPayments();
            // getPrice();
        }
    }
})
// Button Preview Action --> end

// Button Close Action --> start
btnClose.addEventListener("click", function(){
    modalPreview.classList.add("hidden");
})
// Button Close Action --> end

// Function Client Check --> start
clientCheck = () => {
    if(clientId.value == ""){
        return false;
    } else {
        if(contactCheck() == false){
            return false;
        } else if(contactCheck() == true){
            return true;
        }
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
    const previewTHead = document.getElementById("previewTHead");
    const previewTBody = document.getElementById("previewTBody");
    var tableRow = previewTBody.getElementsByTagName('tr');
    var tableHead = previewTHead.getElementsByTagName('tr');

    let objPrice = JSON.parse(price.value);
    let dataPrice = objPrice.dataPrice;
    let dataHeader = objPrice.dataHeader;

    attachment.value = createAttachment.innerText;
    previewAttachment.innerHTML = createAttachment.innerText;
    subject.value = createSubject.innerText;
    previewSubject.innerHTML = createSubject.innerText;

    for (let i = 0; i < dataHeader.length; i++){
        if(dataHeader[i].checkbox == true){
            tableHead[1].cells[i+3].innerHTML = dataHeader[i].title;
            tableHead[1].cells[i+3].removeAttribute('hidden');
            for (let n = 0; n < tableRow.length; n++){
                tableRow[n].cells[i+6].removeAttribute('hidden');
            }
        } else {
            tableHead[1].cells[i+3].innerHTML = dataHeader[i].title;
            tableHead[1].cells[i+3].setAttribute('hidden', 'hidden');
            for (let n = 0; n < tableRow.length; n++){
                tableRow[n].cells[i+6].setAttribute('hidden', 'hidden');
            }
        }
    }
    for (let i = 0; i < tableRow.length; i++){
        tableRow[i].cells[6].innerHTML = "Rp. " + dataPrice[0][i].price.toLocaleString()+",-";
        tableRow[i].cells[7].innerHTML = "Rp. " + dataPrice[1][i].price.toLocaleString()+",-";
        tableRow[i].cells[8].innerHTML = "Rp. " + dataPrice[2][i].price.toLocaleString()  +",-";
        tableRow[i].cells[9].innerHTML = "Rp. " + dataPrice[3][i].price.toLocaleString() +",-";
    }
}
// Function Fill Data --> 

// Function Get Note --> start
getNotes = () => {
    const notes = document.getElementById("notes");
    const previewNotesQty = document.getElementById("previewNotesQty");
    let objNotes = {};
    let dataNotes = [];    

    while (previewNotesQty.hasChildNodes()) {
        previewNotesQty.removeChild(previewNotesQty.firstChild);
    }

    for(let i = 0; i < notesQty.children.length; i++){
        if(notesQty.children[i].children[0].value != ""){
            dataNotes[i] = notesQty.children[i].children[0].value;

            const divNotes = document.createElement("div");
            const labelNotes = document.createElement("label");
            
            divNotes.classList.add("flex");
            labelNotes.classList.add("flex");
            labelNotes.classList.add("text-xs");
            labelNotes.classList.add("text-black");

            if(i == 2 || i == 3 ){
                labelNotes.classList.add("ml-4");
            } else {
                labelNotes.classList.add("ml-1");
            }

            labelNotes.innerHTML = notesQty.children[i].children[0].value;

            divNotes.appendChild(labelNotes);
            previewNotesQty.appendChild(divNotes);
        }
    }

    objNotes = {dataNotes};
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

// Function Get Price --> start
getPrice = () => {
    const cbMonth = document.getElementById("cbMonth");
    const cbQuarter = document.getElementById("cbQuarter");
    const cbHalf = document.getElementById("cbHalf");
    const cbYear = document.getElementById("cbYear");
    const signageTHead = document.getElementById("signageTHead");
    const signageTBody = document.getElementById("signageTBody");
    var tableRow = signageTBody.getElementsByTagName('tr');
    var tableHead = signageTHead.getElementsByTagName('tr');
    
    let objPrice = {};
    let dataPrice = [];
    let dataHeader = [];
    let dataPriceMonth = [];
    let dataPriceQuarter = [];
    let dataPriceHalf = [];
    let dataPriceYear = [];
    
    for(let i = 0; i < tableRow.length; i++){
        dataPriceMonth[i] = {
            signage_code : tableRow[i].cells[1].innerText.substring(0,4),
            city_code : tableRow[i].cells[1].innerText.substring(5),
            price : Number(tableRow[i].cells[6].children[0].children[0].value)
        }
        dataPriceQuarter[i] = {
            signage_code : tableRow[i].cells[1].innerText.substring(0,4),
            city_code : tableRow[i].cells[1].innerText.substring(5),
            price : Number(tableRow[i].cells[7].children[0].children[0].value)
        }
        dataPriceHalf[i] = {
            signage_code : tableRow[i].cells[1].innerText.substring(0,4),
            city_code : tableRow[i].cells[1].innerText.substring(5),
            price : Number(tableRow[i].cells[8].children[0].children[0].value)
        }
        dataPriceYear[i] = {
            signage_code : tableRow[i].cells[1].innerText.substring(0,4),
            city_code : tableRow[i].cells[1].innerText.substring(5),
            price : Number(tableRow[i].cells[9].children[0].children[0].value)
        }
    }
    dataPrice[0] = dataPriceMonth;
    dataPrice[1] = dataPriceQuarter;
    dataPrice[2] = dataPriceHalf;
    dataPrice[3] = dataPriceYear;

    for (let i = 0; i < 4; i++){
        dataHeader[i] = {
            checkbox : tableHead[1].cells[i+3].children[0].children[0].checked,
            title : tableHead[1].cells[i+3].children[0].children[1].value
        }
    }

    objPrice = {dataHeader, dataPrice};

    if (cbMonth.checked == false && cbQuarter.checked == false && cbHalf.checked == false && cbYear.checked == false ) {
        alert("Pilihan harga tidak boleh kosong");
        return false;
    } else {
        price.value = JSON.stringify(objPrice);
        return true;
    }
}
// Function Get Price --> end

// Function Checkbox Month --> start
cbMonth = (sel) => {
    const thMonth = document.getElementById("thMonth");
    const priceMonths = document.querySelectorAll('[id=priceMonth]');
    if(Boolean(sel.checked == true)){
        thMonth.removeAttribute('disabled');
        thMonth.value = "1 Bulan";
        for (let i = 0; i < priceMonths.length; i++) {
            priceMonths[i].classList.remove('hidden');
            priceMonths[i].classList.add('flex');
        }
    }else{
        thMonth.setAttribute('disabled', 'disabled');
        thMonth.value = "";
        for (let i = 0; i < priceMonths.length; i++) {
            priceMonths[i].classList.add('hidden');
            priceMonths[i].classList.remove('flex');
        }
    }
}
// Function Checkbox Month --> end

// Function Checkbox Quarter --> start
cbQuarter = (sel) => {
    const thQuarter = document.getElementById("thQuarter");
    const priceQuarters = document.querySelectorAll('[id=priceQuarter]');
    if(Boolean(sel.checked == true)){
        thQuarter.removeAttribute('disabled');
        thQuarter.value = "3 Bulan";
        for (let i = 0; i < priceQuarters.length; i++) {
            priceQuarters[i].classList.remove('hidden');
            priceQuarters[i].classList.add('flex');
        }
    }else{
        thQuarter.setAttribute('disabled', 'disabled');
        thQuarter.value = "";
        for (let i = 0; i < priceQuarters.length; i++) {
            priceQuarters[i].classList.add('hidden');
            priceQuarters[i].classList.remove('flex');
        }
    }
}
// Function Checkbox Quarter --> end

// Function Checkbox Half --> start
cbHalf = (sel) => {
    const thHalf = document.getElementById("thHalf");
    const priceHalfs = document.querySelectorAll('[id=priceHalf]');
    if(Boolean(sel.checked == true)){
        thHalf.removeAttribute('disabled');
        thHalf.value = "6 Bulan";
        for (let i = 0; i < priceHalfs.length; i++) {
            priceHalfs[i].classList.remove('hidden');
            priceHalfs[i].classList.add('flex');
        }
    }else{
        thHalf.setAttribute('disabled', 'disabled');
        thHalf.value = "";
        for (let i = 0; i < priceHalfs.length; i++) {
            priceHalfs[i].classList.add('hidden');
            priceHalfs[i].classList.remove('flex');
        }
    }
}
// Function Checkbox Half --> end

// Function Checkbox Year --> start
cbYear = (sel) => {
    const thYear = document.getElementById("thYear");
    const priceYears = document.querySelectorAll('[id=priceYear]');
    if(Boolean(sel.checked == true)){
        thYear.removeAttribute('disabled');
        thYear.value = "1 Tahun";
        for (let i = 0; i < priceYears.length; i++) {
            priceYears[i].classList.remove('hidden');
            priceYears[i].classList.add('flex');
        }
    }else{
        thYear.setAttribute('disabled', 'disabled');
        thYear.value = "";
        for (let i = 0; i < priceYears.length; i++) {
            priceYears[i].classList.add('hidden');
            priceYears[i].classList.remove('flex');
        }
    }
}
// Function Checkbox Year --> end
const products = document.getElementById("products");
const signageId = document.getElementById("signage_id");
let objProducts = JSON.parse(products.value);
console.log(objProducts);
console.log(signageId.value);
