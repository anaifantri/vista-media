//const notes
const btnAddNote = document.getElementById("btnAddNote");
const btnDelNote = document.getElementById("btnDelNote");
const notesQty = document.getElementById("notesQty");
const btnAddPayment = document.getElementById("btnAddPayment");
const btnDelPayment = document.getElementById("btnDelPayment");
const paymentTerms = document.getElementById("paymentTerms");
const price = document.getElementById("price");
const category = document.getElementById("category");
let objProducts = JSON.parse(document.getElementById("products").value);
let productsQty = JSON.parse(document.getElementById("products").value);

let includedPrint = {
    checked : false
};
let includedInstall = {
    checked : false
};


// Button Add Note Action --> start
btnAddNote.addEventListener("click", function() {
    if(category.value == "Service"){
        if (notesQty.children.length < 4) {
            const divNotes = document.createElement("div");
            const inputNotes = document.createElement("textarea");
            divNotes.classList.add("flex");
            inputNotes.classList.add("text-area-notes");
            inputNotes.value = "- ";
            inputNotes.setAttribute("rows", "1");
    
            divNotes.appendChild(inputNotes);
    
            // notesQty.appendChild(divNotes);
            notesQty.insertBefore(divNotes, notesQty.children[notesQty.children.length]);
            inputNotes.focus();
        } else {
            alert("Maksimal tambahan 3 catatan");
        }
    }else{
        if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
            if (notesQty.children.length < 9) {
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
        }else{
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
        }
    }
});
// Button Add Note Action --> end

// Button Remove Last Note Action --> start
btnDelNote.addEventListener("click", function() {
    if(category.value == "Service"){
        if (notesQty.children.length > 1) {
            notesQty.removeChild(notesQty.children[notesQty.children.length - 1]);
        } else {
            alert("Tidak ada tambahan catatan yang bisa dihapus");
        }
    }else{
        if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
            if (notesQty.children.length > 6) {
                notesQty.removeChild(notesQty.children[notesQty.children.length - 2]);
            } else {
                alert("Tidak ada tambahan catatan yang bisa dihapus");
            }
        }else{
            if (notesQty.children.length > 7) {
                notesQty.removeChild(notesQty.children[notesQty.children.length - 2]);
            } else {
                alert("Tidak ada tambahan catatan yang bisa dihapus");
            }
        }
    }
});
// Button Remove Last Note Action --> end

// Button Add Payment Action --> start
btnAddPayment.addEventListener("click", function() {
    if (paymentTerms.children.length < 5) {
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
        alert("Maksimal 5 termin pembayaran");
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

submitAction = () =>{
    const formCreate = document.getElementById("formCreate");
    if(category.value == "Service"){
        if(printProductCheck() == false || installPriceCheck() == false){
            alert("Silahkan lengkapi harga yang belum diinput..!!")
        }else{
            if (paymentCheck() == true) {
                fillServiceData();
                getNotes();
                getPayments();
                formCreate.submit();
            }
        }
    }else{
        if(document.getElementById("cbIncludeInstall")){
            if (paymentCheck() == true && includeServiceChecking() == true) {
                getNotes();
                getPayments();
                if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
                    getVideotronPrice();
                }else{
                    getBillboardPrice();
                }
                formCreate.submit();
            }
        }else{
            if (paymentCheck() == true) {
                getNotes();
                getPayments();
                if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
                    getVideotronPrice();
                }else{
                    getBillboardPrice();
                }
                formCreate.submit();
            }
        }
    }
}

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
    let objNotes = {};
    let dataNotes = []; 
    var freePrint = 0;
    var freeInstall = 0;  

    for(let i = 0; i < notesQty.children.length; i++){
        if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
            dataNotes.push(notesQty.children[i].children[0].value);
        }else{
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
        }
    }

    for(let i = 0; i < dataNotes.length; i++){
        const divNotes = document.createElement("div");
        const labelNotes = document.createElement("label");
        
        divNotes.classList.add("flex");
        labelNotes.classList.add("flex");
        labelNotes.classList.add("text-xs");
        labelNotes.classList.add("text-black");

        if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
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
       

        labelNotes.innerHTML = dataNotes[i];

        divNotes.appendChild(labelNotes);
    }

    // objNotes = {dataNotes, freePrint, freeInstall};
    objNotes = {dataNotes, freePrint, freeInstall, includedPrint, includedInstall};
    notes.value = JSON.stringify(objNotes);
}
// Function Get Note --> end

// Function Get Payment Terms --> start
getPayments = () => {
    const terms = document.getElementById("payment_terms");
    let objPayments = {};
    let dataPayments = [];

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
    }

    objPayments = {dataPayments};
    terms.value = JSON.stringify(objPayments);
}
// Function Get Payment Terms --> end

