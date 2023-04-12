<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Modul;
use App\Models\Aktiviti;
use App\Models\PesertaModul;
use PDF;


class PRIPController extends Controller
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

            
            $checkprips = User::where('role', '2')->where('bulan_lantikan', date('m'))->where('tahun_lantikan', (date('Y')-2))->get();
            foreach ($checkprips as $checkprip){
                    $checkprip->status = 2;
                    $checkprip->save();
                }

            $sort = Session::get('sort');
            if (empty($sort)){
                $pendings = User::where('status', '0')->orderBy('created_at')->get();
                $prips = User::where('role', '2')->where('status', '1')->orWhere('status', '2')->orderBy('name')->get();
                $cprips = User::where('role', '4')->where('status', '1')->orderBy('name')->get();
                $penggunas = User::where('role', '3')->where('status', '1')->orderBy('name')->get();
                $admins = User::where('role', '1')->where('status', '1')->orderBy('name')->get();
                return view('admin.senarai-pengguna')->with(['prips'=>$prips, 'penggunas'=>$penggunas, 'admins'=>$admins, 'pendings'=>$pendings, 'sort'=>'Aktiviti', 'cprips'=>$cprips]);
            }

            else {
                $pendings = User::where('status', '0')->orderBy('created_at')->get();
                $prips = User::where('role', '2')->where('status', '1')->orderBy($sort, 'desc')->get();
                $cprips = User::where('role', '4')->where('status', '1')->orderBy('name')->get();
                $penggunas = User::where('role', '3')->where('status', '1')->orderBy('name')->get();
                $admins = User::where('role', '1')->where('status', '1')->orderBy('name')->get();
                return view('admin.senarai-pengguna')->with(['prips'=>$prips, 'penggunas'=>$penggunas, 'admins'=>$admins, 'pendings'=>$pendings, 'sort'=>'Nama', 'cprips'=>$cprips]);
            }
        }

        else if (Session::get('role') === '4'){
            $modul = DB::table('peserta_modul')
                    ->join('modul','modul.id','=','peserta_modul.modul')
                    ->where('peserta_modul.calon', '=', Auth::id())
                    ->get();

            return view('prip.calon-prip')->with('modul', $modul);
        }

        else {
            $prips = User::where('role', '2')->where('status', '1')->orWhere('status', '2')->get();
            return view('user.senarai-prip')->with(['prips'=>$prips]);
        }  
    }

    

    public function filter(Request $request)
    {
        $bidang = $request->input('bidang');
        $negeri = $request->input('negeri');

        if (($bidang !== '0') && ($negeri !== '0'))
        $prips = User::where('role', '2')->where('status', '1')->where('bidang', $bidang)->where('negeri', $negeri)->get();

        else
            if(($bidang !== '0') && ($negeri === '0'))
            $prips = User::where('role', '2')->where('status', '1')->where('bidang', $bidang)->get();

            elseif (($bidang === '0') && ($negeri !== '0'))
            $prips = User::where('role', '2')->where('status', '1')->where('negeri', $negeri)->get();

            else{
                $prips = User::where('role', '2')->where('status', '1')->get();
                return view('user.senarai-prip')->with(['prips'=>$prips]);
            }



        return view('user.cari-prip')->with(['prips'=>$prips, 'negeri'=>$negeri, 'bidang'=>$bidang]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sort)
    {

        if ($sort === 'Nama')
            Session::forget('sort');
        
        else
            Session::put('sort', 'bil_aktiviti');

        return redirect()->back();
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
        $modul = DB::table('peserta_modul')
                    ->join('modul','modul.id','=','peserta_modul.modul')
                    ->where('peserta_modul.calon', '=', $id)
                    ->get();

        $ref = $id;
        return view('admin.calon-prip')->with(['modul'=>$modul, 'ref'=>$ref]);
    }

    public static function status ($no, $id)
    {
        $modul = PesertaModul::all()->where('calon', $id);
        if ($modul->contains('kod_modul', 'm'.$no))
        return true;

        else return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Session::get('role') === '1'){
            $user = User::find($id);
            $minYear = date('Y')-3;
            $maxYear = date('Y')+3;
            return view('admin.sunting-pengguna')->with(['user'=>$user, 'minYear'=>$minYear, 'maxYear'=>$maxYear]);
        }
    }

    public function cariEmel(Request $request)
    {
          $query = $request->get('query');
          $filterResult = User::where('email', 'LIKE', '%'. $query. '%')->where('status', '1')->pluck('email');
          return response()->json($filterResult);
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
        $prip = User::find($id);
        $prip->bulan_lantikan = $request->input('bulan_lantikan');
        $prip->tahun_lantikan = date('Y');
        $prip->status = 1;
        $prip->save();

        return back()->with('success', 'Kontrak '.$prip->name.' telah diperbaharui.');
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

}
