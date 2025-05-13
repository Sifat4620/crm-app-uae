<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        // dd($request->business_name);

        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'national_id'     => ['required', 'numeric'],
            'business_number' => ['required', 'numeric'],
            'country'         => ['required', 'string', 'max:100'],
            'email'           => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'        => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // dd($request);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $user->business_name   = $request->business_name;
        $user->vat_no          = $request->vat_no;
        $user->tax_no          = $request->tax_no;
        $user->national_id     = $request->national_id;
        $user->mobile          = $request->mobile;
        $user->business_number = $request->business_number;
        $user->tel             = $request->tel;
        $user->gender          = $request->gender;
        $user->country         = $request->country;
        $user->state           = $request->state;
        $user->city            = $request->city;
        $user->zip             = $request->zip;
        $user->area            = $request->area;
        $user->house           = $request->house;
        $user->whatsapp        = $request->whatsapp;
        $user->vibre           = $request->vibre;
        $user->imo             = $request->imo;
        $user->website         = $request->website;
        $user->notes           = $request->notes;
        $user->admin_notes     = $request->admin_notes;
        $user->save();

        return redirect(route('dashboard', absolute: false));
    }
}