// Function Get Billboard Price --> start
getBillboardPrice = () => {
    const cbBillboardTitle = document.querySelectorAll('[id=cbBillboardTitle]');
    const billboardTitle = document.querySelectorAll('[id=billboardTitle]');
    const billboardPrice0 = document.querySelectorAll('[id=billboardPrice0]');
    const billboardPrice1 = document.querySelectorAll('[id=billboardPrice1]');
    const billboardPrice2 = document.querySelectorAll('[id=billboardPrice2]');
    const billboardPrice3 = document.querySelectorAll('[id=billboardPrice3]');
    
    let objPrice = {};
    let objPpn = {
        value : 11,
        checked : false,
        dpp : 0
    };
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

    if(document.getElementById("ppnYes").checked == true){
        objPpn.checked = true;
        objPpn.value = Number(ppnValue.value);
        objPpn.dpp = Number(dppValue.value);
    }

    objPrice = {dataTitle, dataPrice, objPpn};
    price.value = JSON.stringify(objPrice);
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
    let objPpn = {
        value : 11,
        checked : false,
        dpp : 0
    };
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
    if(document.getElementById("ppnYes").checked == true){
        objPpn.checked = true;
        objPpn.value = Number(ppnValue.value);
        objPpn.dpp = Number(dppValue.value);
    }

    objPrice = {dataSharingPrice, dataExclusivePrice, priceType, slotQty, objPpn};
    price.value = JSON.stringify(objPrice);

}
// Function Get Videotron Price --> end

