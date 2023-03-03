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
const navMenu = document.querySelector('#nav-menu');

hamburger.addEventListener('click', function () {
    hamburger.classList.toggle('hamburger-active');
    navMenu.classList.toggle('nav-menu-show');
});

// Nav Right - Profile
const profile = document.querySelector('#profile');
const profileChild = document.querySelector('#profileChild');
const profileArrow = document.querySelector('#profileArrow');

profile.addEventListener('click', function () {
    profile.classList.toggle('group');
    profileArrow.classList.toggle('rotate-180');
    profileChild.classList.toggle('opacity-0');
    profileChild.classList.toggle('opacity-100');
});

// Sidebar dropdown
// Media OOH
const media = document.querySelector('#media');
const mediaChild = document.querySelector('#mediaChild');
const mediaArrow = document.querySelector('#mediaArrow');

media.addEventListener('click', function () {
    media.classList.toggle('group');
    mediaArrow.classList.toggle('rotate-180');
    mediaChild.classList.toggle('hidden');
});
// Marketing
const marketing = document.querySelector('#marketing');
const marketingChild = document.querySelector('#marketingChild');
const marketingArrow = document.querySelector('#marketingArrow');

marketing.addEventListener('click', function () {
    marketing.classList.toggle('group');
    marketingArrow.classList.toggle('rotate-180');
    marketingChild.classList.toggle('hidden');
});
// Penawaran
const penawaran = document.querySelector('#penawaran');
const penawaranChild = document.querySelector('#penawaranChild');
const penawaranArrow = document.querySelector('#penawaranArrow');

penawaran.addEventListener('click', function () {
    penawaran.classList.toggle('group');
    penawaranArrow.classList.toggle('rotate-180');
    penawaranChild.classList.toggle('hidden');
});
// Penjualan
const penjualan = document.querySelector('#penjualan');
const penjualanChild = document.querySelector('#penjualanChild');
const penjualanArrow = document.querySelector('#penjualanArrow');

penjualan.addEventListener('click', function () {
    penjualan.classList.toggle('group');
    penjualanArrow.classList.toggle('rotate-180');
    penjualanChild.classList.toggle('hidden');
});
// Penggantian Materi
const materi = document.querySelector('#materi');
const materiChild = document.querySelector('#materiChild');
const materiArrow = document.querySelector('#materiArrow');

materi.addEventListener('click', function () {
    materi.classList.toggle('group');
    materiArrow.classList.toggle('rotate-180');
    materiChild.classList.toggle('hidden');
});
//Accounting
const accounting = document.querySelector('#accounting');
const accountingChild = document.querySelector('#accountingChild');
const accountingArrow = document.querySelector('#accountingArrow');

accounting.addEventListener('click', function () {
    accounting.classList.toggle('group');
    accountingArrow.classList.toggle('rotate-180');
    accountingChild.classList.toggle('hidden');
});
//penagihan
const penagihan = document.querySelector('#penagihan');
const penagihanChild = document.querySelector('#penagihanChild');
const penagihanArrow = document.querySelector('#penagihanArrow');

penagihan.addEventListener('click', function () {
    penagihan.classList.toggle('group');
    penagihanArrow.classList.toggle('rotate-180');
    penagihanChild.classList.toggle('hidden');
});
//ppn
const ppn = document.querySelector('#ppn');
const ppnChild = document.querySelector('#ppnChild');
const ppnArrow = document.querySelector('#ppnArrow');

ppn.addEventListener('click', function () {
    ppn.classList.toggle('group');
    ppnArrow.classList.toggle('rotate-180');
    ppnChild.classList.toggle('hidden');
});
//pph
const pph = document.querySelector('#pph');
const pphChild = document.querySelector('#pphChild');
const pphArrow = document.querySelector('#pphArrow');

pph.addEventListener('click', function () {
    pph.classList.toggle('group');
    pphArrow.classList.toggle('rotate-180');
    pphChild.classList.toggle('hidden');
});
//Workshop
const workshop = document.querySelector('#workshop');
const workshopChild = document.querySelector('#workshopChild');
const workshopArrow = document.querySelector('#workshopArrow');

workshop.addEventListener('click', function () {
    workshop.classList.toggle('group');
    workshopArrow.classList.toggle('rotate-180');
    workshopChild.classList.toggle('hidden');
});
//Monitoring
const monitoring = document.querySelector('#monitoring');
const monitoringChild = document.querySelector('#monitoringChild');
const monitoringArrow = document.querySelector('#monitoringArrow');

monitoring.addEventListener('click', function () {
    monitoring.classList.toggle('group');
    monitoringArrow.classList.toggle('rotate-180');
    monitoringChild.classList.toggle('hidden');
});
//Pasang Gambar
const gambar = document.querySelector('#gambar');
const gambarChild = document.querySelector('#gambarChild');
const gambarArrow = document.querySelector('#gambarArrow');

gambar.addEventListener('click', function () {
    gambar.classList.toggle('group');
    gambarArrow.classList.toggle('rotate-180');
    gambarChild.classList.toggle('hidden');
});
//User
const user = document.querySelector('#user');
const userChild = document.querySelector('#userChild');
const userArrow = document.querySelector('#userArrow');

user.addEventListener('click', function () {
    user.classList.toggle('group');
    userArrow.classList.toggle('rotate-180');
    userChild.classList.toggle('hidden');
});
