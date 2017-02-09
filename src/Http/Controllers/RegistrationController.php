<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Routing\Controller;
use TypiCMS\Modules\Core\Shells\Facades\TypiCMS;
use TypiCMS\Modules\Users\Shells\Http\Requests\FormRequestRegister;
use TypiCMS\Modules\Users\Shells\Repositories\UserInterface;
use Auth;

class RegistrationController extends Controller
{
    protected $repository;

    /**
     * Create a new registration controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $user)
    {
        $this->repository = $user;

        $this->middleware('guest');
        $this->middleware('registrationAllowed');
    }

    /**
     * Show the register page.
     *
     * @return \Response
     */
    public function getRegister()
    {
        return view('users::register');
    }

    /**
     * Perform the registration.
     *
     * @param FormRequestRegister $request
     * @param Mailer              $mailer
     *
     * @return \Redirect
     */
    public function postRegister(FormRequestRegister $request, Mailer $mailer)
    {
        $data = $request->all();

        $data['activated'] = true;
        $user = $this->repository->create($data);

        $mailer->send('users::emails.welcome', compact('user'), function (Message $message) use ($user) {
            $subject = '['.TypiCMS::title().'] '.trans('users::global.Welcome');
            $message->to($user->email)->subject($subject);
        });

        Auth::login($user);

        return redirect()
            ->back()
            ->with('status', trans('users::global.Your account has been created'));
    }

    /**
     * Confirm a user’s email address.
     *
     * @param string $token
     *
     * @return mixed
     */
    public function confirmEmail($token)
    {
        $user = $this->repository->byToken($token);

        if (!$user) {
            abort(404);
        }

        $user->confirmEmail();

        return redirect()
            ->route('login')
            ->with('status', trans('users::global.Your account has been activated, you can now log in'));
    }
}
