const locationQty = document.getElementById("locationQty");
const installPrice = document.querySelectorAll('[id=installPrice]');
const installTotal = document.querySelectorAll('[id=installTotal]');
const printTotal = document.querySelectorAll('[id=printTotal]');
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
// let objPrints = {};
let objPrints = [];
// let objInstalls = {};
let objInstalls = [];
let dataServiceNotes = [];

selectPrintProduct = (sel) =>{
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    const wide = document.querySelectorAll('[id=wide]');
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
    const productSide = document.querySelectorAll('[id=productSide]');
    const cbRight = document.querySelectorAll('[id=cbRight]');
    const cbLeft = document.querySelectorAll('[id=cbLeft]');
    const wide = document.querySelectorAll('[id=wide]');
    const locationSide = document.querySelectorAll('[id=locationSide]');
    
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
    const installPrice = document.querySelectorAll('[id=installPrice]');
    const installTotal = document.querySelectorAll('[id=installTotal]');
    const freeInstalls = document.querySelectorAll('[id=freeInstalls]');
    const locationCode = document.querySelectorAll('[id=locationCode]');
    const installProduct = document.querySelectorAll('[id=installProduct]');
    let subTotalInstall = 0;
    for(let i = 0; i < Number(locationQty.value); i++){
        if(document.getElementById("cbInstall").checked == true){
            objInstalls[i] =  {
                code : parseInt(locationCode[i].innerHTML.replace ( /[^\d.]/g, '' )),
                price : installPrice[i].value,
                type : installProduct[i].value,
                freeInstall : freeInstalls[i].value
            }
        }else{
            objInstalls[i] =  {
                code : "",
                price : 0,
                type : "",
                freeInstall : freeInstalls[i].value
            }
        }
    
    subTotalInstall = subTotalInstall + Number(installTotal[i].value);
    }

    // objInstalls = objInstalls;
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
                code : parseInt(locationCode[i].innerHTML.replace ( /[^\d.]/g, '' )),
                price : printPrice[i].value,
                printProduct : selectPrint[i].value
            }
        }else{
            objPrints[i] =  {
                code : "",
                price : 0,
                printProduct : ""
            }
        }
        
        subTotalPrint = subTotalPrint + Number(printTotal[i].value);
    }
    // objPrints = objPrints;
    return subTotalPrint;
}

