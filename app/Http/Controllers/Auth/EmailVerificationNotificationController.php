<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $user = $request->user();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
        $emailBody = view('auth.email', compact(['user', 'verificationUrl']))->render();

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $email->setSubject("Verify your email address");
        $email->addTo($user->email, $user->name);
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent("text/html", $emailBody);
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            if ($response->statusCode() == 202) {
                return back()->with('status', 'verification-link-sent');
            } else {
                return back()->with('status', 'something-went-wrong');
            }
        } catch (Exception $e) {
            return back()->with('status', 'something-went-wrong');
        }
    }
}
