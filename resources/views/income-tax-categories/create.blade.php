@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Objek Pajak start -->
    <!-- Form Create Objek Pajak start -->
    <form action="/accounting/income-tax-categories" method="post" class="d-inline">
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex justify-center w-full ">
                    <div class="flex w-[900px] border-b">
                        <!-- Title Area start -->
                        <h1 class="index-h1 w-[500px]"> MENAMBAHKAN OBJEK PPh</h1>
                        <!-- Title Area end -->
                        <div class="flex w-full justify-end items-center">
                            <button class="flex justify-center items-center mx-1 btn-primary" type="submit">
                                <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                </svg>
                                <span class="mx-1">Save</span>
                            </button>
                            <a class="flex justify-center items-center mx-1 btn-danger"
                                href="/accounting/income-tax-categories">
                                <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                </svg>
                                <span class="mx-1">Cancel</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                    <div class="w-full px-2">
                        <div class="flex mx-1 mt-3 items-center">
                            <label class="w-36 text-stone-100">Kode Objek Pajak</label>
                            <input name="code" class="input-area in-out-spin-none w-[200px]" value="{{ old('code') }}"
                                placeholder="Input Kode Objek Pajak" autofocus required>
                        </div>
                        @error('code')
                            <div class="text-red-600 flex mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex mx-1 mt-3 items-center">
                            <label class="w-36 text-stone-100">Nama Objek Pajak</label>
                            <textarea name="name" class="flex input-area w-[750px] @error('name') is-invalid @enderror" type="text"
                                placeholder="Input Nama Objek Pajak" rows="2" required>{{ old('name') }}</textarea>
                        </div>
                        @error('name')
                            <div class="text-red-600 flex mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex mx-1 mt-3 items-center">
                            <label class="w-36 text-stone-100">Tarif Pajak</label>
                            <input name="rates" class="input-area w-[160px] in-out-spin-none" type="number"
                                placeholder="Input Tarif" value="{{ old('rates') }}" required>
                        </div>
                        @error('rates')
                            <div class="text-red-600 flex mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Form Create Objek Pajak end -->
    <!-- Create Objek Pajak end -->
@endsection
