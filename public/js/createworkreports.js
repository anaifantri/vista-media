const formSelectSale = document.getElementById("formSelectSale");
let saleId = "";

getMediaSales = (sel) => {
    getSale = JSON.parse(sel.value);
    saleId = getSale.id;
    saleProduct = JSON.parse(getSale.product);
    if(category == "Service"){
        if(saleProduct.type == "new"){
            mainSaleId = saleId;
        }else{
            mainSaleId = saleProduct.sale_id;
        }
        console.log(saleId);
    }else{
        mainSaleId = 0;
    }
    formSelectSale.setAttribute('action', '/work-reports/select-documentation/' + saleId + '/' + mainSaleId + '/' + category);
}

// Function Modal Sale Start
saleNext = () =>{
    if(saleId == ""){
        alert("Silahkan pilih penjualan terlebih dahulu..!!");
    }else{
        formSelectSale.submit();
    }
}
// Function Modal Sale end

// Function Modal Preview start
previewMediaBack = () =>{
    document.getElementById("modalPreview").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectTerm").removeAttribute('hidden');
    document.getElementById("divButton").classList.remove('flex');
    document.getElementById("divButton").classList.add('hidden');
    saleHeader.classList.remove('hidden');
    saleHeader.classList.add('flex');
}
previewServiceBack = () =>{
    document.getElementById("modalPreview").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectSale").removeAttribute('hidden');
    document.getElementById("divButton").classList.remove('flex');
    document.getElementById("divButton").classList.add('hidden');
    saleHeader.classList.remove('flex');
    saleHeader.classList.add('hidden');
}
// Function Modal Preview end


// Search Table --> start
function searchTable() {
    const search = document.getElementById("search");
    const salesTable = document.getElementById("salesTable");
    var filter, tr, td, i, found, tdText;
    filter = search.value.toUpperCase();
    tr = salesTable.getElementsByTagName("tr");
    for (i = 2; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            tdText = tr[i].getElementsByTagName("td")[j];
            if (tdText.innerText.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found == true) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
// Search Table --> end