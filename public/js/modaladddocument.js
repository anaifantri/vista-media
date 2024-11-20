const modalImages = document.getElementById("modalImages");
const figureImages = document.getElementById("figureImages");
const slidesPreview = document.getElementById("slidesPreview");
const numberImagesFile = document.getElementById("numberImagesFile");
const nextButton = document.getElementById("nextButton");
const prevButton = document.getElementById("prevButton");
const inputNumber = document.getElementById("inputNumber");
const inputDate = document.getElementById("inputDate");
const agreementNumber = document.getElementById("agreement_number");
const agreementDate = document.getElementById("agreement_date");
const orderNumber = document.getElementById("order_number");
const orderDate = document.getElementById("order_date");

let previewImage = [];
let slidePreview = [];
let slidePreviewImage = [];
let index = 0;
let fileLength = 0;

//btn images action --> start
btnImages = (sel, choose, label) => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    const btnClear = document.getElementById("btnClear");
    const btnSubmit = document.getElementById("btnSubmit");
    const btnChooseImages = document.getElementById("btnChooseImages");
    const documentNumber = document.getElementById("documentNumber");
    const documentDate = document.getElementById("documentDate");
    const title = document.getElementById("title");
    
    const labelId = label[0].id;
    const inputId = choose.id;

    if(sel.id == "approval"){
        title.innerHTML = "DOKUMEN PERSETUJUAN";
        documentNumber.classList.remove("flex");
        documentNumber.classList.add("hidden");
        documentDate.classList.remove("flex");
        documentDate.classList.add("hidden");
    }else if(sel.id == "agreement"){
        title.innerHTML = "DOKUMEN PERJANJIAN";
        documentNumber.classList.remove("hidden");
        documentNumber.classList.add("flex");
        documentDate.classList.remove("hidden");
        documentDate.classList.add("flex");
        inputNumber.setAttribute('onkeyup', 'getAgreementNumber(this)');
        if(agreementNumber.value != ""){
            inputNumber.value = agreementNumber.value;
        }else{
            inputNumber.value = "";
        }
        inputDate.setAttribute('onchange', 'getAgreementDate(this)');
        if(agreementDate.value != ""){
            inputDate.value = agreementDate.value;
        }else {
            inputDate.value = "";
        }
    }else if(sel.id == "po"){
        title.innerHTML = "DOKUMEN PO/SPK";
        documentNumber.classList.remove("hidden");
        documentNumber.classList.add("flex");
        documentDate.classList.remove("hidden");
        documentDate.classList.add("flex");
        inputNumber.setAttribute('onkeyup', 'getPoNumber(this)');
        if(orderNumber.value != ""){
            inputNumber.value = orderNumber.value;
        }else{
            inputNumber.value = "";
        }
        inputDate.setAttribute('onchange', 'getPoDate(this)');
        if(orderDate.value != ""){
            inputDate.value = orderDate.value;
        }else{
            inputDate.value = "";
        }
    }

    modalImages.classList.remove("hidden");
    modalImages.classList.add("flex");

    btnChooseImages.setAttribute('onclick', 'document.getElementById("'+inputId+'").click()');
    btnClear.setAttribute('onclick', 'btnClearAction(document.querySelectorAll("[id='+labelId+']"), document.getElementById("'+inputId+'"))');
    btnSubmit.setAttribute('onclick', 'btnSubmitAction('+sel.id+')');

    imagePreview(choose, label);
}
//btn images action --> end

//btn close action --> start
btnClose = () =>{
    modalImages.classList.remove("flex");
    modalImages.classList.add("hidden");
    prevButton.setAttribute('hidden', 'hidden');
    nextButton.setAttribute('hidden', 'hidden');
}
//btn close action --> end

//preview images --> start
imagePreview = (sel, label) => {
    fileLength = 0;
    index = 0;
    numberImagesFile.innerHTML = "Tidak Ada File Yang Dipilih";
    while (figureImages.hasChildNodes()) {
        figureImages.removeChild(figureImages.firstChild);
    }

    while (slidesPreview.hasChildNodes()) {
        slidesPreview.removeChild(slidesPreview.firstChild);
    }

    if (sel.files.length != 0) {
        for(let i = 0; i < label.length; i++){
            label[i].innerHTML = "";
            label[i].innerHTML = sel.files.length + " dokumen";
        }
        
        numberImagesFile.innerHTML = sel.files.length + " file dipilih";
        fileLength = sel.files.length ;

        for (n = 0; n < sel.files.length; n++) {
            const file = sel.files[n];
            const objectUrl = URL.createObjectURL(file);

            previewImage[n] = document.createElement("img");
            if (n == 0) {
                previewImage[n].classList.add("document-approval-active");
            } else {
                previewImage[n].classList.add("document-approval");
            }

            previewImage[n].src = objectUrl;
            previewImage[n].setAttribute('id', n);
            previewImage[n].setAttribute('onclick', 'myPreviewSlide(this)');
            figureImages.appendChild(previewImage[n]);

            slidePreview[n] = document.createElement("figure");
            slidePreview[n].classList.add("mySlides");
            slidePreview[n].classList.add("fade");
            slidePreviewImage[n] = document.createElement("img");
            if (n != 0) {
                slidePreviewImage[n].classList.add("hidden");
            }
            slidePreviewImage[n].classList.add("w-full");
            slidePreviewImage[n].classList.add("mt-2");
            slidePreviewImage[n].src = objectUrl;
            slidePreview[n].appendChild(slidePreviewImage[n]);
            slidesPreview.appendChild(slidePreview[n]);
        }

        prevButton.removeAttribute('hidden');
        nextButton.removeAttribute('hidden');
    }
}
//preview images --> end

