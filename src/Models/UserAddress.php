<?php

namespace TypiCMS\Modules\Users\Models;

use TypiCMS\Modules\Core\Shells\Models\Base;

class UserAddress extends Base
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_name',
        'phone',
        'address',
        'address2',
        'postcode',
        'city',
        'state',
        'country',
        'details',
    ];

    /**
     * Address belongs to user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}