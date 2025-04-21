const inputPrice = document.getElementById("inputPrice");
const inputPpn = document.getElementById("inputPpn");
const inputPriceDiff = document.getElementById("inputPriceDiff");
const inputPpnDiff = document.getElementById("inputPpnDiff");
const inputDpp = document.getElementById("inputDpp");
const inputQuotationPrice = document.getElementById("inputQuotationPrice");
const inputMediaPrice = document.getElementById("inputMediaPrice");
var inputPrintTotal = 0;
var inputInstallTotal = 0;
var getGrandTotal = 0;
var getSubTotal = 0;
if(document.getElementById("inputPrintTotal")){
    inputPrintTotal = document.getElementById("inputPrintTotal").value;
}
if(document.getElementById("inputInstallTotal")){
    inputInstallTotal = document.getElementById("inputInstallTotal").value;
}
const inputMediaDpp = document.getElementById("inputMediaDpp");
const tdSubTotal = document.getElementById("tdSubTotal");
const tdPpn = document.getElementById("tdPpn");
const tdGrandTotal = document.getElementById("tdGrandTotal");
const printPrice = document.getElementById("printPrice");
const inputPrintQty = document.getElementById("inputPrintQty");
const inputFreePrint = document.getElementById("inputFreePrint");
const installPrice = document.getElementById("installPrice");
const inputInstallQty = document.getElementById("inputInstallQty");
const inputFreeInstall = document.getElementById("inputFreeInstall");
const printProduct = document.getElementById("printProduct");
if(document.getElementById("printProduct")){
    var printProductDefault = printProduct.value;
}
const installProduct = document.getElementById("installProduct");
if(document.getElementById("installProduct")){
    var installProductDefault = installProduct.value;
}

durationChangeAction = (sel) =>{
    if(sel.value == ""){
        alert ("Jenis harga tidak boleh kosong..!!");
        sel.value = sel.defaultValue;
    }else{
        quotationPrice.title = sel.value;
    }
}

startAtChange = (sel) =>{
    if(sel.value == ""){
        alert ("Tanggal awal kontrak tidak boleh kosong..!!");
        sel.value = sel.defaultValue;
    }
}

endAtChange = (sel) =>{
    if(sel.value == ""){
        alert ("Tanggal akhir kontrak tidak boleh kosong..!!");
        sel.value = sel.defaultValue;
    }else{
        if(sel.value < document.getElementById("startAt").value){
            alert ("Tanggal akhir kontrak tidak boleh lebih kecil dari tanggal awal kontrak..!!");
            sel.value = sel.defaultValue;
        }
    }
}

mediaPriceChange = (sel) =>{
    if(sel.value < 1){
        alert ("Harga harus lebih besar dari 0..!!");
        sel.value = sel.defaultValue;
    }else{
        getSubTotal = Number(sel.value) + Number(inputPrintTotal) + Number(inputInstallTotal);
        var getMediaDpp = getSubTotal;
        calculateTotalPrice(getSubTotal, getMediaDpp);
        quotationPrice.price = sel.value;
    }
}

videotronPriceChange = (sel) =>{
    if(sel.value < 1){
        alert ("Harga harus lebih besar dari 0..!!");
        sel.value = sel.defaultValue;
    }else{
        getSubTotal = Number(sel.value);
        var getMediaDpp = getSubTotal;
        calculateTotalPrice(getSubTotal, getMediaDpp);
        quotationPrice.price = sel.value;
    }
}

mediaDppChange = (sel) =>{
    if(sel.value < 1 || sel.value > inputMediaPrice.value){
        alert ("DPP harus lebih besar dari 0 dan lebih kecil dari harga..!!");
        sel.value = sel.defaultValue;
    }else{
        getSubTotal = Number(inputMediaPrice.value) + Number(inputPrintTotal) + Number(inputInstallTotal);
        var getMediaDpp = Number(sel.value);
        calculateTotalPrice(getSubTotal, getMediaDpp);
        inputDpp.value = sel.value;
    }
}

videotronDppChange = (sel) =>{
    if(sel.value < 1 || sel.value > inputMediaPrice.value){
        alert ("DPP harus lebih besar dari 0 dan lebih kecil dari harga..!!");
        sel.value = sel.defaultValue;
    }else{
        getSubTotal = Number(inputMediaPrice.value);
        var getMediaDpp = Number(sel.value);
        calculateTotalPrice(getSubTotal, getMediaDpp);
        inputDpp.value = sel.value;
    }
}

