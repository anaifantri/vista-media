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
const penawaranArrow = document.querySelector('#penawaranArrow');
const penjualanArrow = document.querySelector('#penjualanArrow');
const materiArrow = document.querySelector('#materiArrow');
const accountingArrow = document.querySelector('#accountingArrow');
const penagihanArrow = document.querySelector('#penagihanArrow');
const ppnArrow = document.querySelector('#ppnArrow');
const pphArrow = document.querySelector('#pphArrow');
const workshopArrow = document.querySelector('#workshopArrow');
const monitoringArrow = document.querySelector('#monitoringArrow');
const gambarArrow = document.querySelector('#gambarArrow');
const userArrow = document.querySelector('#userArrow');

hamburger.addEventListener('click', function () {
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
});

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
// Media OOH
liMedia.addEventListener('click', function () {
    liMedia.classList.toggle('group');
    mediaArrow.classList.toggle('rotate-180');
    mediaChild.classList.toggle('hidden');
});
// Marketing
liMarketing.addEventListener('click', function () {
    liMarketing.classList.toggle('group');
    marketingArrow.classList.toggle('rotate-180');
    marketingChild.classList.toggle('hidden');
});
// Penawaran
const penawaran = document.querySelector('#penawaran');
const penawaranChild = document.querySelector('#penawaranChild');

penawaran.addEventListener('click', function () {
    penawaran.classList.toggle('group');
    penawaranArrow.classList.toggle('rotate-180');
    penawaranChild.classList.toggle('hidden');
});
// Penjualan
const penjualan = document.querySelector('#penjualan');
const penjualanChild = document.querySelector('#penjualanChild');

penjualan.addEventListener('click', function () {
    penjualan.classList.toggle('group');
    penjualanArrow.classList.toggle('rotate-180');
    penjualanChild.classList.toggle('hidden');
});
// Penggantian Materi
const materi = document.querySelector('#materi');
const materiChild = document.querySelector('#materiChild');

materi.addEventListener('click', function () {
    materi.classList.toggle('group');
    materiArrow.classList.toggle('rotate-180');
    materiChild.classList.toggle('hidden');
});
//Accounting
liAccounting.addEventListener('click', function () {
    liAccounting.classList.toggle('group');
    accountingArrow.classList.toggle('rotate-180');
    accountingChild.classList.toggle('hidden');
});
//penagihan
const penagihan = document.querySelector('#penagihan');
const penagihanChild = document.querySelector('#penagihanChild');

penagihan.addEventListener('click', function () {
    penagihan.classList.toggle('group');
    penagihanArrow.classList.toggle('rotate-180');
    penagihanChild.classList.toggle('hidden');
});
//ppn
const ppn = document.querySelector('#ppn');
const ppnChild = document.querySelector('#ppnChild');

ppn.addEventListener('click', function () {
    ppn.classList.toggle('group');
    ppnArrow.classList.toggle('rotate-180');
    ppnChild.classList.toggle('hidden');
});
//pph
const pph = document.querySelector('#pph');
const pphChild = document.querySelector('#pphChild');

pph.addEventListener('click', function () {
    pph.classList.toggle('group');
    pphArrow.classList.toggle('rotate-180');
    pphChild.classList.toggle('hidden');
});
//Workshop
liWorkshop.addEventListener('click', function () {
    liWorkshop.classList.toggle('group');
    workshopArrow.classList.toggle('rotate-180');
    workshopChild.classList.toggle('hidden');
});
//Monitoring
const monitoring = document.querySelector('#monitoring');
const monitoringChild = document.querySelector('#monitoringChild');

monitoring.addEventListener('click', function () {
    monitoring.classList.toggle('group');
    monitoringArrow.classList.toggle('rotate-180');
    monitoringChild.classList.toggle('hidden');
});
//Pasang Gambar
const gambar = document.querySelector('#gambar');
const gambarChild = document.querySelector('#gambarChild');

gambar.addEventListener('click', function () {
    gambar.classList.toggle('group');
    gambarArrow.classList.toggle('rotate-180');
    gambarChild.classList.toggle('hidden');
});
//User
liUser.addEventListener('click', function () {
    liUser.classList.toggle('group');
    userArrow.classList.toggle('rotate-180');
    userChild.classList.toggle('hidden');
});
