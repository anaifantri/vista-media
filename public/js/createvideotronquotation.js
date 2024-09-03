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
    // if(numberCheck() == false){
    //     alert("Silahkan input nomor surat penawaran");
    //     createNumber.focus();
    // } else 
    if(clientCheck() == false) {
        alert("Silahkan pilih klien dan kontak");
    } else {
        if (paymentCheck() == true && getPrice() == true) {
            modalPreview.classList.remove("hidden");
            fillData();
            getNotes();
            getPayments();
            getPrice();
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
    // number.value = createNumber.value;
    // previewNumber.innerHTML = createNumber.value;
    attachment.value = createAttachment.innerText;
    previewAttachment.innerHTML = createAttachment.innerText;
    subject.value = createSubject.innerText;
    previewSubject.innerHTML = createSubject.innerText;
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
    const price = document.getElementById("price");
    var checkPrice = false;
    const videotronTBody = document.getElementById("videotronTBody");
    const previewTBody = document.getElementById("previewTBody");
    var tableRow = videotronTBody.getElementsByTagName('tr');
    var previewTableRow = previewTBody.getElementsByTagName('tr');
    
    let objPrice = {};
    let sharePrice = [];
    let exPrice = [];
    let priceType = [];

    for (let i = 0; i < 4; i++){
        sharePrice[i] = {
            checkbox : tableRow[11].cells[i+1].children[0].children[0].checked,
            title : tableRow[11].cells[i+1].children[0].children[1].value,
            price : Number(tableRow[12].cells[i].children[0].children[0].value)
        }

        if(tableRow[11].cells[i+1].children[0].children[0].checked == true){
            previewTableRow[11].cells[i+1].innerHTML = tableRow[11].cells[i+1].children[0].children[1].value;
            previewTableRow[12].cells[i].innerHTML = 'Rp. ' + Number(tableRow[12].cells[i].children[0].children[0].value).toLocaleString() + ',-';
            previewTableRow[11].cells[i + 1].removeAttribute('hidden');
            previewTableRow[12].cells[i].removeAttribute('hidden');
        } else {
            previewTableRow[11].cells[i + 1].setAttribute('hidden', 'hidden');
            previewTableRow[12].cells[i].setAttribute('hidden', 'hidden');
        }

        if(tableRow[11].cells[i+1].children[0].children[0].checked){
            checkPrice = true;
        }
    }

    for (let i = 0; i < 4; i++){
        exPrice[i] = {
            checkbox : tableRow[13].cells[i+1].children[0].children[0].checked,
            title : tableRow[13].cells[i+1].children[0].children[1].value,
            price : Number(tableRow[14].cells[i].children[0].children[0].value)
        }

        if(tableRow[13].cells[i+1].children[0].children[0].checked == true){
            previewTableRow[13].cells[i+1].innerHTML = tableRow[13].cells[i+1].children[0].children[1].value;
            previewTableRow[14].cells[i].innerHTML = 'Rp. ' + Number(tableRow[14].cells[i].children[0].children[0].value).toLocaleString() + ',-';
            previewTableRow[13].cells[i + 1].removeAttribute('hidden');
            previewTableRow[14].cells[i].removeAttribute('hidden');
        } else {
            previewTableRow[13].cells[i + 1].setAttribute('hidden', 'hidden');
            previewTableRow[14].cells[i].setAttribute('hidden', 'hidden');
        }

        if(tableRow[13].cells[i+1].children[0].children[0].checked){
            checkPrice = true;
        }
    }

    if (tableRow[11].cells[0].children[0].children[0].checked == true) {
        priceType[0] = true;
    } else {
        priceType[0] = false;
    }

    if (tableRow[13].cells[0].children[0].children[0].checked == true) {
        priceType[1] = true;
    } else {
        priceType[1] = false;
    }

    objPrice = {priceType, sharePrice, exPrice};
    if (checkPrice == false) {
        alert("Pilihan harga tidak boleh kosong");
        return false;
    } else {
        price.value = JSON.stringify(objPrice);
        return true;
    }
    
}
// Function Get Price --> end

// Function Sharing Price Action --> start
sharingPrice = (sel) => {
    const videotronTBody = document.getElementById("videotronTBody");
    var tableRow = videotronTBody.getElementsByTagName('tr');let objPrice = {};
    const previewTBody = document.getElementById("previewTBody");
    var previewTableRow = previewTBody.getElementsByTagName('tr');
    if(sel.checked == true){
        for (let i = 0; i < 4; i++){
            tableRow[11].cells[i+1].children[0].children[0].checked = true;
            tableRow[11].cells[i+1].children[0].children[0].removeAttribute('disabled');
            tableRow[11].cells[i+1].children[0].children[1].removeAttribute('disabled');
            tableRow[12].cells[i].children[0].children[0].removeAttribute('disabled');
        }
        previewTableRow[11].removeAttribute('hidden');
        previewTableRow[12].removeAttribute('hidden');
    } else {
        for (let i = 0; i < 4; i++){
            tableRow[11].cells[i+1].children[0].children[0].checked = false;
            tableRow[11].cells[i+1].children[0].children[0].setAttribute('disabled', 'disabled');
            tableRow[11].cells[i+1].children[0].children[1].setAttribute('disabled', 'disabled');
            tableRow[12].cells[i].children[0].children[0].setAttribute('disabled', 'disabled');
        }
        previewTableRow[11].setAttribute('hidden', 'hidden');
        previewTableRow[12].setAttribute('hidden', 'hidden');
    }
}
// Function Sharing Price Action --> end

// Function Exclusive Price Action --> start
exclusivePrice = (sel) => {
    const videotronTBody = document.getElementById("videotronTBody");
    var tableRow = videotronTBody.getElementsByTagName('tr');let objPrice = {};
    const previewTBody = document.getElementById("previewTBody");
    var previewTableRow = previewTBody.getElementsByTagName('tr');
    if(sel.checked == true){
        for (let i = 0; i < 4; i++){
            tableRow[13].cells[i+1].children[0].children[0].checked = true;
            tableRow[13].cells[i+1].children[0].children[0].removeAttribute('disabled');
            tableRow[13].cells[i+1].children[0].children[1].removeAttribute('disabled');
            tableRow[14].cells[i].children[0].children[0].removeAttribute('disabled');
        }
        previewTableRow[13].removeAttribute('hidden');
        previewTableRow[14].removeAttribute('hidden');
    } else {
        for (let i = 0; i < 4; i++){
            tableRow[13].cells[i+1].children[0].children[0].checked = false;
            tableRow[13].cells[i+1].children[0].children[0].setAttribute('disabled', 'disabled');
            tableRow[13].cells[i+1].children[0].children[1].setAttribute('disabled', 'disabled');
            tableRow[14].cells[i].children[0].children[0].setAttribute('disabled', 'disabled');
        }
        previewTableRow[13].setAttribute('hidden', 'hidden');
        previewTableRow[14].setAttribute('hidden', 'hidden');
    }
}
// Function Exclusive Price Action --> end