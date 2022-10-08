<?php

namespace Zaoob\Laravel\Team\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zaoob_teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'member_type',
        'member_id',
        'rule',
        'expires_at',
    ];
}
