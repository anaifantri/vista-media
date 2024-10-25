// const qty = document.getElementById("qty");
// const qtyCopy = document.getElementById("qtyCopy");
// const size = document.getElementById("size");
// const sizeWidth = document.getElementById("sizeWidth");
// const sizeHeight = document.getElementById("sizeHeight");
// const vendorId = document.getElementById("vendorId");
// const selectProduct = document.getElementById("selectProduct");
// const inputFinishing = document.getElementById("inputFinishing");
// const inputTheme = document.getElementById("inputTheme");
// const inputDesign = document.getElementById("inputDesign");
// const design = document.getElementById("design");
// const price = document.getElementById("price");
// const orderStatus = document.getElementById("orderStatus");

// let objProducts = {
//     product_id : "",
//     product_type : "",
//     product_name : "",
//     product_price : 0,
//     vendor_id : "",
//     vendor_company : "",
//     vendor_address : "",
//     vendor_phone : "",
//     location_id : "",
//     location_code : "",
//     city_code : "",
//     location_side : "",
//     location_size : "",
//     location_width : "",
//     location_height : "",
//     sale_id : "",
//     sale_number : "",
//     order_type : "",
//     status : ""
// }

// let objNotes = {
//     finishing : "",
//     note : "",
// }

// vendorCheck = () =>{
//     if(vendorId.value == "pilih"){
//         alert('Silahkan pilih vendor terlebih dahulu..!!');
//         vendorId.classList.add("is-invalid");
//         vendorId.focus();
//     }else{
//         return true;
//     }
// }

// productCheck = () =>{
//     if(selectProduct.value == "pilih"){
//         alert('Silahkan pilih bahan cetak terlebih dahulu..!!');
//         selectProduct.classList.add("is-invalid");
//         selectProduct.focus();
//     }else{
//         return true;
//     }
// }

// finishingCheck = () =>{
//     if(inputFinishing.value == ""){
//         alert('Silahkan pilih input finishing terlebih dahulu..!!');
//         inputFinishing.classList.add("is-invalid");
//         inputFinishing.focus();
//     }else{
//         return true;
//     }
// }

// themeCheck = () =>{
//     if(inputTheme.value == ""){
//         alert('Silahkan pilih input tema design terlebih dahulu..!!');
//         inputTheme.classList.add("is-invalid");
//         inputTheme.focus();
//     }else{
//         return true;
//     }
// }

// designCheck = () =>{
//     if(inputDesign.files.length == 0){
//         alert('Silahkan pilih pilih file design terlebih dahulu..!!');
//         inputDesign.classList.add("is-invalid");
//         inputDesign.focus();
//     }else{
//         return true;
//     }
// }

printOrderRadio = (sel) =>{
    const selectPrint = document.getElementById("selectPrint");
    if(sel.value == "yes"){
        selectPrint.removeAttribute('disabled');
    }else{
        selectPrint.setAttribute('disabled', 'disabled');
        selectPrint.options.selectedIndex = 0;
    }
}