getServiceNote = () => {
    const serviceNotes = document.querySelectorAll('[id=serviceNotes]');
    const locationCode = document.querySelectorAll('[id=locationCode]');

    for(let i = 0; i < serviceNotes.length; i++){
        dataServiceNotes[i] = {
            code : parseInt(locationCode[i].innerHTML.replace ( /[^\d.]/g, '' )),
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
        if(sel.checked == true){
            for(let i = 0; i < serviceTBodyRows.length; i++){
                if(i % 2 != 0 && i < serviceTBodyRows.length - 3){
                    serviceTBodyRows[i].cells[3].children[0].id = "installTotal";
                    serviceTBodyRows[i].cells[2].children[0].id = "installPrice";
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
                    serviceTBodyRows[i].cells[3].children[0].id = "";
                    serviceTBodyRows[i].cells[2].children[0].id = "";
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
checkPpn = (sel) =>{
    if(sel.value == 0 || sel.value == null){
        alert('PPN tidak boleh kosong');
        sel.value = sel.defaultValue;
        countServicePrice();
    }
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
            if(objInstalls[i].price == 0 && objInstalls[i].freeInstall == false){
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
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(cbRight[index].checked == false){
        alert("Pilih salah satu atau kedua sisi..!!");
        sel.checked = true;
    }else{
        if(cbLeft[index].checked == true && sel.checked == true){
            locationSide[index].value = "2";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * Number(qty[index].value) * 2;
            printTotal[index].value = Number(wide[index].innerText) * printPrice[index].value;
            installTotal[index].value = Number(wide[index].innerText) * installPrice[index].value;
        }else{
            locationSide[index].value = "1";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * Number(qty[index].value) * 1;
            printTotal[index].value = Number(wide[index].innerText) * printPrice[index].value;
            installTotal[index].value = Number(wide[index].innerText) * installPrice[index].value;
        }
        getSideView();
        countServicePrice();
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
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * Number(qty[index].value) * 2;
            printTotal[index].value = Number(wide[index].innerText) * printPrice[index].value;
            installTotal[index].value = Number(wide[index].innerText) * installPrice[index].value;
        }else{
            locationSide[index].value = "1";
            wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * Number(qty[index].value) * 1;
            printTotal[index].value = Number(wide[index].innerText) * printPrice[index].value;
            installTotal[index].value = Number(wide[index].innerText) * installPrice[index].value;
        }
        getSideView();
        countServicePrice();
    }
}

qtyChangeAction = (sel) =>{
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * Number(sel.value) * Number(locationSide[index].value);
    if(printPrice[index]){
        printTotal[index].value= Number(wide[index].innerText) * printPrice[index].value;
    }
    if(installPrice[index]){
        installTotal[index].value = Number(wide[index].innerText) * installPrice[index].value;
    }
    countServicePrice();
}

checkQty = (sel) =>{
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(sel.value == 0 || sel.value == null){
        alert('Quantity pasang tidak boleh kosong');
        sel.value = sel.defaultValue;
        wide[index].innerHTML = Number(locationWidth[index].value) * Number(locationHeight[index].value) * Number(sel.value) * Number(locationSide[index].value);
        if(printPrice[index]){
            printTotal[index].value= Number(wide[index].innerText) * printPrice[index].value;
        }
        if(installPrice[index]){
            installTotal[index].value = Number(wide[index].innerText) * installPrice[index].value;
        }
        countServicePrice();
    }
}

installPriceChanged = (sel) =>{
    const installTotal = document.querySelectorAll('[id=installTotal]');
    const wide = document.querySelectorAll('[id=wide]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    installTotal[index].value = Number(sel.value) * Number(wide[index].innerText);
    countServicePrice();
}
checkInstallPrice = (sel) =>{
    const installTotal = document.querySelectorAll('[id=installTotal]');
    const wide = document.querySelectorAll('[id=wide]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(sel.value == 0 || sel.value == null){
        alert('Harga pasang tidak boleh kosong');
        sel.value = sel.defaultValue;
        installTotal[index].value = Number(sel.value) * Number(wide[index].innerText);
        countServicePrice();
    }
}

checkPrintPrice = (sel) =>{
    const selectPrint = document.querySelectorAll('[id=selectPrint]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    const wide = document.querySelectorAll('[id=wide]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    if(sel.value == 0 || sel.value == null){
        alert('Harga cetak tidak boleh kosong');
        sel.value = Number(selectPrint[index].options[selectPrint[index].selectedIndex].id);
        printTotal[index].value = Number(sel.value) * Number(wide[index].innerHTML);
        countServicePrice();
    }
}

printPriceChanged = (sel) =>{
    const printTotal = document.querySelectorAll('[id=printTotal]');
    var index = parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    const wide = document.querySelectorAll('[id=wide]');

    printTotal[index].value = Number(sel.value) * Number(wide[index].innerText);

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
            var node = serviceTbody.rows[0].cloneNode(true);
            var node2 = serviceTbody.rows[1].cloneNode(true);
            node.cells[0].innerText = sel.value;
            serviceTbody.insertBefore(node, serviceTbody.rows[serviceTbody.rows.length - 3]);
            serviceTbody.insertBefore(node2, serviceTbody.rows[serviceTbody.rows.length - 3]);
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
            installProduct[sel.value - 1].value = "Free ke " + getFree + " dari " + totalFree.value;
            objProducts.push(objProducts[0]);
            document.getElementById("products").value = JSON.stringify(objProducts);
        }else if(locationQty.value < sel.value && getFree > totalFree.value){
            alert("Jumlah maksimal melebihi free pasang");
            sel.value = sel.value - 1;
        }else{
            serviceTbody.removeChild(serviceTbody.children[serviceTbody.children.length - 4]);
            serviceTbody.removeChild(serviceTbody.children[serviceTbody.children.length - 4]);
            
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
            var node = serviceTbody.rows[0].cloneNode(true);
            var node2 = serviceTbody.rows[1].cloneNode(true);
            node.cells[0].innerText = sel.value;
            serviceTbody.insertBefore(node, serviceTbody.rows[serviceTbody.rows.length - 3]);
            serviceTbody.insertBefore(node2, serviceTbody.rows[serviceTbody.rows.length - 3]);
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
            serviceTbody.removeChild(serviceTbody.children[serviceTbody.children.length - 4]);
            serviceTbody.removeChild(serviceTbody.children[serviceTbody.children.length - 4]);
            
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