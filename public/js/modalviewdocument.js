const modalViewImages = document.getElementById("modalViewImages");
const figureViewImages = document.getElementById("figureViewImages");
const slidesViewDocument = document.getElementById("slidesViewDocument");
const buttonNextView = document.getElementById("buttonNextView");
const buttonPrevView = document.getElementById("buttonPrevView");

let previewDocument = [];
let slideDocument = [];
let slideDocumentImg = [];
let indexDocument = 0;
let fileDocument = 0;

//preview images --> start
documentImagesPreview = (dataImages) => {
    let objDocument = dataImages;

    indexDocument = 0;
    while (figureViewImages.hasChildNodes()) {
        figureViewImages.removeChild(figureViewImages.firstChild);
    }

    while (slidesViewDocument.hasChildNodes()) {
        slidesViewDocument.removeChild(slidesViewDocument.firstChild);
    }

    if (objDocument.length != 0) {
        fileDocument = objDocument.length;
        for (let i = 0; i < objDocument.length; i++) {
            const objectUrl = "/storage/" + objDocument[i].image;

            previewDocument[i] = document.createElement("img");
            if (i == 0) {
                previewDocument[i].classList.add("document-approval-active");
            } else {
                previewDocument[i].classList.add("document-approval");
            }

            previewDocument[i].src = objectUrl;
            previewDocument[i].setAttribute('id', i);
            previewDocument[i].setAttribute('onclick', 'myDocumentPreview(this)');
            figureViewImages.appendChild(previewDocument[i]);

            slideDocument[i] = document.createElement("figure");
            slideDocument[i].classList.add("mySlides");
            slideDocument[i].classList.add("fade");
            slideDocumentImg[i] = document.createElement("img");
            if (i != 0) {
                slideDocumentImg[i].classList.add("hidden");
            }
            slideDocumentImg[i].classList.add("w-full");
            slideDocumentImg[i].classList.add("mt-2");
            slideDocumentImg[i].src = objectUrl;
            slideDocument[i].appendChild(slideDocumentImg[i]);
            slidesViewDocument.appendChild(slideDocument[i]);
        }

        buttonPrevView.removeAttribute('hidden');
        buttonNextView.removeAttribute('hidden');
    }
}
//preview images --> end

//Figure Image Action --> start
myDocumentPreview = (img) =>{
    slideDocumentImg[indexDocument].classList.add("hidden");
    previewDocument[indexDocument].classList.remove("document-approval-active");
    previewDocument[indexDocument].classList.add("document-approval");
    indexDocument = Number(img.id);
    slideDocumentImg[indexDocument].classList.remove("hidden");
    previewDocument[indexDocument].classList.remove("document-approval");
    previewDocument[indexDocument].classList.add("document-approval-active");
}
//Figure Image Action --> end

//prev button action --> start
buttonPrevAction = () =>{
    if (indexDocument != 0) {
        slideDocumentImg[indexDocument].classList.add("hidden");
        previewDocument[indexDocument].classList.remove("document-approval-active");
        previewDocument[indexDocument].classList.add("document-approval");
        indexDocument = indexDocument - 1;
        slideDocumentImg[indexDocument].classList.remove("hidden");
        previewDocument[indexDocument].classList.remove("document-approval");
        previewDocument[indexDocument].classList.add("document-approval-active");
    } else {
        slideDocumentImg[indexDocument].classList.add("hidden");
        previewDocument[0].classList.remove("document-approval-active");
        previewDocument[0].classList.add("document-approval");
        indexDocument = fileDocument - 1;
        slideDocumentImg[indexDocument].classList.remove("hidden");
        previewDocument[indexDocument].classList.remove("document-approval");
        previewDocument[indexDocument].classList.add("document-approval-active");
    }
}
//prev button action --> end

//next button action --> start
buttonNextAction = () =>{
    if (indexDocument != fileDocument - 1) {
        slideDocumentImg[indexDocument].classList.add("hidden");
        previewDocument[indexDocument].classList.remove("document-approval-active");
        previewDocument[indexDocument].classList.add("document-approval");
        indexDocument = indexDocument + 1;
        slideDocumentImg[indexDocument].classList.remove("hidden");
        previewDocument[indexDocument].classList.remove("document-approval");
        previewDocument[indexDocument].classList.add("document-approval-active");
    } else {
        slideDocumentImg[indexDocument].classList.add("hidden");
        previewDocument[indexDocument].classList.remove("document-approval-active");
        previewDocument[indexDocument].classList.add("document-approval");
        indexDocument = 0;
        slideDocumentImg[indexDocument].classList.remove("hidden");
        previewDocument[indexDocument].classList.remove("document-approval");
        previewDocument[indexDocument].classList.add("document-approval-active");
    }
}
//next button action --> end

btnCloseDocument = () =>{
    document.getElementById("modalViewImages").classList.add('hidden');
    document.getElementById("modalViewImages").classList.remove('flex');
}

btnShowModalView = (imgDocument) =>{
    window.scrollTo({ top: 0, behavior: 'smooth' });
    let objImages = JSON.parse(imgDocument.value);
    document.getElementById("modalViewImages").classList.add('flex');
    document.getElementById("modalViewImages").classList.remove('hidden');
    documentImagesPreview(objImages);
}