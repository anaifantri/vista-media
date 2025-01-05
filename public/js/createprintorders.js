const qty = document.getElementById("qty");
const qtyCopy = document.getElementById("qtyCopy");
const size = document.getElementById("size");
const sizeWidth = document.getElementById("sizeWidth");
const sizeHeight = document.getElementById("sizeHeight");
const vendorId = document.getElementById("vendorId");
const selectProduct = document.getElementById("selectProduct");
const inputFinishing = document.getElementById("inputFinishing");
const inputTheme = document.getElementById("inputTheme");
const design = document.getElementById("design");
const price = document.getElementById("price");
const orderStatus = document.getElementById("orderStatus");
const product = document.getElementById("product");
const notes = document.getElementById("notes");

let objProducts = {
    product_id : "",
    product_type : "",
    product_name : "",
    product_price : 0,
    vendor_id : "",
    vendor_company : "",
    vendor_address : "",
    vendor_phone : "",
    location_id : "",
    location_code : "",
    city_code : "",
    location_side : "",
    location_qty : "",
    location_address : "",
    location_lat : "",
    location_lng : "",
    location_size : "",
    location_width : "",
    location_height : "",
    sale_id : "",
    main_sale_id : "",
    sale_number : "",
    order_type : "",
    status : "",
    qty : 0,
    side_right : false,
    side_left : true
}

let objNotes = {
    finishing : "",
    note : "",
}

if(product.value != ""){
    objProducts = JSON.parse(product.value);
    if(objProducts.side_left == false){
        document.getElementById("cbLeft").checked = false;
        document.getElementById("cbLeftCopy").checked = false;
    }
    if(objProducts.side_right == false){
        document.getElementById("cbRight").checked = false;
        document.getElementById("cbRightCopy").checked = false;
    }
}

if(notes.value != ""){
    objNotes = JSON.parse(notes.value);
}

vendorCheck = () =>{
    if(vendorId.value == "pilih"){
        alert('Silahkan pilih vendor terlebih dahulu..!!');
        vendorId.classList.add("is-invalid");
        vendorId.focus();
    }else{
        return true;
    }
}

productCheck = () =>{
    if(selectProduct.value == "pilih"){
        alert('Silahkan pilih bahan cetak terlebih dahulu..!!');
        selectProduct.classList.add("is-invalid");
        selectProduct.focus();
    }else{
        return true;
    }
}

finishingCheck = () =>{
    if(inputFinishing.value == ""){
        alert('Silahkan input finishing terlebih dahulu..!!');
        inputFinishing.classList.add("is-invalid");
        inputFinishing.focus();
    }else{
        return true;
    }
}

themeCheck = () =>{
    if(inputTheme.value == ""){
        alert('Silahkan input tema design terlebih dahulu..!!');
        inputTheme.classList.add("is-invalid");
        inputTheme.focus();
    }else{
        return true;
    }
}

designCheck = () =>{
    if(design.files.length == 0){
        alert('Silahkan pilih pilih file design terlebih dahulu..!!');
        design.classList.add("is-invalid");
        design.focus();
    }else{
        return true;
    }
}

function previewImage(sel) {
    const imgPreview = document.querySelector('.img-preview');
    const imgPreviewCopy = document.querySelector('.img-preview-copy');

    const oFReader = new FileReader();

    oFReader.readAsDataURL(sel.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
        imgPreviewCopy.src = oFREvent.target.result;
    }
}

countTotal = () =>{
    const productPrice =document.getElementById("productPrice");
    const total = document.getElementById("total");
    const totalCopy = document.getElementById("totalCopy");

    var getWide = qty.value * sizeWidth.value * sizeHeight.value;
    var getTotal = getWide * productPrice.value;

    total.value = getTotal;
    totalCopy.value = getTotal;
    price.value = getTotal;
    
}

if(vendorId.value != "pilih"){
    const inputVendorId = document.getElementById("vendor_id");
    document.getElementById("vendorSign").innerHTML = vendorId.options[vendorId.selectedIndex].text;
    document.getElementById("vendorSignCopy").innerHTML = vendorId.options[vendorId.selectedIndex].text;
    inputVendorId.value = vendorId.value;
    objProducts.vendor_id = vendorId.value;
    objProducts.vendor_address = document.getElementById("vendorAddress").value;
    objProducts.vendor_phone = document.getElementById("vendorPhone").innerText;
    objProducts.vendor_company = vendorId.options[vendorId.selectedIndex].text;
}

