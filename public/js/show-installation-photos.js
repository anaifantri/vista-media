// Funtion Button Next-Prev-figure start -->
const imageNightViews = document.querySelectorAll(".divNightPhoto");
const imageDayViews = document.querySelectorAll(".divDayPhoto");
const figureNightPhoto = document.getElementById("figureNightPhoto");
const figureDayPhoto = document.getElementById("figureDayPhoto");
const figureNightImages = figureNightPhoto.getElementsByTagName("img");
const figureDayImages = figureDayPhoto.getElementsByTagName("img");

if (document.querySelectorAll(".divNightPhoto").length > 2) {
    var indexNight = Math.floor(document.querySelectorAll(".divNightPhoto").length / 2);
} else {
    var indexNight = 0;
}

if (document.querySelectorAll(".divDayPhoto").length > 2) {
    var indexDay = Math.floor(document.querySelectorAll(".divDayPhoto").length / 2);
} else {
    var indexDay = 0;
}

buttonNightNext = () => {
    if (indexNight == imageNightViews.length - 1) {
        figureNightImages[indexNight].classList.remove('documentation-photo-active');
        figureNightImages[indexNight].classList.add('documentation-photo');
        figureNightImages[0].classList.remove('documentation-photo');
        figureNightImages[0].classList.add('documentation-photo-active');
        imageNightViews[indexNight].setAttribute('hidden', 'hidden');
        imageNightViews[0].removeAttribute('hidden');
        indexNight = 0;
    } else {
        figureNightImages[indexNight].classList.remove('documentation-photo-active');
        figureNightImages[indexNight].classList.add('documentation-photo');
        figureNightImages[indexNight + 1].classList.add('documentation-photo-active');
        figureNightImages[indexNight + 1].classList.remove('documentation-photo');
        imageNightViews[indexNight].setAttribute('hidden', 'hidden');
        imageNightViews[indexNight + 1].removeAttribute('hidden');
        indexNight = indexNight + 1;
    }
}
buttonDayNext = () => {
    if (indexDay == imageDayViews.length - 1) {
        figureDayImages[indexDay].classList.remove('documentation-photo-active');
        figureDayImages[indexDay].classList.add('documentation-photo');
        figureDayImages[0].classList.remove('documentation-photo');
        figureDayImages[0].classList.add('documentation-photo-active');
        imageDayViews[indexDay].setAttribute('hidden', 'hidden');
        imageDayViews[0].removeAttribute('hidden');
        indexDay = 0;
    } else {
        figureDayImages[indexDay].classList.remove('documentation-photo-active');
        figureDayImages[indexDay].classList.add('documentation-photo');
        figureDayImages[indexDay + 1].classList.add('documentation-photo-active');
        figureDayImages[indexDay + 1].classList.remove('documentation-photo');
        imageDayViews[indexDay].setAttribute('hidden', 'hidden');
        imageDayViews[indexDay + 1].removeAttribute('hidden');
        indexDay = indexDay + 1;
    }
}
buttonNightPrev = () => {
    if (indexNight == 0) {
        figureNightImages[indexNight].classList.remove('documentation-photo-active');
        figureNightImages[indexNight].classList.add('documentation-photo');
        figureNightImages[imageNightViews.length - 1].classList.remove('documentation-photo');
        figureNightImages[imageNightViews.length - 1].classList.add('documentation-photo-active');
        imageNightViews[indexNight].setAttribute('hidden', 'hidden');
        imageNightViews[imageNightViews.length - 1].removeAttribute('hidden');
        indexNight = imageNightViews.length - 1;
    } else {
        figureNightImages[indexNight].classList.remove('documentation-photo-active');
        figureNightImages[indexNight].classList.add('documentation-photo');
        figureNightImages[indexNight - 1].classList.add('documentation-photo-active');
        figureNightImages[indexNight - 1].classList.remove('documentation-photo');
        imageNightViews[indexNight].setAttribute('hidden', 'hidden');
        imageNightViews[indexNight - 1].removeAttribute('hidden');
        indexNight = indexNight - 1;
    }
}
buttonDayPrev = () => {
    if (indexDay == 0) {
        figureDayImages[indexDay].classList.remove('documentation-photo-active');
        figureDayImages[indexDay].classList.add('documentation-photo');
        figureDayImages[imageDayViews.length - 1].classList.remove('documentation-photo');
        figureDayImages[imageDayViews.length - 1].classList.add('documentation-photo-active');
        imageDayViews[indexDay].setAttribute('hidden', 'hidden');
        imageDayViews[imageDayViews.length - 1].removeAttribute('hidden');
        indexDay = imageDayViews.length - 1;
    } else {
        figureDayImages[indexDay].classList.remove('documentation-photo-active');
        figureDayImages[indexDay].classList.add('documentation-photo');
        figureDayImages[indexDay - 1].classList.add('documentation-photo-active');
        figureDayImages[indexDay - 1].classList.remove('documentation-photo');
        imageDayViews[indexDay].setAttribute('hidden', 'hidden');
        imageDayViews[indexDay - 1].removeAttribute('hidden');
        indexDay = indexDay - 1;
    }
}
figureNightAction = (sel) => {
    for (let i = 0; i < figureNightImages.length; i++) {
        if (figureNightImages[i].id == sel.id) {
            figureNightImages[i].classList.remove('documentation-photo');
            figureNightImages[i].classList.add('documentation-photo-active');
            imageNightViews[i].removeAttribute('hidden');
        } else {
            figureNightImages[i].classList.add('documentation-photo');
            figureNightImages[i].classList.remove('documentation-photo-active');
            imageNightViews[i].setAttribute('hidden', 'hidden');
        }
    }
    indexNight = parseInt(sel.id.replace(/[^\d.]/g, ''));
    console.log(indexNight);
}
figureDayAction = (sel) => {
    for (let i = 0; i < figureDayImages.length; i++) {
        if (figureDayImages[i].id == sel.id) {
            figureDayImages[i].classList.remove('documentation-photo');
            figureDayImages[i].classList.add('documentation-photo-active');
            imageDayViews[i].removeAttribute('hidden');
        } else {
            figureDayImages[i].classList.add('documentation-photo');
            figureDayImages[i].classList.remove('documentation-photo-active');
            imageDayViews[i].setAttribute('hidden', 'hidden');
        }
    }
    indexDay = parseInt(sel.id.replace(/[^\d.]/g, ''));
}
// Funtion Button Next-Prev-figure end -->

// Button delete action start -->
deletePhoto = (sel) => {
    if (confirm("Anda yakin ingin menghapus foto ini?")) {
        document.getElementById("formDelete").action = "/workshop/installation-photos/" + sel.id;
        document.getElementById("formDelete").submit();
    }
}
// Button delete action end -->