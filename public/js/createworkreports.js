// Function Modal Sale Start
saleNext = () =>{
    if(Object.keys(sale).length == 0){
        alert("Silahkan pilih data penjualan yang akan dibuatkan BAST..");
    }else{
        const month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const saleHeader = document.getElementById("saleHeader");
        const saleDetail = document.getElementById("saleDetail");
        const quotationDetail = document.getElementById("quotationDetail");
        document.getElementById("modalSelectSale").setAttribute('hidden', 'hidden');
        document.getElementById("modalSelectDocumentation").removeAttribute('hidden');
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

        saleHeader.classList.remove('hidden');
        saleHeader.classList.add('flex');
    }
}
// Function Modal Sale end

// Function Modal Documentation start
documentationNext = () =>{
    const firstImage = document.getElementById("firstImage");
    const secondImage = document.getElementById("secondImage");
    if(secondImage.files.length == 0 && firstImage.files.length == 0){
        alert("Silahkan pilih foto terlebih dahulu..!"); 
    }else{
        document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
        document.getElementById("modalPreview").removeAttribute('hidden');
        document.getElementById("divButton").classList.remove('hidden');
        document.getElementById("divButton").classList.add('flex');
        saleHeader.classList.remove('flex');
        saleHeader.classList.add('hidden');
    }
}
documentationBack = () =>{
    document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectSale").removeAttribute('hidden');
    saleHeader.classList.remove('flex');
    saleHeader.classList.add('hidden');
}
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

// cbTermAction = (sel) => {
//     if(sel.checked == true){
//         var termsData = {
//             term_number : sel.name,
//             term_value : terms[sel.name].term
//         }
//         var dppData = {
//             dpp_number : sel.name,
//             dpp_value : sale[0].dpp * (terms[sel.name].term / 100),
//             ppn_value : sale[0].ppn,
//             ppn_nominal : (sale[0].dpp * (terms[sel.name].term / 100)) * (sale[0].ppn / 100)
//         }
//         var nominalData = {
//             nominal_number : sel.name,
//             nominal_value : sale[0].price * (terms[sel.name].term / 100)
//         }
//         billTermsData.push(termsData);
//         billDppData.push(dppData);
//         billNominalData.push(nominalData);
//         billTerms.value = JSON.stringify(billTermsData);
//         billDpp.value = JSON.stringify(billDppData);
//         billNominal.value = JSON.stringify(billNominalData);
//     }else{
//         for (let i = 0; i < billTermsData.length; i++) {
//             if (billTermsData[i].term_number == sel.name) {
//                 billTermsData.splice(i, 1);
//             }
//         }
//         for (let i = 0; i < billDppData.length; i++) {
//             if (billDppData[i].dpp_number == sel.name) {
//                 billDppData.splice(i, 1);
//             }
//         }
//         for (let i = 0; i < billNominalData.length; i++) {
//             if (billNominalData[i].nominal_number == sel.name) {
//                 billNominalData.splice(i, 1);
//             }
//         }
//         billTerms.value = JSON.stringify(billTermsData);
//         billDpp.value = JSON.stringify(billDppData);
//         billNominal.value = JSON.stringify(billNominalData);
//     }
// }

// rbManualTerm = (sel) =>{
//     const cbTerms = document.querySelectorAll('[id=cbTerms]');
//     var divManualTerms = document.getElementById("divManualTerms");
//     var inputNodes = divManualTerms.getElementsByTagName('INPUT');
//     for(let i = 0; i < cbTerms.length; i++){
//         cbTerms[i].checked = false;
//         cbTerms[i].setAttribute('disabled', 'disabled');
//     }
    
//     billTermsData = [];
//     billDppData = [];
//     billNominalData = [];
//     billTerms.value = "";
//     billDpp.value = "";
//     billNominal.value = "";

//     for(var i = 0; i < inputNodes.length; ++i){
//         var inputNode = inputNodes[i];
//         inputNode.removeAttribute('disabled');
//     }
// }

// rbAutoTerm = () =>{
//     const cbTerms = document.querySelectorAll('[id=cbTerms]');
//     var divManualTerms = document.getElementById("divManualTerms");
//     var inputNodes = divManualTerms.getElementsByTagName('INPUT');
//     for(let i = 0; i < cbTerms.length; i++){
//         cbTerms[i].removeAttribute('disabled');
//     }
//     for(var i = 0; i < inputNodes.length; ++i){
//         var inputNode = inputNodes[i];
//         inputNode.value = inputNode.defaultValue;
//         inputNode.setAttribute('disabled', 'disabled');
//     }
// }