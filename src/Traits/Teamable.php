<?php

namespace Zaoob\Laravel\Team\Traits;

use Zaoob\Laravel\Team\Models\Team;

trait Teamable
{
    public function addMember($user_id, $rule = null, $expires_at = null)
    {
        return $this->morphOne(Team::class, 'modelable')
            ->create([
                'member_type' => config('auth.providers.users.model'),
                'member_id' => $user_id,
                'rule' => $rule,
                'expires_at' => $expires_at,
            ]);
    }

    public function getMember($user_id)
    {
        return $this->getMembers->where('member_id', $user_id)->first();
    }

    public function getMembers()
    {
        return $this->morphMany(Team::class, 'modelable');
    }
}
