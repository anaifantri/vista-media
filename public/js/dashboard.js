//Navbar Fixed
window.onscroll = function () {
    const header = document.querySelector('header');
    const fixedNav = header.offsetTop;

    if (window.pageYOffset > fixedNav) {
        header.classList.add('navbar-fixed');
    } else {
        header.classList.remove('navbar-fixed');
    }
}

// Hamburger menu
const hamburger = document.querySelector('#hamburger');
const liDashboard = document.querySelector('#liDashboard');
const liMedia = document.querySelector('#liMedia');
const liMarketing = document.querySelector('#liMarketing');
const liAccounting = document.querySelector('#liAccounting');
const liWorkshop = document.querySelector('#liWorkshop');
const liUser = document.querySelector('#liUser');
const liLogout = document.querySelector('#liLogout');
const menu = document.querySelector('#menu');
const mediaChild = document.querySelector('#mediaChild');
const marketingChild = document.getElementById('marketingChild');
const accountingChild = document.querySelector('#accountingChild');
const workshopChild = document.querySelector('#workshopChild');
const userChild = document.querySelector('#userChild');
const mediaArrow = document.querySelector('#mediaArrow');
const marketingArrow = document.getElementById('marketingArrow');
const accountingArrow = document.querySelector('#accountingArrow');
const workshopArrow = document.querySelector('#workshopArrow');
const userArrow = document.querySelector('#userArrow');

hamburger.addEventListener('click', function () {
    showHideMenu();
    profileChildrendHide();
});

function showHideMenu() {
    hamburger.classList.toggle('hamburger-active');
    liDashboard.classList.toggle('hidden');
    if(liMedia){
        liMedia.classList.toggle('hidden');
        mediaChild.classList.add('hidden');
        mediaArrow.classList.add('rotate-180');
    }
    if(liMarketing){
        liMarketing.classList.toggle('hidden');
        marketingChild.classList.add('hidden');
        marketingArrow.classList.add('rotate-180');
    }
    if(liAccounting){
        liAccounting.classList.toggle('hidden');
        accountingChild.classList.add('hidden');
        accountingArrow.classList.add('rotate-180');
    }
    if(liWorkshop){
        liWorkshop.classList.toggle('hidden');
        workshopChild.classList.add('hidden');
        workshopArrow.classList.add('rotate-180');
    }
    if(liUser){
        liUser.classList.toggle('hidden');
        userChild.classList.add('hidden');
        userArrow.classList.add('rotate-180');
    }
    liLogout.classList.toggle('hidden');
    menu.classList.toggle('hidden');
    menu.classList.toggle('flex');
}

var mainWrapper = document.getElementById("main-wrapper");
var mainHeader = document.getElementById("main-header");

mainWrapper.addEventListener('click', function () {
    hideMenu();
    profileChildrendHide();
    navBarChildHidden();
}, false);

mainHeader.addEventListener('click', function () {
    hideMenu();
    profileChildrendHide();
    navBarChildHidden();
}, false);

document.getElementById("nav-menu").addEventListener('click', function () {
    navBarChildHidden();
}, false);

function hideMenu() {
    hamburger.classList.remove('hamburger-active');
    liDashboard.classList.add('hidden');
    if(liMedia){
        liMedia.classList.add('hidden');
        liMedia.classList.add('group');
        mediaChild.classList.add('hidden');
        mediaArrow.classList.remove('rotate-180');
    }
    if(liMarketing){
        liMarketing.classList.add('hidden');
        liMarketing.classList.add('group');
        marketingChild.classList.add('hidden');
        marketingArrow.classList.remove('rotate-180');
    }
    if(liAccounting){
        liAccounting.classList.add('hidden');
        liAccounting.classList.add('group');
        accountingChild.classList.add('hidden');
        accountingArrow.classList.remove('rotate-180');
    }
    if(liWorkshop){
        liWorkshop.classList.add('hidden');
        liWorkshop.classList.add('group');
        workshopChild.classList.add('hidden');
        workshopArrow.classList.remove('rotate-180');
    }
    if(liUser){
        liUser.classList.add('hidden');
        liUser.classList.add('group');
        userChild.classList.add('hidden');
        userArrow.classList.remove('rotate-180');
    }
    
    liLogout.classList.add('hidden');
    menu.classList.add('hidden');
    menu.classList.remove('flex');
}


