const figureImages = document.getElementById("figureImages");
const slidesPreview = document.getElementById("slidesPreview");
const numberImagesFile = document.getElementById("numberImagesFile");
const nextButton = document.getElementById("nextButton");
const prevButton = document.getElementById("prevButton");

let previewImage = [];
let slidePreview = [];
let slidePreviewImage = [];
let index = 0;
let fileLength = 0;

//preview images --> start
imagePreview = (sel) => {
    fileLength = 0;
    index = 0;
    numberImagesFile.innerHTML = "Tidak Ada File Yang Dipilih";
    while (figureImages.hasChildNodes()) {
        figureImages.removeChild(figureImages.firstChild);
    }

    while (slidesPreview.hasChildNodes()) {
        slidesPreview.removeChild(slidesPreview.firstChild);
    }

    if (sel.files.length != 0) {
        numberImagesFile.innerHTML = sel.files.length + " file di pilih";
        fileLength = sel.files.length ;

        for (n = 0; n < sel.files.length; n++) {
            const file = sel.files[n];
            const objectUrl = URL.createObjectURL(file);

            previewImage[n] = document.createElement("img");
            if (n == 0) {
                previewImage[n].classList.add("document-approval-active");
            } else {
                previewImage[n].classList.add("document-approval");
            }

            previewImage[n].src = objectUrl;
            previewImage[n].setAttribute('id', n);
            previewImage[n].setAttribute('onclick', 'myPreviewSlide(this)');
            figureImages.appendChild(previewImage[n]);

            slidePreview[n] = document.createElement("figure");
            slidePreview[n].classList.add("mySlides");
            slidePreview[n].classList.add("fade");
            slidePreviewImage[n] = document.createElement("img");
            if (n != 0) {
                slidePreviewImage[n].classList.add("hidden");
            }
            slidePreviewImage[n].classList.add("w-full");
            slidePreviewImage[n].classList.add("mt-2");
            slidePreviewImage[n].src = objectUrl;
            slidePreview[n].appendChild(slidePreviewImage[n]);
            slidesPreview.appendChild(slidePreview[n]);
        }

        prevButton.removeAttribute('hidden');
        nextButton.removeAttribute('hidden');
    }
}
//preview images --> end

//Figure Image Action --> start
myPreviewSlide = (img) =>{
    slidePreviewImage[index].classList.add("hidden");
    previewImage[index].classList.remove("document-approval-active");
    previewImage[index].classList.add("document-approval");
    index = Number(img.id);
    slidePreviewImage[index].classList.remove("hidden");
    previewImage[index].classList.remove("document-approval");
    previewImage[index].classList.add("document-approval-active");
}
//Figure Image Action --> end

//prev button action --> start
prevButtonAction = () =>{
    if (index != 0) {
        slidePreviewImage[index].classList.add("hidden");
        previewImage[index].classList.remove("document-approval-active");
        previewImage[index].classList.add("document-approval");
        index = index - 1;
        slidePreviewImage[index].classList.remove("hidden");
        previewImage[index].classList.remove("document-approval");
        previewImage[index].classList.add("document-approval-active");
    } else {
        slidePreviewImage[index].classList.add("hidden");
        previewImage[0].classList.remove("document-approval-active");
        previewImage[0].classList.add("document-approval");
        index = fileLength - 1;
        slidePreviewImage[index].classList.remove("hidden");
        previewImage[index].classList.remove("document-approval");
        previewImage[index].classList.add("document-approval-active");
    }
}
//prev button action --> end

//next button action --> start
nextButtonAction = () =>{
    if (index != fileLength - 1) {
        slidePreviewImage[index].classList.add("hidden");
        previewImage[index].classList.remove("document-approval-active");
        previewImage[index].classList.add("document-approval");
        index = index + 1;
        slidePreviewImage[index].classList.remove("hidden");
        previewImage[index].classList.remove("document-approval");
        previewImage[index].classList.add("document-approval-active");
    } else {
        slidePreviewImage[index].classList.add("hidden");
        previewImage[index].classList.remove("document-approval-active");
        previewImage[index].classList.add("document-approval");
        index = 0;
        slidePreviewImage[index].classList.remove("hidden");
        previewImage[index].classList.remove("document-approval");
        previewImage[index].classList.add("document-approval-active");
    }
}
//next button action --> end