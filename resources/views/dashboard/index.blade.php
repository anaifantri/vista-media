@extends('dashboard.layouts.main');

@section('container')
    <div class="text-center w-full">
        <h1 class="w-full text-xl text-emerald-700 font-bold tracking-wider mt-8"> Welcome back
            {{ auth()->user()->name }}
        </h1>
        <h1 class="w-full text-xl text-emerald-700 font-bold tracking-wider mt-2"> Have a nice day....</h1>
        <h1 class="w-full text-md text-emerald-700 tracking-wider mt-24"> Today's Quote :</h1>
        <h1 id="quote" name="quote"
            class="w-full text-xl text-emerald-700 font-semibold italic tracking-wider mt-4 px-10">
        </h1>
        <h1 id="author" name="author" class="w-full text-sm text-emerald-700 tracking-wider mt-4"></h1>
    </div>

    <script src="/js/quote.js"></script>
@endsection
