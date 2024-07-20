const btnViewClosePO = document.getElementById("btnViewClosePO");
const documentName = document.getElementById("documentName");
const orderViewNumber = document.getElementById("orderViewNumber");
const orderViewDate = document.getElementById("orderViewDate");
const documentViewPO = document.getElementById("documentViewPO");
const slidesViewPO = document.getElementById("slidesViewPO");
const numberViewPOFile = document.getElementById("numberViewPOFile");
const prevViewPOButton = document.getElementById("prevViewPOButton");
const nextViewPOButton = document.getElementById("nextViewPOButton");
const poViewImg = document.getElementById("poViewImg");

let objOrder = {};
let orderData = [];
let orderViewUrl = [];
let poImageView = [];
let slideViewPO = [];
let slidePOViewImage = [];
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

//Get Document Order --> start
getOrderData();

function getOrderData() {
    const xhrDocumentOrder = new XMLHttpRequest();
    const methodDocumentOrder = "GET";
    const urlDocumentOrder = "/showClientOrder";

    xhrDocumentOrder.open(methodDocumentOrder, urlDocumentOrder, true);
    xhrDocumentOrder.send();

    xhrDocumentOrder.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrDocumentOrder.readyState === XMLHttpRequest.DONE) {
            const status = xhrDocumentOrder.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objOrder = JSON.parse(xhrDocumentOrder.responseText);
                orderData = objOrder.dataClientOrder;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
//Get Document Order --> end

// Preview PO/SPK Document --> start
function previewPOImage(quotID, quot) {
    modalViewPO.classList.remove("hidden");
    modalViewPO.classList.add("flex");
    window.scrollTo(0, 0);

    while (poViewImg.hasChildNodes()) {
        poViewImg.removeChild(poViewImg.firstChild);
    }

    while (slidesViewPO.hasChildNodes()) {
        slidesViewPO.removeChild(slidesViewPO.firstChild);
    }

    var a = 0;
    orderViewUrl = [];

    if (quot == "Main") {
        poBillboardQuotationId.value = "";
        poBillboardQuotationId.value = quotID;
        for (i = 0; i < orderData.length; i++) {
            if (orderData[i].billboard_quotation_id == quotID) {
                orderViewUrl[a] = orderData[i].order_image;
                documentName.innerHTML = "";
                documentName.innerHTML = orderData[i].name;
                orderViewNumber.innerHTML = "";
                orderViewNumber.innerHTML = orderData[i].number;
                orderViewDate.innerHTML = "";
                orderViewDate.innerHTML = getFormatDate(new Date(orderData[i].order_date), options, '-');
                a = a + 1;
            }
        }
    } else if (quot == "Revision") {
        poBillboardQuotRevisionId.value = "";
        poBillboardQuotRevisionId.value = quotID;
        for (i = 0; i < orderData.length; i++) {
            if (orderData[i].billboard_quot_revision_id == quotID) {
                orderViewUrl[a] = orderData[i].order_image;
                documentName.innerHTML = "";
                documentName.innerHTML = orderData[i].name;
                orderViewNumber.innerHTML = "";
                orderViewNumber.innerHTML = orderData[i].number;
                orderViewDate.innerHTML = "";
                orderViewDate.innerHTML = getFormatDate(new Date(orderData[i].order_date), options, '-');
                a = a + 1;
            }
        }
    }

    if (orderViewUrl.length != 0) {
        btnViewClosePO.classList.remove("hidden");
        btnViewClosePO.classList.add("flex");
        numberViewPOFile.innerHTML = "";
        numberViewPOFile.innerHTML = orderViewUrl.length + " images";
        for (n = 0; n < orderViewUrl.length; n++) {
            // const file = documentViewPO.files[n];
            // const objectUrl = URL.createObjectURL(file);

            poImageView[n] = document.createElement("img")
            if (n == 0) {
                poImageView[n].classList.add("document-approval-active");
            } else {
                poImageView[n].classList.add("document-approval");
            }

            poImageView[n].src = '/storage/' + orderViewUrl[n];
            poImageView[n].setAttribute('id', n);
            poImageView[n].setAttribute('onclick', 'myViewPOSlide(this)');
            poViewImg.appendChild(poImageView[n]);

            slideViewPO[n] = document.createElement("figure");
            slideViewPO[n].classList.add("mySlides");
            slideViewPO[n].classList.add("fade");
            slidePOViewImage[n] = document.createElement("img");
            if (n != 0) {
                slidePOViewImage[n].classList.add("hidden");
            }
            slidePOViewImage[n].classList.add("w-full");
            slidePOViewImage[n].classList.add("mt-2");
            slidePOViewImage[n].src = '/storage/' + orderViewUrl[n];
            slideViewPO[n].appendChild(slidePOViewImage[n]);
            slidesViewPO.appendChild(slideViewPO[n]);
        }

        prevViewPOButton.removeAttribute('hidden');
        nextViewPOButton.removeAttribute('hidden');
    } else {
        orderPO.setAttribute('checked', 'checked');
        orderPO.removeAttribute('readonly');
        orderSPK.removeAttribute('checked');
        orderSPK.removeAttribute('readonly');
        btnChosePO.classList.remove("hidden");
        btnChosePO.classList.add("flex");
        btnViewClosePO.classList.add("hidden");
        btnViewClosePO.classList.remove("flex");
        orderViewNumber.value = "";
        orderViewNumber.removeAttribute('readonly');
        orderViewDate.value = "";
        orderViewDate.removeAttribute('readonly');
        numberViewPOFile.innerHTML = "No Files Chosen";
    }
}

prevViewPOButton.addEventListener('click', function () {
    if (orderViewUrl != 0) {
        if (slideViewPOIndex != 0) {
            slidePOViewImage[slideViewPOIndex].classList.add("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval-active");
            poImageView[slideViewPOIndex].classList.add("document-approval");
            slideViewPOIndex = slideViewPOIndex - 1;
            slidePOViewImage[slideViewPOIndex].classList.remove("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval");
            poImageView[slideViewPOIndex].classList.add("document-approval-active");
        } else {
            slidePOViewImage[slideViewPOIndex].classList.add("hidden");
            poImageView[0].classList.remove("document-approval-active");
            poImageView[0].classList.add("document-approval");
            slideViewPOIndex = orderViewUrl.length - 1;
            slidePOViewImage[slideViewPOIndex].classList.remove("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval");
            poImageView[slideViewPOIndex].classList.add("document-approval-active");
        }
    } else {
        if (slideViewPOIndex != 0) {
            slidePOViewImage[slideViewPOIndex].classList.add("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval-active");
            poImageView[slideViewPOIndex].classList.add("document-approval");
            slideViewPOIndex = slideViewPOIndex - 1;
            slidePOViewImage[slideViewPOIndex].classList.remove("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval");
            poImageView[slideViewPOIndex].classList.add("document-approval-active");
        } else {
            slidePOViewImage[slideViewPOIndex].classList.add("hidden");
            poImageView[0].classList.remove("document-approval-active");
            poImageView[0].classList.add("document-approval");
            slideViewPOIndex = documentViewPO.files.length - 1;
            slidePOViewImage[slideViewPOIndex].classList.remove("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval");
            poImageView[slideViewPOIndex].classList.add("document-approval-active");
        }
    }
})

nextViewPOButton.addEventListener('click', function () {
    if (orderViewUrl != 0) {
        if (slideViewPOIndex != orderViewUrl.length - 1) {
            slidePOViewImage[slideViewPOIndex].classList.add("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval-active");
            poImageView[slideViewPOIndex].classList.add("document-approval");
            slideViewPOIndex = slideViewPOIndex + 1;
            slidePOViewImage[slideViewPOIndex].classList.remove("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval");
            poImageView[slideViewPOIndex].classList.add("document-approval-active");
        } else {
            slidePOViewImage[slideViewPOIndex].classList.add("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval-active");
            poImageView[slideViewPOIndex].classList.add("document-approval");
            slideViewPOIndex = 0;
            slidePOViewImage[slideViewPOIndex].classList.remove("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval");
            poImageView[slideViewPOIndex].classList.add("document-approval-active");
        }
    } else {
        if (slideViewPOIndex != documentViewPO.files.length - 1) {
            slidePOViewImage[slideViewPOIndex].classList.add("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval-active");
            poImageView[slideViewPOIndex].classList.add("document-approval");
            slideViewPOIndex = slideViewPOIndex + 1;
            slidePOViewImage[slideViewPOIndex].classList.remove("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval");
            poImageView[slideViewPOIndex].classList.add("document-approval-active");
        } else {
            slidePOViewImage[slideViewPOIndex].classList.add("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval-active");
            poImageView[slideViewPOIndex].classList.add("document-approval");
            slideViewPOIndex = 0;
            slidePOViewImage[slideViewPOIndex].classList.remove("hidden");
            poImageView[slideViewPOIndex].classList.remove("document-approval");
            poImageView[slideViewPOIndex].classList.add("document-approval-active");
        }
    }
})

function myViewPOSlide(img) {
    slidePOViewImage[slideViewPOIndex].classList.add("hidden");
    poImageView[slideViewPOIndex].classList.remove("document-approval-active");
    poImageView[slideViewPOIndex].classList.add("document-approval");
    slideViewPOIndex = Number(img.id);
    slidePOViewImage[slideViewPOIndex].classList.remove("hidden");
    poImageView[slideViewPOIndex].classList.remove("document-approval");
    poImageView[slideViewPOIndex].classList.add("document-approval-active");
}

btnViewClosePO.addEventListener('click', function () {
    modalViewPO.classList.add("hidden");
    modalViewPO.classList.remove("flex");
    while (poViewImg.hasChildNodes()) {
        poViewImg.removeChild(poViewImg.firstChild);
    }

    while (slidesViewPO.hasChildNodes()) {
        slidesViewPO.removeChild(slidesViewPO.firstChild);
    }
})

// Preview PO/SPK Document --> end