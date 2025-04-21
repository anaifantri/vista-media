const inputNote = document.getElementById("inputNote");
const inputPpn = document.getElementById("inputPpn");
const inputDpp = document.getElementById("inputDpp");
const inputQuotationPrice = document.getElementById("inputQuotationPrice");
const inputPrice = document.getElementById("inputPrice");
const inputPriceDiff = document.getElementById("inputPriceDiff");
const inputPpnDiff = document.getElementById("inputPpnDiff");

const tdSubTotal = document.getElementById("tdSubTotal");
const tdPpn = document.getElementById("tdPpn");
const tdGrandTotal = document.getElementById("tdGrandTotal");

const printProduct = document.getElementById("printProduct");
const printPrice = document.getElementById("printPrice");
const printTotal = document.getElementById("printTotal");
const installProduct = document.getElementById("installProduct");
const installPrice = document.getElementById("installPrice");
const installTotal = document.getElementById("installTotal");
const productSide = document.getElementById("productSide");
const productWide = document.getElementById("productWide");
const cbSide = document.querySelectorAll("[id=cbSide]");


var printProductDefault = printProduct.value;
var installProductDefault = installProduct.value;
var getTotalInstall = installPrice.value * Number(productWide.innerHTML);
var getTotalPrint = printPrice.value * Number(productWide.innerHTML);
var getSubTotal = getTotalInstall + getTotalPrint;
var getGrandTotal = 0;

cbPrintAction = (sel) =>{
    if(sel.checked == true){
        printProduct.value = printProductDefault;
        printPrice.value = printPrice.defaultValue;
        printPrice.removeAttribute('disabled');
        printProduct.removeAttribute('disabled');
        printTotal.innerHTML = (printPrice.value * quotationPrice.objSideView.wide).toLocaleString();
        quotationPrice.objServiceType.print = true;
        quotationPrice.objInstall.price = installPrice.value;
        quotationPrice.objPrint.price = printPrice.value;
        getTotalInstall = quotationPrice.objInstall.price * quotationPrice.objSideView.wide;
        getTotalPrint = quotationPrice.objPrint.price * quotationPrice.objSideView.wide;
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }else{
        if(document.getElementById("cbInstall").checked == false){
            alert ("Cetak/Pasang minimal terpilih salah satu..!!");
            sel.checked = true;
        }else{
            printProduct.value = "pilih";
            printPrice.value = 0;
            printPrice.setAttribute('disabled','disabled');
            printProduct.setAttribute('disabled','disabled');
            printTotal.innerHTML = 0;
            quotationPrice.objServiceType.print = false;
            quotationPrice.objInstall.price = installPrice.value;
            quotationPrice.objPrint.price = printPrice.value;
            getTotalInstall = quotationPrice.objInstall.price * quotationPrice.objSideView.wide;
            getTotalPrint = quotationPrice.objPrint.price * quotationPrice.objSideView.wide;
            calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
        }
    }
}

cbInstallAction = (sel) =>{
    if(sel.checked == true){
        installProduct.value = installProductDefault;
        installPrice.value = installPrice.defaultValue;
        installPrice.removeAttribute('disabled');
        installProduct.removeAttribute('disabled');
        installTotal.innerHTML = (installPrice.value * quotationPrice.objSideView.wide).toLocaleString();
        quotationPrice.objServiceType.install = true;
        quotationPrice.objInstall.price = installPrice.value;
        quotationPrice.objPrint.price = printPrice.value;
        getTotalInstall = quotationPrice.objInstall.price * quotationPrice.objSideView.wide;
        getTotalPrint = quotationPrice.objPrint.price * quotationPrice.objSideView.wide;
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }else{
        if(document.getElementById("cbPrint").checked == false){
            alert ("Cetak/Pasang minimal terpilih salah satu..!!");
            sel.checked = true;
        }else{
            installProduct.value = "pilih";
            installPrice.value = 0;
            installPrice.setAttribute('disabled','disabled');
            installProduct.setAttribute('disabled','disabled');
            installTotal.innerHTML = 0;
            quotationPrice.objServiceType.install = false;
            quotationPrice.objInstall.price = installPrice.value;
            quotationPrice.objPrint.price = printPrice.value;
            getTotalInstall = quotationPrice.objInstall.price * quotationPrice.objSideView.wide;
            getTotalPrint = quotationPrice.objPrint.price * quotationPrice.objSideView.wide;
            calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
        }
    }
}

calculateTotalPrice = (install, print, ppn) =>{
    getSubTotal = install + print;
    getDpp = getSubTotal;
    var getTdPpn = getDpp * (ppn/100);
    getGrandTotal = getSubTotal + getTdPpn;

    tdSubTotal.innerHTML = getSubTotal.toLocaleString();
    tdPpn.innerHTML = getTdPpn.toLocaleString();
    tdGrandTotal.innerHTML = getGrandTotal.toLocaleString();
}

