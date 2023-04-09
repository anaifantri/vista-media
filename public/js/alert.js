const failAlert = document.getElementById("failAlert");
const btAlert = document.getElementById("btAlert");

btAlert.addEventListener('click', function () {
    failAlert.classList.add('hidden');
})