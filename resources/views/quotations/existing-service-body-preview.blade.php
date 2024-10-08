<div class="h-[1125px]">
    <div class="flex justify-center">
        <div class="w-[725px] mt-2">
            <div class="flex">
                <label class="ml-1 text-sm text-black w-20">Nomor</label>
                <label class="ml-1 text-sm text-black">:</label>
                <label class="ml-1 text-sm text-slate-500">Penomoran otomatis</label>
            </div>
            <div class="flex">
                <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                <label class="ml-1 text-sm text-black">:</label>
                <label id="previewAttachment" class="ml-1 text-sm text-black"></label>
            </div>
            <div class="flex">
                <label class="ml-1 text-sm text-black w-20">Perihal</label>
                <label class="ml-1 text-sm text-black">:</label>
                <label id="previewSubject" class="ml-1 text-sm text-black"></label>
            </div>
            <div class="mt-4">
                <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                <label class="flex ml-1 text-sm text-black font-semibold" id="previewClientCompany"></label>
                <label class="flex ml-1 text-sm text-black font-semibold" id="previewClientContact"></label>
                <label class="flex ml-1 text-sm text-black">Di -</label>
                <label class="flex ml-6 text-sm text-black">Tempat</label>
            </div>
            <div class="flex mt-4">
                <label class="ml-1 text-sm text-black w-20">Email</label>
                <label class="ml-1 text-sm text-black ">:</label>
                <label id="previewEmail" class="ml-1 text-sm text-black "></label>
            </div>
            <div class="flex">
                <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                <label class="ml-1 text-sm text-black ">:</label>
                <label id="previewPhone" class="ml-1 text-sm text-black "></label>
            </div>
            <div class="flex mt-4">
                <label class="ml-1 text-sm text-black">Dengan hormat,</label>
            </div>
            <div class="flex mt-2">
                <textarea id="previewBodyTop" class="ml-1 w-[721px] outline-none text-sm" readonly></textarea>
            </div>
        </div>
    </div>
    <!-- signage table start -->
    <div class="flex justify-center ml-2">
        @if ($category == 'Signage')
            @php
                $dataDescription = json_decode($locations[0]->description);
            @endphp
            @if ($dataDescription->type != 'Videotron')
                @include('quotations.service-preview-table')
            @endif
        @else
            @include('quotations.preview-service-table')
        @endif
    </div>
    <!-- signage table end -->

    <!-- quotation note start -->
    <div class="flex justify-center">
        <div class="w-[725px] mt-2">
            <div class="flex">
                <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                <label class="ml-1 text-sm text-black flex">:</label>
            </div>
            <div id="previewNotesQty"></div>
            <div class="flex mt-2">
                <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
            </div>
            <div id="previewPaymentTerms"></div>
        </div>
    </div>
    <!-- quotation note end -->

    <div class="h-[1125px]">
        <div class="flex justify-center">
            <div class="flex mt-4">
                <textarea id="previewBodyEnd" class="ml-1 w-[721px] outline-none text-sm" rows="1" readonly>
            </textarea>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px] mt-4">
                <label class="ml-1 text-sm text-black flex">Denpasar, {{ date('d') }}
                    {{ $bulan[(int) date('m')] }}
                    {{ date('Y') }}</label>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px]">
                <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista
                    Media</label>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px] mt-10">
                <input class="ml-1 text-sm text-black flex font-semibold" value="{{ auth()->user()->name }}"
                    type="text">
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px]">
                <input class="ml-1 text-sm text-black flex" value="{{ auth()->user()->position }}" type="text">
            </div>
        </div>
    </div>
</div>
