const sidebarMenu = document.getElementById("sidebarMenu");
const tableHeader = document.getElementById("tableHeader");
const tableRow = document.getElementById("tableRow");
const mainMenu = document.getElementById("mainMenu");
const subMenu = document.getElementById("subMenu");
const menuItems = document.getElementById("menuItems");
const position = document.getElementById("position");
const level = document.getElementById("level");
const division = document.getElementById("division");
const inputPosition = document.getElementById("inputPosition");
const cbPassword = document.getElementById('cbPassword');
const cbPasswordValue = document.getElementById('cbPasswordValue');

let mediaRoles = [];
let objMedia = {};
let marketingRoles = [];
let objMarketing = {};
let accountingRoles = [];
let objAccounting = {};
let workshopRoles = [];
let objWorkshop = {};
let userRoles = [];
let objUser = {};

if(division){
  if(division.value != "pilih"){
    if(inputPosition.value != ""){
      selectDivision(division, inputPosition);
      inputPosition.value = "";
    }else{
      inputPosition.value = "pilih";
      selectDivision(division, inputPosition);
    }
  }else{
    for(let i = 0; i < sidebarMenu.children.length; i++){
      if(i > 0 && i < sidebarMenu.children.length - 1){
        duplicateMainMenu("mainMenu", sidebarMenu.children[i].title, i);
        duplicateSubMenu("subMenu", i);
      }
    } 
  }
}

selectPosition = (sel) =>{
  inputPosition.value = sel.value;
}

