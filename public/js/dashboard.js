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
});

function showHideMenu() {
    hamburger.classList.toggle('hamburger-active');
    liDashboard.classList.toggle('hidden');
    liMedia.classList.toggle('hidden');
    liMarketing.classList.toggle('hidden');
    liAccounting.classList.toggle('hidden');
    liWorkshop.classList.toggle('hidden');
    liUser.classList.toggle('hidden');
    liLogout.classList.toggle('hidden');
    menu.classList.toggle('hidden');
    menu.classList.toggle('flex');
    mediaChild.classList.add('hidden');
    marketingChild.classList.add('hidden');
    accountingChild.classList.add('hidden');
    workshopChild.classList.add('hidden');
    userChild.classList.add('hidden');
    mediaArrow.classList.add('rotate-180');
    marketingArrow.classList.add('rotate-180');
    accountingArrow.classList.add('rotate-180');
    workshopArrow.classList.add('rotate-180');
    userArrow.classList.add('rotate-180');
}

var mainWrapper = document.getElementById("main-wrapper");
var mainHeader = document.getElementById("main-header");

mainWrapper.addEventListener('click', function () {
    hideMenu();
}, false);

mainHeader.addEventListener('click', function () {
    hideMenu();
}, false);

function hideMenu() {
    hamburger.classList.remove('hamburger-active');
    liDashboard.classList.add('hidden');
    liMedia.classList.add('hidden');
    liMarketing.classList.add('hidden');
    liAccounting.classList.add('hidden');
    liWorkshop.classList.add('hidden');
    liUser.classList.add('hidden');
    liLogout.classList.add('hidden');
    menu.classList.add('hidden');
    menu.classList.remove('flex');
    mediaChild.classList.add('hidden');
    marketingChild.classList.add('hidden');
    accountingChild.classList.add('hidden');
    workshopChild.classList.add('hidden');
    userChild.classList.add('hidden');
    mediaArrow.classList.add('rotate-180');
    marketingArrow.classList.add('rotate-180');
    accountingArrow.classList.add('rotate-180');
    workshopArrow.classList.add('rotate-180');
    userArrow.classList.add('rotate-180');
}


// Nav Right - Profile
const profile = document.querySelector('#profile');
const profileChild = document.querySelector('#profileChild');
const profileArrow = document.querySelector('#profileArrow');

profile.addEventListener('click', function () {
    profile.classList.toggle('group');
    profileArrow.classList.toggle('rotate-180');
    profileChild.classList.toggle('hidden');
    profileChild.classList.toggle('flex');
});

// Navbar - Setting
const setting = document.querySelector('#setting');
const settingChild = document.querySelector('#settingChild');
const settingArrow = document.querySelector('#settingArrow');

setting.addEventListener('click', function () {
    setting.classList.toggle('group');
    settingArrow.classList.toggle('rotate-180');
    settingChild.classList.toggle('flex');
    settingChild.classList.toggle('hidden');
});

// Sidebar dropdown
function showHideDropdown(sel) {
    sel.classList.toggle('group');
    sel.children[0].children[1].classList.toggle('rotate-180');
    sel.children[1].classList.toggle('hidden');
}

// Media OOH
liMedia.addEventListener('click', function () {
    showHideDropdown();
});
// Marketing
liMarketing.addEventListener('click', function () {
    showHideDropdown();
});

function childMenu(e, sel) {
    e.stopPropagation();
    sel.classList.toggle('group');
    sel.children[0].children[2].classList.toggle('rotate-180');
    sel.children[1].classList.toggle('hidden');
}

//Accounting
liAccounting.addEventListener('click', function () {
    showHideDropdown();
});

//Workshop
liWorkshop.addEventListener('click', function () {
    showHideDropdown();
});

//User
liUser.addEventListener('click', function () {
    showHideDropdown();
});
