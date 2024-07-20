//Preview PO/SPK document --> start
const modalPO = document.getElementById("modalPO");
const btnSave = document.getElementById("btnSave");
const btnPOSubmit = document.getElementById("btnPOSubmit");
const btnPOClear = document.getElementById("btnPOClear");
const btnPOClose = document.getElementById("btnPOClose");
const orderNumber = document.getElementById("order_number");
const orderDate = document.getElementById("order_date");
const documentPO = document.getElementById("documentPO");
const slidesPOPreview = document.getElementById("slidesPOPreview");
const numberPOFile = document.getElementById("numberPOFile");
const prevPOButton = document.getElementById("prevPOButton");
const nextPOButton = document.getElementById("nextPOButton");
const poImg = document.getElementById("poImg");
const orderDocuments = document.querySelectorAll("[id='orderDocuments']");

let poImage = [];
let slidePOPreview = [];
let slidePOImage = [];
let slidePOIndex = 0;

function previewPOImage() {
    while (poImg.hasChildNodes()) {
        poImg.removeChild(poImg.firstChild);
    }

    while (slidesPOPreview.hasChildNodes()) {
        slidesPOPreview.removeChild(slidesPOPreview.firstChild);
    }

    if (documentPO.files.length != 0) {
        numberPOFile.innerHTML = "";
        numberPOFile.innerHTML = documentPO.files.length + " images selected";

        for (n = 0; n < documentPO.files.length; n++) {
            const file = documentPO.files[n];
            const objectUrl = URL.createObjectURL(file);

            poImage[n] = document.createElement("img")
            if (n == 0) {
                poImage[n].classList.add("document-approval-active");
            } else {
                poImage[n].classList.add("document-approval");
            }

            poImage[n].src = objectUrl;
            poImage[n].setAttribute('id', n);
            poImage[n].setAttribute('onclick', 'myPOSlide(this)');
            poImg.appendChild(poImage[n]);

            slidePOPreview[n] = document.createElement("figure");
            slidePOPreview[n].classList.add("mySlides");
            slidePOPreview[n].classList.add("fade");
            slidePOImage[n] = document.createElement("img");
            if (n != 0) {
                slidePOImage[n].classList.add("hidden");
            }
            slidePOImage[n].classList.add("w-full");
            slidePOImage[n].classList.add("mt-2");
            slidePOImage[n].src = objectUrl;
            slidePOPreview[n].appendChild(slidePOImage[n]);
            slidesPOPreview.appendChild(slidePOPreview[n]);
        }

        prevPOButton.removeAttribute('hidden');
        nextPOButton.removeAttribute('hidden');
    }
}

prevPOButton.addEventListener('click', function() {
    if (slidePOIndex != 0) {
        slidePOImage[slidePOIndex].classList.add("hidden");
        poImage[slidePOIndex].classList.remove("document-approval-active");
        poImage[slidePOIndex].classList.add("document-approval");
        slidePOIndex = slidePOIndex - 1;
        slidePOImage[slidePOIndex].classList.remove("hidden");
        poImage[slidePOIndex].classList.remove("document-approval");
        poImage[slidePOIndex].classList.add("document-approval-active");
    } else {
        slidePOImage[slidePOIndex].classList.add("hidden");
        poImage[0].classList.remove("document-approval-active");
        poImage[0].classList.add("document-approval");
        slidePOIndex = documentPO.files.length - 1;
        slidePOImage[slidePOIndex].classList.remove("hidden");
        poImage[slidePOIndex].classList.remove("document-approval");
        poImage[slidePOIndex].classList.add("document-approval-active");
    }
})

nextPOButton.addEventListener('click', function() {
    if (slidePOIndex != documentPO.files.length - 1) {
        slidePOImage[slidePOIndex].classList.add("hidden");
        poImage[slidePOIndex].classList.remove("document-approval-active");
        poImage[slidePOIndex].classList.add("document-approval");
        slidePOIndex = slidePOIndex + 1;
        slidePOImage[slidePOIndex].classList.remove("hidden");
        poImage[slidePOIndex].classList.remove("document-approval");
        poImage[slidePOIndex].classList.add("document-approval-active");
    } else {
        slidePOImage[slidePOIndex].classList.add("hidden");
        poImage[slidePOIndex].classList.remove("document-approval-active");
        poImage[slidePOIndex].classList.add("document-approval");
        slidePOIndex = 0;
        slidePOImage[slidePOIndex].classList.remove("hidden");
        poImage[slidePOIndex].classList.remove("document-approval");
        poImage[slidePOIndex].classList.add("document-approval-active");
    }
})

function myPOSlide(img) {
    slidePOImage[slidePOIndex].classList.add("hidden");
    poImage[slidePOIndex].classList.remove("document-approval-active");
    poImage[slidePOIndex].classList.add("document-approval");
    slidePOIndex = Number(img.id);
    slidePOImage[slidePOIndex].classList.remove("hidden");
    poImage[slidePOIndex].classList.remove("document-approval");
    poImage[slidePOIndex].classList.add("document-approval-active");
}

function btnPOEvent() {
    modalPO.classList.remove("hidden");
    modalPO.classList.add("flex");
    window.scrollTo(0, 0);
}

btnPOSubmit.addEventListener('click', function() {
    if (documentPO.files.length == 0) {
        alert("Dokumen po/spk dipilih")
    } else if (orderNumber.value == "") {
        alert("Nomor po/spk belum di input")
    } else if (orderDate.value == "") {
        alert("Tanggal po/spk belum diinput")
    } else {
        btnSave.click();
        // modalPO.classList.add("hidden");
        // modalPO.classList.remove("flex");
        // for (let i = 0; i < orderDocuments.length; i++) {
        //     orderDocuments[i].innerHTML = "";
        //     orderDocuments[i].innerHTML = numberPOFile.innerHTML;
        // }
    }
})

btnPOClear.addEventListener('click', function() {
    prevPOButton.setAttribute('hidden', 'hidden');
    nextPOButton.setAttribute('hidden', 'hidden');
    for (let i = 0; i < orderDocuments.length; i++) {
        orderDocuments[i].innerHTML = "";
        orderDocuments[i].innerHTML = "No Files Chosen";
    }
    documentPO.value = null;
    while (poImg.hasChildNodes()) {
        poImg.removeChild(poImg.firstChild);
    }

    while (slidesPOPreview.hasChildNodes()) {
        slidesPOPreview.removeChild(slidesPOPreview.firstChild);
    }

    numberPOFile.innerHTML = "No Files Chosen";
    orderDate.value = null;
    orderNumber.value = null;
})

btnPOClose.addEventListener('click', () => {
    modalPO.classList.add("hidden");
    modalPO.classList.remove("flex");
})
//Preview PO/SPK document --> end
