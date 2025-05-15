<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'national_id'     => ['required', 'numeric'],
            'business_number' => ['required', 'numeric'],
            'country'         => ['required', 'string', 'max:100'],
            'email'           => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'        => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $client = new Client();

        $client->user_id         = $user->id;
        $client->national_id     = $request->national_id;
        $client->business_number = $request->business_number;
        $client->country         = $request->country;
        $client->gender          = $request->gender;
        $client->state           = $request->state;
        $client->city            = $request->city;
        $client->zip             = $request->zip;
        $client->save();

        return redirect(route('dashboard', absolute: false));
    }
}
