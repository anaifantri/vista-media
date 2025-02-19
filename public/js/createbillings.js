// Function Modal Sale Start
saleMediaNext = () =>{
    if(Object.keys(sale).length == 0){
        alert("Silahkan pilih data penjualan yang akan ditagihkan..!");
    }else{
        const month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const saleHeader = document.getElementById("saleHeader");
        const divTerms = document.getElementById("divTerms");
        const nodeTerm = document.getElementById("nodeTerm");
        const saleDetail = document.getElementById("saleDetail");
        const quotationDetail = document.getElementById("quotationDetail");
        document.getElementById("modalSelectSale").setAttribute('hidden', 'hidden');
        document.getElementById("modalSelectTerm").removeAttribute('hidden');
        var product = JSON.parse(sale[0].product);
        var saleDate = new Date(sale[0].created_at);
        var quotationDate = new Date(quotationDeal.created_at);

        saleDetail.children[0].children[2].innerHTML = sale[0].number;
        saleDetail.children[1].children[2].innerHTML = saleDate.getDate() + ' ' + month[saleDate.getMonth()] + ' ' + saleDate.getFullYear();
        saleDetail.children[2].children[2].innerHTML = product.category;
        saleDetail.children[3].children[2].innerHTML = product.code + '-' + product.city_code + ' | ' +  product.address;
        saleDetail.children[4].children[2].innerHTML = 'Rp. ' + sale[0].price.toLocaleString() + ',-';
        saleDetail.children[0].children[2].innerHTML = sale[0].number;

        quotationDetail.children[0].children[2].innerHTML = quotationDeal.number;
        quotationDetail.children[1].children[2].innerHTML = quotationDate.getDate() + ' ' + month[quotationDate.getMonth()] + ' ' + quotationDate.getFullYear();
        quotationDetail.children[2].children[2].innerHTML = client.name;
        quotationDetail.children[3].children[2].innerHTML = client.company;

        
        while (divTerms.hasChildNodes()) {
            divTerms.removeChild(divTerms.firstChild);
        }
        for(let i = 0; i < terms.length; i++){
            var node = nodeTerm.cloneNode(true);
            var termNominal = terms[i].term / 100 * sale[0].price;
            node.children[0].innerHTML = "Tahap " + (i+1) + " : " + terms[i].term + "% x " + sale[0].price.toLocaleString();
            node.children[1].innerHTML = " = Rp. ";
            node.children[2].innerHTML = termNominal.toLocaleString();
            node.children[3].innerHTML = ",-";
            node.children[4].id = "cbTerms";
            node.children[4].name = i;
            divTerms.appendChild(node);
        }
        saleHeader.classList.remove('hidden');
        saleHeader.classList.add('flex');
    }
}

saleServiceNext = () =>{
    document.getElementById("modalSelectSale").setAttribute('hidden', 'hidden');
    document.getElementById("modalPreview").removeAttribute('hidden');
    document.getElementById("divButton").classList.remove('hidden');
    document.getElementById("divButton").classList.add('flex');
    saleHeader.classList.remove('flex');
    saleHeader.classList.add('hidden');
}
// Function Modal Sale end

// Function Modal Term start
termNext = () =>{
    const cbTerms = document.querySelectorAll('[id=cbTerms]');
    var getTerms = false;
    for(let i = 0; i < cbTerms.length; i++){
        if(cbTerms[i].checked == true){
            getTerms = true;
        }
    }
    if(getTerms == true){
        document.getElementById("modalSelectTerm").setAttribute('hidden', 'hidden');
        document.getElementById("modalPreview").removeAttribute('hidden');
        saleHeader.classList.remove('flex');
        saleHeader.classList.add('hidden');
    }else{
        alert("Silahkan pilih termin yang akan ditagihkan terlebih dahulu..!!");
    }
}
termBack = () =>{
    document.getElementById("modalSelectTerm").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectSale").removeAttribute('hidden');
    saleHeader.classList.remove('flex');
    saleHeader.classList.add('hidden');
}
// Function Modal Term end

// Function Modal Faktur start
// fakturNext = () =>{
//     const number = document.getElementById("number");
//     const taxDate = document.getElementById("taxDate");
//     const images = document.getElementById("images");
//     if(number.value == ""){
//         alert("Nomor faktur belum diinput");
//     }else if(taxDate.value == ""){
//         alert("Tanggal faktur belum diinput");
//     }else if(images.files.length == 0){
//         alert("File Faktur belum dipilih");
//     }else{
//         document.getElementById("modalInputFaktur").setAttribute('hidden', 'hidden');
//         document.getElementById("modalSelectDocuments").removeAttribute('hidden');
//     }
// }
// fakturBack = () =>{
//     document.getElementById("modalInputFaktur").setAttribute('hidden', 'hidden');
//     document.getElementById("modalSelectTerm").removeAttribute('hidden');
// }
// Function Modal Faktur end

