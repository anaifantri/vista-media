@extends('dashboard.layouts.main');

@section('container')
    <div class="text-center">
        <h1 class="w-full text-xl text-emerald-700 font-bold tracking-wider mt-8"> Welcome back
            {{ auth()->user()->name }}
        </h1>
        <h1 class="w-full text-xl text-emerald-700 font-bold tracking-wider mt-2"> Have a nice day....</h1>
    </div>
@endsection