getPrintProduct = (sel) =>{
    if(sel.value != "pilih"){
        document.getElementById("copyProduct").value = sel.options[sel.selectedIndex].text;
        document.getElementById("productPrice").value = sel.options[sel.selectedIndex].value;
        document.getElementById("copyPrice").value = sel.options[sel.selectedIndex].value;
        objProducts.product_id = sel.options[sel.selectedIndex].id;
        objProducts.product_name = sel.options[sel.selectedIndex].text;
        objProducts.product_price = Number(sel.options[sel.selectedIndex].value);
        objProducts.product_type = document.getElementById("productType").value;
        countTotal();
    }else{
        document.getElementById("copyProduct").value = "";
        document.getElementById("productPrice").value = "";
        document.getElementById("copyPrice").value = "";
        objProducts.product_id = "";
        objProducts.product_name = "";
        objProducts.product_price = "";
        objProducts.product_type = "";
        countTotal();
    }
}

getFinishing = (sel) =>{
    document.getElementById("copyFinishing").value = sel.value;
    objNotes.finishing = sel.value;
}

getNotes = (sel) =>{
    document.getElementById("copyNotes").value = sel.value;
    objNotes.note = sel.value;
}

getDesign = (sel) =>{
    document.getElementById("copyDesign").value = sel.value;
    document.getElementById("theme").value = sel.value;
}

cbRightAction = (sel) =>{
    if(sel.checked == true){
        if(document.getElementById("cbLeft").checked == false){
            qty.value = document.getElementById("location_qty").value * 1;
            qtyCopy.value = document.getElementById("location_qty").value * 1;
            document.getElementById("cbRightCopy").checked = sel.checked;
            countTotal();
        }else{
            qty.value = document.getElementById("location_qty").value * 2;
            qtyCopy.value = document.getElementById("location_qty").value * 2;
            document.getElementById("cbRightCopy").checked = sel.checked;
            countTotal();
        }

    }else{
        if(document.getElementById("cbLeft").checked == false){
            alert('Pilih salah satu sisi atau pilih kedua sisi..!!');
            sel.checked = true;
            document.getElementById("cbRightCopy").checked = sel.checked;
        }else{
            qty.value = document.getElementById("location_qty").value * 1;
            qtyCopy.value = document.getElementById("location_qty").value * 1;
            document.getElementById("cbRightCopy").checked = sel.checked;
            countTotal();
        }
    }
}

cbLeftAction = (sel) =>{
    if(sel.checked == true){
        if(document.getElementById("cbRight").checked == false){
            qty.value = document.getElementById("location_qty").value * 1;
            qtyCopy.value = document.getElementById("location_qty").value * 1;
            document.getElementById("cbLeftCopy").checked = sel.checked;
            countTotal();
        }else{
            qty.value = document.getElementById("location_qty").value * 2;
            qtyCopy.value = document.getElementById("location_qty").value * 2;
            document.getElementById("cbLeftCopy").checked = sel.checked;
            countTotal();
        }

    }else{
        if(document.getElementById("cbRight").checked == false){
            alert('Pilih salah satu sisi atau pilih kedua sisi..!!');
            sel.checked = true;
            document.getElementById("cbLeftCopy").checked = sel.checked;
        }else{
            qty.value = document.getElementById("location_qty").value * 1;
            qtyCopy.value = document.getElementById("location_qty").value * 1;
            document.getElementById("cbLeftCopy").checked = sel.checked;
            countTotal();
        }
    }
}

fillData = () =>{
    if(vendorCheck() == true && productCheck() == true && themeCheck() == true && designCheck() == true && finishingCheck() == true){
        if(confirm('Apakah anda yakin data yang diinput sudah benar?')){
            objProducts.sale_id = document.getElementById("sale_id").value;
            objProducts.sale_number = document.getElementById("thSaleNumber").innerText;
            objProducts.location_width = sizeWidth.value;
            objProducts.location_height = sizeHeight.value;
            objProducts.location_side = document.getElementById("location_side").value;
            objProducts.location_size = size.value;
            objProducts.location_id = document.getElementById("location_id").value;
            objProducts.location_qty = document.getElementById("location_qty").value;
            objProducts.location_address = document.getElementById("location_address").value;
            objProducts.location_lat = document.getElementById("location_lat").value;
            objProducts.location_lng = document.getElementById("location_lng").value;
            objProducts.location_category = document.getElementById("location_category").value;
            objProducts.location_code = document.getElementById("location_code").value;
            objProducts.city_code = document.getElementById("cityCode").value;
            objProducts.order_type = document.getElementById("orderType").value;
            objProducts.status = orderStatus.value;
            objProducts.qty = qty.value;
            objProducts.main_sale_id = document.getElementById("main_sale_id").value;
            objProducts.side_left = document.getElementById("cbLeft").checked;
            objProducts.side_right = document.getElementById("cbRight").checked;
            product.value = JSON.stringify(objProducts);
            notes.value = JSON.stringify(objNotes);
        }else{
            return false;
        }
    }else{
        return false;
    }
}

formVendorSubmit = (sel) =>{
    document.getElementById("vendorID").value = sel.value;
    document.getElementById("formVendor").submit();
}