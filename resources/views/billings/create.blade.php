@extends('dashboard.layouts.main');

@section('container')
    @php
        $sales = $data_sales->where('company_id', $company->id);
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

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    <form method="post" action="/accounting/billings" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center w-full bg-black">
            <div class="mt-10">
                <div class="flex items-center w-[1200px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[1200px]">Membuat Data Penagihan</h1>
                    <!-- Title end -->
                    <div id="divButton" class="hidden w-[150px] justify-end">
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
                            onclick="previewBack()">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1 text-white">Back</span>
                        </button>
                        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="mx-1 text-white">Save</span>
                        </button>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[1200px] h-[650px] mb-10 p-2">
                        <!-- Modal Select Sale start-->
                        @include('billings.modal-select-sale')
                        <!-- Modal Select Sale end-->

                        <!-- Modal Select Term start-->
                        @include('billings.modal-select-term')
                        <!-- Modal Select Term end-->

                        <!-- Modal Input Faktur start-->
                        @include('billings.modal-input-faktur')
                        <!-- Modal Input Faktur end-->

                        <!-- Modal Select Document start-->
                        @include('billings.modal-select-documents')
                        <!-- Modal Select Document end-->

                        <!-- Modal Select Documentation start-->
                        @include('billings.modal-select-documentation')
                        <!-- Modal Select Documentation end-->

                        <!-- Modal Preview start-->
                        @include('billings.modal-preview')
                        <!-- Modal Preview end-->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Script Preview Image start-->
    <script src="/js/createbillings.js"></script>
    <!-- Script Preview Image end-->
@endsection
