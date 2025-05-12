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
                            <span class="text-center w-full text-lg font-semibold">PILIH MODEL INVOICE/PENAGIHAN</span>
                        </div>
                        <div
                            class="grid grid-cols-2 gap-8 w-full h-[560px] bg-stone-200 mt-2 border rounded-lg border-stone-400 py-6 px-20">
                            <form action="/billings/select-sale/media/{{ $company->id }}">
                                <div
                                    class="flex justify-center items-center border rounded-3xl bg-stone-800 h-32 cursor-pointer hover:bg-stone-700 text-xl text-white font-bold tracking-wider">
                                    <button class="flex justify-center items-center w-full h-full" type="submit">
                                        Invoice Berdasarkan Termin Pembayaran
                                    </button>
                                    <input type="text" name="model" value="auto" hidden>
                                </div>
                            </form>
                            <form action="/billings/select-sale/media/{{ $company->id }}">
                                <div
                                    class="flex justify-center items-center border rounded-3xl bg-stone-800 h-32 cursor-pointer hover:bg-stone-700 text-xl text-white font-bold tracking-wider">
                                    <button class="flex justify-center items-center w-full h-full" type="submit">
                                        Invoice Dengan Input Manual
                                    </button>
                                    <input type="text" name="model" value="manual" hidden>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script></script>
@endsection
