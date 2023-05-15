<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktiviti;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Prip;
use App\Models\Cadangan;
use PDF;

class AktivitiController extends Controller
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
        if (Session::get('role') === '1'){
            $user = User::all();

            $aktivitiL = Aktiviti::where('status', 1)->orderBy('tarikh_mula','desc')->get();
            $aktivitiB = Aktiviti::where('status', 0)->orderBy('tarikh_mula','desc')->get();
            $aktiviti = Aktiviti::orderBy('tarikh_mula','desc')->get(   );
            return view('admin.senarai-aktiviti')->with(['user'=>$user, 'aktivitii'=>$aktiviti, 'aktivitiL'=>$aktivitiL, 'aktivitiB'=>$aktivitiB]);
        }

        else if (Session::get('role') === '2'){
            $user = User::find(Auth::id());

            $aktivitiL = Aktiviti::where('prip', Auth::id())->where('status', 1)->orderBy('tarikh_mula','desc')->get();
            $aktivitiB = Aktiviti::where('prip', Auth::id())->where('status', 0)->orderBy('tarikh_mula','desc')->get();
            $aktiviti = Aktiviti::where('prip', Auth::id())->orderBy('tarikh_mula','desc')->get();

            
            return view('prip.aktiviti-saya')->with(['user'=>$user, 'aktivitii'=>$aktiviti, 'aktivitiL'=>$aktivitiL, 'aktivitiB'=>$aktivitiB]);
        }

        else{
            abort(404);
        }
    }


    public static function kiraPeserta($id){
        $prip = User::find($id);
        $mula = $prip->tahun_lantikan;
        $akhir = $mula + 2;

        $peserta = Aktiviti::where('prip', $id)->where('status', '1')->whereBetween('tarikh_mula', [$mula, $akhir])->sum('bil_peserta');
        return ($peserta);
    }

    public static function kiraHari($id){
        $prip = User::find($id);
        $mula = $prip->tahun_lantikan;
        $akhir = $mula + 2;
        $hari = 0;

        $peserta = DB::table('aktiviti')->where('prip', $id)->where('status', '1')->whereBetween('tarikh_mula', [$mula, $akhir])->get();
        
        foreach ($peserta as $ps){
            $now = strtotime($ps->tarikh_akhir); // or your date as well
            $your_date = strtotime($ps->tarikh_mula);
            $datediff = $now - $your_date;

            $hari += (round($datediff / (60 * 60 * 24)) + 1);
        }
        return $hari;
        return ($peserta->sum('days'));
    }

    public static function kiraAktiviti($id){
        $prip = User::find($id);
        $mula = $prip->tahun_lantikan;
        $akhir = $mula + 2;
        $aktiviti = DB::table('aktiviti')->where('prip', $id)->where('status', '1')->whereBetween('tarikh_mula', [$mula, $akhir])->get();
        return (count($aktiviti));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::get('role') === '1'){
            return view('prip.tambah-aktiviti');
        }

        else if (Session::get('role') === '2'){
            $user = User::find(Auth::id());
            $cadangans = Cadangan::where('kepada', $user->email)->get();
            return view('prip.tambah-aktiviti')->with(['user'=>$user, 'cadangans'=>$cadangans]);
        }

        else {
            $user = User::find(Auth::id());
            return view('user.cadangan-aktiviti')->with(['user'=>$user, 'email'=>'']);
        }
    }

    public function borangAktiviti($id){
        $user = User::find(Auth::id());
        return view('user.cadangan-aktiviti')->with(['user'=>$user, 'email'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Session::get('role') === '1'){
            $aktiviti = new Aktiviti;
            $prips = User::where('role', '2')->where('email', $request->input('emel'))->get();
            if (!(count($prips)>0))
                return back()->with('error', 'Emel PRIP tiada dalam rekod');
        
            $aktiviti->emel = $request->input('emel');
            $aktiviti->prip = User::where('email', $request->input('emel'))->first()->id;
            $aktiviti->nama = $request->input('nama_aktiviti');
            $aktiviti->butiran = $request->input('butiran_aktiviti');
            $aktiviti->tarikh_mula = $request->input('tarikh_mula');
            $aktiviti->tarikh_akhir = $request->input('tarikh_akhir');
            $aktiviti->tempat = $request->input('tempat');
            $aktiviti->bil_peserta = $request->input('bil_peserta');
            $user = User::find($aktiviti->prip);
            $user->bil_aktiviti = count(Aktiviti::where('prip', $user->id)->where('status', '1')->get()) + 1;
            $user->save();


            $aktiviti->institusi = $request->input('institusi');
            if($request->hasFile('gambar')){
                $imageName = 'Gambar_'.$request->input('nama_aktiviti').'.'.$request->gambar->extension();
                $request->gambar->storeAs('public/gambar/aktiviti', $imageName);
                $aktiviti->gambar = $imageName;
            }
            $aktiviti->status = 1;
            $aktiviti->save();
            return back()->with('success', 'Aktiviti '.$aktiviti->nama.' telah dimuatnaik ke dalam sistem.');
        }

        else if (Session::get('role') === '2'){
            $aktiviti = new Aktiviti;
            $aktiviti->prip = Auth::id();
            $aktiviti->emel = User::find(Auth::id())->email;
            $aktiviti->nama = $request->input('nama_aktiviti');
            $aktiviti->butiran = $request->input('butiran_aktiviti');
            $aktiviti->tarikh_mula = $request->input('tarikh_mula');
            $aktiviti->tarikh_akhir = $request->input('tarikh_akhir');
            $aktiviti->tempat = $request->input('tempat');
            $aktiviti->institusi = $request->input('institusi');
            $aktiviti->bil_peserta = $request->input('bil_peserta');
            if($request->hasFile('gambar')){
                $imageName = 'Gambar_'.$request->input('nama_aktiviti').'.'.$request->gambar->extension();
                $request->gambar->storeAs('public/gambar/aktiviti', $imageName);
                $aktiviti->gambar = $imageName;
            }
            $aktiviti->save();
            return back()->with('success', 'Aktiviti anda telah dimuatnaik untuk diluluskan oleh Admin');

        }

        else{

            $prips = User::where('role', '2')->where('email', $request->input('pensyarah'))->get();
            if (!(count($prips)>0))
            return back()->with('error', 'Emel PRIP tiada dalam rekod');

            else{
                $cadangan = new Cadangan;
                $cadangan->daripada = Auth()->user()->email;
                $cadangan->nama = $request->input('nama');
                $cadangan->kepada = $request->input('pensyarah');
                $cadangan->cadangan_aktiviti = $request->input('cadangan_aktiviti');
                $cadangan->institusi = $request->input('institusi');
                $cadangan->no_telefon = $request->input('no_telefon');
                $cadangan->save();


                $user = User::find(Auth::id());
                $user->polikk = $request->input('institusi');
                $user->telefon = $request->input('no_telefon');
                $user->save();

                return back()->with('success', 'Cadangan anda telah dihantar');
                
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aktiviti = Aktiviti::find($id);
        $prip = User::find($aktiviti->prip);
        $pdf = PDF::loadView('prip.laporan-aktiviti', compact(['aktiviti', 'prip']));
        return $pdf->stream('Report_'.$aktiviti->nama.'_'.uniqid().'.pdf');
    }

    public function aktivitiPrip ($id){
        $user = User::find($id);
        
        $aktivitiL = Aktiviti::where('prip', $id)->where('status', 1)->get();
        $aktivitiB = Aktiviti::where('prip', $id)->where('status', 0)->get();
        $aktiviti = Aktiviti::where('prip', $id)->get();

        $mohonT = Cadangan::where('kepada', $user->email)->where('status', 2)->get();
        $mohonL = Cadangan::where('kepada', $user->email)->where('status', 1)->get();
        $mohonB = Cadangan::where('kepada', $user->email)->where('status', 0)->get();
        $mohon = Cadangan::where('kepada', $user->email)->get();
        return view('admin.aktiviti-prip')->with(['user'=>$user, 'aktivitii'=>$aktiviti, 'aktivitiL'=>$aktivitiL, 'aktivitiB'=>$aktivitiB,
                                                'mohonT'=>$mohonT, 'mohonL'=> $mohonL, 'mohonB'=> $mohonB, 'mohon'=> $mohon]);
    }

    public function mohonAktiviti ($id){
        $user = User::find($id);
        if (Session::get('role')==='1'){
            $aktivitiT = Cadangan::where('daripada', $user->email)->where('status', 2)->get();
            $aktivitiL = Cadangan::where('daripada', $user->email)->where('status', 1)->get();
            $aktivitiB = Cadangan::where('daripada', $user->email)->where('status', 0)->get();
            $aktiviti = Cadangan::where('daripada', $user->email)->get();
            return view('admin.mohon-aktiviti')->with(['user'=>$user, 'aktivitii'=>$aktiviti, 'aktivitiL'=>$aktivitiL, 'aktivitiB'=>$aktivitiB,  'aktivitiT'=>$aktivitiT]);
        }

        else if (Session::get('role')==='2'){
            $aktivitiT = Cadangan::where('kepada', $user->email)->where('status', 2)->get();
            $aktivitiL = Cadangan::where('kepada', $user->email)->where('status', 1)->get();
            $aktivitiB = Cadangan::where('kepada', $user->email)->where('status', 0)->get();
            $aktiviti = Cadangan::where('kepada', $user->email)->get();
            return view('prip.mohon-aktiviti')->with(['user'=>$user, 'aktivitii'=>$aktiviti, 'aktivitiL'=>$aktivitiL, 'aktivitiT'=>$aktivitiT, 'aktivitiB'=>$aktivitiB]);
        }

        else{
            $aktivitiT = Cadangan::where('daripada', $user->email)->where('status', 2)->get();
            $aktivitiL = Cadangan::where('daripada', $user->email)->where('status', 1)->get();
            $aktivitiB = Cadangan::where('daripada', $user->email)->where('status', 0)->get();
            $aktiviti = Cadangan::where('daripada', $user->email)->get();
            return view('user.status-cadangan')->with(['user'=>$user, 'aktivitii'=>$aktiviti, 'aktivitiT'=>$aktivitiT, 'aktivitiL'=>$aktivitiL, 'aktivitiB'=>$aktivitiB]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aktiviti = Aktiviti::find($id);
        $aktiviti->status = 1;
        $aktiviti->save();

        $user = User::find($aktiviti->prip);
        $user->bil_aktiviti = count(Aktiviti::where('prip', $user->id)->where('status', '1')->get());
        $user->save();
        return back()->with('success', $aktiviti->nama.' telah diluluskan.');
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
        $aktiviti = Aktiviti::find($id);
        $aktiviti->nama = $request->input('nama');
        $aktiviti->butiran = $request->input('butiran');
        $aktiviti->tarikh_mula = $request->input('tarikh_mula');
        $aktiviti->tarikh_akhir = $request->input('tarikh_akhir');
        $aktiviti->tempat = $request->input('tempat');
        $aktiviti->institusi = $request->input('institusi');
        $aktiviti->bil_peserta = $request->input('bil_peserta');


        $aktiviti->save();

        return back()->with('success', 'Data '. $aktiviti->nama.' telah dikemaskini.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aktiviti = Aktiviti::find($id);
        $aktiviti->delete();
        return back()->with('success', 'Data '. $aktiviti->nama.' telah dibuang.');

    }

    public function terimaMohon($id)
    {
        $mohon = Cadangan::find($id);
        $mohon->status = 1;
        $mohon->save();
        return   back()->with('success','Status permohonan aktiviti telah dikemaskini');
    }

    public function tolakMohon($id)
    {
        $mohon = Cadangan::find($id);
        $mohon->status = 2;
        $mohon->save();
        return back()->with('success','Status permohonan aktiviti telah dikemaskini');
    }

    public function filter (Request $request){
        $user = User::all();
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');

        if (($bulan !== '0') && ($tahun !== '0')){
            $aktivitiL = Aktiviti::where('status', 1)->whereYear('tarikh_mula', $tahun)->whereMonth('tarikh_mula', $bulan)->orderBy('tarikh_mula','desc')->get();
            $aktivitiB = Aktiviti::where('status', 0)->whereYear('tarikh_mula', $tahun)->whereMonth('tarikh_mula', $bulan)->orderBy('tarikh_mula','desc')->get();
            $aktiviti = Aktiviti::whereYear('tarikh_mula', $tahun)->whereMonth('tarikh_mula', $bulan)->orderBy('tarikh_mula','desc')->get();
        }

        else
            if(($tahun !== '0') && ($bulan === '0')){
                $aktivitiL = Aktiviti::where('status', 1)->whereYear('tarikh_mula', $tahun)->orderBy('tarikh_mula','desc')->get();
                $aktivitiB = Aktiviti::where('status', 0)->whereYear('tarikh_mula', $tahun)->orderBy('tarikh_mula','desc')->get();
                $aktiviti = Aktiviti::whereYear('tarikh_mula', $tahun)->get();
            }

            elseif (($tahun === '0') && ($bulan !== '0')){
                $aktivitiL = Aktiviti::where('status', 1)->whereMonth('tarikh_mula', $bulan)->orderBy('tarikh_mula','desc')->get();
                $aktivitiB = Aktiviti::where('status', 0)->whereMonth('tarikh_mula', $bulan)->orderBy('tarikh_mula','desc')->get();
                $aktiviti = Aktiviti::whereMonth('tarikh_mula', $bulan)->orderBy('tarikh_mula','desc')->get();
            }

            else{
                $aktivitiL = Aktiviti::where('status', 1)->orderBy('tarikh_mula','desc')->get();
                $aktivitiB = Aktiviti::where('status', 0)->orderBy('tarikh_mula','desc')->get();
                $aktiviti = Aktiviti::orderBy('tarikh_mula','desc')->get();
                return view('admin.senarai-aktiviti')->with(['user'=>$user, 'aktivitii'=>$aktiviti, 'aktivitiL'=>$aktivitiL, 'aktivitiB'=>$aktivitiB]);
            }

        return view('admin.cari-aktiviti')->with(['user'=>$user, 'aktivitii'=>$aktiviti, 'aktivitiL'=>$aktivitiL, 'aktivitiB'=>$aktivitiB,
                                                'tahun'=>$tahun, 'bulan'=>$bulan]);
    }
}
