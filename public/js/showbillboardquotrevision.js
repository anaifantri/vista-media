// Declaration --> start
const divStatus = document.getElementById("divStatus");
const divDescription = document.getElementById("divDescription");
const cbUpdateProgress = document.getElementById("cbUpdateProgress");
const btnSaveProgress = document.getElementById("btnSaveProgress");

// Declaration --> start

// Checkbox Update Progress Action --> start
cbUpdateProgress.addEventListener('click', function () {
    if (cbUpdateProgress.checked == true) {
        divStatus.removeAttribute('hidden');
        divDescription.removeAttribute('hidden');
        btnSaveProgress.classList.add('flex');
        btnSaveProgress.classList.remove('hidden');
    } else {
        divStatus.setAttribute('hidden', 'hidden');
        divDescription.setAttribute('hidden', 'hidden');
        btnSaveProgress.classList.add('hidden');
        btnSaveProgress.classList.remove('flex');
    }
})

// Checkbox Update Progress Action --> start

// Create PDF --> start
document.getElementById("btnCreatePdf").onclick = function () {
    var element = document.getElementById('pdfPreview');
    var opt = {
        margin: 0,
        filename: 'test.pdf',
        image: {
            type: 'jpeg',
            quality: 1
        },
        pagebreak: {
            mode: ['avoid-all', 'css', 'legacy']
        },
        html2canvas: {
            dpi: 192,
            scale: 4,
            letterRendering: true,
            useCORS: true
        },
        jsPDF: {
            unit: 'in',
            format: 'a4',
            orientation: 'portrait',
            putTotalPages: true
        }
    };
    // html2pdf(element, opt);
    html2pdf().set(opt).from(element).save();
};
// Create PDF --> end