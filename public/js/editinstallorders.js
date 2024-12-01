const type = document.getElementById("type");
const product = document.getElementById("product");
const theme = document.getElementById("theme");
const installAt = document.getElementById("install_at");
const notes = document.getElementById("notes");

themeCheck = () =>{
    if(theme.value == ""){
        alert('Silahkan pilih input tema design terlebih dahulu..!!');
        theme.classList.add("is-invalid");
        theme.focus();
    }else{
        return true;
    }
}

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

fillData = () =>{
    if(themeCheck() == true && installAtCheck() == true){
        if(confirm('Apakah anda yakin data yang diinput sudah benar?')){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}