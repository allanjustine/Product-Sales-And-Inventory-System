<?php

namespace App\Http\Livewire\Auth;

use App\Events\UserLoginHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class Login extends Component
{

    public $email, $password;
    public $remember;
    public $newPassword;
    public $user;

    public function mount(Request $request)
    {
        $this->email = $request->old('email') ?: Cookie::get('remembered_email');
    }


    public function login()
    {
        $validatedData = $this->validate([
            'email'             =>      'required|email',
            'password'          =>      'required',
        ]);


        if ($this->remember) {
            Cookie::queue('remembered_email', $this->email, 60 * 24 * 30); // 30 days
        } else {
            Cookie::queue(Cookie::forget('remembered_email'));
        }

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || $user->email_verified_at == null) {

            alert()->error('Error', 'The email is either not verified yet or does not exist');

            return redirect('/login');
        }

        if (Auth::attempt($validatedData)) {

            $agent = new Agent();

            $ip_address = request()->ip() ?? 'Unknown IP';

            $browser_address = $agent->platform() . ", " .  $agent->browser() ?? 'Unknown Browser';

            if (auth()->user()->is_admin) {

                event(new UserLoginHistory($ip_address, $browser_address));

                return redirect()->intended('/admin/dashboard');
            } else {

                event(new UserLoginHistory($ip_address, $browser_address));

                return redirect()->intended('/');
            }
        } else {

            if ($validatedData != $this->password) {
                alert()->warning('Sorry', 'Password is incorrect');
            }
            return redirect('/login');
        }

        return redirect('/login');
    }

    public function sendNewPassword()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $this->email)->first();

        $random = Str::random(6);

        if ($user) {
            $newPassword = $random;
            $user->password = Hash::make($newPassword);
            $user->save();

            Mail::send('pages.auth.new-password', ['user' => $user, 'newPassword' => $newPassword], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Your new password');
            });
            alert()->success('Congrats', 'A new password has been sent to your email address.');
        } else {
            alert()->error('Error', 'We could not find a user with that email address.');
        }

        $this->reset('email');

        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
