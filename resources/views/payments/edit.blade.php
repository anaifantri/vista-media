@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    @php
        $client = json_decode($billings[0]->client);
        $data_pph = [];
        $sale_nominal = [];
        $billing_nominal = [];

        $updated_by = new stdClass();
        $updated_by->id = auth()->user()->id;
        $updated_by->name = auth()->user()->name;
        $updated_by->position = auth()->user()->position;
    @endphp
    <form action="/accounting/payments/{{ $payment->id }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="updated_by" value="{{ json_encode($updated_by) }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <label class="flex text-xl text-stone-100 font-bold w-[850px]">
                        EDIT DATA PEMBAYARAN
                    </label>
                    <div class="flex items-center w-full justify-end">
                        <button class="flex justify-center items-center ml-1 btn-primary" type="submit">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-1 w-10 text-sm">Save</span>
                        </button>
                        <a href="/payments/index/{{ $company->id }}"
                            class="flex justify-center items-center mx-1 btn-danger" title="Back">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1 text-white">Cancel</span>
                        </a>
                    </div>
                </div>
                <!-- Title end -->

                <!-- Body start -->
                <div class="flex bg-stone-400 justify-center border rounded-lg w-[1200px] mt-2 p-4">
                    <div class="w-full">
                        <div class="text-sm text-stone-900 p-2 bg-stone-300 border border-stone-900 rounded-lg">
                            <div class="flex">
                                <label class="w-32">Perusahaan</label>
                                <label class="ml-2">:</label>
                                <label class="ml-2">
                                    @if (isset($client->company))
                                        {{ $client->company }}
                                    @elseif (isset($client->name))
                                        {{ $client->name }}
                                    @else
                                        {{ $client->contact_name }}
                                    @endif
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="w-32">Alamat</label>
                                <label class="ml-2">:</label>
                                <label class="ml-2">{{ $client->address }}</label>
                            </div>
                        </div>
                        <table class="table-auto w-full mt-2">
                            <thead>
                                <tr class="bg-stone-300">
                                    <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center">No.</th>
                                    <th class="text-stone-900 border border-stone-900 text-sm w-16 text-center">Jenis</th>
                                    <th class="text-stone-900 border border-stone-900 text-sm w-56 text-center">No. Invoice
                                    </th>
                                    <th class="text-stone-900 border border-stone-900 text-sm text-center">Lokasi</th>
                                    <th class="text-stone-900 border border-stone-900 text-sm w-28 text-center">Tagihan</th>
                                    <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center">PPh</th>
                                    <th class="text-stone-900 border border-stone-900 text-sm w-28 text-center">Pembayaran
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPph = $income_taxes->sum('nominal');
                                    $totalPpn = 0;
                                @endphp
                                @foreach ($billings as $billing)
                                    @php
                                        $invoice_content = json_decode($billing->invoice_content);
                                        $invoice_description = $invoice_content->description;

                                        $billingNominal = new stdClass();
                                        $billingNominal->billing_id = $billing->id;
                                        $billingNominal->nominal =
                                            $billing->nominal + $billing->ppn - ($billing->nominal * 2) / 100;
                                        array_push($billing_nominal, $billingNominal);
                                    @endphp
                                    <tr class="bg-stone-200">
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1  text-center">
                                            {{ $loop->iteration }}</td>
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1  text-center">
                                            @if ($billing->category == 'Service')
                                                Cetak/Pasang
                                            @else
                                                Media
                                            @endif
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                            <a
                                                href="/accounting/billings/{{ $billing->id }}">{{ $billing->invoice_number }}</a>
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                            <div>
                                                @foreach ($invoice_description as $itemDescription)
                                                    <span class="flex">{{ $itemDescription->location }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1 text-right">
                                            <div class="w-full">
                                                @foreach ($invoice_description as $itemDescription)
                                                    @php
                                                        $ppn = ($itemDescription->nominal * 11) / 100;
                                                        $totalPpn = $totalPpn + $ppn;
                                                    @endphp
                                                    <span id="inputBilling"
                                                        class="flex justify-end px-1">{{ number_format($itemDescription->nominal + $ppn) }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1 text-right">
                                            <div class="w-full">
                                                @foreach ($income_taxes as $income_tax)
                                                    <input id="inputPph" type="number" placeholder="Input Nominal PPh"
                                                        value="{{ round($income_tax->nominal) }}"
                                                        title="{{ $billing->id }}"
                                                        class="ml-1 text-sm outline-none border rounded-md px-1 w-full text-right in-out-spin-none"
                                                        onchange="setPph(this)" onfocus="inputPphAction(this)">
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1 text-right">
                                            <div class="w-full">
                                                @php
                                                    $indexPph = 0;
                                                @endphp
                                                @foreach ($invoice_description as $itemDescription)
                                                    @php
                                                        $ppn = ($itemDescription->nominal * 11) / 100;
                                                        $itemNominal = new stdClass();
                                                        $itemNominal->sale_id = $itemDescription->sale_id;
                                                        $itemNominal->nominal =
                                                            $itemDescription->nominal +
                                                            $ppn -
                                                            $income_taxes[$indexPph]->nominal;
                                                        array_push($sale_nominal, $itemNominal);
                                                    @endphp
                                                    <input id="inputNominal" type="number" title="{{ $billing->id }}"
                                                        placeholder="Input Nominal Pembayaran" onchange="setNominal(this)"
                                                        onfocus="inputNominalAction(this)"
                                                        value="{{ round($itemDescription->nominal + $ppn - $income_taxes[$indexPph]->nominal) }}"
                                                        class="text-sm outline-none border rounded-md px-1 w-full text-right in-out-spin-none"
                                                        required>
                                                    @php
                                                        $indexPph++;
                                                    @endphp
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="bg-stone-200">
                                    <td class="text-stone-900 border border-stone-900 text-sm px-1 font-bold text-right"
                                        colspan="4">Sub Total</td>
                                    <td id="billingTotal"
                                        class="text-stone-900 border border-stone-900 text-sm px-2 font-bold text-right">
                                        {{ number_format($billings->sum('nominal') + $billings->sum('ppn')) }}
                                    </td>
                                    <td id="totalPph"
                                        class="text-stone-900 border border-stone-900 text-sm px-2 font-bold text-right">
                                        {{ number_format($totalPph) }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm px-1 font-bold text-right">
                                        <input id="subTotal" type="number"
                                            value="{{ $billings->sum('nominal') + $billings->sum('ppn') - $totalPph }}"
                                            class="border rounded-md outline-none in-out-spin-none px-1 text-right w-full"
                                            readonly>

                                    </td>
                                </tr>
                                <tr class="bg-stone-200">
                                    <td class="text-stone-900 border border-stone-900 text-sm px-1 font-bold text-right"
                                        colspan="4">Potongan Lainnya</td>
                                    <td class="text-stone-900 border border-stone-900 bg-slate-400 text-sm px-1 font-bold text-right"
                                        colspan="2">
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm px-1 font-bold text-right">
                                        @if ($payment->other_fee)
                                            <input type="number" name="other_fee" id="otherFee"
                                                value="{{ $payment->other_fee->nominal }}"
                                                onchange="otherFeeChange(this)"
                                                class="border rounded-md outline-none in-out-spin-none px-1 text-right w-full">
                                        @else
                                            <input type="number" name="other_fee" id="otherFee" value="0"
                                                onchange="otherFeeChange(this)"
                                                class="border rounded-md outline-none in-out-spin-none px-1 text-right w-full">
                                        @endif
                                    </td>
                                </tr>
                                <tr class="bg-stone-200">
                                    <td class="text-stone-900 border border-stone-900 text-sm px-1 font-bold text-right"
                                        colspan="4">Grand Total</td>
                                    <td class="text-stone-900 border border-stone-900 bg-slate-400 text-sm px-1 font-bold text-right"
                                        colspan="2">
                                    </td>
                                    <td id="totalPayment"
                                        class="text-stone-900 border border-stone-900 text-sm px-1 font-bold text-right">
                                        {{ number_format($billings->sum('nominal') + $billings->sum('ppn') - $totalPph) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input id="inputDataPph" type="text" name="data_pph" value="{{ json_encode($data_pph) }}"
                            hidden>
                        <input id="inputSaleNominal" type="text" name="sale_nominal"
                            value="{{ json_encode($sale_nominal) }}" hidden>
                        <input id="inputBillingNominal" type="text" name="billing_nominal"
                            value="{{ json_encode($billing_nominal) }}" hidden>
                        <input id="nominal" name="nominal"
                            value="{{ $billings->sum('nominal') + $billings->sum('ppn') - $totalPph }}"
                            class="text-sm px-1 outline-none rounded-md w-full text-right" hidden>
                        <div class="text-sm text-stone-900 p-2 bg-stone-300 border border-stone-900 rounded-lg mt-4">
                            <div class="flex mt-4">
                                <label class="w-32">Tgl. Pembayaran</label>
                                <label class="ml-2">:</label>
                                <input name="payment_date" type="date"
                                    class="text-sm outline-none rounded-md px-1 ml-2"
                                    value="{{ $payment->payment_date }}" required>
                            </div>
                            <div class="flex mt-4">
                                <label class="w-32">Keterangan</label>
                                <label class="ml-2">:</label>
                                <textarea name="note" rows="3" class="outline-none border rounded-lg px-1 ml-2 w-[600px]">{{ $payment->note }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Body end -->
            </div>
        </div>
    </form>
    <!-- Container end -->
    <!-- Script start -->
    <script>
        const inputBilling = document.querySelectorAll("[id=inputBilling]");
        const inputNominal = document.querySelectorAll("[id=inputNominal]");
        const inputPph = document.querySelectorAll("[id=inputPph]");
        const totalPayment = document.getElementById("totalPayment");
        const subTotal = document.getElementById("subTotal");
        const otherFee = document.getElementById("otherFee");
        const totalPph = document.getElementById("totalPph");
        const nominal = document.getElementById("nominal");
        const inputDataPph = document.getElementById("inputDataPph");
        const inputSaleNominal = document.getElementById("inputSaleNominal");
        const inputBillingNominal = document.getElementById("inputBillingNominal");
        var billings = @json($billings);
        var dataPph = @json($data_pph);
        var saleNominal = @json($sale_nominal);
        var billingNominal = @json($billing_nominal);
        var index = "";

        inputPphAction = (sel) => {
            for (let i = 0; i < inputPph.length; i++) {
                if (inputPph[i] == document.activeElement) {
                    index = i;
                }
            }
        }

        setPph = (sel) => {
            if (sel.value > sel.defaultValue) {
                alert("Nominal pph tidak boleh melebihi 2% dari tagihan..!!");
                sel.value = sel.defaultValue;
            } else {
                var pphTitle = sel.title;
                inputNominal[index].value = Number(inputBilling[index].innerText.replace(/,/g, "")) - Number(
                    sel.value);
                dataPph[index].pph = sel.value;
                inputDataPph.value = JSON.stringify(dataPph);

                countTotalPayment(pphTitle);
            }
        }

        inputNominalAction = (sel) => {
            for (let i = 0; i < inputNominal.length; i++) {
                if (inputNominal[i] == document.activeElement) {
                    index = i;
                }
            }
        }

        setNominal = (sel) => {
            var nominalTitle = sel.title;
            if (sel.value > Number(inputBilling[index].innerText.replace(/,/g, "")) || sel.value == 0) {
                alert("Nominal pembayaran tidak boleh 0 dan tidak boleh melebihi total tagihan..!!");
                sel.value = sel.defaultValue;
            } else {
                countTotalPayment(nominalTitle);
            }
        }

        countTotalPayment = (title) => {
            var total = 0;
            var getPph = 0;
            var grandTotal = 0;
            for (let i = 0; i < inputNominal.length; i++) {
                saleNominal[i].nominal = Number(inputNominal[i].value);
                total = total + Number(inputNominal[i].value);
                getPph = getPph + Number(inputPph[i].value);
            }
            grandTotal = total - Number(otherFee.value);
            subTotal.value = total;
            totalPayment.innerText = grandTotal.toLocaleString();
            totalPph.innerText = getPph.toLocaleString();
            nominal.value = Number(total);
            inputSaleNominal.value = JSON.stringify(saleNominal);

            var getBillingNominal = 0;
            for (let i = 0; i < inputNominal.length; i++) {
                if (inputNominal[i].title == title) {
                    getBillingNominal = getBillingNominal + Number(inputNominal[i].value);
                }
            }

            for (let i = 0; i < billingNominal.length; i++) {
                if (billingNominal[i].billing_id == title) {
                    billingNominal[i].nominal = getBillingNominal;
                    inputBillingNominal.value = JSON.stringify(billingNominal);
                }
            }
        }

        otherFeeChange = (sel) => {
            var getTotal = Number(subTotal.value) - Number(sel.value);

            totalPayment.innerText = getTotal.toLocaleString();
            nominal.value = Number(getTotal);
        }
    </script>
    <!-- Script end -->
@endsection
