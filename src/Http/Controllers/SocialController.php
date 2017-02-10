<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Routing\Controller;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

use TypiCMS\Modules\Users\Shells\Models\Social;
use TypiCMS\Modules\Users\Shells\Models\User;

class SocialController extends Controller
{

    public function getSocialRedirect( $provider )
    {
        if (!config()->get('auth.social_users')) return redirect(route(config('app.locale') . '.login'));

        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {

            return view('pages.status')
                ->with('error','No such provider');

        }

        return Socialite::driver( $provider )->redirect();

    }

    public function getSocialHandle( $provider )
    {
        if (!config()->get('auth.social_users')) return redirect(route(config('app.locale') . '.login'));

        if (Input::get('denied') != '') {

            return redirect()->to(route(config('app.locale') . '.login'))
                    ->withErrors([
                        'email' => trans('users::global.You did not share your profile data with our social app.'),
                    ]);

        }

        $user = Socialite::driver( $provider )->user();

        $socialUser = null;

        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();

        $email = $user->email;

        if (!$user->email) {
            $email = 'missing' . str_random(10);
        }

        if (!empty($userCheck)) {

            $socialUser = $userCheck;

        } else {

            $sameSocialId = Social::where('social_id', '=', $user->id)
                ->where('provider', '=', $provider )
                ->first();

            if (empty($sameSocialId)) {

                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new User;
                $newSocialUser->email              = $email;
                $name = explode(' ', $user->name);

                if (count($name) >= 1) {
                    $newSocialUser->first_name = $name[0];
                }

                if (count($name) >= 2) {
                    $newSocialUser->last_name = $name[1];
                }

                $newSocialUser->password = bcrypt(str_random(16));
                $newSocialUser->token = str_random(64);
                $newSocialUser->activated = true;

                if ($social_admin_emails = config()->get('auth.social_admin_emails')) {
                    $social_admin_emails = explode(',', $social_admin_emails);
                    foreach ($social_admin_emails as $social_admin_email) {
                        $social_admin_email = trim($social_admin_email);
                        if (!empty($social_admin_email) && $social_admin_email == $user->email) {
                            $newSocialUser->superuser = true;
                        }
                    }
                }

                if ($social_admin_domains = config()->get('auth.social_admin_domains')) {
                    $social_admin_domains = explode(',', $social_admin_domains);
                    foreach ($social_admin_domains as $social_admin_domain) {
                        $social_admin_domain = trim($social_admin_domain);
                        if (!empty($social_admin_domain) && preg_match('/@' . preg_quote($social_admin_domain, '/') . '$/', $user->email)) {
                            $newSocialUser->superuser = true;
                        }
                    }
                }

                if (!$newSocialUser->superuser && !config()->get('auth.social_guests')) {
                    return redirect()
                        ->route(config('app.locale') . '.login')
                        ->withErrors([
                            'email' => trans('users::global.User does not exist'),
                        ]);
                }

                $newSocialUser->save();

                $socialData = new Social;
                $socialData->social_id = $user->id;
                $socialData->provider = $provider;
                $newSocialUser->social()->save($socialData);

                $socialUser = $newSocialUser;

            } else {

                //Load this existing social user
                $socialUser = $sameSocialId->user;

            }

        }

        auth()->login($socialUser, true);

        return redirect()->intended(url('/'));
    }
}