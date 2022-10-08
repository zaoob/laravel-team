<?php

namespace Zaoob\Laravel\Team\Traits;

use Zaoob\Laravel\Team\Models\Team;

trait Teamable
{
    public function addMember($memberModel, $memberModelId, $rule = null, $expires_at = null)
    {
        return $this->morphOne(Team::class, 'modelable')
            ->create([
                'member_type' => $memberModel,
                'member_id' => $memberModelId,
                'rule' => $rule,
                'expires_at' => $expires_at,
            ]);
    }

    public function getMember($member_id)
    {
        return $this->getMembers->where('member_id', $member_id)->first();
    }

    public function getMembers()
    {
        return $this->morphMany(Team::class, 'modelable');
    }
}
