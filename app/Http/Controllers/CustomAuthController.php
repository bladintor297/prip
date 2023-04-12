<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'no_kp' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('no_kp', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }
  
        return redirect("login")->with('error', 'Padanan username dan kata laluan tidak tepat atau tiada dalam rekod.');
    }

    public function registration()
    {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'no_kp' => ['required'],
        ],
        [
            // 'email.unique' => 'Emel ini telah digunakan.',
            'password.confirmed' => 'Padanan kata laluan tidak tepat',
            
            'role.required' => 'Sila pilih satu jenis akses',
            'name.required' => 'Sila masukkan nama anda',
            'email.required' => 'Sila masukkan emel anda',
            'no_kp.required' => 'Sila masukkan no kad pengenalan anda',
        ]);
        $data = $request->all();

        if  ($data['role'] === '3'){
            $status = '1';
            $message = 'Pendaftaran berjaya. Sila log masuk menggunakan akaun anda';
        }

        else{
            $status = '0';
            $message = 'Pendaftaran berjaya. Sila tunggu sementara pihak urusetia mengesahkan akaun anda.';
        }
            

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'status' => $status,
            'no_kp' => $data['no_kp'],
        ]);
        
        return redirect("login")->with('success', $message);
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('home');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}