printPriceChange = (sel) =>{
    if(sel.value < 1){
        alert ("Harga harus lebih besar dari 0..!!");
        sel.value = sel.defaultValue;
    }else{
        var getPrintTotal = sel.value * getWide * Number(inputPrintQty.value);
        inputPrintTotal = getPrintTotal;
        document.getElementById("inputPrintTotal").value = inputPrintTotal;
    
        getSubTotal = Number(inputMediaPrice.value) + Number(inputPrintTotal) + Number(inputInstallTotal);
        var getMediaDpp = Number(getSubTotal);
        calculateTotalPrice(getSubTotal, getMediaDpp);
        quotationPrice.includedPrint.price = getPrintTotal;
    }
}

installPriceChange = (sel) =>{
    if(sel.value < 1){
        alert ("Harga harus lebih besar dari 0..!!");
        sel.value = sel.defaultValue;
    }else{
        var getInstallTotal = sel.value * getWide * Number(inputInstallQty.value);
        inputInstallTotal = getInstallTotal;
        document.getElementById("inputInstallTotal").value = inputInstallTotal;
    
        getSubTotal = Number(inputMediaPrice.value) + Number(inputPrintTotal) + Number(inputInstallTotal);
        var getMediaDpp = Number(getSubTotal);
        calculateTotalPrice(getSubTotal, getMediaDpp);
        quotationPrice.includedInstall.price = getInstallTotal;
    }
}

installQtyChange = (sel) =>{
    if(sel.value < 1){
        alert ("Jumlah harus lebih besar dari 0..!!");
        sel.value = sel.defaultValue;
    }else{
        var getInstallTotal = sel.value * getWide * Number(installPrice.value);
        inputInstallTotal = getInstallTotal;
        document.getElementById("inputInstallTotal").value = inputInstallTotal;
        
        getSubTotal = Number(inputMediaPrice.value) + Number(inputPrintTotal) + Number(inputInstallTotal);
        var getMediaDpp = getSubTotal;
        calculateTotalPrice(getSubTotal, getMediaDpp);
        inputFreeInstall.value = sel.value;
        quotationPrice.includedInstall.qty = sel.value;
    }
}

printQtyChange = (sel) =>{
    if(sel.value < 1){
        alert ("Jumlah harus lebih besar dari 0..!!");
        sel.value = sel.defaultValue;
    }else{
        var getPrintTotal = sel.value * getWide * Number(printPrice.value);
        inputPrintTotal = getPrintTotal;
        document.getElementById("inputPrintTotal").value = inputPrintTotal;
        
        getSubTotal = Number(inputMediaPrice.value) + Number(inputPrintTotal) + Number(inputInstallTotal);
        var getMediaDpp = getSubTotal;
        calculateTotalPrice(getSubTotal, getMediaDpp);
        inputFreePrint.value = sel.value;
        quotationPrice.includedPrint.qty = sel.value;
    }
}

selectPrintProduct = (sel) =>{
    if(sel.value == "pilih"){
        printPrice.value = 0;
        quotationPrice.includedPrint.product = "";
    }else{
        printPrice.value = sel.options[sel.selectedIndex].id;
        quotationPrice.includedPrint.product = sel.value;
    }
    
    var getPrintTotal = Number(printPrice.value) * getWide * Number(inputInstallQty.value);
    inputPrintTotal = getPrintTotal;
    document.getElementById("inputPrintTotal").value = inputPrintTotal;

    getSubTotal = Number(inputMediaPrice.value) + Number(inputPrintTotal) + Number(inputInstallTotal);
    var getMediaDpp = Number(getSubTotal);
    calculateTotalPrice(getSubTotal, getMediaDpp);
    quotationPrice.includedPrint.price = printPrice.value;
    quotationPrice.includedPrint.qty = inputPrintQty.value;
}

selectInstallProduct = (sel) =>{
    if(sel.value == "pilih"){
        installPrice.value = 0;
        quotationPrice.includedInstall.product = "";
    }else{
        installPrice.value = sel.options[sel.selectedIndex].id;
        quotationPrice.includedInstall.product = sel.value;
    }
    
    var getInstallTotal = Number(installPrice.value) * getWide * Number(inputInstallQty.value);
    inputInstallTotal = getInstallTotal;
    document.getElementById("inputInstallTotal").value = inputInstallTotal;

    getSubTotal = Number(inputMediaPrice.value) + Number(inputPrintTotal) + Number(inputInstallTotal);
    var getMediaDpp = Number(getSubTotal);
    calculateTotalPrice(getSubTotal, getMediaDpp);
    quotationPrice.includedInstall.price = installPrice.value;
    quotationPrice.includedInstall.qty = inputInstallQty.value;
}

