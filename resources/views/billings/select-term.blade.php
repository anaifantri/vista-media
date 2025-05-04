<form id="formSelectTerm" action="/billings/create-media-billing/{{ $sale_id }}">
    <input type="text" id="billTerms" name="bill_terms" value="{{ json_encode($bill_terms) }}" hidden>
    <input type="text" id="manualTerms" value="{{ json_encode($manual_terms) }}" hidden>
    <input type="text" id="autoTerms" value="{{ json_encode($auto_terms) }}" hidden>
    @if (request('set_preview'))
        <input type="text" id="setPreview" name="set_preview" value="{{ request('set_preview') }}" hidden>
    @else
        <input type="text" id="setPreview" name="set_preview" value="false" hidden>
    @endif
    <div id="modalSelectTerm">
        <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
            <span class="text-center w-full text-lg font-semibold">Pilih Termin Pembayaran Yang Akan Ditagihkan?</span>
        </div>
        <div
            class="flex w-full h-[350px] bg-stone-200 justify-center border rounded-lg border-stone-400 my-2 p-2 border-b pb-2">
            <div class="w-[575px] p-2 border rounded-lg border-stone-900">
                <div class="flex text-md font-semibold">
                    @if (request('rbTerm') && request('rbTerm') == 'autoTerm')
                        <input id="rbAutoTerm" name="rbTerm" value="autoTerm" type="radio"
                            onclick="rbAutoTermAction()" checked>
                    @else
                        <input id="rbAutoTerm" name="rbTerm" value="autoTerm" type="radio"
                            onclick="rbAutoTermAction()" checked>
                    @endif
                    <label class="ml-2">Berdasarkan Termin Pembayaran :</label>
                </div>
                <div id="divAutoTerms">
                    @foreach ($payment_terms->dataPayments as $term)
                        <div class="flex mt-2 text-sm">
                            <span class="w-[270px]">Tahap {{ $loop->iteration }} = ({{ $term->term }} %) sebesar Rp.
                                {{ number_format(($term->term / 100) * $sale_price) }},-</span>
                            @if (request('rbTerm') && request('rbTerm') == 'autoTerm')
                                @if ($bill_terms[$loop->iteration - 1]->set_collect == true && request('rbTerm') == 'autoTerm')
                                    <input id="cbTerm{{ $loop->iteration - 1 }}" type="checkbox" class="ml-6"
                                        onclick="cbAutoTerm(this)" checked>
                                @else
                                    <input id="cbTerm{{ $loop->iteration - 1 }}" type="checkbox" class="ml-6"
                                        onclick="cbAutoTerm(this)">
                                @endif
                            @elseif (request('rbTerm') && request('rbTerm') == 'manualTerm')
                                <input id="cbTerm{{ $loop->iteration - 1 }}" type="checkbox" class="ml-6"
                                    onclick="cbAutoTerm(this)" disabled>
                            @else
                                <input id="cbTerm{{ $loop->iteration - 1 }}" type="checkbox" class="ml-6"
                                    onclick="cbAutoTerm(this)">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @if (count($sales) > 1)
                <div class="ml-4 w-[575px] p-2 border rounded-lg border-stone-900" hidden>
                    <div class="flex text-md font-semibold">
                        @if (request('rbTerm'))
                            @if (request('rbTerm') == 'manualTerm')
                                <input id="rbManualTerm" name="rbTerm" value="manualTerm" type="radio"
                                    onclick="rbManualTermAction()" checked>
                            @else
                                <input id="rbManualTerm" name="rbTerm" value="manualTerm" type="radio"
                                    onclick="rbManualTermAction()">
                            @endif
                        @else
                            <input id="rbManualTerm" name="rbTerm" value="manualTerm" type="radio"
                                onclick="rbManualTermAction()">
                        @endif
                        <label class="ml-2">Input manual :</label>
                    </div>
                    @if (request('rbTerm') && request('rbTerm') == 'manualTerm')
                        @include('billings.manual-term-enable')
                    @else
                        @include('billings.manual-term-disable')
                    @endif
                </div>
            @else
                <div class="ml-4 w-[575px] p-2 border rounded-lg border-stone-900">
                    <div class="flex text-md font-semibold">
                        @if (request('rbTerm'))
                            @if (request('rbTerm') == 'manualTerm')
                                <input id="rbManualTerm" name="rbTerm" value="manualTerm" type="radio"
                                    onclick="rbManualTermAction()" checked>
                            @else
                                <input id="rbManualTerm" name="rbTerm" value="manualTerm" type="radio"
                                    onclick="rbManualTermAction()">
                            @endif
                        @else
                            <input id="rbManualTerm" name="rbTerm" value="manualTerm" type="radio"
                                onclick="rbManualTermAction()">
                        @endif
                        <label class="ml-2">Input manual :</label>
                    </div>
                    @if (request('rbTerm') && request('rbTerm') == 'manualTerm')
                        @include('billings.manual-term-enable')
                    @else
                        @include('billings.manual-term-disable')
                    @endif
                </div>
            @endif
        </div>
        <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
            <a href="/billings/select-sale/media/{{ $company->id }}"
                class="flex justify-center items-center mx-1 btn-primary" title="Back">
                <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                </svg>
                <span class="mx-1 text-white">Back</span>
            </a>
            <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
                onclick="termNext()">
                <span class="mx-1 text-white">Next</span>
                <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                </svg>
            </button>
        </div>
    </div>
</form>

<script>
    let paymentTerms = @json($payment_terms);
    let billTerms = JSON.parse(document.getElementById("billTerms").value);
    let manualTerms = JSON.parse(document.getElementById("manualTerms").value);
    let autoTerms = JSON.parse(document.getElementById("autoTerms").value);
    let setPreview = document.getElementById("setPreview");
    var salePpn = @json($sale_ppn);
    var salePrice = @json($sale_price);
    var totalTerm = 0;
</script>