// Set Checkbox Menu --> start
function setCbMenu(e){
  const subMenu = document.querySelectorAll("[id=subMenu]");
  const cbMainMenu = document.querySelectorAll("[id=cbMainMenu]");
  const cbCreate = document.querySelectorAll("[id=cbCreate]");
  const cbRead = document.querySelectorAll("[id=cbRead]");
  const cbUpdate = document.querySelectorAll("[id=cbUpdate]");
  const cbDelete = document.querySelectorAll("[id=cbDelete]");
  
  for(let i = 0; i < cbMainMenu.length; i++){
    if(i > 0){
      if(e.value == "Administrator"){
        cbCreate[i].removeAttribute("disabled");
        cbCreate[i].checked = true;
        cbRead[i].removeAttribute("disabled");
        cbRead[i].checked = true;
        cbUpdate[i].removeAttribute("disabled");
        cbUpdate[i].checked = true;
        cbDelete[i].removeAttribute("disabled");
        cbDelete[i].checked = true;
        for(let n = 0; n < subMenu[i].children.length; n++){
          subMenu[i].children[n].children[0].removeAttribute("disabled");
          subMenu[i].children[n].children[0].checked = true;
        }
      }else if(e.value == "Owner"){
        cbCreate[i].setAttribute("disabled", "disabled");
        cbCreate[i].checked = false;
        cbRead[i].removeAttribute("disabled");
        cbRead[i].checked = true;
        cbUpdate[i].setAttribute("disabled", "disabled");
        cbUpdate[i].checked = false;
        cbDelete[i].setAttribute("disabled", "disabled");
        cbDelete[i].checked = false;
        for(let n = 0; n < subMenu[i].children.length; n++){
          subMenu[i].children[n].children[0].removeAttribute("disabled");
          subMenu[i].children[n].children[0].checked = true;
        }
      }else if(e.value == "Media"){
        if(cbMainMenu[i].value == "Data Media"){
          cbCreate[i].removeAttribute("disabled");
          cbCreate[i].checked = true;
          cbRead[i].removeAttribute("disabled");
          cbRead[i].checked = true;
          cbUpdate[i].removeAttribute("disabled");
          cbUpdate[i].checked = true;
          cbDelete[i].removeAttribute("disabled");
          cbDelete[i].checked = true;
        }else{
          cbCreate[i].setAttribute("disabled", "disabled");
          cbCreate[i].checked = false;
          cbRead[i].setAttribute("disabled", "disabled");
          cbRead[i].checked = false;
          cbUpdate[i].setAttribute("disabled", "disabled");
          cbUpdate[i].checked = false;
          cbDelete[i].setAttribute("disabled", "disabled");
          cbDelete[i].checked = false;
        }
        
        for(let n = 0; n < subMenu[i].children.length; n++){
          if(e.value == "Administrator"){
            subMenu[i].children[n].children[0].removeAttribute("disabled");
            subMenu[i].children[n].children[0].checked = true;
          }else if(cbMainMenu[i].value == "Data Media"){
            subMenu[i].children[n].children[0].removeAttribute("disabled");
            subMenu[i].children[n].children[0].checked = true;
          }else{
            subMenu[i].children[n].children[0].setAttribute("disabled", "disabled");
            subMenu[i].children[n].children[0].checked = false;
          }
        }
      }else if(e.value == "Marketing"){
        if(cbMainMenu[i].value == "Data Pemasaran"){
          cbCreate[i].removeAttribute("disabled");
          cbCreate[i].checked = true;
          cbRead[i].removeAttribute("disabled");
          cbRead[i].checked = true;
          cbUpdate[i].removeAttribute("disabled");
          cbUpdate[i].checked = true;
          cbDelete[i].removeAttribute("disabled");
          cbDelete[i].checked = true;
        }else{
          cbCreate[i].setAttribute("disabled", "disabled");
          cbCreate[i].checked = false;
          if(cbMainMenu[i].value == "Data Pengguna"){
            cbRead[i].setAttribute("disabled", "disabled");
            cbRead[i].checked = false;
          }else{
            cbRead[i].removeAttribute("disabled");
            cbRead[i].checked = true;
          }
          cbUpdate[i].setAttribute("disabled", "disabled");
          cbUpdate[i].checked = false;
          cbDelete[i].setAttribute("disabled", "disabled");
          cbDelete[i].checked = false;
        }
        
        for(let n = 0; n < subMenu[i].children.length; n++){
          if(e.value == "Administrator"){
            subMenu[i].children[n].children[0].removeAttribute("disabled");
            subMenu[i].children[n].children[0].checked = true;
          }else if(cbMainMenu[i].value == "Data Pengguna"){
            subMenu[i].children[n].children[0].setAttribute("disabled", "disabled");
            subMenu[i].children[n].children[0].checked = false;
          }else{
            subMenu[i].children[n].children[0].removeAttribute("disabled");
            subMenu[i].children[n].children[0].checked = true;
          }
        }
      }else if(e.value == "Accounting"){
        if(cbMainMenu[i].value == "Data Keuangan"){
          cbCreate[i].removeAttribute("disabled");
          cbCreate[i].checked = true;
          cbRead[i].removeAttribute("disabled");
          cbRead[i].checked = true;
          cbUpdate[i].removeAttribute("disabled");
          cbUpdate[i].checked = true;
          cbDelete[i].removeAttribute("disabled");
          cbDelete[i].checked = true;
        }else{
          cbCreate[i].setAttribute("disabled", "disabled");
          cbCreate[i].checked = false;
          if(cbMainMenu[i].value == "Data Pengguna"){
            cbRead[i].setAttribute("disabled", "disabled");
            cbRead[i].checked = false;
          }else{
            cbRead[i].removeAttribute("disabled");
            cbRead[i].checked = true;
          }
          cbUpdate[i].setAttribute("disabled", "disabled");
          cbUpdate[i].checked = false;
          cbDelete[i].setAttribute("disabled", "disabled");
          cbDelete[i].checked = false;
        }
        
        for(let n = 0; n < subMenu[i].children.length; n++){
          if(e.value == "Administrator"){
            subMenu[i].children[n].children[0].removeAttribute("disabled");
            subMenu[i].children[n].children[0].checked = true;
          }else if(cbMainMenu[i].value == "Data Pengguna"){
            subMenu[i].children[n].children[0].setAttribute("disabled", "disabled");
            subMenu[i].children[n].children[0].checked = false;
          }else{
            subMenu[i].children[n].children[0].removeAttribute("disabled");
            subMenu[i].children[n].children[0].checked = true;
          }
        }
      }else if(e.value == "Workshop"){
        if(cbMainMenu[i].value == "Data Produksi"){
          cbCreate[i].removeAttribute("disabled");
          cbCreate[i].checked = true;
          cbRead[i].removeAttribute("disabled");
          cbRead[i].checked = true;
          cbUpdate[i].removeAttribute("disabled");
          cbUpdate[i].checked = true;
          cbDelete[i].removeAttribute("disabled");
          cbDelete[i].checked = true;
        }else{
          cbCreate[i].setAttribute("disabled", "disabled");
          cbCreate[i].checked = false;
          cbRead[i].setAttribute("disabled", "disabled");
          cbRead[i].checked = false;
          cbUpdate[i].setAttribute("disabled", "disabled");
          cbUpdate[i].checked = false;
          cbDelete[i].setAttribute("disabled", "disabled");
          cbDelete[i].checked = false;
        }
        
        for(let n = 0; n < subMenu[i].children.length; n++){
          if(e.value == "Administrator"){
            subMenu[i].children[n].children[0].removeAttribute("disabled");
            subMenu[i].children[n].children[0].checked = true;
          }else if(cbMainMenu[i].value == "Data Produksi"){
            subMenu[i].children[n].children[0].removeAttribute("disabled");
            subMenu[i].children[n].children[0].checked = true;
          }else{
            subMenu[i].children[n].children[0].setAttribute("disabled", "disabled");
            subMenu[i].children[n].children[0].checked = false;
          }
        }
      }
    }
  }
}
// Set Checkbox Menu --> end

