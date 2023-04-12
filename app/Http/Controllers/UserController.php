<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = User::find(Auth::id());
        $tamat_lantikan = $user->tahun_lantikan + 2;
        return view('profil.profil-saya')->with(['user'=>$user, 'tamat_lantikan'=>$tamat_lantikan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ((Session::get('role')==='1') || (Session::get('role')==='2')){
            if ($request->has('pensyarah'))
            $user->email = $request->input('pensyarah');
            $user->name = $request->input('nama');
            $user->no_kp = $request->input('no_kp');
            $user->telefon = $request->input('telefon');
            $user->bidang = $request->input('bidang');
            $user->program = $request->input('program');
            $user->gred = $request->input('gred');
            $user->polikk = $request->input('institusi');
            $user->telefon = $request->input('telefon');
            $user->negeri = $request->input('negeri');
            $user->emel_google = $request->input('emel_google');
        }

        else{
            if ($request->has('pensyarah'))
            $user->email = $request->input('pensyarah');
            $user->name = $request->input('nama');
            $user->bidang = $request->input('bidang');
            $user->program = $request->input('program');
            $user->polikk = $request->input('institusi');
            $user->negeri = $request->input('negeri');
            $user->no_kp = $request->input('no_kp');
            $user->telefon = $request->input('telefon');
        }
        $user->save();
        return back()->with('success', 'Profil anda sudah dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(){
        return view('profil.tukar-password');
    }

    public function updatePassword(Request $request) {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ],
        [
            'old_password.required' => 'Kata Laluan Semasa mesti diisi',
            'new_password.required' => 'Kata Laluan Baru mesti diisi',
            'new_password.confirmed' => 'Kata Laluan Baru tidak sepadan',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Kata Laluan Semasa tidak sepadan!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Kata Laluan Berjaya Ditukar!");
    }
}
