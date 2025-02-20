const formSelectSale = document.getElementById("formSelectSale");
let saleId = "";

getMediaSales = (sel) => {
    saleId = JSON.parse(sel.value).id;
    formSelectSale.setAttribute('action', '/work-reports/select-documentation/' + saleId);
}

// Function Modal Sale Start
saleNext = () =>{
    if(saleId == ""){
        alert("Silahkan pilih penjualan terlebih dahulu..!!");
    }else{
        formSelectSale.submit();
    }
}
// Function Modal Sale end

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