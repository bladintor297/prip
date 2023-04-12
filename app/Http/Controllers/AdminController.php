<?php

namespace App\Http\Controllers;

use App\Models\CalonPrip;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PesertaModul;
use Illuminate\Contracts\Session\Session;

class AdminController extends Controller
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
        $prips = User::where('status', '0')->get();
        $expired = User::where('status', '2')->get();
        return view('admin.pengguna-pending')->with(['prips'=>$prips, 'expired'=>$expired]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $user->status = '1';
        $user->save();
        return back()->with('success', 'Status '.$user->name.' sudah dikemaskini dalam sistem.' );
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
        $user->name = $request->input('nama');
        $user->no_kp = $request->input('no_kp');
        $user->polikk = $request->input('institusi');
        $user->bidang = $request->input('bidang');
        $user->program = $request->input('program');
        $user->negeri = $request->input('negeri');
        if($user->role === '2')
        $user->tahun_lantikan = $request->input('tahun_lantikan');
        $user->role = $request->input('role');

        if ($request->input('role') === '2'){
            $user->batch = date('Y');
        }

        $user->save();

        return back()->with('success', 'Data '.$user->name.' telah dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success', 'Status '.$user->name.' sudah dibuang dari sistem.' );
    }
}
