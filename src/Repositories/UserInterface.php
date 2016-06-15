<?php

namespace TypiCMS\Modules\Users\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface UserInterface extends RepositoryInterface
{
    /**
     * Create a new model.
     *
     * @param array $data
     *
     * @return mixed Model or false on error during save
     */
    public function create(array $data, array $syncTables = []);

    /**
     * Update an existing model.
     *
     * @param array $data
     *
     * @return bool
     */
    public function update(array $data, array $syncTables = []);

    /**
     * Find user by token.
     *
     * @param string $key
     * @param string $value
     * @param array  $with
     */
    public function byToken($token);

    /**
     * Update current user preferences.
     *
     * @return mixed
     */
    public function updatePreferences(array $data);
}