// Function Sharing Price Action --> start
sharingPrice = (sel) => {
    const cbShareTitle = document.querySelectorAll('[id=cbShareTitle]');
    const shareTitle = document.querySelectorAll('[id=shareTitle]');
    const sharePrice = document.querySelectorAll('[id=sharePrice]');

    if(ppnYes.checked == true){
        alert('Harga include PPN, hanya dapat dipilih satu harga');
        if(sel.checked == true){
            sel.checked = false;
        }else{
            sel.checked = true;
        }
    }else{
        if(sel.checked == true){
            for(let i = 0; i < cbShareTitle.length; i++){
                cbShareTitle[i].checked = true;
                cbShareTitle[i].removeAttribute('disabled');
                shareTitle[i].removeAttribute('disabled');
                shareTitle[i].removeAttribute('hidden');
                sharePrice[i].classList.add('flex');
                sharePrice[i].classList.remove('hidden');
                shareTitle[i].value = shareTitle[i].defaultValue;
                sharePrice[i].value = sharePrice[i].defaultValue;
                document.getElementById("slotQty").value = document.getElementById("slotQty").defaultValue;
                document.getElementById("slotQty").removeAttribute('disabled');
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
                    shareTitle[i].setAttribute('hidden', 'hidden');
                    sharePrice[i].classList.add('hidden');
                    sharePrice[i].classList.remove('flex');
                    shareTitle[i].value = "";
                    sharePrice[i].value = "";
                    document.getElementById("slotQty").value = document.getElementById("slotQty").defaultValue;
                    document.getElementById("slotQty").setAttribute('disabled', 'disabled');
                }
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

    if(ppnYes.checked == true){
        alert('Harga include PPN, hanya dapat dipilih satu harga');
        if(sel.checked == true){
            sel.checked = false;
        }else{
            sel.checked = true;
        }
    }else{
        if(sel.checked == true){
            for(let i = 0; i < cbExTitle.length; i++){
                cbExTitle[i].checked = true;
                cbExTitle[i].removeAttribute('disabled');
                exTitle[i].removeAttribute('disabled');
                exTitle[i].removeAttribute('hidden');
                exPrice[i].classList.add('flex');
                exPrice[i].classList.remove('hidden');
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
                    exTitle[i].setAttribute('hidden','hidden');
                    exPrice[i].classList.add('hidden');
                    exPrice[i].classList.remove('flex');
                    exTitle[i].value = "";
                    exPrice[i].value = "";
                }
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
    if(ppnYes.checked == true){
        alert('Harga include PPN, hanya dapat dipilih satu harga');
        if(sel.checked == true){
            sel.checked = false;
        }else{
            sel.checked = true;
        }
    }else{
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
                        sharePrice[i].value = sharePrice[i].defaultValue * document.getElementById("slotQty").value;
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
}
// Function Checkbox Sharing Check Action --> end

// Function Checkbox Exclusive Check Action --> start
cbExclusiveCheck = (sel) => {
    const cbExTitle = document.querySelectorAll('[id=cbExTitle]');
    const exTitle = document.querySelectorAll('[id=exTitle]');
    const exPrice = document.querySelectorAll('[id=exPrice]');

    var index = parseInt(sel.name.replace(/[A-Za-z$-]/g, ""));
    if(ppnYes.checked == true){
        alert('Harga include PPN, hanya dapat dipilih satu harga');
        if(sel.checked == true){
            sel.checked = false;
        }else{
            sel.checked = true;
        }
    }else{
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
    if(Number(sel.value) < document.getElementById("maxSlot").value && Number(sel.value) > 0){
        for(let i = 0; i < sharePrice.length; i++){
            if(i == 0){
                sharePrice[i].value = ((objProducts[0].price *27.5/100) / 10) * Number(sel.value);
            }else if(i == 1){
                sharePrice[i].value = ((objProducts[0].price *27.5/100) *27.5/100) * Number(sel.value);
            }else if(i == 2){
                sharePrice[i].value = ((objProducts[0].price *27.5/100) * 52.5/100) * Number(sel.value);
            }else if(i == 3){
                sharePrice[i].value = ((objProducts[0].price *27.5/100)) * Number(sel.value);
            }
            
            if(ppnYes.checked == true){
                if( cbShareTitle[i].checked == true ){
                    getPrice = sharePrice[i].value;
                    dppValue.value = sharePrice[i].value;
                }
            }
        }
        if(ppnYes.checked == true){
            countGrandTotal();
        }
    }else if(sel.value > document.getElementById("maxSlot").value){
        alert('Jumlah slot maksimal ' + document.getElementById("maxSlot").value);
        sel.value = sel.defaultValue;
        for(let i = 0; i < sharePrice.length; i++){
            sharePrice[i].value = Number(sharePrice[i].defaultValue);
            if(ppnYes.checked == true){
                getPrice = sharePrice[i].value;
                dppValue.value = sharePrice[i].value;
            }
        }
        if(ppnYes.checked == true){
            countGrandTotal();
        }
    }
}

checkSlot = (sel) =>{
    if(sel.value == null || sel.value == 0){
        alert('Jumlah slot tidak boleh kosong');
        sel.value = sel.defaultValue;
        for(let i = 0; i < sharePrice.length; i++){
            sharePrice[i].value = Number(sharePrice[i].defaultValue);
            if(ppnYes.checked == true){
                getPrice = sharePrice[i].value;
                dppValue.value = sharePrice[i].value;
            }
        }
        if(ppnYes.checked == true){
            countGrandTotal();
        }
    }
}
// Function Input Slot Action --> end

// Function Remove Location --> start
removeLocation = (sel) => {
    const locationView = document.querySelectorAll('[id=locationView]');
    const tableBody = document.getElementById("tableBody");
    const trButton = tableBody.getElementsByTagName("button");

    if(objProducts.length > 1){
        for(let i = 0; i < objProducts.length; i++){
            if(objProducts[i].id == sel.name){
                objProducts.splice(i, 1);
            }
        }
        tableBody.deleteRow(sel.id);
        locationView[Number(sel.id)].classList.remove("flex");
        locationView[Number(sel.id)].classList.add("hidden");
        for(let i = 0; i < tableBody.rows.length; i++){
            if(i < tableBody.rows.length - 4){
                tableBody.rows[i].cells[0].innerHTML = i + 1;
            }
        }
        for(let i = 0; i < trButton.length; i++){
            trButton[i].id = i;
        }
        if(ppnYes.checked == true){
            var totalPrice = countTotalPrice();
            var dpp = totalPrice;
            subTotal.innerHTML = totalPrice.toLocaleString();
            dppValue.value = dpp;
            countGrandTotal();
        }
        document.getElementById("products").value = JSON.stringify(objProducts);
        if(objProducts.length == 1){
            document.getElementById("dppValue").removeAttribute('readonly');
        }
    }else{
        alert('Minimal harus ada 1 lokasi');
    }
}
// Function Remove Location --> end

countTotalPrice = ()=>{
    const cbBillboardTitle = document.querySelectorAll('[id=cbBillboardTitle]');
    var totalPrice = 0;

    getBillboardPrice();

    let objPrice = JSON.parse(price.value);

    for(let i = 0; i < cbBillboardTitle.length; i++){
        if( cbBillboardTitle[i].checked == true ){
            for(let n = 0; n < objPrice.dataPrice[i].length; n++){
                totalPrice = totalPrice + objPrice.dataPrice[i][n].price;
                if(document.getElementById("totalPrint") && document.getElementById("cbIncludePrint").checked == true){
                    totalPrice = totalPrice + Number(document.getElementById("totalPrint").innerText);
                }
                if(document.getElementById("totalInstall") && document.getElementById("cbIncludeInstall").checked == true){
                    totalPrice = totalPrice + Number(document.getElementById("totalInstall").innerText);
                }
            }
        }
    }
    return totalPrice;
}

// Function PPN Check Action --> start
ppnCheckAction = (sel) =>{
    const cbBillboardTitle = document.querySelectorAll('[id=cbBillboardTitle]');
    const tableTbody = document.getElementById("tableBody");
    const rows = tableTbody.getElementsByTagName("tr");
    
    let index = 0;
    if(sel.value == "yes"){
        if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
            for(let i = 0; i < cbShareTitle.length; i++){
                if( cbShareTitle[i].checked == true ){
                    index++;
                    getPrice = sharePrice[i].value;
                }
            }
            for(let i = 0; i < cbExTitle.length; i++){
                if( cbExTitle[i].checked == true ){
                    index++;
                    getPrice = exPrice[i].value;
                }
            }
            if(index > 1){
                alert('Pilih salah satu harga saja');
                document.getElementById("ppnNo").checked = true;
                sel.checked = false;
            }else{
                dppValue.value = getPrice;
                var ppn = dppValue.value * (Number(ppnValue.value) / 100);
                ppnNominal.innerHTML = ppn.toLocaleString();
                grandTotal.innerHTML = (Number(getPrice) + Number(ppn)).toLocaleString();
                for(let i = 0; i < rows.length; i++){
                    if(i > rows.length - 3){
                        rows[i].removeAttribute("hidden");
                    }
                }
                document.getElementById("ppnNote").value = "- Harga di atas sudah termasuk PPN";
            }
        }else{
            for(let i = 0; i < cbBillboardTitle.length; i++){
                if( cbBillboardTitle[i].checked == true ){
                    index++;
                }
            }
            if(index > 1){
                alert('Pilih salah satu harga saja');
                document.getElementById("ppnNo").checked = true;
                sel.checked = false;
            }else{
                var totalPrice = countTotalPrice();
                var dpp = totalPrice;
                var ppn = dpp * (Number(ppnValue.value) / 100);
                subTotal.innerHTML = totalPrice.toLocaleString();
                dppValue.value = dpp;
                ppnNominal.innerHTML = ppn.toLocaleString();
                grandTotal.innerHTML = (totalPrice + ppn).toLocaleString();
                for(let i = 0; i < rows.length; i++){
                    if(i > rows.length - 3){
                        rows[i].removeAttribute("hidden");
                    }
                }
                rowSubTotal.removeAttribute('hidden');
                document.getElementById("ppnNote").value = "- Harga di atas sudah termasuk PPN";
            }
        }
    }else{
        if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
            for(let i = 0; i < rows.length; i++){
                if(i > rows.length - 3){
                    rows[i].setAttribute('hidden', 'hidden');
                }
            }
            document.getElementById("ppnNote").value =  "- Harga di atas belum termasuk PPN";
        }else{
            for(let i = 0; i < rows.length; i++){
                if(i > rows.length - 3){
                    rows[i].setAttribute('hidden', 'hidden');
                }
            }
            if(document.getElementById("cbIncludeInstall")){
                if(document.getElementById("cbIncludeInstall").checked == false && document.getElementById("cbIncludePrint").checked == false){
                    rowSubTotal.setAttribute('hidden', 'hidden');
                }
            }else{
                rowSubTotal.setAttribute('hidden', 'hidden');
            }
            document.getElementById("ppnNote").value =  "- Harga di atas belum termasuk PPN";
        }
    }
}
// Function PPN Check Action --> end

countGrandTotal = () =>{
    var ppn = dppValue.value * (ppnValue.value / 100);
    ppnNominal.innerHTML = ppn.toLocaleString();
    if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
        grandTotal.innerHTML = (Number(getPrice) + Number(ppn)).toLocaleString();
    }else{
        grandTotal.innerHTML = (countTotalPrice() + ppn).toLocaleString();
    }
}

inputPriceChange = (sel) =>{
    if(ppnYes.checked == true){
        if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
            getPrice = Number(sel.value);
            var dpp = getPrice;
            dppValue.value = dpp;
            countGrandTotal();
        }else{
            var totalPrice = countTotalPrice();
            var dpp = totalPrice;
            subTotal.innerHTML = totalPrice.toLocaleString();
            dppValue.value = dpp;
            countGrandTotal();
        }
    }
}
checkPrice = (sel) =>{
    if(sel.value == 0 || sel.value == null){
        alert('Harga tidak boleh kosong');
        if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
            if(document.getElementById("cbSharing").checked == true && sel.id == "sharePrice"){
                sel.value = sel.defaultValue * document.getElementById("slotQty").value;
            }else{
                sel.value = sel.defaultValue;
            }
        }else{
            sel.value = sel.defaultValue;
        }
        if(ppnYes.checked == true){
            if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
                getPrice = Number(sel.value);
                var dpp = getPrice;
                dppValue.value = dpp;
                countGrandTotal();
            }else{
                var totalPrice = countTotalPrice();
                var dpp = totalPrice;
                subTotal.innerHTML = totalPrice.toLocaleString();
                dppValue.value = dpp;
                countGrandTotal();
            }
        }
    }
}
//set ppn --> start
setPpn = (sel) =>{
    countGrandTotal();
}
checkPpn = (sel) =>{
    if(sel.value == 0 || sel.value == null){
        alert('PPN tidak boleh kosong');
        sel.value = sel.defaultValue;
        countGrandTotal();
    }
}
//set ppn --> end

