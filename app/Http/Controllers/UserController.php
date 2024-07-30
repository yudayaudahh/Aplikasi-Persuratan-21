<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    
    public function index(){
        $title = 'Hapus Data!';
        $text = "Yakin Hapus Data Ini";
        confirmDelete($title, $text);
        return view('akun.index', [
            'title' => 'User',
            'breadcrumbs' => [
                [
                'title' => 'User',
                'link' => route('user'),
                ]
            ],
            'user' => User::all()
        ]);
    }

    public function create(){
        return view('akun.action', [
            'title' => 'Tambah Akun',
            'breadcrumbs' => [
                [
                'title' => 'Tambah Akun',
                'link' => route('user'),
                ]
            ],
        ]);
    }

    public function store(Request $request){
        $request->validate([
			'name' => 'required',
            'nip' => 'required|unique:users,nip',
			'role' => 'required',
			'password' => 'required|min:6',
			'confirm' => 'required|same:password',
		]);

        User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        Alert::toast('Data Berhasil Di Buat', 'success');
        return redirect()->route('user');
    }

    public function edit(User $user){
        return view('akun.action', [
            'title' => 'Tambah Akun',
            'breadcrumbs' => [
                [
                'title' => 'Tambah Akun',
                'link' => route('user'),
                ]
            ],
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user){
        $request->validate([
			'name' => 'required',
            'nip' => 'required',
			'role' => 'required',
		]);

        $user->updateUser($request->except(['password', 'confirm']));

        if(isset($request->password)){
            $user->setPassword($request->password);
        }

        Alert::toast('Data Berhasil Di Buat', 'success');
        return redirect()->route('user');
    }

    public function destroy(User $user){
        $user->delete();
        
        Alert::toast('Data Berhasil Di Hapus', 'success');
        return redirect()->route('user');
    }
}
