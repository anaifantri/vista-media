// Preview Approval Document --> start
// import { getApprovalData } from "./printinstalapprovalsdata";
const documentApproval = document.querySelector('#documentApproval');
const slidesApprovalPreview = document.getElementById("slidesApprovalPreview");
const prevApprovalButton = document.getElementById("prevApprovalButton");
const nextApprovalButton = document.getElementById("nextApprovalButton");
const approvalImg = document.getElementById("approvalImg");
const btnCloseApproval = document.getElementById("btnCloseApproval");

let objApproval = {};
let approvalData = [];
let approvalUrl = [];
let approvalImage = [];
let slideApprovalPreview = [];
let slideApprovalImage = [];
let slideApprovalIndex = 0;

//Get Document Approval --> start
getApprovalData();

function getApprovalData() {
    const xhrDocumentApproval = new XMLHttpRequest();
    const methodDocumentApproval = "GET";
    const urlDocumentApproval = "/printInstallApproval";

    xhrDocumentApproval.open(methodDocumentApproval, urlDocumentApproval, true);
    xhrDocumentApproval.send();

    xhrDocumentApproval.onreadystatechange = () => {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (xhrDocumentApproval.readyState === XMLHttpRequest.DONE) {
            const status = xhrDocumentApproval.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                objApproval = JSON.parse(xhrDocumentApproval.responseText);
                approvalData = objApproval.dataApproval;
            } else {
                // Oh no! There has been an error with the request!
            }
        }
    }
}
//Get Document Approval --> end

function previewAppovalImage(quotID) {
    modalApproval.classList.remove("hidden");
    modalApproval.classList.add("flex");
    window.scrollTo(0, 0);
    slideApprovalIndex = 0;

    while (approvalImg.hasChildNodes()) {
        approvalImg.removeChild(approvalImg.firstChild);
    }

    while (slidesApprovalPreview.hasChildNodes()) {
        slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
    }

    var a = 0;
    approvalUrl = [];
    for (i = 0; i < approvalData.length; i++) {
        if (approvalData[i].print_instal_quotation_id == quotID) {
            approvalUrl[a] = approvalData[i].approval_image;
            a = a + 1;
        }
    }

    if (approvalUrl.length != 0) {
        for (n = 0; n < approvalUrl.length; n++) {
            approvalImage[n] = document.createElement("img")
            if (n == 0) {
                approvalImage[n].classList.add("document-approval-active");
            } else {
                approvalImage[n].classList.add("document-approval");
            }

            approvalImage[n].src = '/storage/' + approvalUrl[n];
            approvalImage[n].setAttribute('id', n);
            approvalImage[n].setAttribute('onclick', 'myApprovalSlide(this)');
            approvalImg.appendChild(approvalImage[n]);

            slideApprovalPreview[n] = document.createElement("figure");
            slideApprovalPreview[n].classList.add("mySlides");
            slideApprovalPreview[n].classList.add("fade");
            slideApprovalImage[n] = document.createElement("img");
            if (n != 0) {
                slideApprovalImage[n].classList.add("hidden");
            }
            slideApprovalImage[n].classList.add("w-full");
            slideApprovalImage[n].classList.add("mt-2");
            slideApprovalImage[n].src = '/storage/' + approvalUrl[n];
            slideApprovalPreview[n].appendChild(slideApprovalImage[n]);
            slidesApprovalPreview.appendChild(slideApprovalPreview[n]);
        }

        prevApprovalButton.removeAttribute('hidden');
        nextApprovalButton.removeAttribute('hidden');
    }
}

prevApprovalButton.addEventListener('click', function() {
    if (slideApprovalIndex != 0) {
        slideApprovalImage[slideApprovalIndex].classList.add("hidden");
        approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
        approvalImage[slideApprovalIndex].classList.add("document-approval");
        slideApprovalIndex = slideApprovalIndex - 1;
        slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
        approvalImage[slideApprovalIndex].classList.remove("document-approval");
        approvalImage[slideApprovalIndex].classList.add("document-approval-active");
    } else {
        slideApprovalImage[slideApprovalIndex].classList.add("hidden");
        approvalImage[0].classList.remove("document-approval-active");
        approvalImage[0].classList.add("document-approval");
        slideApprovalIndex = approvalUrl.length - 1;
        slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
        approvalImage[slideApprovalIndex].classList.remove("document-approval");
        approvalImage[slideApprovalIndex].classList.add("document-approval-active");
    }
})

nextApprovalButton.addEventListener('click', function() {
    if (slideApprovalIndex != approvalUrl.length - 1) {
        slideApprovalImage[slideApprovalIndex].classList.add("hidden");
        approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
        approvalImage[slideApprovalIndex].classList.add("document-approval");
        slideApprovalIndex = slideApprovalIndex + 1;
        slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
        approvalImage[slideApprovalIndex].classList.remove("document-approval");
        approvalImage[slideApprovalIndex].classList.add("document-approval-active");
    } else {
        slideApprovalImage[slideApprovalIndex].classList.add("hidden");
        approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
        approvalImage[slideApprovalIndex].classList.add("document-approval");
        slideApprovalIndex = 0;
        slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
        approvalImage[slideApprovalIndex].classList.remove("document-approval");
        approvalImage[slideApprovalIndex].classList.add("document-approval-active");
    }
})

function myApprovalSlide(img) {
    slideApprovalImage[slideApprovalIndex].classList.add("hidden");
    approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
    approvalImage[slideApprovalIndex].classList.add("document-approval");
    slideApprovalIndex = Number(img.id);
    slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
    approvalImage[slideApprovalIndex].classList.remove("document-approval");
    approvalImage[slideApprovalIndex].classList.add("document-approval-active");
}

btnCloseApproval.addEventListener('click', function() {
    modalApproval.classList.add("hidden");
    modalApproval.classList.remove("flex");
})

// Preview Approval Document --> end