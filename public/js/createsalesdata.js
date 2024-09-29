const priceValue = document.querySelectorAll('[id=priceValue]');
const dppValue = document.querySelectorAll('[id=dppValue]');
const previewDpp = document.querySelectorAll('[id=previewDpp]');
const ppnValue = document.querySelectorAll('[id=ppnValue]');
const previewPpn = document.querySelectorAll('[id=previewPpn]');
const pphValue = document.querySelectorAll('[id=pphValue]');
const previewPph = document.querySelectorAll('[id=previewPph]');
const totalValue = document.querySelectorAll('[id=totalValue]');
const previewTotal = document.querySelectorAll('[id=previewTotal]');
let options = [{ day: 'numeric' }, { month: 'short' }, { year: 'numeric' }];
const start = document.querySelectorAll('[id=start]');
const previewStartAt = document.querySelectorAll('[id=previewStartAt]');
const end = document.querySelectorAll('[id=end]');
const previewEndAt = document.querySelectorAll('[id=previewEndAt]');
const note = document.querySelectorAll('[id=otherNote]');
const otherNote = document.querySelectorAll('[id=other_note]');
const inputPpn = document.querySelectorAll('[id=inputPpn]');
const inputPph = document.querySelectorAll('[id=inputPph]');
const thTitle = document.querySelectorAll('[id=thTitle]');
const ppnYes = document.querySelectorAll('[id=ppnYes]');
const tBodyCreate = document.querySelectorAll('[id=tBodyCreate]');
const tBodyPreview = document.querySelectorAll('[id=tBodyPreview]');

const salesData = document.getElementById("salesData");
let objSales = JSON.parse(salesData.value);

var startAtData = [];
var endAtData = [];
var dppData = [];
var salesNumber = [];
var productCode = [];

//Fill price --> start
function fillPreviewLabel(){
    const labelPo = document.querySelectorAll('[id=labelPo]');
    const labelAgreement = document.querySelectorAll('[id=labelAgreement]');
    const previewPo = document.querySelectorAll('[id=previewPo]');
    const previewAgreement = document.querySelectorAll('[id=previewAgreement]');
    
    for(let i = 0; i < labelPo.length; i++){
        previewPo[i].innerHTML = labelPo[i].innerHTML;
        previewAgreement[i].innerHTML = labelAgreement[i].innerHTML;
        otherNote[i].value = note[i].value;
    }
}
//Fill price --> end
//Fill price --> start
for(let i = 0; i < objSales.length; i++){
    if(ppnYes[i].checked == true){
        inputPpn[i].value = 11;
        inputPph[i].value = 2;
        fillTotal(Number(priceValue[i].innerHTML),dppValue[i].value, inputPpn[i].value, inputPph[i].value, i);
        for(let n = 0; n < tBodyCreate[i].rows.length; n++){
            if(n > 1){
                tBodyCreate[i].rows[n].removeAttribute('hidden');
                tBodyPreview[i].rows[n-1].removeAttribute('hidden');
            }
        }
    }else{
        for(let n = 0; n < tBodyCreate[i].rows.length; n++){
            if(n > 1){
                tBodyCreate[i].rows[n].setAttribute('hidden', 'hidden');
                tBodyPreview[i].rows[n-1].setAttribute('hidden', 'hidden');
                inputPph[sel.id].value = null;
                inputPpn[sel.id].value = null;
                dppValue[sel.id].value = null;
            }
        }
    }
    
}

function fillTotal(price, dpp, ppn, pph, index){
        var ppn = dpp * (ppn / 100);
        var pph = dpp * (pph / 100);
        var total = (price + ppn) - pph;
        previewDpp[index].innerHTML = dpp.toLocaleString();
        ppnValue[index].innerHTML = ppn.toLocaleString();
        previewPpn[index].innerHTML = ppn.toLocaleString();
        pphValue[index].innerHTML = pph.toLocaleString();
        previewPph[index].innerHTML = pph.toLocaleString();
        totalValue[index].innerHTML = total.toLocaleString();
        previewTotal[index].innerHTML = total.toLocaleString();
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
        sel.value = Number(priceValue[Number(sel.name)].innerHTML);
        fillTotal(Number(priceValue[sel.name].innerHTML),sel.value, inputPpn[sel.name].value, inputPph[sel.name].value, sel.name);
    }else{
        fillTotal(Number(priceValue[sel.name].innerHTML),sel.value, inputPpn[sel.name].value, inputPph[sel.name].value, sel.name);
    }
}
//Get DPP --> end

