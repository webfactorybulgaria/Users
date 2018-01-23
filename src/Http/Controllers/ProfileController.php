<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use TypiCMS\Modules\Users\Shells\Http\Requests\FormRequestAddress;
use TypiCMS\Modules\Users\Shells\Models\UserAddress;
use Auth;

class ProfileController extends Controller
{
    /**
     * Shows user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = auth()->user();

        return view('users::public.profile.show', compact('user'));
    }
}
