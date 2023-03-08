<?php

namespace App\Http\Controllers;

use App\Models\MediaNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MediaNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return view('dashboard.media.notification.index');
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
    public function show(MediaNotification $mediaNotification): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaNotification $mediaNotification): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MediaNotification $mediaNotification): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaNotification $mediaNotification): RedirectResponse
    {
        //
    }
}
