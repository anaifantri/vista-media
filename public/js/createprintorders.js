selectVendorAction = (sel) => {
    const vendor = sel.options[sel.selectedIndex].id.split("-");
    const vendorSign = document.querySelectorAll("[id=vendorSign]")
    document.getElementById("vendorAddress").innerHTML = vendor[3];
    document.getElementById("vendorPhone").innerHTML = vendor[4];
    document.getElementById("copyVendorCompany").innerHTML = vendor[2];
    document.getElementById("copyVendorAddress").innerHTML = vendor[3];
    document.getElementById("copyVendorPhone").innerHTML = vendor[4];
    vendorSign[0].innerHTML = vendor[2];
    vendorSign[1].innerHTML = vendor[2];
}