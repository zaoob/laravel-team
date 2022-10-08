<?php

namespace Zaoob\Laravel\Team\Traits;

use Zaoob\Laravel\Team\Models\Team;

trait Teamable
{
    public function addMember($user_id, $rule = null, $expires_at = null)
    {
        $users_model = config('auth.providers.users.model');

        $member = $this->morphOne(Team::class, 'modelable')
            ->where('member_type', $users_model)
            ->where('member_id', $user_id)
            ->first();

        if (!$member) {
            $member = $this->morphOne(Team::class, 'modelable')
                ->create([
                    'member_type' => $users_model,
                    'member_id' => $user_id,
                    'rule' => $rule,
                    'expires_at' => $expires_at,
                ]);
        }

        return $member;
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
