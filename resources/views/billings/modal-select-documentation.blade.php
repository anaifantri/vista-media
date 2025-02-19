<div id="modalSelectDocumentation" hidden>
    <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
        <span class="text-center w-full text-lg font-semibold">Upload Dokumentasi Pekerjaan</span>
    </div>
    <div
        class="flex w-full h-[350px] bg-stone-200 justify-center border rounded-lg border-stone-400 my-2 p-2 border-b pb-2">
        <div class="text-sm w-[550px]">
            <label class="flex justify-center w-full text-md font-semibold">Foto Siang</label>
            <div class="flex justify-center mt-2">
                <input id="dayImage" name="day_image" type="file" class="outline-none border bg-white rounded-r-md"
                    onchange="previewImageDay(this)">
            </div>
            <div class="border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-2 p-1">
                <img class="m-auto img-preview-day flex items-center bg-white rounded-lg" src="/img/product-image.png">
            </div>
        </div>
        <div class="text-sm w-[550px]">
            <label class="flex justify-center text-md font-semibold">Foto Malam</label>
            <div class="flex justify-center mt-2">
                <input id="nightImage" name="night_image" type="file"
                    class="outline-none border bg-white rounded-r-md" onchange="previewImageNight(this)">
            </div>
            <div class="border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-2 p-1">
                <img class="m-auto img-preview-night flex items-center bg-white rounded-lg"
                    src="/img/product-image.png">
            </div>
        </div>
    </div>
    <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
        <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
            onclick="documentationBack()">
            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
            </svg>
            <span class="mx-1 text-white">Back</span>
        </button>
        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
            onclick="documentationNext()">
            <span class="mx-1 text-white">Next</span>
            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
            </svg>
        </button>
    </div>
</div>

<script>
    function previewImageDay(sel) {
        const imgPreview = document.querySelector('.img-preview-day');

        const oFReader = new FileReader();

        oFReader.readAsDataURL(sel.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    function previewImageNight(sel) {
        const imgPreview = document.querySelector('.img-preview-night');

        const oFReader = new FileReader();

        oFReader.readAsDataURL(sel.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
