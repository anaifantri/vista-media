// Button delete action start -->
deleteDocument = (sel) => {
    if(confirm("Anda yakin ingin menghapus dokumen ini?")) {
        document.getElementById("formDelete").action = "/media/license-documents/"+ sel.id;
        document.getElementById("formDelete").submit();
    }
}
// Button delete action end -->

// Funtion Button Next-Prev-figure start -->
const imageViews = document.querySelectorAll(".divImage");
const figure = document.getElementById("figure");
const figureImages = figure.getElementsByTagName("img");
var index = 0;

if (imageViews.length > 2) {
    index = Math.floor(imageViews.length / 2);
} else {
    index = 0;
}

buttonNext = () => {
    if(index == imageViews.length - 1){
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[0].classList.remove('photo');
        figureImages[0].classList.add('photo-active');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[0].removeAttribute('hidden');
        index = 0;
    } else {
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[index + 1].classList.add('photo-active');
        figureImages[index + 1].classList.remove('photo');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[index + 1].removeAttribute('hidden');
        index = index + 1;
    }
}
buttonPrev = () => {
    if(index == 0){
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[imageViews.length - 1].classList.remove('photo');
        figureImages[imageViews.length - 1].classList.add('photo-active');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[imageViews.length - 1].removeAttribute('hidden');
        index = imageViews.length - 1;
    } else {
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[index - 1].classList.add('photo-active');
        figureImages[index - 1].classList.remove('photo');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[index - 1].removeAttribute('hidden');
        index = index - 1;
    }
}
figureAction = (sel) => {
    for(let i = 0; i < figureImages.length; i++){
        if(figureImages[i].id == sel.id){
            figureImages[i].classList.remove('photo');
            figureImages[i].classList.add('photo-active');
            imageViews[i].removeAttribute('hidden');
        } else {
            figureImages[i].classList.add('photo');
            figureImages[i].classList.remove('photo-active');
            imageViews[i].setAttribute('hidden', 'hidden');
        }
    }
}
// Funtion Button Next-Prev-figure end -->
