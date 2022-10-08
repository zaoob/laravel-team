<?php

namespace Zaoob\Laravel\Team\Traits;

use Zaoob\Laravel\Team\Models\Team;

trait Memberships
{
    public function getMemberships()
    {
        return $this->hasMany(Team::class, 'member_id', 'id');
    }
}
