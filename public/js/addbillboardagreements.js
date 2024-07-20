const btnCloseAgreement = document.getElementById("btnCloseAgreement");
const btnAgreementUpload = document.getElementById("btnAgreementUpload");
const btnAgreementSave = document.getElementById("btnAgreementSave");
const btnAgreementClear = document.getElementById("btnAgreementClear");
const agreementBillboardQuotationId = document.getElementById("agreementBillboardQuotationId");
const agreementBillboardQuotRevisionId = document.getElementById("agreementBillboardQuotRevisionId");
const agreementNumber = document.getElementById("agreement_number");
const agreementDate = document.getElementById("agreement_date");
const documentAgreement = document.getElementById("documentAgreement");
const btnChoseAgreement = document.getElementById("btnChoseAgreement");
const btnAgreement = document.getElementById("btnAgreement");
const spanBtnAgreement = document.getElementById("spanBtnAgreement");

const slidesAgreementPreview = document.getElementById("slidesAgreementPreview");
const numberAgreementFile = document.getElementById("numberAgreementFile");
const prevAgreementButton = document.getElementById("prevAgreementButton");
const nextAgreementButton = document.getElementById("nextAgreementButton");
const agreementImg = document.getElementById("agreementImg");

let agreementImage = [];
let agreementNumberValue = "";
let agreementDateValue = "";
let slideAgreementPreview = [];
let slideAgreementImage = [];
let slideAgreementIndex = 0;


// Preview Agreement Document --> start
function addAgreementImage(quotID, quot) {
    modalAgreement.classList.remove("hidden");
    modalAgreement.classList.add("flex");
    window.scrollTo(0, 0);

    if (quot == "Main") {
        agreementBillboardQuotationId.value = "";
        agreementBillboardQuotRevisionId.value = "";
        agreementBillboardQuotationId.value = quotID;
    } else if (quot == "Revision") {
        agreementBillboardQuotationId.value = "";
        agreementBillboardQuotRevisionId.value = "";
        agreementBillboardQuotRevisionId.value = quotID;
    }   

    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }
}

function choseAgreementImage() {
    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }
    if (documentAgreement.files.length != 0) {
        numberAgreementFile.innerHTML = "";
        numberAgreementFile.innerHTML = documentAgreement.files.length + " images selected";

        for (n = 0; n < documentAgreement.files.length; n++) {
            const file = documentAgreement.files[n];
            const objectUrl = URL.createObjectURL(file);

            agreementImage[n] = document.createElement("img")
            if (n == 0) {
                agreementImage[n].classList.add("document-approval-active");
            } else {
                agreementImage[n].classList.add("document-approval");
            }

            agreementImage[n].src = objectUrl;
            agreementImage[n].setAttribute('id', n);
            agreementImage[n].setAttribute('onclick', 'myAgreementSlide(this)');
            agreementImg.appendChild(agreementImage[n]);

            slideAgreementPreview[n] = document.createElement("figure");
            slideAgreementPreview[n].classList.add("mySlides");
            slideAgreementPreview[n].classList.add("fade");
            slideAgreementImage[n] = document.createElement("img");
            if (n != 0) {
                slideAgreementImage[n].classList.add("hidden");
            }
            slideAgreementImage[n].classList.add("w-full");
            slideAgreementImage[n].classList.add("mt-2");
            slideAgreementImage[n].src = objectUrl;
            slideAgreementPreview[n].appendChild(slideAgreementImage[n]);
            slidesAgreementPreview.appendChild(slideAgreementPreview[n]);
        }

        prevAgreementButton.removeAttribute('hidden');
        nextAgreementButton.removeAttribute('hidden');
    }
}

prevAgreementButton.addEventListener('click', function () {
    if (slideAgreementIndex != 0) {
            slideAgreementImage[slideAgreementIndex].classList.add("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval-active");
            agreementImage[slideAgreementIndex].classList.add("document-approval");
            slideAgreementIndex = slideAgreementIndex - 1;
            slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval");
            agreementImage[slideAgreementIndex].classList.add("document-approval-active");
        } else {
            slideAgreementImage[slideAgreementIndex].classList.add("hidden");
            agreementImage[0].classList.remove("document-approval-active");
            agreementImage[0].classList.add("document-approval");
            slideAgreementIndex = documentAgreement.files.length - 1;
            slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval");
            agreementImage[slideAgreementIndex].classList.add("document-approval-active");
        }
})

nextAgreementButton.addEventListener('click', function () {
    if (slideAgreementIndex != documentAgreement.files.length - 1) {
            slideAgreementImage[slideAgreementIndex].classList.add("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval-active");
            agreementImage[slideAgreementIndex].classList.add("document-approval");
            slideAgreementIndex = slideAgreementIndex + 1;
            slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval");
            agreementImage[slideAgreementIndex].classList.add("document-approval-active");
        } else {
            slideAgreementImage[slideAgreementIndex].classList.add("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval-active");
            agreementImage[slideAgreementIndex].classList.add("document-approval");
            slideAgreementIndex = 0;
            slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
            agreementImage[slideAgreementIndex].classList.remove("document-approval");
            agreementImage[slideAgreementIndex].classList.add("document-approval-active");
        }
})

function myAgreementSlide(img) {
    slideAgreementImage[slideAgreementIndex].classList.add("hidden");
    agreementImage[slideAgreementIndex].classList.remove("document-approval-active");
    agreementImage[slideAgreementIndex].classList.add("document-approval");
    slideAgreementIndex = Number(img.id);
    slideAgreementImage[slideAgreementIndex].classList.remove("hidden");
    agreementImage[slideAgreementIndex].classList.remove("document-approval");
    agreementImage[slideAgreementIndex].classList.add("document-approval-active");
}

btnAgreementUpload.addEventListener('click', function () {
    if (documentAgreement.files.length == 0) {
        alert("Dokumen perjanjian dipilih")
    } else if (agreementNumber.value == "") {
        alert("Nomor perjanjian belum di input")
    } else if (agreementDate.value == "") {
        alert("Tanggal perjanjian belum diinput")
    } else {
        btnAgreementSave.click();
    }
})

btnAgreementClear.addEventListener('click', function () {
    prevAgreementButton.setAttribute('hidden', 'hidden');
    nextAgreementButton.setAttribute('hidden', 'hidden');
    documentAgreement.value = null;
    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }
    numberAgreementFile.innerHTML = "No Files Chosen";
    agreementDate.value = null;
    agreementNumber.value = null;
})

btnCloseAgreement.addEventListener('click', function () {
    modalAgreement.classList.add("hidden");
    modalAgreement.classList.remove("flex");
    documentAgreement.value = null;
    prevAgreementButton.setAttribute('hidden', 'hidden');
    nextAgreementButton.setAttribute('hidden', 'hidden');
    while (agreementImg.hasChildNodes()) {
        agreementImg.removeChild(agreementImg.firstChild);
    }

    while (slidesAgreementPreview.hasChildNodes()) {
        slidesAgreementPreview.removeChild(slidesAgreementPreview.firstChild);
    }

    numberAgreementFile.innerHTML = "No Files Chosen";
    agreementDate.value = null;
    agreementNumber.value = null;
})

// Preview Agreement Document --> end