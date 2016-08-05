<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Custom\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Users\Custom\Http\Requests\FormRequest;
use TypiCMS\Modules\Users\Custom\Models\User;
use TypiCMS\Modules\Users\Custom\Repositories\UserInterface;

class AdminController extends BaseAdminController
{
    public function __construct(UserInterface $user)
    {
        parent::__construct($user);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all([], true);
        app('JavaScript')->put('models', $models);

        return view('users::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();
        $permissions = [];
        $selectedRoles = [];

        return view('users::admin.create')
            ->with(compact('model', 'permissions', 'selectedRoles'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Users\Custom\Models\User $user
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $permissions = $user->permissions()->pluck('name')->all();
        $selectedRoles = $user->roles()->pluck('id')->all();

        return view('users::admin.edit')
            ->with([
                'model'         => $user,
                'permissions'   => $permissions,
                'selectedRoles' => $selectedRoles,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Users\Custom\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $user = $this->repository->create($request->all());

        return $this->redirect($request, $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Users\Custom\Models\User               $user
     * @param \TypiCMS\Modules\Users\Custom\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $user);
    }

    /**
     * Update User's preferences.
     *
     * @return void
     */
    public function postUpdatePreferences()
    {
        $this->repository->updatePreferences(Request::all());
    }
}
