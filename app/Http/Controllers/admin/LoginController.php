<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('admin.login');
    }

    public function login_submit(Request $request){

            $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
            ]);
            if(isset($request->remember) && $request->remember == "on"){
                setcookie('email',$request->email,time()+60*60*24*100);
                setcookie('password',bcrypt($request->password),time()+60*60*24*100);
            }
            else{
                setcookie('email',$request->email,100);
                setcookie('password',bcrypt($request->password),100);
            }
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('dashboard');

            } else {
                throw ValidationException::withMessages([
                    'error' => [trans('auth.failed')],
                ]);
                return back()->withInput($request->only('email', 'remember'));
            }

    }

    public function logout(){
        Auth::logout();
        return view('admin.login');
    }
}
