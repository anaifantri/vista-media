const locationQty = document.getElementById("locationQty");
const printPrice = document.querySelectorAll('[id=printPrice]');
const installPrice = document.querySelectorAll('[id=installPrice]');
const installTotal = document.querySelectorAll('[id=installTotal]');
const printTotal = document.querySelectorAll('[id=printTotal]');
const selectPrint = document.querySelectorAll('[id=selectPrint]');
const locationCode = document.querySelectorAll('[id=locationCode]');
const locationSide = document.querySelectorAll('[id=locationSide]');
const locationWidth = document.querySelectorAll('[id=locationWidth]');
const locationHeight = document.querySelectorAll('[id=locationHeight]');
const productSide = document.querySelectorAll('[id=productSide]');
const installProduct = document.querySelectorAll('[id=installProduct]');
const wide = document.querySelectorAll('[id=wide]');
const qty = document.querySelectorAll('[id=qty]');
const cbRight = document.querySelectorAll('[id=cbRight]');
const cbLeft = document.querySelectorAll('[id=cbLeft]');
const serviceTBody = document.getElementById("serviceTBody");
const serviceTBodyRows = serviceTBody.getElementsByTagName("tr");
const serviceTypeInstall = document.getElementById("serviceTypeInstall");
const serviceTypePrint = document.getElementById("serviceTypePrint");

let objPrice = JSON.parse(price.value);

let objServiceType = {
    print : serviceTypePrint.value,
    install : serviceTypeInstall.value
}
let objServicePpn = {
    status : true,
    value : 11
}
let objSideView = {};
let dataSideView = [];
// let objPrints = {};
let objPrints = [];
// let objInstalls = {};
let objInstalls = [];
let dataServiceNotes = [];

selectPrintProduct = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    
    if(sel.value != "pilih"){
        printPrice[index].value = Number(sel.options[sel.selectedIndex].id);
        var printTotalPrice = Number(sel.options[sel.selectedIndex].id) * Number(wide[index].innerHTML);
        printTotal[index].innerHTML = printTotalPrice;
    }

    countServicePrice();
}

getSideView = () =>{
    for(let i = 0; i < Number(locationQty.value); i++){
        if(productSide[i].value = "2"){
            dataSideView[i] =  {
                left : cbLeft[i].checked,
                right : cbRight[i].checked,
                side : locationSide[i].innerText,
                wide : Number(wide[i].innerText)
            }
        }else{
            dataSideView[i] =  {
                left : true,
                right : false,
                side : locationSide[i].innerText,
                wide : Number(wide[i].innerText)
            }
        }
    }
    objSideView = dataSideView;
    objPrice.objSideView = objSideView;
    price.value = JSON.stringify(objPrice);
}
getTotalInstall = () =>{
    const installPrice = document.querySelectorAll('[id=installPrice]');
    const installTotal = document.querySelectorAll('[id=installTotal]');
    const freeInstalls = document.querySelectorAll('[id=freeInstalls]');
    const locationCode = document.querySelectorAll('[id=locationCode]');
    const installProduct = document.querySelectorAll('[id=installProduct]');
    let subTotalInstall = 0;
    for(let i = 0; i < Number(locationQty.value); i++){
        if(document.getElementById("cbInstall").checked == true){
            objInstalls[i] =  {
                code : locationCode[i].value,
                price : installPrice[i].value,
                type : installProduct[i].innerText,
                freeInstall : freeInstalls[i].value
            }
            subTotalInstall = subTotalInstall + parseInt(installTotal[i].innerText.replace ( /[^\d.]/g, '' ));
        }else{
            objInstalls[i] =  {
                code : "",
                price : 0,
                type : "",
                freeInstall : freeInstalls[i].value
            }
        }
    }

    // objInstalls = objInstalls;
    objPrice.objInstalls = objInstalls;
    price.value = JSON.stringify(objPrice);
    
    return subTotalInstall;
}

getTotalPrint = () =>{
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    const selectPrint = document.querySelectorAll('[id=selectPrint]');
    const locationCode = document.querySelectorAll('[id=locationCode]');
    let subTotalPrint = 0;
    for(let i = 0; i < Number(locationQty.value); i++){
        if(document.getElementById("cbPrint").checked == true){
            objPrints[i] =  {
                code : locationCode[i].value,
                price : printPrice[i].value,
                printProduct : selectPrint[i].value
            }
            subTotalPrint = subTotalPrint + parseInt(printTotal[i].innerText.replace ( /[^\d.]/g, '' ));
        }else{
            objPrints[i] =  {
                code : "",
                price : 0,
                printProduct : ""
            }
        }
    }
    // objPrints = objPrints;
    objPrice.objPrints = objPrints;
    price.value = JSON.stringify(objPrice);
    return subTotalPrint;
}