// Set Division --> start
function selectDivision(sel, e){
  if(e.value == "" || e.value == "pilih"){
    setCbMenu(sel);
  }

  let administrator = {
    name : "Administrator",
    position : ["Administrator"]
  };
  let owner = {
    name : "Owner",
    position : ["Owner"]
  };
  let media = {
    name : "Media",
    position : ["Manager", "Admin", "Staff"]
  };
  let marketing = {
    name : "Marketing",
    position : ["Manager", "Sales & Marketing", "Admin", "Staff"]
  };
  let accounting = {
    name : "Accounting",
    position : ["Manager", "Collector", "Admin", "Staff"]
  };
  let workshop = {
    name : "Workshop",
    position : ["Manager", "Admin", "Staff"]
  };

  let objPosition = [administrator, owner, media, marketing, accounting, workshop];

  if(sel.value != "pilih"){
    level.value = sel.value;
    for(let i = 0; i < objPosition.length; i++){
      if(sel.value == objPosition[i].name){
        position.removeAttribute("disabled");
          while (position.length > 1) {
            position.removeChild(position.lastChild);
          }
          objPosition[i].position.forEach((element) => {
            option = document.createElement('option');
            option.appendChild(document.createTextNode(element));
            if(e.value == element){
              option.setAttribute('selected', 'selected');
            };
            option.setAttribute('value', element);
            position.appendChild(option);
          });
      }
    }
  }else{
    level.value = "";
    while (position.length > 1) {
      position.removeChild(position.lastChild);
    }
    position.setAttribute("disabled", "disabled");
  } 
}
// Set Division --> end

// Set User Access --> start

function duplicateMainMenu(eFrom, sel, index) {
  var eFrom = document.getElementById(eFrom);
  var cln = eFrom.cloneNode(true);
  tableHeader.appendChild(cln);
  tableHeader.children[index].children[0].children[0].value = sel;
  tableHeader.children[index].children[0].children[1].innerHTML = sel;
  tableHeader.children[index].removeAttribute("hidden");
};

function duplicateSubMenu(eFrom, index) {
  var eFrom = document.getElementById(eFrom);
  var cln = eFrom.cloneNode(true);
  tableRow.appendChild(cln);
  tableRow.children[index].removeAttribute("hidden");
  for(let n = 0; n < sidebarMenu.children[index].children[1].children[1].children.length; n++){
    var eItem = document.getElementById("menuItems");
    var clnItem = eItem.cloneNode(true);
    tableRow.children[index].appendChild(clnItem);
    tableRow.children[index].children[n].children[0].value = sidebarMenu.children[index].children[1].children[1].children[n].title;
    tableRow.children[index].children[n].children[1].innerHTML = sidebarMenu.children[index].children[1].children[1].children[n].title;
    tableRow.children[index].children[n].classList.remove("hidden");
    tableRow.children[index].children[n].classList.add("flex");
  }
};
// Set User Access --> end

