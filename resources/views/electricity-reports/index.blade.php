@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full p-1 border-b">
                <label class="text-lg text-stone-100 font-bold">Data-Data Kelistrikan</label>
            </div>
            <div class="grid grid-cols-3 gap-4 w-[950px] p-6">
                <a href="/workshop/electricity-reports/power"
                    class="flex justify-center text-yellow-400 hover:text-stone-900 items-center h-[60px] bg-stone-900 hover:bg-stone-400 border rounded-lg shadow-lg cursor-pointer">
                    <div>
                        <label class="flex justify-center font-serif text-md font-semibold cursor-pointer">DAYA
                            LISTRIK</label>
                    </div>
                </a>
                <a href="/workshop/electricity-reports/payment"
                    class="flex justify-center text-yellow-400 hover:text-stone-900 items-center h-[60px] bg-stone-900 hover:bg-stone-400 border rounded-lg shadow-lg cursor-pointer">
                    <div>
                        <label class="flex justify-center font-serif text-md font-semibold cursor-pointer">PEMBAYARAN
                            LISTRIK</label>
                    </div>
                </a>
                <a href="/workshop/electricity-reports/topup"
                    class="flex justify-center text-yellow-400 hover:text-stone-900 items-center h-[60px] bg-stone-900 hover:bg-stone-400 border rounded-lg shadow-lg cursor-pointer">
                    <div>
                        <label class="flex justify-center font-serif text-md font-semibold cursor-pointer">PENGISIAN PULSA
                            LISTRIK</label>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
