<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isAdmin') && Gate::allows('isUserMenu')){
            return response()->view('users.index', [
                'users' => User::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
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
        if(Gate::allows('isAdmin') && Gate::allows('isUserCreate')){
            return response()->view('users.create', [
                'title' => 'Menambah Data Pengguna'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if(Gate::allows('isAdmin') && Gate::allows('isUserCreate')){
            $roles = json_decode($request->user_access);
            // dd($roles);
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
    
    
            $validateData = $request->validate([
                'name' => 'required|max:255',
                'username' => 'required|min:6|unique:users',
                'email' => 'required|email:dns|unique:users',
                'phone' => 'required|unique:users',
                'gender' => 'required',
                'user_access'=>'required',
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
            
            return redirect('/user/users')->with('success','Data pengguna baru dengan nama'. $request->name . ' berhasil ditambahkan');
    
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        if($user->id === auth()->user()->id){
            return response()->view('users.show', [
                'user' => $user,
                'title' => 'Detail User'
            ]);
        } else if(Gate::allows('isAdmin') && Gate::allows('isUserRead')){
            return response()->view('users.show', [
                'user' => $user,
                'title' => 'Detail User'
            ]);
        } else {
            abort(403);
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
                'title' => 'Edit User'
            ]);
        } else if(Gate::allows('isAdmin') && Gate::allows('isUserEdit')){
            return response()->view('users.edit', [
                'user' => $user,
                'title' => 'Edit User'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        if($user->id === auth()->user()->id){
            $rules = [
                'name' => 'required|max:255',
                'gender' => 'required',
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
            if($request->cbPassword == true){
                $rules['password'] = 'required|min:8';
            }
    
            $validateData = $request->validate($rules);
    
            if($request->cbPassword == true){
                if($request->password != $request->confirm_password){
                    return back()->withErrors(['confirm_password' => ['Konfirmasi password tidak sesuai']])->withInput();
                }else{
                    $validateData['password'] = Hash::make($validateData['password']);
                }
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
                return redirect('/user/users')->with('success','Data pengguna dengan nama ' . $user->name. ' berhasil diupdate');
            } else {
                return redirect('/user/users/' . $user->id)->with('success','Data pengguna dengan nama ' . $user->name. ' berhasil diupdate');
            }
        } else  if(Gate::allows('isAdmin') && Gate::allows('isUserEdit')){
            if ($request->position == 'pilih'){
                return back()->withErrors(['position' => ['Silahkan pilih jabatan']])->withInput();
            }
            $rules = [
                'name' => 'required|max:255',
                'gender' => 'required',
                'level' => 'required',
                'division' => 'required',
                'position' => 'required',
                'user_access'=>'required',
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
            if($request->cbPassword == true){
                $rules['password'] = 'required|min:8';
            }

            $validateData = $request->validate($rules);

            if($request->cbPassword == true){
                if($request->password != $request->confirm_password){
                    return back()->withErrors(['confirm_password' => ['Konfirmasi password tidak sesuai']])->withInput();
                }else{
                    $validateData['password'] = Hash::make($validateData['password']);
                }
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
                return redirect('/user/users')->with('success','Data pengguna dengan nama ' . $user->name. ' berhasil diupdate');
            } else {
                return redirect('/user/users/' . $user->id)->with('success','Data pengguna dengan nama ' . $user->name. ' berhasil diupdate');
            }
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if(Gate::allows('isAdmin') && Gate::allows('isUserDelete')){
            if($user->media_categories()->exists() || $user->leds()->exists() || $user->vendors()->exists() || $user->vendor_contacts()->exists() || $user->vendor_categories()->exists() || $user->areas()->exists() || $user->cities()->exists() || $user->location_photos()->exists() || $user->media_sizes()->exists() || $user->clients()->exists() || $user->client_categories()->exists() || $user->client_groups()->exists() || $user->contacts()->exists() || $user->companies()->exists() || $user->printing_products()->exists() || $user->printing_prices()->exists() || $user->installation_prices()->exists() || $user->land_agreements()->exists() || $user->licenses()->exists()){
                return back()->withErrors(['delete' => ['Gagal untuk menghapus data pengguna, terdapat relasi dengan data pada tabel data lainnya']]);
            }else{
                if($user->level == 'Administrator'){
                    $dataUsers = User::where('level', 'Administrator')->get();
                    if(count($dataUsers) == 1){
                        return back()->withErrors(['delete' => ['Gagal untuk menghapus data pengguna, minimal harus ada 1 pengguna dengan level Administrator']]);
                    }else{
                        if($user->avatar){
                            Storage::delete($user->avatar);
                        }
                
                        User::destroy($user->id);
                
                        return redirect('/user/users')->with('success','Data penggunan dengan nama ' . $user->name . ' berhasil dihapus');
                    }
                }else {
                    if($user->avatar){
                        Storage::delete($user->avatar);
                    }
            
                    User::destroy($user->id);
            
                    return redirect('/user/users')->with('success','Data penggunan dengan nama ' . $user->name . ' berhasil dihapus');
                }                
            }
            
        } else {
            abort(403);
        }
    }
}
