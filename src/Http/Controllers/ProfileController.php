<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use TypiCMS\Modules\Users\Shells\Http\Requests\FormRequestAddress;
use TypiCMS\Modules\Users\Shells\Models\UserAddress;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Shows user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();

        return view('users::public.show-profile')
                ->with(compact('user'));
    }

    /**
     * Create user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function createAddress()
    {
        $model = new UserAddress();

        return view('users::public.create-profile')
                ->with(compact('model'));
    }

    /**
     * Edit the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function editAddress(UserAddress $address)
    {
        $user = Auth::user();

        if ($user && ($user->id == $address->user_id)) {
            return view('users::public.edit-profile')
                ->with(['model' => $address]);
        }
    }

    /**
     * Store the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeAddress(FormRequestAddress $request)
    {
        if ($request->user()) {
            $address = new UserAddress();
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            $address->create($data);
        }

        return redirect()->back();
    }

    /**
     * Update the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateAddress(UserAddress $address, FormRequestAddress $request)
    {
        if ($request->user() && ($request->user()->id == $address->user_id)) {
            $address->update($request->all());
        }

        return redirect('profile');
    }
}
