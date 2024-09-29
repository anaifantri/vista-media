//const notes
const btnAddNote = document.getElementById("btnAddNote");
const btnDelNote = document.getElementById("btnDelNote");
const notesQty = document.getElementById("notesQty");
const btnAddPayment = document.getElementById("btnAddPayment");
const btnDelPayment = document.getElementById("btnDelPayment");
const paymentTerms = document.getElementById("paymentTerms");
const price = document.getElementById("price");

//const preview check
const btnPreview = document.getElementById("btnPreview");
const modalPreview = document.getElementById("modalPreview");
const btnClose = document.getElementById("btnClose");


// Button Add Note Action --> start
btnAddNote.addEventListener("click", function() {
    if (notesQty.children.length < 10) {
        const divNotes = document.createElement("div");
        const inputNotes = document.createElement("textarea");
        divNotes.classList.add("flex");
        inputNotes.classList.add("text-area-notes");
        inputNotes.value = "- ";
        inputNotes.setAttribute("rows", "1");

        divNotes.appendChild(inputNotes);

        // notesQty.appendChild(divNotes);
        notesQty.insertBefore(divNotes, notesQty.children[notesQty.children.length - 1]);
        inputNotes.focus();
    } else {
        alert("Maksimal tambahan 3 catatan");
    }
});
// Button Add Note Action --> end

// Button Remove Last Note Action --> start
btnDelNote.addEventListener("click", function() {
    if (notesQty.children.length > 7) {
        notesQty.removeChild(notesQty.children[notesQty.children.length - 2]);
    } else {
        alert("Tidak ada tambahan catatan yang bisa dihapus");
    }
});
// Button Remove Last Note Action --> end

// Button Add Payment Action --> start
btnAddPayment.addEventListener("click", function() {
    if (paymentTerms.children.length < 4) {
        const divPayment = document.createElement("div");
        const labelPayment = document.createElement("label");
        const termOfPayment = document.createElement("input");
        const paymentDescription = document.createElement("textarea");
        divPayment.classList.add("flex");

        labelPayment.classList.add("ml-1");
        labelPayment.classList.add("text-sm");
        labelPayment.innerHTML = "-";

        termOfPayment.setAttribute('min', 0);
        termOfPayment.setAttribute('max', 100);
        termOfPayment.setAttribute('type', 'number');
        termOfPayment.setAttribute('value', 0);
        termOfPayment.setAttribute('required', 'required');
        termOfPayment.classList.add('term-of-payment');

        paymentDescription.classList.add("text-area-notes");
        paymentDescription.value = "%";
        paymentDescription.setAttribute("rows", "1");

        divPayment.appendChild(labelPayment);
        divPayment.appendChild(termOfPayment);
        divPayment.appendChild(paymentDescription);

        paymentTerms.appendChild(divPayment);
        termOfPayment.focus();
    } else {
        alert("Maksimal 4 termin pembayaran");
    }
});
// Button Add Payment Action --> end

// Button Remove Last Payment Action --> start
btnDelPayment.addEventListener("click", function() {
    if (paymentTerms.children.length > 1) {
        paymentTerms.removeChild(paymentTerms.children[paymentTerms.children.length - 1]);
    } else {
        alert("Minimal 1 termin pembayaran");
    }
});
// Button Remove Last Payment Action --> end

// Button Preview Action --> start
btnPreview.addEventListener("click", function(){
    const category = document.getElementById("category");
    if (paymentCheck() == true) {
        modalPreview.classList.remove("hidden");
        getNotes();
        getPayments();
        if(category.value == "Billboard"){
            getBillboardPrice();
        } else if(category.value == "Signage"){
            if(document.getElementById("signageType").value == "Videotron"){
                getVideotronPrice();
            }else{
                getBillboardPrice();
            }
        }else{
            getVideotronPrice();
        }
    }
})
// Button Preview Action --> end

// Button Close Action --> start
btnClose.addEventListener("click", function(){
    modalPreview.classList.add("hidden");
})
// Button Close Action --> end

