@php
    $dataDescription = json_decode($locations[0]->description);
@endphp
<form class="flex justify-center" action="/marketing/quotations" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="company_id" id="company_id" value="1" hidden>
    <input type="text" name="media_category_id" id="media_category_id" value="{{ $data_category->id }}" hidden>
    @if ($data_category->name == 'Signage')
        <input type="text" id="category" name="{{ $dataDescription->type }}" value="{{ $data_category->name }}"
            hidden>
    @else
        <input type="text" id="category" value="{{ $data_category->name }}" hidden>
    @endif

    <input type="text" id="quotationType" value="{{ $quotation_type }}" hidden>
    @if ($quotation_type == 'extend' || $quotation_type == 'existing')
        <input type="text" id="client_type" value="{{ $dataClient->type }}" hidden>
    @endif
    <input type="text" id="quotationType" value="{{ $quotation_type }}" hidden>
    @if ($data_category->name == 'Signage')
        <input type="text" value="{{ $dataDescription->type }}" id="signageType" hidden>
    @endif
    <input type="text" id="attachment" name="attachment" hidden>
    <input type="text" id="subject" name="subject" hidden>
    @if ($quotation_type == 'extend' || $quotation_type == 'existing')
        <input type="text" name="clients" id="clients" value="{{ json_encode($dataClient) }}" hidden>
    @else
        <input type="text" name="clients" id="clients" hidden>
    @endif
    <input type="text" name="body_top" id="body_top" hidden>
    <input type="text" name="body_end" id="body_end" hidden>
    <input type="text" name="notes" id="notes" hidden>
    <input type="text" name="payment_terms" id="payment_terms" hidden>
    <input type="text" name="price" id="price" hidden>
    <input type="text" name="created_by" id="created_by" value="{{ json_encode($created_by) }}" hidden>
    <input type="text" name="modified_by" id="modified_by" value="{{ json_encode($created_by) }}" hidden>
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
                    @if ($category == 'Service')
                        @if ($quotation_type == 'new')
                            @include('quotations.new-service-body-preview');
                        @elseif ($quotation_type == 'existing')
                            @include('quotations.existing-service-body-preview');
                        @endif
                    @else
                        @if ($quotation_type == 'new')
                            @include('quotations.new-media-body-preview');
                        @elseif ($quotation_type == 'extend')
                            @include('quotations.extend-media-body-preview');
                        @endif
                    @endif

                    <!-- Body end -->
                    <!-- Footer start -->
                    @include('dashboard.layouts.letter-footer')
                    <!-- Footer end -->
                </div>
            </div>
        </div>

        <!-- View Location start -->
        @if ($category != 'Service')
            @if ($quotation_type == 'new')
                @include('quotations.locations-view')
            @else
                @include('quotations.locations-extend-view')
            @endif
        @endif
        <!-- View Location end -->
    </div>
</form>
