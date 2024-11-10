// Funtion Button Next-Prev-figure start -->
var indexAgreement = 0;
var indexCertificate = 0;
var indexReceipt = 0;
var index = 0;

if (document.querySelectorAll(".divImageAgreement").length > 2) {
    indexAgreement = Math.floor(document.querySelectorAll(".divImageAgreement").length / 2);
} else {
    indexAgreement = 0;
}

if (document.querySelectorAll(".divImageCertificate").length > 2) {
    indexCertificate = Math.floor(document.querySelectorAll(".divImageCertificate").length / 2);
} else {
    indexCertificate = 0;
}

if (document.querySelectorAll(".divImageReceipt").length > 2) {
    indexReceipt = Math.floor(document.querySelectorAll(".divImageReceipt").length / 2);
} else {
    indexReceipt = 0;
}

buttonNext = (type) => {
    var imageViews = '';
    var figureImages = '';
    if(type == 'agreement'){
        imageViews = document.querySelectorAll(".divImageAgreement");
        const figure = document.getElementById("figureAgreement");
        figureImages = figure.getElementsByTagName("img");
        index = indexAgreement;
    }else if(type == 'certificate'){
        imageViews = document.querySelectorAll(".divImageCertificate");
        const figure = document.getElementById("figureCertificate");
        figureImages = figure.getElementsByTagName("img");
        index = indexCertificate;
    }else if(type == 'receipt'){
        imageViews = document.querySelectorAll(".divImageReceipt");
        const figure = document.getElementById("figureReceipt");
        figureImages = figure.getElementsByTagName("img");
        index = indexReceipt;
    }
    if (index == imageViews.length - 1) {
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[0].classList.remove('photo');
        figureImages[0].classList.add('photo-active');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[0].removeAttribute('hidden');
        if(type == 'agreement'){
            indexAgreement = 0;
        }else if(type == 'certificate'){
            indexCertificate = 0;
        }else if(type == 'receipt'){
            indexReceipt = 0;
        }
    } else {
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[index + 1].classList.add('photo-active');
        figureImages[index + 1].classList.remove('photo');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[index + 1].removeAttribute('hidden');
        if(type == 'agreement'){
            indexAgreement = indexAgreement + 1;
        }else if(type == 'certificate'){
            indexCertificate = indexCertificate + 1;
        }else if(type == 'receipt'){
            indexReceipt = indexReceipt + 1;
        }
    }
}
buttonPrev = (type) => {
    var imageViews = '';
    var figureImages = '';
    if(type == 'agreement'){
        imageViews = document.querySelectorAll(".divImageAgreement");
        const figure = document.getElementById("figureAgreement");
        figureImages = figure.getElementsByTagName("img");
        index = indexAgreement;
    }else if(type == 'certificate'){
        imageViews = document.querySelectorAll(".divImageCertificate");
        const figure = document.getElementById("figureCertificate");
        figureImages = figure.getElementsByTagName("img");
        index = indexCertificate;
    }else if(type == 'receipt'){
        imageViews = document.querySelectorAll(".divImageReceipt");
        const figure = document.getElementById("figureReceipt");
        figureImages = figure.getElementsByTagName("img");
        index = indexReceipt;
    }
    if (index == 0) {
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[imageViews.length - 1].classList.remove('photo');
        figureImages[imageViews.length - 1].classList.add('photo-active');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[imageViews.length - 1].removeAttribute('hidden');
        if(type == 'agreement'){
            indexAgreement = imageViews.length - 1;
        }else if(type == 'certificate'){
            indexCertificate = imageViews.length - 1;
        }else if(type == 'certificate'){
            indexReceipt = imageViews.length - 1;
        }
    } else {
        figureImages[index].classList.remove('photo-active');
        figureImages[index].classList.add('photo');
        figureImages[index - 1].classList.add('photo-active');
        figureImages[index - 1].classList.remove('photo');
        imageViews[index].setAttribute('hidden', 'hidden');
        imageViews[index - 1].removeAttribute('hidden');
        if(type == 'agreement'){
            indexAgreement = indexAgreement - 1;
        }else if(type == 'certificate'){
            indexCertificate = indexCertificate - 1;
        }else if(type == 'certificate'){
            indexReceipt = indexReceipt - 1;
        }
    }
}
figureAction = (sel, type) => {
    var imageViews = '';
    var figureImages = '';
    if(type == 'agreement'){
        imageViews = document.querySelectorAll(".divImageAgreement");
        const figure = document.getElementById("figureAgreement");
        figureImages = figure.getElementsByTagName("img");
        indexAgreement = Number(sel.id);
    }else if(type == 'certificate'){
        imageViews = document.querySelectorAll(".divImageCertificate");
        const figure = document.getElementById("figureCertificate");
        figureImages = figure.getElementsByTagName("img");
        indexCertificate = Number(sel.id);
    }else if(type == 'receipt'){
        imageViews = document.querySelectorAll(".divImageReceipt");
        const figure = document.getElementById("figureReceipt");
        figureImages = figure.getElementsByTagName("img");
        indexReceipt = Number(sel.id);
    }
    for (let i = 0; i < figureImages.length; i++) {
        if (figureImages[i].id == sel.id) {
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