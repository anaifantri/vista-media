@php
    $dataDescription = json_decode($products[0]->description);
@endphp
<form class="flex justify-center" action="/marketing/quotation-revisions" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="number" id="number"
        value="{{ $number }}_Rev{{ count($quotation->quotation_revisions) + 1 }}/SPH/VM/{{ $romawi[(int) date('m')] }}-{{ date('Y') }}"
        hidden>
    <input type="text" id="category" name="category" value="{{ $category }}" hidden>
    <input type="text" id="quotation_id" name="quotation_id" value="{{ $quotation->id }}" hidden>
    @if ($category == 'Signage')
        <input type="text" id="signageType" value="{{ $dataDescription->type }}" hidden>
    @endif
    <input type="text" name="notes" id="notes" {{ json_encode($notes) }} hidden>
    <input type="text" name="payment_terms" id="payment_terms" value="{{ json_encode($payment_terms) }}" hidden>
    <input type="text" name="price" id="price" value="{{ json_encode($price) }}" hidden>
    <input type="text" name="modified_by" id="modified_by" value="{{ json_encode($modified_by) }}" hidden>
    <input type="text" name="products" id="products" value="{{ json_encode($products) }}" hidden>
    <div id="modalPreview" name="modalPreview"
        class="absolute justify-center top-0 w-full h-[full] bg-black bg-opacity-90 z-20 hidden">
        <div class="mt-10">
            <div class="flex w-full justify-center">
                <div class="flex w-[950px] justify-end">
                    <button id="btnSave" class="flex justify-center items-center mx-1 btn-primary" title="Save"
                        type="submit">
                        <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                        </svg>
                        <span class="ml-2 text-white">Save</span>
                    </button>
                    <button id="btnClose" class="flex justify-center items-center ml-1  btn-danger" type="button"
                        title="Close">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-sm">Close</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-center w-full">
                <div class="w-[950px] h-[1345px] border mb-10 mt-1 bg-white">
                    <!-- Header start -->
                    @include('dashboard.layouts.letter-header')
                    <!-- Header end -->
                    <!-- Body start -->
                    <div class="h-[1125px]">
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-2">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">Nomor</label>
                                    <label class="ml-1 text-sm text-black">:</label>
                                    <label
                                        class="ml-1 text-sm text-slate-500">{{ $number }}_Rev{{ count($quotation->quotation_revisions) + 1 }}/SPH/VM/{{ $romawi[(int) date('m')] }}-{{ date('Y') }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                                    <label class="ml-1 text-sm text-black">:</label>
                                    <label class="ml-1 text-sm text-black">{{ $quotation->attachment }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                    <label class="ml-1 text-sm text-black">:</label>
                                    <label class="ml-1 text-sm text-black">{{ $quotation->subject }}</label>
                                </div>
                                <div class="mt-4">
                                    <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                    @if ($client->type == 'Perorangan')
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $client->name }}</label>
                                    @else
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $client->company }}</label>
                                        @if ($client->contact_gender == 'Male')
                                            <label class="flex ml-1 text-sm text-black font-semibold">Bapak
                                                {{ $client->contact_name }}</label>
                                        @else
                                            <label class="flex ml-1 text-sm text-black font-semibold">Ibu
                                                {{ $client->contact_name }}</label>
                                        @endif
                                    @endif
                                    <label class="flex ml-1 text-sm text-black">Di -</label>
                                    <label class="flex ml-6 text-sm text-black">Tempat</label>
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black w-20">Email</label>
                                    <label class="ml-1 text-sm text-black ">:</label>
                                    @if ($client->type == 'Perorangan')
                                        <label class="ml-1 text-sm text-black ">{{ $client->email }}</label>
                                    @else
                                        <label class="ml-1 text-sm text-black ">{{ $client->contact_email }}</label>
                                    @endif
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                    <label class="ml-1 text-sm text-black ">:</label>
                                    @if ($client->type == 'Perorangan')
                                        <label class="ml-1 text-sm text-black ">{{ $client->phone }}</label>
                                    @else
                                        <label class="ml-1 text-sm text-black ">{{ $client->contact_phone }}</label>
                                    @endif
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                </div>
                                <div class="flex mt-2">
                                    <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $quotation->body_top }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- signage table start -->
                        <div class="flex justify-center ml-2">
                            @if ($category == 'Service')
                                @include('quotation-revisions.preview-service-table')
                            @else
                                @if ($category == 'Videotron')
                                    @include('quotation-revisions.vt-preview-table')
                                @elseif ($category == 'Signage')
                                    @php
                                        $dataDescription = json_decode($products[0]->description);
                                    @endphp
                                    @if ($dataDescription->type == 'Videotron')
                                        @include('quotation-revisions.vt-preview-table')
                                    @else
                                        @include('quotation-revisions.bb-preview-table')
                                    @endif
                                @else
                                    @include('quotation-revisions.bb-preview-table')
                                @endif
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
                                    <textarea class="ml-1 w-[721px] outline-none text-sm" rows="1" readonly>{{ $quotation->body_end }}
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
                                    <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-10">
                                    <input class="ml-1 text-sm text-black flex font-semibold"
                                        value="{{ auth()->user()->name }}" type="text">
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[725px]">
                                    <input class="ml-1 text-sm text-black flex"
                                        value="{{ auth()->user()->position }}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Body end -->
                    <!-- Footer start -->
                    @include('dashboard.layouts.letter-footer')
                    <!-- Footer end -->
                </div>
            </div>
        </div>
    </div>
</form>
