const divProgress = document.getElementById("divProgress");
const divApproval = document.getElementById("divApproval");
const cbUpdate = document.getElementById("cbUpdate");
const selectStatus = document.getElementById("status");
const price = document.getElementById("price");
const btnSaveProgress = document.getElementById("btnSaveProgress");
const cbUpdateValue = document.getElementById("cbUpdateValue");

if (Boolean(cbUpdateValue.value) == true) {
    divProgress.removeAttribute('hidden');
    cbUpdate.checked = true;
    if (selectStatus.value == "Deal") {
        divApproval.removeAttribute('hidden');
    } else {
        divApproval.setAttribute('hidden', 'hidden');
    }
} else {
    divProgress.setAttribute('hidden', 'hidden');
    cbUpdate.checked = false;
}


updateProgress = (sel) => {
    if (sel.checked == true) {
        divProgress.removeAttribute('hidden');
        cbUpdateValue.value = true;
    } else {
        divProgress.setAttribute('hidden', 'hidden');
        cbUpdateValue.value = false;
    }
}

getStatus = (sel) => {
    if (sel.options[sel.selectedIndex].text == "Deal") {
        const category = document.getElementById("category");
        let dataPrice = JSON.parse(price.value);
        var titlePrice = 0;

        if(category.value != "Service"){
            if(category.value == "Videotron" || (category.value == "Signage" && category.name == "Videotron")){
                if(dataPrice.priceType[0] == true){
                    for(let i = 0; i < dataPrice.dataSharingPrice.length; i++){
                        if(dataPrice.dataSharingPrice[i].checkbox == true){
                            titlePrice++;
                        }
                    }
                }
                if(dataPrice.priceType[1] == true){
                    for(let i = 0; i < dataPrice.dataExclusivePrice.length; i++){
                        if(dataPrice.dataExclusivePrice[i].checkbox == true){
                            titlePrice++;
                        }
                    }
                }
            }else{
                for(let i = 0; i < dataPrice.dataTitle.length; i++){
                    if(dataPrice.dataTitle[i].checkbox == true){
                        titlePrice++;
                    }
                }
            }

            if(titlePrice > 1){
                btnSaveProgress.classList.add('hidden');
                alert('Silahkan revisi penawaran, harga harus dalam 1 periode');
            }else{
                divApproval.removeAttribute('hidden');
                btnSaveProgress.classList.remove('hidden');
                // selectStatus.value = sel.options[sel.selectedIndex].text;
            }
        }else{
            divApproval.removeAttribute('hidden');
            btnSaveProgress.classList.remove('hidden');
        }
        
    } else {
        divApproval.setAttribute('hidden', 'hidden');
        btnSaveProgress.classList.remove('hidden');
        // selectStatus.value = sel.options[sel.selectedIndex].text;
    }
}

// const modalApproval = document.getElementById("modalApproval");

// const btnApprovalClear = document.getElementById("btnApprovalClear");
// const btnApprovalClose = document.getElementById("btnApprovalClose");
// const btnApprovalSubmit = document.getElementById("btnApprovalSubmit");
// const documentApproval = document.querySelector('#documentApproval');

// const slidesApprovalPreview = document.getElementById("slidesApprovalPreview");
// const numberApprovalFile = document.getElementById("numberApprovalFile");
// const labelDocumentApproval = document.getElementById("labelDocumentApproval");
// const prevApprovalButton = document.getElementById("prevApprovalButton");
// const nextApprovalButton = document.getElementById("nextApprovalButton");
// const approvalImg = document.getElementById("approvalImg");

// let approvalImage = [];
// let slideApprovalPreview = [];
// let slideApprovalImage = [];
// let slideApprovalIndex = 0;

// // Function Button Approval Event --> start
// function btnApprovalEvent() {
//     modalApproval.classList.remove("hidden");
//     modalApproval.classList.add("flex");
//     window.scrollTo(0, 0);
// }

// btnApprovalClear.addEventListener('click', function() {
//     prevApprovalButton.setAttribute('hidden', 'hidden');
//     nextApprovalButton.setAttribute('hidden', 'hidden');
//     documentApproval.value = null;
//     labelDocumentApproval.innerHTML = "0 images selected";
//     numberApprovalFile.innerHTML = "No Files Chosen";
//     approvalImage = [];
//     slideApprovalPreview = [];
//     slideApprovalImage = [];
//     while (approvalImg.hasChildNodes()) {
//         approvalImg.removeChild(approvalImg.firstChild);
//     }
//     while (slidesApprovalPreview.hasChildNodes()) {
//         slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
//     }
// })

// btnApprovalClose.addEventListener('click', function() {
//     modalApproval.classList.add("hidden");
//     modalApproval.classList.remove("flex");
// })

// btnApprovalSubmit.addEventListener('click', function() {
//     slideApprovalIndex = 0;
//     if (documentApproval.files.length == 0) {
//         alert("Document approval belum dipilih")
//     } else {
//         modalApproval.classList.add("hidden");
//         modalApproval.classList.remove("flex");
//         labelDocumentApproval.innerHTML = "";
//         labelDocumentApproval.innerHTML = documentApproval.files.length + " images selected";
//     }
// })
// // Function Button Approval Event --> end

