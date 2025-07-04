<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

   
    public function index()
    {
        return view('auth.login');
    }  
    
    /**
     * Write code on Method
     *
     * @return response()
     */  
    public function customLogin(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == 'admin') {
                $users = UserData::latest()->paginate(5);
        
        return view('admin.adminHome',compact('users'));
            }else if (auth()->user()->type == 'seller') {
                return view('auth.home');
            }else{
               return view('auth.home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
   
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("home")->withSuccess('You have signed-in');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }    

    /**
     * Write code on Method
     *
     * @return response()
     */ 
    public function dashboard()
    {
        
        if(Auth::check()){
            return view('auth.dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function home()
    {
        return view('auth.home');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function sellerHome()
    {
        return view('auth.home');
    }

}
