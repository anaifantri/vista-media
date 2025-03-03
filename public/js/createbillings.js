if(document.getElementById("setPreview")){
    showHidePreview();
}

function showHidePreview(){
    if(setPreview.value == 'true'){
        document.getElementById("modalSelectTerm").setAttribute('hidden', 'hidden');
        document.getElementById("saleHeader").classList.remove('flex');
        document.getElementById("saleHeader").classList.add('hidden');
        document.getElementById("divButton").classList.remove('hidden');
        document.getElementById("divButton").classList.add('flex');
        document.getElementById("modalPreview").removeAttribute('hidden');
    }else{
        document.getElementById("modalSelectTerm").removeAttribute('hidden');
        document.getElementById("saleHeader").classList.add('flex');
        document.getElementById("saleHeader").classList.remove('hidden');
        document.getElementById("divButton").classList.add('hidden');
        document.getElementById("divButton").classList.remove('flex');
        document.getElementById("modalPreview").setAttribute('hidden','hidden');
    }
}
// Function Modal Sale Start
saleMediaNext = () =>{
    formSelectSale.submit();
}

// Function Modal Term start
termNext = () =>{
    var divManualTerms = document.getElementById("divManualTerms");
    const rbManualTerm = document.getElementById("rbManualTerm");
    const rbAutoTerm = document.getElementById("rbAutoTerm");
    const nominalTerms = document.querySelectorAll('[id=nominalTerms]');
    var checkNominal = false;
    if(rbAutoTerm.checked == true){
        if(billTerms.length == 0){
            alert ("Silahkan pilih termin pembayaran terlebih dahulu..!!");
        }else{
            setPreview.value = 'true';
            document.getElementById("billTerms").value = JSON.stringify(billTerms);
            document.getElementById("formSelectTerm").submit();
        }
    }else if(rbManualTerm.checked == true){
        for(let i = 0; i < nominalTerms.length; i++){
            if(nominalTerms[i].value != "" && nominalTerms[i].value != 0){
                checkNominal = true;
            }
        }
        if(checkNominal == false){
            alert ("Silahkan input termin pembayaran terlebih dahulu..!!");
        }else{
            setPreview.value = 'true';
            document.getElementById("billTerms").value = JSON.stringify(billTerms);
            document.getElementById("formSelectTerm").submit();
        }
    }
}