//Get DPP --> start
getDpp = (sel) =>{
    if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
        for(let i = 0; i < cbShareTitle.length; i++){
            if( cbShareTitle[i].checked == true ){
                getPrice = sharePrice[i].value;
            }
        }
        for(let i = 0; i < cbExTitle.length; i++){
            if( cbExTitle[i].checked == true ){
                getPrice = exPrice[i].value;
            }
        }
        if(Number(sel.value) > Number(getPrice)){
            alert('Nilai DDP tidak boleh lebih besar dari harga');
            sel.value = Number(getPrice);
            countGrandTotal();
        }else{
            countGrandTotal();
        }
    }else{
        if(Number(sel.value) > countTotalPrice()){
            alert('Nilai DDP tidak boleh lebih besar dari harga');
            sel.value = countTotalPrice();
            countGrandTotal();
        }else{
            countGrandTotal();
        }
    }
}
dppCheck = (sel) =>{
    var totalPrice = countTotalPrice();
    if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
        if(sel.value == null || sel.value == 0){
            alert('Nilai DDP tidak boleh kosong');
            if(sel.defaultValue == 0 || sel.defaultValue == null){
                sel.value = totalPrice;
            }else{
                sel.value = sel.defaultValue;
            }
            countGrandTotal();
        }
    }else{
        if(sel.value == null || sel.value == 0){
            alert('Nilai DDP tidak boleh kosong');
            if(productsQty.length > 1){
                sel.value = countTotalPrice();
            }else{
                if(sel.defaultValue == 0 || sel.defaultValue == null){
                    sel.value = totalPrice;
                }else{
                    sel.value = sel.defaultValue;
                }
            }
            countGrandTotal();
        }
    }
}