// Function Modal Documents start
// documentNext = () =>{
//     const cbApproval = document.getElementById("cbApproval");
//     const cbOrder = document.getElementById("cbOrder");
//     const cbAgreement = document.getElementById("cbAgreement");
//     if(cbAgreement.checked == true || cbApproval.checked == true || cbOrder.checked == true){
//         document.getElementById("modalSelectDocuments").setAttribute('hidden', 'hidden');
//         document.getElementById("modalSelectDocumentation").removeAttribute('hidden');
//     }else{
//         alert("Anda belum memilih dokumen sebagai lampiran..!!");
//     }
// }
// documentBack = () =>{
//     document.getElementById("modalSelectDocuments").setAttribute('hidden', 'hidden');
//     document.getElementById("modalInputFaktur").removeAttribute('hidden');
// }
// Function Modal Documents end

// Function Modal Documentation start
// documentationNext = () =>{
//     const dayImage = document.getElementById("dayImage");
//     const nightImage = document.getElementById("nightImage");
//     if(nightImage.files.length == 0 || dayImage.files.length == 0){
//         alert("Silahkan lengkapi foto siang dan malam"); 
//     }else{
//         document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
//         document.getElementById("modalPreview").removeAttribute('hidden');
//         document.getElementById("divButton").classList.remove('hidden');
//         document.getElementById("divButton").classList.add('flex');
//         saleHeader.classList.remove('flex');
//         saleHeader.classList.add('hidden');
//     }
// }
// documentationBack = () =>{
//     document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
//     document.getElementById("modalSelectDocuments").removeAttribute('hidden');
// }
// Function Modal Documentation end

// Function Modal Preview start
previewMediaBack = () =>{
    document.getElementById("modalPreview").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectTerm").removeAttribute('hidden');
    document.getElementById("divButton").classList.remove('flex');
    document.getElementById("divButton").classList.add('hidden');
    saleHeader.classList.remove('hidden');
    saleHeader.classList.add('flex');
}
previewServiceBack = () =>{
    document.getElementById("modalPreview").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectSale").removeAttribute('hidden');
    document.getElementById("divButton").classList.remove('flex');
    document.getElementById("divButton").classList.add('hidden');
    saleHeader.classList.remove('flex');
    saleHeader.classList.add('hidden');
}
// Function Modal Preview end


// Search Table --> start
function searchTable() {
    const search = document.getElementById("search");
    const salesTable = document.getElementById("salesTable");
    var filter, tr, td, i, found;
    filter = search.value.toUpperCase();
    tr = salesTable.getElementsByTagName("tr");
    for (i = 3; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
// Search Table --> end

cbTermAction = (sel) => {
    if(sel.checked == true){
        var termsData = {
            term_number : sel.name,
            term_value : terms[sel.name].term
        }
        var dppData = {
            dpp_number : sel.name,
            dpp_value : sale[0].dpp * (terms[sel.name].term / 100),
            ppn_value : sale[0].ppn,
            ppn_nominal : (sale[0].dpp * (terms[sel.name].term / 100)) * (sale[0].ppn / 100)
        }
        var nominalData = {
            nominal_number : sel.name,
            nominal_value : sale[0].price * (terms[sel.name].term / 100)
        }
        billTermsData.push(termsData);
        billDppData.push(dppData);
        billNominalData.push(nominalData);
        billTerms.value = JSON.stringify(billTermsData);
        billDpp.value = JSON.stringify(billDppData);
        billNominal.value = JSON.stringify(billNominalData);
    }else{
        for (let i = 0; i < billTermsData.length; i++) {
            if (billTermsData[i].term_number == sel.name) {
                billTermsData.splice(i, 1);
            }
        }
        for (let i = 0; i < billDppData.length; i++) {
            if (billDppData[i].dpp_number == sel.name) {
                billDppData.splice(i, 1);
            }
        }
        for (let i = 0; i < billNominalData.length; i++) {
            if (billNominalData[i].nominal_number == sel.name) {
                billNominalData.splice(i, 1);
            }
        }
        billTerms.value = JSON.stringify(billTermsData);
        billDpp.value = JSON.stringify(billDppData);
        billNominal.value = JSON.stringify(billNominalData);
    }
}

rbManualTerm = (sel) =>{
    const cbTerms = document.querySelectorAll('[id=cbTerms]');
    var divManualTerms = document.getElementById("divManualTerms");
    var inputNodes = divManualTerms.getElementsByTagName('INPUT');
    for(let i = 0; i < cbTerms.length; i++){
        cbTerms[i].checked = false;
        cbTerms[i].setAttribute('disabled', 'disabled');
    }
    
    billTermsData = [];
    billDppData = [];
    billNominalData = [];
    billTerms.value = "";
    billDpp.value = "";
    billNominal.value = "";

    for(var i = 0; i < inputNodes.length; ++i){
        var inputNode = inputNodes[i];
        inputNode.removeAttribute('disabled');
    }
}

rbAutoTerm = () =>{
    const cbTerms = document.querySelectorAll('[id=cbTerms]');
    var divManualTerms = document.getElementById("divManualTerms");
    var inputNodes = divManualTerms.getElementsByTagName('INPUT');
    for(let i = 0; i < cbTerms.length; i++){
        cbTerms[i].removeAttribute('disabled');
    }
    for(var i = 0; i < inputNodes.length; ++i){
        var inputNode = inputNodes[i];
        inputNode.value = inputNode.defaultValue;
        inputNode.setAttribute('disabled', 'disabled');
    }
}