// Function Modal Sale Start
saleMediaNext = () =>{
    formSelectSale.submit();
}
saleServiceNext = () =>{
    formSelectSale.submit();
}

// Search Table --> start
function searchTable() {
    const search = document.getElementById("search");
    const salesTable = document.getElementById("salesTable");
    var filter, tr, td, i, found, tdText;
    filter = search.value.toUpperCase();
    tr = salesTable.getElementsByTagName("tr");
    for (i = 2; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            tdText = tr[i].getElementsByTagName("td")[j];
            if (tdText.innerText.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found == true) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
// Search Table --> end

changeClient = (sel) =>{
    let objClient = JSON.parse(document.getElementById("client").value);
    const receiptCompany = document.getElementById("receiptCompany");
    if(sel.name == "client_contact"){
        objClient.contact_name = sel.value;
    }else if(sel.name == "client_company"){
        objClient.company = sel.value;
        receiptCompany.innerHTML = '<b>' + sel.value + '</b>';
    }else if(sel.name == "client_address"){
        objClient.address = sel.value;
    }else if(sel.name == "contact_phone"){
        objClient.contact_phone = sel.value;
    }else if(sel.name == "contact_email"){
        objClient.contact_email = sel.value;
    }

    document.getElementById("client").value = JSON.stringify(objClient);
}

changeInvoiceTitle = (sel) =>{
    let objInvoice = JSON.parse(document.getElementById("invoice").value);
    var indexInvTitle = parseInt(sel.id.replace(/[A-Za-z$-]/g, ""));
    
    if(sel.value == ""){
        alert("Judul deskripsi tidak boleh kosong..!!");
        sel.value = sel.defaultValue;
        objInvoice.description[indexInvTitle].title = sel.defaultValue;
        document.getElementById("invoice").value = JSON.stringify(objInvoice); 
    }else{
        objInvoice.description[indexInvTitle].title = sel.value;
    }

    document.getElementById("invoice").value = JSON.stringify(objInvoice);
}

changeInvoiceTheme = (sel) =>{
    let objInvoice = JSON.parse(document.getElementById("invoice").value);
    var indexInvTheme = parseInt(sel.id.replace(/[A-Za-z$-]/g, ""));
    
    if(sel.value == ""){
        alert("Tema tidak boleh kosong..!!");
        sel.value = sel.defaultValue;
        objInvoice.description[indexInvTheme].theme = sel.defaultValue;
        document.getElementById("invoice").value = JSON.stringify(objInvoice); 
    }else{
        objInvoice.description[indexInvTheme].theme = sel.value;
    }

    document.getElementById("invoice").value = JSON.stringify(objInvoice);
}

changeReceiptTitle = (sel) =>{
    let objReceipt = JSON.parse(document.getElementById("receipt").value);
    
    if(sel.value == ""){
        alert("Judul deskripsi tidak boleh kosong..!!");
        sel.value = sel.defaultValue;
        objReceipt.title = sel.defaultValue;
        document.getElementById("receipt").value = JSON.stringify(objReceipt); 
    }else{
        objReceipt.title = sel.value;
    }

    document.getElementById("receipt").value = JSON.stringify(objReceipt);    
}

changeReceiptTheme = (sel) =>{
    let objReceipt = JSON.parse(document.getElementById("receipt").value);
    
    if(sel.value == ""){
        alert("Tema tidak boleh kosong..!!");
        sel.value = sel.defaultValue;
        objReceipt.theme = sel.defaultValue;
        document.getElementById("receipt").value = JSON.stringify(objReceipt); 
    }else{
        objReceipt.theme = sel.value;
    }

    document.getElementById("receipt").value = JSON.stringify(objReceipt);   
}

mergeLocation = (sel) =>{
    let objInvoice = JSON.parse(document.getElementById("invoice").value);
    objInvoice.merge = sel.value;
    document.getElementById("invoice").value = JSON.stringify(objInvoice);
    document.getElementById("merge").value = sel.value;

    document.getElementById("formCreateBilling").submit();
}

btnSaveAction = () => {
    let objClient = JSON.parse(document.getElementById("client").value);
    const formCreate = document.getElementById("formCreate");
    const inputNpwp = document.getElementById("inputNpwp");

    if (inputNpwp.value == "") {
        alert ("NPWP tidak boleh kosong..!!");
        inputNpwp.focus();
    }else{
        objClient.npwp = inputNpwp.value;
        document.getElementById("client").value = JSON.stringify(objClient);
        
        formCreate.submit();
    }
}

// function previewImage(sel) {
//     const imgPreview = document.querySelector('.img-preview');

//     const oFReader = new FileReader();

//     oFReader.readAsDataURL(sel.files[0]);

//     oFReader.onload = function(oFREvent) {
//         imgPreview.src = oFREvent.target.result;
//     }
// }

// showModal = () =>{
//     const modalNpwp = document.getElementById("modalNpwp");
//     modalNpwp.classList.remove("hidden");
//     modalNpwp.classList.add("flex");
// }

// btnCloseModal = () =>{
//     const modalNpwp = document.getElementById("modalNpwp");
//     modalNpwp.classList.remove("flex");
//     modalNpwp.classList.add("hidden");
// }

// npwpNumberChange = (sel) =>{
//     const inputNpwp = document.getElementById("inputNpwp");

//     inputNpwp.value = sel.value;
//     console.log(inputNpwp.value);
    
// }