alertDpp = () =>{
    if(objProducts.length > 1){
        alert("Lokasi lebih dari satu, DPP tidak dapat diatur manual..!!");
    }
}
//Get DPP --> end
periodeTitleCheck = (sel) =>{
    if(sel.value == ""){
        alert("Periode harga tidak boleh kosong..!!");
        sel.value = sel.defaultValue;
    }
}

//Checkbox include print action --> start
cbIncludePrintAction = (sel) => {
    const cbBillboardTitle = document.querySelectorAll('[id=cbBillboardTitle]');
    const rowPrint = document.getElementById("rowPrint");
    const rowSubTotal = document.getElementById("rowSubTotal");
    const cbIncludeInstall = document.getElementById("cbIncludeInstall");
    const printNote = document.getElementById("printNote");
    const includePrintQty = document.getElementById("includePrintQty");
    const printQty = document.getElementById("printQty");
    const printPrice = document.getElementById("printPrice");
    const totalPrint = document.getElementById("totalPrint");
    const printProduct = document.getElementById("printProduct");
    let index = 0;

    for(let i = 0; i < cbBillboardTitle.length; i++){
        if( cbBillboardTitle[i].checked == true ){
            index++;
        }
    }
    if(index > 1){
        alert('Pilih salah satu harga saja');
        sel.checked = false;
    }else{
        if(sel.checked == true){
            printNote.innerText = "• Include cetak materi visual";
            printQty.value = includePrintQty.value;
            printQty.setAttribute('readonly', 'readonly');
            rowPrint.removeAttribute('hidden');
            if(cbIncludeInstall.checked == false && document.getElementById("ppnYes").checked == false){
                rowSubTotal.removeAttribute('hidden');
            }
            subTotal.innerText = countTotalPrice();
            dppValue.value = countTotalPrice();
            countGrandTotal();
        }else{
            printNote.innerText = "• Free cetak materi visual";
            printQty.value = "";
            printQty.removeAttribute('readonly');
            rowPrint.setAttribute('hidden', 'hidden');
            if(cbIncludeInstall.checked == false && document.getElementById("ppnYes").checked == false){
                rowSubTotal.setAttribute('hidden', 'hidden');
            }
            printPrice.value = printPrice.defaultValue;
            printQty.value = printQty.defaultValue;
            includePrintQty.value = includePrintQty.defaultValue;
            printProduct.options.selectedIndex = 0;
            totalPrint.innerHTML = 0;
            subTotal.innerText = countTotalPrice();
            dppValue.value = countTotalPrice();
            countGrandTotal();
        }
    }
}
//Checkbox include print action --> end

//Checkbox include install action --> start
cbIncludeInstallAction = (sel) => {
    const cbBillboardTitle = document.querySelectorAll('[id=cbBillboardTitle]');
    const rowInstall = document.getElementById("rowInstall");
    const totalInstall = document.getElementById("totalInstall");
    const installPrice = document.getElementById("installPrice");
    const installWide = document.getElementById("installWide");
    const rowSubTotal = document.getElementById("rowSubTotal");
    const cbIncludePrint = document.getElementById("cbIncludePrint");
    const installNote = document.getElementById("installNote");
    const installQty = document.getElementById("installQty");
    const includeInstallQty = document.getElementById("includeInstallQty");
    let index = 0;

    for(let i = 0; i < cbBillboardTitle.length; i++){
        if( cbBillboardTitle[i].checked == true ){
            index++;
        }
    }
    if(index > 1){
        alert('Pilih salah satu harga saja');
        sel.checked = false;
    }else{
        if(sel.checked == true){
            installNote.innerText = "• Include pemasangan materi visual";
            installQty.value = includeInstallQty.value;
            installQty.setAttribute('readonly', 'readonly');
            rowInstall.removeAttribute('hidden');
            if(cbIncludePrint.checked == false && document.getElementById("ppnYes").checked == false){
                rowSubTotal.removeAttribute('hidden');
            }
            subTotal.innerText = countTotalPrice();
            dppValue.value = countTotalPrice();
            countGrandTotal();
        }else{
            installNote.innerText = "• Free pemasangan materi visual";
            installQty.value = "";
            installQty.removeAttribute('readonly');
            rowInstall.setAttribute('hidden', 'hidden');
            if(cbIncludePrint.checked == false && document.getElementById("ppnYes").checked == false){
                rowSubTotal.setAttribute('hidden', 'hidden');
            }
            installPrice.value = installPrice.defaultValue;
            includeInstallQty.value = includeInstallQty.defaultValue;
            totalInstall.innerText = installPrice.value * includeInstallQty.value * installWide.value;
            subTotal.innerText = countTotalPrice();
            dppValue.value = countTotalPrice();
            countGrandTotal();
        }
    }
}
//Checkbox include install action --> end

