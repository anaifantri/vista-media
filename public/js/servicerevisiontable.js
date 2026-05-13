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

// let objServiceType = {
//     print : serviceTypePrint.value,
//     install : serviceTypeInstall.value
// }
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
                side : Number(locationSide[i].innerText),
                wide : Number(wide[i].innerText)
            }
        }else{
            dataSideView[i] =  {
                left : true,
                right : false,
                side : Number(locationSide[i].innerText),
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
    const installationPrice = document.querySelectorAll('[id=installationPrice]');
    const installTotal = document.querySelectorAll('[id=installTotal]');
    const freeInstalls = document.querySelectorAll('[id=freeInstalls]');
    const locationCode = document.querySelectorAll('[id=locationCode]');
    const installProduct = document.querySelectorAll('[id=installProduct]');
    const cbInstalls = document.querySelectorAll('[id=cbInstall]');
    let subTotalInstall = 0;
    for(let i = 0; i < Number(locationQty.value); i++){
        if(cbInstalls[i].checked == true){
            objInstalls[i] =  {
                install : true,
                code : locationCode[i].value,
                price : installPrice[i].value,
                type : installProduct[i].value,
                freeInstall : freeInstalls[i].value
            }
        }else{
            objInstalls[i] =  {
                install : false,
                code : locationCode[i].value,
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
    const cbPrints = document.querySelectorAll('[id=cbPrint]');
    let subTotalPrint = 0;
    for(let i = 0; i < Number(locationQty.value); i++){
        if(cbPrints[i].checked == true){
            objPrints[i] =  {
                print : true,
                code : locationCode[i].value,
                price : printPrice[i].value,
                printProduct : selectPrint[i].value
            }
        }else{
            objPrints[i] =  {
                print : false,
                code : locationCode[i].value,
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
            code : locationCode[i].value,
            serviceNote : serviceNotes[i].value
        }
    }
}

cbPrintAction = (sel) =>{
    const index =  parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    const printProducts = document.querySelectorAll('[id=selectPrint]');
    const printPrice = document.querySelectorAll('[id=printPrice]');
    const printTotal = document.querySelectorAll('[id=printTotal]');
    const selectPrint = document.querySelectorAll('[id=selectPrint]');
    const cbInstalls = document.querySelectorAll('[id=cbInstall]');
    if(cbInstalls[index].checked == false){
        alert("Pilih salah satu atau kedua opsi penawaran..!!");
        sel.checked = true;
    }else{
        // if(sel.checked == true){
        //     printProducts[index].removeAttribute('disabled');
        //     // for(let i = 0; i < serviceTBodyRows.length; i++){
        //     //     if(i % 2 != 0 && i < serviceTBodyRows.length - 3){
        //     //         serviceTBodyRows[i].cells[3].children[0].id = "installTotal";
        //     //         serviceTBodyRows[i].cells[2].children[0].id = "installPrice";
        //     //         serviceTBodyRows[i-1].cells[2].innerHTML = serviceTBodyRows[i].cells[4].innerHTML;
        //     //         serviceTBodyRows[i-1].cells[3].innerHTML = serviceTBodyRows[i].cells[5].innerHTML;
        //     //         serviceTBodyRows[i-1].cells[6].innerHTML = serviceTBodyRows[i].cells[6].innerHTML;
        //     //         serviceTBodyRows[i-1].cells[7].innerHTML = serviceTBodyRows[i].cells[7].innerHTML;
        //     //         serviceTBodyRows[i].deleteCell(7);
        //     //         serviceTBodyRows[i].deleteCell(6);
        //     //         serviceTBodyRows[i].deleteCell(5);
        //     //         serviceTBodyRows[i].deleteCell(4);
        //     //         serviceTBodyRows[i-1].cells[0].setAttribute('rowspan', '2');
        //     //         serviceTBodyRows[i-1].cells[1].setAttribute('rowspan', '2');
        //     //         serviceTBodyRows[i-1].cells[4].setAttribute('rowspan', '2');
        //     //         serviceTBodyRows[i-1].cells[5].setAttribute('rowspan', '2');
        //     //         serviceTBodyRows[i].removeAttribute('hidden', 'hidden');
        //     //     }
        //     // }
        // }else{
        //     // for(let i = 0; i < serviceTBodyRows.length; i++){
        //     //     if(i % 2 != 0 && i < serviceTBodyRows.length - 3){ 
        //     //         serviceTBodyRows[i].insertCell(4);
        //     //         serviceTBodyRows[i].cells[4].innerHTML = serviceTBodyRows[i-1].cells[2].innerHTML;
        //     //         serviceTBodyRows[i].cells[4].setAttribute('hidden', 'hidden');
        //     //         serviceTBodyRows[i].insertCell(5);
        //     //         serviceTBodyRows[i].cells[5].innerHTML = serviceTBodyRows[i-1].cells[3].innerHTML;
        //     //         serviceTBodyRows[i].cells[5].setAttribute('hidden', 'hidden');
        //     //         serviceTBodyRows[i].insertCell(6);
        //     //         serviceTBodyRows[i].cells[6].innerHTML = serviceTBodyRows[i-1].cells[6].innerHTML;
        //     //         serviceTBodyRows[i].cells[6].setAttribute('hidden', 'hidden');
        //     //         serviceTBodyRows[i].insertCell(7);
        //     //         serviceTBodyRows[i].cells[7].innerHTML = serviceTBodyRows[i-1].cells[7].innerHTML;
        //     //         serviceTBodyRows[i].cells[7].setAttribute('hidden', 'hidden');
        //     //         serviceTBodyRows[i-1].cells[2].innerHTML = serviceTBodyRows[i].cells[0].innerHTML;
        //     //         serviceTBodyRows[i-1].cells[3].innerHTML = serviceTBodyRows[i].cells[1].innerHTML;
        //     //         serviceTBodyRows[i-1].cells[6].innerHTML = serviceTBodyRows[i].cells[2].innerHTML;
        //     //         serviceTBodyRows[i-1].cells[7].innerHTML = serviceTBodyRows[i].cells[3].innerHTML;
        //     //         serviceTBodyRows[i-1].cells[0].removeAttribute('rowspan');
        //     //         serviceTBodyRows[i-1].cells[1].removeAttribute('rowspan');
        //     //         serviceTBodyRows[i-1].cells[4].removeAttribute('rowspan');
        //     //         serviceTBodyRows[i-1].cells[5].removeAttribute('rowspan');
        //     //         serviceTBodyRows[i].setAttribute('hidden', 'hidden');
        //     //         serviceTBodyRows[i].cells[3].children[0].id = "";
        //     //         serviceTBodyRows[i].cells[2].children[0].id = "";
        //     //     }
        //     // }
        //     printProducts[index].setAttribute('disabled', 'disabled');
        //     printProducts[index].selectedIndex = 0;
        // }
        
            if(sel.checked == true){
                selectPrint[index].removeAttribute('disabled');
            }else{
                printProducts[index].selectedIndex = 0;
                selectPrint[index].setAttribute('disabled', 'disabled');
                printPrice[index].value = 0;
                printTotal[index].value = 0;
                selectPrint[index].options[0].selected = true;
                printPrice[index].setAttribute('disabled', 'disabled');
            }
        // for(let i = 0; i < Number(locationQty.value);i++){
        //     if(sel.checked == true){
        //         selectPrint[i].removeAttribute('disabled');
        //     }else{
        //         selectPrint[i].setAttribute('disabled', 'disabled');
        //         printPrice[i].value = 0;
        //         printTotal[i].value = 0;
        //         selectPrint[i].options[0].selected = true;
        //         printPrice[i].setAttribute('disabled', 'disabled');
        //     }
        // }
        countServicePrice();
        // if(sel.checked == true){
        //     objServiceType.print = true;
        // }else{
        //     objServiceType.print = false;
        // }
        if(sel.checked == true){
            objPrints[index].print = true;
        }else{
            objPrints[index].print = false;
        }
    }
}

cbInstallAction = (sel) =>{
    const index =  parseInt(sel.name.replace ( /[^\d.]/g, '' ));
    const installPrice = document.querySelectorAll('[id=installPrice]');
    const installationPrice = document.querySelectorAll('[id=installationPrice]');
    const installTotal = document.querySelectorAll('[id=installTotal]');
    const cbPrints = document.querySelectorAll('[id=cbPrint]');
    if(cbPrints[index].checked == false){
        alert("Pilih salah satu atau kedua opsi penawaran..!!");
        sel.checked = true;
    }else
        {
            if(sel.checked == true){
                installPrice[index].removeAttribute('disabled');
                installPrice[index].value = installationPrice[index].value;
                installTotal[index].value = installPrice[index].value * Number(wide[index].innerHTML);
            }else{
                installPrice[index].setAttribute('disabled', 'disabled');
                installPrice[index].value = 0;
                installTotal[index].value = "0";
            }
        // for(let i = 0; i < Number(locationQty.value);i++){
        //     if(sel.checked == true){
        //         installPrice[i].removeAttribute('disabled');
        //         installPrice[i].value = installPrice[i].defaultValue;
        //         installTotal[i].value = installTotal[i].defaultValue;
        //     }else{
        //         installPrice[i].setAttribute('disabled', 'disabled');
        //         installPrice[i].value = 0;
        //         installTotal[i].value = "0";
        //     }
        // }

        // if(sel.checked == true){
        //     for(let i = 0; i < serviceTBodyRows.length; i++){
        //         if(i % 2 != 0 && i < serviceTBodyRows.length - 3){
        //             serviceTBodyRows[i-1].cells[0].setAttribute('rowspan', "2");
        //             serviceTBodyRows[i-1].cells[1].setAttribute('rowspan', "2");
        //             serviceTBodyRows[i-1].cells[4].setAttribute('rowspan', "2");
        //             serviceTBodyRows[i-1].cells[5].setAttribute('rowspan', "2");
        //             serviceTBodyRows[i].removeAttribute('hidden');
        //         }
        //     }
        // }else{
        //     for(let i = 0; i < serviceTBodyRows.length; i++){
        //         if(i % 2 != 0 && i < serviceTBodyRows.length - 3){ 
        //             serviceTBodyRows[i-1].cells[0].removeAttribute('rowspan');
        //             serviceTBodyRows[i-1].cells[1].removeAttribute('rowspan');
        //             serviceTBodyRows[i-1].cells[4].removeAttribute('rowspan');
        //             serviceTBodyRows[i-1].cells[5].removeAttribute('rowspan');
        //             serviceTBodyRows[i].setAttribute('hidden', 'hidden');
        //         }
        //     }
        // }

        countServicePrice();
        // if(sel.checked == true){
        //     objServiceType.install = true;
        // }else{
        //     objServiceType.install = false;
        // }
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
    // if(serviceTypeInstall.value == true && serviceTypePrint.value == true){
    //     var subTotal = Number(getTotalInstall()) + Number(getTotalPrint());
    // }else if(serviceTypeInstall.value == false && serviceTypePrint.value == true){
    //     var subTotal = Number(getTotalPrint());
    // }else if(serviceTypeInstall.value == true && serviceTypePrint.value == false){
    //     var subTotal = Number(getTotalInstall());
    // }
    var subTotal = Number(getTotalInstall()) + Number(getTotalPrint());
    
    var ppnValue = subTotal * (document.getElementById("inputPpn").value / 100);
    document.getElementById("subTotal").innerHTML = subTotal.toLocaleString();
    document.getElementById("servicePpn").innerHTML = ppnValue.toLocaleString();
    document.getElementById("serviceGrandTotal").innerHTML = (subTotal + ppnValue).toLocaleString();
}

printProductCheck = () =>{
        getTotalPrint();
        for(let i = 0; i < objPrints.length; i++){
            if(objPrints[i].price == 0 && objPrints[i].print == true){
                return false;
            }
        }
    // if(document.getElementById("cbPrint").checked == true){
    //     getTotalPrint();
    //     for(let i = 0; i < objPrints.length; i++){
    //         if(objPrints[i].price == 0){
    //             return false;
    //         }
    //     }
    // }
}

installPriceCheck = () =>{
        getTotalInstall();
        for(let i = 0; i < objInstalls.length; i++){
            if(objInstalls[i].price == 0 && objInstalls[i].freeInstall == false && objInstalls[i].install == true){
                return false;
            }
        }
    // if(document.getElementById("cbInstall").checked == true){
    //     getTotalInstall();
    //     for(let i = 0; i < objInstalls.length; i++){
    //         if(objInstalls[i].price == 0){
    //             return false;
    //         }
    //     }
    // }
}

fillServiceData = () =>{
    const price = document.getElementById("price");
    let objPrice = {};

    getTotalInstall();
    getTotalPrint();
    getSideView();
    getServiceNote();

    objPrice = {objInstalls, objPrints, objServicePpn, objSideView, dataServiceNotes};
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