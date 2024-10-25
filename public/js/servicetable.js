const locationQty = document.getElementById("locationQty");
const installPrice = document.querySelectorAll('[id=installPrice]');
const installTotal = document.querySelectorAll('[id=installTotal]');
const selectPrint = document.querySelectorAll('[id=selectPrint]');
const locationCode = document.querySelectorAll('[id=locationCode]');
const locationSide = document.querySelectorAll('[id=locationSide]');
const locationWidth = document.querySelectorAll('[id=locationWidth]');
const locationHeight = document.querySelectorAll('[id=locationHeight]');
const productSide = document.querySelectorAll('[id=productSide]');
const installProduct = document.querySelectorAll('[id=installProduct]');
const wide = document.querySelectorAll('[id=wide]');
const cbRight = document.querySelectorAll('[id=cbRight]');
const cbLeft = document.querySelectorAll('[id=cbLeft]');
const serviceTbody = document.getElementById("serviceTBody");
const serviceTBodyRows = serviceTbody.getElementsByTagName("tr");

let objServiceType = {
    print : true,
    install : true
}
let objServicePpn = {
    status : true,
    value : 11
}
let objSideView = {};
let dataSideView = [];
let objPrints = {};
let dataPrints = [];
let objInstalls = {};
let dataInstalls = [];

selectPrintProduct = (sel) =>{
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    
    if(sel.value != "pilih"){
        printPrice[index].removeAttribute('disabled');
        printPrice[index].value = Number(sel.options[sel.selectedIndex].id);
        var printTotalPrice = Number(sel.options[sel.selectedIndex].id) * Number(wide[index].innerHTML)
        printTotal[index].value = printTotalPrice;
    }else{
        printPrice[index].setAttribute('disabled','disabled');
        printPrice[index].value = 0;
        printTotal[index].value = 0;
    }

    countServicePrice();
}

getSideView = () =>{
    for(let i = 0; i < Number(locationQty.value); i++){
        if(productSide[i].value = "2"){
            dataSideView[i] =  {
                left : cbLeft[i].checked,
                right : cbRight[i].checked,
                side : locationSide[i].value,
                wide : Number(wide[i].innerText)
            }
        }else{
            dataSideView[i] =  {
                left : true,
                right : false,
                side : locationSide[i].value,
                wide : Number(wide[i].innerText)
            }
        }
    }
    objSideView = dataSideView;
}
getTotalInstall = () =>{
    let subTotalInstall = 0;
    for(let i = 0; i < Number(locationQty.value); i++){
        if(document.getElementById("cbInstall").checked == true){
            dataInstalls[i] =  {
                code : parseInt(locationCode[i].innerHTML.replace ( /[^\d.]/g, '' )),
                price : installPrice[i].value,
                type : installProduct[i].innerText,
            }
        }else{
            dataInstalls[i] =  {
                code : "",
                price : 0,
                type : "",
            }
        }
    
    subTotalInstall = subTotalInstall + Number(installTotal[i].value);
    }

    objInstalls = dataInstalls
    return subTotalInstall;
}

getTotalPrint = () =>{
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    let subTotalPrint = 0;
    for(let i = 0; i < Number(locationQty.value); i++){
        if(document.getElementById("cbPrint").checked == true){
            dataPrints[i] =  {
                code : parseInt(locationCode[i].innerHTML.replace ( /[^\d.]/g, '' )),
                price : printPrice[i].value,
                printProduct : selectPrint[i].value
            }
        }else{
            dataPrints[i] =  {
                code : "",
                price : 0,
                printProduct : ""
            }
        }
        
        subTotalPrint = subTotalPrint + Number(printTotal[i].value);
    }
    objPrints = dataPrints;
    return subTotalPrint;
}