// Function Payment Check --> start
paymentCheck = () => {
    var payment = 0;
    for (let i = 0; i < paymentTerms.children.length; i++) {
        if(paymentTerms.children[i].children[1].value == 0){
            payment = 0;
            alert("Silahkan input termin pembayaran yang masih kosong");
            paymentTerms.children[i].children[1].focus();
            return false;
        } else {
            payment = payment + Number(paymentTerms.children[i].children[1].value);
        }
    }
    if(payment != 100){
        alert("Total termin pembayaran tidak sama dengan 100%, silahkan sesuaikan lagi termin pembayaran");
        payment = 0;
        paymentTerms.children[0].children[1].focus();
    } else {
        return true;
    }
}
// Function Payment Check --> end

// Function Get Note --> start
getNotes = () => {
    const notes = document.getElementById("notes");
    const previewNotesQty = document.getElementById("previewNotesQty");
    const category = document.getElementById("category");
    let objNotes = {};
    let dataNotes = []; 
    var freePrint = 0;
    var freeInstall = 0;   

    while (previewNotesQty.hasChildNodes()) {
        previewNotesQty.removeChild(previewNotesQty.firstChild);
    }

    for(let i = 0; i < notesQty.children.length; i++){
        if(category.value == "Billboard"){
            if(i == 2 || i == 3){
                if(notesQty.children[i].children[1].value != 0){
                    if(i == 2){
                        freeInstall = notesQty.children[i].children[1].value;
                        dataNotes.push(notesQty.children[i].children[0].innerText + " " + notesQty.children[i].children[1].value  + " "  + notesQty.children[i].children[2].innerText);
                    }
                    if(i == 3){
                        freePrint = notesQty.children[i].children[1].value;
                        dataNotes.push(notesQty.children[i].children[0].innerText + " " + notesQty.children[i].children[1].value  + " "  + notesQty.children[i].children[2].innerText);
                    }
                }
            } else{
                dataNotes.push(notesQty.children[i].children[0].value);
            }
        }else if(category.value == "Signage"){
            if(document.getElementById("signageType").value != "Videotron"){
                if(i == 2 || i == 3){
                    if(notesQty.children[i].children[1].value != 0){
                        if(i == 2){
                            freeInstall = notesQty.children[i].children[1].value;
                            dataNotes.push(notesQty.children[i].children[0].innerText + " " + notesQty.children[i].children[1].value  + " "  + notesQty.children[i].children[2].innerText);
                        }
                        if(i == 3){
                            freePrint = notesQty.children[i].children[1].value;
                            dataNotes.push(notesQty.children[i].children[0].innerText + " " + notesQty.children[i].children[1].value  + " "  + notesQty.children[i].children[2].innerText);
                        }
                    }
                } else{
                    dataNotes.push(notesQty.children[i].children[0].value);
                }
            } else {
                dataNotes.push(notesQty.children[i].children[0].value);
            }
        }else{
            dataNotes.push(notesQty.children[i].children[0].value);
        }
    }

    for(let i = 0; i < dataNotes.length; i++){
        const divNotes = document.createElement("div");
        const labelNotes = document.createElement("label");
        
        divNotes.classList.add("flex");
        labelNotes.classList.add("flex");
        labelNotes.classList.add("text-xs");
        labelNotes.classList.add("text-black");

        if(category.value == "Billboard"){
            if(freeInstall != 0 && freePrint != 0) {
                if(i == 2 || i == 3 || i == 4){
                    labelNotes.classList.add("ml-4");
                }
            }else if((freeInstall == 0 && freePrint != 0) || (freeInstall != 0 && freePrint == 0)){
                if(i == 2 || i == 3){
                    labelNotes.classList.add("ml-4");
                }
            } else if(freeInstall == 0 && freePrint == 0){
                if(i == 2){
                    labelNotes.classList.add("ml-4");
                }
            } else{
                labelNotes.classList.add("ml-1");
            }
        } else if(category.value == "Signage"){
            if(category.name == "Videotron"){
                if(i == 2 || i == 3 ){
                    labelNotes.classList.add("ml-4");
                } else {
                    labelNotes.classList.add("ml-1");
                }
            }else{
                if(freeInstall != 0 && freePrint != 0) {
                    if(i == 2 || i == 3 || i == 4){
                        labelNotes.classList.add("ml-4");
                    }
                }else if((freeInstall == 0 && freePrint != 0) || (freeInstall != 0 && freePrint == 0)){
                    if(i == 2 || i == 3){
                        labelNotes.classList.add("ml-4");
                    }
                } else if(freeInstall == 0 && freePrint == 0){
                    if(i == 2){
                        labelNotes.classList.add("ml-4");
                    }
                } else{
                    labelNotes.classList.add("ml-1");
                }
            }
            
        }else{
            if(i == 2 || i == 3 ){
                labelNotes.classList.add("ml-4");
            } else {
                labelNotes.classList.add("ml-1");
            }
        }
       

        labelNotes.innerHTML = dataNotes[i];

        divNotes.appendChild(labelNotes);
        previewNotesQty.appendChild(divNotes);
    }

    objNotes = {dataNotes, freePrint, freeInstall};
    notes.value = JSON.stringify(objNotes);
}
// Function Get Note --> end