function previewImage(sel) {
    const imgPreview = document.querySelector('.img-preview');

    // imgPreview.style.display = 'block';

    const oFReader = new FileReader();

    oFReader.readAsDataURL(sel.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
    design.files = sel.files;
    console.log(design.value);
}

// countTotal = () =>{
//     const productPrice =document.getElementById("productPrice");
//     const total = document.getElementById("total");
//     const totalCopy = document.getElementById("totalCopy");

//     var getWide = qty.value * sizeWidth.value * sizeHeight.value;
//     var getTotal = getWide * productPrice.value;

//     total.value = getTotal;
//     totalCopy.value = getTotal;
//     price.value = getTotal;
//     document.getElementById("totalPreview").innerHTML = getTotal.toLocaleString();
//     document.getElementById("copyTotalPreview").innerHTML = getTotal.toLocaleString();
    
// }

// if(vendorId.value != "pilih"){
//     const inputVendorId = document.getElementById("vendor_id");
//     document.getElementById("vendorSign").innerHTML = vendorId.options[vendorId.selectedIndex].text;
//     document.getElementById("vendorSignPreview").innerHTML = vendorId.options[vendorId.selectedIndex].text;
//     document.getElementById("vendorSignCopy").innerHTML = vendorId.options[vendorId.selectedIndex].text;
//     document.getElementById("vendorSignCopyPreview").innerHTML = vendorId.options[vendorId.selectedIndex].text;
//     inputVendorId.value = vendorId.value;
//     objProducts.vendor_id = vendorId.value;
//     objProducts.vendor_address = document.getElementById("vendorAddress").value;
//     objProducts.vendor_phone = document.getElementById("vendorPhone").innerText;
//     objProducts.vendor_company = vendorId.options[vendorId.selectedIndex].text;
// }

// getPrintProduct = (sel) =>{
//     if(sel.value != "pilih"){
//         document.getElementById("copyProduct").value = sel.options[sel.selectedIndex].text;
//         document.getElementById("copyProductPreview").innerHTML = sel.options[sel.selectedIndex].text;
//         document.getElementById("productPreview").innerHTML = sel.options[sel.selectedIndex].text;
//         document.getElementById("productPrice").value = sel.options[sel.selectedIndex].value;
//         document.getElementById("pricePreview").innerHTML = Number(sel.options[sel.selectedIndex].value).toLocaleString();
//         document.getElementById("copyPrice").value = sel.options[sel.selectedIndex].value;
//         document.getElementById("copyPricePreview").innerHTML = Number(sel.options[sel.selectedIndex].value).toLocaleString();
//         objProducts.product_id = sel.options[sel.selectedIndex].id;
//         objProducts.product_name = sel.options[sel.selectedIndex].text;
//         objProducts.product_price = Number(sel.options[sel.selectedIndex].value);
//         objProducts.product_type = document.getElementById("productType").value;
//         countTotal();
//     }
// }

// getFinishing = (sel) =>{
//     document.getElementById("copyFinishing").value = sel.value;
//     document.getElementById("finishingPreview").innerHTML = sel.value;
//     document.getElementById("copyFinishingPreview").innerHTML = sel.value;
//     objNotes.finishing = sel.value;
// }

// getNotes = (sel) =>{
//     document.getElementById("copyNotes").value = sel.value;
//     document.getElementById("notesPreview").innerHTML = sel.value;
//     document.getElementById("copyNotesPreview").innerHTML = sel.value;
//     objNotes.note = sel.value;
// }

// getDesign = (sel) =>{
//     document.getElementById("copyDesign").value = sel.value;
//     document.getElementById("designPreview").innerHTML = sel.value;
//     document.getElementById("copyDesignPreview").innerHTML = sel.value;
//     document.getElementById("theme").value = sel.value;
// }

// cbRightAction = (sel) =>{
//     if(sel.checked == true){
//         if(document.getElementById("cbLeft").checked == false){
//             qty.value = 1;
//             qtyCopy.value = 1;
//             document.getElementById("cbRightCopy").checked = sel.checked;
//             countTotal();
//         }else{
//             qty.value = 2;
//             qtyCopy.value = 2;
//             document.getElementById("cbRightCopy").checked = sel.checked;
//             countTotal();
//         }

//     }else{
//         if(document.getElementById("cbLeft").checked == false){
//             alert('Pilih salah satu sisi atau pilih kedua sisi..!!');
//             sel.checked = true;
//             document.getElementById("cbRightCopy").checked = sel.checked;
//         }else{
//             qty.value = 1;
//             qtyCopy.value = 1;
//             document.getElementById("cbRightCopy").checked = sel.checked;
//             countTotal();
//         }
//     }
// }

// cbLeftAction = (sel) =>{
//     if(sel.checked == true){
//         if(document.getElementById("cbRight").checked == false){
//             qty.value = 1;
//             qtyCopy.value = 1;
//             document.getElementById("cbLeftCopy").checked = sel.checked;
//             countTotal();
//         }else{
//             qty.value = 2;
//             qtyCopy.value = 2;
//             document.getElementById("cbLeftCopy").checked = sel.checked;
//             countTotal();
//         }

//     }else{
//         if(document.getElementById("cbRight").checked == false){
//             alert('Pilih salah satu sisi atau pilih kedua sisi..!!');
//             sel.checked = true;
//             document.getElementById("cbLeftCopy").checked = sel.checked;
//         }else{
//             qty.value = 1;
//             qtyCopy.value = 1;
//             document.getElementById("cbLeftCopy").checked = sel.checked;
//             countTotal();
//         }
//     }
// }

// btnPreviewAction = () =>{
//     if(vendorCheck() == true && productCheck() == true && themeCheck() == true && designCheck() == true && finishingCheck() == true){
//         fillPreviewData();
//         document.getElementById("modalPreview").classList.remove("hidden");
//         document.getElementById("modalPreview").classList.add("flex");
//     }
// }

// fillPreviewData = () =>{
//     document.getElementById("qtyPreview").innerHTML = qty.value + " Lembar";
//     document.getElementById("copyQtyPreview").innerHTML = qty.value + " Lembar";
//     objProducts.sale_id = document.getElementById("sale_id").value;
//     objProducts.sale_number = document.getElementById("thSaleNumber").innerText;
//     objProducts.location_width = sizeWidth.value;
//     objProducts.location_height = sizeHeight.value;
//     objProducts.location_side = qty.value;
//     objProducts.location_size = size.value;
//     objProducts.location_id = document.getElementById("location_id").value;
//     objProducts.location_code = document.getElementById("location_code").value;
//     objProducts.city_code = document.getElementById("cityCode").value;
//     objProducts.order_type = document.getElementById("orderType").value;
//     objProducts.status = orderStatus.value;
//     document.getElementById("product").value = JSON.stringify(objProducts);
//     document.getElementById("notes").value = JSON.stringify(objNotes);
// }

// Button Close Action --> start
// btnClose.addEventListener("click", function(){
//     modalPreview.classList.add("hidden");
//     modalPreview.classList.remove("flex");
// })
// Button Close Action --> end