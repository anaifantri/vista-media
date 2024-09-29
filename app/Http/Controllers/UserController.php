<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Owner' ){
            return response()->view('users.index', [
                'users' => User::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
                'title' => 'Daftar User',
                'categories' => MediaCategory::all()
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $this->authorize('isAdmin');

        return response()->view('users.create', [
            'title' => 'Menambah Data Pengguna',
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('isAdmin');
        if($request->password != $request->confirm_password){
            return back()->withErrors(['confirm_password' => ['Konfirmasi password tidak sesuai']])->withInput();
        }

        if ($request->gender == 'pilih'){
            return back()->withErrors(['gender' => ['Silahkan pilih jenis kelamin']])->withInput();
        }
        if ($request->division == 'pilih'){
            return back()->withErrors(['division' => ['Silahkan pilih divisi']])->withInput();
        }
        if ($request->position == 'pilih'){
            return back()->withErrors(['position' => ['Silahkan pilih jabatan']])->withInput();
        }
        if ($request->level == 'pilih'){
            return back()->withErrors(['level' => ['Silahkan pilih level akses']])->withInput();
        }

        $validateData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:6|unique:users',
            'email' => 'required|email:dns|unique:users',
            'phone' => 'required|unique:users',
            'gender' => 'required',
            'level' => 'required',
            'division' => 'required',
            'position' => 'required',
            'password' => 'required|min:8',
            'avatar' => 'image|file|max:1024'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        $validateData['online_status'] = 0;
        $validateData['active_status'] = 1;

        if($request->file('avatar')){
            $validateData['avatar'] = $request->file('avatar')->store('user-images');
        }

        User::create($validateData);
        
        return redirect('/users')->with('success','Data pengguna baru dengan nama'. $request->name . ' berhasil ditambahkan');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        if($user->id === auth()->user()->id){
            return response()->view('users.show', [
                'user' => $user,
                'title' => 'Detail User',
                'categories' => MediaCategory::all()
            ]);
        } else if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Owner' ){
            return response()->view('users.show', [
                'user' => $user,
                'title' => 'Detail User',
                'categories' => MediaCategory::all()
            ]);
        } else {
            abort(401);
        }
        }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): Response
    {
        if($user->id === auth()->user()->id){
            return response()->view('users.edit', [
                'user' => $user,
                'title' => 'Edit User',
                'categories' => MediaCategory::all()
            ]);
        } else {
            $this->authorize('isAdmin');
            
            return response()->view('users.edit', [
                'user' => $user,
                'title' => 'Edit User',
                'categories' => MediaCategory::all()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required',
            'level' => 'required',
            'division' => 'required',
            'position' => 'required',
            'avatar' => 'image|file|max:1024'
        ];

        if($request->email != $user->email){
            $rules['email'] = 'required|email:dns|unique:users';
        }

        if($request->username != $user->username){
            $rules['username'] = 'required|min:6|unique:users';
        } 

        if($request->phone != $user->phone){
            $rules['phone'] = 'required|unique:users';
        }
        if($request->password){
            $rules['password'] = 'required|min:8';
        }

        $validateData = $request->validate($rules);

        if($request->password){
            $validateData['password'] = Hash::make($validateData['password']);
        }

        if($request->file('avatar')){
            if($request->oldAvatar){
                Storage::delete($request->oldAvatar);
            }
            $validateData['avatar'] = $request->file('avatar')->store('user-images');
        }

        User::where('id', $user->id)
                ->update($validateData);

        if(auth()->user()->level === 'Administrator'){
            return redirect('/users')->with('success','Data pengguna dengan nama ' . $user->name. ' berhasil diupdate');
        } else {
            return redirect('/users/' . $user->id)->with('success','Data pengguna dengan nama ' . $user->name. ' berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('isAdmin');

        $dataUsers = User::where('level', 'Administrator')->get();
        if(count($dataUsers) == 1){
            return back()->withErrors(['delete' => ['Gagal untuk menghapus data pengguna, minimal harus ada 1 pengguna dengan level Administrator']]);
        }
        
        if($user->avatar){
            Storage::delete($user->avatar);
        }

        User::destroy($user->id);

        return redirect('/users')->with('success','Data penggunan dengan nama ' . $user->name . ' berhasil dihapus');
    }
}