// Nav Right - Profile
const profile = document.querySelector('#profile');
const profileChild = document.querySelector('#profileChild');
const profileArrow = document.querySelector('#profileArrow');

profileAction = (e,sel) => {
    navBarChildHidden();
    hideMenu();
    e.stopPropagation();
    sel.classList.toggle('group');
    profileArrow.classList.toggle('rotate-180');
    profileChild.classList.toggle('hidden');
    profileChild.classList.toggle('flex');
};

profileChildrendHide = () =>{
    profileArrow.classList.remove('rotate-180');
    profileChild.classList.add('hidden');
}

navBarChildHidden = () =>{
    if(document.getElementById("saleNav")){
        document.getElementById("saleChild").classList.add('hidden');
        document.getElementById("saleNav").classList.add('group');
        document.getElementById("saleArrow").classList.remove('rotate-180');
        document.getElementById("quotationNav").classList.add('group');
        document.getElementById("quotationChild").classList.add('hidden');
        document.getElementById("quotationArrow").classList.remove('rotate-180');
    } else if(document.getElementById("mediaNav")){
        document.getElementById("mediaChildNav").classList.add('hidden');
        document.getElementById("mediaNav").classList.add('group');
        document.getElementById("mediaArrowNav").classList.remove('rotate-180');
        document.getElementById("legalNav").classList.add('group');
        document.getElementById("legalChildNav").classList.add('hidden');
        document.getElementById("legalArrow").classList.remove('rotate-180');
    }else if(document.getElementById("electricityNav")){
        document.getElementById("electricityChildNav").classList.add('hidden');
        document.getElementById("electricityNav").classList.add('group');
        document.getElementById("electricityArrowNav").classList.remove('rotate-180');
        document.getElementById("complaintChildNav").classList.add('hidden');
        document.getElementById("complaintNav").classList.add('group');
        document.getElementById("complaintArrowNav").classList.remove('rotate-180');
        document.getElementById("monitoringChildNav").classList.add('hidden');
        document.getElementById("monitoringNav").classList.add('group');
        document.getElementById("monitoringArrowNav").classList.remove('rotate-180');
        document.getElementById("documentationChildNav").classList.add('hidden');
        document.getElementById("documentationNav").classList.add('group');
        document.getElementById("documentationArrowNav").classList.remove('rotate-180');
        document.getElementById("contentChildNav").classList.add('hidden');
        document.getElementById("contentNav").classList.add('group');
        document.getElementById("contentArrowNav").classList.remove('rotate-180');
    }else if(document.getElementById("collectNav")){
        document.getElementById("collectChildNav").classList.add('hidden');
        document.getElementById("collectNav").classList.add('group');
        document.getElementById("collectArrowNav").classList.remove('rotate-180');
        document.getElementById("paymentChildNav").classList.add('hidden');
        document.getElementById("paymentNav").classList.add('group');
        document.getElementById("paymentArrowNav").classList.remove('rotate-180');
        document.getElementById("ppnChildNav").classList.add('hidden');
        document.getElementById("ppnNav").classList.add('group');
        document.getElementById("ppnArrowNav").classList.remove('rotate-180');
        document.getElementById("pphChildNav").classList.add('hidden');
        document.getElementById("pphNav").classList.add('group');
        document.getElementById("pphArrowNav").classList.remove('rotate-180');
    }
}

// Sidebar dropdown
function showHideDropdown(sel) {
    sel.classList.toggle('group');
    sel.children[0].children[1].classList.toggle('rotate-180');
    sel.children[1].classList.toggle('hidden');
}