// // Preview Approval Document --> start
// function previewAppovalImage() {
//     while (approvalImg.hasChildNodes()) {
//         approvalImg.removeChild(approvalImg.firstChild);
//     }

//     while (slidesApprovalPreview.hasChildNodes()) {
//         slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
//     }

//     if (documentApproval.files.length != 0) {
//         numberApprovalFile.innerHTML = "";
//         numberApprovalFile.innerHTML = documentApproval.files.length + " images selected";

//         for (n = 0; n < documentApproval.files.length; n++) {
//             const file = documentApproval.files[n];
//             const objectUrl = URL.createObjectURL(file);

//             approvalImage[n] = document.createElement("img")
//             if (n == 0) {
//                 approvalImage[n].classList.add("document-approval-active");
//             } else {
//                 approvalImage[n].classList.add("document-approval");
//             }

//             approvalImage[n].src = objectUrl;
//             approvalImage[n].setAttribute('id', n);
//             approvalImage[n].setAttribute('onclick', 'myApprovalSlide(this)');
//             approvalImg.appendChild(approvalImage[n]);

//             slideApprovalPreview[n] = document.createElement("figure");
//             slideApprovalPreview[n].classList.add("mySlides");
//             slideApprovalPreview[n].classList.add("fade");
//             slideApprovalImage[n] = document.createElement("img");
//             if (n != 0) {
//                 slideApprovalImage[n].classList.add("hidden");
//             }
//             slideApprovalImage[n].classList.add("w-full");
//             slideApprovalImage[n].classList.add("mt-2");
//             slideApprovalImage[n].src = objectUrl;
//             slideApprovalPreview[n].appendChild(slideApprovalImage[n]);
//             slidesApprovalPreview.appendChild(slideApprovalPreview[n]);
//         }

//         prevApprovalButton.removeAttribute('hidden');
//         nextApprovalButton.removeAttribute('hidden');
//     }
// }

// prevApprovalButton.addEventListener('click', function() {
//     console.log(slideApprovalIndex);
//     if (slideApprovalIndex != 0) {
//         slideApprovalImage[slideApprovalIndex].classList.add("hidden");
//         approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
//         approvalImage[slideApprovalIndex].classList.add("document-approval");
//         slideApprovalIndex = slideApprovalIndex - 1;
//         slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
//         approvalImage[slideApprovalIndex].classList.remove("document-approval");
//         approvalImage[slideApprovalIndex].classList.add("document-approval-active");
//     } else {
//         slideApprovalImage[slideApprovalIndex].classList.add("hidden");
//         approvalImage[0].classList.remove("document-approval-active");
//         approvalImage[0].classList.add("document-approval");
//         slideApprovalIndex = documentApproval.files.length - 1;
//         slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
//         approvalImage[slideApprovalIndex].classList.remove("document-approval");
//         approvalImage[slideApprovalIndex].classList.add("document-approval-active");
//     }
// })

// nextApprovalButton.addEventListener('click', function() {
//     console.log(slideApprovalIndex);
//     if (slideApprovalIndex != documentApproval.files.length - 1) {
//         slideApprovalImage[slideApprovalIndex].classList.add("hidden");
//         approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
//         approvalImage[slideApprovalIndex].classList.add("document-approval");
//         slideApprovalIndex = slideApprovalIndex + 1;
//         slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
//         approvalImage[slideApprovalIndex].classList.remove("document-approval");
//         approvalImage[slideApprovalIndex].classList.add("document-approval-active");
//     } else {
//         slideApprovalImage[slideApprovalIndex].classList.add("hidden");
//         approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
//         approvalImage[slideApprovalIndex].classList.add("document-approval");
//         slideApprovalIndex = 0;
//         slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
//         approvalImage[slideApprovalIndex].classList.remove("document-approval");
//         approvalImage[slideApprovalIndex].classList.add("document-approval-active");
//     }
// })

// function myApprovalSlide(img) {
//     slideApprovalImage[slideApprovalIndex].classList.add("hidden");
//     approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
//     approvalImage[slideApprovalIndex].classList.add("document-approval");
//     slideApprovalIndex = Number(img.id);
//     slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
//     approvalImage[slideApprovalIndex].classList.remove("document-approval");
//     approvalImage[slideApprovalIndex].classList.add("document-approval-active");
// }
// Preview Approval Document --> end

//Function create pdf --> start
const saveName = document.getElementById("saveName");
document.getElementById("btnCreatePdf").onclick = function() {
    var element = document.getElementById('pdfPreview');
    var opt = {
        margin: 0,
        filename: saveName.value,
        image: {
            type: 'jpeg',
            quality: 1
        },
        pagebreak: {
            mode: ['avoid-all', 'css', 'legacy']
        },
        html2canvas: {
            dpi: 300,
            scale: 1,
            letterRendering: true,
            useCORS: true
        },
        jsPDF: {
            unit: 'px',
            format: [950, 1365],
            orientation: 'portrait',
            putTotalPages: true
        }
    };
    // html2pdf(element, opt);
    html2pdf().set(opt).from(element).save();
};
//Function create pdf --> end