const tdCreate = document.querySelectorAll("[id=tdCreate]");
const btnCreate = document.getElementById("btnCreate");
const orderType = document.getElementById("orderType");
let locationId = "";

getLocation = (sel) =>{
    locationId = sel.value;
}

orderCreate = () =>{
    if (locationId == "") {
        alert("Silahkan pilih lokasi terlebih dahulu...!!")
    } else {
        if(orderType.value == "free" || orderType.value == "sale"){
            btnCreate.setAttribute('href', '/print-orders/create-order/' + locationId +'/sale');
        }else{
            btnCreate.setAttribute('href', '/print-orders/create-order/' + locationId +'/location');
        }
        
        btnCreate.click();
    }
}