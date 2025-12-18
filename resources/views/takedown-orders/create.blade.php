@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [
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
        $spkDate = date('d') . ' ' . $bulan[(int) date('m')] . ' ' . date('Y');
        $product = json_decode($install_order->product);
        $description = json_decode($location->description);

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    <form method="post" action="/marketing/takedown-orders" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="location_id" value="{{ $location->id }}" hidden>
        <input type="text" name="install_order_id" value="{{ $install_order->id }}" hidden>
        <input type="text" name="product" value="{{ $install_order->product }}" hidden>
        <input type="text" name="created_by" id="created_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="updated_by" id="updated_by" value="{{ json_encode($created_by) }}" hidden>
        <div class="flex justify-center w-full bg-black">
            <div class="mt-10">
                <div class="flex items-center w-[950px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[800px]">MENAMBAHKAN DATA SPK PENURUNAN GAMBAR</h1>
                    <!-- Title end -->
                    <div class="flex w-[130px] justify-end items-center p-1">
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/takedown-orders/select-locations/{{ $company->id }}">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="m12.012 2c5.518 0 9.997 4.48 9.997 9.998 0 5.517-4.479 9.997-9.997 9.997s-9.998-4.48-9.998-9.997c0-5.518 4.48-9.998 9.998-9.998zm-1.523 6.21s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Back</span>
                        </a>
                        <button class="flex justify-center items-center mx-1 btn-success" title="Preview" type="submit">
                            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="ml-2 text-white">save</span>
                        </button>
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
@endsection
