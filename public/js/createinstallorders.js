const locationId = document.getElementById("location_id");
const locationCode = document.getElementById("location_code");
const locationSide = document.getElementById("location_side");
const locationAddress = document.getElementById("location_address");
const locationPhoto = document.getElementById("location_photo");
const cityCode = document.getElementById("cityCode");
const side = document.getElementById("side");
const size = document.getElementById("size");
const qty = document.getElementById("qty");
const type = document.getElementById("type");
const product = document.getElementById("product");
const orderType = document.getElementById("orderType");
const sizeWidth = document.getElementById("sizeWidth");
const sizeHeight = document.getElementById("sizeHeight");
const theme = document.getElementById("theme");
const design = document.getElementById("design");
const installAt = document.getElementById("install_at");
const saleId = document.getElementById("sale_id");
const mainSaleId = document.getElementById("main_sale_id");
const saleNumber = document.getElementById("saleNumber");
const orderStatus = document.getElementById("orderStatus");

let objProducts = {
    qty : 0,
    location_id : "",
    location_code : "",
    location_address : "",
    location_lat : "",
    location_lng : "",
    location_category : "",
    location_photo : "",
    city_code : "",
    location_side : "",
    location_size : "",
    location_width : "",
    location_height : "",
    sale_id : "",
    main_sale_id : "",
    sale_number : "",
    order_type : "",
    status : "",
    side_right : false,
    side_left : true
}

if(product.value != ""){
    objProducts = JSON.parse(product.value);
}

themeCheck = () =>{
    if(theme.value == ""){
        alert('Silahkan pilih input tema design terlebih dahulu..!!');
        theme.classList.add("is-invalid");
        theme.focus();
    }else{
        return true;
    }
}

// designCheck = () =>{
//     if(design.files.length == 0){
//         alert('Silahkan pilih file design terlebih dahulu..!!');
//         design.classList.add("is-invalid");
//         design.focus();
//     }else{
//         return true;
//     }
// }

installAtCheck = () =>{
    if(installAt.value == ""){
        alert('Silahkan input tanggal tayang terlebih dahulu..!!');
        installAt.classList.add("is-invalid");
        installAt.focus();
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

getNotes = (sel) =>{
    document.getElementById("notesCopy").value = sel.value;
}

getTheme = (sel) =>{
    document.getElementById("themeCopy").value = sel.value;
}

getInstallAt = (sel) =>{
    document.getElementById("installAt").value = sel.value;
}


cbRightAction = (sel) =>{
    if(sel.checked == true){
        if(document.getElementById("cbLeft").checked == false){
            qty.value = document.getElementById("location_qty").value * 1;
            qtyCopy.value = document.getElementById("location_qty").value * 1;
            document.getElementById("cbRightCopy").checked = sel.checked;
        }else{
            qty.value = document.getElementById("location_qty").value * 2;
            qtyCopy.value = document.getElementById("location_qty").value * 2;
            document.getElementById("cbRightCopy").checked = sel.checked;
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
        }
    }
}

cbLeftAction = (sel) =>{
    if(sel.checked == true){
        if(document.getElementById("cbRight").checked == false){
            qty.value = document.getElementById("location_qty").value * 1;
            qtyCopy.value = document.getElementById("location_qty").value * 1;
            document.getElementById("cbLeftCopy").checked = sel.checked;
        }else{
            qty.value = document.getElementById("location_qty").value * 2;
            qtyCopy.value = document.getElementById("location_qty").value * 2;
            document.getElementById("cbLeftCopy").checked = sel.checked;
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
        }
    }
}

fillData = () =>{
    if(themeCheck() == true && installAtCheck() == true){
        if(confirm('Apakah anda yakin data yang diinput sudah benar?')){
            objProducts.sale_id = saleId.value;
            objProducts.main_sale_id = mainSaleId.value;
            objProducts.sale_number = saleNumber.innerText;
            objProducts.location_width = sizeWidth.value;
            objProducts.location_height = sizeHeight.value;
            objProducts.location_side = locationSide.value;
            objProducts.location_size = size.value;
            objProducts.location_id = locationId.value;
            objProducts.location_code = locationCode.value;
            objProducts.location_address = locationAddress.value;
            objProducts.location_lat = document.getElementById("location_lat").value;
            objProducts.location_lng = document.getElementById("location_lng").value;
            objProducts.location_category = document.getElementById("location_category").value;
            objProducts.location_photo = locationPhoto.value;
            objProducts.city_code = cityCode.value;
            objProducts.qty = qty.value;
            objProducts.order_type = orderType.value;
            objProducts.status = orderStatus.value;
            objProducts.side_left = document.getElementById("cbLeft").checked;
            objProducts.side_right = document.getElementById("cbRight").checked;
            product.value = JSON.stringify(objProducts);
        }else{
            return false;
        }
    }else{
        return false;
    }
}