cbPrintAction = (sel) =>{
    if(document.getElementById("cbInstall").checked == false){
        alert("Pilih salah satu atau kedua opsi penawaran..!!");
        sel.checked = true;
    }else{
        if(sel.checked == true){
            for(let i = 0; i < serviceTBodyRows.length; i++){
                if(i % 2 != 0 && i < serviceTBodyRows.length - 3){
                    serviceTBodyRows[i-1].cells[2].innerHTML = serviceTBodyRows[i].cells[4].innerHTML;
                    serviceTBodyRows[i-1].cells[3].innerHTML = serviceTBodyRows[i].cells[5].innerHTML;
                    serviceTBodyRows[i-1].cells[6].innerHTML = serviceTBodyRows[i].cells[6].innerHTML;
                    serviceTBodyRows[i-1].cells[7].innerHTML = serviceTBodyRows[i].cells[7].innerHTML;
                    serviceTBodyRows[i].deleteCell(7);
                    serviceTBodyRows[i].deleteCell(6);
                    serviceTBodyRows[i].deleteCell(5);
                    serviceTBodyRows[i].deleteCell(4);
                    serviceTBodyRows[i-1].cells[0].setAttribute('rowspan', '2');
                    serviceTBodyRows[i-1].cells[1].setAttribute('rowspan', '2');
                    serviceTBodyRows[i-1].cells[4].setAttribute('rowspan', '2');
                    serviceTBodyRows[i-1].cells[5].setAttribute('rowspan', '2');
                    serviceTBodyRows[i].removeAttribute('hidden', 'hidden');
                }
            }
        }else{
            for(let i = 0; i < serviceTBodyRows.length; i++){
                if(i % 2 != 0 && i < serviceTBodyRows.length - 3){ 
                    serviceTBodyRows[i].insertCell(4);
                    serviceTBodyRows[i].cells[4].innerHTML = serviceTBodyRows[i-1].cells[2].innerHTML;
                    serviceTBodyRows[i].cells[4].setAttribute('hidden', 'hidden');
                    serviceTBodyRows[i].insertCell(5);
                    serviceTBodyRows[i].cells[5].innerHTML = serviceTBodyRows[i-1].cells[3].innerHTML;
                    serviceTBodyRows[i].cells[5].setAttribute('hidden', 'hidden');
                    serviceTBodyRows[i].insertCell(6);
                    serviceTBodyRows[i].cells[6].innerHTML = serviceTBodyRows[i-1].cells[6].innerHTML;
                    serviceTBodyRows[i].cells[6].setAttribute('hidden', 'hidden');
                    serviceTBodyRows[i].insertCell(7);
                    serviceTBodyRows[i].cells[7].innerHTML = serviceTBodyRows[i-1].cells[7].innerHTML;
                    serviceTBodyRows[i].cells[7].setAttribute('hidden', 'hidden');
                    serviceTBodyRows[i-1].cells[2].innerHTML = serviceTBodyRows[i].cells[0].innerHTML;
                    serviceTBodyRows[i-1].cells[3].innerHTML = serviceTBodyRows[i].cells[1].innerHTML;
                    serviceTBodyRows[i-1].cells[6].innerHTML = serviceTBodyRows[i].cells[2].innerHTML;
                    serviceTBodyRows[i-1].cells[7].innerHTML = serviceTBodyRows[i].cells[3].innerHTML;
                    serviceTBodyRows[i-1].cells[0].removeAttribute('rowspan');
                    serviceTBodyRows[i-1].cells[1].removeAttribute('rowspan');
                    serviceTBodyRows[i-1].cells[4].removeAttribute('rowspan');
                    serviceTBodyRows[i-1].cells[5].removeAttribute('rowspan');
                    serviceTBodyRows[i].setAttribute('hidden', 'hidden');
                }
            }
        }
        for(let i = 0; i < Number(locationQty.value);i++){
            if(sel.checked == true){
                selectPrint[i].removeAttribute('disabled');
            }else{
                selectPrint[i].setAttribute('disabled', 'disabled');
                printPrice[i].value = 0;
                printTotal[i].value = 0;
                selectPrint[i].options[0].selected = true;
                printPrice[i].setAttribute('disabled', 'disabled');
            }
        }
        countServicePrice();
        if(sel.checked == true){
            objServiceType.print = true;
        }else{
            objServiceType.print = false;
        }
    }
}

cbInstallAction = (sel) =>{
    if(document.getElementById("cbPrint").checked == false){
        alert("Pilih salah satu atau kedua opsi penawaran..!!");
        sel.checked = true;
    }else{
        for(let i = 0; i < Number(locationQty.value);i++){
            if(sel.checked == true){
                installPrice[i].removeAttribute('disabled');
                installPrice[i].value = installPrice[i].defaultValue;
                installTotal[i].value = installTotal[i].defaultValue;
            }else{
                installPrice[i].setAttribute('disabled', 'disabled');
                installPrice[i].value = 0;
                installTotal[i].value = "0";
            }
        }

        if(sel.checked == true){
            for(let i = 0; i < serviceTBodyRows.length; i++){
                if(i % 2 != 0 && i < serviceTBodyRows.length - 3){
                    serviceTBodyRows[i-1].cells[0].setAttribute('rowspan', "2");
                    serviceTBodyRows[i-1].cells[1].setAttribute('rowspan', "2");
                    serviceTBodyRows[i-1].cells[4].setAttribute('rowspan', "2");
                    serviceTBodyRows[i-1].cells[5].setAttribute('rowspan', "2");
                    serviceTBodyRows[i].removeAttribute('hidden');
                }
            }
        }else{
            for(let i = 0; i < serviceTBodyRows.length; i++){
                if(i % 2 != 0 && i < serviceTBodyRows.length - 3){ 
                    serviceTBodyRows[i-1].cells[0].removeAttribute('rowspan');
                    serviceTBodyRows[i-1].cells[1].removeAttribute('rowspan');
                    serviceTBodyRows[i-1].cells[4].removeAttribute('rowspan');
                    serviceTBodyRows[i-1].cells[5].removeAttribute('rowspan');
                    serviceTBodyRows[i].setAttribute('hidden', 'hidden');
                }
            }
        }

        countServicePrice();
        if(sel.checked == true){
            objServiceType.install = true;
        }else{
            objServiceType.install = false;
        }
    }
}

