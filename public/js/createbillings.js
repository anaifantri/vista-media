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

// saleServiceNext = () =>{
//     document.getElementById("modalSelectSale").setAttribute('hidden', 'hidden');
//     document.getElementById("modalPreview").removeAttribute('hidden');
//     document.getElementById("divButton").classList.remove('hidden');
//     document.getElementById("divButton").classList.add('flex');
//     saleHeader.classList.remove('flex');
//     saleHeader.classList.add('hidden');
// }
// Function Modal Sale end

// Function Modal Term start
termNext = () =>{
    var divManualTerms = document.getElementById("divManualTerms");
    var manualCheckboxs = divManualTerms.querySelectorAll('[type="checkbox"]');
    const rbManualTerm = document.getElementById("rbManualTerm");
    const rbAutoTerm = document.getElementById("rbAutoTerm");
    const nominalTerms = document.querySelectorAll('[id=nominalTerms]');
    const dppTerms = document.querySelectorAll('[id=dppTerms]');
    const ppnTerms = document.querySelectorAll('[id=ppnTerms]');
    const receiptTotalTerbilang = document.querySelectorAll('[id=receiptTotalTerbilang]');
    const receiptTotal = document.querySelectorAll('[id=receiptTotal]');
    var checkNominal = false;
    if(rbAutoTerm.checked == true){
        if(autoTerms.length == 0){
            alert ("Silahkan pilih termin pembayaran terlebih dahulu..!!");
        }else{
            document.getElementById("receiptTotal").innerText = 'Rp. '+ totalTerm.toLocaleString()+',-';

            for(let i = 0; i < receiptTotal.length; i++){
                receiptTotal[i].innerText = 'Rp. '+ totalTerm.toLocaleString()+',-';
            }
            for(let i = 0; i < receiptTotalTerbilang.length; i++){
                receiptTotalTerbilang[i].innerText = '# '+terbilang(totalTerm)+' Rupiah #';
            }
            setPreview.value = 'true';
            document.getElementById("autoTerms").value = JSON.stringify(autoTerms);
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
            for(let i = 0; i < nominalTerms.length; i++){
                if(manualCheckboxs[i].checked == true){
                    var objTerm = {
                        nominal: nominalTerms[i].value,
                        dpp: dppTerms[i].value,
                        ppn: ppnTerms[i].value
                    }
                    billPayments.push(objTerm);
                    totalTerm = totalTerm + nominalTerms[i].value + ppnTerms[i].value;
                }
            }
            for(let i = 0; i < receiptTotal.length; i++){
                receiptTotal[i].innerText = 'Rp. '+ totalTerm.toLocaleString()+',-';
            }
            for(let i = 0; i < receiptTotalTerbilang.length; i++){
                receiptTotalTerbilang[i].innerText = '# '+terbilang(totalTerm)+' Rupiah #';
            }
            setPreview.value == 'true';
            document.getElementById("autoTerms").value = JSON.stringify(autoTerms);
            document.getElementById("formSelectTerm").submit();
        }
    }
}

// Function Modal Preview start
previewMediaBack = () =>{
    setPreview.value = 'false';
    showHidePreview();
}
// previewServiceBack = () =>{
//     document.getElementById("modalPreview").setAttribute('hidden', 'hidden');
//     document.getElementById("modalSelectSale").removeAttribute('hidden');
//     document.getElementById("divButton").classList.remove('flex');
//     document.getElementById("divButton").classList.add('hidden');
//     saleHeader.classList.remove('flex');
//     saleHeader.classList.add('hidden');
// }
// Function Modal Preview end


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
    const titleTerms = document.querySelectorAll('[id=titleTerms]');
    const nominalTerms = document.querySelectorAll('[id=nominalTerms]');
    const dppTerms = document.querySelectorAll('[id=dppTerms]');
    const ppnTerms = document.querySelectorAll('[id=ppnTerms]');
    if(sel.checked == true){
        titleTerms[indexManualTerm].removeAttribute('disabled');
        nominalTerms[indexManualTerm].removeAttribute('disabled');
        dppTerms[indexManualTerm].removeAttribute('disabled');
        ppnTerms[indexManualTerm].removeAttribute('disabled');
    }else{
        titleTerms[indexManualTerm].setAttribute('disabled', 'disabled');
        titleTerms[indexManualTerm].value = titleTerms[indexManualTerm].defaultValue;
        nominalTerms[indexManualTerm].setAttribute('disabled', 'disabled');
        nominalTerms[indexManualTerm].value = nominalTerms[indexManualTerm].defaultValue;
        dppTerms[indexManualTerm].setAttribute('disabled', 'disabled');
        dppTerms[indexManualTerm].value = dppTerms[indexManualTerm].defaultValue;
        ppnTerms[indexManualTerm].setAttribute('disabled', 'disabled');
        ppnTerms[indexManualTerm].value = ppnTerms[indexManualTerm].defaultValue;
    }
}

inputNominalTerm = (sel) =>{
    var indexNominal = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    const dppTerms = document.querySelectorAll('[id=dppTerms]');
    const ppnTerms = document.querySelectorAll('[id=ppnTerms]');

    dppTerms[indexNominal].value = sel.value;
    ppnTerms[indexNominal].value = sel.value * (salePpn/100);
}

inputDppTerm = (sel) =>{
    var indexDpp = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    const ppnTerms = document.querySelectorAll('[id=ppnTerms]');
    const nominalTerms = document.querySelectorAll('[id=nominalTerms]');
    if(nominalTerms[indexDpp].value == ""){
        alert("Silahkan input nominal terlebih dahulu..!!");
        sel.value = sel.defaultValue;
    }else{
        ppnTerms[indexDpp].value = sel.value * (salePpn/100);
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
    }
}

cbAutoTerm = (sel) => {
    var indexAutoTerm = parseInt(sel.id.replace(/[A-Za-z$-]/g, ""));
    
    if(sel.checked == true){
        autoTerms[indexAutoTerm].set_collect = true;
    }else{
        autoTerms[indexAutoTerm].set_collect = false;
    }
}

rbManualTermAction = () =>{
    billPayments = [];
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