<?php

namespace App\Http\Controllers;

use App\Models\Led;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $leds = LED::with('vendor')->get();
        $vendors = Vendor::with('leds')->get();
        $users = User::with('leds')->get();

        return response()-> view ('dashboard.media.leds.index', [
            'leds'=>Led::all(),
            'title' => 'Daftar Jenis LED',
            compact('leds', 'users', 'vendors')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Led $led): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Led $led): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Led $led): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Led $led): RedirectResponse
    {
        //
    }
}