// Function Get Payment Terms --> start
getPayments = () => {
    const terms = document.getElementById("payment_terms");
    const previewPaymentTerms = document.getElementById("previewPaymentTerms");
    let objPayments = {};
    let dataPayments = [];

    while (previewPaymentTerms.hasChildNodes()) {
        previewPaymentTerms.removeChild(previewPaymentTerms.firstChild);
    }

    for(let i = 0; i < paymentTerms.children.length; i++){
            dataPayments[i] = {
                term : paymentTerms.children[i].children[1].value,
                note : paymentTerms.children[i].children[2].value,
            }

            const divTerms = document.createElement("div");
            const labelTerms = document.createElement("label");
            
            divTerms.classList.add("flex");
            labelTerms.classList.add("flex");
            labelTerms.classList.add("text-xs");
            labelTerms.classList.add("ml-1");
            labelTerms.classList.add("text-black");

            labelTerms.innerHTML = '- ' + paymentTerms.children[i].children[1].value + ' ' + paymentTerms.children[i].children[2].value;

            divTerms.appendChild(labelTerms);
            previewPaymentTerms.appendChild(divTerms);
    }

    objPayments = {dataPayments};
    terms.value = JSON.stringify(objPayments);
}
// Function Get Payment Terms --> end

// Function Get Billboard Price --> start
getBillboardPrice = () => {
    const thPrice = document.getElementById("thPrice");
    const divTable = document.getElementById("divTable");
    const cbBillboardTitle = document.querySelectorAll('[id=cbBillboardTitle]');
    const thTitle = document.querySelectorAll('[id=thTitle]');
    const billboardTitle = document.querySelectorAll('[id=billboardTitle]');
    const billboardPrice0 = document.querySelectorAll('[id=billboardPrice0]');
    const tdPriceMonth = document.querySelectorAll('[id=tdPriceMonth]');
    const billboardPrice1 = document.querySelectorAll('[id=billboardPrice1]');
    const tdPriceQuarter = document.querySelectorAll('[id=tdPriceQuarter]');
    const billboardPrice2 = document.querySelectorAll('[id=billboardPrice2]');
    const tdPriceHalf = document.querySelectorAll('[id=tdPriceHalf]');
    const billboardPrice3 = document.querySelectorAll('[id=billboardPrice3]');
    const tdPriceYear = document.querySelectorAll('[id=tdPriceYear]');
    
    let objPrice = {};
    let dataPrice = [];
    let dataTitle = [];
    let dataPriceMonth = [];
    let dataPriceQuarter = [];
    let dataPriceHalf = [];
    let dataPriceYear = [];
    var colSpan = 4;
    
    for(let i = 0; i < billboardPrice0.length; i++){
        dataPriceMonth[i] = {
            code : billboardPrice0[i].name,
            price : Number(billboardPrice0[i].value)
        }
        dataPriceQuarter[i] = {
            code : billboardPrice1[i].name,
            price : Number(billboardPrice1[i].value)
        }
        dataPriceHalf[i] = {
            code : billboardPrice2[i].name,
            price : Number(billboardPrice2[i].value)
        }
        dataPriceYear[i] = {
            code : billboardPrice3[i].name,
            price : Number(billboardPrice3[i].value)
        }
    }

    dataPrice[0] = dataPriceMonth;
    dataPrice[1] = dataPriceQuarter;
    dataPrice[2] = dataPriceHalf;
    dataPrice[3] = dataPriceYear;

    for (let i = 0; i < cbBillboardTitle.length; i++){
        dataTitle[i] = {
            checkbox : cbBillboardTitle[i].checked,
            title : billboardTitle[i].value
        }
    }

    objPrice = {dataTitle, dataPrice};
    price.value = JSON.stringify(objPrice);
    console.log(dataPriceHalf);
    for(let i = 0; i < dataTitle.length; i++){
        if(dataTitle[i].checkbox == true){
            thTitle[i].innerHTML = dataTitle[i].title;
            thTitle[i].removeAttribute('hidden');
            if(i == 0){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceMonth[n].innerHTML = dataPriceMonth[n].price.toLocaleString();
                    tdPriceMonth[n].removeAttribute('hidden');
                }
            } else if(i == 1){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceQuarter[n].innerHTML = dataPriceQuarter[n].price.toLocaleString();
                    tdPriceQuarter[n].removeAttribute('hidden');
                }
            }else if(i == 2){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceHalf[n].innerHTML = dataPriceHalf[n].price.toLocaleString();
                    tdPriceHalf[n].removeAttribute('hidden');
                }
            }else if(i == 3){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceYear[n].innerHTML = dataPriceYear[n].price.toLocaleString();
                    tdPriceYear[n].removeAttribute('hidden');
                }   
            }
        }else{
            colSpan = colSpan - 1;
            thTitle[i].setAttribute('hidden', 'hidden');
            if(i == 0){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceMonth[n].setAttribute('hidden', 'hidden');
                }
            } else if(i == 1){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceQuarter[n].setAttribute('hidden', 'hidden');
                }
            }else if(i == 2){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceHalf[n].setAttribute('hidden', 'hidden');
                }
            }else if(i == 3){
                for(let n = 0; n < dataPriceMonth.length; n++){
                    tdPriceYear[n].setAttribute('hidden', 'hidden');
                }   
            }
        }
        thPrice.setAttribute('colspan', colSpan);
        if(colSpan > 2){
            divTable.classList.add('w-[800px]');
            divTable.classList.remove('w-[725px]');
        }else{
            divTable.classList.add('w-[725px]');
            divTable.classList.remove('w-[800px]');
        }
    }
}
// Function Get Billboard Price --> end

