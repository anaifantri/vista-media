<!-- Location Photo & Maps start -->
<div class="flex justify-center bg-stone-300 border rounded-lg w-[650px] p-4 ml-4">
    <div>
        <!-- Location Photo start -->
        <div>
            <span class="border-b flex justify-center text-base font-semibold w-full">Photo Lokasi</span>
            <input
                class="mt-1 w-full h-8 border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 @error('photo') is-invalid @enderror"
                type="file" id="photo" name="photo" onchange="previewImage()">
        </div>
        @error('photo')
            <div class="invalid-feedback ml-5 ">
                {{ $message }}
            </div>
        @enderror
        <div class="flex lg-photo-product border mt-2">
            <img class="img-preview lg-photo-product" src="/img/product-image.png" alt="">
        </div>
        <!-- Location Photo end -->

        <!-- Location Maps start -->
        @error('lat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <span class="flex justify-center border-b mt-2 text-base font-semibold">Peta Lokasi</span>
        <div class="lg-map-product mt-2" id="map">
        </div>
        <!-- Location Maps end -->
    </div>
</div>
<!-- Location Photo & Maps end -->
