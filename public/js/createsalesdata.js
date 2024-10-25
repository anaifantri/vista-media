const priceValue = document.querySelectorAll('[id=priceValue]');
const dppValue = document.querySelectorAll('[id=dppValue]');
const ppnValue = document.querySelectorAll('[id=ppnValue]');
const pphValue = document.querySelectorAll('[id=pphValue]');
const totalValue = document.querySelectorAll('[id=totalValue]');
let options = [{ day: 'numeric' }, { month: 'short' }, { year: 'numeric' }];
const start = document.querySelectorAll('[id=start]');
const end = document.querySelectorAll('[id=end]');
const note = document.querySelectorAll('[id=otherNote]');
const otherNote = document.querySelectorAll('[id=other_note]');
const inputPpn = document.querySelectorAll('[id=inputPpn]');
const inputPph = document.querySelectorAll('[id=inputPph]');
const thTitle = document.querySelectorAll('[id=thTitle]');
const ppnYes = document.querySelectorAll('[id=ppnYes]');
const tBodyCreate = document.querySelectorAll('[id=tBodyCreate]');

const category = document.getElementById("category");
const salesData = document.getElementById("salesData");
let objSales = JSON.parse(salesData.value);

var startAtData = [];
var endAtData = [];

function fillTotal(price, dpp, ppn, pph, index){
        var ppn = dpp * (ppn / 100);
        var pph = dpp * (pph / 100);
        var total = price + ppn - pph;
        ppnValue[index].innerHTML = ppn;
        pphValue[index].innerHTML = pph;
        totalValue[index].innerHTML = total;
}
//Fill price --> end

//Radio DPP Action --> start
radioCheck = (sel) => {
    for(let i = 0; i < dppValue.length; i++){
        if(i == Number(sel.id) && sel.value == "No"){
            dppValue[i].removeAttribute('readonly');
            dppValue[i].focus();
        } else {
            dppValue[i].setAttribute('readonly', 'readonly');
        }
    }
}
//Radio DPP Action --> end

//Get DPP --> start
getDpp = (sel) =>{
    if(Number(sel.value) > Number(priceValue[Number(sel.name)].innerHTML)){
        alert('Nilai DDP tidak boleh lebih besar dari harga');
        sel.value = sel.defaultValue;
        fillTotal(Number(priceValue[sel.name].innerHTML),sel.value, inputPpn[sel.name].value, inputPph[sel.name].value, sel.name);
    }else{
        fillTotal(Number(priceValue[sel.name].innerHTML),sel.value, inputPpn[sel.name].value, inputPph[sel.name].value, sel.name);
    }
}
//Get DPP --> end

insertSalesData = () =>{
    for(let i = 0; i < objSales.length; i++){
        objSales[i].dpp = dppValue[i].value;
        objSales[i].start_at = start[i].value;
        objSales[i].end_at = end[i].value;
        objSales[i].note = note[i].value;
        objSales[i].duration = thTitle[i].innerText;
        objSales[i].price = Number(priceValue[i].innerText);
        objSales[i].ppn = inputPpn[i].value;
        objSales[i].pph = inputPph[i].value;
    }
    salesData.value = JSON.stringify(objSales);
}

//get start at --> start
getStartAt = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));

    if(end[index].value != "" && end[index].value < sel.value){
        alert('Tanggal awal kontrak harus lebih kecil dari tanggal akhir kontrak');
        sel.value = null;
        end[index].value = null;
    }
}
//get start at --> end

//get end at --> start
getEndAt = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));

    if(start[index].value == ""){
        alert('Silahkan input awal kontrak terlebih dahulu');
        sel.value = null;
    }else{
        if(start[index].value > sel.value){
            alert('Tanggal akhir kontrak harus lebih besar dari tanggal awal kontrak');
            sel.value = null;
        }
    }
}
//get end at --> end

//ppn check --> start
ppnValueCheck = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(sel.value == "Yes"){
        for(let i = 0; i < tBodyCreate[index].rows.length; i++){
            if(i > 1){
                tBodyCreate[index].rows[i].removeAttribute('hidden');
            }
        }
        inputPpn[index].value = inputPpn[index].defaultValue;
        inputPpn[index].setAttribute('required','required');
        inputPph[index].value = inputPph[index].defaultValue;
        inputPph[index].setAttribute('required','required');
        dppValue[index].value = dppValue[index].defaultValue;
        dppValue[index].setAttribute('required','required');
        fillTotal(Number(dppValue[index].value),dppValue[index].value, inputPpn[index].value, inputPph[index].value, index);
    }else if(sel.value == "No"){
        for(let i = 0; i < tBodyCreate[index].rows.length; i++){
            if(i > 1){
                tBodyCreate[index].rows[i].setAttribute('hidden', 'hidden');
                inputPph[index].value = null;
                inputPph[index].removeAttribute('required');
                inputPpn[index].value = null;
                inputPpn[index].removeAttribute('required');
                dppValue[index].value = null;
                dppValue[index].removeAttribute('required');
                totalValue[index].innerHTML = "";
            }
        }
    }
}
//ppn check --> end

//set ppn --> start
setPpn = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(dppValue[index].value == 0 || dppValue[index].value == null){
        alert('Silakan input DPP terlebih dahulu');
        sel.value = null;
    }else{
        fillTotal(Number(priceValue[index].innerHTML),dppValue[index].value, sel.value, inputPph[index].value, index);
    }
}
//set ppn --> end

//set ppn --> start
setPph = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(dppValue[index].value == 0 || dppValue[index].value == null){
        alert('Silakan input DPP terlebih dahulu');
        sel.value = null;
    }else{
        fillTotal(Number(priceValue[index].innerHTML),dppValue[index].value, inputPpn[index].value, sel.value, index);
    }
}
//set ppn --> end