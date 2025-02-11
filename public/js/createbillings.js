// Function Modal Sale Start
saleNext = () =>{
    document.getElementById("modalSelectSale").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectTerm").removeAttribute('hidden');
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

// Function Modal Faktur PPN start
fakturNext = () =>{
    document.getElementById("modalInputFaktur").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectDocuments").removeAttribute('hidden');
}
fakturBack = () =>{
    document.getElementById("modalInputFaktur").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectTerm").removeAttribute('hidden');
}
// Function Modal Faktur PPN end

// Function Modal Documents PPN start
documentNext = () =>{
    document.getElementById("modalSelectDocuments").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectDocumentation").removeAttribute('hidden');
}
documentBack = () =>{
    document.getElementById("modalSelectDocuments").setAttribute('hidden', 'hidden');
    document.getElementById("modalInputFaktur").removeAttribute('hidden');
}
// Function Modal Documents PPN end

// Function Modal Documentation PPN start
documentationNext = () =>{
    document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
    document.getElementById("modalPreview").removeAttribute('hidden');
}
documentationBack = () =>{
    document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectDocuments").removeAttribute('hidden');
}
// Function Modal Documentation PPN end

// Function Modal Preview PPN start
// documentNext = () =>{
//     document.getElementById("modalSelectDocumentation").setAttribute('hidden', 'hidden');
//     document.getElementById("modalPreview").removeAttribute('hidden');
// }
previewBack = () =>{
    document.getElementById("modalPreview").setAttribute('hidden', 'hidden');
    document.getElementById("modalSelectDocumentation").removeAttribute('hidden');
}
// Function Modal Preview PPN end