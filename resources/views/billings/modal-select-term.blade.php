<form id="formSelectTerm" action="/billings/create-media-billing/{{ $sale->id }}">
    <input type="text" id="autoTerms" name="auto_terms" value="{{ json_encode($auto_terms) }}" hidden>
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
                    @if (request('rbTerm'))
                        @if (request('rbTerm') == 'autoTerm')
                            <input id="rbAutoTerm" name="rbTerm" value="autoTerm" type="radio"
                                onclick="rbAutoTermAction()" checked>
                        @else
                            <input id="rbAutoTerm" name="rbTerm" value="autoTerm" type="radio"
                                onclick="rbAutoTermAction()">
                        @endif
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
                                {{ number_format(($term->term / 100) * $sale->price) }},-</span>
                            @if ($auto_terms[$loop->iteration - 1]->set_collect == true && request('rbTerm') == 'autoTerm')
                                <input id="cbTerm{{ $loop->iteration - 1 }}" type="checkbox" class="ml-6"
                                    onclick="cbAutoTerm(this)" checked>
                            @else
                                <input id="cbTerm{{ $loop->iteration - 1 }}" type="checkbox" class="ml-6"
                                    onclick="cbAutoTerm(this)">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
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
                <div class="mt-2 text-sm" id="divManualTerms">
                    <div class="border rounded-md border-stone-900 p-1">
                        <div class="flex">
                            <input id="cbManualTerm0" type="checkbox" onclick="cbManualTerm(this)" disabled>
                            <input id="titleTerms" type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md"
                                value="Produksi Media Luar Ruang" disabled>
                        </div>
                        <div class="flex mt-1 ml-7">
                            <label>Nominal</label>
                            <input id="nominalTerms" name="nominalTerms0" type="number"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" onkeyup="inputNominalTerm(this)" disabled>
                            <label class="ml-2">DPP</label>
                            <input id="dppTerms" name="dppTerms0" type="number" onkeyup="inputDppTerm(this)"
                                onchange="inputDppTermChange(this)"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled>
                            <label class="ml-2">PPN</label>
                            <input id="ppnTerms" name="ppnTerms0" type="number"
                                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled readonly>
                        </div>
                    </div>
                    <div class="border rounded-md border-stone-900  mt-1 p-1">
                        <div class="flex">
                            <input id="cbManualTerm1" type="checkbox" onclick="cbManualTerm(this)" disabled>
                            <input id="titleTerms" type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md"
                                value="Pemakaian Listrik Media Luar Ruang" disabled>
                        </div>
                        <div class="flex mt-1 ml-7">
                            <label>Nominal</label>
                            <input id="nominalTerms" name="nominalTerms1" type="number"
                                onkeyup="inputNominalTerm(this)"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled>
                            <label class="ml-2">DPP</label>
                            <input id="dppTerms" name="dppTerms1" type="number" onkeyup="inputDppTerm(this)"
                                onchange="inputDppTermChange(this)"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled>
                            <label class="ml-2">PPN</label>
                            <input id="ppnTerms" name="ppnTerms1" type="number"
                                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled readonly>
                        </div>
                    </div>
                    <div class="border rounded-md border-stone-900  mt-1 p-1">
                        <div class="flex">
                            <input id="cbManualTerm2" type="checkbox" onclick="cbManualTerm(this)" disabled>
                            <input id="titleTerms" type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md"
                                value="Jasa Media Luar Ruang" disabled>
                        </div>
                        <div class="flex mt-1 ml-7">
                            <label>Nominal</label>
                            <input id="nominalTerms" name="nominalTerms2" type="number"
                                onkeyup="inputNominalTerm(this)"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled>
                            <label class="ml-2">DPP</label>
                            <input id="dppTerms" name="dppTerms2" type="number" onkeyup="inputDppTerm(this)"
                                onchange="inputDppTermChange(this)"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled>
                            <label class="ml-2">PPN</label>
                            <input id="ppnTerms" name="ppnTerms2" type="number"
                                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled readonly>
                        </div>
                    </div>
                    <div class="border rounded-md border-stone-900  mt-1 p-1">
                        <div class="flex">
                            <input id="cbManualTerm3" type="checkbox" onclick="cbManualTerm(this)" disabled>
                            <input id="titleTerms" type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md"
                                value="Pajak Reklame" disabled readonly>
                        </div>
                        <div class="flex mt-1 ml-7">
                            <label>Nominal</label>
                            <input id="nominalTerms" name="nominalTerms3" type="number"
                                onkeyup="inputNominalTerm(this)"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled>
                            <label class="ml-2">DPP</label>
                            <input id="dppTerms" name="dppTerms3" type="number" onkeyup="inputDppTerm(this)"
                                onchange="inputDppTermChange(this)"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled hidden>
                            <label class="ml-2">PPN</label>
                            <input id="ppnTerms" name="ppnTerms3" type="number"
                                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled readonly hidden>
                        </div>
                    </div>
                    <div class="border rounded-md border-stone-900  mt-1 p-1">
                        <div class="flex">
                            <input id="cbManualTerm4" type="checkbox" onclick="cbManualTerm(this)" disabled>
                            <input id="titleTerms" type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md"
                                placeholder="Lainnya" disabled>
                        </div>
                        <div class="flex mt-1 ml-7">
                            <label>Nominal</label>
                            <input id="nominalTerms" name="nominalTerms4" type="number"
                                onkeyup="inputNominalTerm(this)"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled>
                            <label class="ml-2">DPP</label>
                            <input id="dppTerms" name="dppTerms4" type="number" onkeyup="inputDppTerm(this)"
                                onchange="inputDppTermChange(this)"
                                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled>
                            <label class="ml-2">PPN</label>
                            <input id="ppnTerms" name="ppnTerms4" type="number"
                                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md"
                                placeholder="0" disabled readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
            <a href="/billings/select-sale/media" class="flex justify-center items-center mx-1 btn-primary"
                title="Back">
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
    let autoTerms = JSON.parse(document.getElementById("autoTerms").value);
    let setPreview = document.getElementById("setPreview");
    var salePpn = @json($sale_ppn);
    var salePrice = @json($sale->price);
    var totalTerm = 0;


    function terbilang(nilai) {
        nilai = Math.floor(Math.abs(nilai));

        var huruf = [
            '',
            'Satu',
            'Dua',
            'Tiga',
            'Empat',
            'Lima',
            'Enam',
            'Tujuh',
            'Delapan',
            'Sembilan',
            'Sepuluh',
            'Sebelas',
        ];

        var bagi = 0;
        var penyimpanan = '';

        if (nilai < 12) {
            penyimpanan = ' ' + huruf[nilai];
        } else if (nilai < 20) {
            penyimpanan = terbilang(Math.floor(nilai - 10)) + ' Belas';
        } else if (nilai < 100) {
            bagi = Math.floor(nilai / 10);
            penyimpanan = terbilang(bagi) + ' Puluh' + terbilang(nilai % 10);
        } else if (nilai < 200) {
            penyimpanan = ' Seratus' + terbilang(nilai - 100);
        } else if (nilai < 1000) {
            bagi = Math.floor(nilai / 100);
            penyimpanan = terbilang(bagi) + ' Ratus' + terbilang(nilai % 100);
        } else if (nilai < 2000) {
            penyimpanan = ' Seribu' + terbilang(nilai - 1000);
        } else if (nilai < 1000000) {
            bagi = Math.floor(nilai / 1000);
            penyimpanan = terbilang(bagi) + ' Ribu' + terbilang(nilai % 1000);
        } else if (nilai < 1000000000) {
            bagi = Math.floor(nilai / 1000000);
            penyimpanan = terbilang(bagi) + ' Juta' + terbilang(nilai % 1000000);
        } else if (nilai < 1000000000000) {
            bagi = Math.floor(nilai / 1000000000);
            penyimpanan = terbilang(bagi) + ' Miliar' + terbilang(nilai % 1000000000);
        } else if (nilai < 1000000000000000) {
            bagi = Math.floor(nilai / 1000000000000);
            penyimpanan = terbilang(nilai / 1000000000000) + ' Triliun' + terbilang(nilai % 1000000000000);
        }

        return penyimpanan;
    }
</script>
