@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    <form method="post" action="/workshop/installation-photos/{{ $installation_photo->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center  py-10 px-14 bg-stone-800">
            <div class="bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[780px] items-center border-b p-1">
                    <label class="flex text-xl text-stone-100 font-bold w-[850px]"> MENGGANTI FOTO
                        @if ($installation_photo->type == 'day')
                            SIANG
                        @else
                            MALAM
                        @endif
                    </label>
                    <div class="flex items-center w-full justify-end">
                        <button id="btnSave" name="btnSave" class="flex justify-center items-center ml-1 btn-primary"
                            type="submit">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Save</span>
                        </button>
                        <a class="flex justify-center items-center ml-1 btn-danger"
                            href="/installation-photos/show/{{ $installation_photo->install_order_id }}">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Cancel</span>
                        </a>
                    </div>
                </div>
                <!-- Title end -->

                <!-- Edit Documentation start -->
                <div class="flex justify-center w-full mt-2">
                    <div class="flex justify-start border rounded-lg w-[780px] p-4">
                        <div class="w-[750px]">
                            <div class="flex w-full justify-center">
                                <input type="hidden" name="oldPhoto" value="{{ $installation_photo->image }}">
                                <input type="file" id="image" name="image" onchange="previewImage(this)" hidden>
                                <button id="btnChooseImages" class="flex justify-center items-center w-44 btn-primary-small"
                                    title="Chose Files" type="button" onclick="document.getElementById('image').click()">
                                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                    </svg>
                                    <span class="ml-2">Pilih Foto
                                        @if ($installation_photo->type == 'day')
                                            Siang
                                        @else
                                            Malam
                                        @endif
                                    </span>
                                </button>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('image.*')
                                <div class="invalid-feedback">
                                    Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                </div>
                            @enderror
                            <div class="relative m-auto w-[750px] h-max mt-2">
                                <img class="m-auto img-preview flex items-center"
                                    src="{{ asset('storage/' . $installation_photo->image) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Documentation end -->
            </div>
        </div>
    </form>
    <!-- Container end -->
    <!-- Script start -->
    <script src="/js/previewimage.js"></script>
    <!-- Script end -->
@endsection
