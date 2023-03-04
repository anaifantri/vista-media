const failAllert = document.getElementById("failAllert");
const btAllert = document.getElementById("btAllert");

btAllert.addEventListener('click', function () {
    failAllert.classList.add('hidden');
})