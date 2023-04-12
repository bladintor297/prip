<?php

namespace App\Http\Controllers;

use App\Models\CalonPrip;
use App\Models\Modul;
use App\Models\PesertaModul;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moduls = Modul::orderBy('tarikh_mula', 'desc')->get();
        return view('modul.senarai-modul')->with('moduls', $moduls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modul.tambah-modul');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # Validation
        $request->validate([
            'butiran' => 'required',
            'tempat' => 'required',
            'nama' => 'required',
            'tarikh_mula' => 'required',
            'tarikh_tamat' => 'required',
        ],
        [
            'butiran.required' => 'Butiran modul mesti diisi',
            'tempat.required' => 'Tempat penganjuran modul mesti diisi',
            'nama.required' => 'Nama modul mesti diisi',
            'tarikh_mula.required' => 'Tarikh mula penganjuran modul mesti diisi',
            'tarikh_tamat.required' => 'Tarikh tamat penganjuran modul mesti diisi',
        ]);

        $modul = new Modul;
        $kod = ' ';
        for ($i = 1; $i<=5; ++$i)
            if (substr(($request->input('nama')), -1) === (string)$i) 
            $kod = 'm'.$i;
            
        $modul->nama = $request->input('nama');
        $modul->kod_modul = $kod;
        $modul->tarikh_mula = $request->input('tarikh_mula');
        $modul->tarikh_tamat = $request->input('tarikh_tamat');
        $modul->tempat = $request->input('tempat');
        $modul->butiran_modul = $request->input('butiran');
        $modul->peserta = 0;
        $modul->save();

        $moduls = Modul::orderBy('tarikh_mula', 'desc')->get();
        return redirect()->back()->with(['success' => $modul->nama . ' (' . date('d-M-Y', strtotime($modul->tarikh_mula))  . ') berjaya ditambah', 'moduls'=>$moduls]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peserta = DB::table('peserta_modul')
                ->join('users','users.id','=','peserta_modul.calon')
                ->where('peserta_modul.modul', $id)
                ->get();
                
        $modul = Modul::find($id);

        return view('modul.senarai-kehadiran')->with(['peserta'=>$peserta, 'id'=>$id, 'modul'=>$modul]);
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

    public static function check ($name, $id)
    {
        $peserta = DB::table('peserta_modul')
                ->join('modul','modul.id','=','peserta_modul.modul')
                ->where('peserta_modul.calon', '=', $id)
                ->where('modul.nama', 'Modul 1')
                ->first();

        return $name;
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
        $peserta = User::where('role', '4')->where('no_kp', $request->input('no_kp'))->get();
            
            if (!(count($peserta)>0))
                return back()->with('error', 'No K/P dimasukkan tiada dalam rekod Calon PRIP.');

            else{
                $peserta = User::where('no_kp', $request->input('no_kp'))->first();

                $peserta_modul = new PesertaModul;
                $peserta_modul->calon = $peserta->id;
                $peserta_modul->no_kp = $peserta->no_kp;
                $peserta_modul->nama = $peserta->name;
                $peserta_modul->modul = $id;

                $kod = ' ';
                for ($i = 1; $i<=5; ++$i)
                    if (substr(($request->input('kod')), -1) === (string)$i) 
                    $kod = 'm'.$i;
                
                $peserta_modul->kod_modul = $kod;
                $peserta_modul->save();

                return back();
            }
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul = Modul::find($id);
        $modul->delete();

        return back()->with($modul->nama.' ('.$modul->tarikh_mula . ') telah dipadam dari rekod.');
    }
}