//Select print product action --> start
selectProduct = (sel) => {
    const printPrice = document.getElementById("printPrice");
    const includePrintQty = document.getElementById("includePrintQty");
    const printWide = document.getElementById("printWide");
    const totalPrint = document.getElementById("totalPrint");
    const subTotal = document.getElementById("subTotal");

    if(sel.options[sel.selectedIndex].value != "pilih"){
        printPrice.value = Number(sel.options[sel.selectedIndex].id);
        totalPrint.innerHTML = printPrice.value * includePrintQty.value * printWide.value;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
        printPrice.removeAttribute('readonly');
    }else{
        printPrice.setAttribute('readonly', 'readonly');
        printPrice.value = printPrice.defaultValue;
        totalPrint.innerHTML = 0;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
    }

}
//Select print product action --> end

//Print price check & change --> start
inputPrintPriceChange = (sel) => {
    const includePrintQty = document.getElementById("includePrintQty");
    const printWide = document.getElementById("printWide");
    const totalPrint = document.getElementById("totalPrint");
    const subTotal = document.getElementById("subTotal");
    const printProduct = document.getElementById("printProduct");
    if(sel.value == 0 || sel.value == ""){
        alert ("Harga tidak boleh kosong");
        sel.value = Number(printProduct.options[printProduct.selectedIndex].id);
        totalPrint.innerHTML = sel.value * includePrintQty.value * printWide.value;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
    } else{
        totalPrint.innerHTML = sel.value * includePrintQty.value * printWide.value;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
    }
}

inputPrintPriceCheck = (sel) => {
    const includePrintQty = document.getElementById("includePrintQty");
    const printWide = document.getElementById("printWide");
    const totalPrint = document.getElementById("totalPrint");
    const subTotal = document.getElementById("subTotal");
    totalPrint.innerHTML = sel.value * includePrintQty.value * printWide.value;
    subTotal.innerText = countTotalPrice();
    dppValue.value = countTotalPrice();
    countGrandTotal();
}
//Print price check --> end

//Install price check & change --> start
inputInstallPriceChange = (sel) => {
    const includeInstallQty = document.getElementById("includeInstallQty");
    const installWide = document.getElementById("installWide");
    const totalInstall = document.getElementById("totalInstall");
    const subTotal = document.getElementById("subTotal");
    if(sel.value == 0 || sel.value == ""){
        alert ("Harga tidak boleh kosong");
        sel.value = sel.defaultValue;
        totalInstall.innerHTML = sel.value * includeInstallQty.value * installWide.value;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
    } else{
        totalInstall.innerHTML = sel.value * includeInstallQty.value * installWide.value;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
    }
}

inputInstallPriceCheck = (sel) => {
    const includeInstallQty = document.getElementById("includeInstallQty");
    const installWide = document.getElementById("installWide");
    const totalInstall = document.getElementById("totalInstall");
    const subTotal = document.getElementById("subTotal");
    totalInstall.innerHTML = sel.value * includeInstallQty.value * installWide.value;
    subTotal.innerText = countTotalPrice();
    dppValue.value = countTotalPrice();
    countGrandTotal();
}
//Install price check & change --> end

//Print qty check & change --> start
inputPrintQtyChange = (sel) => {
    const printPrice = document.getElementById("printPrice");
    const printWide = document.getElementById("printWide");
    const totalPrint = document.getElementById("totalPrint");
    const subTotal = document.getElementById("subTotal");
    const printQty = document.getElementById("printQty");
    if(sel.value == 0 || sel.value == ""){
        alert ("Jumlah tidak boleh kosong");
        sel.value = sel.defaultValue;
        printQty.value = sel.value;
        totalPrint.innerHTML = sel.value * printPrice.value * printWide.value;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
    } else{
        totalPrint.innerHTML = sel.value * printPrice.value * printWide.value;
        printQty.value = sel.value;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
    }
}

inputPrintQtyCheck = (sel) => {
    const printPrice = document.getElementById("printPrice");
    const printWide = document.getElementById("printWide");
    const totalPrint = document.getElementById("totalPrint");
    const subTotal = document.getElementById("subTotal");
    const printQty = document.getElementById("printQty");
    printQty.value = sel.value;
    totalPrint.innerHTML = sel.value * printPrice.value * printWide.value;
    subTotal.innerText = countTotalPrice();
    dppValue.value = countTotalPrice();
    countGrandTotal();
}
//Print qty check & change --> end