// Function Get Videotron Price --> start
getVideotronPrice = () => {
    const cbShareTitle = document.querySelectorAll('[id=cbShareTitle]');
    const shareTitle = document.querySelectorAll('[id=shareTitle]');
    const tdShareTitle = document.querySelectorAll('[id=tdShareTitle]');
    const sharePrice = document.querySelectorAll('[id=sharePrice]');
    const tdSharePrice = document.querySelectorAll('[id=tdSharePrice]');
    const cbExTitle = document.querySelectorAll('[id=cbExTitle]');
    const exTitle = document.querySelectorAll('[id=exTitle]');
    const tdExTitle = document.querySelectorAll('[id=tdExTitle]');
    const exPrice = document.querySelectorAll('[id=exPrice]');
    const tdExPrice = document.querySelectorAll('[id=tdExPrice]');
    const cbSharing = document.getElementById("cbSharing");
    const cbExclusive = document.getElementById("cbExclusive");
    
    let objPrice = {};
    let dataSharingPrice = [];
    let dataExclusivePrice = [];
    let priceType = [];
    var slotQty = document.getElementById("slotQty").value;
    
    for(let i = 0; i < cbShareTitle.length; i++){
        dataSharingPrice[i] = {
            checkbox : cbShareTitle[i].checked,
            title : shareTitle[i].value,
            price : Number(sharePrice[i].value)
        }
    }
    for(let i = 0; i < cbExTitle.length; i++){
        dataExclusivePrice[i] = {
            checkbox : cbExTitle[i].checked,
            title : exTitle[i].value,
            price : Number(exPrice[i].value)
        }
    }

    if(cbSharing.checked == true){
        priceType[0] = true;
    }else{
        priceType[0] = false;
    }

    if(cbExclusive.checked == true){
        priceType[1] = true;
    }else{
        priceType[1] = false;
    }

    objPrice = {dataSharingPrice, dataExclusivePrice, priceType, slotQty};
    price.value = JSON.stringify(objPrice);

    if(objPrice.priceType[0] == true){
        document.getElementById("trSharing").removeAttribute('hidden');
        document.getElementById("tdSharing").innerHTML = "Harga Sharing " + document.getElementById("slotQty").value + " Slot";
        document.getElementById("trSharingPrice").removeAttribute('hidden');
        for(let i = 0; i < 4; i++){
            if(objPrice.dataSharingPrice[i].checkbox == true){
                tdShareTitle[i].innerHTML = objPrice.dataSharingPrice[i].title;
                tdShareTitle[i].removeAttribute('hidden');
                tdSharePrice[i].innerHTML = objPrice.dataSharingPrice[i].price.toLocaleString();
                tdSharePrice[i].removeAttribute('hidden');
            }else{
                tdShareTitle[i].setAttribute('hidden', 'hidden');
                tdSharePrice[i].setAttribute('hidden', 'hidden');
            }
        }
    }else{
        document.getElementById("trSharing").setAttribute('hidden', 'hidden');
        document.getElementById("trSharingPrice").setAttribute('hidden', 'hidden');
    }
    if(objPrice.priceType[1] == true){
        document.getElementById("trExclusive").removeAttribute('hidden');
        document.getElementById("trExclusivePrice").removeAttribute('hidden');
        for(let i = 0; i < 4; i++){
            if(objPrice.dataExclusivePrice[i].checkbox == true){
                tdExTitle[i].innerHTML = objPrice.dataExclusivePrice[i].title;
                tdExTitle[i].removeAttribute('hidden');
                tdExPrice[i].innerHTML = objPrice.dataExclusivePrice[i].price.toLocaleString();
                tdExPrice[i].removeAttribute('hidden');
            }else{
                tdExTitle[i].setAttribute('hidden', 'hidden');
                tdExPrice[i].setAttribute('hidden', 'hidden');
            }
        }
    }else{
        document.getElementById("trExclusive").setAttribute('hidden', 'hidden');
        document.getElementById("trExclusivePrice").setAttribute('hidden', 'hidden');
    }
}
// Function Get Videotron Price --> end