getServiceNote = () => {
    const serviceNotes = document.querySelectorAll('[id=serviceNotes]');
    const locationCode = document.querySelectorAll('[id=locationCode]');

    for(let i = 0; i < serviceNotes.length; i++){
        dataServiceNotes[i] = {
            code : locationCode[i].value,
            serviceNote : serviceNotes[i].value
        }
    }
}

cbPrintAction = (sel) =>{
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    const selectPrint = document.querySelectorAll('[id=selectPrint]');
    if(document.getElementById("cbInstall").checked == false){
        alert("Pilih salah satu atau kedua opsi penawaran..!!");
        sel.checked = true;
    }else{
        for(let i = 0; i < Number(locationQty.value);i++){
            if(sel.checked == true){
                selectPrint[i].removeAttribute('disabled');
                printPrice[i].value = printPrice[i].defaultValue;
                printTotal[i].innerText = printPrice[i].value * Number(wide[i].innerHTML);
                selectPrint[i].options[0].selected = true;
                printPrice[i].removeAttribute('disabled');
            }else{
                selectPrint[i].setAttribute('disabled', 'disabled');
                printPrice[i].value = 0;
                printTotal[i].innerText = 0;
                selectPrint[i].options[0].selected = true;
                printPrice[i].setAttribute('disabled', 'disabled');
            }
        }
        if(sel.checked == true){
            for(let i = 0; i < serviceTBodyRows.length; i++){
                if(i % 2 != 0 && i < serviceTBodyRows.length - 3){
                    serviceTBodyRows[i].deleteCell(5);
                    serviceTBodyRows[i].deleteCell(4);
                    serviceTBodyRows[i].deleteCell(1);
                    serviceTBodyRows[i].deleteCell(0);
                    serviceTBodyRows[i-1].removeAttribute('hidden');
                }
            }
        }else{
            for(let i = 0; i < serviceTBodyRows.length; i++){
                if(i % 2 != 0 && i < serviceTBodyRows.length - 3){ 
                    serviceTBodyRows[i].insertCell(0);
                    serviceTBodyRows[i].cells[0].classList.add("td-service-center");
                    serviceTBodyRows[i].cells[0].innerHTML = serviceTBodyRows[i-1].cells[0].innerHTML;
                    serviceTBodyRows[i].insertCell(1);
                    serviceTBodyRows[i].cells[1].classList.add("td-service-normal");
                    serviceTBodyRows[i].cells[1].innerHTML = serviceTBodyRows[i-1].cells[1].innerHTML;
                    serviceTBodyRows[i].insertCell(4);
                    serviceTBodyRows[i].cells[4].classList.add("td-service-center");
                    serviceTBodyRows[i].cells[4].setAttribute('hidden', 'hidden');
                    serviceTBodyRows[i].cells[4].setAttribute('hidden', 'hidden');
                    serviceTBodyRows[i].cells[4].innerHTML = serviceTBodyRows[i-1].cells[4].innerHTML;
                    serviceTBodyRows[i].insertCell(5);
                    serviceTBodyRows[i].cells[5].classList.add("td-service-center");
                    serviceTBodyRows[i].cells[5].setAttribute('id', 'wide');
                    serviceTBodyRows[i].cells[5].innerHTML = serviceTBodyRows[i-1].cells[5].innerHTML;
                    serviceTBodyRows[i].cells[0].removeAttribute('rowspan');
                    serviceTBodyRows[i].cells[1].removeAttribute('rowspan');
                    serviceTBodyRows[i].cells[4].removeAttribute('rowspan');
                    serviceTBodyRows[i].cells[5].removeAttribute('rowspan');
                    serviceTBodyRows[i-1].setAttribute('hidden', 'hidden');
                }
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
    const installPrice = document.querySelectorAll('[id=installPrice]');
    const installTotal = document.querySelectorAll('[id=installTotal]');
    if(document.getElementById("cbPrint").checked == false){
        alert("Pilih salah satu atau kedua opsi penawaran..!!");
        sel.checked = true;
    }else{
        for(let i = 0; i < Number(locationQty.value);i++){
            if(sel.checked == true){
                installPrice[i].removeAttribute('disabled');
                installPrice[i].value = installPrice[i].defaultValue;
                installTotal[i].innerText = installPrice[i].value * Number(wide[i].innerHTML);
            }else{
                installPrice[i].setAttribute('disabled', 'disabled');
                installPrice[i].value = 0;
                installTotal[i].innerText = "0";
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
    if(serviceTypeInstall.value == true && serviceTypePrint.value == true){
        var subTotal = Number(getTotalInstall()) + Number(getTotalPrint());
    }else if(serviceTypeInstall.value == false && serviceTypePrint.value == true){
        var subTotal = Number(getTotalPrint());
    }else if(serviceTypeInstall.value == true && serviceTypePrint.value == false){
        var subTotal = Number(getTotalInstall());
    }
    
    var ppnValue = subTotal * (document.getElementById("inputPpn").value / 100);
    document.getElementById("subTotal").innerHTML = subTotal.toLocaleString();
    document.getElementById("servicePpn").innerHTML = ppnValue.toLocaleString();
    document.getElementById("serviceGrandTotal").innerHTML = (subTotal + ppnValue).toLocaleString();
}

printProductCheck = () =>{
    if(document.getElementById("cbPrint").checked == true){
        getTotalPrint();
        for(let i = 0; i < objPrints.length; i++){
            if(objPrints[i].price == 0){
                return false;
            }
        }
    }
}

installPriceCheck = () =>{
    if(document.getElementById("cbInstall").checked == true){
        getTotalInstall();
        for(let i = 0; i < objInstalls.length; i++){
            if(objInstalls[i].price == 0){
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
    getServiceNote();

    objPrice = {objInstalls, objPrints, objServicePpn, objServiceType, objSideView, dataServiceNotes};
    price.value = JSON.stringify(objPrice);
}

cbLeftAction = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(cbRight[index].checked == false){
        alert("Pilih salah satu atau kedua sisi..!!");
        sel.checked = true;
    }else{
        if(cbLeft[index].checked == true && sel.checked == true){
            locationSide[index].innerText = "2";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * qty[index].value * 2;
            printTotal[index].innerText = (Number(wide[index].innerText) * printPrice[index].value).toLocaleString();
            installTotal[index].innerText = (Number(wide[index].innerText) * installPrice[index].value).toLocaleString();
        }else{
            locationSide[index].innerText = "1";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * qty[index].value * 1;
            printTotal[index].innerText = (Number(wide[index].innerText) * printPrice[index].value).toLocaleString();
            installTotal[index].innerText = (Number(wide[index].innerText) * installPrice[index].value).toLocaleString();
        }
        getSideView();
        countServicePrice();
    }
}

cbRightAction = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(cbLeft[index].checked == false){
        alert("Pilih salah satu atau kedua sisi..!!");
        sel.checked = true;
    }else{
        if(cbLeft[index].checked == true && sel.checked == true){
            locationSide[index].innerText = "2";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * Number(qty[index].value) * 2;
            printTotal[index].innerText= (Number(wide[index].innerText) * printPrice[index].value).toLocaleString();
            installTotal[index].innerText = (Number(wide[index].innerText) * installPrice[index].value).toLocaleString();
        }else{
            locationSide[index].innerText = "1";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * Number(qty[index].value) * 1;
            printTotal[index].innerText = (Number(wide[index].innerText) * printPrice[index].value).toLocaleString();
            installTotal[index].innerText = (Number(wide[index].innerText) * installPrice[index].value).toLocaleString();
        }
        getSideView();
        countServicePrice();
    }
}

qtyChangeAction = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * Number(sel.value) * Number(locationSide[index].innerText);
    if(printPrice[index]){
        printTotal[index].innerText= (Number(wide[index].innerText) * printPrice[index].value).toLocaleString();
    }
    if(installPrice[index]){
        installTotal[index].innerText = (Number(wide[index].innerText) * installPrice[index].value).toLocaleString();
    }
    countServicePrice();
}

installPriceChanged = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));

    installTotal[index].innerHTML = Number(sel.value) * Number(wide[index].innerText);

    countServicePrice();
}

printPriceChanged = (sel) =>{
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));

    printTotal[index].innerHTML = Number(sel.value) * Number(wide[index].innerText);

    countServicePrice();
}


changeProductQty = (sel) => {
    const usedFree = document.getElementById("usedFree");
    const totalFree = document.getElementById("totalFree");
    var getFree = Number(usedFree.value)+Number(sel.value);
    if(usedFree.value < totalFree.value){
        if(sel.value == 0){
            alert("Jumlah minimal 1");
            sel.value = 1;
        }else if(locationQty.value < sel.value && getFree <= totalFree.value){
            var node = serviceTBody.rows[0].cloneNode(true);
            var node2 = serviceTBody.rows[1].cloneNode(true);
            node.cells[0].innerText = sel.value;
            serviceTBody.insertBefore(node, serviceTBody.rows[serviceTBody.rows.length - 3]);
            serviceTBody.insertBefore(node2, serviceTBody.rows[serviceTBody.rows.length - 3]);
            locationQty.value = sel.value;
            
            const installPrice = document.querySelectorAll('[id=installPrice]');
            const selectPrint = document.querySelectorAll('[id=selectPrint]');
            const printPrice = document.querySelectorAll('[id=printPrice]');
            for(let i =0; i < sel.value; i++){
                installPrice[i].name = "instalPrice" + i;
                selectPrint[i].name = "printing_product" + i;
                printPrice[i].name = "printPrice" + i;
            }
            countServicePrice();
            const installProduct = document.querySelectorAll('[id=installProduct]');
            installProduct[sel.value - 1].innerText = "Free ke " + getFree + " dari " + totalFree.value;
            objProducts.push(objProducts[0]);
            document.getElementById("products").value = JSON.stringify(objProducts);
        }else if(locationQty.value < sel.value && getFree > totalFree.value){
            alert("Jumlah maksimal melebihi free pasang");
            sel.value = sel.value - 1;
        }else{
            serviceTBody.removeChild(serviceTBody.children[serviceTBody.children.length - 4]);
            serviceTBody.removeChild(serviceTBody.children[serviceTBody.children.length - 4]);
            
            locationQty.value = sel.value;
            const installPrice = document.querySelectorAll('[id=installPrice]');
            const selectPrint = document.querySelectorAll('[id=selectPrint]');
            const printPrice = document.querySelectorAll('[id=printPrice]');
            for(let i =0; i < sel.value; i++){
                installPrice[i].name = "instalPrice" + i;
                selectPrint[i].name = "printing_product" + i;
                printPrice[i].name = "printPrice" + i;
            }
            countServicePrice();
            objProducts.splice(objProducts.length - 1, 1);
            objPrints.splice(objPrints.length - 1, 1);
            objInstalls.splice(objInstalls.length - 1, 1);
            document.getElementById("products").value = JSON.stringify(objProducts);
        }
    }else{
        if(sel.value == 0){
            alert("Jumlah minimal 1");
            sel.value = 1;
        }else if(locationQty.value < sel.value){
            var node = serviceTBody.rows[0].cloneNode(true);
            var node2 = serviceTBody.rows[1].cloneNode(true);
            node.cells[0].innerText = sel.value;
            serviceTBody.insertBefore(node, serviceTBody.rows[serviceTBody.rows.length - 3]);
            serviceTBody.insertBefore(node2, serviceTBody.rows[serviceTBody.rows.length - 3]);
            locationQty.value = sel.value;
            
            const installPrice = document.querySelectorAll('[id=installPrice]');
            const selectPrint = document.querySelectorAll('[id=selectPrint]');
            const printPrice = document.querySelectorAll('[id=printPrice]');
            for(let i =0; i < sel.value; i++){
                installPrice[i].name = "instalPrice" + i;
                selectPrint[i].name = "printing_product" + i;
                printPrice[i].name = "printPrice" + i;
            }
            countServicePrice();
            objProducts.push(objProducts[0]);
            document.getElementById("products").value = JSON.stringify(objProducts);
        }else{
            serviceTBody.removeChild(serviceTBody.children[serviceTBody.children.length - 4]);
            serviceTBody.removeChild(serviceTBody.children[serviceTBody.children.length - 4]);
            
            locationQty.value = sel.value;
            const installPrice = document.querySelectorAll('[id=installPrice]');
            const selectPrint = document.querySelectorAll('[id=selectPrint]');
            const printPrice = document.querySelectorAll('[id=printPrice]');
            for(let i =0; i < sel.value; i++){
                installPrice[i].name = "instalPrice" + i;
                selectPrint[i].name = "printing_product" + i;
                printPrice[i].name = "printPrice" + i;
            }
            countServicePrice();
            objProducts.splice(objProducts.length - 1, 1);
            objPrints.splice(objPrints.length - 1, 1);
            objInstalls.splice(objInstalls.length - 1, 1);
            document.getElementById("products").value = JSON.stringify(objProducts);
        }
    }
}