//install qty check & change --> start
inputInstallQtyChange = (sel) => {
    const installPrice = document.getElementById("installPrice");
    const installWide = document.getElementById("installWide");
    const totalInstall = document.getElementById("totalInstall");
    const subTotal = document.getElementById("subTotal");
    const installQty = document.getElementById("installQty");
    if(sel.value == 0 || sel.value == ""){
        alert ("Jumlah tidak boleh kosong");
        sel.value = sel.defaultValue;
        installQty.value = sel.value;
        totalInstall.innerHTML = sel.value * installPrice.value * installWide.value;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
    } else{
        totalInstall.innerHTML = sel.value * installPrice.value * installWide.value;
        installQty.value = sel.value;
        subTotal.innerText = countTotalPrice();
        dppValue.value = countTotalPrice();
        countGrandTotal();
    }
}

inputInstallQtyCheck = (sel) => {
    const installPrice = document.getElementById("installPrice");
    const installWide = document.getElementById("installWide");
    const totalInstall = document.getElementById("totalInstall");
    const subTotal = document.getElementById("subTotal");
    const installQty = document.getElementById("installQty");
    installQty.value = sel.value;
    totalInstall.innerHTML = sel.value * installPrice.value * installWide.value;
    subTotal.innerText = countTotalPrice();
    dppValue.value = countTotalPrice();
    countGrandTotal();
}
//install qty check & change --> end

//Include service check --> start
includeServiceChecking = () => {
    const cbIncludePrint = document.getElementById("cbIncludePrint");
    const cbIncludeInstall = document.getElementById("cbIncludeInstall");
    const printProduct = document.getElementById("printProduct");
    const printPrice = document.getElementById("printPrice");
    const printQty = document.getElementById("printQty");
    if(cbIncludePrint.checked == true){
        if(printProduct.value == "pilih"){
            alert("Silahkan pilih bahan cetak terlebih dahulu..!!");
            return false;
        }else if(cbIncludeInstall.checked == true){
            includedPrint.checked = true;
            includedPrint.product = printProduct.value;
            includedPrint.qty = printQty.value;
            includedPrint.price = printPrice.value;
            includedInstall.checked = true;
            includedInstall.qty = installQty.value;
            includedInstall.price = installPrice.value;
            return true;
        }else{
            includedPrint.checked = true;
            includedPrint.product = printProduct.value;
            includedPrint.qty = printQty.value;
            includedPrint.price = printPrice.value;
            return true;
        }
    }else if(cbIncludeInstall.checked == true){
        includedInstall.checked = true;
        includedInstall.qty = installQty.value;
        includedInstall.price = installPrice.value;
        return true;
    }else{
        return true;
    }
}
//Include service check --> end

