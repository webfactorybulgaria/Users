<?php

namespace TypiCMS\Modules\Users\Models;

use TypiCMS\Modules\Core\Shells\Models\Base;

class Social extends Base
{
    protected $table = 'social_logins';

    public function user()
    {
        return $this->belongsTo('TypiCMS\Modules\Users\Models\Shells\User');
    }
}

