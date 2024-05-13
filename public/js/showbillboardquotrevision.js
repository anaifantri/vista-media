// Declaration --> start
const selectStatus = document.getElementById("status");
const cbUpdateValue = document.getElementById("cbUpdateValue");
const divStatus = document.getElementById("divStatus");
const divDescription = document.getElementById("divDescription");
const cbUpdateProgress = document.getElementById("cbUpdateProgress");
const btnSaveProgress = document.getElementById("btnSaveProgress");
const divApproval = document.getElementById("divApproval");
const modalApproval = document.getElementById("modalApproval");
const btnApprovalCancel = document.getElementById("btnApprovalCancel");
const btnApprovalSubmit = document.getElementById("btnApprovalSubmit");
const documentApproval = document.querySelector('#documentApproval');

const slidesApprovalPreview = document.getElementById("slidesApprovalPreview");
const numberApprovalFile = document.getElementById("numberApprovalFile");
const labelDocumentApproval = document.getElementById("labelDocumentApproval");
const prevApprovalButton = document.getElementById("prevApprovalButton");
const nextApprovalButton = document.getElementById("nextApprovalButton");
const approvalImg = document.getElementById("approvalImg");

let approvalImage = [];
let slideApprovalPreview = [];
let slideApprovalImage = [];
let slideApprovalIndex = 0;

// Declaration --> start

// Checkbox Update Progress Action --> start
if (cbUpdateValue.value == "True") {
    divStatus.removeAttribute('hidden');
    divDescription.removeAttribute('hidden');
    btnSaveProgress.classList.add('flex');
    btnSaveProgress.classList.remove('hidden');
    cbUpdateProgress.setAttribute('checked', 'checked');
    divApproval.removeAttribute('hidden');
} else {
    divStatus.setAttribute('hidden', 'hidden');
    divDescription.setAttribute('hidden', 'hidden');
    btnSaveProgress.classList.add('hidden');
    btnSaveProgress.classList.remove('flex');
    divApproval.setAttribute('hidden', 'hidden');
    cbUpdateProgress.removeAttribute('checked');
}

cbUpdateProgress.addEventListener('click', function () {
    if (cbUpdateProgress.checked == true) {
        cbUpdateValue.value = "True";
        divStatus.removeAttribute('hidden');
        divDescription.removeAttribute('hidden');
        btnSaveProgress.classList.add('flex');
        btnSaveProgress.classList.remove('hidden');
    } else {
        divStatus.setAttribute('hidden', 'hidden');
        divDescription.setAttribute('hidden', 'hidden');
        btnSaveProgress.classList.add('hidden');
        btnSaveProgress.classList.remove('flex');
        cbUpdateValue.value = "False";
    }
})

// Checkbox Update Progress Action --> start

// Create PDF --> start
// document.getElementById("btnCreatePdf").onclick = function () {
//     const saveName = document.getElementById("fileName");
//     var element = document.getElementById('pdfPreview');
//     var opt = {
//         margin: 0,
//         filename: saveName.value,
//         image: {
//             type: 'jpeg',
//             quality: 1
//         },
//         pagebreak: {
//             mode: ['avoid-all', 'css', 'legacy']
//         },
//         html2canvas: {
//             dpi: 192,
//             scale: 4,
//             letterRendering: true,
//             useCORS: true
//         },
//         jsPDF: {
//             unit: 'in',
//             format: 'a4',
//             orientation: 'portrait',
//             putTotalPages: true
//         }
//     };
//     html2pdf().set(opt).from(element).save();
// };
// Create PDF --> end

// Function Button Approval Event --> start
function btnApprovalEvent() {
    modalApproval.classList.remove("hidden");
    modalApproval.classList.add("flex");
    window.scrollTo(0, 0);
}

btnApprovalCancel.addEventListener('click', function () {
    modalApproval.classList.add("hidden");
    modalApproval.classList.remove("flex");
    documentApproval.value = null;
    labelDocumentApproval.innerHTML = "0 images selected";
    numberApprovalFile.innerHTML = "No Files Chosen";
    approvalImage = [];
    slideApprovalPreview = [];
    slideApprovalImage = [];
    slideApprovalIndex = 0;
    while (approvalImg.hasChildNodes()) {
        approvalImg.removeChild(approvalImg.firstChild);
    }
    while (slidesApprovalPreview.hasChildNodes()) {
        slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
    }
})

btnApprovalSubmit.addEventListener('click', function () {
    if (documentApproval.files.length == 0) {
        alert("Document approval belum dipilih")
    } else {
        modalApproval.classList.add("hidden");
        modalApproval.classList.remove("flex");
        labelDocumentApproval.innerHTML = "";
        labelDocumentApproval.innerHTML = documentApproval.files.length + " images selected";
    }
})
// Function Button Approval Event --> end

// Preview Approval Document --> start
function previewAppovalImage() {
    while (approvalImg.hasChildNodes()) {
        approvalImg.removeChild(approvalImg.firstChild);
    }

    while (slidesApprovalPreview.hasChildNodes()) {
        slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
    }

    console.log(documentApproval.files.length);

    if (documentApproval.files.length != 0) {
        numberApprovalFile.innerHTML = "";
        numberApprovalFile.innerHTML = documentApproval.files.length + " images selected";

        for (n = 0; n < documentApproval.files.length; n++) {
            const file = documentApproval.files[n];
            const objectUrl = URL.createObjectURL(file);

            approvalImage[n] = document.createElement("img")
            if (n == 0) {
                approvalImage[n].classList.add("document-approval-active");
            } else {
                approvalImage[n].classList.add("document-approval");
            }

            approvalImage[n].src = objectUrl;
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
            slideApprovalImage[n].src = objectUrl;
            slideApprovalPreview[n].appendChild(slideApprovalImage[n]);
            slidesApprovalPreview.appendChild(slideApprovalPreview[n]);
        }

        prevApprovalButton.removeAttribute('hidden');
        nextApprovalButton.removeAttribute('hidden');
    }

    prevApprovalButton.addEventListener('click', function () {
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
            slideApprovalIndex = documentApproval.files.length - 1;
            slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval");
            approvalImage[slideApprovalIndex].classList.add("document-approval-active");
        }
    })

    nextApprovalButton.addEventListener('click', function () {
        if (slideApprovalIndex != documentApproval.files.length - 1) {
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
}

function myApprovalSlide(img) {
    slideApprovalImage[slideApprovalIndex].classList.add("hidden");
    approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
    approvalImage[slideApprovalIndex].classList.add("document-approval");
    slideApprovalIndex = Number(img.id);
    slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
    approvalImage[slideApprovalIndex].classList.remove("document-approval");
    approvalImage[slideApprovalIndex].classList.add("document-approval-active");
}

// Preview Approval Document --> end

selectStatus.addEventListener('click', function () {
    if (selectStatus.value == 'Deal') {
        divApproval.removeAttribute('hidden');
    } else {
        divApproval.setAttribute('hidden', 'hidden');
    }
})