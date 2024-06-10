<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GoogleService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    protected $googleService;

    public function __construct(GoogleService $googleService)
    {
        $this->googleService = $googleService;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogle()
    {
        $googleUser = Socialite::driver('google')->user();

        $existingUser = User::where('google_id', $googleUser->id)->first();

        $expiresInSeconds = $googleUser->expiresIn;
        $expiryDateTime = now()->addSeconds($expiresInSeconds);

        if ($existingUser) {
            $existingUser->update([
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'google_token_expiry' => $expiryDateTime,
            ]);
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'id_role' => 2,
            ]);

            Auth::login($newUser);
        }

        return redirect()->intended('/dashboard');
    }

    public function someGoogleApiFunction(User $user)
    {
        $accessToken = $user->google_token;

        if ($this->tokenHasExpired($user)) {
            $accessToken = $this->googleService->refreshAccessToken($user);
        }

        $response = $this->googleService->makeApiRequest($accessToken);

        return $response;
    }

    protected function tokenHasExpired(User $user)
    {
        $expiry = $user->google_token_expiry;

        return $expiry ? now()->greaterThan($expiry) : true;
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:tbl_users,email',
            'password' => 'required|min:8|max:255',
            'confirm-password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_role' => 2
            ]);

            event(new Registered($user));

            Auth::login($user);

            DB::commit();

            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $cekDataPengguna = User::where('email', $request->email)->first();

        if ($cekDataPengguna) {
            if (Auth::attempt($credentials)) {
                if (Auth::user()->email_verified_at == '') {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect('verify');
                }

                $request->session()->regenerate();

                if (Auth::user()->id_role == '1') {
                    return redirect('admin/dashboard');
                } else {
                    return redirect()->route('customer.index');
                }
            } else {
                return back()->withInput()->with(
                    'msg',
                    '<div class="alert alert-danger alert-dismissible text-white" role="alert">
        <span class="text-sm">Email atau password salah.</span>
        <button type="button" class="btn-close text-lg py-3 " data-bs-dismiss="alert" aria-label="Close">
        </button>
        </div>'
                );
            }
        }
        return back()->withInput()->with('msg', '<div class="alert alert-danger alert-dismissible text-white" role="alert">
        <span class="text-sm">Akun Tidak Ditemukan. Silahkan Daftar akun terlebih dahulu.</span>
        <button type="button" class="btn-close text-lg py-3" data-bs-dismiss="alert" aria-label="Close">    
        </button>
        </div>');
    }

    public function verify()
    {
        return view('auth.verify');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