cbIncludeInstallAction = (sel) =>{
    if(sel.checked == true){
        installProduct.value = installProductDefault;
        inputInstallQty.value = inputInstallQty.defaultValue;        
        selectInstallProduct(installProduct);
        installProduct.removeAttribute('disabled');
        installPrice.removeAttribute('disabled');
        inputInstallQty.removeAttribute('disabled');
        quotationPrice.includedInstall.checked = true;
        quotationPrice.includedInstall.price = installPrice.value;
        quotationPrice.includedInstall.qty = inputInstallQty.value;
        quotationPrice.includedInstall.product = installProduct.value;
        inputFreeInstall.value = inputInstallQty.value;
        inputFreeInstall.setAttribute('readonly', 'readonly');
    }else{
        installProduct.value = "pilih";
        inputInstallQty.value = inputInstallQty.defaultValue;
        selectInstallProduct(installProduct);
        installProduct.setAttribute('disabled', 'disabled');
        installPrice.setAttribute('disabled', 'disabled');
        inputInstallQty.setAttribute('disabled', 'disabled');
        quotationPrice.includedInstall.checked = false;
        quotationPrice.includedInstall.price = 0;
        quotationPrice.includedInstall.qty = 0;
        quotationPrice.includedInstall.product = "";
        inputFreeInstall.value = inputFreeInstall.defaultValue;
        inputFreeInstall.removeAttribute('readonly');
    }
}
cbIncludePrintAction = (sel) =>{
    if(sel.checked == true){
        printProduct.value = printProductDefault;
        inputPrintQty.value = inputPrintQty.defaultValue;
        selectPrintProduct(printProduct);
        printProduct.removeAttribute('disabled');
        printPrice.removeAttribute('disabled');
        inputPrintQty.removeAttribute('disabled');
        quotationPrice.includedPrint.checked = true;
        quotationPrice.includedPrint.price = printPrice.value;
        quotationPrice.includedPrint.qty = inputPrintQty.value;
        quotationPrice.includedPrint.product = printProduct.value;
        inputFreePrint.value = inputPrintQty.value;
        inputFreePrint.setAttribute('readonly', 'readonly');
    }else{
        printProduct.value = "pilih";
        inputPrintQty.value = inputPrintQty.defaultValue;
        selectPrintProduct(printProduct);
        printProduct.setAttribute('disabled', 'disabled');
        printPrice.setAttribute('disabled', 'disabled');
        inputPrintQty.setAttribute('disabled', 'disabled');
        quotationPrice.includedPrint.checked = false;
        quotationPrice.includedPrint.price = 0;
        quotationPrice.includedPrint.qty = 0;
        quotationPrice.includedPrint.product = "";
        inputFreePrint.value = inputFreePrint.defaultValue;
        inputFreePrint.removeAttribute('readonly');
    }
}

calculateTotalPrice = (subtotal, dpp) =>{
    var getPpnValue = dpp * (getPpn/100);
    getGrandTotal = subtotal + getPpnValue;

    inputMediaDpp.value = Number(dpp);
    
    tdSubTotal.innerHTML = subtotal.toLocaleString();
    tdPpn.innerHTML = getPpnValue.toLocaleString();
    tdGrandTotal.innerHTML = getGrandTotal.toLocaleString();
}

btnBillboardSubmitAction = () =>{
    if(quotationPrice.includedPrint.checked == true && printProduct.value == "pilih"){
        alert ("Bahan cetak belum dipilih..!!");        
    }else if(quotationPrice.includedInstall.checked == true && installProduct.value == "pilih"){
        alert ("Bahan pasang belum dipilih..!!");        
    }else if(inputNote.value == ""){
        alert ("Keterangan perubahan tidak boleh kosong..!!");
    }else{
        if(quotationPrice.includedPrint.checked == true){
            quotationPrice.freePrint = quotationPrice.includedPrint.qty;
        }
        if(quotationPrice.includedInstall.checked == true){
            quotationPrice.freeInstall = quotationPrice.includedInstall.qty;
        }
        quotationPrice.freeInstall = inputFreeInstall.value;
        quotationPrice.freePrint = inputFreePrint.value;
        inputQuotationPrice.value = JSON.stringify(quotationPrice);
        inputDpp.value = inputMediaDpp.value;
        inputPpnDiff.value = (inputDpp.value * (getPpn/100)) - (getSaleDpp * (getPpn/100));
        inputPrice.value = getSubTotal;
        inputPriceDiff.value = getSubTotal - getSalePrice;
        document.getElementById("formChangeSale").submit();
    }
}

btnVideotronSubmitAction = () =>{
    if(inputNote.value == ""){
        alert ("Keterangan perubahan tidak boleh kosong..!!");
    }else{
        inputQuotationPrice.value = JSON.stringify(quotationPrice);
        inputDpp.value = inputMediaDpp.value;
        inputPpnDiff.value = (inputDpp.value * (getPpn/100)) - (getSaleDpp * (getPpn/100));
        inputPrice.value = getSubTotal;
        inputPriceDiff.value = getSubTotal - getSalePrice;
        document.getElementById("formChangeSale").submit();
    }
}

