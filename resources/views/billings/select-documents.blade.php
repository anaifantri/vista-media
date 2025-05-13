@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div>
                <div class="flex items-center w-[1200px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[1200px]">Membuat Invoice & Kwitansi</h1>
                    <!-- Title end -->
                    <div>
                        <a href="/billings/index/{{ $company->id }}" class="flex justify-center items-center mx-1 btn-danger"
                            title="Cancel">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1 text-white">Cancel</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[1200px] mb-10 p-2">
                        <div class="flex w-full bg-stone-400 rounded-xl items-center border-b p-2">
                            <span class="text-center w-full text-lg font-semibold">PILIH DOKUMEN PENDUKUNG
                                INVOICE/PENAGIHAN</span>
                        </div>
                        <div
                            class="grid grid-cols-3 gap-4 w-full h-[560px] bg-stone-200 mt-2 border rounded-lg border-stone-400 py-6 px-10">
                            <div class="border rounded-3xl bg-stone-800 p-2">
                                <div class="flex items-center justify-center p-2 text-white border-b-2 border-white">
                                    <input class="outline-none" type="radio" value="approvals" name="chooseDocument"
                                        checked onclick="rbChooseDocument(this)">
                                    <span class="ml-2">DOKUMEN PENAWARAN</span>
                                </div>
                                @php
                                    if (count($approvals) > 0) {
                                        $firstApprovalNumber = $approvals[0]->number;
                                    } else {
                                        $firstApprovalNumber = '';
                                    }
                                @endphp
                                @foreach ($approvals as $approval)
                                    @if ($loop->iteration == 1)
                                        <div class="text-white text-md flex mt-2">
                                            <input id="cbApprovals" value="{{ json_encode($approval) }}" type="checkbox"
                                                class="outline-none" onclick="cbApprovalsAction(this)">
                                            <span class="ml-2">Nomor : </span>
                                            <span class="ml-2">{{ $approval->number }}</span>
                                        </div>
                                    @else
                                        @if ($approval->number != $firstApprovalNumber)
                                            <div class="text-white text-md flex mt-2">
                                                <input value="{{ json_encode($approval) }}" id="cbApprovals" type="checkbox"
                                                    class="outline-none" onclick="cbApprovalsAction(this)">
                                                <span class="ml-2">Nomor : </span>
                                                <span class="ml-2">{{ $approval->number }}</span>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            <div class="border rounded-3xl bg-stone-800 p-2">
                                <div class="flex items-center justify-center p-2 text-white border-b-2 border-white">
                                    <input class="outline-none" type="radio" value="orders" name="chooseDocument"
                                        onclick="rbChooseDocument(this)">
                                    <span class="ml-2">DOKUMEN PO/SPK</span>
                                </div>
                                @php
                                    if (count($orders) > 0) {
                                        $firstOrderNumber = $orders[0]->number;
                                    } else {
                                        $firstOrderNumber = '';
                                    }
                                @endphp
                                @foreach ($orders as $order)
                                    @if ($loop->iteration == 1)
                                        <div class="text-white text-md flex mt-2">
                                            <input id="cbOrders" type="checkbox" class="outline-none"
                                                onclick="cbOrdersAction(this)" value="{{ json_encode($order) }}" disabled>
                                            <span class="ml-2">Nomor : </span>
                                            <span class="ml-2">{{ $order->number }}</span>
                                        </div>
                                    @else
                                        @if ($order->number != $firstOrderNumber)
                                            <div class="text-white text-md flex mt-2">
                                                <input id="cbOrders" type="checkbox" class="outline-none"
                                                    onclick="cbOrdersAction(this)" value="{{ json_encode($order) }}"
                                                    disabled>
                                                <span class="ml-2">Nomor : </span>
                                                <span class="ml-2">{{ $order->number }}</span>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            <div class="border rounded-3xl bg-stone-800">
                                <div class="flex items-center justify-center p-2 text-white border-b-2 border-white">
                                    <input class="outline-none" type="radio" value="agreements" name="chooseDocument"
                                        onclick="rbChooseDocument(this)">
                                    <span class="ml-2">DOKUMEN PERJANJIAN</span>
                                </div>
                                @php
                                    if (count($agreements) > 0) {
                                        $firstAgreementNumber = $agreements[0]->number;
                                    } else {
                                        $firstAgreementNumber = '';
                                    }
                                @endphp
                                @foreach ($agreements as $agreement)
                                    @if ($loop->iteration == 1)
                                        <div class="text-white text-md flex mt-2">
                                            <input id="cbAgreements" type="checkbox" class="outline-none"
                                                onclick="cbAgreementsAction(this)" value="{{ json_encode($agreement) }}"
                                                disabled>
                                            <span class="ml-2">Nomor : </span>
                                            <span class="ml-2">{{ $agreement->number }}</span>
                                        </div>
                                    @else
                                        @if ($agreement->number != $firstAgreementNumber)
                                            <div class="text-white text-md flex mt-2">
                                                <input id="cbAgreements" type="checkbox" class="outline-none"
                                                    onclick="cbAgreementsAction(this)"
                                                    value="{{ json_encode($agreement) }}" disabled>
                                                <span class="ml-2">Nomor : </span>
                                                <span class="ml-2">{{ $agreement->number }}</span>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end mt-2 p-1">
                            <form class="m-1" action="/billings/select-terms/{{ json_encode($sale_id) }}">
                                <button class="flex justify-center items-center mx-1 btn-primary" title="Back"
                                    type="submit">
                                    <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                    </svg>
                                    <span class="mx-1 text-white">Back</span>
                                </button>
                                <input type="text" name="model" value="{{ $model }}" hidden>
                            </form>
                            <form class="m-1" action="/billings/create-media-billing" method="post">
                                @csrf
                                <input type="text" name="model" value="{{ $model }}" hidden>
                                <input type="text" id="inputReceipt" name="receipt_content"
                                    value="{{ json_encode($receipt_content) }}" hidden>
                                <input type="text" id="inputInvoice" name="invoice_content"
                                    value="{{ json_encode($invoice_content) }}" hidden>
                                <input type="text" name="client" value="{{ json_encode($client) }}" hidden>
                                <input type="text" name="sale_id" value="{{ json_encode($sale_id) }}" hidden>
                                <input type="text" name="sale_year" value="{{ $sale_year }}" hidden>
                                <input type="text" name="sale_number" value="{{ $sale_number }}" hidden>
                                <input type="text" id="merge" name="merge" value="normal" hidden>
                                <button class="flex justify-center items-center mx-1 btn-success" title="Next"
                                    type="submit">
                                    <span class="mx-1 text-white">Next</span>
                                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cbApprovals = document.querySelectorAll('[id=cbApprovals]');
        const cbOrders = document.querySelectorAll('[id=cbOrders]');
        const cbAgreements = document.querySelectorAll('[id=cbAgreements]');
        const inputInvoice = document.getElementById("inputInvoice");
        var approvals = [];
        var orders = [];
        var agreements = [];

        let invoiceContent = JSON.parse(inputInvoice.value);

        cbApprovalsAction = (sel) => {
            if (sel.checked == true) {
                approvals.push(JSON.parse(sel.value));
                invoiceContent.approval = approvals;
                invoiceContent.orders = orders;
                invoiceContent.agreements = agreements;
                inputInvoice.value = JSON.stringify(invoiceContent);
            } else {
                for (let i = 0; i < approvals.length; i++) {
                    if (approvals[i].id == sel.value.id) {
                        approvals.splice(i, 1);
                        invoiceContent.approval = approvals;
                        invoiceContent.orders = orders;
                        invoiceContent.agreements = agreements;
                        inputInvoice.value = JSON.stringify(invoiceContent);
                    }
                }
            }
        }

        cbOrdersAction = (sel) => {
            if (sel.checked == true) {
                orders.push(JSON.parse(sel.value));
                invoiceContent.approval = approvals;
                invoiceContent.orders = orders;
                invoiceContent.agreements = agreements;
                inputInvoice.value = JSON.stringify(invoiceContent);
            } else {
                for (let i = 0; i < orders.length; i++) {
                    if (orders[i].id == sel.value.id) {
                        orders.splice(i, 1);
                        invoiceContent.approval = approvals;
                        invoiceContent.orders = orders;
                        invoiceContent.agreements = agreements;
                        inputInvoice.value = JSON.stringify(invoiceContent);
                    }
                }
            }
        }

        cbAgreementsAction = (sel) => {
            if (sel.checked == true) {
                agreements.push(JSON.parse(sel.value));
                invoiceContent.approval = approvals;
                invoiceContent.orders = orders;
                invoiceContent.agreements = agreements;
                inputInvoice.value = JSON.stringify(invoiceContent);
            } else {
                for (let i = 0; i < agreements.length; i++) {
                    if (agreements[i].id == sel.value.id) {
                        agreements.splice(i, 1);
                        invoiceContent.approval = approvals;
                        invoiceContent.orders = orders;
                        invoiceContent.agreements = agreements;
                        inputInvoice.value = JSON.stringify(invoiceContent);
                    }
                }
            }
        }

        rbChooseDocument = (sel) => {
            if (sel.value == "approvals") {
                disableOrders();
                disableAgreements();
                enableApprovals();
                agreements = [];
                // inputAgreements.value = "";
                orders = [];
                // inputOrders.value = "";
            } else if (sel.value == "orders") {
                enableOrders();
                disableAgreements();
                disableApprovals();
                agreements = [];
                // inputAgreements.value = "";
                approvals = [];
                // inputApprovals.value = "";
            } else {
                disableOrders();
                enableAgreements();
                disableApprovals();
                approvals = [];
                // inputApprovals.value = "";
                orders = [];
                // inputOrders.value = "";
            }

        }

        disableApprovals = () => {
            for (let i = 0; i < cbApprovals.length; i++) {
                cbApprovals[i].checked = false;
                cbApprovals[i].setAttribute('disabled', 'disabled');
            }
        }
        enableApprovals = () => {
            for (let i = 0; i < cbApprovals.length; i++) {
                cbApprovals[i].removeAttribute('disabled');
            }
        }

        disableOrders = () => {
            for (let i = 0; i < cbOrders.length; i++) {
                cbOrders[i].checked = false;
                cbOrders[i].setAttribute('disabled', 'disabled');
            }
        }
        enableOrders = () => {
            for (let i = 0; i < cbOrders.length; i++) {
                cbOrders[i].removeAttribute('disabled');
            }
        }

        disableAgreements = () => {
            for (let i = 0; i < cbAgreements.length; i++) {
                cbAgreements[i].checked = false;
                cbAgreements[i].setAttribute('disabled', 'disabled');
            }
        }
        enableAgreements = () => {
            for (let i = 0; i < cbAgreements.length; i++) {
                cbAgreements[i].removeAttribute('disabled');
            }
        }
    </script>
@endsection
