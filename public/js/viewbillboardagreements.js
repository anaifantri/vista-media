const btnViewCloseAgreement = document.getElementById("btnViewCloseAgreement");
const agreementViewNumber = document.getElementById("agreementViewNumber");
const agreementViewDate = document.getElementById("agreementViewDate");
const documentViewAgreement = document.getElementById("documentViewAgreement");
const slidesViewAgreement = document.getElementById("slidesViewAgreement");
const numberViewAgreementFile = document.getElementById("numberViewAgreementFile");
const prevViewAgreementButton = document.getElementById("prevViewAgreementButton");
const nextViewAgreementButton = document.getElementById("nextViewAgreementButton");
const agreementViewImg = document.getElementById("agreementViewImg");

let objAgreement = {};
let agreementData = [];
let agreementViewUrl = [];
let agreementImageView = [];
let slideViewAgreement = [];
let slideAgreementViewImage = [];
let slideViewAgreementIndex = 0;

//Get Document Agreement --> start
getAgreementData();

function getAgreementData() {
    const xhrDocumentAgreement = new XMLHttpRequest();
    const methodDocumentAgreement = "GET";
    const urlDocumentAgreement = "/showClientAgreement";

    xhrDocumentAgreement.open(methodDocumentAgreement, urlDocumentAgreement, true);
    xhrDocumentAgreement.send();

    xhrDocumentAgreement.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrDocumentAgreement.readyState === XMLHttpRequest.DONE) {
            const status = xhrDocumentAgreement.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objAgreement = JSON.parse(xhrDocumentAgreement.responseText);
                agreementData = objAgreement.dataClientAgreement;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
//Get Document Agreement --> end

// Preview Agreement Document --> start
function previewAgreementImage(quotID, quot) {
    modalViewAgreement.classList.remove("hidden");
    modalViewAgreement.classList.add("flex");
    window.scrollTo(0, 0);

    while (agreementViewImg.hasChildNodes()) {
        agreementViewImg.removeChild(agreementViewImg.firstChild);
    }

    while (slidesViewAgreement.hasChildNodes()) {
        slidesViewAgreement.removeChild(slidesViewAgreement.firstChild);
    }

    var a = 0;
    agreementViewUrl = [];

    if (quot == "Main") {
        agreementBillboardQuotationId.value = "";
        agreementBillboardQuotationId.value = quotID;
        for (i = 0; i < agreementData.length; i++) {
            if (agreementData[i].billboard_quotation_id == quotID) {
                agreementViewUrl[a] = agreementData[i].agreement_image;
                agreementViewNumber.innerHTML = "";
                agreementViewNumber.innerHTML = agreementData[i].number;
                agreementViewDate.innerHTML = "";
                agreementViewDate.innerHTML = getFormatDate(new Date(agreementData[i].date), options, '-');
                a = a + 1;
            }
        }
    } else if (quot == "Revision") {
        agreementBillboardQuotRevisionId.value = "";
        agreementBillboardQuotRevisionId.value = quotID;
        for (i = 0; i < agreementData.length; i++) {
            if (agreementData[i].billboard_quot_revision_id == quotID) {
                agreementViewUrl[a] = agreementData[i].agreement_image;
                agreementViewNumber.innerHTML = "";
                agreementViewNumber.innerHTML = agreementData[i].number;
                agreementViewDate.innerHTML = "";
                agreementViewDate.innerHTML = getFormatDate(new Date(agreementData[i].date), options, '-');
                a = a + 1;
            }
        }
    }

    if (agreementViewUrl.length != 0) {
        btnViewCloseAgreement.classList.remove("hidden");
        btnViewCloseAgreement.classList.add("flex");
        numberViewAgreementFile.innerHTML = "";
        numberViewAgreementFile.innerHTML = agreementViewUrl.length + " images";
        for (n = 0; n < agreementViewUrl.length; n++) {
            // const file = documentViewAgreement.files[n];
            // const objectUrl = URL.createObjectURL(file);

            agreementImageView[n] = document.createElement("img")
            if (n == 0) {
                agreementImageView[n].classList.add("document-approval-active");
            } else {
                agreementImageView[n].classList.add("document-approval");
            }

            agreementImageView[n].src = '/storage/' + agreementViewUrl[n];
            agreementImageView[n].setAttribute('id', n);
            agreementImageView[n].setAttribute('onclick', 'myViewAgreementSlide(this)');
            agreementViewImg.appendChild(agreementImageView[n]);

            slideViewAgreement[n] = document.createElement("figure");
            slideViewAgreement[n].classList.add("mySlides");
            slideViewAgreement[n].classList.add("fade");
            slideAgreementViewImage[n] = document.createElement("img");
            if (n != 0) {
                slideAgreementViewImage[n].classList.add("hidden");
            }
            slideAgreementViewImage[n].classList.add("w-full");
            slideAgreementViewImage[n].classList.add("mt-2");
            slideAgreementViewImage[n].src = '/storage/' + agreementViewUrl[n];
            slideViewAgreement[n].appendChild(slideAgreementViewImage[n]);
            slidesViewAgreement.appendChild(slideViewAgreement[n]);
        }

        prevViewAgreementButton.removeAttribute('hidden');
        nextViewAgreementButton.removeAttribute('hidden');
    } else {
        btnChoseAgreement.classList.remove("hidden");
        btnChoseAgreement.classList.add("flex");
        btnViewCloseAgreement.classList.add("hidden");
        btnViewCloseAgreement.classList.remove("flex");
        agreementViewNumber.value = "";
        agreementViewNumber.removeAttribute('readonly');
        agreementViewDate.value = "";
        agreementViewDate.removeAttribute('readonly');
        numberViewAgreementFile.innerHTML = "No Files Chosen";
    }
}

prevViewAgreementButton.addEventListener('click', function () {
    if (agreementViewUrl != 0) {
        if (slideViewAgreementIndex != 0) {
            slideAgreementViewImage[slideViewAgreementIndex].classList.add("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval-active");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval");
            slideViewAgreementIndex = slideViewAgreementIndex - 1;
            slideAgreementViewImage[slideViewAgreementIndex].classList.remove("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval-active");
        } else {
            slideAgreementViewImage[slideViewAgreementIndex].classList.add("hidden");
            agreementImageView[0].classList.remove("document-approval-active");
            agreementImageView[0].classList.add("document-approval");
            slideViewAgreementIndex = agreementViewUrl.length - 1;
            slideAgreementViewImage[slideViewAgreementIndex].classList.remove("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval-active");
        }
    } else {
        if (slideViewAgreementIndex != 0) {
            slideAgreementViewImage[slideViewAgreementIndex].classList.add("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval-active");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval");
            slideViewAgreementIndex = slideViewAgreementIndex - 1;
            slideAgreementViewImage[slideViewAgreementIndex].classList.remove("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval-active");
        } else {
            slideAgreementViewImage[slideViewAgreementIndex].classList.add("hidden");
            agreementImageView[0].classList.remove("document-approval-active");
            agreementImageView[0].classList.add("document-approval");
            slideViewAgreementIndex = documentViewAgreement.files.length - 1;
            slideAgreementViewImage[slideViewAgreementIndex].classList.remove("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval-active");
        }
    }
})

nextViewAgreementButton.addEventListener('click', function () {
    if (agreementViewUrl != 0) {
        if (slideViewAgreementIndex != agreementViewUrl.length - 1) {
            slideAgreementViewImage[slideViewAgreementIndex].classList.add("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval-active");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval");
            slideViewAgreementIndex = slideViewAgreementIndex + 1;
            slideAgreementViewImage[slideViewAgreementIndex].classList.remove("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval-active");
        } else {
            slideAgreementViewImage[slideViewAgreementIndex].classList.add("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval-active");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval");
            slideViewAgreementIndex = 0;
            slideAgreementViewImage[slideViewAgreementIndex].classList.remove("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval-active");
        }
    } else {
        if (slideViewAgreementIndex != documentViewAgreement.files.length - 1) {
            slideAgreementViewImage[slideViewAgreementIndex].classList.add("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval-active");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval");
            slideViewAgreementIndex = slideViewAgreementIndex + 1;
            slideAgreementViewImage[slideViewAgreementIndex].classList.remove("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval-active");
        } else {
            slideAgreementViewImage[slideViewAgreementIndex].classList.add("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval-active");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval");
            slideViewAgreementIndex = 0;
            slideAgreementViewImage[slideViewAgreementIndex].classList.remove("hidden");
            agreementImageView[slideViewAgreementIndex].classList.remove("document-approval");
            agreementImageView[slideViewAgreementIndex].classList.add("document-approval-active");
        }
    }
})

function myViewAgreementSlide(img) {
    slideAgreementViewImage[slideViewAgreementIndex].classList.add("hidden");
    agreementImageView[slideViewAgreementIndex].classList.remove("document-approval-active");
    agreementImageView[slideViewAgreementIndex].classList.add("document-approval");
    slideViewAgreementIndex = Number(img.id);
    slideAgreementViewImage[slideViewAgreementIndex].classList.remove("hidden");
    agreementImageView[slideViewAgreementIndex].classList.remove("document-approval");
    agreementImageView[slideViewAgreementIndex].classList.add("document-approval-active");
}

btnViewCloseAgreement.addEventListener('click', function () {
    modalViewAgreement.classList.add("hidden");
    modalViewAgreement.classList.remove("flex");
    while (agreementViewImg.hasChildNodes()) {
        agreementViewImg.removeChild(agreementViewImg.firstChild);
    }

    while (slidesViewAgreement.hasChildNodes()) {
        slidesViewAgreement.removeChild(slidesViewAgreement.firstChild);
    }
})

// Preview Agreement Document --> end