// Function Modal Preview start
previewMediaBack = () =>{
    setPreview.value = 'false';
    showHidePreview();
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

cbManualTerm = (sel) =>{
    var indexManualTerm = parseInt(sel.id.replace(/[A-Za-z$-]/g, ""));
    const termTitles = document.querySelectorAll('[id=termTitles]');
    const termNumbers = document.querySelectorAll('[id=termNumbers]');
    const termValues = document.querySelectorAll('[id=termValues]');
    const nominalTerms = document.querySelectorAll('[id=nominalTerms]');
    const dppTerms = document.querySelectorAll('[id=dppTerms]');
    const ppnTerms = document.querySelectorAll('[id=ppnTerms]');
    if(sel.checked == true){
        termTitles[indexManualTerm].removeAttribute('disabled');
        termNumbers[indexManualTerm].removeAttribute('disabled');
        termValues[indexManualTerm].removeAttribute('disabled');
        nominalTerms[indexManualTerm].removeAttribute('disabled');
        dppTerms[indexManualTerm].removeAttribute('disabled');
        ppnTerms[indexManualTerm].removeAttribute('disabled');
        billTerms[indexManualTerm].title = termTitles[indexManualTerm].value;
        billTerms[indexManualTerm].set_collect = true;
    }else{
        termTitles[indexManualTerm].setAttribute('disabled', 'disabled');
        termTitles[indexManualTerm].value = termTitles[indexManualTerm].defaultValue;
        termNumbers[indexManualTerm].setAttribute('disabled', 'disabled');
        termNumbers[indexManualTerm].value = termNumbers[indexManualTerm].defaultValue;
        termValues[indexManualTerm].setAttribute('disabled', 'disabled');
        termValues[indexManualTerm].value = termValues[indexManualTerm].defaultValue;
        nominalTerms[indexManualTerm].setAttribute('disabled', 'disabled');
        nominalTerms[indexManualTerm].value = nominalTerms[indexManualTerm].defaultValue;
        dppTerms[indexManualTerm].setAttribute('disabled', 'disabled');
        dppTerms[indexManualTerm].value = dppTerms[indexManualTerm].defaultValue;
        ppnTerms[indexManualTerm].setAttribute('disabled', 'disabled');
        ppnTerms[indexManualTerm].value = ppnTerms[indexManualTerm].defaultValue;
        billTerms[indexManualTerm].title = termTitles[indexManualTerm].defaultValue;
        billTerms[indexManualTerm].set_collect = false;
    }
}

inputNominalTerm = (sel) =>{
    var indexNominal = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    const dppTerms = document.querySelectorAll('[id=dppTerms]');
    const ppnTerms = document.querySelectorAll('[id=ppnTerms]');

    dppTerms[indexNominal].value = Math.round(sel.value/12*11);
    ppnTerms[indexNominal].value = sel.value * (salePpn/100);
    billTerms[indexNominal].nominal = sel.value;
    billTerms[indexNominal].dpp = Math.round(sel.value/12*11);
    billTerms[indexNominal].ppn = sel.value*(salePpn/100);
}

inputDppTerm = (sel) =>{
    var indexDpp = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    const ppnTerms = document.querySelectorAll('[id=ppnTerms]');
    const nominalTerms = document.querySelectorAll('[id=nominalTerms]');
    if(nominalTerms[indexDpp].value == ""){
        alert("Silahkan input nominal terlebih dahulu..!!");
        sel.value = sel.defaultValue;
    }else{
        ppnTerms[indexDpp].value = Math.round(sel.value * (12/100));
        billTerms[indexDpp].dpp = Math.round(sel.value);
        billTerms[indexDpp].ppn = Math.round(sel.value * (12/100));
    }
}

inputDppTermChange = (sel) =>{
    var indexDpp = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    const ppnTerms = document.querySelectorAll('[id=ppnTerms]');
    const nominalTerms = document.querySelectorAll('[id=nominalTerms]');
    if(sel.value > nominalTerms[indexDpp].value){
        alert("DPP tidak boleh lebih besar dari nominal..!");
        sel.value = nominalTerms[indexDpp].value;
        ppnTerms[indexDpp].value = nominalTerms[indexDpp].value * (salePpn/100);
        billTerms[indexDpp].dpp = nominalTerms[indexDpp].value;
        billTerms[indexDpp].ppn = Math.round(nominalTerms[indexDpp].value * (12/100));
    }
}
inputTermTitle = (sel, index) =>{
    billTerms[index].title = sel.value;
}
inputTermNumber = (sel, index) =>{
    billTerms[index].number = sel.value;
}
inputTermValue = (sel, index) =>{
    billTerms[index].term = sel.value;
}

cbAutoTerm = (sel) => {
    var indexAutoTerm = parseInt(sel.id.replace(/[A-Za-z$-]/g, ""));
    
    if(sel.checked == true){
        billTerms[indexAutoTerm].set_collect = true;
    }else{
        billTerms[indexAutoTerm].set_collect = false;
    }
}

rbManualTermAction = () =>{
    billTerms = manualTerms;
    var divManualTerms = document.getElementById("divManualTerms");
    var divAutoTerms = document.getElementById("divAutoTerms");
    var manualInputs = divManualTerms.querySelectorAll('[type="checkbox"]');
    var autoInputs = divAutoTerms.getElementsByTagName('INPUT');
    
    for(let i = 0; i < autoInputs.length; i++){
        autoInputs[i].checked = false;
        autoInputs[i].setAttribute('disabled', 'disabled');
    }

    for(var i = 0; i < manualInputs.length; ++i){
        var manualInput = manualInputs[i];
        manualInput.removeAttribute('disabled');
    }
}

rbAutoTermAction = () =>{
    billTerms = autoTerms;
    var divManualTerms = document.getElementById("divManualTerms");
    var divAutoTerms = document.getElementById("divAutoTerms");
    var manualCheckboxs = divManualTerms.querySelectorAll('[type="checkbox"]');
    var manualInputs = divManualTerms.getElementsByTagName('INPUT');
    var autoInputs = divAutoTerms.getElementsByTagName('INPUT');
    for(let i = 0; i < autoInputs.length; i++){
        autoInputs[i].removeAttribute('disabled');
    }
    
    for(var i = 0; i < manualInputs.length; ++i){
        manualInputs[i].value = manualInputs[i].defaultValue;
        manualInputs[i].setAttribute('disabled', 'disabled');
    }
    for(var i = 0; i < manualCheckboxs.length; ++i){
        manualCheckboxs[i].checked = false;
    }
}