const tdCreate = document.querySelectorAll("[id=tdCreate]");
const btnCreate = document.getElementById("btnCreate");
const orderType = document.getElementById("orderType");
let locationId = "";

getLocation = (sel) => {
    locationId = sel.value;
};

orderCreate = () => {
    if (locationId == "") {
        alert("Silahkan pilih lokasi terlebih dahulu...!!");
    } else {
        if(orderType.value == "free"){
            btnCreate.setAttribute("href", "/install-orders/create-order/" + locationId + "/free");
        }else if (orderType.value == "sales") {
            btnCreate.setAttribute("href", "/install-orders/create-order/" + locationId + "/sales");
        } else {
            btnCreate.setAttribute("href", "/install-orders/create-order/" + locationId + "/location");
        }

        btnCreate.click();
    }
};