cbSideAction = (sel) =>{
    cbChecked = false;
    for(let i = 0; i < cbSide.length;i++){
        if(cbSide[i].checked == true){
            cbChecked = true;
        }
    }

    if(cbChecked == false){
        alert ("Pilih minimal salah satu sisi..!!");
        sel.checked = true;
    }else{
        if (sel.checked == true) {
            quotationPrice.objSideView.side = 2;
            quotationPrice.objSideView.wide = 2 * product.width * product.height;
            productSide.innerHTML = quotationPrice.objSideView.side;
            productWide.innerHTML = quotationPrice.objSideView.wide;
            getTotalInstall = installPrice.value * quotationPrice.objSideView.wide;
            getTotalPrint = printPrice.value * quotationPrice.objSideView.wide;
            installTotal.innerHTML = getTotalInstall.toLocaleString();
            printTotal.innerHTML = getTotalPrint.toLocaleString();
            calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
            if(sel.value == "right"){
                quotationPrice.objSideView.right = true;
            }else if(sel.value == "left"){
                quotationPrice.objSideView.left = true;
            }
        }else{
            quotationPrice.objSideView.side = 1;
            quotationPrice.objSideView.wide = product.width * product.height;
            productSide.innerHTML = quotationPrice.objSideView.side;
            productWide.innerHTML = quotationPrice.objSideView.wide;
            getTotalInstall = installPrice.value * quotationPrice.objSideView.wide;
            getTotalPrint = printPrice.value * quotationPrice.objSideView.wide;
            installTotal.innerHTML = getTotalInstall.toLocaleString();
            printTotal.innerHTML = getTotalPrint.toLocaleString();
            calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph); 
            if(sel.value == "right"){
                quotationPrice.objSideView.right = false;
            }else if(sel.value == "left"){
                quotationPrice.objSideView.left = false;
            }
        }
    }
}

selectPrintProductAction = (sel) =>{
    if (sel.value == "pilih") {
        printPrice.value = 0;
        getTotalPrint = printPrice.value * quotationPrice.objSideView.wide;
        printTotal.innerHTML = getTotalPrint.toLocaleString();
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);        
    }else{
        printPrice.value = Number(sel.options[sel.selectedIndex].id);
        getTotalPrint = printPrice.value * quotationPrice.objSideView.wide;
        printTotal.innerHTML = getTotalPrint.toLocaleString();
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }
}

selectInstallProductAction = (sel) =>{
    if (sel.value == "pilih") {
        installPrice.value = 0;
        getTotalInstall = installPrice.value * quotationPrice.objSideView.wide;
        installTotal.innerHTML = getTotalInstall.toLocaleString();
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);        
    }else{
        installPrice.value = Number(sel.options[sel.selectedIndex].id);
        getTotalInstall = installPrice.value * quotationPrice.objSideView.wide;
        installTotal.innerHTML = getTotalInstall.toLocaleString();
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }
}

installPriceChanged = (sel) =>{
    if(sel.value == 0 || sel.value == ""){
        alert ("Input harga tidak boleh kosong");
        sel.value = sel.defaultValue;
        getTotalInstall = sel.value * quotationPrice.objSideView.wide;
        installTotal.innerHTML = getTotalInstall.toLocaleString();
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }else{
        getTotalInstall = sel.value * quotationPrice.objSideView.wide;
        installTotal.innerHTML = getTotalInstall.toLocaleString();
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }
}

printPriceChanged = (sel) =>{
    if(sel.value == 0 || sel.value == ""){
        alert ("Input harga tidak boleh kosong");
        sel.value = sel.defaultValue;
        getTotalPrint = sel.value * quotationPrice.objSideView.wide;
        printTotal.innerHTML = getTotalPrint.toLocaleString();
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }else{
        getTotalPrint = sel.value * quotationPrice.objSideView.wide;
        printTotal.innerHTML = getTotalPrint.toLocaleString();
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }
}

setPpn = (sel) =>{
    if(sel.value == 0 || sel.value == ""){
        alert ("Input ppn tidak boleh kosong");
        sel.value = sel.defaultValue;
        getPpn = sel.value;
        tdPpn.innerHTML = sel.value/100 * getSubTotal;
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }else{
        getPpn = sel.value;
        tdPpn.innerHTML = sel.value/100 * getSubTotal;
        calculateTotalPrice(getTotalInstall,getTotalPrint,getPpn,getPph);
    }
}

getNote = (sel) =>{
    quotationPrice.serviceNote = sel.value;
}

btnSubmitAction = () =>{
    if(quotationPrice.objServiceType.print == true && printProduct.value == "pilih"){
        alert ("Bahan cetak belum dipilih..!!");        
    }else if(quotationPrice.objServiceType.install == true && installProduct.value == "pilih"){
        alert ("Bahan pasang belum dipilih..!!");        
    }else if(inputNote.value == ""){
        alert ("Keterangan perubahan tidak boleh kosong..!!");
    }else{
        inputQuotationPrice.value = JSON.stringify(quotationPrice);
        inputDpp.value = getSubTotal;
        inputPpnDiff.value = (inputDpp.value * (getPpn/100)) - (getSaleDpp * (getPpn/100));
        inputPrice.value = getSubTotal;
        inputPriceDiff.value = getSubTotal - getSalePrice;
    
        document.getElementById("formChangeSale").submit();
    }
}