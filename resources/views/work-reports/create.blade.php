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
    <form method="post" action="/accounting/work-reports" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="sale_id" id="saleId" hidden>
        <input type="text" name="images" hidden>
        <input type="text" name="content" hidden>
        <input type="text" name="created_by" id="createdBy" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="updated_by" id="updatedBy" value="{{ json_encode($created_by) }}" hidden>
        <div class="flex justify-center bg-black p-10">
            <div>
                <div class="flex items-center w-[1200px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[1200px]">Membuat BAST</h1>
                    <!-- Title end -->
                    <div id="divButton" class="hidden w-[150px] justify-end">
                        @if ($work_category == 'media')
                            <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
                                onclick="previewMediaBack()">
                                <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                </svg>
                                <span class="mx-1 text-white">Back</span>
                            </button>
                        @elseif ($work_category == 'service')
                            <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
                                onclick="previewServiceBack()">
                                <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                </svg>
                                <span class="mx-1 text-white">Back</span>
                            </button>
                        @endif
                        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="mx-1 text-white">Save</span>
                        </button>
                    </div>
                    <div>
                        <a href="/work-reports/index/{{ $company->id }}"
                            class="flex justify-center items-center mx-1 btn-danger" title="Cancel">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1 text-white">Cancel</span>
                        </a>
                    </div>
                </div>
                @include('work-reports.sale-detail')
                <div class="flex justify-center w-full">
                    <div class="w-[1200px] mb-10 p-2">
                        <!-- Modal Select Sale start-->
                        @include('work-reports.modal-select-sale')
                        <!-- Modal Select Sale end-->

                        <!-- Modal Select Documentation start-->
                        @include('work-reports.modal-select-documentation')
                        <!-- Modal Select Documentation end-->

                        <!-- Modal Preview start-->
                        @include('work-reports.modal-preview')
                        <!-- Modal Preview end-->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Script Preview Image start-->
    <script src="/js/createworkreports.js"></script>
    <!-- Script Preview Image end-->
@endsection
