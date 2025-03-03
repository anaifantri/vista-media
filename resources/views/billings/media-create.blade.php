@extends('dashboard.layouts.main');

@section('container')
    @php
        function terbilang($nilai)
        {
            $huruf = [
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
            if ($nilai == 0) {
                return '';
            } elseif (($nilai < 12) & ($nilai != 0)) {
                return '' . $huruf[$nilai];
            } elseif ($nilai < 20) {
                return Terbilang($nilai - 10) . ' Belas ';
            } elseif ($nilai < 100) {
                return Terbilang($nilai / 10) . ' Puluh ' . Terbilang($nilai % 10);
            } elseif ($nilai < 200) {
                return ' Seratus ' . Terbilang($nilai - 100);
            } elseif ($nilai < 1000) {
                return Terbilang($nilai / 100) . ' Ratus ' . Terbilang($nilai % 100);
            } elseif ($nilai < 2000) {
                return ' Seribu ' . Terbilang($nilai - 1000);
            } elseif ($nilai < 1000000) {
                return Terbilang($nilai / 1000) . ' Ribu ' . Terbilang($nilai % 1000);
            } elseif ($nilai < 1000000000) {
                return Terbilang($nilai / 1000000) . ' Juta ' . Terbilang($nilai % 1000000);
            } elseif ($nilai < 1000000000000) {
                return Terbilang($nilai / 1000000000) . ' Milyar ' . Terbilang($nilai % 1000000000);
            } elseif ($nilai < 100000000000000) {
                return Terbilang($nilai / 1000000000000) . ' Trilyun ' . Terbilang($nilai % 1000000000000);
            } elseif ($nilai <= 100000000000000) {
                return 'Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar';
            }
        }
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $month = [
            1 => 'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des',
        ];

        $manual_terms = [];
        $dataTitles = ['Produksi', 'Pemakaian Listrik', 'Jasa', 'Pajak Reklame', 'Lainnya'];
        for ($indexManual = 0; $indexManual < count($dataTitles); $indexManual++) {
            $manual_term = new stdClass();
            $manual_term->title = $dataTitles[$indexManual];
            $manual_term->number = '';
            $manual_term->term = 0;
            $manual_term->nominal = 0;
            $manual_term->dpp = 0;
            $manual_term->ppn = 0;
            $manual_term->set_collect = false;
            array_push($manual_terms, $manual_term);
        }

        $auto_terms = [];
        $indexAuto = 0;
        foreach ($payment_terms->dataPayments as $paymentTerm) {
            $indexAuto++;
            $auto_term = new stdClass();
            $auto_term->title = 'Penempatan';
            $auto_term->number = $indexAuto;
            $auto_term->term = $paymentTerm->term;
            $auto_term->nominal = $sale->price * ($paymentTerm->term / 100);
            $auto_term->dpp = round((($sale->price * ($paymentTerm->term / 100)) / 12) * 11);
            $auto_term->ppn = $sale->price * ($paymentTerm->term / 100) * ($sale->ppn / 100);
            $auto_term->set_collect = false;
            array_push($auto_terms, $auto_term);
        }

        foreach ($price->dataTitle as $dataTitle) {
            if ($dataTitle->checkbox == true) {
                $priceTitle = $dataTitle->title;
            }
        }

        if (request('set_preview')) {
            if (request('set_preview') == true) {
                $set_preview = true;
            } else {
                $set_preview = false;
            }
        } else {
            $set_preview = false;
        }

        $bill_terms = [];

        if (request('bill_terms')) {
            $bill_terms = json_decode(request('bill_terms'));
        } else {
            if (request('rbTerms') == 'manualTerm') {
                $bill_terms = $manual_term;
            } else {
                $bill_terms = $auto_terms;
            }
        }

        $totalNominal = 0;
        $totalPpn = 0;
        $totalDpp = 0;
        $grandTotal = 0;

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    {{-- <form method="post" action="/accounting/billings" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="sale_id" id="saleId" hidden>
        <input type="text" name="term" id="billTerms" hidden>
        <input type="text" name="dpp" id="billDpp" hidden>
        <input type="text" name="nominal" id="billNominal" hidden>
        <input type="text" name="order" id="orderDocument" hidden>
        <input type="text" name="approval" id="approvalDocument" hidden>
        <input type="text" name="agreement" id="agreementDocument" hidden>
        <input type="text" name="created_by" id="createdBy" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="updated_by" id="updatedBy" value="{{ json_encode($created_by) }}" hidden> --}}
    <div class="flex justify-center bg-black p-10">
        <div>
            <div class="flex items-center w-[1200px] border-b px-2">
                <!-- Title start -->
                <h1 class="index-h1 w-[1200px]">Membuat Invoice & Kwitansi</h1>
                <!-- Title end -->
                <div id="divButton" class="hidden w-[150px] justify-end">
                    <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
                        onclick="previewMediaBack()">
                        <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                        </svg>
                        <span class="mx-1 text-white">Back</span>
                    </button>
                    <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button">
                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                        </svg>
                        <span class="mx-1 text-white">Save</span>
                    </button>
                </div>
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
            @include('billings.sale-detail')
            <div class="flex justify-center w-full">
                <div class="w-[1200px] mb-10 p-2">
                    <!-- Modal Select Sale start-->
                    {{-- @include('billings.modal-select-sale') --}}
                    <!-- Modal Select Sale end-->

                    <!-- Modal Select Term start-->
                    @include('billings.modal-select-term')
                    <!-- Modal Select Term end-->

                    <!-- Modal Input Faktur start-->
                    {{-- @include('billings.modal-input-faktur') --}}
                    <!-- Modal Input Faktur end-->

                    <!-- Modal Select Document start-->
                    {{-- @include('billings.modal-select-documents') --}}
                    <!-- Modal Select Document end-->

                    <!-- Modal Select Documentation start-->
                    {{-- @include('billings.modal-select-documentation') --}}
                    <!-- Modal Select Documentation end-->

                    <!-- Modal Preview start-->
                    @include('billings.modal-preview')
                    <!-- Modal Preview end-->
                </div>
            </div>
        </div>
    </div>
    {{-- </form> --}}

    <!-- Script Preview Image start-->
    <script src="/js/createbillings.js"></script>
    <!-- Script Preview Image end-->
@endsection
