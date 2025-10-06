@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Objek Pajak start -->
    <!-- Form Show Objek Pajak start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full ">
                <div class="flex w-[900px] border-b">
                    <!-- Title Area start -->
                    <h1 class="index-h1 w-[500px]"> DETAIL OBJEK PPh</h1>
                    <!-- Title Area end -->
                    <div class="flex w-full justify-end items-center">
                        <a href="/accounting/income-tax-categories/{{ $income_tax_category->id }}/edit"
                            class="flex items-center justify-center btn-warning mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Edit </span>
                        </a>
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/accounting/income-tax-categories">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Close</span>
                        </a>
                    </div>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="ml-2 flex alert-success">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            <div class="flex justify-center mt-4">
                <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                <div class="w-full px-2">
                    <div class="flex mx-1 mt-3 items-center">
                        <label class="w-36 text-stone-100">Kode Objek Pajak</label>
                        <input name="code" class="border rounded-lg text-white px-2 w-[200px]"
                            value="{{ $income_tax_category->code }}" placeholder="Input Kode Objek Pajak" disabled>
                    </div>
                    <div class="flex mx-1 mt-3 items-center">
                        <label class="w-36 text-stone-100">Nama Objek Pajak</label>
                        <textarea name="name" class="border rounded-lg text-white px-2 w-[750px] @error('name') is-invalid @enderror"
                            type="text" placeholder="Input Nama Objek Pajak" rows="2" disabled>{{ $income_tax_category->name }}</textarea>
                    </div>
                    <div class="flex mx-1 mt-3 items-center">
                        <label class="w-36 text-stone-100">Tarif Pajak</label>
                        <input name="rates" class="border rounded-lg text-white px-2 w-12 in-out-spin-none text-center"
                            type="number" placeholder="Input Tarif" value="{{ $income_tax_category->rates }}" disabled>
                        <label class="text-stone-100 ml-2">%</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Show Objek Pajak end -->
    <!-- Show Objek Pajak end -->
@endsection
