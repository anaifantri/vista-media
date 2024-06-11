        const modal = document.getElementById("modal");
        const btnCreate = document.getElementById("btnCreate");
        const btnCancel = document.getElementById("btnCancel");
        const btnClose = document.getElementById("btnClose");
        const btnChangeContact = document.getElementById("btnChangeContact");
        const changeContact = document.getElementById("changeContact");
        const clientContact = document.getElementById("clientContact");
        const contactEmail = document.getElementById("contactEmail");
        const contactPhone = document.getElementById("contactPhone");
        const btnAddNote = document.getElementById("btnAddNote");
        const btnDelNote = document.getElementById("btnDelNote");
        const notesQty = document.getElementById("notesQty");
        const btnPreview = document.getElementById("btnPreview");

        const printingProduct = document.getElementById("printing_product");
        const printingPrice = document.getElementById("printing_price");
        const printingProductName = document.getElementById("printing_product_name");
        // const installationPrice = document.getElementById("installation_price");
        const instalPrice = document.getElementById("instal_price");
        const installationProduct = document.getElementById("installation_product");
        const widePrint = document.getElementById("widePrint");
        const wideInstal = document.getElementById("wideInstal");
        // const totalInstal = document.getElementById("totalInstal");
        const totalPrint = document.getElementById("totalPrint");
        const subTotal = document.getElementById("subTotal");
        const ppnValue = document.getElementById("ppnValue");
        const grandTotal = document.getElementById("grandTotal");
        const diffPrint = document.getElementById("diffPrint");
        const diffInstal = document.getElementById("diffInstal");
        const totalInstall = document.getElementById("total_install");

        const saleId = document.getElementById("sale_id");
        const billboardId = document.getElementById("billboard_id");
        const billboardcode = document.getElementById("billboard_code");
        const billboardAddress = document.getElementById("billboard_address");
        const companyId = document.getElementById("company_id");
        const contactId = document.getElementById("contact_id");
        const clientId = document.getElementById("client_id");
        const products = document.getElementById("products");

        btnCreate.addEventListener('click', function() {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        })

        btnCancel.addEventListener('click', function() {
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        })

        const saveName = document.getElementById("saveNumber");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: saveName.value,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 300,
                    scale: 4,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [950, 1380],
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            // html2pdf(element, opt);
            html2pdf().set(opt).from(element).save();
        };

        // Button Change Contact Action --> start
        btnChangeContact.addEventListener('click', function() {
            changeContact.classList.remove("hidden");
            changeContact.classList.add("flex");
        })
        // Button Change Contact Action --> end

        // Button CLose Action --> start
        btnClose.addEventListener('click', function() {
            changeContact.classList.remove("flex");
            changeContact.classList.add("hidden");
        })
        // Button CLose Action --> end

        // Radio Function Action --> start
        function radioFunction(sel) {
            var radioValueArray = sel.value.split("-");
            contactId.value = radioValueArray[0];
            clientContact.innerHTML = "";
            clientContact.innerHTML = radioValueArray[1];
            contactEmail.innerHTML = "";
            contactEmail.innerHTML = radioValueArray[2];
            contactPhone.innerHTML = "";
            contactPhone.innerHTML = radioValueArray[3];
        }
        // Radio Function Action --> end

        // Button Add Note Action --> start
        btnAddNote.addEventListener('click', function() {
            if (notesQty.children.length < 5) {
                const divNotes = document.createElement("div");
                const labelNotes = document.createElement("label");
                const inputNotes = document.createElement("textarea");
                divNotes.classList.add("flex");
                labelNotes.classList.add("ml-1");
                labelNotes.classList.add("text-sm");
                labelNotes.innerHTML = "-";
                inputNotes.classList.add("text-area-notes");
                inputNotes.setAttribute('placeholder', 'input catatan');
                inputNotes.setAttribute('rows', '1');

                divNotes.appendChild(labelNotes);
                divNotes.appendChild(inputNotes);

                notesQty.appendChild(divNotes);
            } else {
                alert("Maksimal 5 catatan");
            }
        })
        // Button Add Note Action --> end

        // Button Remove Last Note Action --> start
        btnDelNote.addEventListener('click', function() {
            if (notesQty.children.length > 0) {
                notesQty.removeChild(notesQty.lastChild);
            } else {
                alert("Tidak ada catatan");
            }
        })
        // Button Remove Last Note Action --> end

        // Button Preview Action --> start
        btnPreview.addEventListener('click', function() {
            if (printing_product.value == "-pilih-" && diffPrint.value == 0) {
                alert("Bahan cetak belum di pilih");
            } else {
                fillProductData();
            }
        })
        // Button Preview Action --> end

        // Fill data --> start
        function fillProductData() {
            const sale_id = 0;
            const billboard_id = 0;
            const billboard_code = 0;
            const billboard_address = "";
            const print = true;
            const install = true;
            const p_size = 0;
            const l_size = 0;
            const wide = 0;
            const orientation = "";
            const print_price = 0;
            const install_price = 0;
            const printProduct = "";
            const installProduct = "";

            let objProducts = {};
            let quotationProducts = [];
            let notes = [];
            var noteIndex = 0;

            quotationProducts = {
                sale_id: saleId.value,
                billboard_id: billboardId.value,
                billboard_code: billboardcode.value,
                billboard_address: billboardAddress.value,
                print: true,
                install: true,
                wide: Number(widePrint.innerHTML),
                print_price: Number(printingPrice.value),
                install_price: instalPrice.value,
                printProduct: printingProductName.value,
                installProduct: installationProduct.innerText,
                notes: []
            }

            if (totalInstall.value == 0) {
                quotationProducts.install = false;
            } else {
                quotationProducts.install = true;
            }

            if (Number(totalPrint.innerHTML) == 0) {
                quotationProducts.print = false;
            } else {
                quotationProducts.print = true;
            }

            for (i = 0; i < notesQty.children.length; i++) {
                if (notesQty.children[i].children[1].value != "") {
                    quotationProducts.notes[noteIndex] = notesQty.children[i].children[1].value;
                    noteIndex++;
                }
            }

            products.value = JSON.stringify(quotationProducts);
            console.log(products.value);
        }
        // Fill data --> end

        // Get Printing Product --> start
        function getPrintingProduct(sel) {
            var valuePriceArray = sel.value.split("-");
            var printProduct = valuePriceArray[2];
            var printPrice = valuePriceArray[1];

            printingPrice.value = Number(printPrice);
            printingProductName.value = printProduct;

            totalPrint.innerHTML = Number(printPrice) * Number(widePrint.innerHTML);
            subTotal.innerHTML = Number(totalPrint.innerHTML) + Number(totalInstall.value);
            ppnValue.innerHTML = Number(subTotal.innerHTML) * 11 / 100;
            grandTotal.innerHTML = Number(subTotal.innerHTML) + Number(ppnValue.innerHTML);
        }