<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'national_id'     => ['required', 'numeric'],
            'business_number' => ['required', 'numeric'],
            'country'         => ['required', 'string', 'max:100'],
            'state'           => ['required', 'string', 'max:100'],
            'city'            => ['required', 'string', 'max:100'],
            'zip'             => ['required', 'string', 'max:100'],
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        $client                  = $user->getClient();
        $client->national_id     = $request->national_id;
        $client->business_number = $request->business_number;
        $client->country         = $request->country;
        $client->gender          = $request->gender;
        $client->state           = $request->state;
        $client->city            = $request->city;
        $client->zip             = $request->zip;
        $client->phone           = $request->phone;
        $client->business_name   = $request->business_name;
        $client->vat_no          = $request->vat_no;
        $client->tax_no          = $request->tax_no;
        $client->tel             = $request->tel;
        $client->area            = $request->area;
        $client->house           = $request->house;
        $client->whatsapp        = $request->whatsapp;
        $client->vibre           = $request->vibre;
        $client->imo             = $request->imo;
        $client->website         = $request->website;
        $client->notes           = $request->notes;
        $client->admin_notes     = $request->admin_notes;
        $client->save();

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }
        // $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
