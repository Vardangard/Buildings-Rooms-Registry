<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'unauth');
    }

    protected function attemptLogin(Request $request)
    {
        $broker = new \Zefy\LaravelSSO\LaravelSSOBroker;

        $credentials = $this->credentials($request);
        return $broker->login($credentials[$this->username()], $credentials['password']);
    }

    public function logout(Request $request)
    {
        $broker = new \Zefy\LaravelSSO\LaravelSSOBroker;

        $broker->logout();

        $this->guard()->logout();

        $request->session()->invalidate();
        
        return redirect('/login')->with('success', 'Sėkmingai atsijungėte!');
    }

    public function unauth(Request $request)
    {
        $broker = new \Zefy\LaravelSSO\LaravelSSOBroker;

        $broker->logout();

        $this->guard()->logout();

        $request->session()->invalidate();
        
        return redirect('/login')->with('danger', 'Jums leidimas nesuteiktas!');
    }

    public function username()
    {
        return 'username';
    }

    protected function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
            $this->username()   => $this->cleanUsername($request->input($this->username())),
            'password'          => $request->input('password'),
        ];
    }

    /**
     * Replace not possible characters from username.
     *
     * @param  null|string $username
     * @return null|string
     */
    protected function cleanUsername(?string $username)
    {
        if (!$username) {
            return null;
        }

        $replaces = [
            'ą' => 'a',
            'č' => 'c',
            'ę' => 'e',
            'ė' => 'e',
            'į' => 'i',
            'š' => 's',
            'ų' => 'u',
            'ū' => 'u',
            'ž' => 'z',
            '@vdu.lt' => ''
        ];

        return str_replace(
            array_keys($replaces),
            array_values($replaces),
            mb_strtolower($username)
        );
    }
}