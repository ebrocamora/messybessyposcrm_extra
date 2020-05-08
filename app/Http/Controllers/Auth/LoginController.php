<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use InvalidArgumentException;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'getUserInfo']);
    }

    /**
     * Redirect application to Oauth server for authentication and access token
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(Request $request)
    {

        if (Auth::check()) {
            return redirect('/');
        }

        $request->session()->put('state', $state = Str::random(128));

        $query = http_build_query([
            'state' => $state,
            'client_id' => config('passport.client_id'),
            'redirect_uri' => config('passport.redirect_uri'),
            'response_type' => 'code',
            'scope' => '',
        ]);

        return redirect(config('passport.server') . '/oauth/authorize?' . $query);
    }

    /**
     * OAuth callback handler
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function callback(Request $request)
    {
        if ($request->error == 'access_denied') return redirect('/');

        $state = $request->session()->pull('state');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );

        $http = new \GuzzleHttp\Client();
        $response = $http->post(config('passport.server') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => config('passport.client_id'),
                'client_secret' => config('passport.client_secret'),
                'redirect_uri' => config('passport.redirect_uri'),
                'code' => $request->code
            ]
        ]);

        $data = encrypt(json_decode((string)$response->getBody(), true));

        $request->session()->put('oauth_payload', $data);

        return redirect(route('auth.user'));
    }

    /**
     * Get access token user information
     *
     * @param Request $request
     * @return mixed
     */
    public function getUserInfo(Request $request)
    {
        $payload = decrypt($request->session()->pull('oauth_payload'));
        $token = $payload['access_token'];

        $http = new \GuzzleHttp\Client();
        $response = $http->get(config('passport.server') . '/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer $token"
            ]
        ]);

        $user = json_decode((string)$response->getBody(), true);

        if ($user) {
            if ($user = Auth::loginUsingId($user['id'])) {
                session()->put('access_token', $token);
            }
        }

        return redirect('/home');
    }

    /**
     * Logged out user ta all session
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logoutOtherDevices(Str::random());
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * Redirect to OAuth Server to log out
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loggedOut()
    {
        return redirect(config('passport.server') . "/client/logout?redirect_uri=" . config('app.url') . "/logout/callback");
    }

    /**
     * Logged out callback handler
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function loggedOutCallback()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('logged-out-callback');
    }
}
