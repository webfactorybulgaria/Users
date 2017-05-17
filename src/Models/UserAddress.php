<?php

namespace TypiCMS\Modules\Users\Models;

use TypiCMS\Modules\Core\Shells\Models\Base;
//use TypiCMS\Modules\Users\Shells\Models\User;

class UserAddress extends Base
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'company',
        'country',
        'state',
        'city',
        'address',
        'address2',
        'postcode',
        'phone'
    ];

    /**
     * User Address belongs to user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo('TypiCMS\Modules\Users\Shells\Models\User');
    }
}