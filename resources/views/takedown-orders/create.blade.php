@extends('dashboard.layouts.main');

@section('container')
    @php
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
        $spkDate = date('d') . ' ' . $bulan[(int) date('m')] . ' ' . date('Y');
        $description = json_decode($location->description);
        $photo = $location->location_photos->where('set_default', true)->where('company_id', $company->id)->last();

        $dataProduct = new stdClass();
        $dataProduct->id = $location->id;
        $dataProduct->code = $location->code;
        $dataProduct->category = $location->media_category->name;
        $dataProduct->area = $location->area->area;
        $dataProduct->city = $location->city->city;
        $dataProduct->city_code = $location->city->code;
        $dataProduct->address = $location->address;
        $dataProduct->photo = $photo->photo;
        $dataProduct->description = $description;
        $dataProduct->size = $location->media_size->size;
        $dataProduct->width = $location->media_size->width;
        $dataProduct->height = $location->media_size->height;
        $dataProduct->side = $location->side;
        $dataProduct->orientation = $location->orientation;

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    <form method="post" action="/marketing/takedown-orders" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" id="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="location_id" id="company_id" value="{{ $location->id }}" hidden>
        <input type="text" id="product" name="product" value="{{ json_encode($dataProduct) }}" hidden>
        <input type="text" name="created_by" id="created_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="updated_by" id="updated_by" value="{{ json_encode($created_by) }}" hidden>
        <div class="flex justify-center w-full bg-black">
            <div class="mt-10">
                <div class="flex items-center w-[950px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[800px]">MENAMBAHKAN DATA SPK PENURUNAN GAMBAR</h1>
                    <!-- Title end -->
                    <div class="flex w-[130px] justify-end items-center p-1">
                        <button class="flex justify-center items-center mx-1 btn-success" title="Preview" type="submit">
                            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="ml-2 text-white">save</span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/takedown-orders/select-locations">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[950px] h-[1345px] bg-white mb-10 p-2 mt-2">
                        <!-- SPK Header start-->
                        @include('takedown-orders.spk-header')
                        <!-- SPK Header end-->

                        <!-- SPK Body start-->
                        @include('takedown-orders.spk-body')
                        <!-- SPK Body end-->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="/js/previewimage.js"></script>
@endsection
