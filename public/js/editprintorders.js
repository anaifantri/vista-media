
const vendorId = document.getElementById("vendorId");
const vendorAddress = document.querySelectorAll("[id=vendorAddress]");
const vendorPhone = document.querySelectorAll("[id=vendorPhone]");
const product = document.getElementById("product");
const productSelect = document.getElementById("productSelect");
const productType = document.getElementById("productType");
const productPrice = document.getElementById("productPrice");
const notes = document.getElementById("notes");
const price = document.getElementById("price");
const companyTotal = document.getElementById("companyTotal");
const companyProductName = document.getElementById("companyProductName");
const companyProductPrice = document.getElementById("companyProductPrice");
const qty = document.getElementById("qty");
const sizeWidth = document.getElementById("sizeWidth");
const sizeHeight = document.getElementById("sizeHeight");
const theme = document.getElementById("theme");

let objProducts = JSON.parse(product.value);

let objNotes = JSON.parse(notes.value);


getVendor = (sel) =>{
    const vendorData = sel.options[sel.selectedIndex].id.split("-");
    const url = "/get-printing-prices/"+sel.value+"/"+productType.value;

    for(let i = 0; i < vendorAddress.length; i++){
        vendorAddress[i].innerHTML = vendorData[0];
        vendorPhone[i].innerHTML = vendorData[1];
    }

    fetch(url)
    .then(response => response.json())
    .then(printingPrices => {
        var productName = "";
        var productId = "";
        while (productSelect.hasChildNodes()) {
            productSelect.removeChild(productSelect.firstChild);
        }
        printingPrices.printingPrices.forEach(printingPrice => {
            printingPrices.printingProducts.forEach(printingProduct => {
                if(printingProduct.id == printingPrice.printing_product_id){
                    productName = printingProduct.name;
                    productId = printingProduct.id;
                }
            });
            let option = document.createElement('option');
            option.setAttribute('id', productId);
            option.value = printingPrice.price;
            option.textContent = productName;
            productSelect.appendChild(option);
        });
        productPrice.value = productSelect.value;
        companyProductPrice.innerHTML = productSelect.value;
        companyProductName.innerHTML = productSelect.text;
        countTotal();
    })
    .catch(error => {
        console.error('Error fetching printingPrices:', error);
    });
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
    var getWide = qty.value * sizeWidth.value * sizeHeight.value;
    var getTotal = getWide * productPrice.value;

    price.value = Number(getTotal);
    companyTotal.innerHTML = getTotal;
    
}

getPrintProduct = (sel) =>{
    productPrice.value = sel.value;
    companyProductPrice.innerHTML = sel.value;
    companyProductName.innerHTML = sel.options[sel.selectedIndex].text;
    objProducts.product_id = sel.options[sel.selectedIndex].id;
    objProducts.product_name = sel.options[sel.selectedIndex].text;
    objProducts.product_price = Number(sel.options[sel.selectedIndex].value);
    countTotal();
    product.value = JSON.stringify(objProducts);
}

getFinishing = (sel) =>{
    document.getElementById("companyFinishing").innerHTML = sel.value;
    objNotes.finishing = sel.value;
    notes.value = JSON.stringify(objNotes);
}

getNotes = (sel) =>{
    document.getElementById("companyNotes").innerHTML = sel.value;
    objNotes.note = sel.value;
    notes.value = JSON.stringify(objNotes);
}

getTheme = (sel) =>{
    document.getElementById("companyDesign").innerHTML = sel.value;
}

cbRightAction = (sel) =>{
    if(sel.checked == true){
        if(document.getElementById("cbLeft").checked == false){
            qty.value = document.getElementById("location_qty").value * 1;
            qtyCopy.innerHTML = document.getElementById("location_qty").value * 1;
            document.getElementById("cbRightCopy").checked = sel.checked;
            countTotal();
        }else{
            qty.value = document.getElementById("location_qty").value * 2;
            qtyCopy.innerHTML = document.getElementById("location_qty").value * 2;
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
            qtyCopy.innerHTML = document.getElementById("location_qty").value * 1;
            document.getElementById("cbRightCopy").checked = sel.checked;
            countTotal();
        }
    }
}

cbLeftAction = (sel) =>{
    if(sel.checked == true){
        if(document.getElementById("cbRight").checked == false){
            qty.value = document.getElementById("location_qty").value * 1;
            qtyCopy.innerHTML = document.getElementById("location_qty").value * 1;
            document.getElementById("cbLeftCopy").checked = sel.checked;
            countTotal();
        }else{
            qty.value = document.getElementById("location_qty").value * 2;
            qtyCopy.innerHTML = document.getElementById("location_qty").value * 2;
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
            qtyCopy.innerHTML = document.getElementById("location_qty").value * 1;
            document.getElementById("cbLeftCopy").checked = sel.checked;
            countTotal();
        }
    }
}

finishingCheck = () =>{
    if(finishing.value == ""){
        alert('Silahkan input finishing terlebih dahulu..!!');
        finishing.classList.add("is-invalid");
        finishing.focus();
    }else{
        return true;
    }
}

themeCheck = () =>{
    if(theme.value == ""){
        alert('Silahkan input tema design terlebih dahulu..!!');
        theme.classList.add("is-invalid");
        theme.focus();
    }else{
        return true;
    }
}

fillData = () =>{
    if(themeCheck() == true && finishingCheck() == true){
        if(confirm('Apakah anda yakin data yang diinput sudah benar?')){
            objProducts.qty = qty.value;
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
