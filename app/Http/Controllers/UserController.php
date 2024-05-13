<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            return response()->view('dashboard.users.users.index', [
                'users' => User::sortable()->paginate(10),
                'title' => 'Daftar User'
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

        return response()->view('dashboard.users.users.create', [
            'title' => 'Tambah User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('isAdmin');

        if ($request->gender == 'Pilih Jenis Kelamin'){
            return back()->withErrors(['gender' => ['Silahkan pilih jenis kelamin']])->withInput();
        }
        if ($request->level == 'Pilih Divisi'){
            return back()->withErrors(['level' => ['Silahkan pilih divisi']])->withInput();
        }
        if ($request->position == 'Pilih Jabatan'){
            return back()->withErrors(['position' => ['Silahkan pilih jabatan']])->withInput();
        }
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:6|unique:users',
            'email' => 'required|email:dns|unique:users',
            'phone' => 'required|unique:users',
            'gender' => 'required',
            'level' => 'required',
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
        
        return redirect('/dashboard/users/users')->with('success','User baru '. $request->username . ' berhasil ditambahkan');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        if($user->id === auth()->user()->id){
            return response()->view('dashboard.users.users.show', [
                'user' => $user,
                'title' => 'Detail User'
            ]);
        } else if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Owner' ){
            return response()->view('dashboard.users.users.show', [
                'user' => $user,
                'title' => 'Detail User'
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
            return response()->view('dashboard.users.users.edit', [
                'user' => $user,
                'title' => 'Edit User'
            ]);
        } else {
        $this->authorize('isAdmin');
        
        return response()->view('dashboard.users.users.edit', [
            'user' => $user,
            'title' => 'Edit User'
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

        if($request->position != $user->position){
            $rules['position'] = 'required';
        }

        if($request->level != $user->level){
            $rules['level'] = 'required';
        }

        if($request->gender != $user->gender){
            $rules['gender'] = 'required';
        }

        if($request->password){
            $rules['password'] = 'required|min:8';
        } else {
            $rules['password'] = $request->oldPassword;
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
            return redirect('/dashboard/users/users')->with('success','User Has Been Updated');
        } else {
            return redirect('/dashboard/users/users/' . $user->id)->with('success','User Has Been Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('isAdmin');
        
        if($user->avatar){
            Storage::delete($user->avatar);
        }

        User::destroy($user->id);

        return redirect('/dashboard/users/users')->with('success','User ' . $user->username . ' berhasil dihapus');
    }
}