cbPpnAction = (sel) =>{
    const ppnNote = document.getElementById("ppnNote");
    if(sel.checked == true){
        ppnNote.value = "- Biaya di atas sudah termasuk PPN";
        inputPpn.value = inputPpn.defaultValue;
        inputPpn.removeAttribute('disabled');
        objServicePpn.status = true;
        objServicePpn.value = document.getElementById("inputPpn").value;
        countServicePrice();
    }else{
        ppnNote.value = "- Biaya di atas belum termasuk PPN";
        inputPpn.value = 0;
        inputPpn.setAttribute('disabled', 'disabled');
        objServicePpn.status = false;
        objServicePpn.value = 0;
        countServicePrice();
    }
}

setServicePpn = () =>{
    countServicePrice();
}

countServicePrice = () =>{
    var subTotal = Number(getTotalInstall()) + Number(getTotalPrint());
    var ppnValue = subTotal * (document.getElementById("inputPpn").value / 100);
    document.getElementById("subTotal").innerHTML = subTotal;
    document.getElementById("servicePpn").innerHTML = ppnValue;
    document.getElementById("serviceGrandTotal").innerHTML = subTotal + ppnValue;
}

printProductCheck = () =>{
    if(document.getElementById("cbPrint").checked == true){
        getTotalPrint();
        for(let i = 0; i < dataPrints.length; i++){
            if(dataPrints[i].price == 0){
                return false;
            }
        }
    }
}

installPriceCheck = () =>{
    if(document.getElementById("cbInstall").checked == true){
        getTotalInstall();
        for(let i = 0; i < dataInstalls.length; i++){
            if(dataInstalls[i].price == 0){
                return false;
            }
        }
    }
}

fillServiceData = () =>{
    const price = document.getElementById("price");
    let objPrice = {};

    getTotalInstall();
    getTotalPrint();
    getSideView();

    objPrice = {objInstalls, objPrints, objServicePpn, objServiceType, objSideView};
    price.value = JSON.stringify(objPrice);
}

cbLeftAction = (sel) =>{
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(cbRight[index].checked == false){
        alert("Pilih salah satu atau kedua sisi..!!");
        sel.checked = true;
    }else{
        if(cbLeft[index].checked == true && sel.checked == true){
            locationSide[index].value = "2";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 2;
            printTotal[index].value = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 2 * printPrice[index].value;
            installTotal[index].value = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 2 * installPrice[index].value;
        }else{
            locationSide[index].value = "1";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 1;
            printTotal[index].value = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 1 * printPrice[index].value;
            installTotal[index].value = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 1 * installPrice[index].value;
        }
        getSideView();
    }
}

cbRightAction = (sel) =>{
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(cbLeft[index].checked == false){
        alert("Pilih salah satu atau kedua sisi..!!");
        sel.checked = true;
    }else{
        if(cbLeft[index].checked == true && sel.checked == true){
            locationSide[index].value = "2";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 2;
            printTotal[index].value = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 2 * printPrice[index].value;
            installTotal[index].value = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 2 * installPrice[index].value;
        }else{
            locationSide[index].value = "1";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 1;
            printTotal[index].value = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 1 * printPrice[index].value;
            installTotal[index].value = Number(locationWidth[index].value) * Number(locationHeight[index].value) * 1 * installPrice[index].value;
        }
        getSideView();
    }
}

installPriceChanged = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));

    installTotal[index].value = Number(sel.value) * Number(wide[index].innerText);

    countServicePrice();
}

printPriceChanged = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));

    printTotal[index].value = Number(sel.value) * Number(wide[index].innerText);

    countServicePrice();
}