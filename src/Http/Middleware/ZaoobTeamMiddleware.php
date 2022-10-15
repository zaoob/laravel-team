<?php

namespace Zaoob\Laravel\Team\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;

class ZaoobTeamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission = false)
    {
        if (!$request->hasMacro('modelTeamable')) {
            throw new Exception('Request not has macro `modelTeamable()`.');
        }

        $member = $request->modelTeamable()->getMembers->where('member_id', $request->user()->id)->firstOrFail();

        if (!$permission) {
            
            $member->update([
                'last_used_at' => Carbon::now(),
            ]);

            return $next($request);
        }

        $rules = config('zaoob.team.rules.' . $member->rule);

        if ($member->rule != '*' && !in_array('zaoobTeam:' . $permission, $rules)) {
            abort(403, 'You do not have permission to it');
        }

        $member->update([
            'last_used_at' => Carbon::now(),
        ]);

        return $next($request);
    }
}
