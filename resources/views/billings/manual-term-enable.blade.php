<div class="mt-2 text-sm" id="divManualTerms">
    <div class="border rounded-md border-stone-900 p-1">
        @if ($bill_terms[0]->set_collect == true)
            <div class="flex items-center">
                <input id="cbManualTerm0" type="checkbox" onclick="cbManualTerm(this)" checked>
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                    value="{{ $bill_terms[0]->title }}" onchange="inputTermTitle(this,0)">
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                    value="{{ $bill_terms[0]->number }}" onchange="inputTermNumber(this,0)">
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                    value="{{ $bill_terms[0]->term }}" onchange="inputTermValue(this,0)">
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms0" type="number"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[0]->nominal }}" onkeyup="inputNominalTerm(this)">
                <label class="ml-2">DPP</label>
                <input id="dppTerms" name="dppTerms0" type="number" onkeyup="inputDppTerm(this)"
                    value="{{ $bill_terms[0]->dpp }}" onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md">
                <label class="ml-2">PPN</label>
                <input id="ppnTerms" name="ppnTerms0" type="number" value="{{ $bill_terms[0]->ppn }}"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" readonly>
            </div>
        @else
            <div class="flex items-center">
                <input id="cbManualTerm0" type="checkbox" onclick="cbManualTerm(this)">
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md" disabled
                    value="{{ $bill_terms[0]->title }}" onchange="inputTermTitle(this,0)">
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md" disabled
                    value="{{ $bill_terms[0]->number }}" onchange="inputTermNumber(this,0)">
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md" disabled
                    value="{{ $bill_terms[0]->term }}" onchange="inputTermValue(this,0)">
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms0" type="number"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" disabled
                    value="{{ $bill_terms[0]->nominal }}" onkeyup="inputNominalTerm(this)">
                <label class="ml-2">DPP</label>
                <input id="dppTerms" name="dppTerms0" type="number" onkeyup="inputDppTerm(this)"
                    value="{{ $bill_terms[0]->dpp }}" onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" disabled>
                <label class="ml-2">PPN</label>
                <input id="ppnTerms" name="ppnTerms0" type="number" value="{{ $bill_terms[0]->ppn }}"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" disabled readonly>
            </div>
        @endif
    </div>
    <div class="border rounded-md border-stone-900  mt-1 p-1">
        @if ($bill_terms[1]->set_collect == true)
            <div class="flex items-center">
                <input id="cbManualTerm1" type="checkbox" onclick="cbManualTerm(this)" checked>
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                    value="{{ $bill_terms[1]->title }}" onchange="inputTermTitle(this,1)">
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                    value="{{ $bill_terms[1]->number }}" onchange="inputTermNumber(this,1)">
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                    value="{{ $bill_terms[1]->term }}" onchange="inputTermValue(this,1)">
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms1" type="number" onkeyup="inputNominalTerm(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[1]->nominal }}">
                <label class="ml-2">DPP</label>
                <input id="dppTerms" name="dppTerms1" type="number" onkeyup="inputDppTerm(this)"
                    onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[1]->dpp }}">
                <label class="ml-2">PPN</label>
                <input id="ppnTerms" name="ppnTerms1" type="number"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[1]->ppn }}" readonly>
            </div>
        @else
            <div class="flex items-center">
                <input id="cbManualTerm1" type="checkbox" onclick="cbManualTerm(this)">
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                    value="{{ $bill_terms[1]->title }}" onchange="inputTermTitle(this,1)" disabled>
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                    value="{{ $bill_terms[1]->number }}" onchange="inputTermNumber(this,1)" disabled>
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                    value="{{ $bill_terms[1]->term }}" onchange="inputTermValue(this,1)" disabled>
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms1" type="number" onkeyup="inputNominalTerm(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled>
                <label class="ml-2">DPP</label>
                <input id="dppTerms" name="dppTerms1" type="number" onkeyup="inputDppTerm(this)"
                    onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled>
                <label class="ml-2">PPN</label>
                <input id="ppnTerms" name="ppnTerms1" type="number"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled readonly>
            </div>
        @endif
    </div>
    <div class="border rounded-md border-stone-900  mt-1 p-1">
        @if ($bill_terms[2]->set_collect == true)
            <div class="flex items-center">
                <input id="cbManualTerm2" type="checkbox" onclick="cbManualTerm(this)" checked>
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                    value="{{ $bill_terms[2]->title }}" onchange="inputTermTitle(this,2)">
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                    value="{{ $bill_terms[2]->number }}" onchange="inputTermNumber(this,2)">
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                    value="{{ $bill_terms[2]->term }}" onchange="inputTermValue(this,2)">
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms2" type="number" onkeyup="inputNominalTerm(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[2]->nominal }}">
                <label class="ml-2">DPP</label>
                <input id="dppTerms" name="dppTerms2" type="number" onkeyup="inputDppTerm(this)"
                    onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[2]->dpp }}">
                <label class="ml-2">PPN</label>
                <input id="ppnTerms" name="ppnTerms2" type="number"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[2]->ppn }}" readonly>
            </div>
        @else
            <div class="flex items-center">
                <input id="cbManualTerm2" type="checkbox" onclick="cbManualTerm(this)">
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                    value="{{ $bill_terms[2]->title }}" onchange="inputTermTitle(this,2)" disabled>
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                    value="{{ $bill_terms[2]->number }}" onchange="inputTermNumber(this,2)" disabled>
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                    value="{{ $bill_terms[2]->term }}" onchange="inputTermValue(this,2)" disabled>
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms2" type="number" onkeyup="inputNominalTerm(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled>
                <label class="ml-2">DPP</label>
                <input id="dppTerms" name="dppTerms2" type="number" onkeyup="inputDppTerm(this)"
                    onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled>
                <label class="ml-2">PPN</label>
                <input id="ppnTerms" name="ppnTerms2" type="number"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled readonly>
            </div>
        @endif
    </div>
    <div class="border rounded-md border-stone-900  mt-1 p-1">
        @if ($bill_terms[3]->set_collect == true)
            <div class="flex items-center">
                <input id="cbManualTerm3" type="checkbox" onclick="cbManualTerm(this)" checked>
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                    value="{{ $bill_terms[3]->title }}" onchange="inputTermTitle(this,3)">
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                    value="{{ $bill_terms[3]->number }}" onchange="inputTermNumber(this,3)">
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                    value="{{ $bill_terms[3]->term }}" onchange="inputTermValue(this,3)">
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms3" type="number" onkeyup="inputNominalTerm(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[3]->nominal }}">
                <label class="ml-2" hidden>DPP</label>
                <input id="dppTerms" name="dppTerms3" type="number" onkeyup="inputDppTerm(this)"
                    onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[3]->dpp }}" hidden>
                <label class="ml-2" hidden>PPN</label>
                <input id="ppnTerms" name="ppnTerms3" type="number"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[3]->ppn }}" readonly hidden>
            </div>
        @else
            <div class="flex items-center">
                <input id="cbManualTerm3" type="checkbox" onclick="cbManualTerm(this)">
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                    value="{{ $bill_terms[3]->title }}" onchange="inputTermTitle(this,3)" disabled>
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                    value="{{ $bill_terms[3]->number }}" onchange="inputTermNumber(this,3)" disabled>
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                    value="{{ $bill_terms[3]->term }}" onchange="inputTermValue(this,3)" disabled>
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms3" type="number" onkeyup="inputNominalTerm(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled>
                <label class="ml-2" hidden>DPP</label>
                <input id="dppTerms" name="dppTerms3" type="number" onkeyup="inputDppTerm(this)"
                    onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled hidden>
                <label class="ml-2" hidden>PPN</label>
                <input id="ppnTerms" name="ppnTerms3" type="number"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled readonly hidden>
            </div>
        @endif
    </div>
    <div class="border rounded-md border-stone-900  mt-1 p-1">
        @if ($bill_terms[3]->set_collect == true)
            <div class="flex items-center">
                <input id="cbManualTerm4" type="checkbox" onclick="cbManualTerm(this)" checked>
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                    value="{{ $bill_terms[4]->title }}" onchange="inputTermTitle(this,4)">
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                    value="{{ $bill_terms[4]->number }}" onchange="inputTermNumber(this,4)">
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                    value="{{ $bill_terms[4]->term }}" onchange="inputTermValue(this,4)">
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms4" type="number" onkeyup="inputNominalTerm(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[4]->nominal }}">
                <label class="ml-2">DPP</label>
                <input id="dppTerms" name="dppTerms4" type="number" onkeyup="inputDppTerm(this)"
                    onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[4]->dpp }}">
                <label class="ml-2">PPN</label>
                <input id="ppnTerms" name="ppnTerms4" type="number"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md"
                    value="{{ $bill_terms[4]->ppn }}" readonly>
            </div>
        @else
            <div class="flex items-center">
                <input id="cbManualTerm4" type="checkbox" onclick="cbManualTerm(this)">
                <label class="ml-4 w-12">Jenis</label>
                <input id="termTitles" type="text" class="ml-3 px-2 outline-none w-[186px] rounded-md"
                    value="{{ $bill_terms[4]->title }}" onchange="inputTermTitle(this,4)" disabled>
                <label class="ml-2 w-[72px]">Termin ke-</label>
                <input id="termNumbers" type="text" class="ml-2 px-2 outline-none w-20 rounded-md"
                    value="{{ $bill_terms[4]->number }}" onchange="inputTermNumber(this,4)" disabled>
                <input id="termValues" type="text" class="ml-2 px-2 outline-none w-8 rounded-md"
                    value="{{ $bill_terms[4]->term }}" onchange="inputTermValue(this,4)" disabled>
                <label class="ml-2">%</label>
            </div>
            <div class="flex mt-1 ml-7">
                <label>Nominal</label>
                <input id="nominalTerms" name="nominalTerms4" type="number" onkeyup="inputNominalTerm(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled>
                <label class="ml-2">DPP</label>
                <input id="dppTerms" name="dppTerms4" type="number" onkeyup="inputDppTerm(this)"
                    onchange="inputDppTermChange(this)"
                    class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled>
                <label class="ml-2">PPN</label>
                <input id="ppnTerms" name="ppnTerms4" type="number"
                    class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0"
                    disabled readonly>
            </div>
        @endif
    </div>
</div>