// header dropdown
function headerDropdown(e, sel) {
    profileChildrendHide();
    hideMenu();
    e.stopPropagation();
    sel.classList.toggle('group');
    sel.children[0].children[2].classList.toggle('rotate-180');
    sel.children[1].classList.toggle('hidden');
    if(document.getElementById("saleNav")){
        if(sel.id == "quotationNav"){
            document.getElementById("saleNav").classList.add('group');
            document.getElementById("saleChild").classList.add('hidden');
            document.getElementById("saleArrow").classList.remove('rotate-180');
        }else if(sel.id == "saleNav"){
            document.getElementById("quotationNav").classList.add('group');
            document.getElementById("quotationChild").classList.add('hidden');
            document.getElementById("quotationArrow").classList.remove('rotate-180');
        }
    } else if(document.getElementById("mediaNav")){
        if(sel.id == "mediaNav"){
            document.getElementById("legalNav").classList.add('group');
            document.getElementById("legalChildNav").classList.add('hidden');
            document.getElementById("legalArrow").classList.remove('rotate-180');
        }else if(sel.id == "legalNav"){
            document.getElementById("mediaNav").classList.add('group');
            document.getElementById("mediaChildNav").classList.add('hidden');
            document.getElementById("mediaArrowNav").classList.remove('rotate-180');
        }
    }else if(document.getElementById("electricityNav")){
        if(sel.id == "electricityNav"){
            document.getElementById("complaintNav").classList.add('group');
            document.getElementById("complaintChildNav").classList.add('hidden');
            document.getElementById("complaintArrowNav").classList.remove('rotate-180');
            document.getElementById("monitoringNav").classList.add('group');
            document.getElementById("monitoringChildNav").classList.add('hidden');
            document.getElementById("monitoringArrowNav").classList.remove('rotate-180');
            document.getElementById("documentationNav").classList.add('group');
            document.getElementById("documentationChildNav").classList.add('hidden');
            document.getElementById("documentationArrowNav").classList.remove('rotate-180');
            document.getElementById("contentNav").classList.add('group');
            document.getElementById("contentChildNav").classList.add('hidden');
            document.getElementById("contentArrowNav").classList.remove('rotate-180');
        }else if(sel.id == "complaintNav"){
            document.getElementById("electricityNav").classList.add('group');
            document.getElementById("electricityChildNav").classList.add('hidden');
            document.getElementById("electricityArrowNav").classList.remove('rotate-180');
            document.getElementById("monitoringNav").classList.add('group');
            document.getElementById("monitoringChildNav").classList.add('hidden');
            document.getElementById("monitoringArrowNav").classList.remove('rotate-180');
            document.getElementById("documentationNav").classList.add('group');
            document.getElementById("documentationChildNav").classList.add('hidden');
            document.getElementById("documentationArrowNav").classList.remove('rotate-180');
            document.getElementById("contentNav").classList.add('group');
            document.getElementById("contentChildNav").classList.add('hidden');
            document.getElementById("contentArrowNav").classList.remove('rotate-180');
        }else if(sel.id == "monitoringNav"){
            document.getElementById("electricityNav").classList.add('group');
            document.getElementById("electricityChildNav").classList.add('hidden');
            document.getElementById("electricityArrowNav").classList.remove('rotate-180');
            document.getElementById("complaintNav").classList.add('group');
            document.getElementById("complaintChildNav").classList.add('hidden');
            document.getElementById("complaintArrowNav").classList.remove('rotate-180');
            document.getElementById("documentationNav").classList.add('group');
            document.getElementById("documentationChildNav").classList.add('hidden');
            document.getElementById("documentationArrowNav").classList.remove('rotate-180');
            document.getElementById("contentNav").classList.add('group');
            document.getElementById("contentChildNav").classList.add('hidden');
            document.getElementById("contentArrowNav").classList.remove('rotate-180');
        }else if(sel.id == "documentationNav"){
            document.getElementById("electricityNav").classList.add('group');
            document.getElementById("electricityChildNav").classList.add('hidden');
            document.getElementById("electricityArrowNav").classList.remove('rotate-180');
            document.getElementById("complaintNav").classList.add('group');
            document.getElementById("complaintChildNav").classList.add('hidden');
            document.getElementById("complaintArrowNav").classList.remove('rotate-180');
            document.getElementById("monitoringNav").classList.add('group');
            document.getElementById("monitoringChildNav").classList.add('hidden');
            document.getElementById("monitoringArrowNav").classList.remove('rotate-180');
            document.getElementById("contentNav").classList.add('group');
            document.getElementById("contentChildNav").classList.add('hidden');
            document.getElementById("contentArrowNav").classList.remove('rotate-180');
        }else if(sel.id == "contentNav"){
            document.getElementById("electricityNav").classList.add('group');
            document.getElementById("electricityChildNav").classList.add('hidden');
            document.getElementById("electricityArrowNav").classList.remove('rotate-180');
            document.getElementById("complaintNav").classList.add('group');
            document.getElementById("complaintChildNav").classList.add('hidden');
            document.getElementById("complaintArrowNav").classList.remove('rotate-180');
            document.getElementById("monitoringNav").classList.add('group');
            document.getElementById("monitoringChildNav").classList.add('hidden');
            document.getElementById("monitoringArrowNav").classList.remove('rotate-180');
            document.getElementById("documentationNav").classList.add('group');
            document.getElementById("documentationChildNav").classList.add('hidden');
            document.getElementById("documentationArrowNav").classList.remove('rotate-180');
        }
    }else if(document.getElementById("collectNav")){
        if(sel.id == "collectNav"){
            document.getElementById("paymentNav").classList.add('group');
            document.getElementById("paymentChildNav").classList.add('hidden');
            document.getElementById("paymentArrowNav").classList.remove('rotate-180');
            document.getElementById("ppnNav").classList.add('group');
            document.getElementById("ppnChildNav").classList.add('hidden');
            document.getElementById("ppnArrowNav").classList.remove('rotate-180');
            document.getElementById("pphNav").classList.add('group');
            document.getElementById("pphChildNav").classList.add('hidden');
            document.getElementById("pphArrowNav").classList.remove('rotate-180');
        }else if(sel.id == "paymentNav"){
            document.getElementById("collectNav").classList.add('group');
            document.getElementById("collectChildNav").classList.add('hidden');
            document.getElementById("collectArrowNav").classList.remove('rotate-180');
            document.getElementById("ppnNav").classList.add('group');
            document.getElementById("ppnChildNav").classList.add('hidden');
            document.getElementById("ppnArrowNav").classList.remove('rotate-180');
            document.getElementById("pphNav").classList.add('group');
            document.getElementById("pphChildNav").classList.add('hidden');
            document.getElementById("pphArrowNav").classList.remove('rotate-180');
        }else if(sel.id == "ppnNav"){
            document.getElementById("collectNav").classList.add('group');
            document.getElementById("collectChildNav").classList.add('hidden');
            document.getElementById("collectArrowNav").classList.remove('rotate-180');
            document.getElementById("paymentNav").classList.add('group');
            document.getElementById("paymentChildNav").classList.add('hidden');
            document.getElementById("paymentArrowNav").classList.remove('rotate-180');
            document.getElementById("pphNav").classList.add('group');
            document.getElementById("pphChildNav").classList.add('hidden');
            document.getElementById("pphArrowNav").classList.remove('rotate-180');
        }else if(sel.id == "pphNav"){
            document.getElementById("collectNav").classList.add('group');
            document.getElementById("collectChildNav").classList.add('hidden');
            document.getElementById("collectArrowNav").classList.remove('rotate-180');
            document.getElementById("paymentNav").classList.add('group');
            document.getElementById("paymentChildNav").classList.add('hidden');
            document.getElementById("paymentArrowNav").classList.remove('rotate-180');
            document.getElementById("ppnNav").classList.add('group');
            document.getElementById("ppnChildNav").classList.add('hidden');
            document.getElementById("ppnArrowNav").classList.remove('rotate-180');
        }
    }
}

function childMenu(e, sel) {
    e.stopPropagation();
    sel.classList.toggle('group');
    sel.children[0].children[2].classList.toggle('rotate-180');
    sel.children[1].classList.toggle('hidden');
}
