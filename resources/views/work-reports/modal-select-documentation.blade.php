<div id="modalSelectDocumentation" hidden>
    <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
        <span class="text-center w-full text-lg font-semibold">Pilih Dokumentasi Pekerjaan</span>
    </div>
    <div
        class="flex w-full h-[350px] bg-stone-200 justify-center border rounded-lg border-stone-400 my-2 p-2 border-b pb-2">
        <div class="text-sm w-[550px]">
            <div class="flex justify-center w-full">
                <label class="flex text-md font-semibold mr-1">Judul Foto :</label>
                @if ($work_category == 'media')
                    <input type="checkbox" class="outline-none ml-4" checked>
                @else
                    <input type="checkbox" class="outline-none ml-4">
                @endif
                <label class="flex text-md font-semibold ml-2">Foto Siang</label>
                <input type="checkbox" class="outline-none ml-4">
                <label class="flex text-md font-semibold ml-2">Foto Malam</label>
                @if ($work_category == 'service')
                    <input type="checkbox" class="outline-none ml-4" checked>
                @else
                    <input type="checkbox" class="outline-none ml-4">
                @endif
                <input type="text" class="ml-2 outline-none bg-white rounded-md px-1 w-32"
                    placeholder="input judul foto">
            </div>
            {{-- <div class="flex justify-center mt-2">
                <input id="firstImage" name="first_image" type="file"
                    class="outline-none border bg-white rounded-r-md" onchange="previewImageFirst(this)">
            </div> --}}
            <div class="border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-6 p-1">
                <img class="m-auto img-preview-first flex items-center bg-white rounded-lg"
                    src="/img/product-image.png">
            </div>
        </div>
        <div class="text-sm w-[550px]">
            <div class="flex justify-center w-full">
                <label class="flex text-md font-semibold mr-1">Judul Foto :</label>
                <input type="checkbox" class="outline-none ml-4">
                <label class="flex text-md font-semibold ml-2">Foto Siang</label>
                @if ($work_category == 'media')
                    <input type="checkbox" class="outline-none ml-4" checked>
                @else
                    <input type="checkbox" class="outline-none ml-4">
                @endif
                <label class="flex text-md font-semibold ml-2">Foto Malam</label>
                @if ($work_category == 'service')
                    <input type="checkbox" class="outline-none ml-4" checked>
                @else
                    <input type="checkbox" class="outline-none ml-4">
                @endif
                <input type="text" class="ml-2 outline-none bg-white rounded-md px-1 w-32"
                    placeholder="input judul foto">
            </div>
            {{-- <div class="flex justify-center mt-2">
                <input id="secondImage" name="second_image" type="file"
                    class="outline-none border bg-white rounded-r-md" onchange="previewImageSecond(this)">
            </div> --}}
            <div class="border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-6 p-1">
                <img class="m-auto img-preview-second flex items-center bg-white rounded-lg"
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
    function previewImageFirst(sel) {
        const imgPreview = document.querySelector('.img-preview-first');

        const oFReader = new FileReader();

        oFReader.readAsDataURL(sel.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    function previewImageSecond(sel) {
        const imgPreview = document.querySelector('.img-preview-second');

        const oFReader = new FileReader();

        oFReader.readAsDataURL(sel.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
