<div class="mt-2 text-sm" id="divManualTerms">
    <div class="border rounded-md border-stone-900 p-1">
        <div class="flex items-center">
            <input id="cbManualTerm0" type="checkbox" onclick="cbManualTerm(this)" disabled>
            <label class="ml-4 w-12">Jenis</label>
            <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md" value="Produksi"
                onchange="inputTermTitle(this,0)" disabled>
            <label class="ml-2 w-[72px]">Termin ke-</label>
            <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                onchange="inputTermNumber(this,0)" disabled>
            <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                onchange="inputTermValue(this,0)" disabled>
            <label class="ml-2">%</label>
        </div>
        <div class="flex mt-1 ml-7">
            <label>Nominal</label>
            <input id="nominalTerms" name="nominalTerms0" type="number"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                onkeyup="inputNominalTerm(this)" disabled>
            <label class="ml-2">DPP</label>
            <input id="dppTerms" name="dppTerms0" type="number" onkeyup="inputDppTerm(this)"
                onchange="inputDppTermChange(this)"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0" disabled>
            <label class="ml-2">PPN</label>
            <input id="ppnTerms" name="ppnTerms0" type="number"
                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0" disabled
                readonly>
        </div>
    </div>
    <div class="border rounded-md border-stone-900  mt-1 p-1">
        <div class="flex items-center">
            <input id="cbManualTerm1" type="checkbox" onclick="cbManualTerm(this)" disabled>
            <label class="ml-4 w-12">Jenis</label>
            <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                value="Pemakaian Listrik" onchange="inputTermTitle(this,1)" disabled>
            <label class="ml-2 w-[72px]">Termin ke-</label>
            <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                onchange="inputTermNumber(this,1)" disabled>
            <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                onchange="inputTermValue(this,1)" disabled>
            <label class="ml-2">%</label>
        </div>
        <div class="flex mt-1 ml-7">
            <label>Nominal</label>
            <input id="nominalTerms" name="nominalTerms1" type="number" onkeyup="inputNominalTerm(this)"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0" disabled>
            <label class="ml-2">DPP</label>
            <input id="dppTerms" name="dppTerms1" type="number" onkeyup="inputDppTerm(this)"
                onchange="inputDppTermChange(this)"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0" disabled>
            <label class="ml-2">PPN</label>
            <input id="ppnTerms" name="ppnTerms1" type="number"
                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0" disabled
                readonly>
        </div>
    </div>
    <div class="border rounded-md border-stone-900  mt-1 p-1">
        <div class="flex items-center">
            <input id="cbManualTerm2" type="checkbox" onclick="cbManualTerm(this)" disabled>
            <label class="ml-4 w-12">Jenis</label>
            <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md" value="Jasa"
                onchange="inputTermTitle(this,2)" disabled>
            <label class="ml-2 w-[72px]">Termin ke-</label>
            <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                onchange="inputTermNumber(this,2)" disabled>
            <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                onchange="inputTermValue(this,2)" disabled>
            <label class="ml-2">%</label>
        </div>
        <div class="flex mt-1 ml-7">
            <label>Nominal</label>
            <input id="nominalTerms" name="nominalTerms2" type="number" onkeyup="inputNominalTerm(this)"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0" disabled>
            <label class="ml-2">DPP</label>
            <input id="dppTerms" name="dppTerms2" type="number" onkeyup="inputDppTerm(this)"
                onchange="inputDppTermChange(this)"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0" disabled>
            <label class="ml-2">PPN</label>
            <input id="ppnTerms" name="ppnTerms2" type="number"
                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0" disabled
                readonly>
        </div>
    </div>
    <div class="border rounded-md border-stone-900  mt-1 p-1">
        <div class="flex items-center">
            <input id="cbManualTerm3" type="checkbox" onclick="cbManualTerm(this)" disabled>
            <label class="ml-4 w-12">Jenis</label>
            <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                value="Pajak Reklame" onchange="inputTermTitle(this,3)" disabled>
            <label class="ml-2 w-[72px]">Termin ke-</label>
            <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                onchange="inputTermNumber(this,3)" disabled>
            <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                onchange="inputTermValue(this,3)" disabled>
            <label class="ml-2">%</label>
        </div>
        <div class="flex mt-1 ml-7">
            <label>Nominal</label>
            <input id="nominalTerms" name="nominalTerms3" type="number" onkeyup="inputNominalTerm(this)"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0" disabled>
            <label class="ml-2" hidden>DPP</label>
            <input id="dppTerms" name="dppTerms3" type="number" onkeyup="inputDppTerm(this)"
                onchange="inputDppTermChange(this)"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0" disabled
                hidden>
            <label class="ml-2" hidden>PPN</label>
            <input id="ppnTerms" name="ppnTerms3" type="number"
                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0" disabled
                readonly hidden>
        </div>
    </div>
    <div class="border rounded-md border-stone-900  mt-1 p-1">
        <div class="flex items-center">
            <input id="cbManualTerm4" type="checkbox" onclick="cbManualTerm(this)" disabled>
            <label class="ml-4 w-12">Jenis</label>
            <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                placeholder="Lainnya" onchange="inputTermTitle(this,4)" disabled>
            <label class="ml-2 w-[72px]">Termin ke-</label>
            <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                onchange="inputTermNumber(this,4)" disabled>
            <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                onchange="inputTermValue(this,4)" disabled>
            <label class="ml-2">%</label>
        </div>
        <div class="flex mt-1 ml-7">
            <label>Nominal</label>
            <input id="nominalTerms" name="nominalTerms4" type="number" onkeyup="inputNominalTerm(this)"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0" disabled>
            <label class="ml-2">DPP</label>
            <input id="dppTerms" name="dppTerms4" type="number" onkeyup="inputDppTerm(this)"
                onchange="inputDppTermChange(this)"
                class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0" disabled>
            <label class="ml-2">PPN</label>
            <input id="ppnTerms" name="ppnTerms4" type="number"
                class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0" disabled
                readonly>
        </div>
    </div>
</div>
