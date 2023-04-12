<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Aktiviti;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()){
            $user = User::find(Auth::id());
            Session::put('role', $user->role);
            Session::put('status', $user->status);

            if (!Session::has('tahun'))
            Session::put('tahun', date('Y'));

            else
            Session::put('tahun', date('Y'));

            $prip = User::where('role', '2')->whereNotNull('batch')->orderBy('name')->get();
            $aktiviti = Aktiviti::where('status', '1')->get();
            $peserta = Aktiviti::where('status', '1')->sum('bil_peserta');
            
            $minYear = Aktiviti::where('status', '1')->orderBy('tarikh_mula', 'asc')->pluck('tarikh_mula')->first();
            $maxYear = Aktiviti::where('status', '1')->orderBy('tarikh_mula', 'desc')->pluck('tarikh_mula')->first();
                
            $prip_tahunan = User::where('role', '2')->where('batch', date('Y'))->orderBy('name')->get();
            $aktiviti_tahunan = Aktiviti::where('status', '1')->whereYear('tarikh_mula', Session::get('tahun'))->get();
            $peserta_tahunan = Aktiviti::where('status', '1')->whereYear('tarikh_mula', Session::get('tahun'))->sum('bil_peserta');

            return view('welcome')->with(['prip'=>$prip, 'aktiviti'=>$aktiviti, 'peserta'=>$peserta, 'user'=>$user, 'minYear'=>$minYear, 'maxYear'=>$maxYear,
                                        'prip_tahunan'=>$prip_tahunan, 'aktiviti_tahunan'=>$aktiviti_tahunan, 'peserta_tahunan'=>$peserta_tahunan]);
        }

        else{
            return view('welcome');
        }
    }

    public static function validateStatus(){
        Session::flush();
        Auth::logout();
        return view('welcome');
    }

    public function update(Request $request)
    {
        if(Auth::check()){
            $user = User::find(Auth::id());
            Session::put('role', $user->role);
            Session::put('status', $user->status);

            if (!Session::has('tahun'))
            Session::put('tahun', date('Y'));

            else
            Session::put('tahun', $request->input('tahun'));

            $prip = User::where('role', '2')->where('status', '1')->orderBy('name')->get();
            $pripall = User::where('role', '2')->orderBy('name')->get();

            $aktiviti = Aktiviti::where('status', '1')->get();
            $peserta = Aktiviti::where('status', '1')->sum('bil_peserta');
            
            $minYear = Aktiviti::where('status', '1')->orderBy('tarikh_mula', 'asc')->pluck('tarikh_mula')->first();
            $maxYear = Aktiviti::where('status', '1')->orderBy('tarikh_mula', 'desc')->pluck('tarikh_mula')->first();

            $prip_tahunan = User::where('role', '2')->where('batch', Session::get('tahun'))->orderBy('name')->get();
            $aktiviti_tahunan = Aktiviti::where('status', '1')->whereYear('tarikh_mula', Session::get('tahun'))->get();
            $peserta_tahunan = Aktiviti::where('status', '1')->whereYear('tarikh_mula', Session::get('tahun'))->sum('bil_peserta');

            return view('welcome')->with(['prip'=>$prip, 'aktiviti'=>$aktiviti, 'peserta'=>$peserta, 'user'=>$user, 'minYear'=>$minYear, 'maxYear'=>$maxYear,
                                        'prip_tahunan'=>$prip_tahunan, 'aktiviti_tahunan'=>$aktiviti_tahunan, 'peserta_tahunan'=>$peserta_tahunan, 'pripall'=>$pripall]);
        }

        else{
            return view('welcome');
        }
    }
}
