<div id="modalPreview" hidden>
    <div class="flex w-full">
        <span class="text-center w-full text-lg font-semibold text-white">Preview Invoice & Kwitansi</span>
    </div>

    <!-- Surat Invoice start -->
    <div class="flex justify-center w-full mt-2">
        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
            <!-- Header start -->
            @include('dashboard.layouts.letter-header')
            <!-- Header end -->
            <!-- Body start -->
            @include('billings.invoice-media-body')
            <!-- Body end -->
            <!-- Footer start -->
            @include('dashboard.layouts.letter-footer')
            <!-- Footer end -->
        </div>
    </div>
    <!-- Surat Invoice end -->

    <!-- Kwitansi start -->
    <div class="flex justify-center w-full mt-2">
        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
            <!-- Header start -->
            @include('billings.receipt-header')
            <!-- Header end -->
            <!-- Body start -->
            @include('billings.receipt-media-body')
            <!-- Body end -->
            <!-- Sign start -->
            @include('billings.receipt-media-sign')
            <!-- Sign end -->
            <div class="flex w-full justify-center items-center pt-2">
                <div class="border-t h-2 border-slate-500 border-dashed w-full">
                </div>
            </div>
            <!-- Header start -->
            @include('billings.receipt-header')
            <!-- Header end -->
            <!-- Body start -->
            @include('billings.receipt-media-body')
            <!-- Body end -->
            <!-- Sign start -->
            @include('billings.receipt-media-sign')
            <!-- Sign end -->
        </div>
    </div>
    <!-- Kwitansi end -->
</div>
