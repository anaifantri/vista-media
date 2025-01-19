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

function fillTotal(price, dpp, ppn, index){
    var ppn = dpp * (ppn / 100);
    var total = price + ppn;
    ppnValue[index].innerHTML = ppn.toLocaleString();
    totalValue[index].innerHTML = total.toLocaleString();
}
//Fill price --> end

//Get DPP --> start
getDpp = (sel) =>{
    if(Number(sel.value) > Number(parseInt(priceValue[sel.name].innerHTML.replace ( /[^\d.]/g, '' )))){
        alert('Nilai DDP tidak boleh lebih besar dari harga');
        sel.value = sel.defaultValue;
        fillTotal(Number(parseInt(priceValue[sel.name].innerText.replace ( /[^\d.]/g, '' ))),Number(sel.value), Number(inputPpn[sel.name].value), sel.name);
    }else{
        fillTotal(Number(parseInt(priceValue[sel.name].innerText.replace ( /[^\d.]/g, '' ))),Number(sel.value), Number(inputPpn[sel.name].value), sel.name);
    }
}
dppCheck = (sel) =>{
    if(Number(sel.value) == 0 || Number(sel.value) == null){
        alert('Nilai DDP tidak boleh kosong');
        sel.value = sel.defaultValue;
        fillTotal(Number(parseInt(priceValue[sel.name].innerText.replace ( /[^\d.]/g, '' ))),Number(sel.value), Number(inputPpn[sel.name].value), sel.name);
    }
}
//Get DPP --> end

insertSalesData = () =>{
    if(periodeCheck() == true){
        if(confirm('Apakah anda yakin data yang diinput sudah benar?')){
            if(category.value == "Service"){
                for(let i = 0; i < objSales.length; i++){
                    objSales[i].dpp = dppValue[i].value;
                    objSales[i].note = note[i].value;
                    objSales[i].price = Number(parseInt(priceValue[i].innerText.replace ( /[^\d.]/g, '' )));
                    objSales[i].ppn = inputPpn[i].value;
                }
            }else{
                for(let i = 0; i < objSales.length; i++){
                    objSales[i].dpp = dppValue[i].value;
                    objSales[i].start_at = start[i].value;
                    objSales[i].end_at = end[i].value;
                    objSales[i].note = note[i].value;
                    objSales[i].duration = thTitle[i].innerText;
                    if(document.getElementById("totalPrint") && document.getElementById("totalInstall")){
                        objSales[i].price = Number(parseInt(priceValue[i].innerText.replace ( /[^\d.]/g, '' )) + parseInt(document.getElementById("totalPrint").innerText.replace ( /[^\d.]/g, '' ))  + parseInt(document.getElementById("totalInstall").innerText.replace ( /[^\d.]/g, '' )));
                    }else if(document.getElementById("totalPrint")){
                        objSales[i].price = Number(parseInt(priceValue[i].innerText.replace ( /[^\d.]/g, '' )) + parseInt(document.getElementById("totalPrint").innerText.replace ( /[^\d.]/g, '' )));
                    }else if(document.getElementById("totalInstall")){
                        objSales[i].price = Number(parseInt(priceValue[i].innerText.replace ( /[^\d.]/g, '' )) + parseInt(document.getElementById("totalInstall").innerText.replace ( /[^\d.]/g, '' )));
                    }else{
                        objSales[i].price = Number(parseInt(priceValue[i].innerText.replace ( /[^\d.]/g, '' )));
                    }
                    objSales[i].ppn = inputPpn[i].value;
                }
            }
            salesData.value = JSON.stringify(objSales);
        }else{
            return false;
        }
    }else{
        return false;
    }
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

//Periode Check --> start
periodeCheck = () =>{
    var statusCheck = true;
    for(let i = 0; i < start.length; i++){
        if(start[i].value != "" && end[i].value == ""){
            statusCheck = false;
        }
    }
    if(statusCheck == true){
        return true;
    }else{
        alert('Terdapat akhir kontrak yang belum di input..!!');
        return false;
    }
}
//Periode Check --> end

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

//set ppn --> start
setPpn = (sel) =>{
    fillTotal(Number(parseInt(priceValue[index].innerText.replace ( /[^\d.]/g, '' ))),dppValue[index].value, sel.value, index);
}
checkPpn = (sel) =>{
    if(sel.value == 0 || sel.value == null){
        alert('PPN tidak boleh kosong');
        sel.value = sel.defaultValue;
        fillTotal(Number(parseInt(priceValue[index].innerText.replace ( /[^\d.]/g, '' ))),dppValue[index].value, sel.value, index);
    }
}
//set ppn --> end
