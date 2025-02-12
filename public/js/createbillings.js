// Function Modal Sale Start
saleNext = () =>{
    if(Object.keys(sale).length == 0){
        alert("Silahkan pilih data penjualan terlebih dahulu");
    }else{
        const month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const divTerms = document.getElementById("divTerms");
        const nodeTerm = document.getElementById("nodeTerm");
        const saleDetail = document.getElementById("saleDetail");
        const quotationDetail = document.getElementById("quotationDetail");
        document.getElementById("modalSelectSale").setAttribute('hidden', 'hidden');
        document.getElementById("modalSelectTerm").removeAttribute('hidden');
        var product = JSON.parse(sale.product);
        var saleDate = new Date(sale.created_at);
        var quotationDate = new Date(quotationDeal.created_at);

        saleDetail.children[0].children[2].innerHTML = sale.number;
        saleDetail.children[1].children[2].innerHTML = saleDate.getDate() + ' ' + month[saleDate.getMonth()] + ' ' + saleDate.getFullYear();
        saleDetail.children[2].children[2].innerHTML = product.category;
        saleDetail.children[3].children[2].innerHTML = product.code + '-' + product.city_code + ' | ' +  product.address;
        saleDetail.children[4].children[2].innerHTML = 'Rp. ' + sale.price.toLocaleString() + ',-';
        saleDetail.children[0].children[2].innerHTML = sale.number;

        quotationDetail.children[0].children[2].innerHTML = quotationDeal.number;
        quotationDetail.children[1].children[2].innerHTML = quotationDate.getDate() + ' ' + month[quotationDate.getMonth()] + ' ' + quotationDate.getFullYear();
        quotationDetail.children[2].children[2].innerHTML = client.name;
        quotationDetail.children[3].children[2].innerHTML = client.company;

        
        while (divTerms.hasChildNodes()) {
            divTerms.removeChild(divTerms.firstChild);
        }
        for(let i = 0; i < terms.length; i++){
            var node = nodeTerm.cloneNode(true);
            var termNominal = terms[i].term / 100 * sale.price;
            node.children[0].innerHTML = "Tahap " + (i+1) + " : " + terms[i].term + "% x " + sale.price.toLocaleString();
            node.children[1].innerHTML = " = ";
            node.children[2].innerHTML = "Rp. " + termNominal.toLocaleString() + ",-";
            divTerms.appendChild(node);
        }
    }
}
// Function Modal Sale end

// Function Modal Term start
termNext = () =>{
    document.getElementById("modalSelectTerm").setAttribute('hidden', 'hidden');
    document.getElementById("modalInputFaktur").removeAttribute('hidden');
}
termBack = () =>{
    document.getElementById("modalSelectTerm").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectSale").removeAttribute('hidden');
}
// Function Modal Term end

// Function Modal Faktur start
fakturNext = () =>{
    document.getElementById("modalInputFaktur").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectDocuments").removeAttribute('hidden');
}
fakturBack = () =>{
    document.getElementById("modalInputFaktur").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectTerm").removeAttribute('hidden');
}
// Function Modal Faktur end

// Function Modal Documents start
documentNext = () =>{
    document.getElementById("modalSelectDocuments").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectDocumentation").removeAttribute('hidden');
}
documentBack = () =>{
    document.getElementById("modalSelectDocuments").setAttribute('hidden', 'hidden');
    document.getElementById("modalInputFaktur").removeAttribute('hidden');
}
// Function Modal Documents end

// Function Modal Documentation start
documentationNext = () =>{
    document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
    document.getElementById("modalPreview").removeAttribute('hidden');
    document.getElementById("divButton").classList.remove('hidden');
    document.getElementById("divButton").classList.add('flex');
}
documentationBack = () =>{
    document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectDocuments").removeAttribute('hidden');
}
// Function Modal Documentation end

// Function Modal Preview start
previewBack = () =>{
    document.getElementById("modalPreview").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectDocumentation").removeAttribute('hidden');
    document.getElementById("divButton").classList.remove('flex');
    document.getElementById("divButton").classList.add('hidden');
}
// Function Modal Preview end


// Search Table --> start
function searchTable() {
    const search = document.getElementById("search");
    const salesTable = document.getElementById("salesTable");
    var filter, tr, td, i, found;
    filter = search.value.toUpperCase();
    tr = salesTable.getElementsByTagName("tr");
    for (i = 3; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
// Search Table --> end