// Get User Access --> start
getUserAccess = () =>{
  const userAccess = document.getElementById("user_access");
  const subMenu = document.querySelectorAll("[id=subMenu]");
  const cbMainMenu = document.querySelectorAll("[id=cbMainMenu]");
  const cbCreate = document.querySelectorAll("[id=cbCreate]");
  const cbRead = document.querySelectorAll("[id=cbRead]");
  const cbUpdate = document.querySelectorAll("[id=cbUpdate]");
  const cbDelete = document.querySelectorAll("[id=cbDelete]");
  
  for(let i = 0; i < cbMainMenu.length; i++){
    if(i > 0){
      let permissions = {
        title : "",
        create : false,
        read : false,
        update : false,
        delete : false
      }
      permissions.title = cbMainMenu[i].value;
      if(cbCreate[i].checked == true){
        permissions.create = true;
      }else{
        permissions.create = false;
      }
      if(cbRead[i].checked == true){
        permissions.read = true;
      }else{
        permissions.read = false;
      }
      if(cbUpdate[i].checked == true){
        permissions.update = true;
      }else{
        permissions.update = false;
      }
      if(cbDelete[i].checked == true){
        permissions.delete = true;
      }else{
        permissions.delete = false;
      }
      for(let n = 0; n < subMenu[i].children.length; n++){
        let roles = {
          access : false,
          title : ""
        }
        if(subMenu[i].children[n].children[0].checked == true){
          roles.access = true;
        }else{
          roles.access = false;
        }
        roles.title = subMenu[i].children[n].children[1].innerText;
        if(cbMainMenu[i].value == "Data Media"){
          mediaRoles.push(roles);
        }else if(cbMainMenu[i].value == "Data Pemasaran"){
          marketingRoles.push(roles);
        }else if(cbMainMenu[i].value == "Data Keuangan"){
          accountingRoles.push(roles);
        }else if(cbMainMenu[i].value == "Data Pemasaran"){
          marketingRoles.push(roles);
        }else if(cbMainMenu[i].value == "Data Produksi"){
          workshopRoles.push(roles);
        }else if(cbMainMenu[i].value == "Data Pengguna"){
          userRoles.push(roles);
        }
      }
      if(cbMainMenu[i].value == "Data Media"){
        objMedia = {permissions, mediaRoles};
      }else if(cbMainMenu[i].value == "Data Pemasaran"){
        objMarketing = {permissions, marketingRoles};
      }else if(cbMainMenu[i].value == "Data Keuangan"){
        objAccounting = {permissions, accountingRoles};
      }else if(cbMainMenu[i].value == "Data Produksi"){
        objWorkshop = {permissions, workshopRoles};
      }else if(cbMainMenu[i].value == "Data Pengguna"){
        objUser = {permissions, userRoles};
      }
    }
  }
  let objUserAccess = {objMedia, objMarketing, objAccounting, objWorkshop, objUser};
  userAccess.value = JSON.stringify(objUserAccess);
  // console.log(userAccess.value);
}
// Get User Access --> end

// Btn Save Action --> start
btnSaveAction = () =>{
  getUserAccess();
  document.getElementById("formUpdate").submit();
}
// Btn Save Action --> end

// Checkbox Change Password Action --> start
console.log(cbPasswordValue.value);
if(Boolean(cbPasswordValue.value) == true){
  cbPassword.checked = true;
  changePassword(cbPassword);
}else{
  cbPassword.checked == false;
}
function changePassword (sel){
  const divPassword = document.getElementById("divPassword");
  const password = document.getElementById("password");
  const divConfirmPassword = document.getElementById("divConfirmPassword");
  const confirmPassword = document.getElementById("confirmPassword");
  if(sel.checked == true){
    cbPasswordValue.value = true;
  }else{
    cbPasswordValue.value = false;
  }
  divPassword.hidden = !sel.checked;
  divConfirmPassword.hidden = !sel.checked;
  password.disabled = !sel.checked;
  password.required = !sel.checked;
  password.value = "";
  password.focus();
  confirmPassword.disabled = !sel.checked;
  confirmPassword.required = !sel.checked;
  confirmPassword.value = "";
};
// Checkbox Change Password Action --> end