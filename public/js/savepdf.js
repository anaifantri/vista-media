savePdf = () => {
    const saveName = document.getElementById("saveName");
    var element = document.getElementById('pdfPreview');
    var opt = {
        margin: 0,
        filename: saveName.value + ".pdf",
        image: {
            type: 'jpeg',
            quality: 1
        },
        pagebreak: {
            mode: ['avoid-all', 'css', 'legacy']
        },
        html2canvas: {
            dpi: 96,
            scale: 2,
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
    html2pdf().set(opt).from(element).save();
};