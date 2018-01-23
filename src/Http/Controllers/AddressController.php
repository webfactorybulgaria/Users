<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use TypiCMS\Modules\Users\Shells\Models\UserAddress;
use TypiCMS\Modules\Users\Shells\Http\Requests\FormRequestAddress;

class AddressController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users::public.address.create');
    }

    /**
     * @param FormRequestAddress $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequestAddress $request)
    {
        auth()->user()->addresses->create($request->all());

        return redirect()->route('profile.show');
    }

    /**
     * @param UserAddress $address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(UserAddress $address)
    {
        $this->abortIfTheUserDoesNotOwnTheAddress($address);

        return view('users::public.address.edit', compact('address'));
    }

    /**
     * @param UserAddress $address
     * @param FormRequestAddress $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserAddress $address, FormRequestAddress $request)
    {
        $this->abortIfTheUserDoesNotOwnTheAddress($address);

        $address->update($request->all());

        return redirect()->back();
    }

    /**
     * @param UserAddress $address
     */
    private function abortIfTheUserDoesNotOwnTheAddress(UserAddress $address)
    {
        if (auth()->user()->id != $address->user->id) return abort(404);
    }
}