//Preview PO/SPK document --> start
const modalViewPO = document.getElementById("modalViewPO");
const btnViewPOClose = document.getElementById("btnViewPOClose");
const labelDocumentName = document.getElementById("labelDocumentName");
const labelOrderNumber = document.getElementById("labelOrderNumber");
const labelOrderDate = document.getElementById("labelOrderDate");
const numberViewPOFile = document.getElementById("numberViewPOFile");
const slidesViewPO = document.getElementById("slidesViewPO");
const prevViewPOButton = document.getElementById("prevViewPOButton");
const nextViewPOButton = document.getElementById("nextViewPOButton");
const poViewImg = document.getElementById("poViewImg");

let objPO = {};
let orderData = [];
let poUrl = [];
let poViewImage = [];
let slideViewPO = [];
let slideViewPOImage = [];
let slideViewPOIndex = 0;

const date = new Date();
const year = date.getFullYear();
let month = "";
let options = [{ day: 'numeric' }, { month: 'short' }, { year: 'numeric' }];
let saleDate = getFormatDate(new Date, options, '-');

//Format date --> start
function getFormatDate(date, options, separator) {
    function format(option) {
        let formatter = new Intl.DateTimeFormat('en', option);
        return formatter.format(date);
    }
    return options.map(format).join(separator);
}
//Format date --> end

//Get Document PO --> start
getPOData();

function getPOData() {
    const xhrDocumentPO = new XMLHttpRequest();
    const methodDocumentPO = "GET";
    const urlDocumentPO = "/printInstallOrder";

    xhrDocumentPO.open(methodDocumentPO, urlDocumentPO, true);
    xhrDocumentPO.send();

    xhrDocumentPO.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrDocumentPO.readyState === XMLHttpRequest.DONE) {
            const status = xhrDocumentPO.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objPO = JSON.parse(xhrDocumentPO.responseText);
                orderData = objPO.dataOrder;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
//Get Document PO --> end

function previewOrderImage(quotID) {
    modalViewPO.classList.remove("hidden");
    modalViewPO.classList.add("flex");
    window.scrollTo(0, 0);
    slideViewPOIndex = 0;

    while (poViewImg.hasChildNodes()) {
        poViewImg.removeChild(poViewImg.firstChild);
    }

    while (slidesViewPO.hasChildNodes()) {
        slidesViewPO.removeChild(slidesViewPO.firstChild);
    }

    var a = 0;
    poUrl = [];
    for (i = 0; i < orderData.length; i++) {
        if (orderData[i].print_instal_quotation_id == quotID) {
            labelDocumentName.innerHTML = "";
            labelDocumentName.innerHTML = orderData[i].name;
            labelOrderNumber.innerHTML = "";
            labelOrderNumber.innerHTML = "";
            labelOrderNumber.innerHTML = orderData[i].number;
            labelOrderDate.innerHTML = getFormatDate(new Date(orderData[i].created_at), options, '-');
            numberViewPOFile.innerHTML = "";
            numberViewPOFile.innerHTML = orderData.length + " Dokumen";
            poUrl[a] = orderData[i].order_image;
            a = a + 1;
        }
    }

    if (poUrl.length != 0) {
        for (n = 0; n < poUrl.length; n++) {
            poViewImage[n] = document.createElement("img")
            if (n == 0) {
                poViewImage[n].classList.add("document-approval-active");
            } else {
                poViewImage[n].classList.add("document-approval");
            }

            poViewImage[n].src = '/storage/' + poUrl[n];
            poViewImage[n].setAttribute('id', n);
            poViewImage[n].setAttribute('onclick', 'myPOSlide(this)');
            poViewImg.appendChild(poViewImage[n]);

            slideViewPO[n] = document.createElement("figure");
            slideViewPO[n].classList.add("mySlides");
            slideViewPO[n].classList.add("fade");
            slideViewPOImage[n] = document.createElement("img");
            if (n != 0) {
                slideViewPOImage[n].classList.add("hidden");
            }
            slideViewPOImage[n].classList.add("w-full");
            slideViewPOImage[n].classList.add("mt-2");
            slideViewPOImage[n].src = '/storage/' + poUrl[n];
            slideViewPO[n].appendChild(slideViewPOImage[n]);
            slidesViewPO.appendChild(slideViewPO[n]);
        }

        prevViewPOButton.removeAttribute('hidden');
        nextViewPOButton.removeAttribute('hidden');
    }
}

prevViewPOButton.addEventListener('click', function() {
    if (slideViewPOIndex != 0) {
        slideViewPOImage[slideViewPOIndex].classList.add("hidden");
        poViewImage[slideViewPOIndex].classList.remove("document-approval-active");
        poViewImage[slideViewPOIndex].classList.add("document-approval");
        slideViewPOIndex = slideViewPOIndex - 1;
        slideViewPOImage[slideViewPOIndex].classList.remove("hidden");
        poViewImage[slideViewPOIndex].classList.remove("document-approval");
        poViewImage[slideViewPOIndex].classList.add("document-approval-active");
    } else {
        slideViewPOImage[slideViewPOIndex].classList.add("hidden");
        poViewImage[0].classList.remove("document-approval-active");
        poViewImage[0].classList.add("document-approval");
        slideViewPOIndex = poUrl.length - 1;
        slideViewPOImage[slideViewPOIndex].classList.remove("hidden");
        poViewImage[slideViewPOIndex].classList.remove("document-approval");
        poViewImage[slideViewPOIndex].classList.add("document-approval-active");
    }
})

nextViewPOButton.addEventListener('click', function() {
    if (slideViewPOIndex != poUrl.length - 1) {
        slideViewPOImage[slideViewPOIndex].classList.add("hidden");
        poViewImage[slideViewPOIndex].classList.remove("document-approval-active");
        poViewImage[slideViewPOIndex].classList.add("document-approval");
        slideViewPOIndex = slideViewPOIndex + 1;
        slideViewPOImage[slideViewPOIndex].classList.remove("hidden");
        poViewImage[slideViewPOIndex].classList.remove("document-approval");
        poViewImage[slideViewPOIndex].classList.add("document-approval-active");
    } else {
        slideViewPOImage[slideViewPOIndex].classList.add("hidden");
        poViewImage[slideViewPOIndex].classList.remove("document-approval-active");
        poViewImage[slideViewPOIndex].classList.add("document-approval");
        slideViewPOIndex = 0;
        slideViewPOImage[slideViewPOIndex].classList.remove("hidden");
        poViewImage[slideViewPOIndex].classList.remove("document-approval");
        poViewImage[slideViewPOIndex].classList.add("document-approval-active");
    }
})

function myPOSlide(img) {
    slideViewPOImage[slideViewPOIndex].classList.add("hidden");
    poViewImage[slideViewPOIndex].classList.remove("document-approval-active");
    poViewImage[slideViewPOIndex].classList.add("document-approval");
    slideViewPOIndex = Number(img.id);
    slideViewPOImage[slideViewPOIndex].classList.remove("hidden");
    poViewImage[slideViewPOIndex].classList.remove("document-approval");
    poViewImage[slideViewPOIndex].classList.add("document-approval-active");
}

btnViewPOClose.addEventListener('click', () => {
    modalViewPO.classList.add("hidden");
    modalViewPO.classList.remove("flex");
})
//Preview PO/SPK document --> end