// Function Sharing Price Action --> start
sharingPrice = (sel) => {
    const cbShareTitle = document.querySelectorAll('[id=cbShareTitle]');
    const shareTitle = document.querySelectorAll('[id=shareTitle]');
    const sharePrice = document.querySelectorAll('[id=sharePrice]');

    if(sel.checked == true){
        for(let i = 0; i < cbShareTitle.length; i++){
            cbShareTitle[i].checked = true;
            cbShareTitle[i].removeAttribute('disabled');
            shareTitle[i].removeAttribute('disabled');
            shareTitle[i].value = shareTitle[i].defaultValue;
            sharePrice[i].value = sharePrice[i].defaultValue;
        }
    } else{
        if(document.getElementById("cbExclusive").checked == false){
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
        } else{
            for(let i = 0; i < cbShareTitle.length; i++){
                cbShareTitle[i].checked = false;
                cbShareTitle[i].setAttribute('disabled', 'disabled');
                shareTitle[i].setAttribute('disabled', 'disabled');
                shareTitle[i].value = "";
                sharePrice[i].value = "";
            }
        }
    }
}
// Function Sharing Price Action --> end

// Function Exclusive Price Action --> start
exclusivePrice = (sel) => {
    const cbExTitle = document.querySelectorAll('[id=cbExTitle]');
    const exTitle = document.querySelectorAll('[id=exTitle]');
    const exPrice = document.querySelectorAll('[id=exPrice]');

    if(sel.checked == true){
        for(let i = 0; i < cbExTitle.length; i++){
            cbExTitle[i].checked = true;
            cbExTitle[i].removeAttribute('disabled');
            exTitle[i].removeAttribute('disabled');
            exTitle[i].value = exTitle[i].defaultValue;
            exPrice[i].value = exPrice[i].defaultValue;
        }
    } else{
        if(document.getElementById("cbSharing").checked == false){
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
        }else{
            for(let i = 0; i < cbExTitle.length; i++){
                cbExTitle[i].checked = false;
                cbExTitle[i].setAttribute('disabled', 'disabled');
                exTitle[i].setAttribute('disabled', 'disabled');
                exTitle[i].value = "";
                exPrice[i].value = "";
            }
        }
    }
}
// Function Exclusive Price Action --> end