// Search Table --> start
function searchArea(sel) {
    const search = document.getElementById("search");
    const city = document.getElementById("city");
    const locationsTable = document.getElementById("locationsTable");
    var filter, tr, td, i, found;
    if(sel.value == "All"){
        city.value = "All";
        city.setAttribute('disabled','disabled');
    }else{
        const option = [];
    
        for (i = 0; i < cities.length; i++) {
            if (cities[i]['area_id'] == sel.options[sel.options.selectedIndex].id) {
                option[i] = document.createElement('option');
                option[i].appendChild(document.createTextNode(cities[i]['city']));
                option[i].setAttribute('value', cities[i]['city']);
                city.appendChild(option[i]);
            }
        }
        city.removeAttribute('disabled');
    }
    if(sel.value == "All"){
        filter = '';
    }else{
        filter = sel.value.toUpperCase();
    }
    filter = sel.value.toUpperCase();
    filterSearch = search.value.toUpperCase();
    if(city.value == "All"){
        filterCity = '';
    }else{
        filterCity = city.value.toUpperCase();
    }
    tr = locationsTable.getElementsByTagName("tr");
    
    for (i = 2; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filterSearch) > -1 && td[3].innerHTML.toUpperCase().indexOf(filter) > -1 && td[4].innerHTML.toUpperCase().indexOf(filterCity) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
function searchTable() {
    const search = document.getElementById("search");
    const area = document.getElementById("area");
    const city = document.getElementById("city");
    const locationsTable = document.getElementById("locationsTable");
    var filter, tr, td, i, found;
    filter = search.value.toUpperCase();
    if(area.value == "All"){
        filterArea = '';
    }else{
        filterArea = area.value.toUpperCase();
    }
    if(city.value == "All"){
        filterCity = '';
    }else{
        filterCity = city.value.toUpperCase();
    }
    tr = locationsTable.getElementsByTagName("tr");
    
    for (i = 2; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1 && td[3].innerHTML.toUpperCase().indexOf(filterArea) > -1 && td[4].innerHTML.toUpperCase().indexOf(filterCity) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
function searchCity(sel) {
    const search = document.getElementById("search");
    const area = document.getElementById("area");
    const locationsTable = document.getElementById("locationsTable");
    var filter, tr, td, i, found;
    if(sel.value == "All"){
        filter = '';
    }else{
        filter = sel.value.toUpperCase();
    }
    filterSearch = search.value.toUpperCase();
    if(area.value == "All"){
        filterArea = '';
    }else{
        filterArea = area.value.toUpperCase();
    }
    tr = locationsTable.getElementsByTagName("tr");
    for (i = 2; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            for (j = 0; j < td.length; j++) {
                if (td[j].innerHTML.toUpperCase().indexOf(filterSearch) > -1 && td[3].innerHTML.toUpperCase().indexOf(filterArea) > -1 && td[4].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                }
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
// Search Table --> end

btnClose = () => {
    document.getElementById("modalLocation").classList.remove('flex');
    document.getElementById("modalLocation").classList.add('hidden');
}
btnAddLocation = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    document.getElementById("modalLocation").classList.remove('hidden');
    document.getElementById("modalLocation").classList.add('flex');
}

addNewLocations = (sel) => {
    var getNewProduct = JSON.parse(sel.value);
    var getDetail = sel.id.split('*');
    if(sel.checked == true){
        var newProduct = {
            id : getNewProduct.id,
            area : getDetail[0],
            city : getDetail[1],
            city_code : getDetail[2],
            code : getNewProduct.code,
            side : getNewProduct.side,
            size : getDetail[6],
            type : getNewProducts[0].type,
            photo : getDetail[7],
            price : getNewProduct.price,
            width : getDetail[3],
            height : getDetail[4],
            sector : getNewProduct.sector,
            address : getNewProduct.address,
            category : getDetail[5],
            description : getNewProduct.description,
            orientation : getNewProduct.orientation,
            max_distance : getNewProduct.max_distance,
            road_segment : getNewProduct.road_segment,
            speed_average : getNewProduct.speed_average
        }
        if(getNewPrice.dataTitle[0].checkbox == true){
            newPriceMonth = {
                code : getNewProduct.code,
                price : getNewProduct.price * 0.1
            }
        }else{
            newPriceMonth = {
                code : getNewProduct.code,
                price : 0
            }
        }
    
        if(getNewPrice.dataTitle[1].checkbox == true){
            newPriceQuarter = {
                code : getNewProduct.code,
                price : getNewProduct.price * 0.275
            }
        }else{
            newPriceQuarter = {
                code : getNewProduct.code,
                price : 0
            }
        }
    
        if(getNewPrice.dataTitle[2].checkbox == true){
            newPriceHalf = {
                code : getNewProduct.code,
                price : getNewProduct.price * 0.525
            }
        }else{
            newPriceHalf = {
                code : getNewProduct.code,
                price : 0
            }
        }
    
        if(getNewPrice.dataTitle[3].checkbox == true){
            newPriceYear = {
                code : getNewProduct.code,
                price : getNewProduct.price
            }
        }else{
            newPriceYear = {
                code : getNewProduct.code,
                price : 0
            }
        }

        getNewPrice.dataPrice[0].push(newPriceMonth);
        getNewPrice.dataPrice[1].push(newPriceQuarter);
        getNewPrice.dataPrice[2].push(newPriceHalf);
        getNewPrice.dataPrice[3].push(newPriceYear);

        if(getNewPrice.objPpn.checked == true){  
            getNewPrice.objPpn.dpp = 0;
            for(let i = 0; i < getNewPrice.dataTitle.length; i++){
                if(getNewPrice.dataTitle[i].checkbox == true){
                    for(let j = 0; j < getNewPrice.dataPrice[i].length; j++){
                        getNewPrice.objPpn.dpp = Number(getNewPrice.objPpn.dpp) + Number(getNewPrice.dataPrice[i][j].price);
                    }
                }
            }
        }
    
        getNewProducts.push(newProduct);
    }else{
        for(let i = 0; i < getNewProducts.length; i++){
            if(getNewProducts[i].id == getNewProduct.id){
                getNewProducts.splice(i, 1);
            }
        }
        for(let i = 0; i < getNewPrice.dataPrice[0].length; i++){
            if(getNewPrice.dataPrice[0][i].code == getNewProduct.code){
                getNewPrice.dataPrice[0].splice(i, 1);
                getNewPrice.dataPrice[1].splice(i, 1);
                getNewPrice.dataPrice[2].splice(i, 1);
                getNewPrice.dataPrice[3].splice(i, 1);
            }
        }
        
        if(getNewPrice.objPpn.checked == true){  
            getNewPrice.objPpn.dpp = 0;
            for(let i = 0; i < getNewPrice.dataTitle.length; i++){
                if(getNewPrice.dataTitle[i].checkbox == true){
                    for(let j = 0; j < getNewPrice.dataPrice[i].length; j++){
                        getNewPrice.objPpn.dpp = Number(getNewPrice.objPpn.dpp) + Number(getNewPrice.dataPrice[i][j].price);
                    }
                }
            }
        }
    }

    newProducts.value = JSON.stringify(getNewProducts);
    newPrice.value = JSON.stringify(getNewPrice);
    document.getElementById("products").value = JSON.stringify(getNewProducts);
}