//Figure Image Action --> start
myPreviewSlide = (img) =>{
    slidePreviewImage[index].classList.add("hidden");
    previewImage[index].classList.remove("document-approval-active");
    previewImage[index].classList.add("document-approval");
    index = Number(img.id);
    slidePreviewImage[index].classList.remove("hidden");
    previewImage[index].classList.remove("document-approval");
    previewImage[index].classList.add("document-approval-active");
}
//Figure Image Action --> end

//prev button action --> start
prevButtonAction = () =>{
    if (index != 0) {
        slidePreviewImage[index].classList.add("hidden");
        previewImage[index].classList.remove("document-approval-active");
        previewImage[index].classList.add("document-approval");
        index = index - 1;
        slidePreviewImage[index].classList.remove("hidden");
        previewImage[index].classList.remove("document-approval");
        previewImage[index].classList.add("document-approval-active");
    } else {
        slidePreviewImage[index].classList.add("hidden");
        previewImage[0].classList.remove("document-approval-active");
        previewImage[0].classList.add("document-approval");
        index = fileLength - 1;
        slidePreviewImage[index].classList.remove("hidden");
        previewImage[index].classList.remove("document-approval");
        previewImage[index].classList.add("document-approval-active");
    }
}
//prev button action --> end

//next button action --> start
nextButtonAction = () =>{
    if (index != fileLength - 1) {
        slidePreviewImage[index].classList.add("hidden");
        previewImage[index].classList.remove("document-approval-active");
        previewImage[index].classList.add("document-approval");
        index = index + 1;
        slidePreviewImage[index].classList.remove("hidden");
        previewImage[index].classList.remove("document-approval");
        previewImage[index].classList.add("document-approval-active");
    } else {
        slidePreviewImage[index].classList.add("hidden");
        previewImage[index].classList.remove("document-approval-active");
        previewImage[index].classList.add("document-approval");
        index = 0;
        slidePreviewImage[index].classList.remove("hidden");
        previewImage[index].classList.remove("document-approval");
        previewImage[index].classList.add("document-approval-active");
    }
}
//next button action --> end

//clear button action --> start
btnClearAction = (label, inputFile) =>{
    prevButton.setAttribute('hidden', 'hidden');
    nextButton.setAttribute('hidden', 'hidden');
    for(let i = 0; i < label.length; i++){
        label[i].innerHTML = "";
        label[i].innerHTML = "0 dokumen";
    }
    inputFile.value = null;
    numberImagesFile.innerHTML = "Tidak Ada File Yang Dipilih";
    previewImage = [];
    slidePreview = [];
    slidePreviewImage = [];
    index = 0;
    fileLength = 0;
    while (figureImages.hasChildNodes()) {
        figureImages.removeChild(figureImages.firstChild);
    }

    while (slidesPreview.hasChildNodes()) {
        slidesPreview.removeChild(slidesPreview.firstChild);
    }
}
//clear button action --> end

//submit button action --> start
btnSubmitAction = (sel) =>{
    index = 0;
    if (fileLength == 0) {
        alert("Dokumen belum dipilih")
    }else if(sel.id == "approval"){
        prevButton.setAttribute('hidden', 'hidden');
        nextButton.setAttribute('hidden', 'hidden');
        modalImages.classList.add("hidden");
        modalImages.classList.remove("flex");
    }else{
        if (inputNumber.value == "") {
            alert("Nomor belum diinput")
        }else if (inputDate.value == "") {
            alert("Tanggal belum diinput")
        } else {
            prevButton.setAttribute('hidden', 'hidden');
            nextButton.setAttribute('hidden', 'hidden');
            modalImages.classList.add("hidden");
            modalImages.classList.remove("flex");
        }
    } 
}
//submit button action --> end

//get agreement number action --> start
getAgreementNumber = (sel) =>{
    agreementNumber.value = sel.value;
}
//get agreement number action --> end

//get po number action --> start
getPoNumber = (sel) =>{
    orderNumber.value = sel.value;
}
//get po number action --> end

//get agreement date action --> start
getAgreementDate = (sel) =>{
    agreementDate.value = sel.value;
}
//get agreement date action --> end

//get po date action --> start
getPoDate = (sel) =>{
    orderDate.value = sel.value;
}
//get po date action --> end