// Function Checkbox Sharing Check Action --> start
cbShareCheck = (sel) => {
    const cbShareTitle = document.querySelectorAll('[id=cbShareTitle]');
    const shareTitle = document.querySelectorAll('[id=shareTitle]');
    const sharePrice = document.querySelectorAll('[id=sharePrice]');

    var index = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    function check(){
        for(let i = 0; i < cbShareTitle.length; i++){
            if( cbShareTitle[i].checked == true ){
                return true;
            }
        }
    }
    if(check() == true){
        if(sel.checked == true){
            for(let i = 0; i < cbShareTitle.length; i++){
                if(i == index){
                    shareTitle[i].removeAttribute('hidden');
                    sharePrice[i].classList.add('flex');
                    sharePrice[i].classList.remove('hidden');
                    shareTitle[i].value = shareTitle[i].defaultValue;
                    sharePrice[i].value = sharePrice[i].defaultValue;
                }
            }
        }else {
            for(let i = 0; i < cbShareTitle.length; i++){
                if(i == index){
                    shareTitle[i].setAttribute('hidden', 'hidden');
                    sharePrice[i].classList.add('hidden');
                    sharePrice[i].classList.remove('flex');
                    shareTitle[i].value = "";
                    sharePrice[i].value = "";
                }
            }
        }
    } else{
        if(document.getElementById("cbExclusive").checked == false){
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
        } else{
            for(let i = 0; i < cbShareTitle.length; i++){
                if(i == index){
                    shareTitle[i].setAttribute('hidden', 'hidden');
                    sharePrice[i].classList.add('hidden');
                    sharePrice[i].classList.remove('flex');
                    shareTitle[i].value = "";
                    sharePrice[i].value = "";
                }
            }
            document.getElementById("cbSharing").click();
        }
    }
}
// Function Checkbox Sharing Check Action --> end

// Function Checkbox Exclusive Check Action --> start
cbExclusiveCheck = (sel) => {
    const cbExTitle = document.querySelectorAll('[id=cbExTitle]');
    const exTitle = document.querySelectorAll('[id=exTitle]');
    const exPrice = document.querySelectorAll('[id=exPrice]');

    var index = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    function check(){
        for(let i = 0; i < cbExTitle.length; i++){
            if( cbExTitle[i].checked == true ){
                return true;
            }
        }
    }
    if(check() == true){
        if(sel.checked == true){
            for(let i = 0; i < cbExTitle.length; i++){
                if(i == index){
                    exTitle[i].removeAttribute('hidden');
                    exPrice[i].classList.add('flex');
                    exPrice[i].classList.remove('hidden');
                    exTitle[i].value = exTitle[i].defaultValue;
                    exPrice[i].value = exPrice[i].defaultValue;
                }
            }
        }else {
            for(let i = 0; i < cbExTitle.length; i++){
                if(i == index){
                    exTitle[i].setAttribute('hidden', 'hidden');
                    exPrice[i].classList.add('hidden');
                    exPrice[i].classList.remove('flex');
                    exTitle[i].value = "";
                    exPrice[i].value = "";
                }
            }
        }
    } else{
        if(document.getElementById("cbSharing").checked == false){
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
        } else{
            for(let i = 0; i < cbExTitle.length; i++){
                if(i == index){
                    exTitle[i].setAttribute('hidden', 'hidden');
                    exPrice[i].classList.add('hidden');
                    exPrice[i].classList.remove('flex');
                    exTitle[i].value = "";
                    exPrice[i].value = "";
                }
            }
            document.getElementById("cbExclusive").click();
        }
    }
}
// Function Checkbox Exclusive Check Action --> end

