@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    @php
        $client = json_decode($billing->client);

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    <form action="/accounting/payments" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="billing_id" value="{{ $billing->id }}" hidden>
        <input type="text" name="created_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="updated_by" value="{{ json_encode($created_by) }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <label class="flex text-xl text-stone-100 font-bold w-[850px]">
                        INPUT DATA PEMBAYARAN
                    </label>
                    <div class="flex items-center w-full justify-end">
                        <a href="/payments/select-billing/{{ $company->id }}"
                            class="flex justify-center items-center mx-1 btn-primary" title="Back">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1 text-white">Back</span>
                        </a>
                        <button id="btnSave" name="btnSave" class="flex justify-center items-center ml-1 btn-primary"
                            type="submit">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-1 w-10 text-md">Save</span>
                        </button>
                        <a class="flex justify-center items-center ml-1 btn-danger"
                            href="/payments/index/{{ $company->id }}">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1 w-10 text-md">Cancel</span>
                        </a>
                    </div>
                </div>
                <!-- Title end -->

                <!-- Body start -->
                <div class="flex bg-stone-400 justify-center border rounded-lg w-[1200px] mt-2">
                    <div>
                        <div class="grid grid-cols-2 gap-2 w-[1200px] p-2">
                            <div class="text-md text-stone-900 p-2 bg-stone-300 border border-stone-900 rounded-lg">
                                <div class="flex">
                                    <label class="w-32">Nomor Invoice</label>
                                    <label class="ml-2">:</label>
                                    <label class="ml-2">{{ $billing->invoice_number }}</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="w-32">Nominal Tagihan</label>
                                    <label class="ml-2">:</label>
                                    <label class="ml-2">Rp.</label>
                                    <label class="ml-2 w-24 text-right">
                                        {{ number_format($billing->nominal) }}
                                    </label>
                                    <label>,-</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="w-32">Nominal Ppn</label>
                                    <label class="ml-2">:</label>
                                    <label class="ml-2">Rp.</label>
                                    <label class="ml-2 w-24 text-right">
                                        {{ number_format($billing->ppn) }}
                                    </label>
                                    <label>,-</label>
                                </div>
                                <div class="flex mt-1">
                                    <input type="checkbox" class="outline-none" onclick="cbPphAction(this)" checked>
                                    <label class="w-28 ml-1">PPh</label>
                                    <label class="ml-2">:</label>
                                    <label class="ml-2">Rp.</label>
                                    <input id="inputPph" name="pph" type="text" placeholder="Input Nominal PPh"
                                        value="{{ ($billing->nominal * 2) / 100 }}"
                                        class="text-md outline-none rounded-md px-1 ml-2 w-24 text-right"
                                        onchange="inputPphAction(this)">
                                    <label>,-</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="w-32">Total Pembayaran</label>
                                    <label class="ml-2">:</label>
                                    <label class="ml-2">Rp.</label>
                                    <input id="inputNominal" name="nominal" name="number" type="text"
                                        placeholder="Input Nominal Pembayaran" onchange="inputNominalAction(this)"
                                        value="{{ $billing->nominal + $billing->ppn - ($billing->nominal * 2) / 100 }}"
                                        class="text-md outline-none rounded-md px-1 ml-2 w-24 text-right" required>
                                    <label>,-</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="w-32">Tgl. Pembayaran</label>
                                    <label class="ml-2">:</label>
                                    <input name="payment_date" type="date"
                                        class="text-md outline-none rounded-md px-1 ml-2" value="{{ old('payment_date') }}"
                                        required>
                                </div>
                                <div class="flex mt-1">
                                    <label class="w-32">Keterangan</label>
                                    <label class="ml-2">:</label>
                                    <textarea class="ml-2 outline-none border rounded-lg text-md w-[420px] px-1" name="note" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="text-md text-stone-900 p-2 bg-stone-300 border border-stone-900 rounded-lg">
                                <div class="flex">
                                    <label class="w-32">Perusahaan</label>
                                    <label class="ml-2">:</label>
                                    <label class="ml-2">{{ $client->company }}</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="w-32">Alamat</label>
                                    <label class="ml-2">:</label>
                                    <label class="w-[400px] ml-2">{{ $client->address }}</label>
                                </div>
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
        const inputNominal = document.getElementById("inputNominal");
        const inputPph = document.getElementById("inputPph");
        var billingNominal = @json($billing->nominal);
        var billingPpn = @json($billing->ppn);
        var billingTotal = billingNominal + billingPpn;

        cbPphAction = (sel) => {
            if (sel.checked == true) {
                inputPph.removeAttribute('disabled');
                inputPph.value = inputPph.defaultValue;
                inputNominal.value = Number(billingTotal) - Number(inputPph.value);
            } else {
                inputPph.setAttribute('disabled', 'disabled');
                inputPph.value = 0;
                inputNominal.value = Number(billingTotal) - Number(inputPph.value);
            }
        }

        inputPphAction = (sel) => {
            inputNominal.value = Number(billingTotal) - Number(sel.value);
        }

        inputNominalAction = (sel) => {
            if (sel.value > billingTotal || sel.value == 0) {
                alert("Nominal pembayaran tidak boleh 0 dan tidak boleh melebihi total tagihan..!!");
                sel.value = sel.defaultValue;
            }
        }
    </script>
    <!-- Script end -->
@endsection