//Btn Preview & close Action --> start
btnPreviewAction = () => {    
    if(getPeriode() == true && ppnYesCheck() == true){
        document.getElementById("modalPreview").classList.remove('hidden');
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
        fillPreviewLabel();
    }
}

btnCloseAction = () => {
    document.getElementById("modalPreview").classList.add('hidden');
}
//Btn Preview & close Action --> end

//Format date --> start
function getFormatDate(date, options, separator) {
    function format(option) {
        let formatter = new Intl.DateTimeFormat('en', option);
        return formatter.format(date);
    }
    return options.map(format).join(separator);
}
//Format date --> end

//get start at --> start
getStartAt = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));

    if(end[index].value != "" && end[index].value < sel.value){
        alert('Tanggal awal kontrak harus lebih kecil dari tanggal akhir kontrak');
        sel.value = null;
        end[index].value = null;
        previewStartAt[index].innerHTML = "-";
        previewEndAt[index].innerHTML = "-";
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
            previewEndAt[index].innerHTML = "-";
        }
    }
}
//get end at --> end

//get periode --> start
getPeriode = () =>{
    for(let i = 0; i < start.length; i++){
        if(start[i].value != "" && end[i].value == ""){
            alert('silahkan isi akhir kontrak atau kosongkan awal kontrak');
            end[i].focus();
            return false;
        } else{
            startAtData[i] = start[i].value;
            endAtData[i] = end[i].value;
            if(start[i].value !=""){
                previewStartAt[i].innerHTML = getFormatDate(new Date(start[i].value), options, '-');
            }else{
                previewStartAt[i].innerHTML = "-";
            }
            if(end[i].value !=""){
                previewEndAt[i].innerHTML = getFormatDate(new Date(end[i].value), options, '-');
            }else{
                previewEndAt[i].innerHTML = "-";
            }
            
        }
    }
    return true;
}
//get periode --> end

//ppn yes check --> start
ppnYesCheck = () =>{
    var index = true;
    for(let i = 0; i < ppnYes.length; i++){
        if(ppnYes[i].checked == true){
            if(dppCheck(i) == true && ppnCheck(i) == true && pphCheck(i) == true){
                index = true;
            }else{
                index = false;
            }
        }
    }
    if(index == true){
        return true;
    }else{
        return false;
    }
}
//ppn yes check --> end

//dpp check --> start
dppCheck = (i) =>{
    if(dppValue[i].value == "" || dppValue[i].value == 0){
        alert('DPP tidak boleh kosong, silahkan isi DPP terlebih dahulu');
        dppValue[i].focus();
        return false;
    }else{
        return true;
    }
}
//dpp check --> end

//ppn check --> start
ppnCheck = (i) =>{
    if(inputPpn[i].value == "" || inputPpn[i].value == 0){
        alert('PPN tidak boleh kosong, silahkan isi PPN terlebih dahulu');
        inputPpn[i].focus();
        return false;
    }else{
        return true;
    }
}
//ppn check --> end

//pph check --> start
pphCheck = (i) =>{
    if(inputPph[i].value == "" || inputPph[i].value == 0){
        alert('PPh tidak boleh kosong, silahkan isi PPh terlebih dahulu');
        inputPph[i].focus();
        return false;
    }else{
        return true;
    }
}
//pph check --> end

//ppn check --> start
ppnValueCheck = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(sel.value == "Yes"){
        for(let i = 0; i < tBodyCreate[index].rows.length; i++){
            if(i > 1){
                tBodyCreate[index].rows[i].removeAttribute('hidden');
                tBodyPreview[index].rows[i-1].removeAttribute('hidden');
            }
        }
        inputPpn[index].value = 11;
        inputPph[index].value = 2;
        dppValue[index].value = Number(priceValue[index].innerHTML);
        fillTotal(Number(priceValue[index].innerHTML),dppValue[index].value, inputPpn[index].value, inputPph[index].value, index);
    }else if(sel.value == "No"){
        for(let i = 0; i < tBodyCreate[index].rows.length; i++){
            if(i > 1){
                tBodyCreate[index].rows[i].setAttribute('hidden', 'hidden');
                tBodyPreview[index].rows[i-1].setAttribute('hidden', 'hidden');
                inputPph[index].value = null;
                inputPpn[index].value = null;
                dppValue[index].value = null;
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