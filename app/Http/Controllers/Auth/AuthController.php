<?php

namespace Dbs\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Dbs\User;
use Validator;
use Dbs\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /** 
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getAdminLogin(){
        return view('auth.adminLogin', compact('page'));
    }

    public function postLogin(Request $request)
    {
        if($request->get('loginType') == 'Admin'){
            $this->validate($request, [
                $this->loginUsername() => 'required', 'password' => 'required', 'g-recaptcha-response' => 'recaptcha'
            ]);
        }else{
            $this->validate($request, [
                $this->loginUsername() => 'required', 'password' => 'required'
            ]);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        $user = User::where('email', '=', $request->get('email'))->first();
        if($user && $user->UserType->value == $request->get('loginType')){
            if (Auth::attempt($credentials, $request->has('remember'))) {
                return $this->handleUserWasAuthenticated($request, $throttles);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if ($throttles) {
                $this->incrementLoginAttempts($request);
            }

            if($request->get('loginType') == 'Admin'){
                return redirect('/admin/auth/login')
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->withErrors([
                        $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
            }else{
                return redirect($this->loginPath())
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->withErrors([
                        $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
            }
        }else{
            if($request->get('loginType') == 'Admin'){
                return redirect('/admin/auth/login')
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->withErrors([
                        $this->loginUsername() => 'There is no '.$request->get('loginType').' with this email address.',
                ]);
            }else{
                return redirect($this->loginPath())
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => 'There is no '.$request->get('loginType').' with this email address.',
                ]);
            }
        }
    }

    public function getLogout()
    {
        Auth::logout();

        if(\Request::get('page') == 'admin'){
            return \Redirect::to('/admin/auth/login');
        }else{
            return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
        }
    }

    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

}