// Function Checkbox Billboard Check Action --> start
cbBillboardCheck = (sel) => {
    const cbBillboardTitle = document.querySelectorAll('[id=cbBillboardTitle]');
    const billboardTitle = document.querySelectorAll('[id=billboardTitle]');
    const billboardPrice0 = document.querySelectorAll('[id=billboardPrice0]');
    const billboardPrice1 = document.querySelectorAll('[id=billboardPrice1]');
    const billboardPrice2 = document.querySelectorAll('[id=billboardPrice2]');
    const billboardPrice3 = document.querySelectorAll('[id=billboardPrice3]');

    var index = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));

    function check(){
        for(let i = 0; i < cbBillboardTitle.length; i++){
            if( cbBillboardTitle[i].checked == true ){
                return true;
            }
        }
    }

    if(check() == true){
        if(sel.checked == true){
            for(let i = 0; i < cbBillboardTitle.length; i++){
                if(i == index){
                    billboardTitle[i].removeAttribute('disabled');
                    billboardTitle[i].value = billboardTitle[i].defaultValue;
                    
                    for(let n = 0; n < billboardPrice0.length; n++){
                        if(index == 0){
                            billboardPrice0[n].value = billboardPrice0[n].defaultValue;
                            billboardPrice0[n].removeAttribute('disabled');
                        }else if(index == 1){
                            billboardPrice1[n].value = billboardPrice1[n].defaultValue;
                            billboardPrice1[n].removeAttribute('disabled');
                        }else if(index == 2){
                            billboardPrice2[n].value = billboardPrice2[n].defaultValue;
                            billboardPrice2[n].removeAttribute('disabled');
                        }else if(index == 3){
                            billboardPrice3[n].value = billboardPrice3[n].defaultValue;
                            billboardPrice3[n].removeAttribute('disabled')
                        }
                    }
                }
            }
        }else {
            for(let i = 0; i < cbBillboardTitle.length; i++){
                if(i == index){
                    billboardTitle[i].setAttribute('disabled', 'disabled');
                    billboardTitle[i].value = "";
                    for(let n = 0; n < billboardPrice0.length; n++){
                        if(index == 0){
                            billboardPrice0[n].value = "";
                            billboardPrice0[n].setAttribute('disabled', 'disabled');
                        }else if(index == 1){
                            billboardPrice1[n].value = "";
                            billboardPrice1[n].setAttribute('disabled', 'disabled');
                        }else if(index == 2){
                            billboardPrice2[n].value = "";
                            billboardPrice2[n].setAttribute('disabled', 'disabled');
                        }else if(index == 3){
                            billboardPrice3[n].value = "";
                            billboardPrice3[n].setAttribute('disabled', 'disabled');
                        }
                    }
                }
            }
        }
    } else{
            alert('Pilih minimal salah satu harga');
            sel.checked = true;
    }
}
// Function Checkbox Billboard Check Action --> end

// Function Input Slot Action --> start
setSLot = (sel) => {
    const sharePrice = document.querySelectorAll('[id=sharePrice]');
    console.log(sel.value);
    if(Number(sel.value) < 4 && Number(sel.value) > 0){
        for(let i = 0; i < sharePrice.length; i++){
            sharePrice[i].value = Number(sharePrice[i].defaultValue) * Number(sel.value);
        }
    }else if(sel.value != ""){
        alert('Jumlah slot minimal 1 dan maksimal 3');
        sel.value = sel.defaultValue;
        for(let i = 0; i < sharePrice.length; i++){
            sharePrice[i].value = Number(sharePrice[i].defaultValue);
        }
    } else {
        for(let i = 0; i < sharePrice.length; i++){
            sharePrice[i].value = 0;
        }
    }
    
}
// Function Input Slot Action --> end

// Function Remove Location --> start
removeLocation = (sel) => {
    const locationView = document.querySelectorAll('[id=locationView]');
    const tableBody = document.getElementById("tableBody");
    const previewTBody = document.getElementById("previewTBody");
    let objProducts = JSON.parse(document.getElementById("products").value);

    for(let i = 0; i < objProducts.length; i++){
        if(objProducts[i].id == sel.name){
            objProducts.splice(i, 1);
        }
    }

    if(tableBody.rows.length > 1){
        tableBody.deleteRow(sel.id);
        previewTBody.deleteRow(sel.id);
        locationView[Number(sel.id)].classList.remove("flex");
        locationView[Number(sel.id)].classList.add("hidden");
        for(let i = 0; i < tableBody.rows.length; i++){
            tableBody.rows[i].cells[0].innerHTML = i + 1;
        }
        for(let i = 0; i < previewTBody.rows.length; i++){
            previewTBody.rows[i].cells[0].innerHTML = i + 1;
        }
        document.getElementById("products").value = JSON.stringify(objProducts);
    }else{
        alert('Minimal harus ada 1 lokasi')
    }
}
// Function Remove Location --> end
