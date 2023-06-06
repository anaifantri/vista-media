<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // $users = User::with('sizes')->get();
        // $sizes = Size::with('user')->get();
        return response()-> view ('dashboard.media.sizes.index', [
            'sizes'=>Size::with(['user'])->get(),
            'title' => 'Daftar Ukuran'
            // compact('sizes', 'users')
        ]);
    }

    public function showSize(){
        $dataSize = Size::All();

        return response()->json(['dataSize'=> $dataSize]);
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
    public function show(Size $size): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size): RedirectResponse
    {
        Size::destroy($size->id);

        return redirect('/dashboard/media/sizes')->with('success','Ukuran '. $size->size . $size->side .' sisi '. $size->orientation .' berhasil dihapus');
    }
}
